<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../../css/global.css">
  <link rel="stylesheet" href="../../css/nav.css">
  <link rel="stylesheet" href="../../css/account.css">
  <link rel="stylesheet" href="../../css/notifications.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Account</title>
</head>
<?php
require('support_logic.php');

if (!isset($_SESSION['user_id'])) {
  header("Location: ./login.php");
}

$userId = $_SESSION['user_id'];

function getUserOrders($userId)
{
  $fileOrder = "../../file_save/order-data.json";
  $jsonArr = getAllOrderData($fileOrder, $userId);
  foreach ($jsonArr as $orderData) {
    if($userId == $orderData["user_id"]) {
      $orderDataArr[] = $orderData;
    }
  }
  return $orderDataArr;
}

function getUserAddress($userId)
{
  $fileUser = "../../file_save/user-data.json";
  $jsonArr = getUserData($fileUser, $userId); // Hier wenn notwendig andere Funktion aufrufen für Adresse
    
  return $jsonArr;
}

function createAddressOverview($userId)
{
  $userData = getUserAddress($userId);
  if(isset($userData)) {
    echo '<br><br><br>';
    echo '<div class="user-address">';
    echo '<h3 class="large-font" style="margin-top: 0px;">Ihre Rechnungsadresse:</h3>';
    echo '<p>Hier Name</p>';           
    echo '<p>Hier Stra&szlige und Hausnummer</p>';  // &szlig ist ß          
    echo '<p>Hier PLZ und Ort</p>';            
    echo '<p>Hier evtl Telefonnr. und/oder Email</p>';   
    echo '</div>';
  }
}

function createTable($userId)
{
  $userOrderDataArr = getUserOrders($userId);
  if(isset($userOrderDataArr) && count($userOrderDataArr) > 0) {
    echo '<div class="table-reservation">';
    echo '<table class="reservation"><tr><th>Order</th><th>E-Scooter</th><th>Zeitraum</th><th>Datum</th><th>Status</th></tr>';
    foreach($userOrderDataArr as $row) {
      echo "<tr><td>".$row['order_id']."</td><td>". escooterType($row['scooter_type'])."</td><td>". convertReversedDate($row['res_start']). " bis ". convertReversedDate($row['res_end'])."</td><td>". $row['time'] ."</td>". ifTimeEx($row['res_start'], $row['res_end']) ."</tr>";
    }
    echo "</table>";
    echo "</div>";
  }
  else {
    echo '<div class="table-reservation">';
    echo '<table class="reservation"><tr><th>Order</th><th>E-Scooter</th><th>Zeitraum</th><th>Datum</th><th>Status</th></tr>';

    echo "<tr><td>Sie haben noch keine Reservierungen!</td>";
    
    echo "</table>";
    echo "</div>";
  }
}
?>

<body>
  <div class="nav-parent">
    <div class="nav">
      <a href="../../index.php">Home</a>
      <a href="./account.php" class="active">Account</a>
    </div>
  </div>
  <?php
    createAddressOverview($userId);
    createTable($userId);
  ?>

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