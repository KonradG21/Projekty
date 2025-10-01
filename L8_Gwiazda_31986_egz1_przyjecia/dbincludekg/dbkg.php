<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "l8_gwiazda_31986_przyjecia";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>