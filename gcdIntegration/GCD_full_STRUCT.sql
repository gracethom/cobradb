-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: mysql0a.comics.org    Database: gcd
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.12.04.1-log

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
-- Table structure for table `gcd_country`
--

DROP TABLE IF EXISTS `gcd_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_2` (`code`),
  KEY `country` (`name`(50))
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `gcd_language`
--

DROP TABLE IF EXISTS `gcd_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_2` (`code`),
  KEY `language` (`name`(10))
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `gcd_story_type`
--

DROP TABLE IF EXISTS `gcd_story_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_story_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sort_code` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `sort_code` (`sort_code`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;




--
-- Table structure for table `gcd_issue_reprint`
--

DROP TABLE IF EXISTS `gcd_issue_reprint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_issue_reprint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origin_issue_id` int(11) NOT NULL,
  `target_issue_id` int(11) NOT NULL,
  `notes` longtext NOT NULL,
  `reserved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `issue_from` (`origin_issue_id`),
  KEY `issue_to` (`target_issue_id`),
  KEY `reserved` (`reserved`),
  CONSTRAINT `gcd_issue_reprint_ibfk_1` FOREIGN KEY (`origin_issue_id`) REFERENCES `gcd_issue` (`id`),
  CONSTRAINT `gcd_issue_reprint_ibfk_2` FOREIGN KEY (`target_issue_id`) REFERENCES `gcd_issue` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4481 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `gcd_reprint`
--

DROP TABLE IF EXISTS `gcd_reprint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_reprint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origin_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `notes` longtext NOT NULL,
  `reserved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `reprint_from` (`origin_id`),
  KEY `reprint_to` (`target_id`),
  KEY `reserved` (`reserved`),
  CONSTRAINT `gcd_reprint_ibfk_1` FOREIGN KEY (`origin_id`) REFERENCES `gcd_story` (`id`),
  CONSTRAINT `gcd_reprint_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `gcd_story` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=281061 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `gcd_reprint_from_issue`
--

DROP TABLE IF EXISTS `gcd_reprint_from_issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_reprint_from_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origin_issue_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `notes` longtext NOT NULL,
  `reserved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `reprint_to_issue_from` (`origin_issue_id`),
  KEY `reprint_to_issue_to` (`target_id`),
  KEY `reserved` (`reserved`),
  CONSTRAINT `gcd_reprint_from_issue_ibfk_1` FOREIGN KEY (`origin_issue_id`) REFERENCES `gcd_issue` (`id`),
  CONSTRAINT `gcd_reprint_from_issue_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `gcd_story` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103378 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `gcd_reprint_to_issue`
--

DROP TABLE IF EXISTS `gcd_reprint_to_issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_reprint_to_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origin_id` int(11) NOT NULL,
  `target_issue_id` int(11) NOT NULL,
  `notes` longtext NOT NULL,
  `reserved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `reprint_to_issue_from` (`origin_id`),
  KEY `reprint_to_issue_to` (`target_issue_id`),
  KEY `reserved` (`reserved`),
  CONSTRAINT `gcd_reprint_to_issue_ibfk_1` FOREIGN KEY (`origin_id`) REFERENCES `gcd_story` (`id`),
  CONSTRAINT `gcd_reprint_to_issue_ibfk_2` FOREIGN KEY (`target_issue_id`) REFERENCES `gcd_issue` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102083 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `gcd_brand_emblem_group`
--

DROP TABLE IF EXISTS `gcd_brand_emblem_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_brand_emblem_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `brandgroup_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gcd_brand_emblem_group_brand_id_4dd3b49d7f79dbe3_uniq` (`brand_id`,`brandgroup_id`),
  KEY `gcd_brand_emblem_group_74876276` (`brand_id`),
  KEY `gcd_brand_emblem_group_9eac909a` (`brandgroup_id`),
  CONSTRAINT `brandgroup_id_refs_id_3d239edd15609953` FOREIGN KEY (`brandgroup_id`) REFERENCES `gcd_brand_group` (`id`),
  CONSTRAINT `brand_id_refs_id_499c2f828021a0a5` FOREIGN KEY (`brand_id`) REFERENCES `gcd_brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8162 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `gcd_brand_use`
--

DROP TABLE IF EXISTS `gcd_brand_use`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_brand_use` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publisher_id` int(11) NOT NULL,
  `emblem_id` int(11) NOT NULL,
  `year_began` int(11) DEFAULT NULL,
  `year_ended` int(11) DEFAULT NULL,
  `year_began_uncertain` tinyint(1) NOT NULL,
  `year_ended_uncertain` tinyint(1) NOT NULL,
  `notes` longtext NOT NULL,
  `reserved` tinyint(1) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gcd_brand_use_22dd9c39` (`publisher_id`),
  KEY `gcd_brand_use_7c3d3954` (`emblem_id`),
  KEY `gcd_brand_use_d4f3f470` (`year_began`),
  KEY `gcd_brand_use_b5b058a2` (`year_began_uncertain`),
  KEY `gcd_brand_use_8c53af9d` (`year_ended_uncertain`),
  KEY `gcd_brand_use_3b2a5c11` (`reserved`),
  CONSTRAINT `emblem_id_refs_id_66e921df4498a093` FOREIGN KEY (`emblem_id`) REFERENCES `gcd_brand` (`id`),
  CONSTRAINT `publisher_id_refs_id_4bf8142e98fbb94c` FOREIGN KEY (`publisher_id`) REFERENCES `gcd_publisher` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6186 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;




--
-- Table structure for table `gcd_series_bond`
--

DROP TABLE IF EXISTS `gcd_series_bond`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_series_bond` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origin_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `origin_issue_id` int(11) DEFAULT NULL,
  `target_issue_id` int(11) DEFAULT NULL,
  `bond_type_id` int(11) NOT NULL,
  `notes` longtext NOT NULL,
  `reserved` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gcd_series_bond_bd654448` (`origin_id`),
  KEY `gcd_series_bond_9358c897` (`target_id`),
  KEY `gcd_series_bond_22a369b6` (`origin_issue_id`),
  KEY `gcd_series_bond_b219039` (`target_issue_id`),
  KEY `gcd_series_bond_1c107711` (`bond_type_id`),
  KEY `gcd_series_bond_3b2a5c11` (`reserved`),
  CONSTRAINT `bond_type_id_refs_id_74608925967dca7d` FOREIGN KEY (`bond_type_id`) REFERENCES `gcd_series_bond_type` (`id`),
  CONSTRAINT `origin_id_refs_id_2e5ee5bcc36327a6` FOREIGN KEY (`origin_id`) REFERENCES `gcd_series` (`id`),
  CONSTRAINT `origin_issue_id_refs_id_14846e21180392d7` FOREIGN KEY (`origin_issue_id`) REFERENCES `gcd_issue` (`id`),
  CONSTRAINT `target_id_refs_id_2e5ee5bcc36327a6` FOREIGN KEY (`target_id`) REFERENCES `gcd_series` (`id`),
  CONSTRAINT `target_issue_id_refs_id_14846e21180392d7` FOREIGN KEY (`target_issue_id`) REFERENCES `gcd_issue` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3755 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `gcd_series_bond_type`
--

DROP TABLE IF EXISTS `gcd_series_bond_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_series_bond_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `notes` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gcd_series_bond_type_52094d6e` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `gcd_series_publication_type`
--

DROP TABLE IF EXISTS `gcd_series_publication_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_series_publication_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `notes` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gcd_series_publication_type_52094d6e` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;




--
-- Table structure for table `gcd_publisher`
--

DROP TABLE IF EXISTS `gcd_publisher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_publisher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `year_began` int(11) DEFAULT NULL,
  `year_ended` int(11) DEFAULT NULL,
  `notes` longtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `is_master` tinyint(1) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `imprint_count` int(11) NOT NULL DEFAULT '0',
  `brand_count` int(11) NOT NULL DEFAULT '0',
  `indicia_publisher_count` int(11) NOT NULL DEFAULT '0',
  `series_count` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `issue_count` int(11) NOT NULL DEFAULT '0',
  `reserved` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `year_began_uncertain` tinyint(1) NOT NULL DEFAULT '0',
  `year_ended_uncertain` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `PubName` (`name`),
  KEY `ParentID` (`parent_id`),
  KEY `Master` (`is_master`),
  KEY `YearBegan` (`year_began`),
  KEY `reserved` (`reserved`),
  KEY `country_id` (`country_id`),
  KEY `brand_count` (`brand_count`),
  KEY `indicia_publisher_count` (`indicia_publisher_count`),
  KEY `deleted` (`deleted`),
  KEY `year_began_uncertain` (`year_began_uncertain`),
  KEY `year_ended_uncertain` (`year_ended_uncertain`),
  CONSTRAINT `gcd_publisher_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `gcd_country` (`id`),
  CONSTRAINT `gcd_publisher_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `gcd_publisher` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10483 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;




--
-- Table structure for table `gcd_brand_group`
--

DROP TABLE IF EXISTS `gcd_brand_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_brand_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `year_began` int(11) DEFAULT NULL,
  `year_ended` int(11) DEFAULT NULL,
  `year_began_uncertain` tinyint(1) NOT NULL,
  `year_ended_uncertain` tinyint(1) NOT NULL,
  `notes` longtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `reserved` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `issue_count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gcd_brand_group_52094d6e` (`name`),
  KEY `gcd_brand_group_d4f3f470` (`year_began`),
  KEY `gcd_brand_group_b5b058a2` (`year_began_uncertain`),
  KEY `gcd_brand_group_8c53af9d` (`year_ended_uncertain`),
  KEY `gcd_brand_group_3b2a5c11` (`reserved`),
  KEY `gcd_brand_group_6cc99b0b` (`deleted`),
  KEY `gcd_brand_group_63f17a16` (`parent_id`),
  CONSTRAINT `parent_id_refs_id_37eff265bd014aa2` FOREIGN KEY (`parent_id`) REFERENCES `gcd_publisher` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5659 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `gcd_brand`
--

DROP TABLE IF EXISTS `gcd_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11),
  `year_began` int(11) DEFAULT NULL,
  `year_ended` int(11) DEFAULT NULL,
  `notes` longtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `issue_count` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `reserved` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `year_began_uncertain` tinyint(1) NOT NULL DEFAULT '0',
  `year_ended_uncertain` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `parent_id` (`parent_id`),
  KEY `year_began` (`year_began`),
  KEY `reserved` (`reserved`),
  KEY `deleted` (`deleted`),
  KEY `year_began_uncertain` (`year_began_uncertain`),
  KEY `year_ended_uncertain` (`year_ended_uncertain`),
  CONSTRAINT `parent_id_refs_id_296ca0e2d5166db4` FOREIGN KEY (`parent_id`) REFERENCES `gcd_publisher` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6263 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `gcd_indicia_publisher`
--

DROP TABLE IF EXISTS `gcd_indicia_publisher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_indicia_publisher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `year_began` int(11) DEFAULT NULL,
  `year_ended` int(11) DEFAULT NULL,
  `is_surrogate` tinyint(1) NOT NULL DEFAULT '0',
  `notes` longtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `issue_count` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `reserved` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `year_began_uncertain` tinyint(1) NOT NULL DEFAULT '0',
  `year_ended_uncertain` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `parent_id` (`parent_id`),
  KEY `country_id` (`country_id`),
  KEY `year_began` (`year_began`),
  KEY `is_surrogate` (`is_surrogate`),
  KEY `reserved` (`reserved`),
  KEY `deleted` (`deleted`),
  KEY `year_began_uncertain` (`year_began_uncertain`),
  KEY `year_ended_uncertain` (`year_ended_uncertain`),
  CONSTRAINT `gcd_indicia_publisher_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `gcd_publisher` (`id`),
  CONSTRAINT `gcd_indicia_publisher_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `gcd_country` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4814 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;




--
-- Table structure for table `gcd_series`
--

DROP TABLE IF EXISTS `gcd_series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_series` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sort_name` varchar(255) NOT NULL,
  `format` varchar(255) NOT NULL DEFAULT '',
  `year_began` int(11) NOT NULL,
  `year_began_uncertain` tinyint(1) NOT NULL DEFAULT '0',
  `year_ended` int(11) DEFAULT NULL,
  `year_ended_uncertain` tinyint(1) NOT NULL DEFAULT '0',
  `publication_dates` varchar(255) NOT NULL DEFAULT '',
  `first_issue_id` int(11) DEFAULT NULL,
  `last_issue_id` int(11) DEFAULT NULL,
  `is_current` tinyint(1) NOT NULL DEFAULT '0',
  `publisher_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  
  `language_id` int(11) NOT NULL,
  
  `tracking_notes` longtext NOT NULL,
  `notes` longtext NOT NULL,
  `publication_notes` longtext NOT NULL,
  `has_gallery` tinyint(1) NOT NULL DEFAULT '0',
  `open_reserve` int(11) DEFAULT NULL,
  `issue_count` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `reserved` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `has_indicia_frequency` tinyint(1) NOT NULL DEFAULT '1',
  `has_isbn` tinyint(1) NOT NULL DEFAULT '1',
  `has_barcode` tinyint(1) NOT NULL DEFAULT '1',
  `has_issue_title` tinyint(1) NOT NULL DEFAULT '0',
  `has_volume` tinyint(1) NOT NULL DEFAULT '1',
  `is_comics_publication` tinyint(1) NOT NULL DEFAULT '1',
  `color` varchar(255) NOT NULL,
  `dimensions` varchar(255) NOT NULL,
  `paper_stock` varchar(255) NOT NULL,
  `binding` varchar(255) NOT NULL,
  `publishing_format` varchar(255) NOT NULL,
  `has_rating` tinyint(1) NOT NULL,
  
  `publication_type_id` int(11),
  
  `is_singleton` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `PubID` (`publisher_id`),
  KEY `Bk_Name` (`name`(150)),
  KEY `Yr_Began` (`year_began`),
  KEY `HasGallery` (`has_gallery`),
  KEY `reserved` (`reserved`),
  KEY `country_id` (`country_id`),
  KEY `language_id` (`language_id`),
  KEY `first_issue_id` (`first_issue_id`),
  KEY `last_issue_id` (`last_issue_id`),
  KEY `deleted` (`deleted`),
  KEY `is_current` (`is_current`),
  KEY `sort_name` (`sort_name`),
  KEY `gcd_series_49a7a4e1` (`publication_type_id`),
  CONSTRAINT `gcd_series_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `gcd_publisher` (`id`),
  CONSTRAINT `gcd_series_ibfk_3` FOREIGN KEY (`country_id`) REFERENCES `gcd_country` (`id`),
  CONSTRAINT `gcd_series_ibfk_4` FOREIGN KEY (`language_id`) REFERENCES `gcd_language` (`id`),
  CONSTRAINT `gcd_series_ibfk_5` FOREIGN KEY (`first_issue_id`) REFERENCES `gcd_issue` (`id`),
  CONSTRAINT `gcd_series_ibfk_6` FOREIGN KEY (`last_issue_id`) REFERENCES `gcd_issue` (`id`),
  CONSTRAINT `publication_type_id_refs_id_2c468df7974b9efa` FOREIGN KEY (`publication_type_id`) REFERENCES `gcd_series_publication_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93515 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `gcd_issue`
--

DROP TABLE IF EXISTS `gcd_issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(50) NOT NULL,
  `volume` varchar(50) NOT NULL DEFAULT '',
  `no_volume` tinyint(1) NOT NULL DEFAULT '0',
  `display_volume_with_number` tinyint(1) NOT NULL DEFAULT '0',
  `series_id` int(11) NOT NULL,
  `indicia_publisher_id` int(11) DEFAULT NULL,
  `indicia_pub_not_printed` tinyint(1) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `no_brand` tinyint(1) NOT NULL,
  `publication_date` varchar(255) NOT NULL,
  `key_date` varchar(10) NOT NULL,
  `sort_code` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `page_count` decimal(10,3) DEFAULT NULL,
  `page_count_uncertain` tinyint(1) NOT NULL DEFAULT '0',
  `indicia_frequency` varchar(255) NOT NULL DEFAULT '',
  `no_indicia_frequency` tinyint(1) NOT NULL DEFAULT '0',
  `editing` longtext NOT NULL,
  `no_editing` tinyint(1) NOT NULL DEFAULT '0',
  `notes` longtext NOT NULL,
  `created` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `reserved` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_indexed` tinyint(1) NOT NULL DEFAULT '0',
  `isbn` varchar(32) NOT NULL DEFAULT '',
  `valid_isbn` varchar(13) NOT NULL DEFAULT '',
  `no_isbn` tinyint(1) NOT NULL DEFAULT '0',
  `variant_of_id` int(11) DEFAULT NULL,
  `variant_name` varchar(255) NOT NULL DEFAULT '',
  `barcode` varchar(38) NOT NULL DEFAULT '',
  `no_barcode` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `no_title` tinyint(1) NOT NULL DEFAULT '0',
  `on_sale_date` varchar(10) NOT NULL,
  `on_sale_date_uncertain` tinyint(1) NOT NULL DEFAULT '0',
  `rating` varchar(255) NOT NULL,
  `no_rating` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `series_id_sort_code` (`series_id`,`sort_code`),
  KEY `SeriesID` (`series_id`),
  KEY `Key_Date` (`key_date`),
  KEY `Issue` (`number`),
  KEY `VolumeNum` (`volume`),
  KEY `Modified` (`modified`),
  KEY `reserved` (`reserved`),
  KEY `no_volume` (`no_volume`),
  KEY `display_volume_with_number` (`display_volume_with_number`),
  KEY `indicia_publisher_id` (`indicia_publisher_id`),
  KEY `brand_id` (`brand_id`),
  KEY `no_editing` (`no_editing`),
  KEY `sort_code` (`sort_code`),
  KEY `no_brand` (`no_brand`),
  KEY `deleted` (`deleted`),
  KEY `is_indexed` (`is_indexed`),
  KEY `isbn` (`isbn`),
  KEY `valid_isbn` (`valid_isbn`),
  KEY `no_indicia_frequency` (`no_indicia_frequency`),
  KEY `no_isbn` (`no_isbn`),
  KEY `title` (`title`),
  KEY `variant_of_id` (`variant_of_id`),
  KEY `barcode` (`barcode`),
  KEY `on_sale_date` (`on_sale_date`),
  KEY `no_title` (`no_title`),
  KEY `gcd_issue_1a619ca6` (`rating`),
  KEY `gcd_issue_ed4c6b73` (`no_rating`),
  CONSTRAINT `gcd_issue_ibfk_1` FOREIGN KEY (`series_id`) REFERENCES `gcd_series` (`id`),
  CONSTRAINT `gcd_issue_ibfk_2` FOREIGN KEY (`indicia_publisher_id`) REFERENCES `gcd_indicia_publisher` (`id`),
  CONSTRAINT `gcd_issue_ibfk_3` FOREIGN KEY (`brand_id`) REFERENCES `gcd_brand` (`id`),
  CONSTRAINT `gcd_issue_ibfk_4` FOREIGN KEY (`variant_of_id`) REFERENCES `gcd_issue` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1490058 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `gcd_story`
--

DROP TABLE IF EXISTS `gcd_story`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcd_story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `title_inferred` tinyint(1) NOT NULL DEFAULT '0',
  `feature` varchar(255) NOT NULL,
  `sequence_number` int(11) NOT NULL,
  `page_count` decimal(10,3) DEFAULT NULL,
  `issue_id` int(11) NOT NULL,
  `script` longtext NOT NULL,
  `pencils` longtext NOT NULL,
  `inks` longtext NOT NULL,
  `colors` longtext NOT NULL,
  `letters` longtext NOT NULL,
  `editing` longtext NOT NULL,
  `genre` varchar(255) NOT NULL DEFAULT '',
  `characters` longtext NOT NULL,
  `synopsis` longtext NOT NULL,
  `reprint_notes` longtext NOT NULL,
  `created` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `notes` longtext NOT NULL,
  `no_script` tinyint(1) NOT NULL DEFAULT '0',
  `no_pencils` tinyint(1) NOT NULL DEFAULT '0',
  `no_inks` tinyint(1) NOT NULL DEFAULT '0',
  `no_colors` tinyint(1) NOT NULL DEFAULT '0',
  `no_letters` tinyint(1) NOT NULL DEFAULT '0',
  `no_editing` tinyint(1) NOT NULL DEFAULT '0',
  `page_count_uncertain` tinyint(1) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL,
  `job_number` varchar(25) NOT NULL DEFAULT '',
  `reserved` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IssueID` (`issue_id`),
  KEY `Modified` (`modified`),
  KEY `no_script` (`no_script`),
  KEY `no_pencils` (`no_pencils`),
  KEY `no_inks` (`no_inks`),
  KEY `no_colors` (`no_colors`),
  KEY `no_letters` (`no_letters`),
  KEY `page_count_uncertain` (`page_count_uncertain`),
  KEY `reserved` (`reserved`),
  KEY `Pg_Cnt` (`page_count`),
  KEY `no_editing` (`no_editing`),
  KEY `type_id` (`type_id`),
  KEY `deleted` (`deleted`),
  KEY `title_inferred` (`title_inferred`),
  CONSTRAINT `gcd_story_ibfk_1` FOREIGN KEY (`issue_id`) REFERENCES `gcd_issue` (`id`),
  CONSTRAINT `gcd_story_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `gcd_story_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1595172 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;














































































































































