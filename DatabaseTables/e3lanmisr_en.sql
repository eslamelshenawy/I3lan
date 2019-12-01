-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2019 at 02:33 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e3lanmisr_en`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(10) NOT NULL,
  `about_id` int(10) NOT NULL,
  `mission` text COLLATE utf8mb4_unicode_ci,
  `vision` text COLLATE utf8mb4_unicode_ci,
  `value` text COLLATE utf8mb4_unicode_ci,
  `approach` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `about_id`, `mission`, `vision`, `value`, `approach`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>&quot;E3lan Misr for OOH Media Solutions, an agency mainly specified in outdoors&rsquo; advertisement based in Egypt since 2005, owning very large portfolio of locations among main roads and areas in Egypt, Large, Medium &amp; Small formats.</p>', '<p>&quot;E3lan Misr for OOH Media Solutions, an agency mainly specified in outdoors&rsquo; advertisement based in Egypt since 2005, owning very large portfolio of locations among main roads and areas in Egypt, Large, Medium &amp; Small forma</p>', '<p>&quot;E3lan Misr for OOH Media Solutions, an agency mainly specified in outdoors&rsquo; advertisement based in Egypt since 2005, owning very large portfolio of locations among main roads and areas in Egypt, Large, Medium &amp; Small formats.</p>', '\"E3lan Misr for OOH Media Solutions, an agency mainly specified in outdoors’ advertisement based in Egypt since 2005, owning very large portfolio of locations among main roads and areas in Egypt, Large, Medium & Small formats.', '<p>&quot;E3lan Misr for OOH Media Solutions, an agency mainly specified in outdoors&rsquo; advertisement based in Egypt since 2005, owning very large portfolio of locations among main roads and areas in Egypt, Large, Medium &amp; Small formats.</p>', '2019-11-11 22:00:00', '2019-11-12 18:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `billboard`
--

CREATE TABLE `billboard` (
  `id` int(10) UNSIGNED NOT NULL,
  `billboard_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billboard`
--

INSERT INTO `billboard` (`id`, `billboard_id`, `name`, `client`, `description`, `created_at`, `updated_at`) VALUES
(5, 12, 'Maverick Project', 'Ahmed Sayed', 'Consectetur adipisicing elit. Officia rerum inventore illo, tempora. Tenetur cumque sit quasi, cupiditate eveniet magni non suscipit accusamus aspernatur, cum architecto nemo aliquam iste aliquid. Adipisicing elit. Magni harum voluptas esse, laboriosam nemo quae, neque temporibus facere laborum voluptatem nostrum, omnis praesentium, sequi minus quod maiores tempore error quasi?????', '2019-11-18 20:53:43', '2019-11-18 18:53:43'),
(6, 13, 'hukesyzuse@mailinator.com', NULL, 'Eligendi anim eius uacascasc', '2019-11-16 13:05:27', '2019-11-16 13:05:27'),
(8, 15, 'hupamumowu@mailinator.com', NULL, 'Eos obcaecati ut ist', '2019-11-19 00:05:59', '2019-11-18 22:05:59'),
(12, 19, 'xyxesene@mailinator.com', NULL, 'Consequat Quae fugi', '2019-11-19 22:44:11', '2019-11-19 20:44:11'),
(13, 20, 'nibery@mailinator.com', NULL, 'Optio nostrum dolor gshsstdeh', '2019-11-25 01:23:36', '2019-11-24 23:23:36');

-- --------------------------------------------------------

--
-- Table structure for table `child_location`
--

CREATE TABLE `child_location` (
  `id` int(10) UNSIGNED NOT NULL,
  `child_location_id` int(10) UNSIGNED NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `child_location`
--

INSERT INTO `child_location` (`id`, `child_location_id`, `location`, `created_at`, `updated_at`) VALUES
(2, 2, 'New Cairo', '2019-11-14 02:47:11', '2019-11-24 22:18:04'),
(3, 3, 'Maadi', '2019-11-15 13:12:12', '2019-11-24 22:18:10');

-- --------------------------------------------------------

--
-- Table structure for table `child_of_child_location`
--

CREATE TABLE `child_of_child_location` (
  `id` int(10) UNSIGNED NOT NULL,
  `child_of_child_location_id` int(10) UNSIGNED NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `child_of_child_location`
--

INSERT INTO `child_of_child_location` (`id`, `child_of_child_location_id`, `location`, `created_at`, `updated_at`) VALUES
(1, 2, '5th Satellment', '2019-11-13 22:00:00', '2019-11-14 03:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(10) NOT NULL,
  `client_id` int(10) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `client_id`, `name`, `created_at`, `updated_at`) VALUES
(7, 8, 'Rawagg', '2019-10-26 08:29:06', '2019-11-18 22:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE `feature` (
  `id` int(10) UNSIGNED NOT NULL,
  `feature_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`id`, `feature_id`, `title`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 4, 'Privacy', NULL, 'الخصوصية مطلب أساسي في المنزل. من خلال شيش الحصيرة الألومنيوم يمكنك الاستمتاع بالخصوصية داخل منزلك والتحكم بها وفق احتياجاتك.', '2019-08-25 11:19:36', '2019-08-25 11:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parent_location`
--

CREATE TABLE `parent_location` (
  `id` int(10) NOT NULL,
  `parent_location_id` int(10) UNSIGNED NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parent_location`
--

INSERT INTO `parent_location` (`id`, `parent_location_id`, `location`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cairo', NULL, '2019-11-13 22:00:00', '2019-11-14 01:53:12'),
(2, 2, 'Alexandria', NULL, '2019-11-14 01:46:11', '2019-11-14 01:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(10) NOT NULL,
  `service_id` int(10) NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second_description` text COLLATE utf8mb4_unicode_ci,
  `third_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `third_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `service_id`, `slug`, `title`, `description`, `second_title`, `second_description`, `third_title`, `third_description`, `created_at`, `updated_at`) VALUES
(18, 23, NULL, 'OOH Media', 'As we offer you online campaigns using different social media channels also offline campaigns if needed.', NULL, NULL, NULL, NULL, '2019-10-26 08:11:04', '2019-11-15 15:58:50'),
(19, 24, NULL, 'Production', 'As we offer you online campaigns using different social media channels also offline campaigns if needed.', NULL, NULL, NULL, NULL, '2019-11-15 15:59:19', '2019-11-15 15:59:19'),
(20, 25, NULL, 'Other Services', 'As we offer you online campaigns using different social media channels also offline campaigns if needed.', NULL, NULL, NULL, NULL, '2019-11-15 15:59:36', '2019-11-15 15:59:36'),
(21, 26, NULL, 'Landmarks', 'As we offer you online campaigns using different social media channels also offline campaigns if needed.', NULL, NULL, NULL, NULL, '2019-11-15 15:59:56', '2019-11-15 15:59:56'),
(22, 27, NULL, 'Street Signage', 'As we offer you online campaigns using different social media channels also offline campaigns if needed.', NULL, NULL, NULL, NULL, '2019-11-15 16:00:57', '2019-11-15 16:00:57'),
(23, 28, NULL, 'Directional Signs', 'As we offer you online campaigns using different social media channels also offline campaigns if needed.', NULL, NULL, NULL, NULL, '2019-11-15 16:01:36', '2019-11-15 16:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `setting_id` int(10) NOT NULL,
  `website_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `setting_id`, `website_name`, `website_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'E3lan Misr', '\"E3lan Misr for OOH Media Solutions, an agency mainly specified in outdoors’ advertisement based in Egypt since 2005, owning very large portfolio of locations among main roads and areas in Egypt, Large, Medium & Small formats.', '2019-08-07 22:00:00', '2019-11-15 15:10:36');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(10) NOT NULL,
  `slide_id` int(10) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `button` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `slide_id`, `title`, `sub_title`, `description`, `button`, `created_at`, `updated_at`) VALUES
(11, 2, 'Unique & Creative <br> Designs', 'Awesome Designs', 'Production for any branding/advertising items (Landmarks – Mockups – Exhibitions’ Booths )', 'Explore Work', '2019-10-26 07:48:17', '2019-11-16 16:45:13'),
(13, 4, 'Business Consultant', 'Talented Team', NULL, NULL, '2019-10-26 14:53:09', '2019-10-26 14:53:09'),
(14, 5, 'Videography<br> & Photography', 'Photography Services', NULL, 'Explore Work', '2019-10-26 14:55:20', '2019-10-26 14:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(10) NOT NULL,
  `testimonial_id` int(10) NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`),
  ADD KEY `about_ar_id` (`about_id`);

--
-- Indexes for table `billboard`
--
ALTER TABLE `billboard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id_en` (`billboard_id`);

--
-- Indexes for table `child_location`
--
ALTER TABLE `child_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_zone_id` (`child_location_id`);

--
-- Indexes for table `child_of_child_location`
--
ALTER TABLE `child_of_child_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area_parent_id` (`child_of_child_location_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_ar_id` (`client_id`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feature_ar_parent` (`feature_id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id_fk` (`parent_id`);

--
-- Indexes for table `parent_location`
--
ALTER TABLE `parent_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_parent_id` (`parent_location_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_ar_id` (`service_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setting_ar_id` (`setting_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slide_id_ar` (`slide_id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimonial_id_ar` (`testimonial_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `billboard`
--
ALTER TABLE `billboard`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `child_location`
--
ALTER TABLE `child_location`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `child_of_child_location`
--
ALTER TABLE `child_of_child_location`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feature`
--
ALTER TABLE `feature`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parent_location`
--
ALTER TABLE `parent_location`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `about`
--
ALTER TABLE `about`
  ADD CONSTRAINT `about_ar_id` FOREIGN KEY (`about_id`) REFERENCES `e3lanmisr`.`about` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `billboard`
--
ALTER TABLE `billboard`
  ADD CONSTRAINT `project_id_en` FOREIGN KEY (`billboard_id`) REFERENCES `e3lanmisr`.`billboard` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `child_location`
--
ALTER TABLE `child_location`
  ADD CONSTRAINT `parent_zone_id` FOREIGN KEY (`child_location_id`) REFERENCES `e3lanmisr`.`child_location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `child_of_child_location`
--
ALTER TABLE `child_of_child_location`
  ADD CONSTRAINT `area_parent_id` FOREIGN KEY (`child_of_child_location_id`) REFERENCES `e3lanmisr`.`child_of_child_location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ar_id` FOREIGN KEY (`client_id`) REFERENCES `e3lanmisr`.`client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feature`
--
ALTER TABLE `feature`
  ADD CONSTRAINT `feature_ar_parent` FOREIGN KEY (`feature_id`) REFERENCES `e3lanmisr`.`feature` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `parent_id_fk` FOREIGN KEY (`parent_id`) REFERENCES `e3lanmisr`.`parent` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parent_location`
--
ALTER TABLE `parent_location`
  ADD CONSTRAINT `location_parent_id` FOREIGN KEY (`parent_location_id`) REFERENCES `e3lanmisr`.`parent_location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ar_id` FOREIGN KEY (`service_id`) REFERENCES `e3lanmisr`.`service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `setting`
--
ALTER TABLE `setting`
  ADD CONSTRAINT `setting_ar_id` FOREIGN KEY (`setting_id`) REFERENCES `e3lanmisr`.`setting` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `slider`
--
ALTER TABLE `slider`
  ADD CONSTRAINT `slide_id_ar` FOREIGN KEY (`slide_id`) REFERENCES `e3lanmisr`.`slider` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD CONSTRAINT `testimonial_id_ar` FOREIGN KEY (`testimonial_id`) REFERENCES `e3lanmisr`.`testimonial` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
