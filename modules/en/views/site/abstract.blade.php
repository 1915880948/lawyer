@extends('layouts.en.main')
@section('route','en/site/abstract')
@section('content')
    <div class="wrapper page_abstract">
        <div class="banner_c">
            <img src="{{yStatic('en/img/banner7.jpg')}}" class="banner_pic" />
            <div class="banner_text">
                <img src="{{yStatic('en/img/banner_text7.png')}}" style="width: 20.36458%;"/>
            </div>
        </div>


        <div class="abs_con con1">
            <div class="wrap">
                <div class="title">About us</div>
                <div class="intro">HASCO Magna Electric Drive System Co., Ltd. (hereinafter referred to as "HASCO Magna") is jointly invested and established by HASCO Automobile System Co., Ltd. (hereinafter referred to as "HASCO Automobile") and Magna (Taicang) Automobile Technology Co., Ltd. (hereinafter referred to as "Magna Technology"), a wholly-owned subsidiary of Magna International Co., Ltd. (hereinafter referred to as "Magna Technology"). HASCO Magna completed its registration in Shanghai in March 2018, mainly focusing on the design, development, testing, manufacturing and sales of new energy vehicle electric drive system assembly products and subcomponents.</div>
            </div>
        </div>


        <div class="abs_con con2">
            <div class="wrap">
                <div class="top">
                    <div class="left">
                        <div class="title">Future development</div>
                        <div class="intro">The company will build a world-class R & D center and manufacturing base, and plan to support a new generation of three in one electric drive system products for domestic and foreign new energy vehicle manufacturers. The company provides the R & D and production of compact electric bridge for the electric vehicle platform of the international first-line automobile factory, and will be put into production in 2020. The product has the characteristics of light weight, high efficiency and low cost. With the batch production of this product and its series of products, the company will occupy an important position in the field of electric drive of new energy vehicles.</div>
                    </div>
                    <div class="right"><img src="{{yStatic('en/img/abstract_pic1.jpg')}}" alt="" /></div>
                </div>
                <div class="bottom">
                    <p>Huayu Magna will apply the advanced lean manufacturing concepts and rich project management experience of Huayu Group and Magna Group, to provide better products and more comprehensive technical services to customers at home and abroad.</p>
                </div>
            </div>
        </div>
        <div class="abs_con con3">
            <div class="wrap">
                <div class="left"><img src="{{yStatic('en/img/abstract_pic2.jpg')}}" alt="" /></div>
                <div class="right">
                    <div class="title">We want to be</div>
                    <ul class="become_ul">
                        <li>China's largest electric drive system design and manufacturing supplier / partner</li>
                        <li>A supplier with fully localized R & D capability of electric drive system</li>
                        <li>A core supplier with rich product series and complete functions</li>
                        <li>A supplier with perfect system, excellent manufacture and first-class service</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="abs_con con4">
            <div class="wrap">
                <div class="right">
                    <div class="title">Our team</div>
                    <div class="intro">At present, our team members are all from “985 / 211” universities in China, as well as overseas students from Britain, France and Germany. Professional technical talents gather here to form our experienced and energetic team, engage in the localization design and development of motor drive system assembly, and build the core competitiveness of electronics, software, machinery, system and experiment.</div>
                </div>
            </div>
        </div>

        <div class="abs_con con5">
            <div class="wrap">
                <div class="top">
                    <div class="left">
                        <div class="title">Our lab</div>
                        <div class="intro">At present, China and the European Technology Center work closely and cooperatively to develop and frequently communicate with European teams. They are committed to the integrated design of electric drive system of new energy vehicles, the software and hardware development of motor controller, the parts development of motor and reducer, and the calibration engineering service of electric vehicle powertrain.</div>
                    </div>
                    <div class="right"><img src="{{yStatic('en/img/abstract_pic3.jpg')}}" alt="" /></div>
                </div>
                <div class="bottom">
                    <p>The laboratory completed in 2019 will have the industry-leading electric drive performance development conditions. Its advanced experimental equipment can provide high-quality system development, component development, parameter calibration and other engineering services to major domestic and foreign automobile manufacturers, so as to meet the huge demand of new energy automobile industry of the current rapid development.</p>
                </div>
            </div>
        </div>

        <div class="abs_conn7">
            <div class="wrap">
                <h1>Message from the general manager</h1>
                <h2>华慕文&nbsp;&nbsp;&nbsp;&nbsp;General Manager</h2>
                <div class="intro">
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
@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app',
	    // vue 在IE里不支持简写
            mounted:function(){

            },
            data:function(){
                return {

                }
            },
            methods: {
                logout:function() {
                    location.href = '/user/login'
                }
            }
        })
    </script>
@stop

@section('plugin-style')
@stop
