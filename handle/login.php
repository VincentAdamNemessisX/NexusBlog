<?php
session_start();
include_once '../database/databaseHandle.php';
date_default_timezone_set('PRC');
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $acts = queryData("accounts", "username,password", "username='" . $_POST['username'] . "'");
        $act = mysqli_fetch_array($acts);
        closeDatabase();
        if ($act) {
            if (md5($_POST['password']) == $act['password']) {
                $_SESSION['user'] = $act['username'];
                $_SESSION['lastLoginTime'] = date('Y-m-d H:i:s');
                echo "<script>alert('Login Successful!');location.href= '../views/index.php';</script>";
            } else {
                echo "<script>alert('Login Failed, please check your username or password!'); history.back();</script>";
            }
        } else {
            echo "<script>alert('Login Failed, the user is not exists!'); history.back()</script>";
        }
    }
