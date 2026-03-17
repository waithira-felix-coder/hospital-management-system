# FAJG Hospital Management System 

## Overview
The Hospital Management System is a web-based application built with PHP and MySQL. It streamlines hospital operations, making it easier to manage patients, doctors, appointments, and medical records in one centralized system.
![FAJG Dashboard](/screenshots/dashboard.png)
This project demonstrates **CRUD operations, authentication, and role-based access**, providing a real-world example of how healthcare management systems function.

![Sample Bill Statement](/screenshots/printablebillingstatement.png)


**Project Structure**
hospital-management-system/
├── assets/            # CSS, JS, images
├── config/            # Database connection & configuration
├── includes/          # Header, footer, sidebar templates
├── admin/             # Admin panel pages
├── doctor/            # Doctor panel pages
├── receptionist/      # Receptionist panel pages
├── database/          # SQL backup file
├── index.php          # Login page
└── README.md          # Project documentation

---


## Features
- **Patient Management**
  - Add, update, delete, and view patient records
  - Track patient medical history
- **Doctor Management**
  - Add, update, delete, and view doctors
  - Assign doctors to patients
- **Appointment Scheduling**
  - Book, update, cancel, and view appointments
  - Automatic conflict detection for overlapping appointments
- **Role-based Access**
  - Admin: full access
  - Receptionist: patient & appointment management
  - Doctor: view patients and appointments
- **Medical Records**
  - Upload and manage patient medical reports
- **Search & Filters**
  - Search patients, doctors, and appointments quickly

---

## Tech Stack
- **Backend:** PHP
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript, Bootstrap (responsive UI)
- **Server:** Apache (XAMPP/LAMP/WAMP)

---

## Installation & Setup

1. **Clone the repository:**
```bash
git clone https://github.com/waithira-felix-coder/hospital-management-system.git

---

**Technical skills learnt**
Full-stack PHP development (backend + frontend integration)

Database design & SQL querying


Responsive web design using Bootstrap/CSS

Project structuring & maintainable code practices
