<?php
require_once "../dbconnect.php";

$id = intval($_POST['id']);
$data_od = $_POST['data_od'];
$data_do = $_POST['data_do'];

if ($data_od > $data_do) {
    header("Location: lista_urlopy.php?status=blad_data");
    exit();
}

// Oblicz nową liczbę dni roboczych
$start = new DateTime($data_od);
$end = new DateTime($data_do);
$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($start, $interval, $end->modify('+1 day'));

$dni_nowe = 0;
foreach ($period as $day) {
    if (!in_array($day->format('N'), [6, 7])) {
        $dni_nowe++;
    }
}

// Pobierz dane urlopu i ID pracownika
$stmt = $conn->prepare("SELECT id_pracownika, dni_robocze FROM dni_urlopowe WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$dane = $result->fetch_assoc();

if (!$dane) {
    header("Location: lista_urlopy.php?status=nie_znaleziono");
    exit();
}

$id_pracownika = $dane['id_pracownika'];
$dni_stare = $dane['dni_robocze'];
$roznica = $dni_nowe - $dni_stare;

// Pobierz pozostały urlop
$stmt = $conn->prepare("SELECT pozostaly_urlop FROM dane_robocze_pracownika WHERE id_pracownika = ?");
$stmt->bind_param("i", $id_pracownika);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();

if (!$row) {
    header("Location: lista_urlopy.php?status=blad_danych_pracownika");
    exit();
}

$pozostaly = $row['pozostaly_urlop'];

// Sprawdź, czy wystarczy urlopu
if ($pozostaly < $roznica) {
    header("Location: lista_urlopy.php?status=za_malo_dni");
    exit();
}

// Transakcja
$conn->begin_transaction();
try {
    // Aktualizuj urlop
    $stmt1 = $conn->prepare("UPDATE dni_urlopowe SET data_od = ?, data_do = ?, dni_robocze = ? WHERE id = ?");
    $stmt1->bind_param("ssii", $data_od, $data_do, $dni_nowe, $id);
    $stmt1->execute();

    // Zmodyfikuj pozostały urlop
    $stmt2 = $conn->prepare("UPDATE dane_robocze_pracownika SET pozostaly_urlop = pozostaly_urlop - ? WHERE id_pracownika = ?");
    $stmt2->bind_param("ii", $roznica, $id_pracownika);
    $stmt2->execute();

    $conn->commit();
    header("Location: lista_urlopy.php?status=edycja_ok");
    exit();
} catch (Exception $e) {
    $conn->rollback();
    header("Location: lista_urlopy.php?status=blad_bazy");
    exit();
}
