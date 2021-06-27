<?php
session_start();
$_SESSION["welcome_id"] = 1;
$_SESSION["user_Id"] = 0;

echo $_SESSION["user_Id"];
header("Location: ../../index.php");