<?php
require_once "../dbconnect.php";

$id_szkolenia = intval($_POST['id_szkolenia']);
$nazwa = $_POST['nazwa_szkolenia'];
$data = $_POST['data_ukonczenia'];

try {
    $stmt = $conn->prepare("UPDATE szkolenia SET nazwa_szkolenia = ?, data_ukonczenia = ? WHERE id_szkolenia = ?");
    if (!$stmt) {
        throw new Exception("Błąd przygotowania zapytania: " . $conn->error);
    }

    $stmt->bind_param("ssi", $nazwa, $data, $id_szkolenia);

    if ($stmt->execute()) {
        header("Location: lista_szkolen.php?status=edycja_ok");
        exit();
    } else {
        throw new Exception("Błąd wykonania zapytania: " . $stmt->error);
    }
} catch (Exception $e) {
    error_log("Błąd edycji szkolenia: " . $e->getMessage());
    header("Location: lista_szkolen.php?status=blad_bazy");
    exit();
}
?>
