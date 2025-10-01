<?php
if ($entry) {
$umiejetnosckg = $_REQUEST['umiejetnosckg'];
$foto_majster_idkg = $_REQUEST['foto_majster_idkg'];


$sql = "INSERT INTO fotograf_majster_umiejetonoscikg (umiejetnosckg, foto_majster_idkg)
VALUES ('".$umiejetnosckg."', '".$foto_majster_idkg."')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>