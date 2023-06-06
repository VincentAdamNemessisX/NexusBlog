<?php include_once "../database/databaseHandle.php"; ?>
<footer class="site-footer footer-1">
    <div class="site-footer__section">
        <div class="site-footer__section-inner inverse-text">
            <div class="section-row">
                <div class="section-column section-column-left text-left">
                    <div class="site-logo">
                        <a href="../views/index.php">
                            <img alt="logo" src="../images/logo.png"></a>
                    </div>
                </div>
                <div class="section-column section-column-center text-center">
                    <nav class="footer-menu text-center">
                        <ul class="navigation navigation--footer navigation--inline" id="menu-footer-menu">
                            <li><a href="../views/index.php">主页</a></li>
                            <li><a href="../NexusAdmin/index.php">后台管理</a></li>
                            <li><a href="../NexusAdmin/function/publish_blog/blog_publish_for_user.php">发布博客</a>
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
                            <li><a href="../views/contact.php">联系我们</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- site-footer -->
<!-- Sticky header -->
<div class="sticky-header js-sticky-header" id="atbs-sticky-header">
    <!-- Navigation bar -->
    <nav class="navigation-bar navigation-bar--fullwidth hidden-xs hidden-sm">
        <div class="navigation-bar__inner">
            <div class="navigation-bar__section">
                <a class="offcanvas-menu-toggle navigation-bar-btn js-atbs-offcanvas-toggle"
                   href="#atbs-offcanvas-primary">
                    <i class="mdicon mdicon-menu icon--2x"></i>
                </a>
                <div class="site-logo header-logo">
                    <a href="../views/index.php">
                        <img alt="logo" src="../images/logo.png" style="max-width: 100px">
                    </a>
                </div>
            </div>
            <div class="navigation-wrapper navigation-bar__section js-priority-nav">
                <ul class="navigation navigation--main navigation--inline" id="menu-main-menu">
                    <li class="menu-item-cat-1">
                        <a href="../views/index.php">主页</a>
                    </li>
                    <li class="menu-item-cat-2">
                        <a href="../NexusAdmin/index.php">后台管理</a>
                    </li>
                    <li class="menu-item-cat-2">
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

                <button class="navigation-bar-btn js-search-dropdown-toggle" type="submit"><i
                            class="mdi mdi-credit-card-search-outline"></i></button>
                <?php
                if (isset($_SESSION['user'])) {
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
    </nav>
    <!-- Navigation-bar -->
</div>
<!-- Sticky header -->
<!-- Off-canvas menu -->
<div class="atbs-offcanvas js-atbs-offcanvas js-perfect-scrollbar scrollbar-overflowing"
     id="atbs-offcanvas-primary">
    <div class="atbs-offcanvas__title">
        <?php
        $login_user = $_SESSION['user'];
        $userinfo = mysqli_fetch_array(queryData('accounts',
            'headPortrait, accountid, nickname, email', "username='$login_user'"));
        $headPortrait = $userinfo['headPortrait'];
        $accountid = $userinfo['accountid'];
        ?>
        <h2 class="site-logo ml-5" style="display: flex; flex-direction: column; align-items: center;">
            <a href="../views/author.php?authorid=<?php echo $accountid ?? '' ?>">
                <img style="border-radius: 50%" alt="logo"
                     src="<?php echo $headPortrait ?? '../images/avatar-default.png' ?>">
            </a>
            <a href="../views/author.php?authorid=<?php echo $accountid ?? '' ?>">
                <span class="site-name"><?php echo $userinfo['nickname'] ?? $login_user ?></span>
        </h2>
        <ul class="social-list list-horizontal" style="display: flex; flex-direction: column; align-items: center;">
            <li><a href="mailto:<?php echo $userinfo['email'] ?>"><i class="mdicon mdicon-mail_outline"></i></a></li>
        </ul>
        <a aria-label="Close" class="atbs-offcanvas-close js-atbs-offcanvas-close"
           href="#atbs-offcanvas-primary"><span aria-hidden="true">&#10005;</span></a>
    </div>
    <div class="atbs-offcanvas__section atbs-offcanvas__section-navigation">
        <ul class="navigation navigation--offcanvas" id="menu-offcanvas-menu"
            style="display: flex; flex-direction: column; align-items: center;">
            <li class="menu-item-cat-1">
                <a href="../views/index.php">主页</a>
            </li>
            <li class="menu-item-cat-2">
                <a href="../NexusAdmin/index.php">后台管理</a>
            </li>
            <li class="menu-item-cat-2">
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
    <?php if(!isset($_SESSION['user']))
        echo <<<EOF
    <div class="atbs-offcanvas__section" id="loginsection">
        <div class="flex-row text-center align-items-center">
            <i class="mdicon mdicon-person mdicon--first"></i><span><a href="../views/login.php">登录</a> / <a
                    href="../views/register.php">注册</a></span>
        </div>
    </div>
EOF;
    else
        echo <<<EOF
EOF;
?>
</div>
<!-- Off-canvas menu -->
<a class="atbs-go-top btn btn-default hidden-xs js-go-top-el" href="#"><i
            class="mdicon mdicon-arrow_upward"></i></a>
<!-- .site-wrapper -->

<script src="../js/jquery.js.pagespeed.jm.vSq_cOaZon.js"></script>
<script src="../js/sidebar.js.pagespeed.jm.9GUzEJsw5p.js"></script>
<script src="../js/owl-carousel.min.js.pagespeed.jm.CUaR_y7pym.js"></script>
<script src="../js/scripts.js.pagespeed.jm.0lwMB5gWYG.js"></script>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/jquery-3.7.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../function/layer/layui.js"></script>
<script src="../js/customscript.js"></script>
</body>
</html>