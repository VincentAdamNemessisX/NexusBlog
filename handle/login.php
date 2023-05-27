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
                echo "<script>$('#closeModalButton1').attr('onclick','hideMyModal(2)');
                    $('#closeModalButton').attr('onclick','hideMyModal(2)');
                    showMyModal('登录验证', '登录成功！');</script>";
            } else {
                echo "<script>$('#closeModalButton1').attr('onclick','hideMyModal(1)');
                    $('#closeModalButton').attr('onclick','hideMyModal(1)');
                    showMyModal('登录验证', '登录失败, 请检查用户名或密码!');</script>";
            }
        } else {
            echo "<script>$('#closeModalButton1').attr('onclick','hideMyModal(1)');
                $('#closeModalButton').attr('onclick','hideMyModal(1)');
                showMyModal('登录验证', '登录失败, 用户不存在!');</script>";
        }
    }
?>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<style>
#myModal {
text-align: center;
        color: red;
        font-weight: bolder;
        font-size: x-large;
    }
</style>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/jquery-3.7.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/customscript.js"></script>
<body>
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title" class="modal-title"></h3>
                <button type="button" id="closeModalButton1" onclick="hideMyModal(0)" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p id="modal-body"></p>
            </div>
            <div class="modal-footer">
                <button id="closeModalButton" onclick="hideMyModal(0)" class="btn btn-secondary" data-dismiss="modal">
    我知道了
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    function showMyModal(title, msg) {
        $("#modal-title").text(title);
        $("#modal-body").text(msg);
        $("#myModal").modal("show");
    }

    function hideMyModal(x) {
        if(x == 0) {
            $("#myModal").modal("hide");
        }
        if(x == 1) {
            window.history.back();
        }
        if(x == 2) {
            window.location.href = "../views/index.php";
        }
    }
</script>
