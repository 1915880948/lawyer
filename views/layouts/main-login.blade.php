<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! yCsrfTag() !!}
    <link rel="stylesheet" href="{{ yStatic('node_modules/vue-ydui/dist/ydui.rem.css') }}">
    <link rel="stylesheet" href="{{ yStatic('css/site.css') }}">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_1086760_mthfi1ual2.css">
    @yield('plugin-style')
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
    @yield('plugin-script')
    <script src="{{ yStatic('js/loading.js') }}"></script>
    <title>华域麦格纳</title>
</head>
<body>
<div id="app">
    @yield('content')
</div>

<script src="{{ yStatic('node_modules/vue/dist/vue.min.js') }}"></script>

<script>
</script>
@yield('foot-script')
</body>
</html>