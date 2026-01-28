<?php
require_once __DIR__ . "/../includes/auth.php";
require_once __DIR__ . "/../config/db.php";
include_once __DIR__ . "/../includes/header.php";

$sql = "
    SELECT 
        a.appointment_id,
        a.appointment_date,
        a.start_time,
        a.end_time,
        p.full_name AS patient_name,
        d.full_name AS doctor_name
    FROM appointments a
    JOIN patients p ON a.patient_id = p.patient_id
    JOIN doctors d ON a.doctor_id = d.doctor_id
    ORDER BY a.appointment_date DESC, a.start_time ASC
";

$appointments = $pdo->query($sql)->fetchAll();
?>

<h2 class="page-title">Appointments</h2>

<p class="action-link">
    <a href="appointments_add.php">Add Appointment</a>
</p>

<table class="data-table">
    <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Patient</th>
        <th>Doctor</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($appointments as $a): ?>
    <tr>
        <td><?= htmlspecialchars($a["appointment_date"]) ?></td>
        <td><?= htmlspecialchars($a["start_time"]) ?> - <?= htmlspecialchars($a["end_time"]) ?></td>
        <td><?= htmlspecialchars($a["patient_name"]) ?></td>
        <td><?= htmlspecialchars($a["doctor_name"]) ?></td>
        <td>
            <a href="appointments_edit.php?id=<?= (int)$a["appointment_id"] ?>">Edit</a> |
            <a href="appointments_delete.php?id=<?= (int)$a["appointment_id"] ?>"
               onclick="return confirm('Delete this appointment?');">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include_once __DIR__ . "/../includes/footer.php"; ?>
