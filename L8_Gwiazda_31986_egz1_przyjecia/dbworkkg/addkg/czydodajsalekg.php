<?php
$entry = TRUE;
if (isset($_POST['spotkanie_idkg'])) {$spotkanie_idkg = $_POST['spotkanie_idkg'];}
elseif (isset($_POST['nazwa_salikg'])) {$nazwa_salikg = $_POST['nazwa_salikg'];}
elseif (isset($_POST['limit_osobkg'])) {$limit_osobkg = $_POST['limit_osobkg'];}
elseif (isset($_POST['koszt_salikg'])) {$koszt_salikg = $_POST['koszt_salikg'];}
else
{$entry = FALSE;}
?>