@extends('layouts.en.main')

@section('content')
    <div class="wrapper">
        <div class="i_banner">
            <div class="i_banner_wrap">
                <img src="{{yStatic('en/img/i_banner_text.png')}}" />
                <a href="/en//site/abstract" class="btn_look">Explore us</a>
            </div>
        </div>
    </div>
@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app',
            mounted(){

            },
            data() {
                return {

                }
            },
            methods:{

            }
        })
    </script>
@stop

@section('plugin-style')
    <style>
    </style>
@stop
