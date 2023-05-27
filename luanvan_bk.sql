-- MySQL dump 10.13  Distrib 5.7.41, for Linux (x86_64)
--
-- Host: localhost    Database: luanvan
-- ------------------------------------------------------
-- Server version	5.7.41-0ubuntu0.18.04.1

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
-- Table structure for table `admin_password_resets`
--

DROP TABLE IF EXISTS `admin_password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_password_resets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_password_resets_email_index` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_password_resets`
--

LOCK TABLES `admin_password_resets` WRITE;
/*!40000 ALTER TABLE `admin_password_resets` DISABLE KEYS */;
INSERT INTO `admin_password_resets` VALUES (1,'trankimh029@gmail.com','xnmxcddf1Q1wFNAF07oQufvwrNywWlo8KbFwKwpo2rUp0nkPXsQXrjFTlO35sR23','2023-05-10 07:46:51',NULL),(2,'trankimh029@gmail.com','e0tQMGvdFi3gQozcT1wai0nIB1McxLgz5X1LAP2pzilIF2VsbKPn1FpBmnThXja2','2023-05-10 07:47:59',NULL);
/*!40000 ALTER TABLE `admin_password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin 1','trankimh029@gmail.com','$2y$10$c5U8HNFdYc6G3taLi0qJiu4tMMW.H7RgD85wzr8soloUTER5RMyna','sAkuEbL5vwG3dCyT5NBmOABofiltoT5XXUxFZs9OKhaKqZCqFmYVw6UkfcuY',NULL,'2023-05-10 07:48:30',NULL),(2,'admin 2','admin2@gmail.com','$2y$10$kHfM0wWMSSVRQAkgdjoZ/eacR1GviA1AVrF59Jlbo6Wz/8jWx.8Fe','CbjXzJrFgLLQ2WPpl2bocZh3rwRezX9BwQgiuageuaxMJe2za54jsHTIRUik',NULL,NULL,NULL),(3,'admin 3','admin3@gmail.com','$2y$10$Me/TErh24uNLf.Tl0GmvsebqmEiVF0Nax9e1zHrm4D6K1thjgDmLe',NULL,NULL,NULL,NULL),(4,'admin 4','admin4@gmail.com','$2y$10$3zAhLxMo4d8mLRzCiPDB3.n4KDv99z02Bs5hvedwxZhcsk.OWIZGq',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attributes`
--

DROP TABLE IF EXISTS `attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ten thuoc tinh',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_private` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attributes`
--

LOCK TABLES `attributes` WRITE;
/*!40000 ALTER TABLE `attributes` DISABLE KEYS */;
INSERT INTO `attributes` VALUES (1,'Dung lượng','2023-05-09 06:39:27','2023-05-16 08:49:36',1),(2,'Màu','2023-05-09 06:40:04','2023-05-16 08:49:30',1),(3,'Màn hình','2023-05-15 06:10:16','2023-05-16 08:49:52',0),(4,'Bảo hành','2023-05-15 06:10:21','2023-05-16 08:50:01',0),(5,'ram','2023-05-15 06:10:27','2023-05-16 08:49:41',1);
/*!40000 ALTER TABLE `attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'banner_images/1/avatar.avif','2023-05-23 05:50:47','2023-05-23 05:50:47',1),(2,'banner_images/2/avatar.avif','2023-05-23 05:50:52','2023-05-23 05:51:03',1),(3,'banner_images/3/avatar.avif','2023-05-23 05:51:10','2023-05-23 05:51:10',1),(4,'banner_images/4/avatar.avif','2023-05-23 05:59:59','2023-05-23 06:05:05',0),(5,'banner_images/5/avatar.avif','2023-05-23 06:05:42','2023-05-23 06:05:42',0);
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `product_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`user_id`),
  KEY `carts_user_id_foreign` (`user_id`),
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (10,1,2);
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'dien thoai','2023-05-08 09:27:48','2023-05-08 09:27:48'),(2,'laptop','2023-05-08 09:28:00','2023-05-08 09:28:00');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_12_14_000001_create_personal_access_tokens_table',1),(2,'2023_02_11_141113_create_admins_table',1),(3,'2023_04_15_064849_create_products_table',1),(4,'2023_04_15_064916_create_attributes_table',1),(5,'2023_04_15_064937_create_values_table',1),(6,'2023_04_16_075245_add_image_to_products_table',1),(7,'2023_05_04_044437_create_password_resets_table',1),(8,'2023_05_04_134006_create_admin_password_resets_table',1),(9,'2023_05_05_072726_add_image_to_admins_table',1),(10,'2023_05_06_112325_add_status_and_price_new_to_products_table',1),(11,'2023_05_06_115549_add_description_to_products_table',1),(12,'2023_05_08_024654_create_categories_table',1),(13,'2023_05_08_030044_add_category_id_to_products_table',1),(14,'2023_05_08_145112_create_users_table',1),(15,'2023_05_08_145412_create_carts_table',1),(16,'2023_05_08_145849_create_orders_table',1),(17,'2023_05_08_150321_create_order_products_table',1),(18,'2023_05_15_132307_drop_price_new_in_products_table',2),(19,'2023_05_15_140058_add_column_attr_ids_to_products_table',3),(20,'2023_05_16_124747_add_is_private_to_attributes_table',4),(21,'2023_05_22_065109_create_banners_table',5),(22,'2023_05_22_072119_add_status_to_banners_table',5),(23,'2023_05_23_135537_add_name_to_orders_table',6),(24,'2023_05_23_143206_add_email_to_orders_table',7),(25,'2023_05_24_093541_create_social_accounts_table',8),(26,'2023_05_25_022324_create_product_images_table',9),(27,'2023_05_26_031401_create_product_attr_config_table',10),(28,'2023_05_26_061449_add_type_to_products_table',10),(29,'2023_05_26_141224_modify_price_and_quantity_in_products_table',11),(30,'2023_05_26_152014_add_is_paid_to_orders_table',11),(31,'2023_05_27_140859_add_ship_code_to_orders_table',12);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_products` (
  `product_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`product_id`,`order_id`),
  KEY `order_products_order_id_foreign` (`order_id`),
  CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_products`
--

LOCK TABLES `order_products` WRITE;
/*!40000 ALTER TABLE `order_products` DISABLE KEYS */;
INSERT INTO `order_products` VALUES (10,23,1,1000000),(10,1685800920,1,1000000),(11,17,10,234),(11,18,10,234),(11,19,1,234),(11,20,1,234),(11,21,1,234),(11,22,1,234),(11,1687022539,1,234),(11,1689465512,1,234),(11,1690591331,1,234),(11,1691295204,1,234),(12,1694888501,2,2000),(28,1690117859,1,1);
/*!40000 ALTER TABLE `order_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'COD',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'UNPAID' COMMENT 'unpaid, paid, refund',
  `payment_response` text COLLATE utf8mb4_unicode_ci,
  `success_at` date DEFAULT NULL,
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `ship_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1694888502 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (17,'asdasd',5,'11','0169 980 0145','MOMO','PAID',NULL,NULL,'Trần Kim Hoàng','trankimhoang11052000@gmail.com','UNPAID',NULL,NULL,'',NULL),(18,'jashjdhjashjdashjd',5,'11','0169 980 0145','MOMO','PAID',NULL,NULL,'Trần Kim Hoàng','trankimhoang11052000@gmail.com','UNPAID',NULL,NULL,'',NULL),(19,NULL,5,'11','0169 980 0145','MOMO','PAID',NULL,NULL,'Trần Kim Hoàng','trankimhoang11052000@gmail.com','UNPAID',NULL,NULL,'',NULL),(20,NULL,5,'11','0169 980 0145','MOMO','PENDING',NULL,NULL,'Trần Kim Hoàng','trankimhoang11052000@gmail.com','UNPAID',NULL,NULL,'',NULL),(21,NULL,5,'11','0169 980 0145','MOMO','PENDING',NULL,NULL,'Trần Kim Hoàng','trankimhoang11052000@gmail.com','UNPAID',NULL,NULL,'',NULL),(22,NULL,5,'11','0169 980 0145','MOMO','PENDING',NULL,NULL,'Trần Kim Hoàng','trankimhoang11052000@gmail.com','UNPAID',NULL,NULL,'',NULL),(23,'asdasd',5,'11','0169 980 0145','MOMO','PAID',NULL,NULL,'Trần Kim Hoàng','trankimhoang11052000@gmail.com','UNPAID',NULL,NULL,'',NULL),(1685800920,NULL,1,'130 Nguyễn Trung Trực, thị trấn Tân Trụ, huyện Tân Trụ','0584246834','COD','CONFIRMED','2023-05-27 06:22:33','2023-05-27 06:23:45','Trần Kim Hoàng','hoang@gmail.com','UNPAID',NULL,NULL,NULL,NULL),(1687022539,NULL,1,'130 Nguyễn Trung Trực, thị trấn Tân Trụ, huyện Tân Trụ','0584246834','COD','PENDING','2023-05-27 06:21:22',NULL,'Trần Kim Hoàng','hoang@gmail.com','UNPAID',NULL,NULL,NULL,NULL),(1689465512,NULL,1,'130 Nguyễn Trung Trực, thị trấn Tân Trụ, huyện Tân Trụ','0584246834','COD','REFUND','2023-05-27 06:55:46','2023-05-27 07:14:00','Trần Kim Hoàng','hoang@gmail.com','REFUND',NULL,'2023-05-27',NULL,'test'),(1690117859,'d',1,'130 Nguyễn Trung Trực, thị trấn Tân Trụ, huyện Tân Trụ','0584246834','MOMO','PENDING','2023-05-27 06:07:32',NULL,'Trần Kim Hoàng','hoang@gmail.com','PAID','{\"partnerCode\":\"MOMOBKUN20180529\",\"orderId\":\"1690117859\",\"requestId\":\"1685192852\",\"amount\":\"1\",\"orderInfo\":\"Thanh to\\u00e1n qua MoMo cho shop Laravel \\u0111\\u01a1n h\\u00e0ng [1690117859]\",\"orderType\":\"momo_wallet\",\"transId\":\"3015882378\",\"resultCode\":\"0\",\"message\":\"Th\\u00e0nh c\\u00f4ng.\",\"payType\":\"qr\",\"responseTime\":\"1685192891697\",\"extraData\":null,\"signature\":\"4aa5377da8be0c2121ed006f6ad540f39494c010be911fac976048beeb5c149c\"}',NULL,NULL,NULL),(1690591331,NULL,1,'130 Nguyễn Trung Trực, thị trấn Tân Trụ, huyện Tân Trụ','0584246834','COD','PENDING','2023-05-27 06:20:31',NULL,'Trần Kim Hoàng','hoang@gmail.com','UNPAID',NULL,NULL,NULL,NULL),(1691295204,NULL,1,'130 Nguyễn Trung Trực, thị trấn Tân Trụ, huyện Tân Trụ','0584246834','MOMO','PENDING','2023-05-27 06:08:45',NULL,'Trần Kim Hoàng','hoang@gmail.com','PAID','{\"partnerCode\":\"MOMOBKUN20180529\",\"orderId\":\"1691295204_repay1685812570\",\"requestId\":\"1685193504\",\"amount\":\"234\",\"orderInfo\":\"Thanh to\\u00e1n qua MoMo cho shop Laravel \\u0111\\u01a1n h\\u00e0ng [1691295204]\",\"orderType\":\"momo_wallet\",\"transId\":\"3015890048\",\"resultCode\":\"0\",\"message\":\"Th\\u00e0nh c\\u00f4ng.\",\"payType\":\"qr\",\"responseTime\":\"1685193539083\",\"extraData\":null,\"signature\":\"b108e2126039aadde0cbd6e81e8e0a4c7eb22a5323547a40f63e478ec8e6c8d9\"}',NULL,NULL,NULL),(1691434364,NULL,1,'130 Nguyễn Trung Trực, thị trấn Tân Trụ, huyện Tân Trụ','0584246834','COD','PENDING','2023-05-27 06:38:12',NULL,'Trần Kim Hoàng','hoang@gmail.com','UNPAID',NULL,NULL,NULL,NULL),(1694888501,NULL,1,'130 Nguyễn Trung Trực, thị trấn Tân Trụ, huyện Tân Trụ','0584246834','COD','CANCEL','2023-05-27 06:39:04','2023-05-27 06:49:13','Trần Kim Hoàng','hoang@gmail.com','UNPAID',NULL,NULL,'asdasdasd234234234',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_attr_config`
--

DROP TABLE IF EXISTS `product_attr_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_attr_config` (
  `product_id` bigint(20) unsigned NOT NULL COMMENT 'id product trong table product',
  `attribute_id` bigint(20) unsigned NOT NULL COMMENT 'id attribute trong table attribute',
  `is_private` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_attr_config`
--

LOCK TABLES `product_attr_config` WRITE;
/*!40000 ALTER TABLE `product_attr_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_attr_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (2,'product_images/29/2515745866396.webp',29,'2023-05-25 08:09:32',NULL),(3,'product_images/29/12602319715188.webp',29,'2023-05-25 08:09:32',NULL),(4,'product_images/29/13805429938815.jpg',29,'2023-05-25 08:10:55',NULL),(5,'product_images/29/3523392408405.webp',29,'2023-05-25 08:10:55',NULL),(6,'product_images/29/6505891003755.jpg',29,'2023-05-25 08:10:55',NULL);
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ten san pham',
  `price` double DEFAULT '0' COMMENT 'gia goc cua san pham',
  `quantity` int(11) DEFAULT '0' COMMENT 'so luong',
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `description` text COLLATE utf8mb4_unicode_ci,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `attr_ids` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'simple',
  PRIMARY KEY (`id`),
  KEY `products_parent_id_foreign` (`parent_id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (8,'Iphone 14',200,2,NULL,'2023-05-11 05:34:50','2023-05-17 06:39:08','product_images/8/avatar.png',1,'iphone 14',1,'2,3,4','simple'),(10,'Xiaomi Redmi Note 12',1000000,3,NULL,'2023-05-13 23:44:11','2023-05-13 23:46:31','product_images/10/avatar.webp',1,'Mới, đầy đủ phụ kiện từ nhà sản xuất\r\nRedmi Note 12\r\nBộ chuyển đổi\r\nCáp USB Type-C\r\nCông cụ đẩy SIM\r\nHướng dẫn bắt đầu nhanh\r\nThẻ bảo hành\r\nVỏ bảo vệ\r\nBảo hành 18 tháng tại trung tâm bảo hành Chính hãng. 1 đổi 1 trong 30 ngày nếu có lỗi phần cứng từ nhà sản xuất.',1,NULL,'simple'),(11,'hoang',234,1,NULL,'2023-05-15 07:09:03','2023-05-27 06:59:01','product_images/11/avatar.webp',1,'asdasdas',NULL,'1,2','simple'),(12,'Kim Hoang123',2000,12,NULL,'2023-05-15 07:10:23','2023-05-27 06:49:01','product_images/12/avatar.webp',1,'asdasdasd',NULL,'1,3','simple'),(13,'sadasdasd',324,1,NULL,'2023-05-15 07:12:50','2023-05-15 07:12:50','product_images/13/avatar.png',1,'asdasdas',NULL,'1,2','simple'),(14,'hoangasdasd',1123,12,NULL,'2023-05-15 07:13:42','2023-05-15 07:13:42',NULL,1,'asdasd',NULL,'1,5','simple'),(15,'hoang9999999999999999934234',2000,1,NULL,'2023-05-15 07:14:26','2023-05-15 07:14:26','product_images/15/avatar.webp',1,'asdasdasd',NULL,'1','simple'),(16,'laptopasdasdas',343,22,NULL,'2023-05-15 07:15:28','2023-05-15 07:15:28','product_images/16/avatar.webp',1,'asdasdas',1,'1,2','simple'),(17,'laptop',43000000,1,NULL,'2023-05-15 07:26:44','2023-05-15 07:28:05','product_images/17/avatar.webp',1,NULL,2,'1,2,5','simple'),(25,'Test',200,12,NULL,'2023-05-17 06:39:56','2023-05-17 06:39:56','product_images/25/avatar.webp',1,NULL,1,'1,2,4','simple'),(26,'hoang',1,1,NULL,'2023-05-17 06:41:59','2023-05-17 06:41:59','product_images/26/avatar.webp',1,NULL,1,'1,4','simple'),(27,NULL,1,1,26,NULL,NULL,NULL,1,NULL,NULL,NULL,'simple'),(28,NULL,1,1,8,NULL,NULL,NULL,1,NULL,NULL,NULL,'simple'),(29,'iphone 6',43000000,1,NULL,'2023-05-25 08:09:32','2023-05-25 08:09:32','product_images/29/avatar.jpg',1,NULL,1,'3','simple');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_accounts`
--

DROP TABLE IF EXISTS `social_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_accounts` (
  `user_id` bigint(20) unsigned NOT NULL,
  `provider_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `social_accounts_user_id_foreign` (`user_id`),
  CONSTRAINT `social_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_accounts`
--

LOCK TABLES `social_accounts` WRITE;
/*!40000 ALTER TABLE `social_accounts` DISABLE KEYS */;
INSERT INTO `social_accounts` VALUES (4,'113608058498797839936','google','2023-05-24 05:27:47','2023-05-24 05:27:47'),(5,'106287706893815684902','google','2023-05-24 05:27:56','2023-05-24 05:27:56'),(6,'103097431573144538672','google','2023-05-24 05:28:29','2023-05-24 05:28:29');
/*!40000 ALTER TABLE `social_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'hoang','hoang@gmail.com','$2a$12$QMZGc2HEvOhnWIbxtNaLfusaLBhPVwhoT9MJ19Mx4VD.RP6Vs5Wym',NULL,NULL,1,'vFp6erY1lwQFqtZnaULE6B8N3fnWTmB19IdJ0iw4m9roIarerX22HlxlqYil',NULL,NULL),(4,'Kim Hoang','trankimh029@gmail.com','$2y$10$SxGJ//S7vwcAVF7qoQHJWuz1kZdsBalrslIx35hVYR2O2mooFl8/S',NULL,NULL,1,'snekX4MdTUb2nBt2bzExUNRB2YhsJ1hXrEON5xfjkc8C8Zca1sgWRhAcsJ9f','2023-05-13 23:47:57','2023-05-13 23:47:57'),(5,'Hoàng Trần Kim','trankimhoang11052000@gmail.com','',NULL,NULL,1,'jSmJ4bCPAsjlp52VcRSmGpX5mveMD3FqBbP54GPHaIiYSXbvqLMa6VRH473z','2023-05-24 05:27:56','2023-05-24 05:27:56'),(6,'Hoang Tran Kim','dh51800369@student.stu.edu.vn','',NULL,NULL,1,'V1Fi64A6Ad1sxsVUzE3syOaGPVIROMfc3yWUUt0z1QN6HOvG0idD3QACCaoZ','2023-05-24 05:28:29','2023-05-24 05:28:29');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `values`
--

DROP TABLE IF EXISTS `values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `values` (
  `product_id` bigint(20) unsigned NOT NULL COMMENT 'id product trong table product',
  `attribute_id` bigint(20) unsigned NOT NULL COMMENT 'id attribute trong table attribute',
  `text_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`product_id`,`attribute_id`),
  KEY `values_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `values_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `values`
--

LOCK TABLES `values` WRITE;
/*!40000 ALTER TABLE `values` DISABLE KEYS */;
INSERT INTO `values` VALUES (8,3,'6.4'),(8,4,'12 thang'),(25,4,'12 thang'),(26,4,'12 thang'),(27,1,'12'),(28,2,'12'),(29,3,'6.4');
/*!40000 ALTER TABLE `values` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-27 21:47:19
