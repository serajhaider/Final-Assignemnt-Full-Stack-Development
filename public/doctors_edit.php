<?php
require "../includes/auth.php";
require "../config/db.php";
include "../includes/header.php";

$id = (int)($_GET["id"] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM doctors WHERE doctor_id = ?");
$stmt->execute([$id]);
$doctor = $stmt->fetch();

if (!$doctor) {
    echo "<p class='error'>Doctor not found.</p>";
    include "../includes/footer.php";
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST["full_name"] ?? "");
    $specialization = trim($_POST["specialization"] ?? "");

    if ($full_name === "" || $specialization === "") {
        $error = "All fields are required.";
    } else {
        try {
            $up = $pdo->prepare(
                "UPDATE doctors SET full_name = ?, specialization = ? WHERE doctor_id = ?"
            );
            $up->execute([$full_name, $specialization, $id]);
            header("Location: doctors_list.php");
            exit;
        } catch (Exception $e) {
            $error = "Failed to update doctor. Please try again.";
        }
    }
}
?>

<h2 class="page-title">Edit Doctor</h2>

<?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" class="form-card">
    <label>Full Name</label>
    <input name="full_name" value="<?= htmlspecialchars($doctor["full_name"]) ?>" required>

    <label>Specialization</label>
    <input name="specialization" value="<?= htmlspecialchars($doctor["specialization"]) ?>" required>

    <button type="submit">Update</button>
</form>

<?php include "../includes/footer.php"; ?>
