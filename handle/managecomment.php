<?php
    session_start();
    include_once "../database/databaseHandle.php";
    $blogid = $_GET['blogid'];
    $commentcontent = $_POST['comment'];
    if($_POST['commentmethod'] == 1) {
        if ($commentcontent == null) {
            echo "<script>alert(\"评论内容不能为空！\");history.back()</script>";
        } else {
            $authorid = mysqli_fetch_array(
                queryData('accounts', 'accountid', "username='$_SESSION[user]'"))['accountid'] ?? 20;
            $parentid = $_POST['parentid'];
            date_default_timezone_set("RPC");
            $commenttime = date("Y-m-d:H:i:s", strtotime('now'));
            if (insertData('comment', '', '', [
                'userid' => $authorid, 'blogid' => $blogid,
                'content' => "'" . $commentcontent . "'", 'parentid' => $parentid,
                'commenttime' => "'" . $commenttime . "'"])) {
                echo "success";
            } else {
//                echo "<script>alert('评论失败！');window.history.back()</script>";
                echo "failed";
            }
        }
    } elseif ($_POST['commentmethod'] == 2) {
        if ($commentcontent == null) {
            echo "failed";
//            echo "<script>alert(\"评论内容不能为空！\");history.back()</script>";
        } else {
            date_default_timezone_set("RPC");
            $commenttime = date("Y-m-d:H:i:s", strtotime('now'));
            if (updateData('comment', "commentid = $_POST[commentid]", [
                'content' => "'" .$commentcontent. "'",  'commenttime' => "'" .$commenttime. "'"])) {
                echo "success";
            } else {
                echo "failed";
            }
        }
    } elseif ($_POST['commentmethod'] == 3) {
        if (removeData('comment', "commentid = $_POST[commentid]") &&
            removeData('comment', "parentid = $_POST[commentid]")) {
            echo "success";
        } else {
            echo "failed";
        }
    }