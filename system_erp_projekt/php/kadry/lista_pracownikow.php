<?php
require_once "../dbconnect.php";

$query = "
    SELECT dp.id_pracownika, dp.imie, dp.nazwisko, dp.pesel, dp.telefon, dp.email, dr.*
    FROM dane_personalne_pracownika dp
    JOIN dane_robocze_pracownika dr ON dp.id_pracownika = dr.id_pracownika
    ORDER BY dp.imie DESC
";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista pracowników</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="lista">
<h2>Pracownicy</h2>
<table border="1">
    <tr>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Email</th>
        <th>Stanowisko</th>
        <th>Rodzaj umowy</th>
        <th>Data podpisania umowy</th>
        <th>Data rozpoczęcia umowy</th>
        <th>Data zakończenia umowy</th>
        <th>Pozosałe dni urlopowe</th>
        <th></th>
        <th></th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['imie']) ?></td>
            <td><?= htmlspecialchars($row['nazwisko']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= ucfirst(htmlspecialchars($row['stanowisko'])) ?></td>
            <td><?= htmlspecialchars($row['rodzaj_umowy']) ?></td>
            <td><?= htmlspecialchars($row['data_podpisania_umowy']) ?></td>
            <td><?= htmlspecialchars($row['data_rozpoczecia_umowy']) ?></td>
            <td><?= htmlspecialchars($row['data_zakonczenia_umowy']) ?></td>
            <td><?= htmlspecialchars($row['pozostaly_urlop']) ?></td>
            <td><a href="edycja_pracownika.php?id=<?= $row['id_pracownika'] ?>">Edytuj</a></td>
            <td><a href="usun_pracownika.php?id=<?= $row['id_pracownika'] ?>" onclick="return confirm('Czy na pewno chcesz usunąć tego pracownika?');">Usuń</a></td>
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

    if (status === "pracownik_dodany") {
        alert("Pracownik został dodany.");
    }else if (status === "blad_data_rozpoczecia") {
        alert("Data rozpoczęcia pracy nie może być przed datą podpisania umowy.");
    }else if (status === "blad_data_zakonczenia") {
        alert("Data zakończenia umowy nie może być przed datą podpisania umowy ani przed datą rozpoczęcia pracy.");
    } else if (status === "blad_bazy") {
        alert("Wystąpił błąd bazy danych.");
    } else if (status === "edycja_ok") {
        alert("Dane pracownika zostały zaktualizowane.");
    } else if (status === "usunieto") {
        alert("Wszystkie dane pracownika zostały usunięte.");
    } else if (status === "blad_id") {
        alert("Nieprawidłowe ID pracownika.");
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
