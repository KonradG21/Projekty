<?php
require_once "../dbconnect.php";

if (!isset($_GET['id'])) {
    header("Location: lista_pracownikow.php?status=blad_id");
    exit();
}

$id = intval($_GET['id']);

$conn->begin_transaction();

try {
    $tabele = [
        "szkolenia",
        "wypłaty",
        "dni_urlopowe",
        "zwolnienia_lekarskie",
        "dane_robocze_pracownika",
        "adres_zamieszkania",
        "dane_personalne_pracownika"
    ];

    foreach ($tabele as $tabela) {
        $stmt = $conn->prepare("DELETE FROM $tabela WHERE id_pracownika = ?");
        if (!$stmt) {
            throw new Exception("Błąd zapytania w tabeli $tabela: " . $conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    $conn->commit();
    header("Location: lista_pracownikow.php?status=usunieto");
    exit();

} catch (Exception $e) {
    $conn->rollback();
    error_log("Błąd usuwania pracownika: " . $e->getMessage());
    header("Location: lista_pracownikow.php?status=blad_bazy");
    exit();
}
?>
