CREATE DATABASE  IF NOT EXISTS `proyecto` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `proyecto`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: proyecto
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.9-MariaDB-log

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `catid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'noticia',NULL,NULL),(2,'update',NULL,NULL),(3,'realese',NULL,NULL),(4,'beta',NULL,NULL),(5,'share',NULL,NULL),(6,'misc',NULL,NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `character`
--

DROP TABLE IF EXISTS `character`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `character` (
  `charid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `charclass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `charname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `charbio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `charbirthdate` date NOT NULL,
  `charportrait` blob NOT NULL,
  `charstylecombat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `faction_id` int(11) NOT NULL,
  `charfacechar` blob NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`charid`),
  KEY `character_faction_id_index` (`faction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `character`
--

LOCK TABLES `character` WRITE;
/*!40000 ALTER TABLE `character` DISABLE KEYS */;
INSERT INTO `character` VALUES (1,'class1','character1','bio1','2016-05-09','','charstylecombat1',1,'',NULL,NULL),(2,'class2','character2','bio2','2016-05-09','','charstylecombat2',2,'',NULL,NULL),(3,'class3','character3','bio3','2016-05-09','','charstylecombat3',3,'',NULL,NULL),(4,'class4','character4','bio4','2016-05-09','','charstylecombat4',4,'',NULL,NULL),(5,'class5','character5','bio5','2016-05-09','','charstylecombat5',1,'',NULL,NULL),(6,'class6','character6','bio6','2016-05-09','','charstylecombat6',2,'',NULL,NULL);
/*!40000 ALTER TABLE `character` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `comid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comcomment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`comid`),
  KEY `comment_user_id_index` (`user_id`),
  KEY `comment_post_id_index` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,'comment1',1,1,NULL,NULL),(2,'comment2',2,2,NULL,NULL),(3,'comment3',3,3,NULL,NULL),(4,'comment4',4,4,NULL,NULL),(5,'comment5',5,5,NULL,NULL);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faction`
--

DROP TABLE IF EXISTS `faction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faction` (
  `facid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `facname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facdescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facshortdescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`facid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faction`
--

LOCK TABLES `faction` WRITE;
/*!40000 ALTER TABLE `faction` DISABLE KEYS */;
INSERT INTO `faction` VALUES (1,'faction1','factiondescription1','factionshortdescrtion1',NULL,NULL),(2,'faction1','factiondescription1','factionshortdescrtion1',NULL,NULL),(3,'faction2','factiondescription2','factionshortdescrtion2',NULL,NULL),(4,'faction3','factiondescription3','factionshortdescrtion3',NULL,NULL),(5,'faction4','factiondescription4','factionshortdescrtion4',NULL,NULL),(6,'faction5','factiondescription5','factionshortdescrtion5',NULL,NULL);
/*!40000 ALTER TABLE `faction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `hisid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `histitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hisdescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hisDateEvent` date NOT NULL,
  `hisshortDescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`hisid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (1,'history1','historydescription1','0000-00-00','historyshortdescription1',NULL,NULL),(2,'history2','historydescription2','0000-00-00','historyshortdescription2',NULL,NULL),(3,'history3','historydescription3','0000-00-00','historyshortdescription3',NULL,NULL),(4,'history4','historydescription4','0000-00-00','historyshortdescription4',NULL,NULL),(5,'history5','historydescription5','0000-00-00','historyshortdescription5',NULL,NULL);
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mechanic`
--

DROP TABLE IF EXISTS `mechanic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mechanic` (
  `mecid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mectitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mecdescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mecpicture` blob NOT NULL,
  `mecvideo` blob NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`mecid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mechanic`
--

LOCK TABLES `mechanic` WRITE;
/*!40000 ALTER TABLE `mechanic` DISABLE KEYS */;
INSERT INTO `mechanic` VALUES (1,'mechanics1','mechanicsdescriprion1','','',NULL,NULL),(2,'mechanics2','mechanicsdescriprion2','','',NULL,NULL),(3,'mechanics3','mechanicsdescriprion3','','',NULL,NULL),(4,'mechanics4','mechanicsdescriprion4','','',NULL,NULL),(5,'mechanics5','mechanicsdescriprion5','','',NULL,NULL);
/*!40000 ALTER TABLE `mechanic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_05_09_173146_create_comment',1),('2016_05_09_173208_create_history',1),('2016_05_09_173225_create_post',1),('2016_05_09_173246_create_character',1),('2016_05_09_173304_create_mechanics',1),('2016_05_09_173327_create_category',1),('2016_05_09_173401_create_factions',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `posid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `postitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `posdescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `poscontent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `posphoto` blob NOT NULL,
  `posdate` date NOT NULL,
  `shortdesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`posid`),
  KEY `post_user_id_index` (`user_id`),
  KEY `post_category_id_index` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,0,'post1','postdescription1','postcontent1','','0000-00-00','postshortdesc1',1,NULL,NULL),(2,0,'post1','postdescription1','postcontent1','','0000-00-00','postshortdesc1',1,NULL,NULL),(3,0,'post2','postdescription2','postcontent2','','0000-00-00','postshortdesc2',2,NULL,NULL),(4,0,'post3','postdescription3','postcontent3','','0000-00-00','postshortdesc3',3,NULL,NULL),(5,0,'post4','postdescription4','postcontent4','','0000-00-00','postshortdesc4',4,NULL,NULL),(6,0,'post5','postdescription5','postcontent5','','0000-00-00','postshortdesc5',5,NULL,NULL);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `usid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uspicture` blob NOT NULL,
  `usbirthDate` date NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usadmin` tinyint(1) NOT NULL,
  `userased` tinyint(1) NOT NULL,
  `ustwitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usfacebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usinstagram` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `faction_id` int(11) NOT NULL,
  `ustumblr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usdesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usemail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uspassword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`usid`),
  UNIQUE KEY `users_usemail_unique` (`usemail`),
  KEY `users_faction_id_index` (`faction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'username1','','0000-00-00','usercountry1',1,0,'usertwitter1','userfacebook1','userinstagram1',1,'usertumblr1','userdesc1','user@user.com','',NULL,NULL,NULL),(3,'username1','','0000-00-00','usercountry1',1,0,'usertwitter1','userfacebook1','userinstagram1',1,'usertumblr1','userdesc1','user1@user.com','',NULL,NULL,NULL),(4,'username2','','0000-00-00','usercountry2',0,0,'usertwitter2','userfacebook2','userinstagram2',1,'usertumblr2','userdesc2','user2@user.com','',NULL,NULL,NULL),(5,'username3','','0000-00-00','usercountry3',1,1,'usertwitter3','userfacebook3','userinstagram3',1,'usertumblr3','userdesc3','user3@user.com','',NULL,NULL,NULL),(6,'username4','','0000-00-00','usercountry4',1,0,'usertwitter4','userfacebook4','userinstagram4',1,'usertumblr4','userdesc4','user4@user.com','',NULL,NULL,NULL),(7,'username5','','0000-00-00','usercountry5',0,1,'usertwitte5r','userfacebook5','userinstagram5',1,'usertumblr5','userdesc5','user5@user.com','',NULL,NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'proyecto'
--

--
-- Dumping routines for database 'proyecto'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-09 20:32:56
