<?php
require_once "../dbconnect.php";

if (isset($_POST['id_pracownika'], $_POST['data_od'], $_POST['data_do'])) {
    $id = intval($_POST['id_pracownika']);
    $od = $_POST['data_od'];
    $do = $_POST['data_do'];

    if ($od > $do) {
        header("Location: lista_zwolnienia.php?status=blad_data");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO zwolnienia_lekarskie (id_pracownika, data_od, data_do) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $id, $od, $do);

    if ($stmt->execute()) {
        header("Location: lista_zwolnienia.php?status=zwolnienie_dodane");
    } else {
        header("Location: lista_zwolnienia.php?status=blad_bazy");
    }
} else {
    header("Location: lista_zwolnienia.php?status=blad_formularza");
}
exit();
?>