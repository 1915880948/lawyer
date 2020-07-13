@extends('layouts.wap')
@section('route','site/index')
@section('content')
    <!-- 内容 -->
    <div class="container page_index">
        <div class="index_con">
            <img src="{{yStatic('wap/img/title1.png')}}" alt="UNLOCKING FUTURE MOBILITY  开启未来的机动性" class="title"/>

            <a href="/site/abstract" class="btn_lookus">探索我们</a>
        </div>
    </div>
    <!-- /内容 -->
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
