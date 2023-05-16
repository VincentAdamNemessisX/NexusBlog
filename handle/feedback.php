<?php
require_once '../database/databaseHandle.php';
$user = $_POST['name']; $email = $_POST['email'];
$message = $_POST['message'];
if ($user != '' && $email != '' && $message != '') {
    $data = [
        'user' => "'" . $user. "'",
        'email' => "'" .$email. "'",
        'message' => "'" .$message. "'"
    ];
    $result = insertData('feedback', '', '', $data);
    if ($result) {
        echo "success";
    } else {
        echo "failed";
    }
} else {
    echo "failed";
}
