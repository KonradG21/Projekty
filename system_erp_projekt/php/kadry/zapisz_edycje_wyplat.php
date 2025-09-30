<?php
require_once "../dbconnect.php";

$id_wyplaty = intval($_POST['id_wyplaty']);
$netto = floatval($_POST['wyplata_netto']);
$brutto = floatval($_POST['wyplata_brutto']);
$data = $_POST['data_transakcji'];

try {
    $stmt = $conn->prepare("UPDATE wypłaty SET wyplata_netto = ?, wyplata_brutto = ?, data_transakcji = ? WHERE id_wyplaty = ?");
    if (!$stmt) {
        throw new Exception("Błąd przygotowania zapytania: " . $conn->error);
    }

    $stmt->bind_param("ddsi", $netto, $brutto, $data, $id_wyplaty);

    if ($stmt->execute()) {
        header("Location: lista_wyplat.php?status=edycja_ok");
        exit();
    } else {
        throw new Exception("Błąd wykonania zapytania: " . $stmt->error);
    }
} catch (Exception $e) {
    error_log("Błąd edycji wypłaty: " . $e->getMessage());
    header("Location: lista_wyplat.php?status=blad_bazy");
    exit();
}
?>
