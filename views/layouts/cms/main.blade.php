<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! yCsrfTag() !!}
    <link rel="shortcut icon" type="image/x-icon" href="{{yStatic('img/logo_icon.png')}}" media="screen" />
    <link rel="stylesheet" href="{{ yStatic('node_modules/element-ui/lib/theme-chalk/index.css') }}">
    <link rel="stylesheet" href="{{ yStatic('css/site.css') }}">
    @yield('plugin-style')
    <style>
        [v-cloak] {
            display: none;
        }

        .iconfont {
            margin-right: 5px;
        }
        .demo-block {
             border: 1px solid #ebebeb;
             border-radius: 3px;
             transition: .2s;
         }
    </style>
    <title>华域麦格纳后台管理系统</title>
</head>
<body>
<div id="app">
    <div class="app-wrapper">
        <el-menu
                default-active="{{ Yii::$app->request->url }}"
                background-color="#324157"
                text-color="#fff"
                active-text-color="#ffd04b!important"
                class="sidebar-container"
                v-cloak>
            <el-menu-item index="/cms/site/index">
                <i class="el-icon-s-home"></i>
                <a href="/cms/site/index"><span slot="title">首页</span></a>
            </el-menu-item>
            @if(\app\common\helpers\AuthHelper::getRole() == 3 || \app\common\helpers\AuthHelper::isAdmin())
                <el-menu-item index="/cms/product/list">
                    <i class="el-icon-setting"></i>
                    <a href="/cms/product/list"><span slot="title">智能产品</span></a>
                </el-menu-item>
            @endif
            @if(\app\common\helpers\AuthHelper::getRole() == 4 || \app\common\helpers\AuthHelper::isAdmin())
                <el-menu-item index="/cms/job/list">
                    <i class="el-icon-setting"></i>
                    <a href="/cms/job/list"><span slot="title">招聘职位</span></a>
                </el-menu-item>
            @endif
{{--            @if(\app\common\helpers\AuthHelper::getRole() == 5 || \app\common\helpers\AuthHelper::isAdmin())--}}
{{--                <el-menu-item index="/cms/employe/list">--}}
{{--                    <i class="el-icon-setting"></i>--}}
{{--                    <a href="/cms/employe/list"><span slot="title">员工感言</span></a>--}}
{{--                </el-menu-item>--}}
{{--            @endif--}}
            @if(\app\common\helpers\AuthHelper::getRole() == 6 || \app\common\helpers\AuthHelper::isAdmin())
                <el-menu-item index="/cms/news/list">
                    <i class="el-icon-setting"></i>
                    <a href="/cms/news/list"><span slot="title">新闻动态</span></a>
                </el-menu-item>
            @endif
            @if(\app\common\helpers\AuthHelper::getRole() == 7 || \app\common\helpers\AuthHelper::isAdmin())
                <el-menu-item index="/cms/active/list">
                    <i class="el-icon-setting"></i>
                    <a href="/cms/active/list"><span slot="title">员工动态</span></a>
                </el-menu-item>
            @endif
            @if(\app\common\helpers\AuthHelper::getRole() == 8 || \app\common\helpers\AuthHelper::isAdmin())
                <el-menu-item index="/cms/basic/index">
                    <i class="el-icon-setting"></i>
                    <a href="/cms/basic/index"><span slot="title">品牌体验</span></a>
                </el-menu-item>
            @endif
            @if(\app\common\helpers\AuthHelper::getRole() == 9 || \app\common\helpers\AuthHelper::isAdmin())
                <el-menu-item index="/cms/career/develop">
                    <i class="el-icon-setting"></i>
                    <a href="/cms/career/develop"><span slot="title">职业发展</span></a>
                </el-menu-item>
            @endif
            @if(\app\common\helpers\AuthHelper::isAdmin())
                <el-menu-item index="/cms/admin/list">
                    <i class="el-icon-s-custom"></i>
                    <a href="/cms/admin/list"><span slot="title">管理员列表</span></a>
                </el-menu-item>
            @endif

        </el-menu>
        <div class="main-container">

            <el-menu class="navbar" mode="horizontal" background-color="#eef1f6">

                <el-dropdown class="avatar-container" trigger="click">
                    <div class="avatar-wrapper">
                        <img class="user-avatar"
                             src="https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif?imageView2/1/w/80/h/80">
                        <i class="el-icon-caret-bottom"></i>
                    </div>
                    <el-dropdown-menu class="user-dropdown" slot="dropdown">
                        @if(\app\common\helpers\AuthHelper::isAdmin())
                            <a target='_blank' href="/cms/admin/list">
                                <el-dropdown-item>人员管理</el-dropdown-item>
                            </a>
                        @endif
                        <a href="/cms/admin/logout">
                            <el-dropdown-item divided>退出登录</el-dropdown-item>
                        </a>
                    </el-dropdown-menu>
                </el-dropdown>
            </el-menu>
            <section class="app-main" style="min-height: 100%">
                <transition name="fade" mode="out-in">
                    @yield('content')
                </transition>
            </section>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{yStatic('js/jquery-1.11.1.min.js')}}"></script>

<script src="{{ yStatic('node_modules/vue/dist/vue.min.js') }}"></script>
<script src="{{ yStatic('node_modules/element-ui/lib/index.js') }}"></script>
{{--<script src="{{ yStatic('node_modules/axios/dist/axios.min.js') }}"></script>--}}
<script src="{{ yStatic('js/helper.js') }}"></script>
<script>
    // axios.interceptors.request.use((config) => {
    //     config.data = {
    //         ...config.data,
    //         _csrf: document.getElementsByTagName('meta')['csrf-token'].content
    //     }
    //     return config
    // });

    function getQueryString(name) {
      //let params = new URLSearchParams(location.search.substring(1));
      //return params.get(name);
        let reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        let r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]);
        return '';
    }
</script>
@yield('foot-script')
</body>
</html>
