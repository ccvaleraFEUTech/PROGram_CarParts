# PROGram Car Parts

PROGram Car Parts is a web-based motorcycle and car parts e-commerce platform developed using native PHP and MySQL. This repository contains the complete source code and database for the project. The website follows a dual-system architecture consisting of a Buyer System for customers and a Seller System for administrators to manage products, inventory, users, and reports.

> **Note:** PROGram Car Parts was primarily developed as a desktop website for educational purposes. Mobile responsiveness has been partially implemented, and some layouts may not display optimally on smaller screens.

---

# Main Features

## Buyer System

- Buyer registration with email confirmation
- Secure user login
- Browse products by category
- Shopping cart with quantity management
- Checkout and simulated payment process
- Buyer order history
- User profile management

## Seller System

- Administrator login
- User management
- Product and inventory management
- Price management
- Inventory report
- Audit log report
- Order management

---

# Core System Features

## 3.1 Buyer Experience

The buyer-facing application provides a complete shopping workflow while emphasizing account verification and ease of use.

- **User Registration**  
  Allows customers to create an account by providing their complete name, email address, password, address, and contact number.

- **Email Confirmation**  
  Newly registered users receive a verification email through PHPMailer before accessing their account.

- **Product Catalog**  
  Products are organized into categories, allowing users to browse motorcycle and car parts more efficiently.

- **Shopping Cart**  
  Customers can add products to their cart, update quantities, and review selected items before checkout.

- **Checkout Process**  
  Users can proceed through checkout and a simulated payment page for demonstration purposes.

- **Order History**  
  Buyers can review their previous purchases through their account.

---

## 3.2 Seller Administration

The Seller System serves as the administrative backend for managing the platform.

- **Administrator Management**  
  Manage administrator accounts with appropriate system access.

- **Product Management**  
  Add, edit, update, or remove products available in the online store.

- **Inventory Management**  
  Monitor available stock levels and update product quantities.

- **Price Management**  
  Modify product pricing whenever necessary.

- **Reports**
  - Inventory Report showing remaining stock.
  - Audit Log recording activities performed by administrators.

- **Order Management**  
  View and manage customer orders placed through the website.

---

# Website Access

- Open the project root directory to access the Buyer Store.
- Open `/seller/` to access the Seller Administration panel.
- Buyer pages are available through the main navigation menu.
- Seller pages require administrator authentication.

---

# Technologies Used

| Component | Technology |
|-----------|------------|
| Backend | Native PHP (No PHP Frameworks) |
| Database | MySQL / MariaDB |
| Frontend | HTML5, CSS3, JavaScript |
| Email Service | PHPMailer (SMTP) |
| Development Environment | XAMPP |
| Hosting | InfinityFree |

---

# Installation & Usage

## Prerequisites

- XAMPP (or any PHP + MySQL environment)
- PHP 8.0 or later
- MySQL / MariaDB
- Web browser

---

## Local Setup

1. Clone or download this repository.
2. Place the project folder inside the `htdocs` directory of XAMPP.
3. Start **Apache** and **MySQL**.
4. Import the provided SQL database using phpMyAdmin.
5. Configure the SMTP email credentials for PHPMailer.
6. Open:

```
http://localhost/PROGram_CarParts/
```

---

# Educational Disclaimer

This website was developed solely for educational purposes as a final project requirement for the course **CCS0043/L – Application Development and Emerging Technologies**.

- The group name and project logo are displayed throughout the website in compliance with the project requirements.
- A disclaimer stating that the website is for educational purposes only is included in the footer of every webpage.
- Product listings, transactions, and payment pages are intended for demonstration purposes only. No real financial transactions are processed.
