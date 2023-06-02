<!DOCTYPE html>
<html lang="en">
<?php
$action = $_GET['action'] ?? "";
$blogid = $_GET['blogid'] ?? "";
include_once "../../../database/databaseHandle.php";
$blogshowstyle_rst = queryData('blogpagestyle');
$type_rst = queryData('blogtype');
if ($action && $blogid) {
    $blog_info = mysqli_fetch_array(queryData('blog', "*", "blogid=$blogid"));
}
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
    <script src="../../../js/customscript.js"></script>
    <link href="../../css/font.css" rel="stylesheet">
    <link href="../../../css/xadmin.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/customstyle.css">
    <script charset="utf-8" src="../../lib/layui/layui.js"></script>
    <script src="../../js/xadmin.js" type="text/javascript"></script>
    <script src="../../js/jquery.min.js"></script>
    <style>
        select option {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 5px;
        }

        select option:

        'selected'
        {
            background-color: #fff
        ;
            color: #000
        ;
        }

        .control {
            width: 20%;
            text-align: center;
        }

        select, input {
            border: 3px solid purple;
        }

        #editor {
            border: 3px solid purple;
            box-shadow: 5px 5px;
        }

        .personal-color {
            border: 3px solid purple;
        }

        label {
            font-size: 20px;
            font-family: Consolas, sans-serif;
            font-weight: bold;
        }
    </style>
</head>
<body>
<!-- 包裹整个博客编辑页内容的顶级容器 -->
<div class="blog-edit-container">
    <div class="title">
        <label for="title" class="form-label mt-1" style="width: 5%">标题</label>
        <input type="text" id="title" class="mr-3" style="border: 3px solid purple" placeholder="在此处输入标题"
               value="<?php echo $blog_info['title'] ?? '' ?>">
        <button onclick="publish()"
                style="background-color: purple"><?php echo $action == "edit" && $blogid ? "修改博客" : "发布博客" ?></button>
        <?php
        if ($action == "edit" && $blogid) {
            echo <<<btn
            <button onclick="reset()" class="ml-2" style="background-color: purple">重置</button>
    btn;
        }
        ?>
    </div>
    <div class="type mb-3 mt-3">
        <label for="type" class="form-label">博客分类</label>
        <select id="type" class="form-control control personal-color">
            <?php
            while ($type = mysqli_fetch_array($type_rst)) {
                if ($type['name'] == $blog_info['type']) {
                    echo "<option value='$type[name]' selected>$type[name]</option>";
                    continue;
                }
                echo "<option value='$type[name]'>$type[name]</option>";
            }
            ?>
        </select><br/>
    </div>
    <div class="mb-3">
        <label for="abstract" class="form-label">博客摘要:</label>
        <textarea id="abstract" class="form-control" style="border: 2px solid purple; box-shadow: 5px 5px" rows="5"
                  cols="80"
                  placeholder="在此输入文章摘要"><?php echo $blog_info['abstract'] ?? '' ?></textarea>
    </div>
    <div class="mb-3">
        <label for="blogshowstyle">博客展示方式</label>
        <select id="blogshowstyle" class="form-control control personal-color">
            <?php
            while ($blogshowstyle = mysqli_fetch_array($blogshowstyle_rst)) {
                if ($blog_info['blogshowstyle'] == $blogshowstyle['urlname']) {
                    echo "<option value='$blogshowstyle[urlname]' selected>$blogshowstyle[name]</option>";
                    continue;
                }
                echo "<option value='$blogshowstyle[urlname]'>$blogshowstyle[name]</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="author" class="col-form-label">作者</label>
        <input type="text" class="text-center fa-user-plus disabled" id="author" style="border: none"
               disabled value="<?php echo $blog_info['author'] ?? $_SESSION['user'] ?? 'Illegal user' ?>">
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
        height: "calc(90% - 50px)",
        // 编辑器中的初始内容
        markdown: <?php echo $blog_info ? json_encode($blog_info['content']) : "'#请在此输入博客内容'" ?>,
        // 指定 editor.md 依赖的插件路径
        path: "editor.md/lib/"
    });

    // 发布博客
    function publish() {
        const pre = $("pre");
        const spans = pre.find("span");
        const text = spans.map(function () {
            return $(this).text();
        }).get().join("");
        var layer = layui.layer;
        const title = $("#title").val();
        const abstract = $("#abstract").val();
        const type = $("#type").val();
        const blogshowstyle = $("#blogshowstyle").val();
        $.ajax({
            url: "../../handle/blog-handle.php",
            type: "POST",
            data: {
                action: "<?php echo $action ?? 'publish' ?>",
                blogid: "<?php echo $blogid ?? '' ?>",
                title: title,
                abstract: abstract,
                type: type,
                blogshowstyle: blogshowstyle,
                content: text
            },
            success: function (data) {
                if (data === "success") {
                    layer.alert("<?php echo $action == "edit" && $blogid ? "修改" : "发布" ?>成功！", {icon: 6});
                    setTimeout(function () {
                        xadmin.close();
                        // xadmin.father_reload();
                    }, 3000);
                } else {
                    layer.alert("<?php echo $action == "edit" && $blogid ? "修改" : "发布" ?>失败！", {icon: 5})
                }
            }
        })
    }

    function reset() {
        window.location.reload(true);
    }
</script>
</body>
</html>