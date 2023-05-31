<?php
    require_once '../../database/databaseHandle.php';
    $action = $_POST['action'] ?? "";
    if($action == "delete") {
        $id = $_POST['id'];
        $result = removeData('blogtype', "blogtypeid = $id")
            || removeData('blog', "blogtypeid = $id") ||
            removeData('comment',
                "blogid in (select blogid from blog, 
                blogtype where blog.type = blogtype.name 
                and blogtypeid = $id)") || removeData('comment',
                "parentid not in (select commentid from comment)");
        if($result) {
            echo "success";
        } else {
            echo "fail";
        }
    }
    if($action == "add") {
        $result = insertData('blogtype', "", "",
            ['name' => "'" . $_POST['name'] . "'", 'showstyle' => $_POST['showstyle']]);
        if($result) {
            echo "success";
        } else {
            echo "fail";
        }
    }
    if($action == "edit") {
        $result = updateData('blogtype', "blogtypeid = " . $_POST['id'],
            ['showstyle' => $_POST['showstyle']]);
        if($result) {
            echo "success";
        } else {
            echo "fail";
        }
    }