-- MariaDB dump 10.18  Distrib 10.4.17-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: Hardware
-- ------------------------------------------------------
-- Server version	10.4.17-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branch` (
  `branch_ID` int(11) NOT NULL AUTO_INCREMENT,
  `branch_Name` varchar(75) NOT NULL,
  `branch_Address` varchar(100) NOT NULL,
  PRIMARY KEY (`branch_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch`
--

LOCK TABLES `branch` WRITE;
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` VALUES (1,'Branch_Name',' Block 1 Lot 1, Streetname, City, Country');
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `cart_ID` int(11) NOT NULL AUTO_INCREMENT,
  `itemID` int(11) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `itemPrice` varchar(50) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `itemTotalP` varchar(100) NOT NULL,
  PRIMARY KEY (`cart_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory` (
  `branch_ID` int(11) NOT NULL,
  `item_ID` int(11) NOT NULL,
  `item_Stock` int(11) NOT NULL,
  `item_RetailPrice` double NOT NULL,
  `Item_markup` double NOT NULL,
  `in_pending` tinyint(4) DEFAULT NULL,
  `inventoryItem_Status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`branch_ID`,`item_ID`),
  KEY `item_ID` (`item_ID`),
  CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`branch_ID`) REFERENCES `branch` (`branch_ID`) ON UPDATE CASCADE,
  CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`item_ID`) REFERENCES `item` (`item_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` VALUES (1,1,50,198,1.28,0,1),(1,2,50,15,1.5,0,1),(1,3,50,13,1.5,0,1),(1,4,50,135,1.5,0,1),(1,5,49,128,1.51,0,1),(1,6,50,87,1.2,0,1),(1,7,49,61,1.25,0,1),(1,8,50,63,1.25,0,1),(1,12,50,9,1.5,0,1),(1,13,50,14,1.5,0,1),(1,14,50,18,1.5,0,1),(1,15,50,12,1.5,0,1),(1,16,50,22,1.88,0,1),(1,17,50,62,1.2,0,1),(1,18,50,20,1.55,0,1),(1,19,48,19,1.55,0,1),(1,20,50,9,1.7,0,1),(1,24,50,4,2.5,0,1),(1,25,50,3,1.6,0,1),(1,26,50,5,1.45,0,1),(1,27,50,5,1.45,0,1),(1,28,50,7,1.5,0,1),(1,29,50,7,2,0,1),(1,30,50,4,1.25,0,1),(1,31,50,185,1.45,0,1),(1,32,50,50,1.3,0,1),(1,33,50,61,1.3,0,1),(1,34,50,65,1.3,0,1),(1,35,50,69,1.3,0,1),(1,36,50,99,1.3,0,1),(1,37,50,42,1.3,0,1),(1,38,50,68,1.3,0,1),(1,39,50,71,1.3,0,1),(1,40,50,60,1.35,0,1),(1,41,50,72,1.3,0,1),(1,42,50,40,1.3,0,1),(1,43,50,5,1.7,0,1),(1,44,50,4,1.7,0,1),(1,45,50,5,1.7,0,1),(1,46,50,4,1.7,0,1),(1,47,50,3,1.45,0,1),(1,48,50,4,1.45,0,1),(1,49,50,3,1.45,0,1),(1,50,50,4,1.45,0,1),(1,51,50,5,1.45,0,1),(1,52,50,6,1.45,0,1),(1,53,50,6,1.45,0,1),(1,54,50,8,1.45,0,1),(1,55,50,3442,1.4,0,1),(1,56,50,2249,1.4,0,1),(1,57,47,1534,1.4,0,1),(1,58,50,5384,1.4,0,1),(1,59,50,426,1.3,0,1),(1,60,50,24,1.3,0,1),(1,61,50,35,1.33,0,1),(1,62,50,29,1.3,0,1),(1,63,50,661,1.3,0,1),(1,64,50,735,1.3,0,1),(1,65,50,654,1.3,0,1),(1,66,50,239,1.3,0,1),(1,67,50,239,1.3,0,1),(1,68,50,239,1.3,0,1),(1,69,49,239,1.3,0,1),(1,70,50,233,1.3,0,1),(1,71,50,233,1.3,0,1),(1,72,50,233,1.3,0,1),(1,73,50,233,1.3,0,1),(1,74,50,661,1.3,0,1),(1,75,46,661,1.3,0,1),(1,76,50,465,1.3,0,1),(1,77,50,654,1.3,0,1),(1,78,50,87,1.4,0,1),(1,79,50,465,1.3,0,1),(1,80,50,465,1.3,0,1),(1,81,50,142,1.3,0,1),(1,82,50,145,1.4,0,1),(1,83,50,109,1.4,0,1),(1,84,50,25,1.6,0,1),(1,85,50,27,1.6,0,1),(1,86,45,30,1.6,0,1),(1,87,50,43,1.3,0,1),(1,88,50,1,2,0,1),(1,89,45,1,2.5,0,1),(1,90,50,1,2,0,1),(1,91,50,1,2,0,1),(1,92,50,911,1.2,0,1),(1,93,48,21,1.5,0,1),(1,94,50,366,1.5,0,1),(1,95,50,411,1.5,0,1),(1,96,50,232,1.212,0,1),(1,97,50,129,1.2,0,1),(1,98,48,99,1.45,0,1),(1,99,50,46,1.45,0,1),(1,100,50,103,1.45,0,1),(1,101,50,43,1.45,0,1),(1,102,50,19,1.25,0,1),(1,103,50,8,1.8,0,1),(1,104,50,8,1.8,0,1),(1,107,50,8,1.8,0,1),(1,108,50,8,1.8,0,1),(1,109,50,8,1.8,0,1),(1,110,50,8,1.8,0,1),(1,111,50,8,1.8,0,1),(1,112,50,8,1.8,0,1),(1,113,50,558,1.3,0,1),(1,114,50,634,1.3,0,1),(1,115,50,69,1.45,0,1),(1,116,50,69,1.45,0,1),(1,117,50,69,1.45,0,1),(1,118,50,69,1.45,0,1),(1,119,45,69,1.45,0,1),(1,120,50,424,1.3,0,1),(1,121,50,503,1.4,0,1),(1,122,50,422,1.4,0,1),(1,123,46,250,1.2,0,1),(1,124,50,1177,1.45,0,1),(1,125,50,608,1.45,0,1),(1,126,49,793,1.45,0,1),(1,127,50,1215,1.45,0,1),(1,128,50,96,1.5,0,1),(1,129,50,118,1.5,0,1),(1,130,50,160,1.5,0,1),(1,131,50,174,1.5,0,1),(1,132,49,60,2,0,1),(1,133,50,78,1.9,0,1),(1,134,50,86,2.1,0,1),(1,135,50,107,2.2,0,1),(1,136,50,60,2.5,0,1),(1,137,50,74,2.5,0,1),(1,138,47,46,2,0,1),(1,139,50,81,2,0,1),(1,140,50,284,2,0,1),(1,141,50,202,2,0,1),(1,142,50,55,2,0,1),(1,143,50,174,1.46,0,1),(1,144,49,270,1.2,0,1),(1,145,50,42,1.45,0,1),(1,146,50,60,1.45,0,1),(1,147,50,74,1.45,0,1),(1,148,50,10,3.5,0,1),(1,149,50,17,1.45,0,1),(1,150,50,6,3.5,0,1),(1,151,50,8,3.5,0,1),(1,152,50,16,3,0,1),(1,153,50,28,3,0,1),(1,154,50,9,2.2,0,1),(1,155,50,503,1.45,0,1),(1,156,50,340,1.3,0,1),(1,157,50,340,1.3,0,1),(1,158,50,304,1.3,0,1),(1,159,50,304,1.3,0,1),(1,160,50,21,2,0,1),(1,161,50,158,1.7,0,1),(1,162,50,13,1.45,0,1),(1,163,50,20,1.58,0,1),(1,164,49,26,1.45,0,1),(1,165,50,7,1.5,0,1),(1,166,50,7,1.5,0,1),(1,167,50,7,1.5,0,1),(1,168,45,193,1.35,0,1),(1,169,50,1650,1.53,0,1),(1,170,50,1164,1.35,0,1),(1,171,60,896.448,1.45,0,1),(1,172,50,628,1.45,0,1),(1,173,50,628,1.45,0,1),(1,174,50,628,1.45,0,1),(1,175,50,143,2.1,0,1),(1,176,50,184,2,0,1),(1,177,50,215,2,0,1),(1,178,45,122,1.5,0,1),(1,179,50,4,2,0,1),(1,180,50,5,2,0,1),(1,181,50,11,2,0,1),(1,182,50,16,1.65,0,1),(1,183,50,13,2.5,0,1),(1,184,50,64,1.18,0,1),(1,185,50,114,1.2,0,1),(1,186,48,162,1.31,0,1),(1,187,50,13,2.2,0,1),(1,188,50,13,2.2,0,1),(1,189,50,13,2.2,0,1),(1,190,50,14,2.2,0,1),(1,191,50,30,2.2,0,1),(1,192,50,313,1.39,0,1),(1,193,50,457,1.33,0,1),(1,194,50,204,1.365,0,1),(1,195,50,354,1.493,0,1),(1,196,50,338,1.395,0,1),(1,197,50,115,1.5,0,1),(1,198,50,899,2.4,0,1),(1,199,50,606,1.35,0,1),(1,200,46,1851,1.5,0,1),(1,201,50,95,1.4,0,1),(1,202,50,398,1.3,0,1),(1,203,50,56,3,0,1),(1,204,50,73,3,0,1),(1,205,50,6826,1.4,0,1),(1,206,50,4363,1.4,0,1),(1,207,50,2851,1.4,0,1),(1,208,50,1944,1.4,0,1),(1,209,50,377,2,0,1),(1,210,50,523,2,0,1),(1,211,50,63,2,0,1),(1,212,50,103,2,0,1),(1,213,50,140,2,0,1),(1,214,50,193,2,0,1),(1,215,50,52,2,0,1),(1,216,50,49,2,0,1),(1,217,50,134,1.2,0,1),(1,218,50,65,1.2,0,1),(1,219,50,140,1.2,0,1),(1,220,50,86,1.2,0,1),(1,221,50,53,1.2,0,1),(1,222,50,79,1.2,0,1),(1,223,50,88,1.2,0,1),(1,224,50,79,1.2,0,1),(1,225,50,52,1.2,0,1),(1,226,50,143,1.2,0,1),(1,227,50,134,1.2,0,1),(1,228,50,27,1.5,0,1),(1,229,50,20,1.5,0,1),(1,230,50,25,1.5,0,1),(1,231,50,14,2,0,1),(1,232,50,27,1.5,0,1),(1,233,50,50,1.2,0,1),(1,234,50,79,1.2,0,1),(1,235,47,23,1.5,0,1),(1,236,50,16,1.5,0,1),(1,237,50,29,1.5,0,1),(1,238,50,23,1.5,0,1),(1,239,50,9,1.5,0,1),(1,240,50,1,3.7,0,1),(1,247,50,1,3.3,0,1),(1,248,50,1,5,0,1),(1,249,50,1,3.9,0,1),(1,250,50,1,2.5,0,1),(1,251,50,107,1.2,0,1),(1,252,50,107,1.2,0,1),(1,253,50,15,2,0,1),(1,254,50,108,3.5,0,1),(1,255,50,108,3.6,0,1),(1,256,50,102,3.5,0,1),(1,257,50,102,3.5,0,1),(1,258,50,102,3.5,0,1),(1,259,50,102,3.5,0,1),(1,260,50,102,3.5,0,1),(1,261,50,102,3.5,0,1),(1,262,50,59,5,0,1),(1,263,50,78,5,0,1),(1,264,50,9,5,0,1),(1,265,50,10,6,0,1),(1,266,50,14,6,0,1),(1,267,50,19,6,0,1),(1,268,50,21,6,0,1),(1,269,48,92,2,0,1),(1,270,50,94,2,0,1),(1,271,50,39,1.5,0,1),(1,272,50,33,1.5,0,1),(1,274,50,18,1.5,0,1),(1,275,50,9,1.5,0,1),(1,276,49,8,1.5,0,1),(1,277,50,18,1.5,0,1),(1,278,50,12,1.5,0,1),(1,279,50,10,1.5,0,1),(1,280,50,9,1.5,0,1),(1,281,49,426,1.3,0,1),(1,282,48,6,1.3,0,1),(1,283,50,10,2,0,1),(1,284,50,5,1.3,0,1),(1,285,50,2,2,0,1),(1,289,50,1,3,0,1),(1,290,50,1,2,0,1),(1,291,50,1,3,0,1),(1,292,50,1,3,0,1),(1,295,45,1,3.4,0,1),(1,296,50,1,3.5,0,1),(1,297,47,1,3.2,0,1),(1,298,50,1,4.5,0,1),(1,299,47,1,3.3,0,1),(1,303,50,1,3,0,1),(1,304,50,1,3,0,1),(1,305,50,1,3,0,1),(1,306,50,1541,1.4,0,1),(1,307,50,2242,1.35,0,1),(1,308,50,602,3.4,0,1),(1,309,50,1,3,0,1),(1,310,50,1,3,0,1),(1,311,50,1,3,0,1),(1,312,50,1,3,0,1),(1,316,50,1,4,0,1),(1,317,50,1,4,0,1),(1,318,90,3.6,4,0,1),(1,319,50,2,4,0,1),(1,320,100,1.425,2.5,0,1),(1,321,50,1,3,0,1),(1,322,50,1,3,0,1),(1,323,50,1,3,0,1),(1,324,50,1,3,0,1),(1,325,50,1,6,0,1),(1,326,50,1,6,0,1),(1,332,50,1,5,0,1),(1,338,50,1,3,0,1),(1,339,50,1,3,0,1),(1,340,50,1,3,0,1),(1,341,50,1,3,0,1),(1,342,50,128,1.2,0,1),(1,343,50,46,1.2,0,1),(1,344,50,52,1.2,0,1),(1,345,50,65,1.2,0,1),(1,346,50,52,1.2,0,1),(1,349,50,55,1.3,0,1),(1,350,50,162,1.2,0,1),(1,351,50,233,1.2,0,1),(1,352,50,59,1.2,0,1),(1,353,50,72,1.2,0,1);
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `item_ID` int(11) NOT NULL AUTO_INCREMENT,
  `item_Name` varchar(75) NOT NULL,
  `item_unit` varchar(50) NOT NULL,
  `item_Brand` varchar(50) NOT NULL,
  `item_Category` varchar(50) NOT NULL,
  `item_Status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`item_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=354 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,'Ohayo water meter 1/2\" dry (5/)','Pcs','Ohayo','Plumbing',1),(2,'GI elbow reducer 3/4 x 1/2\"','Pcs','unbranded','Plumbing',1),(3,'GI socket reducer 3/4 x 1/2\"','Pcs','unbranded','Plumbing',1),(4,'G.V. faucet hose bibb medium','pc','G.V.','Plumbing',1),(5,'G.V. faucet plain bibb medium','pc','G.V.','Plumbing',1),(6,'Neltex solvent cement, 200ml','can',' Neltex ','Plumbing',1),(7,'E.C.Q. Chrome faucet P/Bibb (20/','pc','ECQ','Plumbing',1),(8,'E.C.Q. Chrome faucet H/Bibb (20/)','pc','ECQ','Plumbing',1),(9,'E.C.Q. Lavatory faucet HD (12/box)','pc','ECQ','Plumbing',1),(10,'GI coupling (270) 1/2\" (600/)','pc','unbranded','Plumbing',1),(11,'GI coupling (270) 3/4\" (600/)','pc','unbranded','Plumbing',1),(12,'GI elbow banded 1/2\"','pc','unbranded','Plumbing',1),(13,'GI elbow banded 3/4\"','pc','unbranded','Plumbing',1),(14,'GI tee  (130) 1/2\"','Pcs','unbranded','Plumbing',1),(15,'GI tee  (130) 3/4\"','pc','unbranded','Plumbing',1),(16,'GI tee reducer 3/4 x 1/2\"','Pcs','unbranded','Plumbing',1),(17,'Neltex solvent cement, 100ml','can',' Neltex ','Plumbing',1),(18,'HK PVC faucet hose bibb blue','pc','ECQ','Plumbing',1),(19,'HK PVC faucet plain','pc','ECQ','Plumbing',1),(20,'Rosco tee reducer 3/4 x 1/2','Pcs','Rosco','Plumbing',1),(21,'Teflon tape, 1/2 x 10m (12mm)','pc','unbranded','Plumbing',1),(22,'Rosco coupling reducer3/4\" x 1/2','Pcs','Rosco','Plumbing',1),(23,'Rosco RO-640 coupling 1/2 (50/)','Pcs','Rosco','Plumbing',1),(24,'Rosco RO-640 coupling 3/4 (50/)','Pcs','Rosco','Plumbing',1),(25,'Rosco RO-641  elbow 1/2 (50/)','Pcs','Rosco','Plumbing',1),(26,'Rosco RO-641 elbow 3/4 (50/)','Pcs','Rosco','Plumbing',1),(27,'Rosco RO-643 blue tee 1/2 (25/)','Pcs','Rosco','Plumbing',1),(28,'Rosco RO-643 blue tee 3/4 (25/)','Pcs','Rosco','Plumbing',1),(29,'Teflon tape, 3/4 x 10m','pc','unbranded','Plumbing',1),(30,'Hose clamp CP 1/2','pc','unbranded','Plumbing',1),(31,'Shovel \"Tombo\" round point #2','pc','unbranded','Tools',1),(32,'Cartridge fuse Eagle 60amp (10)','Pc','Eagle','Electrical',1),(33,'Firefly CFL XEU22 7W (25)','pc','Firefly','Electrical',1),(34,'Firefly CFL XEU22 9W (25)','pc','Firefly','Electrical',1),(35,'Firefly CFL XEU22 15W (25)','pc','Firefly','Electrical',1),(36,'Firefly CFL XEU22 23W (25)','pc','Firefly','Electrical',1),(37,'Philips Fluo tube 10W x 50/box','pc','Philips','Electrical',1),(38,'Philips Fluo tube 20W x 50/box','pc','Philips','Electrical',1),(39,'Philips Fluo tube 40W x 50/box','pc','Philips','Electrical',1),(40,'Eagle duplex tap #2082 20/box','Pc','Eagle','Electrical',1),(41,'Eagle triplex tap #2083 20/box','Pc','Eagle','Electrical',1),(42,'Omni 1way switchWES-213 20/box','Pc','Omni','Electrical',1),(43,'Rosco RO-646 F. adapter 3/4 (50)','Pcs','Rosco','Plumbing',1),(44,'Rosco RO-646 F. adapter 1/2 (50)','Pcs','Rosco','Plumbing',1),(45,'Rosco RO-647 M. adapter 3/4 (50)','Pcs','Rosco','Plumbing',1),(46,'Rosco RO-647 M. adapter 1/2 (50)','Pcs','Rosco','Plumbing',1),(47,'Rosco RO-648 blue cap 1/2 (50)','Pcs','Rosco','Plumbing',1),(48,'Rosco RO-648 blue cap 3/4 (50)','Pcs','Rosco','Plumbing',1),(49,'Rosco RO-648 blue plug 1/2 (50)','Pcs','Rosco','Plumbing',1),(50,'Rosco RO-648 blue plug 3/4 (50)','Pcs','Rosco','Plumbing',1),(51,'Rosco threaded elbow 1/2 (50/p)','Pcs','Rosco','Plumbing',1),(52,'Rosco threaded elbow 3/4 (50/p)','Pcs','Rosco','Plumbing',1),(53,'Rosco threaded tee 1/2 (25/p)','Pcs','Rosco','Plumbing',1),(54,'Rosco threaded tee 3/4 (25/p)','Pcs','Rosco','Plumbing',1),(55,'Omega THHN wire 10/7 x 150m (5.5)','roll','Omega','Electrical',1),(56,'Omega THHN wire 12/7 x 150m (3.5)','roll','Omega','Electrical',1),(57,'Omega THHN wire 14/7 x 150m (2.0)','roll','Omega','Electrical',1),(58,'Omega THHN wire 8/7 x 150m (8.0)','roll','Omega','Electrical',1),(59,'Zemcoat super fine white, 20 kgs','bag',' ABC ','Electrical',1),(60,'Moldex moulding white 1/2 (25)','Pc','Moldex','Electrical',1),(61,'Moldex moulding white 3/4 (25)','Pc','Moldex','Electrical',1),(62,'Moldex moulding white 5/8 (25)','Pc','Moldex','Electrical',1),(63,'GE breaker TQC 30A 2P bolt-on','prs','GE','Electrical',1),(64,'GE breaker TQC 60A 2P bolt-on','prs','GE','Electrical',1),(65,'GE circuit breaker TQL 40amp, plug-in (3/box)','prs','GE','Electrical',1),(66,'Koten bolt on breaker HPH-15amp','Pc',' Koten ','Electrical',1),(67,'Koten bolt on breaker HPH-20amp','Pc',' Koten ','Electrical',1),(68,'Koten bolt on breaker HPH-30amp','Pc',' Koten ','Electrical',1),(69,'Koten bolt on breaker HPH-60amp','Pc',' Koten ','Electrical',1),(70,'Koten plug in breaker HPH-P 15amp','Pc',' Koten ','Electrical',1),(71,'Koten plug in breaker HPH-P 20amp','Pc',' Koten ','Electrical',1),(72,'Koten plug in breaker HPH-P 30amp','Pc',' Koten ','Electrical',1),(73,'Koten plug in breaker HPH-P 60amp','Pc',' Koten ','Electrical',1),(74,'GE breaker TQC 15A 2P bolt-on','prs','GE','Electrical',1),(75,'GE breaker TQC 20A 2P bolt-on','prs','GE','Electrical',1),(76,'GE circuit breaker TQL 30amp, plug-in (3/box)','prs','GE','Electrical',1),(77,'GE circuit breaker TQL 60amp, plug-in (3/box)','prs','GE','Electrical',1),(78,'Diamond circular saw 4\" dry Makita','pc',' Makita ','Electrical',1),(79,'GE circuit breaker TQL 15amp, plug-in (3/box)','Pc','GE','Electrical',1),(80,'GE circuit breaker TQL 20amp, plug-in (3/box)','Pc','GE','Electrical',1),(81,'KM2195-B5 extension brown 5M','Pc','unbranded','Electrical',1),(82,'Omni P3-S13-PK 3G 1W switch set','Pc','Omni','Electrical',1),(83,'Omni P2-S13-PK 2Gang 1W switch set','Pc','Omni','Electrical',1),(84,'Cement trowel \"El Toro\" 7\"','Pc','unbranded','Tools',1),(85,'Cement trowel \"El Toro\" 8\"','Pc','unbranded','Tools',1),(86,'Cement trowel \"El Toro\" 9\"','Pc','unbranded','Tools',1),(87,'KM2049 chain current tap (20/box)','Pc','unbranded','Electrical',1),(88,'Cable clip 8mm square (FC#16)','Pc','unbranded','Electrical',1),(89,'Cable clip 10mm square (PDX12)','Pc','unbranded','Electrical',1),(90,'Cable clip 12mm square (PDX10)','Pc','unbranded','Electrical',1),(91,'Cable clip 14mm square (PDX)','Pc','unbranded','Electrical',1),(92,'Sahara waterproof cement (32/c)','crt','unbranded','Architectural',1),(93,'Plastic cement pale','Pc','unbranded','Architectural',1),(94,'Nihonweld S/S rod 3/32 (2.5mm)','kg','Nihonweld','Architectural',1),(95,'Nihonweld S/S rod 5/64 (2.0mm)','kg','Nihonweld','Architectural',1),(96,'Vulcaseal 1/2 ltr x 12 cans/ctn','can',' Bostik ','Architectural',1),(97,'Vulcaseal 1/4 ltr x 12 cans/ctn','can',' Bostik ','Architectural',1),(98,'Elastoseal 250G pisil pack /30','pack',' Pioneer ','Architectural',1),(99,'Cord epoxy steel 15 grams x 48 pcs','Pc',' Cord ','Architectural',1),(100,'Cord epoxy steel 40 grams x 24 pcs','Pc',' Cord ','Architectural',1),(101,'Pisilito elastoseal 85G x 30/box','Pc',' Pioneer ','Architectural',1),(102,'Zebra contact cement 42ml (72/box)','bot',' Zebra ','Architectural',1),(103,'Omega waterproof sandpaper #120','Pc',' Omega ','Architectural',1),(104,'Omega waterproof sandpaper #150','Pc',' Omega ','Architectural',1),(105,'Omega waterproof sandpaper #180','Pc',' Omega ','Architectural',1),(106,'Omega waterproof sandpaper #220','Pc',' Omega ','Architectural',1),(107,'Omega waterproof sandpaper #240','Pc',' Omega ','Architectural',1),(108,'Omega waterproof sandpaper #280','Pc',' Omega ','Architectural',1),(109,'Omega waterproof sandpaper #400','Pc',' Omega ','Architectural',1),(110,'Omega waterproof sandpaper #600','Pc',' Omega ','Architectural',1),(111,'Omega waterproof sandpaper #800','Pc',' Omega ','Architectural',1),(112,'Omega waterproof sandpaper #1000','Pc',' Omega ','Architectural',1),(113,'Lacquer thinner 350CC x 24 bot','ctn',' unbranded ','Architectural',1),(114,'Paint thinner 350CC x 24 bot','ctn',' unbranded ','Architectural',1),(115,'Concrete nail 1\" x 4.0mm','kg',' unbranded ','Architectural',1),(116,'Concrete nail 2\" x 4.5mm','kg',' unbranded ','Architectural',1),(117,'Concrete nail 3\" x 4.8mm','kg',' unbranded ','Architectural',1),(118,'Concrete nail 4\" x 4.8mm','kg',' unbranded ','Architectural',1),(119,'Concrete nail 1-1/2\" x 4.0mm','kg',' unbranded ','Architectural',1),(120,'Novtek red cement (2kg/10Pack)','box',' Novtek ','Architectural',1),(121,'ABC grout F1 beige (2kgs/10 bag)','Ctn',' ABC ','Architectural',1),(122,'ABC grout F15 white (2kgs/10 bag)','Ctn',' ABC ','Architectural',1),(123,'ABC tile adhesive 25kgs gray','sack',' ABC ','Architectural',1),(124,'Nihonweld special N6013 (3/32)','box',' Nihonweld ','Architectural',1),(125,'Amerilock brass padlock 20mm','doz',' Amerilock ','Architectural',1),(126,'Amerilock brass padlock 30mm','doz',' Amerilock ','Architectural',1),(127,'Amerilock brass padlock 40mm','doz',' Amerilock ','Architectural',1),(128,'Tansi 40yds #0.70mm 35 lbs','pack',' unbranded ','Architectural',1),(129,'Tansi 40yds #0.80mm 45 lbs','pack',' unbranded ','Architectural',1),(130,'Tansi 40yds #0.90mm 50 lbs','pack',' unbranded ','Architectural',1),(131,'Tansi 40yds #1.00mm 60 lbs','pack',' unbranded ','Architectural',1),(132,'China brass barrel bolt 2\" (99)','Doz',' unbranded ','Architectural',1),(133,'China brass barrel bolt 2-1/2\" (99)','Doz',' unbranded ','Architectural',1),(134,'China brass barrel bolt 3\" (99)','Doz',' unbranded ','Architectural',1),(135,'Door spring #3 TW ( doz/box) ','Doz',' unbranded ','Architectural',1),(136,'Putty knife w/o hole blue 4\"','doz',' unbranded ','Architectural',1),(137,'Putty knife w/o hole blue 6\"','doz',' unbranded ','Architectural',1),(138,'Safety hasp 2\" diamond (2 doz/230','Doz',' unbranded ','Architectural',1),(139,'Cup hook 1\" brass (120gr/ctn)','gross',' unbranded ','Architectural',1),(140,'Cup hook 2\" brass (120gr/ctn)','gross',' unbranded ','Architectural',1),(141,'Cup hook 1-1/2\" brass (120gr/ctn)','gross',' unbranded ','Architectural',1),(142,'Cup hook 3/4\" brass (120gr/ctn)','gross',' unbranded ','Architectural',1),(143,'Amerilock 588 SS (stainless) lockset','set',' Amerilock ','Architectural',1),(144,'Amerilock Dead bolt single D101SS','set',' Amerilock ','Architectural',1),(145,'Mighty bond (single) 3 grams x 40/box)','Pc',' Pioneer ','Architectural',1),(146,'Tyrolit basic C/O metal 4\" *','Pc',' Tyrolit ','Tools',1),(147,'Tyrolit basic C/O metal 4\" (1mm)','Pc',' Tyrolit ','Tools',1),(148,'Cylindrical hinge 5/8\" (16) (300)','Pc',' unbranded ','Architectural',1),(149,'Mighty bond (sakto) 1 gram x 24','Pc',' Pioneer ','Architectural',1),(150,'Cylindrical hinge 3/8\" (10) (600)','Pc',' unbranded ','Architectural',1),(151,'Cylindrical hinge 1/2\" (13) (480)','Pc',' unbranded ','Architectural',1),(152,'Cylindrical hinge 3/4\" (18) (200)','Pc',' unbranded ','Architectural',1),(153,'Cylindrical hinge 1\" (24) (100)','Pc',' unbranded ','Architectural',1),(154,'Matex door pull M-4 (72/box)','pc',' Matex ','Architectural',1),(155,'Denatured alcohol 350CC x 24 bot','ctn',' unbranded ','Architectural',1),(156,'Royu bolt on breaker 60A','pc',' Royu ','Architectural',1),(157,'Royu bolt on breaker 30A','pc',' Royu ','Architectural',1),(158,'Royu bolt on breaker 20A','pc',' Royu ','Architectural',1),(159,'Royu bolt on breaker 15A','pc',' Royu ','Architectural',1),(160,'PVC pail #12','pc','unbranded','Architectural',1),(161,'Putty knife w/out hole 6','doz','unbranded','Architectural',1),(162,'Armak masking tape 1/2\"','Pc','Armak','Architectural',1),(163,'Armak masking tape 3/4\"','Pc','Armak','Architectural',1),(164,'Armak masking tape 1\"','Pc','Armak','Architectural',1),(165,'Rosco sandpaper #60','Pc','Rosco','Architectural',1),(166,'Rosco sandpaper #80','Pc','Rosco','Architectural',1),(167,'Rosco sandpaper #100','Pc','Rosco','Architectural',1),(168,'Patching compound','sack','unbranded','Architectural',1),(169,'Umbrella nail twisted, 2-1/2','box','unbranded','Architectural',1),(170,'Do all contact cement 350cc','box','Shelby','Architectural',1),(171,'Plastic varnish, maple','box','unbranded','Electrical',1),(172,'Plastic varnish, natural','box','unbranded','Architectural',1),(173,'Plastic varnish, brown','box','unbranded','Architectural',1),(174,'Plastic varnish, mahogany','box','unbranded','Architectural',1),(175,'Door spring #4','Doz','unbranded','Architectural',1),(176,'Door spring #5','Doz','unbranded','Architectural',1),(177,'Door spring #6','Doz','unbranded','Architectural',1),(178,'Door pull #4 Matex','Doz','unbranded','Architectural',1),(179,'RO-600 tube cap 1/2\"CP',' Pc ','unbranded','Architectural',1),(180,'RO-600 tube cap 3/4\"CP',' Pc ','unbranded','Architectural',1),(181,'Curtain holder 1/2CP','Pc','unbranded','Architectural',1),(182,'Curtain holder 3/4CP','Pc','unbranded','Architectural',1),(183,'PVC sink strainer 4\" x 4\"','Pc','unbranded','Architectural',1),(184,'Stikwel pack 1/2 ltr','Pc','Stikwel','Architectural',1),(185,'Stikwel pack 1 ltr','Pc','Stikwel','Architectural',1),(186,'Polittuff w/ hardener 1liter','can','unbranded','Architectural',1),(187,'Drill bit 1/8\", masonry','Pc','unbranded','Tools',1),(188,'Drill bit 5/32\", masonry','Pc','unbranded','Tools',1),(189,'Drill bit 3/16\", masonry','Pc','unbranded','Tools',1),(190,'Drill bit 1/4\", masonry','Pc','unbranded','Tools',1),(191,'Drill bit 3/8\", masonry','Pc','unbranded','Tools',1),(192,'Plain sheet ga#24 x 3 x 8',' sht ','unbranded','Architectural',1),(193,'Plain sheet ga#24 x 4 x 8',' sht ','unbranded','Electrical',1),(194,'Plain sheet ga#26 x 3 x 8',' sht ','unbranded','Architectural',1),(195,'Plain sheet ga#26 x 4 x 8',' sht ','unbranded','Architectural',1),(196,'Kitchen sink s/s 14 x 20',' Pc ','unbranded','Plumbing',1),(197,'Kitchen sink ordinary small GI',' Pc ','Stallion','Plumbing',1),(198,'Level hose, 1/4\" x 300m',' roll ','unbranded','Architectural',1),(199,'Paint thinner, bottle',' box ','unbranded','Architectural',1),(200,'Beaver (Pala)',' doz ','Dragon','Architectural',1),(201,'HD putty knife 4\"',' doz ','unbranded','Architectural',1),(202,'S. gysum joint compound 20 kgs (Boral)',' bag ','Sakura','Architectural',1),(203,'Safety hasp 2-1/2\"',' doz ','unbranded','Architectural',1),(204,'Safety hasp 3\"',' doz ','unbranded','Architectural',1),(205,'TN08X-B THHN stranded 8mm2 BI','roll','Pelflex','Electrical',1),(206,'TN08X-B THHN stranded 5.5mm2','roll','Pelflex','Electrical',1),(207,'TN08X-B THHN stranded 3.5mm3','roll','Pelflex','Electrical',1),(208,'TN08X-B THHN stranded 2.0mm2','roll','Pelflex','Electrical',1),(209,'Globe paint brush 3\" (24dz/ctn)',' doz ',' Globe ','Architectural',1),(210,'Globe paint brush 4\" (15dz/ctn)',' doz ',' Globe ','Architectural',1),(211,'Globe paint brush 1\" (92dz/ctn)',' doz ',' Globe ','Architectural',1),(212,'Globe paint brush 1-1/2\" (50dz/ctn)',' doz ',' Globe ','Architectural',1),(213,'Globe paint brush 2\" (36dz/ctn)',' doz ',' Globe ','Architectural',1),(214,'Globe paint brush 2-1/2\" (50dz/ctn)',' doz ',' Globe ','Architectural',1),(215,'Globe paint brush 3/4\" (120dz/ctn)',' doz ',' Globe ','Architectural',1),(216,'Globe paint brush 1/2\" (202dz/ctn)',' doz ',' Globe ','Architectural',1),(217,'Taski metal polish 150ml (24/ctn)','pc',' Taski ','Architectural',1),(218,'Bosny wall putty B219 1/2k','can',' Bosny ','Architectural',1),(219,'W/C Enamel glazing putty white 1 ltr','can',' Welcoat ','Paints',1),(220,'T/T color bulletin red 1/4 ltr','can',' Triton ','Paints',1),(221,'T/T color burnt amber 1/4 ltr','can',' Triton ','Paints',1),(222,'T/T color pthalo green 1/4 ltr','can',' Triton ','Paints',1),(223,'T/T color hanza yellow 1/4 ltr','can',' Triton ','Paints',1),(224,'T/T color pthalo blue 1/4 ltr','can',' Triton ','Paints',1),(225,'T/T color raw sienna 1/4 ltr','can',' Triton ','Paints',1),(226,'W/C acrylic emulsion clear 1 ltr',' can ',' Welcoat ','Paints',1),(227,'WD-40 lubricant 6.3OZ (191ml)','can',' WD-40 ','Architectural',1),(228,'Baby roller w/ handle 4\" (BCA (84) foam storch',' pc ',' Storch ','Architectural',1),(229,'Mini roller w/ handle 4\" #401 (84) cotton Hi-tech',' pc ',' Hi-tech ','Architectural',1),(230,'Omega mini filler only 4\" (200) cotton',' pc ',' Omega ','Architectural',1),(231,'Paint roller 7\" Hi-Tech',' pc ',' Hi-tech ','Architectural',1),(232,'Paint roller with handle 7\" Hi-Tech',' pc ',' Hi-tech ','Architectural',1),(233,'Wipe out stain remover 250g','can',' Wipe-Out ','Architectural',1),(234,'Pioneer regular epoxy in can 161g (1/4 pint)','set',' Pioneer ','Architectural',1),(235,'Baby filler only 4\" #BC4',' pc ',' unbranded ','Architectural',1),(236,'Mini filler only 4\" #401',' pc ',' unbranded ','Architectural',1),(237,'Omega mini roller w/ handle 4\" (100) cotton',' pc ',' Omega ','Architectural',1),(238,'Paint roller with handle 4\" Hi-Tech',' pc ',' Hi-tech ','Architectural',1),(239,'Paint roller 4\" Hi-Tech',' pc ',' Hi-tech ','Architectural',1),(240,'Alum blind rivets 3/16 x 1','pc',' unbranded ','Architectural',1),(241,'Alum blind rivets 3/16 x 3/4','pc',' unbranded ','Architectural',1),(242,'Alum blind rivets 3/16 x 1/2','pc',' unbranded ','Architectural',1),(243,'Alum blind rivets 3/16 x 3/8','pc',' unbranded ','Architectural',1),(244,'Alum blind rivets 3/16 x 5/8','pc',' unbranded ','Architectural',1),(245,'Alum blind rivets 3/16 x 5/16','pc',' unbranded ','Architectural',1),(246,'Alum blind rivets 5/32 x 1/2','pc',' unbranded ','Architectural',1),(247,'Alum blind rivets 5/32 x 3/4','pc',' unbranded ','Architectural',1),(248,'Alum blind rivets 5/32 x 3/8','pc',' unbranded ','Architectural',1),(249,'Alum blind rivets 5/32 x 5/8','pc',' unbranded ','Architectural',1),(250,'Alum blind rivets 5/32 x 5/16','pc',' unbranded ','Architectural',1),(251,'Joinsil sealant black','tube',' Joinsil ','Architectural',1),(252,'Joinsil sealant clear','tube',' Joinsil ','Architectural',1),(253,'Roller paint tray only (20/bdle) ',' pc ',' unbranded ','Architectural',1),(254,'Lagscrew 1/2\" x 1-1/2\" (45/sck)','kg',' unbranded ','Architectural',1),(255,'Lagscrew 1/2\" x 2\" (45/sck)','kg',' unbranded ','Architectural',1),(256,'Lagscrew 1/4\" x 1-1/2\" (25 kg/sck)','kg',' unbranded ','Architectural',1),(257,'Lagscrew 1/4\" x 2\" (25 kg/sck)','kg',' unbranded ','Architectural',1),(258,'Lagscrew 3/8\" x 1-1/2\" (45 kg/sck)','kg',' unbranded ','Architectural',1),(259,'Lagscrew 3/8\" x 2\" (25 kg/sck)','kg',' unbranded ','Architectural',1),(260,'Lagscrew 5/16\" x 1-1/2\" (25 kg/sck)','kg',' unbranded ','Architectural',1),(261,'Lagscrew 5/16\" x 2\" (25 kg/sck)','kg',' unbranded ','Architectural',1),(262,'Metal screw #8 x 1-1/2\"','gross',' unbranded ','Architectural',1),(263,'Metal screw #10 x 1-1/2\"','gross',' unbranded ','Architectural',1),(264,'Tox expansion shield # 4 (300/)','box',' unbranded ','Architectural',1),(265,'Tox expansion shield # 5 (300/)','box',' unbranded ','Architectural',1),(266,'Tox expansion shield # 6 (300/)','box',' unbranded ','Architectural',1),(267,'Tox expansion shield # 8 (300/)','box',' unbranded ','Architectural',1),(268,'Tox expansion shield # 10 (300/)','box',' unbranded ','Architectural',1),(269,'Colored cotton gloves thick','doz',' unbranded ','Tools',1),(270,'Cotton gloves thick','doz',' unbranded ','Tools',1),(271,'Leather welding gloves, long','pair',' unbranded ','Tools',1),(272,'Leather welding gloves, medium','pair',' unbranded ','Tools',1),(273,'Expansion shield 1/2\" L (250/box)','pc',' unbranded ','Architectural',1),(274,'Expansion shield 1/2\" S (300/box)','pc',' unbranded ','Architectural',1),(275,'Expansion shield 1/4\" L (200/box)','pc',' unbranded ','Architectural',1),(276,'Expansion shield 1/4\" S (200/box)','pc',' unbranded ','Architectural',1),(277,'Expansion shield 3/8\" L (300/box)','pc',' unbranded ','Architectural',1),(278,'Expansion shield 3/8\" S (500/box)','pc',' unbranded ','Architectural',1),(279,'Expansion shield 5/16\" L (200/box)','pc',' unbranded ','Architectural',1),(280,'Expansion shield 5/16\" S (200/box)','pc',' unbranded ','Architectural',1),(281,'Zemcoat super fine white 20kgs','sack',' ABC ','Architectural',1),(282,'Stainless hose clamp 1\"','pc',' unbranded ','Architectural',1),(283,'Stainless hose clamp 1-1/2\"','pc',' unbranded ','Architectural',1),(284,'Stainless hose clamp 3/4\"','pc',' unbranded ','Architectural',1),(285,'PVC blue clamp 3/4','pc',' unbranded ','Plumbing',1),(286,'Rosco PVC orange clamp 3/4','pc',' Rosco ','Electrical',1),(287,'Rosco PVC orange clamp 1/2','pc',' Rosco ','Electrical',1),(288,'Gypsum screw metal 50mm (500/bx)','pc',' unbranded ','Architectural',1),(289,'Gypsum screw wood 50mm (500/bx)','pc',' unbranded ','Architectural',1),(290,'Rosco PVC blue clamp 1/2','pc',' Rosco ','Plumbing',1),(291,'Gypsum screw metal 65mm (300/bx)','pc',' unbranded ','Architectural',1),(292,'Gypsum screw wood 65mm (300/bx)','pc',' unbranded ','Architectural',1),(293,'Alum blind rivets 1/8 x 1','pc',' unbranded ','Architectural',1),(294,'Alum blind rivets 1/8 x 1/2','pc',' unbranded ','Architectural',1),(295,'Alum blind rivets 1/8 x 1/4','pc',' unbranded ','Architectural',1),(296,'Alum blind rivets 1/8 x 3/4','pc',' unbranded ','Architectural',1),(297,'Alum blind rivets 1/8 x 3/8','pc',' unbranded ','Architectural',1),(298,'Alum blind rivets 1/8 x 5/8','pc',' unbranded ','Architectural',1),(299,'Alum blind rivets 1/8 x 5/16','pc',' unbranded ','Architectural',1),(300,'Gypsum screw metal 25mm (1k/bx)','pc',' unbranded ','Architectural',1),(301,'Gypsum screw metal 32mm (1k/bx)','pc',' unbranded ','Architectural',1),(302,'Gypsum screw wood 25mm (1000/bx)','pc',' unbranded ','Architectural',1),(303,'Gypsum screw wood 32mm (1000/bx)','pc',' unbranded ','Architectural',1),(304,'Gypsum screw wood 38mm (500/bx)','pc',' unbranded ','Architectural',1),(305,'Gypsum screw metal 38mm (600/bx)','pc',' unbranded ','Architectural',1),(306,'Amazon screen 1/4\" x 3ft x 30m','roll',' unbranded ','Architectural',1),(307,'Amazon screen 1/8\" x 4ft x 30m','roll',' unbranded ','Architectural',1),(308,'Nylon rope #12 (6mm x 200m)','roll',' unbranded ','Architectural',1),(309,'Capscrew M5 x 8','Pc',' unbranded ','Electrical',1),(310,'Capscrew M5 x 10','Pc',' unbranded ','bolts and nuts',1),(311,'Capscrew M5 x 12','Pc',' unbranded ','bolts and nuts',1),(312,'Capscrew M5 x 15','Pc',' unbranded ','bolts and nuts',1),(313,'Capscrew M5 x 20','Pc',' unbranded ','bolts and nuts',1),(314,'Capscrew M5 x 25','Pc',' unbranded ','bolts and nuts',1),(315,'Capscrew M5 x 30','Pc',' unbranded ','bolts and nuts',1),(316,'Capscrew M5 x 35','Pc',' unbranded ','bolts and nuts',1),(317,'Capscrew M5 x 40','Pc',' unbranded ','bolts and nuts',1),(318,'Capscrew M5 x 45','Pc',' unbranded ','Electrical',1),(319,'Capscrew M5 x 50','Pc',' unbranded ','bolts and nuts',1),(320,'Capscrew M6 x 12','Pc',' unbranded ','Electrical',1),(321,'Capscrew M6 x 15','Pc',' unbranded ','bolts and nuts',1),(322,'Capscrew M6 x 20','Pc',' unbranded ','bolts and nuts',1),(323,'Capscrew M6 x 25','Pc',' unbranded ','bolts and nuts',1),(324,'Capscrew M6 x 30','Pc',' unbranded ','bolts and nuts',1),(325,'Nut M5','Pc',' unbranded ','bolts and nuts',1),(326,'Nut M6','Pc',' unbranded ','bolts and nuts',1),(327,'Nut M8','Pc',' unbranded ','bolts and nuts',1),(328,'Tin washer 3/16\"','Pc',' unbranded ','bolts and nuts',1),(329,'Tin washer 1/4\"','Pc',' unbranded ','bolts and nuts',1),(330,'Tin washer 5/16\"','Pc',' unbranded ','bolts and nuts',1),(331,'Tin washer 3/8\"','Pc',' unbranded ','bolts and nuts',1),(332,'Tin washer 7/16\"','Pc',' unbranded ','bolts and nuts',1),(333,'Tin washer 1/2\"','Pc',' unbranded ','bolts and nuts',1),(334,'Tin washer 9/16\"','Pc',' unbranded ','bolts and nuts',1),(335,'Tin washer 5/8\"','Pc',' unbranded ','bolts and nuts',1),(336,'Flat washer M6','Pc',' unbranded ','bolts and nuts',1),(337,'Tin washer M8','Pc',' unbranded ','bolts and nuts',1),(338,'Tetanized capscrew M5 x 8','Pc',' unbranded ','Electrical',1),(339,'Tetanized capscrew M5 x 10','Pc',' unbranded ','Electrical',1),(340,'Tetanized capscrew M5 x 12','Pc',' unbranded ','Electrical',1),(341,'Tetanized capscrew M5 x 15','Pc',' unbranded ','Electrical',1),(342,'Coco lumber 2 x 3 x 12','Pc',' unbranded ','Electrical',1),(343,'KD S4S 1/2 x 1 x 8','Pc',' unbranded ','Electrical',1),(344,'KD S4S 1/2 x 2 x 8','Pc',' unbranded ','Electrical',1),(345,'KD S4S 1/2 x 2 x 10','Pc',' unbranded ','Electrical',1),(346,'KD S4S 1 x 1 x 8','Pc',' unbranded ','Wood',1),(347,'KD QC 1 x 1 x 8','Pc',' unbranded ','Wood',1),(348,'KD QR 1 x 1 x 8','Pc',' unbranded ','Wood',1),(349,'H Round 1 x 1 x 8','Pc',' unbranded ','Wood',1),(350,'KD cornice 1 x 2 x 10','Pc',' unbranded ','Wood',1),(351,'KD cornice 1 x 3 x 10','Pc',' unbranded ','Wood',1),(352,'S4S 1 x 2 x 8','Pc',' unbranded ','Wood',1),(353,'S4S 1 x 2 x 10','Pc',' unbranded ','Wood',1);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `item_ID` int(11) NOT NULL,
  `order_ID` int(11) NOT NULL,
  `orderItems_Quantity` int(11) NOT NULL,
  `orderItems_TotalPrice` double NOT NULL,
  PRIMARY KEY (`item_ID`,`order_ID`),
  KEY `order_ID` (`order_ID`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`item_ID`) REFERENCES `item` (`item_ID`) ON UPDATE CASCADE,
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_ID`) REFERENCES `orders` (`order_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (5,2,1,128),(7,2,1,61),(19,2,2,38),(57,8,3,4602),(69,5,1,239),(75,2,4,2644),(86,15,5,150),(89,11,5,5),(93,10,2,42),(98,2,2,198),(119,11,5,345),(123,8,4,1000),(126,3,1,793),(132,4,1,60),(138,15,3,138),(144,9,1,270),(164,7,1,26),(168,13,5,965),(178,14,5,610),(186,1,2,324),(200,6,2,3702),(200,8,2,3702),(235,1,3,69),(269,4,2,184),(276,14,1,8),(281,11,1,426),(282,12,2,12),(295,7,5,5),(297,7,3,3),(299,7,3,3);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_ID` int(11) NOT NULL AUTO_INCREMENT,
  `order_Date` datetime NOT NULL,
  `order_Total` double NOT NULL,
  PRIMARY KEY (`order_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'2024-05-02 18:43:31',393),(2,'2024-05-02 18:45:01',3069),(3,'2024-05-02 18:45:12',793),(4,'2024-05-02 18:45:47',244),(5,'2024-05-02 18:46:03',239),(6,'2024-05-02 18:46:21',3702),(7,'2024-05-02 18:47:21',37),(8,'2024-05-06 13:08:23',9304),(9,'2024-05-06 19:22:53',270),(10,'2024-05-06 19:23:13',42),(11,'2024-05-06 19:23:46',776),(12,'2024-05-07 16:27:33',12),(13,'2024-05-07 16:27:43',965),(14,'2024-05-07 16:28:05',618),(15,'2024-05-07 16:28:34',288);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `return_item`
--

DROP TABLE IF EXISTS `return_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return_item` (
  `return_ID` int(11) NOT NULL AUTO_INCREMENT,
  `item_ID` int(11) NOT NULL,
  `item_ReturnedQuan` int(11) NOT NULL,
  `item_Reason` longtext NOT NULL,
  `itemReturn_Date` datetime NOT NULL,
  PRIMARY KEY (`return_ID`),
  KEY `item_ID` (`item_ID`),
  CONSTRAINT `return_item_ibfk_1` FOREIGN KEY (`item_ID`) REFERENCES `item` (`item_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `return_item`
--

LOCK TABLES `return_item` WRITE;
/*!40000 ALTER TABLE `return_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `return_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `supplier_ID` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_Name` varchar(75) NOT NULL,
  `supplier_ContactPerson` varchar(75) NOT NULL,
  `supplier_ContactNum` varchar(11) NOT NULL,
  `supplier_Address` varchar(100) NOT NULL,
  `supplier_Status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`supplier_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'Wilmar','contact-01','09123456789','address-01',1),(2,'Wilmar Metal','contact-02','09123456789','address-02',1),(3,'JCM88','contact-03','09123456789','address-03',1),(4,'Finewood Corp.','contact-04','09123456789','address-04',1),(5,'Amao Enterprises Co.','contact-05','09123456789','address-05',1),(6,'Topstar','contact-06','09123456789','address-06',1),(7,'Amulet','contact-07','09123456789','address-07',1),(8,'One Way Merchandising','contact-08','09123456789','address-08',1),(9,'Pelflex','contact-09','09123456789','address-09',1);
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_item`
--

DROP TABLE IF EXISTS `supplier_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier_item` (
  `supplier_ID` int(11) NOT NULL,
  `item_ID` int(11) NOT NULL,
  `supplierItem_CostPrice` double NOT NULL,
  `supplierItem_Status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`supplier_ID`,`item_ID`),
  KEY `item_ID` (`item_ID`),
  CONSTRAINT `supplier_item_ibfk_1` FOREIGN KEY (`supplier_ID`) REFERENCES `supplier` (`supplier_ID`) ON UPDATE CASCADE,
  CONSTRAINT `supplier_item_ibfk_2` FOREIGN KEY (`item_ID`) REFERENCES `item` (`item_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_item`
--

LOCK TABLES `supplier_item` WRITE;
/*!40000 ALTER TABLE `supplier_item` DISABLE KEYS */;
INSERT INTO `supplier_item` VALUES (1,309,0.4,1),(1,310,0.4,1),(1,311,0.45,1),(1,312,0.5,1),(1,313,0.6,1),(1,314,0.65,1),(1,315,0.7,1),(1,316,0.75,1),(1,317,0.8,1),(1,318,0.9,1),(1,319,1,1),(1,320,0.57,1),(1,321,0.63,1),(1,322,0.72,1),(1,323,0.8,1),(1,324,0.9,1),(1,325,0.25,1),(1,326,0.33,1),(1,327,0.55,1),(1,331,0.31,1),(1,332,0.49,1),(2,338,0.4,1),(2,339,0.4,1),(2,340,0.43,1),(2,341,0.46,1),(3,342,126,1),(4,343,44.8,1),(4,344,51.2,1),(4,345,64,1),(4,346,51.2,1),(4,347,53.6,1),(4,348,53.6,1),(4,349,53.6,1),(4,350,160,1),(4,351,230,1),(4,352,58.05,1),(4,353,70.95,1),(5,1,195,1),(5,2,14.7,1),(5,3,12,1),(5,4,132.8,1),(5,5,125.6,1),(5,6,85.84,1),(5,7,60,1),(5,8,62,1),(5,9,78,1),(5,10,6.75,1),(5,11,8.7,1),(5,12,8.8,1),(5,13,13.5,1),(5,14,17.2,1),(5,15,11.7,1),(5,16,21,1),(5,17,60.43,1),(5,18,19,1),(5,19,18,1),(5,20,8.5,1),(5,21,3.85,1),(5,22,3.55,1),(5,23,2,1),(5,24,3,1),(5,25,2.95,1),(5,26,4.5,1),(5,27,4.5,1),(5,28,6.25,1),(5,29,6.4,1),(5,30,3.3,1),(5,31,182,1),(5,32,48.85,1),(5,33,59.96,1),(5,34,63.71,1),(5,35,67.46,1),(5,36,97.46,1),(5,37,41.3,1),(5,38,66.5,1),(5,39,69.3,1),(5,40,58.85,1),(5,41,71.05,1),(5,42,39.01,1),(5,43,4.1,1),(5,44,3.55,1),(5,45,4.1,1),(5,46,3.55,1),(5,47,2.5,1),(5,48,3.75,1),(5,49,2.5,1),(5,50,3.75,1),(5,51,4.8,1),(5,52,5.9,1),(5,53,4.95,1),(5,54,7.05,1),(5,55,3,1),(5,56,2,1),(5,57,1,1),(5,58,5,1),(5,59,420,1),(5,60,23,1),(5,61,33.75,1),(5,62,28.18,1),(5,63,651.7,1),(5,64,724.85,1),(5,65,645.05,1),(5,66,235,1),(5,67,235,1),(5,68,235,1),(5,69,235,1),(5,70,230,1),(5,71,230,1),(5,72,230,1),(5,73,230,1),(5,74,651.7,1),(5,75,651.7,1),(5,76,458.85,1),(5,77,645.05,1),(5,78,85,1),(5,79,458.85,1),(5,80,458.85,1),(5,81,140,1),(5,82,142.32,1),(5,83,106.7,1),(5,84,24.2,1),(5,85,26.4,1),(5,86,28.6,1),(5,87,42,1),(5,88,0.4,1),(5,89,0.5,1),(5,90,0.6,1),(5,91,0.65,1),(5,92,900,1),(5,93,20,1),(5,94,360,1),(5,95,404,1),(5,96,228.42,1),(5,97,126.9,1),(5,98,97.33,1),(5,99,44.8,1),(5,100,100.88,1),(5,101,42.29,1),(5,102,18.13,1),(5,103,7.25,1),(5,104,7.25,1),(5,105,7.25,1),(5,106,7.25,1),(5,107,7.25,1),(5,108,7.25,1),(5,109,7.25,1),(5,110,7.25,1),(5,111,7.25,1),(5,112,7.25,1),(5,113,550,1),(5,114,625,1),(5,115,68,1),(5,116,68,1),(5,117,68,1),(5,118,68,1),(5,119,68,1),(5,120,418,1),(5,121,496,1),(5,122,416,1),(5,123,246.8,1),(5,124,1,1),(5,125,598.5,1),(5,126,780.9,1),(5,127,1,1),(5,128,94,1),(5,129,116,1),(5,130,157,1),(5,131,171,1),(5,132,58.8,1),(5,133,75.6,1),(5,134,84,1),(5,135,104.5,1),(5,136,58,1),(5,137,72,1),(5,138,44.8,1),(5,139,79,1),(5,140,278,1),(5,141,198,1),(5,142,53,1),(5,143,171,1),(5,144,266,1),(5,145,40.5,1),(5,146,59,1),(5,147,72,1),(5,148,9.38,1),(5,149,16.44,1),(5,150,5.63,1),(5,151,7.13,1),(5,152,15,1),(5,153,27,1),(5,154,8.8,1),(5,155,495,1),(5,209,369.6,1),(5,210,512.4,1),(5,211,60.9,1),(5,212,100.8,1),(5,213,136.5,1),(5,214,189,1),(5,215,50.4,1),(5,216,47.6,1),(5,217,131.75,1),(5,218,63.9,1),(5,219,138.08,1),(5,220,84.84,1),(5,221,52.35,1),(5,222,77.62,1),(5,223,86.64,1),(5,224,77.62,1),(5,225,50.54,1),(5,226,140.79,1),(5,227,132.3,1),(5,228,26,1),(5,229,19,1),(5,230,24,1),(5,231,13.2,1),(5,232,26,1),(5,233,48.6,1),(5,234,77.36,1),(5,235,22,1),(5,236,15,1),(5,237,28,1),(5,238,22,1),(5,239,8.8,1),(5,240,0.54,1),(5,241,0.38,1),(5,242,0.31,1),(5,243,0.28,1),(5,244,0.32,1),(5,245,0.24,1),(5,246,0.21,1),(5,247,0.29,1),(5,248,0.19,1),(5,249,0.26,1),(5,250,0.17,1),(5,251,105,1),(5,252,105,1),(5,253,14,1),(5,254,104,1),(5,255,104,1),(5,256,98,1),(5,257,98,1),(5,258,98,1),(5,259,98,1),(5,260,98,1),(5,261,98,1),(5,262,56,1),(5,263,73.5,1),(5,264,8,1),(5,265,9,1),(5,266,12.5,1),(5,267,17.5,1),(5,268,19.75,1),(5,269,90,1),(5,270,92,1),(5,271,38,1),(5,272,32,1),(5,273,22.4,1),(5,274,16.8,1),(5,275,8.4,1),(5,276,7,1),(5,277,16.8,1),(5,278,11.2,1),(5,279,9.8,1),(5,280,8.4,1),(5,281,420,1),(5,282,5.1,1),(5,283,9.8,1),(5,284,4.7,1),(5,285,1.29,1),(5,286,1.29,1),(5,287,0.96,1),(5,288,0.5,1),(5,289,0.45,1),(5,290,0.96,1),(5,291,0.95,1),(5,292,0.9,1),(5,293,0.38,1),(5,294,0.18,1),(5,295,0.14,1),(5,296,0.26,1),(5,297,0.15,1),(5,298,0.2,1),(5,299,0.15,1),(5,300,0.25,1),(5,301,0.3,1),(5,302,0.2,1),(5,303,0.25,1),(5,304,0.35,1),(5,305,0.4,1),(5,306,1,1),(5,307,2,1),(5,308,581.4,1),(6,156,335,1),(6,157,335,1),(6,158,300,1),(6,159,300,1),(7,160,20,1),(7,161,155,1),(7,162,12.6,1),(7,163,18.9,1),(7,164,25.2,1),(7,165,6.75,1),(7,166,6.75,1),(7,167,6.75,1),(7,168,190,1),(7,169,1,1),(7,170,1,1),(7,171,618.24,1),(7,172,618.24,1),(7,173,618.24,1),(7,174,618.24,1),(7,175,140,1),(7,176,180,1),(7,177,210,1),(7,178,120,1),(7,179,3.33,1),(7,180,4.68,1),(7,181,10,1),(7,182,15,1),(7,183,12,1),(7,184,63,1),(7,185,112.5,1),(7,186,159.6,1),(7,187,12.15,1),(7,188,12.15,1),(7,189,12.6,1),(7,190,13.5,1),(7,191,28.8,1),(8,192,308.7,1),(8,193,450.8,1),(8,194,200.9,1),(8,195,347.9,1),(8,196,333.2,1),(8,197,112.7,1),(8,198,877.1,1),(8,199,597.8,1),(8,200,1,1),(8,201,93.1,1),(8,202,392,1),(8,203,53.9,1),(8,204,70.56,1),(9,205,6,1),(9,206,4,1),(9,207,2,1),(9,208,1,1);
/*!40000 ALTER TABLE `supplier_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_transactions`
--

DROP TABLE IF EXISTS `supplier_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier_transactions` (
  `transaction_ID` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_ID` int(11) NOT NULL,
  `transaction_Date` datetime NOT NULL,
  `transaction_Status` tinyint(4) DEFAULT NULL,
  `transaction_TotalPrice` double NOT NULL,
  PRIMARY KEY (`transaction_ID`),
  KEY `supplier_ID` (`supplier_ID`),
  CONSTRAINT `supplier_transactions_ibfk_1` FOREIGN KEY (`supplier_ID`) REFERENCES `supplier` (`supplier_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_transactions`
--

LOCK TABLES `supplier_transactions` WRITE;
/*!40000 ALTER TABLE `supplier_transactions` DISABLE KEYS */;
INSERT INTO `supplier_transactions` VALUES (1,1,'2024-05-02 18:47:58',2,64.5),(2,7,'2024-05-02 18:49:08',2,6182.4),(3,5,'2024-05-06 12:24:43',1,675),(4,3,'2024-05-06 13:10:07',1,2520),(5,8,'2024-05-07 16:28:54',1,2704.8),(6,9,'2024-05-07 16:29:06',0,47),(7,2,'2024-05-07 16:30:28',0,16.9),(8,4,'2024-05-07 16:31:36',0,2240);
/*!40000 ALTER TABLE `supplier_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_items`
--

DROP TABLE IF EXISTS `transaction_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_items` (
  `transaction_ID` int(11) NOT NULL,
  `item_ID` int(11) NOT NULL,
  `transactionItems_Quantity` int(11) NOT NULL,
  `transactionItems_CostPrice` double NOT NULL,
  `transactionItems_TotalPrice` double NOT NULL,
  PRIMARY KEY (`transaction_ID`,`item_ID`),
  KEY `item_ID` (`item_ID`),
  CONSTRAINT `transaction_items_ibfk_1` FOREIGN KEY (`transaction_ID`) REFERENCES `supplier_transactions` (`transaction_ID`) ON UPDATE CASCADE,
  CONSTRAINT `transaction_items_ibfk_2` FOREIGN KEY (`item_ID`) REFERENCES `item` (`item_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_items`
--

LOCK TABLES `transaction_items` WRITE;
/*!40000 ALTER TABLE `transaction_items` DISABLE KEYS */;
INSERT INTO `transaction_items` VALUES (1,318,40,0.9,36),(1,320,50,0.57,28.5),(2,171,10,618.24,6182.4),(3,10,100,6.75,675),(4,342,20,126,2520),(5,193,6,450.8,2704.8),(6,205,2,6,12),(6,206,5,4,20),(6,207,5,2,10),(6,208,5,1,5),(7,338,10,0.4,4),(7,339,10,0.4,4),(7,340,10,0.43,4.3),(7,341,10,0.46,4.6),(8,343,10,44.8,448),(8,344,10,51.2,512),(8,345,20,64,1280);
/*!40000 ALTER TABLE `transaction_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `user_pword` varchar(100) NOT NULL,
  PRIMARY KEY (`user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Username 1','202cb962ac59075b964b07152d234b70'),(2,'Username 2','202cb962ac59075b964b07152d234b70');
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

-- Dump completed on 2024-05-07 22:32:10
