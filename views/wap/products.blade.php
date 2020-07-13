@extends('layouts.wap')
@section('route','site/products')
@section('content')
    <!-- 内容 -->
    <div class="container page_products">
        <div class="top_pic_c">
            <img src="{{yStatic('wap/img/top_pic3.jpg')}}" class="top_pic" />
            <img src="{{yStatic('wap/img/title6.png')}}" alt="MADE BY HME PRODUCTS  智能科技" class="title"/>
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
                    <span>以全球趋势为导向</span>受驱动力驱动
                </div>
                <div class="intro_style3">
                    <p>全球汽车趋势作为我们的路标，我们在通往动力传动系电气化的道路上已经达到了许多里程碑。我们积极寻求这些趋势，并用创新的ETeligigTrand解决方案来解决这些问题。通过不断面对未来的挑战，我们努力成为第一个在路上，第一个跨越终点线的eMobility比赛。凭借我们的系统能力，我们理解未来传动系的复杂性，并提供广泛的产品以满足客户的要求。</p>
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
    @include('layouts.foot')
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
