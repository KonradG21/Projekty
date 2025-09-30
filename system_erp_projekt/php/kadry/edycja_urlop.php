<?php
require_once "../dbconnect.php";

if (!isset($_GET['id'])) {
    echo "Brak ID urlopu.";
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("
    SELECT u.*, dp.imie, dp.nazwisko
    FROM dni_urlopowe u
    JOIN dane_personalne_pracownika dp ON u.id_pracownika = dp.id_pracownika
    WHERE u.id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$dane = $stmt->get_result()->fetch_assoc();

if (!$dane) {
    echo "Nie znaleziono urlopu.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edycja urlopu</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="lista">
<form action="zapisz_edycje_urlop.php" method="post">
    <input type="hidden" name="id" value="<?= $id ?>">

    <h3>Edycja urlopu dla: <?= htmlspecialchars($dane['imie'] . ' ' . $dane['nazwisko']) ?></h3>

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
