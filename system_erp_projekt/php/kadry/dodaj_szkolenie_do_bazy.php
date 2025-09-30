<?php
require_once "../dbconnect.php";

$id_pracownika = $_POST['id_pracownika'];
$nazwa = $_POST['nazwa_szkolenia'];
$date = $_POST['data_ukonczenia'];

try {
    $stmt = $conn->prepare("INSERT INTO szkolenia (id_pracownika, nazwa_szkolenia, data_ukonczenia) VALUES (?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Błąd przygotowania zapytania: " . $conn->error);
    }

    $stmt->bind_param("iss", $id_pracownika, $nazwa, $date);

    if ($stmt->execute()) {
        header("Location: lista_szkolen.php?status=szkolenie_dodane");
        exit();
    } else {
        throw new Exception("Błąd wykonania zapytania: " . $stmt->error);
    }
} catch (Exception $e) {
    error_log("Błąd dodawania szkolenia: " . $e->getMessage());
    header("Location: lista_szkolen.php?status=blad_bazy");
    exit();
}
?>
