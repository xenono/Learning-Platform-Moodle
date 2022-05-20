CREATE TABLE IF NOT EXISTS `member` (
 
  `id` int(10) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `phoneNumber` int(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `dateOfBirth` DATE NOT NULL,
  `userType` varchar(10) NOT NULL,
  `mem_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `attendance` int(10) NOT NULL, 
   PRIMARY KEY (`mem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `member` VALUES
(20220001, 'Diego', 'Caseroles', 'asd', 'ads', '1234', 'asd', '2022-01-12', 'admin', 1, 20220001,-1),
(20220008, 'Kapil ', 'Dev', '1234513', 'kapil@hope.com', '1234', 'Kapils adresss', '2022-03-08', 'student', 2, 20220008,-1),
(20220009, 'Daniel', 'KFC', '1234513', 'daniel@email.com', '1234', 'Daniels address', '2022-01-31', 'student', 3, 20220009,-1),
(20220019, 'New Usre', 'New user Surname', '12312312311', 'new@email.com', '1234', 'Some address', '2022-03-02', 'student', 4, 20220019,-1);

CREATE TABLE IF NOT EXISTS `employee` (
 
  `id` int(10) NOT NULL,
  `attendance` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `employee` VALUES
(1, -1),
(2, -1),
(3, 1)
;