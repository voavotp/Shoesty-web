<?php
session_start();
session_unset();
session_destroy();
header("Location: ../shoesty/login.php");
exit;
?>