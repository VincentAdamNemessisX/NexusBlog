<?php
    include_once '../database/databaseHandle.php';
    $username = $_POST['username'];
    if (mysqli_fetch_array(queryData('accounts', 'username', "username = \"$username\""))) {
        echo "failed";
    } else {
        echo "success";
    }