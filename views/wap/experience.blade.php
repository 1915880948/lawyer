@extends('layouts.wap')
@section('route','site/develop')
@section('content')
    <!-- 内容 -->
    <div class="container page_experience">
        <div class="top_pic_c">
            <img src="{{yStatic('wap/img/top_pic4.jpg')}}" class="top_pic" />
            <img src="{{yStatic('wap/img/title5.png')}}" alt="HME OUR BRANDS  品牌体验" class="title"/>
        </div>

        <div class="page_con bg_blue con1">
            <div class="wrap">
                <div class="title_style5 white">
                    <span>@{{ data.brand_title }}</span>@{{ data.brand_title2 }}
                </div>

                <div class="intro_style1 white">
                    <p>@{{ data.brand_desc }}</p>
                </div>
            </div>
        </div>

        <div class="page_con con2">
            <div class="wrap">
                <div class="title_style5">
                    <span>@{{ data.strength_title }}</span>@{{ data.strength_title2 }}
                </div>
                <div class="intro_style1">
                    <p>@{{ data.strength_desc }}</p>
                </div>

                <ul class="project_list">
                    <li v-for="item in list">
                        <div class="info">
                            <div class="name"  v-html="filter(item.title)"></div>
                            <div class="desc"  v-html="filter(item.title2)"></div>
                        </div>
                        <div class="thumb"><img v-bind:src="domain+item.img_url" alt="高度集成化电驱动桥平台产品"></div>
                    </li>
                </ul>

                <div class="intro_style1">
                    <p>@{{ data.strength_desc2 }}</p>
                </div>
            </div>
        </div>

        <div class="page_con con3">
            <div class="wrap">
                <div class="title_style5">
                    <span>@{{ data.position_title }}</span>@{{ data.position_title2 }}
                </div>
                <div class="intro_style2">
                    <p>@{{ data.position_desc }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- /内容 -->
    @include('layouts.foot')
@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app',
            mounted(){
                this.getExper();
            },
            data(){
                return {
                    domain: '{{ Yii::$app->params['qiniu']['domain'] }}',
                    data:{},
                    list:[],
                }
            },
            methods: {
                getExper() {
                    let _this = this;
                    Helper.asynRequest('GET', '/api/exper', {}, function (response) {
                        _this.data = response.data;
                        _this.list = response.list;
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });
                },
                filter(str){
                    var arr = str.split('/');
                    var html = '';
                    for(let i=0; i<arr.length;i++){
                        html+=arr[i]+'<br/>';
                    }
                    return html.substr(0,html.length-5);
                }
            }
        })
    </script>
@stop

@section('plugin-style')
@stop
