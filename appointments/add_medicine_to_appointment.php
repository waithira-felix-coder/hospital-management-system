<?php
include("../config.php");

$appointment_id = $_POST['appointment_id'];
$medicine_id = $_POST['medicine_id'];
$quantity = $_POST['quantity'];

// Check stock
$med = $conn->query("SELECT * FROM medicines WHERE medicine_id = $medicine_id")->fetch_assoc();
if ($med['quantity'] < $quantity) {
    echo "Insufficient stock. Available: " . $med['quantity'];
    exit;
}

// Insert into appointment_medications
$sql = "INSERT INTO appointment_medications (appointment_id, medicine_id, quantity) VALUES ($appointment_id, $medicine_id, $quantity)";
if ($conn->query($sql)) {
    // Deduct from stock
    $conn->query("UPDATE medicines SET quantity = quantity - $quantity WHERE medicine_id = $medicine_id");
    header("Location: edit_appointment.php?id=$appointment_id");
} else {
    echo "Error: " . $conn->error;
}
?>