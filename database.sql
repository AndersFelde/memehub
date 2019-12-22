CREATE DATABASE  IF NOT EXISTS `memehub` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `memehub`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: memehub
-- ------------------------------------------------------
-- Server version	8.0.13

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
-- Table structure for table `bruker`
--

DROP TABLE IF EXISTS `bruker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bruker` (
  `bruker_id` int(11) NOT NULL AUTO_INCREMENT,
  `brukernavn` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `passord` varchar(45) NOT NULL,
  `bilde` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`bruker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bruker`
--

LOCK TABLES `bruker` WRITE;
/*!40000 ALTER TABLE `bruker` DISABLE KEYS */;
INSERT INTO `bruker` VALUES (4,'Kippster','anderskfelde@hotmail.com','Mordi123','5cc99c040d79c4.09873159.jpg');
/*!40000 ALTER TABLE `bruker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `innlegg`
--

DROP TABLE IF EXISTS `innlegg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `innlegg` (
  `innlegg_id` int(11) NOT NULL AUTO_INCREMENT,
  `bilde` varchar(100) NOT NULL,
  `vote` int(11) DEFAULT NULL,
  `bruker_id` int(11) NOT NULL,
  `tid` datetime NOT NULL,
  `tekst` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`innlegg_id`),
  KEY `fk_innlegg_bruker_idx` (`bruker_id`),
  CONSTRAINT `fk_innlegg_bruker` FOREIGN KEY (`bruker_id`) REFERENCES `bruker` (`bruker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `innlegg`
--

LOCK TABLES `innlegg` WRITE;
/*!40000 ALTER TABLE `innlegg` DISABLE KEYS */;
INSERT INTO `innlegg` VALUES (1,'5cc9bf82947f60.58741943.jpg',NULL,4,'2019-05-01 17:47:14',NULL),(2,'5cc9bfe13f5ac9.00395483.jpg',NULL,4,'2019-05-01 17:48:49',NULL),(3,'5cc9c1ffdc41a1.20971186.jpg',NULL,4,'2019-05-01 17:57:51',NULL),(4,'5cc9c464ab2ac5.50384960.jpg',NULL,4,'2019-05-01 18:08:04',NULL),(5,'5cc9c48936bd77.93301294.jpg',NULL,4,'2019-05-01 18:08:41',NULL),(6,'5cc9c71401f853.65686848.jpg',NULL,4,'2019-05-01 18:19:32',NULL),(7,'5cc9c7563fb845.56105395.jpg',NULL,4,'2019-05-01 18:20:38',NULL),(8,'5ccab311ab4520.72044301.jpg',NULL,4,'2019-05-02 11:06:25',NULL),(9,'5ccab403005e75.15585370.jpg',NULL,4,'2019-05-02 11:10:27',NULL),(10,'5ccab42595a330.09150511.jpg',NULL,4,'2019-05-02 11:11:01',NULL),(11,'5ccab5a0e583c2.54348594.jpg',NULL,4,'2019-05-02 11:17:20',NULL);
/*!40000 ALTER TABLE `innlegg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `innlegg_id` int(11) NOT NULL,
  `kategori` varchar(45) NOT NULL,
  PRIMARY KEY (`kategori_id`),
  KEY `fk_kategori_innlegg_idx` (`innlegg_id`),
  CONSTRAINT `fk_kategori_innlegg` FOREIGN KEY (`innlegg_id`) REFERENCES `innlegg` (`innlegg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (1,1,'ok'),(2,2,'ok'),(3,3,'ja'),(4,4,'meme'),(5,4,'haha'),(6,4,'okei'),(7,5,'start'),(8,5,'midt'),(9,5,'midt'),(10,5,'midt'),(11,5,'slutt'),(12,6,'harry'),(13,7,'iron'),(14,7,'man'),(15,8,'okei'),(16,8,'haha'),(17,8,'ja'),(18,8,'ok'),(19,9,'haha'),(20,10,'haha'),(21,10,'haha'),(22,10,'haha'),(23,11,'meme'),(24,11,'okei');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kommentar`
--

DROP TABLE IF EXISTS `kommentar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kommentar` (
  `kommentar_id` int(11) NOT NULL AUTO_INCREMENT,
  `tekst` text NOT NULL,
  `innlegg_id` int(11) NOT NULL,
  `bruker_id` int(11) NOT NULL,
  PRIMARY KEY (`kommentar_id`),
  KEY `fk_kommentar_innlegg_idx` (`innlegg_id`),
  KEY `fk_kommentar_bruker_idx` (`bruker_id`),
  CONSTRAINT `fk_kommentar_bruker` FOREIGN KEY (`bruker_id`) REFERENCES `bruker` (`bruker_id`),
  CONSTRAINT `fk_kommentar_innlegg` FOREIGN KEY (`innlegg_id`) REFERENCES `innlegg` (`innlegg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kommentar`
--

LOCK TABLES `kommentar` WRITE;
/*!40000 ALTER TABLE `kommentar` DISABLE KEYS */;
/*!40000 ALTER TABLE `kommentar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voted`
--

DROP TABLE IF EXISTS `voted`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voted` (
  `voted_id` int(11) NOT NULL AUTO_INCREMENT,
  `vote` tinyint(4) NOT NULL,
  `innlegg_id` int(11) NOT NULL,
  `bruker_id` int(11) NOT NULL,
  PRIMARY KEY (`voted_id`),
  KEY `fk_voted_innlegg_idx` (`innlegg_id`),
  KEY `fk_voted_bruker_idx` (`bruker_id`),
  CONSTRAINT `fk_voted_bruker` FOREIGN KEY (`bruker_id`) REFERENCES `bruker` (`bruker_id`),
  CONSTRAINT `fk_voted_innlegg` FOREIGN KEY (`innlegg_id`) REFERENCES `innlegg` (`innlegg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voted`
--

LOCK TABLES `voted` WRITE;
/*!40000 ALTER TABLE `voted` DISABLE KEYS */;
/*!40000 ALTER TABLE `voted` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-22 19:16:16
