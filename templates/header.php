<?php
session_start();
include_once '../database/databaseHandle.php';
$loginstatus = isset($_SESSION['user']);
$rst = queryData('blogtype');
$types = [];
while ($row = mysqli_fetch_array($rst)) {
    $types[] = $row;
}
// session 数组存储和使用方法与 php 数组有区别，所以需要转换且 session 数组不能使用 session[]来存储
$_SESSION['types'] = $types;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <title>
        <?php
            if(isset($_SESSION['tabtitle']) && $_SESSION['tabtitle'] != '')
                echo $_SESSION['tabtitle'];
            else
                echo 'NexusBlog';
        ?>
    </title>
    <meta content="HTML5 News Magazine Template" name="keywords">
    <meta content="Nvic - Ultimate News and Magazine Template" name="description">
    <!-- Mobile Metas -->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="icon" href="../favicon.ico">
    <script src="../js/jquery-3.7.0.min.js"></script>
    <script src="../js/customscript.js"></script>
    <!-- import stylesheet -->
    <style>
        @import url(../css/vendors.css);
        @import url(../css/atbs-style.css);
        @import url(../css/header.css);
        @import url(../css/footer.css);
        @import url(../css/heading-title.css);
        @import url(../css/typography.css);
        @import url(../css/atbs-featured-module-1.css);
        @import url(../css/atbs-featured-module-2.css);
        @import url(../css/atbs-featured-module-3.css);
        @import url(../css/atbs-featured-module-4.css);
        @import url(../css/atbs-featured-module-5.css);
        @import url(../css/atbs-featured-module-6.css);
        @import url(../css/atbs-featured-module-7.css);
        @import url(../css/atbs-posts-listing--grid-1-has-sidebar.css);
        @import url(../css/atbs-posts-listing--grid-3-has-sidebar.css);
        @import url(../css/atbs-posts-listing--grid-3-has-sidebar.css);
        @import url(../css/atbs-posts-listing--list-1-has-sidebar.css);
        @import url(../css/widget.css);
        @import url(../css/single-default.css);
        @import url(../css/single-1.css);
        @import url(../css/author.css);
        @import url(../css/font.css);
        @import url(../css/color.css);
        @import url(../css/customstyle.css);
        @import url(../css/tailwind.min.css);
        @import url(../css/bootstrap.min.css);
        @import url(../css/materialdesignicons.min.css);
        @import url(../function/layer/layui.css);
        );
    </style>
    <!-- Web Fonts  -->
    <link href="../css/css2.css" rel="stylesheet">
    <link href="../css/css21.css" rel="stylesheet">
</head>
<body class="home home-1 has-block-heading-line">
<?php include_once "../templates/modal.php" ?>
<!-- .site-wrapper -->
<div class="site-wrapper">
    <!-- Site header -->
    <header class="site-header">
        <!-- Mobile header -->
        <div class="mobile-header visible-xs visible-sm" id="atbs-mobile-header">
            <div class="mobile-header__inner mobile-header__inner--flex">
                <div class="header-branding header-branding--mobile mobile-header__section text-left">
                    <div class="header-logo header-logo--mobile flexbox__item text-left">
                        <a href="../views/index.php">
                            <img alt="logo" src="../images/logo.png"></a>
                    </div>
                </div>
                <div class="mobile-header__section text-right inverse-text">
                    <button class="mobile-header-btn js-search-dropdown-toggle" type="submit">
                        <i class="mdi mdi-credit-card-search-outline hidden-xs"></i>
                        <i class="mdi mdi-credit-card-search-outline visible-xs-inline-block"></i>
                    </button>
                    <?php
                    if($loginstatus) {
                        echo <<<logout
                    <button id="logoutbtn1" class="mobile-header-btn" type="button" onclick="logout()"
                            onchange="checkLoginStatus()">
                        <i id="logout1" class="mdi mdi-logout hidden-xs"></i>
                        <i id="logout2" class="mdi mdi-logout visible-xs-inline-block"></i>
                    </button>
logout;
                    } else {
                        echo <<<login
                    <button id="logoutbtn1" class="mobile-header-btn" lay-type="1" type="button" onclick="logout()"
                            onchange="checkLoginStatus()">
                        <i id="logout1" class="mdi mdi-logout hidden-xs"></i>
                        <i id="logout2" class="mdi mdi-logout visible-xs-inline-block"></i>
                    </button>
login;
                    }
                ?>
                    <a class="offcanvas-menu-toggle mobile-header-btn js-atbs-offcanvas-toggle"
                       href="#atbs-offcanvas-primary">
                        <i class="mdicon mdicon-menu hidden-xs"></i>
                        <i class="mdicon mdicon-menu visible-xs-inline-block"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Mobile header -->
        <!-- Navigation bar with PC And most iPad Devices -->
        <nav class="navigation-bar hidden-xs hidden-sm js-sticky-header-holder">
            <div class="navigation-bar__inner flexbox-wrap flexbox-center-y">
                <div class="navigation-bar__section flex-box align-item-center">
                    <a class="offcanvas-menu-toggle navigation-bar-btn js-atbs-offcanvas-toggle
                    btn-menu-bar-icon flex-box align-item-center"
                       href="#atbs-offcanvas-primary">
                        <svg height="20" viewbox="0 0 30 20" width="30" xmlns="http://www.w3.org/2000/svg">
                            <g data-name="Group 19291" id="Group_19291" transform="translate(4636 4933)">
                                <rect data-name="Rectangle 1246" fill="#fff" height="2" id="Rectangle_1246"
                                      transform="translate(-4636 -4933)" width="30"></rect>
                                <rect data-name="Rectangle 1247" fill="#fff" height="2" id="Rectangle_1247"
                                      transform="translate(-4636 -4924)" width="25"></rect>
                                <rect data-name="Rectangle 1248" fill="#fff" height="2" id="Rectangle_1248"
                                      transform="translate(-4636 -4915)" width="30"></rect>
                            </g>
                        </svg>
                    </a>
                    <div class="header-logo">
                        <a href="../views/index.php">
                            <img alt="logo" src="../images/logo.png" style="max-height: 120px"></a>
                    </div>
                </div>
                <div class="navigation-bar__section navigation-menu-section js-priority-nav text-center">
                    <ul class="navigation navigation--main navigation--inline" id="menu-main-menu">
                        <li class="menu-item-cat-1">
                            <a href="../views/index.php">主页</a>
                        </li>
                        <li class="menu-item-cat-3">
                            <a href="../NexusAdmin/index.php">后台管理</a>
                        </li>
                        <li class="menu-item-cat-3">
                            <a href="../NexusAdmin/function/publish_blog/blog_publish_for_user.php">发布文章</a>
                        </li>
                        <?php
                            foreach ($_SESSION['types'] as $type) {
                                $typename = $type['name'];
                                $blogtypeid = $type['blogtypeid'];
                                $typestyle = $type['showstyle'];
                                echo <<<li
                        <li class="menu-item-cat-2"><a href="../views/categorystyle-$typestyle.php?typeid=$blogtypeid">
                            $typename</a>
                        </li>
li;
                            }
                        ?>
                        <li class="menu-item-cat-4">
                            <a href="../views/contact.php">联系我们</a>
                        </li>
                    </ul>
                </div>
                <div class="navigation-bar__section">
                    <button class="navigation-bar-btn js-search-dropdown-toggle nav-btn-square "
                            style="margin-right: 0"
                            type="submit"><i
                            class="mdi mdi-credit-card-search-outline"></i></button>
                    <?php
                        if ($loginstatus) {
                            echo <<<logout
                    <button id="logoutbtn2" class="navigation-bar-btn nav-btn-square" type="button" 
                    onclick="logout()" onchange="checkLoginStatus()">
                        <i id="logout" class="mdi mdi-logout"></i></button>
logout;
                        } else {
                            echo <<<login
                    <button id="logoutbtn2" class="navigation-bar-btn nav-btn-square" type="button" onclick="
                    window.location.href='../views/login.php'">
                        <i id="logout" class="mdi mdi-login-variant"></i></button>
login;
                        }
                    ?>
                </div>
            </div>
            <!-- .navigation-bar__inner -->
            <div class="header-search-dropdown ajax-search is-in-navbar js-ajax-search" id="header-search-dropdown">
                <div class="container container--narrow">
                    <form action="../views/search.php"
                          id = "search-form"
                          class="search-form search-form--horizontal" method="get">
                        <div class="search-form__input-wrap">
                            <label>
                                <input class="search-form__input" id="q" name="q" placeholder="Search" type="text" value="">
                            </label>
                        </div>
                        <div class="search-form__submit-wrap">
                            <button class="search-form__submit btn btn-primary" style="border: none" type="button">搜索</button>
                        </div>
                    </form>
                    <script>
                        $(document).ready(function () {
                            $('.search-form__submit').click(function () {
                                var searchForm = $('#search-form');
                                $('#q').val(encodeAll($("#q").val()));
                                searchForm.submit();
                            })
                        })
                    </script>
<!--                    <div class="search-results">-->
<!--                        <div class="typing-loader"></div>-->
<!--                        <div class="search-results__inner"></div>-->
<!--                    </div>-->
                </div>
            </div>
            <!-- .header-search-dropdown -->
        </nav>
        <!-- Navigation-bar -->
    </header>