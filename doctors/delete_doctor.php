<?php
include("../config.php");

$id = $_GET['id'];
$conn->query("DELETE FROM doctors WHERE doctor_id=$id");

header("Location: view_doctors.php");
?>
