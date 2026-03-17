<?php
include("../config.php");

$id = $_GET['id'];
$conn->query("DELETE FROM medicines WHERE medicine_id=$id");

header("Location: view_medicines.php");
?>
