<?php
include("../config.php");
$id = $_GET['id'];

$conn->query("DELETE FROM patients WHERE patient_id=$id");
header("Location: view_patients.php");
?>
