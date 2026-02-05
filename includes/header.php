<!-- <!DOCTYPE html>
<html>
<head>
    <title>Clinic Appointment System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<nav>
    <a href="index.php">Home</a> |
    <a href="patients_list.php">Patients</a> |
    <a href="doctors_list.php">Doctors</a> |
    <a href="appointments_list.php">Appointments</a> |
    <a href="search.php">Search</a> |
    <a href="logout.php">Logout</a>
</nav>

<hr> -->


<?php require_once "../config/config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Clinic Appointment System</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
</head>
<body>

<nav>
    <a href="<?= BASE_URL ?>public/index.php">Home</a> |
    <a href="<?= BASE_URL ?>public/patients_list.php">Patients</a> |
    <a href="<?= BASE_URL ?>public/doctors_list.php">Doctors</a> |
    <a href="<?= BASE_URL ?>public/appointments_list.php">Appointments</a> |
    <a href="<?= BASE_URL ?>public/search.php">Search</a> |
    <a href="<?= BASE_URL ?>public/logout.php">Logout</a>
</nav>

<hr>
