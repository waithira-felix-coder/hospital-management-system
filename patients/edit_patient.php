<?php
include("../config.php");
$id = $_GET['id'];

$result = $conn->query("SELECT * FROM patients WHERE patient_id=$id");
$row = $result->fetch_assoc();

if(isset($_POST['update'])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE patients SET
            name='$name', gender='$gender', age='$age',
            phone='$phone', address='$address'
            WHERE patient_id=$id";

    if($conn->query($sql)) {
        header("Location: view_patients.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Patient - FAJG HEALTHCARE CENTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php include("../top_nav.php"); ?>

    <h2>Edit Patient</h2>
    <div class="card" style="max-width:500px;">
        <form method="post">
            <label>Name:</label><br>
            <input type="text" name="name" value="<?= $row['name'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Gender:</label><br>
            <input type="text" name="gender" value="<?= $row['gender'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Age:</label><br>
            <input type="number" name="age" value="<?= $row['age'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Phone:</label><br>
            <input type="text" name="phone" value="<?= $row['phone'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Address:</label><br>
            <textarea name="address" style="width:100%; padding:8px; margin-bottom:10px;"><?= $row['address'] ?></textarea><br>
            <button name="update" style="padding:10px 20px; background:#2980b9; color:white; border:none; border-radius:5px;">Update</button>
        </form>
    </div>

</div>
</body>
</html>
