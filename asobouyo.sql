-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: asobouyo
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

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
-- Table structure for table `Lyrics`
--

DROP TABLE IF EXISTS `Lyrics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Lyrics` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Format` enum('roomaji','kana','kanji') DEFAULT NULL,
  `FileLocation` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Lyrics`
--

LOCK TABLES `Lyrics` WRITE;
/*!40000 ALTER TABLE `Lyrics` DISABLE KEYS */;
INSERT INTO `Lyrics` VALUES (2,NULL,'pwd');
/*!40000 ALTER TABLE `Lyrics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Player`
--

DROP TABLE IF EXISTS `Player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Player` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) NOT NULL,
  `PhoneNumber` varchar(255) DEFAULT NULL,
  `DigitsID` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `DigitsIDIndex` (`DigitsID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Player`
--

LOCK TABLES `Player` WRITE;
/*!40000 ALTER TABLE `Player` DISABLE KEYS */;
INSERT INTO `Player` VALUES (8,'Username','12535145899','3271374978');
/*!40000 ALTER TABLE `Player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Score`
--

DROP TABLE IF EXISTS `Score`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Score` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SongID` int(11) NOT NULL,
  `PlayerDigitsID` varchar(255) NOT NULL,
  `Score` int(11) NOT NULL,
  `ArchivedDate` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `SongID` (`SongID`),
  KEY `PlayerDigitsID` (`PlayerDigitsID`),
  CONSTRAINT `Score_ibfk_1` FOREIGN KEY (`SongID`) REFERENCES `Song` (`ID`),
  CONSTRAINT `Score_ibfk_2` FOREIGN KEY (`PlayerDigitsID`) REFERENCES `Player` (`DigitsID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Score`
--

LOCK TABLES `Score` WRITE;
/*!40000 ALTER TABLE `Score` DISABLE KEYS */;
/*!40000 ALTER TABLE `Score` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Song`
--

DROP TABLE IF EXISTS `Song`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Song` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Artist` varchar(255) DEFAULT NULL,
  `Album` varchar(255) DEFAULT NULL,
  `Genre` varchar(255) DEFAULT NULL,
  `Length` time NOT NULL,
  `Difficulty` enum('slow','medium','fast') DEFAULT NULL,
  `LyricsID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `LyricsID` (`LyricsID`),
  CONSTRAINT `Song_ibfk_1` FOREIGN KEY (`LyricsID`) REFERENCES `Lyrics` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Song`
--

LOCK TABLES `Song` WRITE;
/*!40000 ALTER TABLE `Song` DISABLE KEYS */;
INSERT INTO `Song` VALUES (4,'yasashiihito',NULL,NULL,NULL,'00:01:00','slow',2);
/*!40000 ALTER TABLE `Song` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-07 19:06:17
