<?php
$entry = TRUE;
if (isset($_POST['kursy_nazwakg'])) {$kursy_nazwakg = $_POST['kursy_nazwakg'];}
elseif(isset($_POST['rodzaje_idkg'])) {$rodzaje_idkg= $_POST['rodzaje_idkg'];}
else
{$entry = FALSE;}
?>