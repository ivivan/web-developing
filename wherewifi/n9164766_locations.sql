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
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `suburb` varchar(64) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'7th Brigade Park, Chermside','Delaware St','Chermside',-27.37893,153.04461),(2,'Annerley Library Wifi','450 Ipswich Road','Annerley, 4103',-27.50942285,153.0333218),(3,'Ashgrove Library Wifi','87 Amarina Avenue','Ashgrove, 4060',-27.44394629,152.9870981),(4,'Banyo Library Wifi','284 St. Vincents Road','Banyo, 4014',-27.37396641,153.0783234),(5,'Booker Place Park','Birkin Rd & Sugarwood St','Bellbowrie',-27.56353,152.89372),(6,'Bracken Ridge Library Wifi','Corner Bracken and Barrett Street','Bracken Ridge, 4017',-27.31797261,153.0378735),(7,'Brisbane Botanic Gardens','Mt Coot-tha Rd','Toowong',-27.47724,152.97599),(8,'Brisbane Square Library Wifi','Brisbane Square, 266 George Street','Brisbane, 4000',-27.47091173,153.0224598),(9,'Bulimba Library Wifi','Corner Riding Road & Oxford Street','Bulimba, 4171',-27.45203086,153.0628242),(10,'Calamvale District Park','Formby & Ormskirk Sts','Calamvale',-27.62152,153.03665),(11,'Carina Library Wifi','Corner Mayfield Road & Nyrang Street','Carina, 4152',-27.49169314,153.0912127),(12,'Carindale Library Wifi','The Home and Leisure Centre, Corner Carindale Street  & Banchory Court, Westfield Carindale Shopping Centre','Carindale, 4152',-27.50475928,153.1003965),(13,'Carindale Recreation Reserve','Cadogan and Bedivere Sts','Carindale',-27.497,153.11105),(14,'Chermside Library Wifi','375 Hamilton  Road','Chermside, 4032',-27.3856032,153.0349028),(15,'City Botanic Gardens Wifi','Alice Street','Brisbane City',-27.47561,153.03005),(16,'Coopers Plains Library Wifi','107 Orange Grove Road','Coopers Plains, 4108',-27.56510509,153.0403183),(17,'Corinda Library Wifi','641 Oxley Road','Corinda, 4075',-27.53880237,152.9809091),(18,'D.M. Henderson Park','Granadilla St','MacGregor',-27.57745,153.07603),(19,'Einbunpin Lagoon','Brighton Rd','Sandgate',-27.31947,153.06822),(20,'Everton Park Library Wifi','561 South Pine Road','Everton park, 4053',-27.4053336,152.9904205),(21,'Fairfield Library Wifi','Fairfield Gardens Shopping Centre, 180 Fairfield Road','Fairfield, 4103',-27.50909038,153.0259709),(22,'Forest Lake Parklands','Forest Lake Bld','Forest Lake',-27.6202,152.96625),(23,'Garden City Library Wifi','Garden City Shopping Centre, Corner Logan and Kessels Road','Upper Mount Gravatt, 4122',-27.56244221,153.0809183),(24,'Glindemann Park','Logan Rd','Holland Park West',-27.52552,153.06923),(25,'Grange Library Wifi','79 Evelyn Street','Grange, 4051',-27.42531193,153.0174728),(26,'Gregory Park','Baroona Rd','Paddington',-27.467,152.99981),(27,'Guyatt Park','Sir Fred Schonell Dve','St Lucia',-27.49297,153.00187),(28,'Hamilton Library Wifi','Corner Racecourt Road and Rossiter Parade','Hamilton, 4007',-27.43790137,153.0642227),(29,'Hidden World Park','Roghan Rd','Fitzgibbon',-27.33971701,153.034981),(30,'Holland Park Library Wifi','81 Seville Road','Holland Park, 4121',-27.52292286,153.0722921),(31,'Inala Library Wifi','Inala Shopping centre, Corsair Ave','Inala, 4077',-27.59828574,152.9735217),(32,'Indooroopilly Library Wifi','Indrooroopilly Shopping centre, Level 4, 322 Moggill Road','Indooroopilly, 4068',-27.49764287,152.9736471),(33,'Kalinga Park','Kalinga St','Clayfield',-27.40666,153.05217),(34,'Kenmore Library Wifi','Kenmore Village Shopping Centre, Brookfield Road','Kenmore, 4069',-27.50592852,152.9386437),(35,'King Edward Park (Jacob\'s Ladder)','Turbot St and Wickham Tce','Brisbane',-27.46589,153.02406),(36,'King George Square','Ann & Adelaide Sts','Brisbane',-27.46843,153.02422),(37,'Mitchelton Library Wifi','37 Helipolis Parada','Mitchelton, 4053',-27.41704165,152.9783402),(38,'Mt Coot-tha Botanic Gardens Library Wifi','Administration Building, Brisbane Botanic Gardens (Mt Coot-tha), Mt Coot-tha Road','Toowong, 4066',-27.47529908,152.9760412),(39,'Mt Gravatt Library Wifi','8 Creek Road','Mt Gravatt, 4122',-27.53855482,153.0802628),(40,'Mt Ommaney Library Wifi','Mt Ommaney Shopping Centre, 171 Dandenong Road','Mt Ommaney, 4074',-27.54824198,152.9378099),(41,'New Farm Library Wifi','135 Sydney Street','New Farm, 4005',-27.46736574,153.0495841),(42,'New Farm Park Wifi','Brunswick Street','New Farm',-27.47046,153.05223),(43,'Nundah Library Wifi','1 Bage Street','Nundah, 4012',-27.40125908,153.0583751),(44,'Oriel Park','Cnr of Alexandra & Lancaster Rds','Ascot',-27.42928,153.05768),(45,'Orleigh Park','Hill End Tce','West End',-27.48995,153.00326),(46,'Post Office Square','Queen & Adelaide Sts','Brisbane',-27.46735,153.02735),(47,'Rocks Riverside Park','Counihan Rd','Seventeen Mile Rocks',-27.54153,152.95913),(48,'Sandgate Library Wifi','Seymour Street','Sandgate, 4017',-27.32060523,153.0704927),(49,'Stones Corner Library Wifi','280 Logan Road','Stones Corner, 4120',-27.49803575,153.043655),(50,'Sunnybank Hills Library Wifi','Sunnybank Hills Shopping Centre, Corner Compton and Calam Roads','Sunnybank Hills, 4109',-27.6109253,153.0550706),(51,'Teralba Park','Pullen & Osborne Rds','Everton Park',-27.40286,152.98059),(52,'Toowong Library Wifi','Toowon Village Shopping Centre, Sherwood Road','Toowong, 4066',-27.48505116,152.9925091),(53,'West End Library Wifi','178 - 180 Boundary Street','West End, 4101',-27.48245078,153.0120763),(54,'Wynnum Library Wifi','Wynnum Civic Centre, 66 Bay Terrace','Wynnum, 4178',-27.44244894,153.1731968),(55,'Zillmere Library Wifi','Corner Jennings Street and Zillmere Road','Zillmere, 4034',-27.36014232,153.0407898);
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-06 21:23:35
