-- Create database
CREATE DATABASE IF NOT EXISTS kabadiwala;
USE kabadiwala;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type ENUM('customer', 'dealer') DEFAULT 'customer',
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Pickups table
CREATE TABLE IF NOT EXISTS pickups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    pincode VARCHAR(10) NOT NULL,
    pickup_date DATE NOT NULL,
    pickup_time VARCHAR(20) NOT NULL,
    material_type VARCHAR(50),
    estimated_weight DECIMAL(10,2),
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Scrap listings table
CREATE TABLE IF NOT EXISTS scrap_listings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    material_category VARCHAR(50) NOT NULL,
    weight DECIMAL(10,2) NOT NULL,
    condition_type ENUM('excellent', 'good', 'average') NOT NULL,
    estimated_price DECIMAL(10,2) NOT NULL,
    photos TEXT,
    status ENUM('pending', 'approved', 'sold', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- AI analysis table
CREATE TABLE IF NOT EXISTS ai_analysis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    photos TEXT NOT NULL,
    estimated_weight DECIMAL(10,2),
    material_types TEXT,
    quality_score DECIMAL(3,2),
    estimated_value DECIMAL(10,2),
    analysis_result TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Transactions table
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    scrap_listing_id INT,
    transaction_type ENUM('sale', 'purchase') NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    payment_method VARCHAR(50),
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (scrap_listing_id) REFERENCES scrap_listings(id) ON DELETE SET NULL
);

-- Insert sample price data
CREATE TABLE IF NOT EXISTS material_prices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    material_type VARCHAR(50) NOT NULL UNIQUE,
    min_price DECIMAL(10,2) NOT NULL,
    max_price DECIMAL(10,2) NOT NULL,
    avg_price DECIMAL(10,2) NOT NULL,
    unit VARCHAR(10) DEFAULT 'kg',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO material_prices (material_type, min_price, max_price, avg_price) VALUES
('paper', 8.00, 12.00, 10.00),
('plastic', 15.00, 25.00, 20.00),
('metal', 30.00, 150.00, 80.00),
('electronics', 50.00, 200.00, 120.00),
('glass', 2.00, 5.00, 3.50);
