@extends('layouts.en.main')
@section('content')
    <div class="wrapper">
        <div class="banner_c">
            <img src="{{yStatic('en/img/banner3.jpg')}}" class="banner_pic" />
            <div class="banner_text">
                <img src="{{yStatic('en/img/banner_text3.png')}}" style="width: 26.385%;"/>
            </div>
        </div>

        <!-- HME品牌 新能源汽车电驱动系统 -->
        <div class="exp_conn1">
            <div class="wrap">
                <div class="left">
                <div class="title">
                    <h1>@{{ data.brand_title }}</h1>
                    <h2>@{{ data.brand_title2 }}</h2>
                </div>
                <div class="content">@{{ data.brand_desc }}</div>
            </div>
            
                <div class="right"><img v-bind:src="domain+data.brand_url" class="sys_pic"/></div>
            </div>
        </div>

        <div class="exp_conn2">
            <div class="wrap">
                <div class="title"><span>@{{ data.strength_title }}</span>@{{ data.strength_title2 }}</div>
                <p>@{{ data.strength_desc }}</p>
                <ul class="list">
                    <li v-for="item in list">
                        <div class="top">
                            <h1 v-html="filter(item.title)"></h1>
                            <p v-html="filter(item.title2)"></p>
                        </div>
                        <div class="bottom">
                            <img v-bind:src="domain+item.img_url" />
                        </div>
                    </li>
                </ul>
                <p>@{{ data.strength_desc2 }}</p>
                <div class="exp_center">
                    <!-- <img src="img/exper_pic3.jpg" class="pic1"/> -->
                    <!-- <img src="img/exper_pic4.jpg" class="pic2"/> -->
                    <p class="text"><span>@{{ data.position_title }}</span>@{{ data.position_title2 }}</p>
                </div>
                <p>@{{ data.position_desc }}</p>
            </div>
        </div>
    </div>
@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app',
	    // vue 在IE里不支持简写
            mounted:function(){
                this.getExper();
            },
	    // vue 在IE里不支持简写
            data:function(){
                return {
                    domain: '{{ Yii::$app->params['qiniu']['domain'] }}',
                    data:{},
                    list:[],
                }
            },
            methods: {
		// vue 在IE里不支持简写
                getExper:function() {
                    let _this = this;
                    Helper.asynRequest('GET', '/en/api/exper', {}, function (response) {
                        _this.data = response.data;
                        _this.list = response.list;
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });
                },
		// vue 在IE里不支持简写
                filter:function(str){
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
