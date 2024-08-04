-- CREATE A DATABASE with name okoa

CREATE DATABASE IF NOT EXISTS okoa;


USE okoa;

-- CREATE TABLES

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- CREATE TABLE user profile

CREATE TABLE profile(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    phone VARCHAR(100) NOT NULL,
    address VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);


-- CREATE TABLE user Bugdet 

CREATE TABLE budget(
    id INT AUTO_INCREMENT PRIMARY KEY,
    budget_user_id INT NOT NULL,
    budget_name VARCHAR(100) NOT NULL,
    budget_amount DECIMAL(10, 2) NOT NULL,
    budget_occurence ENUM('daily', 'weekly', 'monthly', 'yearly') NOT NULL,
    budget_status ENUM('active', 'inactive') NOT NULL,
    budget_reminder_status ENUM('active', 'inactive') NOT NULL,
    budget_expire_date DATE NULL,
    budget_description TEXT NULL,
    budget_created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(budget_user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- CREATE TABLE items category

CREATE TABLE categories(
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_user_id INT NOT NULL,
    category_name VARCHAR(100) NOT NULL,
    category_estimated_amount DECIMAL(10, 2) NOT NULL,
    category_occurence ENUM('daily', 'weekly', 'monthly', 'yearly') NOT NULL,
    category_status ENUM('active', 'inactive') NOT NULL,
    reminder_date DATE NULL,
    category_description TEXT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(category_user_id) REFERENCES users(id) ON DELETE CASCADE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- CREATE TABLE user expenses

CREATE TABLE expenses(
    id INT AUTO_INCREMENT PRIMARY KEY,
    expense_user_id INT NOT NULL,
    expense_name VARCHAR(100) NOT NULL,
    expense_amount DECIMAL(10, 2) NOT NULL,
    expense_category_name VARCHAR(100) DEFAULT NULL,
    expense_budget_id INT NOT NULL,
    expense_description TEXT NOT NULL,
    expense_created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(expense_user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY(expense_budget_id) REFERENCES budget(id) ON DELETE CASCADE
);

-- CREATE TABLE user income

CREATE TABLE income(
    id INT AUTO_INCREMENT PRIMARY KEY,
    income_user_id INT NOT NULL,
    income_amount DECIMAL(10, 2) NOT NULL,
    income_source VARCHAR(100) NOT NULL,
    income_description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



-- CREATE TABLE user reminders

CREATE TABLE reminders(
    id INT AUTO_INCREMENT PRIMARY KEY,
    reminder_user_id INT NOT NULL,
    reminder_name VARCHAR(100) NOT NULL,
    reminder_status ENUM('active', 'inactive') NOT NULL,
    reminder_type ENUM('income', 'expense', 'budget') NOT NULL,
    reminder_read_status ENUM('read', 'unread') NOT NULL,
    reminder_message TEXT NULL,
    reminder_description TEXT NOT NULL,
    reminder_date_time DATETIME NOT NULL
);

-- Reset password table

CREATE TABLE reset_password(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(100) NOT NULL,
    token_status ENUM('active', 'inactive') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);