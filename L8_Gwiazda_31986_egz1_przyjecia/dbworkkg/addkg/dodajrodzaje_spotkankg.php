<?php
if ($entry) {
$spotkanie_nazwakg = $_REQUEST['spotkanie_nazwakg'];



$sql = "INSERT INTO rodzaje_spotkankg (spotkanie_nazwakg)
VALUES ('".$spotkanie_nazwakg."')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>