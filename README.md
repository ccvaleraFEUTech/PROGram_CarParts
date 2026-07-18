# PROGram Car Parts

A web-based e-commerce system developed as a final project for PHP Server-Side Programming. The system allows customers to browse and purchase motorcycle/car parts while providing administrators with tools to manage products, users, inventory, and reports.

> **Educational Purpose Only**
>
> This website was developed solely for educational purposes as a requirement for a college course.

---

# Features

## Buyer Module

- User Registration
- Email Verification using PHPMailer
- User Login and Logout
- Browse Products by Category
- Product Search
- Add to Cart
- Shopping Cart Management
- Checkout
- Payment Information Page (No payment gateway integration)
- Order History
- User Profile Management
- Contact Page
- About Page

---

## Seller / Admin Module

- Admin Dashboard
- Manage Products
- Manage Product Categories
- Inventory Management
- Order Management
- User Management
- Admin User Management
- Inventory Reports
- Audit Log Reports

---

# Technologies Used

- PHP
- MySQL / MariaDB
- HTML5
- CSS3
- JavaScript
- PHPMailer
- XAMPP (Development Environment)

---

# Project Structure

```
PROGram_CarParts/
│
├── actions/              # Form processing and business logic
├── assets/
│   ├── css/
│   ├── images/
│   └── json/
├── includes/             # Shared PHP files
├── js/                   # JavaScript files
├── pages/                # Buyer pages
├── seller/               # Admin/Seller pages
├── phpmailer/            # PHPMailer library
├── index.php
├── login.php
├── register.php
└── confirm_email.php
```

---

# Installation

## Requirements

- PHP 8.x or later
- MySQL / MariaDB
- XAMPP
- Web Browser

---

## Setup

### 1. Clone the repository

```bash
git clone https://github.com/yourusername/PROGram_CarParts.git
```

or download the ZIP.

---

### 2. Move the project

Copy the project folder into

```
xampp/htdocs/
```

---

### 3. Import the database

1. Start **Apache** and **MySQL** using XAMPP.
2. Open **phpMyAdmin**.
3. Create a new database.
4. Import the provided SQL file.

---

### 4. Configure Email

Create or update the email configuration file with your SMTP credentials.

Example:

```php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USER', 'your_email@gmail.com');
define('SMTP_PASS', 'your_app_password');
define('SMTP_PORT', 587);
```

> **Important:** Do not upload your real SMTP credentials to a public GitHub repository.

---

### 5. Run the project

Open your browser and visit

```
http://localhost/PROGram_CarParts/
```

---

# Default Accounts

Please refer to the provided **sample_accounts.txt** file for testing credentials.

---

# Email Verification

This project uses **PHPMailer** to send email verification messages during user registration.

A Gmail account with an App Password is recommended for SMTP configuration.

---

# Screenshots

Screenshots of the system are included in the project documentation submitted for the course.

---

# Developers

**Group Name:** PROGram

Developed by the members of Group PROGram.

---

# Course Information

This project was developed as partial fulfillment of the requirements for the course on PHP Server-Side Programming.

---

# Disclaimer

This website is intended **for educational purposes only**. Product names, images, and information used within this project are solely for demonstration and academic requirements. No commercial use is intended.

---

# License

This project is intended for academic and educational use only.
