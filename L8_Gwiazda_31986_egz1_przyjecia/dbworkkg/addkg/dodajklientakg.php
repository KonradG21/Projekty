<?php
if ($entry) {
$klient_nazwakg = $_REQUEST['klient_nazwakg'];
$cena_talerza = $_REQUEST['cena_talerza'];



$sql = "INSERT INTO klientkg (klient_nazwakg, cena_talerza)
VALUES ('".$klient_nazwakg."', '".$cena_talerza."')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>