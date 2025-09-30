<?php
require_once "../dbconnect.php";

if (isset($_POST['id_pracownika'], $_POST['data_od'], $_POST['data_do'])) {
    $id = intval($_POST['id_pracownika']);
    $data_od = $_POST['data_od'];
    $data_do = $_POST['data_do'];

    if ($data_od > $data_do) {
        header("Location: lista_urlopy.php?status=blad_data");
        exit();
    }

    // obliczanie dni robocze
    $start = new DateTime($data_od);
    $end = new DateTime($data_do);
    $interval = DateInterval::createFromDateString('1 day');
    $period = new DatePeriod($start, $interval, $end->modify('+1 day'));

    $dni_robocze = 0;
    foreach ($period as $day) {
        if (!in_array($day->format('N'), [6, 7])) {
            $dni_robocze++;
        }
    }

    // sprawdzanie pozostały urlop
    $stmt_check = $conn->prepare("SELECT pozostaly_urlop FROM dane_robocze_pracownika WHERE id_pracownika = ?");
    $stmt_check->bind_param("i", $id);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: lista_urlopy.php?status=brak_pracownika");
        exit();
    }

    if ($row['pozostaly_urlop'] < $dni_robocze) {
        header("Location: lista_urlopy.php?status=brak_dni");
        exit();
    }

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("INSERT INTO dni_urlopowe (id_pracownika, data_od, data_do, dni_robocze) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $id, $data_od, $data_do, $dni_robocze);
        $stmt->execute();

        $stmt2 = $conn->prepare("UPDATE dane_robocze_pracownika SET pozostaly_urlop = pozostaly_urlop - ? WHERE id_pracownika = ?");
        $stmt2->bind_param("ii", $dni_robocze, $id);
        $stmt2->execute();

        $conn->commit();
        header("Location: lista_urlopy.php?status=urlop_dodany");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        header("Location: lista_urlopy.php?status=blad_bazy");
        exit();
    }
} else {
    header("Location: lista_urlopy.php?status=blad_formularza");
    exit();
}
?>
