<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>修改密码</title>
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
    <![endif]--></head>

<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_pass">
                    <span class="x-red">*</span>请输入新密码</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="L_pass" lay-verify="pass" name="pass"
                           required="required"
                           type="password"></div>
                <div class="layui-form-mid layui-word-aux">6到16个字符</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_repass">
                    <span class="x-red">*</span>请确认新密码</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="L_repass" lay-verify="repass" name="repass"
                           required="required" type="password"></div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_repass"></label>
                <button class="layui-btn" lay-filter="add" lay-submit="">修改</button>
            </div>
        </form>
    </div>
</div>
<script>layui.use(['form', 'layer'],
        function () {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            //自定义验证规则
            form.verify({
                pass: [/(.+){6,12}$/, '密码必须6到12位'],
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
                        url: './handle/user-handle.php',
                        type: 'post',
                        dataType: 'text', //返回的数据格式：json/xml/html/script/jsonp/text
                        data: {
                            action: 'edit_password',
                            accountid: <?php echo $_GET['accountid']; ?>,
                            password: data.field.pass,
                        },
                        success: function (data) {
                            if (data === 'success') {
                                layer.alert("修改成功", {
                                        icon: 6
                                    },
                                    function () {
                                        // 获得frame索引
                                        var index = parent.layer.getFrameIndex(window.name);
                                        //关闭当前frame
                                        parent.layer.close(index);
                                    });
                            } else if (data === "failWithSamePassword") {
                                layer.alert("修改失败：新密码与旧密码相同!", {
                                    icon: 5
                                });
                            } else {
                                layer.alert("修改失败：" + data + "!", {
                                        icon: 5
                                    },
                                    function () {
                                        // 获得frame索引
                                        var index = parent.layer.getFrameIndex(window.name);
                                        //关闭当前frame
                                        parent.layer.close(index);
                                    });
                            }
                        }
                    });
                    return false;
                });
        });</script>
</body>
</html>