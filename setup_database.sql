-- Table: Admins (For Admin Panel Login)
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL -- Use password_hash() in PHP
);

-- Table: Bookings (For 'Book Now' requests)
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    tour_package VARCHAR(100) NOT NULL, -- e.g., '1N 2D', 'Luxury'
    travel_date DATE NOT NULL,
    number_of_people INT NOT NULL,
    status ENUM('Pending', 'Confirmed', 'Cancelled') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: Inquiries (For 'Contact Us' form)
CREATE TABLE IF NOT EXISTS inquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin (username: admin, password: password123)
-- Hash generated using password_hash('password123', PASSWORD_DEFAULT)
INSERT INTO admins (username, password) VALUES ('admin', '$2y$10$S9l7.dJ8J1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1');
-- Note: The above hash is a placeholder. Please use admin/reset_password.php to set the initial password.
