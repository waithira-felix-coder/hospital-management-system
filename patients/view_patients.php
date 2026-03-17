<?php
include("../config.php");
$result = $conn->query("SELECT * FROM patients");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Patients - FAJG HEALTHCARE CENTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php include("../top_nav.php"); ?>

    <h2>All Patients</h2>
    <a href="add_patient.php" style="display:inline-block; margin-bottom:20px; padding:10px 20px; background:#2980b9; color:white; text-decoration:none; border-radius:5px;">Add New Patient</a>
    <table>
    <tr>
        <th>ID</th><th>Name</th><th>Phone</th><th>Actions</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['patient_id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['phone'] ?></td>
        <td>
            <a href="edit_patient.php?id=<?= $row['patient_id'] ?>" style="margin-right:10px; color:#2980b9;">Edit</a>
            <a href="delete_patient.php?id=<?= $row['patient_id'] ?>" style="color:#e74c3c;">Delete</a>
        </td>
    </tr>
    <?php } ?>
    </table>

</div>
</body>
</html>
