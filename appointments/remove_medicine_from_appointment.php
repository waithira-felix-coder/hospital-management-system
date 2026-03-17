<?php
include("../config.php");

$am_id = $_GET['am_id'];
$appt_id = $_GET['appt_id'];

// Get the quantity
$am = $conn->query("SELECT * FROM appointment_medications WHERE id = $am_id")->fetch_assoc();
$quantity = $am['quantity'];
$medicine_id = $am['medicine_id'];

// Delete from appointment_medications
$conn->query("DELETE FROM appointment_medications WHERE id = $am_id");

// Add back to stock
$conn->query("UPDATE medicines SET quantity = quantity + $quantity WHERE medicine_id = $medicine_id");

header("Location: edit_appointment.php?id=$appt_id");
?>