-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: imob
-- ------------------------------------------------------
-- Server version	8.0.29

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
-- Table structure for table `medias`
--

DROP TABLE IF EXISTS `medias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medias` (
  `id_media` int NOT NULL AUTO_INCREMENT,
  `nm_file` varchar(500) NOT NULL,
  `ds_file_path` varchar(1000) NOT NULL,
  `dt_upload` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_property` int DEFAULT NULL,
  PRIMARY KEY (`id_media`),
  KEY `fk_id_imovel_idx` (`id_property`),
  CONSTRAINT `fk_id_property` FOREIGN KEY (`id_property`) REFERENCES `propertys` (`id_property`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medias`
--

LOCK TABLES `medias` WRITE;
/*!40000 ALTER TABLE `medias` DISABLE KEYS */;
INSERT INTO `medias` VALUES (5,'imagem plaza','/app/public/files/3e43c26a3005719f84b4365fd0718726.jpg','2022-07-03 16:54:22',3),(6,'planta','/app/public/files/1619719b58feeaf62eb4a85fb9a9a5b1.webp','2022-07-03 16:57:55',1),(7,'imagem riomar','/app/public/files/f810d055463d4e69d087c22eedbb96eb.jpg','2022-07-03 16:58:13',2);
/*!40000 ALTER TABLE `medias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propertys`
--

DROP TABLE IF EXISTS `propertys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propertys` (
  `id_property` int NOT NULL AUTO_INCREMENT,
  `ds_title` varchar(100) NOT NULL,
  `ds_description` varchar(500) DEFAULT NULL,
  `ds_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dt_insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nr_lat` varchar(100) NOT NULL DEFAULT '0',
  `nr_long` varchar(100) NOT NULL DEFAULT '0',
  `nr_price` decimal(14,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_property`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propertys`
--

LOCK TABLES `propertys` WRITE;
/*!40000 ALTER TABLE `propertys` DISABLE KEYS */;
INSERT INTO `propertys` VALUES (1,'Shopping Recife','Complexo amplo com lojas locais e internacionais, além de lanchonetes, cafés e um fliperama.','Shopping Recife - Rua Padre Carapuceiro - Boa Viagem, Recife - PE, Brasil','2022-06-30 23:44:57','-8.1190456','-34.9046689',15.51),(2,'RioMar Recife','O RioMar Shopping é um centro comercial de grande porte, localizado na cidade do Recife, capital de Pernambuco.','RioMar Recife - Avenida República do Líbano - Pina, Recife - PE, Brasil','2022-06-30 23:49:06','-8.086053999999999','-34.8947486',18.22),(3,'Plaza Casa Forte','Shopping contemporâneo com cinema, serviços e uma variedade de lojas varejistas e restaurantes.','Plaza Casa Forte - Rua Doutor João Santos Filho - Parnamirim, Recife - PE, Brasil','2022-06-30 23:53:03','-8.037011099999999','-34.9125792',36.99),(10,'TESTE','TESTETETETE','TESTE','2022-07-03 16:52:51','0','0',15.20);
/*!40000 ALTER TABLE `propertys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'imob'
--

--
-- Dumping routines for database 'imob'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-03 21:38:19
