<?php
require_once "../dbconnect.php";

if (!isset($_GET['id'])) {
    header("Location: lista_zwolnienia.php?status=blad_id");
    exit();
}

$id = intval($_GET['id']);

$conn->begin_transaction();

try {
    $stmt = $conn->prepare("DELETE FROM zwolnienia_lekarskie WHERE id_zwolnienia = ?");
    if (!$stmt) {
        throw new Exception("Błąd przygotowania zapytania: " . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        throw new Exception("Nie znaleziono zwolnienia do usunięcia.");
    }

    $conn->commit();
    header("Location: lista_zwolnienia.php?status=usunieto");
    exit();

} catch (Exception $e) {
    $conn->rollback();
    error_log("Błąd usuwania zwolnienia: " . $e->getMessage());
    header("Location: lista_zwolnienia.php?status=blad_bazy");
    exit();
}
?>
