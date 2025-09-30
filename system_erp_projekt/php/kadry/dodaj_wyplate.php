<?php require_once "../dbconnect.php";
                $pracownicy = $conn->query("SELECT id_pracownika, imie, nazwisko FROM dane_personalne_pracownika"); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj wypłatę</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="lista">
    <form action="dodaj_wyplate_do_bazy.php" method="post">
        <h2>Dodaj wypłatę</h2>
        <select name="id_pracownika" required>
            <option value="">-- wybierz --</option>
            <?php while ($row = $pracownicy->fetch_assoc()): ?>
                <option value="<?= $row['id_pracownika'] ?>">
                    <?= htmlspecialchars($row['imie'] . ' ' . $row['nazwisko']) ?>
                </option>
            <?php endwhile; ?>
        </select>
        <input type="number" step="0.01" name="wyplata_brutto" placeholder="Wypłata brutto" required>
        <input type="number" step="0.01" name="wyplata_netto" placeholder="Wypłata netto" required>
        <label for="data_transakcji">Data transakcji</label>
        <input type="date" name="data_transakcji" placeholder="Data transakcji" required>
        <button type="submit">Dodaj wypłatę</button>
    </form>
</div>
<a href="../logout.php" class="logout">Wyloguj się</a>
<a href="../uzytkownicy/HR.php" class="panel_kadrowy">Powrót do panela pracownika</a>
<a href="panel_kadrowy.php" class="panel_kadrowy_powrot">Powrót do panela kadrowego</a>
</body>
</html>
