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
    $result = removeData('accounts', "accountid = $accountid") or removeData('comment',
        "userid = $accountid") or removeData('blog',
        "author = 
            (select author from accounts, blog where $accountid = accounts.accountid 
            and accounts.username = blog.author)");
    if ($result) {
        echo "success";
    } else {
        echo "fail";
    }
}

if ($action == "delete_all") {
    $accountids = $_POST['accountids'];
    $results = [];
    for ($i = 0; $i < count($accountids); $i++) {
        $temp = intval($accountids[$i]);
        $result = removeData('accounts', "accountid = $temp") or removeData('comment',
            "userid = $temp") or removeData('blog',
            "author = 
            (select author from accounts, blog where $temp = accounts.accountid 
            and accounts.username = blog.author)");
        $results[] = $result;
    }
    if (in_array(false, $results)) {
        echo "fail";
    } else {
        echo "success";
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

if ($action == "edit_password") {
    if (md5($_POST['password']) == mysqli_fetch_array(queryData('accounts', "password",
            "accountid = " . $_POST['accountid']))['password']) {
        echo "failWithSamePassword";
    } else {
        $result = updateData('accounts', "accountid = " . $_POST['accountid'],
            ['password' => "'" . md5($_POST['password']) . "'"]);
        if ($result) {
            echo "success";
        } else {
            echo "failWithMysqlService";
        }
    }
}

if ($action == "get") {
    $result = queryData('accounts');
    if ($result) {
        header('Content-type: application/json');
        echo json_encode(result_to_json($result));
    } elseif (mysqli_num_rows($result) <= 0) {
        echo "none";
    } else {
        echo "fail";
    }
}

if ($action == "search") {
    $something = $_POST['search'];
    if ($something != null) {
        $result = queryData('accounts', '*',
            "accountid like '%$something%' or bio like '%$something%' or
             email like '%$something%' or username like '%$something%' or 
             nickname like '%$something%'");
    } else {
        $result = [];
    }
    if ($result) {
        $rows = [];
        while ($row = mysqli_fetch_array($result)) {
            $rows[] = $row;
        }
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]['manageprompt'] = ($rows[$i]['status'] == 1) ? "冻结" : '解冻';
            $rows[$i]['status'] = ($rows[$i]['status'] == 1) ? "<span class=\"layui-btn layui-btn-normal layui-btn-mini\">正常</span>"
                : "<span class=\"layui-btn layui-btn-normal layui-btn-disabled layui-btn-mini\">已冻结</span>";
            $rows[$i]['nickname'] = $rows[$i]['nickname'] == null ? '未填写' : $rows[$i]['nickname'];
            $rows[$i]['gender'] = $rows[$i]['gender'] == null ? '未知' : $rows[$i]['gender'];
            $rows[$i]['city'] = $rows[$i]['city'] == null ? '未知' : $rows[$i]['city'];
            $rows[$i]['skill'] = $rows[$i]['skill'] == null ? '未知' : $rows[$i]['skill'];
            $rows[$i]['description'] = $rows[$i]['description'] == null ? '未知' : $rows[$i]['description'];
            $rows[$i]['bio'] = $rows[$i]['bio'] == null ? '未知' : $rows[$i]['bio'];
        }
        header('Content-type: application/json');
//        echo json_encode($rows);
        echo json_encode(json_encode($rows));
    } elseif (mysqli_num_rows($result) <= 0) {
        echo "none";
    } else {
        echo "fail";
    }
}