<?php
include "config.php";

// --- FETCH TOTALS; patients, doctors, medicine in stock and the total revenue for the hospital. ---
$total_patients = $conn->query("SELECT COUNT(*) AS total FROM patients")->fetch_assoc()['total'];
$total_doctors = $conn->query("SELECT COUNT(*) AS total FROM doctors")->fetch_assoc()['total'];
$appointments_today = $conn->query("SELECT COUNT(*) AS total FROM appointments WHERE date = CURDATE()")->fetch_assoc()['total'];
$medicines_in_stock = $conn->query("SELECT SUM(quantity) AS total FROM medicines")->fetch_assoc()['total'];
$total_revenue = $conn->query("SELECT SUM(total_amount) AS total FROM bills")->fetch_assoc()['total'];

// ---Displays RECENT APPOINTMENTS ---
$recent_appointments = $conn->query("
    SELECT a.*, p.name AS patient_name, d.name AS doctor_name
    FROM appointments a
    JOIN patients p ON a.patient_id = p.patient_id
    JOIN doctors d ON a.doctor_id = d.doctor_id
    ORDER BY a.date DESC, a.time DESC
    LIMIT 5
");

// --- LOW STOCK ALERT (MEDICINES < 10) ---
$low_stock_medicines = $conn->query("SELECT * FROM medicines WHERE quantity < 10 ORDER BY quantity ASC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAJG HEALTHCARE CENTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php include("nav.php"); ?>
    <div class="topbar">
        <h2>FAJG HEALTHCARE CENTER</h2>
        <button onclick="logout()" style="padding:10px 20px; background:#e74c3c; border:none; color:white; border-radius:5px; cursor:pointer; transition: background 0.3s ease;">Logout</button>
    </div>
<!-- A logout button-->
    <script>
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                // Since no session, just redirect to dashboard or show message
                alert('Logged out successfully!');
                window.location.href = 'blank.html'; // Redirect to a blank page or login page
            }
        }
    </script>

    <!-- Statistics and what to be displayed-->
    <div class="stats">
        <div class="card">
            <h3><?php echo $total_patients; ?></h3>
            <p>Registered Patients</p>
        </div>
        <div class="card">
            <h3><?php echo $total_doctors; ?></h3>
            <p>Doctors</p>
        </div>
        <div class="card">
            <h3><?php echo $appointments_today; ?></h3>
            <p>Appointments Today</p>
        </div>
        <div class="card">
            <h3><?php echo $medicines_in_stock; ?></h3>
            <p>Total Medicines in Stock</p>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="card" style="margin-bottom:20px;">
        <h3>Total Revenue: KES 
            <?php echo number_format($total_revenue, 2); ?>       </h3>
    </div>

    <!-- Recent Appointments -->
    <div class="card" style="margin-bottom:20px;">
        <h3>Recent Appointments</h3><br>
        <table>
            <tr>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
            <?php while($row = $recent_appointments->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['patient_name']; ?></td>
                <td><?php echo $row['doctor_name']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['time']; ?></td>
                <td><?php echo $row['status']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <!-- Low Stock Medicines -->
    <?php if($low_stock_medicines->num_rows > 0): ?>
    <div class="card">
        <h3>Low Stock Alert</h3>
        <?php while($med = $low_stock_medicines->fetch_assoc()): ?>
            <div class="alert">
                <?php echo $med['name']; ?> — Only <?php echo $med['quantity']; ?> left
            </div>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>

</div>
</body>
</html>
