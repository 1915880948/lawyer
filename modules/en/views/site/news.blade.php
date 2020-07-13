@extends('layouts.en.main')
@section('plugin-style')
@endsection
@section('content')
    <div class="wrapper">
        <div class="banner_c">
            <img src="{{yStatic('en/img/banner2.jpg')}}" class="banner_pic"/>
            <div class="banner_text">
                <img src="{{yStatic('en/img/banner_text2.png')}}"/>
            </div>
        </div>

        <!-- 新闻动态 -->
        <div class="news_conn1">
            <div class="wrap">
                <ul class="news_list">
                    <li v-for="item in news">
                        <a v-bind:href="'/en/site/ndetail?id='+item.id">
                            <div class="left"><img v-bind:src="domain+item.img_url"></div>
                            <div class="right"><h1>@{{ item.title }}</h1>
                                <p>@{{ item.desc }}</p>
                                <span>@{{ item.time }}</span>
                            </div>
                        </a>
                    </li>
                </ul>

                <div class="news_pagination">
                    <div>
                        <img src="{{yStatic('en/img/prev.png')}}" class="prev"/>
                        <ul class="num">
                            <li v-for="p in news_page" v-bind:class="{'active':p==query.page}">@{{ p }}</li>
                        </ul>
                        <img src="{{yStatic('en/img/next.png')}}" class="next"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- 员工动态 -->
        <div class="banner_c">
            <img src="{{yStatic('en/img/news_bg.jpg')}}" class="banner_pic"/>
            <div class="banner_text" style="top: 0;">
                <img src="{{yStatic('en/img/news_bg_text.png')}}" style="width: 45.8854%; margin-top: 12.1vw;"/>
            </div>
        </div>

        <div class="news_conn2">
            <div class="wrap">
                <div class="swiper-container employ_swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <ul class="employ_list">
                                <li v-for="(item,index) in active" :key="index" v-if="0<=index && index<4">
                                    <img v-bind:src="domain+item.img_url" width="460" height="260"/>
                                    <div class="content">
                                        <p>@{{ item.title }}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="swiper-slide">
                            <ul class="employ_list">
                                <li v-for="(item,index) in active" :key="index" v-if="4<=index && index<8">
                                    <img v-bind:src="domain+item.img_url" width="460" height="260"/>
                                    <div class="content">
                                        <p>@{{ item.title }}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        {{--<div class="swiper-slide" v-for="i in active_page" :key="i">--}}
                        {{--<ul class="employ_list">--}}
                        {{--<li v-for="(item,index) in active" :key="index" v-if="(i-1)*(5-1) <= index && index<i*(5-1)">--}}
                        {{--<img v-bind:src="domain+item.img_url" width="460" height="260" />--}}
                        {{--<div class="content">--}}
                        {{--<p>@{{ item.title }}</p>--}}
                        {{--</div>--}}
                        {{--</li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <img src="{{yStatic('en/img/prev.png')}}" class="employ_prev"/>
                <img src="{{yStatic('en/img/next.png')}}" class="employ_next"/>
            </div>
        </div>

        <!-- 图片放大弹窗 -->
        <div class="pic_toast">
            <div class="shadow"></div>
            <div class="pic_wrap">
                <img src="{{yStatic('en/img/btn_close.png')}}" alt="关闭" class="btn_close"/>
                <img src="{{yStatic('en/img/employ1.jpg')}}" alt="" class="pic"/>
            </div>
        </div>
        <!-- /图片放大弹窗 -->
    </div>
@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app',
	    // vue 在IE里不支持简写
            mounted:function() {
                this.getNews();
                this.getActive();
            },
	    // vue 在IE里不支持简写
            data:function() {
                return {
                    domain: '{{ Yii::$app->params['qiniu']['domain'] }}',
                    num: 0,
                    news: [],
                    news_page:1,
                    active: [],
                    active_page: 0,
                    query: {
                        page: 1,
                        size: 5
                    }

                }
            },
            methods: {
		// vue 在IE里不支持简写
                getNews:function() {
                    let _this = this;
                    Helper.asynRequest('GET', '/en/api/news-list', _this.query, function (response) {
                        _this.news = response.data;
                        _this.news_page =  Math.ceil(response.recordsTotal / _this.query.size) ;  // 总页数
                        console.log(_this.news_page);
                        _this.num++;
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });
                },
		// vue 在IE里不支持简写
                getActive:function() {
                    let _this = this;
                    Helper.asynRequest('GET', '/en/api/active-list', {}, function (response) {
                        _this.active = response.data;
                        _this.num++;
                        _this.active_page = Math.ceil(_this.active.length / 4);
                        _this.initDom();
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });
                },
		// vue 在IE里不支持简写
                initDom:function() {
                    let _this = this;
                    if (_this.num < 2) {
                        return;
                    }
                    // 新闻动态翻页
                    var prevPage = $('.news_pagination .prev');
                    var nextPage = $('.news_pagination .next');

                    // 点击页面加载内容
                    $('body').delegate('.news_pagination .num>li', 'click', function () {
                        var idx = parseInt($(this).html());
                        _this.query.page = idx;
                        _this.getNews();
                    });
                    // 上一页
                    prevPage.click(function () {
                        // 当前页码
                        var nowPage = parseInt($('.news_pagination .num').find('.active').html());

                        if (nowPage > 1) {
                            _this.query.page = nowPage-1;
                            _this.getNews();
                        }
                    });

                    // 下一页
                    nextPage.click(function () {

                        // 当前页码
                        var nowPage = parseInt($('.news_pagination .num').find('.active').html());
                        if (nowPage < _this.news_page) {
                            _this.query.page = nowPage+1;
                            _this.getNews();
                        }
                    });

                    // 员工动态
                    var employSwiper = new Swiper('.employ_swiper', {
                        speed: 500
                    });
                    var prevButton = $('.employ_prev');
                    var nextButton = $('.employ_next');
                    prevButton.click(function () {
                        employSwiper.swipePrev();
                    });
                    nextButton.click(function () {
                        employSwiper.swipeNext();
                    });

                    setTimeout(function(){
                        // 图片放大/关闭
                        var pic_toast = $('.pic_toast');
                        var employ_list = $('.employ_list>li');
                        var enlarge_pic = $('.pic_toast .pic');
                        var btn_close = $('.pic_toast .shadow, .pic_toast .btn_close');
                        btn_close.on('click', function(){
                            pic_toast.fadeOut();
                        });
                        // alert(employ_list.val())
                        employ_list.on('click', function(){
                            enlarge_pic.attr('src', $(this).find('img').attr('src'));
                            pic_toast.fadeIn();
                        });
                    },100);


                }
            }
        })
    </script>
@stop

@section('plugin-style')
@stop
