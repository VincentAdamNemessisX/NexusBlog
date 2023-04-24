<?php
session_start();
if (isset($_SESSION['user'])) {
    echo "<script>location.href= 'views/index.php';</script>";
} else {
    echo "<script>location.href= 'views/login.html';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
</body>
</html>