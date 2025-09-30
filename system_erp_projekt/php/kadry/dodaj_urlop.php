<?php
require_once "../dbconnect.php";
$pracownicy = $conn->query("SELECT id_pracownika, imie, nazwisko FROM dane_personalne_pracownika");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj urlop</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="lista">
    <form action="dodaj_urlop_do_bazy.php" method="post">
        <h2>Dodaj urlop pracownika</h2>

        <select name="id_pracownika" required>
            <option value="">-- wybierz pracownika --</option>
            <?php while ($row = $pracownicy->fetch_assoc()): ?>
                <option value="<?= $row['id_pracownika'] ?>">
                    <?= htmlspecialchars($row['imie'] . ' ' . $row['nazwisko']) ?>
                </option>
            <?php endwhile; ?>
        </select>
        <label for="data_od">Data początkowa urlopu</label>
        <input type="date" name="data_od" placeholder="Data od" required>
        <label for="data_do">Data końcowa urlopu</label>
        <input type="date" name="data_do" placeholder="Data do" required>

        <button type="submit">Dodaj urlop</button>
    </form>
</div>

<a href="../logout.php" class="logout">Wyloguj się</a>
<a href="../uzytkownicy/HR.php" class="panel_kadrowy">Powrót do panela pracownika</a>
<a href="panel_kadrowy.php" class="panel_kadrowy_powrot">Powrót do panela kadrowego</a>
</body>
</html>
