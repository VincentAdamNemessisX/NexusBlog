<?php include_once "../templates/header.php" ?>
<div class="site-content">
    <!-- module-2 -->
    <div class="atbs-block atbs-block--fullwidth atbs-featured-module-2">
        <div class="container leaveToTop">
            <div class="block-heading block-heading_style-1 block-heading--center block-heading-no-line">
                <?php $currenttype = mysqli_fetch_array(queryData('blogtype', 'name',
                    "blogtypeid = $_GET[typeid]"))['name'];
                ?>
                <h4 class="block-heading__title">
                    <span class="first-word"><?php echo $currenttype ?></span>
                    <span>专栏</span>
                </h4>
            </div>
        </div>
        <div class="container">
            <div class="atbs-block__inner flex-box flex-box-1i">
                <div class="section-main">
                    <div class="section-main__inner flex-box flex-space-30">
                        <?php
                        $blogrst = []; $blog = [];
                        $blogrst = queryData('accounts, blog, blogtype, blogimages ',
                            '*', 'blog.blogid = blogimages.blogid and
                             blog.author = accounts.username and blog.type = blogtype.name
                             and blogtype.blogtypeid = ' . $_GET['typeid'] . ' order by blog.readTimes desc' ,
                            0, 4);
                        $blog = mysqli_fetch_array($blogrst);
                        $blogpublishTime = date("Y年m月", strtotime($blog['publishTime']));
                        $blogimagesurl = explode(',', $blog['imagesurl']);
                        $blogauthor = $blog['nickName'] ?? $blog['username'];
                        echo <<<postmain
                        <div class="post-main">
                            <article
                                class="post post--overlay post--overlay-medium post--overlay-bottom post--overlay-height-440 post--overlay-padding-lg">
                                <div class="post__thumb post__thumb--overlay atbs-thumb-object-fit">
                                    <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">
                                        <img alt="file not found"
                                             src="$blogimagesurl[0]">
                                    </a>
                                </div>
                                <div class="post__text inverse-text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner">
                                            <h3 class="post__title f-28 f-w-700 m-b-15">
                                                <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">$blog[title]</a>
                                            </h3>
                                            <div class="post__meta">
                                                <div class="post-author post-author_style-7">
                                                    <a class="post-author__avatar" 
                                                    href="author.php?authorid=$blog[accountid]"
                                                       rel="author" title="Posts by $blog[author]">
                                                        <img alt="$blog[author]"
                                                             src="$blog[headPortrait]">
                                                    </a>
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>由</span>
                                                            <a class="post-author__name"
                                                               href="author.php?authorid=$[accountid]" rel="author"
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
                                <a class="link-overlay" href="$blog[blogshowstyle]?blogid=$blog[blogid]"></a>
                                <a class="post__cat post__cat--bg overlay-item--top-left"
                                   href="categorystyle-$blog[showstyle].php?typeid=$blog[blogtypeid]">$blog[type]</a>
                            </article>
                        </div>
postmain;
                        $blog = mysqli_fetch_array($blogrst);
                        $blogpublishTime = date("Y年m月", strtotime($blog['publishTime']));
                        $blogimagesurl = explode(',', $blog['imagesurl']);
                        $blogauthor = $blog['nickName'] ?? $blog['username'];
                        echo <<<postsub
                        <div class="post-sub">
                            <article
                                class="post post--vertical post--vertical-style-card-thumb-aside post--hover-theme"
                                data-dark-mode="true">
                                <div class="post__thumb object-fit">
                                    <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">
                                        <img alt="File not found"
                                             src="$blogimagesurl[0]">
                                    </a>
                                </div>
                                <div class="post__text flex-box flex-direction-column inverse-text">
                                    <div class="post__text-group">
                                        <a class="post__cat post__cat-primary"
                                         href="categorystyle-$blog[showstyle].php?typeid=$blog[blogtypeid]">
                                         $blog[type]</a>
                                        <h3 class="post__title f-20 f-w-600 m-b-35 m-t-10 atbs-line-limit atbs-line-limit-3">
                                            <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">$blog[title]</a>
                                        </h3>
                                    </div>
                                    <div class="post__text-group flex-item-auto-bottom">
                                        <div
                                            class="post__meta time-style-1 flex-box justify-content-space align-item-center">
                                            <div class="post-author post-author_style-6">
                                                <div class="post-author__text">
                                                    <div class="author_name--wrap">
                                                        <span>由</span>
                                                        <a class="post-author__name" 
                                                        href="author.php?authorid=$blog[accountid]"
                                                           rel="author" title="Posts by $blogauthor">
                                                        $blogauthor</a>
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
                <div class="section-sub m-t-30">
                    <div class="section-sub__inner flex-box flex-space-30">
                        <?php
                        $blog = mysqli_fetch_array($blogrst);
                        $blogpublishTime = date("Y年m月", strtotime($blog['publishTime']));
                        $blogimagesurl = explode(',', $blog['imagesurl']);
                        $blogauthor = $blog['nickName'] ?? $blog['username'];
                        echo <<<postmain
                        <div class="post-main">
                            <article
                                class="post post--overlay  post--overlay-medium post--overlay-bottom post--overlay-height-440 post--overlay-padding-lg">
                                <div class="post__thumb post__thumb--overlay atbs-thumb-object-fit">
                                    <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">
                                        <img alt="file not found"
                                             src="$blogimagesurl[0]">
                                    </a>
                                </div>
                                <div class="post__text inverse-text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner">
                                            <h3 class="post__title f-28 f-w-700 m-b-15">
                                                <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">$blog[title]</a>
                                            </h3>
                                            <div class="post__meta">
                                                <div class="post-author post-author_style-7">
                                                    <a class="post-author__avatar" 
                                                    href="author.php?authorid=$blog[accountid]"
                                                       rel="author" title="Posts by $blogauthor">
                                                        <img alt="$blogauthor"
                                                             src="$blog[headPortrait]">
                                                    </a>
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>由</span>
                                                            <a class="post-author__name"
                                                               href="author.php?authorid=$blog[accountid]" rel="author"
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
                                <a class="link-overlay" href="$blog[blogshowstyle]?blogid=$blog[blogid]"></a>
                                <a class="post__cat post__cat--bg overlay-item--top-left"
                                   href="categorystyle-$blog[showstyle].php?typeid=$blog[blogtypeid]">$blog[type]</a>
                            </article>
                        </div>
postmain;
                        $blog = mysqli_fetch_array($blogrst);
                        $blogpublishTime = date("Y年m月", strtotime($blog['publishTime']));
                        $blogimagesurl = explode(',', $blog['imagesurl']);
                        $blogauthor = $blog['nickName'] ?? $blog['username'];
                        echo <<<postsub
                        <div class="post-sub flex-order-1">
                            <article
                                class="post post--vertical post--vertical-style-card-thumb-aside post--hover-theme"
                                data-dark-mode="true">
                                <div class="post__thumb object-fit">
                                    <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">
                                        <img alt="File not found"
                                             src="$blogimagesurl[0]">
                                    </a>
                                </div>
                                <div class="post__text flex-box flex-direction-column inverse-text">
                                    <div class="post__text-group">
                                        <a class="post__cat post__cat-primary" 
                                        href="categorystyle-$blog[showstyle].php?typeid=$blog[blogtypeid]">
                                        $blog[type]</a>
                                        <h3 class="post__title f-20 f-w-600 m-b-35 m-t-10 atbs-line-limit atbs-line-limit-3">
                                            <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">$blog[title]</a>
                                        </h3>
                                    </div>
                                    <div class="post__text-group flex-item-auto-bottom">
                                        <div
                                            class="post__meta time-style-1 flex-box justify-content-space align-item-center">
                                            <div class="post-author post-author_style-6">
                                                <div class="post-author__text">
                                                    <div class="author_name--wrap">
                                                        <span>由</span>
                                                        <a class="post-author__name" 
                                                        href="author.php?authorid=$blog[accountid]"
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
    </div>
    <!-- module-2 -->
    <div class="atbs-block atbs-block--fullwidth">
        <div class="container">
            <div class="row">
                <div class="atbs-main-col">
                    <!-- listing-grid-1 -->
                    <div class="atbs-block atbs-block--fullwidth atbs-posts-listing--grid-1-has-sidebar">
                        <div
                            class="block-heading block-heading_style-1 block-heading-no-line block-heading_style-1-small">
                            <h4 class="block-heading__title">
                                <span class="first-word">In Category </span><span> Travel</span>
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
                                                     data-pagespeed-url-hash="3134146331"
                                                     src="../images/x41.jpg.pagespeed.ic.nvSrkipbG2.jpg">
                                            </a>
                                            <a class="post__cat post__cat--bg overlay-item--top-left"
                                               href="">GADGETS</a>
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
                                                             data-pagespeed-url-hash="1520034441"
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
            <?php include_once "../templates/blogsidebar.php"; ?>
            </div>
        </div>
    </div>
</div>
<!-- .site-content -->
<?php include_once "../templates/footer.php" ?>
