<?php
require_once "../dbconnect.php";

if (!isset($_GET['id'])) {
    header("Location: lista_szkolen.php?status=blad_id");
    exit();
}

$id = intval($_GET['id']);

try {
    $stmt = $conn->prepare("DELETE FROM szkolenia WHERE id_szkolenia = ?");
    if (!$stmt) {
        throw new Exception("Błąd przygotowania zapytania: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: lista_szkolen.php?status=usunieto");
        exit();
    } else {
        throw new Exception("Błąd wykonania zapytania: " . $stmt->error);
    }
} catch (Exception $e) {
    error_log("Błąd usuwania szkolenia: " . $e->getMessage());
    header("Location: lista_szkolen.php?status=blad_bazy");
    exit();
}
?>
