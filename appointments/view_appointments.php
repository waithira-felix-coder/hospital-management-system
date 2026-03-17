<?php
include("../config.php");

$sql = "SELECT a.*, p.name AS patient_name, d.name AS doctor_name
        FROM appointments a
        JOIN patients p ON a.patient_id = p.patient_id
        JOIN doctors d ON a.doctor_id = d.doctor_id
        ORDER BY a.date DESC, a.time DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Appointments - FAJG HEALTHCARE CENTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php include("../top_nav.php"); ?>

    <h2>Appointments</h2>
    <a href="add_appointment.php" style="display:inline-block; margin-bottom:20px; padding:10px 20px; background:#2980b9; color:white; text-decoration:none; border-radius:5px;">+ Add New Appointment</a>
    <br><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['appointment_id'] ?></td>
            <td><?= $row['patient_name'] ?></td>
            <td><?= $row['doctor_name'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['time'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <a href="edit_appointment.php?id=<?= $row['appointment_id'] ?>" style="margin-right:10px; color:#2980b9;">Edit</a>
                <a href="delete_appointment.php?id=<?= $row['appointment_id'] ?>" onclick="return confirm('Delete this appointment?')" style="color:#e74c3c;">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>
</body>
</html>
