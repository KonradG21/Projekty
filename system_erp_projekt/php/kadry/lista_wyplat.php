<?php
require_once "../dbconnect.php";

$query = "
    SELECT w.id_wyplaty, dp.imie, dp.nazwisko, w.wyplata_brutto, w.wyplata_netto, w.data_transakcji
    FROM wypłaty w
    JOIN dane_personalne_pracownika dp ON w.id_pracownika = dp.id_pracownika
    ORDER BY dp.imie asc
";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista wypłat</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="lista">
<h2>Wypłaty</h2>
<table border="1">
    <tr>
        <th>Pracownik</th>
        <th>Brutto</th>
        <th>Netto</th>
        <th>Data</th>
        <th></th>
        <th></th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['imie'] . ' ' . $row['nazwisko']) ?></td>
            <td><?= $row['wyplata_brutto'] ?></td>
            <td><?= $row['wyplata_netto'] ?></td>
            <td><?= $row['data_transakcji'] ?></td>
            <td><a href="edycja_wyplat.php?id=<?= $row['id_wyplaty'] ?>">Edytuj</a></td>
            <td><a href="usun_wyplate.php?id=<?= $row['id_wyplaty'] ?>" onclick="return confirm('Czy na pewno chcesz usunąć tę wypłatę?');">Usuń</a></td>
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
    if (status === "wyplata_dodana") {
        alert("Wypłata została dodana.");
    } else if (status === "blad_bazy") {
        alert("Wystąpił błąd bazy danych.");
    } else if (status === "edycja_ok") {
        alert("Dane wypłaty zostały zaktualizowane.");
    } else if (status === "usunieto") {
        alert("Dane wypłaty zostały usunięte.");
    } else if (status === "blad_id") {
        alert("Nieprawidłowe ID wypłaty.");
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
