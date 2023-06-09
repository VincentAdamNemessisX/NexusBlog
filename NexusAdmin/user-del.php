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
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" onclick="location.reload()"
       style="line-height:1.6em;margin-top:3px;float:right" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5">
                        <div class="layui-inline layui-show-xs-block">
                            <input autocomplete="off" class="layui-input" id="start" name="start" placeholder="开始日">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input autocomplete="off" class="layui-input" id="end" name="end" placeholder="截止日">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input autocomplete="off" class="layui-input" name="username" placeholder="请输入用户名"
                                   type="text">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <button class="layui-btn" lay-filter="sreach" lay-submit=""><i
                                        class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>
                <div class="layui-card-header">
                    <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量恢复
                    </button>
                </div>
                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>
                                <input lay-skin="primary" name="" type="checkbox">
                            </th>
                            <th>ID</th>
                            <th>用户名</th>
                            <th>性别</th>
                            <th>手机</th>
                            <th>邮箱</th>
                            <th>地址</th>
                            <th>加入时间</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <input lay-skin="primary" name="" type="checkbox">
                            </td>
                            <td>1</td>
                            <td>小明</td>
                            <td>男</td>
                            <td>13000000000</td>
                            <td>admin@mail.com</td>
                            <td>北京市 海淀区</td>
                            <td>2017-01-01 11:11:42</td>
                            <td class="td-status">
                                <span class="layui-btn layui-btn-danger layui-btn-mini">
                                                  已删除
                                              </span>
                            <td class="td-manage">
                                <a href="javascript:" onclick="member_del(this,'要删除的id')" title="恢复">
                                    <i class="layui-icon">&#xe669;</i>
                                </a>
                                <a href="javascript:" onclick="member_del(this,'要删除的id')" title="删除">
                                    <i class="layui-icon">&#xe640;</i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input lay-skin="primary" name="" type="checkbox">
                            </td>
                            <td>1</td>
                            <td>小明</td>
                            <td>男</td>
                            <td>13000000000</td>
                            <td>admin@mail.com</td>
                            <td>北京市 海淀区</td>
                            <td>2017-01-01 11:11:42</td>
                            <td class="td-status">
                                <span class="layui-btn layui-btn-danger layui-btn-mini">
                                                  已删除
                                              </span>
                            <td class="td-manage">
                                <a href="javascript:" onclick="member_del(this,'要删除的id')" title="恢复">
                                    <i class="layui-icon">&#xe669;</i>
                                </a>
                                <a href="javascript:" onclick="member_del(this,'要删除的id')" title="删除">
                                    <i class="layui-icon">&#xe640;</i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="layui-card-body ">
                    <div class="page">
                        <div>
                            <a class="prev" href="">&lt;&lt;</a>
                            <a class="num" href="">1</a>
                            <span class="current">2</span>
                            <a class="num" href="">3</a>
                            <a class="num" href="">489</a>
                            <a class="next" href="">&gt;&gt;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    layui.use(['laydate', 'form'], function () {
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });


    /*用户-删除*/
    function member_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            //发异步删除数据
            $(obj).parents("tr").remove();
            layer.msg('已删除!', {icon: 1, time: 1000});
        });
    }


    function delAll(argument) {

        var data = tableCheck.getData();

        layer.confirm('确认要恢复吗？' + data, function (index) {
            //捉到所有被选中的，发异步进行删除
            layer.msg('恢复成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
    }
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