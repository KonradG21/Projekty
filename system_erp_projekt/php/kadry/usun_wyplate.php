<?php
require_once "../dbconnect.php";

if (!isset($_GET['id'])) {
    header("Location: lista_wyplat.php?status=blad_id");
    exit();
}

$id = intval($_GET['id']);

$conn->begin_transaction();

try {
    $stmt = $conn->prepare("DELETE FROM wypłaty WHERE id_wyplaty = ?");
    if (!$stmt) {
        throw new Exception("Błąd przygotowania zapytania: " . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        throw new Exception("Nie znaleziono wypłaty do usunięcia.");
    }

    $conn->commit();
    header("Location: lista_wyplat.php?status=usunieto");
    exit();

} catch (Exception $e) {
    $conn->rollback();
    error_log("Błąd usuwania wypłaty: " . $e->getMessage());
    header("Location: lista_wyplat.php?status=blad_bazy");
    exit();
}
?>
