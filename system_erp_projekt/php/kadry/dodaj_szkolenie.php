<?php require_once "../dbconnect.php";
                $pracownicy = $conn->query("SELECT id_pracownika, imie, nazwisko FROM dane_personalne_pracownika"); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj szkolenie</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="lista">
    <form action="dodaj_szkolenie_do_bazy.php" method="post">
        <h2>Dodaj szkolenie</h2>
        <select name="id_pracownika" required>
            <option value="">-- wybierz --</option>
            <?php while ($row = $pracownicy->fetch_assoc()): ?>
                <option value="<?= $row['id_pracownika'] ?>">
                    <?= htmlspecialchars($row['imie'] . ' ' . $row['nazwisko']) ?>
                </option>
            <?php endwhile; ?>
        </select>
        <input type="text" name="nazwa_szkolenia" placeholder="Nazwa szkolenia" required>
        <label for="data_ukonczenia">Data ukończenia szkolenia
        </label>
        <input type="date" name="data_ukonczenia" required>
        <button type="submit">Dodaj szkolenie</button>
    </form>
</div>
<a href="../logout.php" class="logout">Wyloguj się</a>
<a href="../uzytkownicy/HR.php" class="panel_kadrowy">Powrót do panela pracownika</a>
<a href="panel_kadrowy.php" class="panel_kadrowy_powrot">Powrót do panela kadrowego</a>
</body>
</html>
