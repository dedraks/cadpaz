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
-- Table structure for table `ctps`
--

DROP TABLE IF EXISTS `ctps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ctps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) DEFAULT NULL,
  `numero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `serie` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `uf` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_BD1C1E0DDF6FA0A5` (`pessoa_id`),
  CONSTRAINT `FK_BD1C1E0DDF6FA0A5` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ctps`
--

LOCK TABLES `ctps` WRITE;
/*!40000 ALTER TABLE `ctps` DISABLE KEYS */;
/*!40000 ALTER TABLE `ctps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) DEFAULT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `padrao` tinyint(1) NOT NULL,
  `logradouro` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `complemento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `municipio` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `uf` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `obs` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F8E0D60EDF6FA0A5` (`pessoa_id`),
  CONSTRAINT `FK_F8E0D60EDF6FA0A5` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

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
  `certidaoNascimento` tinyint(1) NOT NULL,
  `certidaoCasamento` tinyint(1) NOT NULL,
  `cartaoVacina` tinyint(1) NOT NULL,
  `estadoCivil` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nomeMae` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `corInformada` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (1,'Carlos da Silva','1974-10-01','M','11111111111',1,0,1,'SOLTEIRO','Maria da Silva','NEGRO','nao@tenho.com'),(2,'João da Silva','1950-05-28','M','22222222222',0,1,1,'CASADO','Joana da Silva Souza','PARDO','nao@tenho.com');
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pis`
--

DROP TABLE IF EXISTS `pis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) DEFAULT NULL,
  `numero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dataEmissao` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D683412ADF6FA0A5` (`pessoa_id`),
  CONSTRAINT `FK_D683412ADF6FA0A5` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pis`
--

LOCK TABLES `pis` WRITE;
/*!40000 ALTER TABLE `pis` DISABLE KEYS */;
INSERT INTO `pis` VALUES (1,1,'1234568569','2015-08-31');
/*!40000 ALTER TABLE `pis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rg`
--

DROP TABLE IF EXISTS `rg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) DEFAULT NULL,
  `numero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dataExpedicao` date NOT NULL,
  `orgaoExpedidor` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8F06FD70DF6FA0A5` (`pessoa_id`),
  CONSTRAINT `FK_8F06FD70DF6FA0A5` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rg`
--

LOCK TABLES `rg` WRITE;
/*!40000 ALTER TABLE `rg` DISABLE KEYS */;
INSERT INTO `rg` VALUES (1,1,'M-123.456.789','2015-08-05','SSP-MG');
/*!40000 ALTER TABLE `rg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefone`
--

DROP TABLE IF EXISTS `telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) DEFAULT NULL,
  `numero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `obs` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2132E361DF6FA0A5` (`pessoa_id`),
  CONSTRAINT `FK_2132E361DF6FA0A5` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefone`
--

LOCK TABLES `telefone` WRITE;
/*!40000 ALTER TABLE `telefone` DISABLE KEYS */;
/*!40000 ALTER TABLE `telefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `titulo`
--

DROP TABLE IF EXISTS `titulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `titulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) DEFAULT NULL,
  `numero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `zona` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `secao` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dataEmissao` date NOT NULL,
  `municipio` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `uf` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_17713E5ADF6FA0A5` (`pessoa_id`),
  CONSTRAINT `FK_17713E5ADF6FA0A5` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `titulo`
--

LOCK TABLES `titulo` WRITE;
/*!40000 ALTER TABLE `titulo` DISABLE KEYS */;
INSERT INTO `titulo` VALUES (1,1,'1234568569','123','1234','2015-08-01','Belo Horizonte','MG');
/*!40000 ALTER TABLE `titulo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-28 22:55:37
