-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2025 at 04:30 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lis`
--

-- --------------------------------------------------------

--
-- Table structure for table `allergies`
--

CREATE TABLE `allergies` (
  `allergy_id` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `drug` int(11) NOT NULL,
  `description` text NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `audit_id` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `transaction` varchar(255) NOT NULL,
  `previous_qty` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`audit_id`, `store`, `item`, `transaction`, `previous_qty`, `quantity`, `posted_by`, `post_date`) VALUES
(21, 1, 376, 'purchase', 0, 30, 1, '2025-02-15 13:03:01'),
(22, 1, 381, 'purchase', 0, 50, 1, '2025-02-15 13:03:18'),
(23, 1, 376, 'purchase', 30, 20, 1, '2025-02-15 13:03:34'),
(24, 1, 379, 'purchase', 0, 30, 1, '2025-02-15 13:03:54'),
(25, 1, 380, 'purchase', 0, 25, 1, '2025-02-15 13:04:09'),
(26, 1, 376, 'adjust', 50, 55, 1, '2025-02-15 13:16:07'),
(27, 1, 376, 'remove', 55, 5, 1, '2025-02-15 13:21:06'),
(28, 1, 376, 'dispense', 50, 5, 1, '2025-02-15 15:03:51'),
(29, 1, 376, 'dispense', 45, 5, 1, '2025-02-15 15:04:57'),
(30, 1, 376, 'dispense', 45, 5, 1, '2025-02-15 15:05:25'),
(31, 1, 379, 'dispense', 30, 2, 1, '2025-02-15 15:05:34'),
(32, 1, 380, 'dispense', 25, 1, 1, '2025-02-15 15:05:46'),
(33, 1, 381, 'dispense', 50, 3, 1, '2025-02-15 15:06:24'),
(34, 1, 381, 'dispense', 50, 3, 1, '2025-02-15 15:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `bank_id` int(11) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `bank`, `account_number`) VALUES
(1, 'FCMB', '9844408013');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `bill_id` int(11) NOT NULL,
  `visit_number` varchar(50) NOT NULL,
  `patient` int(11) NOT NULL,
  `patient_category` varchar(50) NOT NULL,
  `sponsor` int(11) NOT NULL,
  `service_category` varchar(50) NOT NULL,
  `service` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` float NOT NULL,
  `bill_status` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`bill_id`, `visit_number`, `patient`, `patient_category`, `sponsor`, `service_category`, `service`, `quantity`, `amount`, `bill_status`, `store`, `posted_by`, `post_date`) VALUES
(65, 'VIN-070225035157', 51, 'Private', 0, '', 0, 0, 18000, 1, 1, 1, '2025-02-07 15:27:26'),
(66, 'VN-1100225045558', 55, 'Private', 0, '', 0, 0, 33500, 1, 1, 1, '2025-02-10 16:28:40'),
(67, 'VN-1150225075659', 56, 'Private', 0, '', 0, 0, 2500, 1, 1, 1, '2025-02-15 19:23:06'),
(68, 'VN-1150225075660', 56, 'Private', 0, '', 0, 0, 3500, 1, 1, 27, '2025-02-15 19:25:26'),
(69, 'VN-1160225015161', 51, 'Private', 0, '', 0, 0, 6000, 1, 1, 1, '2025-02-16 13:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `bonus`
--

CREATE TABLE `bonus` (
  `bonus_id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `sales_rep` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `post_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `category` varchar(1024) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `department`, `category`, `price`) VALUES
(41, '41', 'Biochemistry', 0),
(42, '41', 'Microbiology', 0),
(43, '41', 'Parasitology', 0),
(44, '42', 'Consumables', 0);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company`, `logo`, `date_created`) VALUES
(1, 'St. Jude&#039;s Medical Laboratory', 'icon.png', '2024-06-10 14:46:39');

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `consultation_id` int(11) NOT NULL,
  `consult_no` varchar(50) NOT NULL,
  `patient` int(11) NOT NULL,
  `primary_diagnosis` int(11) NOT NULL,
  `secondary_diagnosis` int(11) NOT NULL,
  `other_diagnosis` text NOT NULL,
  `complain` text NOT NULL,
  `complain_history` text NOT NULL,
  `medical_history` text NOT NULL,
  `family_history` text NOT NULL,
  `nutritional_history` text NOT NULL,
  `gyn_history` text NOT NULL,
  `perinatal_history` text NOT NULL,
  `systemic_review` text NOT NULL,
  `notes` text NOT NULL,
  `prescriptions` varchar(50) NOT NULL,
  `consult_status` int(11) NOT NULL,
  `follow_up` datetime DEFAULT NULL,
  `store` int(11) NOT NULL,
  `consultant` int(11) NOT NULL,
  `post_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_trail`
--

CREATE TABLE `customer_trail` (
  `id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `amount` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `debtors`
--

CREATE TABLE `debtors` (
  `debtor_id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `debt_status` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department`) VALUES
(41, 'Investigations'),
(42, 'Consumables');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `deposit_id` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `details` varchar(255) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp(),
  `posted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `designation_id` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`designation_id`, `designation`) VALUES
(1, 'MEDICAL OFFICER'),
(2, 'HEAD NURSE'),
(3, 'CASHIER'),
(4, 'BILLING OFFICER'),
(5, 'HEAD LABORATORY'),
(6, 'LAB SCIENTIST'),
(7, 'LAB TECHNICIAN'),
(8, 'CONSULTANT PAEDIATRICIAN'),
(9, 'NURSING OFFICER'),
(10, 'NURSE ASSISTANT'),
(11, 'HEAD PHARMACY'),
(12, 'ACCOUNT OFFICER'),
(13, 'HEAD ICT'),
(14, 'ICT OFFICER');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `diagnosis_id` int(11) NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `post_date` datetime DEFAULT NULL,
  `posted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disciplines`
--

CREATE TABLE `disciplines` (
  `discipline_id` int(11) NOT NULL,
  `discipline` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disciplines`
--

INSERT INTO `disciplines` (`discipline_id`, `discipline`) VALUES
(1, 'MEDICAL DOCTOR'),
(2, 'NURSE'),
(3, 'ACCOUNTANT'),
(4, 'SCIENTIST'),
(5, 'PHARMACIST'),
(6, 'NUTRITIONIST'),
(7, 'FRONT DESK OFFICER'),
(8, 'HR GENERALIST'),
(9, 'SOFTWARE DEVELOPER'),
(10, 'ICT ENGINEER');

-- --------------------------------------------------------

--
-- Table structure for table `dispense_items`
--

CREATE TABLE `dispense_items` (
  `dispense_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dispense_status` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime DEFAULT NULL,
  `cost_price` float NOT NULL,
  `expiration` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dispense_items`
--

INSERT INTO `dispense_items` (`dispense_id`, `item`, `invoice`, `quantity`, `dispense_status`, `store`, `posted_by`, `post_date`, `cost_price`, `expiration`) VALUES
(2, 376, 'DP71089115022503031', 5, 1, 1, 1, '2025-02-15 15:05:25', 130, '2026-12-30'),
(3, 379, 'DP71089115022503031', 2, 1, 1, 1, '2025-02-15 15:05:34', 5500, '2028-12-30'),
(4, 380, 'DP71089115022503031', 1, 1, 1, 1, '2025-02-15 15:05:46', 6500, '2025-12-30'),
(6, 381, 'DP12707115022503061', 3, 1, 1, 1, '2025-02-15 15:08:09', 300, '2025-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `expense_head` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `details` text NOT NULL,
  `expense_date` datetime NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `store`, `posted_by`, `expense_head`, `amount`, `details`, `expense_date`, `post_date`) VALUES
(2, 1, 1, '1', 100000, 'Fuel', '2025-02-16 00:00:00', '2025-02-16 16:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `expense_heads`
--

CREATE TABLE `expense_heads` (
  `exp_head_id` int(11) NOT NULL,
  `expense_head` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_heads`
--

INSERT INTO `expense_heads` (`exp_head_id`, `expense_head`) VALUES
(1, 'Utility'),
(2, 'Fuel &amp; Diesel');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `cost_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `batch_number` varchar(20) NOT NULL,
  `expiration_date` date NOT NULL,
  `reorder_level` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `item`, `store`, `cost_price`, `quantity`, `batch_number`, `expiration_date`, `reorder_level`, `post_date`) VALUES
(551, 376, 1, 130, 20, '', '2026-12-30', 10, '2025-02-15 13:03:01'),
(552, 381, 1, 300, 47, '', '2025-02-28', 10, '2025-02-15 13:03:18'),
(553, 376, 1, 130, 20, '', '2025-06-15', 10, '2025-02-15 13:03:34'),
(554, 379, 1, 5500, 28, '', '2028-12-30', 10, '2025-02-15 13:03:54'),
(555, 380, 1, 6500, 24, '', '2025-12-30', 10, '2025-02-15 13:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `investigations`
--

CREATE TABLE `investigations` (
  `investigation_id` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `visit_number` varchar(50) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `patient` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `amount` float NOT NULL,
  `test_status` int(11) NOT NULL,
  `validation` int(11) NOT NULL,
  `validated_by` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investigations`
--

INSERT INTO `investigations` (`investigation_id`, `store`, `visit_number`, `invoice`, `patient`, `item`, `amount`, `test_status`, `validation`, `validated_by`, `posted_by`, `post_date`) VALUES
(40, 1, 'VIN-070225035157', 'INV11960702250327', 51, 366, 6000, 4, 1, 1, 1, '2025-02-07 15:27:21'),
(41, 1, 'VIN-070225035157', 'INV11960702250327', 51, 367, 12000, 4, 1, 1, 1, '2025-02-07 15:27:24'),
(42, 1, 'VN-1100225045558', 'INV15781002250427', 55, 367, 12000, 3, 0, 0, 1, '2025-02-10 16:27:27'),
(43, 1, 'VN-1100225045558', 'INV15781002250427', 55, 368, 6000, 4, 1, 1, 1, '2025-02-10 16:27:32'),
(44, 1, 'VN-1100225045558', 'INV15781002250427', 55, 371, 2500, 4, 1, 1, 1, '2025-02-10 16:27:43'),
(45, 1, 'VN-1100225045558', 'INV15781002250427', 55, 369, 9500, 4, 0, 0, 1, '2025-02-10 16:27:48'),
(47, 1, 'VN-1100225045558', 'INV15781002250427', 55, 372, 3500, 3, 0, 0, 1, '2025-02-10 16:28:15'),
(48, 1, 'VN-1150225075659', 'INV12451502250722', 56, 371, 2500, 2, 0, 0, 1, '2025-02-15 19:22:43'),
(50, 1, 'VN-1150225075660', 'INV275471502250725', 56, 372, 3500, 4, 0, 0, 27, '2025-02-15 19:25:24'),
(51, 1, 'VN-1160225015161', 'INV16181602250149', 51, 366, 6000, 2, 0, 0, 1, '2025-02-16 13:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_group` varchar(50) NOT NULL,
  `department` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `class` varchar(50) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `cost_price` float NOT NULL,
  `sales_price` float NOT NULL,
  `pack_size` int(11) NOT NULL,
  `pack_price` int(11) NOT NULL,
  `wholesale` int(11) NOT NULL,
  `wholesale_pack` int(11) NOT NULL,
  `wholesale_cost` float NOT NULL,
  `carton_role` float NOT NULL,
  `carton_size` int(11) NOT NULL,
  `markup` float NOT NULL,
  `reorder_level` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `photo` varchar(1024) NOT NULL,
  `photo2` varchar(1024) NOT NULL,
  `photo3` varchar(1024) NOT NULL,
  `description` text NOT NULL,
  `dosage` text NOT NULL,
  `commission` float NOT NULL,
  `item_status` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_group`, `department`, `category`, `class`, `item_name`, `cost_price`, `sales_price`, `pack_size`, `pack_price`, `wholesale`, `wholesale_pack`, `wholesale_cost`, `carton_role`, `carton_size`, `markup`, `reorder_level`, `barcode`, `photo`, `photo2`, `photo3`, `description`, `dosage`, `commission`, `item_status`, `date_created`) VALUES
(366, 'Laboratory', '41', 41, '', 'MALARIA PARASITE', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-05 15:14:37'),
(367, 'Laboratory', '41', 41, '', 'URINALYSIS', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-05 15:14:41'),
(368, 'Laboratory', '41', 42, '', 'HIV', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-10 16:23:34'),
(369, 'Laboratory', '41', 42, '', 'APETITIS B', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-10 16:23:45'),
(370, 'Laboratory', '41', 42, '', 'PCV', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-10 16:23:49'),
(371, 'Laboratory', '41', 41, '', 'FULL BLOOD COUNT (FBC)', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-10 16:25:48'),
(372, 'Laboratory', '41', 41, '', 'FASTING BLOOD SUGAR (FBS)', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-10 16:25:59'),
(373, 'Consumables', '42', 44, '', 'PENNICILIN OINTMENT', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-15 11:54:30'),
(374, 'Consumables', '42', 44, '', 'DEXTROSE WATER', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-15 11:54:37'),
(375, 'Consumables', '42', 44, '', '2G NEEDLE', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-15 11:54:41'),
(376, 'Consumables', '42', 44, '', '23G NEEDLE', 130, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-15 11:54:45'),
(377, 'Consumables', '42', 44, '', '25G NEEDLE', 150, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-15 11:54:49'),
(378, 'Consumables', '42', 44, '', 'URINE BAG', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-15 11:54:53'),
(379, 'Consumables', '42', 44, '', 'DRIP SET', 5500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-15 11:54:58'),
(380, 'Consumables', '42', 44, '', 'BLOOD GIVING SET', 6500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-15 11:55:07'),
(381, 'Consumables', '42', 44, '', '5ML SYRINGE', 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-15 12:02:23'),
(382, 'Consumables', '42', 44, '', '10ML SYRINGE', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-15 12:02:27'),
(383, 'Laboratory', '41', 42, '', 'PROTEIN PROFILE', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-15 12:09:41'),
(384, 'Consumables', '42', 44, '', 'METHYLATED SPIRIT', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '0', '', '', '', '', '', 0, 0, '2025-02-15 12:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `item_transfers`
--

CREATE TABLE `item_transfers` (
  `transfer_id` int(11) NOT NULL,
  `item_from` int(11) NOT NULL,
  `item_to` int(11) NOT NULL,
  `removed_qty` int(11) NOT NULL,
  `added_qty` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lab_results`
--

CREATE TABLE `lab_results` (
  `result_id` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `investigation` int(11) NOT NULL,
  `visit_number` varchar(50) NOT NULL,
  `result_number` varchar(50) NOT NULL,
  `result` text NOT NULL,
  `store` int(11) NOT NULL,
  `post_date` datetime DEFAULT NULL,
  `posted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lab_results`
--

INSERT INTO `lab_results` (`result_id`, `patient`, `investigation`, `visit_number`, `result_number`, `result`, `store`, `post_date`, `posted_by`) VALUES
(5, 51, 366, 'VIN-070225035157', 'LB-51366601565', '\n                \n                \n                <p><br></p><p><b>QBC MALARIA : 2+</b></p><p><b><br></b></p><p><b><br></b></p><p class=\"MsoNormal\"><b>Result Interpretation: </b><b>Parasites/QBC\n  malaria field:</b></p><table border=\"1\" style=\"width: 100%; border-collapse: collapse; border-color:#e7e6e6;\"><tbody><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">1 - 10</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">1+</td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">10 - 100</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">2+</td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">100 and above</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">3+&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br></td></tr></tbody></table><p class=\"MsoNormal\"><br></p><p>NB: Please quickly go treat yourslef</p>\n                            \n             \n            ', 1, '2025-02-14 14:02:07', 1),
(6, 51, 367, 'VIN-070225035157', 'LB-51367602006', '\n                \n                \n                <p><br></p><table border=\"1\" style=\"width: 100%; border-collapse: collapse; border-color:#e7e6e6;\"><tbody><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><b>PARAMETERS</b></td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><b>RESULTS&nbsp;</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br></td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Appearance:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">pale</td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Color:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">yellow</td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Specific Gravity:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">23gx</td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">pH:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">7</td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Leukocyte:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">230</td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Nitrite:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">12.5</td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Protein:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">104m/g</td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Glucose:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">25ghz</td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Ketone:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">98ii</td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Urobilinogen:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">0</td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Bilirubin:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">91</td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Erythrocyte:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">140</td></tr></tbody></table><p><br></p><p><br></p>\n                            \n             \n            ', 1, '2025-02-14 15:28:12', 1),
(7, 55, 371, 'VN-1100225045558', 'LB-55371024277', '\n                blood is ok \n            ', 1, '2025-02-14 15:42:35', 1),
(8, 55, 368, 'VN-1100225045558', 'LB-55368662228', '\n                <div><br></div><div><b>NOT POSITIVE</b></div> \n            ', 1, '2025-02-15 09:11:55', 1),
(9, 55, 369, 'VN-1100225045558', 'LB-55369283919', '<div><br></div><div><br></div><div><b>NO apetitis found</b></div>\n                \n                \n            ', 1, '2025-02-15 18:39:05', 26),
(10, 56, 372, 'VN-1150225075660', 'LB-563722517610', 'mbjhghjk', 1, '2025-02-15 19:44:08', 26);

-- --------------------------------------------------------

--
-- Table structure for table `lab_templates`
--

CREATE TABLE `lab_templates` (
  `template_id` int(11) NOT NULL,
  `template_number` varchar(50) NOT NULL,
  `investigation` int(11) NOT NULL,
  `visit_number` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age_from` int(11) NOT NULL,
  `age_to` int(11) NOT NULL,
  `template` text NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lab_templates`
--

INSERT INTO `lab_templates` (`template_id`, `template_number`, `investigation`, `visit_number`, `gender`, `age_from`, `age_to`, `template`, `posted_by`, `post_date`) VALUES
(1, 'TMP-3679771402251158', 367, '', '', 0, 0, '\n                <p><br></p><table border=\"1\" style=\"width: 100%; border-collapse: collapse; border-color:#e7e6e6;\"><tbody><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><b>PARAMETERS</b></td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><b>RESULTS&nbsp;</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br></td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Appearance:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><br></td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Color:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><br></td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Specific Gravity:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><br></td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">pH:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><br></td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Leukocyte:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><br></td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Nitrite:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><br></td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Protein:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><br></td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Glucose:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><br></td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Ketone:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><br></td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Urobilinogen:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><br></td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Bilirubin:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><br></td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">Erythrocyte:</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\"><br></td></tr></tbody></table><p><br></p>\n            ', 1, '2025-02-14 11:58:58'),
(2, 'TMP-3663421402251201', 366, '', '', 0, 0, '\n                <p><br></p><p><b>QBC MALARIA : <br></b></p><p><b><br></b></p><p><b><br></b></p><p class=\"MsoNormal\"><b>Result Interpretation: </b><b>Parasites/QBC\n  malaria field:</b></p><table border=\"1\" style=\"width: 100%; border-collapse: collapse; border-color:#e7e6e6;\"><tbody><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">1 - 10</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">1+</td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">10 - 100</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">2+</td></tr><tr><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">100 and above</td><td style=\"padding: 10px; text-align: left; border-color:#e7e6e6;\">3+&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br></td></tr></tbody></table><p class=\"MsoNormal\"><br></p><p><br></p>\n            ', 1, '2025-02-14 12:01:19');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `menu`) VALUES
(1, 'Admin menu'),
(2, 'Pharmacy'),
(3, 'Inventory'),
(4, 'Financial mgt'),
(5, 'Reports'),
(6, 'Financial reports'),
(8, 'Front Desk'),
(10, 'Tariff Menu'),
(11, 'Cash/billing Menu'),
(12, 'Human Resource'),
(13, 'Doctor Menu'),
(14, 'Nurse Menu'),
(15, 'Laboratory');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `post_date` datetime DEFAULT NULL,
  `posted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `monthly_target`
--

CREATE TABLE `monthly_target` (
  `target_id` int(11) NOT NULL,
  `sales_rep` int(11) NOT NULL,
  `month` date DEFAULT NULL,
  `amount` float NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `multiple_payments`
--

CREATE TABLE `multiple_payments` (
  `id` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `cash` int(11) NOT NULL,
  `transfer` int(11) NOT NULL,
  `pos` int(11) NOT NULL,
  `bank` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `other_payments`
--

CREATE TABLE `other_payments` (
  `payment_id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(20) NOT NULL,
  `store` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `patient_number` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `sponsor` int(11) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `other_names` varchar(50) NOT NULL,
  `phone_numbers` varchar(20) NOT NULL,
  `home_address` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  `suffix` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `marital_status` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `nok` varchar(100) NOT NULL,
  `nok_address` varchar(100) NOT NULL,
  `nok_phone` varchar(20) NOT NULL,
  `nok_relation` varchar(20) NOT NULL,
  `wallet_balance` int(11) NOT NULL,
  `photo` varchar(1024) NOT NULL,
  `store` int(11) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `patient_number`, `category`, `sponsor`, `last_name`, `other_names`, `phone_numbers`, `home_address`, `email_address`, `dob`, `suffix`, `title`, `gender`, `marital_status`, `occupation`, `religion`, `nok`, `nok_address`, `nok_phone`, `nok_relation`, `wallet_balance`, `photo`, `store`, `reg_date`) VALUES
(51, 'PRN-HS214370051', 'Private', 0, 'IKPEFUA', 'KELLY', '07068897068', '1b Ogidan Street Off Sadiku Bajo Street, Okun-ajah, Lagos State', 'onostarkels@gmail.com', '1989-05-15', '', 'Mr.', 'Male', 'Married', 'Engineer', 'Christian', 'PAUL IKPEFUA', 'Abraka, Delta State', '09012345678', 'BROTHER', 0, 'user.png', 0, '2025-02-07 11:48:13'),
(53, 'PRN-HS347360053', 'Family', 2, 'OGUAS', 'GODWIN', '08035716496', '27 Father Healing Street, Warri', 'winneroguas@gmail.com', '1959-09-21', '', 'Mr.', 'Male', 'Widowed', 'Others', 'Christian', 'KELLY IKPEFUA', '1b Ogidan Street, Lagos', '07068897068', 'SON', 0, 'user.png', 0, '2025-02-07 11:55:23'),
(55, 'PRN-HS268970055', 'Private', 0, 'FANIRAN', 'DORCAS', '08100653703', '1b Ogidan Street Off Sadiku Bajo Street, Okun-ajah, Lagos State', 'oluwatoyi13@gmail.com', '1994-07-06', '', 'Mrs', 'Female', 'Married', 'Banker', 'Christian', 'MATTHEW OKEOWO', 'Badagry, Lagos', 'nil', 'BROTHER', 0, 'user.png', 0, '2025-02-07 12:05:59'),
(56, 'PRN-HS311010056', 'Private', 0, 'MURPHY', 'JACOB', '09012345678', 'Jkh89ijk', 'jkn', '1998-09-08', '', 'Mr.', 'Male', 'Single', 'Business Person', 'Christian', 'N', 'M,n', 'm,n', 'M,N', 0, 'user.png', 0, '2025-02-07 12:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `sales_type` varchar(50) NOT NULL,
  `customer` int(11) NOT NULL,
  `visit_number` varchar(50) NOT NULL,
  `amount_due` float NOT NULL,
  `store` int(11) NOT NULL,
  `amount_paid` float NOT NULL,
  `discount` int(20) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `bank` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp(),
  `sold_by` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `sales_type`, `customer`, `visit_number`, `amount_due`, `store`, `amount_paid`, `discount`, `payment_mode`, `bank`, `post_date`, `sold_by`, `posted_by`, `invoice`) VALUES
(194, 'Investigation', 51, 'VIN-070225035157', 18000, 1, 18000, 0, 'Transfer', 1, '2025-02-07 15:57:00', 0, 1, 'INV11960702250327'),
(195, 'Investigation', 55, 'VN-1100225045558', 33500, 1, 33500, 0, 'POS', 1, '2025-02-10 16:29:05', 0, 1, 'INV15781002250427'),
(196, 'Investigation', 56, 'VN-1150225075660', 3500, 1, 3500, 0, 'Cash', 0, '2025-02-15 19:25:36', 0, 27, 'INV275471502250725'),
(197, 'Investigation', 51, 'VN-1160225015161', 6000, 1, 6000, 0, 'Transfer', 1, '2025-02-16 13:52:07', 0, 1, 'INV16181602250149'),
(198, 'Investigation', 56, 'VN-1150225075659', 2500, 1, 2500, 0, 'Cash', 0, '2025-02-16 15:16:11', 0, 1, 'INV12451502250722');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `prescription_id` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `visit_number` varchar(50) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `drug` int(11) NOT NULL,
  `class` varchar(50) NOT NULL,
  `dosage` int(11) NOT NULL,
  `frequency` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `route` varchar(50) NOT NULL,
  `drug_status` int(11) NOT NULL,
  `details` text NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `item` int(11) NOT NULL,
  `cost_price` int(255) NOT NULL,
  `sales_price` int(255) NOT NULL,
  `vendor` int(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `expiration_date` date NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `store`, `invoice`, `item`, `cost_price`, `sales_price`, `vendor`, `quantity`, `expiration_date`, `posted_by`, `post_date`) VALUES
(551, 1, 'jkh88', 376, 130, 0, 1, 30, '2026-12-30', 1, '2025-02-15 13:03:01'),
(552, 1, 'jkh88', 381, 300, 0, 1, 50, '2025-02-28', 1, '2025-02-15 13:03:18'),
(553, 1, 'jkh88', 376, 130, 0, 1, 20, '2025-06-15', 1, '2025-02-15 13:03:34'),
(554, 1, 'jkh88', 379, 5500, 0, 1, 30, '2028-12-30', 1, '2025-02-15 13:03:54'),
(555, 1, 'jkh88', 380, 6500, 0, 1, 25, '2025-12-30', 1, '2025-02-15 13:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `remove_items`
--

CREATE TABLE `remove_items` (
  `remove_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `previous_qty` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `removed_by` int(11) NOT NULL,
  `removed_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `remove_items`
--

INSERT INTO `remove_items` (`remove_id`, `item`, `store`, `previous_qty`, `quantity`, `reason`, `removed_by`, `removed_date`) VALUES
(6, 376, 1, 55, 5, 'Damages', 1, '2025-02-15 13:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `remove_reasons`
--

CREATE TABLE `remove_reasons` (
  `remove_id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `remove_reasons`
--

INSERT INTO `remove_reasons` (`remove_id`, `reason`) VALUES
(1, 'Expiration'),
(2, 'Damages'),
(3, 'Transfer');

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE `rights` (
  `right_id` int(11) NOT NULL,
  `menu` int(11) NOT NULL,
  `sub_menu` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rights`
--

INSERT INTO `rights` (`right_id`, `menu`, `sub_menu`, `user`) VALUES
(171, 15, 141, 26),
(172, 15, 145, 26),
(173, 8, 62, 27),
(174, 8, 123, 27),
(175, 8, 124, 27);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `sales_type` varchar(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `markup` float NOT NULL,
  `price` float NOT NULL,
  `discount` int(11) NOT NULL,
  `total_amount` float NOT NULL,
  `cost` float NOT NULL,
  `commission` float NOT NULL,
  `posted_by` int(11) NOT NULL,
  `sales_status` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_returns`
--

CREATE TABLE `sales_returns` (
  `return_id` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `store` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `reason` varchar(1024) NOT NULL,
  `returned_by` int(11) NOT NULL,
  `return_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `samples`
--

CREATE TABLE `samples` (
  `sample_id` int(11) NOT NULL,
  `sample` varchar(155) NOT NULL,
  `post_date` datetime DEFAULT NULL,
  `posted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `samples`
--

INSERT INTO `samples` (`sample_id`, `sample`, `post_date`, `posted_by`) VALUES
(1, 'BLOOD', '2025-02-10 13:24:50', 1),
(2, 'SALIVA', '2025-02-10 13:25:21', 1),
(3, 'URINE', '2025-02-10 13:25:26', 1),
(4, 'SWAB', '2025-02-10 13:25:43', 1),
(5, 'SPUTUM', '2025-02-10 13:25:46', 1),
(6, 'STOOL', '2025-02-10 13:25:48', 1),
(7, 'OTHERS', '2025-02-10 13:26:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sample_collection`
--

CREATE TABLE `sample_collection` (
  `sample_id` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `visit_no` varchar(50) NOT NULL,
  `investigation` int(11) NOT NULL,
  `sample` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sample_collection`
--

INSERT INTO `sample_collection` (`sample_id`, `store`, `patient`, `visit_no`, `investigation`, `sample`, `posted_by`, `post_date`) VALUES
(4, 1, 51, 'VIN-070225035157', 366, 1, 1, '2025-02-10 15:50:30'),
(5, 1, 51, 'VIN-070225035157', 367, 3, 1, '2025-02-10 15:51:07'),
(6, 1, 55, 'VN-1100225045558', 367, 3, 1, '2025-02-10 16:29:41'),
(7, 1, 55, 'VN-1100225045558', 368, 1, 1, '2025-02-10 16:29:56'),
(8, 1, 55, 'VN-1100225045558', 371, 1, 1, '2025-02-10 16:30:02'),
(9, 1, 55, 'VN-1100225045558', 369, 1, 1, '2025-02-10 16:30:13'),
(10, 1, 55, 'VN-1100225045558', 372, 1, 1, '2025-02-10 16:30:20'),
(11, 1, 56, 'VN-1150225075660', 372, 1, 26, '2025-02-15 19:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `sponsor_id` int(11) NOT NULL,
  `sponsor_type` varchar(50) NOT NULL,
  `sponsor` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `location` varchar(1024) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`sponsor_id`, `sponsor_type`, `sponsor`, `contact_person`, `phone`, `email_address`, `location`, `post_date`) VALUES
(1, 'Insurance', 'AXA MANSARD', 'Jacob Zuma', '080788888', 'nil', 'Nil', '2024-07-21 13:53:57'),
(2, 'Family', 'IKPEFUA FAMILY', 'Kelly Ikpefua', '07068897068', 'mail', 'Nil', '2024-07-21 13:54:36'),
(3, 'Insurance', 'HYGEA', 'Alice Madson', '098098', 'nil', 'Nil', '2024-07-21 13:55:11');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staff_id` int(11) NOT NULL,
  `staff_number` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `other_names` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `marital_status` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `home_address` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `nok` varchar(255) NOT NULL,
  `nok_relation` varchar(50) NOT NULL,
  `nok_phone` varchar(50) NOT NULL,
  `employed` date NOT NULL,
  `department` int(11) NOT NULL,
  `staff_group` varchar(50) NOT NULL,
  `staff_category` varchar(50) NOT NULL,
  `designation` int(11) NOT NULL,
  `discipline` int(11) NOT NULL,
  `bank` int(11) NOT NULL,
  `account_num` int(11) NOT NULL,
  `pension` varchar(50) NOT NULL,
  `pension_num` varchar(50) NOT NULL,
  `photo` varchar(1024) NOT NULL,
  `staff_status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reg_date` datetime DEFAULT NULL,
  `posted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `staff_number`, `last_name`, `other_names`, `gender`, `title`, `dob`, `marital_status`, `religion`, `phone`, `home_address`, `email_address`, `nok`, `nok_relation`, `nok_phone`, `employed`, `department`, `staff_group`, `staff_category`, `designation`, `discipline`, `bank`, `account_num`, `pension`, `pension_num`, `photo`, `staff_status`, `user_id`, `reg_date`, `posted_by`) VALUES
(0, '0', 'Administrator', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', 0, '', '', 0, 0, 0, 0, '', '', '', 0, 1, NULL, 0),
(99895, '987', 'IKPEFUA', 'KELLY', 'Male', 'Mr.', '1989-05-15', 'Married', 'Christian', '07030662253', '1b Ogidan Street Off Sadiku Bajo Street, Okun-ajah, Lagos State', 'onostarkels@gmail.com', 'PAUL IKPEFUA', 'BROTHER', '09112345678', '2025-02-01', 0, 'core staff', 'senior staff', 6, 4, 1, 30596252, 'STANBIC IBTC', 'jk899889', 'user.png', 1, 26, '2025-02-15 16:08:15', 1),
(99896, '78678', 'FANIRAN', 'DORCAS', 'Female', 'Mrs', '1994-07-06', 'Married', 'Christian', '08100653703', 'Badagry', 'nil', 'N', 'N', '08100653703', '2025-02-02', 0, 'core staff', 'senior staff', 3, 7, 1, 0, '', '', 'user.png', 1, 27, '2025-02-15 16:12:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments`
--

CREATE TABLE `stock_adjustments` (
  `adjust_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `adjusted_by` int(11) NOT NULL,
  `previous_qty` int(11) NOT NULL,
  `new_qty` int(11) NOT NULL,
  `adjust_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_adjustments`
--

INSERT INTO `stock_adjustments` (`adjust_id`, `item`, `store`, `adjusted_by`, `previous_qty`, `new_qty`, `adjust_date`) VALUES
(39, 376, 1, 1, 50, 55, '2025-02-15 13:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `store_id` int(11) NOT NULL,
  `company` int(11) NOT NULL,
  `store` varchar(124) NOT NULL,
  `store_address` varchar(255) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`store_id`, `company`, `store`, `store_address`, `phone_number`, `date_created`) VALUES
(1, 1, 'Main Office', '49 Ugbowo - Lagos Road, OPp UBTH Main Gate, Benin city', '08036693760', '2023-09-15 15:36:25');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menus`
--

CREATE TABLE `sub_menus` (
  `sub_menu_id` int(11) NOT NULL,
  `menu` int(11) NOT NULL,
  `sub_menu` varchar(255) NOT NULL,
  `url` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_menus`
--

INSERT INTO `sub_menus` (`sub_menu_id`, `menu`, `sub_menu`, `url`, `status`) VALUES
(1, 1, 'Add Users', 'add_user', 0),
(2, 1, 'Disable User', 'disable_user', 0),
(3, 1, 'Activate User', 'activate_user', 0),
(4, 1, 'Reset Password', 'reset_password', 0),
(5, 1, 'Add Department', 'add_department', 0),
(6, 1, 'Add Category', 'add_category', 0),
(7, 1, 'Add Items', 'add_item', 0),
(8, 1, 'Modify Item Details', 'modify_item', 0),
(9, 1, 'Add Bank', 'add_bank', 0),
(10, 1, 'Manage Tariff', 'item_price', 0),
(11, 1, 'Add Remove Reasons', 'add_remove_reasons', 0),
(12, 2, 'Direct Sales', 'direct_sales', 0),
(13, 2, 'Sales Order', 'wholesale', 0),
(14, 2, 'Post Sales Order', 'post_sales_order', 1),
(15, 2, 'Sales Return', 'sales_return', 0),
(16, 2, 'Reprint Receipt', 'print_receipt', 0),
(17, 3, 'Set Reorder Level', 'reorder_level', 0),
(18, 3, 'Stock Balance', 'stock_balance', 0),
(19, 3, 'Receive Items', 'stockin_purchase', 0),
(20, 3, 'Add Supplier', 'add_vendor', 0),
(21, 3, 'Adjust Quantity', 'stock_adjustment', 0),
(22, 3, 'Remove Item', 'remove_item', 0),
(23, 3, 'Adjust Expiration', 'adjust_expiration', 0),
(24, 4, 'Add Expense Head', 'add_exp_head', 0),
(25, 4, 'Post Expense', 'post_expense', 0),
(26, 5, 'Item List', 'item_list', 0),
(27, 5, 'Bank List', 'bank_list', 0),
(28, 5, 'List Of Suppliers', 'vendor_list', 0),
(29, 5, 'Sales Return Report', 'sales_return_report', 0),
(30, 5, 'Stock Adjustment Report', 'stock_adjustment_report', 0),
(31, 5, 'Item Removed Report', 'item_removed_report', 0),
(33, 5, 'Purchase Reports', 'purchase_reports', 0),
(34, 5, 'Out Of Stock', 'out_of_stock', 0),
(35, 5, 'Soon To Expire', 'expire_soon', 0),
(36, 5, 'Expired Items', 'expired_items', 0),
(37, 5, 'Reached Reorder Level', 'reached_reorder', 0),
(38, 5, 'Item History', 'item_history', 0),
(39, 5, 'Purchase By Item', 'purchase_by_item', 0),
(40, 5, 'Purchase Per Vendor', 'purchase_per_vendor', 0),
(41, 6, 'Revenue Report', 'revenue_report', 0),
(42, 6, 'Cash Payments', 'cash_list', 0),
(43, 6, 'POS Payments', 'pos_list', 0),
(44, 6, 'Transfer Payments', 'transfer_list', 0),
(45, 6, 'Cashier Report', 'cashier_report', 0),
(46, 6, 'Revenue By Category', 'revenue_by_category', 0),
(47, 6, 'Profit And Loss Statement', 'profit_and_loss', 0),
(48, 6, 'Expense Report', 'expense_report', 0),
(49, 5, 'Highest Selling Items', 'highest_selling', 0),
(50, 5, 'Fast Selling Items', 'fast_selling', 0),
(51, 1, 'Change Category', 'change_category', 0),
(52, 1, 'Update Item Barcode', 'update_barcode', 0),
(53, 3, 'Transfer Items', 'transfer_item', 0),
(54, 3, 'Pending Transfer', 'pending_transfer', 0),
(55, 3, 'Accept Items', 'accept_items', 0),
(56, 3, 'Returned Transfer', 'returned_transfer', 0),
(57, 5, 'Transferred Items Report', 'transfer_report', 0),
(58, 5, 'Accept Items Report', 'accept_report', 0),
(59, 3, 'All Store Balance', 'all_store_balance', 0),
(60, 2, 'Wholesale', 'wholesale', 0),
(61, 2, 'Wholesale Order', 'wholesale_order', 1),
(62, 8, 'New Registration', 'new_registration', 0),
(63, 5, 'List Of Patients', 'customer_list', 0),
(64, 6, 'Retail Sales', 'retail_sales', 0),
(65, 6, 'Wholesale Report', 'wholesale_report', 0),
(66, 6, 'Customer Statement', 'customer_statement', 0),
(67, 6, 'Credit Sales List', 'credit_sales_list', 0),
(68, 6, 'Debtors Report', 'debtors_list', 0),
(69, 4, 'Pay Debt', 'pay_debt', 0),
(70, 6, 'Debt Payment Report', 'debt_payment_report', 0),
(71, 1, 'Add Menu', 'add_menu', 1),
(72, 1, 'Add Sub-menu', 'add_sub_menu', 1),
(73, 1, 'Edit Sub Menu', 'edit_sub_menu', 1),
(74, 1, 'Manage Profile', 'manage_profile', 1),
(75, 1, 'Add Store', 'add_store', 1),
(76, 1, 'Update Store Details', 'update_store', 0),
(77, 1, 'Add User Rights', 'add_rights', 1),
(78, 1, 'Delete Rights', 'delete_right', 0),
(79, 8, 'Update Patient Details', 'edit_customer_info', 0),
(80, 4, 'Fund Wallet', 'fund_wallet', 0),
(81, 4, 'Reverse Deposit', 'reverse_deposit', 0),
(82, 1, 'Adjust Expiration', 'adjust_expiration', 0),
(83, 3, 'Transfer Qty Btw Items', 'transfer_qty', 1),
(85, 5, 'List Of Users', 'user_list', 0),
(86, 3, 'Reprint Transfer Receipt', 'reprint_transfer', 0),
(87, 1, 'Give Rights', 'give_user_right', 0),
(89, 1, 'Manage Mark-up', 'manage_markup', 0),
(90, 2, 'Rep Sales', 'rep_sales', 0),
(91, 3, 'Receive Goods', 'receive_goods', 0),
(92, 1, 'Edit Suplier Info', 'edit_supplier_info', 0),
(93, 6, 'Sales Report', 'all_rep_sales', 0),
(94, 6, 'Sales Rep Report', 'rep_report', 0),
(95, 6, 'Sales Rep Statement', 'sales_rep_statement', 0),
(96, 5, 'Sales Rep List', 'sales_rep_list', 0),
(97, 1, 'Monthly Target', 'monthly_target', 0),
(98, 6, 'Item Revenue', 'revenue_by_item', 0),
(99, 6, 'Revenue Report', 'sales_report', 0),
(100, 6, 'Monthly Revenue', 'monthly_revenue', 0),
(101, 6, 'My Sales Report', 'sales_rep_report', 0),
(102, 6, 'My Monthly Revenue', 'rep_monthly_revenue', 0),
(103, 6, 'Sales Rep Bonus', 'sales_rep_bonus', 0),
(104, 8, 'Add Prescription', 'prescription', 0),
(105, 8, 'View Prescriptions', 'daily_prescriptions', 0),
(106, 5, 'Patient History', 'patient_history', 0),
(107, 8, 'Send Messaage', 'send_message', 0),
(108, 8, 'Schedule Message', 'schedule_message', 0),
(109, 8, 'Message Template', 'create_template', 0),
(110, 5, 'Sent Messages', 'sent_messages', 0),
(111, 5, 'Message Count', 'message_count', 0),
(113, 10, 'Add New Tariff', 'new_tariff', 0),
(114, 10, 'Edit Tariff', 'edit_tariff', 0),
(115, 1, 'Add Sponsor', 'add_sponsor', 0),
(116, 5, 'List Of Sponsors', 'sponsor_list', 0),
(117, 10, 'Investigation Price List', 'lab_price_list', 0),
(118, 10, 'Pharmacy Price List', 'pharmacy_tariff', 0),
(120, 5, 'Patient Visit Report', 'patient_visit', 0),
(121, 8, 'Update Photo', 'photo_update', 0),
(122, 8, 'Update Patient Sponsor', 'update_sponsor', 0),
(123, 8, 'Post Payments', 'outpatient_payment', 0),
(124, 8, 'Existing Patient', 'existing_patient', 0),
(125, 8, 'Merge Patient File', 'merge_files', 0),
(127, 1, 'Add Doctor To Specialty', 'add_doctor_to_specialty', 0),
(128, 5, 'Specialty List', 'specialty_list', 0),
(129, 10, 'Specialty Tariff', 'specialty_tariff', 0),
(130, 10, 'Services Price List', 'service_price_list', 0),
(131, 12, 'Add Designtation', 'add_designation', 0),
(132, 12, 'Add Discipline', 'add_discipline', 0),
(133, 12, 'Add Staff', 'add_staff', 0),
(134, 12, 'Staff List', 'staff_list', 0),
(135, 1, 'Add User Role', 'add_role', 0),
(136, 13, 'General Waiting List', 'op_waiting_list', 0),
(137, 14, 'OP Waiting List', 'new_vital_sign', 0),
(138, 14, 'Edit Vital Sign', 'edit_vital_sign', 0),
(139, 2, 'Reclassify Drug', 'reclassify_drug', 0),
(140, 13, 'Add Diagnosis', 'add_diagnosis', 0),
(141, 15, 'Sample Collection', 'sample_collection', 0),
(142, 15, 'Add Sample Type', 'add_sample_type', 0),
(143, 5, 'Sample Collection', 'sample_collection_report', 0),
(144, 15, 'Create Template', 'create_lab_template', 0),
(145, 15, 'Post Lab Result', 'post_lab_result', 0),
(146, 15, 'Recall Result', 'recall_result', 0),
(147, 15, 'Validate Result', 'validate_result', 0),
(148, 15, 'View Result', 'view_lab_result', 0),
(149, 5, 'Investigations Done', 'investigations_done', 0),
(150, 3, 'Dispense Item', 'dispense_item', 0),
(151, 3, 'Pending Dispense', 'pending_dispense', 0),
(152, 5, 'Dispense Report', 'dispense_report', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tariff`
--

CREATE TABLE `tariff` (
  `tariff_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `sponsor` int(11) NOT NULL,
  `item_group` varchar(50) NOT NULL,
  `item` int(11) NOT NULL,
  `cost` float NOT NULL,
  `amount` float NOT NULL,
  `revisit` float NOT NULL,
  `period` int(11) NOT NULL,
  `post_date` datetime DEFAULT NULL,
  `posted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tariff`
--

INSERT INTO `tariff` (`tariff_id`, `category`, `sponsor`, `item_group`, `item`, `cost`, `amount`, `revisit`, `period`, `post_date`, `posted_by`) VALUES
(36, 'Private', 0, 'Investigation', 367, 2000, 12000, 0, 0, '2025-02-05 15:20:40', 1),
(37, 'Private', 0, 'Investigation', 366, 1300, 6000, 0, 0, '2025-02-05 15:20:53', 1),
(38, 'Insurance', 3, 'Investigation', 367, 1000, 10000, 0, 0, '2025-02-07 09:28:15', 1),
(39, 'Insurance', 3, 'Investigation', 366, 1000, 4000, 0, 0, '2025-02-07 09:28:25', 1),
(40, 'Private', 0, 'Investigation', 370, 2500, 3000, 0, 0, '2025-02-10 16:24:47', 1),
(41, 'Private', 0, 'Investigation', 368, 4000, 6000, 0, 0, '2025-02-10 16:25:03', 1),
(42, 'Private', 0, 'Investigation', 369, 7000, 9500, 0, 0, '2025-02-10 16:25:29', 1),
(43, 'Private', 0, 'Investigation', 372, 2000, 3500, 0, 0, '2025-02-10 16:26:10', 1),
(44, 'Private', 0, 'Investigation', 371, 1500, 2500, 0, 0, '2025-02-10 16:26:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `template_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `transfer_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `from_store` int(11) NOT NULL,
  `to_store` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost_price` int(11) NOT NULL,
  `sales_price` int(11) NOT NULL,
  `expiration` date NOT NULL,
  `transfer_status` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `accept_by` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `home_address` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_password` varchar(1024) NOT NULL,
  `status` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `username`, `phone`, `home_address`, `email_address`, `user_role`, `user_password`, `status`, `store`, `reg_date`) VALUES
(1, 0, 'Sysadmin', '', '', '', 'Admin', '$2y$10$dcUrnR/.PvfK7XeYcP60hOyW2qnPSSvEq/Wxee6lv5DETW8pbGXYu', 0, 1, '2022-09-27 13:47:21'),
(26, 99895, 'onostar', '0909', '0909', '0909', 'Lab Scientist', '$2y$10$gBbN3e9k7Ob1.9jpt1tRuunLN/.ss63TE5ouurCOwCYAkAgviCRxe', 0, 1, '2025-02-15 16:10:04'),
(27, 99896, 'dorcas', '0909', '0909', '0909', 'Front Desk Officer', '$2y$10$jeyrk4ablXohQJGCPhZlDeS3lmlCqH0gejMGNZ9k31L7Kgm3hvc4i', 0, 1, '2025-02-15 16:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL,
  `user_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `user_role`) VALUES
(1, 'Admin'),
(2, 'Cashier'),
(3, 'Front Desk Officer'),
(7, 'Lab Scientist'),
(9, 'Inventory Officer');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `vendor` varchar(1024) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor`, `contact_person`, `phone`, `email_address`, `created_date`) VALUES
(1, 'Initial Stocking Item', 'Initial Stock', '090909009', 'nil', '2024-06-04 03:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `visit_id` int(11) NOT NULL,
  `visit_number` varchar(50) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `patient` int(11) NOT NULL,
  `patient_category` varchar(50) NOT NULL,
  `sponsor` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `visit_status` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `visit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`visit_id`, `visit_number`, `invoice`, `patient`, `patient_category`, `sponsor`, `store`, `visit_status`, `posted_by`, `visit_date`) VALUES
(46, 'VIN-070225115146', 'INV109707022511', 51, 'Private', 0, 1, 0, 1, '2025-02-07 11:48:13'),
(48, 'VIN-070225115348', 'INV195907022511', 53, 'Family', 2, 1, 0, 1, '2025-02-07 11:55:23'),
(50, 'VIN-070225125550', 'INV10730702251204', 55, 'Private', 0, 1, 0, 1, '2025-02-07 12:05:59'),
(51, 'VIN-070225125651', 'INV11170702251210', 56, 'Private', 0, 1, 0, 1, '2025-02-07 12:10:53'),
(53, 'VIN-070225035153', 'INV16610702250320', 51, 'Private', 0, 1, 0, 1, '2025-02-07 15:20:52'),
(54, 'VIN-070225035154', 'INV13800702250324', 51, 'Private', 0, 1, 0, 1, '2025-02-07 15:24:08'),
(55, 'VIN-070225035555', 'INV19060702250325', 55, 'Private', 0, 1, 0, 1, '2025-02-07 15:25:57'),
(56, 'VIN-070225035156', 'INV14180702250326', 51, 'Private', 0, 1, 0, 1, '2025-02-07 15:27:00'),
(57, 'VIN-070225035157', 'INV11960702250327', 51, 'Private', 0, 1, 1, 1, '2025-02-07 15:27:26'),
(58, 'VN-1100225045558', 'INV15781002250427', 55, 'Private', 0, 1, 1, 1, '2025-02-10 16:28:40'),
(59, 'VN-1150225075659', 'INV12451502250722', 56, 'Private', 0, 1, 1, 1, '2025-02-15 19:23:06'),
(60, 'VN-1150225075660', 'INV275471502250725', 56, 'Private', 0, 1, 1, 27, '2025-02-15 19:25:26'),
(61, 'VN-1160225015161', 'INV16181602250149', 51, 'Private', 0, 1, 1, 1, '2025-02-16 13:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `vital_signs`
--

CREATE TABLE `vital_signs` (
  `vitals_id` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `visit_number` varchar(50) NOT NULL,
  `complaints` text NOT NULL,
  `temperature` float NOT NULL,
  `systolic` float NOT NULL,
  `diastolic` float NOT NULL,
  `pulse` float NOT NULL,
  `respiration` float NOT NULL,
  `weight` float NOT NULL,
  `height` float NOT NULL,
  `bmi` float NOT NULL,
  `oxygen_saturation` float NOT NULL,
  `head_circumference` float NOT NULL,
  `remark` text NOT NULL,
  `triage` varchar(50) NOT NULL,
  `vital_status` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `post_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allergies`
--
ALTER TABLE `allergies`
  ADD PRIMARY KEY (`allergy_id`);

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`audit_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`bonus_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`consultation_id`);

--
-- Indexes for table `customer_trail`
--
ALTER TABLE `customer_trail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debtors`
--
ALTER TABLE `debtors`
  ADD PRIMARY KEY (`debtor_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`deposit_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`diagnosis_id`);

--
-- Indexes for table `disciplines`
--
ALTER TABLE `disciplines`
  ADD PRIMARY KEY (`discipline_id`);

--
-- Indexes for table `dispense_items`
--
ALTER TABLE `dispense_items`
  ADD PRIMARY KEY (`dispense_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `expense_heads`
--
ALTER TABLE `expense_heads`
  ADD PRIMARY KEY (`exp_head_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `investigations`
--
ALTER TABLE `investigations`
  ADD PRIMARY KEY (`investigation_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `item_transfers`
--
ALTER TABLE `item_transfers`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `lab_results`
--
ALTER TABLE `lab_results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `lab_templates`
--
ALTER TABLE `lab_templates`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `monthly_target`
--
ALTER TABLE `monthly_target`
  ADD PRIMARY KEY (`target_id`);

--
-- Indexes for table `multiple_payments`
--
ALTER TABLE `multiple_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_payments`
--
ALTER TABLE `other_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`prescription_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `remove_items`
--
ALTER TABLE `remove_items`
  ADD PRIMARY KEY (`remove_id`);

--
-- Indexes for table `remove_reasons`
--
ALTER TABLE `remove_reasons`
  ADD PRIMARY KEY (`remove_id`);

--
-- Indexes for table `rights`
--
ALTER TABLE `rights`
  ADD PRIMARY KEY (`right_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `sales_returns`
--
ALTER TABLE `sales_returns`
  ADD PRIMARY KEY (`return_id`);

--
-- Indexes for table `samples`
--
ALTER TABLE `samples`
  ADD PRIMARY KEY (`sample_id`);

--
-- Indexes for table `sample_collection`
--
ALTER TABLE `sample_collection`
  ADD PRIMARY KEY (`sample_id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`sponsor_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD PRIMARY KEY (`adjust_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD PRIMARY KEY (`sub_menu_id`);

--
-- Indexes for table `tariff`
--
ALTER TABLE `tariff`
  ADD PRIMARY KEY (`tariff_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`visit_id`);

--
-- Indexes for table `vital_signs`
--
ALTER TABLE `vital_signs`
  ADD PRIMARY KEY (`vitals_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allergies`
--
ALTER TABLE `allergies`
  MODIFY `allergy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `audit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `bonus`
--
ALTER TABLE `bonus`
  MODIFY `bonus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `consultation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_trail`
--
ALTER TABLE `customer_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `debtors`
--
ALTER TABLE `debtors`
  MODIFY `debtor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `deposit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `diagnosis_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `discipline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dispense_items`
--
ALTER TABLE `dispense_items`
  MODIFY `dispense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense_heads`
--
ALTER TABLE `expense_heads`
  MODIFY `exp_head_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=556;

--
-- AUTO_INCREMENT for table `investigations`
--
ALTER TABLE `investigations`
  MODIFY `investigation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT for table `item_transfers`
--
ALTER TABLE `item_transfers`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `lab_results`
--
ALTER TABLE `lab_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lab_templates`
--
ALTER TABLE `lab_templates`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `monthly_target`
--
ALTER TABLE `monthly_target`
  MODIFY `target_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `multiple_payments`
--
ALTER TABLE `multiple_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `other_payments`
--
ALTER TABLE `other_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=556;

--
-- AUTO_INCREMENT for table `remove_items`
--
ALTER TABLE `remove_items`
  MODIFY `remove_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `remove_reasons`
--
ALTER TABLE `remove_reasons`
  MODIFY `remove_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rights`
--
ALTER TABLE `rights`
  MODIFY `right_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1221;

--
-- AUTO_INCREMENT for table `sales_returns`
--
ALTER TABLE `sales_returns`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `samples`
--
ALTER TABLE `samples`
  MODIFY `sample_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sample_collection`
--
ALTER TABLE `sample_collection`
  MODIFY `sample_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `sponsor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99897;

--
-- AUTO_INCREMENT for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  MODIFY `adjust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_menus`
--
ALTER TABLE `sub_menus`
  MODIFY `sub_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `tariff`
--
ALTER TABLE `tariff`
  MODIFY `tariff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `vital_signs`
--
ALTER TABLE `vital_signs`
  MODIFY `vitals_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
