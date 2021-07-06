<?php
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
  <title>Login</title>
</head>

<body>

  <?php
  error_reporting(0);
  require('support_logic.php');

  $userName = $userPwd = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = testInput($_POST["name"]);
    $userPwd = testInput($_POST["password"]);
    $cookieConfirm = testInput(isset($_POST["cookieConfirm"]));
    if (!empty($userName) && strlen($userPwd) >= 5 && $cookieConfirm === "1") {
      userValidation($userName, $userPwd);
    } elseif (empty($userName) && empty($userPwd)) {
      echo ("<div class='info'>INFO! Bitte Anmelden!</div>");
    } elseif ($cookieConfirm != "1") {
      echo ("<div class='warning'>WARNING! The Cookie & AGB checkboxed must be checked for register!</div>");
    } else echo ("<div class='error'>ERROR! Keine gültige Dateneingabe!</div>");
  } else echo ("<div class='info'>INFO! Bitte Anmelden!</div>");

  function userValidation($userName, $userPwd)
  {
    $file = "../file_save/user-data.json";
    $data = file_get_contents($file);
    $jsonArr = json_decode($data, true);
    if (!empty($jsonArr)) {
      foreach ($jsonArr as $outArr) {
        if ($userName == $outArr["user_name"]) {
          $userData = $outArr;
        }
      }
    }
    if (isset($userData)) {
      $userId = $userData["user_id"];
      $hash = $userData["user_pwd"];
      $userCrypt = $userData["user_crypt"];
    }

    if (isset($hash) && password_verify($userPwd, $hash)) {
      setUserSession($userName, $userId, $userCrypt);
      logLogin($userName);
      header("Location: ../index.php");
    } else {
      echo "<div class='warning'>WARNING! Username or password are incorrect. Or you don't have an account yet, please create one!</div>";
    }
  }

  function setUserSession($userName, $userId, $userCrypt)
  {
    $_SESSION['user_name'] = $userName;
    $_SESSION['user_id'] = $userId;
    $_SESSION['user_crypt'] = $userCrypt;
    $_SESSION['welcome_id'] = true;
    $_SESSION['not_login'] = false;
  }

  function logLogin($userName)
  {
    $date = date("d.m.Y");
    $time = date("h:i:sa");
    $file = fopen("../logs/log_login.txt", "a+");
    $log_msg = "(%s %s): %s\n";
    $log_msg = sprintf($log_msg, $date, $time, $userName);
    fwrite($file, $log_msg);
    fclose($file);
  }
  ?>
  <div class="nav-parent" style="position: relative">
    <div class="nav">
      <a href="../index.php">Home</a>
      <a href="account.php"><?php echo ($navIf) ?></a>
    </div>
  </div>
  <div class="user-login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <label for="user_name">Name</label>
      <input type="text" id="user_name" name="name" placeholder="Your username">
      <label for="user_pwd">Password</label>
      <input type="password" id="user_pwd" name="password" placeholder="Your password">
      <input type="checkbox" id="cookie_confirm" name="cookieConfirm" value="agb">
      <label for="cookie_confirm">AGB & Cookie Bestätigung</label>
      <div class='info'>INFO! <a href="agb.php">AGB</a> & <a href="cookie.php">Cookie Informationen</a> beide
        müssen akzeptiert werden um den vollen umfang unserer Dienste verwenden zu können. Wir Informieren sie
        bei Änderungen!</div>
      <div class="flex-user-form">
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
        <button><a href="registry.php">Zur Registrierung</a></button>
      </div>
    </form>
  </div>
  <footer style="position: fixed">
    <div class="flex-footer">
      <div>
        <a href="impressum.php">Impressum</a>
        <a href="#search">Datenschutz</a>
        <a href="#search">AGB</a>
        <a href="#search">Support</a>
        <a href="logout.php"><?php echo ($logoutIf) ?></a>
      </div>
    </div>
  </footer>
</body>

</html>