<?php
    include_once "../database/databaseHandle.php";
    $username = $_POST['username'];
    if ($username) {
        if($record = mysqli_fetch_array(queryData('accounts', 'headPortrait', "username = '$username'"))) {
            echo $record['headPortrait'];
        } else {
            echo "failed";
        }
    }