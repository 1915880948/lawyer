@extends('layouts.en.main')
@section('route','site/news')
@section('content')
    <div class="wrapper">
        <div class="detail_c">
            <div class="detail_w">
                <div class="time">@{{ news.time }}</div>
                <h1>@{{ news.title }}</h1>
                <div class="intro" v-html="news.content">
                </div>
            </div>
        </div>
    </div>
@stop

@section('foot-script')
    <script>
        var id = "{{Yii::$app->request->get('id')}}";
        new Vue({
            el: '#app',
	    // vue 在IE里不支持简写
            mounted:function(){
                this.getNews();
            },
	    // vue 在IE里不支持简写
            data:function(){
                return {
                    news:{}
                }
            },
            methods: {
		// vue 在IE里不支持简写
                getNews:function(){
                  let _this = this;
                    Helper.asynRequest('GET', '/en/api/ndetail', {id:id}, function (response) {
                        _this.news = response.data;
                        _this.initDom();
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });
                },
		// vue 在IE里不支持简写
                initDom:function() {
                    var video = $('.detail_w>video');
                    var videoPlay = $('.detail_w .toast .video_play');
                    videoPlay.click(function(){
                        $(this).parent().fadeOut();
                        video.attr('controls', true).trigger('play');
                    });
                }
            }
        })
    </script>
@stop

@section('plugin-style')
@stop
