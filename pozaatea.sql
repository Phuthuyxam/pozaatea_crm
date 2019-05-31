-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 31, 2019 lúc 09:31 PM
-- Phiên bản máy phục vụ: 10.1.34-MariaDB
-- Phiên bản PHP: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `pozaatea`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accountant_detail`
--

CREATE TABLE `accountant_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `is_action` tinyint(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `accountant_detail`
--

INSERT INTO `accountant_detail` (`id`, `account_id`, `name`, `description`, `is_action`, `status`, `create_at`, `update_at`) VALUES
(1, 2, '1', '', 0, 0, '2019-05-29 00:00:00', NULL),
(2, 2, '2', '', 1, 0, '2019-05-29 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accountant_overview`
--

CREATE TABLE `accountant_overview` (
  `id` int(11) UNSIGNED NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `accountant_overview`
--

INSERT INTO `accountant_overview` (`id`, `sale_id`, `create_at`, `update_at`) VALUES
(1, 4, '2019-05-27 00:00:00', NULL),
(2, 6, '2019-05-29 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attr_customers`
--

CREATE TABLE `attr_customers` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `user_id` text COLLATE utf8_unicode_ci,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attr_customers`
--

INSERT INTO `attr_customers` (`id`, `name`, `key`, `description`, `user_id`, `create_at`, `update_at`) VALUES
(1, 'Ghi chú', 'ghi_chu', '', '[\"3\"]', '2019-05-21 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `care_detail`
--

CREATE TABLE `care_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `care_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `channel_id` int(11) DEFAULT NULL,
  `link` text COLLATE utf8_unicode_ci,
  `is_action` tinyint(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `care_detail`
--

INSERT INTO `care_detail` (`id`, `care_id`, `name`, `channel_id`, `link`, `is_action`, `status`, `create_at`, `update_at`) VALUES
(1, 1, '', 0, '', NULL, 4, '2019-05-27 00:00:00', '2019-05-27 00:00:00'),
(2, 2, '1', 0, '', 0, 0, '2019-05-29 00:00:00', NULL),
(3, 2, '2', 0, '', 1, 0, '2019-05-29 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `care_overview`
--

CREATE TABLE `care_overview` (
  `id` int(11) UNSIGNED NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `care_overview`
--

INSERT INTO `care_overview` (`id`, `sale_id`, `create_at`, `update_at`) VALUES
(1, 4, '2019-05-27 00:00:00', NULL),
(2, 6, '2019-05-29 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `channel`
--

CREATE TABLE `channel` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `channel`
--

INSERT INTO `channel` (`id`, `name`, `description`, `create_at`, `update_at`) VALUES
(1, 'Email', 'Email marketing\r\n', '2019-05-14 00:00:00', NULL),
(2, 'Youtube', '', '2019-05-22 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` int(11) UNSIGNED NOT NULL,
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
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `phone`, `phone2`, `address`, `level_id`, `link_tracking`, `service_id`, `marketer_id`, `source_id`, `type`, `status`, `telesale_id`, `note`, `create_at`, `update_at`) VALUES
(31, 'poza', 'customer@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '02131293891238', NULL, NULL, 1, '', 1, 1, 1, 1, 2, 1, NULL, '2019-05-25 00:00:00', '2019-05-27 00:00:00'),
(32, 'Nam', 'nam@gmai.com', NULL, '9313212321', '', '', 9, '', 1, 1, 1, 4, 2, 6, NULL, '2019-05-27 00:00:00', '2019-05-27 00:00:00'),
(33, 'Phạm Văn Phúc', 'phucdev@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0132445677', NULL, NULL, 1, '', 1, 1, 1, 2, 2, 3, NULL, '2019-05-30 00:00:00', NULL),
(34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_shop`
--

CREATE TABLE `customer_shop` (
  `id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `design_detail`
--

CREATE TABLE `design_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `design_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `channel_id` int(11) DEFAULT NULL,
  `link` text COLLATE utf8_unicode_ci,
  `is_action` tinyint(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `design_detail`
--

INSERT INTO `design_detail` (`id`, `design_id`, `name`, `channel_id`, `link`, `is_action`, `status`, `create_at`, `update_at`) VALUES
(1, 2, '', 0, '', 0, 4, '2019-05-29 00:00:00', '2019-05-29 00:00:00'),
(2, 2, '2', 0, '', 1, 0, '2019-05-29 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `design_overview`
--

CREATE TABLE `design_overview` (
  `id` int(11) UNSIGNED NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `design_overview`
--

INSERT INTO `design_overview` (`id`, `sale_id`, `create_at`, `update_at`) VALUES
(1, 4, '2019-05-27 00:00:00', NULL),
(2, 6, '2019-05-29 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `exim_overview`
--

CREATE TABLE `exim_overview` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '0: Import, 1: Export',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `exim_overview`
--

INSERT INTO `exim_overview` (`id`, `code`, `quantity`, `total`, `type`, `create_at`, `update_at`) VALUES
(31, 'NK-20A06666', 20, 3000000, 0, '2019-05-31 00:00:00', NULL),
(34, 'XH-6F51B0D3', 20, 2400000, 1, '2019-05-31 00:00:00', NULL),
(35, 'NK-36EF27EA', 20, 3000000, 0, '2019-05-31 00:00:00', NULL),
(39, 'XH-B313F002', 10, 1200000, 1, '2019-05-31 00:00:00', NULL),
(40, 'NK-CCA3D8B5', 200, 30000000, 0, '2019-05-31 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `export_detail`
--

CREATE TABLE `export_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `export_id` int(200) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `export_detail`
--

INSERT INTO `export_detail` (`id`, `export_id`, `material_id`, `quantity`, `total`, `customer_id`, `create_at`, `update_at`) VALUES
(14, 34, 1, 10, NULL, 32, '2019-05-31 00:00:00', NULL),
(15, 34, 2, 10, NULL, 32, '2019-05-31 00:00:00', NULL),
(20, 39, 1, 5, NULL, 32, '2019-05-31 00:00:00', NULL),
(21, 39, 2, 5, NULL, 32, '2019-05-31 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `groups`
--

CREATE TABLE `groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `create_at`, `update_at`) VALUES
(1, 'Administrator', 'Quản trị viên 2', NULL, 2019),
(2, 'MKT', 'Marketing', NULL, NULL),
(3, 'Sale', 'Bán hàng\r\n', 2019, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `import_detail`
--

CREATE TABLE `import_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `import_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `import_detail`
--

INSERT INTO `import_detail` (`id`, `import_id`, `material_id`, `quantity`, `create_at`, `update_at`) VALUES
(33, 31, 1, 10, '2019-05-31 00:00:00', NULL),
(34, 31, 2, 10, '2019-05-31 00:00:00', NULL),
(35, 35, 1, 10, '2019-05-31 00:00:00', NULL),
(36, 35, 2, 10, '2019-05-31 00:00:00', NULL),
(38, 40, 1, 100, '2019-05-31 00:00:00', NULL),
(39, 40, 2, 100, '2019-05-31 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) UNSIGNED NOT NULL,
  `material_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `inventory`
--

INSERT INTO `inventory` (`id`, `material_id`, `quantity`, `create_at`, `update_at`) VALUES
(1, 1, 105, NULL, '2019-05-31 00:00:00'),
(2, 2, 115, NULL, '2019-05-31 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice_detail`
--

CREATE TABLE `invoice_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice_material`
--

CREATE TABLE `invoice_material` (
  `id` int(11) UNSIGNED NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice_overview`
--

CREATE TABLE `invoice_overview` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '0: gia hạn nhường quyền, 1: đặt hàng nguyên liệu',
  `total` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0: Chưa thanh toán, 1: Đã thanh toán',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `leads`
--

CREATE TABLE `leads` (
  `id` int(11) UNSIGNED NOT NULL,
  `your_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `your_phone` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `your_email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `your_content` text COLLATE utf8_unicode_ci COMMENT 'Thông tin sản phẩm mua',
  `shop_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0: Chưa xử lý - 1: Đã xử lý',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `level`
--

CREATE TABLE `level` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` int(11) DEFAULT NULL COMMENT 'level kieu int de check max',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `level`
--

INSERT INTO `level` (`id`, `name`, `create_at`, `update_at`) VALUES
(1, 1, '2019-05-14 00:00:00', NULL),
(2, 2, '2019-05-14 00:00:00', NULL),
(4, 3, '2019-05-14 00:00:00', NULL),
(5, 4, '2019-05-14 00:00:00', NULL),
(6, 5, '2019-05-14 00:00:00', NULL),
(7, 6, '2019-05-14 00:00:00', NULL),
(8, 7, '2019-05-14 00:00:00', NULL),
(9, 8, '2019-05-14 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `materials`
--

CREATE TABLE `materials` (
  `id` int(11) UNSIGNED NOT NULL,
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
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `materials`
--

INSERT INTO `materials` (`id`, `name`, `description`, `price_im`, `price_ex1`, `price_ex2`, `price_ex3`, `price_ex4`, `price_single`, `unit`, `create_at`, `update_at`) VALUES
(1, 'Trà sữa', 'ngon', 100000, 110000, 120000, 130000, 140000, 1500000, 'Lít', '2019-05-30 00:00:00', NULL),
(2, 'Nha đam', 'ngon', 200000, 100000, 100000, 100000, 100000, 100000, 'miếng', '2019-05-30 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `meta_customers`
--

CREATE TABLE `meta_customers` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `meta_customers`
--

INSERT INTO `meta_customers` (`id`, `key`, `value`, `customer_id`) VALUES
(4, 'ghi_chu', '', 31),
(5, 'ghi_chu', '', 32),
(6, 'ghi_chu', '', 33);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mkt_detail`
--

CREATE TABLE `mkt_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `time_callback` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_action` tinyint(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mkt_detail`
--

INSERT INTO `mkt_detail` (`id`, `customer_id`, `content`, `time_callback`, `is_action`, `create_at`, `update_at`) VALUES
(10, 32, '', '', 0, '2019-05-29 00:00:00', NULL),
(11, 31, '1', '', 0, '2019-05-29 00:00:00', NULL),
(12, 31, '2', '2019-05-15', 1, '2019-05-29 00:00:00', NULL),
(15, 31, '3', '', 0, '2019-05-29 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `module` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `group_id`, `module`, `content`) VALUES
(116, 1, 'setup', '[\"view\",\"add\",\"edit\",\"del\"]'),
(117, 2, 'setup', '[\"view\",\"add\",\"edit\",\"del\"]'),
(118, 3, 'setup', '[\"view\",\"add\",\"edit\",\"del\"]'),
(122, 1, 'sales', '[\"view\",\"add\",\"edit\",\"del\"]'),
(123, 2, 'sales', '[\"view\",\"add\",\"edit\",\"del\"]'),
(124, 3, 'sales', '[\"view\",\"add\",\"edit\",\"del\"]'),
(125, 1, 'care', '[\"view\",\"add\",\"edit\",\"del\"]'),
(126, 2, 'care', '[\"view\",\"add\",\"edit\",\"del\"]'),
(127, 3, 'care', '[\"view\",\"add\",\"edit\",\"del\"]'),
(128, 1, 'design', '[\"view\",\"add\",\"edit\",\"del\"]'),
(129, 2, 'design', '[\"view\",\"add\",\"edit\",\"del\"]'),
(130, 3, 'design', '[\"view\",\"add\",\"edit\",\"del\"]'),
(131, 1, 'support', '[\"view\",\"add\",\"edit\",\"del\"]'),
(132, 2, 'support', '[\"view\",\"add\",\"edit\",\"del\"]'),
(133, 3, 'support', '[\"view\",\"add\",\"edit\",\"del\"]'),
(134, 1, 'accountant', '[\"view\",\"add\",\"edit\",\"del\"]'),
(135, 2, 'accountant', '[\"view\",\"add\",\"edit\",\"del\"]'),
(136, 3, 'accountant', '[\"view\",\"add\",\"edit\",\"del\"]'),
(139, 1, 'mkt', '[\"view\",\"add\",\"edit\",\"del\"]'),
(140, 2, 'mkt', '[\"view\",\"add\",\"edit\",\"del\"]'),
(141, 3, 'mkt', '[\"view\",\"add\",\"edit\",\"del\"]');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sales_detail`
--

CREATE TABLE `sales_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `status_history` int(11) DEFAULT NULL,
  `level_history` int(11) DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `time_callback` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_action` tinyint(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sales_detail`
--

INSERT INTO `sales_detail` (`id`, `sale_id`, `status_history`, `level_history`, `content`, `time_callback`, `is_action`, `create_at`, `update_at`) VALUES
(2, 4, 1, 4, '', '', NULL, '2019-05-27 00:00:00', NULL),
(3, 4, 1, 4, '', '', NULL, '2019-05-27 00:00:00', NULL),
(4, 5, NULL, NULL, NULL, NULL, NULL, '2019-05-27 00:00:00', NULL),
(5, 6, NULL, NULL, NULL, NULL, NULL, '2019-05-27 00:00:00', NULL),
(6, 6, NULL, 9, '1', '', 1, '2019-05-29 00:00:00', NULL),
(7, 6, NULL, 9, '1', '', 1, '2019-05-29 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sales_overview`
--

CREATE TABLE `sales_overview` (
  `id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `status_care_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci COMMENT 'Ghi chú sales (Không phải ghi chú khách)',
  `opening_date` date DEFAULT NULL COMMENT 'Dự kiến khai trương',
  `duration` int(11) DEFAULT NULL COMMENT 'Thời hạn (năm)',
  `deposit` float DEFAULT NULL,
  `contract` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sales_overview`
--

INSERT INTO `sales_overview` (`id`, `customer_id`, `status_care_id`, `note`, `opening_date`, `duration`, `deposit`, `contract`, `create_at`, `update_at`) VALUES
(3, 31, 1, '', '1970-01-01', 0, 0, '', '2019-05-25 00:00:00', '2019-05-27 00:00:00'),
(4, 32, 1, '                                                                    ', '1970-01-01', 0, 0, '', '2019-05-27 00:00:00', '2019-05-27 00:00:00'),
(5, 31, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-27 00:00:00', NULL),
(6, 32, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-27 00:00:00', NULL),
(7, 33, 1, '', '2019-05-04', 10, 1000000, 'hhhh', '2019-05-30 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fee` float DEFAULT NULL COMMENT 'Phí dịch vụ/năm',
  `description` text COLLATE utf8_unicode_ci,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `name`, `fee`, `description`, `create_at`, `update_at`) VALUES
(1, 'Yotea', 1000000000000, 'ok', '2019-05-14 00:00:00', '2019-05-14 00:00:00'),
(2, 'pizaa', 88888900, '', '2019-05-20 00:00:00', '2019-05-22 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shops`
--

CREATE TABLE `shops` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sources`
--

CREATE TABLE `sources` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sources`
--

INSERT INTO `sources` (`id`, `name`, `description`, `create_at`, `update_at`) VALUES
(1, 'Facebook', 'Facebook', NULL, '2019-05-14 00:00:00'),
(3, 'google', 'google', '2019-05-14 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `status_care`
--

CREATE TABLE `status_care` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `status_care`
--

INSERT INTO `status_care` (`id`, `name`, `create_at`, `update_at`) VALUES
(1, 'Đang chăm sóc', '2019-05-14 00:00:00', NULL),
(2, 'Dừng', '2019-05-14 00:00:00', NULL),
(3, 'Hủy', '2019-05-14 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `status_process`
--

CREATE TABLE `status_process` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `status_process`
--

INSERT INTO `status_process` (`id`, `name`, `create_at`, `update_at`) VALUES
(4, 'Hoàn thành', NULL, NULL),
(5, 'Chưa gửi', NULL, NULL),
(6, 'Đang chờ', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `supports`
--

CREATE TABLE `supports` (
  `id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `support_detail`
--

CREATE TABLE `support_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `support_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `channel_id` int(11) DEFAULT NULL,
  `link` text COLLATE utf8_unicode_ci,
  `is_action` tinyint(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `support_detail`
--

INSERT INTO `support_detail` (`id`, `support_id`, `name`, `channel_id`, `link`, `is_action`, `status`, `create_at`, `update_at`) VALUES
(1, 2, '1', 0, '', 0, 0, '2019-05-29 00:00:00', NULL),
(3, 2, '2', 0, '', 1, 0, '2019-05-29 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `support_overview`
--

CREATE TABLE `support_overview` (
  `id` int(11) UNSIGNED NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `support_overview`
--

INSERT INTO `support_overview` (`id`, `sale_id`, `create_at`, `update_at`) VALUES
(1, 4, '2019-05-27 00:00:00', NULL),
(2, 6, '2019-05-29 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `customer_id` int(11) DEFAULT NULL,
  `department` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'marketing: Phòng Marketing, care: CSKH, support: Hỗ trợ, design: Thiết kế, sales: Phòng Sales, all: Hỗ trợ chung',
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0: Chưa xử lý, 1: Đang xử lý, 2: Đã xử lý, 3: Đóng',
  `parent_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `content`, `customer_id`, `department`, `user_id`, `status`, `parent_id`, `create_at`, `update_at`) VALUES
(10, 'Yêu cầu gia hạn hợp đồng', 'Tôi muốn gia hạn hợp đồng thêm 2 năm. Thắc mắc về vấn đề chi phí. cũng như thủ tục', 33, '6', NULL, 0, 0, '2019-06-01 00:00:00', NULL),
(13, 'reply 10', 'Chào bạn : chúng tôi đã nhận được phản hồi từ bạn . Về phần phí gia hạn và thủ tục ra hạn bạn vui lòng đến văn phòng công ty tại địa chỉ ...', 33, '0', 3, NULL, 10, '2019-06-01 00:00:00', NULL),
(29, 'Yêu cầu gia hạn hợp đồng', 'ádasd', 33, '6', NULL, NULL, 10, '2019-06-01 00:00:00', NULL),
(30, 'reply 10', 'Bạn có thể nói rõ vấn đề bạn đang gặp phải ?', 33, '0', 3, NULL, 10, '2019-06-01 00:00:00', NULL),
(31, 'reply 10', 'chào bạn ??', 33, '0', 3, NULL, 10, '2019-06-01 00:00:00', NULL),
(32, 'reply 10', 'chào bạn ...', 33, '0', 3, NULL, 10, '2019-06-01 00:00:00', NULL),
(33, 'Yêu cầu gia hạn hợp đồng', 'ádasd', 33, '6', NULL, NULL, 10, '2019-06-01 00:00:00', NULL),
(34, 'Yêu cầu gia hạn hợp đồng', 'ádasd', 33, '6', NULL, NULL, 10, '2019-06-01 00:00:00', NULL),
(35, 'Yêu cầu gia hạn hợp đồng', 'ádasd', 33, '6', NULL, NULL, 10, '2019-06-01 00:00:00', NULL),
(36, 'Yêu cầu gia hạn hợp đồng', 'ádasd', 33, '6', NULL, NULL, 10, '2019-06-01 00:00:00', NULL),
(41, 'yêu cầu hỗ trợ mặt bằng', 'â á sd', 31, '6', NULL, 0, 0, '2019-06-01 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forgot_code` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `is_sale` tinyint(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fullname`, `phone`, `forgot_code`, `group_id`, `is_sale`, `create_at`, `update_at`) VALUES
(1, 'balongfpt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'longhb', '0972186807', NULL, 1, NULL, NULL, '2019-05-14 00:00:00'),
(3, 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Quản trị', '0972186807', NULL, 2, NULL, '2019-05-14 00:00:00', '2019-05-27 00:00:00'),
(4, 'sales@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'sales', '0912983921839', NULL, 3, NULL, '2019-05-26 00:00:00', NULL),
(5, 'sale1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'sale 1', '09213892183921', NULL, 3, 1, '2019-05-26 00:00:00', NULL),
(6, 'sale2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'sale 2', '0928138219389', NULL, 3, 1, '2019-05-26 00:00:00', '2019-05-26 00:00:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accountant_detail`
--
ALTER TABLE `accountant_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `accountant_overview`
--
ALTER TABLE `accountant_overview`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `attr_customers`
--
ALTER TABLE `attr_customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `care_detail`
--
ALTER TABLE `care_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `care_overview`
--
ALTER TABLE `care_overview`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer_shop`
--
ALTER TABLE `customer_shop`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `design_detail`
--
ALTER TABLE `design_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `design_overview`
--
ALTER TABLE `design_overview`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `exim_overview`
--
ALTER TABLE `exim_overview`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `export_detail`
--
ALTER TABLE `export_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `import_detail`
--
ALTER TABLE `import_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `invoice_material`
--
ALTER TABLE `invoice_material`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `invoice_overview`
--
ALTER TABLE `invoice_overview`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `meta_customers`
--
ALTER TABLE `meta_customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `mkt_detail`
--
ALTER TABLE `mkt_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sales_detail`
--
ALTER TABLE `sales_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sales_overview`
--
ALTER TABLE `sales_overview`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sources`
--
ALTER TABLE `sources`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `status_care`
--
ALTER TABLE `status_care`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `status_process`
--
ALTER TABLE `status_process`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `support_detail`
--
ALTER TABLE `support_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `support_overview`
--
ALTER TABLE `support_overview`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accountant_detail`
--
ALTER TABLE `accountant_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `accountant_overview`
--
ALTER TABLE `accountant_overview`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `attr_customers`
--
ALTER TABLE `attr_customers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `care_detail`
--
ALTER TABLE `care_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `care_overview`
--
ALTER TABLE `care_overview`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `channel`
--
ALTER TABLE `channel`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `customer_shop`
--
ALTER TABLE `customer_shop`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `design_detail`
--
ALTER TABLE `design_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `design_overview`
--
ALTER TABLE `design_overview`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `exim_overview`
--
ALTER TABLE `exim_overview`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `export_detail`
--
ALTER TABLE `export_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `import_detail`
--
ALTER TABLE `import_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `invoice_material`
--
ALTER TABLE `invoice_material`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `invoice_overview`
--
ALTER TABLE `invoice_overview`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `meta_customers`
--
ALTER TABLE `meta_customers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `mkt_detail`
--
ALTER TABLE `mkt_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT cho bảng `sales_detail`
--
ALTER TABLE `sales_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `sales_overview`
--
ALTER TABLE `sales_overview`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sources`
--
ALTER TABLE `sources`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `status_care`
--
ALTER TABLE `status_care`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `status_process`
--
ALTER TABLE `status_process`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `supports`
--
ALTER TABLE `supports`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `support_detail`
--
ALTER TABLE `support_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `support_overview`
--
ALTER TABLE `support_overview`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
