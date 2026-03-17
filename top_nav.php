<style>
    body {
        margin:0;
        font-family: Arial;
        background:#f5f6fa;
    }
    .topnav {
        background:#2c3e50;
        color:white;
        padding:15px 20px;
        display:flex;
        justify-content:space-between;
        align-items:center;
    }
    .topnav .logo {
        font-size:24px;
        font-weight:bold;
    }
    .topnav .nav-links {
        display:flex;
    }
    .topnav .nav-links a {
        color:white;
        text-decoration:none;
        margin:0 15px;
        font-size:16px;
    }
    .topnav .nav-links a:hover {
        background:#34495e;
        padding:5px 10px;
        border-radius:3px;
    }
    .main {
        margin:20px;
        padding:20px;
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
        .topnav {
            padding: 10px 5px;
            flex-direction: column;
            text-align: center;
        }
        .topnav .logo {
            margin-bottom: 10px;
            font-size: 20px;
        }
        .topnav .nav-links {
            flex-wrap: wrap;
            justify-content: center;
        }
        .topnav .nav-links a {
            margin: 5px;
            padding: 8px 12px;
            font-size: 14px;
        }
        .main {
            margin: 10px;
            padding: 10px;
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
        .topnav .nav-links a {
            font-size: 12px;
            padding: 6px 10px;
        }
        .main {
            margin: 5px;
            padding: 5px;
        }
    }
</style>

<div class="topnav">
    <div class="logo">FAJG HEALTHCARE</div>
    <div class="nav-links">
        <a href="/hms/dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="/hms/patients/view_patients.php"><i class="bi bi-person"></i> Patients</a>
        <a href="/hms/doctors/view_doctors.php"><i class="bi bi-person-badge"></i> Doctors</a>
        <a href="/hms/appointments/view_appointments.php"><i class="bi bi-calendar-check"></i> Appointments</a>
        <a href="/hms/medicines/view_medicines.php"><i class="bi bi-capsule"></i> Medicines</a>
        <a href="/hms/bills/view_bills.php"><i class="bi bi-receipt"></i> Billing</a>
    </div>
</div>

<div class="main">