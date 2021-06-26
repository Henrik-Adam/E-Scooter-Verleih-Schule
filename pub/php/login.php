<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/nav.css">
    <link rel="stylesheet" href="/css/notifications.css">
    <link rel="stylesheet" href="/css/login_system.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Login</title>
</head>
<body>

<?php

require('support_logic.php');

$userName = $userPwd = "";

if(array_key_exists("user_id", $_SESSION) && array_key_exists("welcome_id", $_SESSION)) {
  $userId = $_SESSION["user_id"];
  $welcomeId = $_SESSION["welcome_id"];
  if($userId >= 1 || $welcomeId === 1) {
    unset($_SESSION["welcome_id"]);
    unset($_SESSION["user_id"]);
    echo("<div class='success'>SUCCESS! You have successfully logged out. </div>");
  }
} elseif($_SERVER["REQUEST_METHOD"] == "POST") {
  $userName = testInput($_POST["name"]);
  $userPwd = testInput($_POST["password"]);
  $cookieConfirm = testInput(isset($_POST["cookieConfirm"]));
  if (!empty($userName) && strlen($userPwd) >= 5 && $cookieConfirm === "1") {
    userValidation($conn, $userName, $userPwd);
  } elseif(empty($userName) && empty($userPwd)) {
    echo("<div class='info'>INFO! Please Sign in!</div>");
  } elseif($cookieConfirm != "1") {
    echo("<div class='warning'>WARNING! The Cookie & AGB checkboxed must be checked for register!</div>");
  } else echo("<div class='error'>ERROR! No valid Data Input!</div>");
} else echo("<div class='info'>INFO! Please Sign in!</div>");

function setUserSession($userName, $userId, $userCrypt) {
  $_SESSION['user_name'] = $userName;
  $_SESSION['user_id'] = $userId;
  $_SESSION['user_crypt'] = $userCrypt;
  $_SESSION['welcome_id'] = 2;
}

function logLogin($userName) {
  $date = date("d.m.Y");
  $time = date("h:i:sa");
  $log_file_login = fopen("logs/log_login.txt", "a+");
  $log_msg = "User: %s,Date: %s,Time: %s\n";
  $log_msg = sprintf($log_msg,$userName, $date, $time);
  fwrite($log_file_login, $log_msg);
  fclose($log_file_login);
}
?>
    <div class="nav-parent">
        <div class="nav">
            <a href="../../index.php">Home</a>
            <a href="/pub/php/account.php">Account</a>
        </div>
    </div>
    <div class="user-login-form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <label for="user_name">Name</label>
            <input type="text" id="user_name" name="name" placeholder="Your username">
            <label for="user_pwd">Password</label>
            <input type="password" id="user_pwd" name="password" placeholder="Your password">
            <input type="checkbox" id="cookie_confirm" name="cookieConfirm" value="agb">
            <label for="cookie_confirm">AGB & Cookie Bestätigung</label>
            <div class='info'>INFO! <a href="agb.php">AGB</a> & <a href="cookie.php">Cookie Informationen</a> beide müssen akzeptiert werden um den vollen umfang unserer Dienste verwenden zu können. Wir Informieren sie bei Änderungen!</div>
            <div class="flex-user-form">
              <input type="submit" value="Submit">
              <input type="reset" value="Reset">
              <button><a href="registry.php">Zur Registrierung</a></button>
            </div>
        </form>
    </div>
    <footer>
        <div>
            <a href="#search">Impressum</a>
            <a href="#search">Datenschutz</a>
            <a href="#search">AGB</a>
            <a href="#search">Support</a>
            <a href="#search">Logout</a>
        </div>
    </footer>
</body>
</html>