<?php
include("../config.php");

$sql = "
    SELECT b.*, p.name AS patient_name, a.date AS appointment_date
    FROM bills b
    LEFT JOIN patients p ON b.patient_id = p.patient_id
    LEFT JOIN appointments a ON b.appointment_id = a.appointment_id
    ORDER BY b.date DESC
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Bills - FAJG HEALTHCARE CENTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php include("../top_nav.php"); ?>

    <h2>Bills</h2>
    <a href="add_bill.php" style="display:inline-block; margin-bottom:20px; padding:10px 20px; background:#2980b9; color:white; text-decoration:none; border-radius:5px;">+ Add New Bill</a>
    <br><br>

    <table>
        <tr>
            <th>Bill ID</th>
            <th>Patient</th>
            <th>Appointment Date</th>
            <th>Medication Cost</th>
            <th>Visiting Fee</th>
            <th>Other Fees</th>
            <th>Total Amount</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['bill_id'] ?></td>
            <td><?= $row['patient_name'] ?></td>
            <td><?= $row['appointment_date'] ?></td>
            <td><?= number_format($row['medication_cost'], 2) ?></td>
            <td><?= number_format($row['visiting_fee'], 2) ?></td>
            <td><?= number_format($row['other_fees'], 2) ?></td>
            <td><?= number_format($row['total_amount'], 2) ?></td>
            <td><?= $row['date'] ?></td>
            <td>
                <a href="edit_bill.php?id=<?= $row['bill_id'] ?>" style="margin-right:10px; color:#2980b9;">Edit</a>
                <a href="delete_bill.php?id=<?= $row['bill_id'] ?>" onclick="return confirm('Delete this bill?')" style="color:#e74c3c;">Delete</a>
                <a href="bill_statement.php?id=<?= $row['bill_id'] ?>" target="_blank" style="margin-left:10px; color:#27ae60;">Download</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>
</body>
</html>
