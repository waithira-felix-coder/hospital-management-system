<?php
include("../config.php");

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO patients (name, gender, age, phone, address)
            VALUES ('$name', '$gender', '$age', '$phone', '$address')";

    if($conn->query($sql)) {
        header("Location: view_patients.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient - FAJG HEALTHCARE CENTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php include("../top_nav.php"); ?>

    <h2>Add New Patient</h2>
    <div class="card" style="max-width:500px;">
        <form method="post">
            <label>Name:</label><br>
            <input type="text" name="name" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Gender:</label><br>
            <input type="text" name="gender" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Age:</label><br>
            <input type="number" name="age" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Phone:</label><br>
            <input type="text" name="phone" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Address:</label><br>
            <textarea name="address" style="width:100%; padding:8px; margin-bottom:10px;"></textarea><br>
            <button type="submit" name="submit" style="padding:10px 20px; background:#2980b9; color:white; border:none; border-radius:5px;">Add Patient</button>
        </form>
    </div>

</div>
</body>
</html>
