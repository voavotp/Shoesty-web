<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
// if there is a session created a cookie is make for 2000 seconds
if (isset($_SESSION['username'])) {
    setcookie("username", $_SESSION['username'], time() + 2000, "/", "", true, true);
}
?>
