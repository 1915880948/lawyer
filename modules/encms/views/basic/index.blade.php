@extends('layouts.encms.main')

@section('title')@stop

@section('content')
    <div id="content">
        <div class="filter-container">
        </div>
        <el-row :gutter="20">
            <el-col :span="16">
                <el-tabs v-model="activeName">
                    <el-tab-pane label="品牌管理" name="first">
                        <el-form :model="form"  label-width="80px" style="margin-top: 20px">
                            <el-form-item label="标题">
                                <el-input v-model="form.brand_title"  placeholder="请输入"></el-input>
                            </el-form-item>
                            <el-form-item label="副标题">
                                <el-input v-model="form.brand_title2"  placeholder="请输入"></el-input>
                            </el-form-item>
                            <el-form-item label="图片">
                                <el-upload class="avatar-uploader" action="http://up.qiniu.com" :show-file-list="false" :data="{token: upToken}" :accept="'.jpg,.jpeg,.png'" :on-success="handleAvatarSuccess" :before-upload="beforeAvatarUpload">
                                    <img v-if="form.brand_url" :src="domain+form.brand_url" class="avatar"> <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                                </el-upload>
                            </el-form-item>
                            <el-form-item label="简介">
                                <el-input
                                        type="textarea"
                                        :autosize="{ minRows: 2, maxRows: 4}"
                                        placeholder="简介"
                                        v-model="form.brand_desc">
                                </el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button >取 消</el-button>
                                <el-button type="primary" @click="submitForm">确 定</el-button>
                            </el-form-item>
                        </el-form>
                    </el-tab-pane>
                    <el-tab-pane label="实力管理" name="second">
                        <el-form :model="form"  label-width="80px" style="margin-top: 20px">
                            <el-form-item label="标题">
                                <el-input v-model="form.strength_title"  placeholder="请输入"></el-input>
                            </el-form-item>
                            <el-form-item label="副标题">
                                <el-input v-model="form.strength_title2"  placeholder="请输入"></el-input>
                            </el-form-item>
                            <el-form-item label="简介">
                                <el-input
                                        type="textarea"
                                        :autosize="{ minRows: 2, maxRows: 4}"
                                        placeholder="简介"
                                        v-model="form.strength_desc">
                                </el-input>
                            </el-form-item>
                            <el-form-item label="简介2">
                                <el-input
                                        type="textarea"
                                        :autosize="{ minRows: 2, maxRows: 4}"
                                        placeholder="简介"
                                        v-model="form.strength_desc2">
                                </el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button >取 消</el-button>
                                <el-button type="primary" @click="submitForm">确 定</el-button>
                            </el-form-item>
                        </el-form>
                    </el-tab-pane>
                    <el-tab-pane label="地位管理" name="third">
                        <el-form :model="form"  label-width="80px" style="margin-top: 20px">
                            <el-form-item label="标题">
                                <el-input v-model="form.position_title"  placeholder="请输入"></el-input>
                            </el-form-item>
                            <el-form-item label="副标题">
                                <el-input v-model="form.position_title2"  placeholder="请输入"></el-input>
                            </el-form-item>
                            <el-form-item label="简介">
                                <el-input
                                        type="textarea"
                                        :autosize="{ minRows: 2, maxRows: 4}"
                                        placeholder="简介"
                                        v-model="form.position_desc">
                                </el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button >取 消</el-button>
                                <el-button type="primary" @click="submitForm">确 定</el-button>
                            </el-form-item>
                        </el-form>
                    </el-tab-pane>
                </el-tabs>
            </el-col>
            {{--<el-col :span="8" class="demo-block">--}}
            {{--</el-col>--}}
        </el-row>

    </div>
@stop

@section('plugin-style')
    <style type="text/css">

    </style>
@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app',
            mounted: function () {
                this.request();
                this.getUptoken();
            },
            data: function () {
                return {
                    domain:'{{ Yii::$app->params['qiniu']['domain'] }}',
                    upToken:'',
                    activeName:'first',
                    tableData: [],
                    form:{
                        id:'',
                        brand_title:'',
                        brand_title2:'',
                        brand_desc:'',
                        brand_url:'',
                        strength_title:'',
                        strength_title2:'',
                        strength_desc:'',
                        strength_desc2:'',
                        position_title:'',
                        position_title2:'',
                        position_desc:'',
                    },
                }
            },
            methods: {
                submitForm(){
                    let url = '/encms/basic/edit',
                        _this = this;
                    Helper.asynRequest('POST', url, _this.form, function (response) {
                        _this.$message({
                            type: 'success',
                            message: '提交成功!',
                            duration: 1000,
                            onClose: function () {
                                _this.request();
                            }
                        });
                    }, function (msg) {
                        _this.$message({
                            type: 'error',
                            message: '提交失败!'
                        });
                    });
                },
                handleAvatarSuccess(res, file) {
                    this.form.brand_url = res.key;
                },
                beforeAvatarUpload(file) {
                    const isJPG = file.type === 'image/jpeg' || file.type === 'image/jpg' || file.type === 'image/png';
                    const isLt2M = file.size / 1024 / 1024 < 2;
                    if (!isJPG) {
                        this.$message.error('上传头像图片只能是 .jpg,.jpeg,.png 格式!');
                    }
                    if (!isLt2M) {
                        this.$message.error('上传图片大小不能超过 2MB!');
                    }
                    return isJPG && isLt2M;
                },
                getUptoken() {
                    let _this = this;
                    Helper.asynRequest('GET', '/file/token', {}, function (response) {
                        _this.upToken = response.data;
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '图片上传配置错误，请稍后再试！!'
                        });
                    });
                },
                request: function () {
                    let _this = this;
                    Helper.asynRequest('GET', '/encms/basic/detail',{}, function (response) {
                        _this.form = response.data;
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });
                }
            }
        });
    </script>
@stop
