<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="/css/global.css">
  <link rel="stylesheet" href="/css/nav.css">
  <link rel="stylesheet" href="/css/account.css">
  <link rel="stylesheet" href="/css/notifications.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Account</title>
</head>
<?php
require('support_logic.php');

if (!isset($_SESSION['user_id'])) {
  header("Location: http://localhost/pub/php/login.php");
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

function createTable($userId)
{
  $userOrderDataArr = getUserOrders($userId);
  if(count($userOrderDataArr) > 0) {
    echo '<div class="table-reservation">';
    echo '<table class="reservation"><tr><th>Order</th><th>E-Scooter</th><th>Zeitraum</th><th>Datum</th><th>Status</th></tr>';
    foreach($userOrderDataArr as $row) {
      echo "<tr><td>".$row['order_id']."</td><td>". $row['scooter_type']."</td><td>". $row['res_start']. " bis ". $row['res_end']."</td><td>". $row['time'] ."</td>". ifTimeEx($row['res_start'], $row['res_end']) ."</tr>";
    }
    echo "</table>";
    echo "</div>";
  }
}
?>

<body>
  <div class="nav-parent">
    <div class="nav">
      <a href="../../index.php">Home</a>
      <a href="/pub/php/account.php" class="active">Account</a>
    </div>
  </div>
  <?php
    createTable($userId);
  ?>

  <footer>
    <div class="flex-footer">
      <div>
        <a href="#search">Impressum</a>
        <a href="#search">Datenschutz</a>
        <a href="#search">AGB</a>
        <a href="#search">Support</a>
        <a href="/pub/php/logout.php">Logout</a>
      </div>
    </div>
  </footer>

</body>

</html>