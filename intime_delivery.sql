-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 24, 2020 at 06:36 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.3.15-3+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evtickr_intime`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `staff_id` int(100) DEFAULT NULL,
  `income_date` timestamp NULL DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `vendor_id` int(100) DEFAULT NULL,
  `amount` int(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `auto_gen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `staff_id`, `income_date`, `remark`, `vendor_id`, `amount`, `created_at`, `auto_gen`) VALUES
(64, 2, '2020-03-01 17:30:00', '-', 2, 1, '2020-03-02 16:23:44', '1583166219'),
(65, 2, '2020-03-01 17:30:00', '- အားလံုးကိုေက်းဇူးတင္ပါတယ္ေနာ္', 2, 10000, '2020-03-02 16:48:49', '1583167710'),
(67, 4, '2020-03-02 17:30:00', '-', 3, 20000, '2020-03-02 17:56:38', '1583171793'),
(68, 4, '2020-03-02 17:30:00', '-', 4, 35000, '2020-03-02 17:56:42', '1583171798'),
(69, 3, '2020-03-02 17:30:00', '-', 2, 1000, '2020-03-02 17:57:06', '1583171817'),
(70, 3, '2020-03-02 17:30:00', '-', 3, 3200, '2020-03-02 17:57:12', '1583171826'),
(71, 3, '2020-03-02 17:30:00', '-', 4, 12000, '2020-03-02 17:57:17', '1583171832'),
(72, 3, '2020-03-02 17:30:00', '-', 2, 10000, '2020-03-03 04:47:39', '1583210852'),
(73, 3, '2020-03-02 17:30:00', '-', 4, 1000, '2020-03-03 04:48:00', '1583210871'),
(81, 7, '2020-03-16 00:00:00', '-', 6, 7000, '2020-03-16 10:31:35', '1584331277');

-- --------------------------------------------------------

--
-- Table structure for table `account_ledger`
--

CREATE TABLE `account_ledger` (
  `id` int(100) NOT NULL,
  `acc_transction_id` int(10) DEFAULT NULL,
  `route_plan_id` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `paid_unpaid` int(100) NOT NULL,
  `charges` int(100) NOT NULL,
  `notification_date` datetime DEFAULT NULL,
  `route_status` int(100) NOT NULL DEFAULT '0',
  `transcation_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_ledger`
--

INSERT INTO `account_ledger` (`id`, `acc_transction_id`, `route_plan_id`, `price`, `quantity`, `amount`, `paid_unpaid`, `charges`, `notification_date`, `route_status`, `transcation_date`) VALUES
(1, NULL, 51, 8100, 1, 8100, 0, 2000, NULL, 0, NULL),
(2, NULL, 50, 13600, 1, 13600, 0, 2000, NULL, 0, NULL),
(3, NULL, 49, 36200, 1, 36200, 0, 2000, NULL, 0, NULL),
(4, NULL, 48, 9600, 1, 9600, 0, 2000, NULL, 0, NULL),
(5, NULL, 47, 22500, 1, 22500, 0, 2000, NULL, 0, NULL),
(6, NULL, 46, 9000, 1, 9000, 0, 2000, NULL, 0, NULL),
(7, NULL, 45, 170500, 1, 170500, 0, 2000, NULL, 0, NULL),
(8, NULL, 44, 28400, 1, 28400, 0, 2000, NULL, 0, NULL),
(9, NULL, 43, 70800, 1, 70800, 0, 2000, NULL, 0, NULL),
(10, NULL, 42, 14600, 1, 14600, 0, 2000, NULL, 0, NULL),
(11, NULL, 41, 7200, 1, 7200, 0, 2000, NULL, 0, NULL),
(12, NULL, 40, 13400, 1, 13400, 0, 2000, NULL, 0, NULL),
(13, NULL, 39, 20400, 1, 20400, 0, 2000, NULL, 0, NULL),
(14, NULL, 38, 7200, 1, 7200, 0, 2000, NULL, 0, NULL),
(15, NULL, 37, 12100, 1, 12100, 0, 2000, NULL, 0, NULL),
(16, NULL, 36, 9200, 1, 9200, 0, 2000, NULL, 0, NULL),
(17, NULL, 35, 11000, 1, 11000, 0, 2000, NULL, 0, NULL),
(18, NULL, 34, 7600, 1, 7600, 0, 2000, NULL, 0, NULL),
(19, NULL, 33, 14300, 1, 14300, 0, 2000, NULL, 0, NULL),
(20, NULL, 32, 14700, 1, 14700, 0, 2000, NULL, 0, NULL),
(21, NULL, 31, 8200, 1, 8200, 0, 2000, NULL, 0, NULL),
(22, NULL, 30, 23800, 1, 23800, 0, 2000, NULL, 0, NULL),
(23, NULL, 29, 31300, 1, 31300, 0, 2000, NULL, 0, NULL),
(24, NULL, 28, 6500, 1, 6500, 0, 2000, NULL, 0, NULL),
(25, NULL, 27, 23000, 1, 23000, 0, 2000, NULL, 0, NULL),
(26, NULL, 26, 22800, 1, 22800, 0, 2000, NULL, 0, NULL),
(27, NULL, 25, 30900, 1, 30900, 0, 2000, NULL, 0, NULL),
(28, NULL, 24, 13600, 1, 13600, 0, 2000, NULL, 0, NULL),
(29, NULL, 52, 16100, 1, 16100, 0, 2000, NULL, 0, NULL),
(30, NULL, 23, 47200, 1, 47200, 0, 2000, NULL, 0, NULL),
(31, NULL, 22, 0, 1, 0, 0, 2000, NULL, 0, NULL),
(32, NULL, 21, 25999, 1, 25999, 0, 2000, NULL, 0, NULL),
(33, NULL, 66, 39400, 1, 39400, 0, 2000, NULL, 0, NULL),
(34, NULL, 65, 9200, 1, 9200, 0, 2000, NULL, 0, NULL),
(35, NULL, 64, 11100, 1, 11100, 0, 2000, NULL, 0, NULL),
(36, NULL, 63, 16000, 1, 16000, 0, 2000, NULL, 0, NULL),
(37, NULL, 62, 35200, 1, 35200, 0, 2000, NULL, 0, NULL),
(38, NULL, 61, 34300, 1, 34300, 0, 2000, NULL, 0, NULL),
(39, NULL, 60, 16000, 1, 16000, 0, 2000, NULL, 0, NULL),
(40, NULL, 59, 13000, 1, 13000, 0, 2000, NULL, 0, NULL),
(41, NULL, 58, 7000, 1, 7000, 0, 2000, NULL, 0, NULL),
(42, NULL, 57, 23000, 1, 23000, 0, 2000, NULL, 0, NULL),
(43, NULL, 56, 13000, 1, 13000, 0, 2000, NULL, 0, NULL),
(44, NULL, 55, 8000, 1, 8000, 0, 2000, NULL, 0, NULL),
(45, NULL, 54, 9200, 1, 9200, 0, 2000, NULL, 0, NULL),
(46, NULL, 53, 19500, 1, 19500, 0, 2000, NULL, 0, NULL),
(47, NULL, 20, 39900, 1, 39900, 0, 2000, NULL, 0, NULL),
(48, NULL, 19, 7500, 1, 7500, 0, 2000, NULL, 0, NULL),
(49, NULL, 18, 16000, 1, 16000, 0, 2000, NULL, 0, NULL),
(50, NULL, 17, 22300, 1, 22300, 0, 2000, NULL, 0, NULL),
(51, NULL, 16, 0, 1, 0, 0, 2000, NULL, 0, NULL),
(52, NULL, 15, 51100, 1, 51100, 0, 2000, NULL, 0, NULL),
(53, NULL, 14, 0, 1, 0, 0, 2000, NULL, 0, NULL),
(54, NULL, 13, 45300, 1, 45300, 0, 2000, NULL, 0, NULL),
(55, NULL, 12, 0, 1, 0, 0, 2000, NULL, 0, NULL),
(56, NULL, 11, 9000, 1, 9000, 0, 2000, NULL, 0, NULL),
(57, NULL, 10, 15100, 1, 15100, 0, 2000, NULL, 0, NULL),
(58, NULL, 9, 20200, 1, 20200, 0, 2000, NULL, 0, NULL),
(59, NULL, 8, 20100, 1, 20100, 0, 2000, NULL, 0, NULL),
(60, NULL, 7, 61000, 1, 61000, 0, 2000, NULL, 0, NULL),
(61, NULL, 6, 16200, 1, 16200, 0, 2000, NULL, 0, NULL),
(62, NULL, 5, 12800, 1, 12800, 0, 2000, NULL, 0, NULL),
(63, NULL, 4, 13500, 1, 13500, 0, 2000, NULL, 0, NULL),
(64, NULL, 3, 13500, 1, 13500, 0, 2000, NULL, 0, NULL),
(65, NULL, 2, 0, 1, 0, 0, 2000, NULL, 0, NULL),
(66, NULL, 1, 0, 1, 0, 0, 2000, NULL, 0, NULL),
(67, NULL, 69, 30000, 1, 30000, 0, 1500, NULL, 0, NULL),
(68, NULL, 68, 15000, 1, 15000, 0, 1500, NULL, 0, NULL),
(69, NULL, 67, 21500, 1, 21500, 0, 1500, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `title`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@admin.com', 'Administrator', '$2y$10$J31Ycoaa2Ha9ob.cBhChB.8IcE3fN7WnmQHctm8xkCVfRO5hsZvym', 0, NULL, NULL, NULL),
(2, 'Accountant', 'accountant@gmail.com', 'Accountant', '$2y$10$J31Ycoaa2Ha9ob.cBhChB.8IcE3fN7WnmQHctm8xkCVfRO5hsZvym', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `amount_lenger`
--

CREATE TABLE `amount_lenger` (
  `route_plan_id` int(10) NOT NULL,
  `charges` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `total_amount` int(100) NOT NULL,
  `paid_unpaid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `amount` int(100) NOT NULL,
  `budget_date` date NOT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `amount`, `budget_date`, `created_at`, `updated_at`) VALUES
(1, 0, '2020-03-19', '2020-03-19 00:00:00.000000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `convert_route`
--

CREATE TABLE `convert_route` (
  `id` int(11) NOT NULL,
  `division` int(100) NOT NULL,
  `township` int(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `target_date` date NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `target_time` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `status` int(5) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `r_name` varchar(100) NOT NULL,
  `customer_confirm_status` int(10) NOT NULL DEFAULT '2',
  `remark` text,
  `parcel_status` int(10) DEFAULT '0',
  `foc` int(100) NOT NULL DEFAULT '0',
  `issue_type` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `daily_gross`
--

CREATE TABLE `daily_gross` (
  `id` int(100) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(20) NOT NULL,
  `amount` int(100) NOT NULL,
  `remark` varchar(191) COLLATE utf8_unicode_ci DEFAULT '-',
  `use_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `b_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_postman`
--

CREATE TABLE `delivery_postman` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `delivery_name` varchar(255) DEFAULT NULL,
  `delivery_nrc` varchar(255) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `employment_date` datetime DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `ph_one` varchar(255) DEFAULT NULL,
  `ph_two` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT '0',
  `status` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery_postman`
--

INSERT INTO `delivery_postman` (`id`, `user_name`, `password`, `register_date`, `delivery_name`, `delivery_nrc`, `registration_date`, `date_of_birth`, `photo`, `employment_date`, `address`, `ph_one`, `ph_two`, `role_id`, `status`) VALUES
(1, 'Myo Thant Zin', '25d55ad283aa400af464c76d713c07ad', '2020-01-22 00:00:00', 'Myo Thant Zin', '7/Thakana(N)093905', '2020-01-22 00:00:00', '1986-05-30', '1579702550.jpeg', '2019-12-01 00:00:00', 'A-7;Dhamayarzar St;(10)quater;South Oakalapa', '09971771677', '09442165294', 0, 0),
(2, 'Phyo Mg Mg', '1fda171830e96501ae5e9e056e1cad33', '2020-01-22 00:00:00', 'Mhan Gyi', '7/Patana(N)170598', '2020-01-22 00:00:00', '2002-01-03', '1579702960.jpeg', '2019-10-31 00:00:00', '3(A);Tharyarshwepyi Housing;Tarmwe', '09407133421', '09661639618', 0, 1),
(5, 'Aung Zaw Myo', '1fda171830e96501ae5e9e056e1cad33', '2020-01-22 00:00:00', 'Ywar Thar', '14/Bakala(N)372903', '2020-01-22 00:00:00', '1993-11-03', '1579706366.jpeg', '1992-11-03 00:00:00', 'No(5);Zezawar St;(9)Quarter;Hlaingtharyar', '09444521143', '09771938896', 0, 1),
(7, 'Zay Yar Myint', '1fda171830e96501ae5e9e056e1cad33', '2020-01-22 00:00:00', 'Pyaung Gyi', '8/Ma Ba Na (N) 071101', '2020-01-22 00:00:00', '1985-01-24', '1579705086.jpeg', '2019-11-06 00:00:00', 'No,275.Part 3 Nwe Khway', '09696599443', '09688410385', 0, 1),
(8, 'Myat Min Aung', '1fda171830e96501ae5e9e056e1cad33', '2020-01-22 00:00:00', 'Myat Min', '12/DaGaSa(N)019815', '2020-01-22 00:00:00', '1999-09-02', '1579705390.jpeg', '2019-12-04 00:00:00', 'No.3 Room.503 ,6 Floor /B Thar Yar Shwe Pyi st,\'Tharyarshwe Pyi Housing', '09970174042', '0932330129', 0, 1),
(9, 'Moe Min Aung', '25d55ad283aa400af464c76d713c07ad', '2020-01-22 00:00:00', 'A Pho', '12/KaTaNa (N)439427', '2020-01-22 00:00:00', '2001-05-30', '1579705742.jpeg', '2020-01-10 00:00:00', 'No.97 ,Da Ma Par Ya st,  North Oakkalapa', '09797116959', '09692268806', 0, 1),
(10, 'Tun Tun', '1fda171830e96501ae5e9e056e1cad33', '2020-01-22 00:00:00', 'Tun Tun', '14/Pha Pa Na (N) 321456', '2020-01-22 00:00:00', '1993-05-04', '1579706073.jpeg', '2020-01-16 00:00:00', 'No.907,BaYint Naung st,Bamar Aye Qtr,Dawpon', '09769369303', '09978676900', 0, 1),
(11, 'Khaing Linn', '1fda171830e96501ae5e9e056e1cad33', '2020-01-22 00:00:00', 'A Par Woo', '12/Ya Ka Na (N)001026', '2020-01-22 00:00:00', '1991-01-14', '1579706730.jpeg', '2020-01-12 00:00:00', 'No,1203,Oak Si Kan St,11 Qtr,YanKin', '09420104136', '09785633844', 0, 1),
(12, 'Myint Thu', '1fda171830e96501ae5e9e056e1cad33', '2020-01-22 00:00:00', 'MaYaKa', '12/MaYaKa(N)187450', '2020-01-22 00:00:00', '1996-11-21', '1579707447.jpeg', '2019-09-22 00:00:00', 'No.8,Room.504, Zay Butar st, Tamine (10 )Qtr Shwe Htee Housing', '09964422544', '09446227610', 0, 1),
(14, 'Thein Zaw Min', 'd41d8cd98f00b204e9800998ecf8427e', '2020-02-11 00:00:00', 'Thein Zaw', '12/KhaYaNa(N) 142734', '2020-02-11 00:00:00', '1994-11-09', '1584868604.jpg', '2020-01-27 00:00:00', 'no30, Nagani 1street, Daw Pon', '09891811092', '09407424074', 0, 1),
(15, 'Aung Ko Ko Oo', 'd41d8cd98f00b204e9800998ecf8427e', '2020-03-21 00:00:00', 'Aung Ko', '12/ A SA Na (Naing)203936', '2020-03-21 00:00:00', '1985-12-01', '1584868613.jpg', '2020-03-01 00:00:00', '430 ကာယသုခ1လမ္းေပညက', '09751173525', '09951811599', 0, 0),
(16, 'La Min Ko Ko', 'd41d8cd98f00b204e9800998ecf8427e', '2020-03-21 00:00:00', 'Gar Gyi', '12/ Ba Ha Na (Naing)114444', '2020-03-21 00:00:00', '1990-03-26', '1584868620.jpg', '2020-03-21 00:00:00', 'No 6 Aung Thiri st 28Qtr North Dagon', '09794162275', '09674783303', 0, 0),
(17, 'TESTER', 'd41d8cd98f00b204e9800998ecf8427e', '2020-03-06 00:00:00', 'test', '8/sala(n)123456', '2020-03-06 00:00:00', '1994-03-12', '1584868626.jpg', '2020-03-06 00:00:00', 'yangon', '09779142148', '09422837105', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `staff_id` int(100) DEFAULT NULL,
  `expense_date` date DEFAULT NULL,
  `reason` text COLLATE utf8_unicode_ci,
  `remark` text COLLATE utf8_unicode_ci,
  `amount` int(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `auto_gen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `staff_id`, `expense_date`, `reason`, `remark`, `amount`, `created_at`, `auto_gen`) VALUES
(3, 3, '2020-03-03', '-', '-', 2000, '2020-03-02 17:57:33', '1583171849'),
(4, 3, '2020-03-03', '-', '-', 3000, '2020-03-02 17:57:36', '1583171853'),
(6, 4, '2020-03-03', '-', '-', 2000, '2020-03-02 17:57:50', '1583171866'),
(7, 3, '2020-03-06', '-', '-', 12000, '2020-03-06 15:18:35', '1583484497');

-- --------------------------------------------------------

--
-- Table structure for table `highway`
--

CREATE TABLE `highway` (
  `id` int(100) NOT NULL,
  `plan_id` int(10) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `delivery_postman_id` int(10) DEFAULT NULL,
  `assign_date` datetime DEFAULT NULL,
  `delivery_charges` int(100) NOT NULL,
  `over_tender_charges` int(100) NOT NULL,
  `notification_date` datetime NOT NULL,
  `status` int(100) NOT NULL DEFAULT '0',
  `extra_charges` int(100) NOT NULL,
  `paid_unpaid` int(100) NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL,
  `division` varchar(100) NOT NULL,
  `township` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `registration_date` datetime NOT NULL,
  `target_date` datetime NOT NULL,
  `customer_confirm_status` int(10) NOT NULL DEFAULT '2',
  `transport_charge` int(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `highway`
--

INSERT INTO `highway` (`id`, `plan_id`, `product_id`, `delivery_postman_id`, `assign_date`, `delivery_charges`, `over_tender_charges`, `notification_date`, `status`, `extra_charges`, `paid_unpaid`, `remark`, `division`, `township`, `address`, `quantity`, `amount`, `registration_date`, `target_date`, `customer_confirm_status`, `transport_charge`) VALUES
(0, 510, 'PT-00006', NULL, NULL, 0, 0, '2020-02-16 00:00:00', 0, 0, 0, '- -', 'မႏၲေလးတိုင္းေဒသႀကီး', 'မႏၲေလးၿမိဳ႕', '62*63,23*24st,Mya Sandar Rd,Mandalay', 1, 19000, '2020-02-16 13:07:19', '0000-00-00 00:00:00', 2, 1000),
(0, 349, 'PT-00003', NULL, NULL, 0, 0, '2020-02-15 00:00:00', 0, 0, 0, '-', 'မႏၲေလးတိုင္းေဒသႀကီး', 'မႏၲေလးၿမိဳ႕', 'Near Sat Mhue Garden,San Pya Rd,Industry Zone-1', 1, 19000, '2020-02-15 06:57:43', '0000-00-00 00:00:00', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `id` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`id`, `name`) VALUES
(4, 'Phone Busy'),
(3, 'Poweroff'),
(5, 'Customer Phone Reject'),
(6, 'Not Answer');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_16_090740_create_admins_table', 1),
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_16_090740_create_admins_table', 1),
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_16_090740_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `office_staff`
--

CREATE TABLE `office_staff` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `delivery_name` varchar(255) DEFAULT NULL,
  `delivery_nrc` varchar(255) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `employment_date` datetime DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `ph_one` varchar(255) DEFAULT NULL,
  `ph_two` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT '0',
  `status` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `office_staff`
--

INSERT INTO `office_staff` (`id`, `user_name`, `password`, `register_date`, `delivery_name`, `delivery_nrc`, `registration_date`, `date_of_birth`, `photo`, `employment_date`, `address`, `ph_one`, `ph_two`, `role_id`, `status`) VALUES
(7, 'Abc', 'd41d8cd98f00b204e9800998ecf8427e', '2020-03-16 00:00:00', 'Abc', '12', '2020-03-16 00:00:00', '2020-03-16', 'images.png', '2020-03-16 00:00:00', '12312', '123', '123', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `online_shop`
--

CREATE TABLE `online_shop` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `ph_one` varchar(255) NOT NULL,
  `ph_two` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `online_shop`
--

INSERT INTO `online_shop` (`id`, `name`, `address`, `ph_one`, `ph_two`, `created_at`, `updated_at`) VALUES
(6, 'Curvy', 'Address', '12345678', '12345678', '2020-03-16 10:31:09', '2020-03-16 04:01:09');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `o_id` int(10) NOT NULL,
  `p_id` varchar(10) NOT NULL,
  `p_weight` varchar(100) NOT NULL,
  `p_expired_date` datetime DEFAULT NULL,
  `p_quantity` int(100) NOT NULL,
  `p_price_per_item` int(100) NOT NULL,
  `p_amount` int(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(50) NOT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `o_id`, `p_id`, `p_weight`, `p_expired_date`, `p_quantity`, `p_price_per_item`, `p_amount`, `created_at`, `user_id`, `updated_at`, `status`) VALUES
(3, 1, 'S0001', '', '2020-01-03 00:00:00', 2, 10000, 20000, '2020-03-06 14:50:44', 1, NULL, 0),
(4, 1, 'S0002', '-', '2020-03-12 00:00:00', 3, 12000, 36000, '2020-03-06 14:51:08', 1, NULL, 0),
(9, 2, 'TEST-01', '-', '2020-03-25 00:00:00', 1, 30000, 30000, '2020-03-06 15:37:51', 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `id` int(11) NOT NULL,
  `o_id` int(10) NOT NULL,
  `o_description` varchar(255) NOT NULL,
  `o_register_date` date NOT NULL,
  `o_register_time` datetime DEFAULT NULL,
  `o_remark` varchar(255) DEFAULT NULL,
  `o_amount_total` int(100) NOT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `user_id` int(100) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id`, `o_id`, `o_description`, `o_register_date`, `o_register_time`, `o_remark`, `o_amount_total`, `created_at`, `user_id`, `status`, `updated_at`) VALUES
(2, 1, 'testing', '2020-03-06', NULL, NULL, 69000, '2020-03-06 14:51:41.000000', 1, 0, NULL),
(4, 2, 'TESTING', '2020-03-06', NULL, NULL, 30000, '2020-03-06 15:37:51.000000', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_temp`
--

CREATE TABLE `order_temp` (
  `id` int(100) NOT NULL,
  `description` text,
  `reg` date DEFAULT NULL,
  `remark` text,
  `total_amount` int(100) DEFAULT NULL,
  `qty` int(100) DEFAULT NULL,
  `o_id` int(100) DEFAULT NULL,
  `p_id` varchar(100) DEFAULT NULL,
  `p_weight` varchar(100) DEFAULT NULL,
  `p_expire_date` date DEFAULT NULL,
  `price_per_item` int(100) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `user_id` int(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parcel`
--

CREATE TABLE `parcel` (
  `id` int(10) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `issue_date` date NOT NULL,
  `voucher_no` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL,
  `s_id` int(10) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_bank_acc` varchar(255) NOT NULL,
  `s_nrc_no` varchar(255) NOT NULL,
  `s_address` varchar(255) NOT NULL,
  `s_ph_one` varchar(255) NOT NULL,
  `s_ph_two` varchar(255) NOT NULL,
  `r_name` varchar(255) NOT NULL,
  `r_address` varchar(255) NOT NULL,
  `r_ph` varchar(255) NOT NULL,
  `p_cost` int(100) NOT NULL,
  `deli_fees` int(100) NOT NULL,
  `township_id` int(10) NOT NULL,
  `status` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postman`
--

CREATE TABLE `postman` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ph_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `postman_location`
--

CREATE TABLE `postman_location` (
  `id` int(11) NOT NULL,
  `postman_id` varchar(50) DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `lon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postman_location`
--

INSERT INTO `postman_location` (`id`, `postman_id`, `lat`, `created_at`, `updated_at`, `lon`) VALUES
(2, '3', '16.8248435', '2020-02-05 03:10:00', '2020-02-24 02:51:14', '96.1803764'),
(3, '5', '16.8240666', '2020-02-06 15:31:40', '2020-02-24 03:42:28', '96.1799015'),
(4, '7', '16.823994', '2020-02-07 03:59:26', '2020-02-23 04:36:56', '96.1798652'),
(5, '4', '16.8978178', '2020-02-07 06:38:30', '2020-02-10 09:59:50', '96.0993073'),
(7, '12', '16.7874535', '2020-02-08 07:44:01', '2020-02-21 05:58:22', '96.1597753'),
(8, '14', '16.8240275', '2020-02-11 13:14:01', '2020-02-24 03:49:09', '96.1798191'),
(9, '11', '16.8240126', '2020-02-13 03:22:29', '2020-02-13 03:22:55', '96.1799969'),
(10, '2', '16.816739', '2020-02-18 07:27:32', '2020-02-19 10:41:16', '96.1672996'),
(12, '1', '16.8079067', '2020-03-21 07:12:17', '2020-03-21 07:12:22', '96.17629'),
(13, '15', '16.8215431', '2020-03-22 05:58:34', NULL, '96.2063678');

-- --------------------------------------------------------

--
-- Table structure for table `postman_route`
--

CREATE TABLE `postman_route` (
  `id` int(10) NOT NULL,
  `township_id` int(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `postman_id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deliver_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `postman_route`
--

INSERT INTO `postman_route` (`id`, `township_id`, `status`, `postman_id`, `p_id`, `created_at`, `updated_at`, `deliver_date`) VALUES
(2327, 392, 0, 17, 1082, '2020-03-06 16:06:26', '2020-03-06 09:36:26', NULL),
(2328, 367, 0, 1, 8, '2020-03-21 01:56:45', '2020-03-21 01:56:45', NULL),
(2329, 367, 0, 1, 28, '2020-03-21 01:56:45', '2020-03-21 01:56:45', NULL),
(2330, 367, 0, 1, 54, '2020-03-21 01:56:45', '2020-03-21 01:56:45', NULL),
(2331, 400, 0, 1, 17, '2020-03-21 01:57:45', '2020-03-21 01:57:45', NULL),
(2332, 400, 0, 1, 24, '2020-03-21 01:57:45', '2020-03-21 01:57:45', NULL),
(2333, 400, 0, 1, 41, '2020-03-21 01:57:45', '2020-03-21 01:57:45', NULL),
(2334, 400, 0, 1, 42, '2020-03-21 01:57:45', '2020-03-21 01:57:45', NULL),
(2335, 400, 0, 1, 45, '2020-03-21 01:57:45', '2020-03-21 01:57:45', NULL),
(2336, 400, 0, 1, 52, '2020-03-21 01:57:45', '2020-03-21 01:57:45', NULL),
(2337, 400, 0, 1, 66, '2020-03-21 01:57:45', '2020-03-21 01:57:45', NULL),
(2338, 398, 0, 2, 16, '2020-03-21 01:58:35', '2020-03-21 01:58:35', NULL),
(2339, 398, 0, 2, 49, '2020-03-21 01:58:35', '2020-03-21 01:58:35', NULL),
(2340, 388, 0, 2, 9, '2020-03-21 01:59:04', '2020-03-21 01:59:04', NULL),
(2341, 388, 0, 2, 26, '2020-03-21 01:59:04', '2020-03-21 01:59:04', NULL),
(2342, 388, 0, 2, 57, '2020-03-21 01:59:04', '2020-03-21 01:59:04', NULL),
(2343, 401, 0, 5, 39, '2020-03-21 01:59:37', '2020-03-21 01:59:37', NULL),
(2344, 399, 0, 5, 27, '2020-03-21 02:00:09', '2020-03-21 02:00:09', NULL),
(2345, 399, 0, 5, 62, '2020-03-21 02:00:09', '2020-03-21 02:00:09', NULL),
(2346, 397, 0, 7, 2, '2020-03-21 02:01:21', '2020-03-21 02:01:21', NULL),
(2347, 397, 0, 7, 12, '2020-03-21 02:01:21', '2020-03-21 02:01:21', NULL),
(2348, 397, 0, 7, 14, '2020-03-21 02:01:21', '2020-03-21 02:01:21', NULL),
(2349, 397, 0, 7, 22, '2020-03-21 02:01:21', '2020-03-21 02:01:21', NULL),
(2350, 397, 0, 9, 19, '2020-03-21 02:01:45', '2020-03-21 02:01:45', NULL),
(2351, 397, 0, 9, 43, '2020-03-21 02:01:45', '2020-03-21 02:01:45', NULL),
(2352, 406, 0, 10, 13, '2020-03-21 02:03:22', '2020-03-21 02:03:22', NULL),
(2353, 406, 0, 10, 50, '2020-03-21 02:03:22', '2020-03-21 02:03:22', NULL),
(2354, 407, 0, 10, 23, '2020-03-21 02:03:43', '2020-03-21 02:03:43', NULL),
(2355, 406, 0, 10, 47, '2020-03-21 02:04:09', '2020-03-21 02:04:09', NULL),
(2356, 377, 0, 11, 44, '2020-03-21 02:04:30', '2020-03-21 02:04:30', NULL),
(2357, 377, 0, 11, 60, '2020-03-21 02:04:30', '2020-03-21 02:04:30', NULL),
(2358, 405, 0, 11, 40, '2020-03-21 02:04:57', '2020-03-21 02:04:57', NULL),
(2359, 405, 0, 11, 53, '2020-03-21 02:04:57', '2020-03-21 02:04:57', NULL),
(2360, 409, 0, 12, 3, '2020-03-21 02:07:00', '2020-03-21 02:07:00', NULL),
(2361, 409, 0, 12, 4, '2020-03-21 02:07:00', '2020-03-21 02:07:00', NULL),
(2362, 409, 0, 12, 46, '2020-03-21 02:07:00', '2020-03-21 02:07:00', NULL),
(2363, 404, 0, 12, 35, '2020-03-21 02:07:23', '2020-03-21 02:07:23', NULL),
(2364, 389, 0, 15, 6, '2020-03-21 02:19:52', '2020-03-21 02:19:52', NULL),
(2365, 389, 0, 15, 10, '2020-03-21 02:19:52', '2020-03-21 02:19:52', NULL),
(2366, 389, 0, 15, 59, '2020-03-21 02:19:52', '2020-03-21 02:19:52', NULL),
(2367, 379, 0, 16, 21, '2020-03-21 02:20:11', '2020-03-21 02:20:11', NULL),
(2368, 380, 0, 16, 1, '2020-03-21 02:20:27', '2020-03-21 02:20:27', NULL),
(2369, 380, 0, 16, 20, '2020-03-21 02:20:27', '2020-03-21 02:20:27', NULL),
(2370, 380, 0, 16, 61, '2020-03-21 02:20:27', '2020-03-21 02:20:27', NULL),
(2371, 381, 0, 16, 29, '2020-03-21 02:20:39', '2020-03-21 02:20:39', NULL),
(2372, 381, 0, 16, 33, '2020-03-21 02:20:39', '2020-03-21 02:20:39', NULL),
(2373, 382, 0, 16, 25, '2020-03-21 02:20:52', '2020-03-21 02:20:52', NULL),
(2374, 382, 0, 16, 37, '2020-03-21 02:20:52', '2020-03-21 02:20:52', NULL),
(2375, 382, 0, 16, 56, '2020-03-21 02:20:52', '2020-03-21 02:20:52', NULL),
(2376, 369, 0, 17, 18, '2020-03-21 02:48:26', '2020-03-21 02:48:26', NULL),
(2377, 369, 0, 17, 32, '2020-03-21 02:48:26', '2020-03-21 02:48:26', NULL),
(2378, 385, 0, 17, 7, '2020-03-21 02:48:44', '2020-03-21 02:48:44', NULL),
(2379, 386, 0, 17, 15, '2020-03-21 02:48:55', '2020-03-21 02:48:55', NULL),
(2380, 388, 0, 2, 68, '2020-03-21 02:52:09', '2020-03-21 02:52:09', NULL),
(2381, 388, 0, 2, 69, '2020-03-21 02:52:09', '2020-03-21 02:52:09', NULL),
(2382, 389, 0, 15, 67, '2020-03-21 02:52:35', '2020-03-21 02:52:35', NULL),
(2383, 387, 0, 17, 5, '2020-03-21 09:59:32', '2020-03-21 09:59:32', NULL),
(2384, 387, 0, 17, 63, '2020-03-21 09:59:32', '2020-03-21 09:59:32', NULL),
(2385, 387, 0, 17, 64, '2020-03-21 09:59:32', '2020-03-21 09:59:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(10) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `product_vendor_name` varchar(255) NOT NULL,
  `p_id` varchar(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_size`, `product_type`, `product_vendor_name`, `p_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Curvy', '-', 'WT-6-2XS-N / B', 'Curvy WT', 'S0001', 1, '2020-01-27 10:13:28.000000', '2020-02-07 06:58:17.000000'),
(3, 'Curvy', '-', 'WT-6-XS-N / B', 'Curvy WT', 'S0002', 1, '2020-01-27 10:13:52.000000', '2020-02-07 06:58:30.000000'),
(4, 'Curvy', '-', 'WT-6-S-N / B', 'Curvy WT', 'S0003', 1, '2020-01-27 10:15:03.000000', '2020-02-07 06:59:09.000000'),
(5, 'Curvy', '-', 'WT-6-M-N / B', 'Curvy WT', 'S0004', 1, '2020-01-27 10:15:35.000000', '2020-02-07 06:59:31.000000'),
(6, 'Curvy', '-', 'WT-6-L-N / B', 'Curvy WT', 'S0005', 1, '2020-01-27 10:26:49.000000', '2020-02-07 06:59:46.000000'),
(7, 'Curvy', '-', 'WT-6-XL-N / B', 'Curvy WT', 'S0006', 1, '2020-01-27 10:29:50.000000', '2020-02-07 07:00:40.000000'),
(8, 'Curvy', '-', 'WT-6-2XL-N / B', 'Curvy WT', 'S0007', 1, '2020-01-27 10:52:34.000000', '2020-02-07 07:01:36.000000'),
(9, 'Curvy', '-', 'WT-6-3XL-N / B', 'Curvy WT', 'S0008', 1, '2020-01-27 10:53:02.000000', '2020-02-07 07:03:42.000000'),
(10, 'Curvy', '-', 'WT-6-4XL-N / B', 'Curvy WT', 'S0009', 1, '2020-01-27 10:53:29.000000', '2020-02-07 07:05:15.000000'),
(11, 'Curvy', '-', 'WT-6-5XL-N / B', 'Curvy WT', 'S00010', 1, '2020-01-27 10:55:09.000000', '2020-02-07 07:05:31.000000'),
(12, 'Curvy', '-', 'WT-6-6XL-N / B', 'Curvy WT', 'S00011', 1, '2020-01-27 10:59:17.000000', '2020-02-07 07:05:55.000000'),
(13, 'Curvy', '-', 'WT-3-2XS-N / B', 'Curvy WT', 'T0001', 1, '2020-01-27 11:00:05.000000', '2020-02-07 07:07:55.000000'),
(14, 'Curvy', '-', 'WT-3-XS-N / B', 'Curvy WT', 'T0002', 1, '2020-01-27 11:00:26.000000', '2020-02-07 07:08:11.000000'),
(15, 'Curvy', '-', 'WT-3-S-N / B', 'Curvy WT', 'T0003', 1, '2020-01-27 11:00:48.000000', '2020-02-07 07:08:21.000000'),
(16, 'Curvy', '-', 'WT-3-M-N / B', 'Curvy WT', 'T0004', 1, '2020-01-27 11:01:08.000000', '2020-02-07 07:08:32.000000'),
(17, 'Curvy', '-', 'WT-3-L-N / B', 'Curvy WT', 'T0005', 1, '2020-01-27 11:03:42.000000', '2020-02-07 07:08:44.000000'),
(18, 'Curvy', '-', 'WT-3-XL-N / B', 'Curvy WT', 'T0006', 1, '2020-01-27 11:04:01.000000', '2020-02-07 07:08:56.000000'),
(19, 'Curvy', '-', 'WT-3-2XL-N / B', 'Curvy WT', 'T0007', 1, '2020-01-27 11:04:20.000000', '2020-02-07 07:09:09.000000'),
(20, 'Curvy', '-', 'WT-3-3XL-N / B', 'Curvy WT', 'T0008', 1, '2020-01-27 11:05:52.000000', '2020-02-07 07:10:22.000000'),
(21, 'Curvy', '-', 'WT-3-4XL-N / B', 'Curvy WT', 'T0009', 1, '2020-01-27 11:06:22.000000', '2020-02-07 07:10:39.000000'),
(22, 'Curvy', '-', 'WT-3-5XL-N / B', 'Curvy WT', 'T0010', 1, '2020-01-27 11:06:40.000000', '2020-02-07 07:11:20.000000'),
(23, 'Curvy', '-', 'WT-3-6XL-N / B', 'Curvy WT', 'T0011', 1, '2020-01-27 11:07:53.000000', '2020-02-07 07:11:31.000000'),
(24, 'Curvy', '-', 'WT-4AH-2XS-N / B', 'Curvy WT', 'F0001', 1, '2020-01-27 11:08:35.000000', '2020-02-07 07:11:44.000000'),
(25, 'Curvy', '-', 'WT-4AH-XS-N / B', 'Curvy WT', 'F0002', 1, '2020-01-27 11:08:54.000000', '2020-02-07 07:11:58.000000'),
(26, 'Curvy', '-', 'WT-4AH-S-N / B', 'Curvy WT', 'F0003', 1, '2020-01-27 11:09:48.000000', '2020-02-07 07:12:14.000000'),
(27, 'Curvy', '-', 'WT-4AH-M-N / B', 'Curvy WT', 'F0004', 1, '2020-01-27 11:10:10.000000', '2020-02-07 07:12:29.000000'),
(28, 'Curvy', '-', 'WT-4AH-L-N / B', 'Curvy WT', 'F0005', 1, '2020-01-27 11:10:33.000000', '2020-02-07 07:12:37.000000'),
(29, 'Curvy', '-', 'WT-4H-XL-N / B', 'Curvy WT', 'F0006', 1, '2020-01-27 11:11:04.000000', '2020-02-07 07:12:47.000000'),
(30, 'Curvy', '-', 'WT-4AH-2XL-N / B', 'Curvy WT', 'F0007', 1, '2020-01-27 11:11:53.000000', '2020-02-07 07:12:59.000000'),
(31, 'Curvy', '-', 'WT-4AH-3XL-N / B', 'Curvy WT', 'F0008', 1, '2020-01-27 11:12:38.000000', '2020-02-07 07:13:06.000000'),
(32, 'Curvy', '-', 'WT-4AH-4XL-N / B', 'Curvy WT', 'F0009', 1, '2020-01-27 11:14:49.000000', '2020-02-07 07:13:24.000000'),
(33, 'Curvy', '-', 'WT-4AH-5XL-N / B', 'Curvy WT', 'F0010', 1, '2020-01-27 11:15:12.000000', '2020-02-07 07:13:33.000000'),
(34, 'Curvy', '-', 'WT-4AH-6XL-N / B', 'Curvy WT', 'F0011', 1, '2020-01-27 11:15:26.000000', '2020-02-07 07:13:40.000000'),
(35, 'Curvy', '-', 'Arm-L', 'Curvy WT', 'A0002', 1, '2020-01-29 06:23:28.000000', NULL),
(36, 'Curvy', '-', 'Arm-M', 'Curvy WT', 'A0003', 1, '2020-01-29 06:23:57.000000', NULL),
(38, 'Curvy', '-', 'Arm-S', 'Curvy WT', 'A0005', 1, '2020-01-29 06:24:39.000000', NULL),
(39, 'Curvy', '-', 'Arm-XS', 'Curvy WT', 'A0006', 1, '2020-01-29 06:24:58.000000', NULL),
(40, 'Curvy', '-', 'Arm-2XS', 'Curvy WT', 'A0007', 1, '2020-01-29 06:29:55.000000', NULL),
(41, 'Curvy', '-', 'Arm-3XS', 'Curvy WT', 'A0008', 1, '2020-01-29 06:30:16.000000', NULL),
(52, 'Curvy', '-', 'WT-6AH-XXS-N / B', 'Curvy WT', 'SA-00001', 1, '2020-02-07 06:56:54.000000', '2020-02-07 07:13:52.000000'),
(53, 'CURVY', '-', 'WT-6AH-XS-N / B', 'Curvy WT', 'SA-00002', 1, '2020-02-07 06:57:33.000000', '2020-02-07 07:13:57.000000'),
(54, 'CURVY', '-', 'WT-6AH-S-N / B', 'Curvy WT', 'SA-0003', 1, '2020-02-07 07:15:24.000000', NULL),
(55, 'CURVY', '-', 'WT-6AH-M-N / B', 'Curvy WT', 'SA-00004', 1, '2020-02-07 07:15:53.000000', NULL),
(56, 'CURVY', '-', 'WT-6AH-L-N / B', 'Curvy WT', 'SA-00005', 1, '2020-02-07 07:16:25.000000', NULL),
(57, 'CURVY', '-', 'WT-6AH-XL-N / B', 'Curvy WT', 'SA-00006', 1, '2020-02-07 07:16:44.000000', NULL),
(58, 'CURVY', '-', 'WT-6AH-2XL-N / B', 'Curvy WT', 'SA-00007', 1, '2020-02-07 07:17:25.000000', NULL),
(59, 'CURVY', '-', 'WT-6AH-3XL-N / B', 'Curvy WT', 'SA-00008', 1, '2020-02-07 07:21:12.000000', NULL),
(60, 'CURVY', '-', 'WT-6AH-4XL-N / B', 'Curvy WT', 'SA-00009', 1, '2020-02-07 07:21:32.000000', NULL),
(61, 'CURVY', '-', 'WT-6AH-5XL-N / B', 'Curvy WT', 'SA-000010', 1, '2020-02-07 07:22:15.000000', NULL),
(62, 'CURVY', '-', 'WT-6AH-6XL-N / B', 'Curvy WT', 'SA-000011', 1, '2020-02-07 07:22:38.000000', NULL),
(63, 'CURVY', '-', 'MEN-XXS-N / B', 'Curvy WT', 'MEN00001', 1, '2020-02-07 07:23:20.000000', NULL),
(64, 'CURVY', '-', 'MEN-XS-N / B', 'Curvy WT', 'MEN00002', 1, '2020-02-07 07:23:37.000000', NULL),
(65, 'CURVY', '-', 'MEN-S-N / B', 'Curvy WT', 'MEN00003', 1, '2020-02-07 07:25:24.000000', NULL),
(66, 'CURVY', '-', 'MEN-M-N / B', 'Curvy WT', 'MEN00004', 1, '2020-02-07 07:25:46.000000', NULL),
(67, 'CURVY', '-', 'MEN-L-N / B', 'Curvy WT', 'MEN00005', 1, '2020-02-07 07:26:09.000000', NULL),
(68, 'CURVY', '-', 'MEN-XL-N / B', 'Curvy WT', 'MEN00006', 1, '2020-02-07 07:26:35.000000', NULL),
(69, 'CURVY', '-', 'MEN-XXL-N / B', 'Curvy WT', 'MEN00007', 1, '2020-02-07 07:27:02.000000', NULL),
(70, 'CURVY', '-', 'MEN-3XL-N / B', 'Curvy WT', 'MEN00008', 1, '2020-02-07 07:27:22.000000', NULL),
(71, 'CURVY', '-', 'MEN-4XL-N / B', 'Curvy WT', 'MEN00009', 1, '2020-02-07 07:27:38.000000', NULL),
(72, 'CURVY', '-', 'MEN-5XL-N / B', 'Curvy WT', 'MEN00010', 1, '2020-02-07 07:27:57.000000', NULL),
(73, 'CURVY', '-', 'MEN-6XL-N / B', 'Curvy WT', 'MEN00011', 1, '2020-02-07 07:28:38.000000', NULL),
(74, 'CURVY', '-', 'PT-XXS-N', 'Curvy WT', 'PT-00001', 1, '2020-02-07 07:29:11.000000', NULL),
(75, 'CURVY', '-', 'PT-XS-N', 'Curvy WT', 'PT-00002', 1, '2020-02-07 07:30:20.000000', NULL),
(76, 'CURVY', '-', 'PT-S-N', 'Curvy WT', 'PT-00003', 1, '2020-02-07 07:30:39.000000', NULL),
(77, 'CURVY', '-', 'PT-M-N', 'Curvy WT', 'PT-00004', 1, '2020-02-07 07:31:04.000000', NULL),
(78, 'CURVY', '-', 'PT-L-N', 'Curvy WT', 'PT-00005', 1, '2020-02-07 07:31:42.000000', NULL),
(80, 'Myanmar Glory', '-', 'Slippers', 'Myanmar Glory DIY Footwears', 'M-00001', 3, '2020-02-07 08:30:52.000000', NULL),
(81, 'ZZ OS', '-', 'Plastic Bags', 'ZZ fashion', 'Z-00001', 3, '2020-02-07 08:31:38.000000', NULL),
(82, 'Oppen', '-', 'Cosmetics', 'OPPEN OS', 'OP-00001', 3, '2020-02-07 08:32:11.000000', NULL),
(83, 'Hsu', '-', 'Blue Fiber Bag', 'Hsu Closet', 'HSU-00001', 3, '2020-02-07 08:33:57.000000', NULL),
(84, 'Daily Collection', '-', 'White Box', 'Daily Collection OS', 'D-0001', 3, '2020-02-07 08:34:46.000000', NULL),
(85, 'Luminous', '-', 'Plastic bags', 'luminious OS', 'L-00001', 3, '2020-02-07 08:38:56.000000', NULL),
(86, 'Fashion Corner', '-', 'Pink Bag', 'Fashion Corner', 'FC-00001', 3, '2020-02-07 08:39:40.000000', NULL),
(87, 'LS', '-', 'White bag', 'LS Onlineshop', 'LS-0001', 3, '2020-02-07 08:40:12.000000', NULL),
(88, 'LUNA', '0', 'Bag', 'LUNA OS', 'LU-0001', 3, '2020-02-07 08:47:29.000000', NULL),
(89, 'Snow Flake', '-', 'Bag', 'Hnin Pwint OS', 'Snow-00001', 3, '2020-02-07 08:48:17.000000', NULL),
(90, 'Authentic Triza', '0', 'bag', 'Authentic TRIZA OS', 'AT-0001', 3, '2020-02-07 08:48:54.000000', NULL),
(91, 'Role', '-', 'Black Bag', 'Role OS', 'R-0001', 3, '2020-02-07 09:05:19.000000', NULL),
(92, 'Mingalarpar LT', '-', 'Tickets', 'Mingalarpar LT', 'MT-00001', 3, '2020-02-07 12:02:33.000000', NULL),
(93, 'Other', '-', 'Plastic Pack', 'IntimeOS', 'OT-0001', 3, '2020-02-08 03:12:28.000000', NULL),
(94, 'Kirin Invitation', '-', 'Bag', 'IntimeOS', 'K-00001', 3, '2020-02-08 03:30:26.000000', NULL),
(95, 'Moe', '-', 'Plastic Box', 'Moe Online', 'Moe-00001', 3, '2020-02-10 03:07:51.000000', NULL),
(96, 'EI Thazin Chaw', '-', 'Cosmetics', 'EI Thazin Chaw', 'COS-00001', 3, '2020-02-23 11:10:48.000000', NULL),
(97, 'Luminous', '-', 'Plastic bags', 'Luminous Fashion', 'LM-0001', 3, '2020-02-24 03:30:10.000000', NULL),
(98, 'Test product', '11', 'Test', 'TEST Vendor', 'TEST-01', 1, '2020-03-06 14:09:17.000000', '2020-03-06 14:09:37.000000'),
(99, 'Mo Mo', '0', 'Closet', 'Mo Mo', '007', 3, '2020-03-20 18:54:50.000000', NULL),
(100, 'Chan Closet', '0', 'Closet', 'ChanCloset', '009', 3, '2020-03-21 01:57:08.000000', NULL),
(101, 'Noe Noe Aung', '0', 'Cosmetic', 'Noe Noe Aung', '0090', 3, '2020-03-21 02:07:21.000000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `route_plan`
--

CREATE TABLE `route_plan` (
  `id` int(11) NOT NULL,
  `division` int(100) NOT NULL,
  `township` int(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `target_date` date NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `target_time` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `status` int(5) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `r_name` varchar(100) NOT NULL,
  `customer_confirm_status` int(10) NOT NULL DEFAULT '2',
  `remark` text,
  `parcel_status` int(10) DEFAULT '0',
  `foc` int(100) NOT NULL DEFAULT '0',
  `issue_type` int(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `route_plan`
--

INSERT INTO `route_plan` (`id`, `division`, `township`, `address`, `quantity`, `amount`, `product_id`, `target_date`, `reg_date`, `target_time`, `user_id`, `status`, `created_at`, `updated_at`, `phone`, `r_name`, `customer_confirm_status`, `remark`, `parcel_status`, `foc`, `issue_type`) VALUES
(1, 13, 380, 'No.154 ဖိုး၀ဇီယာလမ္း ၃၉ Bရပ္ကြက္ မဒဂံု', 1, 0, 99, '2020-03-21', '2020-03-20 19:10:30', '01 : 30', 3, 2, '2020-03-20 19:10:30', NULL, 'ံ09972702969', 'မဖူးဖူးခိုင္', 2, '-', 0, 0, 0),
(2, 13, 397, 'ပုပါးၿမိဳ့ကားဂိတ္', 1, 0, 99, '2020-03-21', '2020-03-20 19:15:55', '01 : 40', 3, 2, '2020-03-20 19:15:55', NULL, '09966830509', 'အိၿမတ္ခိုင္', 2, '-', 0, 0, 0),
(3, 13, 409, 'No.155 Alone st & Ayarwady st', 1, 13500, 81, '2020-03-21', '2020-03-20 19:18:38', '00 : 46', 3, 2, '2020-03-20 19:18:38', NULL, '9968363904', 'Ma Ei Thazin Phyu', 0, '-', 0, 0, 0),
(4, 13, 409, 'No.155 Alone st & Ayarwady st', 1, 13500, 81, '2020-03-21', '2020-03-20 19:18:38', '00 : 46', 3, 2, '2020-03-20 19:18:38', NULL, '9968363904', 'Ma Ei Thazin Phyu', 0, '-', 1, 0, 0),
(5, 13, 387, '46 st bo1000 ကုန္သည္လမ္းဘက္', 1, 12800, 81, '2020-03-21', '2020-03-20 19:20:52', '01 : 48', 3, 2, '2020-03-20 19:20:52', NULL, '9421027435', 'Ma Hnin Hnin', 2, '-', 0, 0, 0),
(6, 13, 389, 'No.403 Condo  f Kabaraye Belar', 1, 16200, 81, '2020-03-21', '2020-03-20 19:23:12', '01 : 50', 3, 2, '2020-03-20 19:23:12', NULL, '9447689146', 'Ma MAY Zuu', 0, '-', 0, 0, 0),
(7, 13, 385, 'တိုက်14.6လွှာရွှေဘုန်းပွငွဘုရားလမ်း', 1, 61000, 99, '2020-03-21', '2020-03-20 19:24:12', '01 : 51', 3, 2, '2020-03-20 19:24:12', NULL, '09792426651', 'မခိုင်ပြည့်ဝန်း', 2, '-', 0, 0, 0),
(8, 13, 367, 'Build 11 Room 56 Pyayyeinkmon housing Kamaryaut', 1, 20100, 81, '2020-03-21', '2020-03-20 19:24:56', '01 : 53', 3, 2, '2020-03-20 19:24:56', NULL, '9786671737', 'Ma Mon Mon Aung', 2, '-', 0, 0, 0),
(9, 13, 388, 'Sedona Hotel', 1, 20200, 81, '2020-03-21', '2020-03-20 19:26:49', '01 : 54', 3, 2, '2020-03-20 19:26:49', NULL, '9254061335', 'Ma Gu Gu', 2, '-', 0, 0, 0),
(10, 13, 389, 'No,27 ဘုရင့္ေနာင္လမ္း ျကီးပြားေရးေျမာက္ပိိုင္း', 1, 15100, 81, '2020-03-21', '2020-03-20 19:29:59', '01 : 56', 3, 2, '2020-03-20 19:29:59', NULL, '9420081558', 'Ma Tee Tee Lay', 0, '-', 0, 0, 0),
(11, 13, 392, 'တာမွေ47လမ်းသီတာမှတ်တိုင်အနီး', 1, 9000, 99, '2020-03-21', '2020-03-20 19:30:17', '01 : 58', 3, 1, '2020-03-20 19:30:17', NULL, '09767097258', 'Htwe Ei Yamin', 2, '-', 0, 0, 0),
(12, 13, 397, 'သံဖြူဇရပ်ကားဂိတ်', 1, 0, 99, '2020-03-21', '2020-03-20 19:31:47', '02 : 00', 3, 2, '2020-03-20 19:31:47', NULL, '09255975246', 'ပြည့်ဖြိုးယံ', 2, '-', 0, 0, 0),
(13, 13, 406, '10 ေတာင္ 12 ရပ္ကြက္သာလာ၀တီ 8 လမ္း သေကတ', 1, 45300, 81, '2020-03-21', '2020-03-20 19:35:08', '02 : 02', 3, 2, '2020-03-20 19:35:08', NULL, '9797970138', 'Ma Phwe Phwe`', 2, '-', 0, 0, 0),
(14, 13, 397, 'မြစ်ကြီးနာမြို့သစ်', 1, 0, 99, '2020-03-21', '2020-03-20 19:35:29', '02 : 01', 3, 2, '2020-03-20 19:35:29', NULL, '09795528246', 'Kyi Htwe Nge', 2, '-', 0, 0, 0),
(15, 13, 386, 'No. 78 Lower bLOCK 27 ST', 1, 51100, 81, '2020-03-21', '2020-03-20 19:37:01', '02 : 05', 3, 2, '2020-03-20 19:37:01', NULL, '9795339624', 'Ma Nu Nu Yi', 2, '-', 0, 0, 0),
(16, 13, 398, 'အမှတ်15တပ်မြေမိုးကောင်းလမ်း ဘောက်ထော်ရန', 1, 0, 99, '2020-03-21', '2020-03-20 19:38:29', '02 : 05', 3, 2, '2020-03-20 19:38:29', NULL, '09783535840', 'စောယဥ်အေး', 2, '-', 0, 0, 0),
(17, 13, 400, 'Baho St build 96 Hladen', 1, 22300, 81, '2020-03-21', '2020-03-20 19:38:33', '02 : 07', 3, 2, '2020-03-20 19:38:33', NULL, '9974421171', 'Ma Wai Lwin Maw', 2, '-', 0, 0, 0),
(18, 13, 369, 'အခန်း၃၀၃ ၃လွှာMGWCente​ဗိုအောျော်လမ်အောက်လောက်', 1, 16000, 99, '2020-03-21', '2020-03-20 19:41:39', '02 : 08', 3, 2, '2020-03-20 19:41:39', NULL, '09250640317', 'ထက်နောင်ကျော်ဗိုဗို', 2, '-', 0, 0, 0),
(19, 13, 397, '31,70*71ၾကား Mdy', 1, 7500, 99, '2020-03-21', '2020-03-20 19:44:42', '02 : 08', 3, 2, '2020-03-20 19:44:42', NULL, '09965126996', 'Eaint Myat Hmuu', 2, '-', 0, 0, 0),
(20, 13, 380, 'North Dangon no. 956 sata st 38 Qtu', 1, 39900, 81, '2020-03-21', '2020-03-20 19:45:52', '01 : 45', 3, 2, '2020-03-20 19:45:52', NULL, '458477327', 'Hk Cing', 2, '-', 0, 0, 0),
(21, 13, 379, 'ေတာင္ဒဂံု 107 ေက်ာင္းလမ္းမွတ္တိုင္', 1, 25999, 99, '2020-03-21', '2020-03-20 19:46:45', '02 : 14', 3, 2, '2020-03-20 19:46:45', NULL, '09693005298', 'Myat Yati Htet', 2, '-', 0, 0, 0),
(22, 13, 397, 'ပဲခူးတိုင္း ေဇယ်၀တီျမိဳ့ကားဂိတ္', 1, 0, 99, '2020-03-21', '2020-03-20 19:49:12', '02 : 16', 3, 2, '2020-03-20 19:49:12', NULL, '09252559841', 'မေမသူေက်ာ္', 2, '-', 0, 0, 0),
(23, 13, 407, 'D 42 Minyekyawswar st yontaw Qut Thanlyun', 1, 47200, 81, '2020-03-21', '2020-03-20 19:49:52', '02 : 15', 3, 2, '2020-03-20 19:49:52', NULL, '9965446142', 'Ma May Thu Nwe', 2, '-', 0, 0, 0),
(24, 13, 400, 'လိွုင္ျမင့္မိုရ္ အိမ္ယာ 1လမ္း', 1, 13600, 99, '2020-03-21', '2020-03-20 19:51:03', '02 : 19', 3, 2, '2020-03-20 19:51:03', NULL, '09254716196', 'မအိအိ', 2, '-', 0, 0, 0),
(25, 13, 382, 'YuzanaGarden city 93 Qut May Yu st No.183', 1, 30900, 81, '2020-03-21', '2020-03-20 19:53:22', '02 : 19', 3, 2, '2020-03-20 19:53:22', NULL, '9675946142', 'Ma May Tyu Htet', 2, '-', 0, 0, 0),
(26, 13, 388, 'ဥသဖယားလမ္းက်ိုကဆံရပ္ကြက္။ဗဟန္း', 1, 22800, 99, '2020-03-21', '2020-03-20 19:54:05', '02 : 21', 3, 2, '2020-03-20 19:54:05', NULL, '0979842260', 'Ma Mu Cus May', 2, '-', 0, 0, 0),
(27, 13, 399, 'Shwepyitar Tandin KAbarloon BusStop', 1, 23000, 81, '2020-03-21', '2020-03-20 19:55:45', '02 : 23', 3, 2, '2020-03-20 19:55:45', NULL, '978137375', 'Ma WAddy Than', 2, '-', 0, 0, 0),
(28, 13, 367, 'No.615Pyay road KaMaryoot Marlar bus stop', 1, 6500, 81, '2020-03-21', '2020-03-20 19:58:24', '02 : 24', 3, 2, '2020-03-20 19:58:24', NULL, '09792447589', 'Ma Nway Nway', 2, '-', 0, 0, 0),
(29, 13, 381, 'No.10184 Ingin st 130 Qut East DAgon', 1, 31300, 81, '2020-03-21', '2020-03-20 19:59:30', '02 : 25', 3, 2, '2020-03-20 19:59:30', NULL, '25541741', 'Daw Toon Lay', 2, '-', 0, 0, 0),
(30, 13, 390, '15/413 စကိုင္းလမ္း။ေရ ႊေပါက္ကံ', 1, 23800, 81, '2020-03-21', '2020-03-20 20:01:41', '02 : 29', 3, 1, '2020-03-20 20:01:41', NULL, '0450032485', 'Ma KHin Khin Aye', 2, '-', 0, 0, 0),
(31, 13, 391, 'No 84သတိပဌာန္းလမ္းေက်ာက္ေျမာင္း', 1, 8200, 81, '2020-03-21', '2020-03-20 20:05:25', '02 : 28', 3, 1, '2020-03-20 20:05:25', NULL, '09427774030', 'ခိုင္ပန့္မို့သြင္', 2, '-', 0, 0, 0),
(32, 13, 369, 'East Insein zay Maharmyin st Thiri Yanada School', 1, 14700, 81, '2020-03-21', '2020-03-20 20:05:25', '02 : 31', 3, 2, '2020-03-20 20:05:25', NULL, '9424539396', 'Ma May Myat noe', 2, '-', 0, 0, 0),
(33, 13, 381, 'အမွတ္ 190 ရာဇသၿကၤန္လမ္းဒဂံုအေရွ့', 1, 14300, 81, '2020-03-21', '2020-03-20 20:07:32', '02 : 35', 3, 2, '2020-03-20 20:07:32', NULL, '09673785383', 'Ma Pyone Cho', 2, '-', 0, 0, 0),
(34, 13, 392, 'အမွတ္31 ပတျမားလမ္းျမန္မာ့ဂုက္ေရာင္အိမ္ယာတာေမြ', 1, 7600, 81, '2020-03-21', '2020-03-20 20:10:30', '02 : 37', 3, 1, '2020-03-20 20:10:30', NULL, '09785125565', 'ႊTin Tin Win', 2, '-', 0, 0, 0),
(35, 13, 404, 'No.96 13 ST Lamadaw', 1, 11000, 81, '2020-03-21', '2020-03-20 20:10:45', '02 : 38', 3, 2, '2020-03-20 20:10:45', NULL, '95102534', 'Ma Pot Pot', 0, '-', 1, 0, 0),
(36, 13, 384, 'အမွတ္ 66 ရြာမလမ္း သေဘၤာက်င္း ေဒါပံု', 1, 9200, 81, '2020-03-21', '2020-03-20 20:13:19', '02 : 40', 3, 1, '2020-03-20 20:13:19', NULL, '09692270855', 'Ma Flower Ma Lay', 2, '-', 0, 0, 0),
(37, 13, 382, 'Dagon Seinken 87 Qut Inwa stNo,795 A', 1, 12100, 81, '2020-03-21', '2020-03-20 20:13:26', '02 : 40', 3, 2, '2020-03-20 20:13:26', NULL, '9422373047', 'Ma Khin Thu', 2, '-', 0, 0, 0),
(38, 13, 390, 'North Okkalar oozenar11 st', 1, 7200, 81, '2020-03-21', '2020-03-20 20:15:30', '02 : 43', 3, 1, '2020-03-20 20:15:30', NULL, '9449528854', 'Ma Maythi ngyon Soe', 2, '-', 0, 0, 0),
(39, 13, 401, 'ေရြွလင္ပန္းတန္ဖိုးနည္းအိမ္ယာလိွုင္သာယာတိုက္ 32 အခန္း006ေျမညီထပ္', 1, 20400, 81, '2020-03-21', '2020-03-20 20:16:18', '02 : 43', 3, 2, '2020-03-20 20:16:18', NULL, '09788626891', 'လမင္းမယ္', 2, '-', 0, 0, 0),
(40, 13, 405, 'C/248ေလးေထာင့္ကန္လမ္းေျမာက္ရပ္ကြက္ သဃၤန္းက်ြန္း', 1, 13400, 81, '2020-03-21', '2020-03-20 20:19:05', '02 : 46', 3, 2, '2020-03-20 20:19:05', NULL, '09421013901', 'Ma Aye Aye', 2, '-', 0, 0, 0),
(41, 13, 400, 'အမွတ္ 31 ပါရမီလမ္း 16 ရပ္ကြက္ လိုွင္ျမို့', 1, 7200, 81, '2020-03-21', '2020-03-20 20:21:53', '02 : 49', 3, 2, '2020-03-20 20:21:53', NULL, '0925434506', 'TinNi Lar Kyaw', 2, '-', 0, 0, 0),
(42, 13, 400, 'လွိုူင္ျမို့နယ္ ဘူတာရံုလမ္း ဘု၇င့္ေနာင္လမ္း', 1, 14600, 81, '2020-03-21', '2020-03-20 22:06:38', '02 : 51', 3, 2, '2020-03-20 22:06:38', NULL, '09778175292', 'Ma Thet Htar', 2, '-', 0, 0, 0),
(43, 13, 397, '20/426ပုဂံလမ္းေရြွေပါက္ကံ', 1, 70800, 81, '2020-03-21', '2020-03-20 22:08:44', '04 : 36', 3, 2, '2020-03-20 22:08:44', NULL, '09261590216', 'Ma Hay Mar', 2, '-', 0, 0, 0),
(44, 13, 377, 'စံျပ5လမ္း သဃၤန္းကြ်န္းစံျပေစ်းအနီး', 1, 28400, 81, '2020-03-21', '2020-03-20 22:11:23', '04 : 38', 3, 2, '2020-03-20 22:11:23', NULL, '09692324792', 'Ma May May Nilar', 2, '-', 0, 0, 0),
(45, 13, 400, 'No 5B စစ္ကိုင္ းလမ္းျမကန္သာဥယ်ာဥ္အိမ္ယာ', 1, 170500, 81, '2020-03-21', '2020-03-20 22:14:45', '04 : 41', 3, 2, '2020-03-20 22:14:45', NULL, '09450020688', 'Ma Tinni Lar', 2, '-', 0, 0, 0),
(46, 13, 409, '103/6H B သိပံလမ္း', 1, 9000, 81, '2020-03-21', '2020-03-20 22:17:22', '04 : 44', 3, 2, '2020-03-20 22:17:22', NULL, '09250516870', 'Ma Aye Pwint', 0, '-', 0, 0, 0),
(47, 13, 406, 'အမွတ္ 17 မာန္ေျပ5လမ္းအေနာက္ 2 ေတာင္ရပ္ကြက္သာေကတ', 1, 22500, 81, '2020-03-20', '2020-03-20 22:21:04', '04 : 47', 3, 2, '2020-03-20 22:21:04', NULL, '09699868613', 'Ma Khaing ThaZin Naing', 2, '-', 0, 0, 0),
(48, 13, 370, 'Crystle To,wer Junction Square', 1, 9600, 81, '2020-03-21', '2020-03-20 22:24:08', '04 : 51', 3, 1, '2020-03-20 22:24:08', NULL, '09797544706', 'Ma Myo Thiri Aung', 2, '-', 0, 0, 0),
(49, 13, 398, 'အမွတ္ 1 သမာဓိလမ္း 14ရပ္ကြက္ရန္ကင္းအေနာက္ေပါက္', 1, 36200, 81, '2020-03-21', '2020-03-20 22:27:20', '04 : 54', 3, 2, '2020-03-20 22:27:20', NULL, '09253248289', 'Ma Khin Sandar Maw', 2, '-', 0, 0, 0),
(50, 13, 406, 'အမွတ္ 13/7 ထူပာရံုး 8လမ္းထိပ္', 1, 13600, 81, '2020-03-21', '2020-03-20 22:29:52', '04 : 57', 3, 2, '2020-03-20 22:29:52', NULL, '0997057649', 'Ma Thidar Htay', 2, '-', 0, 0, 0),
(51, 13, 375, 'No 27.7Aေအာင္သေျပလမ္း', 1, 8100, 81, '2020-03-21', '2020-03-20 22:31:58', '04 : 59', 3, 1, '2020-03-20 22:31:58', NULL, '0943180865', 'မသူသူညီသိန္း', 2, '-', 0, 0, 0),
(52, 13, 400, 'Malarmyint 8st No,21 Hlaing', 1, 16100, 81, '2020-03-21', '2020-03-20 22:41:56', '05 : 09', 3, 2, '2020-03-20 22:41:56', NULL, '259930748', 'Ma Zar Zar', 2, '-', 0, 0, 0),
(53, 13, 405, 'No,24 U Yuu st Yadana Tiri Houing zawana BUS STOP', 1, 19500, 81, '2020-03-21', '2020-03-20 22:46:27', '05 : 11', 3, 2, '2020-03-20 22:46:27', NULL, '95010356', 'Ma Nge Thar', 2, '-', 0, 0, 0),
(54, 13, 367, 'Bayint Naung 12st, Building 242, 5B', 1, 9200, 81, '2020-03-21', '2020-03-20 22:48:45', '05 : 16', 3, 2, '2020-03-20 22:48:45', NULL, '420079335', 'Ma Myat Lay', 2, '-', 0, 0, 0),
(55, 13, 392, 'No.24 26 Tamwe South  Horse st', 1, 8000, 81, '2020-03-21', '2020-03-20 22:55:33', '05 : 18', 3, 1, '2020-03-20 22:55:33', NULL, '450006981', 'Khaing Wai Lwin Soe', 2, '-', 0, 1, 0),
(56, 13, 382, 'No.11 KounArt MinTar st Zon 1', 1, 13000, 81, '2020-03-21', '2020-03-20 22:57:55', '05 : 25', 3, 2, '2020-03-20 22:57:55', NULL, '9254499603', 'Ma Khin Zar', 2, '-', 0, 0, 0),
(57, 13, 388, 'No.7 NayThuLwin st', 1, 23000, 81, '2020-03-21', '2020-03-20 23:00:12', '05 : 27', 3, 2, '2020-03-20 23:00:12', NULL, '9260209297', 'Ma Thida', 2, '-', 0, 0, 0),
(58, 13, 391, 'Build 7 ROOM 7 Myawady Housing', 1, 7000, 81, '2020-03-21', '2020-03-20 23:32:12', '05 : 30', 3, 1, '2020-03-20 23:32:12', NULL, '9799669739', 'Ma in Pa Pa Phyo', 2, '-', 0, 0, 0),
(59, 13, 389, '386 THAMAINE', 1, 13000, 81, '2020-03-21', '2020-03-20 23:34:39', '06 : 02', 3, 2, '2020-03-20 23:34:39', NULL, '943075138', 'Ma MayThwe Khin', 0, '-', 1, 0, 0),
(60, 13, 377, 'KaTuMarLar 4 Qtu No.7', 1, 16000, 81, '2020-03-21', '2020-03-20 23:37:28', '06 : 04', 3, 2, '2020-03-20 23:37:28', NULL, '425064814', 'Ma Zin Mar', 2, '-', 0, 0, 0),
(61, 13, 380, 'No.200 b SatMu 3 St North DAGON', 1, 34300, 81, '2020-03-21', '2020-03-20 23:39:33', '06 : 07', 3, 2, '2020-03-20 23:39:33', NULL, '786423616', 'Ma La Min', 2, '-', 0, 0, 0),
(62, 13, 399, '128 b ShweJoePyu 3 st 7 Qut Shwepyitar', 1, 35200, 81, '2020-03-21', '2020-03-20 23:41:45', '06 : 09', 3, 2, '2020-03-20 23:41:45', NULL, '950400688', 'Ma Phyo Phyo', 2, '-', 0, 0, 0),
(63, 13, 387, 'No,64 Bo 1000', 1, 16000, 81, '2020-03-21', '2020-03-20 23:43:35', '06 : 11', 3, 2, '2020-03-20 23:43:35', NULL, '5049746', 'Ma Ma Phyo', 2, '-', 0, 0, 0),
(64, 13, 387, 'No.4 Room 002 1 FALOOR NayjarTharyarkone st Bo 1000', 1, 11100, 81, '2020-03-21', '2020-03-20 23:47:00', '06 : 13', 3, 2, '2020-03-20 23:47:00', NULL, '252676568', 'Ma Htike', 0, '-', 0, 0, 0),
(65, 13, 391, 'No.118 MaHaTuka st Kyitaw Qut', 1, 9200, 81, '2020-03-21', '2020-03-20 23:48:57', '06 : 17', 3, 1, '2020-03-20 23:48:57', NULL, '42040310', 'Ma Ei Lay', 2, '-', 0, 0, 0),
(66, 13, 400, '12 Qtu Hlaing', 1, 39400, 81, '2020-03-21', '2020-03-20 23:50:25', '06 : 18', 3, 2, '2020-03-20 23:50:25', NULL, '420148767', 'Ma Lat Latt', 2, '-', 0, 0, 0),
(67, 13, 389, 'BPI Saywarsatyod Thamine Lansone Yut compus b-block', 1, 21500, 100, '2020-03-21', '2020-03-21 02:01:48', '08 : 27', 3, 2, '2020-03-21 02:01:48', NULL, '972740067', 'Aye Chan Myae', 0, '-', 0, 0, 0),
(68, 13, 388, 'No, 110 Uniyeinktarlantat USA Bahan', 1, 15000, 101, '2020-03-21', '2020-03-21 02:13:45', '08 : 37', 3, 2, '2020-03-21 02:13:45', NULL, '9790644270', 'Ma Nan Htike Aung', 2, '-', 0, 0, 0),
(69, 13, 388, 'No,1 5 floor USA Bahan', 1, 30000, 101, '2020-03-21', '2020-03-21 02:16:40', '08 : 43', 3, 2, '2020-03-21 02:16:40', NULL, '43073350', 'Ma Jelly', 2, '-', 0, 0, 0),
(70, 13, 404, '4 လႊာ၊နံပါတ္ 69 ဂ လမ္း၊လမ္းမေတာ္ၿမိဳ႕', 1, 35000, 24, '2020-03-22', '2020-03-21 04:01:54', '10 : 30', 1, 0, '2020-03-21 04:01:54', NULL, '9899043399', 'Phoo Pwint Han', 2, '-', 0, 0, 0),
(71, 13, 401, '\"အမွတ္ 28/ခ မႏၱေလးလမ္း၊သခင္ျမလမ္း 113 ရပ္ကြက္၊ပင္လံုေစ်းအနီး၊၀ိုင္း၀ိုင္းလည္ ဆန္ဆိုင္ လိႈင္သာယာ \"', 1, 35000, 25, '2020-03-22', '2020-03-21 04:43:32', '10 : 31', 1, 0, '2020-03-21 04:43:32', NULL, '\"0945000045 09420065412\"', 'Pa Lynn', 2, '-', 0, 0, 0),
(72, 13, 391, 'အမွတ္ 261 96 လမ္း၊မဂၤလာေတာင္ညႊန္႕', 1, 35000, 25, '2020-03-22', '2020-03-21 05:26:58', '11 : 13', 1, 0, '2020-03-21 05:26:58', NULL, '9777314356', 'Zayar May', 2, '-', 0, 0, 0),
(73, 13, 404, 'Lamadaw township, Yangon. New yangon general hospital.', 1, 40000, 4, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09254539095', 'Aye Myat Mu', 2, NULL, 0, 0, 0),
(74, 13, 410, 'Gyogone bus stop, corner of Shwemarlar st. Inesin\nၾကို႕ကုန္းမွတ္တိုင္ေရာက္ရင္ဖုနးဆက္ေပးရန္။', 1, 40000, 26, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09968999161', 'May Thu Thu Mon', 2, NULL, 0, 0, 0),
(75, 13, 389, 'No 52.A သာယာကုန္းရွမ္းရြာလမ္း A7 မရမ္းကုန္း', 1, 40000, 54, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09798382889', 'Yoon Lay', 2, NULL, 0, 0, 0),
(76, 13, 399, 'ေရႊျပည္သာ လ ၀ က ရံုး', 1, 29000, 77, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09775497804', 'Htet', 2, NULL, 0, 0, 0),
(77, 13, 375, 'City Mart အနား၊ျပည္လမ္း၊ေျမနီကုန္း', 1, 40000, 4, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '0943126323', 'Su Su Htwe', 2, NULL, 0, 0, 0),
(78, 13, 375, 'City Mart အနား၊ျပည္လမ္း၊ေျမနီကုန္း', 1, 19000, 36, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '0943126323', 'Su Su Htwe', 2, NULL, 0, 0, 0),
(79, 13, 387, 'Mon to Fri -ဗိုလ္ျမတ္ထြန္းလမ္းနဲ႔ကုန္သည္လမ္းေထာင့္၊(၁၂)ထပ္ခြဲ၊စည္ပင္ရံုးေရွ႕။\nSat & Sun -ေျမနီကုန္း၊ဓမၼၾရံုလမ္း၊အမွတ္(26/56)5လႊာ။', 2, 29000, 77, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09448048696', 'Khinhninthet', 2, NULL, 0, 0, 0),
(80, 13, 391, 'No 29 ပထမထပ္၊ပုသိမ္ညႊန္႕ ၇ လမ္း၊ပုသိမ္ညႊန္႕ရပ္ကြက္၊မဂၤလာေတာင္ညႊန္႕', 1, 40000, 4, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09950353797', 'Khinnanther', 2, NULL, 0, 0, 0),
(81, 13, 367, 'အမွတ္ 47၊စံရိပ္ၿငိမ္ ၆ လမ္း၊ကမာရြက္', 1, 19000, 38, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '095104252', 'Will Theint Theint Zaw', 2, NULL, 0, 0, 0),
(82, 13, 401, '362 ေအာင္ေျမသာယာဘုရားလမ္း 6 ရပ္ကြက္၊လိႈင္သာယာ', 1, 29000, 79, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '095178559', 'Jewel Minn', 2, NULL, 0, 0, 0),
(83, 13, 390, 'No.3A,4 Floor ဥဇနာ ၉ လမ္း၊ေျမာက္ဥကၠလာပၿမိဳ႕နယ္', 1, 40000, 4, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09421175294', 'Mayflower', 2, NULL, 0, 0, 0),
(84, 13, 370, '67 ဗိုလ္သူရလမ္း၊ၾကည့္ျမင္တိုင္', 1, 40000, 4, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09250075054', 'Than Than', 2, NULL, 0, 0, 0),
(85, 13, 391, 'Nang Yein Hom .No 72 3rd Fioor 124th Street,upper block,Mingalar Taung Nyunt,Yangon', 1, 40000, 3, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09402619310', 'Ariel Yein', 2, NULL, 0, 0, 0),
(86, 13, 390, 'အမွတ္ 31 အာသာ၀တီလမ္း၊ေျမာက္ဥကၠလာဘုန္းႀကီးလမ္းမွတ္တိုင္', 1, 29000, 75, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09794592144/09977827838', 'Thae Myat Noe', 2, NULL, 0, 0, 0),
(87, 13, 398, 'တိုက္ ၇ အခန္း ၁ ၀ါ၀ါ၀င္းအိမ္ယာ၊ရန္ကင္း', 1, 29000, 77, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09951058553', 'Mo Mo Win Tin', 2, NULL, 0, 0, 0),
(88, 13, 367, 'အမွတ္ 336၊၀င္းေသာ္တာလမ္း၊လွည္းတန္းကမာရြက္', 1, 19000, 40, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '0943082493', 'May Thuzar Han', 2, NULL, 0, 0, 0),
(89, 13, 386, '103,105 ပထမထပ္ မင္းသုခေရႊဆိုင္၊ပန္းဘဲတန္းၿမိဳ႕နယ္', 1, 29000, 75, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '0979677639', 'Sandar Win Aye', 2, NULL, 0, 0, 0),
(90, 13, 375, 'အမွတ္ 763၊သံတံတားလမ္း၊စမ္းေခ်ာင္း', 1, 40000, 53, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09791800985/09761571203', 'Alex Suyee', 2, NULL, 0, 0, 0),
(91, 13, 382, '3/11 လမ္း၊တိုက္ 24 အခန္း 201၊ယုဇနဥယာဥ္ၿမိဳ႕ေတာ္၊ရန္ကုန္', 1, 40000, 2, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09776648040', 'Maytlin Htike', 2, NULL, 0, 0, 0),
(92, 13, 479, 'အမွတ္ 15၊ေမတၱာလမ္းႀကံခင္းစုရပ္ကြက္၊မဂၤလာဒံုၿမိဳ႕နယ္', 1, 29000, 75, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09422190543', 'Lovely Moe', 2, NULL, 0, 0, 0),
(93, 13, 392, '785,ZayathuKha st,Myitarnyuut Qrt ,Tamwe', 1, 29000, 75, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09979315355', 'April', 2, NULL, 0, 0, 0),
(94, 13, 406, 'အမွတ္ 255 ၿမိဳ႕မ၊12 လမ္း၊အလယ္ 41 ေျမာက္သာေကတ', 1, 29000, 75, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09422834696', 'ထက္ထက္', 2, NULL, 0, 0, 0),
(95, 13, 406, 'အမွတ္ 255 ၿမိဳ႕မ၊12 လမ္း၊အလယ္ 41 ေျမာက္သာေကတ', 1, 29000, 79, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09422834696', 'ထက္ထက္', 2, NULL, 0, 0, 0),
(96, 13, 479, 'အမွတ္(14)(10)လမ္းျပည္ေတာ္သာရပ္ကြက္၊၀ါယာလက္၊မဂၤလာဒံု', 1, 40000, 28, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '0943055729', 'San Dy', 2, NULL, 0, 0, 0),
(97, 13, 479, 'အမွတ္(14)(10)လမ္းျပည္ေတာ္သာရပ္ကြက္၊၀ါယာလက္၊မဂၤလာဒံု', 1, 40000, 5, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '0943055729', 'San Dy', 2, NULL, 0, 0, 0),
(98, 13, 367, 'တိုက္(20/24)၊အခန္း(၃၀၂)၊ကြမ္းၿခံ(၂)လမ္း၊၄ ရပ္ကြက္၊ကမာရြက္', 1, 29000, 78, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09760430697', 'Yu Thin Zar Aung', 2, NULL, 0, 0, 0),
(99, 13, 367, 'တိုက္(20/24)၊အခန္း(၃၀၂)၊ကြမ္းၿခံ(၂)လမ္း၊၄ ရပ္ကြက္၊ကမာရြက္', 1, 29000, 77, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09760430697', 'Yu Thin Zar Aung', 2, NULL, 0, 0, 0),
(100, 13, 410, 'အင္းစိန္ရံုးတံတားအဆင္း၊မရင္သိန္းဆံပင္အ၀ယ္ဆိုင္', 1, 19000, 35, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09427272301', 'Htet Htet Wa', 2, NULL, 0, 0, 0),
(101, 13, 389, 'No.33 Pyay Road 7 mile Yangon', 1, 29000, 77, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09785177388', 'Ahthin Nwe', 2, NULL, 0, 0, 0),
(102, 13, 406, 'အမွတ္ 35 ဘီ/မာန္ေျပ ၂၂ လမ္း/သာေကတ', 1, 40000, 52, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '095040560', 'Ei Thandar', 2, NULL, 0, 0, 0),
(103, 13, 406, 'အမွတ္ 35 ဘီ/မာန္ေျပ ၂၂ လမ္း/သာေကတ', 1, 29000, 76, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '095040560', 'Ei Thandar', 2, NULL, 0, 0, 0),
(104, 13, 406, '(၃ခ)ရတနာပံု ၃ လမ္း၊ရတနာပံုအိမ္ယာ၊၁၀/ေျမာက္သာေကတ', 1, 29000, 75, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09965193036', 'Zin Mar Tun', 2, NULL, 0, 0, 0),
(105, 13, 388, 'Building C,Pearl condo,Kabaraye Pagoda road Bahan YGN', 1, 29000, 77, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09797686090', 'Amy Zin', 2, NULL, 0, 0, 0),
(106, 13, 410, 'No 128,ရွမ္းကုန္းလမ္း၊နံသာကုန္းရပ္ကြက္၊အင္းစိန္', 1, 29000, 77, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09788718266', 'Yamin Chit', 2, NULL, 0, 0, 0),
(107, 13, 479, 'No.8,3F,(A)?Dana Thelkdl street 8th Ward,Mayangone Township Yangon', 1, 29000, 77, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09421115098', 'Phue Pwint Yadanar', 2, NULL, 0, 0, 0),
(108, 13, 370, 'သီရိမဂၤလာေစ်းသစ္၊ၾကည့္ျမင္တိုင္', 1, 19000, 39, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09795500029', 'Suhlaing Win', 2, NULL, 0, 0, 0),
(109, 13, 370, 'သီရိမဂၤလာေစ်းသစ္၊ၾကည့္ျမင္တိုင္', 1, 29000, 76, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09795500029', 'Suhlaing Win', 2, NULL, 0, 0, 0),
(110, 13, 483, 'လွည္းတန္းစိန္ေဂဟာေဘး၊ဆင္ျဖဴေတာ္အရုပ္ဆိုင္', 1, 40000, 7, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09441555380', 'Chit Hsu', 2, NULL, 0, 0, 0),
(111, 13, 483, 'လွည္းတန္းစိန္ေဂဟာေဘး၊ဆင္ျဖဴေတာ္အရုပ္ဆိုင္', 1, 40000, 4, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09441555380', 'Chit Hsu', 2, NULL, 0, 0, 0),
(112, 13, 483, 'လွည္းတန္းစိန္ေဂဟာေဘး၊ဆင္ျဖဴေတာ္အရုပ္ဆိုင္', 1, 19000, 38, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09441555380', 'Chit Hsu', 2, NULL, 0, 0, 0),
(113, 13, 369, 'အမွတ္ (၂၃၆)၊၄ လႊာ၊ပန္းဆိုးတန္းလမ္း၊အထက္၊ေက်ာက္တံတား', 1, 40000, 7, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09448375640', 'Madalena Sen', 2, NULL, 0, 0, 0),
(114, 13, 397, 'No.957,၀ဇီယာ(၉)လမ္း၊ေျမာက္ဥကၠလာ', 1, 45000, 68, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09777107188', 'Ei Myat', 2, NULL, 0, 0, 0),
(115, 13, 400, 'အမွတ္(၂၀၅)၊ေအးရိပ္မြန္အိမ္ယာ၊တိုက္(၂)၊ဘုရင့္ေနာင္လမ္းမ၊အမွတ္(၄)ရပ္ကြက္၊လိႈင္', 1, 40000, 56, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09762505209', 'Suhlaing Win', 2, NULL, 0, 0, 0),
(116, 13, 400, 'အမွတ္(၂၀၅)၊ေအးရိပ္မြန္အိမ္ယာ၊တိုက္(၂)၊ဘုရင့္ေနာင္လမ္းမ၊အမွတ္(၄)ရပ္ကြက္၊လိႈင္', 1, 40000, 57, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09762505209', 'Suhlaing Win', 2, NULL, 0, 0, 0),
(117, 13, 400, 'အမွတ္(၂၀၅)၊ေအးရိပ္မြန္အိမ္ယာ၊တိုက္(၂)၊ဘုရင့္ေနာင္လမ္းမ၊အမွတ္(၄)ရပ္ကြက္၊လိႈင္', 1, 19000, 38, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09762505209', 'Suhlaing Win', 2, NULL, 0, 0, 0),
(118, 13, 400, 'အမွတ္(၂၀၅)၊ေအးရိပ္မြန္အိမ္ယာ၊တိုက္(၂)၊ဘုရင့္ေနာင္လမ္းမ၊အမွတ္(၄)ရပ္ကြက္၊လိႈင္', 1, 19000, 35, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09762505209', 'Suhlaing Win', 2, NULL, 0, 0, 0),
(119, 13, 400, 'အမွတ္(၂၀၅)၊ေအးရိပ္မြန္အိမ္ယာ၊တိုက္(၂)၊ဘုရင့္ေနာင္လမ္းမ၊အမွတ္(၄)ရပ္ကြက္၊လိႈင္', 2, 29000, 76, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09762505209', 'Suhlaing Win', 2, NULL, 0, 0, 0),
(120, 13, 388, 'အမွတ္(၈၁)၊တကၠသိုလ္ရိပ္သာလမ္း၊ဗဟန္း(ရံုးခ်ိန္အတြင္းပို႕ေပးရန္)', 1, 19000, 39, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09403724977', 'Nang Kham Yin', 2, NULL, 0, 0, 0),
(121, 13, 388, 'အမွတ္(၈၁)၊တကၠသိုလ္ရိပ္သာလမ္း၊ဗဟန္း(ရံုးခ်ိန္အတြင္းပို႕ေပးရန္)', 1, 29000, 76, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09403724977', 'Nang Kham Yin', 2, NULL, 0, 0, 0),
(122, 13, 388, 'အမွတ္(၂၄)၊ဦးေအာင္ဘလမ္း၊ဆရာစံေတာင္ရပ္ကြက္၊မင္းလမ္းအနီး၊ဗဟန္း', 1, 40000, 3, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '0943145253', 'Athena Shoon', 2, NULL, 0, 0, 0),
(123, 13, 377, 'ေအာင္သိဒၵိအိမ္ယာ၊(၄)ရပ္ကြက္၊နႏၵ၀န္ေစ်းေဘး၊ေတာင္ဥကၠလာ', 1, 40000, 4, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09794774475', 'Lin Lin', 2, NULL, 0, 0, 0),
(124, 13, 377, 'ေအာင္သိဒၵိအိမ္ယာ၊(၄)ရပ္ကြက္၊နႏၵ၀န္ေစ်းေဘး၊ေတာင္ဥကၠလာ', 1, 19000, 36, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09794774475', 'Lin Lin', 2, NULL, 0, 0, 0),
(125, 13, 369, 'AYE Sule ဘဏ္ခြဲ၊ေက်ာက္တံတား', 1, 40000, 53, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09787173922', 'Eingyin Ney Win', 2, NULL, 0, 0, 0),
(126, 13, 380, 'အမွတ္(1351)၊စပ္စ့ထြန္းလမ္း၊(၄၆)ရပ္ကြက္၊ေျမာက္ဒဂံု', 1, 40000, 6, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09777429137', 'Hsu Yi', 2, NULL, 0, 0, 0),
(127, 13, 400, 'အမွတ္(၅၂)၊မာလာၿမိဳႈ္(၄)လမ္း၊(အလယ္ျဖတ္)၊ ၆ ရပ္ကြက္၊ပါရမီစိန္ေဂဟာအနီး၊လိႈင္', 1, 40000, 26, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '095194795', 'Padauk War(မပိေတာက္၀ါ)', 2, NULL, 0, 0, 0),
(128, 13, 404, 'အမွတ္ 187 ေအးရိပ္စ့ေဆးခန္း၊လမ္းမေတာ္လမ္းမ၊လမ္းမေတာ္ၿမိဳ႕နယ္', 1, 40000, 3, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09447014033', 'အိန္ဂ်ယ္ခ်စ္သူ', 2, NULL, 0, 0, 0),
(129, 13, 401, 'အမွတ္ 1790၊ဗိုလ္ခ်ဳပ္လမ္း၊၅ရပ္ကြက္၊လိႈင္သာယာၿမိဳ႕နယ္၊ဗိုလ္ခ်ဳပ္မွတ္တိုင္', 1, 40000, 54, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09777844408', 'Htet Poe Ei', 2, NULL, 0, 0, 0),
(130, 13, 401, 'အမွတ္ 1790၊ဗိုလ္ခ်ဳပ္လမ္း၊၅ရပ္ကြက္၊လိႈင္သာယာၿမိဳ႕နယ္၊ဗိုလ္ခ်ဳပ္မွတ္တိုင္', 1, 29000, 74, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09777844408', 'Htet Poe Ei', 2, NULL, 0, 0, 0),
(131, 13, 370, 'အမွတ္38၊ရံုးႀကီးလမ္း၊ၾကည့္ျမင္တိုင္', 1, 40000, 3, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09250085675', 'Ma War', 2, NULL, 0, 0, 0),
(132, 13, 390, 'အမွတ္143/ဥဇၨနာ(၅)လမ္း၊ဇရပ္ကြက္၊ေျမာက္ဥကၠလာ', 1, 19000, 40, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09761003421', 'Myat Ei Mon', 2, NULL, 0, 0, 0),
(133, 13, 367, 'အမွတ္-157၊5 လႊာ၊ေအာင္ခ်မ္းသာလမ္း၊၅ရပ္ကြက္ဆင္မလိုက္ေစ်းေနာက္၊ကမာရြက္ၿမိဳ႕နယ္', 1, 40000, 4, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09402676778', 'Sandi Phyo', 2, NULL, 0, 0, 0),
(134, 13, 410, 'အမွတ္ 642/က၊နိမၺာန္လမ္းမႀကီး၊ေစာဘြားႀကီးကုန္း၊အင္းစိန္', 1, 29000, 79, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09796599738', 'Chit Pan Sint', 2, NULL, 0, 0, 0),
(135, 13, 407, 'အမွတ္(33/ခ)၊ပဲခူးစုလမ္း၊ပဲခူးစုရပ္ကြက္၊သန္လ်င္ၿမိဳ႕နယ္', 1, 29000, 75, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09799455492', 'Kaythi Khine', 2, NULL, 0, 0, 0),
(136, 13, 392, 'အမွတ္(၃၇/4A)၊အေသာကလမ္း၊နတ္ေခ်ာင္းရပ္ကြက္၊တာေမြ', 1, 29000, 76, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '095360321', 'Chochit Chochit', 2, NULL, 0, 0, 0),
(137, 13, 388, 'အမွတ္(၆၄-B)၊ေရႊဂံုတိုင္ပလာစာ(၆)လႊာ၊ေရႊဂံုတိုင္၊ဗဟန္း', 1, 29000, 77, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09422505511', 'Yaww Mal', 2, NULL, 0, 0, 0),
(138, 13, 400, 'မလာၿမိဳင္(၈)လမ္း၊၁၆ ရပ္ကြက္၊လိႈင္ၿမိဳ႕နယ္', 1, 29000, 76, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '0943087636', 'Nway Shu Ma Wami', 2, NULL, 0, 0, 0),
(139, 13, 380, 'အမွတ္ 1094၊ဇြဲကပင္လမ္း၊၄၃ ရပ္ကြက္၊ေျမာက္ဒဂံု', 1, 29000, 76, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09972354467', 'Wint Wint Tun Naing', 2, NULL, 0, 0, 0),
(140, 13, 380, 'အမွတ္ 1094၊ဇြဲကပင္လမ္း၊၄၃ ရပ္ကြက္၊ေျမာက္ဒဂံု', 1, 29000, 77, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09972354467', 'Wint Wint Tun Naing', 2, NULL, 0, 0, 0),
(141, 13, 389, 'Myanmar Plaza၊ကမၻာေအးဘုရားလမ္း၊မရမ္းကုန္း', 1, 29000, 77, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09403727935', 'Thandar Ko', 2, NULL, 0, 0, 0),
(142, 13, 390, 'အမွတ္ 388၊ဘုမၼာ(၁၀)လမ္း၊ညရပ္ကြက္၊ေျမာက္ဥကၠလာ', 1, 29000, 74, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09785116299/09764661408', 'Thuzar Thet', 2, NULL, 0, 0, 0),
(143, 13, 405, 'အမွတ္ 27 သံသုမာလမ္း၊လိုင္စင္ရံုးမွတ္တိုင္၊သဃၤန္းကၽြန္း', 1, 29000, 76, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09422660476', 'Angle', 2, NULL, 0, 0, 0),
(144, 13, 370, 'အမွတ္ 62 ၊3လႊာ၊ကြန္ရဲတန္းလမ္း(အထက္)၊ၾကည့္ျမင္တိုင္ၿမိဳ႕', 1, 29000, 76, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09966699139/09422344640', 'Su Mon Latt', 2, NULL, 0, 0, 0),
(145, 13, 379, 'အမွတ္ ၂၅၆၊ေအာင္သိဒၵိလမ္း၊ ၂၀ ရပ္ကြက္၊ေတာင္ဒဂံုၿမိဳ႕နယ္၊ဘုန္းႀကီးေက်ာင္းေကြ႕ မွတ္တိုင္', 1, 29000, 76, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09448037149', 'Nilar Nyunt', 2, NULL, 0, 0, 0),
(146, 13, 389, 'Ford car showrooms သမိုင္းလမ္းဆံု၊မရမ္းကုန္းၿမိဳ႕', 1, 29000, 78, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09420020341', 'Suwai Tun', 2, NULL, 0, 0, 0),
(147, 13, 389, 'အမွတ္(၁၈) A၊ေအာင္သိဒီၶရိပ္သာ (၃)လမ္း၊မရမ္းကုန္းၿမိဳ႕နယ္', 1, 29000, 79, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09420704007/09425889909', 'Yu Moe Han', 2, NULL, 0, 0, 0),
(148, 13, 370, 'တိုက္ 10၊အခန္း ၈၊ပန္းလိႈင္အိမ္ရာ၊ၾကည္ျ့မင္တိုင္', 1, 29000, 77, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09691793875', 'Yee Mya', 2, NULL, 0, 0, 0),
(149, 13, 410, 'No 22,City Golf Housing ,Thiri Mingalar Rd,Insein', 1, 29000, 76, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09795936748', 'Thinzar', 2, NULL, 0, 0, 0),
(150, 13, 398, 'Building 2 ,မိုးေကာင္းလမ္းမ၊ရန္ကင္း', 1, 29000, 79, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09420012312', 'Khinme MeKyaw', 2, NULL, 0, 0, 0),
(151, 13, 377, 'အမွတ္(322-A)၊ရတနာလမ္း၊၁၁ ရပ္ကြက္၊ကုလားဘုရားမွတ္တိုင္၊ရတနာလမ္းမႀကီးေပၚက CB Bank ၊ေတာင္ဥကၠလာ(၁၆)ေကြ႔ဘဏ္ခြဲ', 1, 29000, 75, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09697109513', 'Main Kalay', 2, NULL, 0, 0, 0),
(152, 13, 367, 'Vantages Tower ျပည္လမ္း၊ကမာရြက္', 1, 40000, 5, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09420738165', 'Htar', 2, NULL, 0, 0, 0),
(153, 13, 386, 'No.195,ေျမညီထပ္၊28လမ္း၊ဗိုလ္ခ်ဳပ္ဘေလာက္၊ေဇာ္မိတၱဴေရွ႕၊ပန္းဘဲတန္း', 1, 19000, 36, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09788213951', 'Thae Thae Phoenix', 2, NULL, 0, 0, 0),
(154, 13, 386, 'No.195,ေျမညီထပ္၊28လမ္း၊ဗိုလ္ခ်ဳပ္ဘေလာက္၊ေဇာ္မိတၱဴေရွ႕၊ပန္းဘဲတန္း', 1, 40000, 6, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09788213951', 'Thae Thae Phoenix', 2, NULL, 0, 0, 0),
(155, 13, 394, 'အေဖ်ာက္ၿမိဳက(၃)ရပ္ကြက္၊တိုက္ႀကီးၿမိဳ႕၊ပန္းတိုင္သစ္ေဘာဒါ', 1, 40000, 52, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '0976946695', 'Khin Pearl Khaing', 2, NULL, 0, 0, 0),
(156, 13, 409, 'No501,Building B2,Aung Zeya Complex,Kannar st Ahlone', 1, 19000, 39, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '095017940', 'Moe Moe Zin', 2, NULL, 0, 0, 0),
(157, 13, 401, 'အမွတ္ 1749/1750 တပင္ေရႊထီးလမ္း/King camel ေကာ္ေဇာဆိုင္ လိႈင္သာယာ၊ရန္ကုန္', 1, 40000, 2, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '092029896', 'Li Aye', 2, NULL, 0, 0, 0),
(158, 13, 377, 'အမွတ္(၂၂၈/၁)(၁၄/၂)ရပ္ကြက္ သံသုမာလမ္းနွင့္ေက်းတမာလမ္းေထာင့္၊ဥကၠလာဘုရားအနီး၊ေတာင္ဥကၠလာ', 1, 40000, 15, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09795587672', 'Khin Cherry Aung', 2, NULL, 0, 0, 0),
(159, 13, 377, 'အမွတ္(၂၂၈/၁)(၁၄/၂)ရပ္ကြက္ သံသုမာလမ္းနွင့္ေက်းတမာလမ္းေထာင့္၊ဥကၠလာဘုရားအနီး၊ေတာင္ဥကၠလာ', 1, 40000, 7, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09795587672', 'Khin Cherry Aung', 2, NULL, 0, 0, 0),
(160, 13, 377, 'အမွတ္(၂၂၈/၁)(၁၄/၂)ရပ္ကြက္ သံသုမာလမ္းနွင့္ေက်းတမာလမ္းေထာင့္၊ဥကၠလာဘုရားအနီး၊ေတာင္ဥကၠလာ', 1, 19000, 38, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09795587672', 'Khin Cherry Aung', 2, NULL, 0, 0, 0),
(161, 13, 387, 'Union Financial Tower,မဟာဗႏၵဳလလမ္းနွင့္သိမ္ျဖဴလမ္းေထာင့္၊ဗိုလ္တေထာင္', 1, 40000, 56, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '095045932', 'Aindre Hpon Naing(အိမ္ခ်မ္းသာ)', 2, NULL, 0, 0, 0),
(162, 13, 390, 'အမွတ္(၂၈၀)၊ေအာင္သိဒၵိလမ္း၊ေ၀ဘာဂီ(၈)ရပ္ကြက္၊ေျမာက္ဥကၠလာ', 1, 40000, 6, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09250679302', 'Chaw Suthwin', 2, NULL, 0, 0, 0),
(163, 13, 400, 'No 162,Aung Dama Yeikthar St,12 Qtr Hlaing', 1, 40000, 3, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09953248899', 'Hera Zr', 2, NULL, 0, 0, 0),
(164, 13, 380, 'ပင္လံုေဆးရံုး၊Tmaging separmet ေျမာက္ဒဂံု', 1, 29000, 77, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09777131274/09979843666', 'Win Kyawt', 2, NULL, 0, 0, 0),
(165, 13, 380, 'ပင္လံုေဆးရံုး၊Tmaging separmet ေျမာက္ဒဂံု', 1, 19000, 36, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09777131274/09979843666', 'Win Kyawt', 2, NULL, 0, 0, 0),
(166, 13, 391, 'အမွတ္ 3၊လမ္း 130 Royal Thiri Condo၊မဂၤလာေတာင္ညႊန္႔', 1, 40000, 3, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '095123158', 'Than Myint', 2, NULL, 0, 0, 0),
(167, 13, 392, 'အမွတ္14၊134 လမ္း၊၄ လႊာ၊မအူကုန္း၊တာေမြၿမိဳ႕နယ္', 1, 40000, 4, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09421944484', 'War War Nay Htun', 2, NULL, 0, 0, 0),
(168, 13, 410, 'No 99 ၊စိုက္ပ်ိဳးေရး ၁ လမ္း၊ေဖာ့ကန္၊အင္းစိန္ၿမိဳ႕နယ္၊ေဖာ့ကန္မွတ္တိုင္', 1, 40000, 3, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09254233142', 'Ei Cho Zin Nyein', 2, NULL, 0, 0, 0),
(169, 13, 394, 'လသာကုန္းလမ္း၊တိုက္ႀကီးၿမိဳ႕နယ္ စာတိုက္', 1, 40000, 4, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09885074368', 'Thin Thin Aye', 2, NULL, 0, 0, 0),
(170, 13, 402, 'အမွတ္(J-7)၊ေညာင္ပင္ေလးေစ်းလမ္း၊လမ္းမေတာ္၊လသာ', 1, 40000, 60, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '0960031310', 'Thuzar Win', 2, NULL, 0, 0, 0),
(171, 13, 483, 'No.(49/A)၊Moe Sandar St,San Yeik Nyein.Heldan.', 1, 40000, 6, '2020-03-22', '2020-03-21 14:36:23', '', 1, 0, '2020-03-21 14:36:21', NULL, '09767678202', 'Saw Yu Nande', 2, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `route_planning`
--

CREATE TABLE `route_planning` (
  `id` int(100) NOT NULL,
  `plan_id` int(10) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `delivery_postman_id` int(10) DEFAULT NULL,
  `assign_date` datetime DEFAULT NULL,
  `delivery_charges` int(100) NOT NULL,
  `over_tender_charges` int(100) NOT NULL,
  `notification_date` datetime NOT NULL,
  `status` int(100) NOT NULL DEFAULT '0',
  `extra_charges` int(100) NOT NULL,
  `paid_unpaid` int(100) NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL,
  `division` varchar(100) NOT NULL,
  `township` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `registration_date` datetime NOT NULL,
  `target_date` datetime NOT NULL,
  `customer_confirm_status` int(10) NOT NULL DEFAULT '2',
  `high_way` int(11) NOT NULL DEFAULT '0',
  `transport_charge` int(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `route_planning`
--

INSERT INTO `route_planning` (`id`, `plan_id`, `product_id`, `delivery_postman_id`, `assign_date`, `delivery_charges`, `over_tender_charges`, `notification_date`, `status`, `extra_charges`, `paid_unpaid`, `remark`, `division`, `township`, `address`, `quantity`, `amount`, `registration_date`, `target_date`, `customer_confirm_status`, `high_way`, `transport_charge`) VALUES
(1, 51, 'Z-00001', NULL, NULL, 2000, 0, '2020-03-20 00:00:00', 0, 0, 0, '- -', 'ရန္ကုန္တိုင္းေဒသႀကီး', 'စမ္းေခ်ာင္းၿမိဳ႕နယ္', 'No 27.7Aေအာင္သေျပလမ္း', 1, 8100, '2020-03-20 22:31:58', '0000-00-00 00:00:00', 2, 0, 0),
(2, 50, 'Z-00001', 10, '2020-03-21 02:03:22', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '406', 'အမွတ္ 13/7 ထူပာရံုး 8လမ္းထိပ္', 1, 13600, '2020-03-20 22:29:52', '0000-00-00 00:00:00', 2, 0, 0),
(3, 49, 'Z-00001', 2, '2020-03-21 01:58:35', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '398', 'အမွတ္ 1 သမာဓိလမ္း 14ရပ္ကြက္ရန္ကင္းအေနာက္ေပါက္', 1, 36200, '2020-03-20 22:27:20', '0000-00-00 00:00:00', 2, 0, 0),
(4, 48, 'Z-00001', NULL, NULL, 2000, 0, '2020-03-20 00:00:00', 0, 0, 0, '- -', 'ရန္ကုန္တိုင္းေဒသႀကီး', 'ၾကည့္ျမင္တိုင္ၿမိဳ႕နယ္', 'Crystle To,wer Junction Square', 1, 9600, '2020-03-20 22:24:08', '0000-00-00 00:00:00', 2, 0, 0),
(5, 47, 'Z-00001', 10, '2020-03-21 02:04:09', 2000, 0, '2020-03-19 00:00:00', 1, 0, 0, '- -', '13', '406', 'အမွတ္ 17 မာန္ေျပ5လမ္းအေနာက္ 2 ေတာင္ရပ္ကြက္သာေကတ', 1, 22500, '2020-03-20 22:21:04', '0000-00-00 00:00:00', 2, 0, 0),
(6, 46, 'Z-00001', 12, '2020-03-21 02:07:00', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '409', '103/6H B သိပံလမ္း', 1, 9000, '2020-03-20 22:17:22', '0000-00-00 00:00:00', 2, 0, 0),
(7, 45, 'Z-00001', 1, '2020-03-21 01:57:45', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '400', 'No 5B စစ္ကိုင္ းလမ္းျမကန္သာဥယ်ာဥ္အိမ္ယာ', 1, 170500, '2020-03-20 22:14:45', '0000-00-00 00:00:00', 2, 0, 0),
(8, 44, 'Z-00001', 11, '2020-03-21 02:04:30', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '377', 'စံျပ5လမ္း သဃၤန္းကြ်န္းစံျပေစ်းအနီး', 1, 28400, '2020-03-20 22:11:23', '0000-00-00 00:00:00', 2, 0, 0),
(9, 43, 'Z-00001', 9, '2020-03-21 02:01:45', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '397', '20/426ပုဂံလမ္းေရြွေပါက္ကံ', 1, 70800, '2020-03-20 22:08:44', '0000-00-00 00:00:00', 2, 0, 0),
(10, 42, 'Z-00001', 1, '2020-03-21 01:57:45', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '400', 'လွိုူင္ျမို့နယ္ ဘူတာရံုလမ္း ဘု၇င့္ေနာင္လမ္း', 1, 14600, '2020-03-20 22:06:38', '0000-00-00 00:00:00', 2, 0, 0),
(11, 41, 'Z-00001', 1, '2020-03-21 01:57:45', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '400', 'အမွတ္ 31 ပါရမီလမ္း 16 ရပ္ကြက္ လိုွင္ျမို့', 1, 7200, '2020-03-20 20:21:53', '0000-00-00 00:00:00', 2, 0, 0),
(12, 40, 'Z-00001', 11, '2020-03-21 02:04:57', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '405', 'C/248ေလးေထာင့္ကန္လမ္းေျမာက္ရပ္ကြက္ သဃၤန္းက်ြန္း', 1, 13400, '2020-03-20 20:19:05', '0000-00-00 00:00:00', 2, 0, 0),
(13, 39, 'Z-00001', 5, '2020-03-21 01:59:37', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '401', 'ေရြွလင္ပန္းတန္ဖိုးနည္းအိမ္ယာလိွုင္သာယာတိုက္ 32 အခန္း006ေျမညီထပ္', 1, 20400, '2020-03-20 20:16:18', '0000-00-00 00:00:00', 2, 0, 0),
(14, 38, 'Z-00001', NULL, NULL, 2000, 0, '2020-03-20 00:00:00', 0, 0, 0, '- -ZZ', 'ရန္ကုန္တိုင္းေဒသႀကီး', 'ေျမာက္ဉကၠလာပ', 'North Okkalar oozenar11 st', 1, 7200, '2020-03-20 20:15:30', '0000-00-00 00:00:00', 2, 0, 0),
(15, 37, 'Z-00001', 16, '2020-03-21 02:20:52', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '382', 'Dagon Seinken 87 Qut Inwa stNo,795 A', 1, 12100, '2020-03-20 20:13:26', '0000-00-00 00:00:00', 2, 0, 0),
(16, 36, 'Z-00001', NULL, NULL, 2000, 0, '2020-03-20 00:00:00', 0, 0, 0, '- -', 'ရန္ကုန္တိုင္းေဒသႀကီး', 'ေဒါပုံၿမိဳ႕နယ္', 'အမွတ္ 66 ရြာမလမ္း သေဘၤာက်င္း ေဒါပံု', 1, 9200, '2020-03-20 20:13:19', '0000-00-00 00:00:00', 2, 0, 0),
(17, 35, 'Z-00001', 12, '2020-03-21 02:07:23', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '404', 'No.96 13 ST Lamadaw', 1, 11000, '2020-03-20 20:10:45', '0000-00-00 00:00:00', 2, 0, 0),
(18, 34, 'Z-00001', NULL, NULL, 2000, 0, '2020-03-20 00:00:00', 0, 0, 0, '- -', 'ရန္ကုန္တိုင္းေဒသႀကီး', 'တာေမြၿမိဳ႕နယ္', 'အမွတ္31 ပတျမားလမ္းျမန္မာ့ဂုက္ေရာင္အိမ္ယာတာေမြ', 1, 7600, '2020-03-20 20:10:30', '0000-00-00 00:00:00', 2, 0, 0),
(19, 33, 'Z-00001', 16, '2020-03-21 02:20:39', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '381', 'အမွတ္ 190 ရာဇသၿကၤန္လမ္းဒဂံုအေရွ့', 1, 14300, '2020-03-20 20:07:32', '0000-00-00 00:00:00', 2, 0, 0),
(20, 32, 'Z-00001', 17, '2020-03-21 02:48:26', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '369', 'East Insein zay Maharmyin st Thiri Yanada School', 1, 14700, '2020-03-20 20:05:25', '0000-00-00 00:00:00', 2, 0, 0),
(21, 31, 'Z-00001', NULL, NULL, 2000, 0, '2020-03-20 00:00:00', 0, 0, 0, '- -', 'ရန္ကုန္တိုင္းေဒသႀကီး', 'မဂၤလာ‌ေတာင္ၫြန႔္ၿမိဳ႕နယ္', 'No 84သတိပဌာန္းလမ္းေက်ာက္ေျမာင္း', 1, 8200, '2020-03-20 20:05:25', '0000-00-00 00:00:00', 2, 0, 0),
(22, 30, 'Z-00001', NULL, NULL, 2000, 0, '2020-03-20 00:00:00', 0, 0, 0, '- -ZZ', 'ရန္ကုန္တိုင္းေဒသႀကီး', 'ေျမာက္ဉကၠလာပ', '15/413 စကိုင္းလမ္း။ေရ ႊေပါက္ကံ', 1, 23800, '2020-03-20 20:01:41', '0000-00-00 00:00:00', 2, 0, 0),
(23, 29, 'Z-00001', 16, '2020-03-21 02:20:39', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '381', 'No.10184 Ingin st 130 Qut East DAgon', 1, 31300, '2020-03-20 19:59:30', '0000-00-00 00:00:00', 2, 0, 0),
(24, 28, 'Z-00001', 1, '2020-03-21 01:56:45', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '367', 'No.615Pyay road KaMaryoot Marlar bus stop', 1, 6500, '2020-03-20 19:58:24', '0000-00-00 00:00:00', 2, 0, 0),
(25, 27, 'Z-00001', 5, '2020-03-21 02:00:09', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '399', 'Shwepyitar Tandin KAbarloon BusStop', 1, 23000, '2020-03-20 19:55:45', '0000-00-00 00:00:00', 2, 0, 0),
(26, 26, '007', 2, '2020-03-21 01:59:04', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '388', 'ဥသဖယားလမ္းက်ိုကဆံရပ္ကြက္။ဗဟန္း', 1, 22800, '2020-03-20 19:54:05', '0000-00-00 00:00:00', 2, 0, 0),
(27, 25, 'Z-00001', 16, '2020-03-21 02:20:52', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '382', 'YuzanaGarden city 93 Qut May Yu st No.183', 1, 30900, '2020-03-20 19:53:22', '0000-00-00 00:00:00', 2, 0, 0),
(28, 24, '007', 1, '2020-03-21 01:57:45', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '400', 'လိွုင္ျမင့္မိုရ္ အိမ္ယာ 1လမ္း', 1, 13600, '2020-03-20 19:51:03', '0000-00-00 00:00:00', 2, 0, 0),
(29, 52, 'Z-00001', 1, '2020-03-21 01:57:45', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '400', 'Malarmyint 8st No,21 Hlaing', 1, 16100, '2020-03-20 22:41:56', '0000-00-00 00:00:00', 2, 0, 0),
(30, 23, 'Z-00001', 10, '2020-03-21 02:03:43', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '407', 'D 42 Minyekyawswar st yontaw Qut Thanlyun', 1, 47200, '2020-03-20 19:49:52', '0000-00-00 00:00:00', 2, 0, 0),
(31, 22, '007', 7, '2020-03-21 02:01:21', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '397', 'ပဲခူးတိုင္း ေဇယ်၀တီျမိဳ့ကားဂိတ္', 1, 0, '2020-03-20 19:49:12', '0000-00-00 00:00:00', 2, 0, 0),
(32, 21, '007', 16, '2020-03-21 02:20:11', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '379', 'ေတာင္ဒဂံု 107 ေက်ာင္းလမ္းမွတ္တိုင္', 1, 25999, '2020-03-20 19:46:45', '0000-00-00 00:00:00', 2, 0, 0),
(33, 66, 'Z-00001', 1, '2020-03-21 01:57:45', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '400', '12 Qtu Hlaing', 1, 39400, '2020-03-20 23:50:25', '0000-00-00 00:00:00', 2, 0, 0),
(34, 65, 'Z-00001', NULL, NULL, 2000, 0, '2020-03-20 00:00:00', 0, 0, 0, '- -ZZ', 'ရန္ကုန္တိုင္းေဒသႀကီး', 'မဂၤလာ‌ေတာင္ၫြန႔္ၿမိဳ႕နယ္', 'No.118 MaHaTuka st Kyitaw Qut', 1, 9200, '2020-03-20 23:48:57', '0000-00-00 00:00:00', 2, 0, 0),
(35, 64, 'Z-00001', 17, '2020-03-21 09:59:32', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '387', 'No.4 Room 002 1 FALOOR NayjarTharyarkone st Bo 1000', 1, 11100, '2020-03-20 23:47:00', '0000-00-00 00:00:00', 2, 0, 0),
(36, 63, 'Z-00001', 17, '2020-03-21 09:59:32', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '387', 'No,64 Bo 1000', 1, 16000, '2020-03-20 23:43:35', '0000-00-00 00:00:00', 2, 0, 0),
(37, 62, 'Z-00001', 5, '2020-03-21 02:00:09', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '399', '128 b ShweJoePyu 3 st 7 Qut Shwepyitar', 1, 35200, '2020-03-20 23:41:45', '0000-00-00 00:00:00', 2, 0, 0),
(38, 61, 'Z-00001', 16, '2020-03-21 02:20:27', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '380', 'No.200 b SatMu 3 St North DAGON', 1, 34300, '2020-03-20 23:39:33', '0000-00-00 00:00:00', 2, 0, 0),
(39, 60, 'Z-00001', 11, '2020-03-21 02:04:30', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '377', 'KaTuMarLar 4 Qtu No.7', 1, 16000, '2020-03-20 23:37:28', '0000-00-00 00:00:00', 2, 0, 0),
(40, 59, 'Z-00001', 15, '2020-03-21 02:19:52', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '389', '386 THAMAINE', 1, 13000, '2020-03-20 23:34:39', '0000-00-00 00:00:00', 2, 0, 0),
(41, 58, 'Z-00001', NULL, NULL, 2000, 0, '2020-03-20 00:00:00', 0, 0, 0, '- -ZZ', 'ရန္ကုန္တိုင္းေဒသႀကီး', 'မဂၤလာ‌ေတာင္ၫြန႔္ၿမိဳ႕နယ္', 'Build 7 ROOM 7 Myawady Housing', 1, 7000, '2020-03-20 23:32:12', '0000-00-00 00:00:00', 2, 0, 0),
(42, 57, 'Z-00001', 2, '2020-03-21 01:59:04', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '388', 'No.7 NayThuLwin st', 1, 23000, '2020-03-20 23:00:12', '0000-00-00 00:00:00', 2, 0, 0),
(43, 56, 'Z-00001', 16, '2020-03-21 02:20:52', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '382', 'No.11 KounArt MinTar st Zon 1', 1, 13000, '2020-03-20 22:57:55', '0000-00-00 00:00:00', 2, 0, 0),
(44, 55, 'Z-00001', NULL, NULL, 2000, 0, '2020-03-20 00:00:00', 0, 0, 0, '- -ZZ', 'ရန္ကုန္တိုင္းေဒသႀကီး', 'တာေမြၿမိဳ႕နယ္', 'No.24 26 Tamwe South  Horse st', 1, 8000, '2020-03-20 22:55:33', '0000-00-00 00:00:00', 2, 0, 0),
(45, 54, 'Z-00001', 1, '2020-03-21 01:56:45', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '367', 'Bayint Naung 12st, Building 242, 5B', 1, 9200, '2020-03-20 22:48:45', '0000-00-00 00:00:00', 2, 0, 0),
(46, 53, 'Z-00001', 11, '2020-03-21 02:04:57', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '405', 'No,24 U Yuu st Yadana Tiri Houing zawana BUS STOP', 1, 19500, '2020-03-20 22:46:27', '0000-00-00 00:00:00', 2, 0, 0),
(47, 20, 'Z-00001', 16, '2020-03-21 02:20:27', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -ZZ', '13', '380', 'North Dangon no. 956 sata st 38 Qtu', 1, 39900, '2020-03-20 19:45:52', '0000-00-00 00:00:00', 2, 0, 0),
(48, 19, '007', 9, '2020-03-21 02:01:45', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '397', '31,70*71ၾကား Mdy', 1, 7500, '2020-03-20 19:44:42', '0000-00-00 00:00:00', 2, 0, 0),
(49, 18, '007', 17, '2020-03-21 02:48:26', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '369', 'အခန်း၃၀၃ ၃လွှာMGWCente​ဗိုအောျော်လမ်အောက်လောက်', 1, 16000, '2020-03-20 19:41:39', '0000-00-00 00:00:00', 2, 0, 0),
(50, 17, 'Z-00001', 1, '2020-03-21 01:57:45', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -zz', '13', '400', 'Baho St build 96 Hladen', 1, 22300, '2020-03-20 19:38:33', '0000-00-00 00:00:00', 2, 0, 0),
(51, 16, '007', 2, '2020-03-21 01:58:35', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '398', 'အမှတ်15တပ်မြေမိုးကောင်းလမ်း ဘောက်ထော်ရန', 1, 0, '2020-03-20 19:38:29', '0000-00-00 00:00:00', 2, 0, 0),
(52, 15, 'Z-00001', 17, '2020-03-21 02:48:55', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -zz', '13', '386', 'No. 78 Lower bLOCK 27 ST', 1, 51100, '2020-03-20 19:37:01', '0000-00-00 00:00:00', 2, 0, 0),
(53, 14, '007', 7, '2020-03-21 02:01:21', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '397', 'မြစ်ကြီးနာမြို့သစ်', 1, 0, '2020-03-20 19:35:29', '0000-00-00 00:00:00', 2, 0, 0),
(54, 13, 'Z-00001', 10, '2020-03-21 02:03:22', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -zz', '13', '406', '10 ေတာင္ 12 ရပ္ကြက္သာလာ၀တီ 8 လမ္း သေကတ', 1, 45300, '2020-03-20 19:35:08', '0000-00-00 00:00:00', 2, 0, 0),
(55, 12, '007', 7, '2020-03-21 02:01:21', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '397', 'သံဖြူဇရပ်ကားဂိတ်', 1, 0, '2020-03-20 19:31:47', '0000-00-00 00:00:00', 2, 0, 0),
(56, 11, '007', NULL, NULL, 2000, 0, '2020-03-20 00:00:00', 0, 0, 0, '- -', 'ရန္ကုန္တိုင္းေဒသႀကီး', 'တာေမြၿမိဳ႕နယ္', 'တာမွေ47လမ်းသီတာမှတ်တိုင်အနီး', 1, 9000, '2020-03-20 19:30:17', '0000-00-00 00:00:00', 2, 0, 0),
(57, 10, 'Z-00001', 15, '2020-03-21 02:19:52', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -zz', '13', '389', 'No,27 ဘုရင့္ေနာင္လမ္း ျကီးပြားေရးေျမာက္ပိိုင္း', 1, 15100, '2020-03-20 19:29:59', '0000-00-00 00:00:00', 2, 0, 0),
(58, 9, 'Z-00001', 2, '2020-03-21 01:59:04', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -zz', '13', '388', 'Sedona Hotel', 1, 20200, '2020-03-20 19:26:49', '0000-00-00 00:00:00', 2, 0, 0),
(59, 8, 'Z-00001', 1, '2020-03-21 01:56:45', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -zz', '13', '367', 'Build 11 Room 56 Pyayyeinkmon housing Kamaryaut', 1, 20100, '2020-03-20 19:24:56', '0000-00-00 00:00:00', 2, 0, 0),
(60, 7, '007', 17, '2020-03-21 02:48:44', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '385', 'တိုက်14.6လွှာရွှေဘုန်းပွငွဘုရားလမ်း', 1, 61000, '2020-03-20 19:24:12', '0000-00-00 00:00:00', 2, 0, 0),
(61, 6, 'Z-00001', 15, '2020-03-21 02:19:52', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -zz', '13', '389', 'No.403 Condo  f Kabaraye Belar', 1, 16200, '2020-03-20 19:23:12', '0000-00-00 00:00:00', 2, 0, 0),
(62, 5, 'Z-00001', 17, '2020-03-21 09:59:32', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- ZZ', '13', '387', '46 st bo1000 ကုန္သည္လမ္းဘက္', 1, 12800, '2020-03-20 19:20:52', '0000-00-00 00:00:00', 2, 0, 0),
(63, 4, 'Z-00001', 12, '2020-03-21 02:07:00', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- ZZ', '13', '409', 'No.155 Alone st & Ayarwady st', 1, 13500, '2020-03-20 19:18:38', '0000-00-00 00:00:00', 2, 0, 0),
(64, 3, 'Z-00001', 12, '2020-03-21 02:07:00', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- ZZ', '13', '409', 'No.155 Alone st & Ayarwady st', 1, 13500, '2020-03-20 19:18:38', '0000-00-00 00:00:00', 2, 0, 0),
(65, 2, '007', 7, '2020-03-21 02:01:21', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '397', 'ပုပါးၿမိဳ့ကားဂိတ္', 1, 0, '2020-03-20 19:15:55', '0000-00-00 00:00:00', 2, 0, 0),
(66, 1, '007', 16, '2020-03-21 02:20:27', 2000, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -', '13', '380', 'No.154 ဖိုး၀ဇီယာလမ္း ၃၉ Bရပ္ကြက္ မဒဂံု', 1, 0, '2020-03-20 19:10:30', '0000-00-00 00:00:00', 2, 0, 0),
(67, 69, '0090', 2, '2020-03-21 02:52:09', 1500, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -Noe Noe Aung(23.3.20)', '13', '388', 'No,1 5 floor USA Bahan', 1, 30000, '2020-03-21 02:16:40', '0000-00-00 00:00:00', 2, 0, 0),
(68, 68, '0090', 2, '2020-03-21 02:52:09', 1500, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -Noe Noe Aung(23.3.20)', '13', '388', 'No, 110 Uniyeinktarlantat USA Bahan', 1, 15000, '2020-03-21 02:13:45', '0000-00-00 00:00:00', 2, 0, 0),
(69, 67, '009', 15, '2020-03-21 02:52:35', 1500, 0, '2020-03-20 00:00:00', 1, 0, 0, '- -chan closet', '13', '389', 'BPI Saywarsatyod Thamine Lansone Yut compus b-block', 1, 21500, '2020-03-21 02:01:48', '0000-00-00 00:00:00', 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `name`) VALUES
(1, 'ကခ်င္ျပည္နယ္'),
(2, 'ကယားျပည္နယ္'),
(3, 'ကရင္ျပည္နယ္'),
(4, 'ခ်င္းျပည္နယ္‌'),
(5, 'စစ္ကိုင္းတိုင္းေဒသႀကီး'),
(6, 'တနသၤာရီတိုင္းေဒသႀကီး'),
(7, 'ေနျပည္ေတာ္ ျပည္ေတာင္စုနယ္ေျမ'),
(8, 'ပဲခူးတိုင္းေဒသႀကီး'),
(9, 'မေကြးတိုင္းေဒသႀကီး'),
(10, 'မႏၲေလးတိုင္းေဒသႀကီး'),
(11, 'မြန္ျပည္နယ္'),
(12, 'ရခိုင္ျပည္နယ္'),
(13, 'ရန္ကုန္တိုင္းေဒသႀကီး'),
(14, 'ရွမ္းျပည္နယ္'),
(15, 'ဧရာဝတီတိုင္းေဒသႀကီး');

-- --------------------------------------------------------

--
-- Table structure for table `stock_in`
--

CREATE TABLE `stock_in` (
  `id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `in_qty` int(100) NOT NULL,
  `out_qty` int(11) NOT NULL DEFAULT '0',
  `price_per_item` int(50) NOT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `o_id` int(100) NOT NULL,
  `postman_id` int(111) DEFAULT NULL,
  `route_plan_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_in_out_return`
--

CREATE TABLE `stock_in_out_return` (
  `stock_id` int(10) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `order_id` int(100) DEFAULT NULL,
  `verified_date` datetime DEFAULT NULL,
  `order_registration_date` datetime DEFAULT NULL,
  `order_registration_time` datetime DEFAULT NULL,
  `remark_order` varchar(255) DEFAULT NULL,
  `remark_quantity` int(100) NOT NULL,
  `product_price_per_item` int(100) NOT NULL,
  `product_amount` int(100) NOT NULL,
  `stock_in` int(100) NOT NULL DEFAULT '0',
  `stock_out` int(100) DEFAULT '0',
  `reason_in_out_return` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `postman_id` int(100) DEFAULT NULL,
  `plan_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock_out`
--

CREATE TABLE `stock_out` (
  `id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `price_per_item` int(50) NOT NULL,
  `out_qty` int(100) NOT NULL,
  `in_qty` int(50) NOT NULL DEFAULT '0',
  `postman_id` int(11) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `o_id` int(100) DEFAULT NULL,
  `plan_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `township`
--

CREATE TABLE `township` (
  `id` int(191) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `township`
--

INSERT INTO `township` (`id`, `state_id`, `name`) VALUES
(1, 1, 'ကန္ပိုက္တီၿမိဳ႕'),
(2, 1, 'ကာမိုင္းၿမိဳ႕'),
(3, 1, 'ခ်ီေဖြၿမိဳ႕'),
(4, 1, 'ေခါင္လန္ဖူးၿမိဳ႕'),
(5, 1, 'ဆင္ဘိုၿမိဳ႕'),
(6, 1, 'ဆဒုံးၿမိဳ႕'),
(7, 1, 'ဆြမ္ပရာဘြမ္ၿမိဳ႕'),
(8, 1, 'ေဆာ့ေလာ္ၿမိဳ႕'),
(9, 1, 'တႏိုင္းၿမိဳ႕'),
(10, 1, 'ေဒါ့ဖုန္းယန္ၿမိဳ႕'),
(11, 1, 'နမၼတီးၿမိဳ႕'),
(12, 1, 'ေနာင္မြန္းၿမိဳ႕'),
(13, 1, 'ပန္နန္းဒင္ၿမိဳ႕'),
(14, 1, 'ပန္ဝါၿမိဳ႕'),
(15, 1, 'ပူတာအိုၿမိဳ႕'),
(16, 1, 'ဖားကန႔္ၿမိဳ႕'),
(17, 1, 'ဗန္းေမာ္ၿမိဳ႕'),
(18, 1, 'မံစီၿမိဳ႕'),
(19, 1, 'မခ်မ္းေဘာၿမိဳ႕'),
(20, 1, 'ျမစ္ႀကီးနားၿမိဳ႕'),
(21, 1, 'ၿမိဳ႕လွၿမိဳ႕'),
(22, 1, 'မိုးေကာင္းၿမိဳ႕'),
(23, 1, 'မိုးညႇင္းၿမိဳ႕'),
(24, 1, 'မိုးေမာက္ၿမိဳ႕'),
(25, 1, 'ေ႐ႊကူၿမိဳ႕'),
(26, 1, 'ရွင္ေဗြယန္ၿမိဳ႕'),
(27, 1, 'လြယ္ဂ်ယ္ၿမိဳ႕'),
(28, 1, 'ဝိုင္းေမာ္ၿမိဳ႕'),
(29, 1, 'ဟိုပင္ၿမိဳ႕'),
(30, 1, 'အင္ဂ်န္းယန္ၿမိဳ႕ '),
(31, 2, 'ဒီး​ေမာ့ဆိုၿမိဳ႕'),
(32, 2, 'နန္းမယ္ခုံၿမိဳ႕'),
(33, 2, 'ဖ႐ူဆိုးၿမိဳ႕'),
(34, 2, 'ဖား​ေဆာင္းၿမိဳ႕'),
(35, 2, '​​ေဘာလခဲၿမိဳ႕'),
(36, 2, 'မယ္စဲ့ၿမိဳ႕'),
(37, 2, '​ေမာ္ခ်ီးၿမိဳ႕'),
(38, 2, '႐ြာသစ္ၿမိဳ႕'),
(39, 2, 'ရွား​ေတာၿမိဳ႕'),
(40, 2, 'လြိဳင္​ေကာ္ၿမိဳ႕'),
(41, 2, 'လြိဳင္လင္​ေလးၿမိဳ႕'),
(42, 3, 'ကတိုး'),
(43, 3, 'ကတိုင္တိ'),
(44, 3, 'ကမေမာင္း'),
(45, 3, 'ေကာ့ဘိန္း'),
(46, 3, 'ေကာ့ဂိုး'),
(47, 3, 'ေကာ့လႅိူး'),
(48, 3, 'ကြၽန္းေခ်ာင္း'),
(49, 3, 'က်ိဳက္ဒုံ'),
(50, 3, 'က်ဳံခဝန္'),
(51, 3, 'က်ဳံဒိုးၿမိဳ႕'),
(52, 3, 'ေက်ာက္ညႇပ္'),
(53, 3, 'ၾကာအင္းဆိပ္ႀကီး'),
(54, 3, 'ခရား'),
(55, 3, 'ခလယ္'),
(56, 3, 'ေခ်ာင္ႏွစ္ခြ'),
(57, 3, 'ဇာသျပင္'),
(58, 3, 'တံခြန္တိုင္'),
(59, 3, 'ေတာင္ကေလး'),
(60, 3, 'ေတာင္ဒီး'),
(61, 3, 'ေတာင္ဝိုင္း'),
(62, 3, 'ထိမံထို'),
(63, 3, 'ထီလုံ'),
(64, 3, 'ထုံးအိုင္႐ြာ'),
(65, 3, 'ဒါးကြင္း'),
(66, 3, 'ေဒၚလမ္း'),
(67, 3, 'နတ္ေတာင္'),
(68, 3, 'နဘူး'),
(69, 3, 'ေနာင္ကၿမိဳင္'),
(70, 3, 'ေနာင္လုံ'),
(71, 3, 'ပိုင္က်ဳံ'),
(72, 3, 'ဖအိုးထ'),
(73, 3, 'ဖာပြန္'),
(74, 3, 'ဖားျပ'),
(75, 3, 'ဘုရားသုံးဆူ'),
(76, 3, 'ေဘာဂလိႀကီး'),
(77, 3, 'မဝိုင္း'),
(78, 3, 'မိေက်ာင္း'),
(79, 3, 'မက္သေရာ'),
(80, 3, 'မယ္ပလဲ'),
(81, 3, 'ၿမိဳင္ႀကီးငူ'),
(82, 3, 'ၿမိဳင္ကေလး'),
(83, 3, 'ယင္းပိုင္'),
(84, 3, 'ယာဒို'),
(85, 3, 'ေရပူ'),
(86, 3, 'ေ႐ႊဂြန္း'),
(87, 3, 'လဂြန္းပ်ိဳ'),
(88, 3, 'လႈိင္းဘြဲ႕'),
(89, 3, 'လိပ္သိုၿမိဳ႕'),
(90, 3, 'ဝင္းက'),
(91, 3, 'ဝင္းကနား'),
(92, 3, 'သံေတာင္'),
(93, 3, 'သံေတာင္ႀကီး'),
(94, 3, 'သံလွယ္'),
(95, 3, 'အနန္းကြင္း'),
(96, 3, 'အိႏၵဳ'),
(97, 3, 'ဒိုင္းျပ'),
(98, 3, 'ျမဝတီၿမိဳ႕'),
(99, 3, 'စုကလိၿမိဳ႕'),
(100, 3, 'ေဝါေလၿမိဳင္ၿမိဳ႕'),
(101, 3, 'ေလာ့ေခၚ'),
(102, 3, 'ေကာ့ကဒါ'),
(103, 3, 'ေကာ့ပေနာ့'),
(104, 4, 'ကန္ပက္လက္ၿမိဳ႕'),
(105, 4, 'က်ီခါးၿမိဳ႕'),
(106, 4, 'ခိုင္ကမ္းၿမိဳ႕'),
(107, 4, 'ဆမီးၿမိဳ႕'),
(108, 4, 'ဆူခြာရ္းၿမိဳ႕'),
(109, 4, 'တြန္းဇံၿမိဳ႕'),
(110, 4, 'တီးတိန္ၿမိဳ႕'),
(111, 4, 'ထန္တလန္ၿမိဳ႕'),
(112, 4, 'ႏွာဟရိန္ၿမိဳ႕'),
(113, 4, 'ပလက္ဝၿမိဳ႕'),
(114, 4, 'ဖလမ္းၿမိဳ႕'),
(115, 4, 'မကြီအိမ္ႏူးၿမိဳ႕'),
(116, 4, 'မတူပီၿမိဳ႕'),
(117, 4, 'မင္းတပ္ၿမိဳ႕'),
(118, 4, 'ရိေခါဒၿမိဳ႕'),
(119, 4, '​ေရဇြာၿမိဳ႕'),
(120, 4, 'လိုင္လင္းပီၿမိဳ႕'),
(121, 4, 'ဟားခါးၿမိဳ႕'),
(122, 5, 'ကနီၿမိဳ႕နယ္'),
(123, 5, 'ကန႔္ဘလူၿမိဳ႕နယ္'),
(124, 5, 'ကေလးၿမိဳ႕နယ္'),
(125, 5, 'ကေလးဝၿမိဳ႕နယ္'),
(126, 5, 'ကသာၿမိဳ႕နယ္'),
(127, 5, 'ေကာလင္းၿမိဳ႕နယ္'),
(128, 5, 'ကြၽန္းလွၿမိဳ႕နယ္'),
(129, 5, 'ခင္ဦးၿမိဳ႕နယ္'),
(130, 5, 'ခႏၲီးၿမိဳ႕နယ္'),
(131, 5, 'ေခ်ာင္းဦးၿမိဳ႕နယ္'),
(132, 5, 'စစ္ကိုင္းၿမိဳ႕နယ္'),
(133, 5, 'ဆားလင္းႀကီးၿမိဳ႕နယ္'),
(134, 5, 'တန႔္ဆည္ၿမိဳ႕နယ္'),
(135, 5, 'တမူးၿမိဳ႕နယ္'),
(136, 5, 'ထီးခ်ိဳင့္ၿမိဳ႕နယ္'),
(137, 5, 'ဒီပဲယင္းၿမိဳ႕နယ္'),
(138, 5, 'နန္းယြန္းၿမိဳ႕နယ္'),
(139, 5, 'ပင္လယ္ဘူးၿမိဳ႕နယ္'),
(140, 5, 'ပုလဲၿမိဳ႕နယ္'),
(141, 5, 'ေဖာင္းျပင္ၿမိဳ႕နယ္'),
(142, 5, 'ဗန္းေမာက္ၿမိဳ႕နယ္'),
(143, 5, 'ဘုတလင္ၿမိဳ႕နယ္'),
(144, 5, 'မင္းကင္းၿမိဳ႕နယ္'),
(145, 5, 'မုံ႐ြာၿမိဳ႕နယ္'),
(146, 5, 'ေမာ္လိုက္ၿမိဳ႕နယ္'),
(147, 5, 'ျမင္းမူၿမိဳ႕နယ္'),
(148, 5, 'ေျမာင္ၿမိဳ႕နယ္'),
(149, 5, 'ယင္းမာပင္ၿမိဳ႕နယ္'),
(150, 5, 'ေရဦးၿမိဳ႕နယ္'),
(151, 5, 'ေ႐ႊဘိုၿမိဳ႕နယ္'),
(152, 5, 'လဟယ္ၿမိဳ႕နယ္'),
(153, 5, 'ေလရွီးၿမိဳ႕နယ္'),
(154, 5, 'ဝက္လက္ၿမိဳ႕နယ္'),
(155, 5, 'ဝန္းသိုၿမိဳ႕နယ္'),
(156, 5, 'ဟုမၼလင္းၿမိဳ႕နယ္'),
(157, 5, 'အင္းေတာ္ၿမိဳ႕နယ္'),
(158, 5, 'အရာေတာ္ၿမိဳ႕နယ္'),
(159, 6, 'ကြၽဲမင္းကုန္း'),
(160, 6, 'ကနက္သိရီ'),
(161, 6, 'ေက်ာက္ခေမာက္'),
(162, 6, 'ကံပုံတလို'),
(163, 6, 'ကေထာင္းနီ'),
(164, 6, 'ကလိန္ေအာင္'),
(165, 6, 'ကလုံးတား'),
(166, 6, 'ကံေပါက္'),
(167, 6, 'ကရသူရီ'),
(168, 6, 'ေက်ာက္မဲေတာင္'),
(169, 6, 'ေက်ာက္ေတာင္'),
(170, 6, 'ေက်ာင္တုံး'),
(171, 6, 'ကြၽဲကူး'),
(172, 6, 'ေခ်ာင္းဝျပင္'),
(173, 6, 'ခ်ဴပန္း'),
(174, 6, 'စုံစင္ဖ်ား'),
(175, 6, 'ဆင္ဒင္'),
(176, 6, 'ဆင္ျဖဴတိုင္'),
(177, 6, 'ဇလြတ္'),
(178, 6, 'တကူ'),
(179, 6, 'တနသၤာရီ'),
(180, 6, 'ေတာင္ေပ်ာက္'),
(181, 6, 'နဘူးလယ္'),
(182, 6, 'နန္းသြန္'),
(183, 6, 'နန္ဒင္'),
(184, 6, 'နတ္ႀကီးစင္'),
(185, 6, 'ႏွမ္းႀကဲ'),
(186, 6, 'ပကာရီ'),
(187, 6, 'ပေလာက္'),
(188, 6, 'ပုေလာ'),
(189, 6, 'ပဲ'),
(190, 6, 'ပလ'),
(191, 6, 'ပင္လယ္ကမ္း'),
(192, 6, 'ျပင္ဘုံႀကီး'),
(193, 6, 'ဘုတ္ျပင္း'),
(194, 6, 'ဘန္ကခြၽန္း'),
(195, 6, 'မလိဝမ္း'),
(196, 6, 'မရမ္း'),
(197, 6, 'ေမာင္းမကန္'),
(198, 6, 'မိေက်ာင္းေလွာင္'),
(199, 6, 'ၿမိတ္'),
(200, 6, 'ေမတၱာ'),
(201, 6, 'ရငဲ'),
(202, 6, 'ရတနာပုံ'),
(203, 6, 'ေရျဖဴ'),
(204, 6, 'ေလာင္းလုံး'),
(205, 6, 'ေလညာ'),
(206, 6, 'လိပ္ဥေခ်ာင္း'),
(207, 6, 'ဝဇြမ္းေခ်ာင္း'),
(208, 6, 'သမုတ္'),
(209, 6, 'သေဘာ့လိပ္'),
(210, 6, 'သက်က္ေတာ့'),
(211, 6, 'သမ္းလွ'),
(212, 6, 'သရက္ေခ်ာင္း'),
(213, 6, 'သာရဘြင္'),
(214, 6, 'ဟာျမင္းႀကီး'),
(215, 6, 'ဟိႏၵား'),
(216, 6, 'အုံးပင္ကြင္း'),
(217, 7, 'ဥတၱရသီရိၿမိဳ႕နယ္'),
(218, 7, 'ပုဗၺသီရိၿမိဳ႕နယ္'),
(219, 7, 'တပ္ကုန္းၿမိဳ႕နယ္'),
(220, 7, 'ေဇယ်ာသီရိၿမိဳ႕နယ္'),
(221, 7, 'ဒကၡိဏသီရိၿမိဳ႕နယ္'),
(222, 7, 'လယ္ေဝးၿမိဳ႕နယ္'),
(223, 7, 'ပ်ဥ္းမနားၿမိဳ႕နယ္'),
(224, 7, 'ဇမၺဴသီရိၿမိဳ႕နယ္'),
(225, 8, 'ကၫႊတ္ကြင္းၿမိဳ႕'),
(226, 8, 'ကဝၿမိဳ႕'),
(227, 8, 'ေကတုမတီၿမိဳ႕'),
(228, 8, 'ေက်ာက္ႀကီးၿမိဳ႕'),
(229, 8, 'ေက်ာက္တံခါးၿမိဳ႕'),
(230, 8, 'ႀကိဳ႕ပင္ေကာက္ၿမိဳ႕'),
(231, 8, 'ဆြာၿမိဳ႕'),
(232, 8, 'ဇီးကုန္းၿမိဳ႕'),
(233, 8, 'ေဇယ်ဝတီၿမိဳ႕'),
(234, 8, 'ေညာင္ေလးပင္ၿမိဳ႕'),
(235, 8, 'ေတာင္ငူၿမိဳ႕'),
(236, 8, 'ထန္းတပင္ၿမိဳ႕၊ ေတာင္ငူခ႐ိုင္'),
(237, 8, 'ဒိုက္ဦးၿမိဳ႕'),
(238, 8, 'နတ္တလင္းၿမိဳ႕'),
(239, 8, 'ပန္းေတာင္းၿမိဳ႕'),
(240, 8, 'ပိန္းဇလုပ္ၿမိဳ႕'),
(241, 8, 'ပုတီးကုန္းၿမိဳ႕'),
(242, 8, 'ေပါက္ေခါင္းၿမိဳ႕'),
(243, 8, 'ေပါင္းတည္ၿမိဳ႕'),
(244, 8, 'ေပါင္းတလည္ၿမိဳ႕'),
(245, 8, 'ပဲခူးၿမိဳ႕'),
(246, 8, 'ပဲႏြယ္ကုန္းၿမိဳ႕'),
(247, 8, 'ျပည္ၿမိဳ႕'),
(248, 8, 'ႁပြန္တန္ဆာၿမိဳ႕'),
(249, 8, 'ဖဒိုၿမိဳ႕'),
(250, 8, 'ျဖဴးၿမိဳ႕'),
(251, 8, 'ဘုရားႀကီးၿမိဳ႕'),
(252, 8, 'မင္းလွၿမိဳ႕၊ သာယာဝတီခ႐ိုင္'),
(253, 8, 'မေဒါက္ၿမိဳ႕'),
(254, 8, 'မိုးညိဳၿမိဳ႕'),
(255, 8, 'ၿမိဳ႕လွၿမိဳ႕၊ ေတာင္ငူခ႐ိုင္'),
(256, 8, 'ေရတာရွည္ၿမိဳ႕'),
(257, 8, 'ေရနီၿမိဳ႕'),
(258, 8, 'ေ႐ႊက်င္ၿမိဳ႕'),
(259, 8, 'ေ႐ႊေတာင္ၿမိဳ႕'),
(260, 8, 'လက္ပံတန္းၿမိဳ႕'),
(261, 8, 'ေဝါၿမိဳ႕'),
(262, 8, 'သကၠလၿမိဳ႕'),
(263, 8, 'သနပၸင္ၿမိဳ႕'),
(264, 8, 'သာယာဝတီၿမိဳ႕'),
(265, 8, 'သုံးဆယ္ၿမိဳ႕'),
(266, 8, 'သဲကုန္းၿမိဳ႕'),
(267, 8, 'အင္းတေကာ္ၿမိဳ႕'),
(268, 8, 'အင္းမၿမိဳ႕'),
(269, 8, 'အုတ္တြင္းၿမိဳ႕'),
(270, 8, 'အုတ္ဖိုၿမိဳ႕'),
(271, 8, 'ဥသွ်စ္ပင္ၿမိဳ႕'),
(272, 9, 'ကမၼၿမိဳ႕နယ္'),
(273, 9, 'ေခ်ာက္ၿမိဳ႕နယ္'),
(274, 9, 'ဂန႔္ေဂါၿမိဳ႕နယ္'),
(275, 9, 'ငဖဲၿမိဳ႕နယ္'),
(276, 9, 'စလင္းၿမိဳ႕နယ္'),
(277, 9, 'ေစတုတၱရာၿမိဳ႕နယ္'),
(278, 9, 'ဆိပ္ျဖဴၿမိဳ႕နယ္'),
(279, 9, 'ေဆာၿမိဳ႕နယ္'),
(280, 9, 'ဆင္ေပါင္ဝဲၿမိဳ႕နယ္'),
(281, 9, 'ေတာင္တြင္းႀကီးၿမိဳ႕နယ္'),
(282, 9, 'ထီးလင္းၿမိဳ႕နယ္'),
(283, 9, 'နတ္ေမာက္ၿမိဳ႕နယ္'),
(284, 9, 'ပြင့္ျဖဴၿမိဳ႕နယ္'),
(285, 9, 'ပခုကၠဴၿမိဳ႕နယ္'),
(286, 9, 'ေပါက္ၿမိဳ႕နယ္'),
(287, 9, 'မေကြးၿမိဳ႕နယ္'),
(288, 9, 'မင္းဘူး(စကု)ၿမိဳ႕နယ္'),
(289, 9, 'ၿမိဳင္ၿမိဳ႕နယ္'),
(290, 9, 'မင္းတုန္းၿမိဳ႕နယ္'),
(291, 9, 'မင္းလွၿမိဳ႕နယ္ (အထက္မင္းလွ)'),
(292, 9, 'ၿမိဳ႕သစ္ၿမိဳ႕နယ္'),
(293, 9, 'ေရစႀကိဳၿမိဳ႕နယ္'),
(294, 9, 'ေရနံေခ်ာင္းၿမိဳ႕နယ္'),
(295, 9, 'သရက္ၿမိဳ႕နယ္'),
(296, 9, 'ေအာင္လံၿမိဳ႕နယ္'),
(297, 10, 'ေက်ာက္ဆည္ၿမိဳ႕'),
(298, 10, 'ေက်ာက္ပန္းေတာင္းၿမိဳ႕'),
(299, 10, 'ငါန္းဇြန္ၿမိဳ႕'),
(300, 10, 'ငါန္းျမာႀကီးၿမိဳ႕'),
(301, 10, 'ငါ့သေရာက္ၿမိဳ႕'),
(302, 10, 'စဥ့္ကိုင္ၿမိဳ႕'),
(303, 10, 'စဥ့္ကူးၿမိဳ႕'),
(304, 10, 'စမၸာယ္နဂိုရ္'),
(305, 10, 'ေညာင္ဦးၿမိဳ႕'),
(306, 10, 'တေကာင္း'),
(307, 10, 'တပ္ကုန္းၿမိဳ႕'),
(308, 10, 'ေတာင္သာၿမိဳ႕'),
(309, 10, 'တံတားဦးၿမိဳ႕'),
(310, 10, 'ႏြားထိုးႀကီးၿမိဳ႕'),
(311, 10, 'ပင္းယၿမိဳ႕'),
(312, 10, 'ပလိပ္ၿမိဳ႕'),
(313, 10, 'ပုဂံ'),
(314, 10, 'ပုဂံၿမိဳ႕သစ္'),
(315, 10, 'ပုဂံၿမိဳ႕ေဟာင္း'),
(316, 10, 'ပုသိမ္ႀကီးၿမိဳ႕'),
(317, 10, 'ေပ်ာ္ဘြယ္ၿမိဳ႕'),
(318, 10, 'ျပင္ဦးလြင္ၿမိဳ႕'),
(319, 10, 'မတၱရာၿမိဳ႕'),
(320, 10, 'မႏၲေလးၿမိဳ႕'),
(321, 10, 'မလႈိင္ၿမိဳ႕'),
(322, 10, 'မိတၳီလာၿမိဳ႕'),
(323, 10, 'မိုင္းေမာၿမိဳ႕ေဟာင္း'),
(324, 10, 'မိုးကုတ္ၿမိဳ႕'),
(325, 10, 'ျမင္စိုင္း'),
(326, 10, 'ျမင္းၿခံၿမိဳ႕'),
(327, 10, 'ျမစ္ငယ္ၿမိဳ႕'),
(328, 10, 'ျမစ္သားၿမိဳ႕'),
(329, 10, 'မ​တၱ​ရာ​ၿမိဳ႕'),
(330, 10, 'ရတနာပုံ နည္းပညာ ၿမိဳ႕သစ္'),
(331, 10, 'ရမည္းသင္းၿမိဳ႕'),
(332, 10, 'လႈိင္းတက္ၿမိဳ႕ေဟာင္း'),
(333, 10, 'ဝတီးၿမိဳ႕ေဟာင္း'),
(334, 10, 'ဝမ္းတြင္းၿမိဳ႕'),
(335, 10, 'သပိတ္က်င္းၿမိဳ႕'),
(336, 10, 'သရက္ခုံ(ေရဇင္း)ၿမိဳ႕ေဟာင္း'),
(337, 10, 'သာစည္ၿမိဳ႕'),
(338, 10, 'အင္းဝၿမိဳ႕'),
(339, 10, 'အမရပူရၿမိဳ႕'),
(340, 11, 'က်ိဳက္မေရာၿမိဳ႕နယ္'),
(341, 11, 'က်ိဳက္ထိုၿမိဳ႕နယ္'),
(342, 11, 'ေခ်ာင္းဆုံၿမိဳ႕နယ္'),
(343, 11, 'ေပါင္းၿမိဳ႕နယ္'),
(344, 11, 'ဘီလင္းၿမိဳ႕နယ္'),
(345, 11, 'ေမာ္လၿမိဳင္ၿမိဳ႕'),
(346, 11, 'မုဒုံၿမိဳ႕နယ္'),
(347, 11, 'ရဲၿမိဳ႕နယ္'),
(348, 11, 'သထုံၿမိဳ႕နယ္'),
(349, 11, 'သံျဖဴဇရပ္ၿမိဳ႕နယ္'),
(350, 12, 'ေက်ာက္ျဖဴၿမိဳ႕'),
(351, 12, 'ေက်ာက္ေတာ္ၿမိဳ႕'),
(352, 12, 'ဂြၿမိဳ႕'),
(353, 12, 'စစ္ေတြၿမိဳ႕'),
(354, 12, 'ေတာင္ကုတ္'),
(355, 12, 'ပုဏၰားကြၽန္းၿမိဳ႕'),
(356, 12, 'ေပါက္ေတာၿမိဳ႕'),
(357, 12, 'ဘူးသီးေတာင္ၿမိဳ႕'),
(358, 12, 'ေမာင္ေတာၿမိဳ႕'),
(359, 12, 'မင္းျပားၿမိဳ႕'),
(360, 12, 'ေျမာက္ဦး'),
(361, 12, 'မာန္ေအာင္ၿမိဳ႕'),
(362, 12, 'ေျမပုံၿမိဳ႕'),
(363, 12, 'ရမ္းၿဗဲၿမိဳ႕'),
(364, 12, 'ရေသ့ေတာင္ၿမိဳ႕'),
(365, 12, 'သံတြဲၿမိဳ႕'),
(366, 12, 'အမ္းၿမိဳ႕'),
(367, 13, 'ကမာ႐ြတ္ၿမိဳ႕နယ္'),
(368, 13, 'ေကာ့မႉးၿမိဳ႕နယ္'),
(369, 13, 'ေက်ာက္တံတားၿမိဳ႕နယ္'),
(370, 13, 'ၾကည့္ျမင္တိုင္ၿမိဳ႕နယ္'),
(371, 13, 'ကြမ္းၿခံကုန္းၿမိဳ႕နယ္'),
(372, 13, 'ေက်ာက္တန္းၿမိဳ႕နယ္'),
(373, 13, 'ကိုကိုးကြၽန္းၿမိဳ႕နယ္'),
(374, 13, 'ခရမ္းၿမိဳ႕နယ္'),
(375, 13, 'စမ္းေခ်ာင္းၿမိဳ႕နယ္'),
(376, 13, 'ဆိပ္ႀကီးခေနာင္တိုၿမိဳ႕နယ္'),
(377, 13, 'ေတာင္ဥကၠလာပၿမိဳ႕နယ္'),
(378, 13, 'ဒဂုံၿမိဳ႕နယ္'),
(379, 13, 'ဒဂုံၿမိဳ႕သစ္ေတာင္ပိုင္း'),
(380, 13, 'ဒဂုံၿမိဳ႕သစ္ေျမာက္ပိုင္း'),
(381, 13, 'ဒဂုံၿမိဳ႕သစ္အေရွ႕ပိုင္း'),
(382, 13, 'ဒဂုံၿမိဳ႕သစ္ဆိပ္ကမ္း'),
(383, 13, 'ဒလၿမိဳ႕နယ္'),
(384, 13, 'ေဒါပုံၿမိဳ႕နယ္'),
(385, 13, 'ပုဇြန္ေတာင္ၿမိဳ႕နယ္'),
(386, 13, 'ပန္းဘဲတန္းၿမိဳ႕နယ္'),
(387, 13, 'ဗိုလ္တေထာင္ၿမိဳ႕နယ္'),
(388, 13, 'ဗဟန္းၿမိဳ႕နယ္'),
(389, 13, 'မရမ္းကုန္းၿမိဳ႕နယ္'),
(390, 13, 'ေျမာက္ဉကၠလာပ'),
(391, 13, 'မဂၤလာ‌ေတာင္ၫြန႔္ၿမိဳ႕နယ္'),
(392, 13, 'တာေမြၿမိဳ႕နယ္'),
(393, 13, 'တြံေတးၿမိဳ႕နယ္'),
(394, 13, 'တိုက္ႀကီးၿမိဳ႕နယ္'),
(395, 13, 'ထန္းတပင္ၿမိဳ႕နယ္'),
(396, 13, 'ေမွာ္ဘီၿမိဳ႕နယ္'),
(397, 13, 'ေျမာက္‌ဥကၠလာပၿမိဳ႕နယ္'),
(398, 13, 'ရန္ကင္းၿမိဳ႕နယ္'),
(399, 13, 'ေ႐ႊျပည္သာၿမိဳ႕နယ္'),
(400, 13, 'လႈိင္ၿမိဳ႕နယ္'),
(401, 13, 'လႈိင္သာယာၿမိဳ႕နယ္'),
(402, 13, 'လသာၿမိဳ႕နယ္'),
(403, 13, 'လွည္းကူးၿမိဳ႕နယ္'),
(404, 13, 'လမ္းမေတာ္ၿမိဳ႕နယ္'),
(405, 13, 'သဃၤန္းကြၽန္းၿမိဳ႕နယ္'),
(406, 13, 'သေကတၿမိဳ႕နယ္'),
(407, 13, 'သန္လ်င္ၿမိဳ႕နယ္'),
(408, 13, 'သုံးခြၿမိဳ႕နယ္'),
(409, 13, 'အလုံၿမိဳ႕နယ္'),
(410, 13, 'အင္းစိန္ၿမိဳ႕နယ္'),
(411, 14, 'က‌ေလာ'),
(412, 14, 'က်ိဳင္းတုံ'),
(413, 14, '‌ေက်ာက္မဲ'),
(414, 14, '‌ကြတ္ခိုင္'),
(415, 14, 'ေညာင္‌‌ေ႐ႊ'),
(416, 14, 'တာခ်ီလိတ္'),
(417, 14, 'ေတာင္ႀကီး'),
(418, 14, 'နမၼတူ'),
(419, 14, '‌နမ့္ခမ္း'),
(420, 14, 'နမ့္စမ္'),
(421, 14, 'ေနာင္ခ်ိဳ'),
(422, 14, 'ဟိုပုန္း'),
(423, 14, '‌ပင္လုံ'),
(424, 14, 'ပင္းတယ'),
(425, 14, 'မိုးၿဗဲ'),
(426, 14, 'မိုင္းကိုင္'),
(427, 14, 'မိုင္းဆတ္'),
(428, 14, 'မိုင္းပြန္'),
(429, 14, 'မိုင္းရႉး'),
(430, 14, 'မူဆယ္'),
(431, 14, 'ေ႐ႊေညာင္'),
(432, 14, 'လားရႈိး'),
(433, 14, 'လြိဳင္လင္'),
(434, 14, 'လင္းေခး'),
(435, 14, 'သီေပါ'),
(436, 14, 'ေအာင္ပန္း'),
(437, 15, 'ကြင္းေကာက္'),
(438, 15, 'က်ိဳက္လတ္'),
(439, 15, 'က်ဳံးဒါး'),
(440, 15, 'က်ဳံကဒြန္း'),
(441, 15, 'က်ဳံမေငး'),
(442, 15, 'ကဒုံကနိ'),
(443, 15, 'ခေမာက္စု'),
(444, 15, 'စေကၠာ့'),
(445, 15, 'စက္ဆန္း'),
(446, 15, 'ဆကာႀကီး'),
(447, 15, 'ဆင္မ'),
(448, 15, 'ဇီးခ်ိဳင္'),
(449, 15, 'တဂရက္'),
(450, 15, 'ေတာင္ကေလး'),
(451, 15, 'တလုေတၳာ္'),
(452, 15, 'ထူးႀကီး'),
(453, 15, 'ဒါးက'),
(454, 15, 'ဓမိ'),
(455, 15, 'နိဗၺာန္'),
(456, 15, 'ပသြယ္'),
(457, 15, 'ျပင္ခ႐ိုင္'),
(458, 15, 'ပ်ဥ္႐ြာ'),
(459, 15, 'ေဘာ္မိ'),
(460, 15, 'မဲဇလီကုန္း'),
(461, 15, 'ျမင္းကကုန္း'),
(462, 15, 'ၿမိဳ႕ကြင္း'),
(463, 15, '​​ ေ႐ြးကုန္'),
(464, 15, 'ရွမ္း႐ြာ'),
(465, 15, 'ေရွာျပာ'),
(466, 15, 'ေ႐ႊေလာင္း'),
(467, 15, 'ေ႐ႊျမင္တင္'),
(468, 15, 'ေ႐ႊေတာင္ေမွာ္'),
(469, 15, 'ေရလဲကေလး'),
(470, 15, '႐ြာသစ္'),
(471, 15, 'လူေခါင္းကြၽန္း'),
(472, 15, 'သစ္ျပဳတ္'),
(473, 15, 'သုံးခြ'),
(474, 15, 'အုန္းပင္'),
(475, 15, 'အင္ပင္'),
(476, 15, 'အေဖ်ာက္'),
(477, 15, 'အသုတ္'),
(478, 15, 'အိုင္သျပဳ'),
(479, 13, 'မဂၤလာဒံုျမိဳ႕နယ္'),
(480, 13, 'ေထာက္ၾကန္႕ျမိဳ႕နယ္'),
(481, 15, 'ပုသိမ္ျမိဳ႕နယ္'),
(482, 3, 'ပုသိမ္ျမိဳ႕နယ္'),
(483, 13, 'လွည္းတန္းျမို႕နယ္'),
(484, 3, 'ဘားအံျမို႕');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Curvy WT', 'userone@gmail.com', NULL, '$2y$10$J31Ycoaa2Ha9ob.cBhChB.8IcE3fN7WnmQHctm8xkCVfRO5hsZvym', NULL, '2019-12-22 03:14:53', '2019-12-22 03:14:53'),
(2, 'Admin', 'admin@admin.com', NULL, '$2y$10$AnmcckDA/6VURPYP4j28tuXaQb6VeZWZfyNP7W.ebgOg7nbXsBekS', NULL, '2020-01-26 11:57:09', '2020-01-26 11:57:09'),
(3, 'IntimeOS', 'jerome.vale123@gmail.com', NULL, '$2y$10$7j04BpxzbF7I4/59XCstyedLNnEjZQTWZzJnK1EJ0VFLGWGL1olxi', NULL, '2020-02-07 08:18:14', '2020-02-07 08:18:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_ledger`
--
ALTER TABLE `account_ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `convert_route`
--
ALTER TABLE `convert_route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_postman`
--
ALTER TABLE `delivery_postman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_staff`
--
ALTER TABLE `office_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_shop`
--
ALTER TABLE `online_shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_temp`
--
ALTER TABLE `order_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcel`
--
ALTER TABLE `parcel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postman`
--
ALTER TABLE `postman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postman_location`
--
ALTER TABLE `postman_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postman_route`
--
ALTER TABLE `postman_route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `route_plan`
--
ALTER TABLE `route_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_planning`
--
ALTER TABLE `route_planning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_in_out_return`
--
ALTER TABLE `stock_in_out_return`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `township`
--
ALTER TABLE `township`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `account_ledger`
--
ALTER TABLE `account_ledger`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `convert_route`
--
ALTER TABLE `convert_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delivery_postman`
--
ALTER TABLE `delivery_postman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `office_staff`
--
ALTER TABLE `office_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `online_shop`
--
ALTER TABLE `online_shop`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `order_temp`
--
ALTER TABLE `order_temp`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `parcel`
--
ALTER TABLE `parcel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `postman`
--
ALTER TABLE `postman`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `postman_location`
--
ALTER TABLE `postman_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `postman_route`
--
ALTER TABLE `postman_route`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2386;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `route_plan`
--
ALTER TABLE `route_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
--
-- AUTO_INCREMENT for table `route_planning`
--
ALTER TABLE `route_planning`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_in_out_return`
--
ALTER TABLE `stock_in_out_return`
  MODIFY `stock_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_out`
--
ALTER TABLE `stock_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `township`
--
ALTER TABLE `township`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=485;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
