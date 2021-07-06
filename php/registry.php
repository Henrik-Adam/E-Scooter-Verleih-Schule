<?php
session_cache_limiter('private');
session_cache_expire(2);
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/global.css">
  <link rel="stylesheet" href="../css/nav.css">
  <link rel="stylesheet" href="../css/notifications.css">
  <link rel="stylesheet" href="../css/login_system.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrieren</title>
</head>

<body>
<?php

require('support_logic.php');
?>
  <div class="nav-parent">
    <div class="nav">
      <a href="../index.php">Home</a>
      <a href="account.php"><?php echo ($navIf) ?></a>
    </div>
  </div>
  <?php

  $userName = $userEmail = $userPwd = $userConfirmedPwd = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = testInput($_POST["name"]);
    $userEmail = testInput($_POST["email"]);
    $cookieConfirm = testInput(isset($_POST["cookieConfirm"]));
    $userPwd = testInput($_POST["password"]);
    $userConfirmedPwd = testInput($_POST["confirmedPassword"]);
    $adultConform = $_POST["adult_confirm"];
    if (!empty($userName) && strlen($userPwd) >= 6 && strlen($userConfirmedPwd) >= 6 && $userPwd === $userConfirmedPwd && $cookieConfirm === "1" && $adultConform >= 18) {
      userValidation($userName, $userEmail, $userPwd, $cookieConfirm);
    } elseif (strlen($userPwd) <= 5 && strlen($userConfirmedPwd) <= 5) {
      echo ("<div class='warning'>WARNING! Das Passwort ist zu kurz! Bitte wählen Sie ein längeres.</div>");
    } elseif ($userPwd != $userConfirmedPwd) {
      echo ("<div class='error'>ERROR! Die Passwörter sind unterschiedlich! Bitte versuchen Sie es erneut!</div>");
    } elseif ($cookieConfirm != "1") {
      echo ("<div class='warning'>WARNING! The Cookie & AGB checkboxed must be checked for register!</div>");
    } elseif ($adultConform < 18) {
      echo ("<div class='warning'>Warunung! Sie haben noch nicht das passende Alter!</div>");
    } else echo ("<div class='error'>ERROR! Kein gültiger Dateneintrag!</div>");
  } else echo ("<div class='info'>INFO! Bitte melden Sie sich an!</div>");

  function checkIfUserExist($userName)
  {
    $data = file_get_contents("../file_save/user-data.json");
    if (!empty($data)) {
      $jsonArr = json_decode($data, true);
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
      $file = "../file_save/user-data.json";
      $data = file_get_contents($file);
      $jsonArr = json_decode($data, true);
      $userId =  isset($jsonArr) ? count($jsonArr) + 1 : 1;
      $jsonArr[] = ["user_id" => $userId, "user_name" => $userName, "user_email" => encrypt($userEmail), "user_pwd" => $userPwd, "user_crypt" => $cryptKey, "user_cookie_agb" => $cookieConfirm, "user_address" => ["user_road" => "", "user_postal" => "", "user_city" => ""]];
      $jsonStr = json_encode($jsonArr);
      if (strlen($jsonStr) != 0) {
        file_put_contents($file, $jsonStr);
        logReg($userName);
        header("Location: login.php");
      } else {
        echo "<div class='error'>Error: " . json_last_error_msg() . "</div>";
        logging($userName, "../logs/systemlog.txt", json_last_error_msg());
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

  function logReg($userName)
  {
    $date = date("d.m.Y");
    $time = date("h:i:sa");
    $log_file_reg = fopen("../logs/log_reg.txt", "a+");
    $log_msg = "(%s %s): %s\n";
    $log_msg = sprintf($log_msg, $date, $time, $userName);
    fwrite($log_file_reg, $log_msg);
    fclose($log_file_reg);
  }
  ?>
  <div class="user-login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <label for="user_name">Name</label>
      <input type="text" id="user_name" name="name" placeholder="Your Username">
      <label for="user_email">Email</label>
      <input type="email" id="user_email" name="email" placeholder="Your Email">
      <label for="user_pwd">Passwort</label>
      <input type="password" id="user_pwd" name="password" placeholder="Password">
      <label for="user_confirm_pwd">Passwort bestätigen</label>
      <input type="password" id="user_confirm_pwd" name="confirmedPassword" placeholder="Password verify">
      <label for="adult_confirm">Alter</label>
      <input type="number" id="adult_confirm" name="adult_confirm" required>
      <input type="checkbox" id="cookie_confirm" name="cookieConfirm" value="agb">
      <label for="cookie_confirm">AGB & Cookie Confirmation</label>
      <div class='info'>INFO! <a href="agb.php">AGB</a> & <a href="cookie.php">Cookie Information</a> beides muss akzeptiert werden!</div>
      <div class="flex-user-form">
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
        <button class="button"><a href="login.php">Anmeldung</a></button>
      </div>
    </form>
  </div>
  <footer>
    <div class="flex-footer">
      <div>
        <a href="impressum.php">Impressum</a>
<<<<<<< HEAD
        <a href="datenschutz.php">Datenschutz</a>
        <a href="agb.php">AGB</a>
        <a href="support.php">Support</a>
        <a href="logout.php"><?php echo($logoutIf)?></a>
=======
        <a href="#search">Datenschutz</a>
        <a href="#search">AGB</a>
        <a href="#search">Support</a>
        <a href="logout.php"><?php echo ($logoutIf) ?></a>
>>>>>>> c30b83657bd61957acda4f85cdeb1e4740951019
      </div>
    </div>
  </footer>
</body>

</html>