<?php
require_once "../dbconnect.php";

// Pobierz wszystkie urlopy wraz z danymi pracowników
$sql = "
    SELECT u.id, dp.imie, dp.nazwisko, u.data_od, u.data_do, u.dni_robocze
    FROM dni_urlopowe u
    JOIN dane_personalne_pracownika dp ON u.id_pracownika = dp.id_pracownika
    ORDER BY u.data_od DESC
";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista urlopów</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="lista">
    <h2>Lista urlopów pracowników</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>Pracownik</th>
            <th>Od</th>
            <th>Do</th>
            <th>Dni robocze</th>
            <th></th>
            <th></th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['imie'] . ' ' . $row['nazwisko']) ?></td>
            <td><?= htmlspecialchars($row['data_od']) ?></td>
            <td><?= htmlspecialchars($row['data_do']) ?></td>
            <td><?= $row['dni_robocze'] ?></td>
            <td><a href="edycja_urlop.php?id=<?= $row['id'] ?>">Edytuj</a> </td>
            <td><a href="usun_urlop.php?id=<?= $row['id'] ?>" onclick="return confirm('Na pewno usunąć urlop?');">Usuń</a></td>
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
    if (status === "urlop_dodany") { 
        alert("Urlop został dodany.");
    } else if (status === "blad_bazy") {
        alert("Wystąpił błąd bazy danych.");
    } else if (status === "brak_dni") {
        alert("Pracownik nie ma wystarczającej liczby dni urlopowych.");
    } else if (status === "blad_formularza") {
        alert("Nieprawidłowy formularz.");
    } else if (status === "blad_data") {
        alert("Data początkowa jest późniejsza niż końcowa.");
    } else if (status === "edycja_ok") {
        alert("Dane urlopu zostały zaktualizowane.");
    } else if (status === "usunieto") {
        alert("Dane szkolenia zostały usunięte.");
    } else if (status === "blad_id") {
        alert("Nieprawidłowe ID urlopu.");
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
