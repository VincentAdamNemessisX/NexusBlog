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
    <!-- <link rel="stylesheet" href="./css/theme5.css"> -->
    <script charset="utf-8" src="./lib/layui/layui.js"></script>
    <script src="./js/xadmin.js" type="text/javascript"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
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
    <!--            <ul class="layui-nav left fast-add" lay-filter="">-->
    <!--                <li class="layui-nav-item">-->
    <!--                    <a href="javascript:;">+新增</a>-->
    <!--                    <dl class="layui-nav-child">-->
    <!--                        &lt;!&ndash; 二级菜单 &ndash;&gt;-->
    <!--                        <dd>-->
    <!--                            <a onclick="xadmin.open('最大化','','','',true)">-->
    <!--                                <i class="iconfont">&#xe6a2;</i>弹出最大化</a></dd>-->
    <!--                        <dd>-->
    <!--                            <a onclick="xadmin.open('弹出自动宽高','')">-->
    <!--                                <i class="iconfont">&#xe6a8;</i>弹出自动宽高</a></dd>-->
    <!--                        <dd>-->
    <!--                            <a onclick="xadmin.open('弹出指定宽高','',500,300)">-->
    <!--                                <i class="iconfont">&#xe6a8;</i>弹出指定宽高</a></dd>-->
    <!--                        <dd>-->
    <!--                            <a onclick="xadmin.add_tab('在tab打开','')">-->
    <!--                                <i class="iconfont">&#xe6b8;</i>在tab打开</a></dd>-->
    <!--                        <dd>-->
    <!--                            <a onclick="xadmin.add_tab('在tab打开刷新','',true)">-->
    <!--                                <i class="iconfont">&#xe6b8;</i>在tab打开刷新</a></dd>-->
    <!--                    </dl>-->
    <!--                </li>-->
    <!--            </ul>-->
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
                    <a href="../../handle/logout.php">退出</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item to-index">
            <a href="../../">前台首页</a></li>
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
                    <i class="iconfont left-nav-li" lay-tips="用户管理">&#xe6b8;</i>
                    <cite>用户管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('用户列表','member-list.php')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>用户列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('会员删除','member-del.php')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>删除用户</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('权限管理','member-list1.php')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>权限管理</cite></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:">
                    <i class="iconfont left-nav-li" lay-tips="文章管理">&#xe723;</i>
                    <cite>博客管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('文章列表','blog-list.php')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>博客列表</cite></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:">
                    <i class="iconfont left-nav-li" lay-tips="分类管理">&#xe723;</i>
                    <cite>分类管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('分类列表','blog-cate.php')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>分类列表</cite></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">
    <div class="layui-tab tab" lay-allowclose="false" lay-filter="xbs_tab">
        <ul class="layui-tab-title">
            <li class="home">
                <i class="layui-icon">&#xe68e;</i>首页
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
                <iframe class="x-iframe" frameborder="0" scrolling="yes" src='welcome.php'></iframe>
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