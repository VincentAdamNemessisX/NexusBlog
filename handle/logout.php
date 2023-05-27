<?php
    session_start();
    unset($_SESSION['user']);
    if(!$_SESSION['user']) {
        echo "success";
    } else {
        echo "fail";
    }
