@extends('layouts.wap')
@section('route','site/abstract')
@section('content')
    <!-- 内容 -->
    <div class="container page_about">
        <div class="top_pic_c">
            <img src="{{yStatic('wap/img/top_pic0.jpg')}}" class="top_pic" />
            <img src="{{yStatic('wap/img/title2.png')}}" alt="UNLOCKING FUTURE MOBILITY  开启未来的机动性" class="title"/>
        </div>

        <div class="page_con bg_gray con1">
            <div class="wrap">
                <div class="title_style1">
                    <span>关于我们</span>
                </div>

                <div class="intro_style1">
                    <p>华域麦格纳电驱动系统有限公司（简称“华域麦格纳”）是华域汽车系统股份有限公司（简称“华域汽车”）与麦格纳国际公司（简称“麦格纳”）所属全资子公司麦格纳 （太仓）汽车科技有限公司（简称“麦格纳科技”）共同投资成立。华域麦格纳于2018年3月在上海完成注册，主要致力于新能源汽车电驱动系统总成产品和子部件的设计、开发、测试、制造和销售。</p>
                    <img src="{{yStatic('wap/img/pic1.jpg')}}" alt=""/>
                </div>

                <div class="title_style2">未来的发展</div>

                <div class="intro_style1">
                    <p>公司将建造世界一流的研发中心、制造基地，规划为国内外新能源汽车制造企业配套新一代三合一电驱动系统产品。公司为国际一线整车厂电动车平台提供配套的紧凑型电桥的研发生产。产品具备重量轻、效率高、成本优的特点。随着这款产品及其系列产品的批产，公司将在新能源汽车电驱动领域占有重要的位置。</p>
                    <p>华域麦格纳将应用华域集团及麦格纳集团先进的精益制造理念，丰富的项目管理经验为国内外顾客提供更优质的产品，更全面技术服务。</p>
                </div>
            </div>
        </div>

        <div class="page_con bg_blue con2">
            <div class="wrap">
                <div class="title_style3 white">
                    <span>我们要立志成为</span>
                </div>

                <ul class="become_list">
                    <li>中国最大的电驱动系统设计制造供应商/合作伙伴</li>
                    <li>具有电驱动系统完全本地化研发能力的供应商</li>
                    <li>产品系列丰富、功能配套齐全的核心供应商</li>
                    <li>系统完善、制造精良、服务一流的供应商</li>
                </ul>
            </div>
        </div>

        <div class="page_con bg_gray con3">
            <div class="wrap">
                <div class="title_style3">
                    <span>我们的研发能力</span>
                </div>

                <div class="title_style4">我们的团队</div>
                <div class="intro_style1">
                    <p>当前我们的团队成员均来自国内985/211高校以及英国、法国和德国的留学生。专业的技术人才汇聚于此，形成我们经验丰富且富有活力的团队，从事电机驱动系统总成的本土化设计与开发，构筑电子、软件、机械、系统和实验的核心竞争力。</p>
                    <img src="{{yStatic('wap/img/pic4.jpg')}}" alt="" />
                </div>
            </div>
        </div>

        <div class="page_con bg_blue con4">
            <div class="wrap">
                <div class="title_style2 white">我们的实验室</div>

                <div class="intro_style1 white">
                    <p>目前中国和欧洲技术中心两地紧密合作、协同开发，频繁地与欧洲团队进行沟通。致力于新能源汽车电驱动系统的集成设计、电机控制器的软件及硬件开发、电机和减速器的零部件开发，以及电动汽车动力总成的标定工程服务。</p>
                    <p>2019年完工的实验室，拥有行业领先水平的电驱动性能开发条件，其先进的实验设备能为国内外各大汽车厂商提供优质的系统开发、零部件开发、参数标定等工程服务，以满足当前飞速发展的新能源汽车行业的巨大需求。</p>
                </div>
            </div>
        </div>
<!-- 
        <div class="page_con bg_gray con5">
            <div class="wrap">
                <div class="title_style2">我们的目标</div>

                <div class="intro_style1">
                    <p>我们的目标是成为最大的电驱动系统设计制造供应商/合作伙伴，成为具有电驱动系统完全研发/验证能力的供应商，成为产品系列丰富、功能配套齐全的核心供应商，成为系统完善、制造精良、服务一流的供应商</p>
                    <img src="{{yStatic('wap/img/pic3.jpg')}}" alt="" />
                </div>
            </div>
        </div> -->

        <div class="page_con con6">
            <div class="wrap">
                <div class="title_style2">总经理致辞</div>
                <div class="manage_name">
                    <span>华慕文</span>
                    <span>General Manager</span>
                </div>

                <div class="manage_talk">
                    <p>各位朋友，大家好：</p>
                    <p>欢迎您登陆华域麦格纳电驱动系统有限公司网站，感谢您对我们的关注。</p>
                    <p>我们企业成立于2018年3月16日，由华域汽车集团和麦格纳集团合资创办。</p>
                    <p>创新引领未来，驱动增速发展。经过二十多年的迅猛发展，汽车行业进入了新能源的时代，我们公司将会为新能源汽车提供核心的电驱动系统，并着力打造致力于本土的领先技术研发实力，引领并推动新能源产业的不断发展和进步。</p>
                    <p>作为未来电动汽车关键零部件的研发、生产、制造于一体的公司，我们是上汽集团的重点发展领域，也是国家重点发展的产业。我们拥有来自于股东方上汽集团、华域汽车及麦格纳集团的大力支持，我们拥有年轻且富有激情的团队，我们拥有广阔的市场前景，我们立志创造新能源时代的标杆，成为业内一颗耀眼的新星。</p>
                    <p>最后，我仅代表华域麦格纳全体员工，向所有关心、支持华域麦格纳电驱动系统发展的各级领导、战略伙伴以及社会各界人士表示真挚的谢意！</p>
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

            },
            data(){
                return {

                }
            },
            methods: {
                logout() {
                    location.href = '/user/login'
                }
            }
        })
    </script>
@stop

@section('plugin-style')
@stop
