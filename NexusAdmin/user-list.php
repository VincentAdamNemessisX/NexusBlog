<?php
session_start();
include_once "../database/databaseHandle.php";
?>
<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>用户列表</title>
    <meta content="webkit" name="renderer">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"
          name="viewport"/>
    <link href="./css/font.css" rel="stylesheet">
    <link href="../css/xadmin.css" rel="stylesheet">
    <script charset="utf-8" src="./lib/layui/layui.js"></script>
    <script src="./js/xadmin.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script src="./js/html5.min.js"></script>
    <script src="./js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="x-nav">
    <a class="layui-btn layui-btn-small" onclick="location.reload()"
       style="line-height:1.6em;margin-top:3px;float:right" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body">
                    <form class="layui-form layui-col-space5">
                        <div class="layui-inline layui-show-xs-block">
                            <input autocomplete="off" class="layui-input" id="searchcontent"
                                   placeholder="请输入用户名或昵称或邮箱" type="text">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <button type="button" class="layui-btn" onclick="search()"><i
                                        class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>
                <div class="layui-card-header">
                    <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除
                    </button>
                    <button class="layui-btn" onclick="xadmin.open('添加用户','./user-add.php',600,400)"><i
                                class="layui-icon"></i>添加
                    </button>
                </div>
                <div class="layui-card-body layui-table-body layui-table-main">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>
                                <input lay-filter="checkall" lay-skin="primary" name="" type="checkbox">
                            </th>
                            <th>ID</th>
                            <th>用户名</th>
                            <th>邮箱</th>
                            <th>头像</th>
                            <th>状态</th>
                            <th>昵称</th>
                            <th>性别</th>
                            <th>城市</th>
                            <th>技能</th>
                            <th>简介</th>
                            <th>个性签名</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody id="results">
                        <?php
                        $accounts = queryData("accounts", '*', 'status <> -1');
                        while ($account = mysqli_fetch_array($accounts)) {
                            $accountstatus = $account['status'] == 1 ?
                                "<span class=\"layui-btn layui-btn-normal layui-btn-mini\">正常</span>"
                                : "<span class=\"layui-btn layui-btn-normal layui-btn-disabled layui-btn-mini\">已冻结</span>";
                            $accountmanageprompt = $account['status'] == 1 ? '冻结' : '解冻';
                            $nickname = $account['nickname'] == null ? '未填写' : $account['nickname'];
                            $gender = $account['gender'] == null ? '未知' : $account['gender'];
                            $city = $account['city'] == null ? '未知' : $account['city'];
                            $skill = $account['skill'] == null ? '未知' : $account['skill'];
                            $description = $account['description'] == null ? '未知' : $account['description'];
                            $bio = $account['bio'] == null ? '未知' : $account['bio'];
                            echo <<<item
                        <tr>
                            <td>
                                <input lay-skin="primary" name="id" type="checkbox" value="$account[accountid]">
                            </td>
                            <td>$account[accountid]</td>
                            <td>$account[username]</td>
                            <td>$account[email]</td>
                            <td><img alt="头像" src="$account[headPortrait]"></td>
                            <td class="td-status">$accountstatus</td>
                            <td>$nickname</td>
                            <td>$gender</td>
                            <td>$city</td>
                            <td>$skill</td>
                            <td>$description</td>
                            <td>$bio</td>
                            <td class="td-manage">
                                <a id="freeze" href="javascript:" 
                                onclick="member_freeze(this,'$account[accountid]')" title="$accountmanageprompt">
                                    <i class="layui-icon">&#xe601;</i>
                                </a>
                                <a href="javascript:" 
                                onclick="xadmin.open('编辑','user-edit.php?accountid=$account[accountid]',600,400)"
                                   title="编辑">
                                    <i class="layui-icon">&#xe642;</i>
                                </a>
                                <a href="javascript:" 
                                onclick="xadmin.open('修改密码','user-edit-password.php?accountid=$account[accountid]',600,400)"
                                   title="修改密码">
                                    <i class="layui-icon">&#xe631;</i>
                                </a>
                                <a href="javascript:" onclick="member_del(this,'$account[accountid]')" title="删除">
                                    <i class="layui-icon">&#xe640;</i>
                                </a>
                            </td>
                        </tr>
item;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="layui-card-body "></div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    layui.use(['laydate', 'form'], function () {
        var laydate = layui.laydate;
        var form = layui.form;


        // 监听全选
        form.on('checkbox(checkall)', function (data) {

            if (data.elem.checked) {
                $('tbody input').prop('checked', true);
            } else {
                $('tbody input').prop('checked', false);
            }
            form.render('checkbox');
        });
    });

    /*用户-冻结*/
    function member_freeze(obj, id) {
        layer.confirm('确认要' + $(obj).attr('title') + '吗？', function (index) {
            if ($(obj).attr('title') === "冻结") {
                //发异步更改用户状态
                $.ajax({
                    type: 'post',
                    url: './handle/user-handle.php',
                    data: {
                        'action': 'freeze',
                        'accountid': id
                    },
                    success: function (data) {
                        if (data === 'success') {
                            $(obj).attr('title', '解冻')
                            $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已冻结');
                            layer.msg('已冻结!', {icon: 5, time: 1000});
                        } else {
                            layer.msg('冻结失败!', {icon: 5, time: 1000});
                        }
                    }
                })
            } else {
                //发异步更改用户状态
                $.ajax({
                    type: 'post',
                    url: './handle/user-handle.php',
                    data: {
                        action: 'unfreeze',
                        accountid: id
                    },
                    success: function (data) {
                        if (data === 'success') {
                            $(obj).attr('title', '冻结')
                            $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('正常');
                            layer.msg('已解除冻结!', {icon: 6, time: 1000});
                        } else {
                            layer.msg('解冻失败!', {icon: 5, time: 1000});
                        }
                    }
                })
            }
        });
    }

    /*用户-删除*/
    function member_del(obj, id) {
        layer.confirm('真的确认要删除吗？', function (index) {
            layer.confirm('删除无法恢复，是否继续？', function () {
                //发异步删除数据
                $.ajax({
                    type: 'post',
                    url: './handle/user-handle.php',
                    data: {
                        action: 'delete',
                        accountid: id
                    },
                    success: function (data) {
                        if (data === 'success') {
                            $(obj).parents("tr").remove();
                            layer.msg('已删除!', {icon: 1, time: 1000});
                        } else {
                            layer.msg('删除失败!', {icon: 2, time: 1000});
                        }
                    }
                });
            });
        });
    }


    function delAll(argument) {
        var ids = [];
        if (ids.length === 0) {
            layer.msg('请选择要删除的数据', {icon: 2, time: 1000});
            return;
        }
        // 获取选中的id 
        $('tbody input').each(function (index, el) {
            if ($(this).prop('checked')) {
                ids.push($(this).val())
            }
        });

        layer.confirm('真的确认要删除吗？' + ids.toString(), function (index) {
            layer.confirm('删除操作无法恢复，是否继续？', function () {
                //捕捉到所有被选中的，发异步进行删除
                $.ajax({
                    type: 'post',
                    url: './handle/user-handle.php',
                    data: {
                        action: 'delete_all',
                        accountids: ids
                    },
                    success: function (data) {
                        if (data === 'success') {
                            layer.msg('删除成功', {icon: 1});
                            $(".layui-form-checked").not('.header').parents('tr').remove();
                        } else {
                            layer.msg('删除失败', {icon: 2});
                        }
                    }
                });
            });
        });
    }

    function search() {
        $ = layui.jquery;
        var search = $('#searchcontent').val();
        if (search === '') {
            layer.msg('请输入搜索内容', {icon: 2});
        } else {
            $.ajax({
                type: 'post',
                url: './handle/user-handle.php',
                data: {
                    action: 'search',
                    search: search
                },
                success: function (data) {
                    if (data === 'fail') {
                        layer.msg('搜索失败', {icon: 2});
                    } else {
                        layer.msg('搜索成功！', {icon: 1});
                        let result = JSON.parse(data);
                        $("#results").empty();
                        if (result != null && result.length > 0) {
                            result.forEach((item) => {
                                $('#results').append(
                                    "<tr>" +
                                    "<td>" +
                                    "<input lay-skin=\"primary\" name=\"id\" type=\"checkbox\" value=\"" + item['accountid'] + "\">" +
                                    "</td>" +
                                    "<td>" + item['accountid'] + "</td>" +
                                    "<td>" + item['username'] + "</td>" +
                                    "<td>" + item['email'] + "</td>" +
                                    "<td><img alt=\"头像\" src=\"" + item['headPortrait'] + "\"></td>" +
                                    "<td class=\"td-status\">" + item['status'] + "</td>" +
                                    "<td>" + item['nickname'] + "</td>" +
                                    "<td>" + item['gender'] + "</td>" +
                                    "<td>" + item['city'] + "</td>" +
                                    "<td>" + item['skill'] + "</td>" +
                                    "<td>" + item['description'] + "</td>" +
                                    "<td>" + item['bio'] + "</td>" +
                                    "<td class=\"td-manage\">" +
                                    "<a id=\"freeze\" href=\"javascript:\"" +
                                    "onclick=\"member_freeze(this,'" + item['accountid'] + "')\" title=\"" + item['manageprompt'] + "\">" +
                                    "<i class=\"layui-icon\">&#xe601;</i>" +
                                    "</a>" +
                                    "<a href=\"javascript:\"" +
                                    "onclick=\"xadmin.open('编辑','user-edit.php?accountid=" + item['accountid'] + "',600,400)\"" +
                                    "title=\"编辑\">" +
                                    "<i class=\"layui-icon\">&#xe642;</i>" +
                                    "</a>" +
                                    "<a href=\"javascript:\"" +
                                    "onclick=\"xadmin.open('修改密码','user-edit-password.php?accountid=" + item['accountid'] + "',600,400)\"" +
                                    "title=\"修改密码\">" +
                                    "<i class=\"layui-icon\">&#xe631;</i>" +
                                    "</a>" +
                                    "<a href=\"javascript:\" onclick=\"member_del(this,'" + item['accountid'] + "')\" title=\"删除\">" +
                                    "<i class=\"layui-icon\">&#xe640;</i>" +
                                    "</a>" +
                                    "</td>" +
                                    "</tr>"
                                );
                            });
                        } else {
                            $("#results").empty();
                            $("#results").append(
                                "<tr>" +
                                "<td colspan=\"13\" style=\"text-align: center\">未查询到数据！</td>" +
                                "</tr>"
                            );
                        }
                    }
                }
            });
        }
    }
</script>
</html>