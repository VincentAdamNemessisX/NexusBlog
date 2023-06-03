<?php

require_once '../../database/databaseHandle.php';
require_once '../function/result_to_json.php';
$action = $_POST['action'] ?? "";

if ($action == "freeze") {
    $accountid = $_POST['accountid'];
    $result = updateData('accounts', "accountid = $accountid", ['status' => 0]);
    if ($result) {
        echo "success";
    } else {
        echo "fail";
    }
}

if ($action == "unfreeze") {
    $accountid = $_POST['accountid'];
    $result = updateData('accounts', "accountid = $accountid", ['status' => 1]);
    if ($result) {
        echo "success";
    } else {
        echo "fail";
    }
}

if ($action == "delete") {
    $accountid = $_POST['accountid'];
    $result = removeData('accounts', "accountid = $accountid") && removeData('comment',
            "userid = $accountid") && removeData('blog',
            "author = 
            (select author from accounts, blog where $accountid = accounts.accountid 
            and accounts.username = blog.author)");
    if ($result) {
        echo "success";
    } else {
        echo "fail";
    }
}

if ($action == "add") {
    $data = [];
    foreach ($_POST as $key => $value) {
        if ($key != "action" && $key != "accountid") {
            $data[$key] = "'" . $value . "'";
        }
    }
    $result = insertData('accounts', "", "",
        $data);
    if ($result) {
        echo "success";
    } else {
        echo "fail";
    }
}

if ($action == "edit") {
    $data = [];
    foreach ($_POST as $key => $value) {
        if ($key != "action" && $key != "accountid") {
            $data[$key] = "'" . $value . "'";
        }
    }
    $result = updateData('accounts', "accountid = " . $_POST['accountid'], $data);
    if ($result) {
        echo "success";
    } else {
        echo "fail";
    }
}

if ($action == "search") {
    $something = $_POST['something'];
    if ($something != null) {
        $result = queryData('accounts', '*',
            "username like '%$something%' or nickname like '%$something%'");
    } else {
        $result = [];
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