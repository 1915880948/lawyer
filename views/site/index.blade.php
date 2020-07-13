@extends('layouts.main')

@section('content')


    <div class="swiper-container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide"><img src="{{yStatic('img/swiper-1.jpg')}}" /></div>
            <div class="swiper-slide"><img src="{{yStatic('img/swiper-2.jpg')}}" /></div>
            <div class="swiper-slide"><img src="{{yStatic('img/swiper-3.jpg')}}" /></div>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>


    <div class="weui-grids">
        <a href="buttons.html" class="weui-grid js_grid">
            <div class="weui-grid__icon">
                <img width="60" src="{{yStatic('img/icon_nav_button.png')}}" alt="">
            </div>
            <p class="weui-grid__label">
                Button
            </p>
        </a>
        <a href="cell.html" class="weui-grid js_grid">
            <div class="weui-grid__icon">
                <img src="{{yStatic('img/icon_nav_cell.png')}}" alt="">
            </div>
            <p class="weui-grid__label">
                List
            </p>
        </a>
        <a href="javascript:;" class="weui-grid js_grid" v-on:click="confirmMsg">
            <div class="weui-grid__icon">
                <img width="60" src="{{yStatic('img/icon_nav_dialog.png')}}" alt="">
            </div>
            <p class="weui-grid__label">
                Dialog
            </p>
        </a>
        <a href="cell.html" class="weui-grid js_grid">
            <div class="weui-grid__icon">
                <img src="{{yStatic('img/icon_nav_article.png')}}" alt="">
            </div>
            <p class="weui-grid__label">
                Article
            </p>
        </a>
    </div>






{{--<a href="javascript:;" class="weui-btn weui-btn_primary">按钮</a>--}}
{{--<a href="javascript:;" class="weui-btn weui-btn_disabled weui-btn_primary">按钮</a>--}}
{{--<a href="javascript:;" class="weui-btn weui-btn_warn">确认</a>--}}
{{--<a href="javascript:;" class="weui-btn weui-btn_disabled weui-btn_warn">确认</a>--}}
{{--<a href="javascript:;" class="weui-btn weui-btn_default">按钮</a>--}}
{{--<a href="javascript:;" class="weui-btn weui-btn_disabled weui-btn_default">按钮</a>--}}
{{--<a href="javascript:;" class="weui-btn weui-btn_plain-default">按钮</a>--}}
{{--<a href="javascript:;" class="weui-btn weui-btn_plain-primary">按钮</a>--}}

@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app',
            mounted:function(){
                this.init();
            },
            data:function() {
                return {

                }
            },
            methods:{
                init:function () {
                    $(".swiper-container").swiper({
                        loop: true,
                        autoplay: 3000
                    });

                },
                confirmMsg:function(){
                    let _this = this;
                    $.confirm("自定义的消息内容", function() {
                        $.alert("自定义的消息内容", "自定义的标题");
                    }, function() {
                        _this.confirmMsg();
                    });
                }

            }
        })
    </script>
@stop

@section('plugin-style')
    <style type= "text/css">
        .swiper-container {
            width: 100%;
        }
        .swiper-container img {
            display: block;
            width: 100%;
        }
    </style>
@stop
