<?php
$db_host = "localhost";
$db_name = "system_erp_projekt";
$db_user = "root";
$db_pass = "";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}
?>
