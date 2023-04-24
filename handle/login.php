<?php
session_start();
include_once '../database/databaseHandle.php';
date_default_timezone_set('PRC');
if (isset($_POST['sb'])) {
    if (isset($_POST['unm']) && isset($_POST['pwd'])) {
        $acts = queryData("accounts", "*", "username='" . $_POST['unm'] . "'");
        $act = mysqli_fetch_array($acts);
        closeDatabase();
        if ($act) {
            if ($_POST['pwd'] == $act['password']) {
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
}
