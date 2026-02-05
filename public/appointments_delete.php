<?php
require "../includes/auth.php";
require "../config/db.php";


$id = (int)($_GET["id"] ?? 0);

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM appointments WHERE appointment_id = ?");
        $stmt->execute([$id]);
    } catch (Exception $e) {
        // If deletion is blocked by constraints, fail silently for user
    }
}

header("Location: appointments_list.php");
exit;
