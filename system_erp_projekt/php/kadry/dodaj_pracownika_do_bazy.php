<?php
require_once "../dbconnect.php";

// dane personalne
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$pesel = $_POST['pesel'];
$telefon = $_POST['telefon'];
$email = $_POST['email'];
$login = $_POST['login'];
$haslo = md5($_POST['haslo']);

// adres
$miejscowosc = $_POST['miejscowosc'];
$ulica = $_POST['ulica'];
$numer_mieszkania = $_POST['numer_mieszkania'];
$kod_pocztowy = $_POST['kod_pocztowy'];

// dane robocze
$stanowisko = $_POST['stanowisko'];
$rodzaj_umowy = $_POST['rodzaj_umowy'];
$data_podpisania = $_POST['data_podpisania_umowy'];
$data_rozpoczecia = $_POST['data_rozpoczecia_umowy'];
$data_zakonczenia = $_POST['data_zakonczenia_umowy'];
$dni_urlopowe = $_POST['dni_urlopowe'];

// walidacja dat
if ($data_rozpoczecia < $data_podpisania) {
    header("Location: lista_pracownikow.php?status=blad_data_rozpoczecia");
    exit();
}
if ($data_zakonczenia < $data_rozpoczecia || $data_zakonczenia < $data_podpisania) {
    header("Location: lista_pracownikow.php?status=blad_data_zakonczenia");
    exit();
}

$conn->begin_transaction();

try {
    // dane_personalne_pracownika
    $stmtpersonalne = $conn->prepare("INSERT INTO dane_personalne_pracownika (imie, nazwisko, pesel, telefon, email, login, haslo) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmtpersonalne->bind_param("sssssss", $imie, $nazwisko, $pesel, $telefon, $email, $login, $haslo);
    $stmtpersonalne->execute();
    $id_pracownika = $conn->insert_id;

    // adres_zamieszkania
    $stmtadres = $conn->prepare("INSERT INTO adres_zamieszkania (id_pracownika, miejscowosc, ulica, numer_mieszkania, kod_pocztowy) VALUES (?, ?, ?, ?, ?)");
    $stmtadres->bind_param("issss", $id_pracownika, $miejscowosc, $ulica, $numer_mieszkania, $kod_pocztowy);
    $stmtadres->execute();

    // dane_robocze_pracownika
    $stmtrobocze = $conn->prepare("INSERT INTO dane_robocze_pracownika (id_pracownika, stanowisko, rodzaj_umowy, data_podpisania_umowy, data_rozpoczecia_umowy, data_zakonczenia_umowy, dni_urlopowe, pozostaly_urlop) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmtrobocze->bind_param("isssssii", $id_pracownika, $stanowisko, $rodzaj_umowy, $data_podpisania, $data_rozpoczecia, $data_zakonczenia, $dni_urlopowe, $dni_urlopowe);
    $stmtrobocze->execute();

    $conn->commit();
    header("Location: lista_pracownikow.php?status=pracownik_dodany");
    exit();
} catch (Exception $e) {
    $conn->rollback();
    header("Location: lista_pracownikow.php?status=blad_bazy");
    exit();
}
?>
