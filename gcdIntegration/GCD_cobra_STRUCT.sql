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
  `is_current` tinyint(1) NOT NULL DEFAULT '0',
  `publisher_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
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
  `is_singleton` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `PubID` (`publisher_id`),
  KEY `Bk_Name` (`name`(150)),
  KEY `Yr_Began` (`year_began`),
  KEY `HasGallery` (`has_gallery`),
  KEY `reserved` (`reserved`),
  KEY `country_id` (`country_id`),
  KEY `deleted` (`deleted`),
  KEY `is_current` (`is_current`),
  KEY `sort_name` (`sort_name`),
  CONSTRAINT `gcd_series_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `gcd_publisher` (`id`),
  CONSTRAINT `gcd_series_ibfk_3` FOREIGN KEY (`country_id`) REFERENCES `gcd_country` (`id`)
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
  `indicia_pub_not_printed` tinyint(1) NOT NULL,
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
  CONSTRAINT `gcd_issue_ibfk_4` FOREIGN KEY (`variant_of_id`) REFERENCES `gcd_issue` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1490058 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;














































































































































