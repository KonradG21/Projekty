<?php
$entry = TRUE;
if (isset($_POST['klient_idkg'])) {$klient_idkg = $_POST['klient_idkg'];}
elseif (isset($_POST['iloscosobkg'])) {$iloscosobkg = $_POST['iloscosobkg'];}

else
{$entry = FALSE;}
?>