@extends('layouts.en.wap')
@section('route','en/site/develop')
@section('content')
    <!-- 内容 -->
    <div class="container page_recruit">
        <div class="top_pic_c">
            <img src="{{yStatic('en/wap/img/top_pic5.jpg')}}" class="top_pic" />
            <img src="{{yStatic('en/wap/img/title8.png')}}" alt="HME HIRE THE ELITE  招聘人才" class="title"/>
        </div>

        <div class="page_con con1">
            <div class="wrap">
                <div class="title_style3"><span>N reasons to join Huayu Magna</span></div>

                <ul class="reason_list">
                    <li>
                        <div class="label_text">Powerful<br>platform</div>
                        <div class="desc">Shareholders = Chinese spare parts No.1, Huayu + spare parts No.3 in the world, Magna</div>
                    </li>
                    <li>
                        <div class="label_text">Industrial<br>opportunities</div>
                        <div class="desc">New energy electric vehicles, supported by national policies</div>
                    </li>
                    <li>
                        <div class="label_text">Strength<br>team</div>
                        <div class="desc">High education level = 60% (Master's degree) / 80% (graduated from elite universities of “985” and “211”) / 20% (overseas study experience)<br/>
                            Geographical diversity = members from all over the world<br/>
                            Diverse working background = members from major global well-known automobile enterprises or main engine plants</div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="page_con bg_gray con2">
            <div class="wrap">
                <div class="title_style2">Join Us</div>

                <ul class="join_list">
                    <li v-for="(item,index) in job" :key="index" :class="{active: index==job_index}">
                        <div class="toggle">
                            <div class="work">@{{ item.name }}</div>
                            <div class="btn_toggle"></div>
                        </div>
                        <div class="content" :style="{display: index==job_index?'block':'none'}">
                            <div class="label">Location:</div>
                            <ul class="list">
                                <li>@{{ item.address }}</li>
                            </ul>
                            <div class="label">Jobs:</div>
                            <ul class="list">
                                <li  v-html="item.targent"></li>
                            </ul>
                            <div class="label">Responsibilities:</div>
                            <ul class="list">
                                <li v-html="item.duty"></li>
                            </ul>
                            <div class="label">Qualifications:</div>
                            <ul class="list">
                                <li v-html="item.require"li>
                            </ul>
                            <div class="label">Other:</div>
                            <ul class="list">
                                <li>@{{ item.other }}</li>
                            </ul>
                            <div class="email">Send resume：<a v-bind:href="'mailto:'+item.email">@{{ item.email }}</a></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="page_con con3">
            <div class="wrap">
                <div class="title_style3"><span>STAFF TESTIMONIALS</span></div>

                <div class="staff_c">
                    <div class="swiper-container staff_swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" v-for="(item,index) in employe" :key="index">
                                <div class="avatar"><img v-bind:src="domain+item.img_url" width="75" height="75" alt="贾庆锡"></div>
                                <div class="info">
                                    <div class="name">@{{ item.name }}</div>
                                    <div class="talk" v-html="item.desc"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper_prev"></div>
                    <div class="swiper_next"></div>
                </div>
            </div>
        </div>
    </div>    <!-- /内容 -->
    @include('layouts.en.foot')
@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app',
            mounted(){
                this.getJob();
                this.getEmploy();
            },
            data(){
                return {
                    domain: '{{ Yii::$app->params['qiniu']['domain'] }}',
                    employe:{},
                    job:[],
                    job_index:0
                }
            },
            methods: {
                getJob(){
                    let _this = this;
                    Helper.asynRequest('GET', '/en/api/job-list', {}, function (response) {
                        _this.job = response.list;
                        //_this.employe = response.data;
                        _this.initDom();
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });
                },
                getEmploy(){
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
                initDom() {
                    setTimeout(function () {
                        $(document).ready(function(){
                            // 职位工作详情开关
                            var rect_toggle = $('.join_list>li>.toggle');
                            //console.log( rect_toggle.find('span').html() );
                            rect_toggle.click(function(){
                                var that = $(this).parent('li');
                                console.log( that );
                                if(that.hasClass('active')){
                                    that.find('.content').slideUp();
                                    that.removeClass('active');
                                }else{
                                    that.find('.content').slideDown();
                                    that.addClass('active');
                                }
                            });
                        });
                        // v-html样式问题
                        $('.join_list').find('p').css('background','none');
                    },500)

                    // 展开/关闭 招聘详情
                    // var join_list_toggle = $('.join_list>li .toggle');
                    // join_list_toggle.parent().eq(0).addClass('active').find('.content').show();
                    //
                    // join_list_toggle.on('click', function(){
                    //     var _parentDom = $(this).parent();
                    //
                    //     if(_parentDom.hasClass('active')){
                    //         _parentDom.removeClass('active').find('.content').slideUp();
                    //     }else{
                    //         _parentDom.addClass('active').find('.content').slideDown();
                    //     }
                    // });


                },
                initEmploy(){
                    // 员工感言
                    setTimeout(function () {
                        var staff_swiper = new Swiper('.staff_swiper', {
                            speed: 800,
                            spaceBetween: 30,
                            navigation: {
                                nextEl: '.staff_c .swiper_next',
                                prevEl: '.staff_c .swiper_prev',
                            },
                        });
                    },100);

                }
            }
        })
    </script>
@stop

@section('plugin-style')
    <style type="text/css">
        #app .warp .title_style2 .join_list ul.list >>> li p{
            background: none;!important;
            border: red 1px solid;
        }
    </style>
@stop

