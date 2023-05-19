<?php
    session_start();
    $_SESSION['tabtitle'] = 'NexusBlog';
    echo "<script>location.href= 'views/index.php';</script>";
?>