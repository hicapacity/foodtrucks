-- MySQL dump 10.13  Distrib 5.1.41, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: streetgrindzapp
-- ------------------------------------------------------
-- Server version	5.1.41-3ubuntu12.10-log

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
-- Table structure for table `trucks`
--

DROP TABLE IF EXISTS `trucks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trucks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `twitter_id` varchar(256) NOT NULL,
  `twitter_username` varchar(64) NOT NULL,
  `menu` varchar(32768) NOT NULL,
  `photo` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `twitter_id` (`twitter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trucks`
--

LOCK TABLES `trucks` WRITE;
/*!40000 ALTER TABLE `trucks` DISABLE KEYS */;
INSERT INTO `trucks` VALUES (1,'31953','ryankanno','<p><u><strong>HELLO!</strong></u></p>',' test','2011-05-21 12:00:00','2011-05-21 22:16:20');
/*!40000 ALTER TABLE `trucks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trucks_tweets`
--

DROP TABLE IF EXISTS `trucks_tweets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trucks_tweets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `truck_id` int(11) NOT NULL,
  `tweet` varchar(160) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `geo_lat` float NOT NULL,
  `geo_long` float NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `truck_id_created` (`truck_id`,`created`),
  KEY `truck_id` (`truck_id`),
  CONSTRAINT `trucks_tweets_ibfk_1` FOREIGN KEY (`truck_id`) REFERENCES `trucks` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trucks_tweets`
--

LOCK TABLES `trucks_tweets` WRITE;
/*!40000 ALTER TABLE `trucks_tweets` DISABLE KEYS */;
/*!40000 ALTER TABLE `trucks_tweets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-05-21 22:20:35
