<?php
session_start();
$_SESSION['tabtitle'] = 'NexusBlog';
if (isset($_SESSION['user'])) {
    echo "<script>location.href= 'views/index.php';</script>";
} else {
    echo "<script>location.href= 'views/login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NexusBlog</title>
</head>
<body>
</body>
</html>