<?php
require_once "../dbconnect.php";

if (!isset($_GET['id'])) {
    echo "Brak ID szkolenia.";
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("
    SELECT s.*, dp.imie, dp.nazwisko
    FROM szkolenia s
    JOIN dane_personalne_pracownika dp ON s.id_pracownika = dp.id_pracownika
    WHERE s.id_szkolenia = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$dane = $stmt->get_result()->fetch_assoc();

if (!$dane) {
    echo "Nie znaleziono szkolenia.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edycja szkolenia</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="lista">
<form action="zapisz_edycje_szkolenia.php" method="post">
    <input type="hidden" name="id_szkolenia" value="<?= $id ?>">

    <h3>Edycja szkolenia dla: <?= htmlspecialchars($dane['imie'] . ' ' . $dane['nazwisko']) ?></h3>

    <label for="nazwa_szkolenia">Nazwa szkolenia</label>
    <input type="text" name="nazwa_szkolenia" value="<?= htmlspecialchars($dane['nazwa_szkolenia']) ?>" required>

    <label for="data_ukonczenia">Data ukończenia</label>
    <input type="date" name="data_ukonczenia" value="<?= $dane['data_ukonczenia'] ?>" required>

    <button type="submit">Zapisz zmiany</button>
</form>
</div>
<a href="../logout.php" class="logout">Wyloguj się</a>
<a href="../uzytkownicy/HR.php" class="panel_kadrowy">Powrót do panela pracownika</a>
<a href="panel_kadrowy.php" class="panel_kadrowy_powrot">Powrót do panela kadrowego</a>
</body>
</html>
