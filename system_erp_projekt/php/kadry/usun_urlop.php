<?php
require_once "../dbconnect.php";

if (!isset($_GET['id'])) {
    header("Location: lista_urlopy.php?status=blad_id");
    exit();
}

$id = intval($_GET['id']);

$conn->begin_transaction();

try {
    // Pobierz id_pracownika i dni_robocze przed usunięciem
    $stmt_select = $conn->prepare("SELECT id_pracownika, dni_robocze FROM dni_urlopowe WHERE id = ?");
    if (!$stmt_select) {
        throw new Exception("Błąd przygotowania zapytania SELECT: " . $conn->error);
    }
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    $dane = $result->fetch_assoc();

    if (!$dane) {
        throw new Exception("Nie znaleziono urlopu do usunięcia.");
    }

    $id_pracownika = $dane['id_pracownika'];
    $dni_robocze = $dane['dni_robocze'];

    // Usuń wpis z dni_urlopowe
    $stmt_delete = $conn->prepare("DELETE FROM dni_urlopowe WHERE id = ?");
    $stmt_delete->bind_param("i", $id);
    $stmt_delete->execute();

    // Zwróć dni do pozostaly_urlop
    $stmt_update = $conn->prepare("UPDATE dane_robocze_pracownika SET pozostaly_urlop = pozostaly_urlop + ? WHERE id_pracownika = ?");
    $stmt_update->bind_param("ii", $dni_robocze, $id_pracownika);
    $stmt_update->execute();

    $conn->commit();
    header("Location: lista_urlopy.php?status=usunieto");
    exit();

} catch (Exception $e) {
    $conn->rollback();
    error_log("Błąd usuwania urlopu: " . $e->getMessage());
    header("Location: lista_urlopy.php?status=blad_bazy");
    exit();
}
?>
