@extends('layouts.en.main')
@section('route','/en/site/cpjy')
@section('content')
    <div class="wrapper">
        <div class="banner_c">
            <img src="{{yStatic('en/img/banner6.jpg')}}" class="banner_pic" />
            <div class="banner_text">
                <img src="{{yStatic('en/img/banner_text6.png')}}" style="width: 58.677%;"/>
            </div>
        </div>

        <div class="rect_reason">
            <div class="wrap"><!-- 
                <div class="title">N reasons to join Huayu Magna</div>
                <ul class="reason_list">
                    <li style="margin-left: 70px;">
                        <div><span>Powerful platform</span></div>
                        <p>Shareholders = Chinese spare parts No.1, Huayu + spare parts No.3 in the world, Magna</p>
                    </li>
                    <li>
                        <div><span>Industrial opportunities</span></div>
                        <p>New energy electric vehicles, supported by national policies</p>
                    </li>
                    <li>
                        <div><span>Strength team</span></div>
                        <p>High education level = 60% (Master's degree) / 80% (graduated from elite universities of “985” and “211”) / 20% (overseas study experience)<br/>Geographical diversity = members from all over the world<br/>Diverse working background = members from major global well-known automobile enterprises or main engine plants</p>
                    </li>
                </ul>-->
            </div>
        </div>
		

        <div class="rect_conn1">
            <div class="wrap">
                <div class="left">
                    <div class="title">Join Us</div>
                    <!-- 招聘职位列表 active-展开 -->
                    <ul class="rect_list">
                        <li v-for="(item,index) in job" :key="index" :class="{'active': index==job_index}" >
                            <div class="work">
                                <span>@{{ item.name }}</span>
                                <div class="btn_toggle"><img src="{{yStatic('en/img/job_toggle.png')}}" /></div>
                            </div>
                            <div class="content" :style="{display: index==job_index?'block':'none'}">
                                <div class="tr">
                                    <div class="left">Location: </div>
                                    <div class="right">@{{ item.address }}</div>
                                </div>
                                <div class="tr">
                                    <div class="left">Jobs: </div>
                                    <div class="right" v-html="item.targent">
                                    </div>
                                </div>
                                <div class="tr">
                                    <div class="left">Responsibilities: </div>
                                    <div class="right" v-html="item.duty">
                                    </div>
                                </div>
                                <div class="tr">
                                    <div class="left">Qualifications: </div>
                                    <div class="right" v-html="item.require">
                                    </div>
                                </div>
                                <div class="tr">
                                    <div class="left">Other: </div>
                                    <div class="right">@{{ item.other }}</div>
                                </div>
                                <div class="send"><span>Send resume：</span><a v-bind:href="'mailto:'+item.email">@{{ item.email }}</a></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="right">
                    <img src="{{yStatic('en/img/qr_code.jpg')}}" />
                    <p>QR code</p>
                </div>
            </div>
        </div>

        <div class="rect_conn2">
            <div class="wrap">
                <div class="concat_title"><span>STAFF TESTIMONIALS</span></div>
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
                    <img src="{{yStatic('en/img/prev.png')}}" class="swiper_prev" />
                    <img src="{{yStatic('en/img/next.png')}}" class="swiper_next" />
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
                    Helper.asynRequest('GET', '/en/api/job-list', {}, function (response) {
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
                    Helper.asynRequest('GET', '/en/api/employ-list', {}, function (response) {
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
