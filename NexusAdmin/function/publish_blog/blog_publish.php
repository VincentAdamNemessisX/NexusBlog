<!DOCTYPE html>
<html lang="en">
<?php
$action = $_GET['action'] ?? "";
$blogid = $_GET['blogid'] ?? "";
include_once "../../../database/databaseHandle.php";
$blog_info = mysqli_fetch_array(queryData('blog', "*", "id=$blogid"));
print_r($blog_info);
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>博客编辑页</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/blog_edit.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- 引入 editor.md 的依赖 -->
    <link rel="stylesheet" href="editor.md/css/editormd.min.css"/>
    <script src="../../js/jquery3.6.min.js"></script>
    <script src="editor.md/lib/marked.min.js"></script>
    <script src="editor.md/lib/prettify.min.js"></script>
    <script src="editor.md/editormd.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <style>
        select option {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 5px;
        }

        select option[selected] {
            background-color: #fff;
            color: #000;
        }
    </style>
</head>
<body>
<!-- 包裹整个博客编辑页内容的顶级容器 -->
<div class="blog-edit-container">
    <div class="title">
        <label for="title"></label>
        <input type="text" id="title" placeholder="在此处输入标题" value="<?php echo $blog_info['title'] ?? '' ?>">
        <button onclick="publish()"><?php echo $action == "edit" && $blogid ? "修改博客" : "发布博客" ?></button>
    </div>
    <div class="type mb-3 mt-3">
        <label for="type" class="form-label">博客分类</label>
        <select id="type" class="form-control">
            <?php
            $type_rst = queryData('blogtype');
            $current_type = mysqli_fetch_array(queryData('blog', "type", "id=$blogid"));
            while ($type = mysqli_fetch_array($type_rst)) {
                if ($type['name'] == $_GET['type']) {
                    echo "<option value='$type[name]' selected>$type[name]</option>";
                    continue;
                }
                echo "<option value='$type[name]'>$type[name]</option>";
            }
            ?>
        </select><br/>
    </div>
    <div class="mb-3">
        <label for="abstract" class="form-label">文章摘要</label><br/>
        <textarea id="abstract" style="border: none" rows="5" cols="80" placeholder="在此输入文章摘要"></textarea>
    </div>
    <div class="mb-3">
        <label for="blogshowstyle">博客展示方式</label>
        <select id="blogshowstyle" class="form-control">
            <?php
            $blogshowstyle_rst = queryData('blogpagestyle');
            while ($blogshowstyle = mysqli_fetch_array($blogshowstyle_rst)) {
                if ($blog_info['blogshowstyle'] == $blogshowstyle['name']) {
                    echo "<option value='$blogshowstyle[urlname]' selected>$blogshowstyle[name]</option>";
                    continue;
                }
                echo "<option value='$blogshowstyle[urlname]'>$blogshowstyle[name]</option>";
            }
            ?>
        </select>
    </div>
    <div></div>
    <!-- 放置 md 编辑器 -->
    <div id="editor"></div>
</div>
<script>
    // 初始化编辑器
    let editor = editormd("editor", {
        // 这里的尺寸必须在这里设置. 设置样式会被 editormd 自动覆盖掉.
        width: "90%",
        // 设定编辑器高度
        height: "calc(90% - 50px)",
        // 编辑器中的初始内容
        markdown: "# 在这里写下一篇博客",
        // 指定 editor.md 依赖的插件路径
        path: "editor.md/lib/"
    });

    function publish() {
        const pre = $("pre");
        const spans = pre.find("span");
        const text = spans.map(function () {
            return $(this).text();
        }).get().join("").trim("#");
        var layer = layui.layer;
        const title = $("#title").val();
        const abstract = $("#abstract").val();
        $.ajax({
            url: "../handle/blog_handle.php",
            type: "POST",
            data: {
                title: title,
                abstract: abstract,
                content: text
            },
            success: function (data) {
                if (data === "success") {
                    layer.alert("发布成功！", {icon: 6});
                } else {
                    layer.alert("发布失败！", {icon: 5})
                }
            }
        })
    }
</script>
</body>
</html>