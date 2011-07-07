-- MySQL dump 10.13  Distrib 5.1.57, for apple-darwin10.7.1 (i386)
--
-- Host: localhost    Database: streetgrindzapp
-- ------------------------------------------------------
-- Server version	5.1.57

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
  `twitter_account_id` int(11) NOT NULL,
  `twitter_id` int(10) unsigned NOT NULL,
  `twitter_username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `icon_url` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `twitter_id` (`twitter_id`),
  KEY `twitter_account_id` (`twitter_account_id`),
  CONSTRAINT `trucks_ibfk_1` FOREIGN KEY (`twitter_account_id`) REFERENCES `twitter_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trucks`
--

LOCK TABLES `trucks` WRITE;
/*!40000 ALTER TABLE `trucks` DISABLE KEYS */;
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
  `tweet_id` bigint(20) unsigned NOT NULL,
  `tweet` varchar(160) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_url` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `geo_lat` float NOT NULL,
  `geo_long` float NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tweet_id` (`tweet_id`),
  KEY `truck_id_created` (`truck_id`,`created`),
  KEY `truck_id` (`truck_id`),
  CONSTRAINT `trucks_tweets_ibfk_1` FOREIGN KEY (`truck_id`) REFERENCES `trucks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trucks_tweets`
--

LOCK TABLES `trucks_tweets` WRITE;
/*!40000 ALTER TABLE `trucks_tweets` DISABLE KEYS */;
/*!40000 ALTER TABLE `trucks_tweets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `twitter_accounts`
--

DROP TABLE IF EXISTS `twitter_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `twitter_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `twitter_id` bigint(20) NOT NULL,
  `twitter_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `truck_info` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `twitter_accounts`
--

LOCK TABLES `twitter_accounts` WRITE;
/*!40000 ALTER TABLE `twitter_accounts` DISABLE KEYS */;
INSERT INTO `twitter_accounts` VALUES (1,31680416,'@bostonvaulter','Test Account','2011-06-25 19:36:15','2011-06-25 19:36:15'),(5,199785206,'@xtremetacos','Tacos','2011-06-25 19:36:15','2011-06-25 19:36:15'),(6,219380743,'@FAIRYCAKES808','Fairy Cakes','2011-06-25 19:36:49','2011-06-25 19:36:49'),(7,275837179,'@tikitruck','Tiki Truck!','2011-06-25 19:37:27','2011-06-25 19:37:27'),(8,79702930,'@fliptouteats','Filipino Eats!','2011-06-25 19:38:02','2011-06-25 19:38:02'),(9,228279591,'@camillesonwheel','Camille','2011-06-25 19:38:27','2011-06-25 19:38:27');
/*!40000 ALTER TABLE `twitter_accounts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-06-25  9:41:45
