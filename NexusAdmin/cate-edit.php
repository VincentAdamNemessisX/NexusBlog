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
            <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
            <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="layui-fluid block-center">
            <div class="layui-row">
                <form class="layui-form">
                    <?php
                        include_once "../database/databaseHandle.php";
                        $type_rst = queryData('blogtype', "*", "blogtypeid = $_GET[typeid]");
                        $record = mysqli_fetch_array($type_rst);
                    ?>
                  <div class="layui-form-item">
                      <label for="name" class="layui-form-label extend-width">
                          <span class="x-red">*</span>分类名称
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="name" name="name" required="required"
                          autocomplete="off" class="layui-input" value="<?php echo $record['name'] ?>">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>此分类独一无二的名字
                      </div>
                  </div>
                  <div class="layui-form-item">
                      <label for="showstyle" class="layui-form-label">
                          <span class="x-red">*</span>显示方式
                      </label>
                      <div class="layui-input-inline">
                          <?php
                          switch ($record['showstyle']) {
                              case 1: echo "<input type='radio' name='showstyle' value='1' checked>
<input type='radio' name='showstyle' value='2'>
<input type='radio' name='showstyle' value='3'>
<input type='radio' name='showstyle' value='4'>";break;
                              case 2: echo "<input type='radio' name='showstyle' value='1'>
<input type='radio' name='showstyle' value='2' checked>
<input type='radio' name='showstyle' value='3'>
<input type='radio' name='showstyle' value='4'>";break;
                              case 3: echo "<input type='radio' name='showstyle' value='1'>
<input type='radio' name='showstyle' value='2'>
<input type='radio' name='showstyle' value='3' checked>
<input type='radio' name='showstyle' value='4'>";break;
                              case 4: echo "<input type='radio' name='showstyle' value='1'>
<input type='radio' name='showstyle' value='2'>
<input type='radio' name='showstyle' value='3'>
<input type='radio' name='showstyle' value='4' checked>";break;
                              default: echo "<input type='radio' name='showstyle' value='1'>
<input type='radio' name='showstyle' value='2'>
<input type='radio' name='showstyle' value='3'>
<input type='radio' name='showstyle' value='4'>";break;
                          }
                          ?>
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>该分类的显示方式
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
        <script>layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;


                //监听提交
                form.on('submit(add)',
                function(data) {
                    let show = $('input:radio[name="showstyle"]:checked').val();
                    //发异步，把数据提交给php
                    $.ajax({
                        type: "post",
                        url: "handle/blog-cate-handle.php",
                        data: {
                            action: "edit",
                            id: <?php echo $_GET['typeid'] ?>,
                            showstyle: show,
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
