<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! yCsrfTag() !!}
    <link rel="stylesheet" href="{{ yStatic('node_modules/element-ui/lib/theme-chalk/index.css') }}">
    <link rel="stylesheet" href="{{ yStatic('css/site.css') }}">
    @yield('plugin-style')
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
    <title>华域麦格纳后台管理系统</title>
</head>
<body>
<div id="app">
    @yield('content')
</div>
<script type="text/javascript" src="{{yStatic('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{ yStatic('js/helper.js') }}"></script>
<script src="{{ yStatic('node_modules/vue/dist/vue.min.js') }}"></script>
<script src="{{ yStatic('node_modules/element-ui/lib/index.js') }}"></script>
{{--<script src="{{ yStatic('node_modules/axios/dist/axios.min.js') }}"></script>--}}
@yield('foot-script')
</body>
</html>