<?php
session_start();
require_once '../../database/databaseHandle.php';
require_once '../function/result_to_json.php';
$action = $_POST['action'] ?? "";
if ($action == "delete") {
    $blogid = $_POST['blogid'];
    $result = removeData('blog', "blogid = $blogid") ||
        removeData('comment',
            "blogid = $blogid") || removeData('comment',
            "parentid not in (select commentid from comment)") ||
        removeData('blogimages', "blogid = $blogid");
    if ($result) {
        echo "success";
    } else {
        echo "fail";
    }
}

if ($action == "publish") {
    $data = [];
    foreach ($_POST as $key => $value) {
        if ($key != "action" && $key != "blogid") {
            $data[$key] = "'" . $value . "'";
        }
    }

    $data['publishTime'] = "'" . date("Y-m-d H:i:s") . "'";
    $data['author'] = "'" . $_SESSION['user'] . "'";
    $result = insertData('blog', "", "", $data);
    if ($result) {
        echo "success";
    } else {
        echo "fail";
    }
}

if ($action == "edit") {
    $data = [];
    foreach ($_POST as $key => $value) {
        if ($key != "action" && $key != "blogid") {
            $data[$key] = "'" . $value . "'";
        }
    }
    $result = updateData('blog', "blogid = " . $_POST['blogid'],
        $data);
    if ($result) {
        echo "success";
    } else {
        echo "fail";
    }
}

if ($action == "search") {
    $something = $_POST['something'];
    if ($something != null) {
        $result = queryData('blog', "*", "title like '%$something%' or
     content like '%$something%' or abstract like '%$something%' or author like '%$something%'
     or blogid like '%$something%' or type like '%$something%' or publishTime like '%$something%'");
    } else {
        $result = queryData('blog');
    }
    if ($result) {
        header('Content-type: application/json');
        echo json_encode(result_to_json($result));
    } elseif (mysqli_num_rows($result) <= 0) {
        echo "none";
    } else {
        echo "fail";
    }
}