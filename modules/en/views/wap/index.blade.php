@extends('layouts.en.wap')
@section('route','/en/site/index')
@section('content')
    <!-- 内容 -->
    <div class="container page_index">
        <div class="index_con">
            <img src="{{yStatic('en/wap/img/title1.png')}}" alt="UNLOCKING FUTURE MOBILITY  开启未来的机动性" class="title"/>

            <a href="/en/site/abstract" class="btn_lookus">Explore us</a>
        </div>
    </div>
    <!-- /内容 -->
@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app',
            mounted:function(){

            },
            data:function(){
                return {

                }
            },
            methods: {
                logout:function() {
                    location.href = '/user/login'
                }
            }
        })
    </script>
@stop

@section('plugin-style')
@stop
