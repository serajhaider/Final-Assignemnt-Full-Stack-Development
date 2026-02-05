Clinic Appointment Scheduling System

This is a PHP and MySQL based web application developed for the
5CS045 Full Stack Development module.

The system allows an administrator to manage patients, doctors,
and appointments in a clinic environment.

--------------------------------
Login Credentials:

Username: admin
Password: password
--------------------------------

Technology Used:
- PHP (Procedural)
- MySQL (PDO)
- HTML5
- CSS3
- JavaScript (AJAX)

System Features:
- Secure login system using PHP sessions
- Admin-only access to the system
- CRUD operations for:
  - Patients
  - Doctors
  - Appointments
- Appointment scheduling with time conflict prevention
- AJAX-based live availability check for appointment time slots
- Search appointments by date
- Prepared statements to prevent SQL injection
- Centralized database connection using PDO
- Clean folder structure (public, includes, config, assets)

How to Run the Project:
1. Import the file `clinic.sql` into the database
2. Update database credentials in `config/db.php`
3. Open the project in browser:
   /public/login.php
4. Login using the admin credentials provided above

Notes:
- This system is designed for administrator use.
- All pages are protected using session-based authentication.
- The project is compatible with both localhost (XAMPP) and
  the college server environment.
