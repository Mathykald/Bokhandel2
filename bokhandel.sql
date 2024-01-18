-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 12:50 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bokhandel`
--

-- --------------------------------------------------------

--
-- Table structure for table `agerec_table`
--

CREATE TABLE `agerec_table` (
  `agerec_id` int(11) NOT NULL,
  `agerec_age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agerec_table`
--

INSERT INTO `agerec_table` (`agerec_id`, `agerec_age`) VALUES
(1, 3),
(2, 6),
(10, 12),
(11, 16),
(12, 18);

-- --------------------------------------------------------

--
-- Table structure for table `author_table`
--

CREATE TABLE `author_table` (
  `author_id` int(11) NOT NULL,
  `author_firstname` varchar(55) NOT NULL,
  `author_lastname` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author_table`
--

INSERT INTO `author_table` (`author_id`, `author_firstname`, `author_lastname`) VALUES
(1, '1', '1'),
(2, 'Tove', 'Jansson'),
(4, 'Carl', 'Barks');

-- --------------------------------------------------------

--
-- Table structure for table `book_table`
--

CREATE TABLE `book_table` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_price` int(11) NOT NULL,
  `book_rating` int(11) NOT NULL,
  `book_author_fk` int(11) DEFAULT NULL,
  `book_illustrator_fk` int(11) NOT NULL,
  `book_description` varchar(550) NOT NULL,
  `book_genre_fk` int(11) DEFAULT NULL,
  `book_pages` int(11) NOT NULL,
  `book_img` varchar(255) NOT NULL,
  `book_lang_fk` int(11) DEFAULT NULL,
  `book_agerec_fk` int(11) DEFAULT NULL,
  `book_publish_fk` int(11) DEFAULT NULL,
  `book_category_fk` int(11) DEFAULT NULL,
  `release_date` date NOT NULL,
  `book_status_fk` int(11) NOT NULL,
  `book_user_fk` int(11) NOT NULL,
  `book_featured_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_table`
--

INSERT INTO `book_table` (`book_id`, `book_title`, `book_price`, `book_rating`, `book_author_fk`, `book_illustrator_fk`, `book_description`, `book_genre_fk`, `book_pages`, `book_img`, `book_lang_fk`, `book_agerec_fk`, `book_publish_fk`, `book_category_fk`, `release_date`, `book_status_fk`, `book_user_fk`, `book_featured_fk`) VALUES
(68, 'Pelle svanslös svenska', 20, 3, 4, 2, 'Svenska', 1, 263, 'Pelle_Svanslös.jpg', 1, 2, 3, 5, '2023-12-29', 1, 13, 2),
(71, 'Bamse', 900, 5, 2, 3, 'bamse', 1, 213, 'kalleanka.jpg', 2, 10, 3, 3, '2023-12-21', 1, 14, 1),
(72, 'Logged in', 99, 2, 1, 1, 'Logged in', 1, 99, 'sutterlin-1362879_640.jpg', 1, 1, 2, 4, '2023-12-27', 3, 13, 1),
(73, 'Nico', 0, 0, 4, 4, 'NIco', 1, 200, 'old-books-436498_1280.jpg', 1, 1, 3, 5, '2024-01-10', 1, 13, 1),
(77, 'bamse', 20, 5, 4, 4, 'Bamse är stark', 1, 20, 'bamse.jpg', 3, 12, 3, 6, '2024-01-18', 1, 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_status_table`
--

CREATE TABLE `category_status_table` (
  `category_status_id` int(11) NOT NULL,
  `category_status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_status_table`
--

INSERT INTO `category_status_table` (`category_status_id`, `category_status_name`) VALUES
(1, 'Bli kvar'),
(2, 'Borttagen');

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(55) NOT NULL,
  `category_img` varchar(255) NOT NULL,
  `category_book_fk` int(11) DEFAULT NULL,
  `category_status_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`category_id`, `category_name`, `category_img`, `category_book_fk`, `category_status_fk`) VALUES
(3, 'Classic fiction', '', NULL, 1),
(4, 'Graphic novel', '', NULL, 1),
(5, 'tecknat', '', NULL, 1),
(6, 'Thriller', 'open-book-mock-up-with-roses-skull.jpg', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `featured_table`
--

CREATE TABLE `featured_table` (
  `featured_id` int(11) NOT NULL,
  `featured_book` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `featured_table`
--

INSERT INTO `featured_table` (`featured_id`, `featured_book`) VALUES
(1, 'Utvald'),
(2, 'Inte utvald');

-- --------------------------------------------------------

--
-- Table structure for table `genre_table`
--

CREATE TABLE `genre_table` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(55) NOT NULL,
  `genre_book_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre_table`
--

INSERT INTO `genre_table` (`genre_id`, `genre_name`, `genre_book_fk`) VALUES
(1, 'Komedi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `illustrator_table`
--

CREATE TABLE `illustrator_table` (
  `illustrator_id` int(11) NOT NULL,
  `illustrator_firstname` varchar(55) NOT NULL,
  `illustrator_lastname` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `illustrator_table`
--

INSERT INTO `illustrator_table` (`illustrator_id`, `illustrator_firstname`, `illustrator_lastname`) VALUES
(1, 'Illustrator 1', 'Illustrator 1'),
(2, 'Illustrator 2', 'Illustrator 2'),
(3, 'dsa', 'dsa'),
(4, 'Matheus', 'Kald');

-- --------------------------------------------------------

--
-- Table structure for table `lang_table`
--

CREATE TABLE `lang_table` (
  `lang_id` int(11) NOT NULL,
  `lang_language` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lang_table`
--

INSERT INTO `lang_table` (`lang_id`, `lang_language`) VALUES
(1, 'Svenska'),
(2, 'Finska'),
(3, 'Engelska');

-- --------------------------------------------------------

--
-- Table structure for table `publish_table`
--

CREATE TABLE `publish_table` (
  `publish_id` int(11) NOT NULL,
  `publish_name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publish_table`
--

INSERT INTO `publish_table` (`publish_id`, `publish_name`) VALUES
(1, 'HarperCollins'),
(2, 'penguin random house'),
(3, 'Bamse förlag');

-- --------------------------------------------------------

--
-- Table structure for table `role_table`
--

CREATE TABLE `role_table` (
  `r_ID` int(11) NOT NULL,
  `r_name` varchar(255) NOT NULL,
  `r_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_table`
--

INSERT INTO `role_table` (`r_ID`, `r_name`, `r_level`) VALUES
(1, 'Admin', 5),
(2, 'Super Admin', 50);

-- --------------------------------------------------------

--
-- Table structure for table `status_table`
--

CREATE TABLE `status_table` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_table`
--

INSERT INTO `status_table` (`status_id`, `status_name`) VALUES
(1, 'Till salu'),
(2, 'Utsold'),
(3, 'Borttagen');

-- --------------------------------------------------------

--
-- Table structure for table `user_status_table`
--

CREATE TABLE `user_status_table` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_status_table`
--

INSERT INTO `user_status_table` (`s_id`, `s_name`) VALUES
(1, 'Active'),
(2, 'Disabled');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `u_ID` int(11) NOT NULL,
  `u_username` varchar(255) NOT NULL,
  `u_firstname` varchar(255) NOT NULL,
  `u_lastname` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_password` varchar(256) NOT NULL,
  `u_status` int(11) DEFAULT NULL,
  `u_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`u_ID`, `u_username`, `u_firstname`, `u_lastname`, `u_email`, `u_password`, `u_status`, `u_role`) VALUES
(8, 'lp', 'lp', 'lp', 'lp', 'lp', NULL, 0),
(9, '123', '123', '123', 'm.stenkald@gmail.com', 'Matheus123', NULL, 0),
(10, 'matheus', 'matheus', 'Matheus', 'matheus@gmail.com', 'Matheus123', 1, 2),
(11, 'Jonas', 'Jonas', 'Jonas', 'Jonas@gmail.com', 'Jonas123', 1, 2),
(12, 'Matheus', 'Matheus', 'kald', 'matheus.sten.kald@gmaill.com', '$2y$10$M8.I.H7W7XqUejBTqhPBHu5F/vjpCqYCIqaEhhUiJhrmNh4MwfuTO', 1, 1),
(13, 'Richard', 'Richard Fristname', 'Richard Lastname', 'Richard@Richard.Richard', '$2y$10$slqKmR3WZ53Xih37AauFCu5CXpYnhFSusmNoEQwBogPYx7N9i/nl.', 1, 2),
(14, 'Matheuss123', 'Matheuss1234', 'Matheuss123', 'Matheuss123@Matheuss123.Matheuss123', '$2y$10$sWqSRJdcpRokygUucHW.yenLkB7LqD02Ukvc8ZuU2CqBwGGifMK9u', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agerec_table`
--
ALTER TABLE `agerec_table`
  ADD PRIMARY KEY (`agerec_id`);

--
-- Indexes for table `author_table`
--
ALTER TABLE `author_table`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `book_table`
--
ALTER TABLE `book_table`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `agerec_fk` (`book_agerec_fk`),
  ADD KEY `genre_fk` (`book_genre_fk`),
  ADD KEY `publish_fk` (`book_publish_fk`),
  ADD KEY `lang_fk` (`book_lang_fk`),
  ADD KEY `status_fk` (`book_status_fk`),
  ADD KEY `book_table_fk` (`book_author_fk`),
  ADD KEY `illustrator_fk` (`book_illustrator_fk`),
  ADD KEY `book_user_fk` (`book_user_fk`),
  ADD KEY `featured_fk` (`book_featured_fk`),
  ADD KEY `category_fk` (`book_category_fk`);

--
-- Indexes for table `category_status_table`
--
ALTER TABLE `category_status_table`
  ADD PRIMARY KEY (`category_status_id`);

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `category_status_fk` (`category_status_fk`);

--
-- Indexes for table `featured_table`
--
ALTER TABLE `featured_table`
  ADD PRIMARY KEY (`featured_id`);

--
-- Indexes for table `genre_table`
--
ALTER TABLE `genre_table`
  ADD PRIMARY KEY (`genre_id`),
  ADD KEY `book_fk` (`genre_book_fk`);

--
-- Indexes for table `illustrator_table`
--
ALTER TABLE `illustrator_table`
  ADD PRIMARY KEY (`illustrator_id`);

--
-- Indexes for table `lang_table`
--
ALTER TABLE `lang_table`
  ADD PRIMARY KEY (`lang_id`);

--
-- Indexes for table `publish_table`
--
ALTER TABLE `publish_table`
  ADD PRIMARY KEY (`publish_id`);

--
-- Indexes for table `role_table`
--
ALTER TABLE `role_table`
  ADD PRIMARY KEY (`r_ID`);

--
-- Indexes for table `status_table`
--
ALTER TABLE `status_table`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `user_status_table`
--
ALTER TABLE `user_status_table`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`u_ID`),
  ADD UNIQUE KEY `u_ID_2` (`u_ID`),
  ADD KEY `u_ID` (`u_ID`),
  ADD KEY `u_ID_3` (`u_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agerec_table`
--
ALTER TABLE `agerec_table`
  MODIFY `agerec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `author_table`
--
ALTER TABLE `author_table`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `book_table`
--
ALTER TABLE `book_table`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `category_status_table`
--
ALTER TABLE `category_status_table`
  MODIFY `category_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `featured_table`
--
ALTER TABLE `featured_table`
  MODIFY `featured_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `genre_table`
--
ALTER TABLE `genre_table`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `illustrator_table`
--
ALTER TABLE `illustrator_table`
  MODIFY `illustrator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lang_table`
--
ALTER TABLE `lang_table`
  MODIFY `lang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `publish_table`
--
ALTER TABLE `publish_table`
  MODIFY `publish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_table`
--
ALTER TABLE `status_table`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_status_table`
--
ALTER TABLE `user_status_table`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `u_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_table`
--
ALTER TABLE `book_table`
  ADD CONSTRAINT `agerec_fk` FOREIGN KEY (`book_agerec_fk`) REFERENCES `agerec_table` (`agerec_id`),
  ADD CONSTRAINT `book_table_fk` FOREIGN KEY (`book_author_fk`) REFERENCES `author_table` (`author_id`),
  ADD CONSTRAINT `book_user_fk` FOREIGN KEY (`book_user_fk`) REFERENCES `user_table` (`u_ID`),
  ADD CONSTRAINT `category_fk` FOREIGN KEY (`book_category_fk`) REFERENCES `category_table` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `genre_fk` FOREIGN KEY (`book_genre_fk`) REFERENCES `genre_table` (`genre_id`),
  ADD CONSTRAINT `illustrator_fk` FOREIGN KEY (`book_illustrator_fk`) REFERENCES `illustrator_table` (`illustrator_id`),
  ADD CONSTRAINT `lang_fk` FOREIGN KEY (`book_lang_fk`) REFERENCES `lang_table` (`lang_id`),
  ADD CONSTRAINT `publish_fk` FOREIGN KEY (`book_publish_fk`) REFERENCES `publish_table` (`publish_id`),
  ADD CONSTRAINT `status_fk` FOREIGN KEY (`book_status_fk`) REFERENCES `status_table` (`status_id`);

--
-- Constraints for table `category_table`
--
ALTER TABLE `category_table`
  ADD CONSTRAINT `category_status_fk` FOREIGN KEY (`category_status_fk`) REFERENCES `category_status_table` (`category_status_id`);

--
-- Constraints for table `genre_table`
--
ALTER TABLE `genre_table`
  ADD CONSTRAINT `book_fk` FOREIGN KEY (`genre_book_fk`) REFERENCES `book_table` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
