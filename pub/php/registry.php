<?php
session_cache_limiter('private');
session_cache_expire(2);
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../../css/global.css">
  <link rel="stylesheet" href="../../css/nav.css">
  <link rel="stylesheet" href="../../css/notifications.css">
  <link rel="stylesheet" href="../../css/login_system.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Registrieren</title>
</head>

<body>

  <?php

  require('support_logic.php');

  $userName = $userEmail = $userPwd = $userConfirmedPwd = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = testInput($_POST["name"]);
    $userEmail = testInput($_POST["email"]);
    $cookieConfirm = testInput(isset($_POST["cookieConfirm"]));
    $userPwd = testInput($_POST["password"]);
    $userConfirmedPwd = testInput($_POST["confirmedPassword"]);
    if (!empty($userName) && strlen($userPwd) >= 6 && strlen($userConfirmedPwd) >= 6 && $userPwd === $userConfirmedPwd && $cookieConfirm === "1") {
      userValidation($userName, $userEmail, $userPwd, $cookieConfirm);
    } elseif (strlen($userPwd) <= 5 && strlen($userConfirmedPwd) <= 5) {
      echo ("<div class='warning'>WARNING! The passwords are to short to be secure. Please use a longer password.</div>");
    } elseif ($userPwd != $userConfirmedPwd) {
      echo ("<div class='error'>ERROR! The passwords are different. Please re-enter</div>");
    } elseif ($cookieConfirm != "1") {
      echo ("<div class='warning'>WARNING! The Cookie & AGB checkboxed must be checked for register!</div>");
    } else echo ("<div class='error'>ERROR! No valid Data Input!</div>");
  } else echo ("<div class='info'>INFO! Please Sign up!</div>");

  function checkIfUserExist($userName)
  {
    $data = file_get_contents("../../file_save/user-data.json");
    if (!empty($data)) {
      $jsonArr = json_decode($data, true);
      $userName = preg_replace('/[^A-Za-z0-9\_]/', '', $userName);
      foreach ($jsonArr as $outArr) {
        if ($userName == $outArr["user_name"]) {
          return true;
        }
      }
    } else {
      return false;
    }
  }

  function userValidation($userName, $userEmail, $userPwd, $cookieConfirm)
  {
    if (!checkIfUserExist($userName)) {
      $cryptKey = generateCryptKey($userPwd);
      $_SESSION['user_crypt'] = $cryptKey;
      $userPwd = password_hash($userPwd, PASSWORD_BCRYPT);
      $file = "../../file_save/user-data.json";
      $data = file_get_contents($file);
      $userName = preg_replace('/[^A-Za-z0-9\_]/', '', $userName);
      $jsonArr = json_decode($data, true);
      $userId =  isset($jsonArr) ? count($jsonArr) + 1 : 1;
      $jsonArr[] = ["user_id" => $userId, "user_name" => $userName, "user_email" => encrypt($userEmail), "user_pwd" => $userPwd, "user_crypt" => $cryptKey, "user_cookie_agb" => $cookieConfirm, "user_address" => ["user_road" => "", "user_postal" => "", "user_city" => ""]];
      $jsonStr = json_encode($jsonArr);
      if (strlen($jsonStr) != 0) {
        file_put_contents($file, $jsonStr);
        logReg($userName);
        header("Location: ./login.php");
      } else {
        echo "<div class='error'>Error: " . json_last_error_msg() . "</div>";
        logRegFail($userName, json_last_error_msg());
      }
    } else {
      echo "<div class='error'>User already exist!</div>";
    }
  }

  function generateCryptKey($userPwd)
  {
    $randBytesSalt = random_bytes(64) . $userPwd;
    $hash = hash("sha3-512", $randBytesSalt);
    $cryptKey = base64_encode($hash);
    return $cryptKey;
  }

  function logRegFail($userName, $error)
  {
    $date = date("d.m.Y");
    $time = date("h:i:sa");
    $log_file_reg = fopen("../../logs/log_reg_fail.txt", "a+");
    $log_msg = "User: %s,Date: %s,Time: %s,  %s\n";
    $log_msg = sprintf($log_msg, $userName, $date, $time, $error);
    fwrite($log_file_reg, $log_msg);
    fclose($log_file_reg);
  }

  function logReg($userName)
  {
    $date = date("d.m.Y");
    $time = date("h:i:sa");
    $log_file_reg = fopen("../../logs/log_reg.txt", "a+");
    $log_msg = "User: %s,Date: %s,Time: %s\n";
    $log_msg = sprintf($log_msg, $userName, $date, $time);
    fwrite($log_file_reg, $log_msg);
    fclose($log_file_reg);
  }
  ?>
  <div class="nav-parent">
    <div class="nav">
      <a href="../../index.php">Home</a>
      <a href="./account.php">Account</a>
    </div>
  </div>

  <div class="user-login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <label for="user_name">Name</label>
      <input type="text" id="user_name" name="name" placeholder="Your Username">
      <label for="user_email">Email</label>
      <input type="email" id="user_email" name="email" placeholder="Your Email">
      <label for="user_pwd">Password</label>
      <input type="password" id="user_pwd" name="password" placeholder="Password">
      <label for="user_confirm_pwd">Password verify</label>
      <input type="password" id="user_confirm_pwd" name="confirmedPassword" placeholder="Password verify">
      <input type="checkbox" id="cookie_confirm" name="cookieConfirm" value="agb">
      <label for="cookie_confirm">AGB & Cookie Confirmation</label>
      <div class='info'>INFO! <a href="agb.php">AGB</a> & <a href="cookie.php">Cookie Information</a> beides muss akzeptiert werden!</div>
      <div class="flex-user-form">
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
        <button class="button"><a href="./login.php">Anmeldung</a></button>
      </div>
    </form>
  </div>
  <footer>
    <div class="flex-footer">
      <div>
        <a href="#search">Impressum</a>
        <a href="#search">Datenschutz</a>
        <a href="#search">AGB</a>
        <a href="#search">Support</a>
        <a href="./logout.php">Logout</a>
      </div>
    </div>
  </footer>
</body>

</html>