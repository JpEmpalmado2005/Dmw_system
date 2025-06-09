-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 09, 2025 at 01:30 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dmw`
--
CREATE DATABASE IF NOT EXISTS `dmw` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dmw`;

-- --------------------------------------------------------

--
-- Table structure for table `direct_hire`
--

DROP TABLE IF EXISTS `direct_hire`;
CREATE TABLE IF NOT EXISTS `direct_hire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `control_no` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jobsite` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `evaluated` smallint NOT NULL DEFAULT '0',
  `mwo` smallint NOT NULL DEFAULT '0',
  `pe` smallint NOT NULL DEFAULT '0',
  `pcg` smallint NOT NULL DEFAULT '0',
  `polo` smallint NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `reason` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dhad` smallint NOT NULL DEFAULT '0',
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=364 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `direct_hire`
--

INSERT INTO `direct_hire` (`id`, `control_no`, `name`, `jobsite`, `evaluated`, `mwo`, `pe`, `pcg`, `polo`, `date`, `reason`, `type`, `created_at`, `dhad`, `status`) VALUES
(252, 'CTRL002', 'Sarah Johnson', 'Site B', 1, 0, 1, 0, 1, '2023-01-16 10:15:00', 'Home appliance repair', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(253, 'CTRL003', 'Michael Brown', 'Site C', 1, 1, 1, 1, 0, '2023-01-17 11:00:00', 'Office system upgrade', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(254, 'CTRL004', 'Emily Davis', 'Home 101', 1, 0, 0, 0, 0, '2023-01-18 13:45:00', 'Residential plumbing inspection', 'professional', '2025-05-04 06:23:24', 0, 'approved'),
(255, 'CTRL005', 'Robert Wilson', 'Site D', 1, 1, 1, 1, 1, '2023-01-19 14:30:00', 'Commercial safety compliance', 'professional', '2025-05-04 06:23:24', 0, 'approved'),
(256, 'CTRL006', 'Jennifer Lee', 'Home 202', 1, 1, 0, 1, 0, '2023-01-20 15:20:00', 'Home electrical audit', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(257, 'CTRL007', 'David Martinez', 'Site E', 1, 1, 1, 1, 1, '2023-01-21 08:45:00', 'Corporate facility review', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(258, 'CTRL008', 'Jessica Taylor', 'Home 303', 1, 0, 0, 1, 0, '2023-01-22 10:00:00', 'Residential AC repair', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(259, 'CTRL009', 'Daniel Anderson', 'Site F', 1, 1, 0, 0, 0, '2023-01-23 11:30:00', 'Industrial maintenance', 'professional', '2025-05-04 06:23:24', 0, 'approved'),
(260, 'CTRL010', 'Amanda Thomas', 'Home 404', 1, 0, 1, 0, 1, '2023-01-24 12:15:00', 'Home security installation', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(261, 'CTRL011', 'Christopher White', 'Site G', 0, 0, 1, 1, 0, '2023-01-25 13:00:00', 'Office structural assessment', 'professional', '2025-05-04 06:23:24', 0, 'approved'),
(262, 'CTRL012', 'Matthew Clark', 'Home 505', 0, 1, 0, 0, 1, '2023-01-26 14:45:00', 'Emergency home repair', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(263, 'CTRL013', 'Elizabeth Rodriguez', 'Site H', 1, 1, 1, 0, 0, '2023-01-27 15:30:00', 'Quarterly system check', 'professional', '2025-05-04 06:23:24', 0, 'approved'),
(264, 'CTRL014', 'Andrew Lewis', 'Home 606', 0, 0, 0, 1, 1, '2023-01-28 09:15:00', 'Appliance calibration', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(265, 'CTRL015', 'Nicole Walker', 'Site I', 1, 1, 0, 1, 0, '2023-01-29 10:00:00', 'Business expansion planning', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(266, 'CTRL016', 'Kevin Hall', 'Home 707', 1, 0, 1, 0, 0, '2023-01-30 11:45:00', 'Home network update', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(267, 'CTRL017', 'Samantha Young', 'Site J', 1, 1, 1, 1, 1, '2023-01-31 12:30:00', 'Annual corporate maintenance', 'professional', '2025-05-04 06:23:24', 0, 'approved'),
(268, 'CTRL018', 'Joshua Allen', 'Home 808', 0, 0, 0, 0, 1, '2023-02-01 13:15:00', 'Temporary home setup', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(269, 'CTRL019', 'Megan King', 'Site K', 1, 1, 0, 1, 0, '2023-02-02 14:00:00', 'Workplace safety check', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(270, 'CTRL020', 'Ryan Scott', 'Home 909', 1, 0, 1, 0, 1, '2023-02-03 15:45:00', 'Home renovation', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(271, 'CTRL021', 'Lauren Green', 'Site L', 1, 1, 1, 0, 0, '2023-02-04 09:30:00', 'Business system optimization', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(272, 'CTRL022', 'Justin Adams', 'Home 1010', 0, 1, 0, 1, 0, '2023-02-05 10:15:00', 'Furniture assembly', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(273, 'CTRL023', 'Hannah Baker', 'Site M', 1, 0, 1, 0, 1, '2023-02-06 11:00:00', 'Professional process study', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(274, 'CTRL024', 'Brandon Nelson', 'Home 1111', 0, 0, 0, 1, 0, '2023-02-07 13:45:00', 'Residential adjustments', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(275, 'CTRL025', 'Rachel Carter', 'Site N', 1, 1, 1, 1, 1, '2023-02-08 14:30:00', 'Corporate audit', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(276, 'CTRL026', 'Nathan Mitchell', 'Home 1212', 0, 0, 0, 0, 0, '2023-02-09 15:20:00', 'Home cleaning service', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(277, 'CTRL027', 'Olivia Perez', 'Site O', 1, 1, 0, 1, 0, '2023-02-10 08:45:00', 'Equipment performance test', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(278, 'CTRL028', 'Tyler Roberts', 'Home 1313', 0, 0, 1, 0, 1, '2023-02-11 10:00:00', 'Home safety implementation', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(279, 'CTRL029', 'Brittany Turner', 'Site P', 1, 1, 1, 0, 0, '2023-02-12 11:30:00', 'Professional certification', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(280, 'CTRL030', 'Alexander Phillips', 'Home 1414', 0, 0, 0, 1, 0, '2023-02-13 12:15:00', 'Home inventory review', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(281, 'CTRL031', 'Kayla Campbell', 'Site Q', 1, 1, 0, 0, 1, '2023-02-14 13:00:00', 'Office access control', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(282, 'CTRL032', 'Patrick Parker', 'Home 1515', 0, 1, 1, 0, 0, '2023-02-15 14:45:00', 'Energy efficiency at home', 'professional', '2025-05-04 06:23:24', 0, 'denied'),
(283, 'CTRL033', 'Victoria Evans', 'Site R', 1, 0, 0, 1, 1, '2023-02-16 15:30:00', 'Workplace emergency drill', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(284, 'CTRL034', 'Samuel Edwards', 'Home 1616', 0, 0, 1, 0, 0, '2023-02-17 09:15:00', 'Home appliance training', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(285, 'CTRL035', 'Alexandra Collins', 'Site S', 1, 1, 1, 1, 1, '2023-02-18 10:00:00', 'Business evaluation', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(286, 'CTRL036', 'Benjamin Stewart', 'Home 1717', 0, 0, 0, 0, 1, '2023-02-19 11:45:00', 'Home system shutdown', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(287, 'CTRL037', 'Mackenzie Sanchez', 'Site T', 1, 1, 0, 1, 0, '2023-02-20 12:30:00', 'Professional maintenance', 'professional', '2025-05-04 06:23:24', 0, 'approved'),
(288, 'CTRL038', 'Noah Morris', 'Home 1818', 0, 0, 1, 0, 0, '2023-02-21 13:15:00', 'Home IT fixes', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(289, 'CTRL039', 'Chloe Rogers', 'Site U', 1, 1, 1, 0, 1, '2023-02-22 14:00:00', 'Business expansion', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(290, 'CTRL040', 'Dylan Reed', 'Home 1919', 0, 0, 0, 1, 0, '2023-02-23 15:45:00', 'Furniture relocation', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(291, 'CTRL041', 'Ava Cook', 'Site V', 1, 1, 0, 0, 1, '2023-02-24 09:30:00', 'Professional training', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(292, 'CTRL042', 'Caleb Morgan', 'Home 2020', 0, 1, 1, 0, 0, '2023-02-25 10:15:00', 'Home system analysis', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(293, 'CTRL043', 'Sophia Bell', 'Site W', 1, 0, 0, 1, 1, '2023-02-26 11:00:00', 'Office emergency check', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(294, 'CTRL044', 'Ethan Murphy', 'Home 2121', 0, 0, 1, 0, 0, '2023-02-27 13:45:00', 'New home protocol', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(295, 'CTRL045', 'Isabella Bailey', 'Site X', 1, 1, 1, 1, 1, '2023-02-28 14:30:00', 'Corporate inspection', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(296, 'CTRL046', 'Liam Rivera', 'Home 2222', 0, 0, 0, 0, 0, '2023-03-01 15:20:00', 'Home system backup', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(297, 'CTRL047', 'Charlotte Cooper', 'Site Y', 1, 1, 0, 1, 0, '2023-03-02 08:45:00', 'Professional maintenance log', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(298, 'CTRL048', 'Mason Richardson', 'Home 2323', 0, 0, 1, 0, 1, '2023-03-03 10:00:00', 'Home security upgrade', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(299, 'CTRL049', 'Amelia Cox', 'Site Z', 1, 1, 1, 0, 0, '2023-03-04 11:30:00', 'Business documentation', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(300, 'CTRL050', 'James Howard', 'Home 2424', 0, 0, 0, 1, 0, '2023-03-05 12:15:00', 'Home supply check', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(301, 'CTRL051', 'Harper Ward', 'Site AA', 1, 1, 0, 0, 1, '2023-03-06 13:00:00', 'Workplace safety', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(302, 'CTRL052', 'Logan Torres', 'Home 2525', 0, 1, 1, 0, 0, '2023-03-07 14:45:00', 'Home upgrade planning', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(303, 'CTRL053', 'Evelyn Peterson', 'Site AB', 1, 0, 0, 1, 1, '2023-03-08 15:30:00', 'Professional emergency training', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(304, 'CTRL054', 'Jacob Gray', 'Home 2626', 0, 0, 1, 0, 0, '2023-03-09 09:15:00', 'Appliance metrics', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(305, 'CTRL055', 'Abigail Ramirez', 'Site AC', 1, 1, 1, 1, 1, '2023-03-10 10:00:00', 'Corporate safety audit', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(306, 'CTRL056', 'William James', 'Home 2727', 0, 0, 0, 0, 1, '2023-03-11 11:45:00', 'Temporary home work area', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(307, 'CTRL057', 'Emily Watson', 'Site AD', 1, 1, 0, 1, 0, '2023-03-12 12:30:00', 'Professional maintenance', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(308, 'CTRL058', 'Alexander Brooks', 'Home 2828', 0, 0, 1, 0, 0, '2023-03-13 13:15:00', 'Home software renewal', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(309, 'CTRL059', 'Madison Sanders', 'Site AE', 1, 1, 1, 0, 1, '2023-03-14 14:00:00', 'Business improvement', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(310, 'CTRL060', 'Michael Price', 'Home 2929', 0, 0, 0, 1, 0, '2023-03-15 15:45:00', 'Home appliance calibration', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(311, 'CTRL061', 'Elizabeth Bennett', 'Site AF', 1, 1, 0, 0, 1, '2023-03-16 09:30:00', 'Office safety update', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(312, 'CTRL062', 'Daniel Wood', 'Home 3030', 0, 1, 1, 0, 0, '2023-03-17 10:15:00', 'Home system optimization', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(313, 'CTRL063', 'Chloe Barnes', 'Site AG', 1, 0, 0, 1, 1, '2023-03-18 11:00:00', 'Professional inspection', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(314, 'CTRL064', 'Matthew Ross', 'Home 3131', 0, 0, 1, 0, 0, '2023-03-19 13:45:00', 'Homeowner training', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(315, 'CTRL065', 'Aubrey Henderson', 'Site AH', 1, 1, 1, 1, 1, '2023-03-20 14:30:00', 'Corporate planning', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(316, 'CTRL066', 'David Coleman', 'Home 3232', 0, 0, 0, 0, 0, '2023-03-21 15:20:00', 'Home diagnostics', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(317, 'CTRL067', 'Scarlett Jenkins', 'Site AI', 1, 1, 0, 1, 0, '2023-03-22 08:45:00', 'Professional documentation', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(318, 'CTRL068', 'Joseph Perry', 'Home 3333', 0, 0, 1, 0, 1, '2023-03-23 10:00:00', 'Residential security', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(319, 'CTRL069', 'Victoria Powell', 'Site AJ', 1, 1, 1, 0, 0, '2023-03-24 11:30:00', 'Business efficiency study', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(320, 'CTRL070', 'Jackson Long', 'Home 3434', 0, 0, 0, 1, 0, '2023-03-25 12:15:00', 'Home inventory update', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(321, 'CTRL071', 'Grace Hughes', 'Site AK', 1, 1, 0, 0, 1, '2023-03-26 13:00:00', 'Professional audit', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(322, 'CTRL072', 'Samuel Flores', 'Home 3535', 0, 1, 1, 0, 0, '2023-03-27 14:45:00', 'Home system testing', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(323, 'CTRL073', 'Zoey Washington', 'Site AL', 1, 0, 0, 1, 1, '2023-03-28 15:30:00', 'Corporate review', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(324, 'CTRL074', 'Henry Butler', 'Home 3636', 0, 0, 1, 0, 0, '2023-03-29 09:15:00', 'Home specifications', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(325, 'CTRL075', 'Lily Simmons', 'Site AM', 1, 1, 1, 1, 1, '2023-03-30 10:00:00', 'Business assessment', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(326, 'CTRL076', 'Owen Foster', 'Home 3737', 0, 0, 0, 0, 1, '2023-03-31 11:45:00', 'Temporary home configuration', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(327, 'CTRL077', 'Hannah Gonzales', 'Site AN', 1, 1, 0, 1, 0, '2023-04-01 12:30:00', 'Professional checklist', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(328, 'CTRL078', 'Sebastian Bryant', 'Home 3838', 0, 0, 1, 0, 0, '2023-04-02 13:15:00', 'Home software update', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(329, 'CTRL079', 'Penelope Russell', 'Site AO', 1, 1, 1, 0, 1, '2023-04-03 14:00:00', 'Business documentation', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(330, 'CTRL080', 'Aiden Griffin', 'Home 3939', 0, 0, 0, 1, 0, '2023-04-04 15:45:00', 'Appliance review', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(331, 'CTRL081', 'Addison Diaz', 'Site AP', 1, 1, 0, 0, 1, '2023-04-05 09:30:00', 'Professional training', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(332, 'CTRL082', 'Wyatt Hayes', 'Home 4040', 0, 1, 1, 0, 0, '2023-04-06 10:15:00', 'Home system project', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(333, 'CTRL083', 'Layla Myers', 'Site AQ', 1, 0, 0, 1, 1, '2023-04-07 11:00:00', 'Professional maintenance', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(334, 'CTRL084', 'Carter Ford', 'Home 4141', 0, 0, 1, 0, 0, '2023-04-08 13:45:00', 'Home protocol training', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(335, 'CTRL085', 'Nora Hamilton', 'Site AR', 1, 1, 1, 1, 1, '2023-04-09 14:30:00', 'Corporate certification', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(336, 'CTRL086', 'Luke Graham', 'Home 4242', 0, 0, 0, 0, 0, '2023-04-10 15:20:00', 'Residential walkthrough', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(337, 'CTRL087', 'Stella Sullivan', 'Site AS', 1, 1, 0, 1, 0, '2023-04-11 08:45:00', 'Professional records', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(338, 'CTRL088', 'Gabriel Wallace', 'Home 4343', 0, 0, 1, 0, 1, '2023-04-12 10:00:00', 'Home security', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(339, 'CTRL089', 'Hazel West', 'Site AT', 1, 1, 1, 0, 0, '2023-04-13 11:30:00', 'Business initiative', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(340, 'CTRL090', 'Julian Cole', 'Home 4444', 0, 0, 0, 1, 0, '2023-04-14 12:15:00', 'Home tracking update', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(341, 'CTRL091', 'Violet Bryant', 'Site AU', 1, 1, 0, 0, 1, '2023-04-15 13:00:00', 'Professional certification', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(342, 'CTRL092', 'Christian Alexander', 'Home 4545', 0, 1, 1, 0, 0, '2023-04-16 14:45:00', 'Home system planning', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(343, 'CTRL093', 'Ellie Lane', 'Site AV', 1, 0, 0, 1, 1, '2023-04-17 15:30:00', 'Corporate protocol', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(344, 'CTRL094', 'Jonathan Harper', 'Home 4646', 0, 0, 1, 0, 0, '2023-04-18 09:15:00', 'Home equipment review', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(345, 'CTRL095', 'Natalie George', 'Site AW', 1, 1, 1, 1, 1, '2023-04-19 10:00:00', 'Business evaluation', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(346, 'CTRL096', 'Isaiah Greene', 'Home 4747', 0, 0, 0, 0, 1, '2023-04-20 11:45:00', 'Temporary adjustment', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(347, 'CTRL097', 'Savannah Burke', 'Site AX', 1, 1, 0, 1, 0, '2023-04-21 12:30:00', 'Professional schedule', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(348, 'CTRL098', 'Charles Dean', 'Home 4848', 0, 0, 1, 0, 0, '2023-04-22 13:15:00', 'Home IT troubleshooting', 'household', '2025-05-04 06:23:24', 0, 'pending'),
(349, 'CTRL099', 'Audrey Arnold', 'Site AY', 1, 1, 1, 0, 1, '2023-04-23 14:00:00', 'Business documentation', 'professional', '2025-05-04 06:23:24', 1, 'approved'),
(350, 'CTRL100', 'Thomas Cunningham', 'Home 4949', 0, 0, 0, 1, 0, '2023-04-24 15:45:00', 'Home calibration records', 'household', '2025-05-04 06:23:24', 0, 'denied'),
(353, 'CTRL0011', 'rinli', 'Laguna', 1, 1, 1, 1, 0, '0000-00-00 00:00:00', '', 'professional', '2025-05-05 01:06:08', 0, ''),
(354, 'CTRL001', 'JP', 'Laguna', 1, 1, 1, 1, 0, '0000-00-00 00:00:00', '', 'professional', '2025-05-08 23:26:27', 0, 'denied'),
(355, 'CTRL002', 'JP', 'Laguna', 1, 0, 0, 0, 1, '0000-00-00 00:00:00', '', 'household', '2025-05-08 23:26:55', 0, 'approved'),
(356, 'dassa', 'dada', 'dsada', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 'sada', 'professional', '2025-05-08 23:33:11', 1, 'denied'),
(357, 'CTRL0012', 'sada', 'dsada', 1, 1, 0, 0, 0, '0000-00-00 00:00:00', '', 'professional', '2025-05-09 00:54:14', 1, 'approved'),
(358, 'sadas', 'dada', 'sada', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 'sadasda', 'professional', '2025-05-09 00:54:23', 1, 'denied'),
(359, 'sadas', 'sadas', 'sad', 1, 1, 0, 0, 0, '0000-00-00 00:00:00', '', 'professional', '2025-05-09 02:24:31', 1, 'approved'),
(360, 'test', 'another', 'lspu', 1, 1, 1, 1, 0, '0000-00-00 00:00:00', '', 'professional', '2025-05-09 03:34:23', 1, 'pending'),
(361, 'CTRL001', 'JPEMPALMADO', 'Site A', 1, 0, 0, 0, 1, '0000-00-00 00:00:00', '', 'household', '2025-05-09 03:34:38', 0, 'approved'),
(362, 'CTRL-99322', 'JP', 'Laguna', 1, 1, 0, 0, 0, '0000-00-00 00:00:00', '', 'professional', '2025-05-26 00:48:14', 1, 'denied'),
(363, 'CTRL001', 'JP', 'Laguna', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', '', 'professional', '2025-05-26 05:41:07', 1, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `gov_to_gov`
--

DROP TABLE IF EXISTS `gov_to_gov`;
CREATE TABLE IF NOT EXISTS `gov_to_gov` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lastname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `middlename` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `birthdate` date NOT NULL,
  `age` int NOT NULL,
  `height_cm` int NOT NULL,
  `weight_kg` int NOT NULL,
  `educ_attainment` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `present_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `passport_validity` date NOT NULL,
  `id_presented` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_number` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `taiwan_exp` smallint NOT NULL DEFAULT '0',
  `taiwan_company` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `taiwan_date_ended` date NOT NULL,
  `job_exp` smallint NOT NULL DEFAULT '0',
  `job_company_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `job_date_started` date NOT NULL,
  `taiwan_date_started` date NOT NULL,
  `job_date_ended` date NOT NULL,
  `sex` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contact_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gov_to_gov`
--

INSERT INTO `gov_to_gov` (`id`, `lastname`, `firstname`, `middlename`, `birthdate`, `age`, `height_cm`, `weight_kg`, `educ_attainment`, `present_address`, `email_address`, `passport_validity`, `id_presented`, `id_number`, `taiwan_exp`, `taiwan_company`, `taiwan_date_ended`, `job_exp`, `job_company_name`, `job_date_started`, `taiwan_date_started`, `job_date_ended`, `sex`, `created_at`, `contact_number`) VALUES
(215, 'Dela Cruz', 'Juan', 'Santos', '1990-05-15', 34, 175, 68, 'College Graduate', '123 Main St, Quezon City', 'juan.delacruz0@email.com', '2027-09-18', 'Passport', '123456789', 1, 'Formosa Inc.', '2022-07-14', 1, 'ABC Corporation', '2015-04-01', '2018-05-22', '2017-10-10', 'Male', '2025-05-04 08:10:29', '09123456789'),
(216, 'Reyes', 'Maria', 'Luna', '1989-12-22', 35, 165, 55, 'Master\'s Degree', '456 Oak Ave, Makati', 'maria.reyes1@email.com', '2026-03-11', 'Driver\'s License', '987654321', 0, 'Wistron Corp.', '2014-11-01', 1, 'XYZ Industries', '2016-01-10', '2012-08-09', '2018-02-20', 'Female', '2025-05-04 08:10:29', '09234567890'),
(217, 'Santos', 'Jose', 'Martinez', '1992-06-30', 32, 170, 70, 'Some College/Vocational', '789 Elm St, Cebu City', 'jose.santos2@email.com', '2028-01-15', 'National ID', '456789123', 1, 'Taiwan Tech Ltd.', '2021-12-31', 1, 'BuildWell Co.', '2014-03-15', '2017-01-01', '2016-09-30', 'Male', '2025-05-04 08:10:29', '09345678901'),
(218, 'Lopez', 'Ana', 'Cruz', '1991-11-12', 33, 160, 50, 'College Graduate', '321 Pine Rd, Davao', 'ana.lopez3@email.com', '2029-06-25', 'SSS ID', '789123456', 0, 'Pegatron Corp.', '2015-08-22', 0, 'Manila Works Inc.', '2016-11-11', '2013-05-17', '2018-03-27', 'Female', '2025-05-04 08:10:29', '09456789012'),
(219, 'Torres', 'Luis', 'Alvarez', '1988-02-25', 36, 178, 72, 'Highschool', '654 Maple Dr, Baguio', 'luis.torres4@email.com', '2025-11-02', 'PhilHealth ID', '234567891', 1, 'Compal Electronics', '2019-01-01', 1, 'TechSolutions', '2011-05-10', '2015-02-01', '2013-07-15', 'Male', '2025-05-04 08:10:29', '09567890123'),
(220, 'Ramos', 'Carmen', 'Diaz', '1994-08-10', 30, 158, 53, 'Highschool undergraduate', '123 Main St, Quezon City', 'carmen.ramos5@email.com', '2027-04-05', 'Passport', '876543210', 0, 'Wistron Corp.', '2018-12-01', 1, 'ABC Corporation', '2019-06-01', '2016-03-20', '2022-02-01', 'Female', '2025-05-04 08:10:29', '09678901234'),
(221, 'Fernandez', 'Pedro', 'Torres', '1990-10-05', 34, 180, 80, 'Doctorate Degree', '456 Oak Ave, Makati', 'pedro.fernandez6@email.com', '2026-07-19', 'Driver\'s License', '345678912', 1, 'Taiwan Tech Ltd.', '2019-10-10', 0, 'XYZ Industries', '2020-01-15', '2014-10-10', '2022-12-01', 'Male', '2025-05-04 08:10:29', '09789012345'),
(222, 'Garcia', 'Lucia', 'Gomez', '1993-03-18', 31, 165, 60, 'Master\'s Degree', '789 Elm St, Cebu City', 'lucia.garcia7@email.com', '2028-12-31', 'National ID', '654321789', 0, 'Formosa Inc.', '2016-09-01', 1, 'TechSolutions', '2017-05-01', '2012-09-01', '2020-04-01', 'Female', '2025-05-04 08:10:29', '09890123456'),
(223, 'Mendoza', 'Carlos', 'Ruiz', '1991-04-22', 33, 172, 77, 'College Graduate', '321 Pine Rd, Davao', 'carlos.mendoza8@email.com', '2025-08-15', 'SSS ID', '567891234', 1, 'Compal Electronics', '2020-06-01', 1, 'BuildWell Co.', '2021-01-01', '2016-06-01', '2023-01-01', 'Male', '2025-05-04 08:10:29', '09901234567'),
(224, 'Dela Cruz', 'Isabel', 'Vega', '1995-07-11', 29, 162, 52, 'Elementary undergraduate', '654 Maple Dr, Baguio', 'isabel.delacruz9@email.com', '2027-10-22', 'PhilHealth ID', '789012345', 0, 'Pegatron Corp.', '2021-03-01', 0, 'Manila Works Inc.', '2022-04-01', '2017-03-01', '2024-01-01', 'Female', '2025-05-04 08:10:29', '09111222333'),
(225, 'Navarro', 'Ricardo', 'Salazar', '1992-09-14', 32, 176, 73, 'College Graduate', '123 Main St, Quezon City', 'ricardo.navarro10@email.com', '2029-01-10', 'Passport', '901234567', 1, 'Formosa Inc.', '2019-02-01', 1, 'ABC Corporation', '2020-05-01', '2015-03-01', '2022-11-01', 'Male', '2025-05-04 08:10:51', '09112223334'),
(226, 'Villanueva', 'Teresita', 'Domingo', '1993-05-25', 31, 163, 58, 'Master\'s Degree', '456 Oak Ave, Makati', 'teresita.villanueva11@email.com', '2028-06-14', 'Driver\'s License', '234567890', 0, 'Wistron Corp.', '2016-06-01', 1, 'XYZ Industries', '2017-09-01', '2013-07-15', '2021-12-01', 'Female', '2025-05-04 08:10:51', '09223334455'),
(227, 'Castillo', 'Eduardo', 'Ponce', '1990-03-02', 34, 174, 75, 'Some College/Vocational', '789 Elm St, Cebu City', 'eduardo.castillo12@email.com', '2026-10-10', 'National ID', '345678901', 1, 'Taiwan Tech Ltd.', '2018-12-01', 1, 'BuildWell Co.', '2019-03-01', '2014-05-01', '2022-05-01', 'Male', '2025-05-04 08:10:51', '09334445566'),
(228, 'Agustin', 'Beatriz', 'Ramos', '1991-08-18', 33, 160, 54, 'College Graduate', '321 Pine Rd, Davao', 'beatriz.agustin13@email.com', '2025-03-25', 'SSS ID', '456789012', 0, 'Pegatron Corp.', '2015-10-01', 0, 'Manila Works Inc.', '2016-07-01', '2012-11-01', '2019-06-01', 'Female', '2025-05-04 08:10:51', '09445556677'),
(229, 'Gutierrez', 'Marco', 'Nieves', '1989-07-20', 35, 180, 78, 'Highschool', '654 Maple Dr, Baguio', 'marco.gutierrez14@email.com', '2027-12-15', 'PhilHealth ID', '567890123', 1, 'Compal Electronics', '2020-04-01', 1, 'TechSolutions', '2021-08-01', '2016-04-01', '2023-10-01', 'Male', '2025-05-04 08:10:51', '09556667788'),
(230, 'Morales', 'Cynthia', 'Beltran', '1995-10-09', 29, 164, 56, 'Highschool undergraduate', '123 Main St, Quezon City', 'cynthia.morales15@email.com', '2028-05-30', 'Passport', '678901234', 0, 'Wistron Corp.', '2022-06-01', 1, 'ABC Corporation', '2023-01-01', '2018-06-01', '2024-04-01', 'Female', '2025-05-04 08:10:51', '09667778899'),
(231, 'Alvarez', 'Roberto', 'Ramos', '1993-01-17', 31, 177, 76, 'Doctorate Degree', '456 Oak Ave, Makati', 'roberto.alvarez16@email.com', '2029-03-01', 'Driver\'s License', '789012345', 1, 'Taiwan Tech Ltd.', '2017-10-01', 0, 'XYZ Industries', '2018-12-01', '2013-10-01', '2021-10-01', 'Male', '2025-05-04 08:10:51', '09778889900'),
(232, 'Domingo', 'Helena', 'Suarez', '1992-04-06', 32, 161, 57, 'Master\'s Degree', '789 Elm St, Cebu City', 'helena.domingo17@email.com', '2025-08-18', 'National ID', '890123456', 0, 'Formosa Inc.', '2014-01-01', 1, 'TechSolutions', '2015-03-01', '2011-01-01', '2018-06-01', 'Female', '2025-05-04 08:10:51', '09889990011'),
(233, 'Silva', 'Andres', 'Vega', '1994-06-13', 30, 172, 71, 'College Graduate', '321 Pine Rd, Davao', 'andres.silva18@email.com', '2026-12-10', 'SSS ID', '901234567', 1, 'Compal Electronics', '2019-11-01', 1, 'BuildWell Co.', '2020-07-01', '2015-12-01', '2023-02-01', 'Male', '2025-05-04 08:10:51', '09990001122'),
(234, 'Soriano', 'Elaine', 'Castro', '1991-02-28', 33, 159, 52, 'Elementary undergraduate', '654 Maple Dr, Baguio', 'elaine.soriano19@email.com', '2027-07-07', 'PhilHealth ID', '123456780', 0, 'Pegatron Corp.', '2018-08-01', 0, 'Manila Works Inc.', '2019-10-01', '2014-08-01', '2022-01-01', 'Female', '2025-05-04 08:10:51', '09110002233'),
(235, 'Mendoza', 'Carlos', 'Reyes', '1990-12-05', 34, 178, 74, 'College Graduate', '45 West Ave, Pasig', 'carlos.mendoza20@email.com', '2029-05-20', 'Passport', '102938475', 1, 'Wistron Corp.', '2019-10-01', 1, 'XYZ Industries', '2020-01-15', '2016-05-01', '2023-03-10', 'Male', '2025-05-04 08:12:49', '09120003344'),
(236, 'Santos', 'Lucia', 'Belmonte', '1993-09-17', 31, 160, 60, 'Some College/Vocational', '789 Rizal St, Manila', 'lucia.santos21@email.com', '2027-12-25', 'Driver\'s License', '203948576', 0, 'Formosa Inc.', '2015-09-01', 1, 'BuildWell Co.', '2016-06-01', '2013-03-01', '2020-11-01', 'Female', '2025-05-04 08:12:49', '09221114455'),
(237, 'Fernandez', 'Miguel', 'Cruz', '1988-11-03', 36, 181, 80, 'Master\'s Degree', '456 Santolan Rd, San Juan', 'miguel.fernandez22@email.com', '2028-09-12', 'SSS ID', '304958617', 1, 'Compal Electronics', '2015-07-01', 1, 'ABC Corporation', '2016-03-01', '2012-08-01', '2020-12-01', 'Male', '2025-05-04 08:12:49', '09332225566'),
(238, 'Garcia', 'Elena', 'Lopez', '1994-04-19', 30, 163, 59, 'College Graduate', '123 Mabini St, Laguna', 'elena.garcia23@email.com', '2025-11-18', 'National ID', '405869723', 0, 'Pegatron Corp.', '2019-05-01', 0, 'TechSolutions', '2020-07-01', '2015-04-01', '2023-01-01', 'Female', '2025-05-04 08:12:49', '09443336677'),
(239, 'Torres', 'Francisco', 'Navarro', '1991-06-26', 33, 177, 77, 'Doctorate Degree', '987 J.P. Rizal, Marikina', 'francisco.torres24@email.com', '2026-01-14', 'Passport', '506978341', 1, 'Taiwan Tech Ltd.', '2017-03-01', 1, 'Manila Works Inc.', '2018-04-01', '2013-02-01', '2022-08-01', 'Male', '2025-05-04 08:12:49', '09554447788'),
(240, 'Ramos', 'Jessica', 'Manalo', '1992-03-15', 32, 165, 57, 'College Graduate', '456 Zapote, Cavite', 'jessica.ramos25@email.com', '2027-08-23', 'Driver\'s License', '607189435', 0, 'Formosa Inc.', '2016-01-01', 1, 'XYZ Industries', '2017-05-01', '2014-01-01', '2021-12-01', 'Female', '2025-05-04 08:12:49', '09665558899'),
(241, 'Bautista', 'Roberto', 'Santos', '1990-02-11', 34, 179, 76, 'Elementary', '321 Daang Hari, Taguig', 'roberto.bautista26@email.com', '2029-04-09', 'PhilHealth ID', '708290546', 1, 'Wistron Corp.', '2014-06-01', 1, 'BuildWell Co.', '2015-07-01', '2011-05-01', '2019-10-01', 'Male', '2025-05-04 08:12:49', '09776669900'),
(242, 'Cruz', 'Amelia', 'Diaz', '1993-07-28', 31, 162, 56, 'Highschool undergraduate', '100 Aurora Blvd, QC', 'amelia.cruz27@email.com', '2026-06-06', 'Passport', '809301657', 0, 'Compal Electronics', '2015-01-01', 0, 'TechSolutions', '2016-03-01', '2012-10-01', '2018-07-01', 'Female', '2025-05-04 08:12:49', '09887770011'),
(243, 'Rivera', 'Jorge', 'Quintos', '1989-10-23', 35, 175, 72, 'Highschool', '52 Ortigas Ext, Pasig', 'jorge.rivera28@email.com', '2025-02-19', 'National ID', '910412768', 1, 'Taiwan Electronics Co.', '2016-08-01', 1, 'ABC Corporation', '2017-10-01', '2013-06-01', '2022-01-01', 'Male', '2025-05-04 08:12:49', '09118882233'),
(244, 'Lopez', 'Mariana', 'Rosales', '1995-01-12', 29, 158, 53, 'Some College/Vocational', '101 P. Tuazon Blvd, Cubao', 'mariana.lopez29@email.com', '2028-03-21', 'SSS ID', '112523879', 0, 'Pegatron Corp.', '2019-03-01', 0, 'Manila Works Inc.', '2020-06-01', '2016-01-01', '2023-02-01', 'Female', '2025-05-04 08:12:49', '09225551122'),
(245, 'Empalmado', 'jp', 'caballes', '1970-01-01', 19, 167, 65, 'College Undergraduate', 'Block 16 Lot 13 Bay Garden Homes', 'test@email.com', '2030-07-17', 'uploads/b47e3cbb74566289_1746761137.png', '1112222', 0, '', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', '0000-00-00', 'Male', '2025-05-09 03:25:37', '09090339393'),
(246, 'Empalmado', 'John', 'Paul', '2025-11-13', 19, 167, 64, 'College Undergraduate', 'Block 16 Lot 13 Bay Garden Homes', 'test2@gmail.com', '1970-01-01', 'uploads/2c961f1ce917731b_1746763085.png', '1112222', 0, '', '0000-00-00', 0, '', '0000-00-00', '0000-00-00', '0000-00-00', 'Male', '2025-05-09 03:58:05', '09207004220');

-- --------------------------------------------------------

--
-- Table structure for table `information_sheet`
--

DROP TABLE IF EXISTS `information_sheet`;
CREATE TABLE IF NOT EXISTS `information_sheet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `male` int NOT NULL,
  `female` int NOT NULL,
  `highest_pct` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lowest_pct` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `employment` int NOT NULL,
  `owwa` int NOT NULL,
  `legal` int NOT NULL,
  `loan` int NOT NULL,
  `visa` int NOT NULL,
  `bm` int NOT NULL,
  `rtt` int NOT NULL,
  `philhealth` int NOT NULL,
  `others` int NOT NULL,
  `landbased` int NOT NULL,
  `rehire` int NOT NULL,
  `seafarer` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `information_sheet`
--

INSERT INTO `information_sheet` (`id`, `date`, `male`, `female`, `highest_pct`, `lowest_pct`, `employment`, `owwa`, `legal`, `loan`, `visa`, `bm`, `rtt`, `philhealth`, `others`, `landbased`, `rehire`, `seafarer`, `created_at`) VALUES
(1, '2023-01-01 00:00:00', 72, 85, '14', '5', 120, 45, 30, 25, 60, 15, 10, 80, 5, 100, 20, 40, '2025-05-04 05:28:50'),
(2, '2023-01-02 08:15:00', 71, 84, '15', '6', 118, 44, 29, 24, 59, 14, 9, 79, 6, 98, 19, 39, '2025-05-04 05:28:50'),
(3, '2023-01-03 08:30:00', 73, 86, '13', '4', 122, 46, 31, 26, 61, 16, 11, 81, 4, 102, 21, 41, '2025-05-04 05:28:50'),
(4, '2023-01-04 08:45:00', 70, 83, '16', '7', 117, 43, 28, 23, 58, 15, 10, 78, 7, 97, 18, 38, '2025-05-04 05:28:50'),
(5, '2023-01-05 09:00:00', 74, 87, '12', '3', 123, 47, 32, 27, 62, 17, 12, 82, 3, 103, 22, 42, '2025-05-04 05:28:50'),
(6, '2023-01-06 09:15:00', 75, 88, '14', '5', 124, 48, 33, 28, 63, 18, 13, 83, 8, 104, 23, 43, '2025-05-04 05:28:50'),
(7, '2023-01-07 09:30:00', 76, 89, '15', '6', 125, 49, 34, 29, 64, 19, 14, 84, 9, 105, 24, 44, '2025-05-04 05:28:50'),
(8, '2023-01-08 09:45:00', 77, 90, '13', '4', 126, 50, 35, 30, 65, 20, 15, 85, 5, 106, 25, 45, '2025-05-04 05:28:50'),
(9, '2023-01-09 10:00:00', 78, 91, '16', '7', 127, 51, 36, 31, 66, 21, 16, 86, 10, 107, 26, 46, '2025-05-04 05:28:50'),
(10, '2023-01-10 10:15:00', 79, 92, '12', '3', 128, 52, 37, 32, 67, 22, 17, 87, 4, 108, 27, 47, '2025-05-04 05:28:50'),
(11, '2023-02-01 08:00:00', 80, 95, '14', '5', 135, 55, 40, 35, 70, 25, 20, 90, 15, 115, 30, 50, '2025-05-04 05:28:50'),
(12, '2023-02-02 08:30:00', 81, 96, '15', '6', 136, 56, 41, 36, 71, 26, 21, 91, 16, 116, 31, 51, '2025-05-04 05:28:50'),
(13, '2023-02-03 09:00:00', 82, 97, '13', '4', 137, 57, 42, 37, 72, 27, 22, 92, 14, 117, 32, 52, '2025-05-04 05:28:50'),
(14, '2023-02-04 09:30:00', 83, 98, '16', '7', 138, 58, 43, 38, 73, 28, 23, 93, 17, 118, 33, 53, '2025-05-04 05:28:50'),
(15, '2023-02-05 10:00:00', 84, 99, '12', '3', 139, 59, 44, 39, 74, 29, 24, 94, 13, 119, 34, 54, '2025-05-04 05:28:50'),
(16, '2023-02-06 10:30:00', 85, 100, '14', '5', 140, 60, 45, 40, 75, 30, 25, 95, 18, 120, 35, 55, '2025-05-04 05:28:50'),
(17, '2023-02-07 11:00:00', 86, 101, '15', '6', 141, 61, 46, 41, 76, 31, 26, 96, 19, 121, 36, 56, '2025-05-04 05:28:50'),
(18, '2023-02-08 11:30:00', 87, 102, '13', '4', 142, 62, 47, 42, 77, 32, 27, 97, 15, 122, 37, 57, '2025-05-04 05:28:50'),
(19, '2023-02-09 12:00:00', 88, 103, '16', '7', 143, 63, 48, 43, 78, 33, 28, 98, 20, 123, 38, 58, '2025-05-04 05:28:50'),
(20, '2023-02-10 12:30:00', 89, 104, '12', '3', 144, 64, 49, 44, 79, 34, 29, 99, 14, 124, 39, 59, '2025-05-04 05:28:50'),
(21, '2023-03-01 08:00:00', 90, 110, '14', '5', 150, 70, 55, 50, 85, 40, 35, 105, 25, 130, 45, 65, '2025-05-04 05:28:50'),
(22, '2023-03-02 08:30:00', 91, 111, '15', '6', 151, 71, 56, 51, 86, 41, 36, 106, 26, 131, 46, 66, '2025-05-04 05:28:50'),
(23, '2023-03-03 09:00:00', 92, 112, '13', '4', 152, 72, 57, 52, 87, 42, 37, 107, 24, 132, 47, 67, '2025-05-04 05:28:50'),
(24, '2023-03-04 09:30:00', 93, 113, '16', '7', 153, 73, 58, 53, 88, 43, 38, 108, 27, 133, 48, 68, '2025-05-04 05:28:50'),
(25, '2023-03-05 10:00:00', 94, 114, '12', '3', 154, 74, 59, 54, 89, 44, 39, 109, 23, 134, 49, 69, '2025-05-04 05:28:50'),
(26, '2023-03-06 10:30:00', 95, 115, '14', '5', 155, 75, 60, 55, 90, 45, 40, 110, 28, 135, 50, 70, '2025-05-04 05:28:50'),
(27, '2023-03-07 11:00:00', 96, 116, '15', '6', 156, 76, 61, 56, 91, 46, 41, 111, 29, 136, 51, 71, '2025-05-04 05:28:50'),
(28, '2023-03-08 11:30:00', 97, 117, '13', '4', 157, 77, 62, 57, 92, 47, 42, 112, 25, 137, 52, 72, '2025-05-04 05:28:50'),
(29, '2023-03-09 12:00:00', 98, 118, '16', '7', 158, 78, 63, 58, 93, 48, 43, 113, 30, 138, 53, 73, '2025-05-04 05:28:50'),
(30, '2023-03-10 12:30:00', 99, 119, '12', '3', 159, 79, 64, 59, 94, 49, 44, 114, 24, 139, 54, 74, '2025-05-04 05:28:50'),
(31, '2023-04-01 08:00:00', 100, 120, '14', '5', 160, 80, 65, 60, 95, 50, 45, 115, 35, 140, 55, 75, '2025-05-04 05:28:50'),
(32, '2023-04-02 08:30:00', 101, 121, '15', '6', 161, 81, 66, 61, 96, 51, 46, 116, 36, 141, 56, 76, '2025-05-04 05:28:50'),
(33, '2023-04-03 09:00:00', 102, 122, '13', '4', 162, 82, 67, 62, 97, 52, 47, 117, 34, 142, 57, 77, '2025-05-04 05:28:50'),
(34, '2023-04-04 09:30:00', 103, 123, '16', '7', 163, 83, 68, 63, 98, 53, 48, 118, 37, 143, 58, 78, '2025-05-04 05:28:50'),
(35, '2023-04-05 10:00:00', 104, 124, '12', '3', 164, 84, 69, 64, 99, 54, 49, 119, 33, 144, 59, 79, '2025-05-04 05:28:50'),
(36, '2023-04-06 10:30:00', 105, 125, '14', '5', 165, 85, 70, 65, 100, 55, 50, 120, 38, 145, 60, 80, '2025-05-04 05:28:50'),
(37, '2023-04-07 11:00:00', 106, 126, '15', '6', 166, 86, 71, 66, 101, 56, 51, 121, 39, 146, 61, 81, '2025-05-04 05:28:50'),
(38, '2023-04-08 11:30:00', 107, 127, '13', '4', 167, 87, 72, 67, 102, 57, 52, 122, 35, 147, 62, 82, '2025-05-04 05:28:50'),
(39, '2023-04-09 12:00:00', 108, 128, '16', '7', 168, 88, 73, 68, 103, 58, 53, 123, 40, 148, 63, 83, '2025-05-04 05:28:50'),
(40, '2023-04-10 12:30:00', 109, 129, '12', '3', 169, 89, 74, 69, 104, 59, 54, 124, 34, 149, 64, 84, '2025-05-04 05:28:50'),
(41, '2023-05-01 08:00:00', 110, 130, '14', '5', 170, 90, 75, 70, 105, 60, 55, 125, 45, 150, 65, 85, '2025-05-04 05:28:50'),
(42, '2023-05-02 08:30:00', 111, 131, '15', '6', 171, 91, 76, 71, 106, 61, 56, 126, 46, 151, 66, 86, '2025-05-04 05:28:50'),
(43, '2023-05-03 09:00:00', 112, 132, '13', '4', 172, 92, 77, 72, 107, 62, 57, 127, 44, 152, 67, 87, '2025-05-04 05:28:50'),
(44, '2023-05-04 09:30:00', 113, 133, '16', '7', 173, 93, 78, 73, 108, 63, 58, 128, 47, 153, 68, 88, '2025-05-04 05:28:50'),
(45, '2023-05-05 10:00:00', 114, 134, '12', '3', 174, 94, 79, 74, 109, 64, 59, 129, 43, 154, 69, 89, '2025-05-04 05:28:50'),
(46, '2023-05-06 10:30:00', 115, 135, '14', '5', 175, 95, 80, 75, 110, 65, 60, 130, 48, 155, 70, 90, '2025-05-04 05:28:50'),
(47, '2023-05-07 11:00:00', 116, 136, '15', '6', 176, 96, 81, 76, 111, 66, 61, 131, 49, 156, 71, 91, '2025-05-04 05:28:50'),
(48, '2023-05-08 11:30:00', 117, 137, '13', '4', 177, 97, 82, 77, 112, 67, 62, 132, 45, 157, 72, 92, '2025-05-04 05:28:50'),
(49, '2023-05-09 12:00:00', 118, 138, '16', '7', 178, 98, 83, 78, 113, 68, 63, 133, 50, 158, 73, 93, '2025-05-04 05:28:50'),
(50, '2023-05-10 12:30:00', 119, 139, '12', '3', 179, 99, 84, 79, 114, 69, 64, 134, 44, 159, 74, 94, '2025-05-04 05:28:50'),
(51, '2023-06-01 08:00:00', 120, 140, '14', '5', 180, 100, 85, 80, 115, 70, 65, 135, 55, 160, 75, 95, '2025-05-04 05:28:50'),
(52, '2023-06-02 08:30:00', 121, 141, '15', '6', 181, 101, 86, 81, 116, 71, 66, 136, 56, 161, 76, 96, '2025-05-04 05:28:50'),
(53, '2023-06-03 09:00:00', 122, 142, '13', '4', 182, 102, 87, 82, 117, 72, 67, 137, 54, 162, 77, 97, '2025-05-04 05:28:50'),
(54, '2023-06-04 09:30:00', 123, 143, '16', '7', 183, 103, 88, 83, 118, 73, 68, 138, 57, 163, 78, 98, '2025-05-04 05:28:50'),
(55, '2023-06-05 10:00:00', 124, 144, '12', '3', 184, 104, 89, 84, 119, 74, 69, 139, 53, 164, 79, 99, '2025-05-04 05:28:50'),
(56, '2023-06-06 10:30:00', 125, 145, '14', '5', 185, 105, 90, 85, 120, 75, 70, 140, 58, 165, 80, 100, '2025-05-04 05:28:50'),
(57, '2023-06-07 11:00:00', 126, 146, '15', '6', 186, 106, 91, 86, 121, 76, 71, 141, 59, 166, 81, 101, '2025-05-04 05:28:50'),
(58, '2023-06-08 11:30:00', 127, 147, '13', '4', 187, 107, 92, 87, 122, 77, 72, 142, 55, 167, 82, 102, '2025-05-04 05:28:50'),
(59, '2023-06-09 12:00:00', 128, 148, '16', '7', 188, 108, 93, 88, 123, 78, 73, 143, 60, 168, 83, 103, '2025-05-04 05:28:50'),
(60, '2023-06-10 12:30:00', 129, 149, '12', '3', 189, 109, 94, 89, 124, 79, 74, 144, 54, 169, 84, 104, '2025-05-04 05:28:50'),
(61, '2023-07-01 08:00:00', 130, 150, '14', '5', 190, 110, 95, 90, 125, 80, 75, 145, 65, 170, 85, 105, '2025-05-04 05:28:50'),
(62, '2023-07-02 08:30:00', 131, 151, '15', '6', 191, 111, 96, 91, 126, 81, 76, 146, 66, 171, 86, 106, '2025-05-04 05:28:50'),
(63, '2023-07-03 09:00:00', 132, 152, '13', '4', 192, 112, 97, 92, 127, 82, 77, 147, 64, 172, 87, 107, '2025-05-04 05:28:50'),
(64, '2023-07-04 09:30:00', 133, 153, '16', '7', 193, 113, 98, 93, 128, 83, 78, 148, 67, 173, 88, 108, '2025-05-04 05:28:50'),
(65, '2023-07-05 10:00:00', 134, 154, '12', '3', 194, 114, 99, 94, 129, 84, 79, 149, 63, 174, 89, 109, '2025-05-04 05:28:50'),
(66, '2023-07-06 10:30:00', 135, 155, '14', '5', 195, 115, 100, 95, 130, 85, 80, 150, 68, 175, 90, 110, '2025-05-04 05:28:50'),
(67, '2023-07-07 11:00:00', 136, 156, '15', '6', 196, 116, 101, 96, 131, 86, 81, 151, 69, 176, 91, 111, '2025-05-04 05:28:50'),
(68, '2023-07-08 11:30:00', 137, 157, '13', '4', 197, 117, 102, 97, 132, 87, 82, 152, 65, 177, 92, 112, '2025-05-04 05:28:50'),
(69, '2023-07-09 12:00:00', 138, 158, '16', '7', 198, 118, 103, 98, 133, 88, 83, 153, 70, 178, 93, 113, '2025-05-04 05:28:50'),
(70, '2023-07-10 12:30:00', 139, 159, '12', '3', 199, 119, 104, 99, 134, 89, 84, 154, 64, 179, 94, 114, '2025-05-04 05:28:50'),
(71, '2023-07-11 08:00:00', 140, 160, '14', '5', 200, 120, 105, 100, 135, 90, 85, 155, 75, 180, 95, 115, '2025-05-04 05:28:50'),
(72, '2023-07-12 08:30:00', 141, 161, '15', '6', 201, 121, 106, 101, 136, 91, 86, 156, 76, 181, 96, 116, '2025-05-04 05:28:50'),
(73, '2023-07-13 09:00:00', 142, 162, '13', '4', 202, 122, 107, 102, 137, 92, 87, 157, 74, 182, 97, 117, '2025-05-04 05:28:50'),
(74, '2023-07-14 09:30:00', 143, 163, '16', '7', 203, 123, 108, 103, 138, 93, 88, 158, 77, 183, 98, 118, '2025-05-04 05:28:50'),
(75, '2023-07-15 10:00:00', 144, 164, '12', '3', 204, 124, 109, 104, 139, 94, 89, 159, 73, 184, 99, 119, '2025-05-04 05:28:50'),
(76, '2019-03-15 00:00:00', 125, 85, '95', '65', 180, 150, 12, 45, 110, 25, 18, 160, 32, 140, 40, 30, '2025-05-04 05:28:50'),
(77, '2019-05-22 00:00:00', 140, 95, '98', '68', 195, 170, 15, 50, 120, 30, 20, 175, 35, 155, 45, 35, '2025-05-04 05:28:50'),
(78, '2019-07-10 00:00:00', 110, 75, '92', '62', 160, 135, 10, 40, 100, 20, 15, 145, 28, 125, 35, 25, '2025-05-04 05:28:50'),
(79, '2019-09-28 00:00:00', 130, 90, '96', '70', 185, 160, 14, 48, 115, 28, 19, 170, 33, 150, 42, 32, '2025-05-04 05:28:50'),
(80, '2019-11-05 00:00:00', 95, 65, '89', '60', 140, 120, 8, 35, 90, 15, 12, 130, 25, 110, 30, 20, '2025-05-04 05:28:50'),
(81, '2020-01-18 00:00:00', 150, 105, '97', '72', 210, 180, 18, 55, 130, 35, 22, 190, 38, 170, 50, 40, '2025-05-04 05:28:50'),
(82, '2020-02-29 00:00:00', 105, 70, '91', '63', 150, 130, 9, 38, 95, 18, 14, 140, 27, 120, 32, 22, '2025-05-04 05:28:50'),
(83, '2020-04-12 00:00:00', 115, 80, '93', '67', 165, 140, 11, 42, 105, 22, 16, 150, 30, 135, 38, 27, '2025-05-04 05:28:50'),
(84, '2020-06-25 00:00:00', 135, 92, '94', '69', 190, 165, 16, 52, 125, 32, 21, 180, 36, 160, 48, 38, '2025-05-04 05:28:50'),
(85, '2020-08-07 00:00:00', 88, 62, '88', '58', 130, 115, 7, 32, 85, 14, 10, 120, 23, 105, 28, 18, '2025-05-04 05:28:50'),
(86, '2020-10-19 00:00:00', 142, 98, '96', '71', 200, 175, 17, 53, 135, 33, 23, 185, 37, 165, 52, 42, '2025-05-04 05:28:50'),
(87, '2020-12-01 00:00:00', 120, 82, '92', '66', 170, 150, 13, 47, 112, 26, 19, 160, 31, 145, 42, 32, '2025-05-04 05:28:50'),
(88, '2021-01-14 00:00:00', 155, 110, '98', '73', 220, 190, 20, 58, 140, 38, 25, 200, 40, 180, 55, 45, '2025-05-04 05:28:50'),
(89, '2021-03-27 00:00:00', 100, 68, '90', '61', 145, 125, 9, 36, 92, 17, 13, 135, 26, 115, 33, 23, '2025-05-04 05:28:50'),
(90, '2021-05-09 00:00:00', 128, 88, '95', '70', 182, 158, 15, 49, 118, 29, 20, 168, 34, 152, 46, 36, '2025-05-04 05:28:50'),
(91, '2021-07-21 00:00:00', 92, 64, '89', '59', 135, 118, 8, 33, 88, 16, 11, 125, 24, 108, 31, 21, '2025-05-04 05:28:50'),
(92, '2021-09-03 00:00:00', 138, 94, '97', '72', 195, 170, 16, 51, 128, 31, 22, 178, 35, 162, 50, 40, '2025-05-04 05:28:50'),
(93, '2021-11-15 00:00:00', 112, 78, '93', '67', 162, 142, 12, 44, 108, 24, 17, 152, 29, 138, 40, 30, '2025-05-04 05:28:50'),
(94, '2022-01-28 00:00:00', 148, 102, '99', '74', 210, 185, 19, 56, 138, 36, 24, 195, 39, 175, 53, 43, '2025-05-04 05:28:50'),
(95, '2022-04-11 00:00:00', 85, 60, '87', '57', 125, 110, 6, 30, 82, 13, 9, 115, 22, 100, 27, 17, '2025-05-04 05:28:50'),
(96, '2022-06-24 00:00:00', 132, 90, '96', '71', 188, 165, 15, 50, 125, 30, 21, 175, 34, 160, 48, 38, '2025-05-04 05:28:50'),
(97, '2022-09-06 00:00:00', 118, 80, '94', '69', 170, 150, 14, 46, 115, 27, 19, 160, 31, 145, 42, 32, '2025-05-04 05:28:50'),
(98, '2022-11-19 00:00:00', 95, 65, '89', '60', 140, 120, 8, 35, 90, 15, 12, 130, 25, 110, 30, 20, '2025-05-04 05:28:50'),
(99, '2023-01-31 00:00:00', 160, 115, '99', '75', 225, 195, 21, 60, 145, 40, 26, 205, 41, 185, 58, 48, '2025-05-04 05:28:50'),
(100, '2023-04-15 00:00:00', 108, 72, '91', '64', 155, 135, 10, 39, 98, 19, 14, 145, 28, 125, 36, 26, '2025-05-04 05:28:50'),
(101, '2023-06-28 00:00:00', 122, 84, '95', '70', 175, 155, 14, 48, 118, 28, 20, 165, 33, 150, 45, 35, '2025-05-04 05:28:50'),
(102, '2023-09-10 00:00:00', 135, 92, '97', '72', 190, 165, 16, 52, 125, 32, 21, 180, 36, 160, 48, 38, '2025-05-04 05:28:50'),
(103, '2023-11-23 00:00:00', 102, 70, '90', '62', 148, 130, 11, 41, 102, 21, 15, 140, 27, 125, 37, 27, '2025-05-04 05:28:50'),
(104, '2024-02-05 00:00:00', 145, 100, '98', '73', 205, 180, 18, 55, 135, 35, 23, 190, 38, 175, 52, 42, '2025-05-04 05:28:50'),
(105, '2024-04-19 00:00:00', 115, 80, '93', '67', 165, 145, 13, 45, 110, 25, 18, 155, 30, 140, 40, 30, '2025-05-04 05:28:50'),
(106, '2024-07-02 00:00:00', 128, 88, '96', '71', 185, 160, 15, 50, 120, 30, 20, 175, 35, 160, 48, 38, '2025-05-04 05:28:50'),
(107, '2024-09-14 00:00:00', 110, 75, '92', '65', 160, 140, 12, 43, 105, 23, 17, 150, 29, 135, 39, 29, '2025-05-04 05:28:50'),
(108, '2024-11-27 00:00:00', 152, 105, '99', '74', 215, 190, 20, 58, 142, 38, 25, 200, 40, 185, 55, 45, '2025-05-04 05:28:50'),
(109, '2019-02-08 00:00:00', 118, 80, '94', '69', 170, 150, 14, 46, 115, 27, 19, 160, 31, 145, 42, 32, '2025-05-04 05:28:50'),
(110, '2019-04-21 00:00:00', 105, 70, '91', '63', 150, 130, 9, 38, 95, 18, 14, 140, 27, 120, 32, 22, '2025-05-04 05:28:50'),
(111, '2019-06-04 00:00:00', 130, 90, '96', '70', 185, 160, 14, 48, 115, 28, 19, 170, 33, 150, 42, 32, '2025-05-04 05:28:50'),
(112, '2019-08-17 00:00:00', 88, 62, '88', '58', 130, 115, 7, 32, 85, 14, 10, 120, 23, 105, 28, 18, '2025-05-04 05:28:50'),
(113, '2019-10-30 00:00:00', 142, 98, '96', '71', 200, 175, 17, 53, 135, 33, 23, 185, 37, 165, 52, 42, '2025-05-04 05:28:50'),
(114, '2020-01-12 00:00:00', 120, 82, '92', '66', 170, 150, 13, 47, 112, 26, 19, 160, 31, 145, 42, 32, '2025-05-04 05:28:50'),
(115, '2020-03-25 00:00:00', 155, 110, '98', '73', 220, 190, 20, 58, 140, 38, 25, 200, 40, 180, 55, 45, '2025-05-04 05:28:50'),
(116, '2020-06-07 00:00:00', 100, 68, '90', '61', 145, 125, 9, 36, 92, 17, 13, 135, 26, 115, 33, 23, '2025-05-04 05:28:50'),
(117, '2020-08-20 00:00:00', 128, 88, '95', '70', 182, 158, 15, 49, 118, 29, 20, 168, 34, 152, 46, 36, '2025-05-04 05:28:50'),
(118, '2020-11-02 00:00:00', 92, 64, '89', '59', 135, 118, 8, 33, 88, 16, 11, 125, 24, 108, 31, 21, '2025-05-04 05:28:50'),
(119, '2021-01-15 00:00:00', 138, 94, '97', '72', 195, 170, 16, 51, 128, 31, 22, 178, 35, 162, 50, 40, '2025-05-04 05:28:50'),
(120, '2021-03-30 00:00:00', 112, 78, '93', '67', 162, 142, 12, 44, 108, 24, 17, 152, 29, 138, 40, 30, '2025-05-04 05:28:50'),
(121, '2021-06-12 00:00:00', 148, 102, '99', '74', 210, 185, 19, 56, 138, 36, 24, 195, 39, 175, 53, 43, '2025-05-04 05:28:50'),
(122, '2021-08-25 00:00:00', 85, 60, '87', '57', 125, 110, 6, 30, 82, 13, 9, 115, 22, 100, 27, 17, '2025-05-04 05:28:50'),
(123, '2021-11-07 00:00:00', 132, 90, '96', '71', 188, 165, 15, 50, 125, 30, 21, 175, 34, 160, 48, 38, '2025-05-04 05:28:50'),
(124, '2022-01-20 00:00:00', 118, 80, '94', '69', 170, 150, 14, 46, 115, 27, 19, 160, 31, 145, 42, 32, '2025-05-04 05:28:50'),
(125, '2022-04-04 00:00:00', 95, 65, '89', '60', 140, 120, 8, 35, 90, 15, 12, 130, 25, 110, 30, 20, '2025-05-04 05:28:50'),
(126, '2022-06-17 00:00:00', 160, 115, '99', '75', 225, 195, 21, 60, 145, 40, 26, 205, 41, 185, 58, 48, '2025-05-04 05:28:50'),
(127, '2022-08-30 00:00:00', 108, 72, '91', '64', 155, 135, 10, 39, 98, 19, 14, 145, 28, 125, 36, 26, '2025-05-04 05:28:50'),
(128, '2022-11-12 00:00:00', 122, 84, '95', '70', 175, 155, 14, 48, 118, 28, 20, 165, 33, 150, 45, 35, '2025-05-04 05:28:50'),
(129, '2023-01-25 00:00:00', 135, 92, '97', '72', 190, 165, 16, 52, 125, 32, 21, 180, 36, 160, 48, 38, '2025-05-04 05:28:50'),
(130, '2023-04-09 00:00:00', 102, 70, '90', '62', 148, 130, 11, 41, 102, 21, 15, 140, 27, 125, 37, 27, '2025-05-04 05:28:50'),
(131, '2023-06-22 00:00:00', 145, 100, '98', '73', 205, 180, 18, 55, 135, 35, 23, 190, 38, 175, 52, 42, '2025-05-04 05:28:50'),
(132, '2023-09-04 00:00:00', 115, 80, '93', '67', 165, 145, 13, 45, 110, 25, 18, 155, 30, 140, 40, 30, '2025-05-04 05:28:50'),
(133, '2023-11-17 00:00:00', 128, 88, '96', '71', 185, 160, 15, 50, 120, 30, 20, 175, 35, 160, 48, 38, '2025-05-04 05:28:50'),
(134, '2024-01-30 00:00:00', 110, 75, '92', '65', 160, 140, 12, 43, 105, 23, 17, 150, 29, 135, 39, 29, '2025-05-04 05:28:50'),
(135, '2024-04-13 00:00:00', 152, 105, '99', '74', 215, 190, 20, 58, 142, 38, 25, 200, 40, 185, 55, 45, '2025-05-04 05:28:50'),
(136, '2024-07-26 00:00:00', 118, 80, '94', '69', 170, 150, 14, 46, 115, 27, 19, 160, 31, 145, 42, 32, '2025-05-04 05:28:50'),
(137, '2024-10-08 00:00:00', 105, 70, '91', '63', 150, 130, 9, 38, 95, 18, 14, 140, 27, 120, 32, 22, '2025-05-04 05:28:50'),
(138, '2019-01-03 00:00:00', 130, 90, '96', '70', 185, 160, 14, 48, 115, 28, 19, 170, 33, 150, 42, 32, '2025-05-04 05:28:50'),
(139, '2019-03-16 00:00:00', 88, 62, '88', '58', 130, 115, 7, 32, 85, 14, 10, 120, 23, 105, 28, 18, '2025-05-04 05:28:50'),
(140, '2019-05-29 00:00:00', 142, 98, '96', '71', 200, 175, 17, 53, 135, 33, 23, 185, 37, 165, 52, 42, '2025-05-04 05:28:50'),
(141, '2019-08-11 00:00:00', 120, 82, '92', '66', 170, 150, 13, 47, 112, 26, 19, 160, 31, 145, 42, 32, '2025-05-04 05:28:50'),
(142, '2019-10-24 00:00:00', 155, 110, '98', '73', 220, 190, 20, 58, 140, 38, 25, 200, 40, 180, 55, 45, '2025-05-04 05:28:50'),
(143, '2020-01-06 00:00:00', 100, 68, '90', '61', 145, 125, 9, 36, 92, 17, 13, 135, 26, 115, 33, 23, '2025-05-04 05:28:50'),
(144, '2020-03-19 00:00:00', 128, 88, '95', '70', 182, 158, 15, 49, 118, 29, 20, 168, 34, 152, 46, 36, '2025-05-04 05:28:50'),
(145, '2020-06-01 00:00:00', 92, 64, '89', '59', 135, 118, 8, 33, 88, 16, 11, 125, 24, 108, 31, 21, '2025-05-04 05:28:50'),
(146, '2020-08-14 00:00:00', 138, 94, '97', '72', 195, 170, 16, 51, 128, 31, 22, 178, 35, 162, 50, 40, '2025-05-04 05:28:50'),
(147, '2020-10-27 00:00:00', 112, 78, '93', '67', 162, 142, 12, 44, 108, 24, 17, 152, 29, 138, 40, 30, '2025-05-04 05:28:50'),
(148, '2021-01-09 00:00:00', 148, 102, '99', '74', 210, 185, 19, 56, 138, 36, 24, 195, 39, 175, 53, 43, '2025-05-04 05:28:50'),
(149, '2021-03-24 00:00:00', 85, 60, '87', '57', 125, 110, 6, 30, 82, 13, 9, 115, 22, 100, 27, 17, '2025-05-04 05:28:50'),
(150, '2021-06-06 00:00:00', 132, 90, '96', '71', 188, 165, 15, 50, 125, 30, 21, 175, 34, 160, 48, 38, '2025-05-04 05:28:50'),
(151, '2021-08-19 00:00:00', 118, 80, '94', '69', 170, 150, 14, 46, 115, 27, 19, 160, 31, 145, 42, 32, '2025-05-04 05:28:50'),
(152, '2021-11-01 00:00:00', 95, 65, '89', '60', 140, 120, 8, 35, 90, 15, 12, 130, 25, 110, 30, 20, '2025-05-04 05:28:50'),
(153, '2022-01-14 00:00:00', 160, 115, '99', '75', 225, 195, 21, 60, 145, 40, 26, 205, 41, 185, 58, 48, '2025-05-04 05:28:50'),
(154, '2022-03-29 00:00:00', 108, 72, '91', '64', 155, 135, 10, 39, 98, 19, 14, 145, 28, 125, 36, 26, '2025-05-04 05:28:50'),
(155, '2022-06-11 00:00:00', 122, 84, '95', '70', 175, 155, 14, 48, 118, 28, 20, 165, 33, 150, 45, 35, '2025-05-04 05:28:50'),
(156, '2022-08-24 00:00:00', 135, 92, '97', '72', 190, 165, 16, 52, 125, 32, 21, 180, 36, 160, 48, 38, '2025-05-04 05:28:50'),
(157, '2022-11-06 00:00:00', 102, 70, '90', '62', 148, 130, 11, 41, 102, 21, 15, 140, 27, 125, 37, 27, '2025-05-04 05:28:50'),
(158, '2023-01-19 00:00:00', 145, 100, '98', '73', 205, 180, 18, 55, 135, 35, 23, 190, 38, 175, 52, 42, '2025-05-04 05:28:50'),
(159, '2023-04-03 00:00:00', 115, 80, '93', '67', 165, 145, 13, 45, 110, 25, 18, 155, 30, 140, 40, 30, '2025-05-04 05:28:50'),
(160, '2023-06-16 00:00:00', 128, 88, '96', '71', 185, 160, 15, 50, 120, 30, 20, 175, 35, 160, 48, 38, '2025-05-04 05:28:50'),
(161, '2023-08-29 00:00:00', 110, 75, '92', '65', 160, 140, 12, 43, 105, 23, 17, 150, 29, 135, 39, 29, '2025-05-04 05:28:50'),
(162, '2023-11-11 00:00:00', 152, 105, '99', '74', 215, 190, 20, 58, 142, 38, 25, 200, 40, 185, 55, 45, '2025-05-04 05:28:50'),
(163, '2024-01-24 00:00:00', 118, 80, '94', '69', 170, 150, 14, 46, 115, 27, 19, 160, 31, 145, 42, 32, '2025-05-04 05:28:50'),
(164, '2024-04-07 00:00:00', 105, 70, '91', '63', 150, 130, 9, 38, 95, 18, 14, 140, 27, 120, 32, 22, '2025-05-04 05:28:50'),
(165, '2024-07-20 00:00:00', 130, 90, '96', '70', 185, 160, 14, 48, 115, 28, 19, 170, 33, 150, 42, 32, '2025-05-04 05:28:50'),
(166, '2024-10-02 00:00:00', 88, 62, '88', '58', 130, 115, 7, 32, 85, 14, 10, 120, 23, 105, 28, 18, '2025-05-04 05:28:50'),
(167, '2024-12-15 00:00:00', 142, 98, '96', '71', 200, 175, 17, 53, 135, 33, 23, 185, 37, 165, 52, 42, '2025-05-04 05:28:50'),
(169, '2025-05-07 00:00:00', 232, 23, '323', '545', 34, 564, 56, 66, 5, 34, 4234, 643, 634, 63, 346, 34, '2025-05-05 07:17:34'),
(170, '2018-01-05 00:00:00', 232, 232, '33', '3', 3, 33, 33, 33, 333, 33, 33, 33, 33, 33, 33, 3, '2025-05-05 07:52:36'),
(171, '1970-01-01 00:00:00', 323, 23, '33', '33', 33, 33, 33, 33, 33, 33, 333, 33, 33, 33, 33, 33, '2025-05-08 23:35:57'),
(172, '1970-01-01 00:00:00', 323, 32, '232', '3121', 312, 232, 323, 23, 232, 21, 21312, 23, 23, 232, 232, 23, '2025-05-09 02:26:01');

-- --------------------------------------------------------

--
-- Table structure for table `job_fairs`
--

DROP TABLE IF EXISTS `job_fairs`;
CREATE TABLE IF NOT EXISTS `job_fairs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `venue` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pra_id` int DEFAULT NULL,
  `peso_id` int DEFAULT NULL,
  `custom_persons` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `custom_contacts` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `male_applicants` int NOT NULL,
  `female_applicants` int NOT NULL,
  `invited_agencies` int NOT NULL,
  `agencies_with_jfa` int NOT NULL,
  `dmw_staff` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_fairs`
--

INSERT INTO `job_fairs` (`id`, `date`, `venue`, `pra_id`, `peso_id`, `custom_persons`, `custom_contacts`, `male_applicants`, `female_applicants`, `invited_agencies`, `agencies_with_jfa`, `dmw_staff`) VALUES
(1, '2024-01-10 00:00:00', 'HK Convention and Exhibition Centre, Hong Kong', 11, 2, NULL, NULL, 62, 54, 15, 12, 'Ana Santos'),
(2, '2024-01-15 00:00:00', 'Dubai World Trade Centre, UAE', 6, 4, NULL, NULL, 45, 60, 10, 9, 'Marco Reyes'),
(3, '2024-01-20 00:00:00', 'Taipei Nangang Exhibition Center, Taiwan', 2, 45, NULL, NULL, 70, 80, 20, 17, 'Joanna Cruz'),
(4, '2024-01-25 00:00:00', 'Tokyo Big Sight, Japan', 8, 17, NULL, NULL, 50, 45, 12, 10, 'Carlos Dela Cruz'),
(5, '2024-02-01 00:00:00', 'Singapore Expo', 7, 36, NULL, NULL, 65, 72, 18, 16, 'Jessica Ramos'),
(6, '2024-02-07 00:00:00', 'Doha Exhibition Center, Qatar', 10, 27, NULL, NULL, 80, 75, 22, 19, 'Luis Gomez'),
(7, '2024-02-14 00:00:00', 'Kuala Lumpur Convention Centre, Malaysia', 1, 23, NULL, NULL, 55, 68, 14, 13, 'Marianne Tuazon'),
(8, '2024-02-21 00:00:00', 'Jeddah International Exhibition & Convention Center, KSA', 3, 46, NULL, NULL, 73, 69, 21, 18, 'Enrico Navarro'),
(9, '2024-02-28 00:00:00', 'Vancouver Convention Centre, Canada', 4, 34, NULL, NULL, 67, 71, 19, 17, 'Paula Mendoza'),
(10, '2024-03-05 00:00:00', 'Los Angeles Convention Center, USA', 3, 20, NULL, NULL, 52, 60, 11, 9, 'Isabel Garcia'),
(11, '2024-03-12 00:00:00', 'Melbourne Convention Centre, Australia', 2, 16, NULL, NULL, 60, 58, 13, 12, 'Dino Agustin'),
(12, '2024-03-18 00:00:00', 'ExCeL London, United Kingdom', 5, 38, NULL, NULL, 44, 49, 8, 7, 'Celeste Fernando'),
(13, '2024-03-25 00:00:00', 'Frankfurt Messe, Germany', 5, 49, NULL, NULL, 55, 66, 14, 11, 'Miguel Fernandez'),
(14, '2024-04-01 00:00:00', 'Paris Expo Porte de Versailles, France', 11, 40, NULL, NULL, 75, 70, 20, 18, 'Bea Salazar'),
(15, '2024-04-08 00:00:00', 'Toronto Congress Centre, Canada', 7, 39, '', '', 66, 64, 16, 15, 'Jonas Rivera'),
(16, '1970-01-01 00:00:00', 'adada', 13, 44, '', '', 0, 0, 0, 0, ''),
(17, '1970-01-01 00:00:00', 'manila', 6, 4, '', '', 0, 0, 0, 0, ''),
(18, '2026-01-02 00:00:00', 'manila', 7, 2, '', '', 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `account_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `edit_profile` smallint NOT NULL DEFAULT '0',
  `manage_staff` smallint NOT NULL DEFAULT '0',
  `approve_accounts` smallint NOT NULL DEFAULT '0',
  `disapproved` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`account_type`, `edit_profile`, `manage_staff`, `approve_accounts`, `disapproved`, `created_at`) VALUES
('Division', 1, 1, 0, 0, '2025-05-04 05:23:46'),
('Regional', 1, 0, 1, 0, '2025-05-04 05:23:46'),
('Staff', 0, 0, 0, 0, '2025-05-04 05:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `peso_contacts`
--

DROP TABLE IF EXISTS `peso_contacts`;
CREATE TABLE IF NOT EXISTS `peso_contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `province` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact_number` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `office_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peso_contacts`
--

INSERT INTO `peso_contacts` (`id`, `province`, `contact_number`, `office_address`, `email_address`) VALUES
(1, 'Cavite', '046-123-4567', 'Provincial Capitol Compound, Trece Martires City', 'cavite_peso@cavite.gov.ph'),
(2, 'Cavite', '046-234-5678', '2nd Floor, SM City Bacoor, Bacoor City', 'peso_bacoor@cavite.gov.ph'),
(3, 'Cavite', '046-345-6789', 'Imus City Hall, Imus City', 'peso_imus@cavite.gov.ph'),
(4, 'Cavite', '046-456-7890', 'Dasmarinas City Government Center', 'peso_dasma@cavite.gov.ph'),
(5, 'Cavite', '046-567-8901', 'General Trias Municipal Hall', 'peso_gentri@cavite.gov.ph'),
(6, 'Cavite', '046-678-9012', 'Tanza Municipal Building', 'peso_tanza@cavite.gov.ph'),
(7, 'Cavite', '046-789-0123', 'Naic Municipal Hall', 'peso_naic@cavite.gov.ph'),
(8, 'Cavite', '046-890-1234', 'Kawit Municipal Hall', 'peso_kawit@cavite.gov.ph'),
(9, 'Cavite', '046-901-2345', 'Rosario Municipal Hall', 'peso_rosario@cavite.gov.ph'),
(10, 'Cavite', '046-012-3456', 'Silang Municipal Hall', 'peso_silang@cavite.gov.ph'),
(11, 'Laguna', '049-123-4567', 'Laguna Provincial Capitol, Santa Cruz', 'laguna_peso@laguna.gov.ph'),
(12, 'Laguna', '049-234-5678', 'Calamba City Hall, Calamba City', 'peso_calamba@laguna.gov.ph'),
(13, 'Laguna', '049-345-6789', 'San Pablo City Hall, San Pablo City', 'peso_sanpablo@laguna.gov.ph'),
(14, 'Laguna', '049-456-7890', 'Biñan City Government Center', 'peso_binan@laguna.gov.ph'),
(15, 'Laguna', '049-567-8901', 'Santa Rosa City Hall', 'peso_santarosa@laguna.gov.ph'),
(16, 'Laguna', '049-678-9012', 'Cabuyao City Hall', 'peso_cabuyao@laguna.gov.ph'),
(17, 'Laguna', '049-789-0123', 'Los Baños Municipal Hall', 'peso_losbanos@laguna.gov.ph'),
(18, 'Laguna', '049-890-1234', 'San Pedro Municipal Hall', 'peso_sanpedro@laguna.gov.ph'),
(19, 'Laguna', '049-901-2345', 'Nagcarlan Municipal Hall', 'peso_nagcarlan@laguna.gov.ph'),
(20, 'Laguna', '049-012-3456', 'Liliw Municipal Hall', 'peso_liliw@laguna.gov.ph'),
(21, 'Batangas', '043-123-4567', 'Batangas Provincial Capitol, Batangas City', 'batangas_peso@batangas.gov.ph'),
(22, 'Batangas', '043-234-5678', 'Lipa City Hall, Lipa City', 'peso_lipa@batangas.gov.ph'),
(23, 'Batangas', '043-345-6789', 'Tanauan City Hall, Tanauan City', 'peso_tanauan@batangas.gov.ph'),
(24, 'Batangas', '043-456-7890', 'Bauan Municipal Hall', 'peso_bauan@batangas.gov.ph'),
(25, 'Batangas', '043-567-8901', 'San Juan Municipal Hall', 'peso_sanjuan@batangas.gov.ph'),
(26, 'Batangas', '043-678-9012', 'Nasugbu Municipal Hall', 'peso_nasugbu@batangas.gov.ph'),
(27, 'Batangas', '043-789-0123', 'Calaca Municipal Hall', 'peso_calaca@batangas.gov.ph'),
(28, 'Batangas', '043-890-1234', 'Balayan Municipal Hall', 'peso_balayan@batangas.gov.ph'),
(29, 'Batangas', '043-901-2345', 'Sto. Tomas Municipal Hall', 'peso_stotomas@batangas.gov.ph'),
(30, 'Batangas', '043-012-3456', 'Malvar Municipal Hall', 'peso_malvar@batangas.gov.ph'),
(31, 'Rizal', '02-123-4567', 'Rizal Provincial Capitol, Antipolo City', 'rizal_peso@rizal.gov.ph'),
(32, 'Rizal', '02-234-5678', 'Antipolo City Hall, Antipolo City', 'peso_antipolo@rizal.gov.ph'),
(33, 'Rizal', '02-345-6789', 'Taytay Municipal Hall', 'peso_taytay@rizal.gov.ph'),
(34, 'Rizal', '02-456-7890', 'Cainta Municipal Hall', 'peso_cainta@rizal.gov.ph'),
(35, 'Rizal', '02-567-8901', 'Binangonan Municipal Hall', 'peso_binangonan@rizal.gov.ph'),
(36, 'Rizal', '02-678-9012', 'Angono Municipal Hall', 'peso_angono@rizal.gov.ph'),
(37, 'Rizal', '02-789-0123', 'Rodriguez Municipal Hall', 'peso_rodriguez@rizal.gov.ph'),
(38, 'Rizal', '02-890-1234', 'San Mateo Municipal Hall', 'peso_sanmateo@rizal.gov.ph'),
(39, 'Rizal', '02-901-2345', 'Cardona Municipal Hall', 'peso_cardona@rizal.gov.ph'),
(40, 'Rizal', '02-012-3456', 'Morong Municipal Hall', 'peso_morong@rizal.gov.ph'),
(41, 'Quezon', '042-123-4567', 'Quezon Provincial Capitol, Lucena City', 'quezon_peso@quezon.gov.ph'),
(42, 'Quezon', '042-234-5678', 'Lucena City Hall, Lucena City', 'peso_lucena@quezon.gov.ph'),
(43, 'Quezon', '042-345-6789', 'Tayabas City Hall, Tayabas City', 'peso_tayabas@quezon.gov.ph'),
(44, 'Quezon', '042-456-7890', 'Candelaria Municipal Hall', 'peso_candelaria@quezon.gov.ph'),
(45, 'Quezon', '042-567-8901', 'Sariaya Municipal Hall', 'peso_sariaya@quezon.gov.ph'),
(46, 'Quezon', '042-678-9012', 'Gumaca Municipal Hall', 'peso_gumaca@quezon.gov.ph'),
(47, 'Quezon', '042-789-0123', 'Lopez Municipal Hall', 'peso_lopez@quezon.gov.ph'),
(48, 'Quezon', '042-890-1234', 'Calauag Municipal Hall', 'peso_calauag@quezon.gov.ph'),
(49, 'Quezon', '042-901-2345', 'Atimonan Municipal Hall', 'peso_atimonan@quezon.gov.ph'),
(50, 'Quezon', '042-012-3456', 'peso_mauban@quezon.gov.ph', 'peso_mauban@quezon.gov.ph'),
(53, 'Laguna', '0912345677', 'bay laguna', 'test5@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pra_contacts`
--

DROP TABLE IF EXISTS `pra_contacts`;
CREATE TABLE IF NOT EXISTS `pra_contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact_persons` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact_numbers` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pra_contacts`
--

INSERT INTO `pra_contacts` (`id`, `name`, `contact_persons`, `email_address`, `contact_numbers`) VALUES
(1, 'ABC Construction', 'John Smith, Sarah Johnson', 'contact@abcconstruction.com', '555-0101, 555-0102'),
(2, 'XYZ Manufacturing', 'Michael Brown, Emily Davis', 'info@xyzmanufacturing.com', '555-0201, 555-0202'),
(3, 'Global Logistics Inc.', 'Robert Wilson, Jennifer Lee', 'support@globallogistics.com', '555-0301, 555-0302'),
(4, 'Tech Solutions Ltd.', 'David Martinez, Jessica Taylor', 'hello@techsolutions.com', '555-0401, 555-0402'),
(5, 'City Builders Co.', 'Daniel Anderson, Amanda Thomas', 'build@citybuilders.com', '555-0501, 555-0502'),
(6, 'Premium Services LLC', 'Christopher White, Matthew Clark', 'premium@premiumservices.com', '555-0601, 555-0602'),
(7, 'Elite Engineering', 'Elizabeth Rodriguez, Andrew Lewis', 'contact@eliteengineering.com', '555-0701, 555-0702'),
(8, 'First Quality Goods', 'Nicole Walker, Kevin Hall', 'sales@firstquality.com', '555-0801, 555-0802'),
(9, 'Metro Industrial', 'Samantha Young, Joshua Allen', 'metro@metroindustrial.com', '555-0901, 555-0902'),
(10, 'Pinnacle Technologies', 'Megan King, Ryan Scott', 'tech@pinnacle.com', '555-1001, 555-1002'),
(11, 'Summit Supplies', 'Lauren Green, Justin Adams', 'summit@summitsupplies.com', '555-1101, 555-1102'),
(13, 'kontak', 'jp', 'test@email.com', '09090990909'),
(14, 'ewewq', 'wewew', 'wewe', '090907563423');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `account_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `email_address`, `account_type`, `is_approved`, `created_at`) VALUES
(1, 'admin', 'Division Head', 'admin', 'admin@test.com', 'Division', 1, '2025-05-04 05:23:17'),
(2, 'demo_regional', 'Demo Regional', 'demo', 'demo_regional@mail.com', 'Regional', 1, '2025-05-04 23:53:07'),
(3, 'demo_staff', 'DMW Staff', 'demo123', 'demo_staff@mail.com', 'Staff', 1, '2025-05-04 23:53:44'),
(5, 'demo_regional1', 'demo regional1', 'demo', 'test@email.com', 'Regional', 1, '2025-05-09 03:55:20'),
(6, 'demo_staff1', 'demo staff1', 'demo', 'test2@gmail.com', 'Staff', 1, '2025-05-09 04:04:30'),
(7, 'staff1', 'JP', '123456', 'test3@gmail.com', 'Staff', 1, '2025-05-26 00:49:35'),
(8, 'test_regional2', 'JP', 'demo', 'test@email.com', 'Regional', 1, '2025-05-26 05:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `work_resumption`
--

DROP TABLE IF EXISTS `work_resumption`;
CREATE TABLE IF NOT EXISTS `work_resumption` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_no` int NOT NULL,
  `counter_no` int NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `middle_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sex` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `destination` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Time_In` datetime NOT NULL,
  `Time_out` datetime NOT NULL,
  `Total_pct` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_resumption`
--

INSERT INTO `work_resumption` (`id`, `order_no`, `counter_no`, `last_name`, `first_name`, `middle_name`, `sex`, `address`, `destination`, `Type`, `Time_In`, `Time_out`, `Total_pct`, `created_at`) VALUES
(26, 1026, 2, 'Lewis', 'Laura', 'Z', 'Female', '369 Fig St, Hamletburg', 'Las Vegas', 'Express', '2023-05-01 09:45:00', '2023-05-01 16:15:00', 88, '2025-05-04 05:22:31'),
(27, 1027, 3, 'Lee', 'Charles', 'AA', 'Male', '471 Guava Ave, Citytown', 'Portland', 'Regular', '2023-05-01 11:30:00', '2023-05-01 19:45:00', 76, '2025-05-04 05:22:31'),
(28, 1028, 4, 'Walker', 'Kimberly', 'AB', 'Female', '582 Papaya Blvd, Villageburg', 'Memphis', 'Express', '2023-05-01 08:30:00', '2023-05-01 15:45:00', 91, '2025-05-04 05:22:31'),
(29, 1029, 1, 'Hall', 'Mark', 'AC', 'Male', '693 Dragonfruit Dr, Townville', 'Louisville', 'Regular', '2023-05-01 10:00:00', '2023-05-01 18:15:00', 83, '2025-05-04 05:22:31'),
(30, 1030, 2, 'Allen', 'Christine', 'AD', 'Female', '714 Passionfruit Ln, Burgtown', 'Baltimore', 'Express', '2023-05-01 09:15:00', '2023-05-01 15:30:00', 95, '2025-05-04 05:22:31'),
(31, 1031, 3, 'Young', 'Donald', 'AE', 'Male', '825 Starfruit Rd, Cityberg', 'Milwaukee', 'Regular', '2023-05-01 11:45:00', '2023-05-01 20:00:00', 79, '2025-05-04 05:22:31'),
(32, 1032, 4, 'King', 'Susan', 'AF', 'Female', '936 Mangosteen Ct, Villageville', 'Albuquerque', 'Express', '2023-05-01 08:45:00', '2023-05-01 15:00:00', 89, '2025-05-04 05:22:31'),
(33, 1033, 1, 'Wright', 'Paul', 'AG', 'Male', '147 Rambutan Way, Township', 'Tucson', 'Regular', '2023-05-01 12:15:00', '2023-05-01 20:30:00', 77, '2025-05-04 05:22:31'),
(34, 1034, 2, 'Scott', 'Nancy', 'AH', 'Female', '258 Longan St, Hamletberg', 'Fresno', 'Express', '2023-05-01 09:30:00', '2023-05-01 16:45:00', 93, '2025-05-04 05:22:31'),
(35, 1035, 3, 'Green', 'Steven', 'AI', 'Male', '369 Lychee Ave, Burgville', 'Sacramento', 'Regular', '2023-05-01 10:15:00', '2023-05-01 18:30:00', 81, '2025-05-04 05:22:31'),
(36, 1036, 4, 'Baker', 'Donna', 'AJ', 'Female', '471 Durian Blvd, Citytown', 'Kansas City', 'Express', '2023-05-01 08:00:00', '2023-05-01 14:15:00', 87, '2025-05-04 05:22:31'),
(37, 1037, 1, 'Adams', 'Edward', 'AK', 'Male', '582 Jackfruit Dr, Villageburg', 'Mesa', 'Regular', '2023-05-01 11:30:00', '2023-05-01 19:45:00', 85, '2025-05-04 05:22:31'),
(38, 1038, 2, 'Nelson', 'Carol', 'AL', 'Female', '693 Soursop Ln, Townberg', 'Atlanta', 'Express', '2023-05-01 09:45:00', '2023-05-01 16:00:00', 90, '2025-05-04 05:22:31'),
(39, 1039, 3, 'Hill', 'Brian', 'AM', 'Male', '714 Breadfruit Rd, Burgtown', 'Omaha', 'Regular', '2023-05-01 10:30:00', '2023-05-01 18:45:00', 78, '2025-05-04 05:22:31'),
(40, 1040, 4, 'Ramirez', 'Margaret', 'AN', 'Female', '825 Ackee Ct, Cityville', 'Colorado Springs', 'Express', '2023-05-01 08:15:00', '2023-05-01 14:30:00', 94, '2025-05-04 05:22:31'),
(41, 1041, 1, 'Campbell', 'Ronald', 'AO', 'Male', '936 Canistel Way, Villageberg', 'Raleigh', 'Regular', '2023-05-01 12:45:00', '2023-05-01 21:00:00', 82, '2025-05-04 05:22:31'),
(42, 1042, 2, 'Mitchell', 'Dorothy', 'AP', 'Female', '147 Cherimoya St, Townshipville', 'Miami', 'Express', '2023-05-01 09:00:00', '2023-05-01 15:15:00', 88, '2025-05-04 05:22:31'),
(43, 1043, 3, 'Roberts', 'Gary', 'AQ', 'Male', '258 Cupuacu Ave, Hamletville', 'Virginia Beach', 'Regular', '2023-05-01 11:15:00', '2023-05-01 19:30:00', 76, '2025-05-04 05:22:31'),
(44, 1044, 4, 'Carter', 'Sharon', 'AR', 'Female', '369 Eggfruit Blvd, Burgberg', 'Oakland', 'Express', '2023-05-01 08:30:00', '2023-05-01 15:45:00', 92, '2025-05-04 05:22:31'),
(45, 1045, 1, 'Phillips', 'Kenneth', 'AS', 'Male', '471 Feijoa Dr, Citytown', 'Minneapolis', 'Regular', '2023-05-01 10:45:00', '2023-05-01 19:00:00', 84, '2025-05-04 05:22:31'),
(46, 1046, 2, 'Evans', 'Deborah', 'AT', 'Female', '582 Genip Ln, Villageville', 'Tulsa', 'Express', '2023-05-01 09:15:00', '2023-05-01 16:30:00', 96, '2025-05-04 05:22:31'),
(47, 1047, 3, 'Turner', 'Joshua', 'AU', 'Male', '693 Honeyberry Rd, Townburg', 'Arlington', 'Regular', '2023-05-01 11:30:00', '2023-05-01 19:45:00', 80, '2025-05-04 05:22:31'),
(48, 1048, 4, 'Parker', 'Pamela', 'AV', 'Female', '714 Imbe Ct, Burgtown', 'New Orleans', 'Express', '2023-05-01 08:45:00', '2023-05-01 15:00:00', 89, '2025-05-04 05:22:31'),
(49, 1049, 1, 'Collins', 'Timothy', 'AW', 'Male', '825 Jaboticaba Way, Cityberg', 'Wichita', 'Regular', '2023-05-01 12:00:00', '2023-05-01 20:15:00', 77, '2025-05-04 05:22:31'),
(50, 1050, 2, 'Edwards', 'Betty', 'AX', 'Female', '936 Kei Apple St, Villageburg', 'Cleveland', 'Express', '2023-05-01 09:30:00', '2023-05-01 16:45:00', 93, '2025-05-04 05:22:31'),
(51, 1051, 3, 'Stewart', 'Jason', 'AY', 'Male', '147 Langsat Ave, Township', 'Tampa', 'Regular', '2023-05-01 10:15:00', '2023-05-01 18:30:00', 81, '2025-05-04 05:22:31'),
(52, 1052, 4, 'Flores', 'Helen', 'AZ', 'Female', '258 Mamey Sapote Blvd, Hamletberg', 'Bakersfield', 'Express', '2023-05-01 08:00:00', '2023-05-01 14:15:00', 87, '2025-05-04 05:22:31'),
(53, 1053, 1, 'Morris', 'Jeffrey', 'BA', 'Male', '369 Nance Dr, Burgville', 'Aurora', 'Regular', '2023-05-01 11:45:00', '2023-05-01 20:00:00', 85, '2025-05-04 05:22:31'),
(54, 1054, 2, 'Nguyen', 'Carolyn', 'BB', 'Female', '471 Olive Ln, Citytown', 'Anaheim', 'Express', '2023-05-01 09:45:00', '2023-05-01 16:00:00', 91, '2025-05-04 05:22:31'),
(55, 1055, 3, 'Murphy', 'Ryan', 'BC', 'Male', '582 Pepino Rd, Villageville', 'Honolulu', 'Regular', '2023-05-01 10:30:00', '2023-05-01 18:45:00', 79, '2025-05-04 05:22:31'),
(56, 1056, 4, 'Rivera', 'Ruth', 'BD', 'Female', '693 Quince Ct, Townberg', 'Santa Ana', 'Express', '2023-05-01 08:15:00', '2023-05-01 14:30:00', 95, '2025-05-04 05:22:31'),
(57, 1057, 1, 'Cook', 'Jacob', 'BE', 'Male', '714 Rose Apple Way, Burgtown', 'Corpus Christi', 'Regular', '2023-05-01 12:30:00', '2023-05-01 20:45:00', 83, '2025-05-04 05:22:31'),
(58, 1058, 2, 'Rogers', 'Janet', 'BF', 'Female', '825 Santol St, Cityville', 'Riverside', 'Express', '2023-05-01 09:00:00', '2023-05-01 15:15:00', 89, '2025-05-04 05:22:31'),
(59, 1059, 3, 'Morgan', 'Nathan', 'BG', 'Male', '936 Tamarind Ave, Villageberg', 'Lexington', 'Regular', '2023-05-01 11:15:00', '2023-05-01 19:30:00', 77, '2025-05-04 05:22:31'),
(60, 1060, 4, 'Peterson', 'Amy', 'BH', 'Female', '147 Ugli Fruit Blvd, Townshipville', 'Stockton', 'Express', '2023-05-01 08:30:00', '2023-05-01 15:45:00', 93, '2025-05-04 05:22:31'),
(61, 1061, 1, 'Cooper', 'Samuel', 'BI', 'Male', '258 Voavanga Dr, Hamletville', 'Henderson', 'Regular', '2023-05-01 10:45:00', '2023-05-01 19:00:00', 81, '2025-05-04 05:22:31'),
(62, 1062, 2, 'Reed', 'Virginia', 'BJ', 'Female', '369 Water Apple Ln, Burgberg', 'Saint Paul', 'Express', '2023-05-01 09:15:00', '2023-05-01 16:30:00', 87, '2025-05-04 05:22:31'),
(63, 1063, 3, 'Bailey', 'Patrick', 'BK', 'Male', '471 Xigua Rd, Citytown', 'Cincinnati', 'Regular', '2023-05-01 11:30:00', '2023-05-01 19:45:00', 85, '2025-05-04 05:22:31'),
(64, 1064, 4, 'Bell', 'Kathleen', 'BL', 'Female', '582 Yangmei Ct, Villageville', 'Greensboro', 'Express', '2023-05-01 08:45:00', '2023-05-01 15:00:00', 91, '2025-05-04 05:22:31'),
(65, 1065, 1, 'Gomez', 'Dennis', 'BM', 'Male', '693 Zapote Way, Townburg', 'Pittsburgh', 'Regular', '2023-05-01 12:15:00', '2023-05-01 20:30:00', 79, '2025-05-04 05:22:31'),
(66, 1066, 2, 'Kelly', 'Shirley', 'BN', 'Female', '714 Ackee St, Burgtown', 'Lincoln', 'Express', '2023-05-01 09:30:00', '2023-05-01 16:45:00', 95, '2025-05-04 05:22:31'),
(67, 1067, 3, 'Howard', 'Jerry', 'BO', 'Male', '825 Breadnut Ave, Cityberg', 'Orlando', 'Regular', '2023-05-01 10:15:00', '2023-05-01 18:30:00', 83, '2025-05-04 05:22:31'),
(68, 1068, 4, 'Ward', 'Brenda', 'BP', 'Female', '936 Canistel Blvd, Villageburg', 'Plano', 'Express', '2023-05-01 08:00:00', '2023-05-01 14:15:00', 89, '2025-05-04 05:22:31'),
(69, 1069, 1, 'Cox', 'Henry', 'BQ', 'Male', '147 Dragonfruit Dr, Township', 'Irvine', 'Regular', '2023-05-01 11:45:00', '2023-05-01 20:00:00', 77, '2025-05-04 05:22:31'),
(70, 1070, 2, 'Diaz', 'Peggy', 'BR', 'Female', '258 Eggfruit Ln, Hamletberg', 'Newark', 'Express', '2023-05-01 09:45:00', '2023-05-01 16:00:00', 93, '2025-05-04 05:22:31');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
