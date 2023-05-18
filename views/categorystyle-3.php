<?php include_once "../templates/header.php" ?>
    <div class="site-content">
        <!--    跑步分类博客专题-->
        <!-- module-7 -->
        <div class="atbs-block atbs-block--fullwidth atbs-featured-module-6">
            <div class="container leaveToTop">
                <div class="block-heading block-heading_style-1 block-heading--center block-heading-no-line">
                    <?php $currenttype = mysqli_fetch_array(queryData('blogtype', 'name',
                        "blogtypeid = $_GET[typeid]"))['name'];
                        if ($currenttype == "") {
                            echo "<script>window.location.href = '../templates/404.php'</script>";
                        }
                    ?>
                    <h4 class="block-heading__title">
                        <span class="first-word"><?php echo $currenttype ?></span>
                        <span>专栏</span>
                    </h4>
                </div>
            </div>
            <div class="container">
                <div class="atbs-block__inner flex-box">
                    <?php
                    $blogrst = queryData('accounts, blog, blogimages, blogtype', '*',
                        'accounts.username = blog.author and blog.blogid = blogimages.blogid
                         and blog.type = blogtype.name
                        and blog.type = "'.$currenttype.'" order by readTimes Desc', '0', '3');
                    $blog = mysqli_fetch_array($blogrst);
                    $blogpublishTime = date("Y年m月d日", strtotime($blog['publishTime']));
                    $blogimagesurl = explode(',', $blog['imagesurl']);
                    $blogauthor = $blog['nickname'] ?? $blog['username'];
                    echo <<<sectionmain
                <div class="section-main">
                    <article
                        class="post post--overlay post--overlay-cylinder-small post--overlay-bottom post--overlay-height-770 post--overlay-padding-lg">
                        <div class="post__thumb post__thumb--overlay atbs-thumb-object-fit">
                            <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">
                                <img alt="file not found" src="$blogimagesurl[0]">
                            </a>
                        </div>
                        <div class="post__text inverse-text">
                            <div class="post__text-wrap">
                                <div class="post__text-inner">
                                    <h3 class="post__title f-32 f-w-700 m-b-15">
                                        <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">$blog[title]</a>
                                    </h3>
                                    <div class="post__excerpt atbs-line-limit atbs-line-limit-3 m-b-20">
                                        $blog[abstract]
                                    </div>
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
                                                    href="author.php?authorid=$blog[accountid]""
                                                       rel="author" title="Posts by $blogauthor">$blogauthor</a>
                                                    <span>撰写</span>
                                                </div>
                                                <time class="time published" datetime="$blogpublishTime"
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
                         href="categorystyle-$blog[showstyle].php">$blog[type]</a>
                    </article>
                </div>
sectionmain;
                    ?>
                    <div class="section-sub">
                        <div class="posts-list flex-box flex-box-1i flex-space-30 posts-list-tablet-2i">
                            <?php
                            while ($blog = mysqli_fetch_array($blogrst)) {
                                $blogpublishTime = date("Y年m月d日", strtotime($blog['publishTime']));
                                $blogimagesurl = explode(',', $blog['imagesurl']);
                                $blogauthor = $blog['nickname'] ?? $blog['username'];
                                echo <<<sectionsublistitem
                        <div class="list-item">
                            <article
                                class="post post--overlay post--overlay-background-blur-primary post--overlay-height-370">
                                <div class="post__thumb  post__thumb--overlay atbs-thumb-object-fit">
                                    <a href="$blog[blogshowstyle]?blogid=$blog[blogid]"><img
                                            alt="File not found"
                                            src="$blogimagesurl[0]"></a>
                                </div>
                                <div class="post__text inverse-text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner flex-box flex-direction-column">
                                            <div class="post__text-group">
                                                <a class="post__cat" 
                                                href="categorystyle-$blog[showstyle].php">$blog[type]</a>
                                                <h3 class="post__title f-22 f-w-700 m-t-15 m-b-20"><a
                                                        href="$blog[blogshowstyle]?blogid=$blog[blogid]">$blog[title]</a></h3>
                                                <div class="post__excerpt atbs-line-limit atbs-line-limit-3 m-b-0">
                                                    $blog[abstract]
                                                </div>
                                            </div>
                                            <div class="post__text-group flex-item-auto-bottom">
                                                <div
                                                    class="post__meta time-style-1 flex-box justify-content-space align-item-center flex-column-100">
                                                    <div class="post-author post-author_style-6">
                                                        <div class="post-author__text">
                                                            <div class="author_name--wrap">
                                                                <span>由</span>
                                                                <a class="post-author__name"
                                                                   href="author.php?authorid=$blog[accountid]" rel="author"
                                                                   title="Posts by $blogauthor">$blogauthor</a>
                                                                <span>撰写</span>
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
                                </div>
                                <a class="link-overlay" href="$blog[blogshowstyle]?blogid=$blog[blogid]"></a>
                            </article>
                        </div>
sectionsublistitem;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="atbs-block atbs-block--fullwidth">
            <div class="container">
                <div class="row">
                    <div class="atbs-main-col">
                        <!-- listing-grid-3 -->
                        <div class="atbs-block atbs-block--fullwidth atbs-posts-listing--grid-3-has-sidebar">
                            <div
                                class="block-heading block-heading_style-1 block-heading-no-line block-heading_style-1-small">
                                <h4 class="block-heading__title">
                                    <span class="first-word"><?php echo $currenttype ?></span>
                                    <span>之行</span>
                                </h4>
                            </div>
                            <div class="atbs-block__inner">
                                <div class="posts-list flex-box flex-box-2i flex-space-30 posts-list-tablet-2i">
                                    <?php
                                    $blogrst = queryData('accounts, blog, blogimages', "*",
                                        "blog.author = accounts.username and blog.type='$currenttype' and blog.blogid=blogimages.blogid
                                        order by blog.publishTime desc");
                                    while ($blog = mysqli_fetch_array($blogrst)) {
                                        $blogpublishTime = date("Y年m月d日", strtotime($blog['publishTime']));
                                        $blogimagesurl = explode(',', $blog['imagesurl']);
                                        $blogauthor = $blog['nickname'] ?? $blog['username'];
                                        echo <<<listitem
                                    <div class="list-item">
                                        <article
                                            class="post post--overlay  post--overlay-medium 
                                            post--overlay-bottom post--overlay-height-440 post--overlay-padding-lg">
                                            <div class="post__thumb post__thumb--overlay atbs-thumb-object-fit">
                                                <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">
                                                    <img alt="file not found"
                                                         data-pagespeed-url-hash="3134146331"
                                                         src="$blogimagesurl[0]">
                                                </a>
                                            </div>
                                            <div class="post__text inverse-text">
                                                <div class="post__text-wrap">
                                                    <div class="post__text-inner">
                                                        <h3 class="post__title f-22 f-w-700 m-b-10">
                                                            <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">
                                                                $blog[title]</a>
                                                        </h3>
                                                        <div class="post__meta flex-box time-style-1">
                                                            <div class="post-author post-author_style-6">
                                                                <div class="post-author__text">
                                                                    <div class="author_name--wrap">
                                                                        <span>由</span>
                                                                        <a class="post-author__name"
                                                                           href="author.php?$blog[accountid]" rel="author"
                                                                           title="Posts by $blog[author]">$blogauthor</a>
                                                                        <span>撰写</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <time class="time published"
                                                                  datetime="$blog[publishTime]"
                                                                  title="$blogpublishTime">
                                                                $blogpublishTime
                                                            </time>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="link-overlay" href="$blog[blogshowstyle]?blogid=$blog[blogid]"></a>
                                            <a class="post__cat post__cat--bg overlay-item--top-left"
                                               href="categorystyle-$blog[showstyle].php">$blog[type]</a>
                                        </article>
                                    </div>
listitem;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- listing-grid-3 -->
                    </div>
                    <?php include "../templates/blogsidebar.php"; ?>
                </div>
            </div>
        </div>
    </div>
<?php include_once "../templates/footer.php" ?>