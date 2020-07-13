@extends('layouts.en.wap')
@section('route','en/site/abstract')
@section('content')
    <!-- 内容 -->
    <div class="container page_about">
        <div class="top_pic_c">
            <img src="{{yStatic('en/wap/img/top_pic0.jpg')}}" class="top_pic" />
            <img src="{{yStatic('en/wap/img/title2.png')}}" alt="UNLOCKING FUTURE MOBILITY  开启未来的机动性" class="title"/>
        </div>

        <div class="page_con bg_gray con1">
            <div class="wrap">
                <div class="title_style1">
                    <span>About us</span>
                </div>

                <div class="intro_style1">
                    <p>HASCO Magna Electric Drive System Co., Ltd. (hereinafter referred to as "HASCO Magna") is jointly invested and established by HASCO Automobile System Co., Ltd. (hereinafter referred to as "HASCO Automobile") and Magna (Taicang) Automobile Technology Co., Ltd. (hereinafter referred to as "Magna Technology"), a wholly-owned subsidiary of Magna International Co., Ltd. (hereinafter referred to as "Magna Technology"). HASCO Magna completed its registration in Shanghai in March 2018, mainly focusing on the design, development, testing, manufacturing and sales of new energy vehicle electric drive system assembly products and subcomponents.</p>
                    <img src="{{yStatic('en/wap/img/pic1.jpg')}}" alt=""/>
                </div>

                <div class="title_style2">Future development</div>

                <div class="intro_style1">
                    <p>The company will build a world-class R & D center and manufacturing base, and plan to support a new generation of three in one electric drive system products for domestic and foreign new energy vehicle manufacturers. The company provides the R & D and production of compact electric bridge for the electric vehicle platform of the international first-line automobile factory, and will be put into production in 2020. The product has the characteristics of light weight, high efficiency and low cost. With the batch production of this product and its series of products, the company will occupy an important position in the field of electric drive of new energy vehicles.</p>
                    <p>Huayu Magna will apply the advanced lean manufacturing concepts and rich project management experience of Huayu Group and Magna Group, to provide better products and more comprehensive technical services to customers at home and abroad.</p>
                </div>
            </div>
        </div>

        <div class="page_con bg_blue con2">
            <div class="wrap">
                <div class="title_style3 white">
                    <span>We want to be</span>
                </div>

                <ul class="become_list">
                    <li>China's largest electric drive system design and manufacturing supplier / partner</li>
                    <li>A supplier with fully localized R & D capability of electric drive system</li>
                    <li>A core supplier with rich product series and complete functions</li>
                    <li>A supplier with perfect system, excellent manufacture and first-class service</li>
                </ul>
            </div>
        </div>

        <div class="page_con bg_gray con3">
            <div class="wrap">
                <div class="title_style3">
                    <span>Our team</span>
                </div>

                <div class="intro_style1">
                    <p>At present, our team members are all from “985 / 211” universities in China, as well as overseas students from Britain, France and Germany. Professional technical talents gather here to form our experienced and energetic team, engage in the localization design and development of motor drive system assembly, and build the core competitiveness of electronics, software, machinery, system and experiment.</p>
                    <img src="{{yStatic('en/wap/img/pic4.jpg')}}" alt="" />
                </div>
            </div>
        </div>

        <div class="page_con bg_blue con4">
            <div class="wrap">
                <div class="title_style2 white">Our lab</div>

                <div class="intro_style1 white">
                    <p>At present, China and the European Technology Center work closely and cooperatively to develop and frequently communicate with European teams. They are committed to the integrated design of electric drive system of new energy vehicles, the software and hardware development of motor controller, the parts development of motor and reducer, and the calibration engineering service of electric vehicle powertrain.</p>
                    <p>The laboratory completed in 2019 will have the industry-leading electric drive performance development conditions. Its advanced experimental equipment can provide high-quality system development, component development, parameter calibration and other engineering services to major domestic and foreign automobile manufacturers, so as to meet the huge demand of new energy automobile industry of the current rapid development.</p>
                </div>
            </div>
        </div>
<!-- 
        <div class="page_con bg_gray con5">
            <div class="wrap">
                <div class="title_style2">我们的目标</div>

                <div class="intro_style1">
                    <p>我们的目标是成为最大的电驱动系统设计制造供应商/合作伙伴，成为具有电驱动系统完全研发/验证能力的供应商，成为产品系列丰富、功能配套齐全的核心供应商，成为系统完善、制造精良、服务一流的供应商</p>
                    <img src="{{yStatic('en/wap/img/pic3.jpg')}}" alt="" />
                </div>
            </div>
        </div> -->

        <div class="page_con con6">
            <div class="wrap">
                <div class="title_style2">Message from the general manager</div>
                <div class="manage_name">
                    <span>华慕文</span>
                    <span>General Manager</span>
                </div>

                <div class="manage_talk">
                    <p>Dear friends,</p>
                    <p>Welcome to the website of Huayu Magna Electric Drive System Co., Ltd. Thank you for your attention.</p>
                    <p>Our company was founded on March 16, 2018, jointly established by Huayu Automobile Group and Magna Group.</p>
                    <p>Innovation leads the future and drives rapid growth. After more than 20 years of rapid development, the automotive industry has entered the era of new energy. Our company will provide the core electric drive system to new energy vehicles, and strive to build a leading technology R & D strength committed to the local, leading and promoting the continuous development and progress of the new energy industry.</p>
                    <p>As a company integrating R & D, production and manufacturing of key parts of electric vehicles in the future, we are the key development field of SAIC Group and the key industry of the state. We have strong support from shareholders such as SAIC Group, Huayu Automobile and Magna Group. We have a young and passionate team. We have broad market prospects. We are determined to create a benchmark in the new energy era and become a dazzling new star in the industry.</p>
                    <p>Finally, on behalf of all employees of Huayu Magna, I would like to express my sincere thanks to all leaders, strategic partners and people from all walks of life who care about and support the development of Huayu Magna Electric Drive System!</p>
                </div>
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
