<?php
require_once __DIR__ . "/../includes/auth.php";
require_once __DIR__ . "/../config/db.php";
include_once __DIR__ . "/../includes/header.php";

$id = (int)($_GET["id"] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM appointments WHERE appointment_id = ?");
$stmt->execute([$id]);
$appt = $stmt->fetch();

if (!$appt) {
    echo "<p class='error'>Appointment not found.</p>";
    include_once __DIR__ . "/../includes/footer.php";
    exit;
}

$patients = $pdo->query("SELECT patient_id, full_name FROM patients ORDER BY full_name")->fetchAll();
$doctors  = $pdo->query("SELECT doctor_id, full_name FROM doctors ORDER BY full_name")->fetchAll();
?>

<h2 class="page-title">Edit Appointment</h2>

<form method="post" action="appointments_save.php" class="form-card">
    <input type="hidden" name="appointment_id" value="<?= (int)$appt["appointment_id"] ?>">

    <label>Patient</label>
    <select name="patient_id" required>
        <?php foreach ($patients as $p): ?>
            <option value="<?= (int)$p["patient_id"] ?>"
                <?= ((int)$p["patient_id"] === (int)$appt["patient_id"]) ? "selected" : "" ?>>
                <?= htmlspecialchars($p["full_name"]) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Doctor</label>
    <select id="doctor_id" name="doctor_id" required>
        <?php foreach ($doctors as $d): ?>
            <option value="<?= (int)$d["doctor_id"] ?>"
                <?= ((int)$d["doctor_id"] === (int)$appt["doctor_id"]) ? "selected" : "" ?>>
                <?= htmlspecialchars($d["full_name"]) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Date</label>
    <input id="appointment_date" type="date" name="appointment_date"
           value="<?= htmlspecialchars($appt["appointment_date"]) ?>" required>

    <label>Start Time</label>
    <input id="start_time" type="time" name="start_time"
           value="<?= htmlspecialchars($appt["start_time"]) ?>" required>

    <label>End Time</label>
    <input id="end_time" type="time" name="end_time"
           value="<?= htmlspecialchars($appt["end_time"]) ?>" required>

    <div id="availability" class="availability-box"></div>

    <button type="submit">Update</button>
</form>

<script src="../assets/js/availability.js"></script>

<?php include_once __DIR__ . "/../includes/footer.php"; ?>
