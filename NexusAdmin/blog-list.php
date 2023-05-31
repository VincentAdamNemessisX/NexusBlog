<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>博客列表</title>
    <meta content="webkit" name="renderer">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"
          name="viewport"/>
    <link href="./css/font.css" rel="stylesheet">
    <link href="../css/xadmin.css" rel="stylesheet">
    <link rel="stylesheet" href="css/customstyle.css">
    <script charset="utf-8" src="./lib/layui/layui.js"></script>
    <script src="./js/xadmin.js" type="text/javascript"></script>
</head>

<body>
    <a class="layui-btn layui-btn-small" onclick="location.reload()"
       style="line-height:1.6em;margin-top:3px;float:right" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
    </a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form id="sb-form" class="layui-form layui-col-space5">
                        <div class="layui-input-inline layui-show-xs-block">
                            <input class="layui-input" id="title" name="title" placeholder="文章标题或内容" required></div>
                        <div class="layui-input-inline layui-show-xs-block">
                            <button id="search" class="layui-btn" lay-filter="search" lay-submit=""
                                    onload="document.forms[0].submit()">
                                <i class="layui-icon">&#xe615;</i></button>
                        </div>
                        <script>
                            layui.use(['form', 'layer'], function () {
                                $ = layui.jquery;
                                var form = layui.form,
                                    layer = layui.layer;

                                //监听提交
                                form.on('submit(search)', function (data) {
                                    //发异步，把数据提交给php
                                    $.ajax({
                                        type: 'post',
                                        url: 'handle/blog-handle.php',
                                        data: {
                                            action: 'search',
                                            something: data.field.title,
                                        },
                                        success: function (data) {
                                            if (data !== 'fail' && data !== 'none') {
                                                layer.msg('搜索成功！', {icon: 6});
                                                let result = JSON.parse(data);
                                                $("#results").empty();
                                                result.forEach((item) => {
                                                    $("#results").append("<tr>" +
                                                        "<td>" + item['blogid'] + "</td>" +
                                                        "<td>" + item['title'] + "</td>" +
                                                        "<td>" + item['type'] + "</td>" +
                                                        "<td>" + item['author'] + "</td>" +
                                                        "<td>" + item['publishTime'] + "</td>" +
                                                        "<td>" + item['readTimes'] + "</td>" +
                                                        "<td>" + item['blogshowstyle'] + "</td>" +
                                                        "<td class='td-manage'>" +
                                                           "<a title='编辑'  " +
                                                        "onclick=\"blogEdit(" +
                                                        item['blogid'] + ")\"" +
                                                            " href='javascript:;'>" +
                                                                "<i class=\"layui-icon\">&#xe642;</i>" +
                                                            "</a>" +
                                                            "<a title=\"删除\" " +
                                                        "onclick=\"blog_del(this, " +
                                                        + item['blogid'] + ")\"" +
                                                        " href=\"javascript:;\">" +
                                                            "<i class=\"layui-icon\">&#xe640;</i>" +
                                                            "</a>" +
                                                        "</td>" +
                                                        "</tr>");
                                                })
                                            } else if (data === null || data === 'none') {
                                                layer.msg('未搜索到相关博客！', {icon: 3});
                                                $(`#results`).empty();
                                                $("#results").append('<tr><td id="no-record" colSpan="8">无相关博客！</td></tr>');
                                            } else {
                                                layer.msg('搜索失败！', {icon: 5});
                                            }
                                        },
                                    })
                                    return false;
                                });
                            });

                            function blogEdit(blogid) {
                                xadmin.open('编辑','blog-edit.php?id=' + blogid);
                            }
                        </script>
                    </form>
                </div>
                <div class="layui-card-body">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>博客ID</th>
                            <th>标题</th>
                            <th>分类</th>
                            <th>作者</th>
                            <th>发布时间</th>
                            <th>浏览量</th>
                            <th>显示方式</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody id="results"></tbody>
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
                            <a class="next" href="">&gt;&gt;</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>layui.use(['laydate', 'form'],
    function () {
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
function blog_del(obj, id) {
    layer.confirm('确认要删除该博客及相关评论吗？',
        function (index) {
            //发异步删除数据
            $.ajax({
                type: 'post',
                url: 'handle/blog-handle.php',
                data: {
                    action: 'delete',
                    id: id,
                },
                success: function (data) {
                    if (data === 'success') {
                        layer.msg('已删除!', {
                            icon: 1,
                            time: 1000
                        });
                        $(obj).parents("tr").remove();
                    } else {
                        layer.msg('删除失败！', {
                            icon: 5,
                            time: 1000
                        });
                    }
                },
            })
        });
}
</script>

</html>