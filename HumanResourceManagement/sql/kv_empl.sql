-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2015 at 04:58 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fa_keywe`
--

-- --------------------------------------------------------

--
-- Table structure for table `0_kv_empl_info`
--

CREATE TABLE IF NOT EXISTS `0_kv_empl_info` (
`empl_id` int(10) NOT NULL,
  `empl_name` varchar(100) NOT NULL,
  `pre_address` varchar(100) NOT NULL,
  `per_address` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `age` int(3) NOT NULL,
  `mobile_phone` int(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `grade` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `designation` varchar(30) NOT NULL,
  `gross_salary` int(10) NOT NULL,
  `basic` int(10) NOT NULL,
  `date_of_join` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_kv_empl_info`
--

INSERT INTO `0_kv_empl_info` (`empl_id`, `empl_name`, `pre_address`, `per_address`, `date_of_birth`, `age`, `mobile_phone`, `email`, `grade`, `department`, `designation`, `gross_salary`, `basic`, `date_of_join`) VALUES
(1, 'test empl', 'test address', 'summa', '1967-09-22', 23, 32452345, 'summa@summa.com', '', '', '', 8750, 0, '2012-09-05'),
(2, 'John vsumma', 'test addre', 'adrestwqe\n', '2015-09-02', 23, 567345234, 'John@kvcodes.com', 'Junior', 'HRM', 'Executive', 2000, 0, '2015-09-02'),
(3, 'John', 'test addre', 'adrestwqe\n', '1984-09-06', 23, 567345234, 'John@kvcodes.com', 'Junior', 'HRM', 'Executive', 3600, 300, '2015-09-02'),
(4, ' Rudolph', 'sreghs\nergs\ner', 'ghse\nr\nghse\nr', '1977-09-24', 44, 2147483647, 'Summa@kvcodes.com', 'ergse', 'sergser', 'ergserg', 9500, 500, '2014-09-03');

-- --------------------------------------------------------

--
-- Table structure for table `0_kv_empl_payslip`
--

CREATE TABLE IF NOT EXISTS `0_kv_empl_payslip` (
`id` int(10) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `empl_id` int(10) NOT NULL,
  `basic` int(10) NOT NULL,
  `da` int(10) NOT NULL,
  `hra` int(10) NOT NULL,
  `convey_allow` int(10) NOT NULL,
  `edu_other_allow` int(10) NOT NULL,
  `pf` int(10) NOT NULL,
  `lop_amount` int(10) NOT NULL,
  `tds` int(10) NOT NULL,
  `total_ded` int(10) NOT NULL,
  `total_net` int(10) NOT NULL,
  `date_of_pay` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_kv_empl_payslip`
--

INSERT INTO `0_kv_empl_payslip` (`id`, `year`, `month`, `empl_id`, `basic`, `da`, `hra`, `convey_allow`, `edu_other_allow`, `pf`, `lop_amount`, `tds`, `total_ded`, `total_net`, `date_of_pay`) VALUES
(1, 1, 3, 4, 2850, 1900, 1900, 950, 1900, 570, 1140, 0, 1960, 7540, '2015-09-24'),
(2, 1, 2, 2, 600, 400, 400, 200, 400, 120, 240, 0, 510, 1490, '2015-09-24'),
(3, 1, 1, 1, 2625, 1750, 1750, 875, 1750, 525, 1050, 0, 2025, 6725, '2015-09-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `0_kv_empl_info`
--
ALTER TABLE `0_kv_empl_info`
 ADD PRIMARY KEY (`empl_id`);

--
-- Indexes for table `0_kv_empl_payslip`
--
ALTER TABLE `0_kv_empl_payslip`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `0_kv_empl_info`
--
ALTER TABLE `0_kv_empl_info`
MODIFY `empl_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `0_kv_empl_payslip`
--
ALTER TABLE `0_kv_empl_payslip`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
