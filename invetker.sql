-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 31, 2024 at 04:46 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invetker`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `content`) VALUES
(1, '&lt;p&gt;&lt;strong&gt;INVETKER&lt;/strong&gt; is a beginner-friendly stock tracking platform with a user-friendly interface. Tracking your stocks is a breeze with INVETKER. Its clear charts make performance monitoring a snap. Plus, its real-time ranking system gives you key insights into your Rate of Return. Whether you&#039;re new to investing or just want a hassle-free way to manage your portfolio, INVETKER has got you covered. Gain confidence in the market with INVETKER&#039;s straightforward tools and clarity.For those who are new to investing, INVETKER is an ideal tool to build confidence in the market. Its straightforward tools and clear information make it simple to manage a portfolio without feeling overwhelmed. Whether you are just starting out or looking for a hassle-free way to keep track of your investments, INVETKER has you covered. The platforms user-friendly approach ensures that anyone can navigate the complexities of the stock market with ease, making investing a more approachable and rewarding experience. In addition to its user-friendly interface and insightful tools, INVETKER is committed to providing a seamless user experience. The platform is designed to be both functional and aesthetically pleasing, ensuring that users can easily find and use the features they need. With INVETKER, you can gain confidence in your investment choices and take control of your financial future. Whether you are tracking individual stocks or managing a diverse portfolio, INVETKERS comprehensive features and clarity make it the perfect companion for any investor.');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `ticker` varchar(50) NOT NULL,
  `quantity` float NOT NULL,
  `action` enum('Bought','Sold') NOT NULL,
  `price` float NOT NULL,
  `fee` float NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` text,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` enum('Investor','Admin') NOT NULL DEFAULT 'Investor',
  `email` varchar(255) NOT NULL,
  `password` char(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `password`, `created_at`) VALUES
(1, 'Alexander, Johnson', 'Admin', 'service@good-series.com', '$2y$10$PQWHlFE52ooIwhdt.vFCTOkACoLNhD.FflfoKW1jy1dlsfPBInB.m', '2024-07-30 18:30:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
