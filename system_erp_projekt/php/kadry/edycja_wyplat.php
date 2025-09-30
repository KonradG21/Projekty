<?php
require_once "../dbconnect.php";

if (!isset($_GET['id'])) {
    echo "Brak ID wypłaty.";
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("
    SELECT w.*, dp.imie, dp.nazwisko
    FROM wypłaty w
    JOIN dane_personalne_pracownika dp ON w.id_pracownika = dp.id_pracownika
    WHERE w.id_wyplaty = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$dane = $stmt->get_result()->fetch_assoc();

if (!$dane) {
    echo "Nie znaleziono wypłaty.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edycja wypłaty</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="lista">
<form action="zapisz_edycje_wyplat.php" method="post">
    <input type="hidden" name="id_wyplaty" value="<?= $id ?>">

    <h3>Edycja wypłaty dla: <?= htmlspecialchars($dane['imie'] . ' ' . $dane['nazwisko']) ?></h3>

    <label for="wyplata_netto">Netto</label>
    <input type="number" step="0.01" name="wyplata_netto" value="<?= $dane['wyplata_netto'] ?>" required>

    <label for="wyplata_brutto">Brutto</label>
    <input type="number" step="0.01" name="wyplata_brutto" value="<?= $dane['wyplata_brutto'] ?>" required>

    <label for="data_transakcji">Data transakcji</label>
    <input type="date" name="data_transakcji" value="<?= $dane['data_transakcji'] ?>" required>

    <button type="submit">Zapisz zmiany</button>
</form>
</div>
<a href="../logout.php" class="logout">Wyloguj się</a>
<a href="../uzytkownicy/HR.php" class="panel_kadrowy">Powrót do panela pracownika</a>
<a href="panel_kadrowy.php" class="panel_kadrowy_powrot">Powrót do panela kadrowego</a>
</body>
</html>
