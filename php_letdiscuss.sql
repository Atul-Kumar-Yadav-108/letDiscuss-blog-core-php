-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 09:22 AM
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
-- Database: `php_letdiscuss`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) DEFAULT NULL,
  `created_by` tinyint(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0:not deleted, 1: deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `created_by`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Python', 'Python is a high-level, general-purpose programming language. Its design philosophy emphasizes code readability with the use of significant indentation. Python is dynamically type-checked and garbage-collected.', NULL, '2025-04-01 15:26:58', NULL, 0),
(2, 'Java', 'Java is a high-level, general-purpose, memory-safe, object-oriented programming language. It is intended to let programmers write once, run anywhere (WORA) meaning that compiled Java code can run on all platforms that support Java without the need to reco', NULL, '2025-04-01 15:27:53', NULL, 0),
(3, 'Laravel', 'Laravel is a free and open-source PHP-based web framework for building web applications. It was created by Taylor Otwell and intended for the development of web applications following the model–view–controller (MVC) architectural', NULL, '2025-04-06 13:33:34', NULL, 0),
(4, 'Laravel', NULL, NULL, '2025-04-26 20:15:29', NULL, 1),
(5, 'Javascript', 'JavaScript (/ˈdʒɑːvəskrɪpt/ ⓘ), often abbreviated as JS, is a programming language and core technology of the World Wide Web, alongside HTML and CSS. Ninety-nine percent of websites use JavaScript on the client', NULL, '2025-04-26 20:15:42', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_requests`
--

CREATE TABLE `category_requests` (
  `request_id` int(10) NOT NULL,
  `req_categ_name` varchar(255) NOT NULL,
  `req_categ_description` varchar(255) DEFAULT NULL,
  `req_user_id` int(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `req_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0:pending, 1:accept, 2:reject'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_requests`
--

INSERT INTO `category_requests` (`request_id`, `req_categ_name`, `req_categ_description`, `req_user_id`, `created_at`, `updated_at`, `req_status`) VALUES
(1, 'Laravel', 'I want to information about laraeland also about discussion. Please create a category for this also', NULL, '2025-04-05 16:06:52', NULL, 1),
(2, 'Javascript', 'As i am a JavaScript developer. So Its my humble request to you please create a JavaScript category', 2, '2025-04-08 13:37:44', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(10) NOT NULL,
  `comment_content` varchar(255) NOT NULL,
  `question_id` int(10) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL COMMENT '0: not delted, 1: deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `question_id`, `created_by`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'mmmm nnnn bb hhhh ttt', 6, 1, '2025-04-06 13:44:13', NULL, 0),
(2, 'mmmm nnnn bb hhhh ttt', 6, NULL, '2025-04-06 13:44:47', NULL, 0),
(3, '', 1, NULL, '2025-04-06 15:36:05', NULL, 0),
(4, 'deko kaise hota hai', 1, 1, '2025-04-06 15:53:52', NULL, 0),
(5, 'Watch video on youtube', 1, 2, '2025-04-08 08:48:40', NULL, 0),
(6, 'afdafag g jhfhjk gfdgfshsfgsdgf sfdg', 18, 2, '2025-04-08 09:04:44', NULL, 0),
(7, 'afdafag g jhfhjk gfdgfshsfgsdgf sfdg', 18, 2, '2025-04-08 09:05:57', NULL, 0),
(8, '&ltscript&gtalert(\"Hello\")&ltscript&gt', 18, 2, '2025-04-08 13:26:44', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_phone` varchar(13) NOT NULL,
  `contact_description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contact_email`, `contact_name`, `contact_phone`, `contact_description`, `created_at`) VALUES
(1, 'atul@gmail.com', 'Atul', '7964523656', 'agjgal ahki 4i4 lafg,ajbvm,nblvxjhkjhgajhlkajfkdhlakjsdhfljhgljdhgkhdlkfhl', '2025-04-08 14:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question_title` varchar(255) NOT NULL,
  `quesition_description` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `creator_user_id` int(10) DEFAULT NULL,
  `is_deleted` tinyint(2) DEFAULT NULL COMMENT '0:not deleted, 1: deleted',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question_title`, `quesition_description`, `category_id`, `creator_user_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'How can i install pychar in windows', 'Its my first time when i am going ot use pychar in windows, so please anyone can suggest me how can I install pychar in my windows 11', 1, 1, 0, '2025-04-05 07:42:37', NULL),
(2, 'How can I install pychar in my windows', 'Hey there, Its my first time to use pycharm in windows, so please anyone can help to install pycharm in windows 11.', 1, NULL, NULL, '2025-04-05 07:44:50', NULL),
(3, 'JAVA string concate', 'I am trying concate the string in java but there is some issue occurring please help me to get out of that..', 1, NULL, NULL, '2025-04-05 15:02:24', NULL),
(4, 'abc ', 'abcdefghijklmnopqrstuvwxyz', 1, NULL, NULL, '2025-04-05 15:06:54', NULL),
(5, 'asfdasfd', 'afasfdsd asdfag dfhgdfgh fgjk gsdfgfdsgs sdg dfsghfghj dsgfs', 1, NULL, NULL, '2025-04-05 15:09:32', NULL),
(6, 'dsagffds sdh dggfds', 's dhsdfg sdfh dgjh dfghsfd hgfd', 1, NULL, NULL, '2025-04-05 15:09:59', NULL),
(7, 'balram', 'balram', 1, NULL, NULL, '2025-04-05 15:10:23', NULL),
(8, 'atul kumar yadavq', 'asfhaksdfg alsdf gagsdf gaslkd jaks kldajsg kjahgs', 1, NULL, NULL, '2025-04-05 15:11:24', NULL),
(9, 'adfa', ' dfghdfhg dfhg dsfh ', 1, NULL, NULL, '2025-04-05 15:12:18', NULL),
(10, 'asfda s', ' asfdas fdas dfas f as', 1, NULL, NULL, '2025-04-05 15:12:40', NULL),
(11, 'asfda sfdasfasf', ' asdfasdf asdfasfdahgaf asfasfd ', 1, NULL, NULL, '2025-04-05 15:12:59', NULL),
(12, 'ram', 'ram ram ram', 1, NULL, NULL, '2025-04-05 15:17:03', NULL),
(13, 'ram', 'ram ram', 1, NULL, NULL, '2025-04-05 15:18:10', NULL),
(14, 'jo jo gua ', 'so ho gya', 1, NULL, NULL, '2025-04-05 15:19:22', NULL),
(15, 'Sab ab ram bhaorshe', 'jai ho bajarang bali hanuman ', 1, NULL, NULL, '2025-04-05 15:19:48', NULL),
(16, 'Java and Javascript are same ', 'I am confused in between java snd javascript , is both are same., What is openion.', 2, NULL, NULL, '2025-04-05 15:22:58', NULL),
(17, 'What is a correct syntax to output \"Hello World\" in Java?', 'Please help to understand this question so that i can work oin it. thanks in advance', 2, 0, NULL, '2025-04-08 09:03:36', NULL),
(18, 'What is a correct syntax to output \"Hello World\" in Java?', 'Please help to understand this question so that i can work oin it. thanks in advance', 2, 2, NULL, '2025-04-08 09:04:30', NULL),
(19, 'What is&ltscript&gtalert(\"Hello\")&lt/script&gt', '&ltscript&gtalert(\"Hello\")&lt/script&gt is a javascript code statement which you should not use in java', 2, 2, NULL, '2025-04-08 13:29:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0:not deleted, 1 deleted',
  `account_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0:actie, 1 :inactive',
  `account_type` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_email`, `username`, `password`, `created_at`, `updated_at`, `is_deleted`, `account_status`, `account_type`) VALUES
(1, 'atul@gmail.com', 'Atul5034037', '$2y$10$BfesOpshJJIv0I7WTrOnIOKSHJoVKc74w0jxvCFUPK/jJUBM/hyHW', '2025-04-06 12:06:08', NULL, 0, 0, 0),
(2, 'balram@gmail.com', 'BalramSingh', '$2y$10$QWONRy5fhBQnsncpBh9d9u1mC5Wjia7YH7DG8GnL/BK4isI/plevO', '2025-04-06 12:24:02', NULL, 0, 0, 0),
(3, 'admin@gmail.com', 'Admin GROUP', '$2y$10$xi4X5KGVl97D42/crrU7L.BFNwW642sfa9/oo01Ingwx2Wf1J7jQq', '2025-04-25 20:09:29', NULL, 0, 0, 1),
(4, 'jyoti@gmail.com', 'Jyoti Yadav', '$2y$10$lgJ4JfLcgl3fwMtJW/KVqOGg7QsK0Ve.pAP9.rS/71JgY0Oe/ubXK', '2025-04-25 20:39:24', NULL, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category_requests`
--
ALTER TABLE `category_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);
ALTER TABLE `questions` ADD FULLTEXT KEY `question_title` (`question_title`,`quesition_description`);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category_requests`
--
ALTER TABLE `category_requests`
  MODIFY `request_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
