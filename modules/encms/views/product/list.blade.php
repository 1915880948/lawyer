@extends('layouts.encms.main')

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
                    <el-table-column label="标题">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.title }}</span>
                        </template>
                    </el-table-column>
                    <el-table-column label="副标题">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.title2 }}</span>
                        </template>
                    </el-table-column>
                    <el-table-column label="封面图">
                        <template slot-scope="scope">
                            <img :src="domain+scope.row.img_url" alt="" width="50px" v-if="scope.row.img_url">
                        </template>
                    </el-table-column>
                    <el-table-column label="简介">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.desc }}</span>
                        </template>
                    </el-table-column>
                    <el-table-column label="排序值">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.sort }}</span>
                        </template>
                    </el-table-column>
                    <el-table-column label="置顶">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.is_top==1?'是':'否' }}</span>
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
                    <el-form-item label="标题">
                        <el-input v-model="form.title"  placeholder="请输入"></el-input>
                        <span style="color: red; font-size: 0.1rem;">换行符号：  / (只对体验产品有效)</span>
                    </el-form-item>
                    <el-form-item label="副标题">
                        <el-input v-model="form.title2"  placeholder="请输入"></el-input>
                        <span style="color: red; font-size: 0.1rem;">换行符号：  / (只对体验产品有效)</span>
                    </el-form-item>
                    <el-form-item label="图片">
                        <el-upload class="avatar-uploader" action="http://up.qiniu.com" :show-file-list="false" :data="{token: upToken}" :accept="'.jpg,.jpeg,.png'" :on-success="handleAvatarSuccess" :before-upload="beforeAvatarUpload">
                            <img v-if="form.img_url" :src="domain+form.img_url" class="avatar"> <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                        </el-upload>
                    </el-form-item>
                    <el-form-item label="简介">
                        <el-input
                                type="textarea"
                                :autosize="{ minRows: 2, maxRows: 4}"
                                placeholder="简介"
                                v-model="form.desc">
                        </el-input>
                    </el-form-item>
                    <el-form-item label="排序" >
                        <el-input-number v-model="form.sort" :min="1" step="10"></el-input-number>
                    </el-form-item>
                    <el-form-item label="体验产品">
                        <el-radio-group v-model="form.is_experience">
                            <el-radio :label="0">否</el-radio>
                            <el-radio :label="1">是</el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="置顶">
                        <el-radio-group v-model="form.is_top">
                            <el-radio :label="0">否</el-radio>
                            <el-radio :label="1">是</el-radio>
                        </el-radio-group>
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
                    is_experience:0,
                    title:'',
                    title2:'',
                    img_url:'',
                    desc:'',
                    sort:10,
                    is_top:0,
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
                this.form.id = this.form.is_experience = this.form.title = this.form.title2 = this.form.img_url = this.form.desc = '';
                this.form.sort = 10;this.shelf_status =1;this.form.is_top = 0;
            },
            handleEdit: function (index, row) {
                let _this = this;
                    _this.form.id = row.id;
                    _this.form.is_experience = parseInt(row.is_experience);
                    _this.form.title = row.title;
                    _this.form.title2 = row.title2;
                    _this.form.img_url = row.img_url;
                    _this.form.desc = row.desc;
                    _this.form.is_top = parseInt(row.is_top);
                    _this.form.sort = row.sort;
                    _this.form.shelf_status = parseInt(row.shelf_status);
            },
            submitForm(){
                let url = '/encms/product/edit',
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
            handleOpreate: function (method,index, row,value) {
                let _this = this;
                _this.$confirm('您确定执行此操作吗, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(function () {
                    Helper.asynRequest('POST', '/encms/product/operate', {method:method,id: row.id,value:value}, function (response) {
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
                Helper.asynRequest('GET', '/encms/product/list', _this.query, function (response) {
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
