<?
setcookie("username", $username, time() - (60 * 60 * 2), "/", "", 0, 0);
setcookie("email", $email, time() - (60 * 60 * 2), "/", "", 0, 0);
header("Location: index.php");