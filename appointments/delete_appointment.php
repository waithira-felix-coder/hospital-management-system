<?php
include("../config.php");

$id = $_GET['id'];
$conn->query("DELETE FROM appointments WHERE appointment_id=$id");

header("Location: view_appointments.php");
?>
