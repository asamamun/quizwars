-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 06:11 PM
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
-- Database: `quiz_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Pre School', '2024-02-05 03:49:21'),
(2, 'Age 2-4', '2024-02-05 03:49:21'),
(3, 'Age 5', '2024-02-05 03:49:41'),
(4, 'SSC', '2024-02-05 03:49:41'),
(5, 'HSC', '2024-02-05 03:50:51'),
(6, 'Honours', '2024-02-05 03:50:51'),
(7, 'Masters', '2024-02-05 03:51:07'),
(8, 'Sports', '2024-02-05 03:51:07'),
(9, 'History', '2024-02-05 03:51:23'),
(10, 'Bangladesh', '2024-02-05 03:51:23'),
(12, 'fgsdfgsdfgdfsg', '2024-02-05 04:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address1` varchar(60) NOT NULL,
  `address2` varchar(60) NOT NULL,
  `dob` date NOT NULL,
  `bg` varchar(3) NOT NULL,
  `nid` varchar(30) NOT NULL,
  `image` varchar(30) NOT NULL,
  `division` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `thana` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizes`
--

CREATE TABLE `quizes` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `question` varchar(1024) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `op1` varchar(200) NOT NULL,
  `op2` varchar(200) NOT NULL,
  `op3` varchar(200) NOT NULL,
  `op4` varchar(200) NOT NULL,
  `c_answer` varchar(200) NOT NULL,
  `explanation` varchar(1024) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizes`
--

INSERT INTO `quizes` (`id`, `category_id`, `subcategory_id`, `question`, `image`, `op1`, `op2`, `op3`, `op4`, `c_answer`, `explanation`, `status`, `user_id`, `created_at`) VALUES
(1, 4, 2, 'What is the correct plural form of the word \"child\"?', NULL, 'childs', 'children', 'childes', 'child\'s', 'op2', 'no explanation available', 1, 1, '2024-02-05 09:57:22'),
(2, 4, 3, 'fgtrfgh', NULL, 'gtrfhy', 'fhg', 'gg', 'hg', 'op1', 'gfhtrr', 0, 1, '2024-02-19 16:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `quizsets`
--

CREATE TABLE `quizsets` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `quiz_title` varchar(256) NOT NULL,
  `descriptions` varchar(512) NOT NULL,
  `totalquiz` int(3) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_time` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizsets`
--

INSERT INTO `quizsets` (`id`, `category_id`, `subcategory_id`, `quiz_title`, `descriptions`, `totalquiz`, `start_time`, `end_time`, `status`, `created_at`) VALUES
(24, NULL, NULL, 'dasdasd', 'asdasd', 342, '2024-02-19 13:10:00', '2024-02-19 12:15:00', 0, '2024-02-19 18:10:15'),
(25, NULL, NULL, 'fsdfsd', 'fsdfsdf', 234, '2024-02-19 12:14:00', '2024-02-19 12:15:00', 0, '2024-02-19 18:10:45');

-- --------------------------------------------------------

--
-- Table structure for table `quizset_quiz`
--

CREATE TABLE `quizset_quiz` (
  `id` int(11) NOT NULL,
  `quizset_id` int(10) NOT NULL,
  `quiz_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizset_quiz`
--

INSERT INTO `quizset_quiz` (`id`, `quizset_id`, `quiz_id`, `created_at`) VALUES
(17, 24, 1, '2024-02-19 18:10:15'),
(18, 24, 2, '2024-02-19 18:10:15'),
(19, 25, 1, '2024-02-19 18:10:45');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `subcat_id` int(10) NOT NULL,
  `quizset_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `marks` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `category_id`, `created_at`) VALUES
(1, 'Bangla', 4, '2024-02-05 03:51:50'),
(2, 'English', 4, '2024-02-05 03:51:50'),
(3, 'Math', 4, '2024-02-05 03:53:52'),
(4, 'Seience', 4, '2024-02-05 03:53:52'),
(5, 'Bangla', 5, '2024-02-05 03:54:20'),
(6, 'English', 5, '2024-02-05 03:54:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` int(2) NOT NULL DEFAULT 1 COMMENT '1=user, 2=admin',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin admin', 'admin@gmail.com', '$2y$10$snR7lKvXXUEpmWXzs1TAUef3kZj/ICni05SldcMwsRc7aH14fAnZe', 2, '2024-02-05 09:39:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `quizes`
--
ALTER TABLE `quizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `quizsets`
--
ALTER TABLE `quizsets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `quizset_quiz`
--
ALTER TABLE `quizset_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizset_id` (`quizset_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizes`
--
ALTER TABLE `quizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quizsets`
--
ALTER TABLE `quizsets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `quizset_quiz`
--
ALTER TABLE `quizset_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `quizes`
--
ALTER TABLE `quizes`
  ADD CONSTRAINT `quizes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `quizes_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`),
  ADD CONSTRAINT `quizes_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `quizsets`
--
ALTER TABLE `quizsets`
  ADD CONSTRAINT `quizsets_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `quizsets_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `quizset_quiz`
--
ALTER TABLE `quizset_quiz`
  ADD CONSTRAINT `quizset_quiz_ibfk_1` FOREIGN KEY (`quizset_id`) REFERENCES `quizsets` (`id`),
  ADD CONSTRAINT `quizset_quiz_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizes` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
