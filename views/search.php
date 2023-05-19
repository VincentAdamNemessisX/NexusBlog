<?php include_once "../templates/header.php" ?>
<?php include_once "../function/encodeAllErrorContent.php" ?>
    <div class="site-content leaveToTop">
        <div class="atbs-block atbs-block--fullwidth">
            <div class="container">
                <div class="row">
                    <div class="atbs-main-col">
                        <!-- listing-grid-1 -->
                        <div class="atbs-block atbs-block--fullwidth atbs-posts-listing--grid-1-has-sidebar">
                            <div
                                class="block-heading block-heading_style-1 block-heading-no-line block-heading_style-1-small">
                                <h4 class="block-heading__title">
                                    <?php
                                        $search = encodeAllErrorContent($_GET['q']);
                                        if(!$search) {
                                            echo "<script>window.location.href = '../templates/404.php'</script>";
                                        }
                                    ?>
                                    <span class="first-word">Search For: </span><span><?php echo $search ?></span>
                                </h4>
                            </div>
                            <div class="atbs-block__inner">
                                <div class="posts-list flex-box flex-space-30 flex-box-2i posts-list-tablet-2i">
                                    <?php
                                        $searchblogresults = queryData('blog, blogimages, accounts', '*',
                                            "blog.blogid = blogimages.blogid 
                                            and blog.author = accounts.username
                                            and (title like '%$search%' or abstract like '%$search%' or
                                             content like '%$search%')");
                                        if(mysqli_num_rows($searchblogresults) == 0) {
                                            echo <<<noresult
                                        <div class="searchNoResultsContainer">
                                            <div class="no-result__inner bg-white p-6 rounded-lg shadow">
                                                <div class="no-result__content">
                                                    <h2 class="no-result__title text-2xl font-bold text-gray-800 mb-4">没有找到相关内容</h2>
                                                    <p class="no-result__desc text-gray-600">请尝试更换关键词</p>
                                                </div>
                                            </div>
                                        </div>
noresult;
                                        }
                                        while ($row = mysqli_fetch_array($searchblogresults)) {
                                            $blogimagesurl = explode(',', $row['imagesurl']);
                                            $blogpublishtime = date('Y年m月d日', strtotime($row['publishTime']));
                                            $blogauthor = $row['nickname'] ?? $row['username'];
                                        echo <<<listitem
                                    <div class="list-item">
                                        <article
                                            class="post post--vertical post--vertical-card-background 
                                            post--vertical-card-background-small post--hover-theme"
                                            data-dark-mode="true">
                                            <div class="post__thumb object-fit">
                                                <a href="$row[blogshowstyle]?blogid=$row[blogid]">
                                                    <img alt="File not found"
                                                         data-pagespeed-url-hash="3134146331"
                                                         src="$blogimagesurl[0]">
                                                </a>
                                                <a class="post__cat post__cat--bg overlay-item--top-left"
                                                   href="categorystyle-$row[showstyle].php?typeid=$row[blogtypeid]">
                                                    $row[type]</a>
                                            </div>
                                            <div class="post__text inverse-text">
                                                <h3 class="post__title f-20 f-w-600 m-b-10 m-t-10 atbs-line-limit atbs-line-limit-2">
                                                    <a href="$row[blogshowstyle]?blogid=$row[blogid]">$row[title]</a>
                                                </h3>
                                                <div class="post__meta border-avatar">
                                                    <div class="post-author post-author_style-7">
                                                        <a class="post-author__avatar" 
                                                        href="author.php?authorid=$row[accountid]"
                                                           rel="author" title="Posts by $row[author]">
                                                            <img alt="$row[author]"
                                                                 data-pagespeed-url-hash="1520034441"
                                                                 src="$row[headPortrait]">
                                                        </a>
                                                        <div class="post-author__text">
                                                            <div class="author_name--wrap">
                                                                <span>由</span>
                                                                <a class="post-author__name"
                                                                   href="author.php?authorid=$row[accountid]" rel="author"
                                                                   title="Posts by $row[accountid]">$blogauthor</a>
                                                                <span>发布于</span>
                                                            </div>
                                                            <time class="time published"
                                                                  datetime="$row[publishTime]"
                                                                  title="$row[publishTime]">
                                                                $blogpublishtime
                                                            </time>
                                                        </div>
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
                        <!-- listing-grid-1 -->
                    </div>
                    <?php include_once "../templates/blogsidebar.php";?>
                </div>
            </div>
        </div>
    </div>
    <!-- .site-content -->
<?php include_once "../templates/footer.php" ?>