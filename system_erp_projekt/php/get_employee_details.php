<?php
require_once 'dbconnect.php';

if (isset($_GET['id'])) {
    $id_pracownika = $_GET['id'];

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Błąd połączenia: " . $conn->connect_error);
    }

    $sql_personal = "SELECT imie, nazwisko, pesel, adres_zamieszkania, telefon, email FROM dane_personalne_pracownika WHERE id_pracownika = ?";
    $stmt_personal = $conn->prepare($sql_personal);
    $stmt_personal->bind_param("i", $id_pracownika);
    $stmt_personal->execute();
    $result_personal = $stmt_personal->get_result();
    $personal_data = $result_personal->fetch_assoc();

    if ($personal_data) {
        echo "<h4>Imię: " . htmlspecialchars($personal_data['imie']) . "</h4>";
        echo "<p><strong>Nazwisko:</strong> " . htmlspecialchars($personal_data['nazwisko']) . "</p>";
        echo "<p><strong>PESEL:</strong> " . htmlspecialchars($personal_data['pesel']) . "</p>";
        echo "<p><strong>Adres:</strong> " . htmlspecialchars($personal_data['adres_zamieszkania']) . "</p>";
        echo "<p><strong>Telefon:</strong> " . htmlspecialchars($personal_data['telefon']) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($personal_data['email']) . "</p>";
    } else {
        echo "Brak danych dla wybranego pracownika.";
    }

    $conn->close();
}
?>
