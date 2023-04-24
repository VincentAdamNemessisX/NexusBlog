<?php
session_start();
date_default_timezone_set('PRC');
include_once '../database/databaseHandle.php';
error_reporting(0);
if (isset($_POST['un']) && isset($_POST['pwd'])) {
    $user = $_POST['un'];
    $pwd = $_POST['pwd'];
    $nickname = $_POST['nickname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $url = $_POST['url'];
    $city = $_POST['city'];
    $description = $_POST['description'];
    $skill = implode(',', $_POST['skill']);
    $result = queryData('user', '*', "username='$user'");
    $act = mysqli_fetch_array($result);
    if (isset($act)) {
        echo "<script>alert('Already exists this account!');history.back();</script>";
    } else {
        $fields = ['username', 'password', 'nickname', 'gender', 'email', 'url', 'city', 'skill', 'description'];
        $values = ['\'' . $user . '\'', '\'' . $pwd . '\'', '\'' . $nickname . '\'',
            '\'' . $gender . '\'', '\'' . $email . '\'', '\'' . $url . '\'',
            '\'' . $city . '\'', '\'' . $skill . '\'', '\'' . $description . '\''];
        if (insertData('accounts', $fields, $values)) {
            $_SESSION['user'] = $user;
            $_SESSION['lastLoginTime'] = date('Y-m-d H:i:s');
            echo "<script>alert('register success!');window.location.href='../views/index.php'</script>";
        } else {
            echo "<script>alert('register failed!');history.go(-1)</script>";
        }
    }
}