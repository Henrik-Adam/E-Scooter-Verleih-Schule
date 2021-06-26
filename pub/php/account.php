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
if(!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/pub/php/login.php");
}
?>
<body>
    <div class="nav-parent">
        <div class="nav">
            <a href="../../index.php">Home</a>
            <a href="/pub/php/account.php" class="active">Account</a>
        </div>
    </div>


    <div class="table-reservation">
    <table class="reservation">
  <tr>
    <th>Company</th>
    <th>Contact</th>
    <th>Country</th>
  </tr>
  <tr>
    <td>Alfreds Futterkiste</td>
    <td>Maria Anders</td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Berglunds snabbköp</td>
    <td>Christina Berglund</td>
    <td>Sweden</td>
  </tr>
  <tr>
    <td>Centro comercial Moctezuma</td>
    <td>Francisco Chang</td>
    <td>Mexico</td>
  </tr>
  <tr>
    <td>Ernst Handel</td>
    <td>Roland Mendel</td>
    <td>Austria</td>
  </tr>
  <tr>
    <td>Island Trading</td>
    <td>Helen Bennett</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Königlich Essen</td>
    <td>Philip Cramer</td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Laughing Bacchus Winecellars</td>
    <td>Yoshi Tannamuri</td>
    <td>Canada</td>
  </tr>
  <tr>
    <td>Magazzini Alimentari Riuniti</td>
    <td>Giovanni Rovelli</td>
    <td>Italy</td>
  </tr>
  <tr>
    <td>North/South</td>
    <td>Simon Crowther</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Paris spécialités</td>
    <td>Marie Bertrand</td>
    <td>France</td>
  </tr>
</table>
    </div>

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