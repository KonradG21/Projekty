<?php
if ($entry) {
$klient_idkg = $_REQUEST['klient_idkg'];
$iloscosobkg = $_REQUEST['iloscosobkg'];



$sql = "INSERT INTO rezerwacje_klientakg (klient_idkg, iloscosobkg)
VALUES ('".$klient_idkg."', '".$iloscosobkg."')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>