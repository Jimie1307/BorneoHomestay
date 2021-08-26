-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2020 at 11:23 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homestay_webeng`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `homestayID` int(11) NOT NULL,
  `bookingPay` double NOT NULL,
  `checkIn` date NOT NULL,
  `checkOut` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingID`, `userID`, `homestayID`, `bookingPay`, `checkIn`, `checkOut`) VALUES
(5, 11, 11, 460, '2020-07-09', '2020-07-11'),
(8, 19, 13, 90, '2020-08-11', '2020-08-12'),
(9, 19, 14, 690, '2020-09-22', '2020-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(3) NOT NULL,
  `commentText` varchar(500) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `homestayName` varchar(50) NOT NULL,
  `rating` int(2) NOT NULL,
  `datePosted` timestamp NOT NULL DEFAULT current_timestamp(),
  `strikeTally` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `commentText`, `userName`, `homestayName`, `rating`, `datePosted`, `strikeTally`) VALUES
(13, 'I love BT21 so this is perfect for me <3', 'Susan', 'BT21', 5, '2020-08-08 15:09:38', 0),
(14, 'Too spooky for me. I saw something whilst asleep !', 'Susan', 'Haunting Enchancemen', 2, '2020-08-08 15:19:40', 1),
(15, 'Very cute and comfortable. The mascots are clean and friendly as well!', 'Susan', 'Kumamon Come On!', 4, '2020-08-08 15:20:33', 0),
(16, 'Very nice homestay to stay at! <3', 'Susan', 'Rilakkuma Kurma', 5, '2020-08-08 15:23:41', 0),
(17, 'It\'s a budget hotel so do not expect too much,, but hey it\'s okay for a short stay.', 'Susan', '706 Budget Hotel', 3, '2020-08-08 15:24:25', 0),
(18, 'Very nice place! Spacious, very nice for visitors coming here to this state. Love it', 'Julien Solomita', 'Jumios Hotel', 4, '2020-08-09 17:18:54', 0),
(19, 'The place is cute however considering the price...the rooms were pretty cramped.', 'Juicy Sauce', 'BT21', 4, '2020-08-09 17:30:52', 0),
(28, 'I dont like it. Too dull. HATE it!', 'Juicy Sauce', '706 Budget Hotel', 2, '2020-08-09 17:47:00', 0),
(29, 'It\'s Kumamon mate! Of course it\'s dope!!', 'Juicy Sauce', 'Kumamon Come On!', 4, '2020-08-09 17:48:09', 0),
(30, 'A ghost tried to tickle me! Not advised to stay here too long.', 'Suzanna', 'Haunting Enchancemen', 1, '2020-08-09 20:19:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `homestay`
--

CREATE TABLE `homestay` (
  `homestayID` int(11) NOT NULL,
  `homestayName` varchar(50) NOT NULL,
  `homestayAddress` varchar(50) NOT NULL,
  `homestayState` varchar(30) NOT NULL,
  `homestayImg` varchar(50) NOT NULL,
  `homestayPrice` int(5) DEFAULT NULL,
  `availability` varchar(1) NOT NULL,
  `rating` float DEFAULT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homestay`
--

INSERT INTO `homestay` (`homestayID`, `homestayName`, `homestayAddress`, `homestayState`, `homestayImg`, `homestayPrice`, `availability`, `rating`, `userID`) VALUES
(10, 'BT21', 'Tata Street', 'Melaka', 'homestayImg/bt21hotel.jpg', 200, 'Y', 4.5, 12),
(11, 'Jumios Hotel', 'Stardew Valley', 'Kedah', 'homestayImg/bedlab06-3.jpg', 230, 'Y', 4, 12),
(12, 'Haunting Enchancemen', 'Batu Terlemas 56', 'Selangor', 'homestayImg/hauntedhotel-1.jpg', 80, 'Y', 1.5, 13),
(13, '706 Budget Hotel', 'Jalan Sutera Emas 78', 'Sabah', 'homestayImg/IMG_0132.jpg', 90, 'Y', 2.25, 13),
(14, 'Kumamon Come On!', 'Watashino Paradise Street', 'Pahang', 'homestayImg/iforgothisname.jpg', 230, 'Y', 4, 12),
(15, 'Rilakkuma Kurma', 'Rila Street 24', 'Johor', 'homestayImg/rilakkuma.jpg', 250, 'Y', 5, 12),
(17, 'Sweet Dodol', 'Taman Sutera Dodol 16, Jumpstreet Walk', 'Terengganu', 'homestayImg/238314850.jpg', 90, 'Y', NULL, 11),
(18, 'Sugar Glider', 'Jalan Gula Gelongsor 16', 'Sarawak', 'homestayImg/88f17fe8329a77c223ee412213c69d15.jpg', 190, 'Y', NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportID` int(3) NOT NULL,
  `commentID` int(3) NOT NULL,
  `reportCause` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`reportID`, `commentID`, `reportCause`) VALUES
(14, 14, 'Spam');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `requestID` int(3) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `userEmail` varchar(64) NOT NULL,
  `hsName` varchar(50) NOT NULL,
  `hsAddress` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(64) NOT NULL,
  `userPwd` varchar(12) NOT NULL,
  `pwdEncrypt` varchar(255) DEFAULT NULL,
  `userType` int(2) DEFAULT NULL,
  `ownership` varchar(2) NOT NULL,
  `createTime` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userName`, `userEmail`, `userPwd`, `pwdEncrypt`, `userType`, `ownership`, `createTime`) VALUES
(8, 'Susanna', 'suesue@gmail.com', 'sueSusan123', '$2y$10$ZwFBD0Ln82vPCkGcAxVgAOgT2rKkUq95h//fvjHSl1nDwicNTiRty', 1, 'N', '2020-07-27 03:01:34'),
(11, 'Dodol', 'didie@gmail.com', 'dodolCuka123', '$2y$10$50//Gn8yW5VTnnlQShQHfOX5agSSqaN2OA1eoENnX9pjw7V9wQXMa', 1, 'Y', '2020-07-27 04:53:08'),
(12, 'Jimin', 'jimin@gmail.com', 'jiminBabo123', '$2y$10$Jl.D5KgL89pPCINKLSGpYuBZwKoFEswiDE3i0exQKKtssLoGr7qqK', 1, 'Y', '2020-07-27 05:00:50'),
(13, 'Taehyung', 'taetae@gmail.com', 'taeHyung99', '$2y$10$V0SvdnMKvos0AkeGcZDEm.607z98LJjSVr91OdoHQ9gQKogBHOt8a', 1, 'Y', '2020-07-27 05:05:27'),
(15, 'Jung Hoseok', 'hoseokAdmin@gmail.com', 'hoSeok34', '$2y$10$sva4BFNx3soXwvLoepab0ePhU/SsvAV1cLiMESznomA1LTvJzDGSW', 2, 'N', '2020-08-04 08:45:46'),
(17, 'Min Yoongi', 'yoongiBbong@gmail.com', 'adomino37', '$2y$10$g5GveK7UksVNNauanTb56ucKwQBbeTCF.FSgMj139s5SgI4qTe/Ee', 2, 'N', '2020-08-04 15:26:07'),
(18, 'Juicy Sauce', 'saucey@rocketmail.com', 'rockyRocky78', '$2y$10$sxDni64cJWzEQq82SuskjeftsU8ie.AsLrUduHjnsxfSRadnEEbfu', 1, 'N', '2020-08-04 16:09:21'),
(19, 'Julien Solomita', 'juju@gmail.com', 'jujuSolo13', '$2y$10$7Dp0Aopmr8Agll.FCYxG7.hhEL1214Bpzfvx/86jWG9zYxWuIVh2W', 1, 'N', '2020-08-09 17:17:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `homestayID` (`homestayID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `homestay`
--
ALTER TABLE `homestay`
  ADD PRIMARY KEY (`homestayID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportID`),
  ADD KEY `report_ibfk_1` (`commentID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`requestID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `homestay`
--
ALTER TABLE `homestay`
  MODIFY `homestayID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `requestID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`homestayID`) REFERENCES `homestay` (`homestayID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `homestay`
--
ALTER TABLE `homestay`
  ADD CONSTRAINT `homestay_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`commentID`) REFERENCES `comments` (`commentID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
