-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: olv
-- ------------------------------------------------------
-- Server version	5.7.14-log

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
-- Table structure for table `categorys`
--

DROP TABLE IF EXISTS `categorys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorys`
--

LOCK TABLES `categorys` WRITE;
/*!40000 ALTER TABLE `categorys` DISABLE KEYS */;
INSERT INTO `categorys` VALUES (1,'Hip Pop'),(2,'Classical'),(3,'Rock');
/*!40000 ALTER TABLE `categorys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `commentdate` date NOT NULL,
  `users_id` int(10) NOT NULL,
  `videos_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users_idx` (`users_id`),
  KEY `fk_comments_videos1_idx` (`videos_id`),
  CONSTRAINT `fk_comments_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_videos1` FOREIGN KEY (`videos_id`) REFERENCES `videos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'test','2016-12-24',10,1),(2,'test-123','2016-12-24',10,1),(3,'test-123','2016-12-24',10,1),(4,'test-123','2016-12-24',10,1),(32,'test\r\n\r\n','2016-12-27',9,34),(33,'test','2016-12-27',9,33),(34,'test','2016-12-27',9,33),(35,'test','2016-12-27',9,33),(36,'test','2016-12-27',9,33),(37,'hello','2016-12-27',9,33);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saved_videos`
--

DROP TABLE IF EXISTS `saved_videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saved_videos` (
  `videos_id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  PRIMARY KEY (`videos_id`,`users_id`),
  KEY `fk_videos_has_users_users1_idx` (`users_id`),
  KEY `fk_videos_has_users_videos1_idx` (`videos_id`),
  CONSTRAINT `fk_videos_has_users_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_videos_has_users_videos1` FOREIGN KEY (`videos_id`) REFERENCES `videos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saved_videos`
--

LOCK TABLES `saved_videos` WRITE;
/*!40000 ALTER TABLE `saved_videos` DISABLE KEYS */;
INSERT INTO `saved_videos` VALUES (1,9),(2,9),(3,9),(32,9),(2,10),(3,10),(5,10),(2,11),(1,12);
/*!40000 ALTER TABLE `saved_videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `role` int(3) NOT NULL,
  `user_image` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (9,'londontec@gmail.com','$2y$13$5oqMZutBgqNyIvbCAAcgE..WH2w/1EZTWaF/8/s0oVAxtg4aGUKgW','London tec','City Campus',0,'images/users/avatar04.png','2016-12-26 00:00:00'),(10,'admin@londontec.com','$2y$13$5oqMZutBgqNyIvbCAAcgE..WH2w/1EZTWaF/8/s0oVAxtg4aGUKgW','Admin','User',100,'images/users/avatar04.png','2016-12-26 00:00:00'),(11,'kaushalya@gmail.com','$2y$13$29WQLkiYAASeATFI/dgS/OLKSqZcdNW39hhqzcUSwa2JI0V5LlgR6','ccc','cccccccccc@',0,'images/users/avatar04.png','2016-12-26 00:00:00'),(12,'kaushaly@gmiail.com','$2y$13$gS4mortE1aFI3Dd5WrhlJe1AmhvYMcMObad.TE.iER0Zuskiu.QRu','cccccc','cccccccccccccccc',0,'images/users/avatar04.png','2016-12-26 00:00:00'),(13,'kaushalya12@gmail.com','$2y$13$d6iKYioH0iEXNkzXIScYmufQTv3Zla4WGqYamkLNF5C4D33iQQwHa','sss','sssssssssssss',0,'images/users/User_No.png','2016-12-26 00:00:00'),(14,'kaushalya126@gmail.com','$2y$13$DrXvGgU7otn/yl9GX89IGuBmEWsGZwvyd0T7FZ82JyT8nyWXHymFq','wwwwwwwwww','ddddddddd',0,'images/users/kaushalya126@gmail.com.jpg','2016-12-26 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `creator` int(11) NOT NULL,
  `createDate` date NOT NULL,
  `rating` int(10) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `category_id` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_videos_categorys_idx` (`category_id`),
  CONSTRAINT `fk_videos_categorys` FOREIGN KEY (`category_id`) REFERENCES `categorys` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (1,'test','https://www.youtube.com/embed/GKSRyLdjsPA','test',9,'2016-12-22',1,'images/videos/test.jpg',1),(2,'test-01','https://www.youtube.com/embed/GKSRyLdjsPA','rasika',10,'2016-12-24',1,'images/videos/test-01.jpg',1),(3,'test-05','https://www.youtube.com/embed/GKSRyLdjsPA','test',10,'2016-12-21',1,'images/videos/test-05.jpg',1),(5,'test-02','https://www.youtube.com/embed/GKSRyLdjsPA','test',10,'2016-12-20',1,'images/videos/test-02.jpg',1),(32,'Sanuka','https://www.youtube.com/embed/izKxgHWzQ80','test',9,'2016-12-26',1,'images/videos/Sanuka.png',1),(33,'Kavindi','https://www.youtube.com/embed/XRxHgUzclSo','test',9,'2016-12-26',1,'images/videos/Kavindi.jpg',1),(34,'MA Nagayu','https://www.youtube.com/embed/UgN9I67zGCU','test',9,'2016-12-26',1,'https://img.youtube.com/vi/UgN9I67zGCU/0.jpg',1),(35,'Shilel u','https://www.youtube.com/embed/k9Kw-PI2qrw','test',9,'2016-12-26',1,'https://img.youtube.com/vi/k9Kw-PI2qrw/0.jpg',2),(36,'test-06','https://www.youtube.com/embed/GKSRyLdjsPA','test',9,'2016-12-29',1,'https://www.youtube.com/embed/GKSRyLdjsPA',2),(37,'test-056','https://www.youtube.com/embed/GKSRyLdjsPA','test',9,'2016-12-29',1,'https://www.youtube.com/embed/GKSRyLdjsPA',2);
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-04 11:56:52
