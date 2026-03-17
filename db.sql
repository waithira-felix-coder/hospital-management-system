<!-- FAJG Hospital Management database(hms) tables-->
<!-- Patients Table -->
CREATE TABLE patients(patient_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
gender VARCHAR(10),
age INT,
phone VARCHAR(20),
address TEXT,
date_registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

<!-- Doctors table-->
CREATE TABLE doctors(doctor_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
specialization VARCHAR(100),
phone VARCHAR(20),
availability VARCHAR(50)
);

<!--Appointments Table-->
CREATE TABLE appointments(appointment_id INT AUTO_INCREMENT PRIMARY KEY,
patient_id INT,
doctor_id INT,
date DATE,
time TIME,
status VARCHAR(20) DEFAULT 'Booked',

FOREIGN KEY (patient_id)
REFERENCES patients(patient_id) ON DELETE CASCADE,
FOREIGN KEY (doctor_id)
REFERENCES doctors(doctor_id) ON DELETE CASCADE
);

<!--Medicines Table-->
CREATE TABLE medicines(medicine_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(120) NOT NULL,
quantity INT DEFAULT 0,
price DECIMAL(10,2),
expiry_date DATE
);

<!--Bills Table-->
CREATE TABLE bills(bill_id INT AUTO_INCREMENT PRIMARY KEY,
patient_id INT,
appointment_id INT,
total_amount DECIMAL(10,2),
date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (patient_id)
REFERENCES patients(patient_id) ON DELETE SET NULL,
FOREIGN KEY (appointment_id)
REFERENCES appointments(appointment_id) ON DELETE SET NULL
);


<!--Applied changes in the database-->
ALTER TABLE bills
ADD COLUMN medication_cost DECIMAL(10,2) DEFAULT 0,
ADD COLUMN visiting fee DECIMAL (10,2) DEFAULT 0,
ADD COLUMN other_fees DECIMAL(10,2) DEFAULT 0;

CREATE TABLE appointment_medications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  appointment_id INT,
  medicine_id INT,
  quantity INT,
  FOREIGN KEY (appointment_id) REFERENCES
  appointments(appointment_id),
  FOREIGN KEY (medicine_id) REFERENCES
  medicines (medicine_id)
);