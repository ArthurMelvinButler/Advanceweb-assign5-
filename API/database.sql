
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



CREATE TABLE `Customers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar (100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `posts` (`id`, `first_name`, `last_name`, `email`, `created_at`) VALUES
(3, 'Post ', 'This is the body for the customers table', 'customers', '2023-21-09');



ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
