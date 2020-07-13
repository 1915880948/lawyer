@extends('layouts.en.main')
@section('content')
    <div class="wrapper">
        <div class="banner_c">
            <img src="{{yStatic('en/img/banner4.jpg')}}" class="banner_pic" />
            <div class="banner_text">
                <img src="{{yStatic('en/img/banner_text4.png')}}" style="width: 28.53125%;"/>
            </div>
        </div>

        <div class="pro_conn1">
            <div class="wrap">
                <ul class="pro_lista">
                    <li v-for="item in list" v-if="item.is_top ==1 ">
                        <a>
                            <img v-bind:src="domain+item.img_url" />
                            <h1>@{{ item.title }}</h1>
                            <p>@{{ item.desc }}</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pro_conn2">
            <div class="wrap">
                <div class="title"><span>Global trend oriented</span>Driven by driving power</div>
                <p>Global automotive trends are our road signs and we have reached many milestones on the road to power train electrification. We actively seek these trends and use innovative ETeligigTrand solutions to solve these problems. By constantly facing the challenges of the future, we strive to be the first on the road, the first eMobility race across the finish line. With our system capabilities, we understand the complexity of future drivelines and offer a wide range of products to meet customer requirements.</p>
            </div>
        </div>

        <div class="pro_conn3">
            <div class="wrap">
                <ul class="pro_listb">
                    <li v-for="item in list" v-if="item.is_top==0"><a>
                            <img v-bind:src="domain+item.img_url" />
                            <h1>@{{ item.title }}</h1>
                            <p>@{{ item.desc }}</p>
                        </a></li>
                </ul>
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
                this.getList();
            },
	    // vue 在IE里不支持简写
            data:function(){
                return {
                    domain: '{{ Yii::$app->params['qiniu']['domain'] }}',
                    list:[],
                }
            },
            methods: {
		// vue 在IE里不支持简写
                getList:function() {
                    let _this =this;
                    Helper.asynRequest('GET', '/en/api/product-list', {}, function (response) {
                        _this.list = response.list;
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });
                }
            }
        })
    </script>
@stop

@section('plugin-style')
@stop
