<?php
session_start();
include_once "../database/databaseHandle.php";
?>
<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>用户修改</title>
    <meta content="webkit" name="renderer">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"
          name="viewport"/>
    <link href="./css/font.css" rel="stylesheet">
    <link href="../css/xadmin.css" rel="stylesheet">
    <script charset="utf-8" src="./lib/layui/layui.js" type="text/javascript"></script>
    <script src="./js/xadmin.js" type="text/javascript"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="./js/html5.min.js"></script>
    <script src="./js/respond.min.js"></script>
    <![endif]-->
    <style>
        #image_hdpt {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
<?php
$current_user_info = mysqli_fetch_array(queryData('accounts', '*', 'accountid=' . $_GET['accountid']));
?>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_username">
                    <span class="x-red">*</span>用户名</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="L_username" lay-verify="username"
                           name="username" required="required"
                           value="<?php echo $current_user_info['username'] ?? ''; ?>"
                           type="text" disabled></div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>您唯一的登入名
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_email">
                    <span class="x-red">*</span>邮箱</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="L_email" lay-verify="email" name="email"
                           required=""
                           type="text" value="<?php echo $current_user_info['email'] ?? '' ?>"></div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_headPortrait">
                    <span class="x-red">*</span>头像</label>
                <div class="layui-input-inline">
                    <select required="" style="display: inline" class="layui-select layui-input" id="headPortrait"
                            name="headPortrait" onchange="change_hdpt()">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            if ($current_user_info['headPortrait'] == "../images/avatar-male-" . $i . '.jpg') {
                                echo '<option value="avatar-male-' . $i . '.jpg" selected>' . "男生头像" . $i . '</option>';
                            } else {
                                echo '<option value="avatar-male-' . $i . '.jpg">' . "男生头像" . $i . '</option>';
                            }
                            if ($current_user_info['headPortrait'] == "../images/avatar-female-" . $i . '.jpg') {
                                echo '<option value="avatar-female-' . $i . '.jpg" selected>' . "女生头像" . $i . '</option>';
                            } else {
                                echo '<option value="avatar-female-' . $i . '.jpg">' . "女生头像" . $i . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <img style="margin: 0 auto; margin-top: 10px" id="image_hdpt"
                         src="<?php echo $current_user_info['headPortrait'] ?? '../images/avatar-male-2.jpg' ?>">
                    <script>
                        function init() {
                            $(".layui-form-select").css("display", "none");
                            $(".layui-form-radio").css("display", "none");
                        }

                        function change_hdpt() {
                            var headPortrait = $("#headPortrait").val();
                            var image_hdpt = $("#image_hdpt");
                            image_hdpt.attr('src', "../images/" + headPortrait);
                        }
                    </script>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_nickname">昵称</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="L_nickname" lay-verify="nickname" name="nickname"
                           type="text" value="<?php echo $current_user_info['nickname'] ?? '' ?>"></div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_gender">性别</label>
                <div id="L_gender">
                    <input style="display: inline-block" type="radio" name="gender" value="Male"
                        <?php echo $current_user_info['gender'] == 'Male' ? 'checked' : '' ?>>男
                    <input style="display: inline-block" type="radio" id="L_gender" name="gender" value="Female"
                        <?php echo $current_user_info['gender'] == 'Female' ? 'checked' : '' ?>>女
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_city">城市</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="L_city" lay-verify="city" name="city"
                           type="text" value="<?php echo $current_user_info['city'] ?? '' ?>"></div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_skill">技能</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input" id="L_skill" lay-verify="skill" name="skill"
                           type="text" value="<?php echo $current_user_info['skill'] ?? '' ?>"></div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_description">个人描述</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input"
                           id="L_description" lay-verify="description" name="description"
                           type="text" value="<?php echo $current_user_info['description'] ?? '' ?>"></div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="L_bio">BIO</label>
                <div class="layui-input-inline">
                    <input autocomplete="off" class="layui-input"
                           id="L_bio" lay-verify="bio" name="bio"
                           type="text" value="<?php echo $current_user_info['bio'] ?? '' ?>"></div>
            </div>
            <div class="layui-form-item">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="accountid"
                       value="<?php echo $current_user_info['accountid'] ?? $_GET['accountid'] ?>">
                <label class="layui-form-label" for="L_repass"></label>
                <button class="layui-btn" lay-filter="add" lay-submit="">修改</button>
            </div>
        </form>
    </div>
</div>
<script>
    layui.use(['form', 'layer'],
        function () {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;
            init();
            //自定义验证规则
            form.verify({
                username: function (value) {
                    if (value.length < 3) {
                        return '用户名至少3个字符';
                    }
                },
                email: function (value) {
                    if (value.length < 1) {
                        return '邮箱不能为空';
                    }
                    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                    if (!regex.test(value)) {
                        return '请输入正确的邮箱格式';
                    }
                }
            });

            //监听提交
            form.on('submit(add)',
                function (data) {
                    //发异步，把数据提交给php
                    $.ajax({
                        url: './handle/user-handle.php',
                        type: 'POST',
                        dataType: 'text',
                        data: data.field,
                        success: function (data) {
                            if (data === 'success') {
                                layer.alert("修改成功!", {
                                        icon: 6
                                    },
                                    function () {
                                        // 获得frame索引
                                        var index = parent.layer.getFrameIndex(window.name);
                                        //关闭当前frame
                                        xadmin.father_reload();
                                        parent.layer.close(index);
                                    });
                            } else {
                                layer.alert("修改失败:" + data + "!", {icon: 5});
                            }
                        }
                    });
                    return false;
                });

        });
</script>
</body>
</html>