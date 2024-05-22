-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 02:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wellnesshub database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permissions` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `permissions`, `created_at`) VALUES
(1, 'Rwema-admin', 'rwemafre@9939932', '{\"permission1\": true, \"permission2\": false}', '2024-05-05 21:13:39');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `counselor_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `appointment_datetime` datetime NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('Canceld','Confirmed','Completed','Pending') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `counselor_id`, `client_id`, `appointment_datetime`, `duration`, `notes`, `status`) VALUES
(4, 1, 1, '2024-05-13 06:14:00', 4, 'zryxtcjyvh 2133', 'Pending'),
(5, 1, 1, '2024-05-13 06:14:00', 4, 'zryxtcjyvh', 'Pending'),
(6, 1, 1, '2024-05-13 16:19:00', 16, 'Ahooooo', 'Pending'),
(8, 1, 1, '2024-05-13 20:34:00', 16, 'I am good', 'Pending'),
(9, 4, 2, '2024-05-13 16:53:14', 23, 'cujvkbjn', 'Pending'),
(10, 3, 3, '2024-05-16 14:03:00', 2, 'asdfghj', 'Pending'),
(11, 3, 3, '2024-05-16 14:03:00', 2, 'asdfghj', 'Pending'),
(12, 3, 3, '2024-05-09 02:04:00', 17, 'helllo', 'Pending'),
(13, 3, 3, '2024-05-09 02:04:00', 17, 'helllo', 'Pending'),
(14, 1, 1, '2024-05-22 15:44:00', 20, 'asdfghjk', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `assessment_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `assessment_type` varchar(50) NOT NULL,
  `assessment_date` date NOT NULL,
  `scores` text DEFAULT NULL,
  `goals` text DEFAULT NULL,
  `progress_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`assessment_id`, `client_id`, `assessment_type`, `assessment_date`, `scores`, `goals`, `progress_notes`) VALUES
(1, 1, 'follow-up', '2024-05-21', '3', 'manage_stress', 'i was trying last advice you suggested'),
(2, 1, 'follow-up', '2024-05-21', '3', 'manage_stress', 'i was trying last advice you suggested');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `counselors`
--

CREATE TABLE `counselors` (
  `counselor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `experience_years` int(11) DEFAULT NULL,
  `education` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `counselors`
--

INSERT INTO `counselors` (`counselor_id`, `user_id`, `specialization`, `experience_years`, `education`) VALUES
(1, 4, 'developer', 5, 'Banchelor');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_reviews`
--

CREATE TABLE `feedback_reviews` (
  `review_id` int(11) NOT NULL,
  `counselor_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `date_submitted` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message_content` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `read_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `receiver_id`, `message_content`, `timestamp`, `read_status`) VALUES
(1, 4, 4, 'asdfghjk', '2024-05-15 15:30:58', 0),
(2, 1, 8, 'zxcvbnmkjhgfds', '2024-05-15 15:32:18', 0),
(3, 1, 1, 'hiii counsolor', '2024-05-15 16:05:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `resource_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `content` text NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL,
  `counselor_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `session_start` datetime NOT NULL,
  `session_end` datetime NOT NULL,
  `session_type` enum('video','chat') NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `counselor_id`, `client_id`, `session_start`, `session_end`, `session_type`, `duration`, `notes`) VALUES
(1, 1, 1, '2024-05-30 12:18:00', '2024-05-31 12:18:00', '', 3000, 'depression problems');

-- --------------------------------------------------------

--
-- Table structure for table `treatment_plans`
--

CREATE TABLE `treatment_plans` (
  `plan_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `counselor_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `goals` text DEFAULT NULL,
  `strategies` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('counselor','client') NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `contact_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `profile_picture`, `contact_info`) VALUES
(1, 'bonhuer_kwizera', 'bonhuer@gmail.com', 'bob123', 'counselor', NULL, NULL),
(2, 'bonhuer_kwizera', 'bonhuer@gmail.com', 'bonhuer12', 'client', NULL, NULL),
(3, 'olivier', 'olivier@gmail.com', '1234567', 'counselor', NULL, NULL),
(4, 'amanda', 'amanda@gmail.com', 'sdfghjk', 'counselor', NULL, NULL),
(5, 'Rwemafrank', 'bit@gmail.com', '1234567', 'counselor', NULL, NULL),
(6, 'bohnuer', 'bonhuer@gmail.com', '12345678', 'counselor', NULL, NULL),
(7, 'amanda', 'irene@gmail.com', 'asdfghjk', 'counselor', NULL, NULL),
(8, 'Rwema ', 'rwemafre123@gmail.com', 'rwema9939932', 'counselor', NULL, NULL),
(9, 'grace', 'grace@gmail.com', '1234', 'counselor', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `counselor_id` (`counselor_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`assessment_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `counselors`
--
ALTER TABLE `counselors`
  ADD PRIMARY KEY (`counselor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `feedback_reviews`
--
ALTER TABLE `feedback_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `counselor_id` (`counselor_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`resource_id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `counselor_id` (`counselor_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `treatment_plans`
--
ALTER TABLE `treatment_plans`
  ADD PRIMARY KEY (`plan_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `counselor_id` (`counselor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `assessment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `counselors`
--
ALTER TABLE `counselors`
  MODIFY `counselor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback_reviews`
--
ALTER TABLE `feedback_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `treatment_plans`
--
ALTER TABLE `treatment_plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`counselor_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `assessments`
--
ALTER TABLE `assessments`
  ADD CONSTRAINT `assessments_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `counselors`
--
ALTER TABLE `counselors`
  ADD CONSTRAINT `counselors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `feedback_reviews`
--
ALTER TABLE `feedback_reviews`
  ADD CONSTRAINT `feedback_reviews_ibfk_1` FOREIGN KEY (`counselor_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `feedback_reviews_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`counselor_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `treatment_plans`
--
ALTER TABLE `treatment_plans`
  ADD CONSTRAINT `treatment_plans_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `treatment_plans_ibfk_2` FOREIGN KEY (`counselor_id`) REFERENCES `counselors` (`counselor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
