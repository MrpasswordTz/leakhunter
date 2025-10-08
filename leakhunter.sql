-- LeakHunter Database Schema
-- Cybersecurity Data Breach Monitoring System

CREATE DATABASE IF NOT EXISTS leakhunter;
USE leakhunter;

-- Users table for admin authentication
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    api_token VARCHAR(500) DEFAULT NULL,
    tokens_remaining INT DEFAULT 100,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE
);

-- Activity logs table
CREATE TABLE activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    details TEXT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Search history table
CREATE TABLE search_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    query VARCHAR(500) NOT NULL,
    results_count INT DEFAULT 0,
    tokens_used INT DEFAULT 0,
    search_type ENUM('email', 'username', 'name', 'phone', 'other') DEFAULT 'other',
    results_data LONGTEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- API usage statistics
CREATE TABLE api_usage (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date DATE NOT NULL,
    requests_count INT DEFAULT 0,
    tokens_consumed INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_date (user_id, date)
);

-- Insert default admin user
-- Password: admin123 (bcrypt hashed)
INSERT INTO users (email, password, full_name, tokens_remaining) VALUES 
('admin@fsociety.com', '$2y$10$iqX.TzOEkzMBMBaAqyMOb.wPyb5UqhPNpVQ6Lf1cghs2VgOc6nCta', 'System Administrator', 100);

-- Create indexes for better performance
CREATE INDEX idx_activity_logs_user_id ON activity_logs(user_id);
CREATE INDEX idx_activity_logs_created_at ON activity_logs(created_at);
CREATE INDEX idx_search_history_user_id ON search_history(user_id);
CREATE INDEX idx_search_history_created_at ON search_history(created_at);
CREATE INDEX idx_api_usage_user_date ON api_usage(user_id, date);
