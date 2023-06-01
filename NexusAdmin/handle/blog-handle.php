<?php
require_once '../../database/databaseHandle.php';
require_once '../function/result_to_json.php';
$action = $_POST['action'] ?? "";
if($action == "delete") {
    $id = $_POST['id'];
    $result = removeData('blog', "blogid = $id") ||
        removeData('comment',
            "blogid = $id") || removeData('comment',
            "parentid not in (select commentid from comment)");
    if($result) {
        echo "success";
    } else {
        echo "fail";
    }
}
if($action == "add") {
    $data = [];
    foreach ($_POST['data'] as $key => $value) {
        if($key != "action" && $key != "id") {
            $data[$key] = "'" . $value . "'";
        }
    }
    $result = insertData('blog', "", "",
        $data);
    if($result) {
        echo "success";
    } else {
        echo "fail";
    }
}
if($action == "edit") {
    $data = [];
    foreach ($_POST as $key => $value) {
        if($key != "action" && $key != "blogid") {
            $data[$key] = "'" . $value . "'";
        }
    }
    $result = updateData('blog', "blogid = " . $_POST['blogid'],
        $data);
    if($result) {
        echo "success";
    } else {
        echo "fail";
    }
}
if($action == "search") {
    $something = $_POST['something'];
    if ($something != null) {
        $result = queryData('blog', "*", "title like '%$something%' or
     content like '%$something%' or abstract like '%$something%' or author like '%$something%'
     or blogid like '%$something%' or type like '%$something%' or publishTime like '%$something%'");
    } else {
        $result = queryData('blog');
    }
    if($result) {
        header('Content-type: application/json');
        echo json_encode(result_to_json($result));
    } elseif (mysqli_num_rows($result) <= 0) {
        echo "none";
    }
    else {
        echo "fail";
    }
}