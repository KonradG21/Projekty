<?php
if ($entry) {
$kursy_nazwakg = $_REQUEST['kursy_nazwakg'];
$rodzaje_idkg = $_REQUEST['rodzaje_idkg'];

$sql = "INSERT INTO kursykg (kursy_nazwakg, rodzaje_idkg)
VALUES ('".$kursy_nazwakg."', '".$rodzaje_idkg."')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>