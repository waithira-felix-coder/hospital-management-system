<?php
include("../config.php");
$result = $conn->query("SELECT * FROM doctors");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Doctors - FAJG HEALTHCARE CENTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php include("../top_nav.php"); ?>

    <h2>Doctors List</h2>
    <a href="add_doctor.php" style="display:inline-block; margin-bottom:20px; padding:10px 20px; background:#2980b9; color:white; text-decoration:none; border-radius:5px;">Add New Doctor</a>

    <table>
    <tr><th>ID</th><th>Name</th><th>Specialization</th><th>Actions</th></tr>

    <?php while($r = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $r['doctor_id'] ?></td>
        <td><?= $r['name'] ?></td>
        <td><?= $r['specialization'] ?></td>
        <td>
            <a href="edit_doctor.php?id=<?= $r['doctor_id'] ?>" style="margin-right:10px; color:#2980b9;">Edit</a>
            <a href="delete_doctor.php?id=<?= $r['doctor_id'] ?>" style="color:#e74c3c;">Delete</a>
        </td>
    </tr>
    <?php } ?>
    </table>

</div>
</body>
</html>
