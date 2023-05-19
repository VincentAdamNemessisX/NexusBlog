<?php
session_start();
include_once '../database/databaseHandle.php';
include_once "../templates/modal.php";
date_default_timezone_set('PRC');
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $acts = queryData("accounts", "username,password", "username='" . $_POST['username'] . "'");
        $act = mysqli_fetch_array($acts);
        closeDatabase();
        if ($act) {
            if (md5($_POST['password']) == $act['password']) {
                $_SESSION['user'] = $act['username'];
                $_SESSION['lastLoginTime'] = date('Y-m-d H:i:s');
                echo "<script>showMyModal('登录验证', '登录成功！');
                    $('#closeModalButton1').attr('onclick','hideMyModal(2)');
                    $('#closeModalButton').attr('onclick','hideMyModal(2)');</script>";
            } else {
                echo "<script>showMyModal('登录验证', '登录失败, 请检查用户名或密码!');
                    $('#closeModalButton1').attr('onclick','hideMyModal(1)');
                    $('#closeModalButton').attr('onclick','hideMyModal(1)');</script>";
            }
        } else {
            echo "<script>showMyModal('登录验证', '登录失败, 用户不存在!');
                $('#closeModalButton1').attr('onclick','hideMyModal(1)');
                $('#closeModalButton').attr('onclick','hideMyModal(1)');</script>";
        }
    }
