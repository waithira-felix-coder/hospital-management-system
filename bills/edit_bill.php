<?php
include("../config.php");

$id = $_GET['id'];

// Fetch current bill
$sql = "SELECT * FROM bills WHERE bill_id=$id";
$bill = $conn->query($sql)->fetch_assoc();

// Fetch patients and appointments
$patients = $conn->query("SELECT patient_id, name FROM patients");
$appointments = $conn->query("
    SELECT a.appointment_id, p.name AS patient_name, d.name AS doctor_name, a.date
    FROM appointments a
    JOIN patients p ON a.patient_id = p.patient_id
    JOIN doctors d ON a.doctor_id = d.doctor_id
    ORDER BY a.date DESC
");

if(isset($_POST['update'])){
    $patient_id = $_POST['patient_id'];
    $appointment_id = $_POST['appointment_id'];
    $medication_cost = $_POST['medication_cost'];
    $visiting_fee = $_POST['visiting_fee'];
    $other_fees = $_POST['other_fees'];
    $total_amount = $medication_cost + $visiting_fee + $other_fees;

    $update = "UPDATE bills SET 
               patient_id='$patient_id',
               appointment_id='$appointment_id',
               medication_cost='$medication_cost',
               visiting_fee='$visiting_fee',
               other_fees='$other_fees',
               total_amount='$total_amount'
               WHERE bill_id=$id";

    if($conn->query($update)){
        header("Location: view_bills.php");
    } else {
        echo "Update failed: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Bill - FAJG HEALTHCARE CENTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php include("../top_nav.php"); ?>

    <script>
        function calculateTotal() {
            let med = parseFloat(document.querySelector('input[name="medication_cost"]').value) || 0;
            let visit = parseFloat(document.querySelector('input[name="visiting_fee"]').value) || 0;
            let other = parseFloat(document.querySelector('input[name="other_fees"]').value) || 0;
            let total = med + visit + other;
            document.getElementById('total').innerText = total.toFixed(2);
        }
        document.addEventListener('input', calculateTotal);
    </script>

    <h2>Edit Bill</h2>
    <div class="card" style="max-width:500px;">
        <form method="post">
            <label>Patient:</label><br>
            <select name="patient_id" required style="width:100%; padding:8px; margin-bottom:10px;">
                <?php while($p = $patients->fetch_assoc()): ?>
                <option value="<?= $p['patient_id'] ?>" <?= $p['patient_id']==$bill['patient_id']?'selected':'' ?>>
                    <?= $p['name'] ?>
                </option>
                <?php endwhile; ?>
            </select><br>

            <label>Appointment:</label><br>
            <select name="appointment_id" required style="width:100%; padding:8px; margin-bottom:10px;">
                <?php while($a = $appointments->fetch_assoc()): ?>
                <option value="<?= $a['appointment_id'] ?>" <?= $a['appointment_id']==$bill['appointment_id']?'selected':'' ?>>
                    <?= $a['patient_name'] ?> - <?= $a['doctor_name'] ?> (<?= $a['date'] ?>)
                </option>
                <?php endwhile; ?>
            </select><br>

            <label>Medication Cost:</label><br>
            <input type="number" step="0.01" name="medication_cost" value="<?= $bill['medication_cost'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <label>Visiting Fee:</label><br>
            <input type="number" step="0.01" name="visiting_fee" value="<?= $bill['visiting_fee'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <label>Other Fees:</label><br>
            <input type="number" step="0.01" name="other_fees" value="<?= $bill['other_fees'] ?>" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <p><strong>Total Amount: <span id="total"><?= number_format($bill['total_amount'], 2) ?></span></strong></p>

            <button type="submit" name="update" style="padding:10px 20px; background:#2980b9; color:white; border:none; border-radius:5px;">Update Bill</button>
        </form>
    </div>

    <br>
    <a href="view_bills.php" style="color:#2980b9;">Back to Bills</a>

</div>
</body>
</html>
