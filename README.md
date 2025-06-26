A secure and feature-rich student mentoring management system with role-based dashboards for students, mentors, and administrators. Includes academic management, student-mentor assignments, live filters, profile change workflows, and report generation.

# 🎓 Student Mentoring Management System (MentorMate)

A robust and secure web application designed for academic institutions to manage student mentoring workflows with role-based access for **Students**, **Mentors**, **Admins**, and **Super Admins**.

---

## 🚀 Features Overview

### 🔐 Role-Based Access
- **Admin & Super Admin**
  - Manage sessions, departments, semesters, and subjects in unique combinations.
  - Bulk import/export students using Excel.
  - Assign students to mentors with real-time filters.
  - Personalized dashboard for all academic operations.
  - Bulk operations: delete, print, filter student records.

- **Mentor**
  - Personalized dashboard with access to assigned students.
  - View and manage academic details.
  - Approve/reject student profile change requests with highlights of modified fields and remarks.
  - Mentoring Info section: live filtering, detailed views, status updates with remarks.
  - Bulk delete and print/download mentoring reports.

- **Student**
  - Personalized dashboard with profile and academic details.
  - Upload profile picture and change password.
  - Submit profile modification requests (only one active at a time).
  - View request history and mentoring information.
  - Auto-fetch subject list based on selected session, department, and semester.
  - Add/update/view mentoring data in structured format.

---

## 💡 Tech Stack

- **Backend**: PHP (Laravel Framework)
- **Frontend**: HTML, CSS, Bootstrap, JavaScript (with AJAX)
- **Database**: MySQL
- **Other Tools**: Laravel Excel, Breeze, DataTables

---



---

## ⚙️ Installation Guide

```bash
# Clone the repository
git clone https://github.com/your-username/student-mentoring-system.git
cd student-mentoring-system

# Install dependencies
composer install
npm install && npm run dev

# Copy the example .env and configure it
cp .env.example .env
php artisan key:generate

# Set up your database in the .env file
php artisan migrate
php artisan db:seed # if you have seeders

# Start the server
php artisan serve
