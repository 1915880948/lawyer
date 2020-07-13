@extends('layouts.en.main')
@section('route','site/cpjy')
@section('content')
    <div class="wrapper">
        <div class="banner_c">
            <img src="{{yStatic('en/img/banner5.jpg')}}" class="banner_pic" />
            <div class="banner_text">
                <img src="{{yStatic('en/img/banner_text5.png')}}" style="width: 50.46875%;"/>
            </div>
        </div>

        <div class="devel_conn1 devel_comment">
            <div class="wrap">
                <div class="">
                    <div v-html="data.content"></div>
                </div>

            </div>
        </div>

        {{--        <div class="devel_conn1 devel_comment">--}}
{{--            <div class="wrap">--}}
{{--                <div class="title">Looking forward to you from all over the world<br/>Grow together with the company</div>--}}
{{--                <!-- <p>把员工视为最宝贵的财富。因此，其人力资源政策密切着眼于尊重员工和他们在集团内的发展。</p> -->--}}
{{--                <ul class="devel_list1">--}}
{{--                    <li>--}}
{{--                        <p>Technology</p>--}}
{{--                        <span>New energy and new trend</span>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <p>Open</p>--}}
{{--                        <span>Listen to different you</span>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <p>Innovation</p>--}}
{{--                        <span>Encourage innovative you</span>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <p>Sunshine</p>--}}
{{--                        <span>Happy, free and positive</span>--}}
{{--                    </li>--}}
{{--                    <li></li>--}}
{{--                    <li>--}}
{{--                        <p>Young</p>--}}
{{--                        <span>Passionate and impassioned</span>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <p>Tolerance</p>--}}
{{--                        <span>Tolerate different you</span>--}}
{{--                    </li>--}}
{{--                    <li></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="devel_conn2 devel_comment">--}}
{{--            <div class="wrap">--}}
{{--                <div class="title">How to help you develop</div>--}}
{{--                <!-- <p>把员工视为最宝贵的财富。因此，其人力资源政策密切着眼于尊重员工和他们在集团内的发展。</p> -->--}}
{{--                <img src="{{yStatic('img/devel_pic1.png')}}" class="devel_pic"/>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="devel_conn3 devel_comment">--}}
{{--            <div class="wrap">--}}
{{--                <div class="title">Career plan</div>--}}
{{--                <!-- <p>把员工视为最宝贵的财富人力资源政于尊重员工和他们在集团内的发展</p> -->--}}
{{--                <img src="{{yStatic('img/devel_pic2.png')}}" class="devel_pic"/>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="devel_conn4 devel_comment">--}}
{{--            <div class="wrap">--}}
{{--                <div class="title">Process of tutor plan "steamed bread plan"</div>--}}
{{--                <!-- <p>把员工视为最宝贵的财富人力资源政于尊重员工和他们在集团内的发展。</p> -->--}}
{{--                <img src="{{yStatic('img/devel_pic3.png')}}" class="devel_pic"/>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="devel_conn5 devel_comment">--}}
{{--            <div class="wrap">--}}
{{--                <div class="title">Related data</div>--}}
{{--                <!-- <p>把员工视为最宝贵的财富人力资源政于尊重员工和他们在集团内的发展。</p> -->--}}
{{--                <ul class="devel_datas">--}}
{{--                    <li>--}}
{{--                        <h1>70%</h1>--}}
{{--                        <p>On-the –job Experience<br/>Informal experiential on-the-job</p>--}}
{{--                    </li>--}}
{{--                    <li style="width: 220px;">--}}
{{--                        <h1>20%</h1>--}}
{{--                        <p>Informal Learning<br/>Social coaching mentoring</p>--}}
{{--                    </li>--}}
{{--                    <li style="width: 220px;">--}}
{{--                        <h1>10%</h1>--}}
{{--                        <p>Formal Learning<br/>Training workshops</p>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app',
            mounted:function(){
                this.detail();
            },
            data:function(){
                return {
                    data:[],
                }
            },
            methods: {
                detail:function() {
                    let _this = this;
                    Helper.asynRequest('GET', '/en/api/develop', {id:''}, function (response) {
                        _this.data = response.data;
                        //_this.initDom();
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });
                }
            }
        })
    </script>
@stop

@section('plugin-style')
@stop
