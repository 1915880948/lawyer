@extends('layouts.main')
@section('route','site/cpjy')
@section('content')
    <div class="wrapper">
        <div class="banner_c">
            <img src="{{yStatic('img/banner6.jpg')}}" class="banner_pic" />
            <div class="banner_text">
                <img src="{{yStatic('img/banner_text6.png')}}" style="width: 15.677%;"/>
            </div>
        </div>

        <div class="rect_reason">
            <div class="wrap"><!-- 
                <div class="title">加入华域麦格纳N个理由</div>
                <ul class="reason_list">
                    <li style="margin-left: 70px;">
                        <div><span>强大平台</span></div>
                        <p>股东方=中资零部件第一华域+世界零部件第三麦格纳</p>
                    </li>
                    <li>
                        <div><span>产业先机</span></div>
                        <p>新能源电动汽车，国家政策重点支持</p>
                    </li>
                    <li>
                        <div><span>实力团队</span></div>
                        <p>学历高=60%（硕士学历）/ 80%（985、211名校毕业）/ 20%（海外留学经历）<br/>地域多样化=成员来自五湖四海<br/>工作背景多样=成员来自各大全球知名汽车企业或主机厂</p>
                    </li>
                </ul>-->
            </div>
        </div>

        <div class="rect_conn1">
            <div class="wrap">
                <div class="left">
                    <div class="title">招聘职位</div>
                    <!-- 招聘职位列表 active-展开 -->
                    <ul class="rect_list">
                        <li v-for="(item,index) in job" :key="index" :class="{'active': index==job_index}" >
                            <div class="work">
                                <span>@{{ item.name }}</span>
                                <div class="btn_toggle"><img src="{{yStatic('img/job_toggle.png')}}" /></div>
                            </div>
                            <div class="content" :style="{display: index==job_index?'block':'none'}">
                                <div class="tr">
                                    <div class="left">工作地点：</div>
                                    <div class="right">@{{ item.address }}</div>
                                </div>
                                <div class="tr">
                                    <div class="left">岗位目标：</div>
                                    <div class="right" v-html="item.targent">
                                    </div>
                                </div>
                                <div class="tr">
                                    <div class="left">岗位职责：</div>
                                    <div class="right" v-html="item.duty">
                                    </div>
                                </div>
                                <div class="tr">
                                    <div class="left">任职资格：</div>
                                    <div class="right" v-html="item.require">
                                    </div>
                                </div>
                                <div class="tr">
                                    <div class="left">其它要求：</div>
                                    <div class="right">@{{ item.other }}</div>
                                </div>
                                <div class="send"><span>请发送您的简历至：</span><a v-bind:href="'mailto:'+item.email">@{{ item.email }}</a></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="right">
                    <img src="{{yStatic('img/qr_code.jpg')}}" />
                    <p>招聘公众号二维码</p>
                </div>
            </div>
        </div>

        <div class="rect_conn2">
            <div class="wrap">
                <div class="concat_title"><span>员工感言</span></div>
                <div class="concat_c">
                    <div class="swiper-container concat_swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" v-for="(item,index) in employe" :key="index">
                                <div class="concat_w">
                                    <div class="left">
                                        <img v-bind:src="domain+item.img_url" />
                                    </div>
                                    <div class="right">
                                        <h2>@{{ item.name }}</h2>
                                        <div class="intro" v-html="item.desc">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img src="{{yStatic('img/prev.png')}}" class="swiper_prev" />
                    <img src="{{yStatic('img/next.png')}}" class="swiper_next" />
                </div>
            </div>
        </div>
    </div>@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app',
	   // vue 在IE里不支持简写
            mounted:function(){
                this.getJob();
                this.getEmploy();
            },
	    // vue 在IE里不支持简写
            data:function(){
                return {
                    domain: '{{ Yii::$app->params['qiniu']['domain'] }}',
                    employe:{},
                    job:[],
                    job_index:0
                }
            },
            methods: {
		// vue 在IE里不支持简写
                getJob:function(){
                    let _this = this;
                    Helper.asynRequest('GET', '/api/job-list', {}, function (response) {
                        _this.job = response.list;
                        // _this.employe = response.data;
                        _this.initDom();
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });
                },
		// vue 在IE里不支持简写
                getEmploy:function(){
                    let _this = this;
                    Helper.asynRequest('GET', '/api/employ-list', {}, function (response) {
                        _this.employe = response.list;
                        _this.initEmploy();
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });
                },
		// vue 在IE里不支持简写
                initDom:function() {
                    setTimeout(function () {
                        $(document).ready(function(){
                            // 职位工作详情开关
                            var rect_toggle = $('.rect_list>li>.work');
                            console.log( rect_toggle.find('span').html() );
                            rect_toggle.click(function(){
                                var that = $(this).parent();
                                if(that.hasClass('active')){
                                    that.find('.content').slideUp();
                                    that.removeClass('active');
                                }else{
                                    that.find('.content').slideDown();
                                    that.addClass('active');
                                }
                            });
                        });
                    },500)

                },
		// vue 在IE里不支持简写
                initEmploy:function(){
                    // 员工感言
                    setTimeout(function () {
                        var concat_w = $('.concat_w');
                        var maxHeight = 300;
                        for(var i=0; i<concat_w.length; i++){
                            if(concat_w.height() > maxHeight){
                                maxHeight = concat_w.height();
                            }
                        }
                        $('.concat_swiper').height(maxHeight);
                        var concat_swiper = new Swiper('.concat_swiper', {
                            speed: 500
                        });
                        var prevButton = $('.concat_c .swiper_prev');
                        var nextButton = $('.concat_c .swiper_next');
                        prevButton.click(function(){
                            concat_swiper.swipePrev();
                        });
                        nextButton.click(function(){
                            concat_swiper.swipeNext();
                        });
                    },100);

                }
            }
        })
    </script>
@stop

@section('plugin-style')
@stop
