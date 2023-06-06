<?php
session_start();
global $conn;
global $_VERSION;
global $_SERVER_ADDRESS;
global $_OS;
global $_RUN_ENV;
global $_PHP_VERSION;
global $_PHP_RUN_METHOD;
global $_MYSQL_VERSION;
global $_TOTAL_SPACE;
global $_FREE_SPACE;
global $_RUN_TIME;
include_once "../database/databaseHandle.php";
include "../config.php";
?>
<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="../css/xadmin.css">
    <script src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="./js/html5.min.js"></script>
    <script src="./js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php
$blog_count = mysqli_fetch_array(queryData('blog', 'count(*) as count'))['count'];
$user_count = mysqli_fetch_array(queryData('accounts', 'count(*) as count', 'permission < 9'))['count'];
$comment_count = mysqli_fetch_array(queryData('comment', 'count(*) as count'))['count'];
$category_count = mysqli_fetch_array(queryData('blogtype', 'count(*) as count'))['count'];
$blog_images_count = mysqli_fetch_array(queryData('blogimages', 'count(*) as count'))['count'];
$total_read_count = mysqli_fetch_array(queryData('blog', 'sum(readTimes) as count'))['count'];
?>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <blockquote class="layui-elem-quote">欢迎管理员：
                        <span class="x-red">
                                    <?php echo $_SESSION['user']; ?>
                                </span>！当前时间:<span id="crt_time" onload="showTime()"></span>
                    </blockquote>
                    <script>
                        function showTime() {
                            var date = new Date();
                            var year = date.getFullYear();
                            var month = date.getMonth() + 1;
                            var day = date.getDate();
                            var hour = date.getHours();
                            var minute = date.getMinutes();
                            var second = date.getSeconds();
                            var time = year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
                            document.getElementById("crt_time").innerHTML = time;
                        }
                        setInterval("showTime()", 1000);
                    </script>
                </div>
            </div>
        </div>
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">数据统计</div>
                <div class="layui-card-body ">
                    <ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
                        <li class="layui-col-md2 layui-col-xs6">
                            <a href="javascript:" class="x-admin-backlog-body">
                                <h3>博客数</h3>
                                <p>
                                    <cite><?php echo $blog_count ?? 0 ?></cite></p>
                            </a>
                        </li>
                        <li class="layui-col-md2 layui-col-xs6">
                            <a href="javascript:" class="x-admin-backlog-body">
                                <h3>用户数</h3>
                                <p>
                                    <cite><?php echo $user_count ?? 1 ?></cite></p>
                            </a>
                        </li>
                        <li class="layui-col-md2 layui-col-xs6">
                            <a href="javascript:" class="x-admin-backlog-body">
                                <h3>评论数</h3>
                                <p>
                                    <cite><?php echo $comment_count ?? 0 ?></cite></p>
                            </a>
                        </li>
                        <li class="layui-col-md2 layui-col-xs6">
                            <a href="javascript:" class="x-admin-backlog-body">
                                <h3>分类数</h3>
                                <p>
                                    <cite><?php echo $category_count ?? 0 ?></cite></p>
                            </a>
                        </li>
                        <li class="layui-col-md2 layui-col-xs6">
                            <a href="javascript:" class="x-admin-backlog-body">
                                <h3>博客资源数</h3>
                                <p>
                                    <cite><?php echo $blog_images_count ?? 0 ?></cite></p>
                            </a>
                        </li>
                        <li class="layui-col-md2 layui-col-xs6 ">
                            <a href="javascript:" class="x-admin-backlog-body">
                                <h3>总浏览量</h3>
                                <p>
                                    <cite><?php echo $total_read_count ?? 0 ?></cite></p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        $month_blog_count = mysqli_fetch_array(queryData('blog', 'count(*) as count',
            'date_format(publishTime, "%Y-%m") = date_format(now(), "%Y-%m")'))['count'];
        $month_blog_count_percent = round($month_blog_count / $blog_count * 100, 2);
        $year_blog_count = mysqli_fetch_array(queryData('blog', 'count(*) as count',
            'date_format(publishTime, "%Y") = date_format(now(), "%Y")'))['count'];
        $year_blog_count_percent = round($year_blog_count / $blog_count * 100, 2);
        $month_comment_count = mysqli_fetch_array(queryData('comment', 'count(*) as count',
            'date_format(commenttime, "%Y-%m") = date_format(now(), "%Y-%m")'))['count'];
        $month_comment_count_percent = round($month_comment_count / $comment_count * 100, 2);
        $year_comment_count = mysqli_fetch_array(queryData('comment', 'count(*) as count',
            'date_format(commenttime, "%Y") = date_format(now(), "%Y")'))['count'];
        $year_comment_count_percent = round($year_comment_count / $comment_count * 100, 2);
        ?>
        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header"> 博客
                    <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span></div>
                <div class="layui-card-body  ">
                    <p class="layuiadmin-big-font"><?php echo $month_blog_count ?? 0 ?></p>
                    <p>新发布
                        <span class="layuiadmin-span-color">
                            <?php echo $month_blog_count_percent . "%" ?? "0%" ?>
                            <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header"> 博客
                    <span class="layui-badge layui-bg-cyan layuiadmin-badge">年</span></div>
                <div class="layui-card-body  ">
                    <p class="layuiadmin-big-font"><?php echo $year_blog_count ?? 0 ?></p>
                    <p>新发布
                        <span class="layuiadmin-span-color">
                            <?php echo $year_blog_count_percent . "%" ?? "0%" ?>
                            <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header">评论
                    <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span></div>
                <div class="layui-card-body ">
                    <p class="layuiadmin-big-font"><?php echo $month_comment_count ?? 0 ?></p>
                    <p>新评论
                        <span class="layuiadmin-span-color">
                            <?php echo $month_comment_count_percent . "%" ?? "0%" ?>
                            <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header">评论
                    <span class="layui-badge layui-bg-cyan layuiadmin-badge">年</span></div>
                <div class="layui-card-body ">
                    <p class="layuiadmin-big-font"><?php echo $year_comment_count ?? 0 ?></p>
                    <p>新评论
                        <span class="layuiadmin-span-color">
                            <?php echo $year_comment_count_percent . "%" ?? "0%" ?>
                            <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">系统信息</div>
                <div class="layui-card-body ">
                    <table class="layui-table">
                        <tbody>
                        <tr>
                            <th>系统版本</th>
                            <td><?php echo $_VERSION ?? '获取失败' ?></td>
                        </tr>
                        <tr>
                            <th>服务器地址</th>
                            <td><?php echo $_SERVER_ADDRESS ?? '获取失败' ?></td>
                        </tr>
                        <tr>
                            <th>操作系统</th>
                            <td><?php echo $_OS ?? '获取失败' ?></td>
                        </tr>
                        <tr>
                            <th>运行环境</th>
                            <td><?php echo $_RUN_ENV ?? '获取失败' ?></td>
                        </tr>
                        <tr>
                            <th>PHP版本</th>
                            <td><?php echo $_PHP_VERSION ?? '获取失败' ?></td>
                        </tr>
                        <tr>
                            <th>PHP运行方式</th>
                            <td><?php echo $_PHP_RUN_METHOD ?? '获取失败' ?></td>
                        </tr>
                        <tr>
                            <th>MYSQL版本</th>
                            <td><?php echo $_MYSQL_VERSION ?? '获取失败' ?></td>
                        </tr>
                        <tr>
                            <th>存储空间</th>
                            <td id="space"><?php
                                if ($_FREE_SPACE && $_TOTAL_SPACE) {
                                    echo $_FREE_SPACE . 'MB/' . $_TOTAL_SPACE . 'MB';
                                } else {
                                    echo '获取失败';
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <th>运行时间</th>
                            <td id="runtime"><?php echo $_RUN_TIME ?? '获取失败' ?></td>
                        </tr>
                        </tbody>
                        <script>
                            function updateSpaceAndRunTime() {
                                $.ajax({
                                    url: '../handle/updateRunTimeAndSpace.php',
                                    type: 'post',
                                    dataType: 'json',
                                    data: {
                                        action: 'updateRunTimeAndSpace'
                                    },
                                    success: function (res) {
                                        if (res.code === 0) {
                                            $('#space').html(res.free_space + 'MB/' + res.total_space + "MB");
                                            $('#runtime').html(res.run_time);
                                        }
                                    }
                                });
                            }

                            setInterval(updateSpaceAndRunTime, 30000);
                        </script>
                    </table>
                </div>
            </div>
        </div>
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">开发团队</div>
                <div class="layui-card-body ">
                    <table class="layui-table">
                        <tbody>
                        <tr>
                            <th>版权所有</th>
                            <td>VINCENTADAMNEMESSIS
                                <a href="http://vincentadamnemessis.site/" target="_blank">访问官网</a></td>
                        </tr>
                        <tr>
                            <th>开发者</th>
                            <td>VincentAdamNemessis(vincentadamnemessis@gmail.com)</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <style id="welcome_style"></style>
        <div class="layui-col-md12">
            <blockquote class="layui-elem-quote layui-quote-nm" style="text-align: center">
                项目管理：张洁<br/>
                设计支持：白志毅<br/>
                服务支持：王晓雷、李义群<br/>
                技术支持：VincentAdamNemessis【赵铜旭】<br/>
                小组成员：赵铜旭、白志毅、张洁、王晓雷、李义群<br/>
                感谢layui, jquery, 本系统由x-admin提供技术支持。
            </blockquote>
        </div>
    </div>
</div>
</div>
</body>
</html>