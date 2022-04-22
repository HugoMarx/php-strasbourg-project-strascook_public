-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: strascook
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Suleyman','Kutuk','10 rue principale 67000 Strasbourg','kutuk.suleymann@gmail.com'),(2,'Sophie','Verdier','2 Avenue De Gaulle 67000 Strasbourg','sophie.verdier188@gmail.com'),(3,'Hugo','Marx','33 rue stéphanie 67000 Strasbourg','marx.hugo@gmail.com');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `order_date` date NOT NULL,
  `order_details_id` int DEFAULT NULL,
  `total_price` float NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customer_id_idx` (`customer_id`),
  KEY `fk_order_details_id_idx` (`order_details_id`),
  CONSTRAINT `fk_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `fk_order_details_id` FOREIGN KEY (`order_details_id`) REFERENCES `order_details` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
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
  `image` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `product_type_id` int NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_product_type1_idx` (`product_type_id`),
  CONSTRAINT `fk_products_product_type1` FOREIGN KEY (`product_type_id`) REFERENCES `product_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Tarte à la carotte et au cumin',15,'tartecarotte.jpg',1,1,'La pâte à tarte est faite avec de la farine de pois-chiche. Les carottes viennent de l\'Ilot de la Meinau pour du 100% local! On y ajoute du cumin et de la roquette fraîche!'),(2,'Soupe de potimarron',10,'veloute.jpeg',1,1,'La recette en toute simplicité, avec un bon lait de coco et un bouquet de coriandre du jardin! Le potimarron vient de l\'Ilot de la Meinau et quelques graines de courges grillées sont ajoutées! '),(3,'Croquettes de riz aux petits pois',15,'croquettes.jpg',1,1,'Une recette originale qui me vient de ma grand-mère! On utilise de la mozarella végétale (que l\'on trouve en magasin bio!). 5 pièces avec un hoummous maison!'),(4,'Maki de légumes',12,'maki.jpg',0,1,'L\'assiette de makis est composée de 6 pièces. A base de légumes de saison et de riz du japon, ils sont accompagnés de lamelles de gingembre frais et de wasabi. Une entrée toute en fraicheur et exotisme!'),(5,'Tajine de légumes oubliés',22,'tajine.jpg',1,2,'Des carottes, du panais, ou du topinambour, tout dépend de la saison mais ce sont des légumes anciens! Un peu de Ras El Hanout me venant de mon amie Marocaine et le tour est joué!'),(6,'Chili végétarien',25,'chilli.jpg',1,2,'Le secret du Chilli est dans ses épices! Les haricots rouges apportent une belle texture et le piment rouge ajoute le peps!'),(7,'Roti de tofu au sirop d\'érable',30,'rotitofu.jpg',1,2,'Qui dit rôti ne dit pas forcément porc! Ce plat original se démarque par la cuisson longue du tofu, caramélisée par le sirop d\'érable. Un vrai délice!'),(8,'Pavlova mangue à la crême de coco',8,'pavlova.jpg',0,3,'Un grand classique! Les fruits varient en fonction de la saison et la meringue et la crème ne contiennent que du lait végétal ainsi que de la crème de coco. '),(9,'Crumble fraise rhubarbe et amandes',7,'crumble.jpg',1,3,'Le crumble est aussi signé Mamie Kutuk donc top sercret! Une réussite à coup sûr en ce temps printanier!'),(10,'Pudding de chia framboise et cardamome',7,'pudding.jpg',1,3,'Le dessert sain et gourmand par excellence. Il se mange ultra frais et ravie les papilles !');
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
  `sign_up` datetime DEFAULT NULL,
  `customers_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_login_customers_idx` (`customers_id`),
  CONSTRAINT `fk_user_login_customers` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_login`
--

LOCK TABLES `user_login` WRITE;
/*!40000 ALTER TABLE `user_login` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_login` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-22 10:23:22
