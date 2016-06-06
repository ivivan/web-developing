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
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `salt` varchar(20) NOT NULL,
  `password` char(128) NOT NULL,
  `email` varchar(64) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `wifi_devices` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (16,'asiodjaoisdj','57404b0ebfca5','a83498c1106ef846c534bc3e3250528c8f1f24b81f206aa93de0dfef9d2277bc','asdasd@asdoiasdj.com','0002-03-02','female',1),(17,'xDxD','57404bbbc6163','308accd6ac1768944b4fa856c11031b9b3725229456d2a00cd5553f4cd0b63a8','123123@awweqwe','3222-12-01','female',555),(18,'Cava','574835a1f2b36','6609d69d36a2dc6f4701f68037a5c2e414c527e41d645147412aa2b422d32879','mail@mail.com','1992-02-13','male',4),(19,'OtherGuy','57483602caa64','71921b50a47711a9a1d256d63ae54442196b4462dcfebc2d4c87ec088873f48a','Otherguy@mail.com','1992-02-13','male',2),(20,'Cavawww','57486aadd402e','56563fb73b950352a68e71a7c0a5d7dd73774f10265880188d441e32cbf24a0d','emailme@mail.com','1992-02-13','Male',22),(21,'Cavaeqwqweqe','57486acfece6c','6e0095c2e12fef246bf761af3a2cc99d585f68dada953089bf19da98dadb0518','newemail@mail.com','2992-02-02','Male',2),(22,'newpersonhere','57486dfc95ce4','ce4781b1acf2c54e2e152e78c79ca21ddde7cba341431d995b3781ec1e651cf6','emialingisfun@emailme.com','1992-12-13','Male',22),(23,'abc','57512970345ad','8d7ff72a9a150e7e1bf45e85154882b09a174d7f3fedce77916b6dd3b99f8acc','ivanbuaa@gmail.com','1444-09-09','Male',1);
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

-- Dump completed on 2016-06-06 21:23:41
