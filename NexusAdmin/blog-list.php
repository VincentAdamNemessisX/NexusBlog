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
    <script src="js/jquery.min.js"></script>
</head>

<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <?php
                        $offset = 0; $limit = 5
                    ?>
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
                                            $ = layui.jquery;
                                            var form = layui.form,
                                                layer = layui.layer;
                                            if (data !== 'fail' && data !== 'none') {
                                                let result = JSON.parse(data);
                                                //console.log(result);
                                                $("#results").empty();
                                                if (result != null && result.length > 0) {
                                                    layer.msg('搜索成功！', {icon: 6});
                                                    $("#no-record").remove();
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
                                                            +item['blogid'] + ")\"" +
                                                            " href=\"javascript:;\">" +
                                                            "<i class=\"layui-icon\">&#xe640;</i>" +
                                                            "</a>" +
                                                            "</td>" +
                                                            "</tr>");
                                                    })
                                                } else {
                                                    layer.msg('未搜索到相关博客！', {icon: 3});
                                                    $("#results").append('<tr><td id="no-record" colSpan="8">无相关博客！</td></tr>');
                                                }
                                            } else {
                                                layer.msg('搜索失败！', {icon: 5});
                                            }
                                        },
                                    })
                                    return false;
                                });
                            });

                            function blogEdit(blogid) {
                                xadmin.open('编辑', 'function/publish_blog/blog_publish.php?action=edit&blogid=' + blogid);
                            }

                            function getData(data) {
                                $ = layui.jquery;
                                var form = layui.form,
                                    layer = layui.layer;
                                $.ajax({
                                    type: 'post',
                                    url: 'handle/blog-handle.php',
                                    data: {
                                        action: 'search',
                                        something: data,
                                    },
                                    success: function (data) {
                                        $ = layui.jquery;
                                        var form = layui.form,
                                            layer = layui.layer;
                                        if (data !== 'fail' && data !== 'none') {
                                            let result = JSON.parse(data);
                                            //console.log(result);
                                            $("#results").empty();
                                            if (result != null && result.length > 0) {
                                                layer.msg('搜索成功！', {icon: 6});
                                                $("#no-record").remove();
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
                                                        +item['blogid'] + ")\"" +
                                                        " href=\"javascript:;\">" +
                                                        "<i class=\"layui-icon\">&#xe640;</i>" +
                                                        "</a>" +
                                                        "</td>" +
                                                        "</tr>");
                                                })
                                            } else {
                                                layer.msg('未搜索到相关博客！', {icon: 3});
                                                $("#results").append('<tr><td id="no-record" colSpan="8">无相关博客！</td></tr>');
                                            }
                                        }else {
                                            layer.msg('搜索失败！', {icon: 5});
                                        }
                                    },
                                })
                            }

                            $(function () {
                                getData('');
                            });
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
                <div class="layui-card-body">
                    <div id="page" class="page">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>

    /*博客-删除*/
    function blog_del(obj, id) {
        layer.confirm('确认要删除该博客及相关评论吗？',
            function (index) {
                //发异步删除数据
                $.ajax({
                    type: 'post',
                    url: 'handle/blog-handle.php',
                    data: {
                        action: 'delete',
                        blogid: id,
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