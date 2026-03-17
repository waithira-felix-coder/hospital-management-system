<?php
include("../config.php");

$id = $_GET['id'];
$sql = "SELECT * FROM medicines WHERE medicine_id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $category =$_POST['category'];
    $qty = $_POST['quantity'];
    $price = $_POST['price'];
    $expiry = $_POST['expiry_date'];

    $update = "UPDATE medicines SET
                name='$name',
                quantity='$qty',
                price='$price',
                expiry_date='$expiry'
               WHERE medicine_id=$id";

    if ($conn->query($update)) {
        header("Location: view_medicines.php");
    } else {
        echo "Update failed: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Medicine - FAJG HEALTHCARE CENTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php include("../top_nav.php"); ?>

    <h2>Edit Medicine</h2>
    <div class="card" style="max-width:500px;">
        <form method="post">
            <label>Name:</label><br>
            <input type="text" name="name" value="<?= $row['name'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <label>Quantity:</label><br>
            <input type="number" name="quantity" value="<?= $row['quantity'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Price:</label><br>
            <input type="number" step="0.01" name="price" value="<?= $row['price'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Expiry:</label><br>
            <input type="date" name="expiry_date" value="<?= $row['expiry_date'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <button name="update" style="padding:10px 20px; background:#2980b9; color:white; border:none; border-radius:5px;">Update</button>
        </form>
    </div>

    <br>
    <a href="view_medicines.php" style="color:#2980b9;">Cancel</a>

</div>
</body>
</html>
