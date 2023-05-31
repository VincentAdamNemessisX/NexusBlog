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
                <label class="layui-form-label" for="username">
                    <span class="x-red">*</span>用户名</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="username" lay-verify="required" name="username"
                           required="" type="text"></div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="username">
                    <span class="x-red">*</span>收货人</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="username" lay-verify="required" name="username"
                           required="" type="text"></div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="phone">
                    <span class="x-red">*</span>手机</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="phone" lay-verify="phone" name="phone" required=""
                           type="text"></div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="username">
                    <span class="x-red">*</span>收货地址</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="username" lay-verify="required" name="username"
                           required="" type="text"></div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="username">
                    <span class="x-red">*</span>配送物流</label>
                <div class="layui-input-inline">
                    <select class="valid" id="shipping" name="shipping">
                        <option value="shentong">申通物流</option>
                        <option value="shunfeng">顺丰物流</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="username">
                    <span class="x-red">*</span>支付方式</label>
                <div class="layui-input-inline">
                    <select name="contrller">
                        <option>支付方式</option>
                        <option>支付宝</option>
                        <option>微信</option>
                        <option>货到付款</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_email">
                    <span class="x-red">*</span>发票抬头</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="L_email" lay-verify="email" name="email" required=""
                           type="text"></div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span></div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label" for="desc">商品增加</label>
                <div class="layui-input-block">
                    <table class="layui-table">
                        <tbody>
                        <tr>
                            <td>haier海尔 BC-93TMPF 93升单门冰箱
                </div>
                </td>
                <td>0.01
            </div>
            </td>
            <td>984
    </div>
    </td>
    <td>1</td>
    <td>删除</td>
    </tr>
    <tr>
        <td>haier海尔 BC-93TMPF 93升单门冰箱
</div>
</td>
<td>0.01</div></td>
<td>984</div></td>
<td>1</td>
<td>删除</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="layui-form-item layui-form-text">
    <label class="layui-form-label" for="desc">描述</label>
    <div class="layui-input-block">
        <textarea class="layui-textarea" id="desc" name="desc" placeholder="请输入内容"></textarea>
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label" for="L_repass"></label>
    <button class="layui-btn" lay-filter="add" lay-submit="">增加</button>
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
            nikename: function (value) {
                if (value.length < 5) {
                    return '昵称至少得5个字符啊';
                }
            },
            pass: [/(.+){6,12}$/, '密码必须6到12位'],
            repass: function (value) {
                if ($('#L_pass').val() != $('#L_repass').val()) {
                    return '两次密码不一致';
                }
            }
        });

        //监听提交
        form.on('submit(add)',
            function (data) {
                console.log(data);
                //发异步，把数据提交给php
                layer.alert("增加成功", {
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