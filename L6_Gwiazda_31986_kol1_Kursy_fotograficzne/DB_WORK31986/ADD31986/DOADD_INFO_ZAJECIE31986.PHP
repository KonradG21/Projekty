<?php
if ($entry) {
$foto_majster_umiejetnosci_idkg = $_REQUEST['foto_majster_umiejetnosci_idkg'];
$kursy_idkg = $_REQUEST['kursy_idkg'];
$koszt_majstrakg = $_REQUEST['koszt_majstrakg'];
$Miejsce_kursukg = $_REQUEST['Miejsce_kursukg'];

$sql = "INSERT INTO info_zajeciakg (foto_majster_umiejetnosci_idkg, kursy_idkg, koszt_majstrakg, Miejsce_kursukg)
VALUES ('".$foto_majster_umiejetnosci_idkg."', '".$kursy_idkg."', '".$koszt_majstrakg."', '".$Miejsce_kursukg."')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully <br>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>