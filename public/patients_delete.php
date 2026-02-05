<?php
require "../includes/auth.php";
require "../config/db.php";

$id = (int)($_GET["id"] ?? 0);

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM patients WHERE patient_id = ?");
        $stmt->execute([$id]);
    } catch (Exception $e) {
        
    }
}

header("Location: patients_list.php");
exit;
