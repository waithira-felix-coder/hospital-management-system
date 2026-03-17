<?php
include("../config.php");

$id = $_GET['id'];

// Fetch bill details
$sql = "
    SELECT b.*, p.name AS patient_name, p.phone, p.address, a.date AS appointment_date, d.name AS doctor_name
    FROM bills b
    LEFT JOIN patients p ON b.patient_id = p.patient_id
    LEFT JOIN appointments a ON b.appointment_id = a.appointment_id
    LEFT JOIN doctors d ON a.doctor_id = d.doctor_id
    WHERE b.bill_id = $id
";
$bill = $conn->query($sql)->fetch_assoc();

if (!$bill) {
    die("Bill not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bill Statement - FAJG HEALTHCARE CENTER</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .details { margin-bottom: 20px; }
        .breakdown { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .breakdown th, .breakdown td { border: 1px solid #000; padding: 8px; text-align: left; }
        .total { font-weight: bold; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>

<div class="header">
    <h1>FAJG HEALTHCARE CENTER</h1>
    <p>Bill Statement</p>
</div>

<div class="details">
    <p><strong>Bill ID:</strong> <?= $bill['bill_id'] ?></p>
    <p><strong>Patient Name:</strong> <?= $bill['patient_name'] ?></p>
    <p><strong>Phone:</strong> <?= $bill['phone'] ?></p>
    <p><strong>Address:</strong> <?= $bill['address'] ?></p>
    <p><strong>Appointment Date:</strong> <?= $bill['appointment_date'] ?></p>
    <p><strong>Doctor:</strong> <?= $bill['doctor_name'] ?></p>
    <p><strong>Bill Date:</strong> <?= $bill['date'] ?></p>
</div>

<table class="breakdown">
    <tr>
        <th>Description</th>
        <th>Amount (KES)</th>
    </tr>
    <tr>
        <td>Medication Cost</td>
        <td><?= number_format($bill['medication_cost'], 2) ?></td>
    </tr>
    <tr>
        <td>Visiting Fee</td>
        <td><?= number_format($bill['visiting_fee'], 2) ?></td>
    </tr>
    <tr>
        <td>Other Fees</td>
        <td><?= number_format($bill['other_fees'], 2) ?></td>
    </tr>
    <tr class="total">
        <td>Total Amount</td>
        <td><?= number_format($bill['total_amount'], 2) ?></td>
    </tr>
</table>

<p>Thank you for choosing FAJG HEALTHCARE CENTER.</p>

<!--Allows us to download and print the bill statement for any patient-->
<button class="no-print" onclick="window.print()">Print Bill</button>

</body>
</html>