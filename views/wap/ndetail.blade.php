@extends('layouts.wap')
@section('route','site/ndetail')
@section('content')
    <!-- 内容 -->
    <div class="container page_Detail">
        <div class="nd_wrap">
            <div class="title">@{{ news.title }}</div>
            <div class="date">@{{ news.time }}</div>

            <div class="intro"  v-html="news.content">
            </div>
        </div>
    </div>    <!-- /内容 -->
    @include('layouts.foot')
@stop

@section('foot-script')
    <script>
        var id = "{{Yii::$app->request->get('id')}}";
        new Vue({
            el: '#app',
            mounted(){
                this.getNews();
            },
            data(){
                return {
                    news:{}
                }
            },
            methods: {
                getNews(){
                    let _this = this;
                    Helper.asynRequest('GET', '/api/ndetail', {id:id}, function (response) {
                        _this.news = response.data;
                        _this.initDom();
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });
                },
                initDom() {
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
