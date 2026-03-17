<?php
include("../config.php");

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $spec = $_POST['specialization'];
    $phone = $_POST['phone'];
    $availability = $_POST['availability'];

    $sql = "INSERT INTO doctors (name, specialization, phone, availability)
            VALUES ('$name', '$spec', '$phone', '$availability')";

    if($conn->query($sql)) {
        header("Location: view_doctors.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Doctor - FAJG HEALTHCARE CENTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php include("../top_nav.php"); ?>

    <h2>Add New Doctor</h2>
    <div class="card" style="max-width:500px;">
        <form method="post">
            <label>Name:</label><br>
            <input type="text" name="name" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Specialization:</label><br>
            <input type="text" name="specialization" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Phone:</label><br>
            <input type="text" name="phone" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Availability:</label><br>
            <input type="text" name="availability" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <button name="submit" style="padding:10px 20px; background:#2980b9; color:white; border:none; border-radius:5px;">Add Doctor</button>
        </form>
    </div>

</div>
</body>
</html>
