@extends('layouts.en.wap')
@section('route','en/site/news')
@section('content')
    <!-- 内容 -->
    <div class="container page_news">
        <div class="top_pic_c">
            <img src="{{yStatic('en/wap/img/top_pic1.jpg')}}" class="top_pic" />
            <img src="{{yStatic('en/wap/img/title3.png')}}" alt="HME NEWS  新闻与故事" class="title"/>
        </div>

        <div class="page_con con1">
            <ul class="news_list">
                <li  v-for="item in news">
                    <a v-bind:href="'/en/site/ndetail?id='+item.id">
                        <div class="thumb"><img v-bind:src="domain+item.img_url" alt="上海Mini Readthon春日热身阅读计划" /></div>
                        <div class="info">
                            <div class="title">@{{ item.title }}</div>
                            <div class="desc">@{{ item.desc }}</div>
                        </div>
                    </a>
                </li>
            </ul>

            <a class="btn_more" v-if="is_show>0"><span v-on:click="getMore()">查看更多 More</span></a>
        </div>

        <div class="page_con con2">
            <div class="employees_top">
                <img src="{{yStatic('en/wap/img/news_bg.jpg')}}" alt="" class="news_bg"/>
                <img src="{{yStatic('en/wap/img/title4.png')}}" alt="HME THE LIFE OF OUR EMPLOYEES  员工动态" class="title"/>
            </div>

            <div class="wrap">
                <div class="employees_c">
                    <div class="swiper-container employees_w">
                        <div class="swiper-wrapper">


                            <div class="swiper-slide" v-for="(item,index) in active" :key="index">
                                <div class="pic">
                                    <img v-bind:src="domain+item.img_url" alt="公司年度团日活动">
                                </div>
                                <div class="name">@{{ item.title }}</div>
                            </div>





{{--                            <div class="swiper-slide">--}}
{{--                                <div class="pic">--}}
{{--                                    <img src="{{yStatic('wap/img/culture_1_550x310.jpg')}}" alt="公司年度团日活动">--}}
{{--                                </div>--}}
{{--                                <div class="name">公司年度团日活动</div>--}}
{{--                            </div>--}}
{{--                            <div class="swiper-slide">--}}
{{--                                <div class="pic">--}}
{{--                                    <img src="{{yStatic('wap/img/culture_1_550x310.jpg')}}" alt="公司年度团日活动">--}}
{{--                                </div>--}}
{{--                                <div class="name">公司年度团日活动</div>--}}
{{--                            </div>--}}
{{--                            <div class="swiper-slide">--}}
{{--                                <div class="pic">--}}
{{--                                    <img src="{{yStatic('wap/img/culture_1_550x310.jpg')}}" alt="公司年度团日活动">--}}
{{--                                </div>--}}
{{--                                <div class="name">公司年度团日活动</div>--}}
{{--                            </div>--}}


                        </div>
                    </div>

                    <div class="swiper_prev"></div>
                    <div class="swiper_next"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /内容 -->
    @include('layouts.en.foot')
@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app',
            mounted() {
                this.getNews();
                this.getActive();
            },
            data() {
                return {
                    domain: '{{ Yii::$app->params['qiniu']['domain'] }}',
                    num: 0,
                    news: [],
                    news_page:1,
                    is_show: 1,
                    active: [],
                    active_page: 0,
                    query: {
                        page: 1,
                        size: 6
                    }

                }
            },
            methods: {
                getNews() {
                    let _this = this;
                    Helper.asynRequest('GET', '/en/api/news-list', _this.query, function (response) {
                        _this.news = response.data;
                        //_this.news_page =  Math.ceil(response.recordsTotal / _this.query.size) ;  // 总页数
                        _this.is_show = response.recordsTotal > _this.query.size*_this.query.page ?1:0 ;  // 总页数
                        console.log(_this.is_show);
                        _this.num++;
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });
                },
                getMore(){
                   let _this = this;
                   _this.query.page++;
                    Helper.asynRequest('GET', '/en/api/news-list', _this.query, function (response) {
                        _this.news = _this.news.concat(response.data);
                        _this.is_show = response.recordsTotal > _this.query.size*_this.query.page ?1:0 ;  // 总页数
                        console.log(_this.is_show);

                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });

                },
                getActive() {
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
                initDom() {
                    let _this = this;
                    if (_this.num < 2) {
                       // return;
                    }
                    // 新闻动态翻页
                    // var prevPage = $('.news_pagination .prev');
                    // var nextPage = $('.news_pagination .next');
                    //
                    // // 点击页面加载内容
                    // $('body').delegate('.news_pagination .num>li', 'click', function () {
                    //     var idx = parseInt($(this).html());
                    //     _this.query.page = idx;
                    //     _this.getNews();
                    // });
                    // // 上一页
                    // prevPage.click(function () {
                    //     // 当前页码
                    //     var nowPage = parseInt($('.news_pagination .num').find('.active').html());
                    //
                    //     if (nowPage > 1) {
                    //         _this.query.page = nowPage-1;
                    //         _this.getNews();
                    //     }
                    // });
                    //
                    // // 下一页
                    // nextPage.click(function () {
                    //
                    //     // 当前页码
                    //     var nowPage = parseInt($('.news_pagination .num').find('.active').html());
                    //     if (nowPage < _this.news_page) {
                    //         _this.query.page = nowPage+1;
                    //         _this.getNews();
                    //     }
                    // });


                    setTimeout(function () {

                        // 员工动态
                        var employees_w = new Swiper('.employees_w', {
                            speed: 800,
                            spaceBetween: 30,
                            navigation: {
                                nextEl: '.employees_c .swiper_next',
                                prevEl: '.employees_c .swiper_prev',
                            },
                        });

                    },100);

                }
            }
        })
    </script>
@stop

@section('plugin-style')
@stop
