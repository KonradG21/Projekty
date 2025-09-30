<?php
require_once "../dbconnect.php";

$id_pracownika = $_POST['id_pracownika'];
$brutto = $_POST['wyplata_brutto'];
$netto = $_POST['wyplata_netto'];
$data = $_POST['data_transakcji'];

try {
    $stmt = $conn->prepare("INSERT INTO wypłaty (id_pracownika, wyplata_brutto, wyplata_netto, data_transakcji) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Błąd przygotowania zapytania: " . $conn->error);
    }

    $stmt->bind_param("idds", $id_pracownika, $brutto, $netto, $data);

    if ($stmt->execute()) {
        header("Location: lista_wyplat.php?status=wyplata_dodana");
        exit();
    } else {
        throw new Exception("Błąd wykonania zapytania: " . $stmt->error);
    }
} catch (Exception $e) {
    error_log("Błąd dodawania wypłaty: " . $e->getMessage());
    header("Location: lista_wyplat.php?status=blad_bazy");
    exit();
}
?>
