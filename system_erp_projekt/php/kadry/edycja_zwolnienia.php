<?php
require_once "../dbconnect.php";

if (!isset($_GET['id'])) {
    echo "Brak ID zwolnienia.";
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("
    SELECT zl.*, dp.imie, dp.nazwisko
    FROM zwolnienia_lekarskie zl
    JOIN dane_personalne_pracownika dp ON zl.id_pracownika = dp.id_pracownika
    WHERE zl.id_zwolnienia = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$dane = $stmt->get_result()->fetch_assoc();

if (!$dane) {
    echo "Nie znaleziono zwolnienia.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edycja zwolnienia</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="lista">
<form action="zapisz_edycje_zwolnienia.php" method="post">
    <input type="hidden" name="id_zwolnienia" value="<?= $id ?>">

    <h3>Edycja zwolnienia dla: <?= htmlspecialchars($dane['imie'] . ' ' . $dane['nazwisko']) ?></h3>

    <label for="data_od">Data od:</label>
    <input type="date" name="data_od" value="<?= $dane['data_od'] ?>" required>

    <label for="data_do">Data do:</label>
    <input type="date" name="data_do" value="<?= $dane['data_do'] ?>" required>

    <button type="submit">Zapisz zmiany</button>
</form>
</div>

<a href="../logout.php" class="logout">Wyloguj się</a>
<a href="../uzytkownicy/HR.php" class="panel_kadrowy">Powrót do panela pracownika</a>
<a href="panel_kadrowy.php" class="panel_kadrowy_powrot">Powrót do panela kadrowego</a>
</body>
</html>
