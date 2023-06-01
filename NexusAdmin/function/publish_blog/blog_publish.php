<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>博客编辑页</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/blog_edit.css">

    <!-- 引入 editor.md 的依赖 -->
    <link rel="stylesheet" href="editor.md/css/editormd.min.css" />
    <script src="../../js/jquery3.6.min.js"></script>
    <script src="editor.md/lib/marked.min.js"></script>
    <script src="editor.md/lib/prettify.min.js"></script>
    <script src="editor.md/editormd.js"></script>
</head>
<body>
    <!-- 包裹整个博客编辑页内容的顶级容器 -->
    <div class="blog-edit-container">
        <div class="title">
            <input type="text" id="title" placeholder="在此处输入标题">
            <button onclick="publish()">发布文章</button>
        </div>
        <div>
            <select id="type">
                <option></option>
            </select>
            <textarea id="abstract" rows="5" cols="100" placeholder="在此输入文章摘要"></textarea>
        </div>
        <!-- 放置 md 编辑器 -->
        <div id="editor"></div>
    </div>
    <script>
        // 初始化编辑器
        let editor = editormd("editor", {
            // 这里的尺寸必须在这里设置. 设置样式会被 editormd 自动覆盖掉. 
            width: "100%",
            // 设定编辑器高度
            height: "calc(100% - 50px)",
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
            }).get().join("");
            const title = $("#title").val();
            const abstract = $("#abstract").val();
            $.ajax({
                url: "publish_blog.php",
                type: "POST",
                data: {
                    title: title,
                    abstract: abstract,
                    content: text
                },
                success: function (data) {
                    if (data === "success") {
                        alert("发布成功");
                        window.location.href = "blog_list.php";
                    } else {
                        alert("发布失败");
                    }
                }
            })
        }
    </script>
</body>
</html>