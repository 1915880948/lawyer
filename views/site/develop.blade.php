@extends('layouts.main')
@section('route','site/cpjy')
@section('content')
    <div class="wrapper">
        <div class="banner_c">
            <img src="{{yStatic('img/banner5.jpg')}}" class="banner_pic" />
            <div class="banner_text">
                <img src="{{yStatic('img/banner_text5.png')}}" style="width: 15.46875%;"/>
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
{{--                <div class="title">期待来自五湖四海的你<br/>与企业共同成长</div>--}}
{{--                <!-- <p>把员工视为最宝贵的财富。因此，其人力资源政策密切着眼于尊重员工和他们在集团内的发展。</p> -->--}}
{{--                <ul class="devel_list1">--}}
{{--                    <li>--}}
{{--                        <p>技术</p>--}}
{{--                        <span>新能源  新潮流</span>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <p>开放</p>--}}
{{--                        <span>倾听不同的你</span>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <p>创新</p>--}}
{{--                        <span>鼓励勇于创新的你</span>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <p>阳光</p>--}}
{{--                        <span>快乐自由 积极向上</span>--}}
{{--                    </li>--}}
{{--                    <li></li>--}}
{{--                    <li>--}}
{{--                        <p>年轻</p>--}}
{{--                        <span>激情澎湃 慷慨激昂</span>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <p>包容</p>--}}
{{--                        <span>包容不同的你</span>--}}
{{--                    </li>--}}
{{--                    <li></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="devel_conn2 devel_comment">--}}
{{--            <div class="wrap">--}}
{{--                <div class="title">如何帮助您不断发展</div>--}}
{{--                <!-- <p>把员工视为最宝贵的财富。因此，其人力资源政策密切着眼于尊重员工和他们在集团内的发展。</p> -->--}}
{{--                <img src="{{yStatic('img/devel_pic1.png')}}" class="devel_pic"/>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="devel_conn3 devel_comment">--}}
{{--            <div class="wrap">--}}
{{--                <div class="title">职业发展通道</div>--}}
{{--                <!-- <p>把员工视为最宝贵的财富人力资源政于尊重员工和他们在集团内的发展</p> -->--}}
{{--                <img src="{{yStatic('img/devel_pic2.png')}}" class="devel_pic"/>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="devel_conn4 devel_comment">--}}
{{--            <div class="wrap">--}}
{{--                <div class="title">导师计划 “馒头计划” 流程</div>--}}
{{--                <!-- <p>把员工视为最宝贵的财富人力资源政于尊重员工和他们在集团内的发展。</p> -->--}}
{{--                <img src="{{yStatic('img/devel_pic3.png')}}" class="devel_pic"/>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="devel_conn5 devel_comment">--}}
{{--            <div class="wrap">--}}
{{--                <div class="title">相关数据</div>--}}
{{--                <!-- <p>把员工视为最宝贵的财富人力资源政于尊重员工和他们在集团内的发展。</p> -->--}}
{{--                <ul class="devel_datas">--}}
{{--                    <li>--}}
{{--                        <h1>70%</h1>--}}
{{--                        <p>On-the –job Experience<br/>在职经验<br/>Informal experiential on-the-job<br/>在职经验等非正式性学习</p>--}}
{{--                    </li>--}}
{{--                    <li style="width: 220px;">--}}
{{--                        <h1>20%</h1>--}}
{{--                        <p>Informal Learning<br/>非正式学习<br/>Social coaching mentoring<br/>社会指导 </p>--}}
{{--                    </li>--}}
{{--                    <li style="width: 220px;">--}}
{{--                        <h1>10%</h1>--}}
{{--                        <p>Formal Learning<br/>正式学习<br/>Training workshops<br/>培训研讨</p>--}}
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
                    Helper.asynRequest('GET', '/api/develop', {id:''}, function (response) {
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
