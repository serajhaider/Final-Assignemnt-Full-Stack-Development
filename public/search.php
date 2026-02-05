<?php
require "../includes/auth.php";
require "../config/db.php";
include "../includes/header.php";
?>

<h2 class="page-title">Search Appointments</h2>

<form method="get" class="form-card">
    <label>Search by Date</label>
    <input type="date" name="date">
    <button type="submit">Search</button>
</form>

<?php
if (isset($_GET["date"]) && $_GET["date"] !== "") {
    $date = $_GET["date"];

    $stmt = $pdo->prepare("
        SELECT 
            a.appointment_date,
            a.start_time,
            a.end_time,
            p.full_name AS patient_name,
            d.full_name AS doctor_name
        FROM appointments a
        JOIN patients p ON a.patient_id = p.patient_id
        JOIN doctors d ON a.doctor_id = d.doctor_id
        WHERE a.appointment_date = ?
        ORDER BY a.start_time
    ");
    $stmt->execute([$date]);
    $rows = $stmt->fetchAll();

    if ($rows):
?>

<table class="data-table">
    <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Patient</th>
        <th>Doctor</th>
    </tr>
    <?php foreach ($rows as $r): ?>
    <tr>
        <td><?= htmlspecialchars($r["appointment_date"]) ?></td>
        <td><?= htmlspecialchars($r["start_time"]) ?> - <?= htmlspecialchars($r["end_time"]) ?></td>
        <td><?= htmlspecialchars($r["patient_name"]) ?></td>
        <td><?= htmlspecialchars($r["doctor_name"]) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php
    else:
        echo "<p class='info'>No appointments found for this date.</p>";
    endif;
}
?>

<?php include "../includes/footer.php"; ?>
