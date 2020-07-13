var ueditor = {
    template: '<div>\n' +
    '    <div :id="id" type="text/plain"></div>\n' +
    '    <el-dialog\n' +
    '      title="上传图片"\n' +
    '      :visible.sync="dialogVisible">\n' +
    '      <el-upload\n' +
    '        class="avatar-uploader"\n' +
    '        action="/file/upload"\n' +
    '        :show-file-list="false"\n' +
    '        :on-success="handleAvatarSuccess">\n' +
    '        <img v-if="imageUrl" :src="imageUrl" class="avatar">\n' +
    '        <i v-else class="el-icon-plus avatar-uploader-icon"></i>\n' +
    '      </el-upload>\n' +
    '      <span slot="footer" class="dialog-footer">\n' +
    '    <el-button @click="dialogVisible = false">取 消</el-button>\n' +
    '    <el-button type="success" @click="submitImage">确 定</el-button>\n' +
    '  </span>\n' +
    '    </el-dialog>\n' +
    '\n' +
    '  </div>',
    data () {
        return {
            editor: null,
            imageUrl: '',
            dialogVisible: false
        }
    },
    props: {
        defaultMsg: {
            type: String
        },
        config: {
            type: Object
        },
        id: {
            type: String
        }
    },
    mounted() {
        let _this = this;

        this.editor = UE.getEditor(this.id, this.config); // 初始化UE
        // this.editor.addListener("ready", function () {
        //     _this.editor.setContent(_this.defaultMsg); // 确保UE加载完成后，放入内容。
        // });
        // UE.registerUI('button', function (editor, uiName) {
        //     //注册按钮执行时的command命令，使用命令默认就会带有回退操作
        //     editor.registerCommand(uiName, {
        //         execCommand: function () {
        //             console.log(_this.editor);
        //             _this.dialogVisible = true;
        //         }
        //     });
        //     //创建一个button
        //     var btn = new UE.ui.Button({
        //         //按钮的名字
        //         name: uiName,
        //         //提示
        //         title: '图片上传',
        //         //添加额外样式，指定icon图标，这里默认使用一个重复的icon
        //         cssRules: 'background-position: -380px 0;',
        //         //点击时执行的命令
        //         onclick: function () {
        //             //这里可以不用执行命令,做你自己的操作也可
        //             editor.execCommand(uiName);
        //         }
        //     });
        //     //当点到编辑内容上时，按钮要做的状态反射
        //     editor.addListener('selectionchange', function () {
        //         var state = editor.queryCommandState(uiName);
        //         if (state == -1) {
        //             btn.setDisabled(true);
        //             btn.setChecked(false);
        //         } else {
        //             btn.setDisabled(false);
        //             btn.setChecked(state);
        //         }
        //     });
        //     //因为你是添加button,所以需要返回这个button
        //     return btn;
        // });
    },
    deactivated () {
        this.$destroy()
    },
    methods: {
        getUEContent() { // 获取内容方法
            return this.editor.getContent()
        },
        setContent(content) {
            let _this = this;
            this.editor.ready(function() {
                _this.editor.setContent(content);
            });
        },
        handleAvatarSuccess(res, file) {
            this.imageUrl = res.url;
        },
        submitImage(){
//        this.editor.execCommand('inserthtml', '<img src="' + this.imageUrl + '" alt="">');
            console.log(this.editor);
            this.editor.execCommand('insertimage', { src: this.imageUrl});
            this.imageUrl = '';
            this.dialogVisible = false;
        }
    },
    destroyed() {
        this.editor.destroy();
    }
}