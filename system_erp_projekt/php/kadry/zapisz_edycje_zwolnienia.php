<?php
require_once "../dbconnect.php";

$id = intval($_POST['id_zwolnienia']);
$od = $_POST['data_od'];
$do = $_POST['data_do'];

if ($od > $do) {
    header("Location: lista_zwolnienia.php?status=blad_data");
    exit();
}

try {
    $stmt = $conn->prepare("UPDATE zwolnienia_lekarskie SET data_od = ?, data_do = ? WHERE id_zwolnienia = ?");
    if (!$stmt) {
        throw new Exception("Błąd przygotowania zapytania: " . $conn->error);
    }

    $stmt->bind_param("ssi", $od, $do, $id);

    if ($stmt->execute()) {
        header("Location: lista_zwolnienia.php?status=edycja_ok");
        exit();
    } else {
        throw new Exception("Błąd wykonania zapytania: " . $stmt->error);
    }
} catch (Exception $e) {
    error_log("Błąd edycji zwolnienia: " . $e->getMessage());
    header("Location: lista_zwolnienia.php?status=blad_bazy");
    exit();
}
?>
