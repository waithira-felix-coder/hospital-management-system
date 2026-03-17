<?php
include("../config.php");

// Fetch patients and appointments for dropdowns
$patients = $conn->query("SELECT patient_id, name FROM patients");
$appointments = $conn->query("
    SELECT a.appointment_id, p.name AS patient_name, d.name AS doctor_name, a.date 
    FROM appointments a
    JOIN patients p ON a.patient_id = p.patient_id
    JOIN doctors d ON a.doctor_id = d.doctor_id
    ORDER BY a.date DESC
");

$medication_cost = 0;if(isset($_POST['submit'])){
    $patient_id = $_POST['patient_id'];
    $appointment_id = $_POST['appointment_id'];
    $medication_cost = $_POST['medication_cost'];
    $visiting_fee = $_POST['visiting_fee'];
    $other_fees = $_POST['other_fees'];
    $total_amount = $medication_cost + $visiting_fee + $other_fees;

    $sql = "INSERT INTO bills (patient_id, appointment_id, medication_cost, visiting_fee, other_fees, total_amount)
            VALUES ('$patient_id','$appointment_id','$medication_cost','$visiting_fee','$other_fees','$total_amount')";

    if($conn->query($sql)){
        header("Location: view_bills.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Bill - FAJG HEALTHCARE CENTER</title>
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

        function updateMedicationCost() {
            let apptId = document.querySelector('select[name="appointment_id"]').value;
            if (apptId) {
                fetch('get_medication_cost.php?appt_id=' + apptId)
                    .then(response => response.text())
                    .then(cost => {
                        document.querySelector('input[name="medication_cost"]').value = parseFloat(cost).toFixed(2);
                        calculateTotal();
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.querySelector('input[name="medication_cost"]').value = '0.00';
                calculateTotal();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('input', calculateTotal);
            document.querySelector('select[name="appointment_id"]').addEventListener('change', updateMedicationCost);
        });
    </script>

    <h2>Add Bill</h2>
    <div class="card" style="max-width:500px;">
        <form method="post">
            <label>Patient:</label><br>
            <select name="patient_id" required style="width:100%; padding:8px; margin-bottom:10px;">
                <option value="">Select Patient</option>
                <?php while($p = $patients->fetch_assoc()): ?>
                <option value="<?= $p['patient_id'] ?>"><?= $p['name'] ?></option>
                <?php endwhile; ?>
            </select><br>

            <label>Appointment:</label><br>
            <select name="appointment_id" required style="width:100%; padding:8px; margin-bottom:10px;">
                <option value="">Select Appointment</option>
                <?php while($a = $appointments->fetch_assoc()): ?>
                <option value="<?= $a['appointment_id'] ?>">
                    <?= $a['patient_name'] ?> - <?= $a['doctor_name'] ?> (<?= $a['date'] ?>)
                </option>
                <?php endwhile; ?>
            </select><br>

            <label>Medication Cost (Auto-calculated from medicines used):</label><br>
            <input type="number" step="0.01" name="medication_cost" value="<?= $medication_cost ?>" readonly style="width:100%; padding:8px; margin-bottom:10px; background:#f0f0f0;"><br>

            <label>Visiting Fee:</label><br>
            <input type="number" step="0.01" name="visiting_fee" value="0" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <label>Other Fees:</label><br>
            <input type="number" step="0.01" name="other_fees" value="0" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <p><strong>Total Amount: <span id="total">0.00</span></strong></p>

            <button type="submit" name="submit" style="padding:10px 20px; background:#2980b9; color:white; border:none; border-radius:5px;">Save Bill</button>
        </form>
    </div>

    <br>
    <a href="view_bills.php" style="color:#2980b9;">Back to Bills</a>

</div>
</body>
</html>
