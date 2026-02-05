<?php
require "../includes/auth.php";
require "../config/db.php";

$appointment_id   = (int)($_POST["appointment_id"] ?? 0);
$patient_id       = (int)($_POST["patient_id"] ?? 0);
$doctor_id        = (int)($_POST["doctor_id"] ?? 0);
$appointment_date = $_POST["appointment_date"] ?? "";
$start_time       = $_POST["start_time"] ?? "";
$end_time         = $_POST["end_time"] ?? "";

if (!$patient_id || !$doctor_id || !$appointment_date || !$start_time || !$end_time) {
    die("Missing required fields.");
}

if ($end_time <= $start_time) {
    die("End time must be after start time.");
}

/*
  Overlap rule:
  A conflict exists if:
  same doctor + same date AND
  NOT (existing ends <= new start OR existing starts >= new end)
*/
$check = $pdo->prepare("
    SELECT COUNT(*) AS c
    FROM appointments
    WHERE doctor_id = ?
      AND appointment_date = ?
      AND NOT (end_time <= ? OR start_time >= ?)
      AND (? = 0 OR appointment_id != ?)
");
$check->execute([
    $doctor_id,
    $appointment_date,
    $start_time,
    $end_time,
    $appointment_id,
    $appointment_id
]);

$conflict = (int)$check->fetch()["c"];

if ($conflict > 0) {
    echo "<p class='error'>This time slot is already booked for the selected doctor.</p>";
    echo "<p><a href='appointments_list.php'>Back to Appointments</a></p>";
    exit;
}

if ($appointment_id > 0) {
    // Update
    $stmt = $pdo->prepare("
        UPDATE appointments
        SET patient_id = ?, doctor_id = ?, appointment_date = ?, start_time = ?, end_time = ?
        WHERE appointment_id = ?
    ");
    $stmt->execute([
        $patient_id,
        $doctor_id,
        $appointment_date,
        $start_time,
        $end_time,
        $appointment_id
    ]);
} else {
    // Insert
    $stmt = $pdo->prepare("
        INSERT INTO appointments (patient_id, doctor_id, appointment_date, start_time, end_time)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $patient_id,
        $doctor_id,
        $appointment_date,
        $start_time,
        $end_time
    ]);
}

header("Location: appointments_list.php");
exit;
