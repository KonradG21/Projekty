<?php
session_start();
require_once "dbconnect.php";

if (!isset($_SESSION['id_pracownika']) || !isset($_SESSION['stanowisko'])) {
    header("Location: login.php");
    exit();
}

$widoczne_stopnie = [];

if ($_SESSION['stanowisko'] === 'kierownik') {
    $widoczne_stopnie = ['pracownik'];
} elseif ($_SESSION['stanowisko'] === 'prezes') {
    $widoczne_stopnie = ['pracownik', 'kierownik', 'HR'];
}elseif ($_SESSION['stanowisko'] === 'HR') {
    $widoczne_stopnie = ['pracownik', 'kierownik', 'prezes'];
} else {
    echo "Brak dostępu.";
    exit();
}

$placeholders = implode(',', array_fill(0, count($widoczne_stopnie), '?'));
$types = str_repeat('s', count($widoczne_stopnie));

$query = "
    SELECT dp.imie, dp.nazwisko, u.data_od, u.data_do, dr.stanowisko
    FROM dni_urlopowe u
    JOIN dane_personalne_pracownika dp ON u.id_pracownika = dp.id_pracownika
    JOIN dane_robocze_pracownika dr ON u.id_pracownika = dr.id_pracownika
    WHERE dr.stanowisko IN ($placeholders)
    ORDER BY u.data_od asc
";

$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$widoczne_stopnie);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Pracownika</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="urlopy_pracownikow">
<h2>Urlopy pracowników</h2>
<table border="1" cellpadding="8">
    <tr>
        <th>Imię i nazwisko</th>
        <th>Stopień pracownika</th>
        <th>Od</th>
        <th>Do</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['imie']) . " " . htmlspecialchars($row['nazwisko']) ?></td>
        <td><?= htmlspecialchars($row['stanowisko'])?></td>
        <td><?= htmlspecialchars($row['data_od']) ?></td>
        <td><?= htmlspecialchars($row['data_do']) ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<button onclick="window.history.back()">Wróć</button>
</div>
</body>
</html>