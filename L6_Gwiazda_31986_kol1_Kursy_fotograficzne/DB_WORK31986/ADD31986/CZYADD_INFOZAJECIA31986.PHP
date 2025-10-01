<?php
$entry = TRUE;
if (isset($_POST['foto_majster_umiejetnosci_idkg'])) {$foto_majster_umiejetnosci_idkg = $_POST['foto_majster_umiejetnosci_idkg'];}
elseif(isset($_POST['kursy_idkg'])) {$kursy_idkg= $_POST['kursy_idkg'];}
elseif(isset($_POST['koszt_majstrakg'])) {$koszt_majstrakg= $_POST['koszt_majstrakg'];}
elseif(isset($_POST['Miejsce_kursukg'])) {$Miejsce_kursukg= $_POST['Miejsce_kursukg'];}
else
{$entry = FALSE;}
?>