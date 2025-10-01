<?php
if ($entry) {
$foto_majster_imiekg = $_REQUEST['foto_majster_imiekg'];

$sql = "INSERT INTO fotograf_majsterkg (foto_majster_imiekg)
VALUES ('".$foto_majster_imiekg."')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>