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
    <title>Registrieren</title>
</head>
<body>

<?php

require('support_logic.php');

$userName = $userPwd = $userConfirmedPwd = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $userName = testInput($_POST["name"]);
  $cookieConfirm = testInput(isset($_POST["cookieConfirm"]));
  $userPwd = testInput($_POST["password"]);
  $userConfirmedPwd = testInput($_POST["confirmedPassword"]);
  if (!empty($userName) && strlen($userPwd) >= 6 && strlen($userConfirmedPwd) >= 6 && $userPwd === $userConfirmedPwd && $cookieConfirm === "1") {
    userValidation($userName, $userPwd, $cookieConfirm);
  } elseif(strlen($userPwd) <= 5 && strlen($userConfirmedPwd) <= 5) {
    echo("<div class='warning'>WARNING! The passwords are to short to be secure. Please use a longer password.</div>");
  } elseif($userPwd != $userConfirmedPwd) {
    echo("<div class='error'>ERROR! The passwords are different. Please re-enter</div>");
  } elseif($cookieConfirm != "1") {
    echo("<div class='warning'>WARNING! The Cookie & AGB checkboxed must be checked for register!</div>");
  } else echo("<div class='error'>ERROR! No valid Data Input!</div>");
} else echo("<div class='info'>INFO! Please Sign up!</div>");

function checkIfUserExist($userName) {
  $file = fopen("../../file_save/user-data.json", "r");
  $file = fread($file, filesize($file));
  if(!empty($file)) {
    $jsonArr = json_decode($file, true);
  }
  $userName = preg_replace('/[^A-Za-z0-9\_]/', '', $userName);
  if(!empty($jsonArr)) {
    foreach($jsonArr as $outArr) {
      if(in_array($userName, $outArr["userName"])) {
        fclose($file);
        return false;
      } else {
        fclose($file);
        return true;
      }
    }
  } else { 
      fclose($file);
      return true;
  }
}

function userValidation($userName, $userPwd, $cookieConfirm) {
  if(checkIfUserExist($userName)) {
    $cryptKey = generateCryptKey($userPwd);
    $userPwd = password_hash($userPwd, PASSWORD_BCRYPT);
    $file = fopen("../../file_save/user-data.json", "a+");
    $userName = preg_replace('/[^A-Za-z0-9\_]/', '', $userName);
    $userId = 1;
    $userData = ["name" => $userName, "user_pwd" => $userPwd, "user_crypt" => $cryptKey, "user_cookie_agb" => $cookieConfirm, "userId" => $userId];
    $jsonStr = json_encode($userData);
    if (strlen($jsonStr) == 0) {
      $_SESSION['welcome_id'] = 3;
      fwrite($file, $jsonStr);
      fclose($file);
      logReg($userName);
      header("Location: http://localhost/pub/php/login.php");
    } else {
      echo "<div class='error'>Error: " . $userData . "</div><br>" . json_last_error_msg();
      logRegFail($userName, $userData, json_last_error_msg());
    }
  } else {
    echo "<div class='error'>User already exist!</div>";
  }
}

function generateCryptKey($userPwd) {
  $randBytesSalt = random_bytes(64) . $userPwd;
  $hash = hash("sha3-512", $randBytesSalt);
  $cryptKey = base64_encode($hash);
  return $cryptKey;
}

function logRegFail($userName, $data, $error) {
  $date = date("d.m.Y");
  $time = date("h:i:sa");
  $log_file_reg = fopen("../../logs/log_reg_fail.txt", "a+");
  $log_msg = "User: %s,Date: %s,Time: %s, %s, %s\n";
  $log_msg = sprintf($log_msg,$userName, $date, $time, $data, $error);
  fwrite($log_file_reg, $log_msg);
  fclose($log_file_reg);
}

function logReg($userName) {
  $date = date("d.m.Y");
  $time = date("h:i:sa");
  $log_file_reg = fopen("../../logs/log_reg.txt", "a+");
  $log_msg = "User: %s,Date: %s,Time: %s\n";
  $log_msg = sprintf($log_msg,$userName, $date, $time);
  fwrite($log_file_reg, $log_msg);
  fclose($log_file_reg);
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
            <input type="text" id="user_name" name="name" placeholder="Your Username">
            <label for="user_pwd">Password</label>
            <input type="password" id="user_pwd" name="password" placeholder="Password">
            <label for="user_confirm_pwd">Password verify</label>
            <input type="password" id="user_confirm_pwd" name="confirmedPassword" placeholder="Password verify">
            <input type="checkbox" id="cookie_confirm" name="cookieConfirm" value="agb">
            <label for="cookie_confirm">AGB & Cookie Confirmation</label>
            <div class='info'>INFO! <a href="agb.php">AGB</a> & <a href="cookie.php">Cookie Information</a> both have to be accepted in order to use our service.</div>
            <div class="flex-user-form">
              <input type="submit" value="Submit">
              <input type="reset" value="Reset">
              <button><a href="index.php">Sign In</a></button>
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