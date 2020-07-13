@extends('layouts.en.wap')
@section('route','en/site/products')
@section('content')
    <!-- 内容 -->
    <div class="container page_products">
        <div class="top_pic_c">
            <img src="{{yStatic('en/wap/img/top_pic3.jpg')}}" class="top_pic" />
            <img src="{{yStatic('en/wap/img/title6.png')}}" alt="MADE BY HME PRODUCTS  智能科技" class="title"/>
        </div>

        <div class="page_con con1">
            <div class="wrap">
                <ul class="products_list">
                    <li v-for="item in list" v-if="item.is_top ==1 ">
                        <div class="thumb">
                            <img v-bind:src="domain+item.img_url" alt="EDS 80A (EDS LOW CE) 78kW">
                        </div>
                        <div class="info">
                            <div class="name"><span>@{{ item.title }}</span></div>
                            <div class="by">@{{ item.desc }}</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="page_con con2">
            <div class="wrap">
                <div class="title_style3">
                    <span>Global trend oriented</span>Driven by driving power
                </div>
                <div class="intro_style3">
                    <p>Global automotive trends are our road signs and we have reached many milestones on the road to power train electrification. We actively seek these trends and use innovative ETeligigTrand solutions to solve these problems. By constantly facing the challenges of the future, we strive to be the first on the road, the first eMobility race across the finish line. With our system capabilities, we understand the complexity of future drivelines and offer a wide range of products to meet customer requirements.</p>
                </div>
            </div>
        </div>

        <div class="page_con con3">
            <div class="wrap">
                <ul class="products_list style2">
                    <li v-for="item in list" v-if="item.is_top==0">
                        <div class="thumb">
                            <img v-bind:src="domain+item.img_url" alt="EDS (EDS MID+ HE) 120-160kW">
                        </div>
                        <div class="info">
                            <div class="name"><span>@{{ item.title }}</span></div>
                            <div class="by">@{{ item.desc }}</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /内容 -->
    @include('layouts.en.foot')
@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app',
            mounted(){
                this.getList();
            },
            data(){
                return {
                    domain: '{{ Yii::$app->params['qiniu']['domain'] }}',
                    list:[],
                }
            },
            methods: {
                getList() {
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
