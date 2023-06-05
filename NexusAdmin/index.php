<?php
session_start();
include_once "../database/databaseHandle.php";
$login_user['user'] = $_SESSION['user'];
$login_user['permission'] = $_SESSION['permission'] ?? 0;
$login_user['status'] = $_SESSION['status'] ?? 2;
$login_user['lastloginip'] = $_SESSION['lastloginip'];
if ($login_user['permission'] < 9 && $login_user['status'] != 1) {
    echo "<script>alert('您没有权限访问该页面，请联系网站管理员或确认登录账户！');
        location.href = '../views/index.php';
    </script>";
}
?>
<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>NexusBlog 后台管理</title>
    <meta content="webkit|ie-comp|ie-stand" name="renderer">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"
          name="viewport"/>
    <meta content="no-siteapp" http-equiv="Cache-Control"/>
    <link href="./css/font.css" rel="stylesheet">
    <link href="../css/xadmin.css" rel="stylesheet">
    <script charset="utf-8" src="./lib/layui/layui.js"></script>
    <script src="./js/xadmin.js" type="text/javascript"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="./js/html5.min.js"></script>
    <script src="./js/respond.min.js"></script>
    <![endif]-->
    <script>
        // 是否开启刷新记忆tab功能
        // var is_remember = false;
    </script>
</head>
<body class="index">
<!-- 顶部开始 -->
<div class="container">
    <div class="logo">
        <a href="index.php">NexusBlog</a></div>
    <div class="left_open">
        <a><i class="iconfont" title="展开左侧栏">&#xe699;</i></a>
    </div>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:">admin</a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a onclick="xadmin.open('个人信息','./')">个人信息</a></dd>
                <dd>
                    <a onclick="xadmin.open('切换帐号','../login.php')">切换帐号</a></dd>
                <dd>
                    <a href="../handle/logout.php">退出</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item to-index">
            <a href="../">前台首页</a></li>
    </ul>
</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:">
                    <i class="iconfont left-nav-li" lay-tips="首页">&#xe696;</i>
                    <cite>首页</cite>
                    <i class="iconfont nav_right">&#xe828;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="$('#home').click()">
                            <i class="iconfont">&#xe6ae;</i>
                            <cite>后台首页</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('<i class=\'iconfont\' style=\'margin-right: 0.5rem; margin-bottom: -0.2rem\'>&#xe6b1;</i>前台首页','../')">
                            <i class="iconfont">&#xe6b1;</i>
                            <cite>前台首页</cite></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:">
                    <i class="iconfont left-nav-li" lay-tips="用户管理">&#xe6b8;</i>
                    <cite>用户管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('<i class=\'iconfont\' style=\'margin-right: 0.5rem; margin-bottom: -0.2rem\'>&#xe6a2;</i>用户列表','user-list.php')">
                            <i class="iconfont">&#xe6a2;</i>
                            <cite>用户列表</cite></a>
                    </li>
                    <!--                    用户权限管理-->
                    <!--                    <li>-->
                    <!--                        <a onclick="xadmin.add_tab('<i class=\'iconfont\' style=\'margin-right: 0.5rem; margin-bottom: -0.2rem\'>&#xe735;</i>权限管理','user-permission-list.php')">-->
                    <!--                            <i class="iconfont">&#xe735;</i>-->
                    <!--                            <cite>权限管理</cite></a>-->
                    <!--                    </li>-->
                </ul>
            </li>
            <li>
                <a href="javascript:">
                    <i class="iconfont left-nav-li" lay-tips="博客管理">&#xe723;</i>
                    <cite>博客管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('<i class=\'iconfont\' style=\'margin-right: 0.5rem; margin-bottom: -0.2rem\'>&#xe6b9;</i>发布博客','./function/publish_blog/blog_publish.php')">
                            <i class="iconfont">&#xe6b9;</i>
                            <cite>发布博客</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('<i class=\'iconfont\' style=\'margin-right: 0.5rem; margin-bottom: -0.2rem\'>&#xe6fa;</i>博客列表','blog-list.php')">
                            <i class="iconfont">&#xe6fa;</i>
                            <cite>博客列表</cite></a>
                    </li>
                </ul>
            </li>
            <li>
                <a onclick="xadmin.add_tab('<i class=\'iconfont\' style=\'margin-right: 0.5rem; margin-bottom: -0.2rem\'>&#xe699;</i>分类列表','blog-cate-list.php')">
                    <i class="iconfont left-nav-li" lay-tips="分类管理">&#xe699;</i>
                    <cite>分类管理</cite></a>
            </li>
            <!--            评论管理-->
            <!--            <li>-->
            <!--                <a href="javascript:">-->
            <!--                    <i class="iconfont left-nav-li" lay-tips="评论管理">&#xe69b;</i>-->
            <!--                    <cite>评论管理</cite>-->
            <!--                    <i class="iconfont nav_right">&#xe697;</i></a>-->
            <!--                <ul class="sub-menu">-->
            <!--                    <li>-->
            <!--                        <a onclick="xadmin.add_tab('<i class=\'iconfont\' style=\'margin-right: 0.5rem; margin-bottom: -0.2rem\'>&#xe6b5;</i>评论列表','comment-list.php')">-->
            <!--                            <i class="iconfont">&#xe6b5;</i>-->
            <!--                            <cite>评论列表</cite></a>-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <a onclick="xadmin.add_tab('<i class=\'iconfont\' style=\'margin-right: 0.5rem; margin-bottom: -0.2rem\'>&#xe723;</i>评论审核','comment-check.php')">-->
            <!--                            <i class="iconfont">&#xe723;</i>-->
            <!--                            <cite>评论审核</cite></a>-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--            </li>-->
            <!--            数据分析-->
            <!--            <li>-->
        </ul>
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">
    <div class="layui-tab tab" lay-allowclose="false" lay-filter="xbs_tab">
        <ul class="layui-tab-title">
            <li id="home" class="home">
                <i class='iconfont' style='margin-right: 0.5rem; margin-bottom: -0.2rem'>&#xe6ae;</i>首页
            </li>
        </ul>
        <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
            <dl>
                <dd data-type="this">关闭当前</dd>
                <dd data-type="other">关闭其它</dd>
                <dd data-type="all">关闭全部</dd>
            </dl>
        </div>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe class="x-iframe" frameborder="0" scrolling="yes" src='home.php'></iframe>
            </div>
        </div>
        <div id="tab_show"></div>
    </div>
</div>
<div class="page-content-bg"></div>
<style id="theme_style"></style>
<!-- 右侧主体结束 -->
<!-- 中部结束 -->
</body>
</html>