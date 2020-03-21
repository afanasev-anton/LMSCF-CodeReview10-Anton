-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2020 at 04:17 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr10_anton_biglibrary`
--
CREATE DATABASE IF NOT EXISTS `cr10_anton_biglibrary` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr10_anton_biglibrary`;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `authId` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`authId`, `name`, `surname`) VALUES
(1, 'Hunter', 'S. Thompson'),
(2, 'George', 'Orwell'),
(3, 'Stephen', 'Hawking'),
(4, 'J.K.', 'Rowling'),
(5, 'Scott', 'Fitzgerald'),
(6, 'J.R.R.', 'Tolkien');

-- --------------------------------------------------------

--
-- Table structure for table `author_media`
--

CREATE TABLE `author_media` (
  `authId` int(11) NOT NULL,
  `mdId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author_media`
--

INSERT INTO `author_media` (`authId`, `mdId`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genId` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `genre_media`
--

CREATE TABLE `genre_media` (
  `genId` int(11) NOT NULL,
  `mdId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `mdId` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `img` varchar(128) DEFAULT 'https://images.app.goo.gl/tsb15vpiWm5vKsM3A',
  `isbn` int(11) DEFAULT NULL,
  `descr` varchar(256) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `publisher` int(11) NOT NULL,
  `type` enum('book','CD','DVD') DEFAULT 'book',
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`mdId`, `title`, `img`, `isbn`, `descr`, `publish_date`, `publisher`, `type`, `status`) VALUES
(1, 'Fear and Loathing in Las Vegas', 'https://images-na.ssl-images-amazon.com/images/I/516ewsQg54L._SX319_BO1,204,203,200_.jpg', 2147483647, 'This cult classic of gonzo journalism is the best chronicle of drug-soaked, addle-brained, rollicking good times ever committed to the printed page.  It is also the tale of a long weekend road trip that has gone down in the annals of American pop culture a', '1998-05-12', 1, 'book', 1),
(2, '1984', 'https://images-na.ssl-images-amazon.com/images/I/414C-IMjfmL._SX277_BO1,204,203,200_.jpg', 2147483647, 'Winston Smith toes the Party line, rewriting history to satisfy the demands of the Ministry of Truth. With each lie he writes, Winston grows to hate the Party that seeks power for its own sake and persecutes those who dare to commit thoughtcrimes. But as h', '1961-01-01', 2, 'book', 1),
(3, 'A Brief History of Time', 'https://images-na.ssl-images-amazon.com/images/I/51ui2QEBp3L._SX326_BO1,204,203,200_.jpg', 2147483647, 'A landmark volume in science writing by one of the great minds of our time, Stephen Hawking’s book explores such profound questions as: How did the universe begin—and what made its start possible? Does time always flow forward? Is the universe unending—or ', '1998-09-01', 3, 'book', 1),
(4, 'Harry Potter and the Sorcerers S', 'https://images-na.ssl-images-amazon.com/images/I/51HSkTKlauL._SX346_BO1,204,203,200_.jpg', 439708184, 'Harry Potter has no idea how famous he is. That is because he is being raised by his miserable aunt and uncle who are terrified Harry will learn that he is really a wizard, just as his parents were. But everything changes when Harry is summoned to attend a', '1998-09-01', 4, 'book', 1),
(5, 'The Great Gatsby', 'https://images-na.ssl-images-amazon.com/images/I/41iers%2BHLSL._SX326_BO1,204,203,200_.jpg', 2147483647, 'The story of the mysteriously wealthy Jay Gatsby and his love for the beautiful Daisy Buchanan, of lavish parties on Long Island at a time when The New York Times noted “gin was the national drink and sex the national obsession,” it is an exquisitely craft', '2004-09-30', 5, 'book', 1),
(6, 'The Lord of the Rings', 'https://images-na.ssl-images-amazon.com/images/I/51EstVXM1UL._SX331_BO1,204,203,200_.jpg', 2147483647, 'One Ring to rule them all, One Ring to find them, One Ring to bring them all and in the darkness bind them', '2012-08-14', 6, 'book', 1),
(7, 'Carl Sagan\'s Cosmos', 'https://images-na.ssl-images-amazon.com/images/I/71k4cN6NwML._SY445_.jpg', NULL, 'Astronomer Carl Sagan\'s landmark 13-part science series takes you on an awe-inspiring cosmic journey to the edge of the Universe and back aboard the spaceship of the imagination.', NULL, 7, 'DVD', 1),
(8, 'Planet Earth Collection', 'https://images-na.ssl-images-amazon.com/images/I/91waNU3fUTL._SY445_.jpg', NULL, 'In one of the most ambitious landmark series, Planet Earth allows us to experience the world from the viewpoint of the animals themselves.', NULL, 7, 'DVD', 1),
(9, 'Avatar - The Last Airbender: The', 'https://images-na.ssl-images-amazon.com/images/I/81O-dW1o1KL._SY445_.jpg', NULL, 'After a lapse of 100 years, the Avatar-spiritual master of the elements-has returned. And just in the nick of time. The Four Nations (Water, Earth, Fire, and Air) have become unbalanced. The Fire Nation wants to rule the world, and its first conquest will ', NULL, 7, 'DVD', 1),
(10, 'Song of Whales: Nature\'s Relaxin', 'https://images-na.ssl-images-amazon.com/images/I/416SMJW9PQL.jpg', NULL, 'Songs of the Whales', NULL, 7, 'CD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `pubId` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `city` varchar(85) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `size` enum('small','medium','big') DEFAULT 'small'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`pubId`, `name`, `city`, `address`, `size`) VALUES
(1, 'Vintage', '', '', 'small'),
(2, 'Signet Classic', '', '', 'small'),
(3, 'Bantam', '', '', 'small'),
(4, 'Scholastic', '', '', 'small'),
(5, 'Scribner', '', '', 'small'),
(6, 'Mariner Books', '', '', 'small'),
(7, 'unknown', NULL, NULL, 'small');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`authId`);

--
-- Indexes for table `author_media`
--
ALTER TABLE `author_media`
  ADD PRIMARY KEY (`authId`,`mdId`),
  ADD KEY `mdId` (`mdId`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genId`);

--
-- Indexes for table `genre_media`
--
ALTER TABLE `genre_media`
  ADD PRIMARY KEY (`genId`,`mdId`),
  ADD KEY `mdId` (`mdId`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`mdId`),
  ADD KEY `publisher` (`publisher`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`pubId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `authId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `mdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `pubId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `author_media`
--
ALTER TABLE `author_media`
  ADD CONSTRAINT `author_media_ibfk_1` FOREIGN KEY (`authId`) REFERENCES `authors` (`authId`),
  ADD CONSTRAINT `author_media_ibfk_2` FOREIGN KEY (`mdId`) REFERENCES `media` (`mdId`);

--
-- Constraints for table `genre_media`
--
ALTER TABLE `genre_media`
  ADD CONSTRAINT `genre_media_ibfk_1` FOREIGN KEY (`genId`) REFERENCES `genres` (`genId`),
  ADD CONSTRAINT `genre_media_ibfk_2` FOREIGN KEY (`mdId`) REFERENCES `media` (`mdId`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`publisher`) REFERENCES `publishers` (`pubId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
