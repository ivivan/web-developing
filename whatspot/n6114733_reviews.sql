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
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `reviewID` int(11) NOT NULL AUTO_INCREMENT,
  `authorID` int(11) DEFAULT NULL,
  `siteID` int(11) DEFAULT NULL,
  `reviewTitle` varchar(200) DEFAULT NULL,
  `reviewText` longtext,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reviewRating` int(1) DEFAULT NULL,
  PRIMARY KEY (`reviewID`),
  KEY `fk_Reviews_1_idx` (`siteID`),
  KEY `fk_Reviews_2_idx` (`authorID`),
  CONSTRAINT `fk_Reviews_1` FOREIGN KEY (`siteID`) REFERENCES `items` (`itemID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reviews_2` FOREIGN KEY (`authorID`) REFERENCES `members` (`memberID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (29,84,1,'Test Review','Test Review','2016-05-26 09:12:58',1),(30,77,1,'Test','Test','2016-05-26 09:29:54',1),(37,77,1,'Some Review Title','A review','2016-05-26 12:58:02',1),(38,77,5,'Booker Place park has terrible free wifi','Don\'t come, it smells funny.','2016-05-26 14:02:37',1),(39,77,7,'asdasd','asdasdasd','2016-05-26 14:03:56',3),(40,77,1,'asdasd','asads','2016-05-26 14:05:51',3),(41,77,7,'sdgsdg','sdgsdg','2016-05-26 14:07:07',4),(42,77,1,'Another Review','Another Review','2016-05-26 14:14:05',4),(43,77,5,'saas','asfasf','2016-05-26 14:14:40',4),(44,77,2,'Test Review','Test Review','2016-05-26 14:26:01',2),(45,77,14,'Test','Yep, you guessed it, another test review.','2016-05-26 14:29:43',3),(46,77,1,'Wow, test review!','The only thing better than this site is my reviews.','2016-05-26 14:30:39',5),(47,77,14,'Wow, test review!','The only thing better than this site is my reviews','2016-05-26 14:32:04',1),(48,77,1,'XSS Script','&lt;script&gt;\r\n\r\n    alert(&quot;Your site has been compromised by an XSS&quot;);\r\n\r\n&lt;/script&gt;','2016-05-27 06:52:06',1),(49,77,20,'Long Test Review','This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.  This is a long test review.','2016-05-27 13:23:47',1),(50,87,24,'Good Review','Yes, a good review.','2016-05-27 14:21:38',4),(51,77,14,'Test Review','Chermside WiFi is really good.','2016-05-29 11:16:51',4),(52,89,25,'Test Review','Test Review','2016-05-30 07:54:22',1),(53,89,8,'Brisbane Square WiFi OK','Was ok, wouldn\'t rave about it.','2016-05-30 10:09:14',3),(54,91,16,'Final Test Review','I\'m out, that\'s enough reviews for me.','2016-05-30 12:59:07',5),(55,92,46,'fff','&lt;b&gt;fff&lt;/b&gt;','2016-06-03 04:49:22',3),(56,92,1,'fff','&lt;b&gt;fff&lt;/b&gt;','2016-06-03 04:49:37',1);
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

-- Dump completed on 2016-06-06 21:05:40
