-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2022 at 07:06 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `budaxsilog`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `customerID` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `contactNumber` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `modeOfPayment` varchar(255) NOT NULL,
  `paymentStatus` varchar(255) DEFAULT NULL,
  `orderStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `price`, `image_path`, `status`) VALUES
(1, 'chixilog', 70, 'imgs/CHIXILOG-p70.png', 'active'),
(2, 'halohalo special', 35, 'imgs/HALOHALO_SPECIAL-p35.png', 'active'),
(3, 'hungariansilog', 70, 'imgs/HUNGARIANSILOG-p70.png', 'active'),
(4, 'lechonsilog', 70, 'imgs/LECHONSILOG-p70.png', 'active'),
(5, 'mais con yelo', 25, 'imgs/MAIS_CON_YELO-p25.png', 'active'),
(6, 'overload nachos', 80, 'imgs/OVERLOAD_NACHOS-p80.png', 'active'),
(7, 'porksilog', 75, 'imgs/PORKSILOG-p75.png', 'active'),
(8, 'real cheesestick 25pcs', 50, 'imgs/REAL_CHEESESTICK_25PCS-p50.png', 'active'),
(9, 'tapsilog', 65, 'imgs/TAPSILOG-p65.png', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
