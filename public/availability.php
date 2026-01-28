<?php
require_once __DIR__ . "/../includes/auth.php";
require_once __DIR__ . "/../config/db.php";

header("Content-Type: application/json");

$doctor_id = (int)($_GET["doctor_id"] ?? 0);
$date      = $_GET["date"] ?? "";
$start     = $_GET["start_time"] ?? "";
$end       = $_GET["end_time"] ?? "";

if (!$doctor_id || !$date || !$start || !$end) {
    echo json_encode([
        "available" => false,
        "message"   => "Select doctor, date, start time and end time"
    ]);
    exit;
}

/*
  Same overlap logic as save:
  conflict if same doctor + same date AND
  NOT (existing ends <= new start OR existing starts >= new end)
*/
$check = $pdo->prepare("
    SELECT COUNT(*) AS c
    FROM appointments
    WHERE doctor_id = ?
      AND appointment_date = ?
      AND NOT (end_time <= ? OR start_time >= ?)
");
$check->execute([$doctor_id, $date, $start, $end]);

$conflict = (int)$check->fetch()["c"];

if ($conflict > 0) {
    echo json_encode([
        "available" => false,
        "message"   => "Not available (already booked)"
    ]);
} else {
    echo json_encode([
        "available" => true,
        "message"   => "Available"
    ]);
}
