<?php
if ($entry) {
$rodzaje_nazwakg = $_REQUEST['rodzaje_nazwakg'];

$sql = "INSERT INTO rodzajekg (rodzaje_nazwakg)
VALUES ('".$rodzaje_nazwakg."')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully <br>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>