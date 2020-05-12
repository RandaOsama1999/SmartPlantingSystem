-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 12, 2020 at 08:24 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartplanting`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Parent_ID` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`ID`, `Name`, `Parent_ID`) VALUES
(1, 'Cairo', 0),
(2, 'Alexandria', 0),
(3, 'New Cairo', 1),
(4, 'Nasr City', 1),
(5, 'Sidi beshr', 2);

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`ID`, `content`) VALUES
(1, 'The plants need to be watered'),
(2, 'Your plant is ready to be harvested'),
(3, 'There is a disease affected your plants!');

-- --------------------------------------------------------

--
-- Table structure for table `fans`
--

DROP TABLE IF EXISTS `fans`;
CREATE TABLE IF NOT EXISTS `fans` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Land_ID` int(11) NOT NULL,
  `DateTime` datetime NOT NULL,
  `opened` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Land_ID` (`Land_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `frame`
--

DROP TABLE IF EXISTS `frame`;
CREATE TABLE IF NOT EXISTS `frame` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Frame` longblob NOT NULL,
  `Time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
CREATE TABLE IF NOT EXISTS `gender` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`ID`, `gender`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `images_frames`
--

DROP TABLE IF EXISTS `images_frames`;
CREATE TABLE IF NOT EXISTS `images_frames` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Image_Id` int(11) NOT NULL,
  `Frame_Id` int(11) NOT NULL,
  `Land_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Image_Id` (`Image_Id`,`Frame_Id`,`Land_ID`),
  KEY `Land_ID` (`Land_ID`),
  KEY `Frame_Id` (`Frame_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `land`
--

DROP TABLE IF EXISTS `land`;
CREATE TABLE IF NOT EXISTS `land` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `landowner_ID` int(11) NOT NULL,
  `address_ID` int(10) NOT NULL,
  `location` text NOT NULL,
  `greenhouse_L` double NOT NULL,
  `greenhouse_W` double NOT NULL,
  `greenhouse_H` double NOT NULL,
  `plantType_ID` int(11) NOT NULL,
  `state_ID` int(11) NOT NULL,
  `updateRequest` tinyint(1) NOT NULL,
  `deleteRequest` tinyint(1) NOT NULL,
  `CreatedDateTime` datetime NOT NULL,
  `LastUpdatedDateTime` datetime NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `landowner_ID` (`landowner_ID`),
  KEY `plantType_ID` (`plantType_ID`),
  KEY `state_ID` (`state_ID`),
  KEY `address_ID` (`address_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `land`
--

INSERT INTO `land` (`ID`, `landowner_ID`, `address_ID`, `location`, `greenhouse_L`, `greenhouse_W`, `greenhouse_H`, `plantType_ID`, `state_ID`, `updateRequest`, `deleteRequest`, `CreatedDateTime`, `LastUpdatedDateTime`, `IsDeleted`) VALUES
(1, 2, 3, 'First settlement, block 5', 120, 70, 110, 1, 2, 1, 0, '2020-02-21 18:35:38', '2020-04-06 16:10:01', 0),
(2, 2, 5, 'block 503', 550, 320, 400, 2, 2, 0, 1, '2020-02-21 18:56:43', '2020-02-21 18:56:43', 0),
(3, 3, 3, 'fifth settlement, block 402', 150, 200, 160, 2, 1, 0, 0, '2020-03-04 18:30:37', '2020-03-04 18:30:37', 0),
(4, 2, 5, 'block 306', 120, 70, 110, 1, 2, 1, 0, '2020-02-21 18:35:38', '2020-02-22 16:21:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `landupdaterequests`
--

DROP TABLE IF EXISTS `landupdaterequests`;
CREATE TABLE IF NOT EXISTS `landupdaterequests` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `Land_ID` int(11) NOT NULL,
  `ItemToBeUpdated` varchar(100) NOT NULL,
  `NewValue` text NOT NULL,
  `State_ID` int(10) NOT NULL,
  `CreatedDateTime` datetime NOT NULL,
  `LastUpdatedDateTime` datetime NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `State_ID` (`State_ID`),
  KEY `Land_ID` (`Land_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `landupdaterequests`
--

INSERT INTO `landupdaterequests` (`ID`, `Land_ID`, `ItemToBeUpdated`, `NewValue`, `State_ID`, `CreatedDateTime`, `LastUpdatedDateTime`, `IsDeleted`) VALUES
(4, 1, 'Plant Type', '3', 1, '2020-03-25 19:44:22', '2020-03-25 19:44:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ledlights`
--

DROP TABLE IF EXISTS `ledlights`;
CREATE TABLE IF NOT EXISTS `ledlights` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ledlights`
--

INSERT INTO `ledlights` (`ID`, `color`) VALUES
(1, 'Red'),
(2, 'Blue'),
(3, 'Green');

-- --------------------------------------------------------

--
-- Table structure for table `ledsystem`
--

DROP TABLE IF EXISTS `ledsystem`;
CREATE TABLE IF NOT EXISTS `ledsystem` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LED_ID` int(11) NOT NULL,
  `Land_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `opened` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `LED_ID` (`LED_ID`),
  KEY `Lend_ID` (`Land_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ledsystem`
--

INSERT INTO `ledsystem` (`ID`, `LED_ID`, `Land_ID`, `Date`, `opened`) VALUES
(1, 2, 1, '2020-02-25', 1),
(2, 3, 1, '2020-02-25', 1),
(3, 2, 1, '2020-02-26', 1),
(4, 3, 1, '2020-02-26', 1),
(5, 1, 1, '2020-03-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
CREATE TABLE IF NOT EXISTS `links` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `PhysicalAddress` varchar(50) NOT NULL,
  `FriendlyAddress` varchar(50) NOT NULL,
  `CreatedDateTime` datetime NOT NULL,
  `LastUpdatedDateTime` datetime NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`ID`, `PhysicalAddress`, `FriendlyAddress`, `CreatedDateTime`, `LastUpdatedDateTime`, `IsDeleted`) VALUES
(3, 'AddLand.php', 'Add new Land Request', '2020-02-17 04:11:20', '2020-02-17 04:11:20', 0),
(4, 'updatemyself.php', 'Update Your Info', '2020-02-26 04:19:19', '2020-02-26 04:19:19', 0),
(5, 'DeleteLandRequest.php', 'Delete Land Request', '2020-02-17 04:11:20', '2020-02-17 04:11:20', 0),
(6, 'ViewAllLands.php', 'View All your Lands', '2020-02-17 04:11:20', '2020-02-17 04:11:20', 0),
(7, 'ViewAllLandsRequests.php', 'View New Land Requests', '2020-02-17 04:11:20', '2020-02-17 04:11:20', 0),
(8, 'ViewCurrentLandsRequests.php', 'View Current Land Update/Delete Requests', '2020-02-17 04:11:20', '2020-02-17 04:11:20', 0),
(9, 'AddNewPlant.php', 'Add New Plant', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(10, 'DeletePlant.php', 'Delete Plant', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(13, 'AddNewAdmin.php', 'Add New Admin', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(14, 'DeleteAdmin.php', 'Delete Admin', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(15, 'viewAllLandowners.php', 'View All Landowners', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(16, 'AddNotificationContent.php', 'Add Notification Content', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(17, 'DeleteNotificationContent.php', 'Delete Notification Content', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(18, 'AddSensor.php', 'Add new sensor', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(19, 'DeleteSensor.php', 'Delete sensor', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(20, 'ChoosePlantToViewStatistcsByAdmin.php', 'View Lands Statistics', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(21, 'AddNewLEDLight.php', 'Add New LED light color', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(22, 'DeleteLEDLight.php', 'Delete LED light color', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(23, 'ViewLEDLight.php', 'View All LED light colors', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(24, 'AddPlantLEDLight.php', 'Add Plant needed LED light color', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(11) NOT NULL,
  `content_ID` int(11) NOT NULL,
  `land_ID` int(11) NOT NULL,
  `DateTime` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `landowner_ID` (`user_ID`),
  KEY `content_ID` (`content_ID`),
  KEY `land_ID` (`land_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`ID`, `user_ID`, `content_ID`, `land_ID`, `DateTime`) VALUES
(1, 2, 1, 1, '2020-03-18 20:00:30'),
(2, 2, 1, 2, '2020-03-19 20:00:30'),
(3, 3, 3, 3, '2020-03-19 20:00:30');

-- --------------------------------------------------------

--
-- Table structure for table `plant`
--

DROP TABLE IF EXISTS `plant`;
CREATE TABLE IF NOT EXISTS `plant` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `plantName` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plant`
--

INSERT INTO `plant` (`ID`, `plantName`) VALUES
(1, 'Tomato'),
(2, 'Bell Pepper'),
(3, 'Cucumber');

-- --------------------------------------------------------

--
-- Table structure for table `plantneededled`
--

DROP TABLE IF EXISTS `plantneededled`;
CREATE TABLE IF NOT EXISTS `plantneededled` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Stage_ID` int(11) NOT NULL,
  `Plant_ID` int(11) NOT NULL,
  `LED_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Plant_ID` (`Plant_ID`,`LED_ID`),
  KEY `Stage_ID` (`Stage_ID`),
  KEY `LED_ID` (`LED_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plantneededled`
--

INSERT INTO `plantneededled` (`ID`, `Stage_ID`, `Plant_ID`, `LED_ID`) VALUES
(1, 1, 1, 2),
(2, 1, 1, 3),
(3, 2, 1, 1),
(10, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `planttemperature`
--

DROP TABLE IF EXISTS `planttemperature`;
CREATE TABLE IF NOT EXISTS `planttemperature` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Temperature` int(11) NOT NULL,
  `plant_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `plant_ID` (`plant_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `planttemperature`
--

INSERT INTO `planttemperature` (`ID`, `Temperature`, `plant_ID`) VALUES
(1, 20, 1),
(6, 35, 2),
(7, 36, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

DROP TABLE IF EXISTS `sensors`;
CREATE TABLE IF NOT EXISTS `sensors` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sensors`
--

INSERT INTO `sensors` (`ID`, `Type`) VALUES
(1, 'DHT11'),
(3, 'Soil Moisture');

-- --------------------------------------------------------

--
-- Table structure for table `sensor_readings`
--

DROP TABLE IF EXISTS `sensor_readings`;
CREATE TABLE IF NOT EXISTS `sensor_readings` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Land_ID` int(11) NOT NULL,
  `Sensor_ID` int(11) NOT NULL,
  `Reading` double NOT NULL,
  `DateTime` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Land_ID` (`Land_ID`),
  KEY `Sensor_ID` (`Sensor_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sensor_readings`
--

INSERT INTO `sensor_readings` (`ID`, `Land_ID`, `Sensor_ID`, `Reading`, `DateTime`) VALUES
(2, 1, 1, 20, '2020-03-17 19:52:21'),
(3, 1, 3, 401, '2020-03-17 19:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

DROP TABLE IF EXISTS `stages`;
CREATE TABLE IF NOT EXISTS `stages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Stage` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`ID`, `Stage`) VALUES
(1, 'Seeding'),
(2, 'Flowering'),
(3, 'Harvesting');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `State` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`ID`, `State`) VALUES
(1, 'waiting'),
(2, 'accepted'),
(3, 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `testing_threshold`
--

DROP TABLE IF EXISTS `testing_threshold`;
CREATE TABLE IF NOT EXISTS `testing_threshold` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Land_ID` int(11) NOT NULL,
  `Stage_ID` int(11) NOT NULL,
  `Percentage` double NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Stage_ID` (`Stage_ID`),
  KEY `Land_ID` (`Land_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testing_threshold`
--

INSERT INTO `testing_threshold` (`ID`, `Land_ID`, `Stage_ID`, `Percentage`, `Date`) VALUES
(1, 1, 1, 8, '2020-02-23'),
(4, 1, 1, 8.1, '2020-02-24'),
(7, 1, 1, 8.2, '2020-02-25'),
(8, 1, 1, 8.3, '2020-02-26'),
(9, 1, 1, 8.4, '2020-02-27'),
(10, 1, 1, 8.5, '2020-02-28'),
(11, 1, 1, 8.6, '2020-02-29'),
(12, 1, 1, 8.7, '2020-03-01'),
(13, 1, 1, 8.8, '2020-03-02'),
(14, 1, 1, 8.9, '2020-03-03'),
(15, 1, 1, 9, '2020-03-04'),
(16, 1, 1, 9.2, '2020-03-05'),
(17, 1, 1, 9.4, '2020-03-05'),
(18, 1, 1, 9.6, '2020-03-06'),
(19, 1, 1, 9.7, '2020-03-07'),
(20, 1, 1, 9.8, '2020-03-08'),
(21, 1, 1, 9.9, '2020-03-09'),
(22, 1, 1, 10, '2020-03-10'),
(23, 1, 1, 10.1, '2020-03-11'),
(24, 1, 1, 10.2, '2020-03-12'),
(25, 1, 1, 10.3, '2020-03-13'),
(26, 1, 1, 10.4, '2020-03-14'),
(27, 1, 1, 10.5, '2020-03-15'),
(28, 1, 1, 10.6, '2020-03-16'),
(29, 1, 1, 10.7, '2020-03-17'),
(30, 1, 1, 10.8, '2020-03-18'),
(31, 1, 1, 10.9, '2020-03-19'),
(32, 1, 1, 11, '2020-03-20'),
(33, 1, 1, 11.1, '2020-03-21'),
(34, 1, 1, 11.2, '2020-03-22'),
(35, 1, 1, 11.3, '2020-03-23'),
(36, 1, 1, 11.4, '2020-03-24'),
(37, 1, 1, 11.5, '2020-03-25'),
(38, 1, 1, 11.6, '2020-03-26'),
(39, 1, 1, 11.7, '2020-03-27'),
(41, 4, 1, 8, '2020-02-23'),
(42, 4, 1, 8.1, '2020-02-24'),
(43, 4, 1, 8.2, '2020-02-25'),
(44, 4, 1, 8.3, '2020-02-26'),
(45, 4, 1, 8.4, '2020-02-27'),
(46, 4, 1, 8.5, '2020-02-28'),
(47, 4, 1, 8.6, '2020-02-29'),
(48, 4, 1, 8.7, '2020-03-01'),
(49, 4, 1, 8.8, '2020-03-02'),
(50, 4, 1, 8.9, '2020-03-03'),
(51, 4, 1, 9, '2020-03-04'),
(52, 4, 1, 9.2, '2020-03-05'),
(53, 4, 1, 9.4, '2020-03-05'),
(54, 4, 1, 9.6, '2020-03-06'),
(55, 4, 1, 9.7, '2020-03-07'),
(56, 4, 1, 9.8, '2020-03-08'),
(57, 4, 1, 9.9, '2020-03-09'),
(58, 4, 1, 10, '2020-03-10'),
(59, 4, 1, 10.1, '2020-03-11'),
(60, 4, 1, 10.2, '2020-03-12'),
(61, 4, 1, 10.3, '2020-03-13'),
(62, 4, 1, 10.4, '2020-03-14'),
(63, 4, 1, 10.5, '2020-03-15'),
(64, 4, 1, 10.6, '2020-03-16'),
(65, 4, 1, 10.7, '2020-03-17'),
(66, 4, 1, 10.8, '2020-03-18'),
(67, 4, 1, 10.9, '2020-03-19'),
(68, 4, 1, 11, '2020-03-20'),
(69, 4, 1, 11.1, '2020-03-21'),
(70, 4, 1, 11.2, '2020-03-22'),
(71, 4, 1, 11.3, '2020-03-23'),
(72, 4, 1, 11.4, '2020-03-24'),
(73, 4, 1, 11.5, '2020-03-25'),
(74, 4, 1, 11.6, '2020-03-26'),
(75, 4, 1, 11.7, '2020-03-27');

-- --------------------------------------------------------

--
-- Table structure for table `timer`
--

DROP TABLE IF EXISTS `timer`;
CREATE TABLE IF NOT EXISTS `timer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `plant_ID` int(11) NOT NULL,
  `HourTobeOpened` time NOT NULL,
  `HourTobeClosed` time NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `plant_ID` (`plant_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timer`
--

INSERT INTO `timer` (`ID`, `plant_ID`, `HourTobeOpened`, `HourTobeClosed`) VALUES
(1, 1, '15:30:00', '23:00:00'),
(3, 2, '20:00:01', '25:00:17'),
(4, 3, '20:00:01', '25:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `training_threshold`
--

DROP TABLE IF EXISTS `training_threshold`;
CREATE TABLE IF NOT EXISTS `training_threshold` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Plant_ID` int(11) NOT NULL,
  `Stage_ID` int(11) NOT NULL,
  `Percentage` double NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Stage_ID` (`Stage_ID`),
  KEY `Land_ID` (`Plant_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `training_threshold`
--

INSERT INTO `training_threshold` (`ID`, `Plant_ID`, `Stage_ID`, `Percentage`) VALUES
(1, 1, 1, 0.4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `usertype_ID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Gender` int(11) NOT NULL,
  `Mobile` bigint(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` text NOT NULL,
  `CreatedDateTime` datetime NOT NULL,
  `LastUpdatedDateTime` datetime NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `userType_ID` (`usertype_ID`),
  KEY `Gender` (`Gender`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `usertype_ID`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `Mobile`, `Email`, `Password`, `CreatedDateTime`, `LastUpdatedDateTime`, `IsDeleted`) VALUES
(1, 1, 'Randa', 'Rashad', '1999-03-01', 2, 1128931312, 'randa1604709@miuegypt.edu.eg', 'cb4965ee3cc6467f4e52f6460fc4596f', '2020-02-17 22:13:30', '2020-04-06 15:59:10', 0),
(2, 2, 'Reem', 'Osama', '1995-06-17', 2, 1096266455, 'randaosama1999@gmail.com', '5c97d76ad082ad3360568afd4aade0d2', '2020-02-18 19:24:17', '2020-02-18 19:24:17', 0),
(3, 2, 'Maha', 'Abo Shadi', '1969-12-01', 2, 1096266466, 'm_a_shadi@hotmail.com', '918261280fb463188738a8006fe63a1a', '2020-03-04 18:29:48', '2020-03-04 18:29:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

DROP TABLE IF EXISTS `usertype`;
CREATE TABLE IF NOT EXISTS `usertype` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` varchar(50) NOT NULL,
  `CreatedDateTime` datetime NOT NULL,
  `LastUpdatedDateTime` datetime NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`ID`, `Type`, `CreatedDateTime`, `LastUpdatedDateTime`, `IsDeleted`) VALUES
(1, 'Admin', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(2, 'LandOwner', '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usertypelinks`
--

DROP TABLE IF EXISTS `usertypelinks`;
CREATE TABLE IF NOT EXISTS `usertypelinks` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `userType_ID` int(10) NOT NULL,
  `links_ID` int(10) NOT NULL,
  `CreatedDateTime` datetime NOT NULL,
  `LastUpdatedDateTime` datetime NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `userType_ID` (`userType_ID`),
  KEY `links_ID` (`links_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usertypelinks`
--

INSERT INTO `usertypelinks` (`ID`, `userType_ID`, `links_ID`, `CreatedDateTime`, `LastUpdatedDateTime`, `IsDeleted`) VALUES
(3, 1, 4, '2020-02-26 04:19:19', '2020-02-26 04:19:19', 0),
(4, 2, 4, '2020-02-26 04:19:19', '2020-02-26 04:19:19', 0),
(5, 2, 3, '2020-02-21 05:13:13', '2020-02-21 05:13:13', 0),
(6, 2, 5, '2020-02-21 05:13:13', '2020-02-21 05:13:13', 0),
(7, 2, 6, '2020-02-21 05:13:13', '2020-02-21 05:13:13', 0),
(8, 1, 7, '2020-02-26 04:19:19', '2020-02-26 04:19:19', 0),
(9, 1, 8, '2020-02-26 04:19:19', '2020-02-26 04:19:19', 0),
(10, 1, 9, '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(11, 1, 10, '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(13, 1, 13, '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(14, 1, 14, '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(15, 1, 15, '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(16, 1, 16, '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(17, 1, 17, '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(18, 1, 18, '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(19, 1, 19, '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(20, 1, 20, '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(21, 1, 21, '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(22, 1, 22, '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(23, 1, 23, '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0),
(24, 1, 24, '2020-02-09 05:20:00', '2020-02-09 05:20:00', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fans`
--
ALTER TABLE `fans`
  ADD CONSTRAINT `fans_ibfk_1` FOREIGN KEY (`Land_ID`) REFERENCES `land` (`ID`);

--
-- Constraints for table `images_frames`
--
ALTER TABLE `images_frames`
  ADD CONSTRAINT `images_frames_ibfk_1` FOREIGN KEY (`Land_ID`) REFERENCES `land` (`ID`),
  ADD CONSTRAINT `images_frames_ibfk_2` FOREIGN KEY (`Image_Id`) REFERENCES `images` (`Id`),
  ADD CONSTRAINT `images_frames_ibfk_3` FOREIGN KEY (`Frame_Id`) REFERENCES `frame` (`Id`);

--
-- Constraints for table `land`
--
ALTER TABLE `land`
  ADD CONSTRAINT `land_ibfk_1` FOREIGN KEY (`landowner_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `land_ibfk_2` FOREIGN KEY (`address_ID`) REFERENCES `address` (`ID`),
  ADD CONSTRAINT `land_ibfk_3` FOREIGN KEY (`state_ID`) REFERENCES `state` (`ID`),
  ADD CONSTRAINT `land_ibfk_4` FOREIGN KEY (`plantType_ID`) REFERENCES `plant` (`ID`);

--
-- Constraints for table `landupdaterequests`
--
ALTER TABLE `landupdaterequests`
  ADD CONSTRAINT `landupdaterequests_ibfk_1` FOREIGN KEY (`Land_ID`) REFERENCES `land` (`ID`),
  ADD CONSTRAINT `landupdaterequests_ibfk_2` FOREIGN KEY (`State_ID`) REFERENCES `state` (`ID`);

--
-- Constraints for table `ledsystem`
--
ALTER TABLE `ledsystem`
  ADD CONSTRAINT `ledsystem_ibfk_1` FOREIGN KEY (`Land_ID`) REFERENCES `land` (`ID`),
  ADD CONSTRAINT `ledsystem_ibfk_2` FOREIGN KEY (`LED_ID`) REFERENCES `ledlights` (`ID`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`content_ID`) REFERENCES `content` (`ID`),
  ADD CONSTRAINT `notification_ibfk_3` FOREIGN KEY (`land_ID`) REFERENCES `land` (`ID`);

--
-- Constraints for table `plantneededled`
--
ALTER TABLE `plantneededled`
  ADD CONSTRAINT `plantneededled_ibfk_1` FOREIGN KEY (`Plant_ID`) REFERENCES `plant` (`ID`),
  ADD CONSTRAINT `plantneededled_ibfk_2` FOREIGN KEY (`Stage_ID`) REFERENCES `stages` (`ID`),
  ADD CONSTRAINT `plantneededled_ibfk_3` FOREIGN KEY (`LED_ID`) REFERENCES `ledlights` (`ID`);

--
-- Constraints for table `sensor_readings`
--
ALTER TABLE `sensor_readings`
  ADD CONSTRAINT `sensor_readings_ibfk_1` FOREIGN KEY (`Land_ID`) REFERENCES `land` (`ID`),
  ADD CONSTRAINT `sensor_readings_ibfk_2` FOREIGN KEY (`Sensor_ID`) REFERENCES `sensors` (`ID`);

--
-- Constraints for table `testing_threshold`
--
ALTER TABLE `testing_threshold`
  ADD CONSTRAINT `testing_threshold_ibfk_1` FOREIGN KEY (`Land_ID`) REFERENCES `land` (`ID`),
  ADD CONSTRAINT `testing_threshold_ibfk_2` FOREIGN KEY (`Stage_ID`) REFERENCES `stages` (`ID`);

--
-- Constraints for table `timer`
--
ALTER TABLE `timer`
  ADD CONSTRAINT `timer_ibfk_1` FOREIGN KEY (`plant_ID`) REFERENCES `plant` (`ID`);

--
-- Constraints for table `training_threshold`
--
ALTER TABLE `training_threshold`
  ADD CONSTRAINT `training_threshold_ibfk_1` FOREIGN KEY (`Stage_ID`) REFERENCES `stages` (`ID`),
  ADD CONSTRAINT `training_threshold_ibfk_2` FOREIGN KEY (`Plant_ID`) REFERENCES `plant` (`ID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`usertype_ID`) REFERENCES `usertype` (`ID`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`Gender`) REFERENCES `gender` (`ID`);

--
-- Constraints for table `usertypelinks`
--
ALTER TABLE `usertypelinks`
  ADD CONSTRAINT `usertypelinks_ibfk_1` FOREIGN KEY (`userType_ID`) REFERENCES `usertype` (`ID`),
  ADD CONSTRAINT `usertypelinks_ibfk_2` FOREIGN KEY (`links_ID`) REFERENCES `links` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
