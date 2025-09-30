<?php
session_start();
require_once "dbconnect.php";

if (!isset($_SESSION['id_pracownika'])) {
    header("Location: login.php");
    exit();
}

$id_pracownika = $_SESSION['id_pracownika'];

// Sprawdzenie danych POST
if (!isset($_POST['data_od'], $_POST['data_do'])) {
    $url = strtok($_SERVER['HTTP_REFERER'], '?');
    header("Location: $url?status=blad");
    exit();
}

$data_od = $_POST['data_od'];
$data_do = $_POST['data_do'];

if ($data_od > $data_do) {
    $url = strtok($_SERVER['HTTP_REFERER'], '?');
    header("Location: $url?status=blad_data");
    exit();
}

// Oblicz dni robocze
$start = new DateTime($data_od);
$end = new DateTime($data_do);
$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($start, $interval, $end->modify('+1 day'));

$dni_urlopu = 0;
foreach ($period as $day) {
    if (!in_array($day->format('N'), [6, 7])) { // 6 = sobota, 7 = niedziela
        $dni_urlopu++;
    }
}

// Sprawdź pozostaly_urlop
$stmt_check = $conn->prepare("SELECT pozostaly_urlop FROM dane_robocze_pracownika WHERE id_pracownika = ?");
$stmt_check->bind_param("i", $id_pracownika);
$stmt_check->execute();
$result = $stmt_check->get_result();
$row = $result->fetch_assoc();

if (!$row || $row['pozostaly_urlop'] < $dni_urlopu) {
    $url = strtok($_SERVER['HTTP_REFERER'], '?');
    header("Location: $url?status=za_malo_dni");
    exit();
}

// Transakcja
$conn->begin_transaction();

try {
    $stmt = $conn->prepare("INSERT INTO dni_urlopowe (id_pracownika, data_od, data_do, dni_robocze) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $id_pracownika, $data_od, $data_do, $dni_urlopu);
    $stmt->execute();

    $stmt2 = $conn->prepare("UPDATE dane_robocze_pracownika SET pozostaly_urlop = pozostaly_urlop - ? WHERE id_pracownika = ?");
    $stmt2->bind_param("ii", $dni_urlopu, $id_pracownika);
    $stmt2->execute();

    $conn->commit();
    $url = strtok($_SERVER['HTTP_REFERER'], '?');
    header("Location: $url?status=sukces");
    exit();

} catch (Exception $e) {
    $conn->rollback();
    $url = strtok($_SERVER['HTTP_REFERER'], '?');
    header("Location: $url?status=blad_transakcji");
    exit();
}
