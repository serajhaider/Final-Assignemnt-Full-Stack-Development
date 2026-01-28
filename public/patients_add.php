
<?php
require_once __DIR__ . "/../includes/auth.php";
require_once __DIR__ . "/../config/db.php";
include_once __DIR__ . "/../includes/header.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST["full_name"] ?? "");
    $email     = trim($_POST["email"] ?? "");

    if ($full_name === "" || $email === "") {
        $error = "All fields are required.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO patients (full_name, email) VALUES (?, ?)");
            $stmt->execute([$full_name, $email]);
            header("Location: patients_list.php");
            exit;
        } catch (Exception $e) {
            $error = "Failed to add patient. Please try again.";
        }
    }
}
?>

<h2 class="page-title">Add Patient</h2>

<?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" class="form-card">
    <label>Full Name</label>
    <input name="full_name" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <button type="submit">Save</button>
</form>

<?php include_once __DIR__ . "/../includes/footer.php"; ?>
