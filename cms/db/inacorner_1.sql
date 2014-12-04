-- MySQL dump 10.13  Distrib 5.6.12, for Linux (x86_64)
--
-- Host: localhost    Database: inacorner
-- ------------------------------------------------------
-- Server version	5.6.12

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
-- Table structure for table `about`
--

DROP TABLE IF EXISTS `about`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu` datetime DEFAULT NULL,
  `judul` text,
  `sub_judul` text,
  `content` text,
  `short_content` text,
  `image` text,
  `kategori` tinyint(4) DEFAULT NULL,
  `kategori_2` tinyint(4) DEFAULT NULL,
  `status_display` tinyint(1) DEFAULT NULL,
  `longitude` decimal(30,0) DEFAULT NULL,
  `latitude` decimal(30,0) DEFAULT NULL,
  `language` tinytext,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about`
--

LOCK TABLES `about` WRITE;
/*!40000 ALTER TABLE `about` DISABLE KEYS */;
INSERT INTO `about` VALUES (1,'2014-10-29 00:00:00','123','2','<p>\n	1</p>','<p>\n	1</p>','about_2014-10-29 _coba2.png',2,8,0,222,222,'en',55);
/*!40000 ALTER TABLE `about` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album` (
  `id_album` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `nama_album` text COLLATE latin1_general_ci,
  `ket` blob,
  `status_display` tinyint(1) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  PRIMARY KEY (`id_album`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attraction`
--

DROP TABLE IF EXISTS `attraction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attraction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu` datetime DEFAULT NULL,
  `judul` text,
  `sub_judul` text,
  `content` text,
  `short_content` text,
  `image` text,
  `kategori` tinyint(4) DEFAULT NULL,
  `kategori_2` tinyint(4) DEFAULT NULL,
  `status_display` tinyint(1) DEFAULT NULL,
  `longitude` decimal(30,0) DEFAULT NULL,
  `latitude` decimal(30,0) DEFAULT NULL,
  `language` tinytext,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attraction`
--

LOCK TABLES `attraction` WRITE;
/*!40000 ALTER TABLE `attraction` DISABLE KEYS */;
INSERT INTO `attraction` VALUES (1,'2014-10-18 00:00:00','1w1c','12','<p>\n	2</p>','<p>\n	1</p>','attraction_2014-10-18 _banner_paparnas.png',2,0,0,0,0,'en',55);
/*!40000 ALTER TABLE `attraction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `culture`
--

DROP TABLE IF EXISTS `culture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `culture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu` datetime DEFAULT NULL,
  `judul` text,
  `sub_judul` text,
  `content` text,
  `short_content` text,
  `image` text,
  `kategori` tinyint(4) DEFAULT NULL,
  `kategori_2` tinyint(4) DEFAULT NULL,
  `status_display` tinyint(1) DEFAULT NULL,
  `longitude` decimal(30,0) DEFAULT NULL,
  `latitude` decimal(30,0) DEFAULT NULL,
  `language` tinytext NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `culture`
--

LOCK TABLES `culture` WRITE;
/*!40000 ALTER TABLE `culture` DISABLE KEYS */;
INSERT INTO `culture` VALUES (1,'2014-10-31 00:00:00','culture1222','132','<p>\n	1</p>','<p>\n	1</p>','culture_2014-10-31 _coba2.png',3,0,0,0,0,'en',55);
/*!40000 ALTER TABLE `culture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destination`
--

DROP TABLE IF EXISTS `destination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `destination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu` datetime DEFAULT NULL,
  `judul` text,
  `sub_judul` text,
  `content` text,
  `short_content` text,
  `image` text,
  `kategori` tinyint(4) DEFAULT NULL,
  `kategori_2` tinyint(4) DEFAULT NULL,
  `status_display` tinyint(1) DEFAULT NULL,
  `longitude` decimal(30,0) DEFAULT NULL,
  `latitude` decimal(30,0) DEFAULT NULL,
  `language` tinytext NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destination`
--

LOCK TABLES `destination` WRITE;
/*!40000 ALTER TABLE `destination` DISABLE KEYS */;
INSERT INTO `destination` VALUES (1,'2014-10-23 00:00:00','22','22','<p>\n	1</p>','<p>\n	1</p>','destination_2014-10-23 _Deputi Seswapres Bidang Politik.png',3,7,0,0,0,'en',55);
/*!40000 ALTER TABLE `destination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu` datetime DEFAULT NULL,
  `judul` text,
  `sub_judul` text,
  `content` text,
  `short_content` text,
  `image` text,
  `kategori` tinyint(4) DEFAULT NULL,
  `kategori_2` tinyint(4) DEFAULT NULL,
  `status_display` tinyint(1) DEFAULT NULL,
  `longitude` decimal(30,0) DEFAULT NULL,
  `latitude` decimal(30,0) DEFAULT NULL,
  `language` tinytext NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food`
--

LOCK TABLES `food` WRITE;
/*!40000 ALTER TABLE `food` DISABLE KEYS */;
INSERT INTO `food` VALUES (2,'2014-10-10 00:00:00','11222','22','<p>\n	1</p>','<p>\n	1</p>','today_2014-10-10 _Untitled 1_html_32357970.png',1,0,0,0,0,'en',55),(3,'2014-10-10 00:00:00','11222','22','<p>\n	1</p>','<p>\n	1</p>','today_2014-10-10 _Untitled 1_html_32357970.png',1,0,0,0,0,'en',55);
/*!40000 ALTER TABLE `food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foto`
--

DROP TABLE IF EXISTS `foto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `judul` text,
  `waktu` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nama_file` text,
  `status_display` tinyint(1) NOT NULL DEFAULT '0',
  `status_headline` tinyint(1) DEFAULT NULL,
  `album` int(11) NOT NULL DEFAULT '0',
  `filter` tinyint(1) NOT NULL DEFAULT '0',
  `ket` blob,
  `sub_judul` text,
  PRIMARY KEY (`id_foto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foto`
--

LOCK TABLES `foto` WRITE;
/*!40000 ALTER TABLE `foto` DISABLE KEYS */;
/*!40000 ALTER TABLE `foto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_about`
--

DROP TABLE IF EXISTS `kategori_about`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori_about` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_about`
--

LOCK TABLES `kategori_about` WRITE;
/*!40000 ALTER TABLE `kategori_about` DISABLE KEYS */;
INSERT INTO `kategori_about` VALUES (1,'Location'),(2,'General Info'),(3,'Traveller Essential');
/*!40000 ALTER TABLE `kategori_about` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_attraction`
--

DROP TABLE IF EXISTS `kategori_attraction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori_attraction` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_attraction`
--

LOCK TABLES `kategori_attraction` WRITE;
/*!40000 ALTER TABLE `kategori_attraction` DISABLE KEYS */;
INSERT INTO `kategori_attraction` VALUES (1,'Travel Highlights'),(2,'Events');
/*!40000 ALTER TABLE `kategori_attraction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_culture`
--

DROP TABLE IF EXISTS `kategori_culture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori_culture` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_culture`
--

LOCK TABLES `kategori_culture` WRITE;
/*!40000 ALTER TABLE `kategori_culture` DISABLE KEYS */;
INSERT INTO `kategori_culture` VALUES (1,'Culture'),(2,'Arts'),(3,'Craft'),(4,'Music/Instrument');
/*!40000 ALTER TABLE `kategori_culture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_destination`
--

DROP TABLE IF EXISTS `kategori_destination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori_destination` (
  `id_kategori` int(11) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_destination`
--

LOCK TABLES `kategori_destination` WRITE;
/*!40000 ALTER TABLE `kategori_destination` DISABLE KEYS */;
INSERT INTO `kategori_destination` VALUES (1,'Recommended'),(2,'Spectacular Indonesia Spot'),(3,'Region');
/*!40000 ALTER TABLE `kategori_destination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_food`
--

DROP TABLE IF EXISTS `kategori_food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori_food` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_food`
--

LOCK TABLES `kategori_food` WRITE;
/*!40000 ALTER TABLE `kategori_food` DISABLE KEYS */;
INSERT INTO `kategori_food` VALUES (1,'Regional Dishes'),(2,'Feast'),(3,'Beverages'),(4,'Eating Establishment'),(5,'Snack'),(6,'Fruit');
/*!40000 ALTER TABLE `kategori_food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_region`
--

DROP TABLE IF EXISTS `kategori_region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori_region` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_region`
--

LOCK TABLES `kategori_region` WRITE;
/*!40000 ALTER TABLE `kategori_region` DISABLE KEYS */;
INSERT INTO `kategori_region` VALUES (1,'Sumatera'),(2,'Jawa'),(3,'Kalimantan'),(4,'Sulawesi'),(5,'Maluku'),(6,'Nusa Tenggara'),(7,'Bali'),(8,'Papua');
/*!40000 ALTER TABLE `kategori_region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `level`
--

DROP TABLE IF EXISTS `level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_level`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level`
--

LOCK TABLES `level` WRITE;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
INSERT INTO `level` VALUES (1,'admin'),(2,'operator');
/*!40000 ALTER TABLE `level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopping`
--

DROP TABLE IF EXISTS `shopping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shopping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu` datetime DEFAULT NULL,
  `judul` text,
  `sub_judul` text,
  `content` text,
  `short_content` text,
  `image` text,
  `kategori` tinyint(4) DEFAULT NULL,
  `kategori_2` tinyint(4) DEFAULT NULL,
  `status_display` tinyint(1) DEFAULT NULL,
  `longitude` decimal(30,0) DEFAULT NULL,
  `latitude` decimal(30,0) DEFAULT NULL,
  `language` tinytext NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopping`
--

LOCK TABLES `shopping` WRITE;
/*!40000 ALTER TABLE `shopping` DISABLE KEYS */;
INSERT INTO `shopping` VALUES (1,'2014-10-03 00:00:00','123','2','<p>\n	1</p>','<p>\n	1</p>','today_2014-10-03 _Untitled 1_html_32357970.png',0,0,0,0,0,'en',55),(3,'2014-10-03 00:00:00','123','2','<p>\n	1</p>','<p>\n	1</p>','today_2014-10-03 _Untitled 1_html_32357970.png',0,0,0,0,0,'en',55),(4,'2014-10-03 00:00:00','123','2','<p>\n	1</p>','<p>\n	1</p>','today_2014-10-03 _Untitled 1_html_32357970.png',0,0,0,0,0,'en',55);
/*!40000 ALTER TABLE `shopping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `today_festival`
--

DROP TABLE IF EXISTS `today_festival`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `today_festival` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu` datetime DEFAULT NULL,
  `judul` text,
  `sub_judul` text,
  `content` text,
  `short_content` text,
  `image` text,
  `kategori` tinyint(4) DEFAULT NULL,
  `kategori_2` tinyint(4) DEFAULT NULL,
  `status_display` tinyint(1) DEFAULT NULL,
  `longitude` decimal(30,0) DEFAULT NULL,
  `latitude` decimal(30,0) DEFAULT NULL,
  `language` tinytext NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `today_festival`
--

LOCK TABLES `today_festival` WRITE;
/*!40000 ALTER TABLE `today_festival` DISABLE KEYS */;
/*!40000 ALTER TABLE `today_festival` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` text NOT NULL,
  `level` varchar(34) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (38,'admin2','d7567a7494e429188b6fd54f5331ea5b42b414c4966697da3ac08f4d11af36440409663705ff8d2dfe2760e656edb4e43c1abea6a5cfe32d7e3a56bd2b988834','1',''),(55,'mamah','ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413','1',''),(62,'june','ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413','2',NULL),(57,'koko','ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413','2',''),(60,'cuncun','3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79','1',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-28 14:47:49
