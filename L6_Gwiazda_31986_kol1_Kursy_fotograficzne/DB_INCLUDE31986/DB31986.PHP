<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "l6_gwiazda_31986_kol1_kursy_fotograficzne1";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>