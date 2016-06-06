CREATE DATABASE  IF NOT EXISTS `n9164766` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `n9164766`;
-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: fastapps04.qut.edu.au    Database: n9164766
-- ------------------------------------------------------
-- Server version	5.7.11-log

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
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `message` varchar(140) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,1,1,5,'We the best','2016-05-30'),(2,18,24,5,'This place was alright, 10/10','2016-05-30'),(3,18,1,4,'This place is also nice.','2016-05-30'),(4,18,12,4,'I liked this place','2016-05-30'),(5,18,6,2,'Didn\'t really like this place','2016-05-30'),(7,18,4,4,'Banyo wifi is the best!','2016-05-30'),(8,18,5,5,'This is a test for the report','2016-05-30'),(9,18,5,5,'This is a test for the report','2016-05-30'),(10,18,5,5,'This is a test for the report','2016-05-30'),(11,18,5,5,'This is a test for the report','2016-05-30'),(12,18,5,5,'FOR BALANCE','2016-05-30'),(13,18,5,1,'OOPS','2016-05-30'),(14,18,5,1,'This is for balance','2016-05-30'),(15,18,5,1,'One more','2016-05-30'),(16,23,46,5,'jj','2016-06-03'),(17,23,46,5,'\r\n    console.log(\"log message\");\r\n    ','2016-06-03'),(18,23,46,5,'\r\n    document.write(\"This is a test.\");\r\n    console.log(\"log message\");\r\n\r\n    ','2016-06-03'),(19,23,46,5,'\r\n    document.write(\"This is a test.\");\r\n    console.log(\"log message\");\r\n\r\n    ','2016-06-03'),(20,23,46,5,'javascript:window.alert(\"Something!!!\");','2016-06-03'),(21,23,46,5,'      ','2016-06-03'),(22,23,46,5,'      ','2016-06-03'),(23,23,46,5,'\r\n    console.log(\"log message\");\r\n ','2016-06-03'),(24,23,5,5,'yyyy','2016-06-03');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-06 21:23:34
