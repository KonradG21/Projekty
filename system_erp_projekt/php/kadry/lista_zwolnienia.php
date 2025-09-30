<?php
require_once "../dbconnect.php";
$res = $conn->query("
    SELECT zl.id_zwolnienia, dp.imie, dp.nazwisko, zl.data_od, zl.data_do
    FROM zwolnienia_lekarskie zl
    JOIN dane_personalne_pracownika dp ON zl.id_pracownika = dp.id_pracownika
");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista zwolnień lekarskich</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="lista">
<h2>Lista zwolnień lekarskich</h2>
<table border="1">
    <tr>
        <th>Pracownik</th>
        <th>Od</th>
        <th>Do</th>
        <th></th>
        <th></th>
    </tr>
    <?php while ($z = $res->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($z['imie'] . " " . $z['nazwisko']) ?></td>
        <td><?= $z['data_od'] ?></td>
        <td><?= $z['data_do'] ?></td>
        <td><a href="edycja_zwolnienia.php?id=<?= $z['id_zwolnienia'] ?>">Edytuj</a></td>
        <td><a href="usun_zwolnienia.php?id=<?= $z['id_zwolnienia'] ?>" onclick="return confirm('Na pewno usunąć?')">Usuń</a></td>
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

            if (status === "zwolnienie_dodane") {
                alert("Zwolnienie lekarskie zostało dodane.");
            } else if (status === "edycja_ok") {
                alert("Dane zwolnienia lekarsiego zostało zaktualizowane.");
            } else if (status === "blad_data") {
                alert("Data początkowa jest późniejsza niż końcowa.");
            } else if (status === "zwolnienie_usuniete") {
                alert("Zwolnienie lekarskie zostało usunięte.");
            } else if (status === "blad_bazy") {
                alert("Wystąpił błąd bazy danych.");
            } else if (status === "usunieto") {
                alert("Dane zwolnienia lekarskiego zostały usunięte.");
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

