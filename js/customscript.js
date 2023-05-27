function editComment(id, content) {
    var submit = document.getElementById('submit');
    var comment = document.getElementById('comment');
    var commentid = document.getElementById('commentid');
    var commentmethod = document.getElementById('comment_method');
    submit.value = "修改";
    comment.placeholder = content;
    comment.value = content;
    commentid.value = id;
    commentmethod.value = 2;
}

function removeComment(id) {
    var submit = document.getElementById('submit');
    var commentmethod = document.getElementById('comment_method');
    commentid.value = id;
    commentmethod.value = 3;
    submit.click();
}

function replyComment(parentid) {
    var commentparent = document.getElementById('comment_parent');
    var submit = document.getElementById('submit');
    var comment = document.getElementById('comment');
    var commentmethod = document.getElementById('comment_method');
    commentparent.value = parentid; submit.value = "回复";
    comment.placeholder = "你的回复";
    commentmethod.value = 1;
}

function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r != null) return unescape(r[2]); return null; //返回参数值
}

function encodeForHtml(str) {
    return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/"/g, '&quot;');
}

function encodeForUrl(str) {
    return encodeURIComponent(str);
}

function encodeForScript(str) {
    return str.replace(/'/g, '&apos;').replace(/"/g, '&quot;');
}

function encodeForCss(str) {
    return str.replace(/'/g, '&apos;').replace(/"/g, '&quot;');
}

function encodeForAttr(str) {
    return str.replace(/'/g, '&apos;').replace(/"/g, '&quot;');
}

function encodeAll(str) {
    return encodeForHtml(encodeForScript(encodeForCss(encodeForAttr(str))));
}

function checkLoginStatus() {
    $.ajax({
        type: "POST",
        url: "../handle/checkloginstatus.php",
        success: function (data) {
            if (data === "true") {
                $('#logout').attr('class', 'mdi mdi-logout');
                $('#logout1').attr('class', 'mdi mdi-logout hidden-xs');
                $('#logout2').attr('class', 'mdi mdi-logout visible-xs-inline-block');
                $('#logoutbtn1').attr('onclick', 'logout()');
                $('#logoutbtn2').attr('onclick', 'logout()');
            } else {
                $('#logout').attr('class', 'mdi mdi-login-variant');
                $('#logout1').attr('class', 'mdi mdi-login-variant hidden-xs');
                $('#logout2').attr('class', 'mdi mdi-login-variant visible-xs-inline-block');
                $('#logoutbtn1').attr('onclick', 'window.location.href="../views/login.php"');
                $('#logoutbtn2').attr('onclick', 'window.location.href="../views/login.php"');
                window.location.reload();
            }
        }
    })
}

function logout() {
    $.ajax({
        type: "POST",
        url: "../handle/logout.php",
        success: function () {
                $('#logout').attr('class', 'mdi mdi-login-variant');
                $('#logout1').attr('class', 'mdi mdi-login-variant hidden-xs');
                $('#logout2').attr('class', 'mdi mdi-login-variant visible-xs-inline-block');
                layer.msg('您已成功登出', {icon: 1});
                checkLoginStatus();
        },
    })
}