-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 21, 2022 at 10:53 AM
-- Server version: 8.0.23
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moodle`
--

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` ( `quizId` INT NOT NULL AUTO_INCREMENT , `courseId` INT NOT NULL , `quizName` VARCHAR(255) NOT NULL , PRIMARY KEY (`quizId`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quizgrade`
--

CREATE TABLE `moodle`.`quizgrade` ( `quizId` INT NOT NULL , `userId` INT NOT NULL , `grade` INT NOT NULL ) ENGINE = InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `quizquestions`
--

CREATE TABLE `moodle`.`quizquestions` ( `questionId` INT NOT NULL AUTO_INCREMENT , `quizId` INT NOT NULL , `question` VARCHAR(255) NOT NULL , `answer1` VARCHAR(255) NOT NULL , `answer2` VARCHAR(255) NOT NULL , `answer3` VARCHAR(255) NOT NULL , `answer4` VARCHAR(255) NOT NULL , `correctAnswer` VARCHAR(255) NOT NULL , PRIMARY KEY (`questionId`)) ENGINE = InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assignmentId` int NOT NULL,
  `courseId` int NOT NULL,
  `assignmentDetails` varchar(50) DEFAULT NULL,
  `dueDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assignmentgrade`
--

CREATE TABLE `assignmentgrade` (
  `assignmentId` int NOT NULL,
  `fileId` int NOT NULL,
  `userId` int NOT NULL,
  `grade` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseId` int NOT NULL,
  `courseName` int NOT NULL,
  `department` varchar(50) NOT NULL,
  `courseLeader` varchar(50) NOT NULL,
  `courseLevel` int NOT NULL,
  `courseProgramme` varchar(100) NOT NULL,
  `awardingBody` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `fileId` int NOT NULL,
  `fileName` varchar(50) NOT NULL,
  `authorId` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `lectureId` int NOT NULL,
  `courseId` int NOT NULL,
  `lectureDecrpt` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lectureresource`
--

CREATE TABLE `lectureresource` (
  `lectureId` int NOT NULL,
  `fileId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentId` int NOT NULL,
  `fee` double(5,2) NOT NULL,
  `courseStatus` varchar(50) NOT NULL,
  `personalutor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `studentassignment`
--

CREATE TABLE `studentassignment` (
  `studentId` int NOT NULL,
  `assignmentId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `studenttakingcourse`
--

CREATE TABLE `studenttakingcourse` (
  `studentId` int NOT NULL,
  `courseId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `tutorId` int NOT NULL,
  `salary` double(7,2) NOT NULL,
  `courseGiving` varchar(50) NOT NULL,
  `contractType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(15) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `phoneNumber` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `address` varchar(60) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `userType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignmentresource`
--

CREATE TABLE `assignmentresource` (
  `assignmentId` int NOT NULL,
  `fileId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `phoneNumber`, `email`, `password`, `address`, `dateOfBirth`, `userType`) VALUES
(202020, 'Noyal', 'Babu', '848966283', 'janumma@yahoo.com', '0147', 'Kerela', '2012-03-01', 'tutor'),
(20220001, 'Diego', 'Caseroles', 'asd', 'ads', '1234', 'asd', '2022-01-12', 'student'),
(20220003, 'asd', 'asd', '07722182910', 'ads', 'asd', 'asd', '2022-01-12', 'asd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assignmentId`),
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `quizgrade`
--
ALTER TABLE `quizgrade`
  ADD KEY `quizId` (`quizId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `quizquestions`
--
ALTER TABLE `quizquestions`
  ADD KEY `quizId` (`quizId`);

--
-- Indexes for table `assignmentresource`
--
ALTER TABLE `assignmentresource`
  ADD KEY `assignmentId` (`assignmentId`),
  ADD KEY `fileId` (`fileId`);

--
-- Indexes for table `assignmentgrade`
--
ALTER TABLE `assignmentgrade`
  ADD KEY `assignmentId` (`assignmentId`),
  ADD KEY `fileId` (`fileId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseId`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`fileId`),
  ADD KEY `authorId` (`authorId`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`lectureId`),
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `lectureresource`
--
ALTER TABLE `lectureresource`
  ADD KEY `lectureId` (`lectureId`),
  ADD KEY `fileId` (`fileId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD KEY `studentId` (`studentId`);

--
-- Indexes for table `studentassignment`
--
ALTER TABLE `studentassignment`
  ADD KEY `studentId` (`studentId`),
  ADD KEY `assignmentId` (`assignmentId`);

--
-- Indexes for table `studenttakingcourse`
--
ALTER TABLE `studenttakingcourse`
  ADD KEY `studentId` (`studentId`),
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD KEY `tutorId` (`tutorId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `assignmentId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `fileId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lecture`
--
ALTER TABLE `lecture`
  MODIFY `lectureId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20220004;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `course` (`courseId`);

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `course` (`courseId`);

--
-- Constraints for table `quizgrade`
--
ALTER TABLE `quizgrade`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`quizId`) REFERENCES `quiz` (`quizId`),
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `quizquestions`
--
ALTER TABLE `quizquestions`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`quizId`) REFERENCES `quiz` (`quizId`);

--
-- Constraints for table `assignmentresource`
--
ALTER TABLE `assignmentresource`
  ADD CONSTRAINT `assignmentresource_ibfk_1` FOREIGN KEY (`assignmentId`) REFERENCES `assignment` (`assignmentId`),
  ADD CONSTRAINT `assignmentresource_ibfk_2` FOREIGN KEY (`fileId`) REFERENCES `file` (`fileId`);

--
-- Constraints for table `assignmentgrade`
--
ALTER TABLE `assignmentgrade`
  ADD CONSTRAINT `assignmentgrade_ibfk_1` FOREIGN KEY (`assignmentId`) REFERENCES `assignment` (`assignmentId`),
  ADD CONSTRAINT `assignmentgrade_ibfk_2` FOREIGN KEY (`fileId`) REFERENCES `file` (`fileId`),
  ADD CONSTRAINT `assignmentgrade_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `user` (`id`);

--
-- Constraints for table `lecture`
--
ALTER TABLE `lecture`
  ADD CONSTRAINT `lecture_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `course` (`courseId`);

--
-- Constraints for table `lectureresource`
--
ALTER TABLE `lectureresource`
  ADD CONSTRAINT `lectureresource_ibfk_1` FOREIGN KEY (`lectureId`) REFERENCES `lecture` (`lectureId`),
  ADD CONSTRAINT `lectureresource_ibfk_2` FOREIGN KEY (`fileId`) REFERENCES `file` (`fileId`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `user` (`id`);

--
-- Constraints for table `studentassignment`
--
ALTER TABLE `studentassignment`
  ADD CONSTRAINT `studentassignment_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `student` (`studentId`),
  ADD CONSTRAINT `studentassignment_ibfk_2` FOREIGN KEY (`assignmentId`) REFERENCES `assignment` (`assignmentId`);

--
-- Constraints for table `studenttakingcourse`
--
ALTER TABLE `studenttakingcourse`
  ADD CONSTRAINT `studenttakingcourse_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `student` (`studentId`),
  ADD CONSTRAINT `studenttakingcourse_ibfk_2` FOREIGN KEY (`courseId`) REFERENCES `course` (`courseId`);

--
-- Constraints for table `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `tutor_ibfk_1` FOREIGN KEY (`tutorId`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
