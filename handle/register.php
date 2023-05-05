<?php
global $conn;
session_start();
date_default_timezone_set('PRC');
include_once '../database/databaseHandle.php';
$headPortrait = $_POST['headPortrait'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$existUserFlag = false;
if (mysqli_fetch_array(queryData('accounts', 'username', "username='$username'"))) {
    $existUserFlag = true;
    echo "<script>alert('Username $username already exists!');window.history.back();</script>";
}
if(!$existUserFlag && $username && $email && $password) {
    if (insertData("accounts", [], [], ["username" => "'" . $username . "'", "email" => "'" . $email . "'",
        "password" => "'" . md5($password) . "'", "headPortrait" => "'" . $headPortrait . "'"])) {
        $_SESSION['user'] = $username;
        echo "<script>alert('$username, Register Successful!');location.href='../views/index.php';</script>";
    } else {
        $error = mysqli_error($conn);
        echo "<script>alert('$error');window.history.back();</script>";
    }
    closeDatabase();
}
