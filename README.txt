# 🌍 Avipro Travels – Travel Booking Web Application

Avipro Travels is a fully functional **travel booking website** built using **PHP, MySQL, HTML, CSS, and Vanilla JS**.  
It includes a complete **Admin Dashboard**, **dynamic packages**, **booking system**, **image galleries**, and a modern UI.

---

## 🚀 Features

### 🧳 **Public Website**
- Dynamic homepage with hero banner & featured packages  
- Beautiful package listing page  
- Individual package page with:
  - Cover image
  - Image gallery
  - Highlights
  - Itinerary timeline  
  - Book Now option  
- Fully functional contact page  
- Booking form with AJAX submission  
- Responsive & modern UI  

---

### 🔐 **Admin Panel**
- Secure login with sessions  
- Dashboard with package & booking statistics  
- Manage travel packages (Add / Edit / Delete)
- Upload images for packages  
- Manage bookings (view all bookings)
- Site settings (title, contact details)
- Logout system  

---

## 🗂️ Project Structure

avipro_travels/
│
├── public/ # Public-facing pages
│ ├── index.php # Homepage
│ ├── packages.php # All travel packages
│ ├── package.php # Single package details
│ ├── booking.php # Booking / enquiry
│ ├── contact.php # Contact page
│ ├── ajax/submit_booking.php
│ └── assets/
│ ├── css/style.css
│ └── images/uploads/ # Uploaded package images
│
├── admin/ # Admin Dashboard
│ ├── index.php # Admin login
│ ├── dashboard.php
│ ├── packages_list.php
│ ├── packages_create.php
│ ├── packages_edit.php
│ ├── packages_delete.php
│ ├── bookings.php
│ ├── settings.php
│ └── logout.php
│
├── includes/
│ ├── db.php # Database connection
│ ├── auth.php # Authentication functions
│ ├── header.php # Site header
│ ├── footer.php # Site footer
│ └── config.php # Config (session start + constants)
│
└── README.md # Documentation


Copy code

---

## 🛠️ Technologies Used

| Component     | Technology |
|---------------|------------|
| Backend       | PHP 8+ |
| Database      | MySQL / MariaDB |
| Frontend      | HTML5, CSS3, JavaScript |
| Server        | Apache (XAMPP) |
| Styling       | Custom CSS (modern travel UI) |
| Auth          | PHP Sessions |
| AJAX          | Fetch API |

---

## ⚙️ Installation & Setup

### **1. Download or Clone the Project**




### **2. Move the folder to your server**
For XAMPP:
C:/xampp/htdocs/avipro_travels

### **3. Import the Database**
- Open **phpMyAdmin**
- Create a new database:
avipro_travels

markdown
Copy code
- Import the SQL file .  

### **4. Configure Database Connection**
Locate:

includes/config.php





5. Start Apache & MySQL (XAMPP)

Then open:


http://localhost/avipro_travels/public/index.php


For admin login:


Copy code
http://localhost/avipro_travels/admin/index.php

🔐 Default Admin Login
Field	Value
Username	admin
Password	admin123


✔ Package Page
Beautiful image gallery + itinerary.

✔ Admin Dashboard
Manage packages, bookings & settings.



📬 Contact
Developers:

Anurag Thakur – 9140189784

Kaushal Tanna – 9157798931

Email: anurag.24bce11136@vitbhopal.ac.in

