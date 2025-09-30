<?php
require_once "../dbconnect.php";

if (!isset($_GET['id'])) {
    echo "Brak ID pracownika.";
    exit();
}

$id = intval($_GET['id']);

$query = "
    SELECT dp.*, az.*, dr.*
    FROM dane_personalne_pracownika dp
    JOIN adres_zamieszkania az ON dp.id_pracownika = az.id_pracownika
    JOIN dane_robocze_pracownika dr ON dp.id_pracownika = dr.id_pracownika
    WHERE dp.id_pracownika = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$dane = $result->fetch_assoc();

if (!$dane) {
    echo "Nie znaleziono pracownika.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja pracownika</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="lista">
<form action="zapisz_edycje_pracownika.php" method="post">
    <input type="hidden" name="id_pracownika" value="<?= $id ?>">
    <h3>Edycja pracownika: <?= htmlspecialchars($dane['imie'] . ' ' . $dane['nazwisko']) ?></h3>

    <h3>Dane osobowe</h3>
    <label for="imie">Imie</label>
    <input type="text" name="imie" value="<?= $dane['imie'] ?>" required>
    <label for="nazwisko">Nazwisko</label>
    <input type="text" name="nazwisko" value="<?= $dane['nazwisko'] ?>" required>
    <label for="pesel">Pesel</label>
    <input type="text" name="pesel" value="<?= $dane['pesel'] ?>" required>
    <label for="telefon">Telefon</label>
    <input type="text" name="telefon" value="<?= $dane['telefon'] ?>">
    <label for="email">Email</label>
    <input type="text" name="email" value="<?= $dane['email'] ?>">
    <label for="login">Login</label>
    <input type="text" name="login" value="<?= $dane['login'] ?>">

    <h3>Adres</h3>
    <label for="miejscowosc">Miejscowosc</label>
    <input type="text" name="miejscowosc" value="<?= $dane['miejscowosc'] ?>">
    <label for="ulica">Ulica</label>
    <input type="text" name="ulica" value="<?= $dane['ulica'] ?>">
    <label for="numer_mieszkania">Numer mieszkania</label>
    <input type="text" name="numer_mieszkania" value="<?= $dane['numer_mieszkania'] ?>">
    <label for="kod_pocztowy">Kod pocztowy</label>
    <input type="text" name="kod_pocztowy" value="<?= $dane['kod_pocztowy'] ?>">

    <h3>Dane robocze</h3>
    <label for="stanowisko">Stanowisko</label>
    <select name="stanowisko">
        <option <?= $dane['stanowisko'] == 'HR' ? 'selected' : '' ?>>HR</option>
        <option <?= $dane['stanowisko'] == 'Kierownik' ? 'selected' : '' ?>>Kierownik</option>
        <option <?= $dane['stanowisko'] == 'Prezes' ? 'selected' : '' ?>>Prezes</option>
        <option <?= $dane['stanowisko'] == 'Pracownik' ? 'selected' : '' ?>>Pracownik</option>
    </select>

    <label for="rodzaj_umowy">Rodzaj umowy</label>
    <select name="rodzaj_umowy">
        <option <?= $dane['rodzaj_umowy'] == 'Umowa o pracę' ? 'selected' : '' ?>>Umowa o pracę</option>
        <option <?= $dane['rodzaj_umowy'] == 'Umowa zlecenie' ? 'selected' : '' ?>>Umowa zlecenie</option>
        <option <?= $dane['rodzaj_umowy'] == 'B2B' ? 'selected' : '' ?>>B2B</option>
    </select>

    <label for="data_podpisania_umowy">Data podpisania umowy</label>
    <input type="date" name="data_podpisania_umowy" value="<?= $dane['data_podpisania_umowy'] ?>">
    <label for="data_rozpoczecia_umowy">Data rozpoczecia umowy</label>
    <input type="date" name="data_rozpoczecia_umowy" value="<?= $dane['data_rozpoczecia_umowy'] ?>">
    <label for="data_zakonczenia_umowy">Data zakonczenia umowy</label>
    <input type="date" name="data_zakonczenia_umowy" value="<?= $dane['data_zakonczenia_umowy'] ?>">
    <label for="dni_urlopowe">Dni urlopowe</label>
    <input type="number" name="dni_urlopowe" value="<?= $dane['dni_urlopowe'] ?>">

    <button type="submit">Zapisz zmiany</button>
</form>
</div>
<a href="../logout.php" class="logout">Wyloguj się</a>
<a href="../uzytkownicy/HR.php" class="panel_kadrowy">Powrót do panela pracownika</a>
<a href="panel_kadrowy.php" class="panel_kadrowy_powrot">Powrót do panela kadrowego</a>
</body>
</html>
