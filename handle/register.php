<?php
global $conn;
session_start();
date_default_timezone_set('PRC');
include_once '../database/databaseHandle.php';
$headPortrait = $_POST['headPortrait'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
if(insertData("accounts", [], [], ["username" => $username, "email" => $email,
    "password" => md5($password), "headPortrait" => $headPortrait])) {
    closeDatabase();
    echo "<script>alert('Register Successful!');location.href='./index.php';</script>";
} else {
    closeDatabase();
    $error = mysqli_error($conn);
    echo "<script>alert('$error');location.history.back();</script>";
}
$_SESSION['user'] = $username;
