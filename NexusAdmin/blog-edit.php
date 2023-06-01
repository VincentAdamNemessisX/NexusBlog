<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
        <title>分类修改</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="stylesheet" href="./css/font.css">
        <link rel="stylesheet" href="../css/xadmin.css">
        <link rel="stylesheet" href="css/customstyle.css">
        <script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="./js/xadmin.js"></script>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
            <script src="js/html5.min.js"></script>
            <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="layui-fluid block-center">
            <div class="layui-row">
                <form class="layui-form">
                    <?php
                        include_once "../database/databaseHandle.php";
                        $blog_rst = queryData('blog', "*", "blogid = $_GET[blogid]");
                        $blog = mysqli_fetch_array($blog_rst);
                    ?>
                  <div class="layui-form-item">
                      <label for="name" class="layui-form-label extend-width">
                          <span class="x-red">*</span>标题
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="title" name="title" required="required"
                          autocomplete="off" class="layui-input" value="<?php echo $blog['title'] ?>">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>博客标题
                      </div>
                  </div>
                  <div class="layui-form-item">
                      <label for="showstyle" class="layui-form-label">
                          <span class="x-red">*</span>类型
                      </label>
                      <div class="layui-input-inline">
                            <input type="text" id="type" name="type" required="required"
                            autocomplete="off" class="layui-input" value="<?php echo $blog['type'] ?>">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>博客类型
                      </div>
                  </div>
                    <div class="layui-form-item">
                        <label for="showstyle" class="layui-form-label">
                            <span class="x-red">*</span>摘要
                        </label>
                        <div class="layui-input-inline">
                            <input type="text" id="abstract" name="abstract" required="required"
                                   autocomplete="off" class="layui-input layui-textarea" value="<?php echo $blog['abstract'] ?>">
                        </div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red">*</span>博客摘要
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="showstyle" class="layui-form-label">
                            <span class="x-red">*</span>内容
                        </label>
                        <div class="layui-input-inline">
                            <input type="text" id="content" name="content" required="required"
                                   autocomplete="off" class="layui-input layui-textarea" value="<?php echo $blog['content'] ?>">
                        </div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red">*</span>博客内容
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="showstyle" class="layui-form-label">
                            <span class="x-red">*</span>作者
                        </label>
                        <div class="layui-input-inline">
                            <input type="text" id="author" name="author" required="required"
                                   autocomplete="off" class="layui-input" disabled value="<?php echo $blog['author'] ?>">
                        </div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red">*</span>博客作者
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="blogshowstyle" class="layui-form-label">
                            <span class="x-red">*</span>显示方式
                        </label>
                        <div class="layui-input-inline">
                            <input type="text" id="blogshowstyle" name="blogshowstyle" required="required"
                                   autocomplete="off" class="layui-input" value="<?php echo $blog['blogshowstyle'] ?>">
                        </div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red">*</span>博客显示方式
                        </div>
                    </div>
                  <div class="layui-form-item">
                      <label for="L_repass" class="layui-form-label">
                      </label>
                      <button  class="layui-btn" lay-filter="add" lay-submit="">
                          修改
                      </button>
                  </div>
              </form>
            </div>
        </div>
        <script>
            layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;
                //监听提交
                form.on('submit(add)',
                function(data) {
                    $ = layui.jquery;
                    var form = layui.form,
                        layer = layui.layer;
                    //发异步，把数据提交给php
                    $.ajax({
                        type: "post",
                        url: "handle/blog-handle.php",
                        data: {
                            action: "edit",
                            blogid: <?php echo $_GET['blogid'] ?>,
                            title: data.field.title,
                            type: data.field.type,
                            abstract: data.field.abstract,
                            content: data.field.content,
                            blogshowstyle: data.field.blogshowstyle
                        },
                        success: function (data) {
                            if (data === "success") {
                                layer.alert("修改成功！", {
                                    icon: 6
                                }, function () {
                                    //关闭当前frame
                                    xadmin.close();
                                    // 可以对父窗口进行刷新
                                    xadmin.father_reload();
                                })
                                return true;
                            } else {
                                layer.alert("修改失败！", {
                                    icon: 5
                                })
                                return false;
                            }
                        }
                    })
                    return false;
                });

            });</script>
    </body>
</html>
