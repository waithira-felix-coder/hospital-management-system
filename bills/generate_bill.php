<?php
include("../config.php");

$patients = $conn->query("SELECT * FROM patients");
$appointments = $conn->query("SELECT * FROM appointments WHERE status='Booked'");

if(isset($_POST['submit'])) {
    $pid = $_POST['patient_id'];
    $aid = $_POST['appointment_id'];
    $amount = $_POST['total_amount'];

    $sql = "INSERT INTO bills (patient_id, appointment_id, total_amount)   
            VALUES ('$pid', '$aid', '$amount')";

    if($conn->query($sql)) {
        echo "Bill Generated!";
    }
}
?>

<form method="post">
    Patient:
    <select name="patient_id">
        <?php 
        while($p = $patients->fetch_assoc()) {
         ?>
        <option value="<?= $p['patient_id'] ?>">
            <?= $p['name'] ?></option>
        <?php } ?>
    </select><br>

    Appointment:
    <select name="appointment_id">
        <?php 
        while($a = $appointments->fetch_assoc()) { 
        ?>
        <option value="<?= $a['appointment_id'] ?>">
            Appointment #<?= $a['appointment_id'] ?>
        </option>
        <?php } ?>
    </select><br>

    Total Amount: <input type="number" name="total_amount" step="0.01"><br>

    <button name="submit">Generate Bill</button>
</form>
