@extends('layouts.en.wap')
@section('route','en/site/develop')
@section('content')
    <!-- 内容 -->
    <div class="container page_develop">
        <div class="top_pic_c">
            <img src="{{yStatic('en/wap/img/top_pic2.jpg')}}" class="top_pic" />
            <img src="{{yStatic('en/wap/img/title7.png')}}" alt="HME HIRE THE ELITE 职业发展" class="title"/>
        </div>

        <div class="page_con con1">
            <div class="wrap">
                <div class="title_style3"><span>Looking forward to you from all over the world<br/>Grow together with the company</span></div>

                <!-- <div class="intro_style4">把员工视为最宝贵的财富。因此，其人力资源政策密切着眼于尊重员工和他们在集团内的发展。</div> -->

                <ul class="develop_list">
                    <li>
                        <div class="label_text">Technology</div>
                        <div class="desc">New energy and<br>new trend</div>
                    </li>
                    <li>
                        <div class="label_text">Open</div>
                        <div class="desc">Listen to <br>different you</div>
                    </li>
                    <li>
                        <div class="label_text">Innovation</div>
                        <div class="desc">Encourage <br>innovative you</div>
                    </li>
                    <li>
                        <div class="label_text">Sunshine</div>
                        <div class="desc">Happy, free and <br>positive</div>
                    </li>
                    <li>
                        <div class="label_text">Young</div>
                        <div class="desc">Passionate and <br>impassioned</div>
                    </li>
                    <li>
                        <div class="label_text">Tolerance</div>
                        <div class="desc">Tolerate <br>different you</div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="page_con bg_gray con2">
            <div class="wrap">
                <div class="title_style3"><span>How to help you develop</span></div>
                <!-- <div class="intro_style4">把员工视为最宝贵的财富。因此，其人力资源政策密切着眼于尊重员工和他们在集团内的发展。</div> -->

                <img src="{{yStatic('en/wap/img/devel_pic1.png')}}" alt="" class="develop_pic"/>
            </div>
        </div>

        <div class="page_con con3">
            <div class="wrap">
                <div class="title_style3"><span>Career plan</span></div>
                <!-- <div class="intro_style4">把员工视为最宝贵的财富人力资源政于尊重员工和他们在集团内的发展。</div> -->

                <img src="{{yStatic('en/wap/img/devel_pic2.png')}}" alt="" class="develop_pic"/>
            </div>
        </div>

        <div class="page_con bg_gray con4">
            <div class="wrap">
                <div class="title_style3"><span>Process of tutor plan "steamed bread plan"</span></div>
                <!-- <div class="intro_style4">把员工视为最宝贵的财富人力资源政于尊重员工和他们在集团内的发展。</div> -->

                <img src="{{yStatic('en/wap/img/devel_pic3.png')}}" alt="" class="develop_pic"/>
            </div>
        </div>

        <div class="page_con con5">
            <div class="wrap">
                <div class="title_style3"><span>Related data</span></div>
                <!-- <div class="intro_style4">把员工视为最宝贵的财富人力资源政于尊重员工和他们在集团内的发展。</div> -->

                <ul class="datas_list">
                    <li>
                        <div class="rate">70%</div>
                        <p>On-the –job Experience<br/>
                            Informal experiential on-the-job
                        </p>
                    </li>
                    <li>
                        <div class="rate">20%</div>
                        <p>Informal Learning<br/>
                            Social coaching mentoring
                        </p>
                    </li>
                    <li>
                        <div class="rate">10%</div>
                        <p>Formal Learning<br/>
                            Training workshops
                        </p>
                    </li>
                </ul>
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
