<?php
require "../includes/auth.php";
require "../config/db.php";
include "../includes/header.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST["full_name"] ?? "");
    $specialization = trim($_POST["specialization"] ?? "");

    if ($full_name === "" || $specialization === "") {
        $error = "All fields are required.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO doctors (full_name, specialization) VALUES (?, ?)");
            $stmt->execute([$full_name, $specialization]);
            header("Location: doctors_list.php");
            exit;
        } catch (Exception $e) {
            $error = "Failed to add doctor. Please try again.";
        }
    }
}
?>

<h2 class="page-title">Add Doctor</h2>

<?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" class="form-card">
    <label>Full Name</label>
    <input name="full_name" required>

    <label>Specialization</label>
    <input name="specialization" required>

    <button type="submit">Save</button>
</form>

<?php include "../includes/footer.php"; ?>
