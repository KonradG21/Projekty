<?php
$entry = TRUE;
if (isset($_POST['klient_nazwakg'])) {$klient_nazwakg = $_POST['klient_nazwakg'];}
elseif (isset($_POST['cena_talerza'])) {$cena_talerza = $_POST['cena_talerza'];}

else
{$entry = FALSE;}
?>