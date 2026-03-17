<style>
    body {
        margin:0;
        font-family: Arial;
        background:#f5f6fa;
    }
    .sidebar {
        width:250px;
        background:#2c3e50;
        color:white;
        height:100vh;
        position:fixed;
        top:0;
        left:0;
        padding-top:20px;
    }
    .sidebar h2 {
        text-align:center;
        margin-bottom:40px;
    }
    .sidebar a {
        display:block;
        padding:15px 25px;
        color:white;
        text-decoration:none;
        transition: background 0.3s ease, color 0.3s ease;
    }
    .sidebar a:hover {
        background:#34495e;
        color:#ecf0f1;
        border-left:4px solid #ecf0f1;
    }
    .main {
        margin-left:260px;
        padding:20px;
    }
    .topbar {
        place-content: center;
        background:white;
        padding:15px;
        border-radius:8px;
        display:flex;
        justify-content:space-between;
        margin-bottom:20px;
    }
    .stats {
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:20px;
        margin-bottom:20px;
    }
    .card {
        background:white;
        padding:20px;
        border-radius:8px;
        box-shadow:0 3px 6px rgba(0,0,0,0.1);
    }
    table {
        width:100%;
        background:white;
        border-collapse:collapse;
        border-radius:8px;
        overflow:hidden;
    }
    table th, table td {
        padding:12px;
        border-bottom:1px solid #ddd;
    }
    table th {
        background:#2980b9;
        color:white;
        text-align:left;
    }
    h3 {
        margin:0;
        font-size:20px;
    }
    .alert {
        padding:15px;
        background:#e74c3c;
        color:white;
        border-radius:5px;
        margin-bottom:15px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
            text-align: center;
        }
        .sidebar h2 {
            margin-bottom: 20px;
        }
        .sidebar a {
            display: inline-block;
            width: auto;
            margin: 5px;
            padding: 10px 15px;
        }
        .main {
            margin-left: 0;
            padding: 10px;
        }
        .topbar {
            flex-direction: column;
            text-align: center;
            padding: 10px;
        }
        .topbar h2 {
            margin-bottom: 10px;
            font-size: 18px;
        }
        .stats {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .card {
            padding: 15px;
        }
        table {
            font-size: 14px;
        }
        table th, table td {
            padding: 8px;
        }
    }

    @media (max-width: 480px) {
        .stats {
            grid-template-columns: 1fr;
        }
        .sidebar a {
            font-size: 14px;
            padding: 8px 12px;
        }
    }
</style>

<!-- Sidebar -->
<div class="sidebar">
    <h2>FAJG HEALTHCARE</h2>
    <a href="/hms/dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="/hms/patients/view_patients.php"><i class="bi bi-person"></i> Patients</a>
    <a href="/hms/doctors/view_doctors.php"><i class="bi bi-person-badge"></i> Doctors</a>
    <a href="/hms/appointments/view_appointments.php"><i class="bi bi-calendar-check"></i> Appointments</a>
    <a href="/hms/medicines/view_medicines.php"><i class="bi bi-capsule"></i> Medicines</a>
    <a href="/hms/bills/view_bills.php"><i class="bi bi-receipt"></i> Billing</a>
</div>

<!-- Main -->
<div class="main">