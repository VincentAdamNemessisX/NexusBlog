                <?php
                    $currentblogid = $_GET['blogid'];
                    if($currentblogid === null) {
                        echo "<script>window.history.back()</script>";
                    }
                    $blogrst = queryData('blog, accounts, blogimages', '*',
                    "blog.blogid = blogimages.blogid and blog.blogid = $currentblogid");
                    $blog = mysqli_fetch_array($blogrst);
                    $commentrst = queryData('blog, comment', 'comment.content',
                    'blog.blogid = comment.blogid and blog.blogid = ' . $currentblogid);
                    $commenttotal = mysqli_num_rows($commentrst);
                    if(!$blog) {
                        echo "<script>window.history.back()</script>";
                    }
                    $blogid = $blog['blogid'];
                    $blogtitle = $blog['title'];
                    $blogcontent = $blog['content'];
                    $blogpublishTime = date("Y年m月d日", strtotime($blog['publishTime']));
                    $blogshowstyle = $blog['blogshowstyle'];
                    $blogauthor = $blog['author'];
                    $blogreadtimes = $blog['readTimes'];
                    $blogabstract = $blog['abstract'];
                    $typestyle = $blog['showstyle'];
                    $blogtype = $blog['type'];
                    $blogtypeid = $blog['blogtypeid'];
                    $authorid = $blog['accountid'];
                    $authorbio = $blog['bio'];
                    $authorheadportrait = $blog['headPortrait'];
                    $blogimagesurl = explode(',', $blog['imagesurl']);
                ?>
                <div class="row">
                    <div class="atbs-main-col">
                        <div
                            class="block-heading block-heading_style-1 block-heading-no-line block-heading_style-1-small">
                            <h4 class="block-heading__title">
                                <span class="first-word"><?php echo $blogtitle ?></span>
                            </h4>
                        </div>
                        <?php
                            echo <<<blogtop
<article class="post post--single">
                            <div class="single-content">
                                <div class="single-body entry-content typography-copy">
                                    <div class="single-row">
                                        <div class="single-box-translate js-sticky-sidebar">
                                            <div class="entry-meta">
                                                <div class="entry-author entry-author_style-1">
                                                    <a class="entry-author__avatar" href="author.php?authorid=$authorid"
                                                       rel="author" title="Posts by $blogauthor">
                                                        <img alt="$blogauthor"
                                                             data-pagespeed-url-hash="1520034441"
                                                             onload="pagespeed.CriticalImages.checkImageForCriticality(this);"
                                                             src="$authorheadportrait">
                                                    </a>
                                                    <div class="entry-author__text">
                                                        <a class="entry-author__name"
                                                           href="author.php?authorid=$authorid" rel="author"
                                                           title="Posts by $blogauthor">$blogauthor</a>
                                                        <time class="time published"
                                                              datetime="$blogpublishTime"
                                                              title="$blogpublishTime">
                                                            $blogpublishTime
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="socials-share-box">
                                                <ul class="social-list">
                                                    <li class="facebook-share">
                                                        <a class="sharing-btn sharing-btn-primary
                                                         facebook-btn facebook-theme-bg-hover"
                                                           data-placement="top" href="#" title="Share on Facebook">
                                                            <div class="share-item__icon">
                                                                <svg fill="#888" height="1.3em"
                                                                     preserveaspectratio="xMidYMid meet"
                                                                     viewbox="0 0 40 40"
                                                                     width="1.3em">
                                                                    <g>
                                                                        <path
                                                                            d="m21.7 16.7h5v5h-5v11.6h-5v-11.6h-5v-5h5v-2.1c0-2 0.6-4.5 1.8-5.9 1.3-1.3 2.8-2 4.7-2h3.5v5h-3.5c-0.9 0-1.5 0.6-1.5 1.5v3.5z"></path>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="twitter-share">
                                                        <a class="sharing-btn sharing-btn-primary twitter-btn twitter-theme-bg-hover"
                                                           data-placement="top" href="#" title="Share on Twitter">
                                                            <div class="share-item__icon">
                                                                <svg fill="#888" height="1.3em"
                                                                     preserveaspectratio="xMidYMid meet"
                                                                     viewbox="0 0 40 40"
                                                                     width="1.3em">
                                                                    <g>
                                                                        <path
                                                                            d="m31.5 11.7c1.3-0.8 2.2-2 2.7-3.4-1.4 0.7-2.7 1.2-4 1.4-1.1-1.2-2.6-1.9-4.4-1.9-1.7 0-3.2 0.6-4.4 1.8-1.2 1.2-1.8 2.7-1.8 4.4 0 0.5 0.1 0.9 0.2 1.3-5.1-0.1-9.4-2.3-12.7-6.4-0.6 1-0.9 2.1-0.9 3.1 0 2.2 1 3.9 2.8 5.2-1.1-0.1-2-0.4-2.8-0.8 0 1.5 0.5 2.8 1.4 4 0.9 1.1 2.1 1.8 3.5 2.1-0.5 0.1-1 0.2-1.6 0.2-0.5 0-0.9 0-1.1-0.1 0.4 1.2 1.1 2.3 2.1 3 1.1 0.8 2.3 1.2 3.6 1.3-2.2 1.7-4.7 2.6-7.6 2.6-0.7 0-1.2 0-1.5-0.1 2.8 1.9 6 2.8 9.5 2.8 3.5 0 6.7-0.9 9.4-2.7 2.8-1.8 4.8-4.1 6.1-6.7 1.3-2.6 1.9-5.3 1.9-8.1v-0.8c1.3-0.9 2.3-2 3.1-3.2-1.1 0.5-2.3 0.8-3.5 1z"></path>
                                                                    </g>

                                                                </svg>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="pinterest-share">
                                                        <a class="sharing-btn pinterest-btn pinterest-theme-bg-hover"
                                                           data-placement="top" href="#" title="Share on Pinterest">
                                                            <div class="share-item__icon">
                                                                <svg fill="#888" height="1.3em"
                                                                     preserveaspectratio="xMidYMid meet"
                                                                     viewbox="0 0 40 40"
                                                                     width="1.3em">
                                                                    <g>
                                                                        <path
                                                                            d="m37.3 20q0 4.7-2.3 8.6t-6.3 6.2-8.6 2.3q-2.4 0-4.8-0.7 1.3-2 1.7-3.6 0.2-0.8 1.2-4.7 0.5 0.8 1.7 1.5t2.5 0.6q2.7 0 4.8-1.5t3.3-4.2 1.2-6.1q0-2.5-1.4-4.7t-3.8-3.7-5.7-1.4q-2.4 0-4.4 0.7t-3.4 1.7-2.5 2.4-1.5 2.9-0.4 3q0 2.4 0.8 4.1t2.7 2.5q0.6 0.3 0.8-0.5 0.1-0.1 0.2-0.6t0.2-0.7q0.1-0.5-0.3-1-1.1-1.3-1.1-3.3 0-3.4 2.3-5.8t6.1-2.5q3.4 0 5.3 1.9t1.9 4.7q0 3.8-1.6 6.5t-3.9 2.6q-1.3 0-2.2-0.9t-0.5-2.4q0.2-0.8 0.6-2.1t0.7-2.3 0.2-1.6q0-1.2-0.6-1.9t-1.7-0.7q-1.4 0-2.3 1.2t-1 3.2q0 1.6 0.6 2.7l-2.2 9.4q-0.4 1.5-0.3 3.9-4.6-2-7.5-6.3t-2.8-9.4q0-4.7 2.3-8.6t6.2-6.2 8.6-2.3 8.6 2.3 6.3 6.2 2.3 8.6z"></path>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="linkedin-share">
                                                        <a class="sharing-btn linkedin-btn linkedin-theme-bg-hover"
                                                           data-placement="top" href="#" title="Share on Linkedin">
                                                            <div class="share-item__icon">
                                                                <svg fill="#888" height="1.3em"
                                                                     preserveaspectratio="xMidYMid meet"
                                                                     viewbox="0 0 40 40"
                                                                     width="1.3em">
                                                                    <g>
                                                                        <path
                                                                            d="m13.3 31.7h-5v-16.7h5v16.7z m18.4 0h-5v-8.9c0-2.4-0.9-3.5-2.5-3.5-1.3 0-2.1 0.6-2.5 1.9v10.5h-5s0-15 0-16.7h3.9l0.3 3.3h0.1c1-1.6 2.7-2.8 4.9-2.8 1.7 0 3.1 0.5 4.2 1.7 1 1.2 1.6 2.8 1.6 5.1v9.4z m-18.3-20.9c0 1.4-1.1 2.5-2.6 2.5s-2.5-1.1-2.5-2.5 1.1-2.5 2.5-2.5 2.6 1.2 2.6 2.5z"></path>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
blogtop;
                            echo "<div class='single-presentation'>";
                            // 定义分段规则
                            $pattern = '/(?<!\n)\n(?!\n)/';
                            // 分段
                            $paragraphs = preg_split($pattern, $blogcontent);
                            if(count($blogimagesurl) == 1) {
                                foreach ($blogimagesurl as $blogimage) {
                                    echo <<<blogcontent
                                            <figure class="wp-caption alignnone atbs-post-media-wide"
                                                    data-shortcode="caption">
                                                <img alt="post image"
                                                     class="wp-image-7 size-full"
                                                     data-pagespeed-url-hash="3873578199"
                                                     onload="pagespeed.CriticalImages.checkImageForCriticality(this);"
                                                     src="$blogimage">
                                            </figure>
blogcontent;
                                }
                                foreach ($paragraphs as $paragraph) {
                                    echo "<p>$paragraph</p>";
                                }
                            } else {
                                $i = 0;
//                                print count($paragraphs);
                                foreach ($paragraphs as $paragraph) {
                                    if ($blogimagesurl[$i] != null) {
                                        echo <<<blogimags
                                            <figure class="wp-caption alignnone atbs-post-media-wide"
                                                    data-shortcode="caption">
                                                <img alt="post image"
                                                     class="wp-image-7 size-full"
                                                     data-pagespeed-url-hash="3873578199"
                                                     onload="pagespeed.CriticalImages.checkImageForCriticality(this);"
                                                     src="$blogimagesurl[$i]">
                                            </figure>
blogimags;
                                    }
                                    echo "<p>$paragraph</p>";
                                    $i++;
                                }
                            }
                            echo <<<blogfooter
                                            <footer class="single-footer entry-footer">
                                                <div class="entry-interaction entry-interaction--horizontal">
                                                    <div class="entry-interaction__left">
                                                    </div>
                                                    <div class="entry-interaction__right">
                                                        <div class="entry-meta-count flex-box justify-content-end">
                                                            <a class="comments-count" data-original-title="13 Views"
                                                               data-placement="top"
                                                               data-toggle="tooltip" href="#"
                                                               title=""><i
                                                                    class="mdicon mdicon-comment-o"></i>
                                                                <span>$commenttotal</span></a>
                                                            <a class="view-count" data-original-title="31 Commnent"
                                                               data-placement="top"
                                                               data-toggle="tooltip" href="#"
                                                               title=""><i
                                                                    class="mdicon mdicon-visibility"></i>
                                                                <span>$blogreadtimes</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </footer>
                                            <div class="author-box">
                                                <div class="author-avatar">
                                                    <img alt="$blogauthor"
                                                         class="avatar photo"
                                                         data-pagespeed-url-hash="1520034441"
                                                         onload="pagespeed.CriticalImages.checkImageForCriticality(this);"
                                                         src="$authorheadportrait">
                                                </div>
                                                <div class="author-box__text">
                                                    <div class="author-name">
                                                        <a class="entry-author__name"
                                                         href="author.php?authorid=$authorid">$blogauthor</a>
                                                    </div>
                                                    <div class="author-bio">
                                                        $authorbio
                                                    </div>
                                                    <ul class="author-social list-unstyled list-horizontal">
                                                        <li>
                                                            <a href="#"><i class="mdicon mdicon-mail_outline"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="mdicon mdicon-mail_outline"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="mdicon mdicon-mail_outline"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
blogfooter;
                            $blogrst = queryData('blog, accounts, blogimages', '*',
                            "blog.author = accounts.username and 
                            blog.blogid = blogimages.blogid and blog.type = (select name from blog, blogtype 
                            where blog.type = blogtype.name and blog.blogid = $blogid) and blog.blogid != $blogid");
                            $blog = mysqli_fetch_array($blogrst);
                            $blogid = $blog['blogid'];
                            $blogtitle = $blog['title'];
                            $blogpublishTime = date("Y年m月d日", strtotime($blog['publishTime']));
                            $blogshowstyle = $blog['blogshowstyle'];
                            $blogauthor = $blog['author'];
                            $blogabstract = $blog['abstract'];
                            $typestyle = $blog['showstyle'];
                            $blogtype = $blog['type'];
                            $blogtypeid = $blog['blogtypeid'];
                            $authorid = $blog['accountid'];
                            $authorheadportrait = $blog['headPortrait'];
                            $blogimagesurl = explode(',', $blog['imagesurl']);
                            echo <<<blogbottomfirst
                                            <div class="posts-navigation-wrap">
                                                <div class="posts-navigation flex-box flex-box-2i">
                                                    <div class="posts-navigation__prev">
                                                        <article
                                                            class="post post--horizontal post--horizontal-middle post--horizontal-reverse post--horizontal-xs post__thumb--width-100 post__thumb-100">
                                                            <div class="post__thumb atbs-thumb-object-fit">
                                                                <a href="$blogshowstyle?blogid=$blogid"><img
                                                                        data-pagespeed-url-hash="3198453904"
                                                                        onload="pagespeed.CriticalImages.checkImageForCriticality(this);"
                                                                        src="$blogimagesurl[0]"></a>
                                                            </div>
                                                            <div class="post__text text-right">
                                                                <a class="posts-navigation__label"
                                                                   href="$blogshowstyle?blogid=$blogid">
                                                                    <svg height="6.545"
                                                                         viewbox="0 0 11.999 6.545" width="11.999"
                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11.454,78.818H1.862l1.8,1.8a.545.545,0,1,1-.771.771L.16,78.658a.545.545,0,0,1,0-.771L2.887,75.16a.545.545,0,1,1,.771.771l-1.8,1.8h9.591a.545.545,0,1,1,0,1.091Z"
                                                                            fill="#222"
                                                                            transform="translate(0 -75)"></path>
                                                                    </svg>
                                                                    <span>上一篇</span>
                                                                </a>
                                                                <h3 class="post__title f-18 f-w-600 atbs-line-limit atbs-line-limit-3">
                                                                    <a href="$blogshowstyle?blogid=$blogid">$blogtitle</a></h3>
                                                            </div>
                                                        </article>
                                                    </div>
blogbottomfirst;
                        $blog = mysqli_fetch_array($blogrst);
                        $blogid = $blog['blogid'];
                        $blogtitle = $blog['title'];
                        $blogpublishTime = date("Y年m月d日", strtotime($blog['publishTime']));
                        $blogshowstyle = $blog['blogshowstyle'];
                        $blogauthor = $blog['author'];
                        $blogabstract = $blog['abstract'];
                        $typestyle = $blog['showstyle'];
                        $blogtype = $blog['type'];
                        $blogtypeid = $blog['blogtypeid'];
                        $authorid = $blog['accountid'];
                        $authorheadportrait = $blog['headPortrait'];
                        $blogimagesurl = explode(',', $blog['imagesurl']);
                            echo <<<blogbottomsecond
                                                    <!-- posts-navigation__prev-->
                                                    <div class="posts-navigation__next clearfix">
                                                        <article
                                                            class="post post--horizontal post--horizontal-middle post--horizontal-xs post__thumb--width-100 post__thumb-100">
                                                            <div class="post__thumb atbs-thumb-object-fit">
                                                                <a href="$blogshowstyle?blogid=$blogid"><img
                                                                        data-pagespeed-url-hash="2903953983"
                                                                        onload="pagespeed.CriticalImages.checkImageForCriticality(this);"
                                                                        src="$blogimagesurl[0]"></a>
                                                            </div>
                                                            <div class="post__text text-left">
                                                                <a class="posts-navigation__label text-left"
                                                                   href="$blogshowstyle?blogid=$blogid">
                                                                    <span>下一篇</span>
                                                                    <svg height="6.545"
                                                                         viewbox="0 0 11.999 6.545" width="11.999"
                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M.545,78.818h9.591l-1.8,1.8a.545.545,0,1,0,.771.771l2.727-2.727a.545.545,0,0,0,0-.771L9.112,75.16a.545.545,0,1,0-.771.771l1.8,1.8H.545a.545.545,0,1,0,0,1.091Z"
                                                                            fill="#222"
                                                                            opacity="0.8"
                                                                            transform="translate(0 -75)"></path>
                                                                    </svg>
                                                                </a>
                                                                <h3 class="post__title f-18 f-w-600 atbs-line-limit atbs-line-limit-3">
                                                                    <a href="$blogshowstyle?blogid=$blogid">$blogtitle</a></h3>
                                                            </div>
                                                        </article>
                                                    </div><!-- posts-navigation__next -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .single-content -->
                        </article>
blogbottomsecond;
                        ?>


<!--comments start-->
                        <div class="comments-section single-entry-section">
                            <div class="comments-area" id="comments">
                                <div class="block-heading block-heading_style-4"
                                     style="--color-heading: var(--color-primary)">
                                    <h4 class="block-heading__title">5 Comments</h4>
                                </div>
                                <ol class="comment-list">
                                    <li class="comment even thread-even depth-1 parent" id="comment-4">
                                        <div class="comment-body" id="div-comment-4">
                                            <footer class="comment-meta">
                                                <div class="comment-author vcard">
                                                    <img alt="avatar"
                                                         class="avatar photo" data-pagespeed-url-hash="1520034441"
                                                         onload="pagespeed.CriticalImages.checkImageForCriticality(this);"
                                                         src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg"><b
                                                        class="fn">Diane Gregory</b><span class="says">says:</span>
                                                </div><!-- .comment-author -->
                                                <div class="comment-metadata">
                                                    <a href="#">
                                                        <time datetime="2016-10-21T13:31:45+00:00">October 21, 2016
                                                            at 1:31 pm
                                                        </time>
                                                    </a>
                                                </div><!-- .comment-metadata -->
                                            </footer><!-- .comment-meta -->
                                            <div class="comment-content">
                                                <p>There's good news, and there's bad news. The bad news is, it's
                                                    not
                                                    the drug. You're here, in the astral plane. You went too far in
                                                    the
                                                    make believe and got lost in your mind, consciousness, and now
                                                    you're trapped in this, no place. Where every day is the same,
                                                    where
                                                    you can imagine yourself a kingdom. but nothing is ever real.
                                                </p>
                                            </div><!-- .comment-content -->
                                            <div class="reply">
                                                <a aria-label="Reply to Sculpture Fan" class="comment-reply-link"
                                                   href="#"
                                                   rel="nofollow">Reply</a>
                                            </div>
                                        </div><!-- .comment-body -->
                                        <ol class="children">
                                            <li class="comment byuser comment-author-melchoyce bypostauthor odd alt depth-2 parent"
                                                id="comment-5">
                                                <div class="comment-body" id="div-comment-5">
                                                    <footer class="comment-meta">
                                                        <div class="comment-author vcard">
                                                            <img alt="avatar"
                                                                 class="avatar photo"
                                                                 data-pagespeed-url-hash="1520034441"
                                                                 onload="pagespeed.CriticalImages.checkImageForCriticality(this);"
                                                                 src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg"><a
                                                                class="url" href="#" rel="external nofollow">Ryan
                                                                Reynold</a><span class="says">says:</span>
                                                        </div><!-- .comment-author -->
                                                        <div class="comment-metadata">
                                                            <a href="#">
                                                                <time datetime="2016-10-21T13:31:45+00:00">October
                                                                    21, 2016 at 1:31 pm
                                                                </time>
                                                            </a>
                                                            <span class="edit-link">
                                                                    <a class="comment-edit-link" href="#">Edit</a>
                                                                </span>
                                                        </div><!-- .comment-metadata -->
                                                    </footer><!-- .comment-meta -->
                                                    <div class="comment-content">
                                                        <p>And what's the good news?</p>
                                                    </div><!-- .comment-content -->
                                                    <div class="reply">
                                                        <a aria-label="Reply to Sculpture Fan"
                                                           class="comment-reply-link" href="#"
                                                           rel="nofollow">Reply</a>
                                                    </div>
                                                </div><!-- .comment-body -->
                                                <ol class="children">
                                                    <li class="comment even depth-3" id="comment-6">
                                                        <div class="comment-body" id="div-comment-6">
                                                            <footer class="comment-meta">
                                                                <div class="comment-author vcard">
                                                                    <img alt="avatar"
                                                                         class="avatar photo"
                                                                         data-pagespeed-url-hash="1520034441"
                                                                         onload="pagespeed.CriticalImages.checkImageForCriticality(this);"
                                                                         src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg"><b
                                                                        class="fn">Diane Gregory</b><span
                                                                        class="says">says:</span>
                                                                </div><!-- .comment-author -->
                                                                <div class="comment-metadata">
                                                                    <a href="#">
                                                                        <time datetime="2016-10-21T13:31:45+00:00">
                                                                            October 21, 2016 at 1:31 pm
                                                                        </time>
                                                                    </a>
                                                                </div><!-- .comment-metadata -->
                                                            </footer><!-- .comment-meta -->
                                                            <div class="comment-content">
                                                                <p>I'm not alone anymore.</p>
                                                            </div><!-- .comment-content -->
                                                            <div class="reply">
                                                                <a aria-label="Reply to Sculpture Fan"
                                                                   class="comment-reply-link"
                                                                   href="#" rel="nofollow">Reply</a>
                                                            </div>
                                                        </div><!-- .comment-body -->
                                                    </li><!-- #comment-## -->
                                                </ol><!-- .children -->
                                            </li><!-- #comment-## -->
                                        </ol><!-- .children -->
                                    </li><!-- #comment-## -->
                                    <li class="comment byuser bypostauthor odd alt thread-odd thread-alt depth-1"
                                        id="comment-7">
                                        <div class="comment-body" id="div-comment-7">
                                            <footer class="comment-meta">
                                                <div class="comment-author vcard">
                                                    <img alt="avatar"
                                                         class="avatar photo" data-pagespeed-url-hash="1520034441"
                                                         onload="pagespeed.CriticalImages.checkImageForCriticality(this);"
                                                         src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg"><b
                                                        class="fn">Ryan Reynold</b><span class="says">says:</span>
                                                </div><!-- .comment-author -->
                                                <div class="comment-metadata">
                                                    <a href="#">
                                                        <time datetime="2016-10-21T13:31:45+00:00">October 21, 2016
                                                            at 1:31 pm
                                                        </time>
                                                    </a>
                                                </div><!-- .comment-metadata -->
                                            </footer><!-- .comment-meta -->
                                            <div class="comment-content">
                                                <p> It's just Thursday. Like the 260th Thursday as a passenger on
                                                    the
                                                    cruise ship "Mental Health." On the plus side I've mastered
                                                    eating
                                                    with a spoon.
                                                </p>
                                            </div><!-- .comment-content -->
                                            <div class="reply">
                                                <a aria-label="Reply to Sculpture Fan" class="comment-reply-link"
                                                   href="#"
                                                   rel="nofollow">Reply</a>
                                            </div>
                                        </div><!-- .comment-body -->
                                    </li><!-- #comment-## -->
                                    <li class="comment byuser odd alt thread-odd thread-alt depth-1" id="comment-8">
                                        <div class="comment-body" id="div-comment-8">
                                            <footer class="comment-meta">
                                                <div class="comment-author vcard">
                                                    <img alt="avatar"
                                                         class="avatar photo" data-pagespeed-url-hash="1520034441"
                                                         onload="pagespeed.CriticalImages.checkImageForCriticality(this);"
                                                         src="../images/xauthor.png.pagespeed.ic.Be6zF3JsOO.jpg"><b
                                                        class="fn">Diane Gregory</b><span class="says">says:</span>
                                                </div><!-- .comment-author -->
                                                <div class="comment-metadata">
                                                    <a href="#">
                                                        <time datetime="2016-10-21T13:31:45+00:00">October 21, 2016
                                                            at 1:31 pm
                                                        </time>
                                                    </a>
                                                </div><!-- .comment-metadata -->
                                            </footer><!-- .comment-meta -->
                                            <div class="comment-content">
                                                <p>I know, I don't have to be afraid. But I am because look at you.
                                                    All
                                                    of you. You're gods, and someday you are going to wake up and
                                                    realize you don't have to listen to us anymore.
                                                </p>
                                            </div><!-- .comment-content -->
                                            <div class="reply">
                                                <a aria-label="Reply to Sculpture Fan" class="comment-reply-link"
                                                   href="#"
                                                   rel="nofollow">Reply</a>
                                            </div>
                                        </div><!-- .comment-body -->
                                    </li><!-- #comment-## -->
                                </ol>
                                <div class="comment-respond" id="respond">
                                    <h3 class="comment-reply-title" id="reply-title">Leave a Reply <small><a
                                                href="#" id="cancel-comment-reply-link" rel="nofollow"
                                                style="display: none;">Cancel reply</a></small></h3>
                                    <form action="#" class="comment-form" id="commentform" method="post"
                                          novalidate="">
                                        <p class="comment-notes"><span id="email-notes">Your email address will not be published.</span>Required
                                            fields are marked <span class="required">*</span></p>
                                        <p class="comment-form-comment">
                                            <label for="comment">Comment</label>
                                            <textarea class="form-control-custom" cols="45" id="comment"
                                                      maxlength="65525" name="comment" placeholder="Your review"
                                                      required="required"
                                                      rows="8"></textarea>
                                        </p>
                                        <p class="comment-form-author">
                                            <label for="author">Name <span class="required">*</span></label>
                                            <input class="form-control-custom" id="author" maxlength="245" name="author"
                                                   placeholder="Name *" required="required" size="30" type="text"
                                                   value="">
                                        </p>
                                        <p class="comment-form-email">
                                            <label for="email">Email <span class="required">*</span></label>
                                            <input aria-describedby="email-notes" class="form-control-custom" id="email"
                                                   maxlength="100"
                                                   name="email" placeholder="Email *" required="required" size="30"
                                                   type="email" value="">
                                        </p>
                                        <p class="form-submit">
                                            <input class="submit" id="submit" name="submit" type="submit"
                                                   value="Post Comment">
                                            <input id="comment_post_ID" name="comment_post_ID" type="hidden"
                                                   value="44">
                                            <input id="comment_parent" name="comment_parent" type="hidden"
                                                   value="0">
                                        </p>
                                    </form>
                                </div><!-- #respond -->
                            </div>
                        </div>
<!--                        comments-area-->
                    </div>