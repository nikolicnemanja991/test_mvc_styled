-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2023 at 10:37 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasks_test_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `log` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `log`) VALUES
(6, 'admin updated Product  with id 10'),
(7, 'admin deleted Product chees with id 10'),
(8, 'admin added Product fanta with id 11'),
(9, 'admin updated Product  with id 11'),
(10, 'admin added Product pork with id 12'),
(11, 'admin added Product bannana with id 13'),
(12, 'admin deleted Product bannana with id 13'),
(13, 'admin added Product frutela with id 14');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `price`, `time`) VALUES
(1, 2, 107, '2023-07-08'),
(2, 2, 90, '2023-07-08'),
(3, 6, 131, '2023-07-08'),
(4, 8, 69, '2023-07-09'),
(5, 9, 45, '2023-07-09'),
(6, 6, 32, '2023-07-09'),
(7, 6, 110, '2023-07-09'),
(8, 6, 98, '2023-07-09'),
(9, 6, 47, '2023-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`) VALUES
(1, 1, 2),
(1, 4, 1),
(2, 1, 1),
(2, 2, 1),
(2, 3, 1),
(3, 1, 1),
(3, 3, 1),
(3, 5, 2),
(3, 2, 2),
(4, 1, 1),
(4, 3, 2),
(4, 5, 3),
(5, 6, 1),
(5, 4, 1),
(5, 2, 1),
(6, 6, 1),
(6, 5, 3),
(6, 3, 4),
(7, 1, 2),
(7, 4, 1),
(7, 6, 1),
(8, 1, 1),
(8, 3, 1),
(8, 12, 1),
(8, 11, 1),
(9, 14, 2),
(9, 12, 1),
(9, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `type`, `price`) VALUES
(1, 'beef', 'food', 50),
(2, 'chicken', 'food', 35),
(3, 'apple', 'fruite', 5),
(4, 'bannana', 'fruite', 7),
(5, 'pepsi', 'juice', 3),
(6, 'sprite', 'juice', 3),
(11, 'fanta', 'juice', 3),
(12, 'pork', 'food', 40),
(14, 'frutela', 'juice', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin'),
(2, 'user', '12dea96fec20593566ab75692c9949596833adc9', 'user'),
(3, 'moderator', '79f52b5b92498b00cb18284f1dcb466bd40ad559', 'moderator'),
(6, 'Nemanja', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'user'),
(7, 'Dragan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'user'),
(8, 'Djordje', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'user'),
(9, 'Boskic', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'user'),
(10, 'Milorada', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
