<?php
require_once __DIR__ . "/../includes/auth.php";
require_once __DIR__ . "/../config/db.php";
include_once __DIR__ . "/../includes/header.php";

$patients = $pdo->query("SELECT patient_id, full_name FROM patients ORDER BY full_name")->fetchAll();
$doctors  = $pdo->query("SELECT doctor_id, full_name FROM doctors ORDER BY full_name")->fetchAll();
?>

<h2 class="page-title">Add Appointment</h2>

<form method="post" action="appointments_save.php" class="form-card">
    <label>Patient</label>
    <select name="patient_id" required>
        <option value="">Select patient</option>
        <?php foreach ($patients as $p): ?>
            <option value="<?= (int)$p["patient_id"] ?>">
                <?= htmlspecialchars($p["full_name"]) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Doctor</label>
    <select id="doctor_id" name="doctor_id" required>
        <option value="">Select doctor</option>
        <?php foreach ($doctors as $d): ?>
            <option value="<?= (int)$d["doctor_id"] ?>">
                <?= htmlspecialchars($d["full_name"]) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Date</label>
    <input id="appointment_date" type="date" name="appointment_date" required>

    <label>Start Time</label>
    <input id="start_time" type="time" name="start_time" required>

    <label>End Time</label>
    <input id="end_time" type="time" name="end_time" required>

    <div id="availability" class="availability-box"></div>

    <button type="submit">Save</button>
</form>

<script src="../assets/js/availability.js"></script>

<?php include_once __DIR__ . "/../includes/footer.php"; ?>
