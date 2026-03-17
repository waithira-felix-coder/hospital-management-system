<?php
include("../config.php");

$id = $_GET['id'];

// Fetch current appointment
$sql = "SELECT * FROM appointments WHERE appointment_id=$id";
$appointment = $conn->query($sql)->fetch_assoc();

// Fetch patients and doctors
$patients = $conn->query("SELECT patient_id, name FROM patients");
$doctors = $conn->query("SELECT doctor_id, name FROM doctors");

if(isset($_POST['update'])){
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = $_POST['status'];

    $update = "UPDATE appointments SET
               patient_id='$patient_id',
               doctor_id='$doctor_id',
               date='$date',
               time='$time',
               status='$status'
               WHERE appointment_id=$id";

    if($conn->query($update)){
        header("Location: view_appointments.php");
    } else {
        echo "Update failed: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Appointment - FAJG HEALTHCARE CENTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php include("../top_nav.php"); ?>

    <h2>Edit Appointment</h2>
    <div class="card" style="max-width:500px;">
        <form method="post">
            <label>Patient:</label><br>
            <select name="patient_id" required style="width:100%; padding:8px; margin-bottom:10px;">
                <?php while($p = $patients->fetch_assoc()): ?>
                <option value="<?= $p['patient_id'] ?>" <?= $p['patient_id']==$appointment['patient_id']?'selected':'' ?>><?= $p['name'] ?></option>
                <?php endwhile; ?>
            </select><br>

            <label>Doctor:</label><br>
            <select name="doctor_id" required style="width:100%; padding:8px; margin-bottom:10px;">
                <?php while($d = $doctors->fetch_assoc()): ?>
                <option value="<?= $d['doctor_id'] ?>" <?= $d['doctor_id']==$appointment['doctor_id']?'selected':'' ?>><?= $d['name'] ?></option>
                <?php endwhile; ?>
            </select><br>

            <label>Date:</label><br>
            <input type="date" name="date" value="<?= $appointment['date'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <label>Time:</label><br>
            <input type="time" name="time" value="<?= $appointment['time'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <label>Status:</label><br>
            <select name="status" required style="width:100%; padding:8px; margin-bottom:10px;">
                <option value="Booked" <?= $appointment['status']=='Booked'?'selected':'' ?>>Booked</option>
                <option value="Completed" <?= $appointment['status']=='Completed'?'selected':'' ?>>Completed</option>
                <option value="Cancelled" <?= $appointment['status']=='Cancelled'?'selected':'' ?>>Cancelled</option>
            </select><br>

            <button type="submit" name="update" style="padding:10px 20px; background:#2980b9; color:white; border:none; border-radius:5px;">Update</button>
        </form>
    </div>

    <h3>Medicines Given</h3>
    <?php
    $med_sql = "SELECT am.*, m.name AS medicine_name FROM appointment_medications am JOIN medicines m ON am.medicine_id = m.medicine_id WHERE am.appointment_id = $id";
    $med_result = $conn->query($med_sql);
    ?>
    <table style="width:100%; border-collapse:collapse; margin-bottom:20px;">
        <tr style="background:#2980b9; color:white;">
            <th style="padding:8px; border:1px solid #ddd;">Medicine</th>
            <th style="padding:8px; border:1px solid #ddd;">Quantity</th>
            <th style="padding:8px; border:1px solid #ddd;">Action</th>
        </tr>
        <?php while($med = $med_result->fetch_assoc()): ?>
        <tr>
            <td style="padding:8px; border:1px solid #ddd;"><?= $med['medicine_name'] ?></td>
            <td style="padding:8px; border:1px solid #ddd;"><?= $med['quantity'] ?></td>
            <td style="padding:8px; border:1px solid #ddd;">
                <a href="remove_medicine_from_appointment.php?am_id=<?= $med['id'] ?>&appt_id=<?= $id ?>" style="color:#e74c3c;">Remove</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="card" style="max-width:500px;">
        <form method="post" action="add_medicine_to_appointment.php">
            <input type="hidden" name="appointment_id" value="<?= $id ?>">
            <label>Select Medicine:</label><br>
            <select name="medicine_id" required style="width:100%; padding:8px; margin-bottom:10px;">
                <option value="">Choose Medicine</option>
                <?php
                $medicines = $conn->query("SELECT * FROM medicines WHERE quantity > 0");
                while($m = $medicines->fetch_assoc()): ?>
                <option value="<?= $m['medicine_id'] ?>"><?= $m['name'] ?> (Stock: <?= $m['quantity'] ?>)</option>
                <?php endwhile; ?>
            </select><br>

            <label>Quantity:</label><br>
            <input type="number" name="quantity" min="1" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <button type="submit" style="padding:10px 20px; background:#27ae60; color:white; border:none; border-radius:5px;">Add Medicine</button>
        </form>
    </div>

    <br>
    <a href="view_appointments.php" style="color:#2980b9;">Back to Appointments</a>

</div>
</body>
</html>
