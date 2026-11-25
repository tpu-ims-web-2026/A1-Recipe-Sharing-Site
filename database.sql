-- Creates and selects the database
CREATE DATABASE IF NOT EXISTS crumbly CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE crumbly;

-- Users table: Stores member and admin account details
CREATE TABLE IF NOT EXISTS users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('member','admin') NOT NULL DEFAULT 'member',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categories table: Stores recipe categories
CREATE TABLE IF NOT EXISTS categories(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

-- Recipes table: Stores title, ingredients, instructions, and image linked to user and category
CREATE TABLE IF NOT EXISTS recipes(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    category_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    ingredients TEXT NOT NULL,
    instructions TEXT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Comments table: Stores user comments on recipes
CREATE TABLE IF NOT EXISTS comments(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    recipe_id INT NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
     FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (recipe_id) REFERENCES recipes(id)
);

-- Inserts default category records to initialize the table
INSERT INTO categories (name) VALUE ('Breakfast'),('Soups'),('Main Course'),('Snacks'),('Pasta'),('Pizza'),('Pastries'),('Salads'),('Desserts'),('Drinks');