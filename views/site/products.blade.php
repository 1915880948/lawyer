@extends('layouts.main')
@section('content')
    <div class="wrapper">
        <div class="banner_c">
            <img src="{{yStatic('img/banner4.jpg')}}" class="banner_pic" />
            <div class="banner_text">
                <img src="{{yStatic('img/banner_text4.png')}}" style="width: 14.53125%;"/>
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
                <div class="title"><span>以全球趋势为导向</span>受驱动力驱动</div>
                <p>全球汽车趋势作为我们的路标，我们在通往动力传动系电气化的道路上已经达到了许多里程碑。我们积极寻求这些趋势，并用创新的ETeligigTrand解决方案来解决这些问题。通过不断面对未来的挑战，我们努力成为第一个在路上，第一个跨越终点线的eMobility比赛。凭借我们的系统能力，我们理解未来传动系的复杂性，并提供广泛的产品以满足客户的要求。</p>
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
                    Helper.asynRequest('GET', '/api/product-list', {}, function (response) {
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
