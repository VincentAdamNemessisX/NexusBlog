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
    <![endif]-->
</head>

<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form action="" class="layui-form layui-form-pane" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label" for="name">
                    <span class="x-red">*</span>角色名
                </label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="name" lay-verify="required" name="name"
                           required="" type="text">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">
                    拥有权限
                </label>
                <table class="layui-table layui-input-block">
                    <tbody>
                    <tr>
                        <td>
                            <input lay-filter="father" lay-skin="primary" name="like1[write]" title="用户管理"
                                   type="checkbox">
                        </td>
                        <td>
                            <div class="layui-input-block">
                                <input lay-skin="primary" name="id[]" title="用户停用" type="checkbox" value="2">
                                <input lay-skin="primary" name="id[]" title="用户删除" type="checkbox" value="2">
                                <input lay-skin="primary" name="id[]" title="用户修改" type="checkbox" value="2">
                                <input lay-skin="primary" name="id[]" title="用户改密" type="checkbox" value="2">
                                <input lay-skin="primary" name="id[]" title="用户列表" type="checkbox" value="2">
                                <input lay-skin="primary" name="id[]" title="用户改密" type="checkbox" value="2">
                                <input lay-skin="primary" name="id[]" title="用户列表" type="checkbox" value="2">
                                <input lay-skin="primary" name="id[]" title="用户改密" type="checkbox" value="2">
                                <input lay-skin="primary" name="id[]" title="用户列表" type="checkbox" value="2">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <input lay-filter="father" lay-skin="primary" name="id[]" title="文章管理" type="checkbox"
                                   value="2">
                        </td>
                        <td>
                            <div class="layui-input-block">
                                <input lay-skin="primary" name="id[]" title="文章添加" type="checkbox" value="2">
                                <input lay-skin="primary" name="id[]" title="文章删除" type="checkbox" value="2">
                                <input lay-skin="primary" name="id[]" title="文章修改" type="checkbox" value="2">
                                <input lay-skin="primary" name="id[]" title="文章改密" type="checkbox" value="2">
                                <input lay-skin="primary" name="id[]" title="文章列表" type="checkbox" value="2">
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label" for="desc">
                    描述
                </label>
                <div class="layui-input-block">
                    <textarea class="layui-textarea" id="desc" name="desc" placeholder="请输入内容"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <button class="layui-btn" lay-filter="add" lay-submit="">增加</button>
            </div>
        </form>
    </div>
</div>
<script>
    layui.use(['form', 'layer'], function () {
        $ = layui.jquery;
        var form = layui.form
            , layer = layui.layer;

        //自定义验证规则
        form.verify({
            nikename: function (value) {
                if (value.length < 5) {
                    return '昵称至少得5个字符啊';
                }
            }
            , pass: [/(.+){6,12}$/, '密码必须6到12位']
            , repass: function (value) {
                if ($('#L_pass').val() != $('#L_repass').val()) {
                    return '两次密码不一致';
                }
            }
        });

        //监听提交
        form.on('submit(add)', function (data) {
            console.log(data);
            //发异步，把数据提交给php
            layer.alert("增加成功", {icon: 6}, function () {
                // 获得frame索引
                var index = parent.layer.getFrameIndex(window.name);
                //关闭当前frame
                parent.layer.close(index);
            });
            return false;
        });


        form.on('checkbox(father)', function (data) {

            if (data.elem.checked) {
                $(data.elem).parent().siblings('td').find('input').prop("checked", true);
                form.render();
            } else {
                $(data.elem).parent().siblings('td').find('input').prop("checked", false);
                form.render();
            }
        });


    });
</script>
<script>var _hmt = _hmt || [];
(function () {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();</script>
</body>

</html>