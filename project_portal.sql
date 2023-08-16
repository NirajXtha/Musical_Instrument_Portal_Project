-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2023 at 05:15 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `username` varchar(100) NOT NULL,
  `pid` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`username`, `pid`, `qty`, `price`) VALUES
('user', 1, 3, 300000),
('pratik', 2, 2, 820000);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msg_id` int(11) NOT NULL,
  `msg` text DEFAULT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pid` text NOT NULL,
  `price` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `payment` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` bigint(20) NOT NULL,
  `product` varchar(255) NOT NULL,
  `p_type` varchar(50) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `price` bigint(20) NOT NULL,
  `img_url` text NOT NULL,
  `detail` text NOT NULL,
  `featured` varchar(6) NOT NULL DEFAULT 'Add'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `product`, `p_type`, `brand`, `price`, `img_url`, `detail`, `featured`) VALUES
(1, 'Yamaha_slg200N', 'Guitar', 'Yamaha', 110000, 'IMG-649841770410c4.00031644.jfif', 'The Yamaha SLG200S Silent Guitar is an exceptional instrument that harmonizes the beauty of acoustic guitar tones with the convenience of a portable and silent design. Its innovative construction and cutting-edge features make it a perfect choice for musicians exploring Nepal\'s breathtaking landscapes without compromising their musical expression. The SLG200S is designed with both practice and performance in mind, making it an ideal companion for musicians in Nepal. Its unique design allows players to enjoy a traditional guitar\'s rich and authentic acoustic sound.', 'Remove'),
(2, 'Fender Telecaster Deluxe', 'Guitar', 'Fender', 410000, 'IMG-649a9e99bb40b8.02482821.png', 'Fender’s American Professional II Telecaster Deluxe puts a new spin on the hugely popular model, with upgrades aimed at the professional player. The iconic Tele Deluxe styling remains, but it benefits from a contoured neck heel and a redesigned 3-saddle bridge, which makes it easier than ever to get a clean setup with perfect intonation. Tim Shaw V-Mod II Double Tap humbuckers provide the fat sound you would expect from a Tele Deluxe, but they pull the wool off the top end, yielding a stunning hi-fi tone.', 'Remove'),
(3, 'Mapex Tornado TND5254TFJ – Ebony Yellow Grain', 'Drum', 'Mapex', 89000, 'IMG-64a93683018943.63353298.png', 'Tornado Series Studio Version Drum shells feature a wrap finish Drum shells are made from basswood Colour: Ebony Yellow Grain', 'Add'),
(4, 'Yamaha PSR-F52 Portable Keyboard', 'Keyboard', 'Yamaha', 19000, 'IMG-64a9388203f985.42839902.png', 'The Yamaha PSR-F52 Portable Keyboard is a versatile and compact instrument that brings joy to musicians in Nepal and beyond. With its 61 touch-sensitive keys, it offers a responsive playing experience that resonates with musicians. Featuring a variety of instrument voices, including pianos, guitars, and strings, it allows for creative exploration across various genres commonly appreciated in Nepals vibrant music scene.', 'Add');

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

CREATE TABLE `rent` (
  `price` int(11) NOT NULL,
  `rid` text NOT NULL,
  `img` text NOT NULL,
  `detail` text NOT NULL,
  `username` varchar(150) NOT NULL,
  `rp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rent`
--

INSERT INTO `rent` (`price`, `rid`, `img`, `detail`, `username`, `rp`) VALUES
(1000, 'set1', 'set1.png', 'Jackson J22 Electric Guitars, Yamaha TRBX35 Bass Guitar, Pearl Rock&Roll Drum Set, Lead Microphone', 'user', 1),
(1000, 'set2', 'set2.jpg', 'Yamaha F335 Acoustic Guitar, Jackson J22 Electric Guitar, Yamaha TRBX35 Bass Guitar, Alesis Strike Electric Drum Set', '', 1),
(1000, 'set3', 'set3.jpg', 'Yamaha F335 Acoustic Guitar, Jackson J22 Electric Guitar, Yamaha TRBX35 Bass Guitar, Alesis Strike Electric Drum Set, Casio KS40 Portable Keyboard', '', 1),
(1000, 'set4', 'set4.jpg', 'Yamaha F335 Acoustic Guitar, Jackson J22 Electric Guitar, Yamaha TRBX35 Bass Guitar, Alesis Strike Electric Drum Set, Yamaha Psr-E273 Portable Keyboard', '', 1),
(1000, 'set5', 'set5.jpg', 'Yamaha F335 Acoustic Guitar, Jackson J22 Electric Guitar, Yamaha TRBX35 Bass Guitar, Alesis Strike Electric Drum Set, Donner DDP-80 Digital Piano', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `r_order`
--

CREATE TABLE `r_order` (
  `username` varchar(150) NOT NULL,
  `rid` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  `hrs` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `payment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `pid` bigint(20) DEFAULT NULL,
  `sale_amt` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`pid`, `sale_amt`) VALUES
(1, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `user_type`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'shresthaniraj633@gmail.com', 'admin'),
('pratik', '0cb2b62754dfd12b6ed0161d4b447df7', 'nishrestha76@gmail.com', 'user'),
('user', 'ee11cbb19052e40b07aac0ca060c23ee', 'shresthaniraj633@gmail.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
