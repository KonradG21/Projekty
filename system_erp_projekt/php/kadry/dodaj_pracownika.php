<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj pracownika</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="lista">
<h2>Dodaj pracownika</h2>
    <form action="dodaj_pracownika_do_bazy.php" method="post">
        <!-- dane personalne -->
        <input type="text" name="imie" placeholder="Imię" required>
        <input type="text" name="nazwisko" placeholder="Nazwisko" required>
        <input type="text" name="pesel" placeholder="PESEL" required>
        <input type="text" name="telefon" placeholder="Telefon" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="login" placeholder="Login" required>
        <input type="password" name="haslo" placeholder="Hasło" required>
        <!-- adres -->
        <input type="text" name="miejscowosc" placeholder="Miejscowość" required>
        <input type="text" name="ulica" placeholder="Ulica" required>
        <input type="text" name="numer_mieszkania" placeholder="Nr mieszkania" required>
        <input type="text" name="kod_pocztowy" placeholder="Kod pocztowy" required>
        <br>
        <!-- dane robocze -->
        <select name="stanowisko" required>
            <option value="pracownik">Pracownik</option>
            <option value="kierownik">Kierownik</option>
            <option value="prezes">Prezes</option>
            <option value="HR">HR</option>
        </select>
        <br>   
        <select name="rodzaj_umowy" required>
            <option value="umowa o pracę">Umowa o pracę</option>
            <option value="umowa zlecenie">Umowa zlecenie</option>
            <option value="umowa o dzieło">Umowa o dzieło</option>
        </select>
        <label for="data_podpisania_umowy">Data podpisania umowy
            <input type="date" name="data_podpisania_umowy" required>
        </label>
        <label for="data_rozpoczecia_umowy">Data rozpoczęcia umowy
            <input type="date" name="data_rozpoczecia_umowy" required>
        </label>
        <label for="data_zakonczenia_umowy">Data zakończenia umowy
            <input type="date" name="data_zakonczenia_umowy" required>
        </label>
        <input type="number" name="dni_urlopowe" placeholder="Dni urlopowe" required>
    
        <button type="submit">Dodaj pracownika</button>
    </form>
</div>
<a href="../logout.php" class="logout">Wyloguj się</a>
<a href="../uzytkownicy/HR.php" class="panel_kadrowy">Powrót do panela pracownika</a>
<a href="panel_kadrowy.php" class="panel_kadrowy_powrot">Powrót do panela kadrowego</a>
</body>
</html>
