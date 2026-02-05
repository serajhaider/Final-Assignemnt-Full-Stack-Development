<?php
require "../includes/auth.php";
require "../config/db.php";
include "../includes/header.php";

$id = (int)($_GET["id"] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM patients WHERE patient_id = ?");
$stmt->execute([$id]);
$patient = $stmt->fetch();

if (!$patient) {
    echo "<p class='error'>Patient not found.</p>";
    include "../includes/footer.php";
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST["full_name"] ?? "");
    $email     = trim($_POST["email"] ?? "");

    if ($full_name === "" || $email === "") {
        $error = "All fields are required.";
    } else {
        try {
            $up = $pdo->prepare("UPDATE patients SET full_name = ?, email = ? WHERE patient_id = ?");
            $up->execute([$full_name, $email, $id]);
            header("Location: patients_list.php");
            exit;
        } catch (Exception $e) {
            $error = "Failed to update patient. Please try again.";
        }
    }
}
?>

<h2 class="page-title">Edit Patient</h2>

<?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" class="form-card">
    <label>Full Name</label>
    <input name="full_name" value="<?= htmlspecialchars($patient["full_name"]) ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($patient["email"]) ?>" required>

    <button type="submit">Update</button>
</form>

<?php include "../includes/footer.php"; ?>
