<?php
require_once "../dbconnect.php";

$id = intval($_POST['id_pracownika']);

// dane osobowe
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$pesel = $_POST['pesel'];
$telefon = $_POST['telefon'];
$email = $_POST['email'];
$login = $_POST['login'];

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
$dni_urlopowe = intval($_POST['dni_urlopowe']);

$conn->begin_transaction();

try {
    // aktualizacja danych osobowych
    $stmt1 = $conn->prepare("UPDATE dane_personalne_pracownika SET imie=?, nazwisko=?, pesel=?, telefon=?, email=?, login=? WHERE id_pracownika=?");
    $stmt1->bind_param("ssssssi", $imie, $nazwisko, $pesel, $telefon, $email, $login, $id);
    if (!$stmt1->execute()) throw new Exception($stmt1->error);

    // aktualizacja adresu
    $stmt2 = $conn->prepare("UPDATE adres_zamieszkania SET miejscowosc=?, ulica=?, numer_mieszkania=?, kod_pocztowy=? WHERE id_pracownika=?");
    $stmt2->bind_param("ssssi", $miejscowosc, $ulica, $numer_mieszkania, $kod_pocztowy, $id);
    if (!$stmt2->execute()) throw new Exception($stmt2->error);

    // aktualizacja danych roboczych
    $stmt3 = $conn->prepare("UPDATE dane_robocze_pracownika SET stanowisko=?, rodzaj_umowy=?, data_podpisania_umowy=?, data_rozpoczecia_umowy=?, data_zakonczenia_umowy=?, dni_urlopowe=? WHERE id_pracownika=?");
    $stmt3->bind_param("ssssssi", $stanowisko, $rodzaj_umowy, $data_podpisania, $data_rozpoczecia, $data_zakonczenia, $dni_urlopowe, $id);
    if (!$stmt3->execute()) throw new Exception($stmt3->error);

    $conn->commit();
    header("Location: lista_pracownikow.php?status=edycja_ok");
    exit();

} catch (Exception $e) {
    $conn->rollback();
    header("Location: lista_pracownikow.php?status=blad_bazy");
    exit();
}
?>
