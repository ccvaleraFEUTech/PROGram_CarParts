CREATE DATABASE IF NOT EXISTS program_carparts;
USE program_carparts;

CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50),
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    role VARCHAR(30) NOT NULL DEFAULT 'Customer',
    status VARCHAR(20) NOT NULL DEFAULT 'Active',
    order_updates INT NOT NULL DEFAULT 1,
    promotions INT NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (email)
);

CREATE TABLE IF NOT EXISTS addresses (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    label VARCHAR(30) NOT NULL,
    street_address VARCHAR(150) NOT NULL,
    barangay VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    province VARCHAR(100) NOT NULL,
    region VARCHAR(100) NOT NULL,
    is_default INT NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS categories (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(80) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

CREATE TABLE IF NOT EXISTS products (
    id INT NOT NULL AUTO_INCREMENT,
    category_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    sku VARCHAR(50) NOT NULL,
    price DOUBLE NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    reorder_level INT NOT NULL DEFAULT 5,
    image VARCHAR(255),
    description VARCHAR(500),
    active INT NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (sku),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE IF NOT EXISTS orders (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    order_number VARCHAR(40) NOT NULL,
    full_name VARCHAR(150) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    delivery_address VARCHAR(500) NOT NULL,
    payment_method VARCHAR(30) NOT NULL,
    total_amount DOUBLE NOT NULL,
    status VARCHAR(30) NOT NULL DEFAULT 'Pending',
    created_at DATETIME NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (order_number),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS order_items (
    id INT NOT NULL AUTO_INCREMENT,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(150) NOT NULL,
    price DOUBLE NOT NULL,
    quantity INT NOT NULL,
    subtotal DOUBLE NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(150) NOT NULL,
    message VARCHAR(1000) NOT NULL,
    created_at DATETIME NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS audit_logs (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT,
    action VARCHAR(100) NOT NULL,
    module VARCHAR(50) NOT NULL,
    details VARCHAR(500) NOT NULL,
    created_at DATETIME NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT IGNORE INTO users
(id, first_name, middle_name, last_name, email, password, contact_number, role, status, order_updates, promotions, created_at)
VALUES
(1, 'Jade', 'Carlos', 'Castillo', 'admin@program.com', '$2y$10$3SST.Pm/l3iJqWrP94J0b.j2ZXDtp7UGOuZo68sMUzqBOwKlvjrsG', '09123456789', 'Super Admin', 'Active', 1, 0, NOW()),
(2, 'Juan', 'Dela', 'Cruz', 'customer@program.com', '$2y$10$TlE/N4h6/BW2w2g7Y8ttJearDfbXY/QcD59.xCrAg3IQOA6hUTJh.', '09987654321', 'Customer', 'Active', 1, 1, NOW());

INSERT IGNORE INTO addresses
(id, user_id, label, street_address, barangay, city, province, region, is_default)
VALUES
(1, 1, 'Default', '123 Admin Street', 'Sampaloc', 'Manila', 'Metro Manila', 'National Capital Region', 1),
(2, 2, 'Default', '123 Juan Dela Cruz Street', 'Matibay', 'Marikina City', 'Metro Manila', 'National Capital Region', 1);

INSERT IGNORE INTO categories (id, name) VALUES
(1, 'Engines'),
(2, 'Brakes'),
(3, 'Tires/Wheels'),
(4, 'Accessories/Boosts'),
(5, 'Transmissions'),
(6, 'Engine Pipes'),
(7, 'Exhausts'),
(8, 'Covers/Paints'),
(9, 'Turbochargers'),
(10, 'Gauges'),
(11, 'Suspension Springs'),
(12, 'Aerodynamics'),
(13, 'Radio/Computers');

INSERT IGNORE INTO products
(id, category_id, name, sku, price, stock, reorder_level, image, description, active, created_at)
VALUES
(1, 10, 'AEM X-Series Wideband UEGO Gauge Kit', 'AEM-UEGO-001', 50130.60, 34, 10, 'assets/images/products/aem-x-series-uego.jpg', 'A fast responding wideband air and fuel ratio controller gauge for performance vehicles.', 1, NOW()),
(2, 11, 'Eibach Pro-Kit Lowering Springs', 'EIB-PRO-014', 12623.56, 8, 10, 'assets/images/products/eibach-pro-kit.jpg', 'Performance lowering springs designed for improved handling and appearance.', 1, NOW()),
(3, 9, 'Garrett G25-550 Turbocharger', 'GAR-G25-550', 19520.07, 0, 5, 'assets/images/products/garrett-g25.jpg', 'Compact turbocharger made for quick response and dependable power.', 1, NOW()),
(4, 12, 'APR GTC-300 Adjustable Rear Wing', 'APR-GTC-300', 91835.29, 15, 5, 'assets/images/products/gtc-300.png', 'An adjustable rear wing for improved high-speed stability and aerodynamics.', 1, NOW()),
(5, 7, 'HKS Hi-Power Exhaust', 'HKS-HPX-220', 130267.94, 5, 8, 'assets/images/index/hks-hi-power.jpg', 'A performance exhaust system with a sporty tone and improved gas flow.', 1, NOW()),
(6, 11, 'Tein Flex Z Coilover Suspension Kit', 'TEIN-FLXZ-09', 50130.60, 42, 10, 'assets/images/index/tein-flex-z.jpg', 'Adjustable coilover suspension for street comfort and responsive handling.', 1, NOW()),
(7, 2, 'Brembo GT Systems 4 Piston Brake Kit', 'BRM-GT4-RD', 80632.42, 12, 5, 'assets/images/index/brembo-4-piston.jpg', 'A four-piston front brake kit made for dependable stopping performance.', 1, NOW());
