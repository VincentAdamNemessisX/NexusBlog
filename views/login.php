<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?php
        if(isset($_SESSION['tabtitle']) && $_SESSION['tabtitle'] != '')
            echo $_SESSION['tabtitle'];
        else
            echo 'NexusBlog';
        ?>
        Login Page
    </title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        body {
            background-color: #000;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background-color: #212121;
            color: #fff;
            border: none;
        }
        .btn-primary {
            background-color: #e53935;
            border-color: #e53935;
        }

        .btn-primary:hover {
            background-color: #c62828;
            border-color: #c62828;
        }

        /* 隐藏原始的复选框 */
        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* 复选框样式 */
        .checkbox-container .checkmark {
            position: relative;
            display: inline-block;
            width: 18px;
            height: 18px;
            margin-right: 10px;
            background-color: #eee;
            border-radius: 4px;
        }

        /* 选中时的样式 */
        .checkbox-container input:checked + .checkmark {
            background-color: #2196f3;
        }

        /* 选中时的图标样式 */
        .checkbox-container .checkmark i {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-size: 12px;
            display: none;
        }

        /* 选中时的图标显示 */
        .checkbox-container input:checked + .checkmark i {
            display: block;
        }

        .imgSize {
            width: 150px;
        }

        #myModal {
            color: red;
            font-weight: bolder;
        }
    </style>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/jquery-3.7.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/customscript.js"></script>
</head>
<body class="d-flex align-items-center">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h4>登录</h4></div>
                <div class="text-center mt-3">
                    <img id="headPortrait" src="../images/avatar-default.png" alt="Avatar"
                         class="rounded-circle imgSize">
                </div>
                <div class="card-body">
                    <form action="../handle/login.php" method="post" id="form">
                        <div class="form-group">
                            <label for="username">用户名</label>
                            <input type="text" class="form-control" name="username" id="username"
                                   placeholder="请输入用户名">
                        </div>
                        <div class="form-group">
                            <label for="password">密码</label>
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="请输入密码">
                        </div>
                        <label class="checkbox-container">
                            <input type="checkbox" name="rmbMe">
                            <span class="checkmark">
                                <i class="fa fa-check"></i>
                            </span>记住密码
                        </label>
                        <button type="button" class="btn btn-primary btn-block" name="sb" onclick="check()">登录</button>
                        <small class="d-block text-center mt-3"><a href="register.php">注册</a></small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title" class="modal-title"></h3>
                <button type="button" onclick="hideMyModal()" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p id="modal-body"></p>
            </div>
            <div class="modal-footer">
                <button id="closeModalButton" onclick="hideMyModal()" class="btn btn-secondary" data-dismiss="modal">
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

    function hideMyModal() {
        $("#myModal").modal("hide");
    }
</script>
<script>
    function fillHeadPortrait(headurl) {
            const headPortrait = document.getElementById('headPortrait');
            headPortrait.src = headurl;
    }

    $(document).ready(function() {
        // 获取用户名和密码输入框的引用
        const usernameInput = $("#username");
        const passwordInput = $("#password");

        // 监听输入框的输入事件
        usernameInput.on("input focusin focusout", function() {
            // 获取输入框中的值
            const username = $(this).val();
            const DEFAULTHEADPORTRAIT = "../images/avatar-default.png";

            // 检查输入是否有效，例如长度是否超过3个字符
            if(username.length < 3) {
                $(this).removeClass("is-valid");
                $(this).addClass("is-invalid");
            } else {
                $(this).removeClass("is-invalid");
                $(this).addClass("is-valid");
                $.ajax({
                    type: "POST",
                    url: "../function/autoFillHeadPortrait.php",
                    data: {
                        username: encodeAll(username),
                    },
                    success: function (data) {
                        if (data !== "failed") {
                            fillHeadPortrait(encodeForUrl(data));
                            return true;
                        } else {
                            fillHeadPortrait(DEFAULTHEADPORTRAIT);
                            return false;
                        }
                    }
                });
            }
        });

        passwordInput.on("input focusin focusout", function() {
            // 获取输入框中的值
            const password = $(this).val();

            // 检查输入是否有效，例如长度是否超过4个字符
            if(password.length < 4) {
                $(this).removeClass("is-valid");
                $(this).addClass("is-invalid");
            } else {
                $(this).removeClass("is-invalid");
                $(this).addClass("is-valid");
            }
        });
    });

    function check() {
        var username = document.getElementById("username").classList.contains("is-valid");
        var password = document.getElementById("password").classList.contains("is-valid");
        var form = document.getElementById("form");
        if(password && username) {
            form.submit();
        } else {
            // alert("请检查用户名或密码！");
            showMyModal("登录验证", "请检查用户名或密码！");
        }
    }
</script>
</body>
</html>