-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bikroybd24_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `ipAddress` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `count` varchar(255) DEFAULT NULL,
  `items_count` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `showInTopCategories` tinyint(1) NOT NULL DEFAULT 1,
  `showInSidebar` tinyint(1) NOT NULL DEFAULT 1,
  `type` varchar(255) NOT NULL DEFAULT 'main',
  `level` varchar(255) NOT NULL DEFAULT 'main',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES ('beauty-care','Beauty & Personal Care','beauty-care','1,150+ Items','1,150+','https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=400&auto=format&fit=crop&q=80',NULL,NULL,NULL,'bg-rose-50 text-rose-700 border-rose-200','Skincare, cosmetics, perfumes, and personal care',1,1,1,'main','main','2026-09-04 09:28:38','2026-09-04 09:28:38'),('groceries','Groceries & Daily Needs','groceries','4,500+ Items','4,500+','https://images.unsplash.com/photo-1542838132-92c53300491e?w=400&auto=format&fit=crop&q=80',NULL,NULL,NULL,'bg-teal-50 text-teal-700 border-teal-200','Fresh food, essential groceries, and daily supplies',1,1,1,'main','main','2026-09-04 09:28:38','2026-09-04 09:28:38'),('home-kitchen','Home & Appliances','home-kitchen','1,420+ Items','1,420+','https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=400&auto=format&fit=crop&q=80',NULL,NULL,NULL,'bg-emerald-50 text-emerald-700 border-emerald-200','Kitchen appliances, cookware, and home decor',1,1,1,'main','main','2026-09-04 09:28:38','2026-09-04 09:28:38'),('laptops-computers','Laptops & Computers','laptops-computers','1,890+ Items','1,890+','https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=400&auto=format&fit=crop&q=80',NULL,NULL,NULL,'bg-indigo-50 text-indigo-700 border-indigo-200','MacBooks, gaming laptops, monitors, and peripherals',1,1,1,'main','main','2026-09-04 09:28:38','2026-09-04 09:28:38'),('mens-fashion','Men\'s Fashion','mens-fashion','2,540+ Items','2,540+','https://images.unsplash.com/photo-1617137984095-74e4e5e3613f?w=400&auto=format&fit=crop&q=80',NULL,NULL,NULL,'bg-purple-50 text-purple-700 border-purple-200','Trendy T-shirts, formal wear, Panjabi, and footwear',1,1,1,'main','main','2026-09-04 09:28:38','2026-09-04 09:28:38'),('smartphones-gadgets','Smartphones & Audio','smartphones-gadgets','3,240+ Items','3,240+','https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=400&auto=format&fit=crop&q=80',NULL,NULL,NULL,'bg-blue-50 text-blue-700 border-blue-200','Flagship smartphones, iPhones, and wireless audio gear',1,1,1,'main','main','2026-09-04 09:28:38','2026-09-04 09:28:38'),('smartwatches-audio','Smartwatches & Audio','smartwatches-audio','1,280+ Items','1,280+','https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=400&auto=format&fit=crop&q=80',NULL,NULL,NULL,'bg-cyan-50 text-cyan-700 border-cyan-200','Smartwatches, fitness bands, and bluetooth audio',1,1,1,'main','main','2026-09-04 09:28:38','2026-09-04 09:28:38'),('sports','Sports & Fitness','sports','640+ Items','640+','https://images.unsplash.com/photo-1517838277536-f5f99be501cd?w=400&auto=format&fit=crop&q=80',NULL,NULL,NULL,'bg-amber-50 text-amber-700 border-amber-200','Fitness equipment, sportswear, and active accessories',1,1,1,'main','main','2026-09-04 09:28:38','2026-09-04 09:28:38'),('womens-fashion','Women\'s Fashion','womens-fashion','2,890+ Items','2,890+','https://images.unsplash.com/photo-1525507119028-ed4c629a60a3?w=400&auto=format&fit=crop&q=80',NULL,NULL,NULL,'bg-pink-50 text-pink-700 border-pink-200','Sarees, three-piece, designer handbags, and jewelry',1,1,1,'main','main','2026-09-04 09:28:38','2026-09-04 09:28:38');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_contents`
--

DROP TABLE IF EXISTS `cms_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cms_contents_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_contents`
--

LOCK TABLES `cms_contents` WRITE;
/*!40000 ALTER TABLE `cms_contents` DISABLE KEYS */;
INSERT INTO `cms_contents` VALUES (1,'hero_slides','[{\"id\":\"slide-1\",\"title\":\"Sony WH-1000XM5 Wireless Headphones\",\"subtitle\":\"Industry-leading noise isolation with dual processors and 30-hour battery stamina.\",\"badge\":\"EXCLUSIVE LAUNCH 25% OFF\",\"badgeText\":\"EXCLUSIVE LAUNCH 25% OFF\",\"price\":\"29,999\",\"oldPrice\":\"38,999\",\"image\":\"https:\\/\\/images.unsplash.com\\/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=1600&q=80\",\"active\":true},{\"id\":\"slide-2\",\"title\":\"Samsung Galaxy S24 Ultra 5G (256GB)\",\"subtitle\":\"Unleash Galaxy AI with 200MP Quad Telephoto and built-in S-Pen precision.\",\"badge\":\"SPECIAL PROMO DEAL\",\"badgeText\":\"SPECIAL PROMO DEAL\",\"price\":\"134,999\",\"oldPrice\":\"149,999\",\"image\":\"https:\\/\\/images.unsplash.com\\/photo-1610945265064-0e34e5519bbf?auto=format&fit=crop&w=1600&q=80\",\"active\":true}]','2026-09-04 09:28:38','2026-09-04 09:28:38'),(2,'mobile_nav_items','[{\"id\":\"home\",\"label\":\"Home\",\"icon\":\"Home\",\"path\":\"\\/\",\"isSpecialBadge\":false,\"active\":true},{\"id\":\"categories\",\"label\":\"Categories\",\"icon\":\"Grid\",\"path\":\"\\/categories\",\"isSpecialBadge\":false,\"active\":true},{\"id\":\"flash\",\"label\":\"Flash Deals\",\"icon\":\"Flame\",\"path\":\"#flash-sale\",\"isSpecialBadge\":true,\"active\":true},{\"id\":\"wishlist\",\"label\":\"Wishlist\",\"icon\":\"Heart\",\"path\":\"\\/wishlist\",\"isSpecialBadge\":false,\"active\":true},{\"id\":\"cart\",\"label\":\"Cart\",\"icon\":\"ShoppingBag\",\"path\":\"\\/cart\",\"isSpecialBadge\":false,\"active\":true}]','2026-09-04 09:28:38','2026-09-04 09:28:38'),(3,'footer_info','{\"aboutText\":\"BikroyBD24 is your trusted online marketplace in Bangladesh offering authentic products, fast express delivery, and cash on delivery guaranteed.\",\"hotline\":\"01854-288311\",\"supportEmail\":\"support@bikroybd24.com\",\"copyrightText\":\"\\u00a9 2026 BikroyBD24. All Rights Reserved.\",\"paymentBadges\":{\"cod\":true,\"bkash\":true,\"nagad\":true,\"rocket\":true,\"visa\":true,\"mastercard\":true}}','2026-09-04 09:28:38','2026-09-04 09:28:38');
/*!40000 ALTER TABLE `cms_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `discountType` varchar(255) NOT NULL DEFAULT 'flat',
  `discountValue` decimal(12,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `minSpend` decimal(12,2) NOT NULL DEFAULT 0.00,
  `usageLimit` int(11) NOT NULL DEFAULT 100,
  `usageCount` int(11) NOT NULL DEFAULT 0,
  `badge` varchar(255) NOT NULL DEFAULT 'EXCLUSIVE FLASH PROMO',
  `headline` varchar(255) DEFAULT NULL,
  `subtext` text DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ACTIVE',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `expiresAt` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES ('c_bikroy500','BIKROY500','flat',500.00,500.00,3000.00,100,8,'STORE COUPON','Save ৳500 Instant Discount!','Enjoy ৳500 extra discount on your order when you spend ৳3,000+ with code BIKROY500.','Enjoy ৳500 extra discount on your order when you spend ৳3,000+ with code BIKROY500.','ACTIVE',1,NULL,'2026-09-04 09:28:38','2026-09-04 09:28:38'),('c_nexabd500','NEXABD500','flat',500.00,500.00,4999.00,100,12,'EXCLUSIVE FLASH PROMO','Save ৳500 Instant Discount!','Enjoy ৳500 extra discount on your order when you spend ৳4,999+ with code NEXABD500.','Enjoy ৳500 extra discount on your order when you spend ৳4,999+ with code NEXABD500.','ACTIVE',1,NULL,'2026-09-04 09:28:38','2026-09-04 09:28:38');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_08_29_000001_create_categories_table',1),(5,'2026_08_29_000002_create_products_table',1),(6,'2026_08_29_000003_create_cms_contents_table',1),(7,'2026_08_29_000004_create_coupons_table',1),(8,'2026_08_29_000005_create_orders_table',1),(9,'2026_08_29_000006_create_order_items_table',1),(10,'2026_08_29_000007_create_audit_logs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` varchar(255) NOT NULL,
  `productId` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `supplierCost` decimal(12,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_orderid_foreign` (`orderId`),
  CONSTRAINT `order_items_orderid_foreign` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` varchar(255) NOT NULL,
  `orderNumber` varchar(255) DEFAULT NULL,
  `customerName` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `district` varchar(255) NOT NULL DEFAULT 'Dhaka',
  `paymentMethod` varchar(255) NOT NULL,
  `paymentStatus` varchar(255) NOT NULL DEFAULT 'Unpaid',
  `deliveryCharge` decimal(12,2) NOT NULL DEFAULT 70.00,
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `totalAmount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `supplierTotalCost` decimal(12,2) NOT NULL DEFAULT 0.00,
  `resellerProfit` decimal(12,2) NOT NULL DEFAULT 0.00,
  `orderStatus` varchar(255) NOT NULL DEFAULT 'Pending Confirmation',
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `courierName` varchar(255) DEFAULT NULL,
  `trackingNumber` varchar(255) DEFAULT NULL,
  `uddoktapayInvoiceId` varchar(255) DEFAULT NULL,
  `trxID` varchar(255) DEFAULT NULL,
  `fraudFlag` varchar(255) NOT NULL DEFAULT 'Normal',
  `notes` text DEFAULT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`items`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_ordernumber_unique` (`orderNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` varchar(255) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `supplierCost` decimal(12,2) NOT NULL DEFAULT 0.00,
  `oldPrice` decimal(12,2) DEFAULT NULL,
  `original_price` decimal(12,2) DEFAULT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `rating` decimal(3,2) NOT NULL DEFAULT 5.00,
  `reviews` int(11) NOT NULL DEFAULT 0,
  `image` text DEFAULT NULL,
  `inStock` int(11) NOT NULL DEFAULT 10,
  `stock` int(11) NOT NULL DEFAULT 10,
  `totalStock` int(11) NOT NULL DEFAULT 50,
  `minStockThreshold` int(11) NOT NULL DEFAULT 5,
  `category_id` varchar(255) DEFAULT NULL,
  `is_trending` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_flash_sale` tinyint(1) NOT NULL DEFAULT 0,
  `isTrending` tinyint(1) NOT NULL DEFAULT 0,
  `isFeatured` tinyint(1) NOT NULL DEFAULT 0,
  `isFlashSale` tinyint(1) NOT NULL DEFAULT 0,
  `section` varchar(255) NOT NULL DEFAULT 'catalog',
  `description` text DEFAULT NULL,
  `badges` text DEFAULT NULL,
  `badge` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_sku_unique` (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES ('f1','SKU-SMAR-001','880910000001','Anker Soundcore Motion+ Bluetooth Speaker','Anker Soundcore Motion+ Bluetooth Speaker','smartwatches-audio','Smartwatches & Audio',8490.00,5519.00,11500.00,11500.00,26,4.90,184,'https://images.unsplash.com/photo-1545454675-3531b543be5d?auto=format&fit=crop&w=600&q=80',8,8,30,5,'smartwatches-audio',1,1,1,1,1,1,'flash_sale','Hi-Res 30W audio with Qualcomm aptX HD and IPX7 waterproof casing.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38'),('f10','SKU-LAPT-010','880910000010','RGB Gaming Mechanical Mouse 7200DPI','RGB Gaming Mechanical Mouse 7200DPI','laptops-computers','Laptops & Computers',1690.00,1099.00,2400.00,2400.00,29,4.80,192,'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?auto=format&fit=crop&w=600&q=80',16,16,45,5,'laptops-computers',1,0,1,1,0,1,'flash_sale','Customizable RGB lighting zones with high-precision optical sensor.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38'),('f11','SKU-HOME-011','880910000011','Non-Stick Aluminium Frying Pan 28cm','Non-Stick Aluminium Frying Pan 28cm','home-kitchen','Home & Appliances',2350.00,1528.00,3400.00,3400.00,30,4.70,78,'https://images.unsplash.com/photo-1584992236310-6edddc08acff?auto=format&fit=crop&w=600&q=80',12,12,40,5,'home-kitchen',0,0,1,0,0,1,'flash_sale','Heavy-gauge forged aluminium pan with ergonomic stay-cool handle.',NULL,'FLASH SALE','2026-09-04 09:28:38','2026-09-04 09:28:38'),('f12','SKU-SPOR-012','880910000012','Lightweight Breathable Running Shoes','Lightweight Breathable Running Shoes','sports','Sports & Fitness',2850.00,1853.00,4200.00,4200.00,32,4.90,210,'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=600&q=80',6,6,25,5,'sports',0,0,1,0,0,1,'flash_sale','Responsive foam cushioning with breathable knit mesh upper.',NULL,'FLASH SALE','2026-09-04 09:28:38','2026-09-04 09:28:38'),('f2','SKU-SMAR-002','880910000002','Smart OLED Fitness Watch Series 9','Smart OLED Fitness Watch Series 9','smartwatches-audio','Smartwatches & Audio',4250.00,2763.00,6200.00,6200.00,31,4.80,215,'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=600&q=80',12,12,45,5,'smartwatches-audio',0,0,1,0,0,1,'flash_sale','Real-time SpO2 monitoring, ECG tracking, and 10-day battery stamina.',NULL,'FLASH SALE','2026-09-04 09:28:38','2026-09-04 09:28:38'),('f3','SKU-FASH-003','880910000003','Men Ultra-Soft Cotton Polo T-Shirt','Men Ultra-Soft Cotton Polo T-Shirt','mens-fashion','Men\'s Fashion',1250.00,813.00,1850.00,1850.00,32,4.70,96,'https://images.unsplash.com/photo-1581655353564-df123a1eb820?auto=format&fit=crop&w=600&q=80',15,15,50,5,'mens-fashion',0,0,1,0,0,1,'flash_sale','Breathable Pima cotton blend with reinforced collar and tailored fit.',NULL,'FLASH SALE','2026-09-04 09:28:38','2026-09-04 09:28:38'),('f4','SKU-BEAU-004','880910000004','L\'Oréal Hydra Genius Daily Moisturizer','L\'Oréal Hydra Genius Daily Moisturizer','beauty-care','Beauty & Personal Care',1650.00,1073.00,2250.00,2250.00,27,4.80,142,'https://images.unsplash.com/photo-1556228720-195a672e8a03?auto=format&fit=crop&w=600&q=80',9,9,40,5,'beauty-care',1,0,1,1,0,1,'flash_sale','Aloe water infusion providing 72 hours of continuous skin hydration.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38'),('f5','SKU-SMAR-005','880910000005','Wireless Active Noise-Canceling Headphones','Wireless Active Noise-Canceling Headphones','smartwatches-audio','Smartwatches & Audio',3850.00,2503.00,5500.00,5500.00,30,4.80,178,'https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=600&q=80',5,5,25,5,'smartwatches-audio',0,1,1,0,1,1,'flash_sale','Deep bass drivers with dual beamforming mic for crystal clear calls.',NULL,'FLASH SALE','2026-09-04 09:28:38','2026-09-04 09:28:38'),('f6','SKU-HOME-006','880910000006','Stainless Steel Electric Kettle 1.8L','Stainless Steel Electric Kettle 1.8L','home-kitchen','Home & Appliances',2150.00,1398.00,3100.00,3100.00,30,4.70,110,'https://images.unsplash.com/photo-1594212699903-ec8a3eca50f6?auto=format&fit=crop&w=600&q=80',11,11,40,5,'home-kitchen',0,0,1,0,0,1,'flash_sale','Rapid 1500W boil tech with auto shut-off and boil-dry safety protection.',NULL,'FLASH SALE','2026-09-04 09:28:38','2026-09-04 09:28:38'),('f7','SKU-ELEC-007','880910000007','Fast Charging Dual USB Power Adapter 65W','Fast Charging Dual USB Power Adapter 65W','smartphones-gadgets','Smartphones & Audio',1950.00,1268.00,2800.00,2800.00,30,4.90,205,'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?auto=format&fit=crop&w=600&q=80',14,14,50,5,'smartphones-gadgets',1,0,1,1,0,1,'flash_sale','GaN III technology fast charger for laptops, tablets, and smartphones.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38'),('f8','SKU-FASH-008','880910000008','Men Slim Fit Cotton Chino Trousers','Men Slim Fit Cotton Chino Trousers','mens-fashion','Men\'s Fashion',1850.00,1203.00,2600.00,2600.00,28,4.70,84,'https://images.unsplash.com/photo-1473966968600-fa801b869a1a?auto=format&fit=crop&w=600&q=80',7,7,30,5,'mens-fashion',0,0,1,0,0,1,'flash_sale','Stretch cotton twill chinos with clean front pockets and ergonomic fit.',NULL,'FLASH SALE','2026-09-04 09:28:38','2026-09-04 09:28:38'),('f9','SKU-HOME-009','880910000009','Stainless Steel Vacuum Thermal Flask 1000ml','Stainless Steel Vacuum Thermal Flask 1000ml','home-kitchen','Home & Appliances',1450.00,943.00,2100.00,2100.00,31,4.80,135,'https://images.unsplash.com/photo-1602143407151-7111542de6e8?auto=format&fit=crop&w=600&q=80',10,10,35,5,'home-kitchen',0,1,1,0,1,1,'flash_sale','24-hour heat and cold retention double-wall vacuum insulated flask.',NULL,'FLASH SALE','2026-09-04 09:28:38','2026-09-04 09:28:38'),('ft1','SKU-SMAR-013','880910000013','Sony WH-1000XM5 Noise-Canceling Headphones','Sony WH-1000XM5 Noise-Canceling Headphones','smartwatches-audio','Smartwatches & Audio',29999.00,19499.00,38999.00,38999.00,23,4.90,310,'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=600&q=80',20,20,50,5,'smartwatches-audio',1,1,1,1,1,1,'featured','Premier active noise cancellation with speak-to-chat auto pause.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38'),('ft2','SKU-HOME-014','880910000014','Ergonomic Mesh High-Back Office Chair','Ergonomic Mesh High-Back Office Chair','home-kitchen','Home & Appliances',13500.00,8775.00,17800.00,17800.00,24,4.80,88,'https://images.unsplash.com/photo-1580481072645-022f9a6d1276?auto=format&fit=crop&w=600&q=80',14,14,30,5,'home-kitchen',0,1,1,0,1,1,'featured','3D adjustable armrests, lumbar support, and heavy-duty chrome wheelbase.',NULL,'FLASH SALE','2026-09-04 09:28:38','2026-09-04 09:28:38'),('ft3','SKU-LAPT-015','880910000015','Asus ROG Strix Gaming Laptop 16-inch','Asus ROG Strix Gaming Laptop 16-inch','laptops-computers','Laptops & Computers',185000.00,120250.00,199000.00,199000.00,7,4.90,140,'https://images.unsplash.com/photo-1603302576837-37561b2e2302?auto=format&fit=crop&w=600&q=80',6,6,15,5,'laptops-computers',0,1,1,0,1,1,'featured','Intel Core i9 14th Gen, RTX 4070 Graphics, 240Hz ROG Nebula Display.',NULL,'FLASH SALE','2026-09-04 09:28:38','2026-09-04 09:28:38'),('ft4','SKU-LAPT-016','880910000016','Mechanical RGB Backlit Gaming Keyboard','Mechanical RGB Backlit Gaming Keyboard','laptops-computers','Laptops & Computers',5600.00,3640.00,7500.00,7500.00,25,4.90,240,'https://images.unsplash.com/photo-1587829741301-dc798b83add3?auto=format&fit=crop&w=600&q=80',18,18,40,5,'laptops-computers',1,1,1,1,1,1,'featured','Hot-swappable tactile switches with aluminum top frame and key macro software.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38'),('lt1','SKU-ELEC-017','880910000017','Samsung Galaxy S24 Ultra 5G (256GB)','Samsung Galaxy S24 Ultra 5G (256GB)','smartphones-gadgets','Smartphones & Audio',134999.00,87749.00,149999.00,149999.00,10,4.90,128,'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?auto=format&fit=crop&w=600&q=80',10,10,25,5,'smartphones-gadgets',0,1,0,0,1,0,'latest','Titanium build with Snapdragon 8 Gen 3 for Galaxy and 100x zoom.',NULL,'FEATURED','2026-09-04 09:28:38','2026-09-04 09:28:38'),('lt2','SKU-HOME-018','880910000018','Non-Stick Granite Cookware Set 5-Piece','Non-Stick Granite Cookware Set 5-Piece','home-kitchen','Home & Appliances',7200.00,4680.00,9500.00,9500.00,24,4.60,62,'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&fit=crop&w=600&q=80',16,16,35,5,'home-kitchen',0,0,0,0,0,0,'latest','PFOA-free triple layer granite coating compatible with induction stovetops.',NULL,'POPULAR','2026-09-04 09:28:38','2026-09-04 09:28:38'),('lt3','SKU-FASH-019','880910000019','Classic Vintage Leather Executive Wallet','Classic Vintage Leather Executive Wallet','mens-fashion','Men\'s Fashion',1550.00,1008.00,2300.00,2300.00,32,4.80,104,'https://images.unsplash.com/photo-1627123424574-724758594e93?auto=format&fit=crop&w=600&q=80',35,35,80,5,'mens-fashion',1,0,0,1,0,0,'latest','Full-grain cowhide leather with RFID blocking lining and coin pocket.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38'),('lt4','SKU-BEAU-020','880910000020','Pure Organic Botanical Facial Serum 50ml','Pure Organic Botanical Facial Serum 50ml','beauty-care','Beauty & Personal Care',1350.00,878.00,1900.00,1900.00,29,4.70,89,'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=600&q=80',28,28,60,5,'beauty-care',0,0,0,0,0,0,'latest','Cold-pressed botanical oils rich in Vitamin C for skin radiance.',NULL,'POPULAR','2026-09-04 09:28:38','2026-09-04 09:28:38'),('lt5','SKU-GROC-021','880910000021','Premium Organic Extra Virgin Olive Oil 1L','Premium Organic Extra Virgin Olive Oil 1L','groceries','Groceries & Daily Needs',1850.00,1203.00,2200.00,2200.00,16,4.90,74,'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&w=600&q=80',40,40,100,5,'groceries',0,1,1,0,1,1,'latest','First cold-pressed Mediterranean olive oil rich in antioxidants and healthy fats.',NULL,'FLASH SALE','2026-09-04 09:28:38','2026-09-04 09:28:38'),('lt6','SKU-WOME-022','880910000022','Women Designer Embroidered Silk Kurti','Women Designer Embroidered Silk Kurti','womens-fashion','Women\'s Fashion',3450.00,2243.00,4800.00,4800.00,28,4.80,118,'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=600&q=80',14,14,35,5,'womens-fashion',1,0,0,1,0,0,'latest','Handcrafted zari thread embroidery on soft Georgette silk fabric.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38'),('lt7','SKU-HOME-023','880910000023','Automatic Stainless Steel Espresso Coffee Maker','Automatic Stainless Steel Espresso Coffee Maker','home-kitchen','Home & Appliances',14500.00,9425.00,18900.00,18900.00,23,4.90,112,'https://images.unsplash.com/photo-1570968915860-54d5c301fa9f?auto=format&fit=crop&w=600&q=80',9,9,25,5,'home-kitchen',0,0,0,0,0,0,'latest','15-bar Italian pressure pump with milk frother wand.',NULL,'POPULAR','2026-09-04 09:28:38','2026-09-04 09:28:38'),('lt8','SKU-SMAR-024','880910000024','Waterproof Sports Smartwatch Pro','Waterproof Sports Smartwatch Pro','smartwatches-audio','Smartwatches & Audio',4990.00,3244.00,6800.00,6800.00,26,4.70,143,'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?auto=format&fit=crop&w=600&q=80',19,19,50,5,'smartwatches-audio',0,0,0,0,0,0,'latest','GPS tracking, heart rate monitoring, and 14-day battery life.',NULL,'POPULAR','2026-09-04 09:28:38','2026-09-04 09:28:38'),('tr1','SKU-FASH-025','880910000025','Slim Fit Designer Denim Jacket for Men','Slim Fit Designer Denim Jacket for Men','mens-fashion','Men\'s Fashion',3100.00,2015.00,4200.00,4200.00,26,4.80,132,'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?auto=format&fit=crop&w=600&q=80',19,19,45,5,'mens-fashion',1,1,0,1,1,0,'trending','Heavyweight cotton denim with vintage wash and custom brass hardware.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38'),('tr2','SKU-HOME-026','880910000026','Minimalist Nordic Ceramic Coffee Mug Set','Minimalist Nordic Ceramic Coffee Mug Set','home-kitchen','Home & Appliances',1890.00,1229.00,2600.00,2600.00,27,4.90,94,'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=600&q=80',25,25,50,5,'home-kitchen',1,0,1,1,0,1,'trending','Handcrafted stoneware ceramic mugs with matte glaze finish.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38'),('tr3','SKU-LAPT-027','880910000027','Wireless Ergonomic Vertical Mouse 2.4G','Wireless Ergonomic Vertical Mouse 2.4G','laptops-computers','Laptops & Computers',1950.00,1268.00,2800.00,2800.00,30,4.60,168,'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?auto=format&fit=crop&w=600&q=80',30,30,70,5,'laptops-computers',1,0,0,1,0,0,'trending','Reduces wrist strain with natural handshake grip position.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38'),('tr4','SKU-BEAU-028','880910000028','Hydrating Matte Velvet Lipstick Set','Hydrating Matte Velvet Lipstick Set','beauty-care','Beauty & Personal Care',2100.00,1365.00,2900.00,2900.00,27,4.80,210,'https://images.unsplash.com/photo-1586495777744-4413f21062fa?auto=format&fit=crop&w=600&q=80',22,22,60,5,'beauty-care',1,0,0,1,0,0,'trending','Long-lasting transfer-proof color with moisturizing jojoba oil.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38'),('tr5','SKU-SPOR-029','880910000029','Adjustable Dumbbell Set 20kg Rubber Coated','Adjustable Dumbbell Set 20kg Rubber Coated','sports','Sports & Fitness',6500.00,4225.00,8500.00,8500.00,23,4.90,79,'https://images.unsplash.com/photo-1584735935682-2f2b69dff9d2?auto=format&fit=crop&w=600&q=80',8,8,20,5,'sports',1,1,0,1,1,0,'trending','Versatile home gym dumbbell set with anti-roll hexagonal plates.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38'),('tr6','SKU-ELEC-030','880910000030','Portable Mini Power Bank 20,000mAh 22.5W','Portable Mini Power Bank 20,000mAh 22.5W','smartphones-gadgets','Smartphones & Audio',2650.00,1723.00,3500.00,3500.00,24,4.80,189,'https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?auto=format&fit=crop&w=600&q=80',35,35,80,5,'smartphones-gadgets',1,0,0,1,0,0,'trending','Fast charging dual USB-C ports with LED digital display.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38'),('tr7','SKU-SMAR-031','880910000031','Noise Cancelling True Wireless Earbuds','Noise Cancelling True Wireless Earbuds','smartwatches-audio','Smartwatches & Audio',3490.00,2269.00,4800.00,4800.00,27,4.90,215,'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?auto=format&fit=crop&w=600&q=80',18,18,50,5,'smartwatches-audio',1,0,1,1,0,1,'trending','Active noise cancellation with 32h playback and IPX5 resistance.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38'),('tr8','SKU-FASH-032','880910000032','Luxury Chronograph Mens Analog Watch','Luxury Chronograph Mens Analog Watch','mens-fashion','Men\'s Fashion',5200.00,3380.00,7200.00,7200.00,28,4.80,162,'https://images.unsplash.com/photo-1524805444758-089113d48a6d?auto=format&fit=crop&w=600&q=80',12,12,30,5,'mens-fashion',1,0,0,1,0,0,'trending','Stainless steel case with Japanese quartz movement and sapphire glass.',NULL,'TRENDING','2026-09-04 09:28:38','2026-09-04 09:28:38');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('4AzTprhqVYihUm3cDsnxrMyU3XiczQm6Y3D6Ve9m',NULL,'127.0.0.1','Go-http-client/1.1','YToyOntzOjY6Il90b2tlbiI7czo0MDoic0RPWjlaWUV6bGR4R1lRalNOSmhaWFJER3pwbTNyY3czUDlYQmdadCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1788535746),('CrCmAVS0t1sOZCxMfSTOXzM5VfqyoRBqTJlIWrh1',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmRQME92MGtObWNoQzVGNm13WllsRklCb3NFUG5LbjhPZFdGRGdyZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1788535830),('F9KlL6E6P5TDMBrqpy9JovrSELgr9qZwwkquQE2O',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiemhZQWJjTzFnODllMkYwanRua0t3RkFiU0ltckNFSXNXR1FaazEwUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1788536488),('NEJ20oN7KU4TfwF4XsK2GTie8NGVavVpT93ATQLi',NULL,'127.0.0.1','Go-http-client/1.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiT1ZpSm5HZnNzYjZLczFxTXE4b05IZEN0dHdMVjlwMXRjZHUwcHdadyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1788535754),('vVoCTXfeDRybsrWCDQud6mTGrbXz5Ujp3kVzdYwl',NULL,'127.0.0.1','Go-http-client/1.1','YToyOntzOjY6Il90b2tlbiI7czo0MDoiVFNsQjZrQ2Y0RnNxaUJCR0pqZXJoRmdGVTVZZVZleURyaGNtZVM2bCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1788535753),('XfwuDuLHhnbaFQJVie1nkahiyv12D3xmvbha6O1w',NULL,'127.0.0.1','Go-http-client/1.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1M3THJYZUtCTk1vRHJwcnYyQUswRk5Ha0Z6NEtLMDdmcm1qWldVSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1788535820),('xOVQnysmDDxjAtL9MuF1QQ6XyXHHhxM1vcwNVbby',NULL,'127.0.0.1','Go-http-client/1.1','YToyOntzOjY6Il90b2tlbiI7czo0MDoiUXR6S2NZcDQxSUxJQ1o4TDZmTFBCc2duRXhacHV4SlhNZXgzQ1FqOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1788535820),('y1SN0sJGMYjbooglWGhhnYUSGbvVKJA1ScCoPWg3',NULL,'127.0.0.1','Go-http-client/1.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXFIWHExdHJueHJmMXpaNzdXekZQUE5aY1Y4ZHdOQmR6dlNnTXJhciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1788535747);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('u_admin_bikroy','BikroyBD24 Admin','admin@bikroybd24.com','01854288311','$2y$12$zGwuMrZPxSzAg5FaOuJYb.7/whwayINo5SWTdCXHH4fsK/J9V5Ele','admin',NULL,'2026-09-04 09:28:38','2026-09-04 09:28:38'),('u_admin_nexacart','Super Admin','admin@nexacart.com.bd','01700000000','$2y$12$HQGEJ0na9K68rqDCUodb4Oxl3iHbwem779KJkyX0in2QqnJSGcSnu','admin',NULL,'2026-09-04 09:28:38','2026-09-04 09:28:38');
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

-- Dump completed on 2026-09-04 21:47:14
