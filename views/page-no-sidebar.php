<?php
include_once "../templates/header.php";
//    include_once "../handle/recommendAirthMethod.php";
?>
<!-- .site-content -->
<div class="site-content">
    <div class="atbs-block atbs-block--fullwidth single-1">
        <div class="atbs-block atbs-block--fullwidth single-entry-wrap">
            <div class="container">
                <?php include_once "../templates/blogcommoncontent.php" ?>
            </div>
        </div>
    </div>
</div>

<!--        本博客相关推荐-->
<div class="atbs-block atbs-block--fullwidth related-posts">
    <div class="container container--narrow">
        <div class="block-heading block-heading_style-1 block-heading--center block-heading-no-line">
            <h4 class="block-heading__title">
                <span class="first-word">相关</span><span>推荐</span>
            </h4>
        </div>
    </div>
    <div class="container">
        <div class="atbs-block__inner">
            <div class="posts-list flex-box flex-box-3i flex-space-30 posts-list-tablet-2i">
                <?php
                //                        print_r(recommendBlogs(3));
                $currentblogid = $_GET['blogid'];
                if($currentblogid === null) {
                    echo "<script>window.history.back()</script>";
                }
                $currentblogtype = mysqli_fetch_array(queryData('blog, blogtype', "type",
                    "blog.type = blogtype.name and blog.blogid = '$currentblogid'"))['type'];
                $blogrst = queryData('blog, blogimages, blogtype', 'blog.blogid, blog.title,
                         blog.author, blog.publishTime, blogtype.name, blogimages.imagesurl, blog.blogshowstyle',
                    'blog.blogid = blogimages.blogid and blog.type = blogtype.name and 
                            blog.type = "'.$currentblogtype.'" and
                            blog.blogid != '.$currentblogid.' order by blog.publishTime desc limit 3');
                while ($blog = mysqli_fetch_array($blogrst)) {
                    $blogid = $blog['blogid'];
                    $blogtitle = $blog['title'];
                    $blogpublishTime = date("Y年m月", strtotime($blog['publishTime']));
                    $blogauthor = $blog['author'];
                    $blogshowstyle = $blog['blogshowstyle'];
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
                                class="post post--vertical post--vertical-style-card-thumb-aside post--hover-theme"
                                data-dark-mode="true">
                                <div class="post__thumb object-fit">
                                    <a href="$blogshowstyle?blogid=$blogid">
                                        <img alt="File not found"
                                             data-pagespeed-url-hash="1270394416"
                                             onload="pagespeed.CriticalImages.checkImageForCriticality(this);"
                                             src="$blogimagesurl[0]">
                                    </a>
                                </div>
                                <div class="post__text flex-box flex-direction-column inverse-text">
                                    <div class="post__text-group">
                                        <a class="post__cat post__cat-primary"
                                         href="categorystyle-$typestyle.php?typeid=$blogtypeid">$blogtype</a>
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
                                                        <span>发布</span>
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
<!-- .site-content -->
<?php include_once "../templates/footer.php" ?>
