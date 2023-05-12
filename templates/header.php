<?php
session_start();
include_once '../database/databaseHandle.php';
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
        p {
            text-indent: 2em;
        }
    </style>
    <!-- Web Fonts  -->
    <link href="../css/css2.css" rel="stylesheet">
    <link href="../css/css21.css" rel="stylesheet">
</head>
<body class="home home-1 has-block-heading-line">
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
                            <img alt="logo"
                                 src="data:image/webp;base64,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">
                        </a>
                    </div>
                </div>
                <div class="mobile-header__section text-right inverse-text">
                    <button class="mobile-header-btn js-search-dropdown-toggle" type="submit">
                        <i class="mdicon mdicon-search hidden-xs"></i>
                        <i class="mdicon mdicon-search visible-xs-inline-block"></i>
                    </button>
                    <a class="offcanvas-menu-toggle mobile-header-btn js-atbs-offcanvas-toggle" href="#atbs-offcanvas-primary">
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
                    <a class="offcanvas-menu-toggle navigation-bar-btn js-atbs-offcanvas-toggle btn-menu-bar-icon flex-box align-item-center"
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
                            <img alt="logo"
                                 src="data:image/webp;base64,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">
                        </a>
                    </div>
                </div>
                <div class="navigation-bar__section navigation-menu-section js-priority-nav text-center">
                    <ul class="navigation navigation--main navigation--inline" id="menu-main-menu">
                        <li class="menu-item-cat-1">
                            <a href="../views/index.php">主页</a>
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
                    <button class="navigation-bar-btn js-search-dropdown-toggle nav-btn-square " type="submit"><i
                            class="mdicon mdicon-search"></i></button>
                </div>
            </div>
            <!-- .navigation-bar__inner -->
            <div class="header-search-dropdown ajax-search is-in-navbar js-ajax-search" id="header-search-dropdown">
                <div class="container container--narrow">
                    <form action="#" class="search-form search-form--horizontal" method="get">
                        <div class="search-form__input-wrap">
                            <label>
                                <input class="search-form__input" name="s" placeholder="Search" type="text" value="">
                            </label>
                        </div>
                        <div class="search-form__submit-wrap">
                            <button class="search-form__submit btn btn-primary" type="submit">搜索</button>
                        </div>
                    </form>
                    <div class="search-results">
                        <div class="typing-loader"></div>
                        <div class="search-results__inner"></div>
                    </div>
                </div>
            </div>
            <!-- .header-search-dropdown -->
        </nav>
        <!-- Navigation-bar -->
    </header>