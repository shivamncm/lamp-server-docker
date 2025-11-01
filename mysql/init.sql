CREATE DATABASE IF NOT EXISTS portfolio_db;
USE portfolio_db;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(150),
  role VARCHAR(100)
);

INSERT INTO users (name, email, role) VALUES
('Shivam','shivam@example.com','Admin'),
('A Dev','dev@example.com','User');