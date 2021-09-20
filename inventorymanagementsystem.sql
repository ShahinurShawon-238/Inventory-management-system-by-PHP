-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2020 at 08:13 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorymanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminName`, `adminPassword`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`, `status`) VALUES
(1, 'LG', 'In stock'),
(2, 'Eco+', 'In stock'),
(4, 'Vivo', 'In stock'),
(5, 'Xiaomi', 'In stock');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `status`) VALUES
(4, 'Laptop', 'In stock'),
(5, 'C.P.U.', 'In stock'),
(6, 'Mobile', 'In stock'),
(7, 'TV', 'In stock'),
(8, 'Fridge', 'In stock');

-- --------------------------------------------------------

--
-- Table structure for table `orderproduct`
--

CREATE TABLE `orderproduct` (
  `id` int(11) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `subTotal` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderproduct`
--

INSERT INTO `orderproduct` (`id`, `date_time`, `subTotal`, `paid`, `balance`) VALUES
(78, '2020-12-15 00:21:38', 1125500, 1125500, 0),
(79, '2020-12-15 00:44:04', 1125500, 1125500, 0),
(80, '2020-12-15 00:44:40', 1200500, 1200500, 0),
(81, '2020-12-15 00:45:07', 1200500, 1200500, 0),
(82, '2020-12-15 00:45:44', 1222000, 1222000, 0),
(83, '2020-12-15 00:46:56', 1222000, 1222000, 0),
(84, '2020-12-15 00:47:16', 1672000, 1672000, 0),
(85, '2020-12-15 00:49:12', 1795000, 1795000, 0),
(86, '2020-12-15 00:54:51', 1918000, 1918000, 0),
(87, '2020-12-15 01:27:55', 1918000, 1918000, 0),
(88, '2020-12-15 01:34:24', 1918000, 1918000, 0),
(89, '2020-12-15 01:35:31', 1918000, 1918000, 0),
(90, '2020-12-15 01:35:49', 1918000, 1918000, 0),
(91, '2020-12-15 01:38:37', 2143000, 2143000, 0),
(92, '2020-12-15 01:40:29', 2218000, 8000, -2210000),
(93, '2020-12-15 01:46:42', 2196500, 2196500, 0),
(94, '2020-12-15 01:47:40', 289500, 289500, 0),
(95, '2020-12-15 01:51:02', 43000, 43000, 0),
(96, '2020-12-15 05:15:18', 75000, 75000, 0),
(97, '2020-12-15 17:13:26', 150000, 150000, 150000),
(98, '2020-12-15 17:14:00', 75000, 75000, 75000),
(99, '2020-12-15 17:14:26', 75000, 75000, 75000),
(100, '2020-12-15 17:16:12', 75000, 75000, 75000),
(101, '2020-12-15 17:16:41', 75000, 750000, 675000),
(102, '2020-12-15 17:27:33', 75000, 750000, 675000),
(103, '2020-12-15 17:29:22', 21500, 21500, 0),
(104, '2020-12-15 17:31:56', 132500, 132500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `image` longtext NOT NULL,
  `description` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `cost_price` int(11) NOT NULL,
  `retail_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product`, `image`, `description`, `category`, `brand`, `cost_price`, `retail_price`, `quantity`, `barcode`, `status`) VALUES
(4, 'Smart Phone', 'productPhoto/0038136-vivo-s1-pro-black8gb-ram-128gb-storage-250.jpg', 'It\'s a smartphone.', 'Mobile', 'Vivo', 18000, 21500, 4, '111VSM', 'In stock'),
(7, 'Smart Phone', 'productPhoto/mi-10-ultra_1_3.jpg', 'It a 5G Phone.', 'Mobile', 'Xiaomi', 22000, 26500, 43, '7658PHX', 'In stock'),
(8, 'Frigde', 'productPhoto/GF-V706MBL-1.jpg', 'It\'s a 4 door fridge', 'Fridge', 'LG', 67000, 75000, 0, '4353FRLg', 'In stock');

-- --------------------------------------------------------

--
-- Table structure for table `productcart`
--

CREATE TABLE `productcart` (
  `id` int(11) NOT NULL,
  `productcode` varchar(255) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNumber` int(13) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phoneNumber`, `password`, `image`) VALUES
(67, 'Sheikh Shahinur Rahman Shawon', 'shahinurshawon35@gmail.com', 1954154357, '92de298000d4bde5a014fc2eddad695d', 'userphoto/DSC_5104.JPG'),
(68, 'Dwip', 'sadman16-263@diu.edu.bd', 1946534434, '48cb1cf1b5f04234113720662f3120c0', 'userphoto/DSC00265.JPG'),
(69, 'Shorif', 'shoriful16-246@diu.edu.bd', 1855654643, 'aa1d1f09e6ceb08fc5885ab957966fa4', 'userphoto/DSC00389.JPG'),
(70, 'Deen', 'deen@gmail.com', 1954464343, 'a986aac3a1f7cddc87310cbde46b0d6c', 'userphoto/DSC_5163.JPG'),
(72, 'Farhana', 'farhana@gmail.com', 1364335677, '9b990c7a2fda485914a5c4797c04b9cd', 'userphoto/DSC00283.JPG'),
(74, 'Kanta', 'kanta@gmail.com', 1684394732, 'db2a305e3a9f5a0568d35be074b0c528', 'userphoto/DSC00288.JPG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productcart`
--
ALTER TABLE `productcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orderproduct`
--
ALTER TABLE `orderproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `productcart`
--
ALTER TABLE `productcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
