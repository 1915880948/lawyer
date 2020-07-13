@extends('layouts.encms.main')

@section('title')@stop

@section('content')
    <div id="content">
        <div id="welcome">登录用户：{{ Yii::$app->controller->module->user->identity->username }}</div>
    </div>
@stop

@section('plugin-style')
@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app'
        })
    </script>
@stop
