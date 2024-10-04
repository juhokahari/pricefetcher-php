/* ceate the database */
CREATE DATABASE IF NOT EXISTS pricefetcher;

/* use the database */
USE pricefetcher;

/* create a test user, set a password*/
CREATE USER 'tester'@'localhost' IDENTIFIED BY 'SET_UP_PASSWORD_HERE';
GRANT ALL PRIVILEGES ON pricefetcher.* TO 'tester'@'localhost';
FLUSH PRIVILEGES;

/* create the products table */
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    number VARCHAR(50) UNIQUE,
    name VARCHAR(255),
    bottle_size VARCHAR(50),
    price DECIMAL(10, 2)
);