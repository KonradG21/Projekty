<?php
session_start();
require_once '../dbconnect.php';

if (!isset($_SESSION['id_pracownika']) || $_SESSION['stanowisko'] !== 'kierownik') {
    header("Location: ../login.php");
    exit();
}

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

$id_pracownika = $_SESSION['id_pracownika'];

// Dane personalne
$sql_personal = "SELECT p.imie, p.nazwisko, p.pesel, a.miejscowosc, a.ulica, a.numer_mieszkania, a.kod_pocztowy, p.telefon, p.email
FROM dane_personalne_pracownika p
JOIN adres_zamieszkania a ON p.id_pracownika = a.id_pracownika
WHERE p.id_pracownika = ?";
$stmt_personal = $conn->prepare($sql_personal);
$stmt_personal->bind_param("i", $id_pracownika);
$stmt_personal->execute();
$result_personal = $stmt_personal->get_result();
$personal_data = $result_personal->fetch_assoc();

// Wypłaty
$sql_wages = "SELECT wyplata_netto, wyplata_brutto, data_transakcji FROM wypłaty WHERE id_pracownika = ?";
$stmt_wages = $conn->prepare($sql_wages);
$stmt_wages->bind_param("i", $id_pracownika);
$stmt_wages->execute();
$result_wages = $stmt_wages->get_result();


// Szkolenia
$sql_trainings = "SELECT nazwa_szkolenia, data_ukonczenia FROM szkolenia WHERE id_pracownika = ? ORDER BY data_ukonczenia DESC;";
$stmt_trainings = $conn->prepare($sql_trainings);
$stmt_trainings->bind_param("i", $id_pracownika);
$stmt_trainings->execute();
$result_trainings = $stmt_trainings->get_result();

// Dane robocze
$sql_work_data = "SELECT stanowisko, rodzaj_umowy, data_podpisania_umowy, data_rozpoczecia_umowy, data_zakonczenia_umowy, dni_urlopowe, pozostaly_urlop FROM dane_robocze_pracownika WHERE id_pracownika = ?";
$stmt_work_data = $conn->prepare($sql_work_data);
$stmt_work_data->bind_param("i", $id_pracownika);
$stmt_work_data->execute();
$result_work_data = $stmt_work_data->get_result();
$work_data = $result_work_data->fetch_assoc();

// Dane innych pracowników
$sql_other_employees = "
    SELECT dp.id_pracownika, dp.imie, dp.nazwisko 
    FROM dane_personalne_pracownika dp
    JOIN dane_robocze_pracownika dr ON dp.id_pracownika = dr.id_pracownika
    WHERE dr.stanowisko = 'pracownik'";
$result_other_employees = $conn->query($sql_other_employees);

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Kierownika</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="flex-container">
    <!-- dane personalne -->
    <div class="flex-box">
        <h3>Dane personalne</h3>
        <p><strong>Imię:</strong> <?php echo htmlspecialchars($personal_data['imie']); ?></p>
        <p><strong>Nazwisko:</strong> <?php echo htmlspecialchars($personal_data['nazwisko']); ?></p>
        <p><strong>PESEL:</strong> <?php echo htmlspecialchars($personal_data['pesel']); ?></p>
        <p><strong>Adres:</strong> <?php echo htmlspecialchars($personal_data['miejscowosc'] . " " .$personal_data['kod_pocztowy'] . ", " .$personal_data['ulica'] . " " .$personal_data['numer_mieszkania']);?></p>
        <p><strong>Telefon:</strong> <?php echo htmlspecialchars($personal_data['telefon']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($personal_data['email']); ?></p>
    </div>
    <!-- pętla while żeby wyświetlić wszystkie wypłaty -->
    <div class="flex-box"> 
        <h3>Wypłaty</h3>
        <?php if ($result_wages->num_rows > 0) {
    echo "<li>";
    while ($row = $result_wages->fetch_assoc()) {
        echo "<p><strong>Data:</strong> " . htmlspecialchars($row['data_transakcji']) . 
             "<br> <strong>Netto:</strong> " . htmlspecialchars($row['wyplata_netto']) . " PLN" . 
             "<br> <strong>Brutto:</strong> " . htmlspecialchars($row['wyplata_brutto']) . " PLN</p>";
    }
} else {
    echo "<p>Brak danych o wypłatach.</p>";
}
?>
    </div>
    <!-- pętla while żeby wyświetlić wszystkie szkolenia -->
    <div class="flex-box">
        <h3>Szkolenia</h3>
        <?php if ($result_trainings->num_rows > 0) {
            echo "<li>";
    while ($row = $result_trainings->fetch_assoc()) {
        echo "<p><strong>Nazwa:</strong> " . htmlspecialchars($row['nazwa_szkolenia']) . 
             "<br> <strong>Data ukończenia:</strong> " . htmlspecialchars($row['data_ukonczenia']) . "</p>" ;
    }
} else {
    echo "Brak szkoleń.";}?>
    </div>
    <!-- dane robocze -->
    <div class="flex-box">
        <h3>Dane robocze</h3>
        <p><strong>Stanowisko:</strong> <?php echo ucfirst(htmlspecialchars($work_data['stanowisko'])); ?></p>
        <p><strong>Rodzaj umowy:</strong> <?php echo htmlspecialchars($work_data['rodzaj_umowy']); ?></p>
        <p><strong>Data podpisania umowy:</strong> <?php echo date('d-m-Y', strtotime($work_data['data_podpisania_umowy'])); ?></p>
        <p><strong>Data rozpoczęcia umowy:</strong> <?php echo date('d-m-Y', strtotime($work_data['data_rozpoczecia_umowy'])); ?></p>
        <p><strong>Data zakonczenia_umowy:</strong> <?php echo date('d-m-Y', strtotime($work_data['data_zakonczenia_umowy'])); ?></p>
        <p><strong>Dni urlopowe:</strong> <?php echo $work_data['dni_urlopowe']; ?></p>
        <p><strong>Pozostałe dni urlopowe:</strong> <?php echo $work_data['pozostaly_urlop']; ?></p>
        <br>
        <button><a href="../zwolnienia_pracownikow.php" class="btn"><h4>Podgląd zwolnienia lekarskich pracowników</a></h4></button>
    </div>
    <!-- kalendarz urlopowy -->
    <div class="flex-box">
        <h3>Kalendarz urlopowy</h3>
        <h4>Dodaj urlop</h4>
                <form method="POST" action="../dodaj_urlop.php" >
                    <label for="data_od">Od:</label>
                    <input type="date" name="data_od" required>
                    <label for="data_do">Do:</label>
                    <input type="date" name="data_do" required>
                    <button type="submit">Zapisz urlop</button>
                </form>

                <h4>Twoje zaplanowane urlopy:</h4>
                <table border="1" cellpadding="8">
                    <tr>
                        <th>Od</th>
                        <th>Do</th>
                    </tr>
                    <!-- stmt żeby pobrać wpisane urlopy -->
                    <?php
                    $stmt = $conn->prepare("SELECT data_od, data_do FROM dni_urlopowe WHERE id_pracownika = ? ORDER BY data_od");
                    $stmt->bind_param("i", $_SESSION['id_pracownika']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($row['data_od']) ?></td>
                            <td><?= htmlspecialchars($row['data_do']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
                <br>
                <button><a href="../urlopy_pracownikow.php" class="btn"><h4>Podgląd urlopów pracowników</a></h4></button>
    </div>
</div>
<script src="../../js/scriptDOM.js"></script>
    <script>
        function showEmployeeDetails(employeeId) {
            if (employeeId === "") {
                document.getElementById("employeeDetails").innerHTML = "";
                return;
            }
            // skrypt ajax żeby pobrać dane pracowników
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../get_employee_details.php?id=" + employeeId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("employeeDetails").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
<a href="../logout.php" class="logout">Wyloguj się</a>
<?php $conn->close();?>
<script src="../../js/scriptDOM.js"></script>
<?php if (isset($_GET['status'])): ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const status = "<?= htmlspecialchars($_GET['status']) ?>";

        if (status === "sukces") {
            alert("Urlop został zapisany pomyślnie.");
        } else if (status === "za_malo_dni") {
            alert("Masz za mało dostępnych dni urlopowych.");
        } else if (status === "blad_data") {
            alert("Data początkowa nie może być po dacie końcowej.");
        } else if (status === "blad_transakcji") {
            alert("Wystąpił błąd podczas zapisu urlopu.");
        } else if (status === "blad") {
            alert("Nieprawidłowe dane formularza.");
        }

        //usuwanie statusu z adresu URL po pokazaniu alertu
        if (window.history.replaceState) {
            const url = window.location.protocol + "//" + window.location.host + window.location.pathname;
            window.history.replaceState({}, document.title, url);
        }
    });
</script>
<?php endif; ?>
</body>
</html>