-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2021 at 06:31 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(100) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `name`, `email`, `password`) VALUES
(1, 'Praful', 'kanagarg10@gmail.com', '00000');

-- --------------------------------------------------------

--
-- Table structure for table `dishesandwishes`
--

CREATE TABLE `dishesandwishes` (
  `dish_id` int(100) NOT NULL,
  `cuisine` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `cost` int(100) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dishesandwishes`
--

INSERT INTO `dishesandwishes` (`dish_id`, `cuisine`, `type`, `cost`, `image`) VALUES
(1, 'Dosa', 'South Indian', 60, 'rest_images/Dosa.jpg'),
(2, 'Noodles', 'Fast Food', 80, 'rest_images/Noodles.jpg'),
(3, 'Burger', 'Fast Food', 40, 'rest_images/Burger.jpg'),
(4, 'Pasta', 'Chinese', 60, 'rest_images/Pasta.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `lapiano`
--

CREATE TABLE `lapiano` (
  `dish_id` int(100) NOT NULL,
  `cuisine` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `cost` int(100) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lapiano`
--

INSERT INTO `lapiano` (`dish_id`, `cuisine`, `type`, `cost`, `image`) VALUES
(1, 'Ice cream', 'Dessert', 50, 'rest_images/Ice cream.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `order_item` varchar(100) NOT NULL,
  `cost` int(100) NOT NULL,
  `rest_name` varchar(100) NOT NULL,
  `Rating` int(10) NOT NULL DEFAULT 10,
  `Time_of_order` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` text NOT NULL DEFAULT 'Waiting for restaurant confirmation..'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_name`, `order_item`, `cost`, `rest_name`, `Rating`, `Time_of_order`, `order_status`) VALUES
(4, 'Praful Garg', '1,2,', 140, 'Dishes and Wishes', 10, '2021-05-10 04:03:07', 'Waiting for restaurant confirmation..'),
(5, 'Praful Garg', '1,', 50, 'La Piano', 10, '2021-05-10 04:03:19', 'Waiting for restaurant confirmation..'),
(6, 'Praful Garg', '1,2,3,', 180, 'Dishes and Wishes', 10, '2021-05-10 04:18:23', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `rest_username` varchar(30) NOT NULL,
  `rest_password` varchar(30) NOT NULL,
  `rest_id` int(100) NOT NULL,
  `rest_ownername` varchar(100) DEFAULT NULL,
  `rest_name` varchar(100) DEFAULT NULL,
  `rest_address` varchar(500) DEFAULT NULL,
  `rest_email` varchar(50) DEFAULT NULL,
  `rest_open` varchar(5) DEFAULT NULL,
  `rest_close` varchar(5) DEFAULT NULL,
  `rest_rating` float(2,1) DEFAULT NULL,
  `rest_image` varchar(255) DEFAULT NULL,
  `rest_cuisine` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`rest_username`, `rest_password`, `rest_id`, `rest_ownername`, `rest_name`, `rest_address`, `rest_email`, `rest_open`, `rest_close`, `rest_rating`, `rest_image`, `rest_cuisine`) VALUES
('Aniket', '12345', 2, 'Praful', 'La Piano', 'Shoprix Mall Shastrinagar Meerut', '789@gmail.com', '10:00', '21:00', 7.0, 'rest_images/La Piano.jpg', 'Fast Food,Dessert,Icecream,Cafe'),
('Praful', '12345', 3, 'Praful', 'Dishes and Wishes', 'Shastrinagar Meerut', '123@gmail.com', '10:00', '21:00', 5.2, 'rest_images/Dishes and Wishes.jpg', 'North Indian,Fast Food,Pizza,Dessert,Icecream,South Indian');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_email` varchar(50) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Praful Garg', 'kanagarg10@gmail.com', '$2y$10$zuYmJD7EYuvLDOfeP9PcduAqlxdWSau1/PaYpCN2kggJRxF4IOefq'),
(2, 'Patan', 'patan@gmail.com', '$2y$10$bnfyR0V1lO5LuKL2U1AW8eCCXiOjmK4GN48B.V7y4XT9f/Ifn0Lv6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dishesandwishes`
--
ALTER TABLE `dishesandwishes`
  ADD PRIMARY KEY (`dish_id`);

--
-- Indexes for table `lapiano`
--
ALTER TABLE `lapiano`
  ADD PRIMARY KEY (`dish_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`rest_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dishesandwishes`
--
ALTER TABLE `dishesandwishes`
  MODIFY `dish_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lapiano`
--
ALTER TABLE `lapiano`
  MODIFY `dish_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `rest_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
