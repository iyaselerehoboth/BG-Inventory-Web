-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2018 at 03:30 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bg_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversion_waybill`
--

CREATE TABLE `conversion_waybill` (
  `id` int(11) NOT NULL,
  `waybill_id` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `quantityToConvert` varchar(15) NOT NULL,
  `originalUnitOfMeasure` varchar(15) NOT NULL,
  `conversionUnitOfMeasure` varchar(15) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `purposeForConversion` varchar(50) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `personnelName` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `transaction_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversion_waybill`
--
ALTER TABLE `conversion_waybill`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversion_waybill`
--
ALTER TABLE `conversion_waybill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
