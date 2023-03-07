-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2023 at 10:13 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurants`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `charge_month` (IN `_month` VARCHAR(50) CHARSET utf8, IN `_year` VARCHAR(50) CHARSET utf8, IN `_description` TEXT CHARSET utf8, IN `_user` INT, IN `_account_id` INT)   BEGIN
     if(SELECT  getBalance(_account_id) < get_salary())THEN
     SELECT 'Deny' as message;
   ELSE
INSERT IGNORE INTO `charge`(`Employee`, `Category`, `Amount`, `Account_id`, `Month`, `Year`, `Description`, `User_id`, `Date`) 
     SELECT e.emp_id,c.id,c.salary,_account_id,_month,_year,_description,_user,CURRENT_DATE from employee e JOIN category  c on e.emp_type_id=c.id;
      if(row_count() > 0)THEN
     SELECT 'Registered' as message;
     ELSE
     SELECT 'horay ayaa loo dalacay lacagta bishaan' as message;
     END IF;
     END IF;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `_username` VARCHAR(55), IN `_password` VARCHAR(55))   BEGIN

if exists( select * from users where username = _username and password = md5(_password))then
if exists( select * from users where username = _username)then 

select * from users where username = _username ;
else

select 'locked 'message;

end if;

else
select 'deny 'message;
end if;
END$$

CREATE DEFINER=`` PROCEDURE `read_all_order_statement` (IN `_order_id` INT)   BEGIN

if(_order_id = '0000-00-00')THEN
SELECT  o.order_id, concat(c.frist_name, ' ', c.last_name) as customer_name, f.name as food_name, o.quantity, o.unit_price, o.date   from orders o JOIN customers c on o.customer_id=c.customer_id JOIN food f on o.food_id=f.food_id; 
else
SELECT  o.order_id, concat(c.frist_name, ' ', c.last_name) as customer_name, f.name as food_name, o.quantity, o.unit_price, o.date   from orders o JOIN customers c on o.customer_id=c.customer_id JOIN food f on o.food_id=f.food_id WHERE order_id=_order_id;
END IF;

END$$

CREATE DEFINER=`` PROCEDURE `read_all_payment_statement` (IN `_payment_id` INT)   BEGIN

if(_payment_id = '0000-00-00')THEN
SELECT p.paymant_id, concat(c.frist_name, ' ', c.last_name) as customer_name, f.name as food_name, ac.bank as bank_name,
 p.amount, p.paymant_date   from paymant p JOIN customers c on p.customer_id=c.customer_id JOIN food f on p.food_id=f.food_id JOIN account ac 
on p.account_id=ac.id;
else
SELECT p.paymant_id, concat(c.frist_name, ' ', c.last_name) as customer_name, f.name as food_name, ac.bank as bank_name,
 p.amount, p.paymant_date   from paymant p JOIN customers c on p.customer_id=c.customer_id JOIN food f on p.food_id=f.food_id JOIN account ac 
on p.account_id=ac.id WHERE paymant_id=_payment_id;
END IF;

END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getBalance` (`id` INT) RETURNS DECIMAL(9,2)  BEGIN

SET @balance= 0.00;

SET @balance =(SELECT SUM(account.Balance)FROM account WHERE account.id= id);

     
     RETURN @balance;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `get_salary` () RETURNS DECIMAL(9,2)  BEGIN

SET @salary= 0.00;

SET @salary =(SELECT SUM(category.salary)FROM category);

     
     RETURN @salary;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(15) NOT NULL,
  `account_number` int(15) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `balance` decimal(9,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `account_number`, `bank`, `balance`, `date`) VALUES
(13, 200, 'dahabshiBank', '991040.00', '2023-01-21 20:39:18'),
(21, 77, 'SalaanBank', '87.00', '2023-01-21 20:38:36'),
(22, 333, 'AmalBank', '44.00', '2023-01-10 07:10:11'),
(24, 34414, 'hormuud', '250.00', '2023-01-21 07:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `salary` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `Title`, `salary`) VALUES
(1, 'cleaner', 150),
(2, 'cashier', 250),
(3, 'keeper', 150),
(4, 'waiter', 200);

-- --------------------------------------------------------

--
-- Table structure for table `charge`
--

CREATE TABLE `charge` (
  `id` int(11) NOT NULL,
  `Employee` int(11) NOT NULL,
  `Category` int(11) NOT NULL,
  `Amount` decimal(9,2) NOT NULL,
  `Account_id` int(11) NOT NULL,
  `Month` varchar(50) NOT NULL,
  `Year` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `User_id` int(11) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `charge`
--
DELIMITER $$
CREATE TRIGGER `charge_month` AFTER INSERT ON `charge` FOR EACH ROW BEGIN
UPDATE account SET Balance=Balance-new.Amount where id=new.Account_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `frist_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `date_reg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `frist_name`, `last_name`, `phone`, `address`, `city`, `date_reg`) VALUES
(2, 'mohamed', 'ABDI', '36778i', 'hodan', 'mogadisho', '2023-01-04 06:07:48'),
(7, 'farxaan', 'ali', '3637876', '', 'mogdisho', '2023-01-04 05:38:16'),
(11, 'najka', 'laki', '896897', 'kaxda', 'mogdisho', '2023-01-04 19:21:17');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `emp_type_id` int(11) DEFAULT NULL,
  `date_reg` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `fullname`, `phone`, `emp_type_id`, `date_reg`) VALUES
(1, 'Abdirahmaan mohamed ahmed', '618846254', 2, '2023-01-21 14:47:22'),
(2, 'ali faraxaan mohamed', '617378367', 1, '2023-01-21 15:09:24'),
(3, 'saciid shaafici nuur', '628762783', 4, '2023-01-21 15:09:41'),
(4, 'samafale mohamed ahmed', '26676876387', 3, '2023-01-21 15:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `quantity_in_stock` int(11) DEFAULT NULL,
  `unit_price` decimal(4,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `name`, `quantity_in_stock`, `unit_price`, `date`) VALUES
(1, 'ice', 20, '55.00', '2023-01-04 12:52:08'),
(2, 'chicken', 20, '55.00', '2023-01-04 19:22:05'),
(3, 'fish', 20, '55.00', '2023-01-04 19:22:34'),
(5, 'kaluun', 345, '23.00', '2023-01-04 19:23:16'),
(6, 'ice', 20, '5.00', '2023-01-09 09:09:12'),
(7, 'mooos', 12, '2.00', '2023-01-10 07:38:27'),
(11, 'lll', 767, '6.00', '2023-01-20 05:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL,
  `unit_price` decimal(9,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'process',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `food_id`, `quantity`, `unit_price`, `status`, `date`) VALUES
(1, 2, 1, 7, '6.00', 'process', '2023-01-20 05:28:47'),
(2, 7, 7, 2, '30.00', 'process', '2023-01-20 15:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `paymant`
--

CREATE TABLE `paymant` (
  `paymant_id` int(15) NOT NULL,
  `customer_id` int(15) DEFAULT NULL,
  `food_id` int(11) NOT NULL,
  `account_id` int(15) DEFAULT NULL,
  `amount` decimal(9,2) DEFAULT NULL,
  `paymant_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymant`
--

INSERT INTO `paymant` (`paymant_id`, `customer_id`, `food_id`, `account_id`, `amount`, `paymant_date`) VALUES
(1, 2, 1, 13, '10.00', '2023-01-21 20:38:24'),
(2, 5, 2, 21, '10.00', '2023-01-21 20:38:36'),
(3, 7, 3, 13, '10.00', '2023-01-21 20:38:50'),
(4, 11, 7, 13, '10.00', '2023-01-21 20:39:02'),
(5, 2, 5, 13, '10.00', '2023-01-21 20:39:18');

--
-- Triggers `paymant`
--
DELIMITER $$
CREATE TRIGGER `delivery` AFTER INSERT ON `paymant` FOR EACH ROW INSERT INTO deliver
VALUES(new.paymant_id,new.customer_id,new.food_id,new.account_id,new.amount,new.paymant_date )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateamount` AFTER INSERT ON `paymant` FOR EACH ROW BEGIN 
Update account set balance = balance + NEW.amount
where id = NEW.account_id ;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `emp_id`, `password`, `image`, `type`) VALUES
(1, 'samafale', 1, '202cb962ac59075b964b07152d234b70', 'USR001.png', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charge`
--
ALTER TABLE `charge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Account_id` (`Account_id`),
  ADD KEY `Category` (`Category`),
  ADD KEY `Employee` (`Employee`),
  ADD KEY `User_id` (`User_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `emp_type_id` (`emp_type_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `paymant`
--
ALTER TABLE `paymant`
  ADD PRIMARY KEY (`paymant_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `charge`
--
ALTER TABLE `charge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paymant`
--
ALTER TABLE `paymant`
  MODIFY `paymant_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `charge`
--
ALTER TABLE `charge`
  ADD CONSTRAINT `charge_ibfk_1` FOREIGN KEY (`Account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `charge_ibfk_2` FOREIGN KEY (`Category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `charge_ibfk_3` FOREIGN KEY (`Employee`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `charge_ibfk_4` FOREIGN KEY (`User_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`);

--
-- Constraints for table `paymant`
--
ALTER TABLE `paymant`
  ADD CONSTRAINT `paymant_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
