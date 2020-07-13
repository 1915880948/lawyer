@extends('layouts.wap')
@section('route','site/develop')
@section('content')
    <!-- 内容 -->
    <div class="container page_develop">
        <div class="top_pic_c">
            <img src="{{yStatic('wap/img/top_pic2.jpg')}}" class="top_pic" />
            <img src="{{yStatic('wap/img/title7.png')}}" alt="HME HIRE THE ELITE 职业发展" class="title"/>
        </div>

        <div class="page_con con1">
            <div class="wrap">
                <div class="title_style3"><span>期待来自五湖四海的你<br/>与企业共同成长</span></div>

                <!-- <div class="intro_style4">把员工视为最宝贵的财富。因此，其人力资源政策密切着眼于尊重员工和他们在集团内的发展。</div> -->

                <ul class="develop_list">
                    <li>
                        <div class="label_text">技术</div>
                        <div class="desc">新能源 新潮流</div>
                    </li>
                    <li>
                        <div class="label_text">开放</div>
                        <div class="desc">倾听不同的你</div>
                    </li>
                    <li>
                        <div class="label_text">创新</div>
                        <div class="desc">鼓励用于创新的你</div>
                    </li>
                    <li>
                        <div class="label_text">阳光</div>
                        <div class="desc">快乐自由 积极向上</div>
                    </li>
                    <li>
                        <div class="label_text">年轻</div>
                        <div class="desc">激情澎湃 慷慨激昂</div>
                    </li>
                    <li>
                        <div class="label_text">包容</div>
                        <div class="desc">包容不同的你</div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="page_con bg_gray con2">
            <div class="wrap">
                <div class="title_style3"><span>如何帮助您不断发展</span></div>
                <!-- <div class="intro_style4">把员工视为最宝贵的财富。因此，其人力资源政策密切着眼于尊重员工和他们在集团内的发展。</div> -->

                <img src="{{yStatic('wap/img/devel_pic1.png')}}" alt="" class="develop_pic"/>
            </div>
        </div>

        <div class="page_con con3">
            <div class="wrap">
                <div class="title_style3"><span>职业发展通道</span></div>
                <!-- <div class="intro_style4">把员工视为最宝贵的财富人力资源政于尊重员工和他们在集团内的发展。</div> -->

                <img src="{{yStatic('wap/img/devel_pic2.png')}}" alt="" class="develop_pic"/>
            </div>
        </div>

        <div class="page_con bg_gray con4">
            <div class="wrap">
                <div class="title_style3"><span>导师计划 “馒头计划” 流程</span></div>
                <!-- <div class="intro_style4">把员工视为最宝贵的财富人力资源政于尊重员工和他们在集团内的发展。</div> -->

                <img src="{{yStatic('wap/img/devel_pic3.png')}}" alt="" class="develop_pic"/>
            </div>
        </div>

        <div class="page_con con5">
            <div class="wrap">
                <div class="title_style3"><span>相关数据</span></div>
                <!-- <div class="intro_style4">把员工视为最宝贵的财富人力资源政于尊重员工和他们在集团内的发展。</div> -->

                <ul class="datas_list">
                    <li>
                        <div class="rate">70%</div>
                        <p>On-the –job Experience<br/>
                            在职经验<br/>
                            Informal experiential on-the-job<br/>
                            在职经验等非正式性学习
                        </p>
                    </li>
                    <li>
                        <div class="rate">20%</div>
                        <p>Informal Learning<br/>
                            非正式学习<br/>
                            Social coaching mentoring<br/>
                            社会指导
                        </p>
                    </li>
                    <li>
                        <div class="rate">10%</div>
                        <p>Formal Learning<br/>
                            正式学习<br/>
                            Training workshops<br/>
                            培训研讨
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /内容 -->
    @include('layouts.foot')
@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app',
            mounted(){

            },
            data(){
                return {

                }
            },
            methods: {
                logout() {
                    location.href = '/user/login'
                }
            }
        })
    </script>
@stop

@section('plugin-style')
@stop
