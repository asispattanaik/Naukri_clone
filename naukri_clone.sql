-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 26, 2025 at 04:42 AM
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
-- Database: `naukri_clone`
--

-- --------------------------------------------------------

--
-- Table structure for table `github_scores`
--

CREATE TABLE `github_scores` (
  `user_id` int(11) DEFAULT NULL,
  `repos` int(11) DEFAULT NULL,
  `commits` int(11) DEFAULT NULL,
  `languages` text DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `salary` varchar(50) DEFAULT NULL,
  `job_type` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_title`, `company_name`, `location`, `experience`, `salary`, `job_type`, `description`, `created_at`) VALUES
(1, 'Full stack developer', 'TCS', 'Bengaluru', '0-2 years', '4lpa', 'Full Time', 'Full stack developer \r\nSkills: Python, sql', '2025-12-16 17:38:25'),
(3, 'Data Analytics', 'Coginzant', 'Bengaluru, Hyderabad', '0-1', '5-6LPA', 'Full Time', '-At Cognizant, we are proud to be at the forefront of the data-driven revolution. By applying the latest analytics tools and techniques, we maximize our offerings and deliver meaningful support to our clients. To continue growing, we are looking for an experienced Data Analyst to join our team. \r\nStrong foundation in statistics and hands-on experience with tools such as Excel, SQL, R, or Python\r\nProven ability to analyze, structure, and present large data sets with clarity\r\nExperience creating reports, dashboards, or data visualizations for decision making', '2025-12-17 04:20:47'),
(4, 'Data Engineer', 'TCS', 'Bhubaneswar, Odisha', '1-2 Years', '6-7 LPA', 'Full Time', 'We are looking for a skilled data engineer to design, build, and maintain reliable data pipelines and infrastructure. The ideal candidate will have experience working with large datasets, cloud platforms, and distributed systems to ensure our data is accessible, secure, and optimized for analysis.\r\n\r\nKey Responsibilities:\r\n\r\nDevelop and maintain scalable ETL pipelines.\r\nManage and optimize data warehouses and storage systems.\r\nEnsure data quality, security, and integrity across systems.\r\nCollaborate with data scientists, analysts, and software engineers to deliver reliable data solutions.\r\nWork with big data tools, cloud technologies, and real-time data streams.\r\nRequired Skills:\r\n\r\nProficiency in SQL and Python.\r\nExperience with cloud platforms like AWS, Azure, or GCP.\r\nHands-on knowledge of big data tools such as Hadoop, Spark, and Kafka.', '2025-12-17 04:26:12'),
(5, 'Python Developer', 'IBM', 'Noida, Bengaluru', '5-6 Years', '8-9 LPA', 'Full Time', 'We are looking for a Python Developer to join our engineering team and help us develop and maintain various software products.\r\nPython Developer responsibilities include writing and testing code, debugging programs and integrating applications with third-party web services. To be successful in this role, you should have experience using server-side logic and work well in a team.\r\nResponsibilities:\r\nWrite effective, scalable code\r\nDevelop back-end components to improve responsiveness and overall performance\r\nIntegrate user-facing elements into applications\r\nTest and debug programs', '2025-12-17 04:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Applied','Shortlisted','Rejected') DEFAULT 'Applied'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `user_id`, `job_id`, `applied_at`, `status`) VALUES
(4, 1, 5, '2025-12-17 17:27:33', NULL),
(5, 1, 4, '2025-12-21 18:46:52', 'Rejected'),
(6, 1, 3, '2025-12-21 19:55:36', 'Applied'),
(7, 1, 1, '2025-12-22 06:27:58', 'Applied');

-- --------------------------------------------------------

--
-- Table structure for table `recruiters`
--

CREATE TABLE `recruiters` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recruiters`
--

INSERT INTO `recruiters` (`id`, `company_name`, `email`, `password`) VALUES
(1, 'TCS', 'srikant.tcs@gmail.com', '$2y$10$Rk45DKa9/dF335UATdgAfOeY7HJC/YyCn/3zNNSroHCMBLUbsJAaq'),
(2, 'Cognizant', 'info@cognizant.com', '$2y$10$tW3vV1Tx8/iqikYXDXCQQuT5uTSxCrj65RQbfQqE4cSSFsevRod1.'),
(4, 'IBM', 'lopamudra@ibm.com', '$2y$10$sLPPX5DXpeSf/IB2Ri9VleSDNRwLGzXBk6yvv2oIPd.78oST0nB8G');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `recruiter_id` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL CHECK (`score` between 1 and 10),
  `comments` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `application_id`, `recruiter_id`, `score`, `comments`, `created_at`) VALUES
(1, 4, 1, 6, 'SQL knowledge must know', '2025-12-18 17:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `work_status` varchar(20) DEFAULT NULL,
  `profile_title` varchar(150) DEFAULT NULL,
  `profile_summary` text DEFAULT NULL,
  `education` varchar(150) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `languages` varchar(100) DEFAULT NULL,
  `projects` text DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('user','admin') DEFAULT 'user',
  `github_username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `mobile`, `work_status`, `profile_title`, `profile_summary`, `education`, `skills`, `languages`, `projects`, `resume`, `created_at`, `role`, `github_username`) VALUES
(1, 'Asis Pattanaik', 'asispattanaik11@gmail.com', '$2y$10$PH7H9bi.6/oeghRd5122..zNEfZgz3O.wcJ2PuAUcyZpPz91E82Sq', '7790003523', 'Fresher', 'Frontend Developer', 'I\'m a developer', 'B.tech in CSE-2023', 'Html,css, js, Python', 'English, Hindi, odia', 'hrms, egov', 'uploads/resumes/1766074360_Asis_Resume.pdf', '2025-12-14 19:33:09', 'user', 'asispattanaik'),
(2, 'Mrunmayee Dash', 'mrunmayee.22oct@gmail.com', '$2y$10$ovaQGwwFE5BykzCPRXAG8ODqiMhg2ojsDTBzJSmVftetemG7di/9.', '9437929266', 'Fresher', 'Data analyst', 'Not intrested', 'btech-2025', 'python,excel,powerbi', 'bhasa', '', 'Asis_Resume.pdf', '2025-12-14 19:42:57', 'user', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`job_id`);

--
-- Indexes for table `recruiters`
--
ALTER TABLE `recruiters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`);

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
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recruiters`
--
ALTER TABLE `recruiters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `job_applications` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
