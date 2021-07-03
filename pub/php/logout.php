<?php
session_start();
$_SESSION = array();
$_SESSION['user_logout'] = true;
header("Location: ../../index.php");