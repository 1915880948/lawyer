@extends('layouts.wap')
@section('route','site/develop')
@section('content')
    <!-- 内容 -->
    <div class="container page_recruit">
        <div class="top_pic_c">
            <img src="{{yStatic('wap/img/top_pic5.jpg')}}" class="top_pic" />
            <img src="{{yStatic('wap/img/title8.png')}}" alt="HME HIRE THE ELITE  招聘人才" class="title"/>
        </div>

        <div class="page_con con1">
            <div class="wrap">
                <div class="title_style3"><span>加入华域麦格纳N个理由</span></div>

                <ul class="reason_list">
                    <li>
                        <div class="label_text">强大平台</div>
                        <div class="desc">股东方=中资零部件第一华域+世界零部件第三麦格纳</div>
                    </li>
                    <li>
                        <div class="label_text">产业先机</div>
                        <div class="desc">新能源电动汽车，国家政策重点支持</div>
                    </li>
                    <li>
                        <div class="label_text">实力团队</div>
                        <div class="desc">学历高=60%（硕士学历）/ 80%（985、211名校毕业）/ 20%（海外留学经历）<br/>
                            地域多样化=成员来自五湖四海<br/>
                            工作背景多样=成员来自各大全球知名汽车企业或主机厂</div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="page_con bg_gray con2">
            <div class="wrap">
                <div class="title_style2">招聘职位</div>

                <ul class="join_list">
                    <li v-for="(item,index) in job" :key="index" :class="{active: index==job_index}">
                        <div class="toggle">
                            <div class="work">@{{ item.name }}</div>
                            <div class="btn_toggle"></div>
                        </div>
                        <div class="content" :style="{display: index==job_index?'block':'none'}">
                            <div class="label">工作地点</div>
                            <ul class="list">
                                <li>@{{ item.address }}</li>
                            </ul>
                            <div class="label">岗位目标</div>
                            <ul class="list">
                                <li  v-html="item.targent"></li>
                            </ul>
                            <div class="label">任职资格</div>
                            <ul class="list">
                                <li v-html="item.duty"></li>
                            </ul>
                            <div class="label">任职资格</div>
                            <ul class="list">
                                <li v-html="item.require"></li>
                            </ul>
                            <div class="label">其他要求</div>
                            <ul class="list">
                                <li>@{{ item.other }}</li>
                            </ul>
                            <div class="email">请发送您的简历至：<a v-bind:href="'mailto:'+item.email">@{{ item.email }}</a></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="page_con con3">
            <div class="wrap">
                <div class="title_style3"><span>员工感言</span></div>

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
    @include('layouts.foot')
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
                    Helper.asynRequest('GET', '/api/job-list', {}, function (response) {
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
