                <?php
                    $currentuser = $_SESSION['user'] ?? 'guest';
                    $currentuserinfo = mysqli_fetch_array(queryData('accounts',
                        '*', "username = '$currentuser'"));
                    $currentblogid = $_GET['blogid'];
                    if($currentblogid === null) {
                        echo "<script>location.href='../views/index.php'</script>";
                    }
                    updateData('blog', "blogid = $currentblogid", ['readTimes' => 'readTimes+1']);
                    $blogrst = queryData('blog, accounts, blogimages', '*',
                    "blog.blogid = blogimages.blogid and blog.blogid = $currentblogid and
                     blog.author = accounts.username");
                    $blog = mysqli_fetch_array($blogrst);
                    $commentrst = queryData('comment', 'commentid',
                    'comment.blogid = ' . $currentblogid);
                    $commenttotal = mysqli_num_rows($commentrst);
                    if(!$blog) {
                        echo "<script>window.history.back()</script>";
                    }
                    $blogid = $blog['blogid'];
                    $blogtitle = $blog['title'];
                    $blogcontent = $blog['content'];
                    $blogpublishTime = date("Y年m月d日", strtotime($blog['publishTime']));
                    $blogshowstyle = $blog['blogshowstyle'];
                    $blogauthor = $blog['nickname'] ?? $blog['username'];
                    $blogreadtimes = $blog['readTimes'];
                    $blogabstract = $blog['abstract'];
                    $typestyle = $blog['showstyle'];
                    $blogtype = $blog['type'];
                    $blogtypeid = $blog['blogtypeid'];
                    $authorid = $blog['accountid'];
                    $authorbio = $blog['bio'] ?? '这个人很懒，什么都没有留下。';
                    $authorheadportrait = $blog['headPortrait'];
                    $blogimagesurl = explode(',', $blog['imagesurl']);
                ?>
                <div class="row">
                    <div class="atbs-main-col" style="margin: 0 auto">
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
                                                     src="$authorheadportrait">
                                            </a>
                                            <div class="entry-author__text">
                                                <a class="entry-author__name" href="author.php?authorid=$authorid"
                                                   rel="author" title="Posts by $blogauthor">$blogauthor</a>
                                                <time class="time published" datetime="$blogpublishTime"
                                                      title="$blogpublishTime">
                                                </time>
                                            </div>
                                        </div>
                                    </div>
<!--                                    分享按钮-->
                                    <div class="socials-share-box">
                                        <ul class="social-list--md" style="background-color: grey">
                                            <li><a href="mailto:$blog[email]?subject=$blogtitle"><i class="mdicon mdicon-mail_outline"></i></a></li>
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
                                                        <li><a href="mailto:$blog[email]?subject=$blogtitle"><i class="mdicon mdicon-mail_outline"></i></a></li>
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
                            $blogauthor = $blog['nickname'] ?? $blog['username'];
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
                        $blogauthor = $blog['nickname'] ?? $blog['username'];
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
                                    <h4 class="block-heading__title"><?php echo $commenttotal ?>条评论</h4>
                                </div>
                                <?php
                                    include_once '../function/commentsRecursive.php';
                                    $commentrst = queryData('comment, accounts', '*',
                                    "comment.userid = accounts.accountid and comment.blogid = $currentblogid
                                    " . "order by commenttime desc");
                                    $comments = [];
                                    while ($comment = mysqli_fetch_assoc($commentrst)) {
                                        $comments[] = $comment;
                                    }
                                    display_comments_recursive($comments, -1);
                                    display_comments_recursive($comments, 0);
                                ?>
                                <div class="comment-respond" id="respond">
                                    <h3 class="comment-reply-title" id="reply-title">留下你的评论<small><a
                                                href="#" id="cancel-comment-reply-link" rel="nofollow"
                                                style="display: none;">取消回复</a></small></h3>
                                    <form class="comment-form"
                                            action="../handle/managecomment.php?blogid=<?php echo $currentblogid ?>"
                                          id="commentform" method="post">
                                        <p class="comment-notes"><span id="email-notes">
                                                你的邮箱和用户名会自动填入，必填项使用<span class="required">*</span>标记</p>
                                        <p class="comment-form-comment">
                                            <label for="comment">评论</label>
                                            <textarea class="form-control-custom" cols="45" id="comment"
                                                      maxlength="65525" name="comment" placeholder="你的评论"
                                                      required="required"
                                                      rows="8"></textarea>
                                        </p>
                                        <p class="comment-form-author">
                                            <label for="author">用户名<span class="required">*</span></label>
                                            <input class="form-control-custom"
                                                   style="background-color: #e6e6e6; color:grey"
                                                   id="author" maxlength="245" name="author"
                                                   placeholder="Name *" required="required" size="30" type="text"
                                                   value="<?php
                                                    if($currentuserinfo['nickName'] == null) {
                                                        echo $currentuserinfo['username'];
                                                    } else {
                                                        echo $currentuserinfo['nickname'];
                                                    }
                                                   ?>" disabled>
                                        </p>
                                        <p class="comment-form-email">
                                            <label for="email">邮箱<span class="required">*</span></label>
                                            <input aria-describedby="email-notes"
                                                   style="background-color: #e6e6e6; color:grey"
                                                   class="form-control-custom" id="email"
                                                   maxlength="100"
                                                   name="email" placeholder="Email *" required="required" size="30"
                                                   type="email" value="<?php
                                                    echo $currentuserinfo['email'];
                                            ?>" disabled>
                                        </p>
                                        <p class="form-submit">
                                            <input class="submit" id="submit" name="submit" type="button"
                                                   value="发布评论">
                                            <input id="commentid" name="commentid" type="hidden" value="">
                                            <input id="comment_method" name="comment_method" type="hidden" value="1">
                                            <input id="comment_parent" name="comment_parent" type="hidden"
                                                   value="-1">
                                        </p>
                                    </form>
                                    <script>
                                        $(document).ready(function () {
                                            $("#submit").click(function () {
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "../handle/managecomment.php?blogid=<?php echo $currentblogid ?>",
                                                        data: {
                                                            comment: encodeAll($('#comment').val()),
                                                            authorid: $('#authorid').val(),
                                                            parentid: $('#comment_parent').val(),
                                                            commentid: $('#commentid').val() ?? -1,
                                                            commentmethod:$('#comment_method').val(),
                                                        },
                                                        success: function (data) {
                                                            if (data === "success") {
                                                                alert("操作成功！");
                                                                $("#comment").val('');
                                                                window.location.reload();
                                                            } else {
                                                                alert("操作失败！");
                                                            }
                                                        }
                                                    });
                                                });
                                            });
                                    </script>
                                </div><!-- #respond -->
                            </div>
                        </div>
<!--                        comments-area-->
                    </div>