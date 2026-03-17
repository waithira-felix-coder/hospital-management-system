<?php
include("../config.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $qty = $_POST['quantity'];
    $price = $_POST['price'];
    $expiry = $_POST['expiry_date'];

    $sql = "INSERT INTO medicines (name, quantity, price, expiry_date)
            VALUES ('$name', '$qty', '$price', '$expiry')";

    if ($conn->query($sql)) {
        header("Location: view_medicines.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Medicine - FAJG HEALTHCARE CENTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php include("../top_nav.php"); ?>

    <h2>Add Medicine</h2>
    <div class="card" style="max-width:500px;">
        <form method="post">
            <label>Name:</label><br>
            <input type="text" name="name" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            
            <label>Quantity:</label><br>
            <input type="number" name="quantity" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Price:</label><br>
            <input type="number" step="0.01" name="price" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Expiry Date:</label><br>
            <input type="date" name="expiry_date" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <button type="submit" name="submit" style="padding:10px 20px; background:#2980b9; color:white; border:none; border-radius:5px;">Save</button>
        </form>
    </div>

    <br>
    <a href="view_medicines.php" style="color:#2980b9;">Back to List</a>

</div>
</body>
</html>
