
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS rmis;
CREATE DATABASE IF NOT EXISTS rmis;

DROP USER IF EXISTS'rmis_user'@'%';
CREATE USER IF NOT EXISTS 'rmis_user'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON rmis.* TO 'rmis_user'@'%';
USE rmis;


-- Table structure for table `reg_login`
CREATE TABLE `reg_login` (
  `regid` int(100) NOT NULL AUTO_INCREMENT,
  `Reg_Email` varchar(50) NOT NULL,
  `Reg_Password` varchar(50) NOT NULL,
  PRIMARY KEY (`regid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Initial admin data for reg_login
INSERT INTO `reg_login` (`regid`, `Reg_Email`, `Reg_Password`) VALUES
(1, 'registrar@gmail.com', '1234');




CREATE TABLE `signup` (
  `StudentId` int(100) NOT NULL AUTO_INCREMENT,  
  `FirstName` varchar(50) NOT NULL,                 
  `LastName` varchar(50) NOT NULL,                             
  `StudentNumber` varchar(20) NOT NULL,           
  `Email` varchar(50) NOT NULL,                   
  `Password` varchar(50) NOT NULL,             
  PRIMARY KEY (`StudentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `signup` (`StudentId`, `FirstName`, `LastName`, `StudentNumber`, `Email`, `Password`) 
VALUES 
(1, 'Audreylyn', 'Morana', '22-1586', 'audreylyn@gmail.com', '123'),
(2, 'Juliana', 'Macaranas', '22-1587', 'juliana@gmail.com', 'password123'),
(3, 'Alijandro', 'Batac', '22-1588', 'aj@gmail.com', 'mypassword'),
(4, 'Ivy', 'Nava', '22-1589', 'ivy@gmail.com', 'password456'),
(5, 'Marianne', 'Saquez', '22-1590', 'marianne@gmail.com', 'securepassword');



 -- user_reservation
 CREATE TABLE `room_requests` (
  `request_id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(100) NOT NULL,
  `year_section` VARCHAR(50) NOT NULL,
  `department` VARCHAR(50) NOT NULL,
  `room_preferred` VARCHAR(50) NOT NULL,
  `purpose` VARCHAR(100) NOT NULL,
  `start_datetime` DATETIME NOT NULL,
  `end_datetime` DATETIME NOT NULL,
  `status` VARCHAR(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- Inserting sample room reservation requests with updated year and section formats
INSERT INTO room_requests (full_name, year_section, department, room_preferred, purpose, start_datetime, end_datetime, status)
VALUES 
('Audreylyn Morana', 'BSA 1-1', 'Accountancy', 'Classroom 1', 'For Study', '2024-12-05 08:00:00', '2024-12-05 12:00:00', 'pending'),
('Juliana Macaranas', 'BSA 1-2', 'Business Administration', 'Computer Laboratory', 'Project Work', '2024-12-06 09:00:00', '2024-12-06 11:00:00', 'pending'),
('Alijandro Batac', 'BSHM 2-1', 'Hospitality Management', 'Gymnasium', 'Physical Education', '2024-12-07 14:00:00', '2024-12-07 16:00:00', 'pending'),
('Ivy Nava', 'BSED 3-1', 'Education and Arts', 'Classroom 2', 'Group Study', '2024-12-08 13:00:00', '2024-12-08 15:00:00', 'pending'),
('Marianne Saquez', 'BSCJ 4-1', 'Criminal Justice', 'Classroom 3', 'Seminar', '2024-12-09 10:00:00', '2024-12-09 12:00:00', 'pending');



CREATE TABLE `rooms` (
    `room_id` INT AUTO_INCREMENT PRIMARY KEY,
    `room_name` VARCHAR(100) NOT NULL,
    `room_description` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO rooms (room_name, room_description) VALUES
('Classroom 1', 'Description for Classroom 1'),
('Classroom 2', 'Description for Classroom 2'),
('Classroom 3', 'Description for Classroom 3'),
('Gymnasium 1', 'Description for Gymnasium 1'),
('Gymnasium 2', 'Description for Gymnasium 2'),
('Computer Laboratory 1', 'Description for Computer Laboratory 1'),
('Computer Laboratory 2', 'Description for Computer Laboratory 2');


ALTER TABLE room_requests ADD COLUMN notification_read TINYINT(1) DEFAULT 0;