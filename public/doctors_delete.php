<?php
require_once __DIR__ . "/../includes/auth.php";
require_once __DIR__ . "/../config/db.php";

$id = (int)($_GET["id"] ?? 0);

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM doctors WHERE doctor_id = ?");
        $stmt->execute([$id]);
    } catch (Exception $e) {
        // Keep silent for users; database constraints may block deletion
    }
}

header("Location: doctors_list.php");
exit;
