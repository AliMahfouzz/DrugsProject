-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mims
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `medicine`
--

DROP TABLE IF EXISTS `medicine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicine` (
  `idmedicine` int NOT NULL AUTO_INCREMENT,
  `name` varchar(450) DEFAULT NULL,
  `description` varchar(450) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `regdate` varchar(45) DEFAULT NULL,
  `expdate` varchar(45) DEFAULT NULL,
  `category` varchar(450) DEFAULT NULL,
  `image` varchar(450) DEFAULT NULL,
  `quantity` varchar(45) DEFAULT NULL,
  `validity_period` varchar(450) DEFAULT NULL,
  `idusers` varchar(45) DEFAULT NULL,
  `branch` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idmedicine`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicine`
--

LOCK TABLES `medicine` WRITE;
/*!40000 ALTER TABLE `medicine` DISABLE KEYS */;
INSERT INTO `medicine` VALUES (5,'trammal','trammal for headachess','150','2000-05-01','2022-05-27','drugs','1652862251trammal.jpg','0','6 months after exp.date','3',NULL),(4,'panadol','p','50.5','2022-05-17','2022-05-25','drugs','1652860695panadol.jpg','50','9 months after exp.date','3',NULL),(6,'trammal','trammal','150','2022-05-18','2025-05-26','drugs','1652862444trammal.jpg','0','6 months after exp.date','5',NULL),(7,'panadol','panadol advance','50.21','2022-05-11','2026-05-31','drugs','1652862485panadol.jpg','20','6 months after exp.date','5',NULL),(8,'trammal','trammal','150','2022-05-18','2025-05-26','drugs','1652862444trammal.jpg','0','6 months after exp.date','5',NULL),(9,'trammal','trammal','150','2022-05-18','2025-05-26','drugs','1652862444trammal.jpg','5','6 months after exp.date','5',NULL),(10,'otipax','otipax occupied','123.25','2022-06-03','2022-06-30','drugs','1654253703otipax.jpg','100','9 months after exp.date','3','embaba'),(11,'Whey Protein','Whey protein supplements','150.69','2022-06-03','2022-11-30','supplements','1654260165R.jpg','50','9 months after exp.date','3','tanta');
/*!40000 ALTER TABLE `medicine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `idorders` int NOT NULL AUTO_INCREMENT,
  `price` varchar(450) DEFAULT NULL,
  `date` varchar(450) DEFAULT NULL,
  `state` varchar(45) DEFAULT '0',
  `idclient` varchar(45) DEFAULT NULL,
  `idph` varchar(45) DEFAULT NULL,
  `iddelivery` varchar(45) DEFAULT NULL,
  `quantity` varchar(45) DEFAULT NULL,
  `originalq` varchar(45) DEFAULT NULL,
  `idmedicine` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idorders`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (4,'7550','2022-05-18 10:47:56','1','2','3','4','50','50','5'),(5,'22550','2022-05-18 22:23:34','1','2','3','4','150','150','5'),(21,'7550','2022-05-19 09:15:39','0','2','3',NULL,'50','145','5'),(22,'3050','2022-05-19 09:15:39','0','2','5',NULL,'20','145','5'),(23,'10550','2022-05-19 09:15:39','0','2','5',NULL,'70','145','5'),(24,'800','2022-05-19 09:15:39','0','2','5',NULL,'5','145','5');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `idusers` int NOT NULL AUTO_INCREMENT,
  `name` varchar(450) DEFAULT NULL,
  `email` varchar(450) DEFAULT NULL,
  `password` varchar(450) DEFAULT NULL,
  `phone` varchar(450) DEFAULT NULL,
  `regdate` varchar(450) DEFAULT NULL,
  `image` varchar(450) DEFAULT NULL,
  `role` varchar(450) DEFAULT NULL,
  `approved` varchar(45) DEFAULT NULL,
  `location` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idusers`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'client','client@client.com','123456789','1234567890123','2022-05-17 12:56:33','1652784993icons8-change-user-48.png','client','1','gizah'),(3,'pharmacie ali','pharmacie@pharmacie.com','123456789','0123456789','2022-05-17 13:02:00','1652785320brain.jpg','pharmacie','1','qahira'),(4,'delivery','delivery@delivery.com','123456789','12012012012203','2022-05-17 13:03:28','1652785408icons8-male-user-40.png','delivery','1','tanta'),(1,'admin','admin@admin.com','123456789','0120120456021','2022-05-17 12:03:28',NULL,'admin','1',NULL),(5,'pharmacie2','pharmacie2@pharmacie.com','123456789','12345678901','2022-05-18 00:27:50','1652826470young-woman-pharmacist-pharmacy.jpg','pharmacie','1','gizah'),(6,'client2','client2@client.com','123456789','12345678901','2022-05-18 22:39:02','1652906342icons8-change-user-48.png','client','1','qahira');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-03 15:46:00
