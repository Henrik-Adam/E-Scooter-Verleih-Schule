<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../../css/global.css">
  <link rel="stylesheet" href="../../css/nav.css">
  <link rel="stylesheet" href="../../css/modal.css">
  <link rel="stylesheet" href="../../css/account.css">
  <link rel="stylesheet" href="../../css/notifications.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Account</title>
</head>
<?php
require('support_logic.php');
$userId = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
  header("Location: ./login.php");
} else $userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  getReservationData($userId);
}

function getReservationData($userId)
{
  $file = "../../file_save/user-data.json";

  if (array_key_exists("postal-road", $_POST)) {
    $postalRoad = testInput($_POST["postal-road"]);
  }
  if (array_key_exists("postal-nr", $_POST)) {
    $postalNr = testInput($_POST["postal-nr"]);
  }
  if (array_key_exists("city", $_POST)) {
    $city = testInput($_POST["city"]);
  }
  if (empty($city) && empty($postalNr) && empty($postalRoad)) {
    $_SESSION['address_insert_fail'] = false;
  } elseif (strlen($postalRoad) >= 4 && strlen($city) >= 4 && $postalNr >= 1) {
    $_SESSION['address_insert_fail'] = false;
    $userDataArr = ["user_road" => encrypt($postalRoad), "user_postal" => encrypt($postalNr), "user_city" => encrypt($city)];
    updateUser($file, $userId, $userDataArr);
  } else {
    $_SESSION['address_insert_fail'] = true;
  }
}

function getUserOrders($userId)
{
  $fileOrder = "../../file_save/order-data.json";
  $jsonArr = getAllOrderData($fileOrder, $userId);
  $orderDataArr = [];
  if ($jsonArr != 0) {
    foreach ($jsonArr as $orderData) {
      if ($userId == $orderData["user_id"]) {
        $orderDataArr[] = $orderData;
      }
    }
  }
  return $orderDataArr;
}

function createAccountOverview($userId)
{
  $file = "../../file_save/user-data.json";
  $userDataArr = getUserData($file, $userId);
  if (isset($userDataArr)) {
    echo '<p><strong>Name: </strong>' . $userDataArr['user_name'] . '</p>';
    echo '<p><strong>Email: </strong>' . decrypt($userDataArr['user_email']) . '</p>';
    echo '<p><strong>Passwort: </strong>******</p>';
  }
}

function createAddressOverview($userId)
{
  $file = "../../file_save/user-data.json";
  $userDataArr = getUserData($file, $userId);
  if (isset($userDataArr)) {
    if (array_key_exists("user_road", $userDataArr["user_address"])) {
      $roadAndNr = $userDataArr["user_address"]["user_road"];
    } else $roadAndNr = "";
    if (array_key_exists("user_postal", $userDataArr["user_address"])) {
      $postal = decrypt($userDataArr["user_address"]["user_postal"]);
    } else $postal = "";
    if (array_key_exists("user_city", $userDataArr["user_address"])) {
      $city = $userDataArr["user_address"]["user_city"];
    } else $city = "";

    echo '<p><strong>Straße und Hausnummer: </strong>' . decrypt($roadAndNr) . '</p>';
    echo '<p><strong>PLZ: </strong>' . $postal . '</p>';
    echo '<p><strong>Stadt: </strong>' . decrypt($city) . '</p>';
  }
}

function createTable($userId)
{
  $userOrderDataArr = getUserOrders($userId);
  if (isset($userOrderDataArr) && count($userOrderDataArr) > 0) {
    echo '<div class="table-reservation">';
    echo '<table class="reservation"><tr><th>Order</th><th>E-Scooter</th><th>Zeitraum</th><th>Datum</th><th>Status</th></tr>';
    foreach ($userOrderDataArr as $row) {
      echo "<tr><td>" . $row['order_id'] . "</td><td>" . escooterType(decrypt($row['scooter_type'])) . "</td><td>" . convertReversedDate($row['res_start']) . " bis " . convertReversedDate($row['res_end']) . "</td><td>" . $row['time'] . "</td>" . ifTimeEx($row['res_end']) . "</tr>";
    }
    echo "</table>";
    echo "</div>";
  } else {
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
  <div class="account-overview">
    <div class="overview-head-boxes">
      <strong>Kontoinformationen</strong>
    </div>
    <div class="overview-info-box">
      <?php
      createAccountOverview($userId);
      ?>
    </div>
    <div class="overview-head-boxes">
      <strong>Addressbuch</strong>
    </div>
    <div class="overview-info-box">
      <?php
      createAddressOverview($userId);
      ?>
      <button class="button" onclick="document.getElementById('modalForm').style.display='block'" style="width:auto;">Addressen bearbeiten</button>
    </div>
    <div class="overview-head-boxes">
      <strong>Reservierungsübersicht</strong>
    </div>
  </div>
  <?php
  if (isset($_SESSION['order_success']) && $_SESSION['order_success'] === true) {
    echo ("<div class='success' style='margin-bottom: 10px;'>Ihre Bestellung wurde erfolgreich verarbeitet!</div>");
    $_SESSION['order_success'] = false;
  }
  createTable($userId);
  ?>

  <div id="modalForm" class="modal">
    <span onclick="document.getElementById('modalForm').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="container">
        <h1>Addressen Hinzufügen</h1>
        <?php
        if (isset($_SESSION['address_insert_fail'])) {
          if ($_SESSION['address_insert_fail']) {
            echo ("<div class='error'>ERROR: Ihre Angaben waren fehlerhaft bitte probieren sie es erneut!</div>");
            $_SESSION['address_insert_fail'] = false;
          }
        }
        ?>
        <p>Bitte füllen sie alle unten angebenen Felder aus. Die Daten werden bei zukünftigen Reservierungen im Formular voreingestellt.</p>
        <hr>

        <label for="postal-road"><b>Straße und Hausnummer</b></label>
        <input type="text" placeholder="Straße" name="postal-road" required>

        <label for="postal-nr"><b>PLZ</b></label>
        <input type="number" placeholder="Postleitzahl" name="postal-nr" required>

        <label for="city"><b>Stadt</b></label>
        <input type="text" placeholder="Stadt" name="city" required>

        <div class="flex">
          <button type="submit" class="btn">Bestätigen</button>
          <button type="reset" class="btn">Reset</button>
          <button type="button" onclick="document.getElementById('modalForm').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
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
  <script src="./js/modal_forms.js"></script>
</body>

</html>