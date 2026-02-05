<?php
require "../includes/auth.php";
require "../config/db.php";
include "../includes/header.php";

$stmt = $pdo->query("SELECT * FROM patients ORDER BY patient_id DESC");
$patients = $stmt->fetchAll();
?>

<h2 class="page-title">Patients</h2>

<p class="action-link">
    <a href="patients_add.php">Add Patient</a>
</p>

<table class="data-table">
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($patients as $p): ?>
    <tr>
        <td><?= (int)$p["patient_id"] ?></td>
        <td><?= htmlspecialchars($p["full_name"]) ?></td>
        <td><?= htmlspecialchars($p["email"]) ?></td>
        <td>
            <a href="patients_edit.php?id=<?= (int)$p["patient_id"] ?>">Edit</a> |
            <a href="patients_delete.php?id=<?= (int)$p["patient_id"] ?>"
               onclick="return confirm('Delete this patient?');">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include "../includes/footer.php"; ?>
