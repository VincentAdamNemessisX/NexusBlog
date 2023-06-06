<?php include_once "../templates/header.php" ?>
    <div class="site-content">
        <?php
            $currentauthorid = $_GET["authorid"];
            if($currentauthorid == "") {
                echo "<script>window.location.href = '../templates/404.php'</script>";
            } else {
                $authorinfo = mysqli_fetch_array(queryData('accounts', '*',
                    "accountid = $currentauthorid"));
                if(!$authorinfo) {
                    echo "<script>window.location.href = '../templates/404.php'</script>";
                }
                $author = $authorinfo['nickname'] ?? $authorinfo['username'];
                $authorbio = $authorinfo['bio'] ?? "这个人很懒，什么都没有留下。";
            }
        ?>
        <div class="atbs-block atbs-block--fullwidth module-author">
            <div class="container">
                <div class="row" id="top">
                    <div class="atbs-main-col">
                        <!-- author-box -->
                        <?php
                            echo <<<authorbox
                        <div class="author-box">
                            <div class="author-box__image">
                                <div class="author-avatar">
                                    <img alt="$author" class="avatar photo"
                                         src="$authorinfo[headPortrait]">
                                </div>
                            </div>
                            <div class="author-box__text">
                                <div class="author-name meta-font">
                                    <a href="#top" rel="author" title="Posts by $author">$author</a>
                                </div>
                                <div class="author-bio">
                                    $authorbio
                                </div>
                                <div class="author-info">
                                    <ul class="list-unstyled list-horizontal list-space-sm">
                                        <li><a href="mailto:$authorinfo[email]"><i class="mdicon mdicon-mail_outline">                                        
                                            </i><span class="sr-only">e-mail</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
authorbox;
                        ?>
                        <!-- author-box -->
                        <?php
                            $blogrst = queryData('blog, blogimages, accounts, blogtype',
                                '*',
                                "blog.author = accounts.username and blog.type = blogtype.name
                                 and blog.blogid = blogimages.blogid and accounts.accountid = $currentauthorid");
                        ?>
                        <!-- listing-grid-2 -->
                        <div class="atbs-block atbs-block--fullwidth atbs-posts-listing--grid-2-has-sidebar">
                            <div class="atbs-block__inner">
                                <div class="posts-list flex-box flex-box-2i flex-space-30 posts-list-tablet-2i">
    <?php
                                        while ($blog = mysqli_fetch_array($blogrst)) {
                                            $blogauthor = $blog['nickname'] ?? $blog['username'];
                                            $blogimage = explode(',', $blog['imagesurl'])[0];
                                            $blogorignalpublishtime = date('Y年m月d日H时i分s秒', strtotime($blog['publishTime']));
                                            $blogpublishtime = date('Y年m月d日', strtotime($blog['publishTime']));
                                            echo <<<blog
                                    <div class="list-item">
                                        <article
                                            class="post post--vertical post--vertical-style-card-thumb-aside post--hover-theme"
                                            data-dark-mode="true">
                                            <div class="post__thumb object-fit">
                                                <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">
                                                    <img alt="File not found"
                                                         src="$blogimage">
                                                </a>
                                            </div>
                                            <div class="post__text flex-box flex-direction-column inverse-text">
                                                <div class="post__text-group">
                                                    <a class="post__cat post__cat-primary"
                                                       href="categorystyle-$blog[showstyle].php?typeid=$blog[blogtypeid]">
                                                       $blog[name]</a>
                                                    <h3 class="post__title f-20 f-w-600 m-b-35 m-t-10 atbs-line-limit atbs-line-limit-3">
                                                        <a href="$blog[blogshowstyle]?blogid=$blog[blogid]">$blog[abstract]</a>
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
                                                                       href="" rel="author"
                                                                       title="Posts by $blogauthor">$blogauthor</a>
                                                                    <span>发布</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <time class="time published"
                                                              datetime="$blogorignalpublishtime"
                                                              title="$blogorignalpublishtime">
                                                            $blogpublishtime
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
blog;
                                        }
?>
                                </div>
                            </div>
                        </div>
                        <!-- listing-grid-2 -->
                    </div>
                    <?php include_once '../templates/blogsidebar.php' ?>
                </div>
            </div>
        </div>
    </div>
    <!-- .site-content -->
<?php include_once "../templates/footer.php" ?>