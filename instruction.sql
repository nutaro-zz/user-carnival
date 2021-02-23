CREATE DATABASE  IF NOT EXISTS UsersDB;
USE UsersDB;
CREATE table IF NOT EXISTS state(id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    state_id int);
CREATE table IF NOT EXISTS city(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    state_id int,
    FOREIGN KEY (state_id) REFERENCES state(id));
CREATE table IF NOT EXISTS users(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    address VARCHAR(250) NOT NULL,
    state_id int,
    city_id int,
    FOREIGN KEY (state_id) REFERENCES state(id),
    FOREIGN KEY (city_id) REFERENCES city(id));