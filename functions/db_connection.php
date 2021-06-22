<?php
require('config.php');

$conn = new mysqli($servername, $sqlUsernName, $sqlPassword, $dbName);

if ($conn->connect_error) {
  die("<div class='error'>Connection failed: " . htmlspecialchars($conn->connect_error) . "</div>");
}
// echo "Connected successfully";
?>