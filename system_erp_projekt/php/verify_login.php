<?php
session_start();
require_once 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = md5($_POST['haslo']); // hashowanie MD5

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Błąd połączenia: " . $conn->connect_error);
    }

    $sql = "SELECT p.id_pracownika, p.haslo, d.stanowisko 
            FROM dane_personalne_pracownika p
            JOIN dane_robocze_pracownika d ON p.id_pracownika = d.id_pracownika
            WHERE p.login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if ($password === $user['haslo']) {
            $_SESSION['id_pracownika'] = $user['id_pracownika'];
            $_SESSION['stanowisko'] = $user['stanowisko'];

            switch ($user['stanowisko']) {
                case 'pracownik':
                    header("Location: uzytkownicy/pracownik.php");
                    break;
                case 'kierownik':
                    header("Location: uzytkownicy/kierownik.php");
                    break;
                case 'prezes':
                    header("Location: uzytkownicy/prezes.php");
                    break;
                case 'HR':
                    header("Location: uzytkownicy/HR.php");
                    break;
                default:
                    $_SESSION['error'] = "Nieznane stanowisko!";
                    header("Location: login.php");
                    break;
            }
            exit();
        } else {
            $_SESSION['error'] = "Nieprawidłowe hasło!";
        }
    } else {
        $_SESSION['error'] = "Nie znaleziono użytkownika!";
    }

    $stmt->close();
    $conn->close();
    header("Location: login.php");
    exit();
}
?>
