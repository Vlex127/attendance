-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 03:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `timestamp`, `latitude`, `longitude`) VALUES
(2, 2, '2025-02-02 02:05:13', 6.43510000, 3.41600000),
(3, 2, '2025-02-02 02:12:33', 6.43510000, 3.41600000),
(4, 2, '2025-02-02 02:17:34', 6.43510000, 3.41600000),
(5, 3, '2025-02-02 02:28:32', 6.49134080, 3.39148800),
(6, 2, '2025-02-02 02:52:24', 6.49134080, 3.39148800),
(7, 2, '2025-02-02 02:53:50', 6.49134080, 3.39148800),
(8, 4, '2025-02-03 02:56:43', 6.49134080, 3.39148800);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT 'default-avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile_picture`) VALUES
(1, 'John Doe', 'john@example.com', 'password123', 'default-avatar.png'),
(2, 'vlex', 'iwunoayokunle@gmail.com', '$2y$10$HydQ3XaLEdUlzZ6kcGhlvu52ppMOzlWLZKS7M3c4BoyMuRnnFZWQK', 'uploads/kakashi-hatake-dark-3840x2160-18503.png'),
(3, 'Iwuno Vincent', 'vincentayokunle@gmail.com', '$2y$10$AJ5bvjFooGlSeCOL02Br9uTCxnTKhVXiiD7ZRFsE0rHNswyv7Ckt.', 'uploads/laughing-luffy-one-3840x2160-19342.jpg'),
(4, 'Iwuno Vincent', 'www@gmail.com', '$2y$10$eGP4kLFeFYzaU7/pDn79Jusa34Pu76rL8nY/NVg2du4bRyFjUGIO2', 'uploads/laughing-luffy-one-3840x2160-19342.jpg'),
(5, 'John Charles', 'jj@gmail.com', '$2y$10$Ldjnsqh.Qh2SkXwe3NKUBebgVeLEw66bCORMhX79cpG3TU4uKokYC', 'uploads/tengen-uzu-3840x2160-18509.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
