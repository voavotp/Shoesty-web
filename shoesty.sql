-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 03:17 AM
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
-- Database: `shoesty`
--

-- --------------------------------------------------------

--
-- Table structure for table `shoes`
--

CREATE TABLE `shoes` (
  `ShoeID` int(255) NOT NULL,
  `Model` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` decimal(25,0) NOT NULL,
  `Brand` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoes`
--

INSERT INTO `shoes` (`ShoeID`, `Model`, `Name`, `Price`, `Brand`, `Email`, `Image`) VALUES
(1, 'Air Jordan 1', 'Bred', 450, 'Nike', 'vladimiriliev05@gmail.com', 'images/aj1_bred.png'),
(2, 'Air Jordan 1', 'Haze', 250, 'Nike', 'viktor@gmail.com', 'images/aj1_haze.png'),
(3, 'Air Jordan 4', 'Military Black', 700, 'Nike', 'chacha2@gmail.com', 'images/aj4_militaryblack.png'),
(4, 'Air Jordan 4', 'Yellow Thunder', 360, 'Nike', 'chacha2@gmail.com', 'images/aj4_thunder.png'),
(5, 'Air Jordan 4', 'Travis Scott', 1700, 'Nike', 'viktor@gmail.com', 'images/aj4_ts.png'),
(6, 'Flex Experience', 'Black', 150, 'Nike', 'vladimiriliev05@gmail.com', 'images/flexe_black.png'),
(7, 'Joyride', 'Black White', 200, 'Nike', 'jameson@gmail.com', 'images/joyrdie_bw.png'),
(8, '550s', 'Classic', 120, 'New Balance', 'jameson@gmail.com', 'images/nb550_classic.png'),
(9, 'Ultra Boost', 'Original', 240, 'Adidas', 'chacha2@gmail.com', 'images/ultraboost_og.png'),
(10, 'Yeezy 350', 'Dazzling Blue', 420, 'Adidas', 'vladimiriliev05@gmail.com', 'images/yeezy350_blue.png'),
(11, 'Yeezy 350', 'Zebra', 512, 'Adidas', 'chacha2@gmail.com', 'images/yeezy350_zebra.png'),
(33, 'Gat', 'Replica', 590, 'Maison Margiela', 'jonnvrl@gmail.com', 'images/maisonmargiela_gat.png'),
(35, 'Air Jordan 1', 'Travis Scott Mocha', 1800, 'Nike', 'mi@gmail.com', 'images/aj1.ts.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `Surname`, `Email`, `Username`, `Password`, `Admin`) VALUES
(1, 'mi', 'name', 'mi@gmail.com', 'mi', '$2y$10$K1HU.FLRPESlIvuUi118Iubd5khxRm4n85DND8SvBvwM1EpBmsUvm', 0),
(2, 'Admin', 'Admin', 'adminshoe@gmail.com', 'ShoeAdmin', '$2y$10$2a9VpKgKxAq6IpUuNWU/4OO.QFdftYrMS6OQU1nVJOrquTRnC9R6C', 1),
(3, 'Vladimir', 'Iliev', 'vladimiriliev05@gmail.com', 'vova', '$2y$10$ffgOMsxDiWLZRuCZTNv.8uO80wNNI8j/epoTxiopMFWiw2nipu2wC', 0),
(4, 'victor', 'von doom', 'viktor@gmail.com', 'DrDoom', '$2y$10$XO9dOY9uEqXVQgA9P2XhW.S6Gxmq3DwhUG5tadcnNORAaPpz3FakS', 0),
(5, 'James', 'Borros', 'jameson@gmail.com', 'James', '$2y$10$C.dw1cKxgkzjlSHtQxxGl.xhhJlyKYjtlXJ.ADg7SfHyJPtne9XLS', 0),
(6, 'Charles', 'Charlstar', 'chacha2@gmail.com', 'Charlie', '$2y$10$Csah2ammeBEmWllj02p5me2m7tqQp.AEfTuWj/lR3W8CM.suH//F2', 0),
(7, 'izo', 'nipe', 'izo@gmail.com', 'izo', '$2y$10$4zTlBYf21xUvs23cKCe9TuS31nfMPUcTYcgdEg3tYE5Ot0peyyYQq', 0),
(8, 'v', 'v', 'v@gmail.com', 'v', '$2y$10$7oYZxWQHcvz5CQi7c5JnveC0SKSeas9ktpW29mrqv2v49cQr6z9MO', 0),
(9, 'jonn', 'vural', 'jonnvrl@gmail.com', 'EvilWizard', '$2y$10$0267BqMuyL0xRIztth4m1OwMFLre6ENLku/Bj7wqbIubBZXKgx.n6', 0),
(10, '1', '2', '2@gmail.com', '2', '$2y$10$eqvELNT0Uf7JXj7kVPSBHOQ3SSRybDRdXP353NW3NZwP.BWFlYTAa', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shoes`
--
ALTER TABLE `shoes`
  ADD PRIMARY KEY (`ShoeID`),
  ADD KEY `sellersrelation` (`Email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shoes`
--
ALTER TABLE `shoes`
  MODIFY `ShoeID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shoes`
--
ALTER TABLE `shoes`
  ADD CONSTRAINT `sellersrelation` FOREIGN KEY (`Email`) REFERENCES `users` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
