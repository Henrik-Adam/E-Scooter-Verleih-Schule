<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./css/main_page.css">
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/modal.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/notifications.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Home</title>
</head>
<?php

require('./pub/php/support_logic.php');

$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    getReservationData($userId);
}

function getReservationData($userId)
{
    $fileOrder = "./file_save/order-data.json";

    if (array_key_exists("name", $_POST)) {
        $name = testInput($_POST["name"]);
    }
    if (array_key_exists("email", $_POST)) {
        $email = testInput($_POST["email"]);
    }
    if (array_key_exists("postal-road", $_POST)) {
        $postalRoad = testInput($_POST["postal-road"]);
    }
    if (array_key_exists("postal-nr", $_POST)) {
        $postalNr = testInput($_POST["postal-nr"]);
    }
    if (array_key_exists("city", $_POST)) {
        $city = testInput($_POST["city"]);
    }
    if (array_key_exists("s-type", $_POST)) {
        $sType = testInput($_POST["s-type"]);
    }
    if (array_key_exists("res-day-start", $_POST)) {
        $resStart = testInput($_POST["res-day-start"]);
    }
    if (array_key_exists("res-day-end", $_POST)) {
        $resEnd = testInput($_POST["res-day-end"]);
    }
    if (strlen($name) >= 3 && strlen($email) >= 3 && strlen($postalRoad) >= 4 && strlen($city) >= 4 && $postalNr >= 1) {
        $orderId = getOrderId($fileOrder);
        $time = date("d.m.Y");
        $_SESSION['order_fail'] = false;
        $resDataArr = ["order_id" => $orderId, "name" => encrypt($name), "email" => $email, "postal_road" => $postalRoad, "postal_nr" => $postalNr, "city" => $city, "scooter_type" => $sType, "res_start" => $resStart, "res_end" => $resEnd, "user_id" => $userId, "time" => $time];
        setOrderDataInJson($fileOrder, $resDataArr);
    } else {
        $_SESSION['order_fail'] = true;
    }
}
?>

<body>
    <noscript><div class='error'>ERROR: Dein Browser Untersützt kein Javascript! Aktiviere Javascript um alle Funktionen nutzten zu können!</div></noscript>
    <div class="nav-parent">
        <div class="nav">
            <a href="index.php" class="active">Home</a>
            <a href="./pub/php/account.php">Account</a>
        </div>
    </div>
    <div class="info_container" style="background-color:#f1f1f1">
        <div class="info_item">
            <div class="info_item_small">
                <img src="./img/pics/escooterrunner.jpg" width="600" height="600">
            </div>
            <div class="info_item_big">
                <h1 class="xlarge-font" style='margin-top: 0px;'><b>Freedom</b></h1>
                <p>Elektroroller sind populär und haben sich gut in unserem Straßenbild etabliert: <b>RISEE</b> hat die beliebten Elektroroller aus useren Innenstädlichen Büro jetzt auch als Online-Vermietung zugänglich gemacht, denn aktuell ist der Bedarf
                    an Individualmobilität so hoch wie nie (was sich zum Beispiel auch am steigenden Verkauf von Fahrrädern ablesen lässt). E-Tretroller erfüllen besonders die Nachfrage nach Sicherheit und Hygiene (im Gegensatz zum ÖPNV).</p>
                <p>Wenn Sie einen E-Roller mieten, sind Sie also individuell mobil und müssen sich keine Sorgen machen, hygienische Risiken einzugehen oder Abstandsregeln nicht einhalten zu können.</p>
                <p>Gerne können sie uns auch in unserer Filiale besuchen und dort ohne Reservierung einen Scooter mieten.</p>
                <button class="button">Read More</button>
            </div>
        </div>
    </div>
    <?php if ($_SESSION['order_fail']) {
        echo ("<div class='error'>ERROR: Ihre Angaben waren fehlerhaft bitte probieren sie es erneut!</div>");
    } ?>
    <div class="info_container">
        <div class="info_item">
            <div class="info_item_big">
                <h1 class="xlarge-font">Casual</h1>
                <h1 class="large-font" style="color:navy;"><b>SOFLOW - SO1 E-Scooter</b></h1>
                <p>Der SO1 verfügt über einen 300 Watt Motor und hat eine Reichweite von bis zu 12 Kilometern. Seine maximale Geschwindigkeit endet bei 20 km/h. Der Scooter bewältigt auch Steigungen von max. 5 % mühelos. Er verfügt über eine elektrische
                    Vorderrad- und eine mechanische Hinterradbremse, und ist ausgestattet mit einem Vorderlicht und einem Bremslicht.</p>
                <button class="button" onclick="document.getElementById('reservationForm').style.display='block'" style="width:auto;">Zur Reservierung</button>
            </div>
            <div class="info_item_small">
                <img src="./img/pics/escooter.jpg" width="335" height="471">
            </div>
        </div>
    </div>

    <div class="info_container" style="background-color:#f1f1f1">
        <div class="info_item">
            <div class="info_item_small">
                <img src="./img/pics/offroadEScoouter.jpg" width="450" height="450">
            </div>
            <div class="info_item_big">
                <h1 class="xlarge-font">Offroad</h1>
                <h1 class="large-font" style="color:navy;"><b>VIRON E-Scooter</b></h1>
                <p>Der Elektro- Scooter - "VIRON" ist mit einem Kraftvollen 1000 Watt Elektromotor ausgestattet. Das 36 Volt Akkupaket, bestehend aus drei 12 Volt Akkus mit je 12 Ah, bringt den Scooter mit nur einer Akkuladung in Abhängigkeit der Geländebeschaffenheit
                    auf eine Reichweite von bis zu 30 Kilometern. Die Ladedauer beträgt ca. 6-7 Stunden.</p>
                <button class="button" onclick="document.getElementById('reservationForm').style.display='block'" style="width:auto;">Zur Reservierung</button>
            </div>
        </div>
    </div>

    <div class="info_container">
        <div class="info_item">
            <div class="info_item_big">
                <h1 class="xlarge-font">FTL</h1>
                <h1 class="large-font" style="color:navy;"><b>SXT Compact Ultimate</b></h1>
                <p>Wenn es um Geschwindigkeit geht, lässt der SXT Compact Ultimate die meisten seiner Konkurrenten weit hinter sich. Mit 40 km/h ist er einer der schnellsten E-Scooter, die auf dem Markt erhältlich sind. Ein weiterer Pluspunkt ist seine enorme
                    Reichweite von ganzen 50 km.</p>
                <button class="button" onclick="document.getElementById('reservationForm').style.display='block'" style="width:auto;">Zur Reservierung</button>
            </div>
            <div class="info_item_small">
                <img src="./img/pics/escoouterFast.jpg" width="500" height="500">
            </div>
        </div>
    </div>

    <div id="reservationForm" class="modal">
        <span onclick="document.getElementById('reservationForm').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form class="modal-content" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="container">
                <h1>Reserveriungsformular</h1>
                <?php
                if ($userId == 0) {
                    echo ("<div class='info'>Wenn sie einen Account haben können sie sich anmelden!</div>");
                }
                if ($_SESSION['order_fail']) {
                    echo ("<div class='error'>ERROR: Ihre Angaben waren fehlerhaft bitte probieren sie es erneut!</div>");
                }
                ?>
                <p>Bitte füllen sie alle unten angebenen Felder aus.</p>
                <hr>
                <label for="name"><b>Name</b></label>
                <input type="text" placeholder="Name" name="name" required>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Email" name="email" required>

                <label for="postal-road"><b>Straße und Hausnummer</b></label>
                <input type="text" placeholder="Straße" name="postal-road" required>

                <label for="postal-nr"><b>PLZ</b></label>
                <input type="number" placeholder="Postleitzahl" name="postal-nr" required>

                <label for="city"><b>Stadt</b></label>
                <input type="text" placeholder="Stadt" name="city" required>

                <label for="s-type"><b>E-Scooter Typ</b></label>
                <select id="s-type" name="s-type" required>
                    <option value="casual">Casual SOFLOW - SO1 E-Scooter</option>
                    <option value="offroad">Offroad VIRON E-Scooter</option>
                    <option value="ftl">FTL SXT Compact Ultimate</option>
                </select>
                <label for="res-day-start"><b>Reservierungszeitraum</b></label>
                <div class="flex">
                    <input type="date" id="res-day-start" name="res-day-start" required>
                    <p> bis zum </p>
                    <input type="date" id="res-day-end" name="res-day-end" required>
                </div>
                <div class="flex">
                    <button type="submit" class="btn">Reservieren</button>
                    <button type="reset" class="btn">Reset</button>
                    <button type="button" onclick="document.getElementById('reservationForm').style.display='none'" class="cancelbtn">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    <div class="info_container" style="background-color:#f1f1f1">
        <div class="info_item">
            <div class="info_item_medium">
                <div><iframe width="500" height="300" src=https://maps.google.de/maps?hl=de&q=Risee+Gmbh%20%20Willy-Brandt-Straße%20Berlin&t=&z=10&ie=utf8&iwloc=b&output=embed frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style='height:300px;width:100%;'> </iframe></div>
            </div>
            <div class="info_item_medium">
                <h1 class="xlarge-font" style='margin-top: 0px;'>Unsere Filiale</h1>
                <p><b>Kontakt</b></p>
                <p>service@risee.com</p>
                <p>Risee Gmbh</p>
                <p>Hibiskusstraße 31.</p>
                <p>66655 Projekt</p>
                <br><br><br>
            </div>
        </div>
    </div>
    <footer>
        <div class="flex-footer">
            <div>
                <a href="#search">Impressum</a>
                <a href="#search">Datenschutz</a>
                <a href="#search">AGB</a>
                <a href="#search">Support</a>
                <a href="./pub/php/logout.php">Logout</a>
            </div>
        </div>
    </footer>
    <script src="./js/modal_forms.js"></script>
</body>

</html>