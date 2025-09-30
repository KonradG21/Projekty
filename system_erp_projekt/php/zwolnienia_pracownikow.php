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
    $widoczne_stopnie = ['pracownik', 'kierownik'];
} elseif ($_SESSION['stanowisko'] === 'HR') {
    $widoczne_stopnie = ['pracownik', 'kierownik', 'prezes'];
} else {
    echo "Brak dostępu.";
    exit();
}

$placeholders = implode(',', array_fill(0, count($widoczne_stopnie), '?'));
$types = str_repeat('s', count($widoczne_stopnie));

$query = "
    SELECT dp.imie, dp.nazwisko, zl.data_od, zl.data_do, dr.stanowisko
    FROM zwolnienia_lekarskie zl
    JOIN dane_personalne_pracownika dp ON zl.id_pracownika = dp.id_pracownika
    JOIN dane_robocze_pracownika dr ON zl.id_pracownika = dr.id_pracownika
    WHERE dr.stanowisko IN ($placeholders)
    ORDER BY zl.data_od ASC
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
    <title>Zwolnienia lekarskie</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="urlopy_pracownikow">
        <h2>Zwolnienia lekarskie pracowników</h2>
        <table border="1" cellpadding="8">
            <tr>
                <th>Imię i nazwisko</th>
                <th>Stanowisko</th>
                <th>Od</th>
                <th>Do</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['imie']) . " " . htmlspecialchars($row['nazwisko']) ?></td>
                    <td><?= htmlspecialchars($row['stanowisko']) ?></td>
                    <td><?= htmlspecialchars($row['data_od']) ?></td>
                    <td><?= htmlspecialchars($row['data_do']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <button onclick="window.history.back()">Wróć</button>
    </div>
</body>
</html>
