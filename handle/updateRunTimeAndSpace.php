<?php
$action = $_POST['action'];
if ($action == "updateRunTimeAndSpace") {
    $_TOTAL_SPACE = round(disk_total_space('/') / 1024 / 1024, 2);
    $_FREE_SPACE = round(disk_free_space('/') / 1024 / 1024, 2);
    $_RUN_TIME = explode(' ', strstr(exec('uptime'), ',', true))[4];
    $_RUN_TIME = explode(':', $_RUN_TIME);
    $_RUN_TIME[0] = $_RUN_TIME[0] . '小时';
    $_RUN_TIME[1] = $_RUN_TIME[1] . '分钟';
    $_RUN_TIME = implode('', $_RUN_TIME);
    header("Content-Type: text/json");
    echo json_encode(array("total_space" => $_TOTAL_SPACE, "free_space" => $_FREE_SPACE, "run_time" => $_RUN_TIME, 'code' => 0));
}
