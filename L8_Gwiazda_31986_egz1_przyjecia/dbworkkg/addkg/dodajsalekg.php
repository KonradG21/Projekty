<?php
if ($entry) {
$spotkanie_idkg = $_REQUEST['spotkanie_idkg'];
$nazwa_salikg = $_REQUEST['nazwa_salikg'];
$limit_osobkg = $_REQUEST['limit_osobkg'];
$koszt_salikg = $_REQUEST['koszt_salikg'];


$sql = "INSERT INTO sale_kg (spotkanie_idkg, nazwa_salikg,limit_osobkg ,koszt_salikg)
VALUES ('".$spotkanie_idkg."', '".$nazwa_salikg."', '".$limit_osobkg."', '".$koszt_salikg."')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>