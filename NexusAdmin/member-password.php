<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.2</title>
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
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--></head>

<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_username">昵称</label>
                <div class="layui-input-inline">
                    <input class="layui-input" disabled="" id="L_username" name="username" type="text" value="小明">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_repass">
                    <span class="x-red">*</span>旧密码</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="L_repass" lay-verify="required" name="oldpass"
                           required="" type="password"></div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_pass">
                    <span class="x-red">*</span>新密码</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="L_pass" lay-verify="required" name="newpass"
                           required="" type="password"></div>
                <div class="layui-form-mid layui-word-aux">6到16个字符</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_repass">
                    <span class="x-red">*</span>确认密码</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="L_repass" lay-verify="required" name="repass"
                           required="" type="password"></div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_repass"></label>
                <button class="layui-btn" lay-filter="save" lay-submit="">增加</button>
            </div>
        </form>
    </div>
</div>
<script>layui.use(['form', 'layer'],
    function () {
        $ = layui.jquery;
        var form = layui.form,
            layer = layui.layer;

        //监听提交
        form.on('submit(save)',
            function (data) {
                console.log(data);
                //发异步，把数据提交给php
                layer.alert("修改成功", {
                        icon: 6
                    },
                    function () {
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前frame
                        parent.layer.close(index);
                    });
                return false;
            });

    });</script>
<script>var _hmt = _hmt || [];
(function () {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();</script>
</body>

</html>