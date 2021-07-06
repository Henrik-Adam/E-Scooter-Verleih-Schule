<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/others.css">
    <link rel="stylesheet" href="../css/notifications.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Impressum</title>
</head>
<?php
require('support_logic.php');
?>

<body>
    <div class="nav-parent">
        <div class="nav">
            <a href="../index.php">Home</a>
            <a href="account.php"><?php echo($navIf) ?></a>
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
        <iframe width="98%" height="450px" src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=0"></iframe>
    </div>
    <footer>
        <div class="flex-footer">
            <div>
                <a href="impressum.php">Impressum</a>
                <a href="datenschutz.php">Datenschutz</a>
                <a href="agb.php">AGB</a>
                <a href="logout.php"><?php echo($logoutIf)?></a>
            </div>
        </div>
    </footer>
</body>

</html>