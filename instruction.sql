CREATE DATABASE  IF NOT EXISTS UsersDB;
USE UsersDB;
CREATE table IF NOT EXISTS state(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
) ENGINE=INNODB;

CREATE table IF NOT EXISTS city(
   id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(50) UNIQUE NOT NULL,
   state_id int,
   INDEX state_index (state_id),
   FOREIGN KEY (state_id) REFERENCES state(id)
)  ENGINE=INNODB;

CREATE table IF NOT EXISTS users(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    address VARCHAR(250) NOT NULL,
    state_id int,
    city_id int,
    INDEX state_index (state_id),
    FOREIGN KEY (state_id) REFERENCES state(id),
    INDEX city_index (city_id),
    FOREIGN KEY (city_id) REFERENCES city(id)
)  ENGINE=INNODB;
