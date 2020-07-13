@extends('layouts.cms.main-login')

@section('content')
    <div class="login-container" id="loginContent">
        <el-form class="card-box login-form" autoComplete="on" :model="loginForm" :rules="loginRules" ref="loginForm"
                 label-position="left">
            <h3 class="title">系统登录</h3>
            <el-form-item prop="username">
                <span class="svg-container svg-container_login">
                    <icon-svg icon-class="user"/>
                </span>
                <el-input name="username" type="text" v-model="loginForm.username" autoComplete="on" placeholder="登录名"/>
            </el-form-item>

            <el-form-item prop="password">
                <span class="svg-container">
                    <icon-svg icon-class="password"/>
                </span>
                <el-input name="password" :type="pwdType" @keyup.enter.native="handleLogin" v-model="loginForm.password"
                          autoComplete="on" show-password placeholder="密码"/>
                <span class='show-pwd' @click='showPwd'><icon-svg icon-class="eye"/></span>
            </el-form-item>
            <el-form-item >
                <el-button type="primary" style="width:100%;margin-bottom:30px;" :loading="loading"
                           @click.native.prevent="handleLogin">登录
                </el-button>
                <a href="{{yUrl('/cms/site/edit')}}" style="color: red; float: right; text-decoration: underline;"> >>>修改密码</a>
            </el-form-item>
        </el-form>
    </div>
@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#loginContent',
            data:function() {
                var validatePassword = function (rule, value, callback) {
                    callback()
                };
                return {
                    loginForm: {
                        username: '',
                        password: ''
                    },
                    loginRules: {
                        username: [{required: true, trigger: 'blur'}],
                        password: [{required: true, trigger: 'blur', validator: validatePassword}]
                    },
                    pwdType: 'password',
                    loading: false,
                    showDialog: false
                }
            },
            methods: {
                showPwd:function() {
                    if (this.pwdType === 'password') {
                        this.pwdType = ''
                    } else {
                        this.pwdType = 'password'
                    }
                },
                handleLogin:function() {
                    var _this = this;
                    this.$refs.loginForm.validate(function(valid) {
                        if (valid) {
                            Helper.asynRequest('POST', '/cms/admin/login', _this.loginForm, function (response) {
                                if( response.code == 200 ){
                                    _this.$message({
                                        message: '登录成功',
                                        type: 'success',
                                        duration: 1000,
                                        onClose: function () {
                                            location.href = '/cms/site/index';
                                        }
                                    })
                                }else if(response.code == 302){
                                    _this.$message({
                                        message: response.message,
                                        type: 'error',
                                        duration: 1000,
                                        onClose: function () {
                                            location.href = '/cms/site/edit';
                                        }
                                    });
                                }else{
                                    _this.$message({
                                        message: response.message,
                                        type: 'error',
                                        duration: 1500
                                    })
                                }
                            }, function () {
                                _this.$message({
                                    type: 'error',
                                    message: '系统错误!'
                                });
                            });
                        } else {
                            console.log('error submit!!');
                            return false
                        }
                    })
                }
            }
        })

    </script>
@stop
