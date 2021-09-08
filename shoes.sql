-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2020 at 01:59 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoes`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Address` text NOT NULL,
  `Postcode` text NOT NULL,
  `City` text NOT NULL,
  `Country` text NOT NULL,
  `Phone` text DEFAULT NULL,
  `Email` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--



-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `OrderID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`OrderID`, `ItemID`, `Quantity`) VALUES
(2, 3, 3),
(3, 3, 3),
(4, 3, 3),
(5, 3, 3),
(6, 3, 3),
(7, 3, 3),
(8, 2, 10),
(9, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `Amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `Amount`) VALUES
(2, 4, 75),
(3, 5, 75),
(4, 6, 75),
(5, 7, 75),
(6, 8, 75),
(7, 9, 75),
(8, 10, 205),
(9, 11, 40);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL,
  `Amount` double NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `CardType` text NOT NULL,
  `ExpDate` date NOT NULL,
  `NameCard` text NOT NULL,
  `CardNumber` varchar(25) NOT NULL,
  `SecurityCode` varchar(3) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

-- --------------------------------------------------------

--
-- Table structure for table `shoes`
--

CREATE TABLE `shoes` (
  `ID` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Size` int(11) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Price` double NOT NULL,
  `Colour` text NOT NULL,
  `Category` varchar(50) NOT NULL,
  `ImagePath` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shoes`
--

INSERT INTO `shoes` (`ID`, `Description`, `Size`, `Stock`, `Price`, `Colour`, `Category`, `ImagePath`) VALUES
(1, 'Blue shoe', 8, 10, 20, 'Blue', 'Male shoes', './Images/BlueShoe.jpg'),
(2, 'Red shoe', 9, 8, 20.5, 'Red', 'Female shoes', './Images/RedShoe.jpg'),
(3, 'Blue shoe', 10, 12, 25, 'Blue', 'Male shoes', './Images/BlueShoe.jpg'),
(4, 'Green sneakers', 7, 4, 50, 'green', 'Kids shoes', './Images/greenshoes.jpg'),
(5, 'Green sneakers', 6, 4, 50, 'green', 'Kids shoes', './Images/greenshoes.jpg'),
(6, 'Nice shoes', 9, 80, 65, 'brown', 'Male shoes', './Images/brownshoes.jpg'),
(7, 'Nice shoes ', 8, 80, 65, 'brown', 'Male shoes', './Images/brownshoes.jpg'),
(8, 'figuratively?', 8, 25, 50, 'Red', 'Female shoes', './Images/heels.jpg'),
(9, 'figuratively?', 8, 25, 50, 'Red', 'Female shoes', './Images/heels.jpg'),
(10, 'Small child shoe', 2, 5, 10, 'Brownish', 'Kids shoes', './Images/childshoe.jpg'),
(11, 'Small child shoe', 3, 3, 10, 'Brownish', 'Kids shoes', './Images/childshoe.jpg'),
(12, 'Dutch afterall', 8, 50, 20, 'Yellow', 'Male shoes', './Images/clogs.jpg'),
(13, 'Dutch afterall', 7, 50, 15, 'Yellow', 'Male shoes', './Images/clogs.jpg'),
(14, 'A strange mix', 10, 6, 65, 'Brown', 'Male shoes', './Images/mixshoe.jpg'),
(15, 'A strange mix', 7, 6, 45, 'Brown', 'Male shoes', './Images/mixshoe.jpg'),
(16, 'Black and white', 8, 10, 50, 'Black', 'Female shoes', './Images/blackandwhite.jpg'),
(17, 'Black and white', 6, 8, 50, 'Black', 'Female shoes', './Images/blackandwhite.jpg'),
(18, 'Green with purple ', 7, 25, 25, 'Green', 'Female shoes', './Images/darkgreen.jpg'),
(19, 'Green with purple ', 9, 25, 35, 'Green', 'Female shoes', './Images/darkgreen.jpg'),
(20, 'Red sneakers', 8, 25, 40, 'Red', 'Male shoes', './Images/shoe3.jpg'),
(21, 'Red sneakers', 8, 20, 40, 'Red', 'Female shoes', './Images/shoe3.jpg'),
(22, 'Blueish sneakers', 9, 6, 50, 'Blue', 'Male shoes', './Images/shoe2.jpg'),
(23, 'Blueish sneakers', 8, 7, 45, 'Blue', 'Male shoes', './Images/shoe2.jpg'),
(24, 'Leather sneakers', 8, 33, 35, 'Brown', 'Male shoes', './Images/shoe1.jpg'),
(25, 'Single sneaker', 12, 1, 100, 'Black', 'Male shoes', './Images/blacksneaker.jpg'),
(26, 'Another brown shoe', 8, 10, 50, 'Brown', 'Male shoes', './Images/brownshoe2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `Code` varchar(50) NOT NULL,
  `Amount` double NOT NULL,
  `Used` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`Code`, `Amount`, `Used`) VALUES
('GSTest2.5', 2.5, 1),
('GSTest5', 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD KEY `ItemID` (`ItemID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `CustomerID` (`CustomerID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `shoes`
--
ALTER TABLE `shoes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`Code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shoes`
--
ALTER TABLE `shoes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
