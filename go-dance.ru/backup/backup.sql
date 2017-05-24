-- MySQL dump 10.16  Distrib 10.1.19-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.1.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `DanceStudio`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `DanceStudio` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `DanceStudio`;

--
-- Table structure for table `Classes`
--

DROP TABLE IF EXISTS `Classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Classes` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `trainer_id` int(11) DEFAULT NULL,
  `name_class` varchar(30) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `class_date` date DEFAULT NULL,
  `cost` int(4) DEFAULT NULL,
  PRIMARY KEY (`class_id`),
  KEY `trainer_id` (`trainer_id`),
  CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `Trainers` (`trainer_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Classes`
--

LOCK TABLES `Classes` WRITE;
/*!40000 ALTER TABLE `Classes` DISABLE KEYS */;
INSERT INTO `Classes` VALUES (1,1,'Хип-Хоп Хореография','1 час 30 минут','2017-03-25',1100),(2,2,'Локинг ','1 час','2017-04-16',900);
/*!40000 ALTER TABLE `Classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Clients`
--

DROP TABLE IF EXISTS `Clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `surname` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `patronymic` varchar(30) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `add_phone` varchar(15) DEFAULT NULL,
  `document` enum('Birth Certificate','Passport') DEFAULT NULL,
  `document_info` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`client_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `Groups` (`group_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Clients`
--

LOCK TABLES `Clients` WRITE;
/*!40000 ALTER TABLE `Clients` DISABLE KEYS */;
INSERT INTO `Clients` VALUES (1,1,'Алексеев','Алексей','Алексеевич','1999-01-17','test@yandex.ru','8(999)999-99-99','8(495)555-55-55','Passport','1122 334565'),(2,1,'Иванова	\r\n','Александра','Владимировна','1989-11-07','ivanova@gmail.com','8(999)999-99-99','8(495)555-55-55','Passport','4431 532212');
/*!40000 ALTER TABLE `Clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Clients_Studios`
--

DROP TABLE IF EXISTS `Clients_Studios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Clients_Studios` (
  `client_id` int(11) NOT NULL,
  `studio_id` int(11) NOT NULL,
  PRIMARY KEY (`client_id`,`studio_id`),
  KEY `studio_id` (`studio_id`),
  CONSTRAINT `clients_studios_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `Clients` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `clients_studios_ibfk_2` FOREIGN KEY (`studio_id`) REFERENCES `Studio` (`studio_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Clients_Studios`
--

LOCK TABLES `Clients_Studios` WRITE;
/*!40000 ALTER TABLE `Clients_Studios` DISABLE KEYS */;
/*!40000 ALTER TABLE `Clients_Studios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Groups`
--

DROP TABLE IF EXISTS `Groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `trainer_id` int(11) DEFAULT NULL,
  `grp_name` varchar(30) NOT NULL,
  `skill` varchar(30) NOT NULL,
  `training_time` char(50) NOT NULL,
  `cost` int(4) DEFAULT NULL,
  PRIMARY KEY (`group_id`),
  KEY `trainer_id` (`trainer_id`),
  CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `Trainers` (`trainer_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Groups`
--

LOCK TABLES `Groups` WRITE;
/*!40000 ALTER TABLE `Groups` DISABLE KEYS */;
INSERT INTO `Groups` VALUES (1,1,'Хип-Хоп Начинающие 12+','Начинающие','1 час',2500),(2,2,'Локинг Начинающие','Начинающие','1 час',3000);
/*!40000 ALTER TABLE `Groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RegisteredToClass`
--

DROP TABLE IF EXISTS `RegisteredToClass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RegisteredToClass` (
  `registered_id` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`registered_id`),
  KEY `class_id` (`class_id`),
  KEY `trainer_id` (`trainer_id`),
  CONSTRAINT `registeredtoclass_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `Classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `registeredtoclass_ibfk_2` FOREIGN KEY (`trainer_id`) REFERENCES `Trainers` (`trainer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RegisteredToClass`
--

LOCK TABLES `RegisteredToClass` WRITE;
/*!40000 ALTER TABLE `RegisteredToClass` DISABLE KEYS */;
INSERT INTO `RegisteredToClass` VALUES (1,'Алексеев','Алексей',1,1,'test@yandex.ru','8(999)999-99-99'),(2,'Евгений','Стародубов',2,NULL,'test@yandex.ru','1(111) 111-11-1'),(3,'Евгений','Стародубов',2,NULL,'test@yandex.ru','1(111) 111-11-1'),(4,'Евгений','Стародубов',2,NULL,'test@yandex.ru','9(999) 999-99-9'),(5,'Стас','Моргунов',2,NULL,'stas@gmail.com','9(999) 999-99-9');
/*!40000 ALTER TABLE `RegisteredToClass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Studio`
--

DROP TABLE IF EXISTS `Studio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Studio` (
  `studio_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `address` varchar(60) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`studio_id`),
  KEY `trainer_id` (`trainer_id`),
  KEY `class_id` (`class_id`),
  CONSTRAINT `studio_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `Trainers` (`trainer_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `studio_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `Classes` (`class_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Studio`
--

LOCK TABLES `Studio` WRITE;
/*!40000 ALTER TABLE `Studio` DISABLE KEYS */;
INSERT INTO `Studio` VALUES (1,'9 залов','ул. Мясницкая, д.15','8-495-111-22-33','2017-03-20',2,1),(2,'Just Dance ','Хлебный пер., д.2','8-988-456-78-90','1999-02-10',NULL,NULL),(3,'PRO Танцы','Малый Саввинский пер.,  8','8-455-22-41','2007-02-15',NULL,NULL),(4,'Active Style Dance Centre','1-я Владимирская улица, 10Бс3','8-495-162‑00-76','2005-03-20',NULL,NULL);
/*!40000 ALTER TABLE `Studio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Trainers`
--

DROP TABLE IF EXISTS `Trainers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Trainers` (
  `trainer_id` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `patronymic` varchar(30) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `style` varchar(100) NOT NULL,
  `serie` int(4) NOT NULL,
  `number` int(6) NOT NULL,
  PRIMARY KEY (`trainer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Trainers`
--

LOCK TABLES `Trainers` WRITE;
/*!40000 ALTER TABLE `Trainers` DISABLE KEYS */;
INSERT INTO `Trainers` VALUES (1,'Стародубов','Евгений','Алексеевич','1999-02-15','coospir@yandex.ru','8-985-474-14-24','Хип-хоп, Поппинг',1234,567892),(2,'Иванов','Иван','Иванович','1989-01-25','ivan_iv@mail.ru','8-916-773-22-41','Локинг',4311,987554);
/*!40000 ALTER TABLE `Trainers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Trainers_Studios`
--

DROP TABLE IF EXISTS `Trainers_Studios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Trainers_Studios` (
  `trainer_id` int(11) NOT NULL,
  `studio_id` int(11) NOT NULL,
  PRIMARY KEY (`trainer_id`,`studio_id`),
  KEY `studio_id` (`studio_id`),
  CONSTRAINT `trainers_studios_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `Trainers` (`trainer_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `trainers_studios_ibfk_2` FOREIGN KEY (`studio_id`) REFERENCES `Studio` (`studio_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Trainers_Studios`
--

LOCK TABLES `Trainers_Studios` WRITE;
/*!40000 ALTER TABLE `Trainers_Studios` DISABLE KEYS */;
INSERT INTO `Trainers_Studios` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `Trainers_Studios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TrainingShedule`
--

DROP TABLE IF EXISTS `TrainingShedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TrainingShedule` (
  `element_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `training_day` varchar(30) NOT NULL,
  `training_start` varchar(5) NOT NULL,
  `training_end` varchar(5) NOT NULL,
  PRIMARY KEY (`element_id`),
  UNIQUE KEY `training_day` (`training_day`,`training_start`),
  KEY `group_id` (`group_id`),
  KEY `trainer_id` (`trainer_id`),
  CONSTRAINT `trainingshedule_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `Groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trainingshedule_ibfk_2` FOREIGN KEY (`trainer_id`) REFERENCES `Trainers` (`trainer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TrainingShedule`
--

LOCK TABLES `TrainingShedule` WRITE;
/*!40000 ALTER TABLE `TrainingShedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `TrainingShedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` int(1) NOT NULL DEFAULT '0',
  `surname` varchar(30) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `patronymic` varchar(30) DEFAULT NULL,
  `login` varchar(30) DEFAULT NULL,
  `pass` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (33,2,NULL,NULL,NULL,'Evgeniy Starodubov','$2y$10$YAqTyD6k3/Pm3UO6cqdHSuaNGOejBocKtQ0F.dFuVsSgUTbaoRXei','eugene.starodubov@gmail.com','8(888)888-88-88'),(34,2,NULL,NULL,NULL,'Tester','$2y$10$2R.YZu7FKl3bFY94lCE.feU23X1au7pJ3X.GkY9My6sUEYBSv7Bxi','test@yandex.ru','8(888)888-88-88'),(35,1,NULL,NULL,NULL,'Stas Morgunov','$2y$10$ltB6XZ/owsvfztRepxU2PeB/OIWoW8YX56CbVMKvWW4ltyYXgQIQu','stas@mail.ru','9(999)999-99-99');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-18 12:53:50
