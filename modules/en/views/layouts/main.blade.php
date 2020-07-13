<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="{{yStatic('img/logo_icon.png')}}" media="screen" />
    {{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    {!! yCsrfTag() !!}
    <link rel="stylesheet" type="text/css" href="{{yStatic('css/idangerous.swiper.css')}}">
    <link rel="stylesheet" type="text/css" href="{{yStatic('css/common.css')}}">
    <script type="text/javascript" src="{{yStatic('js/jquery-1.11.1.min.js')}}"></script>
    <script type="text/javascript" src="{{yStatic('js/idangerous.swiper.min.js')}}"></script>
    <script type="text/javascript" src="{{yStatic('js/common.js')}}"></script>
    <script src="{{ yStatic('js/helper.js') }}"></script>
    @yield('plugin-style')
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
    <title>HASCO MAGNA</title>
</head>
<body>
<!-- 导航 -->
<div class="nav_c">
    <div class="left"><a href="{{yUrl('/en/site/index')}}"><img src="{{yStatic('img/logo.png')}}" class="logo"/></a></div>
    <div class="middle">
{{--        <ul class="nav_list">--}}
{{--            <li>--}}
{{--                <span><a href="{{yUrl('/en/site/abstract')}}">ABOUT</a></span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <span><a href="{{yUrl('/en/site/news')}}">NEWS</a></span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <span><a href="{{yUrl('/en/site/experience')}}">BRANDS</a></span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <span><a href="{{yUrl('/en/site/products')}}">PRODUCTS</a></span>--}}
{{--            </li>--}}
{{--            <li data-url="{{yUrl('/en/site/cpjy')}}">--}}
{{--                <span>JION US</span>--}}
{{--                <div class="subNav_c">--}}
{{--                    <ul class="subNav_list sub6">--}}
{{--                        <li><a href="{{yUrl('/en/site/develop')}}">FUTURE</a></li>--}}
{{--                        <li><a href="{{yUrl('/en/site/recruit')}}">JOBS</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </li><!----}}
{{--            <li>--}}
{{--                <span><a href="###">社会责任</a></span>--}}
{{--            </li> -->--}}
{{--        </ul>--}}
    </div>
    <div class="right">
        <ul class="link_c">

            <li>
                <a href="{{yUrl('/en')}}">EN</a> /
                <a href="{{yUrl('/')}}">中文</a>
            </li>
            <li>
                <a href=""><img src="{{yStatic('img/link1_b.png')}}" /></a>
                <div class="link_qr"><img src="{{yStatic('img/qr_code.jpg')}}" /></div>
            </li><!--
            <li><a href=""><img src="{{yStatic('img/link2_b.png')}}" /></a></li>
            <li><a href=""><img src="{{yStatic('img/link3_b.png')}}" /></a></li> -->
        </ul>
    </div>
</div>
<!-- 导航 -->
<div id="app">
    @yield('content')
</div>    <!-- 底部 -->
<div class="footer">
    <div class="wrap">
        <a href="{{yUrl('/en/site/index')}}" class="logo"><img src="{{yStatic('img/logo.png')}}" /></a>
        <div class="footer_info">
            <p>HASCO MAGNA ELECTRIC DRIVE SYSTEM CO., LTD</p>

            <ul class="info_list">
                <li>Address: No. 881, Jinshi Road, Baoshan District, Shanghai</li>
                <li>Telephone: 021-26099000</li>
                <li><div style="margin:0 auto; padding-top:20px 0;"><a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=31011302006031" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;"><img src="{{yStatic('img/icp.png')}}" style="float:left; width:20px;"/><p style="margin: 0px 0px 0px 25px; color:#939393;">沪公网安备 31011302006031号</p></a><a target="_blank" href="http://beian.miit.gov.cn" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;margin: 0px 0px 0px 25px;">沪ICP备18040547号-1</a> </div>
                </li>
            </ul>
            <p class="p_vision">&copy; 2018 Hasco Magna Electric Drive. All Rights Reserved</p>
        </div>
    </div>
</div>
<!-- 底部 -->

<script src="{{ yStatic('node_modules/vue/dist/vue.min.js') }}"></script>
@yield('foot-script')
<script>
    var route  = ""+"/@yield('route',Yii::$app->request->pathInfo)";
    $(function(){
        $('a[href="'+route+'"]').parents('span').parent('li').addClass('active');
        $('li[data-url="'+route+'"]').addClass('active');
    });
</script>
</body>
</html>
