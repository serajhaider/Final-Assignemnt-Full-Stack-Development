<?php
require_once __DIR__ . "/../includes/auth.php";
require_once __DIR__ . "/../config/db.php";

$id = (int)($_GET["id"] ?? 0);

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM patients WHERE patient_id = ?");
        $stmt->execute([$id]);
    } catch (Exception $e) {
        // You can log this if needed; keep silent for users
    }
}

header("Location: patients_list.php");
exit;
