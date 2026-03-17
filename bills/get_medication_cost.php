<?php
include("../config.php");

$appt_id = $_GET['appt_id'];
$medication_cost = 0;

$med_sql = "SELECT am.quantity, m.price FROM appointment_medications am JOIN medicines m ON am.medicine_id = m.medicine_id WHERE am.appointment_id = $appt_id";
$med_result = $conn->query($med_sql);
while ($row = $med_result->fetch_assoc()) {
    $medication_cost += $row['quantity'] * $row['price'];
}

echo $medication_cost;
?>