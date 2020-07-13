@extends('layouts.encms.main')

@section('title')@stop

@section('content')
    <div id="content">
        <h4>职业发展</h4>
        <el-row :gutter="20">
            <el-col :span="24" class="demo-block">
                <el-form :model="form"  label-width="80px" style="margin-top: 20px">
                    <el-form-item label="正文" class="rich"  prop="content">
                        <ueditor :config="config" ref="ueContent" :id="'ue1'" style="width: 100%"></ueditor>
                    </el-form-item>

                    <el-form-item>
                        <el-button >取 消</el-button>
                        <el-button type="primary" @click="submitForm">确 定</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>

    </div>
@stop

@section('plugin-style')
    <style type="text/css">
        .rich .el-form-item__content{
            line-height: inherit;
        }
    </style>
@stop

@section('foot-script')
    <script src="{{ yStatic('ueditor/ueditor.config.js') }}"></script>
    <script src="{{ yStatic('ueditor/ueditor.all.min.js') }}"></script>
    <script src="{{ yStatic('ueditor/lang/zh-cn/zh-cn.js') }}"></script>
    <script src="{{ yStatic('ueditor/ueditor.parse.min.js') }}"></script>
    <script src="{{ yStatic('js/Vue.ue.js') }}"></script>
    <script>
    new Vue({
        el: '#app',
        components: { ueditor},
        mounted: function () {
            this.request();
            this.getUptoken();
        },
        data: function () {
            return {
                domain:'{{ Yii::$app->params['qiniu']['domain'] }}',
                total: 0,
                upToken:'',
                form:{
                    id:1,
                    content:'',
                    time:'',
                },
                config: {
                    toolbars: [
                        [
                            'bold', //加粗
                            'indent', //首行缩进
                            'italic', //斜体
                            'underline', //下划线
                            'source', //源代码
                            'horizontal', //分隔线
                            'removeformat', //清除格式
                            'unlink', //取消链接
                            'cleardoc', //清空文档
                            'fontfamily', //字体
                            'fontsize', //字号
                            'paragraph', //段落格式
                            'simpleupload', //单图上传
                            'link', //超链接
                            'map', //Baidu地图
                            // 'insertvideo', //视频
                            'help', //帮助
                            'justifyleft', //居左对齐
                            'justifyright', //居右对齐
                            'justifycenter', //居中对齐
                            'justifyjustify', //两端对齐
                            'forecolor', //字体颜色
                            'backcolor', //背景色
                            //'insertorderedlist', //有序列表
                            //'insertunorderedlist', //无序列表
                            'fullscreen', //全屏
                            'lineheight', //行间距
                            'edittip ', //编辑提示
                            //'customstyle', //自定义标题
                            'template', //模板
                        ]
                    ],
                    initialFrameWidth: 800,
                    initialFrameHeight: 400,
                    autoHeightEnabled: false
                },
            }
        },
        methods: {
            submitForm(){
                let url = '/encms/career/develop',
                    _this = this;
                _this.form.content = _this.$refs.ueContent.getUEContent();
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
                this.form.img_url = res.key;
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
            handleSizeChange: function (val) {
                this.query.size = val;
                this.request();
            },
            handleCurrentChange: function (val) {
                this.query.page = val;
                this.request();
            },
            handleFilter: function () {
                this.request();
            },
            request: function () {
                let _this = this;
                Helper.asynRequest('GET', '/encms/career/detail', _this.query, function (response) {
                    _this.form = response.data;
                    _this.$refs.ueContent.setContent(response.data.content);
                    // _this.total = parseInt(response.recordsTotal);
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
