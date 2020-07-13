@extends('layouts.encms.main-login')

@section('content')
    <div class="login-container" id="loginContent">
        <el-form class="card-box login-form" autoComplete="on" :model="loginForm" :rules="loginRules" ref="loginForm"
                 label-position="left">
            <h3 class="title">修改密码-EN</h3>
            <el-form-item prop="username">
                <span class="svg-container svg-container_login">
                    <icon-svg icon-class="user"/>
                </span>
                <el-input name="username" type="text" v-model="loginForm.username" autoComplete="on" placeholder="要修改的账号"/>
            </el-form-item>

            <el-form-item prop="password">
                <span class="svg-container">
                    <icon-svg icon-class="password"/>
                </span>
                <el-input name="password" :type="pwdType" @keyup.enter.native="handleEdit" v-model="loginForm.password"
                          autoComplete="on" show-password placeholder="新密码"/>
            </el-form-item>
            <el-form-item prop="password2">
                <span class="svg-container">
                    <icon-svg icon-class="password"/>
                </span>
                <el-input name="password2" :type="pwdType" @keyup.enter.native="handleEdit" v-model="loginForm.password2"
                          autoComplete="on" show-password placeholder="确认密码"/>
            </el-form-item>
            <div style="font-size: 1rem; color: red;"><i class="el-icon-user-solid"></i>至少10位.大写字母,小写字母,数字,符号中的至少三种 </div>
            <el-form-item >
                <el-button type="danger" style="width:100%;margin-bottom:30px;" :loading="loading"
                           @click.native.prevent="handleEdit">确认修改
                </el-button>
                <a href="{{yUrl('/encms/site/login')}}" style="color: red; float: right; text-decoration: underline;"> >>>去登录</a>
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
                        password: '',
                        password2: ''
                    },
                    loginRules: {
                        username: [{required: true,message:'用户名必填', trigger: 'blur'}],
                        password: [{required: true, min: 10, max: 30, message: '10~30个字符', trigger: 'blur'}],
                        password2: [{required: true, min: 10, max: 30, message: '10~30个字符', trigger: 'blur' }]
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
                handleEdit:function() {
                    var _this = this;
                    if( _this.loginForm.password !== _this.loginForm.password2 ){
                        _this.$message({
                            message: '两次密码不一样！！',
                            type: 'error',
                            duration: 1000,
                        });
                        return;
                    }
                    this.$refs.loginForm.validate(function(valid) {
                        if (valid) {
                            Helper.asynRequest('POST', '/encms/site/edit', _this.loginForm, function (response) {
                                if( response.code == 200 ){
                                    _this.$message({
                                        message: '修改成功，请重新登录',
                                        type: 'success',
                                        duration: 1000,
                                        onClose: function () {
                                            location.href = '/encms/site/login';
                                        }
                                    })
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
