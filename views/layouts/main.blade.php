<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="{{yStatic('img/logo_icon.png')}}"  />
    <link rel="shortcut" href="favicon.ico" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    {!! yCsrfTag() !!}
{{--    <link rel="stylesheet" href="{{yStatic('node_modules/weui/dist/style/weui.min.css')}}"/>--}}
    <link rel="stylesheet" href="{{yStatic('css/weui.min.css')}}"/>
    <link rel="stylesheet" href="{{yStatic('css/jquery-weui.min.css')}}"/>
    <script src="{{ yStatic('js/helper.js') }}"></script>
    @yield('plugin-style')
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
    <title>法律网</title>
</head>
<body>
<!-- 导航 -->

<!-- 导航 -->
<div id="app">
    @yield('content')
</div>
<!-- 底部 -->
@include('layouts.foot')
{{--<div class="weui-footer weui-footer_fixed-bottom">--}}
{{--    <div class="weui-tab">--}}
{{--        <div class="weui-tabbar">--}}
{{--            <a href="javascript:;" class="weui-tabbar__item weui-bar__item--on">--}}
{{--                <span class="weui-badge" style="position: absolute;top: -.4em;right: 1em;">8</span>--}}
{{--                <div class="weui-tabbar__icon">--}}
{{--                    <img src="{{yStatic('img/icon_nav_button.png')}}" alt="">--}}
{{--                </div>--}}
{{--                <p class="weui-tabbar__label">微信</p>--}}
{{--            </a>--}}
{{--            <a href="javascript:;" class="weui-tabbar__item">--}}
{{--                <div class="weui-tabbar__icon">--}}
{{--                    <img src="{{yStatic('img/icon_nav_msg.png')}}" alt="">--}}
{{--                </div>--}}
{{--                <p class="weui-tabbar__label">通讯录</p>--}}
{{--            </a>--}}
{{--            <a href="javascript:;" class="weui-tabbar__item">--}}
{{--                <div class="weui-tabbar__icon">--}}
{{--                    <img src="{{yStatic('img/icon_nav_article.png')}}" alt="">--}}
{{--                </div>--}}
{{--                <p class="weui-tabbar__label">发现</p>--}}
{{--            </a>--}}
{{--            <a href="javascript:;" class="weui-tabbar__item">--}}
{{--                <div class="weui-tabbar__icon">--}}
{{--                    <img src="{{yStatic('img/icon_nav_cell.png')}}" alt="">--}}
{{--                </div>--}}
{{--                <p class="weui-tabbar__label">我</p>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- 底部 -->
<script src="{{ yStatic('js/jquery-2.1.4.js') }}"></script>
<script src="{{ yStatic('js/jquery-weui.min.js') }}"></script>
<script src="{{ yStatic('js/swiper.min.js') }}"></script>
<script src="{{ yStatic('js/city-picker.min.js') }}"></script>
<script src="{{ yStatic('node_modules/vue/dist/vue.min.js') }}"></script>
@yield('foot-script')
<script>
    var route  = "/@yield('route',Yii::$app->request->pathInfo)";
    $(function(){
        $('a[href="'+route+'"]').parents('span').parent('li').addClass('active');
        $('li[data-url="'+route+'"]').addClass('active');
    });
</script>
</body>
</html>
