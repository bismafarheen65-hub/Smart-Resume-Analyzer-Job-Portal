-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2026 at 07:55 PM
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
-- Database: `resumebuilder`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `Application_ID` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Job_ID` int(11) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Applied_Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`Application_ID`, `User_ID`, `Job_ID`, `Status`, `Applied_Date`) VALUES
(1, 1, 3, 'Applied', '2026-08-05 10:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `careerroles`
--

CREATE TABLE `careerroles` (
  `Role_ID` int(11) NOT NULL,
  `Role_Name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `Certification_ID` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Certificate_Name` varchar(150) DEFAULT NULL,
  `Issuing_Organization` varchar(150) DEFAULT NULL,
  `Year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `CV_ID` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `File_Name` varchar(255) DEFAULT NULL,
  `Upload_Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `cnic` varchar(20) DEFAULT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `education` text DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `certifications` text DEFAULT NULL,
  `projects` text DEFAULT NULL,
  `experience` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`CV_ID`, `User_ID`, `File_Name`, `Upload_Date`, `full_name`, `email`, `phone`, `address`, `cnic`, `languages`, `profile_picture`, `education`, `skills`, `certifications`, `projects`, `experience`) VALUES
(1, 1, NULL, '2026-07-22 12:42:11', 'Bisma Farheen', 'bismafarheen65@gmail.com', '03040882747', 'Islamabad ,Pakistan', '38103-4416915-8', 'Urdu,Saraiki,English', '1784724131mypic.jpeg', '{\"degree\":[\"BS Computer Engineering\"],\"institute\":[\"COMSATS University Islamabad\"],\"date\":[\"\"]}', 'CSS,cpp programming,HTML,Multisim,github,OOP,JAVA,MYSQL', '{\"name\":[\"campus honor role award\"],\"org\":[\"\"],\"date\":[\"\"]}', 'cgpa calculator,encryption system', '{\"title\":[],\"company\":[],\"date\":[]}');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `Education_ID` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Degree` varchar(100) DEFAULT NULL,
  `Institute` varchar(150) DEFAULT NULL,
  `Start_Year` year(4) DEFAULT NULL,
  `End_Year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `Experience_ID` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Company` varchar(150) DEFAULT NULL,
  `Job_Title` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Start_Date` date DEFAULT NULL,
  `End_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `Job_ID` int(11) NOT NULL,
  `Job_Title` varchar(150) DEFAULT NULL,
  `Company` varchar(150) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Required_Skills` text DEFAULT NULL,
  `Posted_Date` date DEFAULT NULL,
  `Employer_ID` int(11) DEFAULT NULL,
  `Company_Name` varchar(100) DEFAULT NULL,
  `Job_Type` varchar(50) DEFAULT NULL,
  `Salary` varchar(50) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `Experience` varchar(100) DEFAULT NULL,
  `Apply_Link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`Job_ID`, `Job_Title`, `Company`, `Description`, `Required_Skills`, `Posted_Date`, `Employer_ID`, `Company_Name`, `Job_Type`, `Salary`, `Location`, `Experience`, `Apply_Link`) VALUES
(1, 'Frontend developer', 'Coding company', 'We are looking for a skilled Frontend Developer to design, develop, and maintain responsive web applications. The candidate should have strong knowledge of HTML, CSS, JavaScript, and frontend frameworks, with the ability to create user-friendly interfaces and optimize website performance. The role involves collaborating with designers and backend developers to deliver high-quality web solutions.', 'HTML, CSS, JavaScript, React.js, Bootstrap, Responsive Design, Git', '2026-07-22', 2, 'Coding company', 'Remote', '25000', 'Islamabad', 'Entry Level', 'jobs@careerconnect.com'),
(3, 'Software Engineer', 'Vision IT Solutions', 'Vision IT Solutions is seeking a talented Software Engineer to join our development team. The ideal candidate should have strong programming skills and experience in designing, developing, testing, and maintaining software applications. The candidate will collaborate with cross-functional teams to deliver high-quality software solutions.', 'C++\r\nJava\r\nPHP\r\nMySQL\r\nHTML\r\nCSS\r\nJavaScript\r\nGit & GitHub\r\nProblem Solving\r\nObject-Oriented Programming (OOP)', '2026-08-05', 3, 'Vision IT Solutions', 'On Site', 'PKR 100,000 – 150,000 / Month', 'Lahore', 'Senior Level', 'hr@visionit.com');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `Project_ID` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Project_Name` varchar(150) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Technologies` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE `resume` (
  `Resume_ID` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Template_ID` int(11) DEFAULT NULL,
  `Resume_Title` varchar(150) DEFAULT NULL,
  `Created_Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resume_analysis`
--

CREATE TABLE `resume_analysis` (
  `Analysis_ID` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Job_ID` int(11) DEFAULT NULL,
  `Match_Percentage` int(11) DEFAULT NULL,
  `Matched_Skills` text DEFAULT NULL,
  `Missing_Skills` text DEFAULT NULL,
  `Suggestions` text DEFAULT NULL,
  `Analysis_Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resume_analysis`
--

INSERT INTO `resume_analysis` (`Analysis_ID`, `User_ID`, `Job_ID`, `Match_Percentage`, `Matched_Skills`, `Missing_Skills`, `Suggestions`, `Analysis_Date`) VALUES
(3, 1, 3, 60, 'C++,Java,MySQL,HTML,CSS,GitHub,OOP', 'PHP,JavaScript,Git,Problem Solving', 'Learn PHP and JavaScript to improve match|Familiarize yourself with Git version control|Highlight problem-solving skills in the resume', '2026-08-05 10:05:15'),
(4, 1, 1, 40, 'HTML,CSS', 'JavaScript,React.js,Bootstrap,Responsive Design,Git', 'Learn JavaScript and its frameworks like React.js|Familiarize yourself with Bootstrap and Responsive Design|Create a Git account and learn its basics', '2026-08-05 10:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `roleskills`
--

CREATE TABLE `roleskills` (
  `RoleSkill_ID` int(11) NOT NULL,
  `Role_ID` int(11) DEFAULT NULL,
  `Skill_Name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `Skill_ID` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Skill_Name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `Template_ID` int(11) NOT NULL,
  `Template_Name` varchar(100) DEFAULT NULL,
  `File_Path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(50) DEFAULT 'user',
  `Phone` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `Name`, `Email`, `Password`, `Created_At`, `role`, `Phone`, `Address`, `Website`) VALUES
(1, 'Bisma Farheen', 'bismafarheen65@gmail.com', 'Maibal1975', '2026-07-22 12:33:33', 'user', NULL, NULL, NULL),
(2, 'Farheen', 'farheen65@gmail.com', '1975', '2026-07-22 12:53:10', 'Employer', '03315853017', 'Islamabad,Pakistan', NULL),
(3, 'Vision IT Solutions', 'ali625@gmail.com', 'itvision', '2026-08-05 08:57:28', 'Employer', '+92 42 3567 8901', 'Johar Town, Lahore, Punjab, Pakistan', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`Application_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Job_ID` (`Job_ID`);

--
-- Indexes for table `careerroles`
--
ALTER TABLE `careerroles`
  ADD PRIMARY KEY (`Role_ID`);

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`Certification_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`CV_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`Education_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`Experience_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`Job_ID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`Project_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`Resume_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Template_ID` (`Template_ID`);

--
-- Indexes for table `resume_analysis`
--
ALTER TABLE `resume_analysis`
  ADD PRIMARY KEY (`Analysis_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `roleskills`
--
ALTER TABLE `roleskills`
  ADD PRIMARY KEY (`RoleSkill_ID`),
  ADD KEY `Role_ID` (`Role_ID`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`Skill_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`Template_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `Application_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `careerroles`
--
ALTER TABLE `careerroles`
  MODIFY `Role_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `Certification_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `CV_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `Education_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `Experience_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `Job_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `Project_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resume`
--
ALTER TABLE `resume`
  MODIFY `Resume_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resume_analysis`
--
ALTER TABLE `resume_analysis`
  MODIFY `Analysis_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roleskills`
--
ALTER TABLE `roleskills`
  MODIFY `RoleSkill_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `Skill_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `Template_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`Job_ID`) REFERENCES `jobs` (`Job_ID`);

--
-- Constraints for table `certifications`
--
ALTER TABLE `certifications`
  ADD CONSTRAINT `certifications_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `cv_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `resume`
--
ALTER TABLE `resume`
  ADD CONSTRAINT `resume_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`),
  ADD CONSTRAINT `resume_ibfk_2` FOREIGN KEY (`Template_ID`) REFERENCES `templates` (`Template_ID`);

--
-- Constraints for table `resume_analysis`
--
ALTER TABLE `resume_analysis`
  ADD CONSTRAINT `resume_analysis_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `roleskills`
--
ALTER TABLE `roleskills`
  ADD CONSTRAINT `roleskills_ibfk_1` FOREIGN KEY (`Role_ID`) REFERENCES `careerroles` (`Role_ID`);

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
