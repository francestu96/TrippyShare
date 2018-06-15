-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2018 at 01:34 PM
-- Server version: 5.7.22-0ubuntu0.17.10.1
-- PHP Version: 7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `S4166252`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plannings`
--

CREATE TABLE `plannings` (
  `id` int(11) NOT NULL,
  `place` varchar(30) NOT NULL,
  `author` int(11) NOT NULL,
  `departure_date` datetime NOT NULL,
  `arrival_date` datetime NOT NULL,
  `price` int(11) NOT NULL,
  `image_path` varchar(40) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plannings`
--

INSERT INTO `plannings` (`id`, `place`, `author`, `departure_date`, `arrival_date`, `price`, `image_path`, `description`) VALUES
(1, '', 7, '1111-11-11 00:00:00', '1111-11-11 00:00:00', 321, 'empty.png', ''),
(2, '', 7, '1111-11-11 00:00:00', '0111-11-11 00:00:00', 213, 'empty.png', ''),
(3, '', 7, '0013-11-11 00:00:00', '0021-03-22 00:00:00', 321, 'empty.png', ''),
(4, '', 7, '0011-11-11 00:00:00', '0003-03-22 00:00:00', 321, 'empty.png', ''),
(5, '', 7, '0003-03-31 00:00:00', '0222-02-02 00:00:00', 321, 'empty.png', '321'),
(6, '', 7, '0003-03-31 00:00:00', '0222-02-02 00:00:00', 321, 'empty.png', '321'),
(7, '', 7, '0022-02-22 00:00:00', '0002-02-22 00:00:00', 432432, 'empty.png', '43');

-- --------------------------------------------------------

--
-- Table structure for table `plannings_stages`
--

CREATE TABLE `plannings_stages` (
  `id` int(11) NOT NULL,
  `planning_id` int(11) NOT NULL,
  `stage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plannings_stages`
--

INSERT INTO `plannings_stages` (`id`, `planning_id`, `stage`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 3, 5),
(6, 3, 6),
(7, 4, 7),
(8, 5, 8),
(9, 5, 9),
(10, 6, 10),
(11, 6, 11),
(12, 7, 12);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `stage` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `rating` int(1) NOT NULL DEFAULT '0',
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE `stages` (
  `id` int(11) NOT NULL,
  `trip_type` varchar(25) NOT NULL,
  `author` int(11) NOT NULL,
  `place` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `duration` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `trip_type`, `author`, `place`, `description`, `duration`) VALUES
(1, 'relax', 7, 'londra', 'ciaone', '1'),
(2, 'relax', 7, 'ciaone', 'suca', '1'),
(3, 'relax', 7, 'bella', 'colione', '1'),
(4, 'relax', 7, 'ciaon', 'wq', '1'),
(5, 'relax', 7, 'ewq', 'ewq', '1'),
(6, 'relax', 7, 'eqw', 'eqw', '1'),
(7, 'relax', 7, '123', '312', '1'),
(8, 'relax', 7, 'cmalta', 'few', '1'),
(9, 'relax', 7, 'sicilia', 'eqw', '1'),
(10, 'relax', 7, 'cmalta', 'few', '1'),
(11, 'relax', 7, 'sicilia', 'eqw', '1'),
(12, 'relax', 7, 'ahah', 'few', '1');

-- --------------------------------------------------------

--
-- Table structure for table `trip_types`
--

CREATE TABLE `trip_types` (
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip_types`
--

INSERT INTO `trip_types` (`type`) VALUES
('relax');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `birthdate` datetime DEFAULT NULL,
  `description` text,
  `gender` enum('male','female','other') DEFAULT NULL,
  `nationality` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `birthdate`, `description`, `gender`, `nationality`) VALUES
(4, 'test', 'test', 'test', 'test', '2017-03-02 00:00:00', NULL, 'male', NULL),
(5, 'ciaoen', 'porcodio', 'fradqwe@fdwe', '382410e305c98367e39b0c35849d814313fab4e3', '2018-05-23 00:00:00', NULL, 'male', NULL),
(6, 'silvia', 'sciutto', 'sciva.silvia@gmai.com', '382410e305c98367e39b0c35849d814313fab4e3', NULL, NULL, NULL, NULL),
(7, 'francesco', 'stucci', 'francestu96@gmail.com', '382410e305c98367e39b0c35849d814313fab4e3', NULL, NULL, NULL, NULL),
(8, 'ciao', 'ciaone', 'ciao@gmail.com', '382410e305c98367e39b0c35849d814313fab4e3', NULL, NULL, NULL, NULL),
(9, 'francesco', 'stucci', 'bio@fn.ok', 'b4b1d459b4c680c82535a5ece826f5aae4eda250', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_plannings`
--

CREATE TABLE `users_plannings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `planning_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_fk0` (`sender`),
  ADD KEY `messages_fk1` (`receiver`);

--
-- Indexes for table `plannings`
--
ALTER TABLE `plannings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plannings_fk0` (`author`);

--
-- Indexes for table `plannings_stages`
--
ALTER TABLE `plannings_stages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plannings_stages_fk0` (`planning_id`),
  ADD KEY `plannings_stages_fk1` (`stage`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_fk0` (`stage`),
  ADD KEY `ratings_fk1` (`author`);

--
-- Indexes for table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stages_fk0` (`trip_type`),
  ADD KEY `stages_fk1` (`author`);

--
-- Indexes for table `trip_types`
--
ALTER TABLE `trip_types`
  ADD PRIMARY KEY (`type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_plannings`
--
ALTER TABLE `users_plannings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_plannings_fk0` (`user_id`),
  ADD KEY `users_plannings_fk1` (`planning_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plannings`
--
ALTER TABLE `plannings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `plannings_stages`
--
ALTER TABLE `plannings_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users_plannings`
--
ALTER TABLE `users_plannings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_fk0` FOREIGN KEY (`sender`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_fk1` FOREIGN KEY (`receiver`) REFERENCES `users` (`id`);

--
-- Constraints for table `plannings`
--
ALTER TABLE `plannings`
  ADD CONSTRAINT `plannings_fk0` FOREIGN KEY (`author`) REFERENCES `users` (`id`);

--
-- Constraints for table `plannings_stages`
--
ALTER TABLE `plannings_stages`
  ADD CONSTRAINT `plannings_stages_fk0` FOREIGN KEY (`planning_id`) REFERENCES `plannings` (`id`),
  ADD CONSTRAINT `plannings_stages_fk1` FOREIGN KEY (`stage`) REFERENCES `stages` (`id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_fk0` FOREIGN KEY (`stage`) REFERENCES `stages` (`id`),
  ADD CONSTRAINT `ratings_fk1` FOREIGN KEY (`author`) REFERENCES `users` (`id`);

--
-- Constraints for table `stages`
--
ALTER TABLE `stages`
  ADD CONSTRAINT `stages_fk0` FOREIGN KEY (`trip_type`) REFERENCES `trip_types` (`type`),
  ADD CONSTRAINT `stages_fk1` FOREIGN KEY (`author`) REFERENCES `users` (`id`);

--
-- Constraints for table `users_plannings`
--
ALTER TABLE `users_plannings`
  ADD CONSTRAINT `users_plannings_fk0` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_plannings_fk1` FOREIGN KEY (`planning_id`) REFERENCES `plannings` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
