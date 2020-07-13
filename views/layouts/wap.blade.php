<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" type="image/x-icon" href="{{yStatic('img/logo_icon.png')}}" media="screen" />
    {!! yCsrfTag() !!}
    <title>HASCO MAGNA</title>
    <script type="text/javascript" src="{{yStatic('wap/js/flexible.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{yStatic('wap/css/swiper-4.2.6.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{yStatic('wap/css/common.css')}}">

    <script type="text/javascript" src="{{yStatic('wap/js/jquery-1.11.1.min.js')}}"></script>
    <script type="text/javascript" src="{{yStatic('wap/js/swiper-4.2.6.min.js')}}"></script>
    <script type="text/javascript" src="{{yStatic('wap/js/common.js')}}"></script>
    <script src="{{ yStatic('js/helper.js') }}"></script>
    @yield('plugin-style')
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
</head>
<body>

<!-- 头部 -->
<div class="header_c">
    <div class="header_w">
        <a class="logo" href="/site/index" title="HASCO MAGNA"><img src="{{yStatic('img/logo.png')}}" alt="HASCO MAGNA" /></a>

			<div class="language_box">
				<div class="language_inner">
					<a href="{{yUrl(['/en/site/index'])}}">EN</a>/
					<a href="{{yUrl('/')}}">中文</a>
				</div>
			</div>
        <div class="menu_toggle"></div>
    </div>
</div>
<!-- 菜单弹窗 -->
<div class="menu_toast">
    <div class="swiper-container menu_scroll">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <ul class="nav_list">
                    <li>
                        <a href="/site/abstract"><div class="title">关于我们</div></a>
                    </li>
                    <li>
                        <a href="/site/news"><div class="title">新闻与故事</div></a>
                    </li>
                    <li>
                        <a href="/site/experience"><div class="title">品牌体验</div></a>
                    </li>
                    <li>
                        <a href="/site/products"><div class="title">智能科技</div></a>
                    </li>
                    <li>
                        <div class="title">诚聘精英</div>
                        <ul class="list">
                            <li><a href="/site/develop">职业发展</a></li>
                            <li><a href="/site/recruit">招聘人才</a></li>
                        </ul>
                    </li><!-- 
                    <li>
                        <a href="/site/abstract"><div class="title">社会责任</div></a>
                    </li> -->
                </ul>
                <img src="{{yStatic('wap/img/qrcode.jpg')}}" alt="二维码" class="qrcode"/>
            </div>
        </div>
    </div>
</div>
<!-- /菜单弹窗 -->
<!-- /头部 -->
<div id="app">
    @yield('content')
</div>

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
