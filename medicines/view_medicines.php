<?php
include("../config.php");
$result = $conn->query("SELECT * FROM medicines");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Medicines - FAJG HEALTHCARE CENTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php include("../top_nav.php"); ?>

    <h2>Medicines Inventory</h2>

    <a href="add_medicine.php" style="display:inline-block; margin-bottom:20px; padding:10px 20px; background:#2980b9; color:white; text-decoration:none; border-radius:5px;">+ Add New Medicine</a>
    <br><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            
            <th>Qty</th>
            <th>Price</th>
            <th>Expiry</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['medicine_id'] ?></td>
                <td><?= $row['name'] ?></td>
                
                <td><?= $row['quantity'] ?></td>
                <td><?= $row['price'] ?></td>
                <td><?= $row['expiry_date'] ?></td>

                <td>
                    <a href="edit_medicine.php?id=<?= $row['medicine_id'] ?>" style="margin-right:10px; color:#2980b9;">Edit</a>
                    <a href="delete_medicine.php?id=<?= $row['medicine_id'] ?>"
                       onclick="return confirm('Delete this item?')" style="color:#e74c3c;">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

</div>
</body>
</html>
