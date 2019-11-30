-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2019 at 05:25 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE DATABASE `web_mini`;
USE `web_mini`;

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `description_about_item` varchar(255) DEFAULT NULL,
  `image_of_item` varchar(255) DEFAULT NULL,
  `place_of_found` varchar(255) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `founder_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

-- INSERT INTO `items` (`item_id`, `description_about_item`, `image_of_item`, `place_of_found`, `time_stamp`, `founder_id`, `status`) VALUES
-- (8, 'Pen', '2.png', 'Auitorium', '2019-11-24 04:45:49', 2, 'CONFIRMED'),
-- (9, 'Watch', '5.png', 'Room 305', '2019-11-24 04:48:51', 2, 'CONFIRMED'),
-- (11, 'Chaddi', '3.png', 'Nethravathi', '2019-11-24 15:27:54', 2, 'CONFIRMED'),
-- (12, 'pen', '2.png', 'Room 305', '2019-11-24 20:21:33', 2, 'CONFIRMED'),
-- (13, 'Bag', 'bag.jpg', 'Auitorium', '2019-11-06 11:00:00', 2, 'PENDING'),
-- (14, 'ID Card', 'satishaID.jpg', 'Cyber Security Class Room', '2019-11-23 13:40:00', 2, 'PENDING'),
-- (15, 'Pen', 'pen.png', 'Room 305', '2019-11-16 05:00:00', 2, 'PENDING'),
-- (16, 'lungi', 'thumbsdownicon.jpg', 'Cyber Security Class Room', '2019-11-24 16:39:00', 2, 'PENDING'),
-- (17, 'Saaman', 'pen.png', 'Cyber Security Class Room', '2019-11-25 04:20:40', 3, 'CONFIRMED');

-- --------------------------------------------------------

--
-- Table structure for table `lost_and_found`
--

CREATE TABLE `lost_and_found` (
  `id` int(11) NOT NULL,
  `loser_id` int(11) DEFAULT NULL,
  `founder_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lost_and_found`
--

-- INSERT INTO `lost_and_found` (`id`, `loser_id`, `founder_id`, `item_id`, `time_stamp`) VALUES
-- (9, 2, 2, 8, '2019-11-23 19:22:43'),
-- (10, 2, 2, 9, '2019-11-24 02:08:19'),
-- (11, 2, 2, 8, '2019-11-24 04:45:49'),
-- (12, 2, 2, 8, '2019-11-24 04:46:01'),
-- (13, 2, 2, 8, '2019-11-24 04:47:38'),
-- (14, 2, 2, 9, '2019-11-24 04:48:51'),
-- (15, 2, 2, 11, '2019-11-24 15:27:54'),
-- (16, 2, 2, 12, '2019-11-24 20:21:33'),
-- (17, 5, 3, 17, '2019-11-25 04:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(10) DEFAULT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

-- INSERT INTO `user` (`user_id`, `full_name`, `mobile_number`, `password`) VALUES
-- (2, 'Prajwal', '7899496873', '5f4dcc3b5aa765d61d8327deb882cf99'),
-- (3, 'Sujith', '7899496873', '5d41402abc4b2a76b9719d911017c592'),
-- (4, 'Nikhil', '6666666666', 'helloworld'),
-- (5, 'Subramanya C', '8618992869', '25f9e794323b453885f5181f1b624d0b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `lost_and_found`
--
ALTER TABLE `lost_and_found`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `lost_and_found`
--
ALTER TABLE `lost_and_found`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
