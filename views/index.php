<?php include_once "../templates/header.php"; ?>
<div class="site-content">
    <!-- module-1 -->
    <div class="atbs-block atbs-block--fullwidth atbs-featured-module-1">
        <div class="atbs-block__inner background-dots">
            <div class="atbs-block__inner-group flex-box">

                <!--                            editor's pick by category-->
                <div class="section-main">
                    <?php $blogrst = queryData('accounts, recommendblog, blog, blogimages', '*',
                            'blog.blogid = recommendblog.blogid and blog.author = accounts.username
                            and blog.blogid = blogimages.blogid');
                    ?>
                    <div
                        class="owl-carousel js-atbs-carousel-1i atbs-carousel dots-circle nav-circle  nav-vertical nav-border">
                        <!--                        cycle print recommend data-->
                        <?php while ($blog = mysqli_fetch_array($blogrst)) {
                            $blogtitle = $blog['title'];
                            $blogpublishTime = date("Y年m月", strtotime($blog['publishTime']));
                            $blogauthor = $blog['author'];
                            $blogabstract = $blog['abstract'];
                            $blogtype = $blog['type'];
                            $authorid = $blog['accountid'];
                            $authorheadportrait = $blog['headPortrait'];
                            $blogimagesurl = explode(',', $blog['imagesurl']);
                            $blogid = $blog['blogid'];
                            echo <<<slideblog
                        <div class="slide-content">
                            <article class="post post--horizontal post--horizontal-middle post--horizontal-circle">
                                                                <div class="post__thumb object-fit">
                                    <a href="single.php?blogid=$blogid"><img
                                            alt="File not found"
                                            src="$blogimagesurl[0]"></a>
                                </div>
                                <div class="post__text inverse-text">
                                    <a class="post__cat post__cat--bg" href="category-1.php">$blogtype</a>
                                    <h3 class="post__title f-46 f-w-700 m-t-10 m-b-15 atbs-line-limit atbs-line-limit-3">
                                        <a href="single.php?blogid=$blogid">
                                        $blogtitle</a>
                                    </h3>
                                    <div class="post__excerpt m-t-0 m-b-20">
                                        $blogabstract
                                    </div>
                                    <div class="post__meta">
                                        <div class="post-author post-author_style-7">
                                            <a class="post-author__avatar" href="author.php?authorid=$authorid"
                                               rel="author" title="Posts by $blogauthor">
                                                <img alt="$blogauthor"
                                                     src="$authorheadportrait">
                                            </a>
                                            <div class="post-author__text">
                                                <div class="author_name--wrap">
                                                    <span>由</span>
                                                    <a class="post-author__name" href="author.php?authorid=$authorid"
                                                       rel="author" title="Posts by $blogauthor">$blogauthor</a>
                                                    <span>创作</span>   
                                                </div>
                                                 <time class="time published"
                                                          datetime="$blogpublishTime"
                                                          title="$blogpublishTime">
                                                    $blogpublishTime
                                                 </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
slideblog;
                        }
                        ?>
                    </div>
                </div>

<!--                up down cycle print data all blog-->
                <?php
                    $blogrst = []; $blog = [];
                    $blogrst = queryData('accounts, blog, blogimages', '*',
                        'blog.author = accounts.username and blog.blogid = blogimages.blogid order by publishTime desc');
                ?>
                <div class="section-sub scrollbar-hidden scroll-default" data-scroll="260">
                    <div class="section-sub__inner">
                        <div class="posts-list flex-box flex-box-1i">
                            <?php
                                while ($blog = mysqli_fetch_array($blogrst)) {
                                    $blogtitle = $blog['title'];
                                    $blogpublishTime = date("Y年m月", strtotime($blog['publishTime']));
                                    $blogauthor = $blog['author'];
                                    $blogabstract = $blog['abstract'];
                                    $blogtype = $blog['type'];
                                    $authorid = $blog['accountid'];
                                    $blogimagesurl = explode(',', $blog['imagesurl']);
                                    $blogid = $blog['blogid'];
                                    echo <<<listitems
                            <div class="list-item">
                                <article
                                    class="post post--overlay post--overlay-outside post--overlay-bottom post--overlay-height-230">
                                    <div class="post__thumb post__thumb--overlay atbs-thumb-object-fit">
                                        <a href="single.php?blogid=$blogid">
                                            <img alt="file not found"
                                                 src="$blogimagesurl[0]">
                                        </a>
                                    </div>
                                    <div class="post__text inverse-text">
                                        <div class="post__text-wrap">
                                            <div class="post__text-inner">
                                                <h3 class="post__title f-20 f-w-600 m-b-10">
                                                    <a href="single.php?blogid=$blogid">$blogtitle</a>
                                                </h3>
                                                <div class="post__readmore m-t-0 m-b-0">
                                                    <a href="single.php?blogid=$blogid">
                                                        <svg height="10.828" viewbox="0 0 20.414 10.828"
                                                             width="20.414" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M17,8l4,4m0,0-4,4m4-4H3" data-name="Path 1402"
                                                                  fill="none" stroke="#000"
                                                                  stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  transform="translate(-2 -6.586)"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="post__meta flex-box time-style-1">
                                                    <div class="post-author post-author_style-6">
                                                        <div class="post-author__text">
                                                            <div class="author_name--wrap">
                                                                <span>由</span>
                                                                <a class="post-author__name"
                                                                   href="author.php?authorid=$authorid" rel="author"
                                                                   title="Posts by $blogauthor">$blogauthor</a>
                                                                <span>创作</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <time class="time published"
                                                          datetime="$blogpublishTime"
                                                          title="$blogpublishTime">
                                                        $blogpublishTime
                                                    </time>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="link-overlay" href="single.php?blogid=$blogid"></a>
                                </article>
                            </div>
listitems;
                                }
                             ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- module-1 -->

    <!-- module-2 -->
<!--    主编推荐模块：斜对齐-->
    <div class="atbs-block atbs-block--fullwidth atbs-featured-module-2">
        <div class="container">
            <div class="block-heading block-heading_style-1 block-heading--center block-heading-no-line">
                <h4 class="block-heading__title">
                    <span class="first-word">主编</span><span>推荐</span>
                </h4>
            </div>
        </div>
        <div class="container">
            <div class="atbs-block__inner flex-box flex-box-1i">
                <div class="section-main">
                    <div class="section-main__inner flex-box flex-space-30">
                        <?php
                        $blogrst = []; $blog = [];
                        $blogrst = queryData('accounts, blog, blogimages, blogtype',
                            '*', 'blog.blogid = blogimages.blogid and blog.author = accounts.username
                            and blogtype.name = blog.type and blogtype.name = "精选"');
                        $blog = mysqli_fetch_array($blogrst);
                        $blogtitle = $blog['title'];
                        $blogpublishTime = date("Y年m月", strtotime($blog['publishTime']));
                        $blogauthor = $blog['author'];
                        $blogabstract = $blog['abstract'];
                        $blogtype = $blog['type'];
                        $authorid = $blog['accountid'];
                        $authorheadportrait = $blog['headPortrait'];
                        $blogimagesurl = explode(',', $blog['imagesurl']);
                        $blogid = $blog['blogid'];
                        echo <<<postmain
                        <div class="post-main">
                            <article
                                class="post post--overlay post--overlay-medium post--overlay-bottom post--overlay-height-440 post--overlay-padding-lg">
                                <div class="post__thumb post__thumb--overlay atbs-thumb-object-fit">
                                    <a href="single.php?blogid=$blogid">
                                        <img alt="file not found"
                                             src="$blogimagesurl[0]">
                                    </a>
                                </div>
                                <div class="post__text inverse-text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner">
                                            <h3 class="post__title f-28 f-w-700 m-b-15">
                                                <a href="single.php?blogid=$blogid">$blogtitle</a>
                                            </h3>
                                            <div class="post__meta">
                                                <div class="post-author post-author_style-7">
                                                    <a class="post-author__avatar" href="author.php?authorid=$authorid"
                                                       rel="author" title="Posts by $blogauthor">
                                                        <img alt="$blogauthor"
                                                             src="$authorheadportrait">
                                                    </a>
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>由</span>
                                                            <a class="post-author__name"
                                                               href="author.php?authorid=$authorid" rel="author"
                                                               title="Posts by $blogauthor">$blogauthor</a>
                                                            <span>创作</span>
                                                        </div>
                                                        <time class="time published"
                                                              datetime="$blogpublishTime"
                                                              title="$blogpublishTime">
                                                              $blogpublishTime
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="link-overlay" href="single.php?blogid=$blogid"></a>
                                <a class="post__cat post__cat--bg overlay-item--top-left"
                                   href="category-1.php">$blogtype</a>
                            </article>
                        </div>
postmain;
                        $blog = mysqli_fetch_array($blogrst);
                        $blogtitle = $blog['title'];
                        $blogpublishTime = date("Y年m月", strtotime($blog['publishTime']));
                        $blogauthor = $blog['author'];
                        $blogabstract = $blog['abstract'];
                        $blogtype = $blog['type'];
                        $authorid = $blog['accountid'];
                        $authorheadportrait = $blog['headPortrait'];
                        $blogimagesurl = explode(',', $blog['imagesurl']);
                        $blogid = $blog['blogid'];
                        echo <<<postsub
                        <div class="post-sub">
                            <article
                                class="post post--vertical post--vertical-style-card-thumb-aside post--hover-theme"
                                data-dark-mode="true">
                                <div class="post__thumb object-fit">
                                    <a href="single.php?blogid=$blogid">
                                        <img alt="File not found"
                                             src="$blogimagesurl[0]">
                                    </a>
                                </div>
                                <div class="post__text flex-box flex-direction-column inverse-text">
                                    <div class="post__text-group">
                                        <a class="post__cat post__cat-primary" href="category-1.php">$blogtype</a>
                                        <h3 class="post__title f-20 f-w-600 m-b-35 m-t-10 atbs-line-limit atbs-line-limit-3">
                                            <a href="single.php?blogid=$blogid">$blogtitle</a>
                                        </h3>
                                    </div>
                                    <div class="post__text-group flex-item-auto-bottom">
                                        <div
                                            class="post__meta time-style-1 flex-box justify-content-space align-item-center">
                                            <div class="post-author post-author_style-6">
                                                <div class="post-author__text">
                                                    <div class="author_name--wrap">
                                                        <span>由</span>
                                                        <a class="post-author__name" href="author.php?authorid=$authorid"
                                                           rel="author" title="Posts by $blogauthor">$blogauthor</a>
                                                        <span>创作</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <time class="time published" datetime="$blogpublishTime"
                                                  title="$blogpublishTime">
                                                  $blogpublishTime
                                            </time>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
postsub;
                        ?>
                    </div>
                </div>
                <?php $blogrst = queryData('blog, accounts, blogimages', '*',
                    'blog.blogid = blogimages.blogid and blog.author = accounts.username and blog.type = "专业运动"') ?>
                <div class="section-sub m-t-30">
                    <div class="section-sub__inner flex-box flex-space-30">
                        <?php
                        $blog = mysqli_fetch_array($blogrst);
                        $blogtitle = $blog['title'];
                        $blogpublishTime = date("Y年m月", strtotime($blog['publishTime']));
                        $blogauthor = $blog['author'];
                        $blogabstract = $blog['abstract'];
                        $blogtype = $blog['type'];
                        $authorid = $blog['accountid'];
                        $authorheadportrait = $blog['headPortrait'];
                        $blogimagesurl = explode(',', $blog['imagesurl']);
                        $blogid = $blog['blogid'];
                        echo <<<postmain
                        <div class="post-main">
                            <article
                                class="post post--overlay  post--overlay-medium post--overlay-bottom post--overlay-height-440 post--overlay-padding-lg">
                                <div class="post__thumb post__thumb--overlay atbs-thumb-object-fit">
                                    <a href="single.php?blogid=$blogid">
                                        <img alt="file not found"
                                             src="$blogimagesurl[0]">
                                    </a>
                                </div>
                                <div class="post__text inverse-text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner">
                                            <h3 class="post__title f-28 f-w-700 m-b-15">
                                                <a href="single.php?$blogid">$blogtitle</a>
                                            </h3>
                                            <div class="post__meta">
                                                <div class="post-author post-author_style-7">
                                                    <a class="post-author__avatar" href="author.php?authorid=$authorid"
                                                       rel="author" title="Posts by $blogauthor">
                                                        <img alt="$blogauthor"
                                                             src="$authorheadportrait">
                                                    </a>
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>由</span>
                                                            <a class="post-author__name"
                                                               href="author.php?authorid=$authorid" rel="author"
                                                               title="Posts by $blogauthor">$blogauthor</a>
                                                            <span>创作</span>
                                                        </div>
                                                        <time class="time published"
                                                              datetime="$blogpublishTime"
                                                              title="$blogpublishTime">
                                                              $blogpublishTime
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="link-overlay" href="single.php?blogid=$blogid"></a>
                                <a class="post__cat post__cat--bg overlay-item--top-left"
                                   href="category-1.php">$blogtype</a>
                            </article>
                        </div>
postmain;
                        $blog = mysqli_fetch_array($blogrst);
                        $blogtitle = $blog['title'];
                        $blogpublishTime = date("Y年m月", strtotime($blog['publishTime']));
                        $blogauthor = $blog['author'];
                        $blogabstract = $blog['abstract'];
                        $blogtype = $blog['type'];
                        $authorid = $blog['accountid'];
                        $authorheadportrait = $blog['headPortrait'];
                        $blogimagesurl = explode(',', $blog['imagesurl']);
                        $blogid = $blog['blogid'];
                        echo <<<postsub
                        <div class="post-sub flex-order-1">
                            <article
                                class="post post--vertical post--vertical-style-card-thumb-aside post--hover-theme"
                                data-dark-mode="true">
                                <div class="post__thumb object-fit">
                                    <a href="single.php?blogid=$blogid">
                                        <img alt="File not found"
                                             src="$blogimagesurl[0]">
                                    </a>
                                </div>
                                <div class="post__text flex-box flex-direction-column inverse-text">
                                    <div class="post__text-group">
                                        <a class="post__cat post__cat-primary" href="category-1.php">$blogtype</a>
                                        <h3 class="post__title f-20 f-w-600 m-b-35 m-t-10 atbs-line-limit atbs-line-limit-3">
                                            <a href="single.php?blogid=$blogid">$blogtitle</a>
                                        </h3>
                                    </div>
                                    <div class="post__text-group flex-item-auto-bottom">
                                        <div
                                            class="post__meta time-style-1 flex-box justify-content-space align-item-center">
                                            <div class="post-author post-author_style-6">
                                                <div class="post-author__text">
                                                    <div class="author_name--wrap">
                                                        <span>由</span>
                                                        <a class="post-author__name" href="author.php?authorid=$authorid"
                                                           rel="author" title="Posts by $blogauthor">$blogauthor</a>
                                                        <span>创作</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <time class="time published" datetime="$blogpublishTime"
                                                  title="$blogpublishTime">
                                                  $blogpublishTime
                                            </time>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
postsub;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- module-2 -->

<!--    复杂页面展示-->
    <!-- module-3 -->
    <div class="atbs-block atbs-block--fullwidth atbs-featured-module-3">
        <div class="container">
            <div class="block-heading block-heading_style-1 block-heading--center block-heading-no-line">
                <h4 class="block-heading__title">
                    <span class="first-word">editor's </span><span> choise</span>
                </h4>
            </div>
        </div>
        <div class="atbs-block__inner background-dots">
            <div class="atbs-block__inner-group flex-box">
                <div class="section-main">
                    <article
                        class="post post--vertical post--vertical-normal-two-column post--vertical-normal-two-column-text-reverse post__thumb-480"
                        data-dark-mode="true">
                        <div class="post__thumb atbs-thumb-object-fit">
                            <a href="single.php">
                                <img alt="File not found" src="../images/x34.jpg.pagespeed.ic.2LSufkqvmb.jpg">
                                <div class="post-type-icon post-type-circle overlay-item--center-xy">
                                    <i class="mdicon mdicon-play_arrow"></i>
                                </div>
                            </a>
                        </div>
                        <div class="post__text inverse-text">
                            <div class="post__text-wrap flex-box">
                                <div class="post__text-group flex-column-100 m-b-10">
                                    <a class="post__cat post__cat-primary" href="category-1.php">Mobile</a>
                                </div>
                                <div class="post__text-group">
                                    <h3 class="post__title f-40 f-w-700 atbs-line-limit atbs-line-limit-3">
                                        <a href="single.php">It’s better to be a lion for a day than a sheep all
                                            your life Me</a>
                                    </h3>
                                    <div class="post__meta m-t-25">
                                        <div class="post-author post-author_style-7">
                                            <a class="post-author__avatar" href="author.php"
                                               rel="author" title="Posts by Connor Randall">
                                                <img alt="Connor Randall"
                                                     src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                            </a>
                                            <div class="post-author__text">
                                                <div class="author_name--wrap">
                                                    <span>by</span>
                                                    <a class="post-author__name" href="author.php"
                                                       rel="author" title="Posts by Connor Randall"> Connor Randall</a>
                                                </div>
                                                <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                      title="March 6, 2021 at 8:45 am">March 6, 2021
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="post__text-group">
                                    <div class="post__excerpt atbs-line-limit atbs-line-limit-3">
                                        The shark swam away when the boy's father jumped into the water, but the
                                        child suffered lacerations across his body
                                    </div>
                                    <div class="post__readmore m-t-20">
                                        <a href="single.php">
                                            <span class="readmore__text">Read More</span>
                                            <svg height="10.121" viewbox="0 0 19.811 10.121" width="19.811"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17,8l4,4m0,0-4,4m4-4H3" data-name="Path 1414"
                                                      fill="none"
                                                      id="Path_1414" opacity="0.8" stroke="#fff"
                                                      stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="1.5" transform="translate(-2.25 -6.939)"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="section-sub">
                    <div class="posts-list flex-box flex-box-2i">
                        <div class="list-item">
                            <article
                                class="post post--vertical post--vertical-style-card-thumb-aside post--hover-theme"
                                data-dark-mode="true">
                                <div class="post__thumb object-fit">
                                    <a href="single.php">
                                        <img alt="File not found"
                                             src="../images/x10.jpg.pagespeed.ic.2193TilPH_.jpg">
                                    </a>
                                </div>
                                <div class="post__text flex-box flex-direction-column inverse-text">
                                    <div class="post__text-group">
                                        <a class="post__cat post__cat-primary" href="category-1.php">GADGETS</a>
                                        <h3 class="post__title f-20 f-w-600 m-b-35 m-t-10 atbs-line-limit atbs-line-limit-3">
                                            <a href="single.php">Oculus Working on Update to Improve Rift S
                                                Audio</a>
                                        </h3>
                                    </div>
                                    <div class="post__text-group flex-item-auto-bottom">
                                        <div
                                            class="post__meta time-style-1 flex-box justify-content-space align-item-center">
                                            <div class="post-author post-author_style-6">
                                                <div class="post-author__text">
                                                    <div class="author_name--wrap">
                                                        <span>by</span>
                                                        <a class="post-author__name" href="author.php"
                                                           rel="author" title="Posts by Connor Randall"> Connor
                                                            Randall</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                  title="March 6, 2021 at 8:45 am">March 6, 2021
                                            </time>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="list-item">
                            <article
                                class="post post--vertical post--vertical-style-card-thumb-aside post--hover-theme"
                                data-dark-mode="true">
                                <div class="post__thumb object-fit">
                                    <a href="single.php">
                                        <img alt="File not found"
                                             src="../images/x9.jpg.pagespeed.ic.inGC_uTvF0.jpg">
                                    </a>
                                </div>
                                <div class="post__text flex-box flex-direction-column inverse-text">
                                    <div class="post__text-group">
                                        <a class="post__cat post__cat-primary" href="category-1.php">GADGETS</a>
                                        <h3 class="post__title f-20 f-w-600 m-b-35 m-t-10 atbs-line-limit atbs-line-limit-3">
                                            <a href="single.php">Oculus Working on Update to Improve Rift S
                                                Audio</a>
                                        </h3>
                                    </div>
                                    <div class="post__text-group flex-item-auto-bottom">
                                        <div
                                            class="post__meta time-style-1 flex-box justify-content-space align-item-center">
                                            <div class="post-author post-author_style-6">
                                                <div class="post-author__text">
                                                    <div class="author_name--wrap">
                                                        <span>by</span>
                                                        <a class="post-author__name" href="author.php"
                                                           rel="author" title="Posts by Connor Randall"> Connor
                                                            Randall</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                  title="March 6, 2021 at 8:45 am">March 6, 2021
                                            </time>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="list-item">
                            <article
                                class="post post--vertical post--vertical-style-card-thumb-aside atbs-post-hover-theme-style post--hover-theme"
                                data-dark-mode="true">
                                <div class="post__thumb object-fit">
                                    <a href="single.php">
                                        <img alt="File not found"
                                             src="../images/x12.jpg.pagespeed.ic.D97Kd4sf7I.jpg">
                                    </a>
                                </div>
                                <div class="post__text flex-box flex-direction-column inverse-text">
                                    <div class="post__text-group">
                                        <a class="post__cat post__cat-primary" href="category-1.php">GADGETS</a>
                                        <h3 class="post__title f-20 f-w-600 m-b-35 m-t-10 atbs-line-limit atbs-line-limit-3">
                                            <a href="single.php">Oculus Working on Update to Improve Rift S
                                                Audio</a>
                                        </h3>
                                    </div>
                                    <div class="post__text-group flex-item-auto-bottom">
                                        <div
                                            class="post__meta time-style-1 flex-box justify-content-space align-item-center">
                                            <div class="post-author post-author_style-6">
                                                <div class="post-author__text">
                                                    <div class="author_name--wrap">
                                                        <span>by</span>
                                                        <a class="post-author__name" href="author.php"
                                                           rel="author" title="Posts by Connor Randall"> Connor
                                                            Randall</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                  title="March 6, 2021 at 8:45 am">March 6, 2021
                                            </time>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="list-item">
                            <article
                                class="post post--vertical post--vertical-style-card-thumb-aside atbs-post-hover-theme-style post--hover-theme"
                                data-dark-mode="true">
                                <div class="post__thumb object-fit">
                                    <a href="single.php">
                                        <img alt="File not found"
                                             src="../images/x44.jpg.pagespeed.ic.CuLi-SGHYS.jpg">
                                    </a>
                                </div>
                                <div class="post__text flex-box flex-direction-column inverse-text">
                                    <div class="post__text-group">
                                        <a class="post__cat post__cat-primary" href="category-1.php">GADGETS</a>
                                        <h3 class="post__title f-20 f-w-600 m-b-35 m-t-10 atbs-line-limit atbs-line-limit-3">
                                            <a href="single.php">Oculus Working on Update to Improve Rift S
                                                Audio</a>
                                        </h3>
                                    </div>
                                    <div class="post__text-group flex-item-auto-bottom">
                                        <div
                                            class="post__meta time-style-1 flex-box justify-content-space align-item-center">
                                            <div class="post-author post-author_style-6">
                                                <div class="post-author__text">
                                                    <div class="author_name--wrap">
                                                        <span>by</span>
                                                        <a class="post-author__name" href="author.php"
                                                           rel="author" title="Posts by Connor Randall"> Connor
                                                            Randall</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                  title="March 6, 2021 at 8:45 am">March 6, 2021
                                            </time>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- module-3 -->


    <!-- module-4 -->
    <div class="atbs-block atbs-block--fullwidth atbs-featured-module-4">
        <div class="container">
            <div class="block-heading block-heading_style-1 block-heading--center block-heading-no-line">
                <h4 class="block-heading__title">
                    <span class="first-word">editor's </span><span> choise</span>
                </h4>
            </div>
        </div>
        <div class="container">
            <div class="atbs-block__inner">
                <div class="section-main">
                    <div
                        class="owl-carousel js-atbs-carousel-1i atbs-carousel dots-circle nav-circle nav-horizontal nav-border">
                        <div class="slide-content">
                            <article
                                class="post post--overlay post--overlay-rectangle post--overlay-bottom post--overlay-height-600 post--overlay-padding-lg">
                                <div class="post__thumb post__thumb--overlay atbs-thumb-object-fit">
                                    <a href="single.php">
                                        <img alt="file not found"
                                             src="../images/x55.jpg.pagespeed.ic.u4FkrAdGX7.jpg">
                                    </a>
                                </div>
                                <div class="post__text inverse-text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner">
                                            <h3 class="post__title f-32 f-w-700 m-b-15">
                                                <a href="single.php">Look Deep Into Nature, And You Will
                                                    Understand</a>
                                            </h3>
                                            <div class="post__excerpt atbs-line-limit atbs-line-limit-3 m-b-20">
                                                The shark swam away when the boy's father jumped into the water, but
                                                the child suffered lacerations across his body
                                            </div>
                                            <div class="post__meta">
                                                <div class="post-author post-author_style-7">
                                                    <a class="post-author__avatar" href="author.php"
                                                       rel="author" title="Posts by Connor Randall">
                                                        <img alt="Connor Randall"
                                                             src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                                    </a>
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>by</span>
                                                            <a class="post-author__name"
                                                               href="author.php" rel="author"
                                                               title="Posts by Connor Randall"> Connor Randall</a>
                                                        </div>
                                                        <time class="time published"
                                                              datetime="2021-03-06T08:45:23+00:00"
                                                              title="March 6, 2021 at 8:45 am">March 6, 2021
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="link-overlay" href="single.php"></a>
                                <a class="post__cat post__cat--bg overlay-item--top-left"
                                   href="category-1.php">GADGETS</a>
                            </article>
                        </div>
                        <div class="slide-content">
                            <article
                                class="post post--overlay post--overlay-rectangle post--overlay-bottom post--overlay-height-600 post--overlay-padding-lg">
                                <div class="post__thumb post__thumb--overlay atbs-thumb-object-fit">
                                    <a href="single.php">
                                        <img alt="file not found"
                                             src="../images/x5.jpg.pagespeed.ic.hbCv2NPLDO.jpg">
                                    </a>
                                </div>
                                <div class="post__text inverse-text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner">
                                            <h3 class="post__title f-32 f-w-700 m-b-15">
                                                <a href="single.php">Look Deep Into Nature, And You Will
                                                    Understand</a>
                                            </h3>
                                            <div class="post__excerpt atbs-line-limit atbs-line-limit-3 m-b-20">
                                                The shark swam away when the boy's father jumped into the water, but
                                                the child suffered lacerations across his body
                                            </div>
                                            <div class="post__meta">
                                                <div class="post-author post-author_style-7">
                                                    <a class="post-author__avatar" href="author.php"
                                                       rel="author" title="Posts by Connor Randall">
                                                        <img alt="Connor Randall"
                                                             src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                                    </a>
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>by</span>
                                                            <a class="post-author__name"
                                                               href="author.php" rel="author"
                                                               title="Posts by Connor Randall"> Connor Randall</a>
                                                        </div>
                                                        <time class="time published"
                                                              datetime="2021-03-06T08:45:23+00:00"
                                                              title="March 6, 2021 at 8:45 am">March 6, 2021
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="link-overlay" href="single.php"></a>
                                <a class="post__cat post__cat--bg overlay-item--top-left"
                                   href="category-1.php">GADGETS</a>
                            </article>
                        </div>
                        <div class="slide-content">
                            <article
                                class="post post--overlay post--overlay-rectangle post--overlay-bottom post--overlay-height-600 post--overlay-padding-lg">
                                <div class="post__thumb post__thumb--overlay atbs-thumb-object-fit">
                                    <a href="single.php">
                                        <img alt="file not found"
                                             src="../images/x43.jpg.pagespeed.ic.FLjUiKrE0a.jpg">
                                    </a>
                                </div>
                                <div class="post__text inverse-text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner">
                                            <h3 class="post__title f-32 f-w-700 m-b-15">
                                                <a href="single.php">Look Deep Into Nature, And You Will
                                                    Understand</a>
                                            </h3>
                                            <div class="post__excerpt atbs-line-limit atbs-line-limit-3 m-b-20">
                                                The shark swam away when the boy's father jumped into the water, but
                                                the child suffered lacerations across his body
                                            </div>
                                            <div class="post__meta">
                                                <div class="post-author post-author_style-7">
                                                    <a class="post-author__avatar" href="author.php"
                                                       rel="author" title="Posts by Connor Randall">
                                                        <img alt="Connor Randall"
                                                             src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                                    </a>
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>by</span>
                                                            <a class="post-author__name"
                                                               href="author.php" rel="author"
                                                               title="Posts by Connor Randall"> Connor Randall</a>
                                                        </div>
                                                        <time class="time published"
                                                              datetime="2021-03-06T08:45:23+00:00"
                                                              title="March 6, 2021 at 8:45 am">March 6, 2021
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="link-overlay" href="single.php"></a>
                                <a class="post__cat post__cat--bg overlay-item--top-left"
                                   href="category-1.php">GADGETS</a>
                            </article>
                        </div>
                    </div>
                </div>
                <div class="section-sub">
                    <div class="posts-list flex-box flex-box-3i flex-space-30 posts-list-tablet-2i">
                        <div class="list-item">
                            <article class="post post--vertical post--vertical-normal">
                                <div class="post__thumb object-fit">
                                    <a href="single.php"><img
                                            alt="File not found"
                                            src="../images/x6.jpg.pagespeed.ic.Dzx_eITMOU.jpg"></a>
                                    <a class="post__cat post__cat--bg overlay-item--top-left"
                                       href="category-1.php">GADGETS</a>
                                </div>
                                <div class="post__text">
                                    <h3 class="post__title f-20 f-w-600 m-b-10"><a href="single.php">Never Let The
                                            Fear Of Striking Out Keep You From Playing </a></h3>
                                    <div class="post__meta flex-box time-style-1">
                                        <div class="post-author post-author_style-6">
                                            <div class="post-author__text">
                                                <div class="author_name--wrap">
                                                    <span>by</span>
                                                    <a class="post-author__name" href="author.php"
                                                       rel="author" title="Posts by Connor Randall"> Connor Randall</a>
                                                </div>
                                            </div>
                                        </div>
                                        <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                              title="March 6, 2021 at 8:45 am">March 6, 2021
                                        </time>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="list-item">
                            <article class="post post--vertical post--vertical-normal">
                                <div class="post__thumb object-fit">
                                    <a href="single.php"><img
                                            alt="File not found"
                                            src="../images/x16.jpg.pagespeed.ic.LvT-5PFqru.jpg"></a>
                                    <a class="post__cat post__cat--bg overlay-item--top-left"
                                       href="category-1.php">GADGETS</a>
                                </div>
                                <div class="post__text">
                                    <h3 class="post__title f-20 f-w-600 m-b-10"><a href="single.php">Never Let The
                                            Fear Of Striking Out Keep You From Playing </a></h3>
                                    <div class="post__meta flex-box time-style-1">
                                        <div class="post-author post-author_style-6">
                                            <div class="post-author__text">
                                                <div class="author_name--wrap">
                                                    <span>by</span>
                                                    <a class="post-author__name" href="author.php"
                                                       rel="author" title="Posts by Connor Randall"> Connor Randall</a>
                                                </div>
                                            </div>
                                        </div>
                                        <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                              title="March 6, 2021 at 8:45 am">March 6, 2021
                                        </time>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="list-item">
                            <article class="post post--vertical post--vertical-normal">
                                <div class="post__thumb object-fit">
                                    <a href="single.php"><img
                                            alt="File not found"
                                            src="../images/x51.jpg.pagespeed.ic.q9GuAyi1ty.jpg"></a>
                                    <a class="post__cat post__cat--bg overlay-item--top-left"
                                       href="category-1.php">GADGETS</a>
                                </div>
                                <div class="post__text">
                                    <h3 class="post__title f-20 f-w-600 m-b-10"><a href="single.php">Never Let The
                                            Fear Of Striking Out Keep You From Playing </a></h3>
                                    <div class="post__meta flex-box time-style-1">
                                        <div class="post-author post-author_style-6">
                                            <div class="post-author__text">
                                                <div class="author_name--wrap">
                                                    <span>by</span>
                                                    <a class="post-author__name" href="author.php"
                                                       rel="author" title="Posts by Connor Randall"> Connor Randall</a>
                                                </div>
                                            </div>
                                        </div>
                                        <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                              title="March 6, 2021 at 8:45 am">March 6, 2021
                                        </time>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- module-4 -->
    <!-- module-5 -->
    <div class="atbs-block atbs-block--fullwidth atbs-featured-module-5">
        <div class="container">
            <div class="block-heading block-heading_style-1 block-heading--center block-heading-no-line">
                <h4 class="block-heading__title">
                    <span class="first-word">editor's </span><span> choise</span>
                </h4>
            </div>
        </div>
        <div class="atbs-block__inner">
            <div class="atbs-block__inner-group flex-box">
                <div class="section-main">
                    <article
                        class="post post--overlay post--overlay-cylinder post--overlay-bottom post--overlay-height-920 post--overlay-padding-lg">
                        <div class="post__thumb post__thumb--overlay atbs-thumb-object-fit">
                            <a href="single.php">
                                <img alt="file not found" src="../images/x43.jpg.pagespeed.ic.FLjUiKrE0a.jpg">
                            </a>
                        </div>
                        <div class="post__text inverse-text">
                            <div class="post__text-wrap">
                                <div class="post__text-inner">
                                    <h3 class="post__title f-32 f-w-700 m-b-15">
                                        <a href="single.php">Keep Your Eyes On The Stars And Your Feet On The
                                            Ground.</a>
                                    </h3>
                                    <div class="post__excerpt atbs-line-limit atbs-line-limit-3 m-b-20">
                                        The shark swam away when the boy's father jumped into the water, but the
                                        child suffered lacerations across his body
                                    </div>
                                    <div class="post__meta">
                                        <div class="post-author post-author_style-7">
                                            <a class="post-author__avatar" href="author.php"
                                               rel="author" title="Posts by Connor Randall">
                                                <img alt="Connor Randall"
                                                     src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                            </a>
                                            <div class="post-author__text">
                                                <div class="author_name--wrap">
                                                    <span>by</span>
                                                    <a class="post-author__name" href="author.php"
                                                       rel="author" title="Posts by Connor Randall"> Connor Randall</a>
                                                </div>
                                                <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                      title="March 6, 2021 at 8:45 am">March 6, 2021
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="link-overlay" href="single.php"></a>
                        <a class="post__cat post__cat--bg overlay-item--top-left" href="category-1.php">GADGETS</a>
                    </article>
                </div>
                <div class="section-sub section-left flex-order-1">
                    <div class="posts-list flex-box flex-box-1i posts-list-tablet-2i">
                        <div class="list-item">
                            <article class="post post--vertical post--vertical-card-background"
                                     data-dark-mode="true">
                                <div class="post__thumb object-fit">
                                    <a href="single.php">
                                        <img alt="File not found"
                                             src="../images/x29.jpg.pagespeed.ic.LErxubgQm6.jpg">
                                    </a>
                                    <a class="post__cat post__cat--bg overlay-item--top-left"
                                       href="category-1.php">GADGETS</a>
                                </div>
                                <div class="post__text inverse-text">
                                    <h3 class="post__title f-22 f-w-600 m-b-10 m-t-10 atbs-line-limit atbs-line-limit-2">
                                        <a href="single.php">Oculus Working on Update to Improve Rift S Audio</a>
                                    </h3>
                                    <div class="post__meta border-avatar">
                                        <div class="post-author post-author_style-7">
                                            <a class="post-author__avatar" href="author.php"
                                               rel="author" title="Posts by Connor Randall">
                                                <img alt="Connor Randall"
                                                     src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                            </a>
                                            <div class="post-author__text">
                                                <div class="author_name--wrap">
                                                    <span>by</span>
                                                    <a class="post-author__name" href="author.php"
                                                       rel="author" title="Posts by Connor Randall"> Connor Randall</a>
                                                </div>
                                                <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                      title="March 6, 2021 at 8:45 am">March 6, 2021
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="list-item">
                            <article class="post post--vertical post--vertical-card-background"
                                     data-dark-mode="true">
                                <div class="post__thumb object-fit">
                                    <a href="single.php">
                                        <img alt="File not found"
                                             src="../images/x6.jpg.pagespeed.ic.Dzx_eITMOU.jpg">
                                    </a>
                                    <a class="post__cat post__cat--bg overlay-item--top-left"
                                       href="category-1.php">GADGETS</a>
                                </div>
                                <div class="post__text inverse-text">
                                    <h3 class="post__title f-22 f-w-600 m-b-10 m-t-10 atbs-line-limit atbs-line-limit-2">
                                        <a href="single.php">Oculus Working on Update to Improve Rift S Audio</a>
                                    </h3>
                                    <div class="post__meta border-avatar">
                                        <div class="post-author post-author_style-7">
                                            <a class="post-author__avatar" href="author.php"
                                               rel="author" title="Posts by Connor Randall">
                                                <img alt="Connor Randall"
                                                     src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                            </a>
                                            <div class="post-author__text">
                                                <div class="author_name--wrap">
                                                    <span>by</span>
                                                    <a class="post-author__name" href="author.php"
                                                       rel="author" title="Posts by Connor Randall"> Connor Randall</a>
                                                </div>
                                                <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                      title="March 6, 2021 at 8:45 am">March 6, 2021
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
                <div class="section-sub section-right">
                    <div class="posts-list flex-box flex-box-1i posts-list-tablet-2i">
                        <div class="list-item">
                            <article class="post post--vertical post--vertical-card-background"
                                     data-dark-mode="true">
                                <div class="post__thumb object-fit">
                                    <a href="single.php">
                                        <img alt="File not found"
                                             src="../images/x16.jpg.pagespeed.ic.LvT-5PFqru.jpg">
                                    </a>
                                    <a class="post__cat post__cat--bg overlay-item--top-left"
                                       href="category-1.php">GADGETS</a>
                                </div>
                                <div class="post__text inverse-text">
                                    <h3 class="post__title f-22 f-w-600 m-b-10 m-t-10 atbs-line-limit atbs-line-limit-2">
                                        <a href="single.php">Oculus Working on Update to Improve Rift S Audio</a>
                                    </h3>
                                    <div class="post__meta border-avatar">
                                        <div class="post-author post-author_style-7">
                                            <a class="post-author__avatar" href="author.php"
                                               rel="author" title="Posts by Connor Randall">
                                                <img alt="Connor Randall"
                                                     src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                            </a>
                                            <div class="post-author__text">
                                                <div class="author_name--wrap">
                                                    <span>by</span>
                                                    <a class="post-author__name" href="author.php"
                                                       rel="author" title="Posts by Connor Randall"> Connor Randall</a>
                                                </div>
                                                <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                      title="March 6, 2021 at 8:45 am">March 6, 2021
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="list-item">
                            <article class="post post--vertical post--vertical-card-background"
                                     data-dark-mode="true">
                                <div class="post__thumb object-fit">
                                    <a href="single.php">
                                        <img alt="File not found"
                                             src="../images/x51.jpg.pagespeed.ic.q9GuAyi1ty.jpg">
                                    </a>
                                    <a class="post__cat post__cat--bg overlay-item--top-left"
                                       href="category-1.php">GADGETS</a>
                                </div>
                                <div class="post__text inverse-text">
                                    <h3 class="post__title f-22 f-w-600 m-b-10 m-t-10 atbs-line-limit atbs-line-limit-2">
                                        <a href="single.php">Oculus Working on Update to Improve Rift S Audio</a>
                                    </h3>
                                    <div class="post__meta border-avatar">
                                        <div class="post-author post-author_style-7">
                                            <a class="post-author__avatar" href="author.php"
                                               rel="author" title="Posts by Connor Randall">
                                                <img alt="Connor Randall"
                                                     src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                            </a>
                                            <div class="post-author__text">
                                                <div class="author_name--wrap">
                                                    <span>by</span>
                                                    <a class="post-author__name" href="author.php"
                                                       rel="author" title="Posts by Connor Randall"> Connor Randall</a>
                                                </div>
                                                <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                      title="March 6, 2021 at 8:45 am">March 6, 2021
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- module-5 -->
    <!-- module-6 -->
    <div class="atbs-block atbs-block--fullwidth atbs-featured-module-6">
        <div class="container">
            <div class="block-heading block-heading_style-1 block-heading--center block-heading-no-line">
                <h4 class="block-heading__title">
                    <span class="first-word">editor's </span><span> choise</span>
                </h4>
            </div>
        </div>
        <div class="container">
            <div class="atbs-block__inner flex-box">
                <div class="section-main">
                    <article
                        class="post post--overlay post--overlay-cylinder-small post--overlay-bottom post--overlay-height-770 post--overlay-padding-lg">
                        <div class="post__thumb post__thumb--overlay atbs-thumb-object-fit">
                            <a href="single.php">
                                <img alt="file not found" src="../images/x9.jpg.pagespeed.ic.inGC_uTvF0.jpg">
                            </a>
                        </div>
                        <div class="post__text inverse-text">
                            <div class="post__text-wrap">
                                <div class="post__text-inner">
                                    <h3 class="post__title f-32 f-w-700 m-b-15">
                                        <a href="single.php">Keep Your Eyes On The Stars And Your Feet On The
                                            Ground.</a>
                                    </h3>
                                    <div class="post__excerpt atbs-line-limit atbs-line-limit-3 m-b-20">
                                        The shark swam away when the boy's father jumped into the water, but the
                                        child suffered lacerations across his body
                                    </div>
                                    <div class="post__meta">
                                        <div class="post-author post-author_style-7">
                                            <a class="post-author__avatar" href="author.php"
                                               rel="author" title="Posts by Connor Randall">
                                                <img alt="Connor Randall"
                                                     src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                            </a>
                                            <div class="post-author__text">
                                                <div class="author_name--wrap">
                                                    <span>by</span>
                                                    <a class="post-author__name" href="author.php"
                                                       rel="author" title="Posts by Connor Randall"> Connor Randall</a>
                                                </div>
                                                <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                      title="March 6, 2021 at 8:45 am">March 6, 2021
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="link-overlay" href="single.php"></a>
                        <a class="post__cat post__cat--bg overlay-item--top-left" href="category-1.php">GADGETS</a>
                    </article>
                </div>
                <div class="section-sub">
                    <div class="posts-list flex-box flex-box-1i flex-space-30 posts-list-tablet-2i">
                        <div class="list-item">
                            <article
                                class="post post--overlay post--overlay-background-blur-primary post--overlay-height-370">
                                <div class="post__thumb  post__thumb--overlay atbs-thumb-object-fit">
                                    <a href="single.php"><img
                                            alt="File not found"
                                            src="../images/x12.jpg.pagespeed.ic.D97Kd4sf7I.jpg"></a>
                                </div>
                                <div class="post__text inverse-text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner flex-box flex-direction-column">
                                            <div class="post__text-group">
                                                <a class="post__cat" href="category-1.php">Mobile</a>
                                                <h3 class="post__title f-22 f-w-700 m-t-15 m-b-20"><a
                                                        href="single.php">Rivals in Gaming, Microsoft And Sony Team
                                                        Up on Cloud Services</a></h3>
                                                <div class="post__excerpt atbs-line-limit atbs-line-limit-3 m-b-0">
                                                    Here are some of the most impressive ones to next expedition
                                                </div>
                                            </div>
                                            <div class="post__text-group flex-item-auto-bottom">
                                                <div
                                                    class="post__meta time-style-1 flex-box justify-content-space align-item-center flex-column-100">
                                                    <div class="post-author post-author_style-6">
                                                        <div class="post-author__text">
                                                            <div class="author_name--wrap">
                                                                <span>by</span>
                                                                <a class="post-author__name"
                                                                   href="author.php" rel="author"
                                                                   title="Posts by Connor Randall"> Connor Randall</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <time class="time published"
                                                          datetime="2021-03-06T08:45:23+00:00"
                                                          title="March 6, 2021 at 8:45 am">March 6, 2021
                                                    </time>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="link-overlay" href="single.php"></a>
                            </article>
                        </div>
                        <div class="list-item">
                            <article
                                class="post post--overlay post--overlay-background-blur-primary post--overlay-height-370">
                                <div class="post__thumb  post__thumb--overlay atbs-thumb-object-fit">
                                    <a href="single.php"><img
                                            alt="File not found"
                                            src="../images/x44.jpg.pagespeed.ic.CuLi-SGHYS.jpg"></a>
                                </div>
                                <div class="post__text inverse-text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner flex-box flex-direction-column">
                                            <div class="post__text-group">
                                                <a class="post__cat" href="category-1.php">Mobile</a>
                                                <h3 class="post__title f-22 f-w-700 m-t-15 m-b-20"><a
                                                        href="single.php">Rivals in Gaming, Microsoft And Sony Team
                                                        Up on Cloud Services</a></h3>
                                                <div class="post__excerpt atbs-line-limit atbs-line-limit-3 m-b-0">
                                                    Here are some of the most impressive ones to next expedition
                                                </div>
                                            </div>
                                            <div class="post__text-group flex-item-auto-bottom">
                                                <div
                                                    class="post__meta time-style-1 flex-box justify-content-space align-item-center flex-column-100">
                                                    <div class="post-author post-author_style-6">
                                                        <div class="post-author__text">
                                                            <div class="author_name--wrap">
                                                                <span>by</span>
                                                                <a class="post-author__name"
                                                                   href="author.php" rel="author"
                                                                   title="Posts by Connor Randall"> Connor Randall</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <time class="time published"
                                                          datetime="2021-03-06T08:45:23+00:00"
                                                          title="March 6, 2021 at 8:45 am">March 6, 2021
                                                    </time>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="link-overlay" href="single.php"></a>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- module-6 -->
    <!-- module-7 -->
    <div class="atbs-block atbs-block--fullwidth atbs-featured-module-7">
        <div class="container">
            <div class="block-heading block-heading_style-1 block-heading--center block-heading-no-line">
                <h4 class="block-heading__title">
                    <span class="first-word">editor's </span><span> choise</span>
                </h4>
            </div>
        </div>
        <div class="atbs-block__inner background-dots">
            <div class="container">
                <div class="atbs-block__inner-group flex-box">
                    <div class="section-main">
                        <div class="post-main">
                            <article
                                class="post post--horizontal post--horizontal-middle post--horizontal-cylinder">
                                <div class="post__thumb object-fit">
                                    <a href="single.php"><img
                                            alt="File not found"
                                            src="../images/4.jpg.pagespeed.ce.ksyJTHqoXB.jpg"></a>
                                </div>
                                <div class="post__text inverse-text">
                                    <a class="post__cat post__cat--bg" href="category-1.php">GADGETS</a>
                                    <h3 class="post__title f-32 f-w-700 m-t-10 m-b-15 atbs-line-limit atbs-line-limit-3">
                                        <a href="single.php">Life Is Either A Daring Adventure Or Nothing At
                                            All</a>
                                    </h3>
                                    <div class="post__excerpt m-t-0 m-b-25">
                                        Last month, Tesla announced it had set up a new data center in mainland
                                        China to keep...
                                    </div>
                                    <div class="post__meta">
                                        <div class="post-author post-author_style-7">
                                            <a class="post-author__avatar" href="author.php"
                                               rel="author" title="Posts by Connor Randall">
                                                <img alt="Connor Randall"
                                                     src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                            </a>
                                            <div class="post-author__text">
                                                <div class="author_name--wrap">
                                                    <span>by</span>
                                                    <a class="post-author__name" href="author.php"
                                                       rel="author" title="Posts by Connor Randall"> Connor Randall</a>
                                                </div>
                                                <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                      title="March 6, 2021 at 8:45 am">March 6, 2021
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="post-sub">
                            <div class="posts-list flex-box flex-box-2i flex-space-40 posts-list-tablet-2i">
                                <div class="list-item">
                                    <article
                                        class="post post--horizontal post--horizontal-middle post--horizontal-card-space flex-box">
                                        <div class="post__thumb object-fit">
                                            <a href="single.php"><img
                                                    alt="File not found"
                                                    src="../images/3.jpg.pagespeed.ce.epdGxZrfIQ.jpg"></a>
                                        </div>
                                        <div class="post__text inverse-text">
                                            <a class="post__cat" href="category-1.php">GADGETS</a>
                                            <h3 class="post__title f-18 f-w-500 m-t-10 m-b-10 atbs-line-limit atbs-line-limit-2">
                                                <a href="single.php">Life Is Too Important To Be Taken
                                                    Seriously</a>
                                            </h3>
                                            <div class="post__meta flex-box time-style-1">
                                                <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                      title="March 6, 2021 at 8:45 am">March 6, 2021
                                                </time>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="list-item">
                                    <article
                                        class="post post--horizontal post--horizontal-middle post--horizontal-card-space flex-box">
                                        <div class="post__thumb object-fit">
                                            <a href="single.php"><img
                                                    alt="File not found"
                                                    src="../images/x34.jpg.pagespeed.ic.2LSufkqvmb.jpg"></a>
                                        </div>
                                        <div class="post__text inverse-text">
                                            <a class="post__cat" href="category-1.php">GADGETS</a>
                                            <h3 class="post__title f-18 f-w-500 m-t-10 m-b-10 atbs-line-limit atbs-line-limit-2">
                                                <a href="single.php">Life Is Too Important To Be Taken
                                                    Seriously</a>
                                            </h3>
                                            <div class="post__meta flex-box time-style-1">
                                                <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                      title="March 6, 2021 at 8:45 am">March 6, 2021
                                                </time>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-sub">
                        <div class="posts-list flex-box flex-space-30 flex-box-1i posts-list-tablet-2i">
                            <div class="list-item">
                                <article
                                    class="post post--vertical post--vertical-style-card-thumb-aside post--vertical-style-card-thumb-aside-small atbs-post-hover-theme-style post--hover-theme"
                                    data-dark-mode="true">
                                    <div class="post__thumb object-fit">
                                        <a href="single.php">
                                            <img alt="File not found"
                                                 src="../images/x10.jpg.pagespeed.ic.2193TilPH_.jpg">
                                        </a>
                                    </div>
                                    <div class="post__text flex-box flex-direction-column inverse-text">
                                        <div class="post__text-group">
                                            <a class="post__cat post__cat-primary"
                                               href="category-1.php">GADGETS</a>
                                            <h3 class="post__title f-20 f-w-600 m-b-35 m-t-10 atbs-line-limit atbs-line-limit-3">
                                                <a href="single.php">Life Is Too Important To Be Taken
                                                    Seriously</a>
                                            </h3>
                                        </div>
                                        <div class="post__text-group flex-item-auto-bottom">
                                            <div
                                                class="post__meta time-style-1 flex-box justify-content-space align-item-center">
                                                <div class="post-author post-author_style-6">
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>by</span>
                                                            <a class="post-author__name"
                                                               href="author.php" rel="author"
                                                               title="Posts by Connor Randall"> Connor Randall</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                      title="March 6, 2021 at 8:45 am">March 6, 2021
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="list-item">
                                <article
                                    class="post post--vertical post--vertical-style-card-thumb-aside post--vertical-style-card-thumb-aside-small atbs-post-hover-theme-style post--hover-theme"
                                    data-dark-mode="true">
                                    <div class="post__thumb object-fit">
                                        <a href="single.php">
                                            <img alt="File not found"
                                                 src="../images/x9.jpg.pagespeed.ic.inGC_uTvF0.jpg">
                                        </a>
                                    </div>
                                    <div class="post__text flex-box flex-direction-column inverse-text">
                                        <div class="post__text-group">
                                            <a class="post__cat post__cat-primary"
                                               href="category-1.php">GADGETS</a>
                                            <h3 class="post__title f-20 f-w-600 m-b-35 m-t-10 atbs-line-limit atbs-line-limit-3">
                                                <a href="single.php">Life Is Too Important To Be Taken
                                                    Seriously</a>
                                            </h3>
                                        </div>
                                        <div class="post__text-group flex-item-auto-bottom">
                                            <div
                                                class="post__meta time-style-1 flex-box justify-content-space align-item-center">
                                                <div class="post-author post-author_style-6">
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>by</span>
                                                            <a class="post-author__name"
                                                               href="author.php" rel="author"
                                                               title="Posts by Connor Randall"> Connor Randall</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <time class="time published" datetime="2021-03-06T08:45:23+00:00"
                                                      title="March 6, 2021 at 8:45 am">March 6, 2021
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- module-7 -->
    <div class="atbs-block atbs-block--fullwidth">
        <div class="container">
            <div class="row">
                <div class="atbs-main-col">
                    <!-- listing-grid-1 -->
                    <div class="atbs-block atbs-block--fullwidth atbs-posts-listing--grid-1-has-sidebar">
                        <div
                            class="block-heading block-heading_style-1 block-heading-no-line block-heading_style-1-small">
                            <h4 class="block-heading__title">
                                <span class="first-word">editor's </span><span> choise</span>
                            </h4>
                        </div>
                        <div class="atbs-block__inner">
                            <div class="posts-list flex-box flex-space-30 flex-box-2i posts-list-tablet-2i">
                                <div class="list-item">
                                    <article
                                        class="post post--vertical post--vertical-card-background post--vertical-card-background-small post--hover-theme"
                                        data-dark-mode="true">
                                        <div class="post__thumb object-fit">
                                            <a href="single.php">
                                                <img alt="File not found"
                                                     src="../images/x41.jpg.pagespeed.ic.nvSrkipbG2.jpg">
                                            </a>
                                            <a class="post__cat post__cat--bg overlay-item--top-left"
                                               href="category-1.php">GADGETS</a>
                                        </div>
                                        <div class="post__text inverse-text">
                                            <h3 class="post__title f-20 f-w-600 m-b-10 m-t-10 atbs-line-limit atbs-line-limit-2">
                                                <a href="single.php">Oculus Working on Update to Improve Rift S
                                                    Audio</a>
                                            </h3>
                                            <div class="post__meta border-avatar">
                                                <div class="post-author post-author_style-7">
                                                    <a class="post-author__avatar" href="author.php"
                                                       rel="author" title="Posts by Connor Randall">
                                                        <img alt="Connor Randall"
                                                             src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                                    </a>
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>by</span>
                                                            <a class="post-author__name"
                                                               href="author.php" rel="author"
                                                               title="Posts by Connor Randall"> Connor Randall</a>
                                                        </div>
                                                        <time class="time published"
                                                              datetime="2021-03-06T08:45:23+00:00"
                                                              title="March 6, 2021 at 8:45 am">March 6, 2021
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="list-item">
                                    <article
                                        class="post post--vertical post--vertical-card-background post--vertical-card-background-small post--hover-theme"
                                        data-dark-mode="true">
                                        <div class="post__thumb object-fit">
                                            <a href="single.php">
                                                <img alt="File not found"
                                                     src="../images/x39.jpg.pagespeed.ic.v5Lmp-m7EV.jpg">
                                            </a>
                                            <a class="post__cat post__cat--bg overlay-item--top-left"
                                               href="category-1.php">GADGETS</a>
                                        </div>
                                        <div class="post__text inverse-text">
                                            <h3 class="post__title f-20 f-w-600 m-b-10 m-t-10 atbs-line-limit atbs-line-limit-2">
                                                <a href="single.php">Oculus Working on Update to Improve Rift S
                                                    Audio</a>
                                            </h3>
                                            <div class="post__meta border-avatar">
                                                <div class="post-author post-author_style-7">
                                                    <a class="post-author__avatar" href="author.php"
                                                       rel="author" title="Posts by Connor Randall">
                                                        <img alt="Connor Randall"
                                                             src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                                    </a>
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>by</span>
                                                            <a class="post-author__name"
                                                               href="author.php" rel="author"
                                                               title="Posts by Connor Randall"> Connor Randall</a>
                                                        </div>
                                                        <time class="time published"
                                                              datetime="2021-03-06T08:45:23+00:00"
                                                              title="March 6, 2021 at 8:45 am">March 6, 2021
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="list-item">
                                    <article
                                        class="post post--vertical post--vertical-card-background post--vertical-card-background-small post--hover-theme"
                                        data-dark-mode="true">
                                        <div class="post__thumb object-fit">
                                            <a href="single.php">
                                                <img alt="File not found"
                                                     src="../images/x21.jpg.pagespeed.ic.GxpFwn4c5G.jpg">
                                            </a>
                                            <a class="post__cat post__cat--bg overlay-item--top-left"
                                               href="category-1.php">GADGETS</a>
                                        </div>
                                        <div class="post__text inverse-text">
                                            <h3 class="post__title f-20 f-w-600 m-b-10 m-t-10 atbs-line-limit atbs-line-limit-2">
                                                <a href="single.php">Oculus Working on Update to Improve Rift S
                                                    Audio</a>
                                            </h3>
                                            <div class="post__meta border-avatar">
                                                <div class="post-author post-author_style-7">
                                                    <a class="post-author__avatar" href="author.php"
                                                       rel="author" title="Posts by Connor Randall">
                                                        <img alt="Connor Randall"
                                                             src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                                    </a>
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>by</span>
                                                            <a class="post-author__name"
                                                               href="author.php" rel="author"
                                                               title="Posts by Connor Randall"> Connor Randall</a>
                                                        </div>
                                                        <time class="time published"
                                                              datetime="2021-03-06T08:45:23+00:00"
                                                              title="March 6, 2021 at 8:45 am">March 6, 2021
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="list-item">
                                    <article
                                        class="post post--vertical post--vertical-card-background post--vertical-card-background-small post--hover-theme"
                                        data-dark-mode="true">
                                        <div class="post__thumb object-fit">
                                            <a href="single.php">
                                                <img alt="File not found"
                                                     src="../images/x1.jpg.pagespeed.ic.lC-7aJNJix.jpg">
                                            </a>
                                            <a class="post__cat post__cat--bg overlay-item--top-left"
                                               href="category-1.php">GADGETS</a>
                                        </div>
                                        <div class="post__text inverse-text">
                                            <h3 class="post__title f-20 f-w-600 m-b-10 m-t-10 atbs-line-limit atbs-line-limit-2">
                                                <a href="single.php">Oculus Working on Update to Improve Rift S
                                                    Audio</a>
                                            </h3>
                                            <div class="post__meta border-avatar">
                                                <div class="post-author post-author_style-7">
                                                    <a class="post-author__avatar" href="author.php"
                                                       rel="author" title="Posts by Connor Randall">
                                                        <img alt="Connor Randall"
                                                             src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                                    </a>
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>by</span>
                                                            <a class="post-author__name"
                                                               href="author.php" rel="author"
                                                               title="Posts by Connor Randall"> Connor Randall</a>
                                                        </div>
                                                        <time class="time published"
                                                              datetime="2021-03-06T08:45:23+00:00"
                                                              title="March 6, 2021 at 8:45 am">March 6, 2021
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="list-item">
                                    <article
                                        class="post post--vertical post--vertical-card-background post--vertical-card-background-small post--hover-theme"
                                        data-dark-mode="true">
                                        <div class="post__thumb object-fit">
                                            <a href="single.php">
                                                <img alt="File not found"
                                                     src="../images/x47.jpg.pagespeed.ic.ym8N9fj4mq.jpg">
                                            </a>
                                            <a class="post__cat post__cat--bg overlay-item--top-left"
                                               href="category-1.php">GADGETS</a>
                                        </div>
                                        <div class="post__text inverse-text">
                                            <h3 class="post__title f-20 f-w-600 m-b-10 m-t-10 atbs-line-limit atbs-line-limit-2">
                                                <a href="single.php">Oculus Working on Update to Improve Rift S
                                                    Audio</a>
                                            </h3>
                                            <div class="post__meta border-avatar">
                                                <div class="post-author post-author_style-7">
                                                    <a class="post-author__avatar" href="author.php"
                                                       rel="author" title="Posts by Connor Randall">
                                                        <img alt="Connor Randall"
                                                             src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                                    </a>
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>by</span>
                                                            <a class="post-author__name"
                                                               href="author.php" rel="author"
                                                               title="Posts by Connor Randall"> Connor Randall</a>
                                                        </div>
                                                        <time class="time published"
                                                              datetime="2021-03-06T08:45:23+00:00"
                                                              title="March 6, 2021 at 8:45 am">March 6, 2021
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="list-item">
                                    <article
                                        class="post post--vertical post--vertical-card-background post--vertical-card-background-small post--hover-theme"
                                        data-dark-mode="true">
                                        <div class="post__thumb object-fit">
                                            <a href="single.php">
                                                <img alt="File not found"
                                                     src="../images/x42.jpg.pagespeed.ic.oAeuycxQzj.jpg">
                                            </a>
                                            <a class="post__cat post__cat--bg overlay-item--top-left"
                                               href="category-1.php">GADGETS</a>
                                        </div>
                                        <div class="post__text inverse-text">
                                            <h3 class="post__title f-20 f-w-600 m-b-10 m-t-10 atbs-line-limit atbs-line-limit-2">
                                                <a href="single.php">Oculus Working on Update to Improve Rift S
                                                    Audio</a>
                                            </h3>
                                            <div class="post__meta border-avatar">
                                                <div class="post-author post-author_style-7">
                                                    <a class="post-author__avatar" href="author.php"
                                                       rel="author" title="Posts by Connor Randall">
                                                        <img alt="Connor Randall"
                                                             src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                                    </a>
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>by</span>
                                                            <a class="post-author__name"
                                                               href="author.php" rel="author"
                                                               title="Posts by Connor Randall"> Connor Randall</a>
                                                        </div>
                                                        <time class="time published"
                                                              datetime="2021-03-06T08:45:23+00:00"
                                                              title="March 6, 2021 at 8:45 am">March 6, 2021
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="list-item">
                                    <article
                                        class="post post--vertical post--vertical-card-background post--vertical-card-background-small post--hover-theme"
                                        data-dark-mode="true">
                                        <div class="post__thumb object-fit">
                                            <a href="single.php">
                                                <img alt="File not found"
                                                     src="../images/4.jpg.pagespeed.ce.ksyJTHqoXB.jpg">
                                            </a>
                                            <a class="post__cat post__cat--bg overlay-item--top-left"
                                               href="category-1.php">GADGETS</a>
                                        </div>
                                        <div class="post__text inverse-text">
                                            <h3 class="post__title f-20 f-w-600 m-b-10 m-t-10 atbs-line-limit atbs-line-limit-2">
                                                <a href="single.php">Oculus Working on Update to Improve Rift S
                                                    Audio</a>
                                            </h3>
                                            <div class="post__meta border-avatar">
                                                <div class="post-author post-author_style-7">
                                                    <a class="post-author__avatar" href="author.php"
                                                       rel="author" title="Posts by Connor Randall">
                                                        <img alt="Connor Randall"
                                                             src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                                    </a>
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>by</span>
                                                            <a class="post-author__name"
                                                               href="author.php" rel="author"
                                                               title="Posts by Connor Randall"> Connor Randall</a>
                                                        </div>
                                                        <time class="time published"
                                                              datetime="2021-03-06T08:45:23+00:00"
                                                              title="March 6, 2021 at 8:45 am">March 6, 2021
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="list-item">
                                    <article
                                        class="post post--vertical post--vertical-card-background post--vertical-card-background-small post--hover-theme"
                                        data-dark-mode="true">
                                        <div class="post__thumb object-fit">
                                            <a href="single.php">
                                                <img alt="File not found"
                                                     src="../images/3.jpg.pagespeed.ce.epdGxZrfIQ.jpg">
                                            </a>
                                            <a class="post__cat post__cat--bg overlay-item--top-left"
                                               href="category-1.php">GADGETS</a>
                                        </div>
                                        <div class="post__text inverse-text">
                                            <h3 class="post__title f-20 f-w-600 m-b-10 m-t-10 atbs-line-limit atbs-line-limit-2">
                                                <a href="single.php">Oculus Working on Update to Improve Rift S
                                                    Audio</a>
                                            </h3>
                                            <div class="post__meta border-avatar">
                                                <div class="post-author post-author_style-7">
                                                    <a class="post-author__avatar" href="author.php"
                                                       rel="author" title="Posts by Connor Randall">
                                                        <img alt="Connor Randall"
                                                             src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg">
                                                    </a>
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>by</span>
                                                            <a class="post-author__name"
                                                               href="author.php" rel="author"
                                                               title="Posts by Connor Randall"> Connor Randall</a>
                                                        </div>
                                                        <time class="time published"
                                                              datetime="2021-03-06T08:45:23+00:00"
                                                              title="March 6, 2021 at 8:45 am">March 6, 2021
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- listing-grid-1 -->
                </div>
                <div class="atbs-sub-col js-sticky-sidebar">
                    <!-- widget-1 -->
                    <div class="widget atbs-atbs-widget atbs-widget-posts-1">
                        <div class="widget-wrap">
                            <div class="widget__title">
                                <h4 class="widget__title-text"><span
                                        class="first-word">Most</span><span> post</span></h4>
                            </div>
                            <div class="widget__inner">
                                <div class="posts-list flex-box flex-space-30 flex-box-1i posts-list-tablet-2i">
                                    <div class="list-item">
                                        <article class="post post--vertical post--vertical-rectangle-outside">
                                            <div class="post__thumb object-fit">
                                                <a href="single.php"><img
                                                        alt="file not found"
                                                        src="../images/x41.jpg.pagespeed.ic.nvSrkipbG2.jpg"></a>
                                                <a class="post__cat post__cat--bg"
                                                   href="category-1.php">GADGETS</a>
                                            </div>
                                            <div class="post__text text-center">
                                                <h3 class="post__title f-18 m-b-5 f-w-500">
                                                    <a href="single.php">Oculus Working on Update to Improve Rift S
                                                        Audio</a>
                                                </h3>
                                                <div class="post__meta time-style-1">
                                                    <time class="time published"
                                                          datetime="2021-03-06T08:45:23+00:00"
                                                          title="March 6, 2021 at 8:45 am">March 6, 2021
                                                    </time>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="list-item">
                                        <article class="post post--vertical post--vertical-rectangle-outside">
                                            <div class="post__thumb object-fit">
                                                <a href="single.php"><img
                                                        alt="file not found"
                                                        src="../images/x39.jpg.pagespeed.ic.v5Lmp-m7EV.jpg"></a>
                                                <a class="post__cat post__cat--bg"
                                                   href="category-1.php">GADGETS</a>
                                            </div>
                                            <div class="post__text text-center">
                                                <h3 class="post__title f-18 m-b-5 f-w-500">
                                                    <a href="single.php">Oculus Working on Update to Improve Rift S
                                                        Audio</a>
                                                </h3>
                                                <div class="post__meta time-style-1">
                                                    <time class="time published"
                                                          datetime="2021-03-06T08:45:23+00:00"
                                                          title="March 6, 2021 at 8:45 am">March 6, 2021
                                                    </time>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="list-item">
                                        <article class="post post--vertical post--vertical-rectangle-outside">
                                            <div class="post__thumb object-fit">
                                                <a href="single.php"><img
                                                        alt="file not found"
                                                        src="../images/x21.jpg.pagespeed.ic.GxpFwn4c5G.jpg"></a>
                                                <a class="post__cat post__cat--bg"
                                                   href="category-1.php">GADGETS</a>
                                            </div>
                                            <div class="post__text text-center">
                                                <h3 class="post__title f-18 m-b-5 f-w-500">
                                                    <a href="single.php">Oculus Working on Update to Improve Rift S
                                                        Audio</a>
                                                </h3>
                                                <div class="post__meta time-style-1">
                                                    <time class="time published"
                                                          datetime="2021-03-06T08:45:23+00:00"
                                                          title="March 6, 2021 at 8:45 am">March 6, 2021
                                                    </time>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- widget-1 -->
                    <!-- widget-2 -->
                    <div class="widget atbs-atbs-widget atbs-widget-posts-1">
                        <div class="widget-wrap">
                            <div class="widget__title">
                                <h4 class="widget__title-text"><span
                                        class="first-word">Most</span><span> post</span></h4>
                            </div>
                            <div class="widget__inner">
                                <div class="posts-list flex-box flex-space-30 flex-box-1i posts-list-tablet-2i">
                                    <div class="list-item">
                                        <article
                                            class="post post--horizontal post--horizontal-xxs post--horizontal-middle">
                                            <div class="post__thumb atbs-thumb-object-fit">
                                                <a href="single.php"><img
                                                        alt="File not found"
                                                        src="../images/x41.jpg.pagespeed.ic.nvSrkipbG2.jpg"></a>
                                            </div>
                                            <div class="post__text">
                                                <h3 class="post__title f-16 f-w-500">
                                                    <a href="single.php">Never Let The Fear Of Striking Out Keep
                                                        You</a>
                                                </h3>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="list-item">
                                        <article
                                            class="post post--horizontal post--horizontal-xxs post--horizontal-middle">
                                            <div class="post__thumb atbs-thumb-object-fit">
                                                <a href="single.php"><img
                                                        alt="File not found"
                                                        src="../images/x39.jpg.pagespeed.ic.v5Lmp-m7EV.jpg"></a>
                                            </div>
                                            <div class="post__text">
                                                <h3 class="post__title f-16 f-w-500">
                                                    <a href="single.php">Never Let The Fear Of Striking Out Keep
                                                        You</a>
                                                </h3>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="list-item">
                                        <article
                                            class="post post--horizontal post--horizontal-xxs post--horizontal-middle">
                                            <div class="post__thumb atbs-thumb-object-fit">
                                                <a href="single.php"><img
                                                        alt="File not found"
                                                        src="../images/x21.jpg.pagespeed.ic.GxpFwn4c5G.jpg"></a>
                                            </div>
                                            <div class="post__text">
                                                <h3 class="post__title f-16 f-w-500">
                                                    <a href="single.php">Never Let The Fear Of Striking Out Keep
                                                        You</a>
                                                </h3>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- widget-2 -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .site-content -->
<?php include_once "../templates/footer.php" ?>
