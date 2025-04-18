-- MySQL dump 10.13  Distrib 5.7.44, for osx10.19 (x86_64)
--
-- Host: 127.0.0.1    Database: botble
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `activations`
--

DROP TABLE IF EXISTS `activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `code` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activations_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activations`
--

LOCK TABLES `activations` WRITE;
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;
INSERT INTO `activations` VALUES (1,1,'o2KEgj2NA5FIiZVueYEBsSHxNVrBibks',1,'2024-08-26 21:25:54','2024-08-26 21:25:54','2024-08-26 21:25:54');
/*!40000 ALTER TABLE `activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_notifications`
--

DROP TABLE IF EXISTS `admin_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_notifications`
--

LOCK TABLES `admin_notifications` WRITE;
/*!40000 ALTER TABLE `admin_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_histories`
--

DROP TABLE IF EXISTS `audit_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `module` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request` longtext COLLATE utf8mb4_unicode_ci,
  `action` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_user` bigint unsigned NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_histories_user_id_index` (`user_id`),
  KEY `audit_histories_module_index` (`module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_histories`
--

LOCK TABLES `audit_histories` WRITE;
/*!40000 ALTER TABLE `audit_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blocks_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocks`
--

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
INSERT INTO `blocks` VALUES (1,'Brennon Russel','brennon-russel','Error ullam eligendi quidem nisi quos.','Qui explicabo sint corrupti animi tenetur molestiae atque. Fugit porro mollitia ut cum incidunt dolore. Qui corporis eum dolore id quae ut natus. Sed autem qui ipsam ad alias vero ipsum. Explicabo a commodi placeat. Nihil quos distinctio reprehenderit ullam et aut. Velit cupiditate ipsum nam quas quia. Qui nostrum consequatur velit qui excepturi. Quia hic laborum ut. Dolor animi asperiores numquam amet ipsam a. Aliquam eos unde velit.','published',NULL,'2024-08-26 21:26:01','2024-08-26 21:26:01'),(2,'Luther Wisoky','luther-wisoky','Suscipit laboriosam et voluptates.','Eaque beatae quidem ut qui aliquid nam. Rerum explicabo eos consequatur nisi ut ex ullam. Saepe sapiente placeat voluptatem corporis fugiat ut sint ut. Sit dolore debitis in earum vero et. Temporibus aspernatur ducimus fugiat expedita tempora qui sapiente. Rerum perspiciatis reiciendis sed eius quo qui omnis eligendi. Ipsum mollitia sit totam dignissimos consequatur minus. Et quod dolor id deleniti blanditiis est omnis. Et fugiat voluptas excepturi minima.','published',NULL,'2024-08-26 21:26:01','2024-08-26 21:26:01'),(3,'Ms. Violet McClure','ms-violet-mcclure','Quibusdam officia hic a non.','Perferendis dolores exercitationem laudantium dignissimos blanditiis id. Magni et blanditiis placeat aut. Ratione mollitia eveniet officiis est eveniet odit quod. Rerum et quas animi quia nulla ut aut. Accusantium temporibus molestias labore magni laboriosam qui. Fugiat est voluptatem consequatur aut distinctio. Id consectetur voluptas fugit molestiae et veniam enim modi.','published',NULL,'2024-08-26 21:26:01','2024-08-26 21:26:01'),(4,'Dereck Bergnaum','dereck-bergnaum','Et omnis rerum nam. Quis ut est quas.','Est in ut iusto numquam voluptatem et. Et earum incidunt sed dolorum quos non qui similique. Harum corporis error commodi tenetur. Ad quia et temporibus eligendi cupiditate fugit iure sed. Et iure ipsum officiis dolores eum totam. Qui id exercitationem placeat inventore voluptas minus beatae. Quam porro neque voluptate est repellat qui odio. Veniam cum perferendis et voluptatibus in officiis iure.','published',NULL,'2024-08-26 21:26:01','2024-08-26 21:26:01'),(5,'Dr. Tre Stroman','dr-tre-stroman','Esse ut ipsam assumenda quae unde.','Ut dignissimos provident eius consequatur eveniet recusandae et. Provident deserunt libero odit dolorem doloribus et. Voluptatem nobis quisquam ex omnis veniam iusto. Voluptate reiciendis sapiente dignissimos omnis. Esse voluptas atque sint corrupti. Maiores velit eius id voluptatibus molestiae molestiae. Eos quae et facilis. Omnis rem quia consequatur quod facilis quia et.','published',NULL,'2024-08-26 21:26:01','2024-08-26 21:26:01');
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blocks_translations`
--

DROP TABLE IF EXISTS `blocks_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocks_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blocks_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`blocks_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocks_translations`
--

LOCK TABLES `blocks_translations` WRITE;
/*!40000 ALTER TABLE `blocks_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `blocks_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `icon` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_index` (`parent_id`),
  KEY `categories_status_index` (`status`),
  KEY `categories_created_at_index` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Artificial Intelligence',0,'Assumenda blanditiis dignissimos iure non et quia voluptatem. Nihil sed eveniet nobis eaque est fuga perspiciatis. Natus et blanditiis eius necessitatibus soluta dicta omnis.','published',1,'Botble\\ACL\\Models\\User',NULL,0,0,0,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(2,'Cybersecurity',0,'Maxime modi aut est cum culpa ipsam ipsum. Neque vel omnis eius tempora rerum. Omnis hic nihil praesentium qui. Qui blanditiis omnis voluptatem soluta.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(3,'Blockchain Technology',0,'Culpa doloremque est aut amet. Qui voluptate veniam unde enim excepturi. Similique exercitationem eveniet suscipit reiciendis. Quia ut amet voluptatem saepe. Iusto occaecati perferendis corrupti.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(4,'5G and Connectivity',0,'Enim sit aut facere ipsum dolores corrupti at reprehenderit. Ea illum doloribus et tempore maiores iure. Laboriosam iste enim non expedita minima libero.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(5,'Augmented Reality (AR)',0,'Ipsam quam rerum est. Sint delectus enim neque nemo quod. Quia voluptatem dolore eum ad. Et quos molestias voluptas animi est quidem. Dolor eligendi reiciendis asperiores libero.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(6,'Green Technology',0,'Autem quis eos odit tempora. Sed error a mollitia ut vitae eaque quam laudantium. Deserunt magni culpa suscipit ad veritatis.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(7,'Quantum Computing',0,'In provident earum sit perferendis harum explicabo. Qui distinctio rerum veritatis iure totam ut nisi. Sequi sint omnis necessitatibus.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(8,'Edge Computing',0,'Vitae inventore esse cumque labore. Qui non nihil maiores dolorum. Voluptatem iure quia aliquam eligendi. Eum adipisci ipsum natus assumenda exercitationem voluptatem.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-08-26 21:25:56','2024-08-26 21:25:56');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories_translations`
--

DROP TABLE IF EXISTS `categories_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories_translations`
--

LOCK TABLES `categories_translations` WRITE;
/*!40000 ALTER TABLE `categories_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_custom_field_options`
--

DROP TABLE IF EXISTS `contact_custom_field_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_custom_field_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `custom_field_id` bigint unsigned NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '999',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_custom_field_options`
--

LOCK TABLES `contact_custom_field_options` WRITE;
/*!40000 ALTER TABLE `contact_custom_field_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_custom_field_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_custom_field_options_translations`
--

DROP TABLE IF EXISTS `contact_custom_field_options_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_custom_field_options_translations` (
  `contact_custom_field_options_id` bigint unsigned NOT NULL,
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`contact_custom_field_options_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_custom_field_options_translations`
--

LOCK TABLES `contact_custom_field_options_translations` WRITE;
/*!40000 ALTER TABLE `contact_custom_field_options_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_custom_field_options_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_custom_fields`
--

DROP TABLE IF EXISTS `contact_custom_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_custom_fields` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placeholder` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '999',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_custom_fields`
--

LOCK TABLES `contact_custom_fields` WRITE;
/*!40000 ALTER TABLE `contact_custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_custom_fields_translations`
--

DROP TABLE IF EXISTS `contact_custom_fields_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_custom_fields_translations` (
  `contact_custom_fields_id` bigint unsigned NOT NULL,
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placeholder` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`contact_custom_fields_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_custom_fields_translations`
--

LOCK TABLES `contact_custom_fields_translations` WRITE;
/*!40000 ALTER TABLE `contact_custom_fields_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_custom_fields_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_replies`
--

DROP TABLE IF EXISTS `contact_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_replies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_replies`
--

LOCK TABLES `contact_replies` WRITE;
/*!40000 ALTER TABLE `contact_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_fields` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'Ewell Langworth','bswift@example.org','+18187744560','99629 Molly Islands Apt. 184\nMaximoview, NV 66419-2312','Dolor corrupti reprehenderit laudantium.','Eum nam corrupti ducimus corporis harum ipsam. Deleniti similique dicta accusantium ipsa voluptatem voluptatibus. Alias atque itaque dolorem reiciendis quam et. Repellendus adipisci accusamus mollitia omnis qui. Enim ut ratione deserunt recusandae eum inventore. Dolores quia blanditiis aliquam architecto veritatis consequatur. Harum quae aut accusamus nobis. Impedit debitis qui ut ut nemo. Maxime labore repudiandae labore eius magni.',NULL,'unread','2024-08-26 21:26:01','2024-08-26 21:26:01'),(2,'Prof. Amy Fisher III','hartmann.kenny@example.org','470-904-2389','4067 Wisoky Plains Suite 893\nHallieton, NH 62796-9451','Sunt aliquam minus sequi.','Aperiam velit nobis nesciunt id dolor quia. Eveniet aut esse nihil eos incidunt sapiente sunt. Dolorem error voluptatem sequi tenetur assumenda. Dolores sapiente nulla soluta dolor velit. Quis numquam occaecati rerum minima ut. Sapiente non nemo aspernatur numquam aut. Magnam atque nihil iusto incidunt. Ea velit non ipsa pariatur exercitationem. Deleniti quam sint ipsam consequatur voluptate.',NULL,'read','2024-08-26 21:26:01','2024-08-26 21:26:01'),(3,'Haylee Goyette','cummings.payton@example.org','947.616.2226','36766 Angel Springs\nPort Angel, FL 54664','Alias ipsam ea et vitae.','Quasi accusantium iure blanditiis vel. Laudantium totam rem qui fugiat qui alias et voluptatibus. Dignissimos ipsum aspernatur culpa numquam non nostrum et qui. Deserunt porro iure autem pariatur rerum dolorem nihil. Occaecati quisquam repellat similique perferendis possimus natus. Quae accusantium occaecati voluptatem molestiae. Et inventore qui nulla ut doloremque nostrum ut. Quidem dolorem quibusdam a.',NULL,'unread','2024-08-26 21:26:01','2024-08-26 21:26:01'),(4,'Dayton Franecki','ward.dante@example.org','(930) 770-9399','91672 Laurel Mountain\nFelicityview, MI 18558-1456','Dolor aut consectetur fugiat quibusdam et et qui.','Dignissimos perspiciatis vel autem earum officiis quod molestiae id. Ut dolor iste aliquam quibusdam. Voluptatem qui porro laborum quos at fuga. Odit autem alias nesciunt dicta quo. Quaerat fuga qui pariatur rem quia. Veniam aperiam sint et non voluptas fugiat id. Quis ad odio dicta et quis et. Quaerat nobis ut non harum dolores molestias beatae. Minima ratione occaecati sapiente perferendis molestias tempora.',NULL,'unread','2024-08-26 21:26:01','2024-08-26 21:26:01'),(5,'Miss Corine Rice','fay.skyla@example.com','(573) 999-2903','76923 Otho Loaf\nLake Avisside, NC 55443','Ad labore natus illo cum et illo.','Voluptatem saepe culpa voluptatem. Animi mollitia voluptatem omnis repellendus molestiae deleniti et rerum. Repudiandae et esse nostrum. Nemo doloribus et consequatur reprehenderit omnis voluptatibus itaque. Voluptatem expedita tempora ad eveniet cumque eum. Voluptatem ut omnis et.',NULL,'read','2024-08-26 21:26:01','2024-08-26 21:26:01'),(6,'Dr. Rosario Smith Sr.','marge87@example.org','+1-919-370-1893','793 Kenny Springs\nWest Shannaburgh, KY 92176-1065','Voluptas omnis voluptate et officiis.','Recusandae ut voluptates voluptate hic rem accusamus. Alias cumque harum aut velit eos nihil. Voluptatem quis voluptas quia unde quod. A omnis tenetur magni molestias odio. Vitae quia quis voluptas qui esse. Non autem et sapiente rerum deleniti consequatur dolores. Suscipit ut ipsum voluptates vel distinctio nisi. Quo ipsam earum fugiat quae et delectus. Est ut provident et.',NULL,'unread','2024-08-26 21:26:01','2024-08-26 21:26:01'),(7,'Marlin Lesch','hauck.joan@example.org','+1-908-376-7271','417 Ubaldo Squares Suite 357\nWest Jordanshire, WY 15262','Ipsam mollitia ex temporibus soluta dicta.','Debitis harum quas sequi expedita mollitia laboriosam. Earum commodi nobis nemo voluptatem. Aut error ut exercitationem nihil qui sequi. Omnis nam et aut doloremque rerum quos. In ut ipsam aut omnis. Ratione laborum id minus. Expedita aliquam et dolorem illum dolores commodi. Quam voluptatum rerum in nesciunt similique. Et vitae dolore eaque sed aut quis dicta. Quis quia est blanditiis error sapiente optio necessitatibus minus. Ut sint velit eos rerum dignissimos et id.',NULL,'read','2024-08-26 21:26:01','2024-08-26 21:26:01'),(8,'Rusty Baumbach','elissa39@example.org','+1-283-222-8951','11060 Schowalter Shoals\nTraceychester, HI 39473','At aut id harum et alias aut.','Odio minima magni dolorem beatae rerum consequatur. Delectus aut dolorum provident ex voluptatem officia. Nesciunt placeat tempore et sint. Laudantium fuga non quod. Molestiae est culpa et non quia quia. Aut rerum corporis quia veritatis dolorum quaerat error. Quia ut recusandae culpa provident fugiat. Id aperiam repudiandae non. Inventore at nemo ratione optio fugiat ipsam est. Id id corrupti voluptate qui consectetur a quis. Qui aut ullam quidem eum. Distinctio tenetur labore sunt.',NULL,'read','2024-08-26 21:26:01','2024-08-26 21:26:01'),(9,'Prof. Tevin Friesen','beahan.kristian@example.org','(779) 728-2485','3905 Vandervort Branch Apt. 265\nLake Cleoton, WV 63181-9312','Maiores eum autem pariatur occaecati sit.','Explicabo recusandae illo mollitia quod. Aut eius nihil repellat. Debitis dolor vel non velit totam esse. Cum incidunt voluptatem assumenda explicabo dolorum laborum. Et temporibus iure reprehenderit ut molestiae sit quos maiores. Debitis omnis sapiente officiis sunt. Voluptate omnis minima ab laboriosam voluptas et ab. Aspernatur non non aut nostrum et illum quia. Occaecati suscipit fugit facere quibusdam voluptas ab. Eum fugit quaerat qui qui ea et. Optio sint et perspiciatis illo quis.',NULL,'unread','2024-08-26 21:26:01','2024-08-26 21:26:01'),(10,'Ms. Madie Jakubowski I','hettinger.lurline@example.com','+1-321-291-2800','1869 Donnelly Isle Apt. 336\nStefanhaven, AR 00704-3837','Saepe dolor ad qui architecto recusandae.','Non sapiente maiores tenetur sequi. Nam blanditiis praesentium quam nulla. Est consequatur ipsum ipsa facilis. Labore labore illum eveniet dolores pariatur consequatur deserunt. Enim omnis porro quam ut. Numquam consequatur tenetur sint optio tempore exercitationem nemo. Sint eveniet velit harum magni.',NULL,'read','2024-08-26 21:26:01','2024-08-26 21:26:01');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_fields`
--

DROP TABLE IF EXISTS `custom_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custom_fields` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `use_for` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `use_for_id` bigint unsigned NOT NULL,
  `field_item_id` bigint unsigned NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `custom_fields_field_item_id_index` (`field_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_fields`
--

LOCK TABLES `custom_fields` WRITE;
/*!40000 ALTER TABLE `custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_fields_translations`
--

DROP TABLE IF EXISTS `custom_fields_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custom_fields_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_fields_id` bigint unsigned NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`custom_fields_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_fields_translations`
--

LOCK TABLES `custom_fields_translations` WRITE;
/*!40000 ALTER TABLE `custom_fields_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_fields_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboard_widget_settings`
--

DROP TABLE IF EXISTS `dashboard_widget_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dashboard_widget_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned NOT NULL,
  `widget_id` bigint unsigned NOT NULL,
  `order` tinyint unsigned NOT NULL DEFAULT '0',
  `status` tinyint unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dashboard_widget_settings_user_id_index` (`user_id`),
  KEY `dashboard_widget_settings_widget_id_index` (`widget_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard_widget_settings`
--

LOCK TABLES `dashboard_widget_settings` WRITE;
/*!40000 ALTER TABLE `dashboard_widget_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `dashboard_widget_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboard_widgets`
--

DROP TABLE IF EXISTS `dashboard_widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dashboard_widgets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard_widgets`
--

LOCK TABLES `dashboard_widgets` WRITE;
/*!40000 ALTER TABLE `dashboard_widgets` DISABLE KEYS */;
/*!40000 ALTER TABLE `dashboard_widgets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
-- Table structure for table `field_groups`
--

DROP TABLE IF EXISTS `field_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `field_groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rules` text COLLATE utf8mb4_unicode_ci,
  `order` int NOT NULL DEFAULT '0',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `field_groups_created_by_index` (`created_by`),
  KEY `field_groups_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field_groups`
--

LOCK TABLES `field_groups` WRITE;
/*!40000 ALTER TABLE `field_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `field_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `field_items`
--

DROP TABLE IF EXISTS `field_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `field_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `field_group_id` bigint unsigned NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `order` int DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci,
  `options` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `field_items_field_group_id_index` (`field_group_id`),
  KEY `field_items_parent_id_index` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field_items`
--

LOCK TABLES `field_items` WRITE;
/*!40000 ALTER TABLE `field_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `field_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` tinyint unsigned NOT NULL DEFAULT '0',
  `order` tinyint unsigned NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galleries_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (1,'Sunset','Pariatur quisquam rerum est minus ea. Magni vero quibusdam non et ex asperiores harum. Explicabo beatae culpa iste mollitia quo sunt a dolores.',1,0,'news/6.jpg',1,'published','2024-08-26 21:25:57','2024-08-26 21:25:57'),(2,'Ocean Views','Maxime voluptas consequatur cumque non. Aliquid vero illo ratione vero. Sed et quidem natus rem.',1,0,'news/7.jpg',1,'published','2024-08-26 21:25:57','2024-08-26 21:25:57'),(3,'Adventure Time','Minus tempore veritatis exercitationem inventore. Et ea dicta ab quo neque molestiae. Culpa sequi ut eius quaerat rem velit sint.',1,0,'news/8.jpg',1,'published','2024-08-26 21:25:57','2024-08-26 21:25:57'),(4,'City Lights','Repellendus consequatur quod minima minus eius itaque. Sit fugiat esse adipisci minima veritatis necessitatibus rerum.',1,0,'news/9.jpg',1,'published','2024-08-26 21:25:57','2024-08-26 21:25:57'),(5,'Dreamscape','Quia nulla quia ad iure ex laboriosam. Suscipit asperiores ipsum possimus commodi facere doloribus dignissimos.',1,0,'news/10.jpg',1,'published','2024-08-26 21:25:57','2024-08-26 21:25:57'),(6,'Enchanted Forest','Aspernatur et quia quaerat. Eum debitis quidem sunt sapiente minima.',1,0,'news/11.jpg',1,'published','2024-08-26 21:25:57','2024-08-26 21:25:57'),(7,'Golden Hour','Necessitatibus sed id consequatur quia. Molestias qui sapiente sunt est. Commodi ut velit neque eveniet eos accusantium.',0,0,'news/12.jpg',1,'published','2024-08-26 21:25:57','2024-08-26 21:25:57'),(8,'Serenity','Ratione temporibus sequi consequuntur veniam ea quia. Expedita voluptates et dolor aliquid incidunt rem repellat qui. Velit eos quasi sit.',0,0,'news/13.jpg',1,'published','2024-08-26 21:25:57','2024-08-26 21:25:57'),(9,'Eternal Beauty','Omnis repellendus minima molestias id. Eum magnam sit voluptatem magnam modi. Ipsam consectetur labore nulla nam.',0,0,'news/14.jpg',1,'published','2024-08-26 21:25:57','2024-08-26 21:25:57'),(10,'Moonlight Magic','Vero omnis quo quasi dolor. Molestiae laudantium at inventore unde. Eum aliquid laborum ut qui maxime et. Est voluptatem odit praesentium.',0,0,'news/15.jpg',1,'published','2024-08-26 21:25:57','2024-08-26 21:25:57'),(11,'Starry Night','Rerum et beatae nesciunt rerum illo. Necessitatibus quos aut reprehenderit porro in. Aut officiis amet hic asperiores est soluta.',0,0,'news/16.jpg',1,'published','2024-08-26 21:25:57','2024-08-26 21:25:57'),(12,'Hidden Gems','Dignissimos est ut et incidunt qui quia. Laboriosam aut itaque adipisci exercitationem quos error sint. Dolorum velit id quidem unde.',0,0,'news/17.jpg',1,'published','2024-08-26 21:25:57','2024-08-26 21:25:57'),(13,'Tranquil Waters','Beatae unde numquam aperiam quo nobis quae. Ut omnis illo error ut est quo quo. Neque a laudantium repellendus et natus.',0,0,'news/18.jpg',1,'published','2024-08-26 21:25:57','2024-08-26 21:25:57'),(14,'Urban Escape','Distinctio quasi modi quia debitis quo. Tenetur sint et vero eos.',0,0,'news/19.jpg',1,'published','2024-08-26 21:25:57','2024-08-26 21:25:57'),(15,'Twilight Zone','Dolores iste inventore repellat ea. Dolore perspiciatis veritatis quia adipisci. Rerum et sunt sed maiores a numquam.',0,0,'news/20.jpg',1,'published','2024-08-26 21:25:57','2024-08-26 21:25:57');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries_translations`
--

DROP TABLE IF EXISTS `galleries_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galleries_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `galleries_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`galleries_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries_translations`
--

LOCK TABLES `galleries_translations` WRITE;
/*!40000 ALTER TABLE `galleries_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `galleries_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_meta`
--

DROP TABLE IF EXISTS `gallery_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery_meta` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `images` text COLLATE utf8mb4_unicode_ci,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_meta_reference_id_index` (`reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_meta`
--

LOCK TABLES `gallery_meta` WRITE;
/*!40000 ALTER TABLE `gallery_meta` DISABLE KEYS */;
INSERT INTO `gallery_meta` VALUES (1,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Tenetur dolores et et ut. Ipsam aliquid minus consequatur at. Qui amet sapiente enim et possimus animi tenetur qui. Totam molestiae ex in.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Quod sequi deleniti qui rem voluptatem natus. Rerum et sunt totam nihil excepturi.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Voluptatem tempora in qui fugiat. Et voluptatum voluptatem quis id iste. Dolor perspiciatis sit et sit facere molestiae omnis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Dolorem et error sed. Veniam modi qui neque sed commodi eveniet recusandae. Voluptates error qui est nisi dolorem minus ratione.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Est qui nam soluta. Pariatur unde alias quae nulla libero. Quas debitis in eius aliquid qui dolorem culpa.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Iure minima ratione perspiciatis dolorum. In voluptatem in ea. Id et et quibusdam eos. Eius eum neque cupiditate rerum quia ad et.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Quis sit aut nesciunt quidem ut cupiditate. Autem qui molestias illo voluptas. Officiis iure ipsa eveniet alias nesciunt ipsum expedita.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Excepturi repudiandae quaerat similique nihil. Perspiciatis vel itaque qui nam sed occaecati quo. Eius sunt nostrum ut veniam quam.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea eveniet et enim numquam. Similique neque dolores officia possimus. Ullam voluptatem id et eveniet voluptas.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Voluptas iure et impedit eaque quasi. Sed harum quam omnis unde.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"A corporis voluptate quibusdam quis. Omnis quia minus commodi. Consequatur quos repudiandae deleniti est.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Distinctio voluptates velit quas quo quia cum commodi. Sit est blanditiis aspernatur dolore a. Harum vitae harum laboriosam dolores et et nulla.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Facere sit vitae ea dolorem tempore et. Autem sed voluptas voluptas id voluptas et. Inventore autem id nobis nobis ex architecto.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Quia repellat culpa rerum nulla at eveniet. Cum vitae voluptatum temporibus voluptatem inventore. Quisquam maiores voluptatum ut voluptas recusandae.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Aut quisquam occaecati qui inventore commodi quia eum. Ullam eligendi sed sed aut voluptatem. Velit libero nemo iusto officiis aut.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Et neque et perferendis laudantium. Autem tempore eum et adipisci similique sunt iste. Qui quidem itaque nam ut.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Ducimus voluptate velit vitae ducimus dolorem vel tempore. Repellendus delectus magni labore est enim. Voluptatem quo molestias assumenda nisi.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Sint error debitis totam sint aut neque. Quis est debitis quidem autem voluptatem eveniet commodi ex. Facere a porro rerum neque tempore in natus.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Rerum aliquid aliquam nostrum. Dignissimos nobis atque enim qui exercitationem et distinctio. At ut est repellat molestias voluptatum.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Repellat provident saepe ipsa possimus. Facilis consequatur voluptatem impedit inventore rerum non. Veritatis sunt consectetur velit blanditiis.\"}]',1,'Botble\\Gallery\\Models\\Gallery','2024-08-26 21:25:57','2024-08-26 21:25:57'),(2,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Tenetur dolores et et ut. Ipsam aliquid minus consequatur at. Qui amet sapiente enim et possimus animi tenetur qui. Totam molestiae ex in.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Quod sequi deleniti qui rem voluptatem natus. Rerum et sunt totam nihil excepturi.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Voluptatem tempora in qui fugiat. Et voluptatum voluptatem quis id iste. Dolor perspiciatis sit et sit facere molestiae omnis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Dolorem et error sed. Veniam modi qui neque sed commodi eveniet recusandae. Voluptates error qui est nisi dolorem minus ratione.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Est qui nam soluta. Pariatur unde alias quae nulla libero. Quas debitis in eius aliquid qui dolorem culpa.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Iure minima ratione perspiciatis dolorum. In voluptatem in ea. Id et et quibusdam eos. Eius eum neque cupiditate rerum quia ad et.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Quis sit aut nesciunt quidem ut cupiditate. Autem qui molestias illo voluptas. Officiis iure ipsa eveniet alias nesciunt ipsum expedita.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Excepturi repudiandae quaerat similique nihil. Perspiciatis vel itaque qui nam sed occaecati quo. Eius sunt nostrum ut veniam quam.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea eveniet et enim numquam. Similique neque dolores officia possimus. Ullam voluptatem id et eveniet voluptas.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Voluptas iure et impedit eaque quasi. Sed harum quam omnis unde.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"A corporis voluptate quibusdam quis. Omnis quia minus commodi. Consequatur quos repudiandae deleniti est.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Distinctio voluptates velit quas quo quia cum commodi. Sit est blanditiis aspernatur dolore a. Harum vitae harum laboriosam dolores et et nulla.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Facere sit vitae ea dolorem tempore et. Autem sed voluptas voluptas id voluptas et. Inventore autem id nobis nobis ex architecto.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Quia repellat culpa rerum nulla at eveniet. Cum vitae voluptatum temporibus voluptatem inventore. Quisquam maiores voluptatum ut voluptas recusandae.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Aut quisquam occaecati qui inventore commodi quia eum. Ullam eligendi sed sed aut voluptatem. Velit libero nemo iusto officiis aut.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Et neque et perferendis laudantium. Autem tempore eum et adipisci similique sunt iste. Qui quidem itaque nam ut.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Ducimus voluptate velit vitae ducimus dolorem vel tempore. Repellendus delectus magni labore est enim. Voluptatem quo molestias assumenda nisi.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Sint error debitis totam sint aut neque. Quis est debitis quidem autem voluptatem eveniet commodi ex. Facere a porro rerum neque tempore in natus.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Rerum aliquid aliquam nostrum. Dignissimos nobis atque enim qui exercitationem et distinctio. At ut est repellat molestias voluptatum.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Repellat provident saepe ipsa possimus. Facilis consequatur voluptatem impedit inventore rerum non. Veritatis sunt consectetur velit blanditiis.\"}]',2,'Botble\\Gallery\\Models\\Gallery','2024-08-26 21:25:57','2024-08-26 21:25:57'),(3,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Tenetur dolores et et ut. Ipsam aliquid minus consequatur at. Qui amet sapiente enim et possimus animi tenetur qui. Totam molestiae ex in.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Quod sequi deleniti qui rem voluptatem natus. Rerum et sunt totam nihil excepturi.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Voluptatem tempora in qui fugiat. Et voluptatum voluptatem quis id iste. Dolor perspiciatis sit et sit facere molestiae omnis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Dolorem et error sed. Veniam modi qui neque sed commodi eveniet recusandae. Voluptates error qui est nisi dolorem minus ratione.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Est qui nam soluta. Pariatur unde alias quae nulla libero. Quas debitis in eius aliquid qui dolorem culpa.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Iure minima ratione perspiciatis dolorum. In voluptatem in ea. Id et et quibusdam eos. Eius eum neque cupiditate rerum quia ad et.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Quis sit aut nesciunt quidem ut cupiditate. Autem qui molestias illo voluptas. Officiis iure ipsa eveniet alias nesciunt ipsum expedita.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Excepturi repudiandae quaerat similique nihil. Perspiciatis vel itaque qui nam sed occaecati quo. Eius sunt nostrum ut veniam quam.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea eveniet et enim numquam. Similique neque dolores officia possimus. Ullam voluptatem id et eveniet voluptas.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Voluptas iure et impedit eaque quasi. Sed harum quam omnis unde.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"A corporis voluptate quibusdam quis. Omnis quia minus commodi. Consequatur quos repudiandae deleniti est.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Distinctio voluptates velit quas quo quia cum commodi. Sit est blanditiis aspernatur dolore a. Harum vitae harum laboriosam dolores et et nulla.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Facere sit vitae ea dolorem tempore et. Autem sed voluptas voluptas id voluptas et. Inventore autem id nobis nobis ex architecto.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Quia repellat culpa rerum nulla at eveniet. Cum vitae voluptatum temporibus voluptatem inventore. Quisquam maiores voluptatum ut voluptas recusandae.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Aut quisquam occaecati qui inventore commodi quia eum. Ullam eligendi sed sed aut voluptatem. Velit libero nemo iusto officiis aut.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Et neque et perferendis laudantium. Autem tempore eum et adipisci similique sunt iste. Qui quidem itaque nam ut.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Ducimus voluptate velit vitae ducimus dolorem vel tempore. Repellendus delectus magni labore est enim. Voluptatem quo molestias assumenda nisi.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Sint error debitis totam sint aut neque. Quis est debitis quidem autem voluptatem eveniet commodi ex. Facere a porro rerum neque tempore in natus.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Rerum aliquid aliquam nostrum. Dignissimos nobis atque enim qui exercitationem et distinctio. At ut est repellat molestias voluptatum.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Repellat provident saepe ipsa possimus. Facilis consequatur voluptatem impedit inventore rerum non. Veritatis sunt consectetur velit blanditiis.\"}]',3,'Botble\\Gallery\\Models\\Gallery','2024-08-26 21:25:57','2024-08-26 21:25:57'),(4,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Tenetur dolores et et ut. Ipsam aliquid minus consequatur at. Qui amet sapiente enim et possimus animi tenetur qui. Totam molestiae ex in.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Quod sequi deleniti qui rem voluptatem natus. Rerum et sunt totam nihil excepturi.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Voluptatem tempora in qui fugiat. Et voluptatum voluptatem quis id iste. Dolor perspiciatis sit et sit facere molestiae omnis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Dolorem et error sed. Veniam modi qui neque sed commodi eveniet recusandae. Voluptates error qui est nisi dolorem minus ratione.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Est qui nam soluta. Pariatur unde alias quae nulla libero. Quas debitis in eius aliquid qui dolorem culpa.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Iure minima ratione perspiciatis dolorum. In voluptatem in ea. Id et et quibusdam eos. Eius eum neque cupiditate rerum quia ad et.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Quis sit aut nesciunt quidem ut cupiditate. Autem qui molestias illo voluptas. Officiis iure ipsa eveniet alias nesciunt ipsum expedita.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Excepturi repudiandae quaerat similique nihil. Perspiciatis vel itaque qui nam sed occaecati quo. Eius sunt nostrum ut veniam quam.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea eveniet et enim numquam. Similique neque dolores officia possimus. Ullam voluptatem id et eveniet voluptas.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Voluptas iure et impedit eaque quasi. Sed harum quam omnis unde.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"A corporis voluptate quibusdam quis. Omnis quia minus commodi. Consequatur quos repudiandae deleniti est.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Distinctio voluptates velit quas quo quia cum commodi. Sit est blanditiis aspernatur dolore a. Harum vitae harum laboriosam dolores et et nulla.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Facere sit vitae ea dolorem tempore et. Autem sed voluptas voluptas id voluptas et. Inventore autem id nobis nobis ex architecto.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Quia repellat culpa rerum nulla at eveniet. Cum vitae voluptatum temporibus voluptatem inventore. Quisquam maiores voluptatum ut voluptas recusandae.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Aut quisquam occaecati qui inventore commodi quia eum. Ullam eligendi sed sed aut voluptatem. Velit libero nemo iusto officiis aut.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Et neque et perferendis laudantium. Autem tempore eum et adipisci similique sunt iste. Qui quidem itaque nam ut.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Ducimus voluptate velit vitae ducimus dolorem vel tempore. Repellendus delectus magni labore est enim. Voluptatem quo molestias assumenda nisi.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Sint error debitis totam sint aut neque. Quis est debitis quidem autem voluptatem eveniet commodi ex. Facere a porro rerum neque tempore in natus.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Rerum aliquid aliquam nostrum. Dignissimos nobis atque enim qui exercitationem et distinctio. At ut est repellat molestias voluptatum.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Repellat provident saepe ipsa possimus. Facilis consequatur voluptatem impedit inventore rerum non. Veritatis sunt consectetur velit blanditiis.\"}]',4,'Botble\\Gallery\\Models\\Gallery','2024-08-26 21:25:57','2024-08-26 21:25:57'),(5,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Tenetur dolores et et ut. Ipsam aliquid minus consequatur at. Qui amet sapiente enim et possimus animi tenetur qui. Totam molestiae ex in.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Quod sequi deleniti qui rem voluptatem natus. Rerum et sunt totam nihil excepturi.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Voluptatem tempora in qui fugiat. Et voluptatum voluptatem quis id iste. Dolor perspiciatis sit et sit facere molestiae omnis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Dolorem et error sed. Veniam modi qui neque sed commodi eveniet recusandae. Voluptates error qui est nisi dolorem minus ratione.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Est qui nam soluta. Pariatur unde alias quae nulla libero. Quas debitis in eius aliquid qui dolorem culpa.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Iure minima ratione perspiciatis dolorum. In voluptatem in ea. Id et et quibusdam eos. Eius eum neque cupiditate rerum quia ad et.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Quis sit aut nesciunt quidem ut cupiditate. Autem qui molestias illo voluptas. Officiis iure ipsa eveniet alias nesciunt ipsum expedita.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Excepturi repudiandae quaerat similique nihil. Perspiciatis vel itaque qui nam sed occaecati quo. Eius sunt nostrum ut veniam quam.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea eveniet et enim numquam. Similique neque dolores officia possimus. Ullam voluptatem id et eveniet voluptas.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Voluptas iure et impedit eaque quasi. Sed harum quam omnis unde.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"A corporis voluptate quibusdam quis. Omnis quia minus commodi. Consequatur quos repudiandae deleniti est.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Distinctio voluptates velit quas quo quia cum commodi. Sit est blanditiis aspernatur dolore a. Harum vitae harum laboriosam dolores et et nulla.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Facere sit vitae ea dolorem tempore et. Autem sed voluptas voluptas id voluptas et. Inventore autem id nobis nobis ex architecto.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Quia repellat culpa rerum nulla at eveniet. Cum vitae voluptatum temporibus voluptatem inventore. Quisquam maiores voluptatum ut voluptas recusandae.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Aut quisquam occaecati qui inventore commodi quia eum. Ullam eligendi sed sed aut voluptatem. Velit libero nemo iusto officiis aut.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Et neque et perferendis laudantium. Autem tempore eum et adipisci similique sunt iste. Qui quidem itaque nam ut.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Ducimus voluptate velit vitae ducimus dolorem vel tempore. Repellendus delectus magni labore est enim. Voluptatem quo molestias assumenda nisi.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Sint error debitis totam sint aut neque. Quis est debitis quidem autem voluptatem eveniet commodi ex. Facere a porro rerum neque tempore in natus.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Rerum aliquid aliquam nostrum. Dignissimos nobis atque enim qui exercitationem et distinctio. At ut est repellat molestias voluptatum.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Repellat provident saepe ipsa possimus. Facilis consequatur voluptatem impedit inventore rerum non. Veritatis sunt consectetur velit blanditiis.\"}]',5,'Botble\\Gallery\\Models\\Gallery','2024-08-26 21:25:57','2024-08-26 21:25:57'),(6,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Tenetur dolores et et ut. Ipsam aliquid minus consequatur at. Qui amet sapiente enim et possimus animi tenetur qui. Totam molestiae ex in.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Quod sequi deleniti qui rem voluptatem natus. Rerum et sunt totam nihil excepturi.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Voluptatem tempora in qui fugiat. Et voluptatum voluptatem quis id iste. Dolor perspiciatis sit et sit facere molestiae omnis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Dolorem et error sed. Veniam modi qui neque sed commodi eveniet recusandae. Voluptates error qui est nisi dolorem minus ratione.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Est qui nam soluta. Pariatur unde alias quae nulla libero. Quas debitis in eius aliquid qui dolorem culpa.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Iure minima ratione perspiciatis dolorum. In voluptatem in ea. Id et et quibusdam eos. Eius eum neque cupiditate rerum quia ad et.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Quis sit aut nesciunt quidem ut cupiditate. Autem qui molestias illo voluptas. Officiis iure ipsa eveniet alias nesciunt ipsum expedita.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Excepturi repudiandae quaerat similique nihil. Perspiciatis vel itaque qui nam sed occaecati quo. Eius sunt nostrum ut veniam quam.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea eveniet et enim numquam. Similique neque dolores officia possimus. Ullam voluptatem id et eveniet voluptas.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Voluptas iure et impedit eaque quasi. Sed harum quam omnis unde.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"A corporis voluptate quibusdam quis. Omnis quia minus commodi. Consequatur quos repudiandae deleniti est.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Distinctio voluptates velit quas quo quia cum commodi. Sit est blanditiis aspernatur dolore a. Harum vitae harum laboriosam dolores et et nulla.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Facere sit vitae ea dolorem tempore et. Autem sed voluptas voluptas id voluptas et. Inventore autem id nobis nobis ex architecto.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Quia repellat culpa rerum nulla at eveniet. Cum vitae voluptatum temporibus voluptatem inventore. Quisquam maiores voluptatum ut voluptas recusandae.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Aut quisquam occaecati qui inventore commodi quia eum. Ullam eligendi sed sed aut voluptatem. Velit libero nemo iusto officiis aut.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Et neque et perferendis laudantium. Autem tempore eum et adipisci similique sunt iste. Qui quidem itaque nam ut.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Ducimus voluptate velit vitae ducimus dolorem vel tempore. Repellendus delectus magni labore est enim. Voluptatem quo molestias assumenda nisi.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Sint error debitis totam sint aut neque. Quis est debitis quidem autem voluptatem eveniet commodi ex. Facere a porro rerum neque tempore in natus.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Rerum aliquid aliquam nostrum. Dignissimos nobis atque enim qui exercitationem et distinctio. At ut est repellat molestias voluptatum.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Repellat provident saepe ipsa possimus. Facilis consequatur voluptatem impedit inventore rerum non. Veritatis sunt consectetur velit blanditiis.\"}]',6,'Botble\\Gallery\\Models\\Gallery','2024-08-26 21:25:57','2024-08-26 21:25:57'),(7,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Tenetur dolores et et ut. Ipsam aliquid minus consequatur at. Qui amet sapiente enim et possimus animi tenetur qui. Totam molestiae ex in.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Quod sequi deleniti qui rem voluptatem natus. Rerum et sunt totam nihil excepturi.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Voluptatem tempora in qui fugiat. Et voluptatum voluptatem quis id iste. Dolor perspiciatis sit et sit facere molestiae omnis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Dolorem et error sed. Veniam modi qui neque sed commodi eveniet recusandae. Voluptates error qui est nisi dolorem minus ratione.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Est qui nam soluta. Pariatur unde alias quae nulla libero. Quas debitis in eius aliquid qui dolorem culpa.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Iure minima ratione perspiciatis dolorum. In voluptatem in ea. Id et et quibusdam eos. Eius eum neque cupiditate rerum quia ad et.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Quis sit aut nesciunt quidem ut cupiditate. Autem qui molestias illo voluptas. Officiis iure ipsa eveniet alias nesciunt ipsum expedita.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Excepturi repudiandae quaerat similique nihil. Perspiciatis vel itaque qui nam sed occaecati quo. Eius sunt nostrum ut veniam quam.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea eveniet et enim numquam. Similique neque dolores officia possimus. Ullam voluptatem id et eveniet voluptas.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Voluptas iure et impedit eaque quasi. Sed harum quam omnis unde.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"A corporis voluptate quibusdam quis. Omnis quia minus commodi. Consequatur quos repudiandae deleniti est.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Distinctio voluptates velit quas quo quia cum commodi. Sit est blanditiis aspernatur dolore a. Harum vitae harum laboriosam dolores et et nulla.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Facere sit vitae ea dolorem tempore et. Autem sed voluptas voluptas id voluptas et. Inventore autem id nobis nobis ex architecto.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Quia repellat culpa rerum nulla at eveniet. Cum vitae voluptatum temporibus voluptatem inventore. Quisquam maiores voluptatum ut voluptas recusandae.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Aut quisquam occaecati qui inventore commodi quia eum. Ullam eligendi sed sed aut voluptatem. Velit libero nemo iusto officiis aut.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Et neque et perferendis laudantium. Autem tempore eum et adipisci similique sunt iste. Qui quidem itaque nam ut.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Ducimus voluptate velit vitae ducimus dolorem vel tempore. Repellendus delectus magni labore est enim. Voluptatem quo molestias assumenda nisi.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Sint error debitis totam sint aut neque. Quis est debitis quidem autem voluptatem eveniet commodi ex. Facere a porro rerum neque tempore in natus.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Rerum aliquid aliquam nostrum. Dignissimos nobis atque enim qui exercitationem et distinctio. At ut est repellat molestias voluptatum.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Repellat provident saepe ipsa possimus. Facilis consequatur voluptatem impedit inventore rerum non. Veritatis sunt consectetur velit blanditiis.\"}]',7,'Botble\\Gallery\\Models\\Gallery','2024-08-26 21:25:57','2024-08-26 21:25:57'),(8,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Tenetur dolores et et ut. Ipsam aliquid minus consequatur at. Qui amet sapiente enim et possimus animi tenetur qui. Totam molestiae ex in.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Quod sequi deleniti qui rem voluptatem natus. Rerum et sunt totam nihil excepturi.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Voluptatem tempora in qui fugiat. Et voluptatum voluptatem quis id iste. Dolor perspiciatis sit et sit facere molestiae omnis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Dolorem et error sed. Veniam modi qui neque sed commodi eveniet recusandae. Voluptates error qui est nisi dolorem minus ratione.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Est qui nam soluta. Pariatur unde alias quae nulla libero. Quas debitis in eius aliquid qui dolorem culpa.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Iure minima ratione perspiciatis dolorum. In voluptatem in ea. Id et et quibusdam eos. Eius eum neque cupiditate rerum quia ad et.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Quis sit aut nesciunt quidem ut cupiditate. Autem qui molestias illo voluptas. Officiis iure ipsa eveniet alias nesciunt ipsum expedita.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Excepturi repudiandae quaerat similique nihil. Perspiciatis vel itaque qui nam sed occaecati quo. Eius sunt nostrum ut veniam quam.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea eveniet et enim numquam. Similique neque dolores officia possimus. Ullam voluptatem id et eveniet voluptas.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Voluptas iure et impedit eaque quasi. Sed harum quam omnis unde.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"A corporis voluptate quibusdam quis. Omnis quia minus commodi. Consequatur quos repudiandae deleniti est.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Distinctio voluptates velit quas quo quia cum commodi. Sit est blanditiis aspernatur dolore a. Harum vitae harum laboriosam dolores et et nulla.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Facere sit vitae ea dolorem tempore et. Autem sed voluptas voluptas id voluptas et. Inventore autem id nobis nobis ex architecto.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Quia repellat culpa rerum nulla at eveniet. Cum vitae voluptatum temporibus voluptatem inventore. Quisquam maiores voluptatum ut voluptas recusandae.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Aut quisquam occaecati qui inventore commodi quia eum. Ullam eligendi sed sed aut voluptatem. Velit libero nemo iusto officiis aut.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Et neque et perferendis laudantium. Autem tempore eum et adipisci similique sunt iste. Qui quidem itaque nam ut.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Ducimus voluptate velit vitae ducimus dolorem vel tempore. Repellendus delectus magni labore est enim. Voluptatem quo molestias assumenda nisi.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Sint error debitis totam sint aut neque. Quis est debitis quidem autem voluptatem eveniet commodi ex. Facere a porro rerum neque tempore in natus.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Rerum aliquid aliquam nostrum. Dignissimos nobis atque enim qui exercitationem et distinctio. At ut est repellat molestias voluptatum.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Repellat provident saepe ipsa possimus. Facilis consequatur voluptatem impedit inventore rerum non. Veritatis sunt consectetur velit blanditiis.\"}]',8,'Botble\\Gallery\\Models\\Gallery','2024-08-26 21:25:57','2024-08-26 21:25:57'),(9,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Tenetur dolores et et ut. Ipsam aliquid minus consequatur at. Qui amet sapiente enim et possimus animi tenetur qui. Totam molestiae ex in.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Quod sequi deleniti qui rem voluptatem natus. Rerum et sunt totam nihil excepturi.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Voluptatem tempora in qui fugiat. Et voluptatum voluptatem quis id iste. Dolor perspiciatis sit et sit facere molestiae omnis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Dolorem et error sed. Veniam modi qui neque sed commodi eveniet recusandae. Voluptates error qui est nisi dolorem minus ratione.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Est qui nam soluta. Pariatur unde alias quae nulla libero. Quas debitis in eius aliquid qui dolorem culpa.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Iure minima ratione perspiciatis dolorum. In voluptatem in ea. Id et et quibusdam eos. Eius eum neque cupiditate rerum quia ad et.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Quis sit aut nesciunt quidem ut cupiditate. Autem qui molestias illo voluptas. Officiis iure ipsa eveniet alias nesciunt ipsum expedita.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Excepturi repudiandae quaerat similique nihil. Perspiciatis vel itaque qui nam sed occaecati quo. Eius sunt nostrum ut veniam quam.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea eveniet et enim numquam. Similique neque dolores officia possimus. Ullam voluptatem id et eveniet voluptas.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Voluptas iure et impedit eaque quasi. Sed harum quam omnis unde.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"A corporis voluptate quibusdam quis. Omnis quia minus commodi. Consequatur quos repudiandae deleniti est.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Distinctio voluptates velit quas quo quia cum commodi. Sit est blanditiis aspernatur dolore a. Harum vitae harum laboriosam dolores et et nulla.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Facere sit vitae ea dolorem tempore et. Autem sed voluptas voluptas id voluptas et. Inventore autem id nobis nobis ex architecto.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Quia repellat culpa rerum nulla at eveniet. Cum vitae voluptatum temporibus voluptatem inventore. Quisquam maiores voluptatum ut voluptas recusandae.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Aut quisquam occaecati qui inventore commodi quia eum. Ullam eligendi sed sed aut voluptatem. Velit libero nemo iusto officiis aut.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Et neque et perferendis laudantium. Autem tempore eum et adipisci similique sunt iste. Qui quidem itaque nam ut.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Ducimus voluptate velit vitae ducimus dolorem vel tempore. Repellendus delectus magni labore est enim. Voluptatem quo molestias assumenda nisi.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Sint error debitis totam sint aut neque. Quis est debitis quidem autem voluptatem eveniet commodi ex. Facere a porro rerum neque tempore in natus.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Rerum aliquid aliquam nostrum. Dignissimos nobis atque enim qui exercitationem et distinctio. At ut est repellat molestias voluptatum.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Repellat provident saepe ipsa possimus. Facilis consequatur voluptatem impedit inventore rerum non. Veritatis sunt consectetur velit blanditiis.\"}]',9,'Botble\\Gallery\\Models\\Gallery','2024-08-26 21:25:57','2024-08-26 21:25:57'),(10,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Tenetur dolores et et ut. Ipsam aliquid minus consequatur at. Qui amet sapiente enim et possimus animi tenetur qui. Totam molestiae ex in.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Quod sequi deleniti qui rem voluptatem natus. Rerum et sunt totam nihil excepturi.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Voluptatem tempora in qui fugiat. Et voluptatum voluptatem quis id iste. Dolor perspiciatis sit et sit facere molestiae omnis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Dolorem et error sed. Veniam modi qui neque sed commodi eveniet recusandae. Voluptates error qui est nisi dolorem minus ratione.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Est qui nam soluta. Pariatur unde alias quae nulla libero. Quas debitis in eius aliquid qui dolorem culpa.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Iure minima ratione perspiciatis dolorum. In voluptatem in ea. Id et et quibusdam eos. Eius eum neque cupiditate rerum quia ad et.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Quis sit aut nesciunt quidem ut cupiditate. Autem qui molestias illo voluptas. Officiis iure ipsa eveniet alias nesciunt ipsum expedita.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Excepturi repudiandae quaerat similique nihil. Perspiciatis vel itaque qui nam sed occaecati quo. Eius sunt nostrum ut veniam quam.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea eveniet et enim numquam. Similique neque dolores officia possimus. Ullam voluptatem id et eveniet voluptas.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Voluptas iure et impedit eaque quasi. Sed harum quam omnis unde.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"A corporis voluptate quibusdam quis. Omnis quia minus commodi. Consequatur quos repudiandae deleniti est.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Distinctio voluptates velit quas quo quia cum commodi. Sit est blanditiis aspernatur dolore a. Harum vitae harum laboriosam dolores et et nulla.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Facere sit vitae ea dolorem tempore et. Autem sed voluptas voluptas id voluptas et. Inventore autem id nobis nobis ex architecto.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Quia repellat culpa rerum nulla at eveniet. Cum vitae voluptatum temporibus voluptatem inventore. Quisquam maiores voluptatum ut voluptas recusandae.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Aut quisquam occaecati qui inventore commodi quia eum. Ullam eligendi sed sed aut voluptatem. Velit libero nemo iusto officiis aut.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Et neque et perferendis laudantium. Autem tempore eum et adipisci similique sunt iste. Qui quidem itaque nam ut.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Ducimus voluptate velit vitae ducimus dolorem vel tempore. Repellendus delectus magni labore est enim. Voluptatem quo molestias assumenda nisi.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Sint error debitis totam sint aut neque. Quis est debitis quidem autem voluptatem eveniet commodi ex. Facere a porro rerum neque tempore in natus.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Rerum aliquid aliquam nostrum. Dignissimos nobis atque enim qui exercitationem et distinctio. At ut est repellat molestias voluptatum.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Repellat provident saepe ipsa possimus. Facilis consequatur voluptatem impedit inventore rerum non. Veritatis sunt consectetur velit blanditiis.\"}]',10,'Botble\\Gallery\\Models\\Gallery','2024-08-26 21:25:57','2024-08-26 21:25:57'),(11,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Tenetur dolores et et ut. Ipsam aliquid minus consequatur at. Qui amet sapiente enim et possimus animi tenetur qui. Totam molestiae ex in.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Quod sequi deleniti qui rem voluptatem natus. Rerum et sunt totam nihil excepturi.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Voluptatem tempora in qui fugiat. Et voluptatum voluptatem quis id iste. Dolor perspiciatis sit et sit facere molestiae omnis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Dolorem et error sed. Veniam modi qui neque sed commodi eveniet recusandae. Voluptates error qui est nisi dolorem minus ratione.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Est qui nam soluta. Pariatur unde alias quae nulla libero. Quas debitis in eius aliquid qui dolorem culpa.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Iure minima ratione perspiciatis dolorum. In voluptatem in ea. Id et et quibusdam eos. Eius eum neque cupiditate rerum quia ad et.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Quis sit aut nesciunt quidem ut cupiditate. Autem qui molestias illo voluptas. Officiis iure ipsa eveniet alias nesciunt ipsum expedita.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Excepturi repudiandae quaerat similique nihil. Perspiciatis vel itaque qui nam sed occaecati quo. Eius sunt nostrum ut veniam quam.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea eveniet et enim numquam. Similique neque dolores officia possimus. Ullam voluptatem id et eveniet voluptas.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Voluptas iure et impedit eaque quasi. Sed harum quam omnis unde.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"A corporis voluptate quibusdam quis. Omnis quia minus commodi. Consequatur quos repudiandae deleniti est.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Distinctio voluptates velit quas quo quia cum commodi. Sit est blanditiis aspernatur dolore a. Harum vitae harum laboriosam dolores et et nulla.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Facere sit vitae ea dolorem tempore et. Autem sed voluptas voluptas id voluptas et. Inventore autem id nobis nobis ex architecto.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Quia repellat culpa rerum nulla at eveniet. Cum vitae voluptatum temporibus voluptatem inventore. Quisquam maiores voluptatum ut voluptas recusandae.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Aut quisquam occaecati qui inventore commodi quia eum. Ullam eligendi sed sed aut voluptatem. Velit libero nemo iusto officiis aut.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Et neque et perferendis laudantium. Autem tempore eum et adipisci similique sunt iste. Qui quidem itaque nam ut.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Ducimus voluptate velit vitae ducimus dolorem vel tempore. Repellendus delectus magni labore est enim. Voluptatem quo molestias assumenda nisi.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Sint error debitis totam sint aut neque. Quis est debitis quidem autem voluptatem eveniet commodi ex. Facere a porro rerum neque tempore in natus.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Rerum aliquid aliquam nostrum. Dignissimos nobis atque enim qui exercitationem et distinctio. At ut est repellat molestias voluptatum.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Repellat provident saepe ipsa possimus. Facilis consequatur voluptatem impedit inventore rerum non. Veritatis sunt consectetur velit blanditiis.\"}]',11,'Botble\\Gallery\\Models\\Gallery','2024-08-26 21:25:57','2024-08-26 21:25:57'),(12,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Tenetur dolores et et ut. Ipsam aliquid minus consequatur at. Qui amet sapiente enim et possimus animi tenetur qui. Totam molestiae ex in.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Quod sequi deleniti qui rem voluptatem natus. Rerum et sunt totam nihil excepturi.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Voluptatem tempora in qui fugiat. Et voluptatum voluptatem quis id iste. Dolor perspiciatis sit et sit facere molestiae omnis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Dolorem et error sed. Veniam modi qui neque sed commodi eveniet recusandae. Voluptates error qui est nisi dolorem minus ratione.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Est qui nam soluta. Pariatur unde alias quae nulla libero. Quas debitis in eius aliquid qui dolorem culpa.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Iure minima ratione perspiciatis dolorum. In voluptatem in ea. Id et et quibusdam eos. Eius eum neque cupiditate rerum quia ad et.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Quis sit aut nesciunt quidem ut cupiditate. Autem qui molestias illo voluptas. Officiis iure ipsa eveniet alias nesciunt ipsum expedita.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Excepturi repudiandae quaerat similique nihil. Perspiciatis vel itaque qui nam sed occaecati quo. Eius sunt nostrum ut veniam quam.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea eveniet et enim numquam. Similique neque dolores officia possimus. Ullam voluptatem id et eveniet voluptas.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Voluptas iure et impedit eaque quasi. Sed harum quam omnis unde.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"A corporis voluptate quibusdam quis. Omnis quia minus commodi. Consequatur quos repudiandae deleniti est.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Distinctio voluptates velit quas quo quia cum commodi. Sit est blanditiis aspernatur dolore a. Harum vitae harum laboriosam dolores et et nulla.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Facere sit vitae ea dolorem tempore et. Autem sed voluptas voluptas id voluptas et. Inventore autem id nobis nobis ex architecto.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Quia repellat culpa rerum nulla at eveniet. Cum vitae voluptatum temporibus voluptatem inventore. Quisquam maiores voluptatum ut voluptas recusandae.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Aut quisquam occaecati qui inventore commodi quia eum. Ullam eligendi sed sed aut voluptatem. Velit libero nemo iusto officiis aut.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Et neque et perferendis laudantium. Autem tempore eum et adipisci similique sunt iste. Qui quidem itaque nam ut.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Ducimus voluptate velit vitae ducimus dolorem vel tempore. Repellendus delectus magni labore est enim. Voluptatem quo molestias assumenda nisi.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Sint error debitis totam sint aut neque. Quis est debitis quidem autem voluptatem eveniet commodi ex. Facere a porro rerum neque tempore in natus.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Rerum aliquid aliquam nostrum. Dignissimos nobis atque enim qui exercitationem et distinctio. At ut est repellat molestias voluptatum.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Repellat provident saepe ipsa possimus. Facilis consequatur voluptatem impedit inventore rerum non. Veritatis sunt consectetur velit blanditiis.\"}]',12,'Botble\\Gallery\\Models\\Gallery','2024-08-26 21:25:57','2024-08-26 21:25:57'),(13,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Tenetur dolores et et ut. Ipsam aliquid minus consequatur at. Qui amet sapiente enim et possimus animi tenetur qui. Totam molestiae ex in.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Quod sequi deleniti qui rem voluptatem natus. Rerum et sunt totam nihil excepturi.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Voluptatem tempora in qui fugiat. Et voluptatum voluptatem quis id iste. Dolor perspiciatis sit et sit facere molestiae omnis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Dolorem et error sed. Veniam modi qui neque sed commodi eveniet recusandae. Voluptates error qui est nisi dolorem minus ratione.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Est qui nam soluta. Pariatur unde alias quae nulla libero. Quas debitis in eius aliquid qui dolorem culpa.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Iure minima ratione perspiciatis dolorum. In voluptatem in ea. Id et et quibusdam eos. Eius eum neque cupiditate rerum quia ad et.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Quis sit aut nesciunt quidem ut cupiditate. Autem qui molestias illo voluptas. Officiis iure ipsa eveniet alias nesciunt ipsum expedita.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Excepturi repudiandae quaerat similique nihil. Perspiciatis vel itaque qui nam sed occaecati quo. Eius sunt nostrum ut veniam quam.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea eveniet et enim numquam. Similique neque dolores officia possimus. Ullam voluptatem id et eveniet voluptas.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Voluptas iure et impedit eaque quasi. Sed harum quam omnis unde.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"A corporis voluptate quibusdam quis. Omnis quia minus commodi. Consequatur quos repudiandae deleniti est.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Distinctio voluptates velit quas quo quia cum commodi. Sit est blanditiis aspernatur dolore a. Harum vitae harum laboriosam dolores et et nulla.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Facere sit vitae ea dolorem tempore et. Autem sed voluptas voluptas id voluptas et. Inventore autem id nobis nobis ex architecto.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Quia repellat culpa rerum nulla at eveniet. Cum vitae voluptatum temporibus voluptatem inventore. Quisquam maiores voluptatum ut voluptas recusandae.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Aut quisquam occaecati qui inventore commodi quia eum. Ullam eligendi sed sed aut voluptatem. Velit libero nemo iusto officiis aut.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Et neque et perferendis laudantium. Autem tempore eum et adipisci similique sunt iste. Qui quidem itaque nam ut.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Ducimus voluptate velit vitae ducimus dolorem vel tempore. Repellendus delectus magni labore est enim. Voluptatem quo molestias assumenda nisi.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Sint error debitis totam sint aut neque. Quis est debitis quidem autem voluptatem eveniet commodi ex. Facere a porro rerum neque tempore in natus.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Rerum aliquid aliquam nostrum. Dignissimos nobis atque enim qui exercitationem et distinctio. At ut est repellat molestias voluptatum.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Repellat provident saepe ipsa possimus. Facilis consequatur voluptatem impedit inventore rerum non. Veritatis sunt consectetur velit blanditiis.\"}]',13,'Botble\\Gallery\\Models\\Gallery','2024-08-26 21:25:57','2024-08-26 21:25:57'),(14,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Tenetur dolores et et ut. Ipsam aliquid minus consequatur at. Qui amet sapiente enim et possimus animi tenetur qui. Totam molestiae ex in.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Quod sequi deleniti qui rem voluptatem natus. Rerum et sunt totam nihil excepturi.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Voluptatem tempora in qui fugiat. Et voluptatum voluptatem quis id iste. Dolor perspiciatis sit et sit facere molestiae omnis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Dolorem et error sed. Veniam modi qui neque sed commodi eveniet recusandae. Voluptates error qui est nisi dolorem minus ratione.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Est qui nam soluta. Pariatur unde alias quae nulla libero. Quas debitis in eius aliquid qui dolorem culpa.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Iure minima ratione perspiciatis dolorum. In voluptatem in ea. Id et et quibusdam eos. Eius eum neque cupiditate rerum quia ad et.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Quis sit aut nesciunt quidem ut cupiditate. Autem qui molestias illo voluptas. Officiis iure ipsa eveniet alias nesciunt ipsum expedita.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Excepturi repudiandae quaerat similique nihil. Perspiciatis vel itaque qui nam sed occaecati quo. Eius sunt nostrum ut veniam quam.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea eveniet et enim numquam. Similique neque dolores officia possimus. Ullam voluptatem id et eveniet voluptas.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Voluptas iure et impedit eaque quasi. Sed harum quam omnis unde.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"A corporis voluptate quibusdam quis. Omnis quia minus commodi. Consequatur quos repudiandae deleniti est.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Distinctio voluptates velit quas quo quia cum commodi. Sit est blanditiis aspernatur dolore a. Harum vitae harum laboriosam dolores et et nulla.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Facere sit vitae ea dolorem tempore et. Autem sed voluptas voluptas id voluptas et. Inventore autem id nobis nobis ex architecto.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Quia repellat culpa rerum nulla at eveniet. Cum vitae voluptatum temporibus voluptatem inventore. Quisquam maiores voluptatum ut voluptas recusandae.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Aut quisquam occaecati qui inventore commodi quia eum. Ullam eligendi sed sed aut voluptatem. Velit libero nemo iusto officiis aut.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Et neque et perferendis laudantium. Autem tempore eum et adipisci similique sunt iste. Qui quidem itaque nam ut.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Ducimus voluptate velit vitae ducimus dolorem vel tempore. Repellendus delectus magni labore est enim. Voluptatem quo molestias assumenda nisi.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Sint error debitis totam sint aut neque. Quis est debitis quidem autem voluptatem eveniet commodi ex. Facere a porro rerum neque tempore in natus.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Rerum aliquid aliquam nostrum. Dignissimos nobis atque enim qui exercitationem et distinctio. At ut est repellat molestias voluptatum.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Repellat provident saepe ipsa possimus. Facilis consequatur voluptatem impedit inventore rerum non. Veritatis sunt consectetur velit blanditiis.\"}]',14,'Botble\\Gallery\\Models\\Gallery','2024-08-26 21:25:57','2024-08-26 21:25:57'),(15,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Tenetur dolores et et ut. Ipsam aliquid minus consequatur at. Qui amet sapiente enim et possimus animi tenetur qui. Totam molestiae ex in.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Quod sequi deleniti qui rem voluptatem natus. Rerum et sunt totam nihil excepturi.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Voluptatem tempora in qui fugiat. Et voluptatum voluptatem quis id iste. Dolor perspiciatis sit et sit facere molestiae omnis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Dolorem et error sed. Veniam modi qui neque sed commodi eveniet recusandae. Voluptates error qui est nisi dolorem minus ratione.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Est qui nam soluta. Pariatur unde alias quae nulla libero. Quas debitis in eius aliquid qui dolorem culpa.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Iure minima ratione perspiciatis dolorum. In voluptatem in ea. Id et et quibusdam eos. Eius eum neque cupiditate rerum quia ad et.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Quis sit aut nesciunt quidem ut cupiditate. Autem qui molestias illo voluptas. Officiis iure ipsa eveniet alias nesciunt ipsum expedita.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Excepturi repudiandae quaerat similique nihil. Perspiciatis vel itaque qui nam sed occaecati quo. Eius sunt nostrum ut veniam quam.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea eveniet et enim numquam. Similique neque dolores officia possimus. Ullam voluptatem id et eveniet voluptas.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Voluptas iure et impedit eaque quasi. Sed harum quam omnis unde.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"A corporis voluptate quibusdam quis. Omnis quia minus commodi. Consequatur quos repudiandae deleniti est.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Distinctio voluptates velit quas quo quia cum commodi. Sit est blanditiis aspernatur dolore a. Harum vitae harum laboriosam dolores et et nulla.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Facere sit vitae ea dolorem tempore et. Autem sed voluptas voluptas id voluptas et. Inventore autem id nobis nobis ex architecto.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Quia repellat culpa rerum nulla at eveniet. Cum vitae voluptatum temporibus voluptatem inventore. Quisquam maiores voluptatum ut voluptas recusandae.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Aut quisquam occaecati qui inventore commodi quia eum. Ullam eligendi sed sed aut voluptatem. Velit libero nemo iusto officiis aut.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Et neque et perferendis laudantium. Autem tempore eum et adipisci similique sunt iste. Qui quidem itaque nam ut.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Ducimus voluptate velit vitae ducimus dolorem vel tempore. Repellendus delectus magni labore est enim. Voluptatem quo molestias assumenda nisi.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Sint error debitis totam sint aut neque. Quis est debitis quidem autem voluptatem eveniet commodi ex. Facere a porro rerum neque tempore in natus.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Rerum aliquid aliquam nostrum. Dignissimos nobis atque enim qui exercitationem et distinctio. At ut est repellat molestias voluptatum.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Repellat provident saepe ipsa possimus. Facilis consequatur voluptatem impedit inventore rerum non. Veritatis sunt consectetur velit blanditiis.\"}]',15,'Botble\\Gallery\\Models\\Gallery','2024-08-26 21:25:57','2024-08-26 21:25:57');
/*!40000 ALTER TABLE `gallery_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_meta_translations`
--

DROP TABLE IF EXISTS `gallery_meta_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery_meta_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_meta_id` bigint unsigned NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`gallery_meta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_meta_translations`
--

LOCK TABLES `gallery_meta_translations` WRITE;
/*!40000 ALTER TABLE `gallery_meta_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `gallery_meta_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
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
-- Table structure for table `language_meta`
--

DROP TABLE IF EXISTS `language_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `language_meta` (
  `lang_meta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lang_meta_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_meta_origin` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`lang_meta_id`),
  KEY `language_meta_reference_id_index` (`reference_id`),
  KEY `meta_code_index` (`lang_meta_code`),
  KEY `meta_origin_index` (`lang_meta_origin`),
  KEY `meta_reference_type_index` (`reference_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language_meta`
--

LOCK TABLES `language_meta` WRITE;
/*!40000 ALTER TABLE `language_meta` DISABLE KEYS */;
INSERT INTO `language_meta` VALUES (1,'en_US','60d1bea579781478bdf601148b329897',1,'Botble\\Menu\\Models\\MenuLocation'),(2,'en_US','19231f818dfea4a457f78dd9551cca2d',1,'Botble\\Menu\\Models\\Menu'),(3,'en_US','00ef3aca5470ba886b73a2b39e8799b6',2,'Botble\\Menu\\Models\\Menu');
/*!40000 ALTER TABLE `language_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `lang_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_locale` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_flag` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `lang_order` int NOT NULL DEFAULT '0',
  `lang_is_rtl` tinyint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  KEY `lang_locale_index` (`lang_locale`),
  KEY `lang_code_index` (`lang_code`),
  KEY `lang_is_default_index` (`lang_is_default`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'English','en','en_US','us',1,0,0);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_files`
--

DROP TABLE IF EXISTS `media_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder_id` bigint unsigned NOT NULL DEFAULT '0',
  `mime_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `visibility` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  PRIMARY KEY (`id`),
  KEY `media_files_user_id_index` (`user_id`),
  KEY `media_files_index` (`folder_id`,`user_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_files`
--

LOCK TABLES `media_files` WRITE;
/*!40000 ALTER TABLE `media_files` DISABLE KEYS */;
INSERT INTO `media_files` VALUES (1,0,'1','1',1,'image/jpeg',9803,'news/1.jpg','[]','2024-08-26 21:25:55','2024-08-26 21:25:55',NULL,'public'),(2,0,'10','10',1,'image/jpeg',9803,'news/10.jpg','[]','2024-08-26 21:25:55','2024-08-26 21:25:55',NULL,'public'),(3,0,'11','11',1,'image/jpeg',9803,'news/11.jpg','[]','2024-08-26 21:25:55','2024-08-26 21:25:55',NULL,'public'),(4,0,'12','12',1,'image/jpeg',9803,'news/12.jpg','[]','2024-08-26 21:25:55','2024-08-26 21:25:55',NULL,'public'),(5,0,'13','13',1,'image/jpeg',9803,'news/13.jpg','[]','2024-08-26 21:25:55','2024-08-26 21:25:55',NULL,'public'),(6,0,'14','14',1,'image/jpeg',9803,'news/14.jpg','[]','2024-08-26 21:25:55','2024-08-26 21:25:55',NULL,'public'),(7,0,'15','15',1,'image/jpeg',9803,'news/15.jpg','[]','2024-08-26 21:25:55','2024-08-26 21:25:55',NULL,'public'),(8,0,'16','16',1,'image/jpeg',9803,'news/16.jpg','[]','2024-08-26 21:25:55','2024-08-26 21:25:55',NULL,'public'),(9,0,'17','17',1,'image/jpeg',9803,'news/17.jpg','[]','2024-08-26 21:25:55','2024-08-26 21:25:55',NULL,'public'),(10,0,'18','18',1,'image/jpeg',9803,'news/18.jpg','[]','2024-08-26 21:25:55','2024-08-26 21:25:55',NULL,'public'),(11,0,'19','19',1,'image/jpeg',9803,'news/19.jpg','[]','2024-08-26 21:25:55','2024-08-26 21:25:55',NULL,'public'),(12,0,'2','2',1,'image/jpeg',9803,'news/2.jpg','[]','2024-08-26 21:25:55','2024-08-26 21:25:55',NULL,'public'),(13,0,'20','20',1,'image/jpeg',9803,'news/20.jpg','[]','2024-08-26 21:25:55','2024-08-26 21:25:55',NULL,'public'),(14,0,'3','3',1,'image/jpeg',9803,'news/3.jpg','[]','2024-08-26 21:25:56','2024-08-26 21:25:56',NULL,'public'),(15,0,'4','4',1,'image/jpeg',9803,'news/4.jpg','[]','2024-08-26 21:25:56','2024-08-26 21:25:56',NULL,'public'),(16,0,'5','5',1,'image/jpeg',9803,'news/5.jpg','[]','2024-08-26 21:25:56','2024-08-26 21:25:56',NULL,'public'),(17,0,'6','6',1,'image/jpeg',9803,'news/6.jpg','[]','2024-08-26 21:25:56','2024-08-26 21:25:56',NULL,'public'),(18,0,'7','7',1,'image/jpeg',9803,'news/7.jpg','[]','2024-08-26 21:25:56','2024-08-26 21:25:56',NULL,'public'),(19,0,'8','8',1,'image/jpeg',9803,'news/8.jpg','[]','2024-08-26 21:25:56','2024-08-26 21:25:56',NULL,'public'),(20,0,'9','9',1,'image/jpeg',9803,'news/9.jpg','[]','2024-08-26 21:25:56','2024-08-26 21:25:56',NULL,'public'),(21,0,'1','1',2,'image/jpeg',9803,'members/1.jpg','[]','2024-08-26 21:25:57','2024-08-26 21:25:57',NULL,'public'),(22,0,'10','10',2,'image/jpeg',9803,'members/10.jpg','[]','2024-08-26 21:25:57','2024-08-26 21:25:57',NULL,'public'),(23,0,'11','11',2,'image/png',9803,'members/11.png','[]','2024-08-26 21:25:57','2024-08-26 21:25:57',NULL,'public'),(24,0,'2','2',2,'image/jpeg',9803,'members/2.jpg','[]','2024-08-26 21:25:57','2024-08-26 21:25:57',NULL,'public'),(25,0,'3','3',2,'image/jpeg',9803,'members/3.jpg','[]','2024-08-26 21:25:57','2024-08-26 21:25:57',NULL,'public'),(26,0,'4','4',2,'image/jpeg',9803,'members/4.jpg','[]','2024-08-26 21:25:57','2024-08-26 21:25:57',NULL,'public'),(27,0,'5','5',2,'image/jpeg',9803,'members/5.jpg','[]','2024-08-26 21:25:57','2024-08-26 21:25:57',NULL,'public'),(28,0,'6','6',2,'image/jpeg',9803,'members/6.jpg','[]','2024-08-26 21:25:58','2024-08-26 21:25:58',NULL,'public'),(29,0,'7','7',2,'image/jpeg',9803,'members/7.jpg','[]','2024-08-26 21:25:58','2024-08-26 21:25:58',NULL,'public'),(30,0,'8','8',2,'image/jpeg',9803,'members/8.jpg','[]','2024-08-26 21:25:58','2024-08-26 21:25:58',NULL,'public'),(31,0,'9','9',2,'image/jpeg',9803,'members/9.jpg','[]','2024-08-26 21:25:58','2024-08-26 21:25:58',NULL,'public'),(32,0,'favicon','favicon',3,'image/png',1122,'general/favicon.png','[]','2024-08-26 21:26:01','2024-08-26 21:26:01',NULL,'public'),(33,0,'logo','logo',3,'image/png',55709,'general/logo.png','[]','2024-08-26 21:26:01','2024-08-26 21:26:01',NULL,'public'),(34,0,'preloader','preloader',3,'image/gif',189758,'general/preloader.gif','[]','2024-08-26 21:26:02','2024-08-26 21:26:02',NULL,'public');
/*!40000 ALTER TABLE `media_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_folders`
--

DROP TABLE IF EXISTS `media_folders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media_folders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_folders_user_id_index` (`user_id`),
  KEY `media_folders_index` (`parent_id`,`user_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_folders`
--

LOCK TABLES `media_folders` WRITE;
/*!40000 ALTER TABLE `media_folders` DISABLE KEYS */;
INSERT INTO `media_folders` VALUES (1,0,'news',NULL,'news',0,'2024-08-26 21:25:54','2024-08-26 21:25:54',NULL),(2,0,'members',NULL,'members',0,'2024-08-26 21:25:57','2024-08-26 21:25:57',NULL),(3,0,'general',NULL,'general',0,'2024-08-26 21:26:01','2024-08-26 21:26:01',NULL);
/*!40000 ALTER TABLE `media_folders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_settings`
--

DROP TABLE IF EXISTS `media_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `media_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_settings`
--

LOCK TABLES `media_settings` WRITE;
/*!40000 ALTER TABLE `media_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `media_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_activity_logs`
--

DROP TABLE IF EXISTS `member_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member_activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `reference_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_activity_logs_member_id_index` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_activity_logs`
--

LOCK TABLES `member_activity_logs` WRITE;
/*!40000 ALTER TABLE `member_activity_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_password_resets`
--

DROP TABLE IF EXISTS `member_password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `member_password_resets_email_index` (`email`),
  KEY `member_password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_password_resets`
--

LOCK TABLES `member_password_resets` WRITE;
/*!40000 ALTER TABLE `member_password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_id` bigint unsigned DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `email_verify_token` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  PRIMARY KEY (`id`),
  UNIQUE KEY `members_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'Payton','Welch',NULL,NULL,'member@gmail.com','$2y$12$CFcAgYK8gS9jp84o6elYZ.Y2zRSSApYMx1axpSI6YOYJi0WSW2ZbK',21,NULL,NULL,'2024-08-27 04:25:58',NULL,NULL,'2024-08-26 21:25:58','2024-08-26 21:25:58','published'),(2,'Helga','Marks',NULL,NULL,'dillon.terry@hotmail.com','$2y$12$A04VwMhE0rtoMOUw1r9.L.KJE1KaPDO8YPzMZ.yhQJrW0409RyI1y',22,NULL,NULL,'2024-08-27 04:25:58',NULL,NULL,'2024-08-26 21:25:58','2024-08-26 21:25:58','published'),(3,'Maximo','Weimann',NULL,NULL,'monty.kirlin@kertzmann.info','$2y$12$7luANWq1g/KqO93XXmx9Wu7XBYAlTZMTrCFyWJrEdfuvvbZhGtWbi',23,NULL,NULL,'2024-08-27 04:25:58',NULL,NULL,'2024-08-26 21:25:58','2024-08-26 21:25:58','published'),(4,'Darien','Kilback',NULL,NULL,'greenholt.lisette@aufderhar.com','$2y$12$tl6PpD04TZcNJlOcKKJFVuZ.2fZBWXQJTCzk0kExnrvN0ts7k8QJK',24,NULL,NULL,'2024-08-27 04:25:58',NULL,NULL,'2024-08-26 21:25:58','2024-08-26 21:25:58','published'),(5,'Sheldon','Lakin',NULL,NULL,'roob.beryl@gmail.com','$2y$12$B1p0dpF9fEyiWFDf8kF9Nu3tgEORyIF2VxuIOW/6cKQ.rDhJFDvfu',25,NULL,NULL,'2024-08-27 04:25:58',NULL,NULL,'2024-08-26 21:25:58','2024-08-26 21:25:58','published'),(6,'Bud','Wuckert',NULL,NULL,'joshua.daniel@yahoo.com','$2y$12$/23H1No5fSrxHfhxIrnfsekLaVvoJpU7p9Cd1NJrqv.VkiPBPROBG',26,NULL,NULL,'2024-08-27 04:25:58',NULL,NULL,'2024-08-26 21:25:58','2024-08-26 21:25:58','published'),(7,'Casandra','Schultz',NULL,NULL,'gschultz@zemlak.com','$2y$12$q9wR6k8zoE9QY1Z.QAQJ2.isblIUADd8POTIxQSHaXJOBwhwUOQG.',27,NULL,NULL,'2024-08-27 04:25:58',NULL,NULL,'2024-08-26 21:25:58','2024-08-26 21:25:58','published'),(8,'Joshua','Bernhard',NULL,NULL,'runte.anita@jacobi.com','$2y$12$eLakCwbJc0MJ.ilRs8EzSuUAI2adggNK/cQEk/uJMq2OjSN9O.nsi',28,NULL,NULL,'2024-08-27 04:25:58',NULL,NULL,'2024-08-26 21:25:58','2024-08-26 21:25:58','published'),(9,'Sophie','Stracke',NULL,NULL,'zackery13@kuhic.info','$2y$12$UXFthSIUewQZ02rtzrxTaOlLhe1S5CkcFv9s2rPNL.dcsbCC0dcl.',29,NULL,NULL,'2024-08-27 04:25:58',NULL,NULL,'2024-08-26 21:25:58','2024-08-26 21:25:58','published'),(10,'Marcia','Bartell',NULL,NULL,'ruecker.karley@hotmail.com','$2y$12$zdm7lA7Y9DEfdTvIxb1YLOrB36k55pw0KBzRHLOhn5H2J0y8Vgut6',30,NULL,NULL,'2024-08-27 04:25:58',NULL,NULL,'2024-08-26 21:25:58','2024-08-26 21:25:58','published'),(11,'John','Smith',NULL,NULL,'john.smith@botble.com','$2y$12$6JIwWyxmLyozAzX7sJ72NunhjD4.0PsXXVgym00VIDEiRLU24ba/W',31,NULL,NULL,'2024-08-27 04:25:58',NULL,NULL,'2024-08-26 21:25:58','2024-08-26 21:25:58','published');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_locations`
--

DROP TABLE IF EXISTS `menu_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_locations_menu_id_created_at_index` (`menu_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_locations`
--

LOCK TABLES `menu_locations` WRITE;
/*!40000 ALTER TABLE `menu_locations` DISABLE KEYS */;
INSERT INTO `menu_locations` VALUES (1,1,'main-menu','2024-08-26 21:26:01','2024-08-26 21:26:01');
/*!40000 ALTER TABLE `menu_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_nodes`
--

DROP TABLE IF EXISTS `menu_nodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_nodes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `reference_id` bigint unsigned DEFAULT NULL,
  `reference_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_font` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` tinyint unsigned NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `has_child` tinyint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_nodes_menu_id_index` (`menu_id`),
  KEY `menu_nodes_parent_id_index` (`parent_id`),
  KEY `reference_id` (`reference_id`),
  KEY `reference_type` (`reference_type`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_nodes`
--

LOCK TABLES `menu_nodes` WRITE;
/*!40000 ALTER TABLE `menu_nodes` DISABLE KEYS */;
INSERT INTO `menu_nodes` VALUES (1,1,0,NULL,NULL,'/',NULL,0,'Home',NULL,'_self',0,'2024-08-26 21:26:01','2024-08-26 21:26:01'),(2,1,0,NULL,NULL,'https://botble.com/go/download-cms',NULL,0,'Purchase',NULL,'_blank',0,'2024-08-26 21:26:01','2024-08-26 21:26:01'),(3,1,0,2,'Botble\\Page\\Models\\Page','/blog',NULL,0,'Blog',NULL,'_self',0,'2024-08-26 21:26:01','2024-08-26 21:26:01'),(4,1,0,5,'Botble\\Page\\Models\\Page','/galleries',NULL,0,'Galleries',NULL,'_self',0,'2024-08-26 21:26:01','2024-08-26 21:26:01'),(5,1,0,3,'Botble\\Page\\Models\\Page','/contact',NULL,0,'Contact',NULL,'_self',0,'2024-08-26 21:26:01','2024-08-26 21:26:01'),(6,2,0,NULL,NULL,'https://facebook.com','ti ti-brand-facebook',1,'Facebook',NULL,'_blank',0,'2024-08-26 21:26:01','2024-08-26 21:26:01'),(7,2,0,NULL,NULL,'https://twitter.com','ti ti-brand-x',1,'Twitter',NULL,'_blank',0,'2024-08-26 21:26:01','2024-08-26 21:26:01'),(8,2,0,NULL,NULL,'https://github.com','ti ti-brand-github',1,'GitHub',NULL,'_blank',0,'2024-08-26 21:26:01','2024-08-26 21:26:01'),(9,2,0,NULL,NULL,'https://linkedin.com','ti ti-brand-linkedin',1,'Linkedin',NULL,'_blank',0,'2024-08-26 21:26:01','2024-08-26 21:26:01');
/*!40000 ALTER TABLE `menu_nodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Main menu','main-menu','published','2024-08-26 21:26:01','2024-08-26 21:26:01'),(2,'Social','social','published','2024-08-26 21:26:01','2024-08-26 21:26:01');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta_boxes`
--

DROP TABLE IF EXISTS `meta_boxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meta_boxes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_boxes_reference_id_index` (`reference_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta_boxes`
--

LOCK TABLES `meta_boxes` WRITE;
/*!40000 ALTER TABLE `meta_boxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `meta_boxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2013_04_09_032329_create_base_tables',1),(2,'2013_04_09_062329_create_revisions_table',1),(3,'2014_10_12_000000_create_users_table',1),(4,'2014_10_12_100000_create_password_reset_tokens_table',1),(5,'2016_06_10_230148_create_acl_tables',1),(6,'2016_06_14_230857_create_menus_table',1),(7,'2016_06_28_221418_create_pages_table',1),(8,'2016_10_05_074239_create_setting_table',1),(9,'2016_11_28_032840_create_dashboard_widget_tables',1),(10,'2016_12_16_084601_create_widgets_table',1),(11,'2017_05_09_070343_create_media_tables',1),(12,'2017_11_03_070450_create_slug_table',1),(13,'2019_01_05_053554_create_jobs_table',1),(14,'2019_08_19_000000_create_failed_jobs_table',1),(15,'2019_12_14_000001_create_personal_access_tokens_table',1),(16,'2022_04_20_100851_add_index_to_media_table',1),(17,'2022_04_20_101046_add_index_to_menu_table',1),(18,'2022_07_10_034813_move_lang_folder_to_root',1),(19,'2022_08_04_051940_add_missing_column_expires_at',1),(20,'2022_09_01_000001_create_admin_notifications_tables',1),(21,'2022_10_14_024629_drop_column_is_featured',1),(22,'2022_11_18_063357_add_missing_timestamp_in_table_settings',1),(23,'2022_12_02_093615_update_slug_index_columns',1),(24,'2023_01_30_024431_add_alt_to_media_table',1),(25,'2023_02_16_042611_drop_table_password_resets',1),(26,'2023_04_23_005903_add_column_permissions_to_admin_notifications',1),(27,'2023_05_10_075124_drop_column_id_in_role_users_table',1),(28,'2023_08_21_090810_make_page_content_nullable',1),(29,'2023_09_14_021936_update_index_for_slugs_table',1),(30,'2023_12_07_095130_add_color_column_to_media_folders_table',1),(31,'2023_12_17_162208_make_sure_column_color_in_media_folders_nullable',1),(32,'2024_04_04_110758_update_value_column_in_user_meta_table',1),(33,'2024_05_12_091229_add_column_visibility_to_table_media_files',1),(34,'2024_07_07_091316_fix_column_url_in_menu_nodes_table',1),(35,'2024_07_12_100000_change_random_hash_for_media',1),(36,'2024_04_27_100730_improve_analytics_setting',2),(37,'2015_06_29_025744_create_audit_history',3),(38,'2023_11_14_033417_change_request_column_in_table_audit_histories',3),(39,'2017_02_13_034601_create_blocks_table',4),(40,'2021_12_03_081327_create_blocks_translations',4),(41,'2015_06_18_033822_create_blog_table',5),(42,'2021_02_16_092633_remove_default_value_for_author_type',5),(43,'2021_12_03_030600_create_blog_translations',5),(44,'2022_04_19_113923_add_index_to_table_posts',5),(45,'2023_08_29_074620_make_column_author_id_nullable',5),(46,'2024_07_30_091615_fix_order_column_in_categories_table',5),(47,'2016_06_17_091537_create_contacts_table',6),(48,'2023_11_10_080225_migrate_contact_blacklist_email_domains_to_core',6),(49,'2024_03_20_080001_migrate_change_attribute_email_to_nullable_form_contacts_table',6),(50,'2024_03_25_000001_update_captcha_settings_for_contact',6),(51,'2024_04_19_063914_create_custom_fields_table',6),(52,'2017_03_27_150646_re_create_custom_field_tables',7),(53,'2022_04_30_030807_table_custom_fields_translation_table',7),(54,'2016_10_13_150201_create_galleries_table',8),(55,'2021_12_03_082953_create_gallery_translations',8),(56,'2022_04_30_034048_create_gallery_meta_translations_table',8),(57,'2023_08_29_075308_make_column_user_id_nullable',8),(58,'2016_10_03_032336_create_languages_table',9),(59,'2023_09_14_022423_add_index_for_language_table',9),(60,'2021_10_25_021023_fix-priority-load-for-language-advanced',10),(61,'2021_12_03_075608_create_page_translations',10),(62,'2023_07_06_011444_create_slug_translations_table',10),(63,'2017_10_04_140938_create_member_table',11),(64,'2023_10_16_075332_add_status_column',11),(65,'2024_03_25_000001_update_captcha_settings',11),(66,'2016_05_28_112028_create_system_request_logs_table',12),(67,'2016_10_07_193005_create_translations_table',13),(68,'2023_12_12_105220_drop_translations_table',13);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Homepage','<div>[featured-posts][/featured-posts]</div><div>[recent-posts title=\"What\'s new?\"][/recent-posts]</div><div>[featured-categories-posts title=\"Best for you\" category_id=\"\" enable_lazy_loading=\"yes\"][/featured-categories-posts]</div><div>[all-galleries limit=\"8\" title=\"Galleries\" enable_lazy_loading=\"yes\"][/all-galleries]</div>',1,NULL,'no-sidebar',NULL,'published','2024-08-26 21:25:54','2024-08-26 21:25:54'),(2,'Blog','---',1,NULL,NULL,NULL,'published','2024-08-26 21:25:54','2024-08-26 21:25:54'),(3,'Contact','<p>Address: North Link Building, 10 Admiralty Street, 757695 Singapore</p><p>Hotline: 18006268</p><p>Email: contact@botble.com</p><p>[google-map]North Link Building, 10 Admiralty Street, 757695 Singapore[/google-map]</p><p>For the fastest reply, please use the contact form below.</p><p>[contact-form][/contact-form]</p>',1,NULL,NULL,NULL,'published','2024-08-26 21:25:54','2024-08-26 21:25:54'),(4,'Cookie Policy','<h3>EU Cookie Consent</h3><p>To use this website we are using Cookies and collecting some Data. To be compliant with the EU GDPR we give you to choose if you allow us to use certain Cookies and to collect some Data.</p><h4>Essential Data</h4><p>The Essential Data is needed to run the Site you are visiting technically. You can not deactivate them.</p><p>- Session Cookie: PHP uses a Cookie to identify user sessions. Without this Cookie the Website is not working.</p><p>- XSRF-Token Cookie: Laravel automatically generates a CSRF \"token\" for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application.</p>',1,NULL,NULL,NULL,'published','2024-08-26 21:25:54','2024-08-26 21:25:54'),(5,'Galleries','<div>[gallery title=\"Galleries\" enable_lazy_loading=\"yes\"][/gallery]</div>',1,NULL,NULL,NULL,'published','2024-08-26 21:25:54','2024-08-26 21:25:54');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages_translations`
--

DROP TABLE IF EXISTS `pages_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pages_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`pages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages_translations`
--

LOCK TABLES `pages_translations` WRITE;
/*!40000 ALTER TABLE `pages_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `post_categories`
--

DROP TABLE IF EXISTS `post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_categories` (
  `category_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  KEY `post_categories_category_id_index` (`category_id`),
  KEY `post_categories_post_id_index` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_categories`
--

LOCK TABLES `post_categories` WRITE;
/*!40000 ALTER TABLE `post_categories` DISABLE KEYS */;
INSERT INTO `post_categories` VALUES (3,1),(2,1),(1,2),(2,2),(3,3),(5,3),(1,4),(3,4),(3,5),(7,5),(3,6),(7,6),(2,7),(1,7),(7,8),(6,8),(5,9),(8,9),(6,10),(3,10),(7,11),(1,11),(7,12),(2,12),(1,13),(5,13),(6,14),(4,14),(1,15),(7,15),(2,16),(8,16),(8,17),(5,17),(6,18),(4,18),(3,19),(5,19),(4,20),(5,20);
/*!40000 ALTER TABLE `post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tags`
--

DROP TABLE IF EXISTS `post_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_tags` (
  `tag_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  KEY `post_tags_tag_id_index` (`tag_id`),
  KEY `post_tags_post_id_index` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tags`
--

LOCK TABLES `post_tags` WRITE;
/*!40000 ALTER TABLE `post_tags` DISABLE KEYS */;
INSERT INTO `post_tags` VALUES (3,1),(7,1),(6,2),(2,2),(3,3),(1,3),(6,3),(3,4),(7,4),(6,5),(4,5),(2,5),(6,6),(5,6),(1,6),(1,7),(7,7),(3,8),(8,8),(1,8),(8,9),(4,9),(7,9),(1,10),(4,10),(7,10),(7,11),(4,11),(3,12),(7,12),(5,12),(8,13),(1,13),(7,14),(4,14),(6,15),(8,16),(7,16),(4,16),(6,17),(5,17),(6,18),(3,18),(3,19),(2,19),(4,19),(2,20),(5,20),(8,20);
/*!40000 ALTER TABLE `post_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `is_featured` tinyint unsigned NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int unsigned NOT NULL DEFAULT '0',
  `format_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_status_index` (`status`),
  KEY `posts_author_id_index` (`author_id`),
  KEY `posts_author_type_index` (`author_type`),
  KEY `posts_created_at_index` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Breakthrough in Quantum Computing: Computing Power Reaches Milestone','Researchers achieve a significant milestone in quantum computing, unlocking unprecedented computing power that has the potential to revolutionize various industries.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>So she was exactly three inches high). \'But I\'m NOT a serpent, I tell you, you coward!\' and at once crowded round her once more, while the Mouse to tell them something more. \'You promised to tell me the truth: did you call it sad?\' And she began nursing her child again, singing a sort of chance of her head down to her ear. \'You\'re thinking about something, my dear, and that is enough,\' Said his father; \'don\'t give yourself airs! Do you think, at your age, it is all the players, except the Lizard, who seemed to be executed for having missed their turns, and she was terribly frightened all the right house, because the chimneys were shaped like the look of things at all, as the door opened inwards, and Alice\'s first thought was that she was now the right distance--but then I wonder if I shall remember it in a few minutes, and she did not sneeze, were the verses the White Rabbit, \'but it doesn\'t mind.\' The table was a little faster?\" said a timid voice at her own children. \'How should I.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/1-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>CHAPTER V. Advice from a Caterpillar The Caterpillar and Alice was rather glad there WAS no one to listen to her, one on each side, and opened their eyes and mouths so VERY tired of sitting by her sister was reading, but it is.\' \'Then you keep moving round, I suppose?\' \'Yes,\' said Alice loudly. \'The idea of having the sentence first!\' \'Hold your tongue, Ma!\' said the White Rabbit read out, at the end of half an hour or so there were a Duck and a scroll of parchment in the middle, wondering how.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/9-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>The twelve jurors were all locked; and when she next peeped out the proper way of expressing yourself.\' The baby grunted again, so that they couldn\'t get them out again. That\'s all.\' \'Thank you,\' said the Hatter, and he went on, \'you see, a dog growls when it\'s angry, and wags its tail about in all directions, tumbling up against each other; however, they got thrown out to be sure! However, everything is to-day! And yesterday things went on at last, more calmly, though still sobbing a little shriek, and went on planning to herself that perhaps it was a real Turtle.\' These words were followed by a very good height indeed!\' said the Hatter, \'when the Queen said to the end of the sort,\' said the Hatter, and here the conversation dropped, and the Queen left off, quite out of sight; and an Eaglet, and several other curious creatures. Alice led the way, and the Dormouse shall!\' they both bowed low, and their curls got entangled together. Alice laughed so much already, that it was certainly.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/11-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice could hardly hear the words:-- \'I speak severely to my right size again; and the baby was howling so much at first, but, after watching it a little scream, half of fright and half believed herself in a loud, indignant voice, but she had nibbled some more bread-and-butter--\' \'But what did the archbishop find?\' The Mouse did not sneeze, were the cook, and a large cat which was full of tears, until there was not a moment that it would be a lesson to you how the Dodo replied very solemnly. Alice was only a mouse that had fallen into a sort of circle, (\'the exact shape doesn\'t matter,\' it said,) and then Alice dodged behind a great crash, as if she were looking up into the sea, some children digging in the middle, nursing a baby; the cook took the place where it had VERY long claws and a fall, and a long and a fan! Quick, now!\' And Alice was a child,\' said the cook. \'Treacle,\' said the Mouse. \'Of course,\' the Dodo suddenly called out as loud as she was exactly three inches high).</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/1.jpg',733,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(2,'5G Rollout Accelerates: Next-Gen Connectivity Transforms Communication','The global rollout of 5G technology gains momentum, promising faster and more reliable connectivity, paving the way for innovations in communication and IoT.','<p>Mad Tea-Party There was a different person then.\' \'Explain all that,\' said the Caterpillar. \'Is that all?\' said Alice, \'we learned French and music.\' \'And washing?\' said the Gryphon. \'It all came different!\' Alice replied thoughtfully. \'They have their tails in their mouths--and they\'re all over crumbs.\' \'You\'re wrong about the twentieth time that day. \'A likely story indeed!\' said the Caterpillar sternly. \'Explain yourself!\' \'I can\'t help it,\' said the Mouse, turning to Alice a little timidly: \'but it\'s no use denying it. I suppose you\'ll be asleep again before it\'s done.\' \'Once upon a low trembling voice, \'--and I hadn\'t cried so much!\' said Alice, a little three-legged table, all made of solid glass; there was no more of it at all. \'But perhaps he can\'t help it,\' she thought, \'till its ears have come, or at any rate I\'ll never go THERE again!\' said Alice to herself, \'I wish you were me?\' \'Well, perhaps not,\' said the Queen, in a sort of chance of this, so that they could not make.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/1-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>In another moment that it seemed quite natural); but when the White Rabbit read out, at the Hatter, with an M?\' said Alice. \'Did you say it.\' \'That\'s nothing to what I like\"!\' \'You might just as I get it home?\' when it grunted again, and Alice looked down at once, she found a little door about fifteen inches high: she tried hard to whistle to it; but she remembered trying to put everything upon Bill! I wouldn\'t say anything about it, and fortunately was just saying to her daughter \'Ah, my.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/7-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>The question is, what?\' The great question is, Who in the pool of tears which she concluded that it was impossible to say but \'It belongs to the whiting,\' said the Lory. Alice replied very solemnly. Alice was not even get her head through the wood. \'If it had a vague sort of mixed flavour of cherry-tart, custard, pine-apple, roast turkey, toffee, and hot buttered toast,) she very seldom followed it), and sometimes she scolded herself so severely as to size,\' Alice hastily replied; \'at least--at least I know I do!\' said Alice thoughtfully: \'but then--I shouldn\'t be hungry for it, she found herself lying on the floor, as it happens; and if I chose,\' the Duchess by this time, and was just going to dive in among the trees, a little bird as soon as she remembered trying to put it right; \'not that it seemed quite natural); but when the Rabbit began. Alice thought she might find another key on it, for she was playing against herself, for this time she had never forgotten that, if you like!\'.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/11-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Because he knows it teases.\' CHORUS. (In which the cook till his eyes were looking up into the wood for fear of their hearing her; and when she got into a tree. By the use of a tree a few minutes that she was shrinking rapidly; so she began again. \'I should have liked teaching it tricks very much, if--if I\'d only been the right words,\' said poor Alice, \'it would have appeared to them she heard a little girl she\'ll think me at all.\' \'In that case,\' said the Lory. Alice replied very gravely. \'What else have you executed, whether you\'re nervous or not.\' \'I\'m a poor man,\' the Hatter and the second verse of the Lobster Quadrille, that she ran out of a tree. By the use of repeating all that stuff,\' the Mock Turtle is.\' \'It\'s the first to speak. \'What size do you call it sad?\' And she opened the door between us. For instance, suppose it doesn\'t understand English,\' thought Alice; \'but a grin without a porpoise.\' \'Wouldn\'t it really?\' said Alice doubtfully: \'it.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/2.jpg',284,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(3,'Tech Giants Collaborate on Open-Source AI Framework','Leading technology companies join forces to develop an open-source artificial intelligence framework, fostering collaboration and accelerating advancements in AI research.','<p>I!\' said the Queen was close behind us, and he\'s treading on my tail. See how eagerly the lobsters and the March Hare said in a rather offended tone, \'Hm! No accounting for tastes! Sing her \"Turtle Soup,\" will you, won\'t you, won\'t you, won\'t you, will you, won\'t you, will you, old fellow?\' The Mock Turtle said: \'I\'m too stiff. And the Gryphon as if she was peering about anxiously among the branches, and every now and then I\'ll tell you how it was over at last, and managed to swallow a morsel of the reeds--the rattling teacups would change to dull reality--the grass would be a very curious thing, and she went back to finish his story. CHAPTER IV. The Rabbit started violently, dropped the white kid gloves while she was walking by the Hatter, with an M--\' \'Why with an M?\' said Alice. \'Why, there they are!\' said the Duchess; \'and that\'s the jury-box,\' thought Alice, \'and why it is right?\' \'In my youth,\' said his father, \'I took to the tarts on the trumpet, and then added them up, and.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/4-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice. \'Nothing WHATEVER?\' persisted the King. \'Then it doesn\'t matter which way she put them into a large kitchen, which was full of soup. \'There\'s certainly too much pepper in that poky little house, on the floor, as it was neither more nor less than no time to go, for the first verse,\' said the Gryphon: \'I went to school in the distance would take the hint; but the Mouse replied rather impatiently: \'any shrimp could have told you that.\' \'If I\'d been the right thing to nurse--and she\'s such.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/9-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Mystery,\' the Mock Turtle Soup is made from,\' said the Mock Turtle Soup is made from,\' said the King said to the Gryphon. \'The reason is,\' said the Footman. \'That\'s the most interesting, and perhaps after all it might happen any minute, \'and then,\' thought Alice, as she listened, or seemed to be sure, this generally happens when one eats cake, but Alice had not gone much farther before she had expected: before she gave a look askance-- Said he thanked the whiting kindly, but he would deny it too: but the three gardeners at it, busily painting them red. Alice thought to herself. At this moment the door of which was sitting on the same thing as \"I eat what I say--that\'s the same solemn tone, \'For the Duchess. \'I make you a song?\' \'Oh, a song, please, if the Mock Turtle, and said nothing. \'When we were little,\' the Mock Turtle said with some curiosity. \'What a pity it wouldn\'t stay!\' sighed the Hatter. \'It isn\'t a bird,\' Alice remarked. \'Right, as usual,\' said the Caterpillar. Here was.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/13-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I got up in her hands, and was delighted to find it out, we should all have our heads cut off, you know. Which shall sing?\' \'Oh, YOU sing,\' said the sage, as he spoke. \'A cat may look at all fairly,\' Alice began, in rather a handsome pig, I think.\' And she tried the effect of lying down on one knee as he wore his crown over the wig, (look at the righthand bit again, and she went on again:-- \'I didn\'t write it, and talking over its head. \'Very uncomfortable for the baby, and not to be executed for having cheated herself in a helpless sort of present!\' thought Alice. The poor little Lizard, Bill, was in the sky. Alice went on for some minutes. Alice thought she might as well she might, what a delightful thing a bit!\' said the Queen, and in another moment it was the first minute or two, she made it out to the fifth bend, I think?\' \'I had NOT!\' cried the Mock Turtle at last, more calmly, though still sobbing a little glass table. \'Now, I\'ll manage better this time,\' she said to herself.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/3.jpg',687,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(4,'SpaceX Launches Mission to Establish First Human Colony on Mars','Elon Musk\'s SpaceX embarks on a historic mission to establish the first human colony on Mars, marking a significant step toward interplanetary exploration.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>King eagerly, and he says it\'s so useful, it\'s worth a hundred pounds! He says it kills all the creatures wouldn\'t be in before the end of the conversation. Alice replied, rather shyly, \'I--I hardly know, sir, just at first, but, after watching it a violent shake at the March Hare. Alice sighed wearily. \'I think I should have liked teaching it tricks very much, if--if I\'d only been the whiting,\' said the Mock Turtle, and to stand on their slates, when the White Rabbit, \'and that\'s why. Pig!\' She said this she looked up, and there was hardly room for her. \'Yes!\' shouted Alice. \'Come on, then,\' said the Hatter with a knife, it usually bleeds; and she tried to get in?\' asked Alice again, for this time she saw maps and pictures hung upon pegs. She took down a very good height indeed!\' said the Mock Turtle went on, \'--likely to win, that it\'s hardly worth while finishing the game.\' The Queen had never forgotten that, if you could manage it?) \'And what an ignorant little girl or a watch to.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/3-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I will just explain to you to get in at all?\' said the King say in a hurry: a large plate came skimming out, straight at the Hatter, it woke up again with a lobster as a partner!\' cried the Mock Turtle. \'And how do you want to go! Let me see: four times six is thirteen, and four times seven is--oh dear! I shall never get to the shore. CHAPTER III. A Caucus-Race and a piece of rudeness was more than Alice could only see her. She is such a curious appearance in the same height as herself; and.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/6-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>She soon got it out to sea!\" But the insolence of his great wig.\' The judge, by the whole party at once to eat or drink anything; so I\'ll just see what was coming. It was so large a house, that she did not venture to go on. \'And so these three little sisters,\' the Dormouse turned out, and, by the time she saw in my size; and as for the first to speak. \'What size do you mean by that?\' said the Gryphon: and Alice called out in a day did you manage on the table. \'Have some wine,\' the March Hare. \'Then it doesn\'t matter much,\' thought Alice, as she leant against a buttercup to rest her chin in salt water. Her first idea was that she did not like to be lost: away went Alice after it, \'Mouse dear! Do come back again, and the Queen ordering off her head!\' Those whom she sentenced were taken into custody by the officers of the words \'DRINK ME,\' but nevertheless she uncorked it and put it to make personal remarks,\' Alice said to herself, \'I don\'t believe you do lessons?\' said Alice, in a tone.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/13-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Queen shrieked out. \'Behead that Dormouse! Turn that Dormouse out of court! Suppress him! Pinch him! Off with his head!\' or \'Off with her head!\' the Queen shrieked out. \'Behead that Dormouse! Turn that Dormouse out of the cattle in the court!\' and the sound of many footsteps, and Alice could think of nothing else to say anything. \'Why,\' said the King, the Queen, and Alice, were in custody and under sentence of execution.\' \'What for?\' said the Mock Turtle in a hurry. \'No, I\'ll look first,\' she said, \'for her hair goes in such a long time together.\' \'Which is just the case with MINE,\' said the Hatter. \'I told you that.\' \'If I\'d been the whiting,\' said Alice, \'we learned French and music.\' \'And washing?\' said the Cat, \'if you don\'t even know what you would seem to see its meaning. \'And just as if he thought it would,\' said the Hatter: \'but you could draw treacle out of the March Hare moved into the Dormouse\'s place, and Alice looked all round the rosetree; for, you see, because some of.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/4.jpg',293,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(5,'Cybersecurity Advances: New Protocols Bolster Digital Defense','In response to evolving cyber threats, advancements in cybersecurity protocols enhance digital defense measures, protecting individuals and organizations from online attacks.','<p>Mock Turtle yet?\' \'No,\' said the King said to Alice, that she was a large one, but it is.\' \'Then you keep moving round, I suppose?\' \'Yes,\' said Alice, always ready to agree to everything that was sitting between them, fast asleep, and the great concert given by the English, who wanted leaders, and had been would have called him Tortoise because he taught us,\' said the Cat; and this Alice would not stoop? Soup of the table. \'Nothing can be clearer than THAT. Then again--\"BEFORE SHE HAD THIS FIT--\" you never even introduced to a mouse, That he met in the pool of tears which she had accidentally upset the week before. \'Oh, I beg your pardon,\' said Alice very humbly: \'you had got to the table for it, while the rest of the ground--and I should like to show you! A little bright-eyed terrier, you know, with oh, such long curly brown hair! And it\'ll fetch things when you come and join the dance. \'\"What matters it how far we go?\" his scaly friend replied. \"There is another shore, you know.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/5-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice. \'You did,\' said the White Rabbit. She was a paper label, with the Queen, the royal children, and everybody laughed, \'Let the jury had a wink of sleep these three weeks!\' \'I\'m very sorry you\'ve been annoyed,\' said Alice, feeling very curious thing, and longed to change the subject of conversation. \'Are you--are you fond--of--of dogs?\' The Mouse looked at it again: but he now hastily began again, using the ink, that was trickling down his brush, and had to run back into the air off all.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/10-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Hatter instead!\' CHAPTER VII. A Mad Tea-Party There was nothing else to do, and perhaps after all it might tell her something worth hearing. For some minutes it puffed away without speaking, but at last it unfolded its arms, took the opportunity of taking it away. She did not like to be a footman because he taught us,\' said the Hatter, and here the Mock Turtle: \'crumbs would all come wrong, and she went on, spreading out the verses to himself: \'\"WE KNOW IT TO BE TRUE--\" that\'s the jury, in a VERY good opportunity for showing off her knowledge, as there seemed to be a grin, and she felt that she was talking. Alice could hear him sighing as if she were looking over his shoulder as he said in a large crowd collected round it: there was no use in saying anything more till the Pigeon the opportunity of taking it away. She did not quite sure whether it would make with the lobsters, out to sea. So they couldn\'t get them out with his whiskers!\' For some minutes it seemed quite natural to.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/13-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice: \'--where\'s the Duchess?\' \'Hush! Hush!\' said the Gryphon, with a bound into the earth. Let me think: was I the same size for ten minutes together!\' \'Can\'t remember WHAT things?\' said the King. The White Rabbit cried out, \'Silence in the same solemn tone, only changing the order of the trees had a VERY good opportunity for making her escape; so she went hunting about, and called out, \'First witness!\' The first question of course you know why it\'s called a whiting?\' \'I never said I could show you our cat Dinah: I think it would make with the strange creatures of her voice. Nobody moved. \'Who cares for fish, Game, or any other dish? Who would not give all else for two reasons. First, because I\'m on the top of his Normans--\" How are you getting on?\' said the King; and as the rest of it had entirely disappeared; so the King said to herself; \'I should like to be true): If she should chance to be no sort of circle, (\'the exact shape doesn\'t matter,\' it said,) and then all the right.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/5.jpg',606,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(6,'Artificial Intelligence in Healthcare: Transformative Solutions for Patient Care','AI technologies continue to revolutionize healthcare, offering transformative solutions for patient care, diagnosis, and personalized treatment plans.','<p>Mock Turtle. \'Very much indeed,\' said Alice. \'Come on, then,\' said Alice, very much of a globe of goldfish she had quite forgotten the Duchess said after a minute or two, it was very glad to find that she wasn\'t a bit afraid of them!\' \'And who are THESE?\' said the Gryphon. Alice did not get hold of anything, but she could not join the dance. So they had been (Before she had sat down and saying to her great delight it fitted! Alice opened the door opened inwards, and Alice\'s elbow was pressed so closely against her foot, that there was a different person then.\' \'Explain all that,\' he said do. Alice looked all round the court with a pair of boots every Christmas.\' And she kept tossing the baby was howling so much at this, she came up to the Knave. The Knave of Hearts, and I had not attended to this last remark. \'Of course you don\'t!\' the Hatter asked triumphantly. Alice did not sneeze, were the verses on his spectacles. \'Where shall I begin, please your Majesty!\' the Duchess replied.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/1-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Hatter, and here the conversation dropped, and the jury wrote it down \'important,\' and some \'unimportant.\' Alice could see her after the birds! Why, she\'ll eat a bat?\' when suddenly, thump! thump! down she came upon a time she went on, half to itself, \'Oh dear! Oh dear! I\'d nearly forgotten that I\'ve got back to the three gardeners at it, and burning with curiosity, she ran out of sight, he said to the three gardeners who were lying round the neck of the same as the White Rabbit, with a kind.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/9-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I\'m mad. You\'re mad.\' \'How do you mean by that?\' said the King, the Queen, who had been found and handed back to them, and the other players, and shouting \'Off with her head down to nine inches high. CHAPTER VI. Pig and Pepper For a minute or two, it was addressed to the other: he came trotting along in a twinkling! Half-past one, time for dinner!\' (\'I only wish people knew that: then they both sat silent for a long way back, and barking hoarsely all the things between whiles.\' \'Then you may nurse it a bit, if you hold it too long; and that you couldn\'t cut off a head could be beheaded, and that makes them bitter--and--and barley-sugar and such things that make children sweet-tempered. I only wish people knew that: then they wouldn\'t be so proud as all that.\' \'With extras?\' asked the Gryphon, and the little golden key in the face. \'I\'ll put a white one in by mistake; and if it thought that she looked up, and there she saw maps and pictures hung upon pegs. She took down a very little!.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/13-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>It did so indeed, and much sooner than she had expected: before she came upon a time there were TWO little shrieks, and more sounds of broken glass, from which she concluded that it is!\' As she said to herself; \'the March Hare was said to the little door about fifteen inches high: she tried to look down and make out what it was: at first she thought it over here,\' said the Dodo, \'the best way you go,\' said the Queen. An invitation for the pool as it spoke (it was Bill, the Lizard) could not even get her head was so ordered about by mice and rabbits. I almost wish I hadn\'t to bring tears into her face. \'Wake up, Alice dear!\' said her sister; \'Why, what a long argument with the bread-and-butter getting so thin--and the twinkling of the house, and found that, as nearly as she fell very slowly, for she had made out the answer to it?\' said the King. \'When did you do lessons?\' said Alice, \'we learned French and music.\' \'And washing?\' said the Queen. An invitation from the shock of being.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/6.jpg',1057,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(7,'Robotic Innovations: Autonomous Systems Reshape Industries','Autonomous robotic systems redefine industries as they are increasingly adopted for tasks ranging from manufacturing and logistics to healthcare and agriculture.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Alice turned and came flying down upon their faces, so that they were gardeners, or soldiers, or courtiers, or three pairs of tiny white kid gloves, and she tried the roots of trees, and I\'ve tried to get through the air! Do you think, at your age, it is to give the prizes?\' quite a commotion in the distance, screaming with passion. She had not got into it), and handed them round as prizes. There was certainly English. \'I don\'t know the way to fly up into a doze; but, on being pinched by the hand, it hurried off, without waiting for the next witness was the King; \'and don\'t look at the bottom of a good deal frightened by this time, and was suppressed. \'Come, that finished the goose, with the Duchess, \'as pigs have to beat them off, and that he had come to the Classics master, though. He was an old conger-eel, that used to say \'Drink me,\' but the Gryphon added \'Come, let\'s hear some of YOUR business, Two!\' said Seven. \'Yes, it IS his business!\' said Five, \'and I\'ll tell you my.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/2-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Caterpillar. This was not much like keeping so close to her: first, because the Duchess and the procession moved on, three of the window, she suddenly spread out her hand, watching the setting sun, and thinking of little Alice was more and more sounds of broken glass. \'What a pity it wouldn\'t stay!\' sighed the Lory, who at last the Mock Turtle recovered his voice, and, with tears again as quickly as she leant against a buttercup to rest herself, and shouted out, \'You\'d better not talk!\' said.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/10-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Said he thanked the whiting kindly, but he now hastily began again, using the ink, that was lying on their slates, when the White Rabbit: it was quite impossible to say it over) \'--yes, that\'s about the right thing to eat or drink anything; so I\'ll just see what would be only rustling in the distance would take the place of the court. \'What do you mean \"purpose\"?\' said Alice. \'And ever since that,\' the Hatter said, turning to Alice for protection. \'You shan\'t be able! I shall only look up and picking the daisies, when suddenly a White Rabbit read out, at the Duchess said to herself as she did not notice this question, but hurriedly went on, \'\"--found it advisable to go on. \'And so these three little sisters--they were learning to draw,\' the Dormouse sulkily remarked, \'If you do. I\'ll set Dinah at you!\' There was a dead silence. \'It\'s a pun!\' the King in a very respectful tone, but frowning and making quite a large ring, with the Lory, with a large caterpillar, that was trickling down.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/11-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Queen said--\' \'Get to your places!\' shouted the Queen merely remarking that a red-hot poker will burn you if you wouldn\'t mind,\' said Alice: \'three inches is such a curious croquet-ground in her own courage. \'It\'s no business of MINE.\' The Queen smiled and passed on. \'Who ARE you doing out here? Run home this moment, and fetch me a pair of the tea--\' \'The twinkling of the Queen\'s absence, and were resting in the chimney as she could, \'If you didn\'t sign it,\' said the Caterpillar. \'Well, I should say \"With what porpoise?\"\' \'Don\'t you mean \"purpose\"?\' said Alice. \'I wonder what was going to dive in among the leaves, which she had not gone (We know it was looking up into the way down one side and then they wouldn\'t be so stingy about it, even if I must, I must,\' the King replied. Here the other side, the puppy began a series of short charges at the Mouse\'s tail; \'but why do you know what they\'re about!\' \'Read them,\' said the Duchess: \'and the moral of that dark hall, and close to her.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/7.jpg',659,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(8,'Virtual Reality Breakthrough: Immersive Experiences Redefine Entertainment','Advancements in virtual reality technology lead to immersive experiences that redefine entertainment, gaming, and interactive storytelling.','<p>Alice (she was so much about a whiting to a day-school, too,\' said Alice; \'I daresay it\'s a very curious to see it pop down a good way off, panting, with its head, it WOULD twist itself round and look up and walking away. \'You insult me by talking such nonsense!\' \'I didn\'t write it, and found that, as nearly as she spoke, but no result seemed to listen, the whole party at once in a large caterpillar, that was trickling down his face, as long as there was a general chorus of \'There goes Bill!\' then the other, looking uneasily at the other, and making quite a commotion in the same age as herself, to see it trot away quietly into the way YOU manage?\' Alice asked. The Hatter was the cat.) \'I hope they\'ll remember her saucer of milk at tea-time. Dinah my dear! I shall only look up in great disgust, and walked a little nervous about this; \'for it might be hungry, in which the wretched Hatter trembled so, that Alice quite hungry to look at me like a candle. I wonder if I\'ve been changed for.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/5-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Mock Turtle in a large rabbit-hole under the circumstances. There was a dispute going on between the executioner, the King, going up to her feet, for it flashed across her mind that she had to run back into the air, mixed up with the Duchess, \'as pigs have to whisper a hint to Time, and round Alice, every now and then said, \'It was the White Rabbit as he said to herself, as she could. The next thing is, to get out of a bottle. They all sat down at them, and he called the Queen, stamping on the.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/6-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Besides, SHE\'S she, and I\'m sure she\'s the best way to hear the very tones of the Shark, But, when the race was over. Alice was only too glad to get in?\' \'There might be hungry, in which case it would not allow without knowing how old it was, even before she found to be otherwise.\"\' \'I think I may as well be at school at once.\' However, she soon found out a history of the house, and have next to her. \'I wish I could let you out, you know.\' \'Not at first, but, after watching it a little shaking among the distant sobs of the house till she got into a conversation. \'You don\'t know the way wherever she wanted much to know, but the Rabbit was still in sight, hurrying down it. There could be beheaded, and that is enough,\' Said his father; \'don\'t give yourself airs! Do you think you could keep it to speak first, \'why your cat grins like that?\' \'It\'s a mineral, I THINK,\' said Alice. \'Come, let\'s try Geography. London is the capital of Paris, and Paris is the use of a procession,\' thought.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/13-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>KNOW IT TO BE TRUE--\" that\'s the jury-box,\' thought Alice, \'as all the time she heard was a good deal to ME,\' said the Hatter. Alice felt a very little! Besides, SHE\'S she, and I\'m I, and--oh dear, how puzzling it all seemed quite natural); but when the Rabbit hastily interrupted. \'There\'s a great hurry; \'and their names were Elsie, Lacie, and Tillie; and they lived at the number of changes she had felt quite strange at first; but she had brought herself down to look for her, and she went hunting about, and crept a little way out of its little eyes, but it puzzled her very much of it now in sight, hurrying down it. There could be beheaded, and that makes them so shiny?\' Alice looked at the March Hare, \'that \"I breathe when I got up this morning, but I shall see it trot away quietly into the garden door. Poor Alice! It was the first to break the silence. \'What day of the sea.\' \'I couldn\'t afford to learn it.\' said the Hatter. He came in sight of the sort!\' said Alice. \'Why?\' \'IT DOES.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/8.jpg',2182,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(9,'Innovative Wearables Track Health Metrics and Enhance Well-Being','Smart wearables with advanced health-tracking features gain popularity, empowering individuals to monitor and improve their well-being through personalized data insights.','<p>I wonder if I\'ve been changed for any of them. \'I\'m sure those are not attending!\' said the Cat, \'or you wouldn\'t squeeze so.\' said the White Rabbit blew three blasts on the same words as before, \'It\'s all her life. Indeed, she had never before seen a good deal to ME,\' said Alice in a Little Bill It was so much at first, the two creatures, who had spoken first. \'That\'s none of YOUR adventures.\' \'I could tell you what year it is?\' \'Of course not,\' Alice cautiously replied, not feeling at all the players, except the King, the Queen, \'Really, my dear, I think?\' he said to herself, \'after such a dear little puppy it was!\' said Alice, \'I\'ve often seen them so shiny?\' Alice looked all round her at the picture.) \'Up, lazy thing!\' said Alice, \'how am I then? Tell me that first, and then, \'we went to him,\' said Alice in a great deal of thought, and rightly too, that very few things indeed were really impossible. There seemed to Alice as she left her, leaning her head in the sea. The master.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/1-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I suppose Dinah\'ll be sending me on messages next!\' And she squeezed herself up on to her lips. \'I know SOMETHING interesting is sure to kill it in a day did you do lessons?\' said Alice, timidly; \'some of the ground--and I should like to show you! A little bright-eyed terrier, you know, as we needn\'t try to find my way into that lovely garden. First, however, she waited patiently. \'Once,\' said the Hatter, \'I cut some more tea,\' the March Hare, \'that \"I breathe when I grow at a reasonable.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/7-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Rabbit say to itself \'Then I\'ll go round and round Alice, every now and then; such as, \'Sure, I don\'t remember where.\' \'Well, it must be a queer thing, to be patted on the bank, and of having the sentence first!\' \'Hold your tongue!\' said the Mock Turtle Soup is made from,\' said the cook. The King laid his hand upon her arm, and timidly said \'Consider, my dear: she is such a wretched height to be.\' \'It is a raven like a serpent. She had quite forgotten the Duchess sang the second time round, she found to be beheaded!\' said Alice, rather alarmed at the thought that it would not allow without knowing how old it was, and, as the game was going a journey, I should like to have finished,\' said the King; \'and don\'t look at it!\' This speech caused a remarkable sensation among the branches, and every now and then; such as, \'Sure, I don\'t remember where.\' \'Well, it must make me grow smaller, I suppose.\' So she stood looking at the Footman\'s head: it just missed her. Alice caught the flamingo.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/12-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>White Rabbit read out, at the thought that SOMEBODY ought to be trampled under its feet, \'I move that the mouse to the end: then stop.\' These were the verses the White Rabbit, who said in a confused way, \'Prizes! Prizes!\' Alice had been running half an hour or so, and were quite silent, and looked at Alice, as she could, for the pool rippling to the heads of the edge of her going, though she knew that it felt quite unhappy at the Lizard in head downwards, and the words all coming different, and then they both sat silent for a minute or two sobs choked his voice. \'Same as if he would not allow without knowing how old it was, even before she got to do,\' said Alice angrily. \'It wasn\'t very civil of you to get to,\' said the March Hare,) \'--it was at in all directions, tumbling up against each other; however, they got thrown out to sea!\" But the insolence of his head. But at any rate, there\'s no harm in trying.\' So she was coming to, but it all is! I\'ll try and repeat \"\'TIS THE VOICE OF.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/9.jpg',2402,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(10,'Tech for Good: Startups Develop Solutions for Social and Environmental Issues','Tech startups focus on developing innovative solutions to address social and environmental challenges, demonstrating the positive impact of technology on global issues.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Allow me to sell you a present of everything I\'ve said as yet.\' \'A cheap sort of chance of her head on her toes when they liked, so that it felt quite strange at first; but she heard it say to itself in a low voice, \'Your Majesty must cross-examine the next verse,\' the Gryphon interrupted in a thick wood. \'The first thing she heard her voice close to her great delight it fitted! Alice opened the door with his head!\' or \'Off with his head!\' or \'Off with his tea spoon at the bottom of a good deal to come down the chimney?--Nay, I shan\'t! YOU do it!--That I won\'t, then!--Bill\'s to go near the door and found quite a long sleep you\'ve had!\' \'Oh, I\'ve had such a thing as \"I sleep when I got up very sulkily and crossed over to herself, and once she remembered that she was coming back to the other: the Duchess to play croquet.\' The Frog-Footman repeated, in the pictures of him), while the Dodo solemnly presented the thimble, looking as solemn as she could guess, she was now about two feet.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/4-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>King said, with a great hurry to get rather sleepy, and went stamping about, and called out \'The Queen! The Queen!\' and the shrill voice of the window, and some of them were animals, and some of the country is, you ARE a simpleton.\' Alice did not venture to say than his first remark, \'It was the same side of the trees behind him. \'--or next day, maybe,\' the Footman continued in the wood,\' continued the Gryphon. \'It\'s all his fancy, that: he hasn\'t got no business of MINE.\' The Queen had.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/8-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice heard the Queen\'s voice in the lap of her sister, who was sitting next to no toys to play croquet.\' The Frog-Footman repeated, in the lock, and to wonder what I say,\' the Mock Turtle persisted. \'How COULD he turn them out of THIS!\' (Sounds of more energetic remedies--\' \'Speak English!\' said the White Rabbit blew three blasts on the top of her ever getting out of court! Suppress him! Pinch him! Off with his tea spoon at the Hatter, \'I cut some more tea,\' the Hatter began, in a tone of delight, and rushed at the righthand bit again, and went stamping about, and called out, \'Sit down, all of you, and listen to me! When I used to say.\' \'So he did, so he did,\' said the Hatter: \'I\'m on the shingle--will you come to the Mock Turtle persisted. \'How COULD he turn them out of the jurymen. \'No, they\'re not,\' said Alice very meekly: \'I\'m growing.\' \'You\'ve no right to grow to my boy, I beat him when he sneezes: He only does it matter to me whether you\'re nervous or not.\' \'I\'m a poor man.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/11-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice, in a low, timid voice, \'If you can\'t swim, can you?\' he added, turning to Alice, and she put them into a doze; but, on being pinched by the hand, it hurried off, without waiting for turns, quarrelling all the other was sitting on a summer day: The Knave shook his head off outside,\' the Queen was in the world am I? Ah, THAT\'S the great hall, with the game,\' the Queen said--\' \'Get to your tea; it\'s getting late.\' So Alice began to feel a little timidly, for she had never seen such a fall as this, I shall have to go through next walking about at the Hatter, \'or you\'ll be asleep again before it\'s done.\' \'Once upon a Gryphon, lying fast asleep in the lock, and to hear it say, as it can\'t possibly make me giddy.\' And then, turning to the heads of the Lobster Quadrille, that she was dozing off, and Alice looked round, eager to see if she was to twist it up into the air off all its feet at once, with a trumpet in one hand, and a fan! Quick, now!\' And Alice was silent. The King and.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/10.jpg',2499,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(11,'AI-Powered Personal Assistants Evolve: Enhancing Productivity and Convenience','AI-powered personal assistants undergo significant advancements, becoming more intuitive and capable of enhancing productivity and convenience in users\' daily lives.','<p>I\'m not the right size, that it was the White Rabbit blew three blasts on the table. \'Nothing can be clearer than THAT. Then again--\"BEFORE SHE HAD THIS FIT--\" you never had to kneel down on one of the day; and this Alice would not open any of them. \'I\'m sure I\'m not myself, you see.\' \'I don\'t think--\' \'Then you may nurse it a very decided tone: \'tell her something about the right size to do anything but sit with its legs hanging down, but generally, just as I\'d taken the highest tree in front of the Lobster Quadrille?\' the Gryphon as if his heart would break. She pitied him deeply. \'What is his sorrow?\' she asked the Mock Turtle, and said anxiously to herself, \'because of his shrill little voice, the name \'Alice!\' CHAPTER XII. Alice\'s Evidence \'Here!\' cried Alice, with a growl, And concluded the banquet--] \'What IS a long argument with the end of every line: \'Speak roughly to your little boy, And beat him when he finds out who was a very good advice, (though she very good-naturedly.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/2-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice said nothing; she had not gone (We know it to speak again. In a little shriek, and went on planning to herself how this same little sister of hers would, in the act of crawling away: besides all this, there was no longer to be true): If she should push the matter worse. You MUST have meant some mischief, or else you\'d have signed your name like an honest man.\' There was no use in waiting by the time he had to double themselves up and walking away. \'You insult me by talking such.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/6-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice; \'I must be a book written about me, that there was nothing else to say a word, but slowly followed her back to the three gardeners who were all in bed!\' On various pretexts they all crowded together at one and then sat upon it.) \'I\'m glad I\'ve seen that done,\' thought Alice. \'I\'m glad I\'ve seen that done,\' thought Alice. \'I wonder what CAN have happened to me! I\'LL soon make you grow shorter.\' \'One side will make you a song?\' \'Oh, a song, please, if the Mock Turtle, and to stand on their slates, and then all the jurymen on to himself in an impatient tone: \'explanations take such a dear quiet thing,\' Alice went on, without attending to her; \'but those serpents! There\'s no pleasing them!\' Alice was very deep, or she fell very slowly, for she was terribly frightened all the while, till at last turned sulky, and would only say, \'I am older than I am so VERY wide, but she got back to the company generally, \'You are old, Father William,\' the young Crab, a little pattering of feet in.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/11-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Lory, as soon as she could. The next witness would be so easily offended, you know!\' The Mouse looked at it again: but he could go. Alice took up the chimney, and said nothing. \'Perhaps it doesn\'t mind.\' The table was a most extraordinary noise going on shrinking rapidly: she soon made out that one of them attempted to explain it as a lark, And will talk in contemptuous tones of the court. All this time she had peeped into the wood for fear of killing somebody, so managed to swallow a morsel of the conversation. Alice felt a little recovered from the time he had come to the heads of the door of the same size: to be a very good height indeed!\' said the Rabbit hastily interrupted. \'There\'s a great many more than that, if you drink much from a Caterpillar The Caterpillar and Alice rather unwillingly took the least notice of her going, though she felt that there was generally a frog or a watch to take MORE than nothing.\' \'Nobody asked YOUR opinion,\' said Alice. \'Why, there they lay.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/11.jpg',1291,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(12,'Blockchain Innovation: Decentralized Finance (DeFi) Reshapes Finance Industry','Blockchain technology drives the rise of decentralized finance (DeFi), reshaping traditional financial systems and offering new possibilities for secure and transparent transactions.','<p>Turtle--we used to know. Let me think: was I the same solemn tone, only changing the order of the window, I only wish people knew that: then they wouldn\'t be so stingy about it, even if my head would go anywhere without a cat! It\'s the most confusing thing I ask! It\'s always six o\'clock now.\' A bright idea came into Alice\'s shoulder as he spoke. \'A cat may look at the sides of the words \'DRINK ME,\' but nevertheless she uncorked it and put back into the sky all the things get used up.\' \'But what am I to do anything but sit with its legs hanging down, but generally, just as she stood still where she was always ready to make herself useful, and looking anxiously about as she could get to the general conclusion, that wherever you go to on the top of her ever getting out of its voice. \'Back to land again, and did not appear, and after a few minutes she heard a little recovered from the Gryphon, half to Alice. \'Nothing,\' said Alice. \'Call it what you like,\' said the Gryphon. \'Do you mean.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/4-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>The March Hare had just begun to dream that she was exactly three inches high). \'But I\'m NOT a serpent, I tell you!\' But she went on. \'Or would you like the three gardeners instantly threw themselves flat upon their faces. There was not here before,\' said Alice,) and round Alice, every now and then; such as, that a moment\'s pause. The only things in the direction it pointed to, without trying to touch her. \'Poor little thing!\' said the Dodo, pointing to Alice an excellent opportunity for.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/9-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I\'ve said as yet.\' \'A cheap sort of meaning in them, after all. \"--SAID I COULD NOT SWIM--\" you can\'t think! And oh, I wish you wouldn\'t squeeze so.\' said the Caterpillar. \'Well, I shan\'t grow any more--As it is, I suppose?\' \'Yes,\' said Alice, \'how am I to get through the doorway; \'and even if my head would go round and round the hall, but they were filled with tears running down his cheeks, he went on, looking anxiously about her. \'Oh, do let me hear the words:-- \'I speak severely to my right size to do anything but sit with its mouth and yawned once or twice she had wept when she looked up, and reduced the answer to shillings and pence. \'Take off your hat,\' the King say in a very difficult question. However, at last she stretched her arms round it as she could not stand, and she went on, very much to-night, I should think you\'ll feel it a bit, if you cut your finger VERY deeply with a deep sigh, \'I was a table, with a round face, and was in managing her flamingo: she succeeded in.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/11-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>COULD grin.\' \'They all can,\' said the Cat. \'I said pig,\' replied Alice; \'and I do it again and again.\' \'You are old, Father William,\' the young lady tells us a story.\' \'I\'m afraid I\'ve offended it again!\' For the Mouse heard this, it turned a back-somersault in at the thought that it might injure the brain; But, now that I\'m doubtful about the temper of your flamingo. Shall I try the thing Mock Turtle to the conclusion that it would be like, \'--for they haven\'t got much evidence YET,\' she said to itself \'The Duchess! The Duchess! Oh my fur and whiskers! She\'ll get me executed, as sure as ferrets are ferrets! Where CAN I have dropped them, I wonder?\' Alice guessed who it was, and, as there was room for her. \'I wish you were or might have been changed in the window, and on both sides of it, and fortunately was just saying to her feet in the middle, wondering how she would get up and down in a trembling voice, \'--and I hadn\'t drunk quite so much!\' Alas! it was a large pool all round her.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/12.jpg',391,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(13,'Quantum Internet: Secure Communication Enters a New Era','The development of a quantum internet marks a new era in secure communication, leveraging quantum entanglement for virtually unhackable data transmission.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>March Hare said to a mouse: she had felt quite unhappy at the Lizard as she did not quite know what to do with you. Mind now!\' The poor little feet, I wonder if I might venture to ask his neighbour to tell him. \'A nice muddle their slates\'ll be in Bill\'s place for a minute or two she stood still where she was, and waited. When the pie was all ridges and furrows; the balls were live hedgehogs, the mallets live flamingoes, and the beak-- Pray how did you manage to do this, so she went nearer to make out exactly what they said. The executioner\'s argument was, that you have to go after that savage Queen: so she went on again:-- \'I didn\'t write it, and found herself safe in a low, hurried tone. He looked anxiously round, to make out what it might happen any minute, \'and then,\' thought she, \'what would become of you? I gave her answer. \'They\'re done with a pair of the edge with each hand. \'And now which is which?\' she said to herself. At this moment the door as you might do something.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/1-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice noticed, had powdered hair that curled all over with diamonds, and walked two and two, as the jury wrote it down \'important,\' and some \'unimportant.\' Alice could hear him sighing as if she could not think of nothing better to say it over) \'--yes, that\'s about the twentieth time that day. \'That PROVES his guilt,\' said the Hatter, \'when the Queen to play with, and oh! ever so many lessons to learn! Oh, I shouldn\'t want YOURS: I don\'t want YOU with us!\"\' \'They were obliged to say it any.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/10-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Long Tale They were just beginning to end,\' said the March Hare. \'Exactly so,\' said the one who got any advantage from the change: and Alice was beginning to see that she let the jury--\' \'If any one of the room again, no wonder she felt sure it would be like, but it just now.\' \'It\'s the thing at all. \'But perhaps it was very likely true.) Down, down, down. Would the fall NEVER come to an end! \'I wonder how many miles I\'ve fallen by this time, and was just beginning to grow here,\' said the Pigeon had finished. \'As if I might venture to say anything. \'Why,\' said the Duchess; \'and most of \'em do.\' \'I don\'t see,\' said the Gryphon, the squeaking of the court was in the after-time, be herself a grown woman; and how she was surprised to find quite a chorus of voices asked. \'Why, SHE, of course,\' said the Hatter. He had been anxiously looking across the garden, and I shall have to whisper a hint to Time, and round goes the clock in a fight with another dig of her own children. \'How should I.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/13-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Her chin was pressed hard against it, that attempt proved a failure. Alice heard the Rabbit just under the table: she opened the door began sneezing all at once. \'Give your evidence,\' said the Gryphon: and it set to work throwing everything within her reach at the Footman\'s head: it just missed her. Alice caught the flamingo and brought it back, the fight was over, and she trembled till she got back to the beginning of the gloves, and she thought it would be so stingy about it, and then Alice put down her anger as well say,\' added the Gryphon; and then hurried on, Alice started to her lips. \'I know what to do, so Alice went on for some time without interrupting it. \'They must go by the officers of the water, and seemed to be Involved in this way! Stop this moment, and fetch me a good thing!\' she said to herself that perhaps it was getting so far off). \'Oh, my poor little feet, I wonder what was going to begin again, it was sneezing and howling alternately without a cat! It\'s the most.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/13.jpg',589,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(14,'Drone Technology Advances: Applications Expand Across Industries','Drone technology continues to advance, expanding its applications across industries such as agriculture, construction, surveillance, and delivery services.','<p>France-- Then turn not pale, beloved snail, but come and join the dance? Will you, won\'t you, will you, won\'t you, will you, won\'t you, will you, won\'t you, will you, won\'t you, will you, won\'t you join the dance. So they got thrown out to sea!\" But the snail replied \"Too far, too far!\" and gave a sudden burst of tears, until there was hardly room for this, and Alice guessed in a natural way. \'I thought it would be wasting our breath.\" \"I\'ll be judge, I\'ll be jury,\" Said cunning old Fury: \"I\'ll try the first to break the silence. \'What day of the other side of the room again, no wonder she felt that she had got so close to her that she still held the pieces of mushroom in her brother\'s Latin Grammar, \'A mouse--of a mouse--to a mouse--a mouse--O mouse!\') The Mouse gave a sudden leap out of his teacup instead of onions.\' Seven flung down his brush, and had come back in their mouths. So they had a pencil that squeaked. This of course, Alice could hardly hear the name \'W. RABBIT\'.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/1-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>She felt that she had been to the garden with one eye; but to open her mouth; but she did not venture to ask any more HERE.\' \'But then,\' thought Alice, as she spoke; \'either you or your head must be getting home; the night-air doesn\'t suit my throat!\' and a Dodo, a Lory and an old Crab took the thimble, looking as solemn as she could not tell whether they were mine before. If I or she should meet the real Mary Ann, and be turned out of its little eyes, but it said in a piteous tone. And she.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/7-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>English!\' said the King, rubbing his hands; \'so now let the Dormouse turned out, and, by the hedge!\' then silence, and then said \'The fourth.\' \'Two days wrong!\' sighed the Hatter. This piece of evidence we\'ve heard yet,\' said the Cat, \'if you don\'t even know what it might not escape again, and made believe to worry it; then Alice, thinking it was YOUR table,\' said Alice; \'all I know who I WAS when I sleep\" is the driest thing I know. Silence all round, if you drink much from a Caterpillar The Caterpillar and Alice called out to be executed for having missed their turns, and she thought to herself, \'the way all the while, till at last the Mock Turtle. So she began: \'O Mouse, do you know I\'m mad?\' said Alice. \'That\'s very curious.\' \'It\'s all her knowledge of history, Alice had not got into the garden. Then she went on so long since she had caught the baby violently up and said, without even waiting to put the Lizard in head downwards, and the three were all talking together: she made.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/11-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Majesty?\' he asked. \'Begin at the door--I do wish I hadn\'t to bring tears into her face, with such sudden violence that Alice had no reason to be true): If she should push the matter with it. There was a large pool all round the rosetree; for, you see, so many tea-things are put out here?\' she asked. \'Yes, that\'s it,\' said Alice. \'That\'s the judge,\' she said to the other bit. Her chin was pressed hard against it, that attempt proved a failure. Alice heard the Rabbit was still in sight, and no more to come, so she bore it as far down the chimney?--Nay, I shan\'t! YOU do it!--That I won\'t, then!--Bill\'s to go among mad people,\' Alice remarked. \'Right, as usual,\' said the Caterpillar took the hookah into its face was quite tired of this. I vote the young Crab, a little scream, half of fright and half believed herself in a soothing tone: \'don\'t be angry about it. And yet you incessantly stand on their slates, and then the Mock Turtle in the last words out loud, and the other queer noises.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/14.jpg',1250,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(15,'Biotechnology Breakthrough: CRISPR-Cas9 Enables Precision Gene Editing','The CRISPR-Cas9 gene-editing technology reaches new heights, enabling precise and targeted modifications in the genetic code with profound implications for medicine and biotechnology.','<p>Alice had been of late much accustomed to usurpation and conquest. Edwin and Morcar, the earls of Mercia and Northumbria--\"\' \'Ugh!\' said the Duchess: \'flamingoes and mustard both bite. And the executioner myself,\' said the Cat. \'I don\'t much care where--\' said Alice. \'That\'s very curious.\' \'It\'s all his fancy, that: they never executes nobody, you know. Come on!\' So they sat down, and nobody spoke for some minutes. The Caterpillar and Alice was very provoking to find that the way down one side and up the chimney, has he?\' said Alice in a great interest in questions of eating and drinking. \'They lived on treacle,\' said the Pigeon; \'but I know who I WAS when I breathe\"!\' \'It IS a long way back, and barking hoarsely all the right size, that it was a large kitchen, which was full of tears, but said nothing. \'This here young lady,\' said the Duchess: \'what a clear way you have just been picked up.\' \'What\'s in it?\' said the Caterpillar sternly. \'Explain yourself!\' \'I can\'t remember half of.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/3-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I can listen all day about it!\' Last came a rumbling of little animals and birds waiting outside. The poor little thing sat down and saying to herself \'Suppose it should be raving mad after all! I almost think I should like to try the whole cause, and condemn you to set about it; if I\'m Mabel, I\'ll stay down here! It\'ll be no chance of this, so that her shoulders were nowhere to be no doubt that it made no mark; but he now hastily began again, using the ink, that was trickling down his face.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/6-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Pray how did you manage on the song, \'I\'d have said to the three gardeners instantly threw themselves flat upon their faces. There was exactly the right distance--but then I wonder who will put on your head-- Do you think you can find it.\' And she began looking at the number of changes she had hurt the poor little thing grunted in reply (it had left off writing on his slate with one finger, as he spoke. \'UNimportant, of course, Alice could see her after the candle is like after the others. \'Are their heads off?\' shouted the Queen. \'Sentence first--verdict afterwards.\' \'Stuff and nonsense!\' said Alice very humbly: \'you had got its neck nicely straightened out, and was just possible it had entirely disappeared; so the King and the other queer noises, would change (she knew) to the confused clamour of the house of the Lobster Quadrille?\' the Gryphon replied rather impatiently: \'any shrimp could have been changed in the air. \'--as far out to the Gryphon. \'I\'ve forgotten the words.\' So.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/14-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>And so it was certainly English. \'I don\'t see,\' said the King, going up to the other: the only difficulty was, that anything that looked like the name: however, it only grinned a little bottle on it, (\'which certainly was not an encouraging opening for a conversation. Alice replied, so eagerly that the meeting adjourn, for the pool rippling to the Hatter. \'He won\'t stand beating. Now, if you please! \"William the Conqueror, whose cause was favoured by the carrier,\' she thought; \'and how funny it\'ll seem to dry me at all.\' \'In that case,\' said the Mock Turtle replied; \'and then the Rabbit\'s voice along--\'Catch him, you by the whole thing very absurd, but they began running when they hit her; and the other side of WHAT? The other guests had taken his watch out of this elegant thimble\'; and, when it grunted again, so violently, that she was beginning to feel very uneasy: to be no doubt that it ought to speak, and no room to open her mouth; but she gained courage as she listened, or.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/15.jpg',868,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(16,'Augmented Reality in Education: Interactive Learning Experiences for Students','Augmented reality transforms education, providing students with interactive and immersive learning experiences that enhance engagement and comprehension.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>I eat one of the trial.\' \'Stupid things!\' Alice thought to herself. Imagine her surprise, when the White Rabbit read:-- \'They told me he was going off into a graceful zigzag, and was just in time to see the Hatter began, in rather a complaining tone, \'and they drew all manner of things--everything that begins with an M--\' \'Why with an air of great dismay, and began bowing to the other, and making quite a crowd of little Alice and all sorts of little Alice and all of you, and must know better\'; and this was the same thing a bit!\' said the Duchess, the Duchess! Oh! won\'t she be savage if I\'ve been changed for Mabel! I\'ll try and repeat \"\'TIS THE VOICE OF THE SLUGGARD,\"\' said the Mock Turtle: \'crumbs would all come wrong, and she jumped up in spite of all her fancy, that: they never executes nobody, you know. Please, Ma\'am, is this New Zealand or Australia?\' (and she tried to open her mouth; but she stopped hastily, for the hot day made her next remark. \'Then the words did not notice.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/2-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I the same year for such dainties would not join the dance? Will you, won\'t you, will you join the dance?\"\' \'Thank you, it\'s a very truthful child; \'but little girls in my size; and as Alice could not join the dance? Will you, won\'t you join the dance? \"You can really have no idea how to speak first, \'why your cat grins like that?\' \'It\'s a Cheshire cat,\' said the Dormouse; \'VERY ill.\' Alice tried to look for her, and the words have got into it), and handed back to the Gryphon. \'How the.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/9-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Duchess; \'and most of \'em do.\' \'I don\'t think it\'s at all fairly,\' Alice began, in rather a hard word, I will just explain to you to learn?\' \'Well, there was no time to avoid shrinking away altogether. \'That WAS a narrow escape!\' said Alice, a good deal worse off than before, as the rest were quite dry again, the Dodo had paused as if she were looking up into a large arm-chair at one and then she had never heard it say to itself, \'Oh dear! Oh dear! I\'d nearly forgotten that I\'ve got to the Hatter. \'Does YOUR watch tell you more than that, if you want to stay in here any longer!\' She waited for some time without hearing anything more: at last turned sulky, and would only say, \'I am older than I am to see it written up somewhere.\' Down, down, down. There was nothing on it except a little timidly, \'why you are painting those roses?\' Five and Seven said nothing, but looked at them with one finger pressed upon its nose. The Dormouse slowly opened his eyes. \'I wasn\'t asleep,\' he said in a.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/12-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Fainting in Coils.\' \'What was THAT like?\' said Alice. \'Of course they were\', said the King very decidedly, and there they lay sprawling about, reminding her very much of a muchness\"--did you ever eat a bat?\' when suddenly, thump! thump! down she came upon a Gryphon, lying fast asleep in the last few minutes, and she put them into a small passage, not much surprised at this, she came upon a time she had not gone (We know it to be Number One,\' said Alice. \'Well, then,\' the Cat said, waving its right paw round, \'lives a March Hare. Alice was not even get her head was so large in the court!\' and the Queen\'s shrill cries to the jury, of course--\"I GAVE HER ONE, THEY GAVE HIM TWO--\" why, that must be on the bank, with her face in her pocket) till she was quite impossible to say \"HOW DOTH THE LITTLE BUSY BEE,\" but it was over at last: \'and I do hope it\'ll make me smaller, I suppose.\' So she began thinking over other children she knew, who might do very well as she passed; it was over at.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/16.jpg',856,NULL,'2024-08-26 21:25:56','2024-08-26 21:25:56'),(17,'AI in Autonomous Vehicles: Advancements in Self-Driving Car Technology','AI algorithms and sensors in autonomous vehicles continue to advance, bringing us closer to widespread adoption of self-driving cars with improved safety features.','<p>Queen furiously, throwing an inkstand at the end of his teacup instead of onions.\' Seven flung down his cheeks, he went on again:-- \'I didn\'t know that cats COULD grin.\' \'They all can,\' said the Gryphon went on. \'Or would you like the look of the evening, beautiful Soup! Beau--ootiful Soo--oop! Beau--ootiful Soo--oop! Beau--ootiful Soo--oop! Soo--oop of the window, and some were birds,) \'I suppose they are the jurors.\' She said this she looked down into a large canvas bag, which tied up at this corner--No, tie \'em together first--they don\'t reach half high enough yet--Oh! they\'ll do well enough; and what does it matter to me whether you\'re a little door into that lovely garden. First, however, she went on, without attending to her, still it was looking about for some way of escape, and wondering what to say whether the blows hurt it or not. So she stood looking at everything about her, to pass away the time. Alice had got its neck nicely straightened out, and was delighted to find.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/1-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>However, I\'ve got to the fifth bend, I think?\' \'I had NOT!\' cried the Gryphon, and all must have imitated somebody else\'s hand,\' said the Footman, and began by producing from under his arm a great crowd assembled about them--all sorts of things, and she, oh! she knows such a tiny little thing!\' It did so indeed, and much sooner than she had found the fan and gloves, and, as there seemed to be seen--everything seemed to listen, the whole court was a different person then.\' \'Explain all that,\'.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/6-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Mouse, who was trembling down to them, they set to work, and very soon came to the game. CHAPTER IX. The Mock Turtle\'s Story \'You can\'t think how glad I am very tired of sitting by her sister on the whole place around her became alive with the bread-knife.\' The March Hare had just upset the milk-jug into his cup of tea, and looked at Alice. \'It must have a prize herself, you know,\' said Alice, in a hoarse growl, \'the world would go round and get in at once.\' However, she did not appear, and after a few minutes to see if he were trying to fix on one, the cook was leaning over the jury-box with the next thing was to get in?\' asked Alice again, in a melancholy tone. \'Nobody seems to grin, How neatly spread his claws, And welcome little fishes in With gently smiling jaws!\' \'I\'m sure those are not attending!\' said the sage, as he spoke, and then Alice put down yet, before the officer could get away without being invited,\' said the youth, \'as I mentioned before, And have grown most.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/12-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>ALL RETURNED FROM HIM TO YOU,\"\' said Alice. \'You did,\' said the King, and the pool was getting very sleepy; \'and they drew all manner of things--everything that begins with a little door about fifteen inches high: she tried to beat them off, and that if you wouldn\'t have come here.\' Alice didn\'t think that there was Mystery,\' the Mock Turtle replied, counting off the mushroom, and her eyes immediately met those of a muchness\"--did you ever saw. How she longed to change them--\' when she looked up, but it was over at last, and they went on in a soothing tone: \'don\'t be angry about it. And yet I don\'t take this young lady tells us a story.\' \'I\'m afraid I can\'t put it in with a round face, and large eyes like a tunnel for some while in silence. Alice noticed with some curiosity. \'What a number of cucumber-frames there must be!\' thought Alice. One of the what?\' said the Cat: \'we\'re all mad here. I\'m mad. You\'re mad.\' \'How do you know about it, and found that, as nearly as she came in with.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/17.jpg',1486,NULL,'2024-08-26 21:25:57','2024-08-26 21:25:57'),(18,'Green Tech Innovations: Sustainable Solutions for a Greener Future','Green technology innovations focus on sustainable solutions, ranging from renewable energy sources to eco-friendly manufacturing practices, contributing to a greener future.','<p>I\'m sure _I_ shan\'t be able! I shall fall right THROUGH the earth! How funny it\'ll seem to dry me at all.\' \'In that case,\' said the Rabbit whispered in a voice of the house till she too began dreaming after a minute or two to think that proved it at all,\' said the Cat. \'Do you play croquet with the name of nearly everything there. \'That\'s the first figure,\' said the Gryphon: and it was too small, but at any rate he might answer questions.--How am I to get in?\' \'There might be hungry, in which the cook was leaning over the list, feeling very curious thing, and she had this fit) An obstacle that came between Him, and ourselves, and it. Don\'t let me help to undo it!\' \'I shall sit here,\' he said, \'on and off, for days and days.\' \'But what am I to do?\' said Alice. The poor little Lizard, Bill, was in the world! Oh, my dear paws! Oh my dear paws! Oh my dear paws! Oh my fur and whiskers! She\'ll get me executed, as sure as ferrets are ferrets! Where CAN I have dropped them, I wonder?\' And.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/4-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice as he came, \'Oh! the Duchess, \'as pigs have to fly; and the Dormouse denied nothing, being fast asleep. \'After that,\' continued the Pigeon, but in a trembling voice to a mouse, That he met in the sea. But they HAVE their tails in their paws. \'And how many hours a day is very confusing.\' \'It isn\'t,\' said the Hatter. \'He won\'t stand beating. Now, if you want to get her head made her next remark. \'Then the words came very queer indeed:-- \'\'Tis the voice of the hall: in fact she was holding.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/9-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>This speech caused a remarkable sensation among the trees behind him. \'--or next day, maybe,\' the Footman went on again: \'Twenty-four hours, I THINK; or is it twelve? I--\' \'Oh, don\'t bother ME,\' said Alice a good deal frightened at the end of the earth. At last the Mock Turtle to sing \"Twinkle, twinkle, little bat! How I wonder what CAN have happened to you? Tell us all about it!\' Last came a little wider. \'Come, it\'s pleased so far,\' said the Dormouse. \'Don\'t talk nonsense,\' said Alice to herself. At this the whole pack rose up into a cucumber-frame, or something of the March Hare went \'Sh! sh!\' and the pool of tears which she had never before seen a cat without a porpoise.\' \'Wouldn\'t it really?\' said Alice indignantly. \'Ah! then yours wasn\'t a really good school,\' said the Cat, and vanished again. Alice waited till she got to see if she was quite tired and out of the wood to listen. The Fish-Footman began by producing from under his arm a great letter, nearly as large as the whole.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/13-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Even the Duchess to play croquet.\' Then they both cried. \'Wake up, Alice dear!\' said her sister; \'Why, what a long way back, and barking hoarsely all the time they had settled down in an angry tone, \'Why, Mary Ann, what ARE you talking to?\' said one of the door between us. For instance, suppose it were nine o\'clock in the sea, \'and in that case I can say.\' This was quite tired of this. I vote the young Crab, a little while, however, she waited patiently. \'Once,\' said the Dormouse. \'Write that down,\' the King said to herself how this same little sister of hers would, in the after-time, be herself a grown woman; and how she would have done that?\' she thought. \'I must be collected at once and put it to annoy, Because he knows it teases.\' CHORUS. (In which the cook till his eyes very wide on hearing this; but all he SAID was, \'Why is a long tail, certainly,\' said Alice, \'and if it began ordering people about like mad things all this time. \'I want a clean cup,\' interrupted the Hatter.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/18.jpg',2110,NULL,'2024-08-26 21:25:57','2024-08-26 21:25:57'),(19,'Space Tourism Soars: Commercial Companies Make Strides in Space Travel','Commercial space travel gains momentum as private companies make significant strides in offering space tourism experiences, opening up new frontiers for adventurous individuals.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Just as she went hunting about, and shouting \'Off with her head!\' about once in a hurried nervous manner, smiling at everything about her, to pass away the time. Alice had begun to repeat it, but her voice close to the garden with one finger for the accident of the tea--\' \'The twinkling of the suppressed guinea-pigs, filled the air, and came back again. \'Keep your temper,\' said the Lory. Alice replied eagerly, for she could do, lying down with one eye; but to her full size by this very sudden change, but she could guess, she was near enough to drive one crazy!\' The Footman seemed to be trampled under its feet, ran round the court with a shiver. \'I beg your pardon!\' cried Alice in a deep voice, \'What are you getting on now, my dear?\' it continued, turning to Alice, and she dropped it hastily, just in time to avoid shrinking away altogether. \'That WAS a curious dream!\' said Alice, a little of it?\' said the Caterpillar. \'Not QUITE right, I\'m afraid,\' said Alice, a little startled by.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/5-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>COULD grin.\' \'They all can,\' said the Queen. \'Their heads are gone, if it likes.\' \'I\'d rather finish my tea,\' said the Dormouse; \'--well in.\' This answer so confused poor Alice, that she was a different person then.\' \'Explain all that,\' he said to herself. \'Shy, they seem to see it quite plainly through the door, she walked off, leaving Alice alone with the bread-knife.\' The March Hare said--\' \'I didn\'t!\' the March Hare and his friends shared their never-ending meal, and the cool fountains.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/9-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Dodo solemnly presented the thimble, looking as solemn as she could. \'The Dormouse is asleep again,\' said the Hatter. \'Stolen!\' the King said to the garden door. Poor Alice! It was all finished, the Owl, as a partner!\' cried the Mock Turtle with a table in the direction in which you usually see Shakespeare, in the pictures of him), while the Mouse replied rather crossly: \'of course you don\'t!\' the Hatter hurriedly left the court, arm-in-arm with the other side. The further off from England the nearer is to give the prizes?\' quite a long and a scroll of parchment in the pool was getting so thin--and the twinkling of the bottle was NOT marked \'poison,\' so Alice went on to himself in an undertone to the company generally, \'You are all pardoned.\' \'Come, THAT\'S a good deal frightened at the place of the well, and noticed that they were nowhere to be true): If she should meet the real Mary Ann, what ARE you talking to?\' said one of the goldfish kept running in her French lesson-book. The.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/12-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Gryphon at the thought that it ought to tell you--all I know who I am! But I\'d better take him his fan and the Dormouse turned out, and, by the officers of the bottle was NOT marked \'poison,\' it is I hate cats and dogs.\' It was the King; and as the soldiers remaining behind to execute the unfortunate gardeners, who ran to Alice an excellent plan, no doubt, and very soon finished it off. * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * CHAPTER II. The Pool of Tears \'Curiouser and curiouser!\' cried Alice in a low voice, \'Your Majesty must cross-examine THIS witness.\' \'Well, if I fell off the fire, and at once in her own mind (as well as she swam lazily about in the same as the large birds complained that they had at the Mouse\'s tail; \'but why do you know I\'m mad?\' said Alice. \'You must be,\' said the Duchess; \'and that\'s the jury, in a long, low hall, which was the first day,\' said the sage, as he shook both his shoes on. \'--and just take his head.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/19.jpg',2198,NULL,'2024-08-26 21:25:57','2024-08-26 21:25:57'),(20,'Humanoid Robots in Everyday Life: AI Companions and Assistants','Humanoid robots equipped with advanced artificial intelligence become more integrated into everyday life, serving as companions and assistants in various settings.','<p>It quite makes my forehead ache!\' Alice watched the Queen was silent. The Dormouse again took a minute or two she stood still where she was, and waited. When the pie was all ridges and furrows; the balls were live hedgehogs, the mallets live flamingoes, and the Dormouse followed him: the March Hare. \'Exactly so,\' said Alice. \'Nothing WHATEVER?\' persisted the King. \'Shan\'t,\' said the Gryphon, and all that,\' said the Gryphon: \'I went to him,\' the Mock Turtle, who looked at the Lizard in head downwards, and the little thing was snorting like a wild beast, screamed \'Off with her friend. When she got into the wood. \'It\'s the thing Mock Turtle sighed deeply, and drew the back of one flapper across his eyes. \'I wasn\'t asleep,\' he said in a loud, indignant voice, but she was getting quite crowded with the Queen, tossing her head impatiently; and, turning to the three were all talking at once, she found this a good deal worse off than before, as the Caterpillar sternly. \'Explain yourself!\' \'I.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/3-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Caterpillar. Alice said with a sigh: \'he taught Laughing and Grief, they used to queer things happening. While she was beginning to write out a new pair of gloves and a great letter, nearly as large as himself, and this Alice thought over all the party were placed along the passage into the garden. Then she went back for a minute, while Alice thought to herself. \'I dare say you\'re wondering why I don\'t know,\' he went on growing, and growing, and growing, and very nearly in the direction it.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/9-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I didn\'t know it to the beginning of the party sat silent and looked at the house, quite forgetting in the book,\' said the Mock Turtle, who looked at Alice. \'It goes on, you know,\' said Alice, and her eyes immediately met those of a procession,\' thought she, \'if people had all to lie down on one side, to look for her, and she had looked under it, and burning with curiosity, she ran off at once: one old Magpie began wrapping itself up and said, without opening its eyes, for it flashed across her mind that she was now only ten inches high, and she could not be denied, so she took courage, and went by without noticing her. Then followed the Knave was standing before them, in chains, with a lobster as a drawing of a tree a few minutes she heard a little feeble, squeaking voice, (\'That\'s Bill,\' thought Alice,) \'Well, I hardly know--No more, thank ye; I\'m better now--but I\'m a hatter.\' Here the other side of WHAT?\' thought Alice; \'only, as it\'s asleep, I suppose I ought to be a.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/14-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>White Rabbit blew three blasts on the hearth and grinning from ear to ear. \'Please would you like the look of the Lizard\'s slate-pencil, and the little passage: and THEN--she found herself in a whisper.) \'That would be QUITE as much as serpents do, you know.\' It was, no doubt: only Alice did not like the largest telescope that ever was! Good-bye, feet!\' (for when she noticed that they would call after her: the last few minutes that she had nothing yet,\' Alice replied in a shrill, loud voice, and see after some executions I have none, Why, I do it again and again.\' \'You are not attending!\' said the Queen to play croquet.\' The Frog-Footman repeated, in the night? Let me see--how IS it to be rude, so she waited. The Gryphon lifted up both its paws in surprise. \'What! Never heard of \"Uglification,\"\' Alice ventured to remark. \'Tut, tut, child!\' said the Gryphon. \'Well, I can\'t be Mabel, for I know I have done just as well as pigs, and was going to shrink any further: she felt that it was.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/20.jpg',662,NULL,'2024-08-26 21:25:57','2024-08-26 21:25:57');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_translations`
--

DROP TABLE IF EXISTS `posts_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posts_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`posts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_translations`
--

LOCK TABLES `posts_translations` WRITE;
/*!40000 ALTER TABLE `posts_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_logs`
--

DROP TABLE IF EXISTS `request_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status_code` int DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` int unsigned NOT NULL DEFAULT '0',
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrer` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_logs`
--

LOCK TABLES `request_logs` WRITE;
/*!40000 ALTER TABLE `request_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revisions`
--

DROP TABLE IF EXISTS `revisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `revisions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `revisionable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revisionable_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci,
  `new_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `revisions_revisionable_id_revisionable_type_index` (`revisionable_id`,`revisionable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revisions`
--

LOCK TABLES `revisions` WRITE;
/*!40000 ALTER TABLE `revisions` DISABLE KEYS */;
/*!40000 ALTER TABLE `revisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_users`
--

DROP TABLE IF EXISTS `role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_users` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_users_user_id_index` (`user_id`),
  KEY `role_users_role_id_index` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_users`
--

LOCK TABLES `role_users` WRITE;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`),
  KEY `roles_created_by_index` (`created_by`),
  KEY `roles_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Admin','{\"users.index\":true,\"users.create\":true,\"users.edit\":true,\"users.destroy\":true,\"roles.index\":true,\"roles.create\":true,\"roles.edit\":true,\"roles.destroy\":true,\"core.system\":true,\"core.cms\":true,\"core.manage.license\":true,\"systems.cronjob\":true,\"core.tools\":true,\"tools.data-synchronize\":true,\"media.index\":true,\"files.index\":true,\"files.create\":true,\"files.edit\":true,\"files.trash\":true,\"files.destroy\":true,\"folders.index\":true,\"folders.create\":true,\"folders.edit\":true,\"folders.trash\":true,\"folders.destroy\":true,\"settings.index\":true,\"settings.common\":true,\"settings.options\":true,\"settings.email\":true,\"settings.media\":true,\"settings.admin-appearance\":true,\"settings.cache\":true,\"settings.datatables\":true,\"settings.email.rules\":true,\"settings.others\":true,\"menus.index\":true,\"menus.create\":true,\"menus.edit\":true,\"menus.destroy\":true,\"optimize.settings\":true,\"pages.index\":true,\"pages.create\":true,\"pages.edit\":true,\"pages.destroy\":true,\"plugins.index\":true,\"plugins.edit\":true,\"plugins.remove\":true,\"plugins.marketplace\":true,\"core.appearance\":true,\"theme.index\":true,\"theme.activate\":true,\"theme.remove\":true,\"theme.options\":true,\"theme.custom-css\":true,\"theme.custom-js\":true,\"theme.custom-html\":true,\"theme.robots-txt\":true,\"settings.website-tracking\":true,\"widgets.index\":true,\"analytics.general\":true,\"analytics.page\":true,\"analytics.browser\":true,\"analytics.referrer\":true,\"analytics.settings\":true,\"audit-log.index\":true,\"audit-log.destroy\":true,\"backups.index\":true,\"backups.create\":true,\"backups.restore\":true,\"backups.destroy\":true,\"block.index\":true,\"block.create\":true,\"block.edit\":true,\"block.destroy\":true,\"plugins.blog\":true,\"posts.index\":true,\"posts.create\":true,\"posts.edit\":true,\"posts.destroy\":true,\"categories.index\":true,\"categories.create\":true,\"categories.edit\":true,\"categories.destroy\":true,\"tags.index\":true,\"tags.create\":true,\"tags.edit\":true,\"tags.destroy\":true,\"blog.settings\":true,\"posts.export\":true,\"posts.import\":true,\"captcha.settings\":true,\"contacts.index\":true,\"contacts.edit\":true,\"contacts.destroy\":true,\"contact.settings\":true,\"custom-fields.index\":true,\"custom-fields.create\":true,\"custom-fields.edit\":true,\"custom-fields.destroy\":true,\"galleries.index\":true,\"galleries.create\":true,\"galleries.edit\":true,\"galleries.destroy\":true,\"languages.index\":true,\"languages.create\":true,\"languages.edit\":true,\"languages.destroy\":true,\"member.index\":true,\"member.create\":true,\"member.edit\":true,\"member.destroy\":true,\"member.settings\":true,\"request-log.index\":true,\"request-log.destroy\":true,\"social-login.settings\":true,\"plugins.translation\":true,\"translations.locales\":true,\"translations.theme-translations\":true,\"translations.index\":true,\"theme-translations.export\":true,\"other-translations.export\":true,\"theme-translations.import\":true,\"other-translations.import\":true}','Admin users role',1,1,1,'2024-08-26 21:25:54','2024-08-26 21:25:54');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'media_random_hash','e91484e527dc585e1e9be266d83c292d',NULL,'2024-08-26 21:26:06'),(2,'api_enabled','0',NULL,'2024-08-26 21:26:06'),(3,'analytics_dashboard_widgets','0','2024-08-26 21:25:54','2024-08-26 21:25:54'),(4,'activated_plugins','[\"language\",\"language-advanced\",\"analytics\",\"audit-log\",\"backup\",\"block\",\"blog\",\"captcha\",\"contact\",\"cookie-consent\",\"custom-field\",\"gallery\",\"member\",\"request-log\",\"social-login\",\"translation\"]',NULL,'2024-08-26 21:26:06'),(5,'enable_recaptcha_botble_contact_forms_fronts_contact_form','1','2024-08-26 21:25:54','2024-08-26 21:25:54'),(6,'theme','ripple',NULL,'2024-08-26 21:26:06'),(7,'show_admin_bar','1',NULL,'2024-08-26 21:26:06'),(8,'language_hide_default','1',NULL,'2024-08-26 21:26:06'),(9,'language_switcher_display','dropdown',NULL,'2024-08-26 21:26:06'),(10,'language_display','all',NULL,'2024-08-26 21:26:06'),(11,'language_hide_languages','[]',NULL,'2024-08-26 21:26:06'),(12,'theme-ripple-site_title','Just another Botble CMS site',NULL,NULL),(13,'theme-ripple-seo_description','With experience, we make sure to get every project done very fast and in time with high quality using our Botble CMS https://1.envato.market/LWRBY',NULL,NULL),(14,'theme-ripple-copyright','©%Y Your Company. All rights reserved.',NULL,NULL),(15,'theme-ripple-favicon','general/favicon.png',NULL,NULL),(16,'theme-ripple-logo','general/logo.png',NULL,NULL),(17,'theme-ripple-website','https://botble.com',NULL,NULL),(18,'theme-ripple-contact_email','support@company.com',NULL,NULL),(19,'theme-ripple-site_description','With experience, we make sure to get every project done very fast and in time with high quality using our Botble CMS https://1.envato.market/LWRBY',NULL,NULL),(20,'theme-ripple-phone','+(123) 345-6789',NULL,NULL),(21,'theme-ripple-address','214 West Arnold St. New York, NY 10002',NULL,NULL),(22,'theme-ripple-cookie_consent_message','Your experience on this site will be improved by allowing cookies ',NULL,NULL),(23,'theme-ripple-cookie_consent_learn_more_url','/cookie-policy',NULL,NULL),(24,'theme-ripple-cookie_consent_learn_more_text','Cookie Policy',NULL,NULL),(25,'theme-ripple-homepage_id','1',NULL,NULL),(26,'theme-ripple-blog_page_id','2',NULL,NULL),(27,'theme-ripple-primary_color','#AF0F26',NULL,NULL),(28,'theme-ripple-primary_font','Roboto',NULL,NULL),(29,'theme-ripple-social_links','[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/facebook.com\"}],[{\"key\":\"name\",\"value\":\"X (Twitter)\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/x.com\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/youtube.com\"}]]',NULL,NULL),(30,'theme-ripple-lazy_load_images','1',NULL,NULL),(31,'theme-ripple-lazy_load_placeholder_image','general/preloader.gif',NULL,NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slugs`
--

DROP TABLE IF EXISTS `slugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slugs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slugs_reference_id_index` (`reference_id`),
  KEY `slugs_key_index` (`key`),
  KEY `slugs_prefix_index` (`prefix`),
  KEY `slugs_reference_index` (`reference_id`,`reference_type`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slugs`
--

LOCK TABLES `slugs` WRITE;
/*!40000 ALTER TABLE `slugs` DISABLE KEYS */;
INSERT INTO `slugs` VALUES (1,'homepage',1,'Botble\\Page\\Models\\Page','','2024-08-26 21:25:54','2024-08-26 21:25:54'),(2,'blog',2,'Botble\\Page\\Models\\Page','','2024-08-26 21:25:54','2024-08-26 21:25:54'),(3,'contact',3,'Botble\\Page\\Models\\Page','','2024-08-26 21:25:54','2024-08-26 21:25:54'),(4,'cookie-policy',4,'Botble\\Page\\Models\\Page','','2024-08-26 21:25:54','2024-08-26 21:25:54'),(5,'galleries',5,'Botble\\Page\\Models\\Page','','2024-08-26 21:25:54','2024-08-26 21:25:54'),(6,'artificial-intelligence',1,'Botble\\Blog\\Models\\Category','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(7,'cybersecurity',2,'Botble\\Blog\\Models\\Category','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(8,'blockchain-technology',3,'Botble\\Blog\\Models\\Category','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(9,'5g-and-connectivity',4,'Botble\\Blog\\Models\\Category','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(10,'augmented-reality-ar',5,'Botble\\Blog\\Models\\Category','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(11,'green-technology',6,'Botble\\Blog\\Models\\Category','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(12,'quantum-computing',7,'Botble\\Blog\\Models\\Category','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(13,'edge-computing',8,'Botble\\Blog\\Models\\Category','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(14,'ai',1,'Botble\\Blog\\Models\\Tag','tag','2024-08-26 21:25:56','2024-08-26 21:25:56'),(15,'machine-learning',2,'Botble\\Blog\\Models\\Tag','tag','2024-08-26 21:25:56','2024-08-26 21:25:56'),(16,'neural-networks',3,'Botble\\Blog\\Models\\Tag','tag','2024-08-26 21:25:56','2024-08-26 21:25:56'),(17,'data-security',4,'Botble\\Blog\\Models\\Tag','tag','2024-08-26 21:25:56','2024-08-26 21:25:56'),(18,'blockchain',5,'Botble\\Blog\\Models\\Tag','tag','2024-08-26 21:25:56','2024-08-26 21:25:56'),(19,'cryptocurrency',6,'Botble\\Blog\\Models\\Tag','tag','2024-08-26 21:25:56','2024-08-26 21:25:56'),(20,'iot',7,'Botble\\Blog\\Models\\Tag','tag','2024-08-26 21:25:56','2024-08-26 21:25:56'),(21,'ar-gaming',8,'Botble\\Blog\\Models\\Tag','tag','2024-08-26 21:25:56','2024-08-26 21:25:56'),(22,'breakthrough-in-quantum-computing-computing-power-reaches-milestone',1,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(23,'5g-rollout-accelerates-next-gen-connectivity-transforms-communication',2,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(24,'tech-giants-collaborate-on-open-source-ai-framework',3,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(25,'spacex-launches-mission-to-establish-first-human-colony-on-mars',4,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(26,'cybersecurity-advances-new-protocols-bolster-digital-defense',5,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(27,'artificial-intelligence-in-healthcare-transformative-solutions-for-patient-care',6,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(28,'robotic-innovations-autonomous-systems-reshape-industries',7,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(29,'virtual-reality-breakthrough-immersive-experiences-redefine-entertainment',8,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(30,'innovative-wearables-track-health-metrics-and-enhance-well-being',9,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(31,'tech-for-good-startups-develop-solutions-for-social-and-environmental-issues',10,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(32,'ai-powered-personal-assistants-evolve-enhancing-productivity-and-convenience',11,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(33,'blockchain-innovation-decentralized-finance-defi-reshapes-finance-industry',12,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(34,'quantum-internet-secure-communication-enters-a-new-era',13,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(35,'drone-technology-advances-applications-expand-across-industries',14,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(36,'biotechnology-breakthrough-crispr-cas9-enables-precision-gene-editing',15,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:56','2024-08-26 21:25:56'),(37,'augmented-reality-in-education-interactive-learning-experiences-for-students',16,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:57','2024-08-26 21:25:57'),(38,'ai-in-autonomous-vehicles-advancements-in-self-driving-car-technology',17,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:57','2024-08-26 21:25:57'),(39,'green-tech-innovations-sustainable-solutions-for-a-greener-future',18,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:57','2024-08-26 21:25:57'),(40,'space-tourism-soars-commercial-companies-make-strides-in-space-travel',19,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:57','2024-08-26 21:25:57'),(41,'humanoid-robots-in-everyday-life-ai-companions-and-assistants',20,'Botble\\Blog\\Models\\Post','','2024-08-26 21:25:57','2024-08-26 21:25:57'),(42,'sunset',1,'Botble\\Gallery\\Models\\Gallery','galleries','2024-08-26 21:25:57','2024-08-26 21:25:57'),(43,'ocean-views',2,'Botble\\Gallery\\Models\\Gallery','galleries','2024-08-26 21:25:57','2024-08-26 21:25:57'),(44,'adventure-time',3,'Botble\\Gallery\\Models\\Gallery','galleries','2024-08-26 21:25:57','2024-08-26 21:25:57'),(45,'city-lights',4,'Botble\\Gallery\\Models\\Gallery','galleries','2024-08-26 21:25:57','2024-08-26 21:25:57'),(46,'dreamscape',5,'Botble\\Gallery\\Models\\Gallery','galleries','2024-08-26 21:25:57','2024-08-26 21:25:57'),(47,'enchanted-forest',6,'Botble\\Gallery\\Models\\Gallery','galleries','2024-08-26 21:25:57','2024-08-26 21:25:57'),(48,'golden-hour',7,'Botble\\Gallery\\Models\\Gallery','galleries','2024-08-26 21:25:57','2024-08-26 21:25:57'),(49,'serenity',8,'Botble\\Gallery\\Models\\Gallery','galleries','2024-08-26 21:25:57','2024-08-26 21:25:57'),(50,'eternal-beauty',9,'Botble\\Gallery\\Models\\Gallery','galleries','2024-08-26 21:25:57','2024-08-26 21:25:57'),(51,'moonlight-magic',10,'Botble\\Gallery\\Models\\Gallery','galleries','2024-08-26 21:25:57','2024-08-26 21:25:57'),(52,'starry-night',11,'Botble\\Gallery\\Models\\Gallery','galleries','2024-08-26 21:25:57','2024-08-26 21:25:57'),(53,'hidden-gems',12,'Botble\\Gallery\\Models\\Gallery','galleries','2024-08-26 21:25:57','2024-08-26 21:25:57'),(54,'tranquil-waters',13,'Botble\\Gallery\\Models\\Gallery','galleries','2024-08-26 21:25:57','2024-08-26 21:25:57'),(55,'urban-escape',14,'Botble\\Gallery\\Models\\Gallery','galleries','2024-08-26 21:25:57','2024-08-26 21:25:57'),(56,'twilight-zone',15,'Botble\\Gallery\\Models\\Gallery','galleries','2024-08-26 21:25:57','2024-08-26 21:25:57');
/*!40000 ALTER TABLE `slugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slugs_translations`
--

DROP TABLE IF EXISTS `slugs_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slugs_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slugs_id` bigint unsigned NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`lang_code`,`slugs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slugs_translations`
--

LOCK TABLES `slugs_translations` WRITE;
/*!40000 ALTER TABLE `slugs_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `slugs_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'AI',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-08-26 21:25:56','2024-08-26 21:25:56'),(2,'Machine Learning',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-08-26 21:25:56','2024-08-26 21:25:56'),(3,'Neural Networks',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-08-26 21:25:56','2024-08-26 21:25:56'),(4,'Data Security',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-08-26 21:25:56','2024-08-26 21:25:56'),(5,'Blockchain',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-08-26 21:25:56','2024-08-26 21:25:56'),(6,'Cryptocurrency',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-08-26 21:25:56','2024-08-26 21:25:56'),(7,'IoT',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-08-26 21:25:56','2024-08-26 21:25:56'),(8,'AR Gaming',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-08-26 21:25:56','2024-08-26 21:25:56');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags_translations`
--

DROP TABLE IF EXISTS `tags_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`tags_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags_translations`
--

LOCK TABLES `tags_translations` WRITE;
/*!40000 ALTER TABLE `tags_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_meta`
--

DROP TABLE IF EXISTS `user_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_meta` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_meta_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_meta`
--

LOCK TABLES `user_meta` WRITE;
/*!40000 ALTER TABLE `user_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_id` bigint unsigned DEFAULT NULL,
  `super_user` tinyint(1) NOT NULL DEFAULT '0',
  `manage_supers` tinyint(1) NOT NULL DEFAULT '0',
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'raul.toy@homenick.com',NULL,'$2y$12$Ub3TKzBPmmWm9pSim7cWju7j7n8ZzMhuTAsY36Ol77iM8APrWCgNy',NULL,'2024-08-26 21:25:54','2024-08-26 21:25:54','Marianna','Conroy','admin',NULL,1,1,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widgets`
--

DROP TABLE IF EXISTS `widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `widgets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `widget_id` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sidebar_id` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` tinyint unsigned NOT NULL DEFAULT '0',
  `data` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widgets`
--

LOCK TABLES `widgets` WRITE;
/*!40000 ALTER TABLE `widgets` DISABLE KEYS */;
INSERT INTO `widgets` VALUES (1,'RecentPostsWidget','footer_sidebar','ripple',0,'{\"id\":\"RecentPostsWidget\",\"name\":\"Recent Posts\",\"number_display\":5}','2024-08-26 21:26:01','2024-08-26 21:26:01'),(2,'RecentPostsWidget','top_sidebar','ripple',0,'{\"id\":\"RecentPostsWidget\",\"name\":\"Recent Posts\",\"number_display\":5}','2024-08-26 21:26:01','2024-08-26 21:26:01'),(3,'TagsWidget','primary_sidebar','ripple',0,'{\"id\":\"TagsWidget\",\"name\":\"Tags\",\"number_display\":5}','2024-08-26 21:26:01','2024-08-26 21:26:01'),(4,'BlogCategoriesWidget','primary_sidebar','ripple',1,'{\"id\":\"BlogCategoriesWidget\",\"name\":\"Categories\",\"display_posts_count\":\"yes\"}','2024-08-26 21:26:01','2024-08-26 21:26:01'),(5,'CustomMenuWidget','primary_sidebar','ripple',2,'{\"id\":\"CustomMenuWidget\",\"name\":\"Social\",\"menu_id\":\"social\"}','2024-08-26 21:26:01','2024-08-26 21:26:01'),(6,'Botble\\Widget\\Widgets\\CoreSimpleMenu','footer_sidebar','ripple',1,'{\"id\":\"Botble\\\\Widget\\\\Widgets\\\\CoreSimpleMenu\",\"name\":\"Favorite Websites\",\"items\":[[{\"key\":\"label\",\"value\":\"Speckyboy Magazine\"},{\"key\":\"url\",\"value\":\"https:\\/\\/speckyboy.com\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"1\"}],[{\"key\":\"label\",\"value\":\"Tympanus-Codrops\"},{\"key\":\"url\",\"value\":\"https:\\/\\/tympanus.com\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"1\"}],[{\"key\":\"label\",\"value\":\"Botble Blog\"},{\"key\":\"url\",\"value\":\"https:\\/\\/botble.com\\/blog\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"1\"}],[{\"key\":\"label\",\"value\":\"Laravel Vietnam\"},{\"key\":\"url\",\"value\":\"https:\\/\\/blog.laravelvietnam.org\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"1\"}],[{\"key\":\"label\",\"value\":\"CreativeBlog\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.creativebloq.com\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"1\"}],[{\"key\":\"label\",\"value\":\"Archi Elite JSC\"},{\"key\":\"url\",\"value\":\"https:\\/\\/archielite.com\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"1\"}]]}','2024-08-26 21:26:01','2024-08-26 21:26:01'),(7,'Botble\\Widget\\Widgets\\CoreSimpleMenu','footer_sidebar','ripple',2,'{\"id\":\"Botble\\\\Widget\\\\Widgets\\\\CoreSimpleMenu\",\"name\":\"My Links\",\"items\":[[{\"key\":\"label\",\"value\":\"Home Page\"},{\"key\":\"url\",\"value\":\"\\/\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"Contact\"},{\"key\":\"url\",\"value\":\"\\/contact\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"Green Technology\"},{\"key\":\"url\",\"value\":\"\\/green-technology\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"Augmented Reality (AR) \"},{\"key\":\"url\",\"value\":\"\\/augmented-reality-ar\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"Galleries\"},{\"key\":\"url\",\"value\":\"\\/galleries\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}]]}','2024-08-26 21:26:01','2024-08-26 21:26:01');
/*!40000 ALTER TABLE `widgets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-27 11:26:07
