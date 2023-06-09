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
        Register Page
    </title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/jquery-3.7.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/customscript.js"></script>
    <style>
        body {
            background-color: #000;
            color: #fff;
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
        /* 居中主体部分 */
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        /* 调整输入框样式 */
        .form-control {
            background-color: #424242;
            color: #fff;
            border-color: #e53935;
        }
        .form-control:focus {
            background-color: #424242;
            color: #fff;
            border-color: #e53935;
            box-shadow: none;
        }

        /* 响应式布局注册页面主体 */
        .card {
            width: 600px;
        }

        .register-form {
            margin: 0 auto;
            width: 500px;
        }

        @media screen and (max-width: 768px) {
            .register-form {
                width: auto;
            }
            .card {
                width: auto;
            }
        }
        /* 调整注册按钮样式 */
        .btn-register {
            background-color: #e53935;
            border-color: #e53935;
            width: 100%;
            margin-top: 20px;
        }
        .btn-register:hover {
            background-color: #c62828;
            border-color: #c62828;
        }
        /* 调整错误提示信息样式 */
        .form-text {
            margin-top: 5px;
            display: none;
        }
        .form-text.active {
            display: block;
        }

        .imgSize {
            width: 150px;
        }

        #myModal {
            text-align: center;
            color: red;
            font-weight: bolder;
            font-size: x-large;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h4>注册</h4></div>
                <div class="card-body">
                    <form class="register-form" action="../handle/register.php" method="post">
                        <div class="text-center mt-3">
                            <label for="headPortrait"></label>
                            <select id="headPortrait" class="form-group" name="headPortrait"
                                    onload="fillHeadPortrait()" onchange="fillHeadPortrait()">
                                <option value="../images/avatar-male-1.jpg">男生头像-1-力量</option>
                                <option value="../images/avatar-male-2.jpg">男生头像-2-星空</option>
                                <option value="../images/avatar-male-3.jpg">男生头像-3-落日</option>
                                <option value="../images/avatar-male-4.jpg">男生头像-4-天空</option>
                                <option value="../images/avatar-male-5.jpg">男生头像-5-自信</option>
                                <option value="../images/avatar-female-1.jpg" selected>女生头像-1-春日</option>
                                <option value="../images/avatar-female-2.jpg">女生头像-2-鲜花</option>
                                <option value="../images/avatar-female-3.jpg">女生头像-3-自由</option>
                                <option value="../images/avatar-female-4.jpg">女生头像-4-落日</option>
                                <option value="../images/avatar-female-5.jpg">女生头像-5-夕阳</option>
                            </select><br/>
                            <input type="image" src="../images/avatar-female-1.jpg" id="img_head" alt="headPortrait" class="rounded-circle imgSize">
                        </div>
                        <div class="form-group">
                            <label for="username">用户名</label>
                            <input type="text" class="form-control" name="username" id="username"
                                   oninput="checkUsername()" onfocusin="checkUsername()" onfocusout="checkUsername()"
                                   placeholder="请输入用户名">
                            <small id="usernameError" style="display: block" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="email">邮箱</label>
                            <input type="email" class="form-control" name="email" id="email" oninput="checkEmail()"
                                   onfocusin="checkEmail()" onfocusout="checkEmail()"
                                   placeholder="请输入邮箱">
                            <small id="emailError" style="display: block" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="password">密码</label>
                            <input type="password" class="form-control" name="password"
                                   id="password" oninput="checkPassword()" onfocusin="checkPassword()"
                                   onfocusout="checkPassword()" placeholder="请输入密码">
                            <small id="passwordError" style="display: block" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">再次输入密码</label>
                            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword"
                                   oninput="checkConfirmPassword()" onfocusin="checkConfirmPassword()"
                                   onfocusout="checkConfirmPassword()" placeholder="请再次输入密码">
                            <small id="confirmPasswordError" style="display: block" class="form-text text-danger"></small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-register" name="reg">注册</button>
                        <small class="d-block text-center mt-3"><a href="login.php">登录</a></small>
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
    let form = document.querySelector('form');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const usernameError = document.getElementById('usernameError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        if(checkInputs()) {
            form.submit();
        } else {
            // alert("请检查输入项是否符合要求!");
            showMyModal("注册验证", "请检查输入项是否符合要求！");
        }
    });

    function fillHeadPortrait() {
        const headPortrait = document.getElementById('headPortrait');
        const img_head = document.getElementById('img_head');
        img_head.src = headPortrait.value;
    }

    function isUsername(username) {
        return /^[a-zA-Z0-9_]+$/.test(username);
    }

    function checkUsername() {
        const usernameValue = username.value.trim();
        if (usernameValue === '') {
            setErrorFor(username, usernameError, '用户名不能为空');
            return false;
        } else if (usernameValue.length < 3 || usernameValue.length > 20) {
            setErrorFor(username, usernameError, '用户名长度必须在3-20个字符之间');
            return false;
        } else if (!isUsername(usernameValue)) {
            setErrorFor(username, usernameError, '用户名只能包含字母、数字、下划线');
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: "../function/checkUserName.php",
                data: {
                    username: encodeAll(usernameValue),
                },
                success: function (data) {
                    if (data === "success") {
                        setSuccessFor(username, usernameError);
                        return true;
                    } else {
                        setErrorFor(username, usernameError, "用户名已存在");
                        return false;
                    }
                }
            });
            return true;
        }
    }

    function checkEmail() {
        const emailValue = email.value.trim();
        if (emailValue === '') {
            setErrorFor(email, emailError, '邮箱不能为空！');
            return false;
        } else if (!isEmail(emailValue)) {
            setErrorFor(email, emailError, '无效的邮箱地址！');
            return false;
        } else {
            setSuccessFor(email, emailError);
            return true;
        }
    }

    function checkPassword() {
        const passwordValue = password.value.trim();
        if (passwordValue === '') {
            setErrorFor(password, passwordError, '密码不能为空！');
            return false;
        } else if (passwordValue.length < 6) {
            setErrorFor(password, passwordError, '密码至少6位！');
            return false;
        } else {
            setSuccessFor(password, passwordError);
            return true;
        }
    }

    function checkConfirmPassword() {
        const confirmPasswordValue = confirmPassword.value.trim();
        if (confirmPasswordValue === '') {
            setErrorFor(confirmPassword, confirmPasswordError, '第二次输入密码不能为空！');
        } else if (confirmPasswordValue !== password.value.trim()) {
            setErrorFor(confirmPassword, confirmPasswordError, '两次密码不匹配！');
            return false;
        } else {
            setSuccessFor(confirmPassword, confirmPasswordError);
            return true;
        }
    }

    function checkInputs() {
        return checkUsername() && checkEmail() && checkPassword() && checkConfirmPassword();
    }

    function setErrorFor(input, error, message) {
        error.innerText = message;
        input.classList.remove('is-valid');
        input.classList.add('is-invalid');
    }

    function setSuccessFor(input, error) {
        error.innerText = '';
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    }

    function isEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
</script>
</body>
</html>