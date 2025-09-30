<?php
require_once "../dbconnect.php";

$query = "
    SELECT s.id_szkolenia, dp.imie, dp.nazwisko, s.nazwa_szkolenia, s.data_ukonczenia
    FROM szkolenia s
    JOIN dane_personalne_pracownika dp ON s.id_pracownika = dp.id_pracownika
    ORDER BY dp.imie DESC
";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista szkoleń</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="lista">
<h2>Szkolenia</h2>
<table border="1">
    <tr>
        <th>Pracownik</th>
        <th>Szkolenie</th>
        <th>Data ukończenia</th>
        <th></th>
        <th></th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['imie'] . ' ' . $row['nazwisko']) ?></td>
            <td><?= htmlspecialchars($row['nazwa_szkolenia']) ?></td>
            <td><?= $row['data_ukonczenia'] ?></td>
            <td><a href="edycja_szkolenia.php?id=<?= $row['id_szkolenia'] ?>">Edytuj</a></td>
            <td><a href="usun_szkolenie.php?id=<?= $row['id_szkolenia'] ?>" onclick="return confirm('Czy na pewno chcesz usunąć te szkolenie?');">Usuń</a></td>
        </tr>
    <?php endwhile; ?>
</table>
</div>
<a href="../logout.php" class="logout">Wyloguj się</a>
<a href="../uzytkownicy/HR.php" class="panel_kadrowy">Powrót do panela pracownika</a>
<a href="panel_kadrowy.php" class="panel_kadrowy_powrot">Powrót do panela kadrowego</a>
<?php if (isset($_GET['status'])): ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const status = "<?= htmlspecialchars($_GET['status']) ?>";

    if (status === "szkolenie_dodane") {
        alert("Szkolenie zostało dodane.");
    } else if (status === "blad_bazy") {
        alert("Wystąpił błąd bazy danych.");
    } else if (status === "edycja_ok") {
        alert("Dane szkolenia zostały zaktualizowane.");
    } else if (status === "usunieto") {
        alert("Dane szkolenia zostały usunięte.");
    } else if (status === "blad_id") {
        alert("Nieprawidłowe ID szkolenia.");
    }
    

    // usuwanie status z URL
    if (window.history.replaceState) {
        const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({}, document.title, cleanUrl);
    }
});
</script>
<?php endif; ?>

</body>
</html>
