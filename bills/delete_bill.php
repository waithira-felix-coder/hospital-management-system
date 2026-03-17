<?php
include("../config.php");

$id = $_GET['id'];
$conn->query("DELETE FROM bills WHERE bill_id=$id");

header("Location: view_bills.php");
?>
