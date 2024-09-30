-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2024 at 05:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `youth`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_pages`
--

CREATE TABLE `about_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_pages`
--

INSERT INTO `about_pages` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '<p><span style=\"font-family:Roboto,sans-serif\"><span style=\"font-size:20px\"><strong>About Page</strong></span></span></p>', '2024-06-12 09:59:46', '2024-06-12 09:59:46');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_title` text NOT NULL,
  `meta_description` text NOT NULL,
  `image` text NOT NULL,
  `alt` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `short_description` text NOT NULL,
  `description` longtext NOT NULL,
  `slug` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Publish',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `blog_category_slug` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `product_size_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `product_size_id`, `created_at`, `updated_at`) VALUES
(117, 1, 35, '1', 11, '2024-09-29 08:04:06', '2024-09-29 08:04:06'),
(118, 1, 32, '1', 12, '2024-09-29 08:04:41', '2024-09-29 08:04:41'),
(119, 1, 49, '1', 12, '2024-09-29 08:05:41', '2024-09-29 08:05:41');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `comment` longtext NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `max_uses` int(11) DEFAULT NULL,
  `max_uses_user` int(11) DEFAULT NULL,
  `type` enum('percent','fixed') NOT NULL DEFAULT 'fixed',
  `discount_amount` int(11) NOT NULL,
  `min_amount` double DEFAULT NULL,
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `name`, `max_uses`, `max_uses_user`, `type`, `discount_amount`, `min_amount`, `starts_at`, `expires_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'EEE000', 'dsfsds', 2, 2, 'percent', 20, 200, '2024-05-27 10:47:25', '2024-06-19 10:47:33', 'active', '2024-06-03 04:47:39', '2024-06-11 08:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_taxes`
--

CREATE TABLE `delivery_taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) NOT NULL,
  `delivery_charge` varchar(255) NOT NULL,
  `vat` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_taxes`
--

INSERT INTO `delivery_taxes` (`id`, `location`, `delivery_charge`, `vat`, `created_at`, `updated_at`) VALUES
(1, 'Inside Dhaka', '60', 15, '2024-06-02 12:29:56', '2024-06-02 12:29:56'),
(2, 'Outside Dhaka', '120', 15, '2024-06-02 12:30:23', '2024-06-02 12:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `event_slug` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `alt` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `first_status` varchar(255) NOT NULL DEFAULT 'off',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `event_slug`, `image`, `alt`, `status`, `first_status`, `created_at`, `updated_at`) VALUES
(3, 'Event Sale', 'event-sale', 'admin/images/event/19003New Project (4).jpg', 'Event Sale', 'active', 'active', '2024-09-28 08:14:11', '2024-09-28 08:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(9, 2, 7, '2024-07-05 11:37:13', '2024-07-05 11:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `hero_banners`
--

CREATE TABLE `hero_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text NOT NULL,
  `alt` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `first_status` varchar(255) NOT NULL DEFAULT 'off',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hero_banners`
--

INSERT INTO `hero_banners` (`id`, `image`, `alt`, `status`, `first_status`, `created_at`, `updated_at`) VALUES
(1, 'admin/images/hero-banner/194391.jpg', 'Home Hero Banner', 'active', 'active', '2024-06-12 05:41:03', '2024-06-12 10:15:37'),
(2, 'admin/images/hero-banner/192222.jpg', 'Home Hero Banner 2', 'active', 'off', '2024-06-12 05:41:13', '2024-06-12 10:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `logo_addresses`
--

CREATE TABLE `logo_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `favicon` text NOT NULL,
  `fav_alt` varchar(255) NOT NULL,
  `logo` text NOT NULL,
  `footer_image` text NOT NULL,
  `footer_alt` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `slogan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logo_addresses`
--

INSERT INTO `logo_addresses` (`id`, `favicon`, `fav_alt`, `logo`, `footer_image`, `footer_alt`, `alt`, `address`, `gmail`, `number`, `slogan`, `created_at`, `updated_at`) VALUES
(1, 'admin/images/Logo/19095faokwhite_ Artboard 2.png', 'Youth Icon', 'admin/images/Logo/17227facebookwhite_ Artboard 2.png', 'admin/images/Logo/12959128x128 WHITE.png', 'dsf dsf s', 'Youth', '<p>Holding No: 35/1, Block: B, Lane: 2, Gopta Road,</p>\r\n\r\n<p>Near Farid Store, Pathantuli., Narayangonj 1400</p>', 'youthbd21@gmail.com', '01813074038', '<p style=\"text-align:justify\"><span style=\"color:#ffffff\"><strong>YOUTH</strong> is a streetwear brand that creates bold, statement-making fashion for the streets.</span></p>', '2024-05-20 05:50:16', '2024-09-06 21:35:42');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `menu_slug` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `image`, `alt`, `menu_slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Summer', 'admin/images/menu/139541.jpg', 'Summer', 'summer', 'active', '2024-08-13 13:23:30', '2024-08-13 13:57:36'),
(2, 'Winter', 'admin/images/menu/182932.jpg', 'Winter', 'winter', 'active', '2024-08-13 13:34:00', '2024-08-13 13:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2024_05_20_060453_create_promo_codes_table', 7),
(24, '2024_06_02_185222_create_contact_messages_table', 17),
(28, '2024_06_11_141343_create_about_pages_table', 20),
(29, '2014_10_12_000000_create_users_table', 21),
(30, '2014_10_12_100000_create_password_reset_tokens_table', 21),
(31, '2019_08_19_000000_create_failed_jobs_table', 21),
(32, '2019_12_14_000001_create_personal_access_tokens_table', 21),
(33, '2024_04_15_173532_create_product_categories_table', 21),
(34, '2024_04_20_150059_create_product_sub_categories_table', 21),
(35, '2024_04_21_150311_create_product_brands_table', 21),
(36, '2024_04_24_172900_create_products_table', 21),
(37, '2024_04_26_163420_create_other_images_table', 21),
(38, '2024_05_07_154301_create_blog_categories_table', 21),
(39, '2024_05_07_154306_create_blogs_table', 21),
(40, '2024_05_20_071321_create_logo_addresses_table', 21),
(41, '2024_05_21_104959_create_social_media_table', 21),
(42, '2024_05_26_165242_create_product_reviews_table', 21),
(43, '2024_05_27_111810_create_subscriptions_table', 21),
(44, '2024_05_28_180502_create_carts_table', 21),
(45, '2024_05_31_171724_create_privacy_policies_table', 21),
(46, '2024_05_31_171737_create_return_policies_table', 21),
(47, '2024_05_31_171755_create_terms_and_conditions_table', 21),
(48, '2024_06_01_195557_create_favourites_table', 21),
(49, '2024_06_02_171846_create_comments_table', 21),
(50, '2024_06_02_175457_create_delivery_taxes_table', 21),
(51, '2024_06_03_095711_create_coupons_table', 21),
(52, '2024_06_03_183817_create_orders_table', 21),
(53, '2024_06_03_183832_create_order_details_table', 21),
(54, '2024_06_05_083223_create_about_pages_table', 21),
(55, '2024_06_12_101230_create_hero_banners_table', 22),
(56, '2024_06_12_101238_create_offers_table', 22),
(57, '2024_06_28_162829_create_product_sizes_table', 23),
(58, '2024_06_28_164046_create_product_colors_table', 24),
(59, '2024_06_28_181822_create_product_color_product_table', 25),
(60, '2024_06_28_181832_create_product_size_product_table', 25),
(61, '2024_08_13_181418_create_menus_table', 26);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `offer_slug` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `alt` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `first_status` varchar(255) NOT NULL DEFAULT 'off',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `name`, `offer_slug`, `image`, `alt`, `status`, `first_status`, `created_at`, `updated_at`) VALUES
(1, 'Flash Sale', 'flash-sale', 'admin/images/offer/12370Flash_Sale_Banner_(1600x200px).jpg', 'Flash Sale', 'active', 'active', '2024-06-12 09:39:58', '2024-06-17 06:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_tax_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount_amount` int(11) DEFAULT NULL,
  `istimate_total` int(11) DEFAULT NULL,
  `order_total` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `number` bigint(20) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `note` varchar(255) DEFAULT NULL,
  `all_terms` varchar(255) NOT NULL,
  `tracking_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `delivery_tax_id`, `coupon_id`, `discount_amount`, `istimate_total`, `order_total`, `name`, `address`, `city`, `postal_code`, `number`, `status`, `note`, `all_terms`, `tracking_id`, `created_at`, `updated_at`) VALUES
(43, 1, 1, NULL, NULL, NULL, 690, 'dsf fs df', 'dsf sf sfs', 'sdf sf s', 453345, 345345345, 'Pending', 'fds sdfs dfs f', 'agree', '4310059', '2024-09-26 06:45:08', '2024-09-26 06:45:08'),
(44, 1, 1, NULL, NULL, NULL, 460, 'efsedf sdfsd', 'sdf sdfsdfsdf', 'dsf dsf sdfds', 3534, 53453453453453, 'Pending', 'fdssfs dfsf sfs df', 'agree', '6027506', '2024-09-28 08:08:07', '2024-09-28 08:08:07'),
(45, 1, 1, NULL, NULL, NULL, 690, 'sdf sf dsf', 'dsf dsfdsf', 'dsf dsf fsf', 342342, 345345345, 'Pending', 'dsf dsf dsf dsf', 'agree', '4190052', '2024-09-28 08:15:55', '2024-09-28 08:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `product_size_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `product_size_id`, `created_at`, `updated_at`) VALUES
(55, 43, 42, 1, 12, '2024-09-26 06:45:08', '2024-09-26 06:45:08'),
(56, 44, 45, 1, 12, '2024-09-28 08:08:07', '2024-09-28 08:08:07'),
(57, 45, 35, 1, 12, '2024-09-28 08:15:55', '2024-09-28 08:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `other_images`
--

CREATE TABLE `other_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `other_image` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `other_images`
--

INSERT INTO `other_images` (`id`, `product_id`, `other_image`, `created_at`, `updated_at`) VALUES
(41, 11, 'admin/images/product/other-images/297501.jpg', '2024-08-12 22:40:14', '2024-08-12 22:40:14'),
(42, 11, 'admin/images/product/other-images/242355.jpg', '2024-08-12 22:40:14', '2024-08-12 22:40:14'),
(43, 11, 'admin/images/product/other-images/458594.jpg', '2024-08-12 22:40:15', '2024-08-12 22:40:15'),
(44, 12, 'admin/images/product/other-images/557300.jpg', '2024-08-12 23:06:22', '2024-08-12 23:06:22'),
(45, 12, 'admin/images/product/other-images/371963.jpg', '2024-08-12 23:06:23', '2024-08-12 23:06:23'),
(46, 12, 'admin/images/product/other-images/426377.jpg', '2024-08-12 23:06:23', '2024-08-12 23:06:23'),
(68, 18, 'admin/images/product/other-images/764743.jpg', '2024-09-04 20:46:17', '2024-09-04 20:46:17'),
(69, 18, 'admin/images/product/other-images/367437.jpg', '2024-09-04 20:46:17', '2024-09-04 20:46:17'),
(70, 18, 'admin/images/product/other-images/438272.jpg', '2024-09-04 20:46:18', '2024-09-04 20:46:18'),
(77, 23, 'admin/images/product/other-images/695440.jpg', '2024-09-05 15:20:29', '2024-09-05 15:20:29'),
(78, 23, 'admin/images/product/other-images/646138.jpg', '2024-09-05 15:20:29', '2024-09-05 15:20:29'),
(79, 23, 'admin/images/product/other-images/692586.jpg', '2024-09-05 15:20:29', '2024-09-05 15:20:29'),
(85, 32, 'admin/images/product/other-images/105065.jpg', '2024-09-05 19:01:06', '2024-09-05 19:01:06'),
(86, 32, 'admin/images/product/other-images/751932.jpg', '2024-09-05 19:01:06', '2024-09-05 19:01:06'),
(87, 32, 'admin/images/product/other-images/92237.jpg', '2024-09-05 19:01:06', '2024-09-05 19:01:06'),
(91, 35, 'admin/images/product/other-images/506264.jpg', '2024-09-05 19:54:29', '2024-09-05 19:54:29'),
(92, 35, 'admin/images/product/other-images/75963.jpg', '2024-09-05 19:54:29', '2024-09-05 19:54:29'),
(93, 35, 'admin/images/product/other-images/822509.jpg', '2024-09-05 19:54:29', '2024-09-05 19:54:29'),
(97, 37, 'admin/images/product/other-images/627184.jpg', '2024-09-05 20:01:36', '2024-09-05 20:01:36'),
(98, 37, 'admin/images/product/other-images/832699.jpg', '2024-09-05 20:01:36', '2024-09-05 20:01:36'),
(99, 37, 'admin/images/product/other-images/793002.jpg', '2024-09-05 20:01:36', '2024-09-05 20:01:36'),
(100, 38, 'admin/images/product/other-images/869076.jpg', '2024-09-05 20:05:38', '2024-09-05 20:05:38'),
(101, 38, 'admin/images/product/other-images/137772.jpg', '2024-09-05 20:05:38', '2024-09-05 20:05:38'),
(102, 38, 'admin/images/product/other-images/836473.jpg', '2024-09-05 20:05:38', '2024-09-05 20:05:38'),
(103, 39, 'admin/images/product/other-images/327594.jpg', '2024-09-05 20:20:10', '2024-09-05 20:20:10'),
(104, 39, 'admin/images/product/other-images/169507.jpg', '2024-09-05 20:20:10', '2024-09-05 20:20:10'),
(105, 39, 'admin/images/product/other-images/882964.jpg', '2024-09-05 20:20:10', '2024-09-05 20:20:10'),
(106, 40, 'admin/images/product/other-images/564414.jpg', '2024-09-05 20:24:46', '2024-09-05 20:24:46'),
(107, 40, 'admin/images/product/other-images/52097.jpg', '2024-09-05 20:24:46', '2024-09-05 20:24:46'),
(108, 40, 'admin/images/product/other-images/257695.jpg', '2024-09-05 20:24:46', '2024-09-05 20:24:46'),
(109, 36, 'admin/images/product/other-images/575914.jpg', '2024-09-05 20:26:46', '2024-09-05 20:26:46'),
(110, 36, 'admin/images/product/other-images/329780.jpg', '2024-09-05 20:26:46', '2024-09-05 20:26:46'),
(111, 36, 'admin/images/product/other-images/489107.jpg', '2024-09-05 20:26:46', '2024-09-05 20:26:46'),
(112, 41, 'admin/images/product/other-images/865884.jpg', '2024-09-05 20:37:01', '2024-09-05 20:37:01'),
(113, 41, 'admin/images/product/other-images/845448.jpg', '2024-09-05 20:37:01', '2024-09-05 20:37:01'),
(114, 41, 'admin/images/product/other-images/711063.jpg', '2024-09-05 20:37:01', '2024-09-05 20:37:01'),
(115, 42, 'admin/images/product/other-images/239152.jpg', '2024-09-05 20:40:38', '2024-09-05 20:40:38'),
(116, 42, 'admin/images/product/other-images/22850.jpg', '2024-09-05 20:40:38', '2024-09-05 20:40:38'),
(117, 42, 'admin/images/product/other-images/549583.jpg', '2024-09-05 20:40:38', '2024-09-05 20:40:38'),
(118, 43, 'admin/images/product/other-images/224291.jpg', '2024-09-05 20:42:54', '2024-09-05 20:42:54'),
(119, 43, 'admin/images/product/other-images/592292.jpg', '2024-09-05 20:42:54', '2024-09-05 20:42:54'),
(120, 43, 'admin/images/product/other-images/547420.jpg', '2024-09-05 20:42:54', '2024-09-05 20:42:54'),
(121, 44, 'admin/images/product/other-images/250566.jpg', '2024-09-10 11:21:17', '2024-09-10 11:21:17'),
(122, 44, 'admin/images/product/other-images/672020.jpg', '2024-09-10 11:21:17', '2024-09-10 11:21:17'),
(123, 44, 'admin/images/product/other-images/153752.jpg', '2024-09-10 11:21:17', '2024-09-10 11:21:17'),
(124, 45, 'admin/images/product/other-images/773549.jpg', '2024-09-10 11:24:56', '2024-09-10 11:24:56'),
(125, 45, 'admin/images/product/other-images/131673.jpg', '2024-09-10 11:24:56', '2024-09-10 11:24:56'),
(126, 45, 'admin/images/product/other-images/889595.jpg', '2024-09-10 11:24:56', '2024-09-10 11:24:56'),
(127, 46, 'admin/images/product/other-images/50100.jpg', '2024-09-10 11:33:25', '2024-09-10 11:33:25'),
(128, 46, 'admin/images/product/other-images/558648.jpg', '2024-09-10 11:33:25', '2024-09-10 11:33:25'),
(129, 46, 'admin/images/product/other-images/867092.jpg', '2024-09-10 11:33:25', '2024-09-10 11:33:25'),
(130, 47, 'admin/images/product/other-images/807295.jpg', '2024-09-10 17:31:09', '2024-09-10 17:31:09'),
(131, 47, 'admin/images/product/other-images/159876.jpg', '2024-09-10 17:31:09', '2024-09-10 17:31:09'),
(132, 48, 'admin/images/product/other-images/529505.jpg', '2024-09-10 17:40:52', '2024-09-10 17:40:52'),
(133, 48, 'admin/images/product/other-images/889216.jpg', '2024-09-10 17:40:52', '2024-09-10 17:40:52'),
(134, 48, 'admin/images/product/other-images/175392.jpg', '2024-09-10 17:40:52', '2024-09-10 17:40:52'),
(135, 49, 'admin/images/product/other-images/380692.jpg', '2024-09-16 13:14:53', '2024-09-16 13:14:53'),
(136, 49, 'admin/images/product/other-images/166117.jpg', '2024-09-16 13:14:53', '2024-09-16 13:14:53'),
(137, 49, 'admin/images/product/other-images/531604.jpg', '2024-09-16 13:14:53', '2024-09-16 13:14:53');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('test@gmail.com', '$2y$10$UeJBIrFdOAlnt/m8tsv0jOmut/KjsKeXPMEnTFbPDJig3NxtlZZAC', '2024-08-13 16:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policies`
--

CREATE TABLE `privacy_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `privacy_policy` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privacy_policies`
--

INSERT INTO `privacy_policies` (`id`, `privacy_policy`, `created_at`, `updated_at`) VALUES
(1, '<p><strong><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:24.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">Privacy Policy</span></span></span></span></span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><span style=\"font-size:24pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">Privacy Policy for YOUTH</span></span></strong></span></span></span></h1>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">At youth, accessible from www.youth.com, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by youth and how we use it.</span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in youth. This policy is not applicable to any information collected offline or via channels other than this website. Our Privacy Policy was created with the help of the&nbsp;</span></span></span><u><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:#4e4e4e\"><a href=\"https://www.privacypolicygenerator.info/\" style=\"color:#0563c1; text-decoration:underline\"><span style=\"color:#4e4e4e\">Privacy Policy Generator</span></a></span></span></span></u><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">&nbsp;and the&nbsp;</span></span></span><u><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:#4e4e4e\"><a href=\"https://www.privacypolicies.com/privacy-policy-generator/\" style=\"color:#0563c1; text-decoration:underline\"><span style=\"color:#4e4e4e\">Free Privacy Policy Generator</span></a></span></span></span></u><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">.</span></span></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><span style=\"font-size:13pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:&quot;Calibri Light&quot;,sans-serif\"><span style=\"color:#2f5496\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:#333333\">Consent</span></span></strong></span></span></span></span></h2>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">By using our website, you hereby consent to our Privacy Policy and agree to its terms. For our Terms and Conditions, please visit the&nbsp;</span></span><span style=\"color:#0563c1\"><u><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:#4e4e4e\"><a href=\"https://www.privacypolicyonline.com/terms-conditions-generator/\" style=\"color:#0563c1; text-decoration:underline\"><span style=\"color:#4e4e4e\">Terms &amp; Conditions Generator</span></a></span></span></u></span><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">.</span></span></span></span></span></p>\r\n\r\n<h2><span style=\"font-size:13pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:&quot;Calibri Light&quot;,sans-serif\"><span style=\"color:#2f5496\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:#333333\">Information we collect</span></span></strong></span></span></span></span></h2>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</span></span></span></span></span></p>\r\n\r\n<h2><span style=\"font-size:13pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:&quot;Calibri Light&quot;,sans-serif\"><span style=\"color:#2f5496\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:#333333\">How we use your information</span></span></strong></span></span></span></span></h2>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">We use the information we collect in various ways, including to:</span></span></span></span></span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"background-color:#f9f9f9\"><span style=\"color:black\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Provide, operate, and maintain our website</span></span></span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"background-color:#f9f9f9\"><span style=\"color:black\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Improve, personalize, and expand our website</span></span></span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"background-color:#f9f9f9\"><span style=\"color:black\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Understand and analyze how you use our website</span></span></span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"background-color:#f9f9f9\"><span style=\"color:black\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Develop new products, services, features, and functionality</span></span></span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"background-color:#f9f9f9\"><span style=\"color:black\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</span></span></span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"background-color:#f9f9f9\"><span style=\"color:black\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Send you emails</span></span></span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"background-color:#f9f9f9\"><span style=\"color:black\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Find and prevent fraud</span></span></span></span></span></li>\r\n</ul>\r\n\r\n<h2><span style=\"font-size:13pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:&quot;Calibri Light&quot;,sans-serif\"><span style=\"color:#2f5496\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:#333333\">Log Files</span></span></strong></span></span></span></span></h2>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">youth follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services&rsquo; analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users&rsquo; movement on the website, and gathering demographic information.</span></span></span></span></span></p>\r\n\r\n<h2><span style=\"font-size:13pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:&quot;Calibri Light&quot;,sans-serif\"><span style=\"color:#2f5496\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:#333333\">Cookies and Web Beacons</span></span></strong></span></span></span></span></h2>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">Like any other website, youth uses &lsquo;cookies&rsquo;. These cookies are used to store information including visitors&rsquo; preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users&rsquo; experience by customizing our web page content based on visitors&rsquo; browser type and/or other information.</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:#f9f9f9\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">For more general information on cookies, please read&nbsp;</span></span><span style=\"color:#0563c1\"><u><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:#4e4e4e\"><a href=\"https://www.cookieconsent.com/what-are-cookies/\" style=\"color:#0563c1; text-decoration:underline\"><span style=\"color:#4e4e4e\">&ldquo;What Are Cookies&rdquo; from Cookie Consent</span></a></span></span></u></span><span style=\"font-family:&quot;Arial&quot;,sans-serif\"><span style=\"color:black\">.</span></span></span></span></span></p>\r\n\r\n<div id=\"gtx-trans\" style=\"left:-16px; position:absolute; top:-11px\">\r\n<div class=\"gtx-trans-icon\">&nbsp;</div>\r\n</div>', '2024-06-01 00:46:42', '2024-06-12 09:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `offer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `name` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `regular_price` int(11) DEFAULT NULL,
  `selling_price` int(11) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `product_slug` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `popular_status` varchar(255) NOT NULL DEFAULT 'inActive',
  `related_status` varchar(255) NOT NULL DEFAULT 'inActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `menu_id`, `product_category_id`, `product_brand_id`, `offer_id`, `event_id`, `meta_title`, `meta_description`, `name`, `image`, `alt`, `stock`, `regular_price`, `selling_price`, `discount`, `description`, `product_slug`, `status`, `popular_status`, `related_status`, `created_at`, `updated_at`) VALUES
(18, 1, 15, 1, NULL, NULL, 'kolo Ranz', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Black\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'Kolo Ranz', 'admin/images/product/product/14345Youth - Kalo Ranz T-shirt.jpg', 'Kolo Ranz', 45, NULL, 600, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: Black<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'kolo-ranz', 'active', 'inActive', 'inActive', '2024-09-04 20:46:17', '2024-09-09 12:23:48'),
(23, 1, 15, 1, NULL, NULL, '𝐈𝐦𝐚𝐠𝐢𝐧𝐞 𝐃𝐫𝐚𝐠𝐨𝐧𝐬', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Grey\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'Imagine Dragons', 'admin/images/product/product/14950Youth- Imagine Dragons T-shirt.jpg', '𝐈𝐦𝐚𝐠𝐢𝐧𝐞 𝐃𝐫𝐚𝐠𝐨𝐧𝐬', 50, NULL, 600, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: Grey<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'imagine-dragons', 'active', 'inActive', 'inActive', '2024-09-05 15:20:29', '2024-09-05 20:16:41'),
(32, 1, 15, 1, 1, NULL, 'Zainul Abedin', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Red\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'Zainul Abedin', 'admin/images/product/product/10538Youth Zainul Abedin T-shirt.jpg', 'Zainul Abedin', 30, 600, 400, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: Red<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'zainul-abedin', 'active', 'inActive', 'inActive', '2024-09-05 19:01:06', '2024-09-05 19:51:06'),
(35, 1, 15, 1, NULL, 3, 'Scarface', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Black\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'Scarface', 'admin/images/product/product/12070Youth - Scarface T-shirt.jpg', 'Scarface', 49, NULL, 600, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: Black<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'scarface', 'active', 'inActive', 'inActive', '2024-09-05 19:54:29', '2024-09-28 08:15:55'),
(36, 1, 15, 1, NULL, NULL, 'Mortis', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Black\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'Mortis', 'admin/images/product/product/14050Youth - Build My Life T-shirt.jpg', 'Mortis', 50, NULL, 600, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: Black<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'mortis', 'active', 'inActive', 'inActive', '2024-09-05 19:57:50', '2024-09-05 19:57:50'),
(37, 1, 15, 1, NULL, NULL, 'BMW', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Off_White\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'BMW', 'admin/images/product/product/13818Youth - Elite T-shirt.jpg', 'BMW', 50, NULL, 600, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: Off_White<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'bmw', 'active', 'inActive', 'inActive', '2024-09-05 20:01:36', '2024-09-05 20:01:36'),
(38, 1, 15, 1, NULL, NULL, 'Murdock', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Light Tan\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'Murdock', 'admin/images/product/product/18893Youth - Muroock T-shirt.jpg', 'Murdock', 50, NULL, 600, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: Light Tan<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'murdock', 'active', 'inActive', 'inActive', '2024-09-05 20:05:38', '2024-09-05 20:05:38'),
(39, 1, 15, 1, NULL, NULL, 'Neon', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Light French Beige\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'Neon', 'admin/images/product/product/16962Youth -Moncler Salehe Bembury T-shirt.jpg', 'Neon', 50, NULL, 600, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: Light French Beige<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'neon', 'active', 'inActive', 'inActive', '2024-09-05 20:20:10', '2024-09-05 20:20:10'),
(40, 1, 15, 1, NULL, NULL, 'Hyperbolic', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Bkack\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'Hyperbolic', 'admin/images/product/product/10373Youth _Hyperbolic T-shirt.jpg', 'Hyperbolic', 50, NULL, 600, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: Black<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'hyperbolic', 'active', 'inActive', 'inActive', '2024-09-05 20:24:46', '2024-09-05 20:24:46'),
(41, 1, 15, 1, NULL, NULL, '53N53', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Grey\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', '53N53', 'admin/images/product/product/13796Youth - 53N53 T-shirt.jpg', '53N53', 50, NULL, 600, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: Grey<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', '53n53', 'active', 'inActive', 'inActive', '2024-09-05 20:37:01', '2024-09-05 20:37:01'),
(42, 1, 15, 1, NULL, NULL, '404', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Maroon\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', '404', 'admin/images/product/product/11220Youth 404 T-shirt.jpg', '404', 49, NULL, 600, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: Maroon<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', '404', 'active', 'inActive', 'inActive', '2024-09-05 20:40:38', '2024-09-26 06:45:08'),
(43, 1, 15, 1, 1, NULL, 'After Hours', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Black\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'After Hours', 'admin/images/product/product/12012Youth - After Hours T-shirt.jpg', 'After Hours', 49, 600, 400, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: Black<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'after-hours', 'active', 'inActive', 'inActive', '2024-09-05 20:42:54', '2024-09-07 13:27:05'),
(44, 1, 19, 1, 1, NULL, 'Freestyle', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Black\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'Freestyle', 'admin/images/product/product/18563Youth_ Freestyle T-shirt.jpg', 'Freestyle', 12, 600, 400, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)</p>\r\n\r\n<p>𝐂𝐨𝐥𝐨𝐫: Black</p>\r\n\r\n<p>𝐅𝐢𝐭: oversized</p>\r\n\r\n<p>𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Size Measurments:</p>\r\n\r\n<p>M- body: 43, height: 27</p>\r\n\r\n<p>L- body: 45, height: 28</p>\r\n\r\n<p>XL- body: 47, height: 29</p>\r\n\r\n<p>XXL- body: 49, height: 30</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'freestyle', 'active', 'inActive', 'inActive', '2024-09-10 11:21:17', '2024-09-29 08:02:04'),
(45, 1, 19, 1, 1, NULL, 'Fearless', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: White\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'Fearless', 'admin/images/product/product/18306Youth -Fearless T-shirt.jpg', 'Fearless', 14, 600, 400, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: White<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'fearless', 'active', 'inActive', 'inActive', '2024-09-10 11:24:56', '2024-09-28 08:08:07'),
(46, 1, 15, 1, NULL, NULL, 'Manic Monday', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Black Acid wash\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'Manic Monday', 'admin/images/product/product/16936Youth _Manic Monday T-shirt.jpg', 'Manic Monday', 20, NULL, 600, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: Black Acid Wash<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'manic-monday', 'active', 'inActive', 'inActive', '2024-09-10 11:33:25', '2024-09-10 11:38:21'),
(47, 1, 18, 1, NULL, NULL, 'Born to be Wild', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Black Acid wash\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'Born to be Wild', 'admin/images/product/product/16714Youth - Born to Be Wild T-shirt.jpg', 'Born to be Wild', 50, 600, 400, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: Black Acid wash<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'born-to-be-wild', 'active', 'inActive', 'inActive', '2024-09-10 17:31:09', '2024-09-29 08:01:31'),
(48, 1, 15, 1, NULL, NULL, 'Spider-man', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: white\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'Spider-man', 'admin/images/product/product/17320447993883_475006358374272_8825859823155611616_n.jpg', 'spider-man', 50, 550, 400, NULL, '<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: White<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'spider-man', 'active', 'inActive', 'inActive', '2024-09-10 17:40:52', '2024-09-10 17:40:52'),
(49, 1, 15, 1, NULL, NULL, 'Cuba', '𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)\r\n𝐂𝐨𝐥𝐨𝐫: Black\r\n𝐅𝐢𝐭: oversized\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print\r\n\r\nSize Measurments:\r\nM- body: 43, height: 27\r\nL- body: 45, height: 28\r\nXL- body: 47, height: 29\r\nXXL- body: 49, height: 30\r\n\r\nThe male model (height 5.11\') is wearing a size L.', 'Cuba', 'admin/images/product/product/17553FB_IMG_1726477781577.jpg', 'Cuba', 3, NULL, 550, NULL, '<p>&nbsp;</p>\r\n\r\n<p>𝐅𝐚𝐛𝐫𝐢𝐜: 𝟏𝟎𝟎% 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐜𝐨𝐭𝐭𝐨𝐧 (𝐆𝐒𝐌 𝟐𝟎𝟎-𝟐𝟐𝟎)<br />\r\n𝐂𝐨𝐥𝐨𝐫: Black<br />\r\n𝐅𝐢𝐭: oversized<br />\r\n𝐏𝐫𝐢𝐧𝐭: Rubber Print</p>\r\n\r\n<p>Size Measurments:<br />\r\nM- body: 43, height: 27<br />\r\nL- body: 45, height: 28<br />\r\nXL- body: 47, height: 29<br />\r\nXXL- body: 49, height: 30</p>\r\n\r\n<p>The male model (height 5.11&#39;) is wearing a size L.</p>', 'cuba', 'active', 'inActive', 'inActive', '2024-09-16 13:14:53', '2024-09-16 13:14:53');

-- --------------------------------------------------------

--
-- Table structure for table `product_brands`
--

CREATE TABLE `product_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `product_brand_slug` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `filter_status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_brands`
--

INSERT INTO `product_brands` (`id`, `name`, `product_brand_slug`, `status`, `filter_status`, `created_at`, `updated_at`) VALUES
(1, 'Youth', 'youth', 'active', 'active', '2024-04-21 10:43:24', '2024-04-27 10:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `feature_image` text NOT NULL,
  `feature_alt` varchar(255) NOT NULL,
  `product_category_slug` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `filter_status` varchar(255) DEFAULT 'inActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `menu_id`, `name`, `feature_image`, `feature_alt`, `product_category_slug`, `status`, `filter_status`, `created_at`, `updated_at`) VALUES
(15, 1, 'DropShoulder', 'admin/images/category/184784.jpg', 'DropShoulder', 'dropshoulder', 'active', 'active', '2024-08-13 21:32:44', '2024-08-28 23:10:40'),
(16, 2, 'Hoodie', 'admin/images/category/10232received_520746430332170.png', 'Winter', 'hoodie', 'active', 'active', '2024-08-13 21:40:16', '2024-08-29 12:15:57'),
(18, 1, 'Acid Wash', 'admin/images/category/178752.jpg', 'Acid Wash', 'acid-wash', 'active', 'active', '2024-08-28 23:09:29', '2024-08-30 22:23:50'),
(19, 1, 'Zipper DropShoulder', 'admin/images/category/187233.jpg', 'Zipper DropShoulder', 'zipper-dropshoulder', 'active', 'active', '2024-08-30 22:20:30', '2024-08-30 22:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `star` int(11) NOT NULL,
  `product_review` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `user_id`, `product_id`, `star`, `product_review`, `status`, `created_at`, `updated_at`) VALUES
(11, 2, 18, 5, 'Ghbb', 'active', '2024-09-07 13:28:24', '2024-09-07 13:28:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `type_name`, `name`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Pant', '28', 'active', '2024-06-28 11:07:24', '2024-06-28 11:07:24'),
(4, 'Pant', '30', 'active', '2024-06-28 11:07:37', '2024-06-28 11:07:37'),
(5, 'Pant', '32', 'active', '2024-06-28 11:08:27', '2024-06-28 11:08:27'),
(6, 'Pant', '34', 'active', '2024-06-28 11:08:43', '2024-06-28 11:08:43'),
(7, 'Pant', '36', 'active', '2024-06-28 11:08:54', '2024-06-28 11:11:43'),
(8, 'T-shirt', 'S', 'active', '2024-06-28 11:09:06', '2024-06-28 11:09:06'),
(9, 'T-shirt', 'M', 'active', '2024-06-28 11:09:33', '2024-06-28 11:09:33'),
(10, 'T-shirt', 'L', 'active', '2024-06-28 11:09:46', '2024-06-28 11:09:46'),
(11, 'T-shirt', 'XL', 'active', '2024-06-28 11:09:58', '2024-06-28 11:09:58'),
(12, 'T-shirt', 'XXL', 'active', '2024-06-28 11:10:10', '2024-06-28 11:10:10'),
(13, 'Shoe', '39', 'active', '2024-06-28 11:37:45', '2024-06-28 11:37:45'),
(14, 'Shoe', '40', 'active', '2024-06-28 11:37:56', '2024-06-28 11:37:56'),
(15, 'Shoe', '41', 'active', '2024-06-28 11:38:07', '2024-06-28 11:38:07'),
(16, 'Shoe', '42', 'active', '2024-06-28 11:38:18', '2024-06-28 11:38:18'),
(17, 'Shoe', '43', 'active', '2024-06-28 11:38:30', '2024-06-28 11:38:30'),
(18, 'Shoe', '44', 'active', '2024-06-28 11:38:47', '2024-06-28 11:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_size_product`
--

CREATE TABLE `product_size_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_size_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_size_product`
--

INSERT INTO `product_size_product` (`id`, `product_id`, `product_size_id`, `created_at`, `updated_at`) VALUES
(34, 18, 9, NULL, NULL),
(35, 18, 10, NULL, NULL),
(36, 18, 11, NULL, NULL),
(37, 18, 12, NULL, NULL),
(40, 23, 9, NULL, NULL),
(41, 23, 10, NULL, NULL),
(42, 23, 11, NULL, NULL),
(43, 23, 12, NULL, NULL),
(46, 32, 12, NULL, NULL),
(47, 32, 11, NULL, NULL),
(48, 32, 10, NULL, NULL),
(49, 32, 9, NULL, NULL),
(54, 35, 12, NULL, NULL),
(55, 35, 11, NULL, NULL),
(56, 35, 10, NULL, NULL),
(57, 35, 9, NULL, NULL),
(58, 36, 12, NULL, NULL),
(59, 36, 11, NULL, NULL),
(60, 36, 10, NULL, NULL),
(61, 36, 9, NULL, NULL),
(62, 37, 12, NULL, NULL),
(63, 37, 11, NULL, NULL),
(64, 37, 10, NULL, NULL),
(65, 37, 9, NULL, NULL),
(66, 38, 12, NULL, NULL),
(67, 38, 11, NULL, NULL),
(68, 38, 10, NULL, NULL),
(69, 38, 9, NULL, NULL),
(70, 39, 12, NULL, NULL),
(71, 39, 11, NULL, NULL),
(72, 39, 10, NULL, NULL),
(73, 39, 9, NULL, NULL),
(74, 40, 12, NULL, NULL),
(75, 40, 11, NULL, NULL),
(76, 40, 10, NULL, NULL),
(77, 40, 9, NULL, NULL),
(78, 41, 12, NULL, NULL),
(79, 41, 11, NULL, NULL),
(80, 41, 10, NULL, NULL),
(81, 41, 9, NULL, NULL),
(82, 42, 12, NULL, NULL),
(83, 42, 11, NULL, NULL),
(84, 42, 10, NULL, NULL),
(85, 42, 9, NULL, NULL),
(86, 43, 12, NULL, NULL),
(87, 43, 11, NULL, NULL),
(88, 43, 10, NULL, NULL),
(89, 43, 9, NULL, NULL),
(90, 44, 12, NULL, NULL),
(91, 44, 11, NULL, NULL),
(92, 44, 10, NULL, NULL),
(93, 44, 9, NULL, NULL),
(94, 45, 12, NULL, NULL),
(95, 45, 11, NULL, NULL),
(96, 45, 10, NULL, NULL),
(97, 45, 9, NULL, NULL),
(98, 46, 12, NULL, NULL),
(99, 46, 11, NULL, NULL),
(100, 46, 10, NULL, NULL),
(101, 46, 9, NULL, NULL),
(102, 47, 12, NULL, NULL),
(103, 47, 11, NULL, NULL),
(104, 47, 10, NULL, NULL),
(105, 47, 9, NULL, NULL),
(106, 48, 12, NULL, NULL),
(107, 48, 11, NULL, NULL),
(108, 48, 10, NULL, NULL),
(109, 48, 9, NULL, NULL),
(110, 49, 12, NULL, NULL),
(111, 49, 11, NULL, NULL),
(112, 49, 10, NULL, NULL),
(113, 49, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_categories`
--

CREATE TABLE `product_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `alt` varchar(255) NOT NULL,
  `product_sub_category_slug` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `filter_status` varchar(255) NOT NULL DEFAULT 'inActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sub_categories`
--

INSERT INTO `product_sub_categories` (`id`, `menu_id`, `product_category_id`, `name`, `image`, `alt`, `product_sub_category_slug`, `status`, `filter_status`, `created_at`, `updated_at`) VALUES
(13, 1, 15, 'Tshirt', 'admin/images/sub-category/17971453664539_2174547362901159_1782781968956533688_n.jpg', 'Tshirt', 'tshirt', 'active', 'active', '2024-08-13 21:39:11', '2024-08-13 14:39:33'),
(14, 2, 16, 'Jaket', 'admin/images/sub-category/10812no-brand_jaket-pria-casual-distro-jaket-bomber-pria-terbaru_full9.jpg', 'Jaket', 'jaket', 'active', 'active', '2024-08-13 21:41:03', '2024-08-14 10:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `return_policies`
--

CREATE TABLE `return_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_policy` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_policies`
--

INSERT INTO `return_policies` (`id`, `return_policy`, `created_at`, `updated_at`) VALUES
(1, '<p><strong><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:22.0pt\">Trial, Exchange and Refund Policy:</span></span></span></strong></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\">Every customer must be encouraged to check the product before payment to the delivery agent.</span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\">If there are sizing issues or defects, or if the customer does not want not to take the product, they must be encouraged to return on spot to the delivery agent.</span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\">If a customer takes delivery and identifies sizing issues or defects afterwards, they must contact &quot;youth&quot; within 48 hours of delivery. Upon consideration by us, we will inform the customer about the action applicable for their case.</span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\">Refunds are only applicable if a customer receives a defective product and we cannot replace it with a fresh piece of the same product. In all other cases of exchanges and returns, customers will be provided alternative products of the same value OR an equal amount of store credit for future purchases.</span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:22.0pt\">Delivery Time:</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\">Regular deliveries are ensured within the below timelines:</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\">Inside Dhaka: 1-2 days</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\">Outside Dhaka: 4-5 days</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">**The exact delivery time cannot be specified as they are handled by a 3rd party delivery company</span></span></span></p>', '2024-06-01 00:54:07', '2024-06-12 09:53:23');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `back_color` varchar(255) DEFAULT NULL,
  `icon` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `color`, `back_color`, `icon`, `name`, `link`, `status`, `created_at`, `updated_at`) VALUES
(3, '#ffffff', '#4268b3', '<i class=\"fa-brands fa-square-facebook\"></i>', 'Facebook', 'https://www.facebook.com/youthoutfits', 'active', '2024-06-01 14:45:54', '2024-07-08 22:45:06'),
(4, '#ffffff', '#df306c', '<i class=\"fa-brands fa-instagram\"></i>', 'Instagram', 'https://www.instagram.com/youthsoutfit', 'active', '2024-07-08 22:46:02', '2024-07-08 22:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscribe` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_conditions`
--

CREATE TABLE `terms_and_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `terms_and_condition` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms_and_conditions`
--

INSERT INTO `terms_and_conditions` (`id`, `terms_and_condition`, `created_at`, `updated_at`) VALUES
(1, '<p><strong><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:48.0pt\">Terms and Conditions</span></span></span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:22.0pt\">Trial, Exchange and Refund Policy:</span></span></span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\">Every customer must be encouraged to check the product before payment to the delivery agent.</span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\">If there are sizing issues or defects, or if the customer does not want not to take the product, they must be encouraged to return on spot to the delivery agent.</span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\">If a customer takes delivery and identifies sizing issues or defects afterwards, they must contact &quot;youth&quot; within 48 hours of delivery. Upon consideration by us, we will inform the customer about the action applicable for their case.</span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\">Refunds are only applicable if a customer receives a defective product and we cannot replace it with a fresh piece of the same product. In all other cases of exchanges and returns, customers will be provided alternative products of the same value OR an equal amount of store credit for future purchases.</span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:22.0pt\">Delivery Time:</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\">Regular deliveries are ensured within the below timelines:</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\">Inside Dhaka: 1-2 days</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\">Outside Dhaka: 4-5 days</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">**The exact delivery time cannot be specified as they are handled by a 3rd party delivery company</span></span></span></p>', '2024-06-12 09:46:38', '2024-06-12 09:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `ban_status` tinyint(4) NOT NULL DEFAULT 0,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `number`, `address`, `ban_status`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$pWWUsV3Kgtbir2qU0Skwj.oiZ0UwHaSsRI970gSLnHb3hn5YXv2bu', 'admin/images/profile_photo/logo png.png', NULL, NULL, 0, 'admin', 'x6BwEv7Oq4Aav5Ob3tCH5Ic241RYLgChhADcBAHLc5NN6G32Xir4bYO7h2sc', '2024-06-12 03:39:56', '2024-06-12 10:38:42'),
(2, 'Test', 'test@gmail.com', NULL, '$2y$10$t.BECYv4/0.iX.1eov5n6uWBbWVPSEdJqaCUrJkRIoX.IoPOJ2Ufe', NULL, NULL, NULL, 0, 'user', 'd3AGEA7VfWr2Hybz3TZ42JQws9LhTmcjb5XuXuTMBZDPPRAbDLfYKZRaI4Vr', '2024-06-12 03:50:52', '2024-08-09 09:55:15'),
(3, 'Mashfiqur Rahman', 'mashfiqurrahman17@gmail.com', NULL, '$2y$10$s7G9I4ZKlFgCAi622f2ly.zlCSOSMHuMHkmkJunhEAxUiyZhWXCLe', NULL, '01575606176', NULL, 0, 'user', NULL, '2024-07-17 09:51:03', '2024-07-17 09:51:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_pages`
--
ALTER TABLE `about_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_title_unique` (`title`) USING HASH;

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_categories_name_unique` (`name`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`),
  ADD UNIQUE KEY `coupons_name_unique` (`name`);

--
-- Indexes for table `delivery_taxes`
--
ALTER TABLE `delivery_taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero_banners`
--
ALTER TABLE `hero_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo_addresses`
--
ALTER TABLE `logo_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`);

--
-- Indexes for table `other_images`
--
ALTER TABLE `other_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`) USING HASH,
  ADD UNIQUE KEY `products_product_slug_unique` (`product_slug`) USING HASH;

--
-- Indexes for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_brands_name_unique` (`name`),
  ADD UNIQUE KEY `product_brands_product_brand_slug_unique` (`product_brand_slug`) USING HASH;

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categories_name_unique` (`name`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_size_product`
--
ALTER TABLE `product_size_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_size_product_product_id_foreign` (`product_id`),
  ADD KEY `product_size_product_product_size_id_foreign` (`product_size_id`);

--
-- Indexes for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_sub_categories_name_unique` (`name`);

--
-- Indexes for table `return_policies`
--
ALTER TABLE `return_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_subscribe_unique` (`subscribe`);

--
-- Indexes for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `number` (`number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_pages`
--
ALTER TABLE `about_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_taxes`
--
ALTER TABLE `delivery_taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hero_banners`
--
ALTER TABLE `hero_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logo_addresses`
--
ALTER TABLE `logo_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `other_images`
--
ALTER TABLE `other_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `product_brands`
--
ALTER TABLE `product_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_size_product`
--
ALTER TABLE `product_size_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `return_policies`
--
ALTER TABLE `return_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_size_product`
--
ALTER TABLE `product_size_product`
  ADD CONSTRAINT `product_size_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_size_product_product_size_id_foreign` FOREIGN KEY (`product_size_id`) REFERENCES `product_sizes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
