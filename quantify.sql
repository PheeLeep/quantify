-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 09:46 AM
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
-- Database: `quantify`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Username` varchar(100) NOT NULL,
  `Hash` varchar(255) NOT NULL,
  `Salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Username`, `Hash`, `Salt`) VALUES
('admin', '$2y$10$KJSfLZ1DDFKqbAr8Cd6h1OPc8ZIi4kcplXU3QVC6E2a3Lf48t0DiK', 'F0GlR7NBEau9RHOjwCxwdYTEzKNUY2N0');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Cart_ID` varchar(100) NOT NULL,
  `Date_Created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Cart_ID`, `Date_Created`) VALUES
('cart_6674e198ae8a0', '2024-06-21 04:12:40'),
('cart_6674f970ea903', '2024-06-21 05:54:24'),
('cart_667524686e0dc', '2024-06-21 08:57:44'),
('cart_66752579e2ea1', '2024-06-21 09:02:17'),
('cart_66752dd00ee5e', '2024-06-21 09:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `CartItemID` varchar(100) NOT NULL,
  `Cart_ID` varchar(100) NOT NULL,
  `Product_Name` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartitem`
--

INSERT INTO `cartitem` (`CartItemID`, `Cart_ID`, `Product_Name`, `Quantity`) VALUES
('cartitem_66752f629ce04', 'cart_66752dd00ee5e', 'Gray Coat', 1),
('cartitem_66752fb9d02a9', 'cart_66752dd00ee5e', 'Gray Coat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(11) NOT NULL,
  `Category_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Category_Name`) VALUES
(0, 'Coat');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_ID` varchar(100) NOT NULL,
  `Order_Date` datetime NOT NULL,
  `StudentID` varchar(100) NOT NULL,
  `StudentName` varchar(255) NOT NULL,
  `StudentProg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_ID` varchar(100) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Category_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Name`, `Description`, `Price`, `Category_ID`) VALUES
('1', 'Gray Coat', 'A coat used by BSTM.', 150, 0),
('2', 'Blazer', 'afwdfgsadfa', 150, 0),
('3', 'Polo Shirt', 'asdasdasdfasdfa', 125, 0),
('4', 'Cap', 'gdbfghjmffdsasdgdgv', 150, 0),
('5', 'Gray Jacket', 'dn bfdsdfsnbfg', 150, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stockup`
--

CREATE TABLE `stockup` (
  `StockID` varchar(100) NOT NULL,
  `Product_ID` varchar(100) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Date_Added` datetime NOT NULL,
  `Username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart_ID`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD KEY `CartItemID` (`CartItemID`),
  ADD KEY `FK_CartItem_Product` (`Product_Name`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`),
  ADD KEY `FK_Product_CategoryID` (`Category_ID`);

--
-- Indexes for table `stockup`
--
ALTER TABLE `stockup`
  ADD KEY `FK_StockUp_Product` (`Product_ID`),
  ADD KEY `StockID` (`StockID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
