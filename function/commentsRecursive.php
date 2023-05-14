<?php
//Test data
//$comments = [['commentid' => 1, 'parentid' => -1, 'content' => 'RootTest',  'name' => 'bug', 'commenttime' => 2021-1-3/12/23/45],
//    ['commentid' => 2, 'parentid' => 1, 'name' => 'bug', 'content' => 'SubTest', 'commenttime' => 2021-1-3/12/23/45],
//    ['commentid' => 3, 'parentid' => 1, 'name' => 'bug', 'content' => 'SubTest', 'commenttime' => 2021-1-3/12/23/45],
//    ['commentid' => 4, 'parentid' => 2, 'name' => 'bug', 'content' => 'SubTest', 'commenttime' => 2021-1-3/12/23/45],];
//display_comments_recursive($comments, -1);

function display_comments_recursive($comments, $parent_id = -1) {
    echo '<ol class="comment-list">';
    foreach ($comments as $comment) {
        if ($comment['nickname'] != null) {
            $comment['name'] = $comment['nickname'];
        } else {
            $comment['name'] = $comment['username'];
        }
        $comment['time'] = date("Y年m月d日 H时i分s秒", strtotime($comment['commenttime']));
        if ($comment['parentid'] == $parent_id) {
            echo <<<liitem
            <li class="comment  thread-even depth-1" id="comment-$comment[commentid]">
                <div class="comment-body" id="div-comment-$comment[commentid]">
                    <footer class="comment-meta">
                        <div class="comment-author vcard">
                            <img alt="avatar"
                                 class="avatar photo" data-pagespeed-url-hash="1520034441"
                                 onload="pagespeed.CriticalImages.checkImageForCriticality(this);"
                                 src="$comment[headPortrait]"><b
                                class="fn">$comment[name]</b><span class="says">:</span>
                        </div><!-- .comment-author -->
                        <div class="comment-metadata">
                            <a href="#">
                                <time datetime="$comment[time]">
                                $comment[time]
                                </time>
                            </a>
liitem;
            if ($_SESSION['user'] == $comment['username']) {
                echo "<span class='edit-link'>
                    <a class='comment-edit-link' href='#commentform' onclick='editComment($comment[commentid], \"$comment[content]\")'>修改</a>
                    <script type='text/javascript'>
                            function editComment(id, content) {
                                var submit = document.getElementById('submit');
                                var comment = document.getElementById('comment');
                                var commentid = document.getElementById('commentid');
                                var commentmethod = document.getElementById('comment_method');
                                submit.value = \"修改\";
                                comment.placeholder = content;
                                comment.value = content;
                                commentid.value = id;
                                commentmethod.value = 2;
                            }
                    </script>
                    </span>";
            }
            echo <<<liitem
                        </div><!-- .comment-metadata -->
                    </footer><!-- .comment-meta -->
                    <div class="comment-content">
                        <p>
                            $comment[content]
                        </p>
                    </div><!-- .comment-content -->
                    <div class="reply">
                        <a aria-label="Reply to Sculpture Fan" class="comment-reply-link"
                           href="#commentform" onclick="replyComment($comment[commentid])"
                           rel="nofollow">回复</a>
                        <script type="text/javascript">
                            function replyComment(parentid) {
                                var commentparent = document.getElementById('comment_parent');
                                var submit = document.getElementById('submit');
                                var comment = document.getElementById('comment');
                                var commentmethod = document.getElementById('comment_method');
                                commentparent.value = parentid; submit.value = "回复";
                                comment.placeholder = "你的回复";
                                commentmethod.value = 1;
                            }
                        </script>
                    </div>
liitem;
            echo "<ol class='children'>";
            display_comments_recursive($comments, $comment['commentid']);
            echo "</ol>";
        }
        echo "</li>";
    }
    echo '</ol>';
}
