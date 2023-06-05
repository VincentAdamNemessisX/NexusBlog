<?php
global $conn;
session_start();
date_default_timezone_set('PRC');
include_once '../database/databaseHandle.php';
include_once "../templates/modal.php";
$headPortrait = $_POST['headPortrait'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$existUserFlag = false;
if (mysqli_fetch_array(queryData('accounts', 'username', "username='$username'"))) {
    $existUserFlag = true;
    echo "<script>showMyModal('注册校验', '用户名【 $username 】已存在!');
        $('#closeModalButton1').attr('onclick','hideMyModal(0)');
        $('#closeModalButton').attr('onclick','hideMyModal(0)');
                    </script>";
}
if(!$existUserFlag && $username && $email && $password) {
    if (insertData("accounts", [], [], ["username" => "'" . $username . "'", "email" => "'" . $email . "'",
        "password" => "'" . md5($password) . "'", "headPortrait" => "'" . $headPortrait . "'"])) {
        $act = mysqli_fetch_array(queryData('accounts', 'username,permission,status',
            "username='$username'"));
        $_SESSION['user'] = $act['username'];
        $_SESSION['permission'] = $act['permission'];
        $_SESSION['status'] = $act['status'];
        $_SESSION['lastloginip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['lastLoginTime'] = date('Y-m-d H:i:s');
        echo "<script>showMyModal('注册校验', '恭喜【 $username 】注册成功!');
            $('#closeModalButton1').attr('onclick','hideMyModal(2)');
            $('#closeModalButton').attr('onclick','hideMyModal(2)');
                    </script>";
    } else {
        $error = mysqli_error($conn);
        echo "<script>showMyModal('注册校验', '数据库异常$error ！');
            </script>";
    }
    closeDatabase();
}
