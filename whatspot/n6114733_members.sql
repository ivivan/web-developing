CREATE DATABASE  IF NOT EXISTS `n6114733` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `n6114733`;
-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: fastapps04.qut.edu.au    Database: n6114733
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
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `memberID` int(11) NOT NULL AUTO_INCREMENT,
  `memberName` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `pwdHash` char(64) DEFAULT NULL,
  `salt` char(32) DEFAULT NULL,
  `addressPC` int(4) NOT NULL,
  `marketing` char(1) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  PRIMARY KEY (`memberID`),
  UNIQUE KEY `memberName_UNIQUE` (`memberName`),
  UNIQUE KEY `salt_UNIQUE` (`salt`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (77,'user','William','Guthrie','an@email.com','b6e31bd65754e6bee39134896668c900f08d96310031a77f4ec3a50388668843','5745ca8d0916f',4032,'Y','1994-02-02'),(82,'new_user','William','Guthrie','an@email.com','e5022ae0a4a6b30fa67944f6ca65f2c5680b84795b3574c37bb14911aee6ec4a','5745e07754634',4000,'Y','1999-01-01'),(83,'wilbo777','Wilbo','Baggins','an@email.com','16d60117ba7acc4fbcae5cce0613c595a789b7cf943f218a9530d35b4ce7047a','5745e11149167',4032,'N','1999-01-01'),(84,'_Auser','Will','Guthrie','an@email.com','babb34a3931213daf26058346adb2c75e5e6224432c6dedced182ac82b8e0106','5746b8cba1e25',0,'Y','1999-11-01'),(86,'wilbobaggins','William','Guthrie','an@email.com','2ccb1f383e4fbcb67d363ee97cdfd3b0025574a0d46def939580a435284f6af9','5747ded2be560',4032,'N','1987-02-20'),(87,'emiltron','Camille','Tynos','an@email.com','68478735f7f7d852c5795c8a316a6979c88be16f98a06943fd44d8d006c32661','574857ad9f7d3',4000,'N','2012-02-29'),(88,'another_user','Another','User','another@email.com','637b0b1fb8b644cb963bd6a730d9c76032987c7d6f8e15fcbf492cc5cdc23472','5748592d642f8',4000,'N','2013-02-22'),(89,'last_user','Last','User','last@user.com','92d6acdb0b56291ed30c7e672493463373020773f1a4b3219a9525f53d691081','574bf183acc7e',4000,'N','2016-02-02'),(91,'new_user3','Wilbo','Baggins','wilbo@baggins.com','bf09bd00390f938d6b7f5ea4b6c71cabb04576b42639860fbb0a3e8348eb7f69','574c38e035572',4000,'Y','1954-05-02'),(92,'ivivan','zhang','zhang','ivanbuaa@hotmail.com','d3fe17b64a24ab8fd8c86be8d22066ce9cf19cfbd6bac41bc9779091dfbc23b3','57510c052629d',4000,'Y','2013-04-03');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-06 21:05:42
