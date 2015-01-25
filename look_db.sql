-- MySQL dump 10.13  Distrib 5.6.21, for Win32 (x86)
--
-- Host: localhost    Database: look_accessories
-- ------------------------------------------------------
-- Server version	5.6.21

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
-- Current Database: `look_accessories`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `look_accessories` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `look_accessories`;

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `apartment` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,'Romania','Timisoara','Timis','Studentilor','8','303'),(2,'Romania','Timisoara','Timis','Studentilor','163B','305');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `is_cart` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AB912789A76ED395` (`user_id`),
  CONSTRAINT `FK_AB912789A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (1,1,1),(2,2,1);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cartproduct`
--

DROP TABLE IF EXISTS `cartproduct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartproduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6DDC373A1AD5CDBF` (`cart_id`),
  KEY `IDX_6DDC373A4584665A` (`product_id`),
  CONSTRAINT `FK_6DDC373A1AD5CDBF` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  CONSTRAINT `FK_6DDC373A4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartproduct`
--

LOCK TABLES `cartproduct` WRITE;
/*!40000 ALTER TABLE `cartproduct` DISABLE KEYS */;
/*!40000 ALTER TABLE `cartproduct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `brand` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Assorted - Braid of Friendship',9,'Bracelets',24,'Michael Kors','Affordable enough to be a small token of affection just because! This woven leather bracelet will show your friends that you\'re thinking of them. A tiny gesture of appreciation for all they\'ve helped you through.','04f08535681af5b7c95ca4ff117d7666f8c40816.jpeg',1),(2,'Rivershine Bracelet',28,'Bracelets',34,'Trinity','The gentle ripple of a river wrapped around your wrist. Modern African design from Trinity Jewelry Crafts of Nairobi. Founder Joseph Muchina does all of Trinity\'s jewelry design.','a876ddfd51a7d0e7860664c7c2dd7dfc9409da6b.jpeg',1),(3,'Center Circle Bracelet',13,'Bracelets',43,'Vinader','A gradation of circles in burgundy, gold and tan. Center Circle Bracelet is comfortable in hand-crocheted cotton.','2e397a6153d5343a16df4cfebe8aae6a9f0b75f9.jpeg',1),(4,'Teal green jade and copper handmade earrings',134,'Earrings',33,'Galy','The 8 mm jade stones have individualized marking within each one, which I think adds to their uniqueness and appeal. Although each stone is different, I take care to ensure that the two stones used are a good match. The earrings hang on copper wires, and have a drop of around 2 cm / 1 inch when measured from the base of the ear wire.','ce0dcaf00a8281a0966d5e91060cd2981a05ddb6.jpeg',1),(5,'Tiny lovebirds nature tag earrings - golden yellow',53,'Earrings',27,'Jalpu','Cute little earrings made from hand dyed aluminium. Each metal disc has a branch with a little bird cut by hand using a tiny jewelers saw. The disc is slightly domed and hung from sterling silver ear wires - you can choose your shape of ear wire (circular as in main photo or oval). Can also be made in other colors on request, please message me with your requirements.','a82beaddaf5223efdffe38a96c41d5823e0cde5a.jpeg',1),(6,'Mis-matched little bird stud earrings',43,'Earrings',22,'Sweety','Sweet little earrings featuring tiny cut out oxidized copper birds set within a textured silver wire circle. The ear pins are sterling silver and come with silver scrolls. Please note your earrings may vary very slightly from the image.','e73590deca333909c54ef0d7b35c179d9afaa39d.jpeg',1),(7,'Rome Black',69,'Handbags',34,'Galfaz','This black across body bag from Collection features three main sections, with zip fastenings along he tops of two of the sections and a magnetic dot fastening on the middle compartment. It also has a front pocket with a contrasting silver twist lock fastening.','5734a423ac6063223c47976df82b0de741c397ed.jpeg',1),(8,'Bradford Blue',156,'Handbags',44,'Tiky','Add some summer to your look with this lovely grab bag from Floozies in navy, crafted with daisy applique on the front and an additional detachable shoulder strap.','e705198ebb4d10a80f1be04e3ff8b9e14990e162.jpeg',1),(9,'Acacia Red',223,'Handbags',21,'Viper','This red flap over purse from The Collection has a twist lock fastening and offers space for all your cash and cards with six card slots and a zipped coin pocket.','6bbaa3f09176a49e917342e6b1a158923b42cf6e.jpeg',1),(10,'Diamond Accent Black',343,'Watches',11,'Anne Klein','Set the mood for your outfit with Anne Klein\'s striking bracelet watch. The blackened design also sparkles with a single diamond accent at the dial.','64cfd7fe16bc98055b3cbba1125628c39ac95290.jpeg',1),(11,'Swiss Blue Woven',703,'Watches',15,'Tommy Bahama','A sparkling dial brings a touch of glam to the island style of this Tommy Bahama watch.','8b3829d5fb4674356284c26454037a5310f3e344.jpeg',1),(12,'Swiss Brown Woven',270,'Watches',22,'Tommy Bahama','A sparkling dial brings a touch of glam to the island style of this Tommy Bahama watch.','d157fc3cdf2ebb4a1aa19d843df2bc2071fa08c5.jpeg',1),(13,'Blue & White Sapphire',333,'Necklaces',17,'Kali','This heart-shaped lab-created blue sapphire necklace is topped with a sparkling lab-created white sapphire and crafted in sterling silver. The pendant suspends from an 18-inch box chain that fastens with a lobster clasp.','33e315c122cf50ee3669360af1ae33c0e76b6b12.png',1),(14,'Birthstone Heart Necklace',226,'Necklaces',23,'Katup','Birthstone Heart Necklace with Engraved Names wherever they are! This beautiful birthstone necklace can be engraved with up to four names and one birthstone crystal per name','8423a92170a8285c32868b14b6ff81b5dc12e8de.jpeg',1);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address_id` int(11) DEFAULT NULL,
  `username` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(49) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2DA17977F5B7AF75` (`address_id`),
  CONSTRAINT `FK_2DA17977F5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,'admin','e212dac0aa4c354fa72a7ccd2424efe79745e7de48e18e66','Admin','Administrator','M','admin@admin.com','1234567890',1),(2,2,'customer','e212dac0aa4c354fa72a7ccd2424efe79745e7de48e18e66','Customer','Customer','F','user@user.com','1234567890',NULL);
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

-- Dump completed on 2015-01-25 18:40:18
