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
    <link rel="stylesheet" href="../css/bootstrap-min-4.5.2.css">
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
    </style>
</head>
<body class="d-flex align-items-center">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h4>Login</h4></div>
                <div class="text-center mt-3">
                    <img src="../images/avatar-male-1.jpg" alt="Avatar" class="rounded-circle imgSize">
                </div>
                <div class="card-body">
                    <form action="../handle/login.php" method="post" id="form">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                        </div>
                        <label class="checkbox-container">
                            <input type="checkbox" name="rmbMe">
                            <span class="checkmark">
                                <i class="fa fa-check"></i>
                            </span>记住密码
                        </label>
                        <button type="button" class="btn btn-primary btn-block" name="sb" onclick="check()">Login</button>
                        <small class="d-block text-center mt-3"><a href="register.php">Register</a></small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(document).ready(function() {
        // 获取用户名和密码输入框的引用
        const usernameInput = $("#username");
        const passwordInput = $("#password");

        // 监听输入框的输入事件
        usernameInput.on("input focusin focusout", function() {
            // 获取输入框中的值
            const username = $(this).val();

            // 检查输入是否有效，例如长度是否超过3个字符
            if(username.length < 3) {
                $(this).removeClass("is-valid");
                $(this).addClass("is-invalid");
            } else {
                $(this).removeClass("is-invalid");
                $(this).addClass("is-valid");
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
            alert("请检查用户名或密码！");
            history.back();
        }
    }
</script>
</body>
</html>