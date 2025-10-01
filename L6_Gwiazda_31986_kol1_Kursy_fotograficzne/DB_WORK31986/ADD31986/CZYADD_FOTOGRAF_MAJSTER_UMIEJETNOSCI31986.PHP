<?php
$entry = TRUE;
if (isset($_POST['umiejetnosckg'])) {$umiejetnosckg = $_POST['umiejetnosckg'];}
elseif(isset($_POST['foto_majster_idkg'])) {$foto_majster_idkg = $_POST['foto_majster_idkg'];}
else
{$entry = FALSE;}
?>