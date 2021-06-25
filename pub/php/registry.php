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
    userValidation($conn, $userName, $userPwd, $cookieConfirm);
  } elseif(strlen($userPwd) <= 5 && strlen($userConfirmedPwd) <= 5) {
    echo("<div class='warning'>WARNING! The passwords are to short to be secure. Please use a longer password.</div>");
  } elseif($userPwd != $userConfirmedPwd) {
    echo("<div class='error'>ERROR! The passwords are different. Please re-enter</div>");
  } elseif($cookieConfirm != "1") {
    echo("<div class='warning'>WARNING! The Cookie & AGB checkboxed must be checked for register!</div>");
  } else echo("<div class='error'>ERROR! No valid Data Input!</div>");
} else echo("<div class='info'>INFO! Please Sign up!</div>");

function checkIfUserExist($conn, $userName) {
  $sqlUser = "SELECT user_name FROM db_user_reg WHERE user_name= '%s'";
  $sqlUser = sprintf($sqlUser, $conn->real_escape_string($userName));
  $resultUser = $conn->query($sqlUser);
  $userArray = $resultUser->fetch_assoc();
  if(empty($userArray)) {
    return true;
  } else {
    return false; 
  }
}

function userValidation($conn, $userName, $userPwd, $cookieConfirm) {
  if(checkIfUserExist($conn, $userName)) {
    $cryptKey = generateCryptKey($userPwd);
    $userPwd = password_hash($userPwd, PASSWORD_BCRYPT);
    //$currentTimestamp = date("j-n-Y H:i:s");
    $stmt = $conn->prepare("INSERT INTO db_user_reg (user_name, user_pwd, user_crypt, user_cookie_agb, user_time_create) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $userName, $userPwd, $cryptKey, $cookieConfirm, $currentTimestamp);
    if ($stmt->execute() === TRUE) {
      setUserSession($conn, $userName, $cryptKey);
      logReg($userName);
      header("Location: http://localhost/pwd_overview.php");
    } else {
      echo "<div class='error'>Error: " . $stmt . "</div><br>" . $conn->error;
      logRegFail($userName, $stmt, $conn->error);
    }
  } else {
    echo "<div class='error'>User already exist!</div>";
  }
}

function setUserSession($conn, $userName, $cryptKey) {
  $sqlUser = "SELECT user_id FROM db_user_reg WHERE user_name= '%s'";
  $sqlUser = sprintf($sqlUser, $conn->real_escape_string($userName));
  $resultUser = $conn->query($sqlUser);
  $userArray = $resultUser->fetch_assoc();
  $userId = $userArray["user_id"];
  $_SESSION['user_name'] = $userName;
  $_SESSION['user_id'] = $userId;
  $_SESSION['crypt_key'] = $cryptKey;
  $_SESSION['welcome_id'] = 3;
}

function generateCryptKey($userPwd) {
  $randBytesSalt = random_bytes(64) . $userPwd;
  $hash = hash("sha3-512", $randBytesSalt);
  $cryptKey = base64_encode($hash);
  return $cryptKey;
}

function logRegFail($userName, $sqlInsert, $error) {
  $date = date("d.m.Y");
  $time = date("h:i:sa");
  $log_file_reg = fopen("logs/log_reg_fail.txt", "a+");
  $log_msg = "User: %s,Date: %s,Time: %s, %s, %s\n";
  $log_msg = sprintf($log_msg,$userName, $date, $time, $sqlInsert, $error);
  fwrite($log_file_reg, $log_msg);
  fclose($log_file_reg);
}

function logReg($userName) {
  $date = date("d.m.Y");
  $time = date("h:i:sa");
  $log_file_reg = fopen("logs/log_reg.txt", "a+");
  $log_msg = "User: %s,Date: %s,Time: %s\n";
  $log_msg = sprintf($log_msg,$userName, $date, $time);
  fwrite($log_file_reg, $log_msg);
  fclose($log_file_reg);
}
?>

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

</body>
</html>