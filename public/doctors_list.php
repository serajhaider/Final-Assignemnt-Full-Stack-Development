<?php
require "../includes/auth.php";
require "../config/db.php";
include "../includes/header.php";

$stmt = $pdo->query("SELECT * FROM doctors ORDER BY doctor_id DESC");
$doctors = $stmt->fetchAll();
?>

<h2 class="page-title">Doctors</h2>

<p class="action-link">
    <a href="doctors_add.php">Add Doctor</a>
</p>

<table class="data-table">
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Specialization</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($doctors as $d): ?>
    <tr>
        <td><?= (int)$d["doctor_id"] ?></td>
        <td><?= htmlspecialchars($d["full_name"]) ?></td>
        <td><?= htmlspecialchars($d["specialization"]) ?></td>
        <td>
            <a href="doctors_edit.php?id=<?= (int)$d["doctor_id"] ?>">Edit</a> |
            <a href="doctors_delete.php?id=<?= (int)$d["doctor_id"] ?>"
               onclick="return confirm('Delete this doctor?');">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include "../includes/footer.php"; ?>
