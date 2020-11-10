-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:51010
-- Generation Time: Nov 10, 2020 at 04:24 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `localdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `recipeID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `RecipeName` varchar(50) NOT NULL,
  `Images` blob NOT NULL,
  `Servings` int(11) DEFAULT NULL,
  `PreparationTime` int(11) DEFAULT NULL,
  `Ratings` int(11) DEFAULT NULL,
  `Ingredients` varchar(200) NOT NULL,
  `Instructions` text NOT NULL,
  `DateAdded` date DEFAULT NULL,
  `TimeAdded` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`recipeID`, `userID`, `RecipeName`, `Images`, `Servings`, `PreparationTime`, `Ratings`, `Ingredients`, `Instructions`, `DateAdded`, `TimeAdded`) VALUES
(1, NULL, 'Green smoothie', '', 2, 5, 4, '1 green apple, 2 kiwis, handful of fresh baby spinach, water', 'Mix everything in blender and enjoy!', '2020-11-04', '17:44:44'),
(2, NULL, 'Berry smoothie', '', 2, 5, 4, 'Berries, 1 banana, oat milk', 'Mix everything in blender and enjoy!', '2020-11-04', '17:47:39'),
(3, NULL, 'Caipirinha', '', 1, 4, 5, 'Pitu, ice cubes, brown sugar, lime', 'Smash lime and sugar in a glass. Add ice cubes and pitu. Enjoy!', '2020-11-04', '18:08:04'),
(4, NULL, 'Latte', '', 1, 10, 4, 'espresso coffee, milk', 'Make the espresso. Heat the milk. Put the hot milk in a cup and add the espresso.', '2020-11-04', '18:10:03'),
(6, NULL, 'Mojito', 0x4172726179, 4, 20, 5, 'Rum, lemon juice, mint, limes, sugar, sparkling water', 'Mix all the ingredients. Add ice. Decorate with mint.', '2020-11-05', '16:47:47'),
(7, NULL, 'Matcha latte', 0x4172726179, 2, 20, 4, 'Matcha tea, oat milk, water', 'Mix matcha powder with hot water, foam milk, pour over matcha tea. Enjoy.', '2020-11-06', '08:28:24'),
(8, NULL, 'Hot Chocolate', 0x4172726179, 3, 30, 5, 'Cocoa, dark chocolate, milk, sugar', 'Mix the ingredients, heat and foam the milk', '2020-11-05', '19:09:46'),
(9, 9, 'Aperol Spritz', 0x6472696e6b73322e6a7067, 4, 15, 5, 'Aperol, prosecco, sparkling water, ice, orange', 'Mix all the ingredients in a glass, serve with a slice of orange.', '2020-11-10', '07:35:00'),
(10, 9, 'Margerita', '', 5, 30, 5, 'Tequila, lemon juice, ice, salt', 'Mix the ingredients. Decorate the glass rim with salt.', '2020-11-10', '07:38:11'),
(11, 9, 'Strawberry smoothie', 0x6472696e6b73332e6a7067, 2, 20, 5, 'Strawberries, other berries, water, syrup, mint', 'Blend everything in a blender.', '2020-11-10', '07:50:09'),
(12, 9, 'Chocolate drink', '', 6, 30, 4, 'Cocoa, dark chocolate, sugar, cinnamon, whipped cream', 'Prepare cocoa, melt chocolate, decorate with cream and sprinkle with cinnamon.', '2020-11-10', '07:55:26'),
(16, 9, 'Flat white', '', 6, 20, 4, 'test test', 'test test', '2020-11-10', '10:39:23'),
(17, 9, 'Test coffee', 0x63686f636f6c6174652e6a7067, 2, 30, 4, 'test', 'test', '2020-11-10', '10:42:52'),
(18, 9, 'Iced tea', 0x677261706566727569742e6a7067, 4, 15, 4, 'Tea, ice, sugar, lemon, mint', 'test test', '2020-11-10', '10:56:34'),
(19, 9, 'Matcha', 0x6d61746368612d6c617474652e6a7067, 1, 15, 2, 'Matcha tea', 'test test', '2020-11-10', '11:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `Username` varchar(128) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `JoiningDate` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `Username`, `Password`, `JoiningDate`) VALUES
(7, 'admin', '$2y$10$vvpgrsESGo21Mh8rF5vcN.WiHbJJ.blVJ5UjXDcQDzniIw1mBu/tq', '2020-11-04 00:00:00'),
(8, 'Laura', '$2y$10$s7RvsdKsDRc3F5E/JAYUx.NiOcjCpBIIZqypQUL1XBwbASyw2BTCS', '2020-11-04 00:00:00'),
(9, 'aleksandra_p', '$2y$10$l0XaCgDI/0jxpGp/uMQurOtNafXLn5SJMLuCtg56I.KpqfAKo07mC', '2020-11-05 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`recipeID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `recipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `recipe_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
