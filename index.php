<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main_page.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/notifications.css">
    <link rel="stylesheet" href="css/slider.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
</head>
<?php

require('php/support_logic.php');

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else $userId = 0;

$userFile = "file_save/user-data.json";
$userData = getUserData($userFile, $userId);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    getReservationData($userId);
}

function getReservationData($userId)
{
    $fileOrder = "file_save/order-data.json";

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
    if (strlen($name) >= 3 && strlen($email) >= 3 && strlen($postalRoad) >= 4 && strlen($city) >= 4 && $postalNr >= 1 && $userId != 0 && formTimeCheck($resStart, $resEnd)) {
        $orderId = getOrderId($fileOrder);
        $time = date("d.m.Y");
        $_SESSION['order_fail'] = false;
        $resDataArr = ["order_id" => $orderId, "name" => encrypt($name), "email" => encrypt($email), "postal_road" => encrypt($postalRoad), "postal_nr" => encrypt($postalNr), "city" => encrypt($city), "scooter_type" => encrypt($sType), "res_start" => $resStart, "res_end" => $resEnd, "user_id" => $userId, "time" => $time];
        setOrderDataInJson($fileOrder, $resDataArr);
        header("Location: php/account.php");
        $_SESSION['order_success'] = true;
        $_SESSION['not_login'] = false;
    } elseif ($userId == 0) {
        $_SESSION['not_login'] = true;
    } else {
        $_SESSION['order_fail'] = true;
    }
}

function getFileHeader()
{
    $imgArr = glob("img/products/*.jpg");
    for ($i = 1; $i <= count(glob("img/products/*.jpg")); $i++) {
        $search = "img/products/" . $i . "_";
        $imgArr[$i - 1] = str_replace($search, "", $imgArr[$i - 1]);
    }
    $imgArr = str_replace(".jpg", "", $imgArr);
    return $imgArr;
}

function getFileName()
{
    $imgArr = glob("img/products/*.jpg");
    return $imgArr;
}

function assembleArr()
{
    $header = getFileHeader();
    $name = getFileName();

    for ($i = 0; $i < count($header); $i++) {
        $assembleInfos[] = ["header" => $header[$i], "name" => $name[$i]];
    }
    return $assembleInfos;
}

function createSlider()
{
    $sliderArr = assembleArr();
    foreach ($sliderArr as $slide) {
        echo ('<div class="slider">');
        echo ('<img src="' . $slide["name"] . '" style="width:100%">');
        echo ('<div class="text"><h1>' . $slide["header"] . '</h1></div>');
        echo ('</div>');
    }
    echo ('<div class="dot-div" style="text-align:center">');
    for ($x = 1; $x <= count($sliderArr); $x++) {
        echo ('<span class="dot" onclick="currentSlide(' . $x . ')"></span>');
    }
    echo ('</div>');
}

$userName = isset($userData['user_name']) ? $userData['user_name'] : "";
$userEmail = isset($userData['user_email']) ? decrypt($userData['user_email']) : "";
$userRoad = isset($userData['user_address']['user_road']) ? decrypt($userData['user_address']['user_road']) : "";
$userPostal = isset($userData['user_address']['user_postal']) ? decrypt($userData['user_address']['user_postal']) : "";
$userCity = isset($userData['user_address']['user_city']) ? decrypt($userData['user_address']['user_city']) : "";
?>

<body>
    <noscript>
        <div class='error'>ERROR: Dein Browser Untersützt kein Javascript! Aktiviere Javascript um alle Funktionen nutzten zu können!</div>
    </noscript>
    <div class="nav-parent">
        <div class="nav">
            <a href="index.php" class="active">Home</a>
            <a href="php/account.php"><?php echo($navIf) ?></a>
        </div>
    </div>
    <?php
    $sessionUserName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "";
    if (isset($_SESSION['welcome_id']) && $_SESSION['welcome_id']) {
        echo ("<div class='info' style='margin-top: 30px'>Willkommen zurück " . $sessionUserName . "</div>");
        $_SESSION['welcome_id'] = false;
    } elseif(isset($_SESSION['user_logout']) && $_SESSION['user_logout']) {
        echo ("<div class='info' style='margin-top: 30px'>Du wurdest erfolgreich ausgelogt</div>");
        $_SESSION['user_logout'] = false;
    }
    ?>
    <div class="info_container" style="background-color:#f1f1f1">
        <div class="info_item">
            <div class="info_item_small">
                <img src="img/pics/escooterrunner.jpg" width="600" height="600">
            </div>
            <div class="info_item_big">
                <h1 class="xlarge-font" style='margin-top: 0px;'><b>Freedom</b></h1>
                <p>Elektroroller sind populär und haben sich gut in unserem Straßenbild etabliert: <b>RISEE</b> hat die beliebten Elektroroller aus useren Innenstädlichen Büro jetzt auch als Online-Vermietung zugänglich gemacht, denn aktuell ist der Bedarf
                    an Individualmobilität so hoch wie nie (was sich zum Beispiel auch am steigenden Verkauf von Fahrrädern ablesen lässt). E-Tretroller erfüllen besonders die Nachfrage nach Sicherheit und Hygiene (im Gegensatz zum ÖPNV).</p>
                <p>Wenn Sie einen E-Roller mieten, sind Sie also individuell mobil und müssen sich keine Sorgen machen, hygienische Risiken einzugehen oder Abstandsregeln nicht einhalten zu können.</p>
                <p>Gerne können sie uns auch in unserer Filiale besuchen und dort ohne Reservierung einen Scooter mieten.</p>
            </div>
        </div>
    </div>
    <?php
    if (isset($_SESSION['order_fail']) && $_SESSION['order_fail']) {
        echo ("<div class='error'>ERROR: Ihre Angaben waren fehlerhaft bitte probieren sie es erneut!</div>");
    }
    if (isset($_SESSION['not_login']) && $_SESSION['not_login']) {
        echo ("<div class='warning'>Sie müssen sich <a href='php/login.php'>anmelden</a> um Reservieren zu können!</div>");
    }
    ?>
    <div class="info_container">
        <div class="info_item">
            <div class="info_item_big">
                <h1 class="xlarge-font">Casual</h1>
                <h1 class="large-font" style="color:navy;"><b>SOFLOW - SO1 E-Scooter</b></h1>
                <p>Der SO1 verfügt über einen 300 Watt Motor und hat eine Reichweite von bis zu 12 Kilometern. Seine maximale Geschwindigkeit endet bei 20 km/h. Der Scooter bewältigt auch Steigungen von max. 5 % mühelos. Er verfügt über eine elektrische
                    Vorderrad- und eine mechanische Hinterradbremse, und ist ausgestattet mit einem Vorderlicht und einem Bremslicht.</p>
                <button class="button" onclick="document.getElementById('modalForm').style.display='block'" style="width:auto;">Zur Reservierung</button>
            </div>
            <div class="info_item_small">
                <img src="img/pics/escooter.jpg" width="335" height="471">
            </div>
        </div>
    </div>

    <div class="info_container" style="background-color:#f1f1f1">
        <div class="info_item">
            <div class="info_item_small">
                <img src="img/pics/offroadEScoouter.jpg" width="450" height="450">
            </div>
            <div class="info_item_big">
                <h1 class="xlarge-font">Offroad</h1>
                <h1 class="large-font" style="color:navy;"><b>VIRON E-Scooter</b></h1>
                <p>Der Elektro- Scooter - "VIRON" ist mit einem Kraftvollen 1000 Watt Elektromotor ausgestattet. Das 36 Volt Akkupaket, bestehend aus drei 12 Volt Akkus mit je 12 Ah, bringt den Scooter mit nur einer Akkuladung in Abhängigkeit der Geländebeschaffenheit
                    auf eine Reichweite von bis zu 30 Kilometern. Die Ladedauer beträgt ca. 6-7 Stunden.</p>
                <button class="button" onclick="document.getElementById('modalForm').style.display='block'" style="width:auto;">Zur Reservierung</button>
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
                <button class="button" onclick="document.getElementById('modalForm').style.display='block'" style="width:auto;">Zur Reservierung</button>
            </div>
            <div class="info_item_small">
                <img src="img/pics/escoouterFast.jpg" width="500" height="500">
            </div>
        </div>
    </div>

    <div id="modalForm" class="modal">
        <span onclick="document.getElementById('modalForm').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form class="modal-content" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="container">
                <h1>Reserveriungsformular</h1>
                <?php
                if ($userId == 0) {
                    echo ("<div class='warning'>Bitte melden sie sich an um Reservieren zu können!</div>");
                }
                if (isset($_SESSION['order_fail'])) {
                    if ($_SESSION['order_fail']) {
                        echo ("<div class='error'>ERROR: Ihre Angaben waren fehlerhaft bitte probieren sie es erneut!</div>");
                    }
                }
                ?>
                <p>Bitte füllen sie alle unten angebenen Felder aus.</p>
                <hr>
                <label for="name"><b>Name</b></label>
                <input type="text" placeholder="Name" name="name" value="<?php echo ($userName); ?>" required>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Email" name="email" value="<?php echo ($userEmail); ?>" required>

                <label for="postal-road"><b>Straße und Hausnummer</b></label>
                <input type="text" placeholder="Straße" name="postal-road" value="<?php echo ($userRoad); ?>" required>

                <label for="postal-nr"><b>PLZ</b></label>
                <input type="number" placeholder="Postleitzahl" name="postal-nr" value="<?php echo ($userPostal); ?>" required>

                <label for="city"><b>Stadt</b></label>
                <input type="text" placeholder="Stadt" name="city" value="<?php echo ($userCity); ?>" required>

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
                    <button type="button" onclick="document.getElementById('modalForm').style.display='none'" class="cancelbtn">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    <div id="slider-div">
        <div class="slideshow-container">
            <?php createSlider() ?>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
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
                <a href="php/impressum.php">Impressum</a>
                <a href="#search">Datenschutz</a>
                <a href="#search">AGB</a>
                <a href="#search">Support</a>
                <a href="php/logout.php"><?php echo($logoutIf)?></a>
            </div>
        </div>
    </footer>
    <script src="js/slider.js"></script>
    <script src="js/modal_forms.js"></script>
</body>

</html>