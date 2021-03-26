CREATE TABLE IF NOT EXISTS `adminn` (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(250) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO `adminn` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'adminneha', '$2y$10$4ZELFBxoWSa3HRZdn3ghEejqrq.pUhKmo0KOPP6Q75orVSc3PrnlW', '2021-03-06 12:50:20');
INSERT INTO `adminn` (`id`, `username`, `password`, `created_at`) VALUES
(2, 'adminpriyanshu', '$2y$10$X.XSH8SPkc2fW2EViE3zFOuiBMn86pjGrdEtIioEh7b9NtCI0nVXO', '2021-03-06 12:52:19');



CREATE TABLE IF NOT EXISTS `users` (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(250) NOT NULL UNIQUE,
  email VARCHAR(250) NOT NULL,
  phonenum VARCHAR(250) NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO `users` (`id`, `username`,`email`,`phonenum`, `password`, `created_at`) VALUES
(1, 'B519029', 'b519029@iiit-bh.ac.in', '+91 9891665791','$2y$10$SEGheZ2fbYjdjULT9N75xeV5VwLIHi5FXezOxeIMjA9Vo9Fo9lkQm', '2021-03-03 17:56:41');



CREATE TABLE IF NOT EXISTS `books` (
    bookid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(250) NOT NULL,
    author VARCHAR(250) NOT NULL,
    edition VARCHAR(250) NOT NULL,
    status VARCHAR(250) NOT NULL,
    image text NOT NULL,
    price INT(250) NOT NULL,
    quantity INT(250) NOT NULL
);

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




CREATE TABLE IF NOT EXISTS `customers` (
  customerid INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(60) NOT NULL,
  address VARCHAR(80) NOT NULL,
  city VARCHAR(30) NOT NULL,
  state VARCHAR(60) NOT NULL,
  zip_code VARCHAR(10) NOT NULL
);

INSERT INTO `customers` (`customerid`, `name`, `address`, `city`,`state`,`zip_code`) VALUES (1, 'Neha Jha', 'E-273, Delta-1', 'Greater Noida', 'Uttar Pradesh', '201310');
INSERT INTO `customers` (`customerid`, `name`, `address`, `city`,`state`,`zip_code`) VALUES(2, 'Nirali Sahoo', 'D-6/88 Kendriya Vihar', 'Bhubaneswar', 'Odisha', '752054');




CREATE TABLE IF NOT EXISTS `orders` (
  `orderid` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `customerid` INT NOT NULL,
  `amount` decimal(6,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ship_name` VARCHAR(60) NOT NULL,
  `ship_address` VARCHAR(80) NOT NULL,
  `ship_city` VARCHAR(30) NOT NULL,
  `ship_state` VARCHAR(20) NOT NULL,
  `ship_zip_code` VARCHAR(10) NOT NULL
);

INSERT INTO `orders` (`orderid`, `customerid`, `amount`, `date`, `ship_name`, `ship_address`, `ship_city`, `ship_state`, `ship_zip_code`) VALUES (1, 1, '800.00', '2021-03-16 12:30:12', 'Neha Jha', 'E-273, Delta-1', 'Greater Noida', 'Uttar Pradesh', '201310');
INSERT INTO `orders` (`orderid`, `customerid`, `amount`, `date`, `ship_name`, `ship_address`, `ship_city`, `ship_state`, `ship_zip_code`) VALUES (2, 2, '650.00', '2021-03-20 20:34:21', 'Nirali Sahoo', 'D-6/88 Kendriya Vihar', 'Bhubaneswar', 'Odisha', '752054');



CREATE TABLE IF NOT EXISTS `order_items` (
  `orderid` INT NOT NULL,
  `book_isbn` VARCHAR(20) NOT NULL,
  `item_price` decimal(6,2) NOT NULL,
  `quantity` INT NOT NULL
);

INSERT INTO `order_items` (`orderid`, `book_isbn`, `item_price`, `quantity`) VALUES (1, '14', '800.00', 1);
INSERT INTO `order_items` (`orderid`, `book_isbn`, `item_price`, `quantity`) VALUES (2, '12', '650.00', 1);