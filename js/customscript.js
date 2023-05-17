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