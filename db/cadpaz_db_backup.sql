-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: localhost    Database: cadpaz_db
-- ------------------------------------------------------
-- Server version	5.6.24

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
-- Table structure for table `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dataNascimento` date NOT NULL,
  `sexo` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `rgNumero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `rgDataExpedicao` date NOT NULL,
  `rgOrgaoExpedidor` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tituloEleitoralNumero` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tituloEleitoralZona` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tituloEleitoralSecao` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `pis` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ctpsNumero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ctpsSerie` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `certidaoNascimento` tinyint(1) NOT NULL,
  `certidaoCasamento` tinyint(1) NOT NULL,
  `cartaoVacina` tinyint(1) NOT NULL,
  `estadoCivil` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nomeMae` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `corInformada` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (1,'João Carlos da Silva','1974-10-01','M','11111111111','MG12345678','1990-01-30','SSP-MG','1234123412341234','123','1234','12023362999','1234567','1234',1,0,1,'SOLTEIRO','Maria da Silva','NEGRO','nao@tenho.com');
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-25 22:08:16
