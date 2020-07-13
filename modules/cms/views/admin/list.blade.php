@extends('layouts.cms.main')

@section('title')@stop

@section('content')
    <div id="content">
        <div class="filter-container">
            <el-input @keyup.enter.native="handleFilter" style="width: 200px;" class="filter-item" placeholder="用户名"
                      v-model="query.search">
            </el-input>

            <el-button class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter" size="medium">搜索
            </el-button>
{{--            <el-button class="filter-item" style="margin-left: 10px;" @click="handleCreate" type="primary"--}}
{{--                       icon="el-icon-plus" size="medium">添加--}}
{{--            </el-button>--}}
        </div>
        <el-row :gutter="20" >
            <el-col :span="16">
                <el-table
                        :data="tableData"
                        border
                        style="width: 100%">
                    <el-table-column label="用户名">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.username }}</span>
                        </template>
                    </el-table-column>
                    <el-table-column label="角色">
                        <template slot-scope="scope">
                            <span v-if="scope.row.role === '0'">超级管理员</span>
                            <span v-if="scope.row.role >= '1'">子账户</span>
                        </template>
                    </el-table-column>
                    <el-table-column label="创建时间">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.create_time }}</span>
                        </template>
                    </el-table-column>

                    <el-table-column label="操作">
                        <template slot-scope="scope">
{{--                            <template v-if="scope.row.role === 2">--}}
{{--                                <el-button--}}
{{--                                        size="mini"--}}
{{--                                        @click="handleMethod('down', scope.row)"--}}
{{--                                        v-if="scope.row.disable_status === 0">禁用--}}
{{--                                </el-button>--}}
{{--                                <el-button--}}
{{--                                        size="mini"--}}
{{--                                        @click="handleMethod('up', scope.row)"--}}
{{--                                        v-if="scope.row.disable_status === 1">启用--}}
{{--                                </el-button>--}}
{{--                            </template>--}}
                            <el-button
                                    size="mini"
                                    type="warning"
                                    @click="handleEdit(scope.$index, scope.row)">编辑
                            </el-button>
{{--                            <el-button--}}
{{--                                    size="mini"--}}
{{--                                    type="danger"--}}
{{--                                    @click="handleMethod('delete', scope.row)" v-if="scope.row.id > 1">删除--}}
{{--                            </el-button>--}}
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
                <el-form ref="form" :model="form" label-width="90px" style="margin-top: 20px">
                    <el-form-item label="用户名">
                        <el-input v-model="form.username" :disabled="true"></el-input>
                    </el-form-item>
                    <el-form-item label="新密码">
                        <el-input type="password" v-model="form.password" show-password></el-input>不修改设为空
                    </el-form-item>
{{--                    <el-form-item label="角色">--}}
{{--                        <el-select v-model="form.role" placeholder="请选择" class="w100">--}}
{{--                            <el-option :label="item.label" :value="item.role" v-for="item in roles"></el-option>--}}
{{--                        </el-select>--}}
{{--                    </el-form-item>--}}
                    <el-form-item>
                        <el-button type="primary" @click="onSubmit">立即提交</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
    </div>
@stop

@section('plugin-style')
@stop

@section('foot-script')
    <script>
        new Vue({
            el: '#app',
            mounted: function () {
                this.request();
            },
            data: function () {
                return {
                    total: 0,
                    tableData: [],
                    agency:[],
                    query: {
                        page: 1,
                        size: 10,
                        search: ''
                    },
                    roles: [{label: '超级管理员', role: '0'}, {label: '子账户', role: '1'}],
                    checkAll: false,
                    form: {
                        id: '',
                        username: '',
                        password: '',
                        role: '',
                        agency_id:'',
                        permission: []
                    }
                }
            },
            methods: {
                handleCreate: function () {
                    this.form.id=this.form.username=this.form.password=this.form.role=this.agency_id='';
                    this.form.precision=[];
                },
                handleEdit: function (index, row) {
                    this.form.id = row.id;
                    this.form.username = row.username;
                    this.form.role = row.role;
                    this.form.agency_id = row.agency_id+'';
                    this.form.permission = row.permission;
                },
                handleMethod (method, row) {
                    this.$confirm('确定执行此操作吗?', '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(() => {
                        axios.post('/cms/admin/method', {
                            id: row.id,
                            method: method
                        }).then(response => {
                            if (response.data.code === 200) {
                                this.$message({
                                    type: 'success',
                                    message: '操作成功!',
                                    duration: 1000,
                                    onClose: ()=> {
                                        this.request();
                                    }
                                })
                            } else {
                                this.$message({
                                    type: 'warning',
                                    message: response.data.message,
                                    duration: 1500
                                })
                            }
                        }).catch(() => {
                            this.$message.error('系统异常')
                        })
                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: '已取消删除'
                        });
                    });

                },

                handleCheckAllChange(val){
                    this.form.permission = val ? this.permissions.map(item => item.value) : []
                    this.isIndeterminate = false
                },
                handleCheckedChange(value){
                    let checkedCount = value.length
                    this.checkAll = checkedCount === this.permissions.length
                    this.isIndeterminate = checkedCount > 0 && checkedCount < this.permissions.length
                },
                onSubmit: function () {
                    let url = this.form.id ? '/cms/admin/edit' : '/cms/admin/create';
                    let _this =this;
                    if( !_this.form.id && !_this.form.password){
                        this.$message.error('创建用户需要设置密码'); return;
                    }
                    Helper.asynRequest('POST', url, _this.form, function (response) {
                        if( response.code ==200 ){
                            _this.$message({
                                type: 'success',
                                message: '修改成功！!'
                            });
                        }
                    }, function () {
                        _this.$message({
                            type: 'error',
                            message: '系统错误!'
                        });
                    });
                },
                handleSizeChange: function (val) {
                    this.query.size = val;
                    this.request()
                },
                handleCurrentChange: function (val) {
                    this.query.page = val;
                    this.request()
                },
                handleFilter: function () {
                    this.request()
                },
                request: function () {
                    let _this = this;
                    Helper.asynRequest('GET', '/cms/admin/list', _this.query, function (response) {
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
        })
    </script>
@stop
