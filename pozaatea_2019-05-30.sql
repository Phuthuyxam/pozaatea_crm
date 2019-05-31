# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.37)
# Database: pozaatea
# Generation Time: 2019-05-30 10:52:56 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table accountant_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `accountant_detail`;

CREATE TABLE `accountant_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `is_action` tinyint(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `accountant_detail` WRITE;
/*!40000 ALTER TABLE `accountant_detail` DISABLE KEYS */;

INSERT INTO `accountant_detail` (`id`, `account_id`, `name`, `description`, `is_action`, `status`, `create_at`, `update_at`)
VALUES
	(1,2,'1','',0,0,'2019-05-29 00:00:00',NULL),
	(2,2,'2','',1,0,'2019-05-29 00:00:00',NULL);

/*!40000 ALTER TABLE `accountant_detail` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table accountant_overview
# ------------------------------------------------------------

DROP TABLE IF EXISTS `accountant_overview`;

CREATE TABLE `accountant_overview` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `accountant_overview` WRITE;
/*!40000 ALTER TABLE `accountant_overview` DISABLE KEYS */;

INSERT INTO `accountant_overview` (`id`, `sale_id`, `create_at`, `update_at`)
VALUES
	(1,4,'2019-05-27 00:00:00',NULL),
	(2,6,'2019-05-29 00:00:00',NULL);

/*!40000 ALTER TABLE `accountant_overview` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table attr_customers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attr_customers`;

CREATE TABLE `attr_customers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `user_id` text COLLATE utf8_unicode_ci,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `attr_customers` WRITE;
/*!40000 ALTER TABLE `attr_customers` DISABLE KEYS */;

INSERT INTO `attr_customers` (`id`, `name`, `key`, `description`, `user_id`, `create_at`, `update_at`)
VALUES
	(1,'Ghi chú','ghi_chu','','[\"3\"]','2019-05-21 00:00:00',NULL);

/*!40000 ALTER TABLE `attr_customers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table care_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `care_detail`;

CREATE TABLE `care_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `care_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `channel_id` int(11) DEFAULT NULL,
  `link` text COLLATE utf8_unicode_ci,
  `is_action` tinyint(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `care_detail` WRITE;
/*!40000 ALTER TABLE `care_detail` DISABLE KEYS */;

INSERT INTO `care_detail` (`id`, `care_id`, `name`, `channel_id`, `link`, `is_action`, `status`, `create_at`, `update_at`)
VALUES
	(1,1,'',0,'',NULL,4,'2019-05-27 00:00:00','2019-05-27 00:00:00'),
	(2,2,'1',0,'',0,0,'2019-05-29 00:00:00',NULL),
	(3,2,'2',0,'',1,0,'2019-05-29 00:00:00',NULL);

/*!40000 ALTER TABLE `care_detail` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table care_overview
# ------------------------------------------------------------

DROP TABLE IF EXISTS `care_overview`;

CREATE TABLE `care_overview` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `care_overview` WRITE;
/*!40000 ALTER TABLE `care_overview` DISABLE KEYS */;

INSERT INTO `care_overview` (`id`, `sale_id`, `create_at`, `update_at`)
VALUES
	(1,4,'2019-05-27 00:00:00',NULL),
	(2,6,'2019-05-29 00:00:00',NULL);

/*!40000 ALTER TABLE `care_overview` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table channel
# ------------------------------------------------------------

DROP TABLE IF EXISTS `channel`;

CREATE TABLE `channel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `channel` WRITE;
/*!40000 ALTER TABLE `channel` DISABLE KEYS */;

INSERT INTO `channel` (`id`, `name`, `description`, `create_at`, `update_at`)
VALUES
	(1,'Email','Email marketing\r\n','2019-05-14 00:00:00',NULL),
	(2,'Youtube','','2019-05-22 00:00:00',NULL);

/*!40000 ALTER TABLE `channel` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table customer_shop
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_shop`;

CREATE TABLE `customer_shop` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table customers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `level_id` int(100) DEFAULT NULL,
  `link_tracking` text COLLATE utf8_unicode_ci,
  `service_id` int(11) DEFAULT NULL,
  `marketer_id` int(11) DEFAULT NULL,
  `source_id` int(200) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1: Đại lý cấp 1, 2: Cấp 2, 3: Cấp 3, 4: Cấp 4',
  `status` int(11) DEFAULT NULL COMMENT '1: Chưa xuất kho - 2: Đã xuất kho',
  `telesale_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci COMMENT 'Ghi chú khách hàng',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `phone`, `phone2`, `address`, `level_id`, `link_tracking`, `service_id`, `marketer_id`, `source_id`, `type`, `status`, `telesale_id`, `note`, `create_at`, `update_at`)
VALUES
	(31,'poza','customer@gmail.com','e10adc3949ba59abbe56e057f20f883e','02131293891238',NULL,NULL,1,'',1,1,1,NULL,2,1,NULL,'2019-05-25 00:00:00','2019-05-27 00:00:00'),
	(32,'Nam','nam@gmai.com',NULL,'9313212321','','',9,'',1,1,1,NULL,2,6,NULL,'2019-05-27 00:00:00','2019-05-27 00:00:00');

/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table design_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `design_detail`;

CREATE TABLE `design_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `design_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `channel_id` int(11) DEFAULT NULL,
  `link` text COLLATE utf8_unicode_ci,
  `is_action` tinyint(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `design_detail` WRITE;
/*!40000 ALTER TABLE `design_detail` DISABLE KEYS */;

INSERT INTO `design_detail` (`id`, `design_id`, `name`, `channel_id`, `link`, `is_action`, `status`, `create_at`, `update_at`)
VALUES
	(1,2,'',0,'',0,4,'2019-05-29 00:00:00','2019-05-29 00:00:00'),
	(2,2,'2',0,'',1,0,'2019-05-29 00:00:00',NULL);

/*!40000 ALTER TABLE `design_detail` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table design_overview
# ------------------------------------------------------------

DROP TABLE IF EXISTS `design_overview`;

CREATE TABLE `design_overview` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `design_overview` WRITE;
/*!40000 ALTER TABLE `design_overview` DISABLE KEYS */;

INSERT INTO `design_overview` (`id`, `sale_id`, `create_at`, `update_at`)
VALUES
	(1,4,'2019-05-27 00:00:00',NULL),
	(2,6,'2019-05-29 00:00:00',NULL);

/*!40000 ALTER TABLE `design_overview` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table exim_overview
# ------------------------------------------------------------

DROP TABLE IF EXISTS `exim_overview`;

CREATE TABLE `exim_overview` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '0: Import, 1: Export',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table export_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `export_detail`;

CREATE TABLE `export_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `export_id` int(200) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`, `description`, `create_at`, `update_at`)
VALUES
	(1,'Administrator','Quản trị viên 2',NULL,2019),
	(2,'MKT','Marketing',NULL,NULL),
	(3,'Sale','Bán hàng\r\n',2019,NULL);

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table import_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `import_detail`;

CREATE TABLE `import_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `import_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table inventory
# ------------------------------------------------------------

DROP TABLE IF EXISTS `inventory`;

CREATE TABLE `inventory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `material_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table invoice_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `invoice_detail`;

CREATE TABLE `invoice_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table invoice_overview
# ------------------------------------------------------------

DROP TABLE IF EXISTS `invoice_overview`;

CREATE TABLE `invoice_overview` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '0: gia hạn nhường quyền, 1: đặt hàng nguyên liệu',
  `total` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0: Chưa thanh toán, 1: Đã thanh toán',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table leads
# ------------------------------------------------------------

DROP TABLE IF EXISTS `leads`;

CREATE TABLE `leads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `your_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `your_phone` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `your_email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `your_content` text COLLATE utf8_unicode_ci COMMENT 'Thông tin sản phẩm mua',
  `shop_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0: Chưa xử lý - 1: Đã xử lý',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table level
# ------------------------------------------------------------

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` int(11) DEFAULT NULL COMMENT 'level kieu int de check max',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `level` WRITE;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;

INSERT INTO `level` (`id`, `name`, `create_at`, `update_at`)
VALUES
	(1,1,'2019-05-14 00:00:00',NULL),
	(2,2,'2019-05-14 00:00:00',NULL),
	(4,3,'2019-05-14 00:00:00',NULL),
	(5,4,'2019-05-14 00:00:00',NULL),
	(6,5,'2019-05-14 00:00:00',NULL),
	(7,6,'2019-05-14 00:00:00',NULL),
	(8,7,'2019-05-14 00:00:00',NULL),
	(9,8,'2019-05-14 00:00:00',NULL);

/*!40000 ALTER TABLE `level` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table materials
# ------------------------------------------------------------

DROP TABLE IF EXISTS `materials`;

CREATE TABLE `materials` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `price_im` float DEFAULT NULL,
  `price_ex1` float DEFAULT NULL,
  `price_ex2` float DEFAULT NULL,
  `price_ex3` float DEFAULT NULL,
  `price_ex4` float DEFAULT NULL,
  `price_single` float DEFAULT NULL,
  `unit` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table meta_customers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `meta_customers`;

CREATE TABLE `meta_customers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `customer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `meta_customers` WRITE;
/*!40000 ALTER TABLE `meta_customers` DISABLE KEYS */;

INSERT INTO `meta_customers` (`id`, `key`, `value`, `customer_id`)
VALUES
	(4,'ghi_chu','',31),
	(5,'ghi_chu','',32);

/*!40000 ALTER TABLE `meta_customers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table mkt_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mkt_detail`;

CREATE TABLE `mkt_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `time_callback` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_action` tinyint(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `mkt_detail` WRITE;
/*!40000 ALTER TABLE `mkt_detail` DISABLE KEYS */;

INSERT INTO `mkt_detail` (`id`, `customer_id`, `content`, `time_callback`, `is_action`, `create_at`, `update_at`)
VALUES
	(10,32,'','',0,'2019-05-29 00:00:00',NULL),
	(11,31,'1','',0,'2019-05-29 00:00:00',NULL),
	(12,31,'2','2019-05-15',1,'2019-05-29 00:00:00',NULL),
	(15,31,'3','',0,'2019-05-29 00:00:00',NULL);

/*!40000 ALTER TABLE `mkt_detail` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `module` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `group_id`, `module`, `content`)
VALUES
	(116,1,'setup','[\"view\",\"add\",\"edit\",\"del\"]'),
	(117,2,'setup','[\"view\",\"add\",\"edit\",\"del\"]'),
	(118,3,'setup','[\"view\",\"add\",\"edit\",\"del\"]'),
	(122,1,'sales','[\"view\",\"add\",\"edit\",\"del\"]'),
	(123,2,'sales','[\"view\",\"add\",\"edit\",\"del\"]'),
	(124,3,'sales','[\"view\",\"add\",\"edit\",\"del\"]'),
	(125,1,'care','[\"view\",\"add\",\"edit\",\"del\"]'),
	(126,2,'care','[\"view\",\"add\",\"edit\",\"del\"]'),
	(127,3,'care','[\"view\",\"add\",\"edit\",\"del\"]'),
	(128,1,'design','[\"view\",\"add\",\"edit\",\"del\"]'),
	(129,2,'design','[\"view\",\"add\",\"edit\",\"del\"]'),
	(130,3,'design','[\"view\",\"add\",\"edit\",\"del\"]'),
	(131,1,'support','[\"view\",\"add\",\"edit\",\"del\"]'),
	(132,2,'support','[\"view\",\"add\",\"edit\",\"del\"]'),
	(133,3,'support','[\"view\",\"add\",\"edit\",\"del\"]'),
	(134,1,'accountant','[\"view\",\"add\",\"edit\",\"del\"]'),
	(135,2,'accountant','[\"view\",\"add\",\"edit\",\"del\"]'),
	(136,3,'accountant','[\"view\",\"add\",\"edit\",\"del\"]'),
	(139,1,'mkt','[\"view\",\"add\",\"edit\",\"del\"]'),
	(140,2,'mkt','[\"view\",\"add\",\"edit\",\"del\"]'),
	(141,3,'mkt','[\"view\",\"add\",\"edit\",\"del\"]');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sales_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sales_detail`;

CREATE TABLE `sales_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) DEFAULT NULL,
  `status_history` int(11) DEFAULT NULL,
  `level_history` int(11) DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `time_callback` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_action` tinyint(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `sales_detail` WRITE;
/*!40000 ALTER TABLE `sales_detail` DISABLE KEYS */;

INSERT INTO `sales_detail` (`id`, `sale_id`, `status_history`, `level_history`, `content`, `time_callback`, `is_action`, `create_at`, `update_at`)
VALUES
	(2,4,1,4,'','',NULL,'2019-05-27 00:00:00',NULL),
	(3,4,1,4,'','',NULL,'2019-05-27 00:00:00',NULL),
	(4,5,NULL,NULL,NULL,NULL,NULL,'2019-05-27 00:00:00',NULL),
	(5,6,NULL,NULL,NULL,NULL,NULL,'2019-05-27 00:00:00',NULL),
	(6,6,NULL,9,'1','',1,'2019-05-29 00:00:00',NULL),
	(7,6,NULL,9,'1','',1,'2019-05-29 00:00:00',NULL);

/*!40000 ALTER TABLE `sales_detail` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sales_overview
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sales_overview`;

CREATE TABLE `sales_overview` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `status_care_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci COMMENT 'Ghi chú sales (Không phải ghi chú khách)',
  `opening_date` date DEFAULT NULL COMMENT 'Dự kiến khai trương',
  `duration` int(11) DEFAULT NULL COMMENT 'Thời hạn (năm)',
  `deposit` float DEFAULT NULL,
  `contract` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `sales_overview` WRITE;
/*!40000 ALTER TABLE `sales_overview` DISABLE KEYS */;

INSERT INTO `sales_overview` (`id`, `customer_id`, `status_care_id`, `note`, `opening_date`, `duration`, `deposit`, `contract`, `create_at`, `update_at`)
VALUES
	(3,31,1,'','1970-01-01',0,0,'','2019-05-25 00:00:00','2019-05-27 00:00:00'),
	(4,32,1,'                                                                    ','1970-01-01',0,0,'','2019-05-27 00:00:00','2019-05-27 00:00:00'),
	(5,31,NULL,NULL,NULL,NULL,NULL,NULL,'2019-05-27 00:00:00',NULL),
	(6,32,NULL,NULL,NULL,NULL,NULL,NULL,'2019-05-27 00:00:00',NULL);

/*!40000 ALTER TABLE `sales_overview` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table services
# ------------------------------------------------------------

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fee` float DEFAULT NULL COMMENT 'Phí dịch vụ/năm',
  `description` text COLLATE utf8_unicode_ci,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;

INSERT INTO `services` (`id`, `name`, `fee`, `description`, `create_at`, `update_at`)
VALUES
	(1,'Yotea',1000000000000,'ok','2019-05-14 00:00:00','2019-05-14 00:00:00'),
	(2,'pizaa',88888900,'','2019-05-20 00:00:00','2019-05-22 00:00:00');

/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shops
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shops`;

CREATE TABLE `shops` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table sources
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sources`;

CREATE TABLE `sources` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `sources` WRITE;
/*!40000 ALTER TABLE `sources` DISABLE KEYS */;

INSERT INTO `sources` (`id`, `name`, `description`, `create_at`, `update_at`)
VALUES
	(1,'Facebook','Facebook',NULL,'2019-05-14 00:00:00'),
	(3,'google','google','2019-05-14 00:00:00',NULL);

/*!40000 ALTER TABLE `sources` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table status_care
# ------------------------------------------------------------

DROP TABLE IF EXISTS `status_care`;

CREATE TABLE `status_care` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `status_care` WRITE;
/*!40000 ALTER TABLE `status_care` DISABLE KEYS */;

INSERT INTO `status_care` (`id`, `name`, `create_at`, `update_at`)
VALUES
	(1,'Đang chăm sóc','2019-05-14 00:00:00',NULL),
	(2,'Dừng','2019-05-14 00:00:00',NULL),
	(3,'Hủy','2019-05-14 00:00:00',NULL);

/*!40000 ALTER TABLE `status_care` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table status_process
# ------------------------------------------------------------

DROP TABLE IF EXISTS `status_process`;

CREATE TABLE `status_process` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `status_process` WRITE;
/*!40000 ALTER TABLE `status_process` DISABLE KEYS */;

INSERT INTO `status_process` (`id`, `name`, `create_at`, `update_at`)
VALUES
	(4,'Hoàn thành',NULL,NULL),
	(5,'Chưa gửi',NULL,NULL),
	(6,'Đang chờ',NULL,NULL);

/*!40000 ALTER TABLE `status_process` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table support_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `support_detail`;

CREATE TABLE `support_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `support_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `channel_id` int(11) DEFAULT NULL,
  `link` text COLLATE utf8_unicode_ci,
  `is_action` tinyint(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `support_detail` WRITE;
/*!40000 ALTER TABLE `support_detail` DISABLE KEYS */;

INSERT INTO `support_detail` (`id`, `support_id`, `name`, `channel_id`, `link`, `is_action`, `status`, `create_at`, `update_at`)
VALUES
	(1,2,'1',0,'',0,0,'2019-05-29 00:00:00',NULL),
	(3,2,'2',0,'',1,0,'2019-05-29 00:00:00',NULL);

/*!40000 ALTER TABLE `support_detail` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table support_overview
# ------------------------------------------------------------

DROP TABLE IF EXISTS `support_overview`;

CREATE TABLE `support_overview` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `support_overview` WRITE;
/*!40000 ALTER TABLE `support_overview` DISABLE KEYS */;

INSERT INTO `support_overview` (`id`, `sale_id`, `create_at`, `update_at`)
VALUES
	(1,4,'2019-05-27 00:00:00',NULL),
	(2,6,'2019-05-29 00:00:00',NULL);

/*!40000 ALTER TABLE `support_overview` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table supports
# ------------------------------------------------------------

DROP TABLE IF EXISTS `supports`;

CREATE TABLE `supports` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table tickets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `customer_id` int(11) DEFAULT NULL,
  `department` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'marketing: Phòng Marketing, care: CSKH, support: Hỗ trợ, design: Thiết kế, sales: Phòng Sales, all: Hỗ trợ chung',
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0: Chưa xử lý, 1: Đang xử lý, 2: Đã xử lý, 3: Đóng',
  `parent_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forgot_code` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `is_sale` tinyint(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `fullname`, `phone`, `forgot_code`, `group_id`, `is_sale`, `create_at`, `update_at`)
VALUES
	(1,'balongfpt@gmail.com','e10adc3949ba59abbe56e057f20f883e','longhb','0972186807',NULL,1,NULL,NULL,'2019-05-14 00:00:00'),
	(3,'admin@gmail.com','e10adc3949ba59abbe56e057f20f883e','Quản trị','0972186807',NULL,2,NULL,'2019-05-14 00:00:00','2019-05-27 00:00:00'),
	(4,'sales@gmail.com','e10adc3949ba59abbe56e057f20f883e','sales','0912983921839',NULL,3,NULL,'2019-05-26 00:00:00',NULL),
	(5,'sale1@gmail.com','e10adc3949ba59abbe56e057f20f883e','sale 1','09213892183921',NULL,3,1,'2019-05-26 00:00:00',NULL),
	(6,'sale2@gmail.com','e10adc3949ba59abbe56e057f20f883e','sale 2','0928138219389',NULL,3,1,'2019-05-26 00:00:00','2019-05-26 00:00:00');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
