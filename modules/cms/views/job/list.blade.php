@extends('layouts.cms.main')

@section('title')@stop

@section('content')
    <div id="content">
        <div class="filter-container">
            <el-input @keyup.enter.native="handleFilter" style="width: 200px;" class="filter-item" placeholder="标题"
                      v-model="query.search">
            </el-input>

            <el-button class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter" size="medium">搜索
            </el-button>
            <el-button class="filter-item" style="margin-left: 10px;" @click="handleCreate" type="primary"
                       icon="el-icon-plus" size="medium">添加
            </el-button>
        </div>
        <el-row :gutter="20">
            <el-col :span="16">
                <el-table
                        :data="tableData"
                        border
                        style="width: 100%">
                    <el-table-column label="职位">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.name }}</span>
                        </template>
                    </el-table-column>
                    <el-table-column label="工作地点">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.address }}</span>
                        </template>
                    </el-table-column>
                    <el-table-column label="递投邮箱">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.email }}</span>
                        </template>
                    </el-table-column>
                    <el-table-column label="排序值">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.sort }}</span>
                        </template>
                    </el-table-column>
                    <el-table-column label="操作" width="260">
                        <template slot-scope="scope">
                            <el-button
                                    size="mini"
                                    type="primary"
                                    @click="handleOpreate('shelf',scope.$index, scope.row,1)"
                                    v-if="scope.row.shelf_status == 0">上架</el-button>
                            <el-button
                                    size="mini"
                                    type="danger"
                                    @click="handleOpreate('shelf',scope.$index, scope.row,0)"
                                    v-if="scope.row.shelf_status == 1">下架</el-button>
                            <el-button
                                    size="mini"
                                    @click="handleEdit(scope.$index, scope.row)">编辑
                            </el-button>
                            <el-button
                                    size="mini"
                                    type="danger"
                                    @click="handleOpreate('delete',scope.$index, scope.row,'')">删除
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <el-pagination
                        @size-change="handleSizeChange"
                        @current-change="handleCurrentChange"
                        :current-page="1"
                        :page-sizes="[10, 20, 50, 100]"
                        :page-size="10"
                        layout="total, sizes, prev, pager, next, jumper"
                        :total="total"
                        class="pagination">
                </el-pagination>
            </el-col>
            <el-col :span="8" class="demo-block">
                <el-form :model="form"  label-width="80px" style="margin-top: 20px">
                    <el-form-item label="职位">
                        <el-input v-model="form.name"  placeholder="请输入"></el-input>
                    </el-form-item>
                    <el-form-item label="工作地点">
                        <el-input v-model="form.address"  placeholder="请输入"></el-input>
                    </el-form-item>
                    <el-form-item label="岗位目标" class="rich"  prop="content">
                        <ueditor :config="config" ref="ueContent1" :id="'ue1'" style="width: 100%"></ueditor>
                    </el-form-item>
                    <el-form-item label="岗位职责" class="rich"  prop="content">
                        <ueditor :config="config" ref="ueContent2" :id="'ue2'" style="width: 100%"></ueditor>
                    </el-form-item>
                    <el-form-item label="任职资格" class="rich"  prop="content">
                        <ueditor :config="config" ref="ueContent3" :id="'ue3'" style="width: 100%"></ueditor>
                    </el-form-item>
                    <el-form-item label="其他要求">
                        <el-input v-model="form.other"  placeholder="请输入"></el-input>
                    </el-form-item>
                    <el-form-item label="递投邮箱">
                        <el-input v-model="form.email"  placeholder="请输入"></el-input>
                    </el-form-item>
                    <el-form-item label="排序" >
                        <el-input-number v-model="form.sort" :min="1" step="10"></el-input-number>
                    </el-form-item>
                    <el-form-item label="上架状态">
                        <el-radio-group v-model="form.shelf_status">
                            <el-radio :label="0">下架</el-radio>
                            <el-radio :label="1">上架</el-radio>
                        </el-radio-group>
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
                tableData: [],
                query: {
                    page: 1,
                    size: 10,
                    search: ''
                },
                form:{
                    id:'',
                    name:'',
                    address:'',
                    targent:'',
                    duty:'',
                    require:'',
                    other:'',
                    email:'',
                    sort:10,
                    shelf_status:1,
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
                            //'insertvideo', //视频
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
            handleCreate: function () {
                this.form.id = this.form.name = this.form.address = this.form.targent = this.form.duty = this.form.require =
                    this.form.other = this.form.email = '';
                this.form.sort = 10;this.shelf_status =1;
            },
            handleEdit: function (index, row) {
                let _this = this;
                Helper.asynRequest('GET', '/cms/job/detail', {id:row.id}, function (response) {
                    _this.form.id = response.data.id;
                    _this.form.name = response.data.name;
                    _this.form.address = response.data.address;
                    _this.form.targent = response.data.targent;
                    _this.form.duty = response.data.duty;
                    _this.form.require = response.data.require;
                    _this.form.other = response.data.other;
                    _this.form.email = response.data.email;
                    _this.form.sort = response.data.sort;
                    _this.form.shelf_status = response.data.shelf_status;
                    _this.$refs.ueContent1.setContent(response.data.targent);
                    _this.$refs.ueContent2.setContent(response.data.duty);
                    _this.$refs.ueContent3.setContent(response.data.require);
                }, function () {
                    _this.$message({
                        type: 'error',
                        message: '系统错误!'
                    });
                });
            },
            submitForm(){
                let url = '/cms/job/edit',
                    _this = this;
                _this.form.targent = _this.$refs.ueContent1.getUEContent();
                _this.form.duty    = _this.$refs.ueContent2.getUEContent();
                _this.form.require = _this.$refs.ueContent3.getUEContent();
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
            handleOpreate: function (method,index, row,value) {
                let _this = this;
                _this.$confirm('您确定执行此操作吗, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(function () {
                    Helper.asynRequest('POST', '/cms/job/operate', {method:method,id: row.id,value:value}, function (response) {
                        _this.$message({
                            type: 'success',
                            message: '操作成功!'
                        });
                        _this.request(_this.page, _this.size);
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });

                }).catch(function () {
                    _this.$message({
                        type: 'info',
                        message: '已取消删除'
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
                Helper.asynRequest('GET', '/cms/job/list', _this.query, function (response) {
                    _this.tableData = response.data;
                    _this.total = parseInt(response.recordsTotal);
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