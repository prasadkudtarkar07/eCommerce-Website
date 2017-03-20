-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2016 at 05:11 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cheapbooks`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `ssn` int(9) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(60) NOT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`ssn`, `name`, `address`, `phone`) VALUES
(100000001, 'ABC', 'ABCDEFGH', 1111111111),
(100000002, 'DEF', 'DEFGHIJK', 1111111112),
(100000003, 'GHI', 'GHIJKLMN', 1111111113),
(100000004, 'JKL', 'JKLMNOPQ', 1111111114),
(100000005, 'MNO', 'MNOPQRST', 1111111115);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `ISBN` int(13) NOT NULL,
  `title` varchar(30) NOT NULL,
  `year` int(4) NOT NULL,
  `price` float NOT NULL,
  `publisher` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ISBN`, `title`, `year`, `price`, `publisher`) VALUES
(100000003, 'superman', 2009, 90, 'DC'),
(100000004, 'arrow', 2012, 80, 'DC'),
(100000005, 'hulk', 2011, 100, 'Marvels'),
(100000006, 'captain', 2012, 90, 'Marvels'),
(100000007, 'antman', 2015, 80, 'Marvels');

-- --------------------------------------------------------

--
-- Table structure for table `contains`
--

CREATE TABLE `contains` (
  `ISBN` int(13) NOT NULL,
  `basketID` varchar(20) NOT NULL,
  `number` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contains`
--

INSERT INTO `contains` (`ISBN`, `basketID`, `number`) VALUES
(101, 'asdf', 1),
(102, 'asdf', 1),
(101, 'asdf', 1),
(101, 'asdf', 2),
(100000001, 'prasad', 2),
(100000002, 'prasad', 3);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `username` varchar(20) NOT NULL,
  `address` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` int(10) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username`, `address`, `email`, `phone`, `password`) VALUES
('avinash', 'avinash', 'avinash@avinash.com', 1234123412, 'a208e5837519309129fa466b0c68396b'),
('prasad', 'prasad', 'prasad@prasad.com', 1231231231, 'dee55bf8057abd8211bf80d6513577ff260e739d627c20762d9d617a393a89db'),
('prasadk', 'asdhbhh', 'prasadk@gmail.com', 1234567890, 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
('prasoon', 'prasoon', 'prasoon@prasoon.com', 1234512345, '04deaa277dadb5ffd8e38e4e4fe3ab959fe778de0213e1b080e2e46197a0ff3e'),
('pushpak', 'pushpak', 'pushpak@pushpak.com', 1351351351, '9ab3d5cccd6b161eedc3e77a4d0c8b54');

-- --------------------------------------------------------

--
-- Table structure for table `shippingorder`
--

CREATE TABLE `shippingorder` (
  `ISBN` int(13) NOT NULL,
  `warehouseCode` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `number` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shippingorder`
--

INSERT INTO `shippingorder` (`ISBN`, `warehouseCode`, `username`, `number`) VALUES
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasadk', 1),
(100000002, 1001, 'pushpak', 2),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000002, 1001, 'pushpak', 1),
(100000005, 1001, 'pushpak', 4),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000002, 1001, 'pushpak', 1),
(100000005, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000005, 1001, 'pushpak', 1),
(100000002, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000002, 1001, 'pushpak', 1),
(100000005, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000005, 1001, 'pushpak', 1),
(100000005, 1001, 'pushpak', 1),
(100000002, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000002, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000002, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000002, 1001, 'prasoon', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000005, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000005, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000005, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000005, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000005, 1001, 'pushpak', 3),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000005, 1001, 'pushpak', 79),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000003, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000003, 1001, 'pushpak', 4),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000003, 1001, 'pushpak', 2),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000003, 1001, 'pushpak', 2),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000003, 1001, 'pushpak', 3),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000003, 1001, 'pushpak', 4),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000003, 1001, 'pushpak', 101),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000003, 1001, 'pushpak', 11),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000003, 1001, 'pushpak', 90),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000003, 1001, 'pushpak', 3),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000003, 1001, 'pushpak', 2),
(100000003, 1001, 'pushpak', 1),
(100000003, 1001, 'pushpak', 1),
(100000003, 1001, 'pushpak', 1),
(100000003, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000003, 1001, 'pushpak', 2),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000001, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000001, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000004, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000004, 1001, 'pushpak', 10),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000001, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000001, 1001, 'pushpak', 1),
(100000001, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000001, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000001, 1001, 'pushpak', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000001, 1001, 'avinash', 1),
(100000001, 1001, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000004, 1001, 'avinash', 2),
(100000001, 1002, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000004, 1004, 'avinash', 2),
(100000001, 1002, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000001, 1002, 'avinash', 2),
(100000001, 1002, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000001, 1002, 'avinash', 1),
(100000001, 1002, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000002, 1001, 'pushpak', 1),
(100000001, 1002, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000002, 1001, 'pushpak', 1),
(100000001, 1002, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000002, 1001, 'pushpak', 2),
(100000001, 1002, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000005, 1001, 'pushpak', 1),
(100000001, 1002, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000005, 1001, 'pushpak', 2),
(100000001, 1002, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000003, 1003, 'pushpak', 1),
(100000001, 1002, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000003, 1003, 'pushpak', 3),
(100000001, 1002, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000004, 1004, 'pushpak', 3),
(100000001, 1002, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000006, 1001, 'pushpak', 2),
(100000001, 1002, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000006, 1001, 'pushpak', 1),
(100000001, 1002, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000007, 1001, 'pushpak', 2),
(100000001, 1002, 'prasad', 2),
(100000002, 1001, 'prasad', 3),
(100000007, 1001, 'pushpak', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingbasket`
--

CREATE TABLE `shoppingbasket` (
  `basketID` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shoppingbasket`
--

INSERT INTO `shoppingbasket` (`basketID`, `username`) VALUES
('avinash', 'avinash'),
('prasad', 'prasad'),
('prasadk', 'prasadk'),
('prasoon', 'prasoon'),
('pushpak', 'pushpak');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `ISBN` int(13) NOT NULL,
  `warehouseCode` int(6) NOT NULL,
  `number` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`ISBN`, `warehouseCode`, `number`) VALUES
(100000001, 1002, 107),
(100000002, 1001, 61),
(100000003, 1003, 196),
(100000004, 1004, 195),
(100000005, 1001, 197),
(100000006, 1001, 197),
(100000007, 1001, 197);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouseCode` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(60) NOT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouseCode`, `name`, `address`, `phone`) VALUES
(1001, 'A', 'pqrs', 2121212121),
(1002, 'B', 'qrst', 2147483647),
(1003, 'C', 'rstu', 2147483647),
(1004, 'D', 'stuv', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `writtenby`
--

CREATE TABLE `writtenby` (
  `ssn` int(9) NOT NULL,
  `ISBN` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `writtenby`
--

INSERT INTO `writtenby` (`ssn`, `ISBN`) VALUES
(100000002, 100000001),
(100000001, 100000002),
(100000004, 100000003),
(100000005, 100000004),
(100000003, 100000005),
(100000001, 100000006),
(100000001, 100000007);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`ssn`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `shoppingbasket`
--
ALTER TABLE `shoppingbasket`
  ADD PRIMARY KEY (`basketID`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouseCode`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
