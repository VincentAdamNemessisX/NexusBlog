<?php
header("Content-type:text/html;charset=utf-8");
include_once "../../database/databaseHandle.php";
function uploadFile()
{
    if (!file_exists('../../uploadFiles/BlogImages')) {
        mkdir('../../uploadFiles/BlogImages', 0777);
    }
    $MyFilePath = "../uploadFiles/BlogImages/";
    $Extensions = array("jpeg", "jpg", "png", "pdf");
    $MaxFileSize = 50;
    date_default_timezone_set("PRC");
    $Time = date("Y-m-d-H-i-s");
    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $name_arr = explode('.', $_FILES['image']['name']);
        $file_ext = strtolower(end($name_arr));

        if (in_array($file_ext, $Extensions) === false) {
            echo "400ExeErr";
            return false;
        }

        if ($file_size > ($MaxFileSize * 1024 * 1024)) {
            echo "400FileSizeErr";
            return false;
        }
        if (in_array($file_ext, $Extensions) === true && $file_size < ($MaxFileSize * 1024 * 1024)) {
            $NewFileName = $Time . "." . $file_ext;
            $AllFilePath = $MyFilePath . $NewFileName;
            move_uploaded_file($file_tmp, $AllFilePath);
            return $AllFilePath;
        }
    }
    return false;
}

if ($_POST['action'] == 'upload') {
    $imagesurl = uploadFile();
    if ($imagesurl) {
        $result_image = insertData('blogimages', "", "",
            ["blogid" => -1, "imagesurl" => "'" . $imagesurl . "'"]);
        if ($result_image) {
            echo "success";
        } else {
            unlink($imagesurl);
            echo "fail";
        }
    } else {
        unlink($imagesurl);
        echo "fail";
    }
}
