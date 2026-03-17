<?php
include("../config.php");

// Fetch patients and doctors for dropdowns
$patients = $conn->query("SELECT patient_id, name FROM patients");
$doctors = $conn->query("SELECT doctor_id, name FROM doctors");

if(isset($_POST['submit'])){
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = $_POST['status'];

    $sql = "INSERT INTO appointments (patient_id, doctor_id, date, time, status)
            VALUES ('$patient_id','$doctor_id','$date','$time','$status')";

    if($conn->query($sql)){
        header("Location: view_appointments.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Appointment - FAJG HEALTHCARE CENTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php include("../top_nav.php"); ?>

    <h2>Add Appointment</h2>
    <div class="card" style="max-width:500px;">
        <form method="post">
            <label>Patient:</label><br>
            <select name="patient_id" required style="width:100%; padding:8px; margin-bottom:10px;">
                <option value="">Select Patient</option>
                <?php while($p = $patients->fetch_assoc()): ?>
                <option value="<?= $p['patient_id'] ?>"><?= $p['name'] ?></option>
                <?php endwhile; ?>
            </select><br>

            <label>Doctor:</label><br>
            <select name="doctor_id" required style="width:100%; padding:8px; margin-bottom:10px;">
                <option value="">Select Doctor</option>
                <?php while($d = $doctors->fetch_assoc()): ?>
                <option value="<?= $d['doctor_id'] ?>"><?= $d['name'] ?></option>
                <?php endwhile; ?>
            </select><br>

            <label>Date:</label><br>
            <input type="date" name="date" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <label>Time:</label><br>
            <input type="time" name="time" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <label>Status:</label><br>
            <select name="status" required style="width:100%; padding:8px; margin-bottom:10px;">
                <option value="Booked">Booked</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select><br>

            <button type="submit" name="submit" style="padding:10px 20px; background:#2980b9; color:white; border:none; border-radius:5px;">Save</button>
        </form>
    </div>

    <br>
    <a href="view_appointments.php" style="color:#2980b9;">Back to Appointments</a>

</div>
</body>
</html>
