-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2024 at 12:12 PM
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
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_books`
--

CREATE TABLE `add_books` (
  `book_id` int(150) NOT NULL,
  `book_title` varchar(150) NOT NULL,
  `author` varchar(150) NOT NULL,
  `publisher` varchar(150) NOT NULL,
  `year` varchar(150) NOT NULL,
  `number_of_copies` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_books`
--

INSERT INTO `add_books` (`book_id`, `book_title`, `author`, `publisher`, `year`, `number_of_copies`) VALUES
(1, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Scribner', '1925', '100'),
(2, 'To Kill a Mockingbird', 'Harper Lee', 'J. B. Lippincott & Co.', '1960', '150'),
(3, '1984', 'George Orwell', 'Secker & Warburg', '1949', '120'),
(4, 'Pride and Prejudice', 'Jane Austen', 'T. Egerton, Whitehall', '1813', '90'),
(5, 'The Catcher in the Rye', 'J.D. Salinger', 'Little, Brown and Company', '1951', '110'),
(6, 'The Hobbit', 'J.R.R. Tolkien', 'George Allen & Unwin', '1937', '130'),
(7, 'Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', 'Bloomsbury', '1997', '200'),
(8, 'The Lord of the Rings', 'J.R.R. Tolkien', 'George Allen & Unwin', '1954', '180'),
(9, 'Jane Eyre', 'Charlotte Brontë', 'Smith, Elder & Co.', '1847', '95'),
(10, 'The Odyssey', 'Homer', 'Various', '8th century BC', '85'),
(11, 'The Divine Comedy', 'Dante Alighieri', 'Various', '1320', '105'),
(12, 'War and Peace', 'Leo Tolstoy', 'The Russian Messenger', '1869', '140'),
(13, 'Moby-Dick', 'Herman Melville', 'Harper & Brothers', '1851', '125'),
(14, 'Don Quixote', 'Miguel de Cervantes', 'Francisco de Robles', '1605', '100'),
(15, 'Alice\'s Adventures in Wonderland', 'Lewis Carroll', 'Macmillan', '1865', '95'),
(16, 'The Picture of Dorian Gray', 'Oscar Wilde', 'Ward, Lock & Co.', '1890', '110'),
(17, 'The Adventures of Huckleberry Finn', 'Mark Twain', 'Charles L. Webster And Company', '1884', '120'),
(18, 'Anna Karenina', 'Leo Tolstoy', 'The Russian Messenger', '1877', '130'),
(19, 'Crime and Punishment', 'Fyodor Dostoevsky', 'The Russian Messenger', '1866', '115'),
(20, 'One Hundred Years of Solitude', 'Gabriel García Márquez', 'Harper & Row', '1967', '150');

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(150) NOT NULL,
  `admin_password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `id` int(150) NOT NULL,
  `book_name` varchar(150) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `borrowed_date` varchar(150) NOT NULL,
  `return_date` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `action` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowed_books`
--

INSERT INTO `borrowed_books` (`id`, `book_name`, `user_name`, `borrowed_date`, `return_date`, `status`, `action`) VALUES
(1, 'The Great Gatsby', 'John Doe', '2024-01-05', '2024-01-15', 'Borrowed', 'Return'),
(2, 'To Kill a Mockingbird', 'Jane Smith', '2024-01-10', '2024-01-20', 'Borrowed', 'Return'),
(3, '1984', 'Michael Johnson', '2024-01-15', '2024-01-25', 'Borrowed', 'Return'),
(4, 'Pride and Prejudice', 'Emily Davis', '2024-01-20', '2024-01-30', 'Borrowed', 'Return'),
(5, 'The Catcher in the Rye', 'David Brown', '2024-01-25', '2024-02-04', 'Borrowed', 'Return'),
(6, 'The Hobbit', 'Sarah Wilson', '2024-01-02', '2024-01-12', 'Borrowed', 'Return'),
(7, 'Harry Potter and the Philosopher\'s Stone', 'Daniel Thompson', '2024-01-08', '2024-01-18', 'Borrowed', 'Return'),
(8, 'The Lord of the Rings', 'Jessica Martinez', '2024-01-12', '2024-01-22', 'Borrowed', 'Return'),
(9, 'Jane Eyre', 'Andrew Clark', '2024-01-18', '2024-01-28', 'Borrowed', 'Return'),
(10, 'The Odyssey', 'Olivia Garcia', '2024-01-22', '2024-02-01', 'Borrowed', 'Return'),
(53, 'To Kill a Mockingbird', 'suhamurad1919@gmail.com', '2024-03-22', '2024-04-22', 'Returned', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(150) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_type` varchar(240) DEFAULT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_password` varchar(150) NOT NULL,
  `user_address` varchar(150) NOT NULL,
  `user_contact` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `user_name`, `user_type`, `user_email`, `user_password`, `user_address`, `user_contact`) VALUES
(25, 'suhamurad1919@gmail.com', 'user', 'suhamurad1919@gmail.com', '$2y$10$h/NMaZqhVcB1iesaBA8MNeRWRosQMKKXQSaJxnDhkbBJZ.WRTH.XS', '123/36,samagimawatha,anurathapuraroad,puttalam', '9862986296'),
(26, 'asmin', 'admin', 'asmin@gmail.com', '$2y$10$GR/mBXkZhGUCQiejnD8x/u5kPgXyG/pzSfYMsFjCQxO7ExB7rvOFO', '123/36,samagimawatha,anurathapuraroad,puttalam', '769816986398');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_books`
--
ALTER TABLE `add_books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_books`
--
ALTER TABLE `add_books`
  MODIFY `book_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
