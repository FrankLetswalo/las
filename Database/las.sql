-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2020 at 12:24 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `las`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_code` varchar(80) NOT NULL,
  `course_name` varchar(80) NOT NULL,
  `no_students` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_code`, `course_name`, `no_students`) VALUES
(2, 'NDISF01', 'Information Technology', 50),
(3, 'NDITF03', 'Information Technology(Extended)', 11),
(5, 'NDIBS01', 'Business Analysis', 5);

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `id` int(11) NOT NULL,
  `staff_no` varchar(15) NOT NULL,
  `firstname` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `password` varchar(80) NOT NULL,
  `date_registered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`id`, `staff_no`, `firstname`, `lastname`, `email`, `contact_no`, `password`, `date_registered`) VALUES
(1, '214700297', 'Rebone', 'Mogale', 'manuel@gmail.com', '0823207253', 'Password1', '2020-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_no` varchar(20) NOT NULL,
  `message` varchar(200) NOT NULL,
  `lecture_no` varchar(20) NOT NULL,
  `date_posted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `student_name`, `student_no`, `message`, `lecture_no`, `date_posted`) VALUES
(4, 'George Mahlangu', '214700298', 'hhhhhhhhhhhh', '214700297', '2020-02-25');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `student_no` varchar(10) NOT NULL,
  `firstname` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL,
  `id_number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `date_registered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_no`, `firstname`, `lastname`, `id_number`, `email`, `contact_no`, `password`, `course_code`, `date_registered`) VALUES
(1, '214700298', 'George', 'Mahlangu', '9705214865210', 'harry@gmail.com', '0823207258', '12345678', 'NDISF01', '2020-01-29'),
(4, '216137990', 'Matshidiso', 'Jabane', '9705215246088', 'jabane@gmail.com', '0823206798', 'Password1', 'NDISF01', '2020-02-25'),
(5, '215266397', 'George', 'Mahlangu', '9705214865210', 'george@gmail.com', '0823207253', 'Gmanrulez1', 'NDITF03', '2020-02-25');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `courseID` int(11) NOT NULL,
  `subject_code` varchar(10) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `lecture_number` varchar(15) NOT NULL,
  `no_students` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`courseID`, `subject_code`, `subject_name`, `course_code`, `lecture_number`, `no_students`) VALUES
(1, 'TPG111T', 'Technical Programming IA', 'NDISF01', '214541491', 16),
(4, 'DSO23BT', 'Software Development 2A', 'NDIBS01', '214700298', 5),
(5, 'ISY34AT', 'Information Systems IIIA', 'NDISF01', '214541491', 60),
(6, 'DSO17AT', 'Software Development IA', 'NDISF01', '214541491', 90);

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `id` int(11) NOT NULL,
  `student_no` varchar(20) NOT NULL,
  `student_name` varchar(80) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `date_submitted` date NOT NULL,
  `filepath` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`id`, `student_no`, `student_name`, `subject_code`, `course_code`, `description`, `date_submitted`, `filepath`) VALUES
(14, '214700298', 'George Mahlangu', 'TPG111T', 'NDISF01', 'No Descrition Added', '2020-02-25', 'files/214700298 1.pdf'),
(15, '214700298', 'George Mahlangu', 'DSO17AT', 'NDISF01', 'No Descrition Added', '2020-02-25', 'files/214700298 2.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code` (`course_code`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lecture`
--
ALTER TABLE `lecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
