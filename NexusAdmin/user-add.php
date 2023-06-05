<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta content="webkit" name="renderer">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"
          name="viewport"/>
    <link href="./css/font.css" rel="stylesheet">
    <link href="../css/xadmin.css" rel="stylesheet">
    <script charset="utf-8" src="./lib/layui/layui.js" type="text/javascript"></script>
    <script src="./js/xadmin.js" type="text/javascript"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="./js/html5.min.js"></script>
    <script src="./js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_username">
                    <span class="x-red">*</span>用户名</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="L_username" lay-verify="username" name="username"
                           required="" type="text"></div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>将会成为您唯一的登入名
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_email">
                    <span class="x-red">*</span>邮箱</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="L_email" lay-verify="email" name="email"
                           required=""
                           type="text"></div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_pass">
                    <span class="x-red">*</span>密码</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="L_pass" lay-verify="password"
                           name="password" required=""
                           type="password"></div>
                <div class="layui-form-mid layui-word-aux">6到16个字符</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_repass">
                    <span class="x-red">*</span>确认密码</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="L_repass" lay-verify="repass" name="repass"
                           required="" type="password"></div>
            </div>
            <div class="layui-form-item">
                <input type="hidden" name="action" value="add">
                <label class="layui-form-label" for="L_repass"></label>
                <button class="layui-btn" lay-filter="add" lay-submit="">添加</button>
            </div>
        </form>
    </div>
</div>
<script>
    layui.use(['form', 'layer', 'jquery'],
        function () {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            //自定义验证规则
            form.verify({
                username: function (value) {
                    if (value.length < 3) {
                        return '用户名至少3个字符';
                    }
                },
                email: function (value) {
                    if (value.length < 1) {
                        return '邮箱不能为空';
                    }
                    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                    if (!regex.test(value)) {
                        return '请输入正确的邮箱格式';
                    }
                },
                password: [/(.+){6,12}$/, '密码必须6到12位'],
                repass: function (value) {
                    if ($('#L_pass').val() !== $('#L_repass').val()) {
                        return '两次密码不一致';
                    }
                }
            });

            //监听提交
            form.on('submit(add)',
                function (data) {
                    //发异步，把数据提交给php
                    $.ajax({
                        url: 'handle/user-handle.php',
                        type: 'post',
                        dataType: 'text',
                        data: data.field,
                        success: function (data) {
                            if (data === "success") {
                                layer.alert("添加成功！", {
                                        icon: 6
                                    },
                                    function () {
                                        //关闭当前frame
                                        xadmin.close();

                                        // 可以对父窗口进行刷新finished
                                        xadmin.father_reload();
                                    });
                            } else {
                                layer.alert("添加失败:" + data + "!", {icon: 5})
                            }
                        }
                    })
                    return false;
                });

        });
</script>
</body>

</html>