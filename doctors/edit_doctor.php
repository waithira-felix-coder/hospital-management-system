<?php
include("../config.php");
$id = $_GET['id'];

$row = $conn->query("SELECT * FROM doctors WHERE doctor_id=$id")->fetch_assoc();

if(isset($_POST['update'])) {
    $name = $_POST['name'];
    $spec = $_POST['specialization'];
    $phone = $_POST['phone'];
    $availability = $_POST['availability'];

    $sql = "UPDATE doctors SET
            name='$name', specialization='$spec', phone='$phone', availability='$availability'
            WHERE doctor_id=$id";

    if($conn->query($sql)) {
        header("Location: view_doctors.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Doctor - FAJG HEALTHCARE CENTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php include("../top_nav.php"); ?>

    <h2>Edit Doctor</h2>
    <div class="card" style="max-width:500px;">
        <form method="post">
            <label>Name:</label><br>
            <input type="text" name="name" value="<?= $row['name'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Specialization:</label><br>
            <input type="text" name="specialization" value="<?= $row['specialization'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Phone:</label><br>
            <input type="text" name="phone" value="<?= $row['phone'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <label>Availability:</label><br>
            <input type="text" name="availability" value="<?= $row['availability'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>
            <button name="update" style="padding:10px 20px; background:#2980b9; color:white; border:none; border-radius:5px;">Update</button>
        </form>
    </div>

</div>
</body>
</html>
