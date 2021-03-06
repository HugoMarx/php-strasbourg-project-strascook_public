
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: strascook
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `adress` longtext,
  `email` varchar(100) DEFAULT NULL,
  `number` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `couverture` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id_idx` (`product_id`),
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,'tartecarotte.jpg',1,1),(2,'veloute.jpeg',2,1),(3,'croquettes.jpg',3,1),(4,'maki.jpg',4,1),(5,'tajine.jpg',5,1),(6,'chilli.jpg',6,1),(7,'rotitofu.jpg',7,1),(8,'pavlova.jpg',8,1),(9,'crumble.jpg',9,1),(10,'pudding.jpg',10,1),(11,'tartecarotte2.jpg',1,0),(12,'tartecarotte3.jpg',1,0),(13,'veloutepotimarron2.jpg',2,0),(14,'potimarrons.jpg',2,0),(15,'croquettes2.jpg',3,0),(16,'croquettes3.jpg',3,0),(17,'maki2.jpg',4,0),(18,'maki3.jpg',4,0),(19,'tajine2.jpg',5,0),(20,'tajine3.jpg',5,0),(21,'chilli2.jpg',6,0),(22,'chilli3.jpg',6,0),(23,'rotitofu2.jpg',7,0),(24,'rotitofu3.jpg',7,0),(25,'pavlova2.jpg',8,0),(26,'pavlova3.jpg',8,0),(27,'crumble2.jpg',9,0),(28,'crumble3.jpg',9,0),(29,'pudding2.jpg',10,0),(30,'pudding3.jpg',10,0),(31,'tartecarotte.jpg',1,0),(32,'veloute.jpeg',2,0),(33,'croquettes.jpg',3,0),(34,'maki.jpg',4,0),(35,'tajine.jpg',5,0),(36,'chilli.jpg',6,0),(37,'rotitofu.jpg',7,0),(38,'pavlova.jpg',8,0),(39,'crumble.jpg',9,0),(40,'pudding.jpg',10,0);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `products_id` int NOT NULL,
  `product_amount` int DEFAULT NULL,
  `order_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_details_order1_idx` (`order_id`),
  KEY `fk_order_details_products1_idx` (`products_id`),
  CONSTRAINT `fk_product_id` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_type`
--

DROP TABLE IF EXISTS `product_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_type`
--

LOCK TABLES `product_type` WRITE;
/*!40000 ALTER TABLE `product_type` DISABLE KEYS */;
INSERT INTO `product_type` VALUES (1,'starter'),(2,'main'),(3,'dessert'),(4,'drink');
/*!40000 ALTER TABLE `product_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `product_image_id` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `product_type_id` int NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_product_type1_idx` (`product_type_id`),
  CONSTRAINT `fk_products_product_type1` FOREIGN KEY (`product_type_id`) REFERENCES `product_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Tarte ?? la carotte et au cumin',15,'tartecarotte.jpg',1,1,'La p??te ?? tarte est faite avec de la farine de pois-chiche. Les carottes viennent de l\'Ilot de la Meinau pour du 100% local! On y ajoute du cumin et de la roquette fra??che!'),(2,'Soupe de potimarron',10,'veloute.jpeg',1,1,'La recette en toute simplicit??, avec un bon lait de coco et un bouquet de coriandre du jardin! Le potimarron vient de l\'Ilot de la Meinau et quelques graines de courges grill??es sont ajout??es! '),(3,'Croquettes de riz aux petits pois',15,'croquettes.jpg',1,1,'Une recette originale qui me vient de ma grand-m??re! On utilise de la mozarella v??g??tale (que l\'on trouve en magasin bio!). 5 pi??ces avec un hoummous maison!'),(4,'Maki de l??gumes',12,'maki.jpg',0,1,'L\'assiette de makis est compos??e de 6 pi??ces. A base de l??gumes de saison et de riz du japon, ils sont accompagn??s de lamelles de gingembre frais et de wasabi. Une entr??e toute en fraicheur et exotisme!'),(5,'Tajine de l??gumes oubli??s',22,'tajine.jpg',1,2,'Des carottes, du panais, ou du topinambour, tout d??pend de la saison mais ce sont des l??gumes anciens! Un peu de Ras El Hanout me venant de mon amie Marocaine et le tour est jou??!'),(6,'Chili v??g??tarien test',45,'chilli.jpg',1,2,'Le secret du Chilli est dans ses ??pices! Les haricots rouges apportent une belle texture et le piment rouge ajoute le peps!'),(7,'Roti de tofu au sirop d\'??rable',30,'rotitofu.jpg',1,2,'Qui dit r??ti ne dit pas forc??ment porc! Ce plat original se d??marque par la cuisson longue du tofu, caram??lis??e par le sirop d\'??rable. Un vrai d??lice!'),(8,'Pavlova mangue ?? la cr??me de coco',8,'pavlova.jpg',0,3,'Un grand classique! Les fruits varient en fonction de la saison et la meringue et la cr??me ne contiennent que du lait v??g??tal ainsi que de la cr??me de coco.'),(9,'Crumble fraise rhubarbe et amandes test',15,'crumble.jpg',1,3,'Le crumble est aussi sign?? Mamie Kutuk donc top sercret! Une r??ussite ?? coup s??r en ce temps printanier!'),(10,'Pudding de chia framboise et cardamome',7,'pudding.jpg',1,3,'Le dessert sain et gourmand par excellence. Il se mange ultra frais et ravie les papilles !');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_login`
--

DROP TABLE IF EXISTS `user_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_login`
--

LOCK TABLES `user_login` WRITE;
/*!40000 ALTER TABLE `user_login` DISABLE KEYS */;
INSERT INTO `user_login` VALUES (1,'yavuz','d4e520d9130bddccba586603dd622562');
/*!40000 ALTER TABLE `user_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_order`
--

DROP TABLE IF EXISTS `user_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customer_id_idx` (`customer_id`),
  CONSTRAINT `fk_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_order`
--

LOCK TABLES `user_order` WRITE;
/*!40000 ALTER TABLE `user_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_order` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-10 14:44:17
