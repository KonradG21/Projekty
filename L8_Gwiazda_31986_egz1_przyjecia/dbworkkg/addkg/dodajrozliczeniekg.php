<?php
if ($entry) {
$rezerwacja_idkg = $_REQUEST['rezerwacja_idkg'];
$sale_idkg = $_REQUEST['sale_idkg'];
$kosztcałykg = $_REQUEST['kosztcałykg'];



$sql = "INSERT INTO rozliczenie (rezerwacja_idkg, sale_idkg, kosztcałykg)
VALUES ('".$rezerwacja_idkg."','".$sale_idkg."', '".$kosztcałykg."')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>