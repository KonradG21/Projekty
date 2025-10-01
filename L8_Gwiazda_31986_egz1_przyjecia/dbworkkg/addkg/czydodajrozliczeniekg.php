<?php
$entry = TRUE;
if (isset($_POST['rezerwacja_idkg'])) {$rezerwacja_idkg = $_POST['rezerwacja_idkg'];}
elseif (isset($_POST['sale_idkg'])) {$sale_idkg = $_POST['sale_idkg'];}
elseif (isset($_POST['kosztcałykg'])) {$kosztcałykg = $_POST['kosztcałykg'];}
else
{$entry = FALSE;}
?>