<div class="atbs-sub-col js-sticky-sidebar leaveToTop sideBarWidth">
    <!--                    最热阅读排行榜-->
    <!-- widget-1 -->
    <div class="widget atbs-atbs-widget atbs-widget-posts-1">
        <div class="widget-wrap">
            <div class="widget__title">
                <h4 class="widget__title-text"><span
                        class="first-word">最热</span><span>阅读</span></h4>
            </div>
            <?php
            $currentauthorid = $_GET["authorid"] ?? null;
            if($currentauthorid) {
                $blogrst = queryData('accounts, blog, blogimages, blogtype', '*',
                    "accounts.username = blog.author and blog.blogid = blogimages.blogid and
                                     blog.type = blogtype.name and accounts.accountid=$currentauthorid
                                      order by readTimes Desc", '0', '3');
            } else {
                $blogrst = queryData('accounts, blog, blogimages, blogtype', '*',
                    'accounts.username = blog.author and blog.blogid = blogimages.blogid and
                                     blog.type = blogtype.name order by readTimes Desc', '0', '3');
            }
            ?>
            <div class="widget__inner">
                <div class="posts-list flex-box flex-space-30 flex-box-1i posts-list-tablet-2i">
                    <?php
                    while ($blog = mysqli_fetch_array($blogrst)) {
                        $blogid = $blog['blogid'];
                        $blogtitle = $blog['title'];
                        $blogpublishTime = date("Y年m月d日", strtotime($blog['publishTime']));
                        $blogauthor = $blog['author'];
                        $blogabstract = $blog['abstract'];
                        $typestyle = $blog['showstyle'];
                        $blogtype = $blog['type'];
                        $blogtypeid = $blog['blogtypeid'];
                        $authorid = $blog['accountid'];
                        $authorheadportrait = $blog['headPortrait'];
                        $blogimagesurl = explode(',', $blog['imagesurl']);
                        echo <<<listitem
                                    <div class="list-item">
                                        <article class="post post--vertical post--vertical-rectangle-outside">
                                            <div class="post__thumb object-fit">
                                                <a href="single.php?blogid=$blogid"><img
                                                        alt="file not found"
                                                        src="$blogimagesurl[0]"></a>
                                                <a class="post__cat post__cat--bg"
                                                   href="categorystyle-$typestyle.php?typeid=$blogtypeid">$blogtype</a>
                                            </div>
                                            <div class="post__text text-center">
                                                <h3 class="post__title f-18 m-b-5 f-w-500">
                                                    <a href="single.php?blogid=$blogid">$blogtitle</a>
                                                </h3>
                                                <div class="post__meta time-style-1">
                                                    <time class="time published"
                                                          datetime="$blogpublishTime"
                                                          title="$blogpublishTime">
                                                        $blogpublishTime
                                                    </time>
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
    <!-- widget-1 -->

    <!--                    最新发布排行榜-->
    <!-- widget-2 -->
    <div class="widget atbs-atbs-widget atbs-widget-posts-1">
        <div class="widget-wrap">
            <div class="widget__title">
                <h4 class="widget__title-text"><span
                        class="first-word">最新</span><span>发布</span></h4>
            </div>
            <?php
            $currentauthorid = $_GET["authorid"] ?? null;
            if($currentauthorid) {
                $blogrst = queryData('accounts, blog, blogimages, blogtype', '*',
                    "accounts.username = blog.author and blog.blogid = blogimages.blogid and
                                     blog.type = blogtype.name and accounts.accountid = $currentauthorid
                                      order by publishTime Desc", '0', '5');
            } else {
                $blogrst = queryData('accounts, blog, blogimages, blogtype', '*',
                    'accounts.username = blog.author and blog.blogid = blogimages.blogid and
                                     blog.type = blogtype.name order by publishTime Desc', '0', '5');
            }
            ?>
            <div class="widget__inner">
                <div class="posts-list flex-box flex-space-30 flex-box-1i posts-list-tablet-2i">
                    <?php
                    while ($blog = mysqli_fetch_array($blogrst)) {
                        $blogid = $blog['blogid'];
                        $blogtitle = $blog['title'];
                        $blogpublishTime = date("Y年m月d日", strtotime($blog['publishTime']));
                        $blogauthor = $blog['author'];
                        $blogabstract = $blog['abstract'];
                        $typestyle = $blog['showstyle'];
                        $blogtype = $blog['type'];
                        $blogtypeid = $blog['blogtypeid'];
                        $authorid = $blog['accountid'];
                        $authorheadportrait = $blog['headPortrait'];
                        $blogimagesurl = explode(',', $blog['imagesurl']);
                        echo <<<listitem
                                    <div class="list-item">
                                        <article
                                            class="post post--horizontal post--horizontal-xxs post--horizontal-middle">
                                            <div class="post__thumb atbs-thumb-object-fit">
                                                <a href="single.php?blogid=$blogid"><img
                                                        alt="File not found"
                                                        src="$blogimagesurl[0]"></a>
                                            </div>
                                            <div class="post__text">
                                                <h3 class="post__title f-16 f-w-500">
                                                    <a href="single.php?blogid=$blogid">$blogtitle</a>
                                                </h3>
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
    <!-- widget-2 -->
</div>
</div>
</div>
</div>
</div>