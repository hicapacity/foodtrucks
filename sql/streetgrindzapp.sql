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
  `twitter_id` int(10) unsigned NOT NULL,
  `twitter_username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `icon_url` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `twitter_id` (`twitter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trucks`
--

LOCK TABLES `trucks` WRITE;
/*!40000 ALTER TABLE `trucks` DISABLE KEYS */;
INSERT INTO `trucks` VALUES (2,92922989,'@808geek','http://a3.twimg.com/profile_images/546740275/geekhead2_normal.JPG','Brandon Askew','Where your Geek meets your Eats!','2011-06-25 19:36:15','2011-07-08 00:00:00'),(10,199785206,'@xtremetacos','http://a1.twimg.com/profile_images/1139472975/Extreme_Taco_Logo_Twitter_reasonably_small.jpg','Xtreme Tacos','Xtreme Tacos will serve Mexican dishes with a Mediterranean flare sprinkled with a lot of Aloha Spirit','2011-07-07 13:06:22','2011-07-07 13:06:22'),(11,219380743,'@fairycakes808','http://a1.twimg.com/profile_images/1179620002/fairycakeslogosmallweb_reasonably_small.jpg','Fairy Cakes ','Welcome to FAIRYCAKES, Hawaii\'s unique mobile cakery!\r\n \r\nOur selection of baked-from-scratch whoopie pies, cupcakes, brownies, bars and cakes are served fresh daily from our travelling van, or \"Lola\" as we like to call her.\r\n \r\nKnown for our famous \"WHOOPIES or FAIRYCAKES\", these light and lovely dessert sandwiches are a must-have for Hawaii\'s sweet tooth lover.  Described as a \"cake-like sandwich or a sandwich-like cake\", whoopie pies have been around for quite some time.  Originally, from the East Coast, whoopie pies are now migrating across the Pacific and making their debut in Hawaii. \r\n \r\nSo lookout for Lola as she roams the streets of Honolulu stocked with whoopies, cupcakes and more\r\n...next stop, your neighborhood!','2011-07-07 13:25:39','2011-07-07 13:25:39'),(12,67725540,'@shogunai_tacos','http://a3.twimg.com/profile_images/715411296/shogunai_character_large_bigger.jpg','Shogunai Tacos','Shogunai was founded on the strength and stability of a shogun warrior mixed with Shoganai Japanese for “the attitude of we cannot do anything else” because this is as good as it gets baby! Why mess with perfection? :)\r\n\r\nShogunai is not just another eating establishment, it is a Culture and Culinary Experience you will not soon forget! Our original creations will make your mouth water and tantalize your taste buds. From East to West our Tacos will take you to far reaching destinations without having to take malaria pills or use a mosquito net!\r\n\r\nThe Hunt is on! With state of the art technology and an integrated networking system we can be followed, contacted, and share our adventure with the rest of the world! Just to name a few place to find us, Facebook, Twitter, Linkdin, Yelp, and newcomers Loopt and Foursquare.','2011-07-07 13:32:25','2011-07-07 13:32:25'),(13,228279591,'@Camillesonwheel','http://a3.twimg.com/profile_images/1222726786/161184_846464485_475568_n_bigger.jpg','Camille\'s on Wheels','The Best Fusion Tacos on O\'ahu! Daily fresh specials including Thai Pork, Shoyu Chicken, Beef & Fish. Pies & Cupcakes too! No plastic or styro in our takeouts.','2011-07-07 13:34:16','2011-07-07 13:34:16'),(14,79702930,'@FliptOutEats','http://a0.twimg.com/profile_images/1263618609/fliptoutflagsmaller_reasonably_small.jpg','Flip\'t Out Eats','Flip\'T What?\r\nWe are new player in the Fusion Food Truck Revolution... Flip\'t Out Eatery!! After my travels throughout the Philippines, I discovered that Hawaii Filipino Food and Philippines Filipino food are very different... So in my quest to introduce the world to the beauty of The Philippines to those who haven\'t yet experinced it, I start by bringing TRADITIONAL Filipino cuisine to Hawai, in a familiar form... STREET TACOS!!\r\n\r\nNow we are just getting flipped out with an array of fusion dishes ranging from our most popular Pinoy Dogs to nice refreshing Ice Candy which is a fusion of the traditional ice pop with fresh fruit and a little twist of Flip\'T Out. We offer a variety of Signiture Filipino Fusion dishes, some of which can only be found at our lunch truck right now so come on down and check us out.\r\n\r\nAlso, we offer catering...Our chefs are masters in all types of dishes so if you like, we can make. Is your group too big or too small? No problem, Flip\'T Out is always up for a challenge. Contact us with any questions..Masarap!!!','2011-07-07 13:36:15','2011-07-07 13:36:15'),(15,96012930,'@ElenasFilipino','http://a1.twimg.com/profile_images/1096285544/LOGO_NEW_reasonably_small.jpg','Elenas Fine Filipino Food','The Sugar Plantation town of Waipahu, Hawaii is where Elena\'s Home of Finest Filipino opened its doors for business. Under the entrepreneurship of Elena and Theo Butuyan, Elena’s Restaurant in Waipahu expanded its operations to 3 lunch trucks, Caterings,  Expos and Craft fairs.  Known for its Trademarked Original Fried Rice Omelet, Popular Pork Adobo Fried Rice OmeletTM, and Sari-Sari, Elena’s is truly the “Home of the Finest Filipino Foods”.  ','2011-07-07 13:43:46','2011-07-07 13:43:46'),(16,17398578,'@pacificsoul','http://a3.twimg.com/profile_images/1245706785/131404_481705023841_349489898841_5888762_2866768_o_bigger.jpg','Soul Patrol','Are you looking for awesome soul food?  Think succulent fried chicken, moist cornbread, homegrown collard greens and congenial Southern hospitality.  Eat-in or takeout, we’ve got you covered.  Drop in and give us a ‘hollar.’  We’re cookin’ sometin’ special for ya’.  And it don’t get any better than this.\r\n\r\nPhilosophy\r\n\r\nSoul food is comfort food. It nourished the mind, the body, and the soul.\r\n\r\nI am committed to using the freshest ingredients and the best flavors to create a meal that\'ll knock your socks off!\r\n\r\nCome down and enjoy a meal with us. We look forward to seeing you soon. Aloha,','2011-07-07 13:47:52','2011-07-07 13:47:52'),(17,145141595,'@SimplyOnoWagons','http://simplyono.com/images/SimplyOno.gif','Simply Ono','We bring together our years of gourmet restaurant training, culinary innovations, and delicious recipes to create a uniquely wonderful and very affordable experience.\r\n\r\nOne taste and you\'ll agree, we are \"Simply Ono\"','2011-07-07 13:51:01','2011-07-07 13:51:01');
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-06-25  9:41:45
