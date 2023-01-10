<?php
session_start();
unset($_SESSION['id']);
header("location:friendslogin.php");
setcookie('id', $user['id'], time() - (86400 * 30), "/"); // 86400 = 1 day
?>