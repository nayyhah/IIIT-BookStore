SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


-- Create Table (1)

CREATE TABLE `adminn` (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(250) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `users` (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(250) NOT NULL UNIQUE,
  email VARCHAR(250) NOT NULL,
  phonenum INT(250) NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `books` (
    bookid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(250) NOT NULL,
    author VARCHAR(250) NOT NULL,
    edition VARCHAR(250) NOT NULL,
    status VARCHAR(250) NOT NULL,
    image text NOT NULL,
    price INT(250) NOT NULL,
    quantity INT(250) NOT NULL
);



-- Insert In Adminn Table (2)

INSERT INTO `adminn` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'adminneha', '$2y$10$4ZELFBxoWSa3HRZdn3ghEejqrq.pUhKmo0KOPP6Q75orVSc3PrnlW', '2021-03-06 12:50:20');
INSERT INTO `adminn` (`id`, `username`, `password`, `created_at`) VALUES
(2, 'adminpriyanshu', '$2y$10$X.XSH8SPkc2fW2EViE3zFOuiBMn86pjGrdEtIioEh7b9NtCI0nVXO', '2021-03-06 12:52:19');



-- Insert In books Table (3)

INSERT INTO `books`(`bookid`, `name`, `author`, `edition`, `status`, `image`, `price`, `quantity`) VALUES (NULL, 'Oracle PL/SQL Programming', 'Steven Feuerstein & Bill Pribyl', '6th', 'Available','Images/book1.jpg', 560, 5);
INSERT INTO `books`(`bookid`, `name`, `author`, `edition`, `status`, `image`, `price`, `quantity`) VALUES (NULL, 'Oracle Database 11g PL/SQL Programming', 'Michael Mclaughlin', '1st', 'Available','Images/book2.jpg', 400, 6);
INSERT INTO `books`(`bookid`, `name`, `author`, `edition`, `status`, `image`, `price`, `quantity`) VALUES (NULL, 'Discrete Mathematics & its Applications', 'Kenneth H. Rosen', '6th', 'Available','Images/book3.jpg', 870,5);
INSERT INTO `books`(`bookid`, `name`, `author`, `edition`, `status`, `image`, `price`, `quantity`) VALUES (NULL, 'Elements of Discrete Mathematics', 'L. Liu & D. Mohapatra', '3rd', 'Available','Images/book4.jpg',920, 9);
INSERT INTO `books`(`bookid`, `name`, `author`, `edition`, `status`, `image`, `price`, `quantity`) VALUES (NULL, 'An Introduction to Database Systems', 'Bipin C. Desai', '7th', 'Available','Images/book5.jpg',1050, 7);
INSERT INTO `books`(`bookid`, `name`, `author`, `edition`, `status`, `image`, `price`, `quantity`) VALUES (NULL, 'Computer Architecture and Organization', 'William Stallings', '10th', 'Available','Images/book6.jpg', 620,6);
INSERT INTO `books`(`bookid`, `name`, `author`, `edition`, `status`, `image`, `price`, `quantity`) VALUES (NULL, 'Electrical Machinery', 'PS Bimbhra', '1st', 'Available','Images/book7.jpg',300, 11);
INSERT INTO `books`(`bookid`, `name`, `author`, `edition`, `status`, `image`, `price`, `quantity`) VALUES (NULL, 'Fundamentals of Algorithms', 'Horowitz & Sahani', '2nd', 'Available','Images/book8.jpeg',750, 4);
INSERT INTO `books`(`bookid`, `name`, `author`, `edition`, `status`, `image`, `price`, `quantity`) VALUES (NULL, 'Digital Principles and Applications', 'Donald P. Leach', '7th', 'Available','Images/book9.jpg',800, 11);
INSERT INTO `books`(`bookid`, `name`, `author`, `edition`, `status`, `image`, `price`, `quantity`) VALUES (NULL, 'Digital Fundamentals', 'T.L. Floyd & R.P. Jain', '11th', 'Available','Images/book10.jpg',550, 9);
INSERT INTO `books`(`bookid`, `name`, `author`, `edition`, `status`, `image`, `price`, `quantity`) VALUES (NULL, 'The C Programming Language', 'Brian W. Kernighan', '2nd', 'Available','Images/book11.jpg',690, 15);
INSERT INTO `books`(`bookid`, `name`, `author`, `edition`, `status`, `image`, `price`, `quantity`) VALUES (NULL, 'The C++ Programming Language', 'Bjarne Stroustrup', '4th', 'Available','Images/book12.jpg',730, 7);
INSERT INTO `books`(`bookid`, `name`, `author`, `edition`, `status`, `image`, `price`, `quantity`) VALUES (NULL, 'Foundations of Python Network Programming', 'John Goerzen', '1st', 'Available','Images/book13.jpg',1200, 5);
INSERT INTO `books`(`bookid`, `name`, `author`, `edition`, `status`, `image`, `price`, `quantity`) VALUES (NULL, 'Twisted Network Programming Essentials', 'Abe Fettig', '2nd', 'Available','Images/book14.jpg',470, 8);

