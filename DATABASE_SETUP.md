# PROGram Car Parts Database Setup

This project uses the procedural PHP and MySQL approach discussed in the supplied lessons. The old `mysql_*` functions shown in the PDF were removed from PHP, so this project uses their current procedural `mysqli_*` equivalents.

## Import with phpMyAdmin

1. Start **Apache** and **MySQL** in XAMPP.
2. Open `http://localhost/phpmyadmin/`.
3. Select **Import**.
4. Choose `database/program_carparts.sql`.
5. Select **Go**.
6. Open `http://localhost/PROGram_CarParts/`.

The connection settings are in `includes/database.php`. The default XAMPP settings are database user `root` with a blank password.

## Test Accounts

- Seller: `admin@program.com` / `Admin123!`
- Customer: `customer@program.com` / `Customer123!`

Change these passwords after testing.
