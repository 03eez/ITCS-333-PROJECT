-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 01:52 AM
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
-- Database: `333tst`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addid` int(101) NOT NULL,
  `cid` int(11) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addid`, `cid`, `address`) VALUES
(1, 1, 'muharraq'),
(2, 1, 'block 999'),
(3, 1, 'zallaq'),
(4, 1, 'zallaq'),
(5, 1, 'zallaq'),
(6, 3, 'arad'),
(7, 3, 'khobar'),
(9, 5, 'galali'),
(10, 16, 'zallaq'),
(11, 18, 'tubli'),
(12, 22, 'khobar');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catid` int(11) NOT NULL,
  `catname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `catname`) VALUES
(1, 'vegetables'),
(2, 'meat'),
(3, 'fruits '),
(4, 'drinks'),
(5, 'dairy'),
(6, 'tea&coffee'),
(7, 'Snacks ');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cid` int(11) NOT NULL,
  `cname` text NOT NULL,
  `cusername` text NOT NULL,
  `cpass` text NOT NULL,
  `cemail` text NOT NULL,
  `cphone` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cid`, `cname`, `cusername`, `cpass`, `cemail`, `cphone`) VALUES
(1, 'Ali Alsaegh', 'aloy7', '12345678', 'ali@gmail.com', 33333333),
(2, 'SAYED ALI', 'sali', '12345678', 'sayali@gmail.com', 33333333),
(3, '3z', '03eezz', '33513715A@', '3eez@gmail.com', 33513715),
(5, 'salman', 'saloom', 'An*^653A2', 'salman@gmail.com', 34096339),
(8, 'alqadhi', 'alqadhi', 'qwerrtyuioP', 'alqadhi@icloud.com', 34680091),
(10, 'sam', 'sam2', '$2y$10$d0ihmMkVgSF46vf1675cje9uRg7BlFAmReuEFg7NaJ6DdkqWFUYpm', '3lwan46@gmail.com', 34680091),
(12, 'aloo', 'haider', '$2y$10$KmLoZkUzovWFw6b11q8za.pZQrnB63HfwKnyq0jqbYe5eqlvXiBXq', 'rrfu@uob.com', 34680091),
(13, 'abood', 'abood', '$2y$10$2oUo2JE9p3rddT/QdpKInuUAnFWnedfxCDAL9NBsRTT7NCTTSVNWS', 'rrfu@uob.com', 34680091),
(15, 'slimna', 'skli', 'sdfs!324252@AS', 'rrfu@uob.com', 34680091),
(16, 'taefefw', 'rtwyuiyu', 'ASD1312!!fg', '3eez@gmail.com', 33513715),
(17, 'dadewf', 'ddsssf', 'ADF!@#qweADS', '3lwan46@gmail.com', 33513715),
(18, 'ayoob', 'ayoo', 'AYOOB1234!', 'alqadhi@icloud.com', 33513715),
(19, 'sara', 'sara', '$2y$10$5sRpnTkx4UmKs3UblVjET.9urcFqqQXz3sFieULxHvhnqtM/x1GXC', 'rrfu@uob.com', 33513715),
(20, 'slimna', 'sali0', '$2y$10$BLRbOfCEw6jlI0gj83jHn.VKC97pqqf2ZVRTo9zDsahYoecRsU0fq', '3lwan46@gmail.com', 34096339),
(21, 'slimna', 'sali09', '$2y$10$bSs00jgdIwqhs.gDOwJodeNCbfoyfbtkeyXZ3yAwUVBILUd4MQcw2', '3lwan46@gmail.com', 34096339),
(22, 'dfdf', '03eezzuy', '$2y$10$ZOZtpi574LrxjPKyzg/Ivui0OCZUlHGomrZ5yE9az.JaI/pJTHV7K', 'alawsh999@icloud.com', 34680091);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `addid` int(11) NOT NULL,
  `totalprice` varchar(11) NOT NULL,
  `status` text NOT NULL,
  `date & time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `cid`, `addid`, `totalprice`, `status`, `date & time`) VALUES
(1, 2, 1, '20', 'In process', '2024-05-02'),
(2, 0, 1, '2.8', 'Order Placed', '2024-05-16'),
(3, 0, 3, '2.8', 'Order Placed', '2024-05-16'),
(4, 1, 2, '1', 'Order Placed', '2024-05-16'),
(5, 1, 2, '0.6', 'Cancelled', '2024-05-16'),
(6, 1, 3, '2.8', 'In process', '2024-05-16'),
(7, 1, 1, '3.55', 'order placed', '2024-05-18'),
(8, 1, 1, '6.94', 'order placed', '2024-05-18'),
(10, 1, 2, '1', 'order placed', '2024-05-18'),
(11, 1, 2, '0', 'order placed', '2024-05-18'),
(12, 1, 2, '0.65', 'order placed', '2024-05-18'),
(13, 1, 1, '0.75', 'order placed', '2024-05-18'),
(16, 1, 1, '1.25', 'order placed', '2024-05-18'),
(17, 1, 2, '0.65', 'order placed', '2024-05-18'),
(18, 3, 6, '1.9', 'order placed', '2024-05-18'),
(19, 5, 9, '1.4', 'order placed', '2024-05-18'),
(20, 5, 9, '2.8', 'order placed', '2024-05-18'),
(21, 3, 7, '0.65', 'order placed', '2024-05-19'),
(22, 3, 7, '3.2', 'Completed', '2024-05-20'),
(23, 3, 6, '3.5', 'order placed', '2024-05-20'),
(24, 3, 6, '1.95', 'order placed', '2024-05-21'),
(25, 1, 1, '1.3', 'order placed', '2024-05-21'),
(26, 1, 1, '0.65', 'order placed', '2024-05-21'),
(27, 1, 1, '2.6', 'order placed', '2024-05-21'),
(28, 3, 6, '1', 'order placed', '2024-05-22'),
(29, 3, 6, '0', 'order placed', '2024-05-22'),
(30, 3, 6, '1', 'order placed', '2024-05-22'),
(31, 3, 6, '1', 'order placed', '2024-05-22'),
(32, 3, 6, '0.65', 'order placed', '2024-05-22'),
(33, 3, 6, '0.65', 'order placed', '2024-05-22'),
(34, 3, 6, '0.65', 'order placed', '2024-05-22'),
(35, 3, 6, '0', 'order placed', '2024-05-22'),
(36, 3, 6, '1', 'order placed', '2024-05-22'),
(37, 3, 6, '1', 'order placed', '2024-05-22'),
(38, 3, 6, '1', 'order placed', '2024-05-22'),
(39, 3, 6, '0.65', 'order placed', '2024-05-22'),
(40, 3, 6, '0.65', 'order placed', '2024-05-22'),
(41, 3, 6, '1', 'order placed', '2024-05-22'),
(42, 3, 6, '2', 'order placed', '2024-05-22'),
(43, 3, 6, '1', 'order placed', '2024-05-22'),
(44, 3, 6, '3.25', 'order placed', '2024-05-22'),
(45, 3, 6, '6.5', 'order placed', '2024-05-22'),
(46, 3, 6, '0.65', 'order placed', '2024-05-22'),
(47, 3, 6, '0.65', 'order placed', '2024-05-22'),
(48, 22, 12, '5.4', 'order placed', '2024-05-23');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `oiid` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`oiid`, `oid`, `pid`, `qty`, `price`) VALUES
(1, 2, 4, 1, 3),
(2, 3, 4, 1, 3),
(3, 4, 12, 2, 1),
(4, 5, 15, 2, 0),
(5, 6, 4, 1, 3),
(6, 7, 14, 1, 3),
(7, 7, 4, 1, 3),
(8, 8, 2, 3, 5),
(9, 8, 22, 1, 5),
(10, 10, 3, 1, 1),
(11, 12, 2, 1, 1),
(12, 13, 1, 1, 1),
(13, 16, 11, 1, 1),
(14, 17, 2, 1, 1),
(15, 18, 12, 1, 1),
(16, 18, 13, 1, 1),
(17, 19, 13, 1, 1),
(18, 20, 4, 1, 3),
(19, 21, 2, 1, 1),
(20, 22, 61, 1, 3),
(21, 23, 60, 1, 4),
(22, 24, 2, 3, 1),
(23, 25, 2, 2, 1),
(24, 26, 2, 1, 1),
(25, 27, 2, 4, 1),
(26, 28, 3, 1, 1),
(27, 30, 3, 1, 1),
(28, 31, 3, 1, 1),
(29, 32, 2, 1, 1),
(30, 33, 2, 1, 1),
(31, 34, 2, 1, 1),
(32, 36, 3, 1, 1),
(33, 37, 3, 1, 1),
(34, 38, 3, 1, 1),
(35, 39, 2, 1, 1),
(36, 40, 2, 1, 1),
(37, 41, 3, 1, 1),
(38, 42, 3, 2, 1),
(39, 43, 3, 1, 1),
(40, 44, 2, 5, 1),
(41, 45, 2, 10, 1),
(42, 46, 2, 1, 1),
(43, 47, 2, 1, 1),
(44, 48, 64, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `Price` double NOT NULL,
  `Stock` int(11) NOT NULL,
  `Picture` text NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `catid`, `Price`, `Stock`, `Picture`, `Description`) VALUES
(1, 3, 0.75, 14, 'apple.jpg', 'red Bahraini apple for 1 kg\r\n'),
(2, 3, 0.65, 16, 'banana.jpg', 'good banana from India for 1 kg'),
(3, 3, 1, 4, 'orange.jpg', 'nice orange from Egypt for 1 kg'),
(4, 3, 2.8, 7, 'Strawberries.webp', 'Strawberries from sitra for one dozen'),
(5, 3, 1.25, 12, 'Grapes.webp', 'Grapes from Egypt for one dozen'),
(11, 1, 1.25, 7, 'Tomato.jpg', 'very nice tomato from south America for 1 kg '),
(12, 1, 0.5, 8, 'Potato.jpg', 'potato from island for 1 kg'),
(13, 1, 1.4, 0, 'Onion.jpg', 'onion from  Saudi Arabia  for 1 kg'),
(14, 1, 0.75, 23, 'Carrot.jpg', 'carrot from manama for 1 kg'),
(15, 1, 0.3, 24, 'Cucumber.jpg', 'Cucumber from zallaq for 1 kg'),
(22, 2, 4.99, 15, 'chicken-breast.jpg', 'chicken breast 129 calory '),
(23, 2, 9.75, 8, 'lamb-leg.webp', 'Australian leg of beef'),
(24, 2, 19, 4, 'salmon-fillet.jpg', 'salmon for only reach people'),
(25, 2, 8.5, 3, 'turkey-breast.webp', 'turkey breasted very good for diet '),
(41, 4, 0.2, 30, 'alsi-cola.png', 'alsi cola 250ml 130 calorie'),
(42, 4, 0.15, 19, 'kinza-cola.jpg', 'kinza cola 250ml 153 calorie '),
(43, 4, 0.15, 15, 'kinza-lemon.jpg', 'kinza  lemon 250ml 130calorie'),
(44, 4, 0.3, 40, 'orange-juice.jpg', 'orange juice from '),
(45, 4, 0.3, 12, 'apple-juice.webp', 'apple juice '),
(51, 5, 0.65, 10, 'Nada-chocolate.avif', 'Nada Chocolate Milk - 250ml. Rich and creamy, perfect for a sweet treat'),
(52, 5, 0.65, 5, 'Nada-vanilla.avif', 'Nada Vanilla Milk - 250ml. Smooth and flavorful, a delightful drink.'),
(53, 5, 2.5, 0, 'kiri-cheese.webp', 'Kiri Cheese Spread - 200g. Creamy and delicious, perfect for spreading on bread or crackers'),
(54, 5, 1.2, 9, 'Almarai-Milk.avif', 'Almarai Fresh Milk - 1L. Rich in calcium and perfect for drinking or cooking'),
(55, 5, 1.1, 12, 'Almarai-Laban.avif', 'Almarai-Laban.avif\', \'Almarai Laban - 1L. Refreshing and tangy, great for drinking or cooking'),
(60, 6, 3.5, 7, '60.webp', 'khadeer tea OPA'),
(61, 6, 3.2, 4, '61.webp', 'alwizza tea OP1'),
(62, 6, 2.8, 10, '62.webp', '999 tea BOP1'),
(63, 6, 2.5, 8, '63.webp', 'baghdad tea from Iraq '),
(64, 6, 1.8, 17, '64.avif', 'Arabic coffee with cardamom and saffron'),
(66, 6, 1.6, 17, 'karak.webp', 'karak tea '),
(67, 6, 5.4, 3, 'co.webp', '1kg Espresso Mocha Coffee Beans - Sicilia Coffee‏');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `sid` int(11) NOT NULL,
  `sname` text NOT NULL,
  `susername` text NOT NULL,
  `semail` text NOT NULL,
  `spass` text NOT NULL,
  `sphone` int(8) NOT NULL,
  `position` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`sid`, `sname`, `susername`, `semail`, `spass`, `sphone`, `position`) VALUES
(1, 'Ali ALsaegh', 'staff_01', 'staff@gmail.com', '12345678', 66666666, 'Cashier'),
(2, 'admin', 'admin', 'admin@gmail.com', 'abc123', 33513715, 'admin'),
(3, 'salmen', 'ldhg', 'salem@gmail.cpm', '$2y$10$e6/8CdWzSIJN21KoWwIIo.Z3hDY9DYUuESJeCwIVwu5h2Ci2UejQG', 33513715, 'cashier'),
(4, 'dpfjg', 'erefjeg', 'salem@gmail.cpm', '$2y$10$z.ECZHmhRZVmIdysiGDQCOixa6r.gtMHAsNdT9h2xe8TLBzWYRmdm', 33513715, 'cashier'),
(5, 'dpfjg', 'erefjeg', 'salem@gmail.cpm', '$2y$10$HKkO3DYG.PkvTKG6Q7wkwOIIJ3KoXXB2RsjPqTFdlGybGOeMmzESi', 33513715, 'cashier'),
(6, 'lmkm', 'dddddd', 'salem@gmail.cpm', '$2y$10$i9Wc7Hdqw2UIT3BuwR.9QO9vNBxq2zK.uDH9NvV5jqgX4pswGVw5i', 33513715, 'cashier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cusername` (`cusername`) USING HASH,
  ADD UNIQUE KEY `cusername_2` (`cusername`) USING HASH;

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `cus` (`cid`),
  ADD KEY `addid` (`addid`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`oiid`),
  ADD KEY `orders_fk` (`oid`),
  ADD KEY `product_fk` (`pid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `cat_fk` (`catid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addid` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `oiid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`addid`) REFERENCES `address` (`addid`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `orders_fk` FOREIGN KEY (`oid`) REFERENCES `orders` (`oid`),
  ADD CONSTRAINT `product_fk` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
