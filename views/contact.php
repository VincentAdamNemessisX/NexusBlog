<?php include_once "../templates/header.php" ?>
<!-- .site-content -->
<div class="site-content" style="margin-top: 5%">
    <div class="atbs-block atbs-block--fullwidth module-contact">
        <div class="container" style="margin-bottom: 4.15%">
            <div class="atbs-block__inner flex-box flex-box-2i flex-space-50 align-item-center">
                <div class="section-main">
                    <div class="contact-heading">
                        <h1>
                            联系我们
                        </h1>
                        <p class="contact-description">
                            有任何问题，欢迎联系我们
                        </p>
                    </div>
                    <iframe allowfullscreen="" loading="lazy" src="javascript:;" style="border:0;"></iframe>
                </div>
                <div class="section-sub">
                    <div class="contact-form">
                        <form action="../handle/feedback.php" method="post">
                            <?php
                                if($_SESSION['user'] != null) {
                                    $currentuser = $_SESSION['user'];
                                    $userinfo = queryData('accounts' , '*' ,
                                        "username = '$currentuser'")->fetch_assoc();
                                    $name = $userinfo['nickname'] ?? $userinfo['username'];
                                    echo <<<formcontent
                            <label for="fname">姓名:</label>
                            <input id="fname" name="name" type="text" value="$name" disabled><br><br><br>
                            <label for="email">邮箱:</label>
                            <input id="email" name="email" type="email" value="$userinfo[email]" disabled><br><br><br>
formcontent;
                                } else {
                                    echo <<<formcontent
                            <label for="fname">姓名:</label>
                            <input id="fname" name="name" type="text" oninput="checkUsername()"
                                   onfocusin="checkUsername()" onfocusout="checkUsername()" 
                                   placeholder="请输入预留姓名">
                            <small id="usernameError" class="form-text text-danger"></small>
                            <br><br><br>
                            <label for="email">邮箱:</label>
                            <input id="email" name="email" type="email" oninput="checkEmail()"
                                   onfocusin="checkEmail()" onfocusout="checkEmail()" placeholder="请输入预留邮箱">
                            <small id="emailError" class="form-text text-danger"></small><br><br><br>
formcontent;
                                }
                            ?>
                            <label for="contactform-message">内容</label>
                            <textarea aria-required="true" class="required form-control"
                                      cols="30" id="contactform-message" name="contactform-message" rows="6"
                            placeholder="请输入你要反馈的内容"></textarea>
                            <input class="btn contactform-submit" id="contactform-submit" name="contactform-submit"
                                    type="button" value="发送">
                        </form>
                        <script>
                            const name = document.getElementById('fname');
                            const email = document.getElementById('email');
                            const usernameError = document.getElementById('usernameError');
                            const emailError = document.getElementById('emailError');
                            $(document).ready(function () {
                                $("#contactform-submit").click(function () {
                                    var name = $("#fname").val();
                                    var email = $("#email").val();
                                    var message = $("#contactform-message").val();
                                    if (name === '' || email === '' || message === '') {
                                        alert("请填写完整信息");
                                    } else {
                                        $.ajax({
                                            type: "POST",
                                            url: "../handle/feedback.php",
                                            data: {
                                                name: name,
                                                email: email,
                                                message: message
                                            },
                                            success: function (data) {
                                                if (data === "success") {
                                                    alert("反馈成功！");
                                                    $("#contactform-message").val('');
                                                } else {
                                                    alert("反馈失败！");
                                                }
                                            }
                                        });
                                    }
                                });
                            });

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

                            function checkUsername() {
                                const usernameValue = name.value.trim();
                                if (usernameValue === '') {
                                    setErrorFor(name, usernameError, 'Username cannot be blank');
                                    return false;
                                } else {
                                    setSuccessFor(name, usernameError);
                                    return true;
                                }
                            }

                            function checkEmail() {
                                const emailValue = email.value.trim();
                                if (emailValue === '') {
                                    setErrorFor(email, emailError, 'Email cannot be blank');
                                    return false;
                                } else if (!isEmail(emailValue)) {
                                    setErrorFor(email, emailError, 'Not a valid email');
                                    return false;
                                } else {
                                    setSuccessFor(email, emailError);
                                    return true;
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .site-content -->
<?php include_once "../templates/footer.php" ?>
