<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/nav.css">
    <link rel="stylesheet" href="../../css/others.css">
    <link rel="stylesheet" href="../../css/notifications.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Impressum</title>
</head>
<?php
require('support_logic.php');
?>

<body>
    <div class="nav-parent">
        <div class="nav">
            <a href="../../index.php">Home</a>
            <a href="./account.php">Account</a>
        </div>
    </div>
    <div class="impressum"> 
        <div>
            <h2>Impressum</h2>
            <p>service@risee.com</p>
            <p>Risee Gmbh</p>
            <p>Hibiskusstraße 31.</p>
            <p>66655 Projekt</p>
        </div>
        <div class="info">Gratulation Sie wurden erfolgreich rickrolled!</div>
        <iframe width="1000" height="450" src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=0"></iframe>
    </div>
    <footer>
        <div class="flex-footer">
            <div>
                <a href="./impressum.php">Impressum</a>
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