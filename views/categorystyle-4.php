<?php include_once "../templates/header.php" ?>
    <div class="site-content leaveToTop">
        <div class="atbs-block atbs-block--fullwidth atbs-featured-module-7">
            <div class="container">
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
            <div class="atbs-block__inner background-dots">
                <div class="container">
                    <div class="atbs-block__inner-group flex-box">
                        <div class="section-main">
                            <?php
                            $blogrst = queryData('accounts, blog, blogimages, blogtype', '*',
                                'accounts.username = blog.author and blog.blogid = blogimages.blogid and blog.type = blogtype.name
                        and blog.type = "' .$currenttype. '" order by readTimes Desc', '0', '5');
                            $blog = mysqli_fetch_array($blogrst);
                            $blogpublishTime = date("Y年m月d日", strtotime($blog['publishTime']));
                            $blogimagesurl = explode(',', $blog['imagesurl']);
                            $blogauthor = $blog['nickname'] ?? $blog['username'];
                            echo <<<postmain
                        <div class="post-main">
                            <article
                                class="post post--horizontal post--horizontal-middle post--horizontal-cylinder">
                                <div class="post__thumb object-fit">
                                    <a href="$blog[blogshowstyle]?blogid=$blog[blogid]"><img
                                            alt="File not found"
                                            src="$blogimagesurl[0]"></a>
                                </div>
                                <div class="post__text inverse-text">
                                    <a class="post__cat post__cat--bg"
                                     href="categorystyle-$blog[showstyle].php?typeid=$blog[blogtypeid]">
                                        $blog[type]</a>
                                    <h3 class="post__title f-32 f-w-700 m-t-10 m-b-15 atbs-line-limit atbs-line-limit-3">
                                        <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">$blog[title]</a>
                                    </h3>
                                    <div class="post__excerpt m-t-0 m-b-25">
                                        $blog[abstract]
                                    </div>
                                    <div class="post__meta">
                                        <div class="post-author post-author_style-7">
                                            <a class="post-author__avatar" href="author.php?authorid=$blog[accountid]"
                                               rel="author" title="Posts by $blog[author]">
                                                <img alt="$blogauthor"
                                                     src="$blog[headPortrait]">
                                            </a>
                                            <div class="post-author__text">
                                                <div class="author_name--wrap">
                                                    <span>由</span>
                                                    <a class="post-author__name" 
                                                    href="author.php?authorid=$blog[accountid]"
                                                       rel="author" title="Posts by $blog[author]">$blogauthor</a>
                                                    <span>撰写</span>
                                                </div>
                                                <time class="time published" datetime="$blog[publishTime]"
                                                      title="$blog[publishTime]">
                                                    $blogpublishTime
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="post-sub">
                            <div class="posts-list flex-box flex-box-2i flex-space-40 posts-list-tablet-2i">
postmain;
                            for($i = 0; $i < 2; $i++) {
                                $blog = mysqli_fetch_array($blogrst);
                                $blogpublishTime = date("Y年m月d日", strtotime($blog['publishTime']));
                                $blogimagesurl = explode(',', $blog['imagesurl']);
                                $blogauthor = $blog['nickname'] ?? $blog['username'];
                                echo <<<postsub
                                <div class="list-item">
                                    <article
                                        class="post post--horizontal post--horizontal-middle post--horizontal-card-space flex-box">
                                        <div class="post__thumb object-fit">
                                            <a href="$blog[blogshowstyle]?blogid=$blog[blogid]"><img
                                                    alt="File not found"
                                                    src="$blogimagesurl[0]"></a>
                                        </div>
                                        <div class="post__text inverse-text">
                                            <a class="post__cat" 
                                            href="categorystyle-$blog[showstyle].php?typeid=$blog[blogtypeid]">
                                                $blog[type]</a>
                                            <h3 class="post__title f-18 f-w-500 m-t-10 m-b-10 atbs-line-limit atbs-line-limit-2">
                                                <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">$blog[title]</a>
                                            </h3>
                                            <div class="post__meta flex-box time-style-1">
                                                <time class="time published" datetime="$blogpublishTime"
                                                      title="$blogpublishTime">
                                                    $blogpublishTime
                                                </time>
                                            </div>
                                        </div>
                                    </article>
                                </div>
postsub;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="section-sub">
                    <div class="posts-list flex-box flex-space-30 flex-box-1i posts-list-tablet-2i">
                        <?php
                        while ($blog = mysqli_fetch_array($blogrst)) {
                            $blogpublishTime = date("Y年m月", strtotime($blog['publishTime']));
                            $blogauthor = $blog['nickname'] ?? $blog['username'];
                            $blogimagesurl = explode(',', $blog['imagesurl']);
                            echo <<<listitem
<div class="list-item">
                                <article
                                    class="post post--vertical post--vertical-style-card-thumb-aside post--vertical-style-card-thumb-aside-small atbs-post-hover-theme-style post--hover-theme"
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
                                            <h3 class="post__title f-20 f-w-600 m-b-35 m-t-10 atbs-line-limit 
                                            atbs-line-limit-3">
                                                <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">$blog[title]</a>
                                            </h3>
                                        </div>
                                        <div class="post__text-group flex-item-auto-bottom">
                                            <div
                                                class="post__meta time-style-1 flex-box justify-content-space 
                                                align-item-center">
                                                <div class="post-author post-author_style-6">
                                                    <div class="post-author__text">
                                                        <div class="author_name--wrap">
                                                            <span>由</span>
                                                            <a class="post-author__name"
                                                               href="author.php?authorid=$blog[accountid]" rel="author"
                                                               title="Posts by $blog[author]">$blogauthor</a>
                                                            <span>撰写</span>
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
listitem;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
        <div class="atbs-block atbs-block--fullwidth">
            <div class="container">
                <div class="row">
                    <div class="atbs-main-col">
                        <!-- listing-list-1 -->
                        <div class="atbs-block atbs-block--fullwidth atbs-posts-listing--list-1-has-sidebar">
                            <div
                                class="block-heading block-heading_style-1 block-heading-no-line block-heading_style-1-small">
                                <h4 class="block-heading__title">
                                    <span class="first-word"><?php echo $currenttype ?></span>
                                    <span>之旅</span>
                                </h4>
                            </div>
                            <div class="atbs-block__inner">
                                <div class="posts-list flex-box flex-box-1i flex-space-50">
                                    <?php
                                    $blogrst = queryData('accounts, blog, blogimages, blogtype', '*',
                                        'accounts.username = blog.author and blog.blogid = blogimages.blogid
                                         and blog.type = blogtype.name and blog.type = "' .$currenttype. '" 
                                         order by publishTime Desc');
                                        while ($blog = mysqli_fetch_array($blogrst)) {
                                            $blogpublishTime = date("Y年m月d日", strtotime($blog['publishTime']));
                                            $blogauthor = $blog['nickname'] ?? $blog['username'];
                                            $blogimagesurl = explode(',', $blog['imagesurl']);
                                        echo <<<listitem
                                    <div class="list-item">
                                        <article
                                            class="post post--horizontal post--horizontal-middle post--horizontal-background">
                                            <div class="post__thumb object-fit">
                                                <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">
                                                    <img alt="File not Found"
                                                         data-pagespeed-url-hash="3134146331"
                                                         src="$blogimagesurl[0]">
                                                </a>
                                                <div class="post__meta">
                                                    <div class="post-author post-author_style-7">
                                                        <a class="post-author__avatar" 
                                                        href="author.php?authorid=$blog[accountid]"
                                                           rel="author" title="Posts by $blog[author]">
                                                            <img alt="$blogauthor"
                                                                 data-pagespeed-url-hash="1520034441"
                                                                 src="$blog[headPortrait]">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post__text inverse-text">
                                                <a class="post__cat" 
                                                href="categorystyle-$blog[showstyle].php?typeid=$blog[blogtypeid]">
                                                $blog[type]</a>
                                                <h3 class="post__title f-22 f-w-600 m-t-10 m-b-15">
                                                    <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">
                                                        $blog[title]
                                                    </a>
                                                </h3>
                                                <div class="post__excerpt f-16 f-w-400">
                                                    $blog[abstract]
                                                </div>
                                                <div class="post__readmore m-t-20">
                                                    <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">
                                                        <span class="readmore__text">阅读全文</span>
                                                        <svg height="10.121" viewbox="0 0 19.811 10.121"
                                                             width="19.811" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M17,8l4,4m0,0-4,4m4-4H3" data-name="Path 1414"
                                                                  fill="none" opacity="0.8"
                                                                  stroke="#fff" stroke-linecap="round"
                                                                  stroke-linejoin="round" stroke-width="1.5"
                                                                  transform="translate(-2.25 -6.939)"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
listitem;
                                        }
                                    ?>
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