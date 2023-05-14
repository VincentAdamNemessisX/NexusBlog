<?php
    session_start();
    include_once "../database/databaseHandle.php";
    $blogid = $_GET['blogid'];
    $commentcontent = $_POST['comment'];
    if($_POST['comment_method'] == 1) {
        if ($commentcontent == null) {
            echo "<script>alert(\"评论内容不能为空！\");history.back()</script>";
        } else {
            $authorid = mysqli_fetch_array(
                queryData('accounts', 'accountid', "username='$_SESSION[user]'"))['accountid'] ?? 20;
            $parentid = $_POST['comment_parent'];
            date_default_timezone_set("RPC");
            $commenttime = date("Y-m-d:H:i:s", strtotime('now'));
            if (insertData('comment', '', '', [
                'userid' => $authorid, 'blogid' => $blogid,
                'content' => "'" . $commentcontent . "'", 'parentid' => $parentid, 'commenttime' => "'" . $commenttime . "'"])) {
                echo "<script>alert('评论成功！');history.back()</script>";
            } else {
                echo "<script>alert('评论失败！');window.history.back()</script>";
            }
        }
    } elseif ($_POST['comment_method'] == 2) {
        if ($commentcontent == null) {
            echo "<script>alert(\"评论内容不能为空！\");history.back()</script>";
        } else {
            date_default_timezone_set("RPC");
            $commenttime = date("Y-m-d:H:i:s", strtotime('now'));
            if (updateData('comment', "commentid = $_POST[commentid]", [
                'content' => $commentcontent,  'commenttime' => $commenttime])) {
                echo "<script>alert('修改成功！');history.back()</script>";
            } else {
                echo "<script>alert('修改失败！');window.history.back()</script>";
            }
        }
    }