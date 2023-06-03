<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>分类列表</title>
    <meta content="webkit" name="renderer">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"
          name="viewport"/>
    <link href="./css/font.css" rel="stylesheet">
    <link href="../css/xadmin.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
    <script charset="utf-8" src="./lib/layui/layui.js"></script>
    <script src="./js/xadmin.js" type="text/javascript"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="x-nav">
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
                    <form class="layui-form layui-col-space5">
                        <div class="layui-input-inline layui-show-xs-block">
                            <input class="layui-input" name="cate_name" placeholder="分类名"></div>
                        <div class="layui-input-inline layui-show-xs-block">
                            <button class="layui-btn" onclick="addCategory()">
                                <i class="layui-icon"></i>增加
                            </button>
                            <script>
                                function addCategory() {
                                    $.ajax({
                                        url: "handle/blog-cate-handle.php",
                                        type: "post",
                                        data: {
                                            action: "add",
                                            name: $("input[name='cate_name']").val(),
                                            showstyle: Math.ceil(Math.random()*4)
                                        },
                                        success: function (data) {
                                            if (data === "success") {
                                                layer.alert("添加成功!", {
                                                    icon: 1
                                                }, function () {
                                                    location.reload();
                                                });
                                                return true;
                                            } else {
                                                layer.alert("添加失败!", {
                                                    icon: 2
                                                });
                                                return false;
                                            }
                                        }
                                    })
                                }
                            </script>
                        </div>
                    </form>
                    <hr>
                </div>
                <div class="layui-card-header">
                </div>
                <div class="layui-card-body">
                    <table class="layui-table layui-form">
                        <tbody class="x-cate">
                        <thead>
                        <tr>
                            <?php
                            include_once "../database/databaseHandle.php";
                            $offset = $_GET['offset'] ?? 0;
                            $limit = 10;
                            $category_rst = queryData('blogtype order by blogtypeid ', "*",
                                "", $offset, $limit);
                            $max_offset = mysqli_num_rows(queryData('blogtype'));
                            $fields = array_keys(mysqli_fetch_array(queryData('blogtype')));
                            foreach ($fields as $field) {
                                switch ($field) {
                                    case "id":
                                        echo "<th>分类ID</th>";
                                        break;
                                    case "name":
                                        echo "<th>分类名称</th>";
                                        break;
                                    case "showstyle":
                                        echo "<th>分类显示样式</th>";
                                        break;
                                }
                            }
                        ?>
                        <th>操作</th>
                        </tr>
                        </thead>
                        <?php
                            while ($record = mysqli_fetch_array($category_rst)) {
                                echo <<<record
                        <tr cate-id='1' fid='0'>
                            <td class="category_id">$record[blogtypeid]</td>
                            <td>
                                <i class="layui-icon" status='true'>$record[name]</i>
                            </td>
                            <td><input class="layui-input x-sort" name="order" style="border: none" type="text" disabled value="$record[showstyle]"></td>
                            <td class="td-manage">
                                <button class="layui-btn layui-btn layui-btn-xs"
                                        onclick=
                                        "xadmin.open('编辑', 'cate-edit.php?typeid=$record[blogtypeid]')">
                                    <i class="layui-icon">&#xe642;</i>编辑
                                </button>
                                <button class="layui-btn-danger layui-btn layui-btn-xs"
                                        href="javascript:;" onclick="cate_del(this,$record[blogtypeid])">
                                    <i class="layui-icon">&#xe640;</i>删除
                                </button>
                            </td>
                        </tr>
record;
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="layui-card-body ">
                    <div class="page">
                        <div style="display: inline">

                            <?php $current_page = ($offset + $limit) > 0 ? ceil(($offset + $limit) / $limit) : 1; ?>

                            <a class="prev" href="blog-cate-list.php?offset=0">&lt;&lt;</a>

                            <a class="next" href="blog-cate-list.php?offset=<?php
                            echo max(($offset + $limit) > 0 ? $offset - $limit : 0, 0);
                            ?>">上一页</a>

                            <a class="num" href=""><?php echo $current_page . "/" . ceil($max_offset / $limit); ?></a>

                            <a class="next" href="blog-cate-list.php?offset=<?php
                            echo max(($offset + $limit) < $max_offset ? ($offset + $limit) : 0, 0); ?>">
                                下一页</a>

                            <a class="next" href="blog-cate-list.php?offset=<?php
                            echo min($max_offset - $offset, $max_offset - $limit) + 1; ?>">&gt;&gt;</a>
                        </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <script>
        layui.use(['form'], function () {
            form = layui.form;

        });

        /*用户-删除*/
        function cate_del(obj, id) {
            layer.confirm('确认要删除此分类及该分类下所有博客以及相关的所有评论吗？', function (index) {
                //发异步删除数据
                $.ajax({
                    type: "post",
                    url: "handle/blog-cate-handle.php",
                    data: {
                        action: "delete",
                        id: id
                    },
                    success: function (data) {
                    if (data === "success") {
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!', {icon: 1, time: 1000});
                    } else {
                        layer.msg('删除失败!', {icon: 2, time: 1000});
                    }
                }
            })
        });
    }

    var cateIds = [];

    function getCateId(cateId) {
        $("tbody tr[fid=" + cateId + "]").each(function (index, el) {
            id = $(el).attr('cate-id');
            cateIds.push(id);
            getCateId(id);
        });
    }

</script>
</body>
</html>
