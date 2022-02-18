-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2022 at 11:46 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `softech`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `url_slug` varchar(255) DEFAULT NULL,
  `h1_tag` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `additional_tag` varchar(500) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `country_id`, `url_slug`, `h1_tag`, `meta_title`, `meta_desc`, `additional_tag`, `sort_order`, `status`, `date_added`, `date_modified`) VALUES
(3, 'Delhi', 99, 'delhi', 'DELHI NCR', 'DELHI NCR', 'DELHI NCR', '', 1, 'active', '2018-08-22 13:14:27', '2018-12-18 08:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `country_name` varchar(255) DEFAULT NULL,
  `country_code` varchar(4) NOT NULL,
  `url_slug` varchar(255) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'active',
  `date_added` datetime NOT NULL DEFAULT '2018-09-01 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `country_code`, `url_slug`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Afghanistan', 'AF', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(2, 'Albania', 'AL', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(3, 'Algeria', 'DZ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(4, 'American Samoa', 'DS', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(5, 'Andorra', 'AD', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(6, 'Angola', 'AO', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(7, 'Anguilla', 'AI', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(8, 'Antarctica', 'AQ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(9, 'Antigua and Barbuda', 'AG', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(10, 'Argentina', 'AR', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(11, 'Armenia', 'AM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(12, 'Aruba', 'AW', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(13, 'Australia', 'AU', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(14, 'Austria', 'AT', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(15, 'Azerbaijan', 'AZ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(16, 'Bahamas', 'BS', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(17, 'Bahrain', 'BH', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(18, 'Bangladesh', 'BD', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(19, 'Barbados', 'BB', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(20, 'Belarus', 'BY', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(21, 'Belgium', 'BE', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(22, 'Belize', 'BZ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(23, 'Benin', 'BJ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(24, 'Bermuda', 'BM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(25, 'Bhutan', 'BT', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(26, 'Bolivia', 'BO', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(27, 'Bosnia and Herzegovina', 'BA', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(28, 'Botswana', 'BW', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(29, 'Bouvet Island', 'BV', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(30, 'Brazil', 'BR', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(31, 'British Indian Ocean Territory', 'IO', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(32, 'Brunei Darussalam', 'BN', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(33, 'Bulgaria', 'BG', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(34, 'Burkina Faso', 'BF', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(35, 'Burundi', 'BI', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(36, 'Cambodia', 'KH', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(37, 'Cameroon', 'CM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(38, 'Canada', 'CA', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(39, 'Cape Verde', 'CV', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(40, 'Cayman Islands', 'KY', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(41, 'Central African Republic', 'CF', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(42, 'Chad', 'TD', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(43, 'Chile', 'CL', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(44, 'China', 'CN', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(45, 'Christmas Island', 'CX', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(46, 'Cocos (Keeling) Islands', 'CC', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(47, 'Colombia', 'CO', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(48, 'Comoros', 'KM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(49, 'Congo', 'CG', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(50, 'Cook Islands', 'CK', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(51, 'Costa Rica', 'CR', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(52, 'Croatia (Hrvatska)', 'HR', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(53, 'Cuba', 'CU', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(54, 'Cyprus', 'CY', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(55, 'Czech Republic', 'CZ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(56, 'Denmark', 'DK', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(57, 'Djibouti', 'DJ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(58, 'Dominica', 'DM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(59, 'Dominican Republic', 'DO', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(60, 'East Timor', 'TP', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(61, 'Ecuador', 'EC', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(62, 'Egypt', 'EG', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(63, 'El Salvador', 'SV', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(64, 'Equatorial Guinea', 'GQ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(65, 'Eritrea', 'ER', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(66, 'Estonia', 'EE', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(67, 'Ethiopia', 'ET', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(68, 'Falkland Islands (Malvinas)', 'FK', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(69, 'Faroe Islands', 'FO', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(70, 'Fiji', 'FJ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(71, 'Finland', 'FI', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(72, 'France', 'FR', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(73, 'France, Metropolitan', 'FX', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(74, 'French Guiana', 'GF', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(75, 'French Polynesia', 'PF', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(76, 'French Southern Territories', 'TF', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(77, 'Gabon', 'GA', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(78, 'Gambia', 'GM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(79, 'Georgia', 'GE', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(80, 'Germany', 'DE', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(81, 'Ghana', 'GH', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(82, 'Gibraltar', 'GI', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(83, 'Guernsey', 'GK', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(84, 'Greece', 'GR', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(85, 'Greenland', 'GL', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(86, 'Grenada', 'GD', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(87, 'Guadeloupe', 'GP', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(88, 'Guam', 'GU', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(89, 'Guatemala', 'GT', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(90, 'Guinea', 'GN', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(91, 'Guinea-Bissau', 'GW', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(92, 'Guyana', 'GY', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(93, 'Haiti', 'HT', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(94, 'Heard and Mc Donald Islands', 'HM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(95, 'Honduras', 'HN', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(96, 'Hong Kong', 'HK', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(97, 'Hungary', 'HU', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(98, 'Iceland', 'IS', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(99, 'India', 'IN', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(100, 'Isle of Man', 'IM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(101, 'Indonesia', 'ID', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(102, 'Iran (Islamic Republic of)', 'IR', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(103, 'Iraq', 'IQ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(104, 'Ireland', 'IE', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(105, 'Israel', 'IL', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(106, 'Italy', 'IT', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(107, 'Ivory Coast', 'CI', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(108, 'Jersey', 'JE', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(109, 'Jamaica', 'JM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(110, 'Japan', 'JP', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(111, 'Jordan', 'JO', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(112, 'Kazakhstan', 'KZ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(113, 'Kenya', 'KE', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(114, 'Kiribati', 'KI', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(115, 'Korea, Democratic People\'s Republic of', 'KP', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(116, 'Korea, Republic of', 'KR', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(117, 'Kosovo', 'XK', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(118, 'Kuwait', 'KW', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(119, 'Kyrgyzstan', 'KG', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(120, 'Lao People\'s Democratic Republic', 'LA', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(121, 'Latvia', 'LV', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(122, 'Lebanon', 'LB', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(123, 'Lesotho', 'LS', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(124, 'Liberia', 'LR', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(125, 'Libyan Arab Jamahiriya', 'LY', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(126, 'Liechtenstein', 'LI', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(127, 'Lithuania', 'LT', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(128, 'Luxembourg', 'LU', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(129, 'Macau', 'MO', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(130, 'Macedonia', 'MK', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(131, 'Madagascar', 'MG', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(132, 'Malawi', 'MW', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(133, 'Malaysia', 'MY', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(134, 'Maldives', 'MV', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(135, 'Mali', 'ML', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(136, 'Malta', 'MT', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(137, 'Marshall Islands', 'MH', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(138, 'Martinique', 'MQ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(139, 'Mauritania', 'MR', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(140, 'Mauritius', 'MU', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(141, 'Mayotte', 'TY', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(142, 'Mexico', 'MX', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(143, 'Micronesia, Federated States of', 'FM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(144, 'Moldova, Republic of', 'MD', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(145, 'Monaco', 'MC', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(146, 'Mongolia', 'MN', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(147, 'Montenegro', 'ME', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(148, 'Montserrat', 'MS', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(149, 'Morocco', 'MA', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(150, 'Mozambique', 'MZ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(151, 'Myanmar', 'MM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(152, 'Namibia', 'NA', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(153, 'Nauru', 'NR', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(154, 'Nepal', 'NP', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(155, 'Netherlands', 'NL', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(156, 'Netherlands Antilles', 'AN', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(157, 'New Caledonia', 'NC', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(158, 'New Zealand', 'NZ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(159, 'Nicaragua', 'NI', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(160, 'Niger', 'NE', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(161, 'Nigeria', 'NG', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(162, 'Niue', 'NU', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(163, 'Norfolk Island', 'NF', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(164, 'Northern Mariana Islands', 'MP', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(165, 'Norway', 'NO', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(166, 'Oman', 'OM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(167, 'Pakistan', 'PK', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(168, 'Palau', 'PW', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(169, 'Palestine', 'PS', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(170, 'Panama', 'PA', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(171, 'Papua New Guinea', 'PG', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(172, 'Paraguay', 'PY', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(173, 'Peru', 'PE', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(174, 'Philippines', 'PH', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(175, 'Pitcairn', 'PN', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(176, 'Poland', 'PL', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(177, 'Portugal', 'PT', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(178, 'Puerto Rico', 'PR', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(179, 'Qatar', 'QA', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(180, 'Reunion', 'RE', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(181, 'Romania', 'RO', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(182, 'Russian Federation', 'RU', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(183, 'Rwanda', 'RW', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(184, 'Saint Kitts and Nevis', 'KN', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(185, 'Saint Lucia', 'LC', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(186, 'Saint Vincent and the Grenadines', 'VC', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(187, 'Samoa', 'WS', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(188, 'San Marino', 'SM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(189, 'Sao Tome and Principe', 'ST', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(190, 'Saudi Arabia', 'SA', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(191, 'Senegal', 'SN', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(192, 'Serbia', 'RS', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(193, 'Seychelles', 'SC', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(194, 'Sierra Leone', 'SL', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(195, 'Singapore', 'SG', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(196, 'Slovakia', 'SK', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(197, 'Slovenia', 'SI', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(198, 'Solomon Islands', 'SB', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(199, 'Somalia', 'SO', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(200, 'South Africa', 'ZA', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(201, 'South Georgia South Sandwich Islands', 'GS', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(202, 'South Sudan', 'SS', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(203, 'Spain', 'ES', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(204, 'Sri Lanka', 'LK', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(205, 'St. Helena', 'SH', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(206, 'St. Pierre and Miquelon', 'PM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(207, 'Sudan', 'SD', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(208, 'Suriname', 'SR', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(209, 'Svalbard and Jan Mayen Islands', 'SJ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(210, 'Swaziland', 'SZ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(211, 'Sweden', 'SE', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(212, 'Switzerland', 'CH', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(213, 'Syrian Arab Republic', 'SY', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(214, 'Taiwan', 'TW', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(215, 'Tajikistan', 'TJ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(216, 'Tanzania, United Republic of', 'TZ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(217, 'Thailand', 'TH', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(218, 'Togo', 'TG', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(219, 'Tokelau', 'TK', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(220, 'Tonga', 'TO', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(221, 'Trinidad and Tobago', 'TT', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(222, 'Tunisia', 'TN', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(223, 'Turkey', 'TR', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(224, 'Turkmenistan', 'TM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(225, 'Turks and Caicos Islands', 'TC', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(226, 'Tuvalu', 'TV', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(227, 'Uganda', 'UG', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(228, 'Ukraine', 'UA', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(229, 'United Arab Emirates', 'AE', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(230, 'United Kingdom', 'GB', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(231, 'United States', 'US', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(232, 'United States minor outlying islands', 'UM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(233, 'Uruguay', 'UY', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(234, 'Uzbekistan', 'UZ', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(235, 'Vanuatu', 'VU', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(236, 'Vatican City State', 'VA', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(237, 'Venezuela', 'VE', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(238, 'Vietnam', 'VN', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(239, 'Virgin Islands (British)', 'VG', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(240, 'Virgin Islands (U.S.)', 'VI', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(241, 'Wallis and Futuna Islands', 'WF', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(242, 'Western Sahara', 'EH', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(243, 'Yemen', 'YE', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(244, 'Zaire', 'ZR', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(245, 'Zambia', 'ZM', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34'),
(246, 'Zimbabwe', 'ZW', NULL, 'active', '2018-09-01 00:00:00', '2018-09-01 17:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `default_page` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `default_page`) VALUES
(1, 'admin', 'Administrators', 'dashboard'),
(2, 'members', 'General User', 'home'),
(3, 'HR Department', 'HR Department', 'career');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(4, '::1', 'admin@admin.com', 1645088771);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `module_code` varchar(255) DEFAULT NULL,
  `mod_create` varchar(255) DEFAULT NULL,
  `mod_edit` varchar(255) DEFAULT NULL,
  `mod_delete` varchar(255) DEFAULT NULL,
  `mod_view` varchar(255) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `parent` tinyint(4) DEFAULT NULL,
  `orderno` smallint(6) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `module_code`, `mod_create`, `mod_edit`, `mod_delete`, `mod_view`, `status`, `parent`, `orderno`, `date_added`, `date_modified`) VALUES
(6, 'Dashboard', 'dashboard', NULL, NULL, NULL, 'index', 'active', 0, 1, '2019-06-22 13:54:46', '2019-06-22 13:54:46'),
(7, 'Banner', 'banner', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 0, 2, '2019-06-22 14:03:15', '2019-06-22 14:03:15'),
(8, 'Departments', 'category', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 0, 3, '2019-06-22 14:12:25', '2019-06-22 14:12:25'),
(9, 'Management Team', 'team', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 0, 4, '2019-06-24 06:35:10', '2019-06-24 06:35:10'),
(10, 'Doctors Team', 'doctors', 'create', 'edit,update,status', 'delete', 'index,page,search,doctorsByCountry', 'active', 0, 5, '2019-06-24 06:35:10', '2019-06-24 06:35:10'),
(11, 'Hospitals', 'hospitals', 'create,add', 'edit,update,status', 'delete', 'index,page,search,hospitalsByLocation', 'active', 0, 6, '2019-06-24 06:35:10', '2019-06-24 06:35:10'),
(12, 'Manage Departments', NULL, NULL, NULL, NULL, NULL, 'active', 0, 7, '2019-06-24 06:58:43', '2019-06-24 06:58:43'),
(13, 'Department Category', 'servicecategory', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 12, 1, '2019-06-24 07:40:43', '2019-06-24 07:40:43'),
(14, 'Services', 'services', 'create,add', 'edit,update,search', 'delete', 'index,page,search,servicesByLocation', 'active', 12, 2, '2019-06-24 07:41:42', '2019-06-24 07:41:42'),
(15, 'CMS Pages', 'pages', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 12, 8, '2019-06-24 07:42:57', '2019-06-24 07:42:57'),
(16, 'News', 'news', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 0, 9, '2019-06-24 07:47:57', '2019-06-24 07:47:57'),
(17, 'Blogs', NULL, NULL, NULL, NULL, NULL, 'active', 0, 10, '2019-06-24 07:48:28', '2019-06-24 07:48:28'),
(18, 'Blog Category', 'blogcategory', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 17, 1, '2019-06-24 07:49:19', '2019-06-24 07:49:19'),
(19, 'Blogs', 'blog', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 17, 2, '2019-06-24 07:49:54', '2019-06-24 07:49:54'),
(20, 'Other Modules', NULL, NULL, NULL, NULL, NULL, 'active', 0, 11, '2019-06-24 08:02:07', '2019-06-24 08:02:07'),
(21, 'Awards', 'awards', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 20, 1, '2019-06-24 08:02:49', '2019-06-24 08:02:49'),
(22, 'Testimonial', 'testimonial', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 20, 2, '2019-06-24 08:03:32', '2019-06-24 08:03:32'),
(23, 'FAQ', 'faq', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 20, 3, '2019-06-24 08:04:12', '2019-06-24 08:04:12'),
(24, 'Masters', NULL, NULL, NULL, NULL, NULL, 'active', 0, 12, '2019-06-24 08:05:10', '2019-06-24 08:05:10'),
(25, 'Locations', 'locations', 'create', 'edit,status', 'delete', 'index,page,search,locationsByCountry', 'active', 24, 1, '2019-06-24 08:05:41', '2019-06-24 08:05:41'),
(26, 'City', 'city', 'create,addsub', 'edit,status', 'delete', 'index,page,search,cityByCountry', 'active', 24, 2, '2019-06-24 08:06:32', '2019-06-24 08:06:32'),
(27, 'Country', 'country', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 24, 3, '2019-06-24 08:07:39', '2019-06-24 08:07:39'),
(28, 'Nationality', 'nationality', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 24, 4, '2019-06-24 08:08:11', '2019-06-24 08:08:11'),
(29, 'Pages Meta Tag', 'pagesmeta', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 0, 13, '2019-06-24 08:16:49', '2019-06-24 08:16:49'),
(30, 'Groups & Users', NULL, NULL, NULL, NULL, NULL, 'active', 0, 16, '2019-07-25 09:22:55', '2019-07-25 09:22:55'),
(31, 'Modules', 'modules', 'create', 'edit,status', 'delete', 'index,page,search,listMethods', 'active', 30, 1, '2019-07-25 09:24:49', '2019-07-25 09:24:49'),
(32, 'Groups', 'groups', 'create', 'edit', 'delete', 'index,checkGroupPermission', 'active', 30, 2, '2019-07-25 09:26:00', '2019-07-25 09:26:00'),
(33, 'Users', 'users', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 30, 3, '2019-07-25 09:26:59', '2019-07-25 09:26:59'),
(34, 'Author', 'author', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 17, 3, '2019-07-25 09:28:26', '2019-07-25 09:28:26'),
(35, 'Careers', 'career', 'create', 'edit,status', 'delete', 'index,page,search,applicantslist,pages', 'active', 0, 14, '2019-07-25 09:30:37', '2019-07-25 09:30:37'),
(36, 'Enquiries', 'enquiries', 'reply,replyenquiry', NULL, 'delete', 'index,page,search,enqdetails', 'active', 0, 15, '2019-07-25 09:40:00', '2019-07-25 09:40:00'),
(37, 'Speciality', 'speciality', 'create', 'edit,status', 'delete', 'index,page,search', 'active', 24, 5, '2019-07-25 09:42:19', '2019-07-25 09:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `nationality`
--

CREATE TABLE `nationality` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url_slug` varchar(255) DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nationality`
--

INSERT INTO `nationality` (`id`, `name`, `url_slug`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Thai', 'thai', 'active', '2018-04-21 12:56:10', '2018-04-21 13:23:17'),
(2, 'Indian', 'indian', 'active', '2018-08-22 13:12:55', '2018-08-22 13:12:55'),
(3, 'American', 'american', 'active', '2018-08-22 13:13:42', '2018-08-22 13:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `modulename` varchar(255) NOT NULL,
  `pr_create` tinyint(4) NOT NULL,
  `pr_edit` tinyint(4) NOT NULL,
  `pr_delete` tinyint(4) NOT NULL,
  `pr_view` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `group_id`, `module_id`, `modulename`, `pr_create`, `pr_edit`, `pr_delete`, `pr_view`, `date_added`, `date_modified`) VALUES
(1, 1, 37, 'speciality', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(2, 1, 36, 'enquiries', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(3, 1, 35, 'career', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(4, 1, 34, 'author', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(5, 1, 33, 'users', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(6, 1, 32, 'groups', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(7, 1, 31, 'modules', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(8, 1, 30, '', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(9, 1, 29, 'pagesmeta', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(10, 1, 28, 'nationality', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(11, 1, 27, 'country', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(12, 1, 26, 'city', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(13, 1, 25, 'locations', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(14, 1, 24, '', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(15, 1, 23, 'faq', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(16, 1, 22, 'testimonial', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(17, 1, 21, 'awards', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(18, 1, 20, '', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(19, 1, 19, 'blog', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(20, 1, 18, 'blogcategory', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(21, 1, 17, '', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(22, 1, 16, 'news', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(23, 1, 15, 'pages', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(24, 1, 14, 'services', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(25, 1, 13, 'servicecategory', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(26, 1, 12, '', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(27, 1, 11, 'hospitals', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(28, 1, 10, 'doctors', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(29, 1, 9, 'team', 1, 1, 1, 1, '2019-07-26 08:00:23', '2019-07-26 08:00:23'),
(30, 1, 8, 'category', 1, 1, 1, 1, '2019-07-26 08:00:24', '2019-07-26 08:00:24'),
(31, 1, 7, 'banner', 1, 1, 1, 1, '2019-07-26 08:00:24', '2019-07-26 08:00:24'),
(32, 1, 6, 'dashboard', 1, 1, 1, 1, '2019-07-26 08:00:24', '2019-07-26 08:00:24'),
(33, 3, 37, 'speciality', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(34, 3, 36, 'enquiries', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(35, 3, 35, 'career', 1, 1, 1, 1, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(36, 3, 34, 'author', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(37, 3, 33, 'users', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(38, 3, 32, 'groups', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(39, 3, 31, 'modules', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(40, 3, 30, '', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(41, 3, 29, 'pagesmeta', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(42, 3, 28, 'nationality', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(43, 3, 27, 'country', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(44, 3, 26, 'city', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(45, 3, 25, 'locations', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(46, 3, 24, '', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(47, 3, 23, 'faq', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(48, 3, 22, 'testimonial', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(49, 3, 21, 'awards', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(50, 3, 20, '', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(51, 3, 19, 'blog', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(52, 3, 18, 'blogcategory', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(53, 3, 17, '', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(54, 3, 16, 'news', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(55, 3, 15, 'pages', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(56, 3, 14, 'services', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(57, 3, 13, 'servicecategory', 0, 0, 0, 0, '2019-07-26 14:00:51', '2019-07-26 14:00:51'),
(58, 3, 12, '', 0, 0, 0, 0, '2019-07-26 14:00:52', '2019-07-26 14:00:52'),
(59, 3, 11, 'hospitals', 0, 0, 0, 0, '2019-07-26 14:00:52', '2019-07-26 14:00:52'),
(60, 3, 10, 'doctors', 0, 0, 0, 0, '2019-07-26 14:00:52', '2019-07-26 14:00:52'),
(61, 3, 9, 'team', 0, 0, 0, 0, '2019-07-26 14:00:52', '2019-07-26 14:00:52'),
(62, 3, 8, 'category', 0, 0, 0, 0, '2019-07-26 14:00:52', '2019-07-26 14:00:52'),
(63, 3, 7, 'banner', 0, 0, 0, 0, '2019-07-26 14:00:52', '2019-07-26 14:00:52'),
(64, 3, 6, 'dashboard', 0, 0, 0, 0, '2019-07-26 14:00:52', '2019-07-26 14:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE `tbl_address` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `addressline1` varchar(100) NOT NULL,
  `addressline2` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(11) NOT NULL,
  `zipcode` varchar(12) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `adr_name` text DEFAULT NULL,
  `addressline1_res` varchar(255) NOT NULL,
  `addressline2_res` varchar(255) NOT NULL,
  `city_res` varchar(100) NOT NULL,
  `state_res` varchar(100) NOT NULL,
  `zipcode_res` varchar(100) NOT NULL,
  `mobile_res` varchar(15) NOT NULL,
  `adr_name_res` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`id`, `uid`, `addressline1`, `addressline2`, `city`, `state`, `zipcode`, `mobile`, `adr_name`, `addressline1_res`, `addressline2_res`, `city_res`, `state_res`, `zipcode_res`, `mobile_res`, `adr_name_res`, `date_added`, `date_modified`) VALUES
(3, 28, 'H-102', 'subhash nagar colony', 'New delhi', 'Delhi', '110093', '9865963250', 'Aman Saxena', 'G-3/A, Ashok nagar, near chowks', 'Noida', 'new delhi', 'delhi', '110088', '8596325654', 'Arun Kumar sharma', '2020-11-13 08:53:47', '2020-11-13 08:53:47'),
(4, 29, 'A-67 first floor', 'Fateh Nagar', 'New Delhi', 'New Delhi', '110018', '80101748485', 'Money', 'A-67 first floor', 'Fateh Nagar', 'New Delhi', 'New Delhi', '110018', '80101748485', 'Money', '2021-01-18 08:31:48', '2021-01-18 08:31:48'),
(5, 30, 'H-350', 'Vikas Puri', 'New Delhi', 'Delhi', '110058', '9958206783', 'vikramjit singh', '1/33', 'Tilak Nagar', 'New Delhi', 'Delhi', '110018', '9891674844', 'Galorebay optix', '2021-01-22 07:05:45', '2021-01-22 07:05:45'),
(6, 31, '#2655/1 1st main Dental college', 'MCC B BLOCK', 'Davanagere', 'KARNATAKA', '577004', '9886591109', 'Nitish optical centre', '#2655/1 1st main Dental college', 'MCC B BLOCK', 'Davanagere', 'KARNATAKA', '577004', '9886591109', 'Nitish optical centre', '2021-01-29 06:13:15', '2021-01-29 06:13:15'),
(7, 32, 'U 5A Subhash park', 'Uttam nagar', 'New Delhi', 'Delhi', '110059', '7678416653', 'Tushar', '1/33', 'Tilak nagar', 'New Delhi', 'Delhi', '110018', '7678416653', 'Tushar', '2021-01-29 08:13:42', '2021-01-29 08:13:42'),
(8, 33, '#343,4th main', 'P J Extension', 'Davangere', 'Karnataka', '577002', '9986163349', 'Vishal H', '#343,4th main', 'P J Extension', 'Davangere', 'Karnataka', '577002', '9986163349', 'Vishal H', '2021-01-29 08:52:22', '2021-01-29 08:52:22'),
(9, 34, '1st main', 'MCC B BLOCK', 'Davangere', 'Karnataka', '577004', '9886088549', 'Nayana opticals', '1st main', 'MCC B BLOCK', 'Davangere', 'Karnataka', '577004', '9886088549', 'Nayana opticals', '2021-01-29 12:15:56', '2021-01-29 12:15:56'),
(10, 35, '175', '3rd, main, ok extension', 'Davangere', 'Karnataka', '577002', '9886567791', 'Landmark medical and optical', '175', '3rd, main, ok extension', 'Davangere', 'Karnataka', '577002', '9886567791', 'Landmark medical and optical', '2021-01-29 13:41:25', '2021-01-29 13:41:25'),
(11, 36, '', '', '', '', '', '', '', 'subhash nagar', 'subhash nagar', 'delhi', 'new delhi', '110025', '09865963250', 'G-321/A,', '2021-02-01 13:28:32', '2021-02-01 13:28:32'),
(12, 37, '', '', '', '', '', '', '', 'Nehru stadium road', 'Bidar', 'Bidar', 'Karnataka', '585401', '9986093139', 'Guru opticals', '2021-02-02 11:21:46', '2021-02-02 11:21:46'),
(13, 38, '', '', '', '', '', '', '', 'Khadi bhandar complex', 'Opp govt hospital', 'Bidar', 'Karnataka', '585401', '9448568546', 'Optical place', '2021-02-02 12:08:29', '2021-02-02 12:08:29'),
(14, 39, '', '', '', '', '', '', '', 'Somasundar EyeHospital.', '21,Coimbatore road.', 'Karur', 'Tsmil nadu', '639001', '9843236178', 'Dhivya optics', '2021-02-03 06:51:07', '2021-02-03 06:51:07'),
(15, 40, '', '', '', '', '', '', '', 'G.k complex', 'S.v.p.chowk', 'Kalaburagi', 'Karnataka', '585103', '8088528857', 'Sri ramdev optical', '2021-02-03 08:21:48', '2021-02-03 08:21:48'),
(16, 41, '', '', '', '', '', '', '', 'K.B.N complex', 'Main road', 'Gulbarga', 'Karnataka', '585102', '9986130407', 'Paramount optical center', '2021-02-03 11:22:08', '2021-02-03 11:22:08'),
(17, 42, '', '', '', '', '', '', '', 'Huns talkies road', 'Belgaum', 'Belgaum', 'Karnataka', '590001', '9916113744', 'Prakash opticals', '2021-02-05 10:31:55', '2021-02-05 10:31:55'),
(18, 43, '', '', '', '', '', '', '', '3141C', 'Khade Bazar', 'Belgaum', 'Karnataka', '590002', '9448583301', 'Girnar optical', '2021-02-05 13:01:36', '2021-02-05 13:01:36'),
(19, 44, '', '', '', '', '', '', '', 'Shet ballet', 'OPP Arts college, vidyanagar', 'Hubli', 'Karnataka', '580021', '9889463692', 'Eye style optics', '2021-02-06 12:05:18', '2021-02-06 12:05:18'),
(20, 45, '', '', '', '', '', '', '', 'Pittaji building', 'Station road', 'Hubballi', 'Karnataka', '580020', '7204362009', 'Shri Raj Laxmi optics', '2021-02-06 14:07:26', '2021-02-06 14:07:26'),
(21, 46, '', '', '', '', '', '', '', 'Pid no. 45/2446, Aditya annexe', 'Coen road', 'Hubli', 'Karnataka', '580020', '8050174909', 'Premium optical', '2021-02-07 07:17:39', '2021-02-07 07:17:39'),
(22, 47, '', '', '', '', '', '', '', 'Jawahar opticians  Diamond Avenue', 'Station road HUBLI', 'HUBLI', 'Karanatak', '580020', '9742499875', 'Jawahar opticians', '2021-02-07 07:31:28', '2021-02-07 07:31:28'),
(23, 48, '', '', '', '', '', '', '', '#20 satellite complex Opp Kataria Trade Center KOPPIKAR ROAD', 'Hubballi', 'Hubballi', 'Karnataka', '580020', '9916021927', 'PRABHU EYEWEAR', '2021-02-07 12:07:06', '2021-02-07 12:07:06'),
(24, 49, '', '', '', '', '', '', '', 'Shop no:9,unique point', 'Near women\'s college road, J C nagar', 'Hubli', 'Karnataka', '580020', '7019069235', 'Sanghvi Opticians', '2021-02-08 05:33:00', '2021-02-08 05:33:00'),
(25, 50, '', '', '', '', '', '', '', '2nd floor , U-mall', 'Koppikar road', 'Hubli', 'Karnataka', '580020', '9880071357', 'Ambika opticals', '2021-02-08 08:23:33', '2021-02-08 08:23:33'),
(26, 51, '', '', '', '', '', '', '', 'Tilak Nagar New Delhi-110018', 'Tilak Nagar New Delhi-110018', 'New Delhi', 'Delhi', '110018', '09891674844', '1/33 mall road', '2021-02-09 06:38:56', '2021-02-09 06:38:56'),
(27, 52, '', '', '', '', '', '', '', 'J.P.N ROAD', 'SHIVAMOGGA', 'SHIVAMOGGA', 'KARNATAKA', '577201', '9448149878', 'Shivamogga opticals', '2021-02-09 07:39:27', '2021-02-09 07:39:27'),
(28, 53, '', '', '', '', '', '', '', 'GOPI CIRCLE', 'SHIMOGA', 'SHIMOGA', 'KARNATAKA', '577201', '9844455115', 'SKANDA OPTICALS', '2021-02-09 09:32:05', '2021-02-09 09:32:05'),
(29, 54, '', '', '', '', '', '', '', 'Opp.ServiceBus Stand,Gousiya Complex', 'Surathkal Mangalore', 'Surathkal', 'Karnataka', '575014', '9880480841', 'Russel Opticals', '2021-02-10 05:30:07', '2021-02-10 05:30:07'),
(30, 55, '', '', '', '', '', '', '', 'Society building', 'Service Bus stand, Surathkal', 'Mangalore', 'Karnataka', '575014', '9845353196', 'Chaitanya I needs', '2021-02-10 06:38:21', '2021-02-10 06:38:21'),
(31, 56, '', '', '', '', '', '', '', 'Vittal netralaya', 'Kundapurada', 'Kundapurada', 'Karnataka', '576201', '9964142277', 'Sudershan optical', '2021-02-10 09:55:16', '2021-02-10 09:55:16'),
(32, 57, '', '', '', '', '', '', '', 'G L Complex', 'Main road', 'Puttur', 'Karnataka', '574202', '9632532045', 'Star optical', '2021-02-11 06:48:40', '2021-02-11 06:48:40'),
(33, 58, '', '', '', '', '', '', '', '#13-7/35,', 'Bharat commercial centre B.C. Road', 'Bantwal', 'Karnataka', '574219', '9481443469', 'Ashwin optical', '2021-02-11 08:14:55', '2021-02-11 08:14:55'),
(34, 59, '', '', '', '', '', '', '', 'Yenepoya mall,', 'Kadri road, near Syndicate Bank', 'Mangalore', 'Karnataka', '575003', '7892887713', 'I needs opticals', '2021-02-12 07:02:40', '2021-02-12 07:02:40'),
(35, 60, '', '', '', '', '', '', '', 'Maithri speciality clink', 'Next to hotel maya international', 'Mangalore', 'Karnataka', '575002', '9008366044', 'Maithri Opticals', '2021-02-12 08:23:45', '2021-02-12 08:23:45'),
(36, 61, '', '', '', '', '', '', '', '1st floor prema plaza', 'Car street', 'Mangalore', 'Karnataka', '575001', '9844274675', 'S R ineed opticals', '2021-02-12 12:06:46', '2021-02-12 12:06:46'),
(37, 62, '', '', '', '', '', '', '', 'Shop No : 32', 'Stadium Complex', 'Kannur', 'Kerala', '670001', '9447366666', 'Nayanam Opticals', '2021-02-15 05:53:28', '2021-02-15 05:53:28'),
(38, 63, '', '', '', '', '', '', '', 'Lig 23 nrupatunga road', 'Kuempunagar', 'Mysore', 'KARNATAKA', '560023', '9916267242', 'JUST 4 EYES', '2021-02-16 11:00:09', '2021-02-16 11:00:09'),
(39, 64, '', '', '', '', '', '', '', 'Shop no 23 Nehru Nagar', 'New Delhi 110065', 'New Delhi', 'Delhi', '110065', '9811473666', 'Uday Optical', '2021-02-18 12:16:24', '2021-02-18 12:16:24'),
(40, 65, '', '', '', '', '', '', '', '21/1 Coimbatore Road', 'Somasundaram eye hospital', 'Karur', 'Tamil Nadu', '639002', '9843236178', 'Dhivya optics', '2021-02-18 16:53:18', '2021-02-18 16:53:18'),
(41, 66, '', '', '', '', '', '', '', '1088/1 kalka dass marg', 'Mehrauli', 'New delhi', 'Delhi', '110030', '9873282509', 'Amar Sons', '2021-02-22 12:51:25', '2021-02-22 12:51:25'),
(42, 67, '', '', '', '', '', '', '', '1/33 Mall Road', 'Tilak Nagar', 'New delhi', 'Delhi', '110018', '9310137282', 'Galorebay optix india', '2021-02-23 05:37:13', '2021-02-23 05:37:13'),
(43, 68, '', '', '', '', '', '', '', 'B-5/365', 'Yamuna Vihar', 'Delhi', 'Delhi', '110053', '9968530761', 'Sunetraa', '2021-02-23 13:17:45', '2021-02-23 13:17:45'),
(44, 69, '', '', '', '', '', '', '', 'Same', 'Same', 'Delhi', 'India', '110091', '9810778121', 'A-76,street num-5,east vinod nagar', '2021-02-24 08:21:44', '2021-02-24 08:21:44'),
(45, 70, '', '', '', '', '', '', '', 'd-9', 'Noida', 'nagpur', 'maharatra', '440022', '09865963250', 'rajat kumar', '2021-02-25 12:20:59', '2021-02-25 12:20:59'),
(46, 78, '', NULL, '', '', '', '', NULL, 'd-9', 'subhash nagar', 'nagpur', 'maharatra', '440022', '09865963250', 'rajat kumar', '2021-02-26 06:37:14', '2021-02-26 06:37:14'),
(47, 88, '', NULL, '', '', '', '', NULL, 'G-321/A,', '', 'delhi', 'new delhi', '110025', '09865963250', 'ajit kumar', '2021-03-01 09:21:32', '2021-03-01 09:21:32'),
(48, 89, '', NULL, '', '', '', '', NULL, 'h-102, subhash nagar', 'subhash nagar', 'new delhi', 'delhi', '110093', '9865963250', 'aman saxena', '2021-03-01 09:40:30', '2021-03-01 09:40:30'),
(49, 90, '', NULL, '', '', '', '', NULL, 'H-09/B, Ashok nagar, asjoo vnae', 'asjoo vnae', 'new delhi', 'delhi', '110085', '9999999999', 'arun kumar', '2021-03-01 09:53:53', '2021-03-01 09:53:53'),
(50, 91, '', NULL, '', '', '', '', NULL, 'H-09/B, Ashok nagar, asjoo vnae', 'asjoo vnae', 'new delhi', 'delhi', '110085', '9999999999', 'arun kumar', '2021-03-01 09:58:25', '2021-03-01 09:58:25'),
(51, 91, '', NULL, '', '', '', '', NULL, 'H-09/B, Ashok nagar, asjoo vnae', 'asjoo vnae', 'new delhi', 'delhi', '110085', '9999999999', 'arun kumar', '2021-03-01 10:13:39', '2021-03-01 10:13:39'),
(52, 91, '', NULL, '', '', '', '', NULL, 'H-09/B, Ashok nagar, asjoo vnae', 'asjoo vnae', 'new delhi', 'delhi', '110085', '9999999999', 'arun kumar', '2021-03-01 10:17:45', '2021-03-01 10:17:45'),
(53, 91, '', NULL, '', '', '', '', NULL, 'H-09/B, Ashok nagar, asjoo vnae', 'asjoo vnae', 'new delhi', 'delhi', '110085', '9999999999', 'arun kumar', '2021-03-01 10:19:48', '2021-03-01 10:19:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_afterbefore`
--

CREATE TABLE `tbl_afterbefore` (
  `afterbefore_id` int(11) NOT NULL,
  `afterbefore_title` varchar(255) DEFAULT NULL,
  `image_fids` varchar(150) NOT NULL,
  `status` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_afterbefore`
--

INSERT INTO `tbl_afterbefore` (`afterbefore_id`, `afterbefore_title`, `image_fids`, `status`, `date_added`, `date_modified`) VALUES
(3, 'After before 1', '[\"6\"]', 'active', '2020-09-26 09:00:40', '2020-09-26 09:00:40'),
(4, 'After before 2', '[\"5\"]', 'active', '2020-09-26 09:00:51', '2020-09-26 09:00:51'),
(5, 'After before 3', '[\"7\"]', 'active', '2020-09-26 09:01:02', '2020-09-26 09:01:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment`
--

CREATE TABLE `tbl_appointment` (
  `eid` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_author`
--

CREATE TABLE `tbl_author` (
  `author_id` int(11) NOT NULL,
  `author_title` varchar(255) NOT NULL,
  `author_desc` varchar(500) DEFAULT NULL,
  `image_fids` varchar(150) NOT NULL,
  `status` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_author`
--

INSERT INTO `tbl_author` (`author_id`, `author_title`, `author_desc`, `image_fids`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Dbamy', 'Dbamy', 'null', 'active', '2018-08-22 14:20:44', '2020-08-05 04:01:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `banner_id` int(11) NOT NULL,
  `banner_title` varchar(255) DEFAULT NULL,
  `banner_desc` varchar(500) DEFAULT NULL,
  `banner_link` varchar(500) DEFAULT NULL,
  `image_fids` varchar(150) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_banner`
--

INSERT INTO `tbl_banner` (`banner_id`, `banner_title`, `banner_desc`, `banner_link`, `image_fids`, `sort_order`, `status`, `date_added`, `date_modified`) VALUES
(9, 'galorebay', '', '', '[\"601\"]', NULL, 'active', '2020-12-28 08:50:50', '2021-01-28 10:44:31'),
(10, 'Feather', '', '', '[\"600\"]', NULL, 'active', '2020-12-28 08:51:18', '2021-01-28 10:44:15'),
(11, 'Caron', '', '', '[\"599\"]', NULL, 'active', '2020-12-28 08:51:33', '2021-01-28 10:43:51'),
(12, 'Kidstar', '', '', '[\"414\"]', NULL, 'active', '2020-12-28 08:51:46', '2021-01-02 07:30:16'),
(13, 'Trackon', '', '', '[\"598\"]', NULL, 'active', '2020-12-28 08:52:02', '2021-01-28 10:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog`
--

CREATE TABLE `tbl_blog` (
  `blog_id` int(11) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_brief` varchar(1000) NOT NULL,
  `blog_category` int(11) DEFAULT NULL,
  `blog_post` text NOT NULL,
  `image_fids` varchar(50) DEFAULT NULL,
  `related_article` varchar(50) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `url_slug` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL,
  `h1_tag` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `image_title` varchar(255) NOT NULL,
  `image_alt` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_blog`
--

INSERT INTO `tbl_blog` (`blog_id`, `blog_title`, `blog_brief`, `blog_category`, `blog_post`, `image_fids`, `related_article`, `author`, `url_slug`, `status`, `h1_tag`, `meta_title`, `meta_description`, `image_title`, `image_alt`, `date_added`, `date_modified`) VALUES
(2, 'ANTI - GLARE GLASSES', '', 12, '<h1><span style=\"font-size:20px\"><strong>WHAT ARE ANTIGLARE GLASSES?</strong></span></h1>\r\n\r\n<p>Are you one of those people who are always on their Laptops? Munching alongside sitting infront of your screens most of the time of the day? Just a suggestion, get your eyes a comforting pair of glasses that protect your eyes well from the harmful lights that come in direct contact with your beautiful eyes. We understand that in pursuit of completing your work or maybe sometimes binge- watching your most relaxing series on OTT platforms, you tend to get carried away and get in direct contact with such lights, which can be harmful. You must get familiar with the correct glasses that would help you with the protection, and there is nothing better than Anti-glare glasses. Now, most of you might not know What are Antiglare glasses? So for you to have an easier understanding of what are antiglare glasses? How are the helpful in keeping your eyes, okay? Why should one opt-in for antiglare glasses? Antiglare glasses are also known as computer glasses specially designed to comfort your eyes and work to painless and irritation-free.</p>\r\n\r\n<h2><span style=\"font-size:20px\"><strong>What are Antiglare glasses?</strong></span></h2>\r\n\r\n<p>Antiglare glasses are glasses with an anti-reflective coating, which prevents the light from poking inside your eye. Anti-reflective glasses help you with comforting vision and lets you do your work without much hassles being encountered. Antiglare glasses are good to be considered as being a constructive preference for getting rid of computer vision syndrome. Must be wondering what computer vision syndrome is like; it is more or less a syndrome that affects the eyes of people who are in front of screens for longer durations throughout the day. Antiglare glasses or computer glasses are conducive and beneficial for eyes to be caressed from direct light to impact the eyes. Antiglare glasses are not just helpful for working professionals on the laptop, but they are also helpful while using any other technology or gadget. Antiglare glasses help correct any vision impairment. Anyone who&amp; s always on their phone or laptop screens busy using them or working for long hours a day should get themselves the antiglare glasses because nobody would like to have irritating eye vision, blurriness or a feeling of dryness in their eyes making it difficult to work and enjoy what they are doing. Antiglare glasses help you with that by becoming a layer of beautiful vision that is comforting and is not hazy or blur. Antiglare glasses come in variations, and one can find asuitable option for themselves. When we precisely talk about Antiglare glasses, the glasses&amp; lenses have the types to be preferred. It has been said that there are both Pros and Cons attached to Anti-glare Glasses, but if it looked upon; there are only Pros to be found with the most effectiveness.</p>\r\n\r\n<p><strong>Some of the advantages of using Antiglare glasses are as follows:</strong></p>\r\n\r\n<p>- They are stylish and set a vibe and attractive and pleasing design that gives an enchanting overall tone.<br />\r\n- Antiglare glasses are specially designed for vision correctness and contrast optimized<br />\r\n- Have wide ranges from design to material<br />\r\n- Anti-reflective coating and protectors to keep eyes as beautiful as ever.</p>\r\n\r\n<p>At Galorebay, we provide our customers with the best time in terms of quality,designs, the material being used, and whatnot. We are more than a decade old brand</p>\r\n\r\n<p>making sure about customer satisfaction and services that we provide.</p>\r\n', '[\"730\"]', '', 1, 'what-are-anti-glare-glasses', 'active', '', 'galorebayoptix - What are Anti-Glare Glasses? Anti-Glare Computer glasses', 'Anti-glare glasses are also known as computer glasses. Anti-glare glasses have that anti- reflective coating that bends the light from entering the eye and act as a protection.', '', 'anti glare glasses', '2021-02-08 07:26:52', '2021-02-08 08:59:18'),
(3, 'Should I Use Eyeglasses For Computer', '', 12, '<p dir=\"ltr\">Sitting in front of the computer and having a headache and eye strains?</p>\r\n\r\n<p>Feeling some kind of heaviness or dryness in the eyes after working on your computer screen. Then, you are in the right place. You might need a pair of optical glasses for better vision.&nbsp;</p>\r\n\r\n<p>These days all the workplaces whether modern or traditional have lots and lots of computers installed for working and it definitely has unpleasant effects on your eyes. You might not feel it right now but would definitely come across it in the future. It is pretty obvious that screens have a negative effect on the eyes and cause-related syndromes.</p>\r\n\r\n<h2 dir=\"ltr\"><strong><span style=\"font-size:14px\">What Is Computer Vision Syndrome?</span></strong></h2>\r\n\r\n<p dir=\"ltr\">Many individuals experience eye discomfort and optical problems when viewing electronic screens for a longer period. The level of discomfort appears to increase with the use of the digital screen. While sitting on your workstations or by the end of the day; you definitely come across dizziness, headache, and heaviness. This may not cause many problems now but will surely get serious in the long run.&nbsp;</p>\r\n\r\n<p>You should immediately get computer glasses and get rid of uncomfortable eye situations</p>\r\n\r\n<h2 dir=\"ltr\"><span style=\"font-size:14px\"><strong>Symptoms</strong></span></h2>\r\n\r\n<p dir=\"ltr\"><strong>The most common computer vision syndrome symptoms are:</strong></p>\r\n\r\n<ul>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\">Eyestrains</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\">Headaches</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\">Blurred vision</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\">Eye dryness</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\">Neck and shoulder pain</p>\r\n	</li>\r\n</ul>\r\n\r\n<p dir=\"ltr\"><strong>These symptoms are caused due to:</strong></p>\r\n\r\n<ul>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\">Low lighting</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\">Glare on the electronic screen</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\">Inappropriate viewing distance</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\">Wrong sitting posture</p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\">Uncorrected vision problems</p>\r\n	</li>\r\n</ul>\r\n\r\n<p dir=\"ltr\"><span style=\"font-size:14px\"><strong>What Are Computer Glasses?</strong></span></p>\r\n\r\n<p>Many of you wear eyeglasses to correct some kind of vision problem. But not all the glasses are right for all situations.</p>\r\n\r\n<p dir=\"ltr\">Computer glasses are totally different from regular glasses in that they are specifically made to reduce the eye strain caused by the use of computers, tablets, and related devices.</p>\r\n\r\n<p dir=\"ltr\">The average person sits for nine hours a day in front of a computer. These long hours make you more and more inclined towards problems. It is usual to the fact, that your eyes just feel tired and irritated at the end of the workday.</p>\r\n\r\n<p>The anti-reflective coating on computer glasses helps to reduce the glare that bounces off the screen and light coming from the device. Glass color tinting is also a feature that helps in increasing the screen&rsquo;s contrast amount without making it too sour for our eyes.&nbsp;</p>\r\n\r\n<p dir=\"ltr\">It is recommended to use blue block lenses if you have a lot of digital work, as it is said prevention is better than cure.</p>\r\n\r\n<h3 dir=\"ltr\"><span style=\"font-size:14px\"><strong>What Are Blue Block Lenses?</strong></span></h3>\r\n\r\n<p dir=\"ltr\"><span style=\"font-size:14px\">Blue-light blocking glasses have filters in their lenses that block and absorb blue light, and sometimes even UV light, from getting through. If you use these glasses while working on a screen, especially after dark, they can help to decrease the exposure to blue light waves that can keep you awake.</span></p>\r\n\r\n<p dir=\"ltr\">A 2017 study done by the University of Houston found that participants wearing the glasses showed about a 58% increase in their nighttime melatonin levels.</p>\r\n\r\n<p dir=\"ltr\">All the working professionals and students out there, go get your blue block lenses asap and gift your eyes a relaxing vision.</p>\r\n', '[\"984\"]', '', 0, 'Should-I-Use-Eyeglasses-For-Computer', 'active', '', 'Should I Use Eyeglasses For Computer - galorebayoptix', '', '', '', '2021-02-26 10:23:17', '2021-02-26 10:31:05'),
(4, 'Best Place To Buy Eyeglasses Frames- Galorebay', '', 13, '<h2><span style=\"font-size:14px\"><strong>Looking for the best eyeglasses frames?</strong></span></h2>\r\n\r\n<p>You are in the best place to buy the best eyeglasses. Galorebay extravagates your personality with the perfect frames and gives a treat of comfort because eye care matters to us.&nbsp;</p>\r\n\r\n<p>Galorebay offers a huge variety of frames for all your needs. Here&rsquo;s the type of frames you can get according to your personality, need, and profession as well.</p>\r\n\r\n<h2><span style=\"font-size:14px\"><strong>Have a look:</strong></span></h2>\r\n\r\n<h3><span style=\"font-size:12px\"><strong>Round Frames:</strong></span></h3>\r\n\r\n<p>Round/Circular frames were a popular choice for pop idols in the 1960s and 70s. These are also known as &ldquo;tea shades&rdquo;. Round glasses are making a major comeback in the fashion world. These frames give a comfortable and trendy vibe and even go well with all the attires and occasions.</p>\r\n\r\n<h3><span style=\"font-size:12px\"><strong>Rectangle Frames:</strong></span></h3>\r\n\r\n<p>Rectangle glasses are the standard glasses that almost everyone has or had. From a corporate employee to a geeky, everyone loves it. It reflects your true personality. It is the most popular frame amongst people of all age groups and genders.</p>\r\n\r\n<p><span style=\"font-size:12px\"><strong>Cat-Eye Frames:&nbsp;</strong></span></p>\r\n\r\n<p>From Manhattan style to chick-style, always in!</p>\r\n\r\n<p>The traces of cat-eye glasses can be seen from the 1950s and still loved by all. Galorebay provides a vast variety of everyone&rsquo;s favourite cat-eye frames. It gives a perfect look to people with round and oval shape faces.</p>\r\n\r\n<p><span style=\"font-size:12px\"><strong>Rim-Less Frames:</strong></span></p>\r\n\r\n<p>Thanks to rim-less frames for their invisible look and style. It goes well with all the face shapes and sizes. It can be considered a no-brainer choice for all the face shapes; you need not worry about these frames. You&rsquo;ll just slay and look great.</p>\r\n\r\n<p>But but but it requires a lot more care</p>\r\n\r\n<p>These frames don&rsquo;t have any solid structure attached to them. So be aware and keep a little extra care.</p>\r\n\r\n<h2><span style=\"font-size:14px\"><strong>Half Rim-Less Frames:</strong></span></h2>\r\n\r\n<p>Half-rim glasses are the ones that do not have a full rim structure around the lenses. These glasses only have a strong structure over the top of lenses. This even reduces the weight of the frame and gives a relaxing and comfortable vision. These frames are also known as &ldquo;semi rim-less&rdquo;.</p>\r\n\r\n<p>Make sure you handle these frames with care!</p>\r\n\r\n<p>Go get your favourite frames from Glorebay Optix and elevate your personality.&nbsp;</p>\r\n\r\n<p>One-stop-shop to all your optical needs!</p>\r\n', '[\"997\"]', '', 0, 'best-place-to-buy-eyeglasses-frames-galorebay', 'active', '', 'Best Place To Buy Eyeglasses Frames- Galorebay - galorebayoptix', '', '', '', '2021-02-27 09:53:27', '2021-02-27 10:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blogcategory`
--

CREATE TABLE `tbl_blogcategory` (
  `bcat_id` int(11) NOT NULL,
  `bcat_name` varchar(255) NOT NULL,
  `url_slug` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_blogcategory`
--

INSERT INTO `tbl_blogcategory` (`bcat_id`, `bcat_name`, `url_slug`, `status`, `date_added`, `date_modified`) VALUES
(11, 'Frames', 'frames', 'active', '2021-02-08 06:37:11', '2021-02-08 06:37:11'),
(12, 'computer glasses', 'computer-glasses', 'active', '2021-02-08 06:37:22', '2021-02-08 06:37:22'),
(13, 'Sunglasses', 'sunglasses', 'active', '2021-02-08 06:37:29', '2021-02-08 06:56:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blogcomments`
--

CREATE TABLE `tbl_blogcomments` (
  `comment_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `comment_name` varchar(150) NOT NULL,
  `comment_email` varchar(150) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'inactive',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_blogcomments`
--

INSERT INTO `tbl_blogcomments` (`comment_id`, `blog_id`, `comment`, `comment_name`, `comment_email`, `parent`, `status`, `date_added`, `date_modified`) VALUES
(1, 1, 'testetet sts t stststs stssgs', 'Abhiseh', 'ne@gm.com', 0, 'active', '2019-04-12 13:28:29', '2019-04-12 13:28:29'),
(2, 1, 'reply comment test', 'Test user', 'test@gmail.com', 1, 'active', '2019-04-15 08:09:33', '2019-04-15 08:09:33'),
(3, 1, 'ron test', 'Ron', 'ron@gmail.com', 1, 'active', '2019-04-15 08:12:14', '2019-04-15 08:12:14'),
(5, 1, 'test comment ', 'Harry', 'harry@gmail.com', 1, 'active', '2019-04-15 08:13:52', '2019-04-15 08:13:52'),
(6, 1, 'test comment', 'New test', 'abhi@gmail.com', 0, 'inactive', '2019-04-15 08:48:53', '2019-04-15 08:48:53'),
(7, 1, 'test testet', 'test', 'trr@gmail.com', 0, 'inactive', '2019-04-15 09:03:19', '2019-04-15 09:03:19'),
(8, 1, 'sdad adsd da dasda', 'test hgh', 'ag@h.com', 0, 'inactive', '2019-04-15 09:29:33', '2019-04-15 09:29:33'),
(9, 1, 'dsfsd  fsdfs', 'test', 'asdasd@g.cc', 0, 'inactive', '2019-04-15 09:33:59', '2019-04-15 09:33:59'),
(10, 1, 'test test test', 'ttt', 'rr@gg.co', 0, 'inactive', '2019-04-15 09:46:11', '2019-04-15 09:46:11'),
(11, 1, 'test test test', 'ttt', 'rr@gg.co', 0, 'inactive', '2019-04-15 09:50:04', '2019-04-15 09:50:04'),
(12, 1, 'test etst test etst', 'ggg', 'gm@gm.com', 0, 'inactive', '2019-04-15 09:51:17', '2019-04-15 09:51:17'),
(13, 1, 'test etst test etst', 'ggg', 'gm@gm.com', 0, 'inactive', '2019-04-15 11:01:50', '2019-04-15 11:01:50'),
(14, 1, 'sfsf sdf', 'as', 'asd@f.co', 0, 'inactive', '2019-04-15 11:05:26', '2019-04-15 11:05:26'),
(15, 1, 'sfsf sdf', 'as', 'asd@f.co', 0, 'inactive', '2019-04-15 11:06:31', '2019-04-15 11:06:31'),
(16, 1, 'sfsf sdf', 'as', 'asd@f.co', 0, 'inactive', '2019-04-15 11:06:38', '2019-04-15 11:06:38'),
(17, 1, 'hello testing the comments....check this out here', 'Abhishek', 'testuserabhi@gmail.com', 0, 'inactive', '2019-05-08 07:02:39', '2019-05-08 07:02:39'),
(18, 1, 'kjfkl asld aslkjd klasd', 'RA', 'rav@fmail.co', 0, 'inactive', '2019-05-08 08:58:00', '2019-05-08 08:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `id` int(10) NOT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `image_fids` varchar(255) DEFAULT NULL,
  `featured` int(11) DEFAULT NULL COMMENT '1: featured list	',
  `url_slug` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `sort_no` int(11) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`id`, `brand_name`, `image_fids`, `featured`, `url_slug`, `meta_title`, `meta_desc`, `status`, `sort_no`, `date_added`, `date_modified`) VALUES
(13, 'Cashier', '[\"164\"]', 1, 'cashier', NULL, NULL, 'active', 6, '2020-11-30 13:15:23', '2020-12-17 07:53:44'),
(14, 'Trackon', '[\"42\"]', 1, 'trackon', NULL, NULL, 'active', 5, '2020-11-30 13:15:26', '2020-12-13 07:56:02'),
(15, 'Kidstar', '[\"25\"]', 1, 'kidstar', NULL, NULL, 'active', 4, '2020-11-30 13:16:59', '2020-12-13 07:55:40'),
(16, 'Caron', '[\"74\"]', 1, 'caron', NULL, NULL, 'active', 3, '2020-11-30 13:17:21', '2020-12-10 10:50:28'),
(17, 'Feather', '[\"172\"]', 1, 'feather', NULL, NULL, 'active', 1, '2020-11-30 13:17:31', '2020-12-17 13:11:27'),
(18, 'Galorebay', '[\"169\"]', 1, 'galorebay', NULL, NULL, 'active', 2, '2020-11-30 13:17:37', '2020-12-17 13:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_career`
--

CREATE TABLE `tbl_career` (
  `cid` int(11) NOT NULL,
  `career_title` varchar(150) DEFAULT NULL,
  `hosp_id` varchar(50) DEFAULT NULL,
  `designation` varchar(150) DEFAULT NULL,
  `department` varchar(200) DEFAULT NULL,
  `qualification` varchar(500) DEFAULT NULL,
  `experience` varchar(100) DEFAULT NULL,
  `total_opening` varchar(150) DEFAULT NULL,
  `job_decription` text DEFAULT NULL,
  `contact_details` varchar(150) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `additional_tag` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `url_slug` varchar(150) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_career`
--

INSERT INTO `tbl_career` (`cid`, `career_title`, `hosp_id`, `designation`, `department`, `qualification`, `experience`, `total_opening`, `job_decription`, `contact_details`, `meta_title`, `meta_desc`, `additional_tag`, `sort_order`, `url_slug`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Consultant Laparoscopic Surgeon', '13,12', 'Consultant Laparoscopic Surgeon', 'Laparoscopy', 'MS/ DNB', '1-4 years', '1', '<p><em><u>POSITION GUIDELINES</u></em></p>\r\n\r\n<p><u>DOCUMENT- JOB DESCRIPTION/ RESPONSIBILITIES</u></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>DEPARTMENT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : NURSING</p>\r\n\r\n<p>POSITION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; : STAFF NURSE</p>\r\n\r\n<p>REPORTING TO&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : FLOOR INCHARGE</p>\r\n\r\n<p>REPORTING TO&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : NURSING SUPERINTENDENT</p>\r\n\r\n<p>QUALIFICATION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : DIPLOMA IN GENERAL NURSING &amp; MIDWIFERY / B.SC. NURSING</p>\r\n\r\n<p>DRESS CODE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : SPECIFIED DRESS CODE WITH I.D. CARD</p>\r\n\r\n<p>DUTY HOURS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : AS PER SCHEDULED REQUIREMENTS</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><u>JOB DESCRIPTION</u></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>To ensure delivery of patient care through implementation of prescribed medication and monitoring effects.</li>\r\n	<li>To provide nursing care to patients based on established clinical practice standards.</li>\r\n	<li>To collaborate with other disciplines to ensure effective and efficient patient care delivery.</li>\r\n	<li>To actively participate in programs for quality improvement in nursing practices.</li>\r\n	<li>To maintain positive interpersonal relations with subordinates &amp; seniors.</li>\r\n	<li>To promote a safe environment for patients, visitors and coworkers including the implementations of infection control policies of the hospital.</li>\r\n	<li>To perform the initial and reassessment of the patient within the defined time frame.</li>\r\n	<li>To check daily inventory of Medicines &amp; Other Equipments.</li>\r\n	<li>To provide Pre &amp; Post operative care to the inpatient as per protocols.</li>\r\n	<li>To provide health education to the patients as required.</li>\r\n	<li>To instruct IV Class staff for cleaning, changing of bed sheets, sponging the patient, other routine necessities of patients and biomedical waste management.&nbsp;&nbsp; Report Checking of all patients.(Supervisory).</li>\r\n	<li>To give priority to emergency cases and to co-ordinate with the consultants / respective department for the same.</li>\r\n	<li>To maintain appropriate departmental documentation.</li>\r\n	<li>To treat all communication about patients, staff, and other organizational business confidentially.</li>\r\n	<li>To be involved in quality Assurance / Quality control activities.</li>\r\n	<li>To perform all the jobs as may be assigned due to exigencies of work.</li>\r\n	<li>Participation in Continuous Quality Improvement.</li>\r\n	<li>&nbsp;</li>\r\n</ol>\r\n', 'shikha.saini@rghospital.com', NULL, NULL, NULL, NULL, 'consultant-laparoscopic-surgeon', 'active', '2019-07-05 11:01:56', '2019-07-05 11:01:56'),
(2, 'Staff Nurse', '14', 'Staff Nurse', 'Nursing', 'GNM/BSC', '0-7 years', '2', '<p><em><u>POSITION GUIDELINES</u></em></p>\r\n\r\n<p><u>DOCUMENT- JOB DESCRIPTION/ RESPONSIBILITIES</u></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>DEPARTMENT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : NURSING</p>\r\n\r\n<p>POSITION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; : STAFF NURSE</p>\r\n\r\n<p>REPORTING TO&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : FLOOR INCHARGE</p>\r\n\r\n<p>REPORTING TO&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : NURSING SUPERINTENDENT</p>\r\n\r\n<p>QUALIFICATION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : DIPLOMA IN GENERAL NURSING &amp; MIDWIFERY / B.SC. NURSING</p>\r\n\r\n<p>DRESS CODE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : SPECIFIED DRESS CODE WITH I.D. CARD</p>\r\n\r\n<p>DUTY HOURS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : AS PER SCHEDULED REQUIREMENTS</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><u>JOB DESCRIPTION</u></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>To ensure delivery of patient care through implementation of prescribed medication and monitoring effects.</li>\r\n	<li>To provide nursing care to patients based on established clinical practice standards.</li>\r\n	<li>To collaborate with other disciplines to ensure effective and efficient patient care delivery.</li>\r\n	<li>To actively participate in programs for quality improvement in nursing practices.</li>\r\n	<li>To maintain positive interpersonal relations with subordinates &amp; seniors.</li>\r\n	<li>To promote a safe environment for patients, visitors and coworkers including the implementations of infection control policies of the hospital.</li>\r\n	<li>To perform the initial and reassessment of the patient within the defined time frame.</li>\r\n	<li>To check daily inventory of Medicines &amp; Other Equipments.</li>\r\n	<li>To provide Pre &amp; Post operative care to the inpatient as per protocols.</li>\r\n	<li>To provide health education to the patients as required.</li>\r\n	<li>To instruct IV Class staff for cleaning, changing of bed sheets, sponging the patient, other routine necessities of patients and biomedical waste management.&nbsp;&nbsp; Report Checking of all patients.(Supervisory).</li>\r\n	<li>To give priority to emergency cases and to co-ordinate with the consultants / respective department for the same.</li>\r\n	<li>To maintain appropriate departmental documentation.</li>\r\n	<li>To treat all communication about patients, staff, and other organizational business confidentially.</li>\r\n	<li>To be involved in quality Assurance / Quality control activities.</li>\r\n	<li>To perform all the jobs as may be assigned due to exigencies of work.</li>\r\n	<li>Participation in Continuous Quality Improvement.</li>\r\n</ol>\r\n', 'shikha.saini@rghospital.com', NULL, NULL, NULL, NULL, 'staff-nurse', 'active', '2019-07-05 11:02:57', '2019-07-05 12:45:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_careerenquiry`
--

CREATE TABLE `tbl_careerenquiry` (
  `cid` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(15) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `currentcity` varchar(100) DEFAULT NULL,
  `designation` varchar(150) DEFAULT NULL,
  `currentctc` varchar(100) DEFAULT NULL,
  `currentcompany` varchar(150) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_careerenquiry`
--

INSERT INTO `tbl_careerenquiry` (`cid`, `name`, `email`, `phone`, `file_name`, `currentcity`, `designation`, `currentctc`, `currentcompany`, `date_added`) VALUES
(10, 'aman saxena', 'amai@gmail.com', '9865963250', '1612003341_369.jpg', 'new delhi', 'abv', '24k', 'av', '2021-01-30 10:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `image_fids` varchar(200) DEFAULT NULL,
  `parent` int(11) DEFAULT 0,
  `hasChild` tinyint(4) DEFAULT 0,
  `featured` int(11) DEFAULT NULL COMMENT '1: featured list',
  `sort_order` int(11) DEFAULT 150,
  `url_slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `additional_tag` varchar(500) DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `category_name`, `image_fids`, `parent`, `hasChild`, `featured`, `sort_order`, `url_slug`, `meta_title`, `meta_desc`, `additional_tag`, `status`, `date_added`, `date_modified`) VALUES
(6, 'frames', '[\"551\"]', 0, 0, 1, 150, 'frames', NULL, NULL, NULL, 'active', '2020-11-18 07:11:48', '2021-01-16 07:21:15'),
(7, 'Computer Glasses', '[\"540\"]', 0, 0, 1, 150, 'computer-glasses', NULL, NULL, NULL, 'active', '2020-11-18 07:12:26', '2021-01-15 12:47:59'),
(9, 'Sunglasses', '[\"538\"]', 0, 0, 1, 150, 'sunglasses', NULL, NULL, NULL, 'active', '2020-11-27 07:03:00', '2021-01-15 09:52:43'),
(10, 'KID GLASSES', '[\"1026\"]', 0, 0, 1, 150, 'kid-glasses', NULL, NULL, NULL, 'active', '2021-03-01 06:36:33', '2021-03-01 06:48:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clients`
--

CREATE TABLE `tbl_clients` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `image_fids` varchar(150) DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_clients`
--

INSERT INTO `tbl_clients` (`client_id`, `client_name`, `image_fids`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Max', '[\"57\"]', 'active', '2019-09-25 07:32:02', '2019-10-18 06:47:24'),
(2, 'City Hospital', '[\"56\"]', 'active', '2019-10-18 06:47:36', '2019-10-18 06:47:36'),
(3, 'BLK', '[\"55\"]', 'active', '2019-10-18 06:47:47', '2019-10-18 06:47:47'),
(4, 'Apollo', '[\"54\"]', 'active', '2019-10-18 06:48:11', '2019-10-18 06:48:11'),
(5, 'Medanta', '[\"53\"]', 'active', '2019-10-18 06:48:23', '2019-10-18 06:48:23'),
(6, 'Fortis', '[\"52\"]', 'active', '2019-10-18 06:48:34', '2019-10-18 06:48:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_verification` tinyint(4) NOT NULL DEFAULT 0,
  `email_verification` tinyint(4) NOT NULL DEFAULT 0,
  `verified` int(10) DEFAULT NULL,
  `otp` varchar(8) DEFAULT NULL,
  `token` text DEFAULT NULL,
  `otp_date` timestamp NULL DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `gst_no` varchar(255) DEFAULT NULL,
  `pan_no` varchar(100) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `email`, `mobile`, `password`, `mobile_verification`, `email_verification`, `verified`, `otp`, `token`, `otp_date`, `company_name`, `gst_no`, `pan_no`, `status`, `date_added`, `date_modified`) VALUES
(29, 'Gurparkash singh', 'money@galorebayoptix.com', '80101748485', '8466cdfe71cacd0442f537d3f598661a', 0, 0, NULL, NULL, NULL, NULL, 'Galorebay optix (india)', '07Mmqpn5814v1zw', 'Mmqpn5814v', 'active', '2021-01-18 08:31:48', '2021-01-24 07:07:51'),
(30, 'Vikramjit Singh', 'vikramjitsinghbajaj@gmail.com', '9958206783', '2c47e372dc5018cabdccd6ece5857b6a', 0, 0, NULL, NULL, NULL, NULL, 'Galorebay optix', '07AAHFG9758N1ZJ', 'AAHFG9758N', 'active', '2021-01-22 07:05:45', '2021-01-22 07:10:06'),
(31, 'K.Kotrappa', 'nitishopticalcentre@gmail.com', '09886591109', 'f497fc24f363cef230346e86211927ee', 0, 0, NULL, NULL, NULL, NULL, 'Nitish optical centre', '29AFKPK4600F1ZL', 'AFKPK4600F', 'active', '2021-01-29 06:13:15', '2021-01-29 06:13:15'),
(32, 'Tushar Anand', 'anandtushar510@gmail.com', '9810714710', '1ef28aa38d478898a07f7c82fc74ed99', 0, 0, NULL, NULL, NULL, NULL, 'Galorebay optix', '07AAHFG9758N1ZJ', 'AAHFG9758N', 'active', '2021-01-29 08:13:42', '2021-01-29 08:13:42'),
(33, 'Vishal H', 'shahopticals@gmail.com', '9986163349', 'aa478ffc05f4b385fcddb8148f45602c', 0, 0, NULL, NULL, NULL, NULL, 'Shah Opticals', '29ACPFS3925D1ZT', 'ACPFS3925D', 'active', '2021-01-29 08:52:22', '2021-01-29 12:24:16'),
(34, 'Dr Vasudhendra', 'nayananov1@gmail.com', '9886088549', '29e9bc61ef34a426141ed4aa6eb12299', 0, 0, NULL, NULL, NULL, NULL, 'Nayana optical', '29AAHFN3861F1Z3', 'AAHFN3861F', 'active', '2021-01-29 12:15:56', '2021-01-29 12:24:33'),
(35, 'Dr Trupti', 'trupti.kotur@gmail.com', '9886567791', '27e012f213ed39137189d9912b33618c', 0, 0, NULL, NULL, NULL, NULL, 'Landmark medical and optical', '29AAGFL1692K1Z3', 'AAGFL1692K', 'active', '2021-01-29 13:41:25', '2021-01-29 13:41:25'),
(36, 'ajit kumar', 'amai@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, NULL, NULL, NULL, NULL, '', '', '', 'inactive', '2021-02-01 13:28:32', '2021-02-22 10:01:49'),
(37, 'Guru raj', 'Gururajj67@gemal.co', '', '8dffefcfedada29da6316aaaf7cfc6c8', 0, 0, NULL, NULL, NULL, NULL, 'Guru opticals', '', 'Bsxpg9775l', 'active', '2021-02-02 11:21:46', '2021-02-21 11:30:52'),
(38, 'Mameemuddin', 'opticalpalace123456@gmail.com', '9448568546', '25d55ad283aa400af464c76d713c07ad', 0, 0, NULL, NULL, NULL, NULL, 'Optical palace', '29abkpa6777b1zl', '', 'active', '2021-02-02 12:08:29', '2021-02-02 12:08:29'),
(39, 'Purnima. B', 'dtbaskarsomasundaram@gmail.com', '9843236178', '11eead9f8f1b6c85143e69d39e6597c3', 0, 0, NULL, NULL, NULL, NULL, 'Dhivya optics ', '', '', 'inactive', '2021-02-03 06:51:07', '2021-02-03 06:51:07'),
(40, 'Jawan singh', 'sriramdev14323@gmail.com', '', '52f703a2b6e5dab5d2ebebc819a4573e', 0, 0, NULL, NULL, NULL, NULL, 'Sri ramdev optical', '29cgpps5000r1zj', '', 'active', '2021-02-03 08:21:48', '2021-02-21 11:26:24'),
(41, 'Syed Ashfaq Ahmed soudagar', 'soudagar1967@gmail.com', '9986130407', '3d6176952719cd66db961d435ab6b67e', 0, 0, NULL, NULL, NULL, NULL, 'Paramount optical center', '29ADJPA8857F1Z9', 'ADJPA8857F', 'active', '2021-02-03 11:22:08', '2021-02-03 11:22:08'),
(42, 'Gigar patel', 'gigar_patel@yahoo.com', '', '2e4b1cccedf8cdecebba1b22efbe7e27', 0, 0, NULL, NULL, NULL, NULL, 'Prakash opticals', '29AXHPP8368GIZR', '', 'active', '2021-02-05 10:31:55', '2021-02-21 11:25:24'),
(43, 'Nikhil mehta', 'girnaropt@gmail.com', '9448583301', '22fe71811e73495c01a4d0b2040eafce', 0, 0, NULL, NULL, NULL, NULL, 'Girnar optical', '29AABFG0230H1ZV', 'AABFG0230H', 'active', '2021-02-05 13:01:36', '2021-02-05 13:01:36'),
(44, 'Anoop', 'anupsolanke86@gmail.com', '', '774fbd4b68a96cf8743894e1fb9cb026', 0, 0, NULL, NULL, NULL, NULL, 'Eye style optics', '29AAGFE6459H1Z1', 'AAGFE6459H', 'active', '2021-02-06 12:05:18', '2021-02-21 11:24:27'),
(45, 'Yogesh s harti', 'yogeshmeena2000@gmail.com', '', '25d55ad283aa400af464c76d713c07ad', 0, 0, NULL, NULL, NULL, NULL, 'Shri Raj Laxmi optics ', '29ADCPH7619BIZR', 'ADCPH7619b', 'active', '2021-02-06 14:07:26', '2021-02-21 11:23:13'),
(46, 'Mahaveer d jain', 'luckyopticianshublihubli77@gmsil.com', '8050174909', '1e22cf5a3f9f3959fa2b5abca8af5d6a', 0, 0, NULL, NULL, NULL, NULL, 'Premium optical', '29BZSPJ5542C1Z3', 'Bzspj5542c', 'active', '2021-02-07 07:17:39', '2021-02-07 07:17:39'),
(47, 'Harsh', 'Harsh.Oza01@gmail.com', '', '820b316024ece22c39c5ec43c32fa0c7', 0, 0, NULL, NULL, NULL, NULL, 'Jawahar opticians ', '29AABFJ3260G1Zi', 'AABFJ3260G', 'active', '2021-02-07 07:31:28', '2021-02-21 11:22:13'),
(48, 'HITESHKUMAR SHAH', 'prabhueyewear@gmail.com', '9916021927', '3d3431b271d82b1e03243eea675757dc', 0, 0, NULL, NULL, NULL, NULL, 'PRABHU EYEWEAR ', '29cycps2532k1z2', 'Cycps2532k', 'active', '2021-02-07 12:07:06', '2021-02-07 12:07:06'),
(49, 'Arvind Sanghvi', 'sanghviarvind1617@gmail.com', '7019069235', 'd61078be10444b14366f212947742655', 0, 0, NULL, NULL, NULL, NULL, 'Sanghvi Opticians', '29HGNPS8867R1ZJ', 'HGNPS8867R', 'active', '2021-02-08 05:33:00', '2021-02-08 05:33:00'),
(50, 'Anusj', 'anushmandot@gmail.com', '', 'd24f9d6dfc2da3f2bd3d51cd65b177f1', 0, 0, NULL, NULL, NULL, NULL, 'Ambika opticals', '29AJBPM6340B1ZI', 'AJBPM6340B', 'active', '2021-02-08 08:23:33', '2021-02-21 11:20:28'),
(51, 'sandeep kumar', 'info.sandeep20@gmail.com', '8810243075', '814736f4e7ab15203796f28c58b4db95', 0, 0, NULL, NULL, NULL, NULL, 'galorebay optix', '07AAHFG9758N1ZJ', '', 'inactive', '2021-02-09 06:38:56', '2021-02-09 06:38:56'),
(52, 'Nandeesha', 'nandeesha.nt@gmail.com', '', '25d55ad283aa400af464c76d713c07ad', 0, 0, NULL, NULL, NULL, NULL, 'Shivamogga opticals ', '29ABAFS8831Q1ZC', 'ABFS8831Q1ZC', 'active', '2021-02-09 07:39:27', '2021-02-21 11:17:47'),
(53, 'GURUPRASAD CN', 'ashokstoresshimoga@gmail.com', '', 'ba1814ec830cbec2e6a4173bc1819b9b', 0, 0, NULL, NULL, NULL, NULL, 'SKANDA OPTICALS ', '29AEJPG3493G1Z9 ', 'AEJPG3493G ', 'active', '2021-02-09 09:32:05', '2021-02-21 11:16:44'),
(54, 'Russel Roche', 'russelopticals@gmail.com', '9880480841', '09054356298920d8cf5fc43c95dc54c0', 0, 0, NULL, NULL, NULL, NULL, 'Russel Opticals', '29AIAPM0595L1ZV', 'AIAPM0595L', 'active', '2021-02-10 05:30:07', '2021-02-10 05:30:07'),
(55, 'Yogish Nayak', 'rtnhyn@gmail.com', '9845353196', '75d1bc3aef31d5f1ae0feee6a06a6818', 0, 0, NULL, NULL, NULL, NULL, 'Chaitanya I needs', '29ACTPN7955L1ZE', 'ACTPNL7955L', 'active', '2021-02-10 06:38:21', '2021-02-10 06:38:21'),
(56, 'Tukaram nayak', 'tukaramineeds@gmail.com', '9964142277', '25d55ad283aa400af464c76d713c07ad', 0, 0, NULL, NULL, NULL, NULL, 'Sudershan optical', '29abaph0739a1z8', 'Abaph0739a', 'active', '2021-02-10 09:55:16', '2021-02-10 09:55:16'),
(57, 'Yusaf hm', 'yusafhm@gmail.com', '9880480820', '25d55ad283aa400af464c76d713c07ad', 0, 0, NULL, NULL, NULL, NULL, 'Satar optical', '29ahypy2240dizt', 'ahypy2240d', 'active', '2021-02-11 06:48:40', '2021-02-11 06:48:40'),
(58, 'Manjula shantaraj', 'manjulabl1972@gmail.com', '', '25d55ad283aa400af464c76d713c07ad', 0, 0, NULL, NULL, NULL, NULL, 'Ashwin optical', '29cpipm8563d1zg', 'cpipm8563d', 'active', '2021-02-11 08:14:55', '2021-02-21 11:14:05'),
(59, 'Vignesh Bhaktha', 'ineedsmlr@gmail.com', '09739461677', '25d55ad283aa400af464c76d713c07ad', 0, 0, NULL, NULL, NULL, NULL, 'I needs opticals', '29ASUPB1988Q1ZL', 'ASUPB1988Q', 'active', '2021-02-12 07:02:40', '2021-02-12 07:02:40'),
(60, 'Girish babu y', 'girishbabu18a@gmail.com', '9008366045', '47e8eae5c502856baaa44a5d3e681a27', 0, 0, NULL, NULL, NULL, NULL, 'Maithri opticals', '29AAwfm7503n1zd', 'AAwfm7503n', 'active', '2021-02-12 08:23:45', '2021-02-12 08:23:45'),
(61, 'Raghuveer', 'raghuessar@yahoo.co.in', '9844274675', '47b9b3c3dda5d5101f5fcf2f0d0c085b', 0, 0, NULL, NULL, NULL, NULL, 'S R ineed opticals ', '29ADJFS0011R1ZP', 'ADJFS0011R', 'active', '2021-02-12 12:06:46', '2021-02-12 12:06:46'),
(62, 'Jose Mathew', 'shibu.nayanam@gmail.com', '9447366666', '0d6ffa766296f3f0e4953a37ef1c3158', 0, 0, NULL, NULL, NULL, NULL, 'Nayanam Opticals ', '32ADXPM2041D1ZS', 'ADXPM2041D', 'active', '2021-02-15 05:53:28', '2021-02-15 05:53:28'),
(63, 'Ashok', 'vijayjustforeyes@gmail.com', '9916267242', 'bae5e3208a3c700e3db642b6631e95b9', 0, 0, NULL, NULL, NULL, NULL, 'JUST 4 EYES', '29AJJPA1997N1ZK ', 'AJJPA1997N', 'active', '2021-02-16 11:00:09', '2021-02-16 11:00:09'),
(64, 'Deepak bajaj', 'udayoptical1@gmail.com', '', 'e08bfc4b9a6c963f9c3314b09819811e', 0, 0, NULL, NULL, NULL, NULL, 'uday optical', '07AFTPR0443L1ZX', 'AFTPR0443L', 'active', '2021-02-18 12:16:24', '2021-02-21 11:11:35'),
(65, 'Purnima', 'drbaskarsomasundaram@gmail.com', '', '11eead9f8f1b6c85143e69d39e6597c3', 0, 0, NULL, NULL, NULL, NULL, 'Dhivya optics ', '', '', 'active', '2021-02-18 16:53:18', '2021-02-21 11:10:57'),
(66, 'Prateek sharma', 'prateek@amarsons.co.in', '9873282509', '36212ac380e4fd0b471c7d9077aa6cf9', 0, 0, NULL, NULL, NULL, NULL, 'Amar Sons ', '07AGQPS1526D1ZC', 'AGQPS1526D', 'active', '2021-02-22 12:51:25', '2021-02-22 12:51:25'),
(67, 'kulvinder singh', 'kulvindersab@gmail.com', '9310137282', '88a872123bcb9bfda0ee74d9f0d1cc3a', 0, 0, NULL, NULL, NULL, NULL, 'Galorebay optix india', '', 'BSWPS6235A', 'active', '2021-02-23 05:37:13', '2021-02-23 05:37:13'),
(68, 'Sunil', 'semwal.sunil73@gmail.com', '9968530761', 'cc9527378c31b13b9552a35cfe87f842', 0, 0, NULL, NULL, NULL, NULL, 'Sunetraa optical', '', 'Bubps 5679??', 'active', '2021-02-23 13:17:45', '2021-02-23 13:17:45'),
(69, 'Vishal kumar', 'vkapoor67@yahoo.com', '9810778121', '966fa72c7880dd3cefd5ab8d33d48d75', 0, 0, NULL, NULL, NULL, NULL, 'Shree balaji opticals', '', 'Angpk9949r', 'active', '2021-02-24 08:21:44', '2021-02-24 08:21:44'),
(84, 'Shah kumar', 'kumarjain19091989@gmail.com', '8140222806', '25f9e794323b453885f5181f1b624d0b', 0, 0, NULL, '1106', '1252ecfe7949160d1cb5b5f4a169fda172202510915369e1ab90957bf441be89830d8b2bf1decc065817e330be6b793ba130024cf118714dd5037cd23c7c68745f6680014989def57ac303b1dc2a', '2021-02-26 19:40:00', 'Rajshree opticals ', '24EPOPS5607Q1ZY', '', 'inactive', '2021-02-26 11:40:23', '2021-02-26 11:40:23'),
(85, 'chetna', 'doi_optix@yahoo.co.in', '9891674844', '013e4ebd6f778171d929403fca19be71', 0, 0, NULL, '8360', '303908dc5c7c2dc045d96a5dccb673e0c8ce6f960b993a1f6e9b3c2e125079201d2662785faded044cbd715d090eba6f3cefcf4d44d89cd243c3e13967691604efba96043b534ae87ca6899606fb', '2021-02-27 14:35:00', 'dubar optics', '07aacpt5115f1zw', '', 'inactive', '2021-02-27 06:35:19', '2021-02-27 06:35:19'),
(91, 'arun kumar', 'amit75965@gmail.com', '9999999999', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, 1, '8042', '17bb116b1e4e919e1527bba4a8fcae02fe896dbde81bf1e16fec611c0a4e89ebf6d4b5b42d4efe37a55b35d82e552698ed36f4f2a8b229aa352229185808a8f3cd20a965e548080a29cd76e259bd', '2021-03-01 17:56:00', '', '', '', 'active', '2021-03-01 09:56:15', '2021-03-01 09:56:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discount`
--

CREATE TABLE `tbl_discount` (
  `did` int(11) NOT NULL,
  `discount_name` varchar(150) NOT NULL,
  `discount_on` varchar(10) NOT NULL COMMENT '1:All 2:Category 3:Products',
  `category_id` varchar(150) DEFAULT NULL,
  `product_id` varchar(150) DEFAULT NULL,
  `discount_type` varchar(10) NOT NULL COMMENT '1:Flat 2:Percentage',
  `discount_value` int(11) NOT NULL,
  `discount_value_limit` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_discount`
--

INSERT INTO `tbl_discount` (`did`, `discount_name`, `discount_on`, `category_id`, `product_id`, `discount_type`, `discount_value`, `discount_value_limit`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Tesy 5%', 'category', '1', '2', 'percent', 5, 150, 'active', '2020-07-30 20:38:43', '2020-07-30 21:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enquiry`
--

CREATE TABLE `tbl_enquiry` (
  `eid` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE `tbl_faq` (
  `faq_id` int(11) NOT NULL,
  `faq_title` varchar(500) NOT NULL,
  `faq_desc` mediumtext NOT NULL,
  `status` varchar(15) NOT NULL,
  `order_no` int(11) DEFAULT NULL,
  `url_slug` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_faq`
--

INSERT INTO `tbl_faq` (`faq_id`, `faq_title`, `faq_desc`, `status`, `order_no`, `url_slug`, `date_added`, `date_modified`) VALUES
(1, 'What Causes Kidney Stones?', '<p>The basic&nbsp;<a href=\"https://www.rghospitals.com/department/urology/urinary-kidney-stone-treatment\">cause of kidney stone</a>&nbsp;occurrence is unknown, but wrong food habits and inadequate fluid intake are to be blamed. Other conditions such as urinary tract infection, gout, arthritis, hypercalciuria (increased calcium levels in urine), enlarged prostate, thyroid disorder, etc are also known to cause urinary stones.</p>\r\n', 'active', NULL, 'what-causes-kidney-stones', '2018-08-29 08:43:32', '2019-08-09 12:41:38'),
(2, 'What Are The Symptoms Of Kidney Stones?', '<p>Symptoms constitute problems with the normal urinary process including discomfort, pain and irritability. When the stone obstructs the urine flow, the ureter dilates and stretches causing muscle spasms giving rise to immense gripping pain (renal colic); felt in flank, lower abdomen, groin or leg of affected side. Some stones are called &lsquo;silent&rsquo; as they cause no pain. Other&nbsp;<a href=\"http://www.rghospitals.com/department/urology/urinary-kidney-stone-treatment\">kidney stone symptoms</a>&nbsp;include blood in urine (hematuria), increased frequency of urination, fever/chills, nausea/vomiting, pain/burning during urination etc.</p>\r\n', 'active', NULL, 'what-are-the-symptoms-of-kidney-stones', '2018-08-30 08:58:05', '2019-08-09 12:42:11'),
(3, 'Who Have Greater Tendency Towards Kidney Stones?', '<ul>\r\n	<li>Those who stay in the hot environmental conditions, such as tropical areas.</li>\r\n	<li>Positive family history of stone disease in first blood relation (25%).</li>\r\n	<li>Decreased fluid intake, which reduces urine output, and forms supersaturated urine.</li>\r\n</ul>\r\n', 'active', NULL, 'who-have-greater-tendency-towards-kidney-stones', '2019-08-09 12:42:35', '2019-08-09 12:42:35'),
(4, 'Why Do Stones Form?', '<h4>Common causes of stone formation are:</h4>\r\n\r\n<ul>\r\n	<li>Supersaturation of urine by decreased intake of water and/or hot environmental conditions leading to loss of body fluid by perspiration, and in breathing.</li>\r\n	<li>Urine infection where crystals deposit on and around the infection causing organism, and the stone grows over the period in the supersaturated urine.</li>\r\n	<li>Diet rich in oxalates, uric acid.</li>\r\n	<li>Functional or structural obstruction of the urinary system can precipitate the stone formation, like Pelvi-Ureteric Junction (PUJ) obstruction, Ectopic kidney etc.</li>\r\n</ul>\r\n', 'active', NULL, 'why-do-stones-form', '2019-08-09 12:43:41', '2019-08-09 12:43:41'),
(5, 'Does Water Help In Flushing Out The Stones?', '<p>Yes but not all stones. Small stones of 3-6 mm can be passed out with the increased intake of water.</p>\r\n', 'active', NULL, 'does-water-help-in-flushing-out-the-stones', '2019-08-09 12:43:54', '2019-08-09 12:43:54'),
(6, 'What Should I Do If I Have Passed A Stone In Urine?', '<p>If you find a stone, take it to your doctor for analysis. The type of stone you have, will determine the diet and prevention programme. You may need additional tests to ensure that new stones do not form in future.</p>\r\n', 'active', NULL, 'what-should-i-do-if-i-have-passed-a-stone-in-urine', '2019-08-09 12:44:04', '2019-08-09 12:44:04'),
(7, 'Is There Any Damage To The Kidney Or Other Organs During Lithotripsy (ESWL)?', '<p>There is no damage to other organs as the shock waves are effective on the focused point at the junction of solid and liquid, which is stone and urine respectively.</p>\r\n', 'active', NULL, 'is-there-any-damage-to-the-kidney-or-other-organs-during-lithotripsy-eswl', '2019-08-09 12:44:15', '2019-08-09 12:44:15'),
(8, 'Are Kidney Stones And Gallstones Related?', '<p>No there is no known link between the two. They are formed in different areas of the body under different systems.</p>\r\n', 'active', NULL, 'are-kidney-stones-and-gallstones-related', '2019-08-09 12:44:23', '2019-08-09 12:44:23'),
(9, 'What Should Be Done In Pregnant Females With Kidney Stone?', '<p>Stones during pregnancy demand conservative treatment. Surgery, if required may be done &ndash; ureteric stenting/PCNL, but only during the first half of the pregnancy term. ESWL is absolutely contraindicated.</p>\r\n', 'active', NULL, 'what-should-be-done-in-pregnant-females-with-kidney-stone', '2019-08-09 12:44:33', '2019-08-09 12:44:33'),
(10, 'What Is Benign Prostatic Hyperplasia?', '<p>Prostate gland is a walnut sized male reproductive gland located in front of rectum, at the base of urinary bladder, surrounding the urethra. In a normal adult, the prostate gland weighs around 20 grams. The size of the prostate gland increases slowly with age. This is known as benign prostatic hyperplasia (BPH) or lower urinary tract symptoms (LUTS). This condition is very common in elderly males over 50 years of age. Enlarged prostate affects urination, ejaculation and sometimes defecation.</p>\r\n', 'active', NULL, 'what-is-benign-prostatic-hyperplasia', '2019-08-09 12:44:42', '2019-08-09 12:44:42'),
(11, 'What Are The Symptoms Of BPH?', '<p>Symptoms of&nbsp;<a href=\"http://www.rghospitals.com/department/urology/enlarged-prostate-surgery\">BPH</a>&nbsp;may include frequency of urination, urgency to urinate, straining, hesitancy while urination (weak stream), urging even after urination, burning/pain during urination (dysuria), dribbling after voiding urine, some amount of blood in urine (hematuria), frequency of urination especially at night (nocturia), and/or uncontrolled outflow of urine. The early symptoms of benign prostatic hyperplasia and prostate cancer are nearly the same.</p>\r\n', 'active', NULL, 'what-are-the-symptoms-of-bph', '2019-08-09 12:44:52', '2019-08-09 12:44:52'),
(12, 'Are There Any Medicines That I Can Take?', '<p>Medications play a role in case of moderate to severe symptoms. Two classes of medicines are given, alpha-adrenergic blockers and 5-alpha-reductase inhibitors, either alone or in combination, which help in shrinking the prostate and helping it to relax. Medications result in symptom relief and slow progress of the disease. However, the effect ceases when the medication is stopped. The patient has to continue the medicines throughout life even if urination becomes normal.</p>\r\n', 'active', NULL, 'are-there-any-medicines-that-i-can-take', '2019-08-09 12:45:06', '2019-08-09 12:45:06'),
(13, 'Does Bph Imply Prostate Cancer?', '<p>No. BPH is non-cancerous enlargement and it does not even increase the risk for prostate cancer.</p>\r\n', 'active', NULL, 'does-bph-imply-prostate-cancer', '2019-08-09 12:45:21', '2019-08-09 12:45:21'),
(14, 'What Is HoLEP?', '<p>Holmium Laser Enucleation of Prostate (HoLEP) is used in the management of enlarged prostate. In this, Holmium laser is used to remove the obstructive tissue and also to seal the blood vessels.</p>\r\n\r\n<p>In this procedure, a resectoscope is inserted into the urethra through penis. Then a 550 micron fibre attached to the 100 watt Holmium laser machine is passed through it, which enucleates the excessive prostatic tissue. The enucleated gland is then pushed into the bladder, which is then shred into smaller pieces and sucked out using a device called Morcellator. The procedure takes around 15-90 minutes, depending upon the size of the prostate gland. HoLEP is almost bloodless as the laser beam seals the blood vessels also. At the end of the surgery, a catheter is inserted to keep the bladder empty. The catheter is usually kept for 24&ndash;48 hours. After the catheter removal, patient is discharged.</p>\r\n', 'active', NULL, 'what-is-holep', '2019-08-09 12:45:32', '2019-08-09 12:45:32'),
(15, 'What Is The Maximum Size Of Prostate Treatable Through HoLEP?', '<p>Size is not the limiting factor for HoLEP, the largest gland enucleated at RG till date is 424 grams. HoLEP can effectively treat the largest of glands with minimal morbidity. It completely removes the prostate lobes with immediate resolution of the obstruction.</p>\r\n', 'active', NULL, 'what-is-the-maximum-size-of-prostate-treatable-through-holep', '2019-08-09 12:45:42', '2019-08-09 12:45:42'),
(16, 'Is HoLEP Safe In Cardiac Patients?', '<p>HoLEP technique can be used safely in BPH patients suffering from hypertension, diabetes, cardiac problems, using cardiac pacemakers, or those in whom open surgery cannot be performed due to high risk of complications. This is a safe procedure.</p>\r\n', 'active', NULL, 'is-holep-safe-in-cardiac-patients', '2019-08-09 12:45:51', '2019-08-09 12:45:51'),
(17, 'What Type Of Doctor Should I Visit For Prostate Cancer Screening?', '<p>Screening for prostate cancer is a simple procedure. One may begin with a visit to the urologist. Urologist will be able to help you learn more about the screening process.</p>\r\n', 'active', NULL, 'what-type-of-doctor-should-i-visit-for-prostate-cancer-screening', '2019-08-09 12:46:01', '2019-08-09 12:46:01'),
(18, 'How Do I Know Which Specialists To See To Treat Prostate Cancer?', '<p>Urologists, radiation oncologists and medical oncologists all play a vital role in the treatment of prostate cancer.</p>\r\n', 'active', NULL, 'how-do-i-know-which-specialists-to-see-to-treat-prostate-cancer', '2019-08-09 12:46:10', '2019-08-09 12:46:10'),
(19, 'How Is Erectile Dysfunction Treated?', '<p>The treatment depends on the cause. Get yourself checked for medical problems and medicines that might cause ED. Medications may help with erectile dysfunction, some of which may be injected into your penis. Other medicines are taken by mouth. Not everyone can use these medicines. Your doctor will help you decide if you can try them.</p>\r\n', 'active', NULL, 'how-is-erectile-dysfunction-treated', '2019-08-09 12:46:18', '2019-08-09 12:46:18'),
(20, 'What Is Urinary Incontinence?', '<p>Urinary incontinence is the inability to hold urine leading to involuntary loss of urine. The urine loss can range from slight leakage of urine to severe frequent wetting. This condition severely affects quality of life by interfering with work, travel, social recreation and sexual activities.</p>\r\n', 'active', NULL, 'what-is-urinary-incontinence', '2019-08-09 12:46:28', '2019-08-09 12:46:28'),
(21, 'Is The Incidence Of Urinary Incontinence Similar In Men And Women?', '<p>No, women experience incontinence twice more often than men. Pregnancy, child-birth, menopause, and short female urinary tract account for this difference. However, both women and men can become incontinent from stroke, multiple sclerosis, and old age.</p>\r\n', 'active', NULL, 'is-the-incidence-of-urinary-incontinence-similar-in-men-and-women', '2019-08-09 12:46:36', '2019-08-09 12:46:36'),
(22, 'What Are The Risk Factors For Urinary Incontinence?', '<p>Risk factors include:</p>\r\n\r\n<ul>\r\n	<li>Pregnancy</li>\r\n	<li>Childbirth</li>\r\n	<li>Obesity</li>\r\n	<li>Menopause</li>\r\n	<li>Cigarette smoking</li>\r\n	<li>Prostate enlargement</li>\r\n	<li>Uterus removal</li>\r\n	<li>Radiation to pelvis</li>\r\n	<li>Diabetes</li>\r\n	<li>Parkinson&rsquo;s disease</li>\r\n	<li>Back injury</li>\r\n	<li>Cerebral vascular accident</li>\r\n</ul>\r\n', 'active', NULL, 'what-are-the-risk-factors-for-urinary-incontinence', '2019-08-09 12:46:52', '2019-08-09 12:46:52'),
(23, 'Is There Any Treatment Of Urinary Incontinence?', '<p>Most types of urinary incontinence can be effectively treated. In some patients, incontinence is often improved by weight loss. Smokers who have a chronic cough have fewer problems when they stop smoking (coughing). Some common drugs can also aggravate the situation.</p>\r\n', 'active', NULL, 'is-there-any-treatment-of-urinary-incontinence', '2019-08-09 12:47:04', '2019-08-09 12:47:04'),
(24, 'What Are The Treatment Options For Stress Incontinence?', '<p>In these patients, pelvic floor exercises (e.g. Kegel exercises) can be effective. These exercises strengthen both peri-urethral and pelvic floor muscles. However, these must be performed frequently throughout the day and continued for long-term effect. Certain drugs are also available for the management of stress incontinence. Oestrogen replacement therapy can also be very helpful, particularly in postmenopausal women. There are several surgical procedures, which may also prove helpful.</p>\r\n', 'active', NULL, 'what-are-the-treatment-options-for-stress-incontinence', '2019-08-09 12:47:15', '2019-08-09 12:47:15'),
(25, 'What Are Gallstones?', '<p>When we eat fatty food the gall bladder squeezes the bile through the common bile duct into the intestine. When cholesterol or fat concentration increases in the bile juice, the juice precipitates as stone.</p>\r\n', 'active', NULL, 'what-are-gallstones', '2019-08-09 12:47:23', '2019-08-09 12:47:23'),
(26, 'What Are The Symptoms Of Gallstones?', '<ul>\r\n	<li>Gaseous distension or bloating (gas formation).</li>\r\n	<li>Flatulent dyspepsia (acidity).</li>\r\n	<li>Acute upper abdominal pain along with vomiting and fever. This occurs when a gall stone gets impacted at the neck of the GB.</li>\r\n	<li>Jaundice &ndash; Occurs when a gall stone drops down from the GB into the common bile duct resulting in obstruction to the flow of bile.</li>\r\n	<li>Pancreatitis &ndash; Occurs when the slipped gall stone in the common bile duct irritates the duct of the pancreas gland leading to inflammation of the gland. This is an emergency situation and patient requires admission into the ICU most times.</li>\r\n</ul>\r\n', 'active', NULL, 'what-are-the-symptoms-of-gallstones', '2019-08-09 12:47:39', '2019-08-09 12:47:39'),
(27, 'Is Obesity A Risk Factor For Gallstones?', '<p>Being even moderately overweight increases the risk for developing gallstones. Obesity is a major risk factor for gallstones, especially in women.</p>\r\n', 'active', NULL, 'is-obesity-a-risk-factor-for-gallstones', '2019-08-09 12:47:48', '2019-08-09 12:47:48'),
(28, 'Is Weight–loss Dieting A Risk Factor For Gallstones?', '<p>As the body metabolizes fat during prolonged fasting and rapid weight loss, such as &ldquo;crash diets&rdquo;, it can cause gallstones.</p>\r\n', 'active', NULL, 'is-weight–loss-dieting-a-risk-factor-for-gallstones', '2019-08-09 12:47:56', '2019-08-09 12:47:56'),
(29, 'What Is The Treatment For Gallstones?', '<p>Silent gallstones are usually left alone and sometimes they disappear on their own. Symptomatic gallstones are usually treated. The most common treatment is surgery to remove the gallbladder. This operation is called a cholecystectomy. This is done through laparoscopy. In other cases, drugs are used to dissolve the gallstones. Your doctor can help determine which option is best for you.</p>\r\n', 'active', NULL, 'what-is-the-treatment-for-gallstones', '2019-08-09 12:48:05', '2019-08-09 12:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_files`
--

CREATE TABLE `tbl_files` (
  `fid` int(10) UNSIGNED NOT NULL,
  `uid` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `orignal_name` text NOT NULL,
  `mime_type` varchar(255) NOT NULL,
  `file_size` varchar(45) NOT NULL,
  `file_dir` text NOT NULL,
  `file_uri` text NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `gallery_id` int(11) NOT NULL,
  `gallery_title` varchar(255) DEFAULT NULL,
  `image_fids` varchar(150) NOT NULL,
  `status` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_meesho_order`
--

CREATE TABLE `tbl_meesho_order` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `address` varchar(555) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `shipping_partner` varchar(255) DEFAULT NULL,
  `shipping_id` varchar(255) DEFAULT NULL,
  `order_date` varchar(255) DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `payment_method` varchar(100) NOT NULL COMMENT 'cod,online',
  `payment_status` int(10) NOT NULL COMMENT '0:Pending\r\n1:Received ',
  `order_status` int(11) NOT NULL DEFAULT 0 COMMENT '0:Ordered\r\n1:Shipped \r\n2:Cancelled\r\n3:Delivered\r\n4:Returned',
  `return_status` int(10) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `nid` int(11) NOT NULL,
  `n_title` varchar(255) NOT NULL,
  `n_desc` mediumtext DEFAULT NULL,
  `image_fids` varchar(50) DEFAULT NULL,
  `url_slug` varchar(255) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `h1_tag` varchar(200) DEFAULT NULL,
  `meta_title` varchar(200) DEFAULT NULL,
  `meta_desc` varchar(200) DEFAULT NULL,
  `additional_tag` varchar(500) DEFAULT NULL,
  `image_title` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`nid`, `n_title`, `n_desc`, `image_fids`, `url_slug`, `status`, `h1_tag`, `meta_title`, `meta_desc`, `additional_tag`, `image_title`, `image_alt`, `date_added`, `date_modified`) VALUES
(1, 'efdsfsdfsd', '<p>sfdgdfgdfgd</p>\r\n', 'null', 'sdfsdf', 'active', 'sdfsd', 'sdfsd', 'sdfsdf', '', NULL, NULL, '2019-01-03 12:20:13', '2019-01-03 12:20:13'),
(2, 'World\'s best hospital', '<p>World&#39;s best hospital</p>\r\n', '[\"1\"]', 'hospitalsssssss', 'active', 'World\'s best hospital', 'World\'s best hospital', 'World\'s best hospital', '', NULL, NULL, '2019-01-03 13:17:49', '2019-01-03 13:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(30) NOT NULL,
  `address_id` int(11) NOT NULL,
  `total_items` int(11) NOT NULL,
  `order_subtotal` float NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `uname` varchar(255) DEFAULT NULL,
  `uemail` varchar(255) DEFAULT NULL,
  `uphone` varchar(255) DEFAULT NULL,
  `ucompany` varchar(255) DEFAULT NULL,
  `udescription` text DEFAULT NULL,
  `wallet_amount` float NOT NULL,
  `total_amount` float NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 0 COMMENT '0:placed 1:Dispatched 2:Out for delivery 3:Delivered',
  `payment_method` varchar(10) DEFAULT NULL COMMENT 'cod,razorpay',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `invoice_no`, `address_id`, `total_items`, `order_subtotal`, `uid`, `uname`, `uemail`, `uphone`, `ucompany`, `udescription`, `wallet_amount`, `total_amount`, `order_status`, `payment_method`, `date_added`, `date_modified`) VALUES
(5, 'wfpKjy0un7', 1, 1, 100, '', 'manish kumar', 'aadya@gmail.com', '9988776655', 'aadya e travel', 'ADS', 0, 100, 0, 'cod', '2020-11-23 09:06:24', '2020-11-23 09:06:24'),
(6, 'VRwTztmbDH', 1, 2, 650, '', 'AMAR SAXENA', 'amar@gmail.com', '0099887766', 'AMAR TRAVELS', 'no description', 0, 650, 0, 'cod', '2020-11-23 09:07:29', '2020-11-23 09:07:29'),
(7, 'qooJsOnKvs', 1, 2, 300, '', 'ajeet kumar', 'aj@gmail.com', '9900998877', 'AJ Creations', 'Smart yet elegant, the John Jacobs full rim round are the perfect archetype of vintage chic. Molded with the marvelous stainless steel material, these round are sturdy yet flexible. They are crafted to influence the ambitious soul. Incredibly comfortable an', 0, 300, 0, 'cod', '2020-11-23 09:10:39', '2020-11-23 09:10:39'),
(8, 'gX50rSk6AG', 1, 1, 600, '', 'manish d', 'aadya@gmail.com', 'dsf', 'dsf', 'dsf', 0, 600, 0, 'cod', '2020-11-26 13:45:06', '2020-11-26 13:45:06'),
(9, 'RLqFFBLNQG', 1, 2, 900, '', 'aman kumar', 'aman@gail.comn', '66582396', 'abc pvt. ltd', 'bna', 0, 900, 0, 'cod', '2020-11-27 07:11:39', '2020-11-27 07:11:39'),
(10, 'wuwmfslviW', 1, 1, 2390, '', 'aman jha', 'sdf@gmail.com', '5552525252', 'yoyo', 'dsfsdf', 0, 2390, 0, 'cod', '2020-12-05 05:12:21', '2020-12-05 05:12:21'),
(11, 'C7U2vJb9Sl', 1, 1, 1995, '', 'Anit Singh', 'galorebay.optic@gmail.com', '09891674844', 'Galorebay Optix (India)', 'thanks for query', 0, 1995, 0, 'cod', '2020-12-13 08:08:43', '2020-12-13 08:08:43'),
(12, 'SN8xk4Rncb', 1, 6, 7920, '', 'arun kumar', 'amai@gmail.com', '9999999999', 'ax', 'hii', 0, 7920, 0, 'cod', '2021-01-14 13:39:16', '2021-01-14 13:39:16'),
(13, 'mr2eEPRWEh', 1, 1, 3490, '', 'Rajesh  Barhate', 'barhate58@gmail.com', '9850935075', 'Patil', 'Hi sir.\nPls send spect frames phots for order my whatsapp 9850935075', 0, 3490, 0, 'cod', '2021-01-18 10:45:24', '2021-01-18 10:45:24'),
(15, 'GAi4Ge5ZDO', 1, 3, 501.5, '28', 'arun kumar', 'amai@gmail.com', '9999999999', 'Arun & co.', 'yess', 0, 2059.3, 0, 'cod', '2021-01-30 05:20:49', '2021-01-30 05:20:49'),
(17, '7FxiniHhd6', 1, 1, 3510.5, '', 'aszd kumar', 'aadya@gmail.com', '9988776655', 'das', 'ZASD', 0, 3510.5, 0, 'cod', '2021-02-01 12:59:44', '2021-02-01 12:59:44'),
(18, 'iPpbGlSwaQ', 1, 1, 3510.5, '', 'ajeet kumar', 'aadya@gmail.com', '2222222222', 'aadya e travel', 'dsfds', 0, 3510.5, 0, 'cod', '2021-02-01 13:00:16', '2021-02-01 13:00:16'),
(19, 'OCfWlAmQTd', 1, 1, 3510.5, '', 'manish asd', 'aadya@gmail.com', '9988776655', 'aadya e travel', 'asd', 0, 3510.5, 0, 'cod', '2021-02-01 13:01:35', '2021-02-01 13:01:35'),
(20, 'VuOknn0P7m', 1, 2, 4368, '', 'sandeep kumar ', 'galorebay.optic@gmail.com', '8810243075', 'Galorebay Optix (India)', 'galorebay', 0, 4368, 0, 'cod', '2021-02-11 05:26:57', '2021-02-11 05:26:57'),
(21, '8dyvOPeWk6', 1, 1, 666.4, '30', 'Sandeep  Kumar', 'galorebayindia@gmail.com', '8810243075', 'Galorebay', 'Galorebay', 0, 666.4, 0, 'cod', '2021-02-12 07:15:03', '2021-02-12 07:15:03'),
(22, 'NqPaAauF9t', 1, 3, 3494.4, '', 'sandeep  kumar', 'info.sandeep20@gmail.com', '8810243075', 'sandy ', 'sandy company', 0, 3494.4, 0, 'cod', '2021-02-14 04:54:54', '2021-02-14 04:54:54'),
(23, 'ptY1lo7fnF', 1, 2, 1310.4, '', 'SANDEEP KUMAR', 'INFO@SANDEEP.COM', '989164484444', 'DANDEEP OPTICAL', '1111', 0, 1310.4, 0, 'cod', '2021-02-14 05:53:19', '2021-02-14 05:53:19'),
(24, '8eg8mbobWy', 1, 2, 1215.2, '30', 'vikram  singh', 'galorebay.optic@gmail.com', '9958206783', 'Galorebay Optix (India)', 'galorebay', 0, 1215.2, 0, 'cod', '2021-02-22 09:57:21', '2021-02-22 09:57:21'),
(25, 'wcJ5FbY3DF', 1, 1, 1999.2, '28', 'manish kumar kumar', 'amit75965@gmail.com', '9865963250', 'XYZ Trading co', 'dcfd', 0, 1999.2, 0, 'cod', '2021-02-24 12:41:52', '2021-02-24 12:41:52'),
(26, 'me46G80Jjp', 1, 1, 666.4, '28', 'manish kumar kuamr', 'amit75965@gmail.com', '9865963250', 'XYZ Trading co', 'asdx', 0, 666.4, 0, 'cod', '2021-02-24 12:43:42', '2021-02-24 12:43:42'),
(30, 'YZYxkPjy2C', 1, 2, 1556.8, '', 'arti jha', 'amit75965@gmail.com', '9988998877', 'ARTI SALES', 'Hii this is testoing', 0, 1556.8, 0, 'cod', '2021-02-25 12:26:01', '2021-02-25 12:26:01'),
(31, 'bdtbtgLq1P', 1, 2, 1556.8, '', 'arti jha', 'amit75965@gmail.com', '9988998877', 'ARTI SALES', 'Hii this is testoing', 0, 1556.8, 0, 'cod', '2021-02-25 12:26:05', '2021-02-25 12:26:05'),
(32, 'jGvqKu1Bcp', 1, 2, 1556.8, '', 'arti jha', 'amit75965@gmail.com', '9988998877', 'ARTI SALES', 'Hii this is testoing', 0, 1556.8, 0, 'cod', '2021-02-25 12:26:16', '2021-02-25 12:26:16'),
(33, 'mcyIkoARJg', 1, 2, 1556.8, '', 'arti jha', 'amit75965@gmail.com', '9988998877', 'ARTI SALES', 'Hii this is testoing', 0, 1556.8, 0, 'cod', '2021-02-25 12:30:37', '2021-02-25 12:30:37'),
(34, '2TrBVUhk4S', 1, 2, 1556.8, '', 'aman saxena', 'amit75965@gmail.com', '9865963250', 'a', 'hello', 0, 1556.8, 0, 'cod', '2021-02-25 12:42:06', '2021-02-25 12:42:06'),
(35, 'Ius2PzMA4F', 1, 2, 1556.8, '', 'arun kumar', 'amit75965@gmail.com', '9999999999', 'a', 'hello', 0, 1556.8, 0, 'cod', '2021-02-25 12:49:03', '2021-02-25 12:49:03'),
(36, 'oWTTXf2yQQ', 1, 2, 1556.8, '', 'arun kumar', 'amit75965@gmail.com', '9999999999', 'a', 'hello', 0, 1556.8, 0, 'cod', '2021-02-25 12:52:39', '2021-02-25 12:52:39'),
(37, 'gl5pfhNaEY', 1, 2, 1556.8, '', 'naman kumar', 'amit75965@gmail.com', '09865963250', 'a', 'dfas', 0, 1556.8, 0, 'cod', '2021-02-25 12:55:36', '2021-02-25 12:55:36'),
(38, 'q19aOMHops', 1, 2, 1780.8, '30', 'Vikramjit Singh bajaj', 'vikramjitsinghbajaj@gmail.com', '9958206783', 'Galorebay optix', 'send asap', 0, 1780.8, 0, 'cod', '2021-02-27 06:05:44', '2021-02-27 06:05:44'),
(39, 'eVEwJdpQW3', 1, 1, 460.2, '30', 'Vikramjit Singh Bajaj', 'vikramjitsinghbajaj@gmail.com', '9958206783', 'Galorebay optix', 'Hi', 0, 460.2, 0, 'cod', '2021-02-27 06:44:02', '2021-02-27 06:44:02'),
(40, 'SMvn1rq4Za', 1, 1, 3572.8, '91', 'aman saxena', 'amai@gmail.com', '9865963250', 'a', 't', 0, 3572.8, 0, 'cod', '2021-03-02 11:05:05', '2021-03-02 11:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_address`
--

CREATE TABLE `tbl_order_address` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `addressline` varchar(100) NOT NULL,
  `addressline2` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(11) NOT NULL,
  `zipcode` varchar(12) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_items`
--

CREATE TABLE `tbl_order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `item_price` float NOT NULL,
  `item_tax` int(10) DEFAULT NULL,
  `item_discounted_price` float DEFAULT NULL,
  `item_qnty` int(11) NOT NULL,
  `item_size` text DEFAULT NULL,
  `item_color` text DEFAULT NULL,
  `item_shape` text DEFAULT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_items`
--

INSERT INTO `tbl_order_items` (`id`, `order_id`, `item_id`, `item_name`, `item_price`, `item_tax`, `item_discounted_price`, `item_qnty`, `item_size`, `item_color`, `item_shape`, `date_added`) VALUES
(4, 5, 1, 'John Jacobs Computer Glasses', 100, NULL, NULL, 1, 'Medium', 'green', 'rectangle', '2020-11-23 09:06:24'),
(5, 6, 2, 'Vincent Chase Computer Glasses', 200, NULL, NULL, 1, 'Small', 'green', 'rectangle', '2020-11-23 09:07:29'),
(6, 6, 3, 'Vincent Chase Computer Glasses fine grey', 450, NULL, NULL, 1, 'Medium', 'yellow', 'rectangle', '2020-11-23 09:07:29'),
(7, 7, 2, 'Vincent Chase Computer Glasses', 200, NULL, NULL, 1, 'Small', 'green', 'rectangle', '2020-11-23 09:10:39'),
(8, 7, 1, 'John Jacobs Computer Glasses', 100, NULL, NULL, 1, 'Medium', 'green', 'rectangle', '2020-11-23 09:10:39'),
(9, 8, 2, 'Vincent Chase Computer Glasses', 200, NULL, NULL, 3, 'Small', 'green', 'rectangle', '2020-11-26 13:45:06'),
(10, 9, 1, 'John Jacobs Computer Glasses', 100, NULL, NULL, 3, 'Medium', 'green', 'rectangle', '2020-11-27 07:11:39'),
(11, 9, 2, 'Vincent Chase Computer Glasses', 200, NULL, NULL, 3, 'Small', 'green', 'rectangle', '2020-11-27 07:11:39'),
(12, 10, 14, 'Galorebay Model No.-G110-753', 1195, NULL, NULL, 2, '9', '7', '6', '2020-12-05 05:12:21'),
(13, 11, 183, 'Feather Model No FR-999', 1995, NULL, NULL, 1, '31', '22', '6', '2020-12-13 08:08:43'),
(14, 12, 450, 'Kidstar Model No KSN-6616', 490, NULL, NULL, 3, '194', '68', '6', '2021-01-14 13:39:16'),
(15, 12, 435, 'Trackon Model No TDS-1739', 290, NULL, NULL, 3, '48', '33', '6', '2021-01-14 13:39:16'),
(16, 12, 451, 'Kidstar Model No KSN-6619', 490, NULL, NULL, 3, '195', '68', '4', '2021-01-14 13:39:16'),
(17, 12, 441, 'Kidstar Model No -028', 590, NULL, NULL, 3, '187', '67', '5', '2021-01-14 13:39:16'),
(18, 12, 436, 'Trackon Model No TDS-1740', 290, NULL, NULL, 3, '183', '30', '6', '2021-01-14 13:39:16'),
(19, 12, 444, 'Kidstar Model No KSP-6025', 490, NULL, NULL, 3, '190', '32', '5', '2021-01-14 13:39:16'),
(20, 13, 102, 'Feather Model No FJ-1355', 3490, NULL, NULL, 1, '16', '22', '6', '2021-01-18 10:45:24'),
(24, 15, 463, 'Kidstar Model No KL-6647', 490, 12, NULL, 2, '111', '27', '5', '2021-01-30 05:20:49'),
(25, 15, 464, 'TRACKON MODEL NO TN-001', 390, 18, NULL, 1, '204', '22', '7', '2021-01-30 05:20:49'),
(26, 15, 465, 'TRACKON MODEL NO TN-001', 425, 18, NULL, 1, '204', '22', '7', '2021-01-30 05:20:49'),
(29, 17, 465, 'TRACKON MODEL NO TN-001', 425, 18, NULL, 7, '204', '22', '7', '2021-02-01 12:59:44'),
(30, 18, 465, 'TRACKON MODEL NO TN-001', 425, 18, NULL, 7, '204', '22', '7', '2021-02-01 13:00:16'),
(31, 19, 465, 'TRACKON MODEL NO TN-001', 425, 18, NULL, 7, '204', '22', '7', '2021-02-01 13:01:35'),
(32, 20, 472, 'Caron Model No CNS-9617', 390, 12, NULL, 6, '28', '67', '6', '2021-02-11 05:26:57'),
(33, 20, 472, 'Caron Model No CNS-9617', 390, 12, NULL, 4, '28', '48', '6', '2021-02-11 05:26:57'),
(34, 21, 279, 'Caron Model No - C5D-9260', 595, 12, NULL, 1, '22', '3', '6', '2021-02-12 07:15:03'),
(35, 22, 472, 'Caron Model No CNS-9617', 390, 12, NULL, 3, '28', '48', '6', '2021-02-14 04:54:54'),
(36, 22, 472, 'Caron Model No CNS-9617', 390, 12, NULL, 4, '28', '67', '6', '2021-02-14 04:54:54'),
(37, 22, 472, 'Caron Model No CNS-9617', 390, 12, NULL, 1, '28', '52', '6', '2021-02-14 04:54:54'),
(38, 23, 472, 'Caron Model No CNS-9617', 390, 12, NULL, 1, '28', '67', '6', '2021-02-14 05:53:19'),
(39, 23, 472, 'Caron Model No CNS-9617', 390, 12, NULL, 2, '28', '48', '6', '2021-02-14 05:53:19'),
(40, 24, 519, 'Caron Model No CFA-9201', 595, 12, NULL, 1, '168', '26', '5', '2021-02-22 09:57:21'),
(41, 24, 371, 'Caron Model No CRD-3138', 490, 12, NULL, 1, '144', '48', '6', '2021-02-22 09:57:21'),
(42, 25, 583, 'Caron Model No CSP-9261', 595, 12, NULL, 3, '10', '30', '6', '2021-02-24 12:41:52'),
(43, 26, 583, 'Caron Model No CSP-9261', 595, 12, NULL, 1, '10', '30', '6', '2021-02-24 12:43:42'),
(44, 27, 583, 'Caron Model No CSP-9261', 595, 12, NULL, 1, '10', '30', '6', '2021-02-24 12:44:19'),
(45, 28, 583, 'Caron Model No CSP-9261', 595, 12, NULL, 1, '10', '30', '6', '2021-02-24 12:45:38'),
(46, 29, 583, 'Caron Model No CSP-9261', 595, 12, NULL, 1, '10', '30', '6', '2021-02-24 12:45:42'),
(47, 30, 606, 'Caron Model No JR-0075', 695, 12, NULL, 1, '264', '52', '5', '2021-02-25 12:26:01'),
(48, 30, 607, 'Caron Model No C6L-71015', 695, 12, NULL, 1, '21', '22', '6', '2021-02-25 12:26:01'),
(49, 31, 606, 'Caron Model No JR-0075', 695, 12, NULL, 1, '264', '52', '5', '2021-02-25 12:26:05'),
(50, 31, 607, 'Caron Model No C6L-71015', 695, 12, NULL, 1, '21', '22', '6', '2021-02-25 12:26:05'),
(51, 32, 606, 'Caron Model No JR-0075', 695, 12, NULL, 1, '264', '52', '5', '2021-02-25 12:26:16'),
(52, 32, 607, 'Caron Model No C6L-71015', 695, 12, NULL, 1, '21', '22', '6', '2021-02-25 12:26:16'),
(53, 33, 606, 'Caron Model No JR-0075', 695, 12, NULL, 1, '264', '52', '5', '2021-02-25 12:30:37'),
(54, 33, 607, 'Caron Model No C6L-71015', 695, 12, NULL, 1, '21', '22', '6', '2021-02-25 12:30:37'),
(55, 34, 606, 'Caron Model No JR-0075', 695, 12, NULL, 1, '264', '52', '5', '2021-02-25 12:42:06'),
(56, 34, 607, 'Caron Model No C6L-71015', 695, 12, NULL, 1, '21', '22', '6', '2021-02-25 12:42:06'),
(57, 35, 606, 'Caron Model No JR-0075', 695, 12, NULL, 1, '264', '52', '5', '2021-02-25 12:49:03'),
(58, 35, 607, 'Caron Model No C6L-71015', 695, 12, NULL, 1, '21', '22', '6', '2021-02-25 12:49:03'),
(59, 36, 606, 'Caron Model No JR-0075', 695, 12, NULL, 1, '264', '52', '5', '2021-02-25 12:52:39'),
(60, 36, 607, 'Caron Model No C6L-71015', 695, 12, NULL, 1, '21', '22', '6', '2021-02-25 12:52:39'),
(61, 37, 606, 'Caron Model No JR-0075', 695, 12, NULL, 1, '264', '52', '5', '2021-02-25 12:55:36'),
(62, 37, 607, 'Caron Model No C6L-71015', 695, 12, NULL, 1, '21', '22', '6', '2021-02-25 12:55:36'),
(63, 38, 612, 'Caron Model No C7J-31048', 795, 12, NULL, 1, '175', '24', '7', '2021-02-27 06:05:44'),
(64, 38, 615, 'Caron Model No C7J-31047', 795, 12, NULL, 1, '175', '31', '3', '2021-02-27 06:05:44'),
(65, 39, 464, 'TRACKON MODEL NO-001', 390, 18, NULL, 1, '205', '30', '7', '2021-02-27 06:44:02'),
(66, 40, 109, 'Galorebay Model No-GWO-3118', 3190, 12, NULL, 1, '15', '22', '6', '2021-03-02 11:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_status`
--

CREATE TABLE `tbl_order_status` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_status`
--

INSERT INTO `tbl_order_status` (`id`, `order_id`, `order_status`, `created_at`, `updated_at`) VALUES
(2, 3, 0, '2020-11-23 08:59:04', '2020-11-23 08:59:04'),
(3, 4, 0, '2020-11-23 09:05:10', '2020-11-23 09:05:10'),
(4, 5, 0, '2020-11-23 09:06:24', '2020-11-23 09:06:24'),
(5, 6, 0, '2020-11-23 09:07:29', '2020-11-23 09:07:29'),
(6, 7, 0, '2020-11-23 09:10:39', '2020-11-23 09:10:39'),
(7, 8, 0, '2020-11-26 13:45:06', '2020-11-26 13:45:06'),
(8, 9, 0, '2020-11-27 07:11:39', '2020-11-27 07:11:39'),
(9, 10, 0, '2020-12-05 05:12:21', '2020-12-05 05:12:21'),
(10, 11, 0, '2020-12-13 08:08:43', '2020-12-13 08:08:43'),
(11, 12, 0, '2021-01-14 13:39:16', '2021-01-14 13:39:16'),
(12, 13, 0, '2021-01-18 10:45:24', '2021-01-18 10:45:24'),
(14, 15, 0, '2021-01-30 05:20:49', '2021-01-30 05:20:49'),
(15, 16, 0, '2021-02-01 12:55:16', '2021-02-01 12:55:16'),
(16, 17, 0, '2021-02-01 12:59:44', '2021-02-01 12:59:44'),
(17, 18, 0, '2021-02-01 13:00:16', '2021-02-01 13:00:16'),
(18, 19, 0, '2021-02-01 13:01:35', '2021-02-01 13:01:35'),
(19, 20, 0, '2021-02-11 05:26:57', '2021-02-11 05:26:57'),
(20, 21, 0, '2021-02-12 07:15:03', '2021-02-12 07:15:03'),
(21, 22, 0, '2021-02-14 04:54:54', '2021-02-14 04:54:54'),
(22, 23, 0, '2021-02-14 05:53:19', '2021-02-14 05:53:19'),
(23, 24, 0, '2021-02-22 09:57:21', '2021-02-22 09:57:21'),
(24, 25, 0, '2021-02-24 12:41:52', '2021-02-24 12:41:52'),
(25, 26, 0, '2021-02-24 12:43:42', '2021-02-24 12:43:42'),
(26, 27, 0, '2021-02-24 12:44:19', '2021-02-24 12:44:19'),
(27, 28, 0, '2021-02-24 12:45:38', '2021-02-24 12:45:38'),
(28, 29, 0, '2021-02-24 12:45:42', '2021-02-24 12:45:42'),
(29, 30, 0, '2021-02-25 12:26:01', '2021-02-25 12:26:01'),
(30, 31, 0, '2021-02-25 12:26:05', '2021-02-25 12:26:05'),
(31, 32, 0, '2021-02-25 12:26:16', '2021-02-25 12:26:16'),
(32, 33, 0, '2021-02-25 12:30:37', '2021-02-25 12:30:37'),
(33, 34, 0, '2021-02-25 12:42:06', '2021-02-25 12:42:06'),
(34, 35, 0, '2021-02-25 12:49:03', '2021-02-25 12:49:03'),
(35, 36, 0, '2021-02-25 12:52:39', '2021-02-25 12:52:39'),
(36, 37, 0, '2021-02-25 12:55:36', '2021-02-25 12:55:36'),
(37, 38, 0, '2021-02-27 06:05:44', '2021-02-27 06:05:44'),
(38, 39, 0, '2021-02-27 06:44:02', '2021-02-27 06:44:02'),
(39, 40, 0, '2021-03-02 11:05:05', '2021-03-02 11:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages`
--

CREATE TABLE `tbl_pages` (
  `pages_id` int(11) NOT NULL,
  `pages_title` varchar(255) NOT NULL,
  `pages_desc` text NOT NULL,
  `url_slug` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pages`
--

INSERT INTO `tbl_pages` (`pages_id`, `pages_title`, `pages_desc`, `url_slug`, `status`, `date_added`, `date_modified`) VALUES
(1, 'About us - Homepage', '<p>Worrying about that crown area falling apart? Every day losing on some strands or more? Sit down and relax we at Dbamy brings the solution to all your concerns. We always focus on catering our clients with their wishful wants; to get that perfect &amp; neat look for themselves. We are a one-stop-shop for all your hair related concerns, from hair patches to wigs we do it all. &nbsp;We curate a high-quality hair replacement system that is fully customized, made of super-fine human hair, and has a breathable base that is indistinguishable from your own. Alongside, to continue the development of wigs and hairpieces, we have for you the Dbamy range of wig care products.</p>\r\n\r\n<p>Our products are meticulously crafted to give you that fresh and best look every day.&nbsp;</p>\r\n', 'about-us-homepage', 'active', '2018-12-13 08:25:22', '2020-09-25 10:10:13'),
(2, 'About us', '<p>red blue&nbsp;</p>\r\n', 'about-us', 'active', '2020-08-04 01:56:44', '2020-12-06 06:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pagesmeta`
--

CREATE TABLE `tbl_pagesmeta` (
  `page_id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `pagesmeta_title` varchar(255) DEFAULT NULL,
  `pagesmeta_desc` varchar(255) DEFAULT NULL,
  `h1_text` varchar(255) DEFAULT NULL,
  `url_slug` varchar(255) DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pagesmeta`
--

INSERT INTO `tbl_pagesmeta` (`page_id`, `page_name`, `pagesmeta_title`, `pagesmeta_desc`, `h1_text`, `url_slug`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Home', 'Hello Nature', 'Hello Nature', '', 'home', 'active', '2019-11-04 23:28:59', '2020-07-31 22:16:32'),
(2, 'Downloads', 'Hello Nature', 'Hello Nature', '', 'downloads', 'active', '2019-11-04 23:31:03', '2019-11-05 00:50:14'),
(3, 'Videos', 'Hello Nature', 'Hello Nature', '', 'videos', 'active', '2019-11-04 23:32:16', '2019-11-04 23:32:16'),
(4, 'Careers', 'Hello Nature', 'Hello Nature', '', 'careers', 'active', '2019-11-04 23:33:13', '2019-11-04 23:33:13'),
(5, 'About us', 'Hello Nature', 'Hello Nature', '', 'about-us', 'active', '2019-11-04 23:34:09', '2019-11-04 23:34:09'),
(6, 'Contact us', 'Hello Nature', 'Hello Nature', '', 'contact-us', 'active', '2019-11-04 23:34:59', '2019-11-04 23:34:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pid` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `brand_id` int(10) DEFAULT NULL,
  `cat_id` int(10) DEFAULT NULL,
  `image_fids` varchar(255) DEFAULT NULL,
  `supplier_cost` varchar(150) DEFAULT NULL,
  `mrp` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  `catalogue_id` varchar(100) NOT NULL,
  `product_id` varchar(100) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `hsn` int(10) NOT NULL DEFAULT 0 COMMENT '0: NO 1: YES',
  `gst_percentage` int(10) DEFAULT 0 COMMENT '0: NO 1: YES 	',
  `status` varchar(15) NOT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `product_size` varchar(255) DEFAULT NULL,
  `product_desc` text DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `url_slug` varchar(555) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pid`, `product_name`, `brand_id`, `cat_id`, `image_fids`, `supplier_cost`, `mrp`, `price`, `catalogue_id`, `product_id`, `sku`, `hsn`, `gst_percentage`, `status`, `weight`, `product_size`, `product_desc`, `platform`, `url_slug`, `date_added`, `date_modified`) VALUES
(25, 'Galorebay Model No - G110-739', 18, 50, '[\"184\"]', '100', 0, 1195, '1195', '2', '6', 0, 0, 'active', '28', '30,33,34,36,37', 'Male', 'meesho', 'galorebay-model-no-g110739', '2020-12-06 08:27:37', '2021-02-09 09:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productcolor`
--

CREATE TABLE `tbl_productcolor` (
  `color_id` int(10) NOT NULL,
  `color_name` varchar(100) DEFAULT NULL,
  `color_type` varchar(100) DEFAULT NULL,
  `color_value1` varchar(100) DEFAULT NULL,
  `color_value2` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `last_modified_date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_productcolor`
--

INSERT INTO `tbl_productcolor` (`color_id`, `color_name`, `color_type`, `color_value1`, `color_value2`, `status`, `last_modified_date`) VALUES
(2, 'GREEN', 'single', '#008000', '', 'active', '2020-12-06 06:28:41'),
(3, 'RED', 'single', '#ff0000', '', 'active', '2020-12-06 05:54:06'),
(22, 'GOLD', 'single', '#ffd700', '', 'active', '2020-12-06 06:27:58'),
(23, 'GOLD/RED', 'dual', '#ffd700', '#ff0000', 'active', '2020-12-06 10:01:16'),
(24, 'GOLD/BLACK', 'dual', '#ffd700', '#000000', 'active', '2020-12-06 10:00:58'),
(25, 'GOLD/GUN', 'dual', '#ffd700', '#808080', 'active', '2020-12-06 06:26:55'),
(26, 'GOLD/BROWN', 'dual', '#ffd700', '#a52a2a', 'active', '2020-12-06 06:26:39'),
(27, 'PINK', 'single', '#ffc0cb', '', 'active', '2020-12-05 12:52:40'),
(28, 'SILVER/WHITE', 'dual', '#c0c0c0', '#ffffff', 'active', '2020-12-06 06:26:25'),
(29, 'GUN/GOLD', 'dual', '#808080', '#ffd700', 'active', '2020-12-06 06:26:02'),
(30, 'BLACK', 'single', '#000000', '', 'active', '2020-12-05 12:54:43'),
(31, 'SILVER', 'single', '#c0c0c0', '', 'active', '2020-12-05 12:55:27'),
(32, 'BLACK/BLUE', 'dual', '#000000', '#0000ff', 'active', '2020-12-06 06:25:47'),
(33, 'BROWN', 'single', '#a52a2a', '', 'active', '2020-12-05 12:56:21'),
(34, 'GUN', 'single', '#808080', '', 'active', '2020-12-05 12:56:47'),
(35, 'WHITE', 'single', '#ffffff', '', 'active', '2020-12-05 13:26:09'),
(36, 'BLUE', 'single', '#0000ff', '', 'active', '2020-12-05 12:57:58'),
(37, 'WINE', 'single', '#800000', '', 'active', '2020-12-05 12:59:48'),
(38, 'PURPLE', 'single', '#800080', '', 'active', '2020-12-05 13:00:06'),
(39, 'BROWN/GOLD', 'dual', '#a52a2a', '#ffd700', 'active', '2020-12-06 06:24:06'),
(40, 'GUN/BLUE', 'dual', '#808080', '#0000ff', 'active', '2020-12-06 06:25:26'),
(41, 'SILVER/BLACK', 'dual', '#c0c0c0', '#000000', 'active', '2020-12-06 06:25:12'),
(42, 'SILVER/BLUE', 'dual', '#c0c0c0', '#0000ff', 'active', '2020-12-06 06:24:54'),
(43, 'SILVER/WINE', 'dual', '#c0c0c0', '#800000', 'active', '2020-12-06 06:24:30'),
(44, 'SILVER/BROWN', 'dual', '#c0c0c0', '#a52a2a', 'active', '2020-12-06 06:23:21'),
(45, 'BLACK/SILVER', 'dual', '#000000', '#c0c0c0', 'active', '2020-12-06 06:23:04'),
(46, 'BLACK/WINE', 'dual', '#000000', '#800000', 'active', '2020-12-06 06:22:46'),
(47, 'GUN/BLACK', 'dual', '#808080', '#000000', 'active', '2020-12-06 06:22:32'),
(48, 'M.BLUE', 'single', '#2020e1', '', 'active', '2020-12-05 13:06:05'),
(49, 'S.BLUE', 'single', '#0000ff', '', 'active', '2020-12-05 13:12:25'),
(50, 'M.BROWN', 'single', '#a52a2a', '', 'active', '2020-12-05 13:16:42'),
(52, 'S.BROWN', 'single', '#a52a2a', '', 'active', '2020-12-05 13:17:15'),
(53, 'BLACK/GUN', 'dual', '#000000', '#808080', 'active', '2020-12-06 06:21:47'),
(54, 'BLUE/GUN', 'dual', '#0000ff', '#808080', 'active', '2020-12-06 06:21:34'),
(55, 'BLACK/GOLD', 'dual', '#000000', '#ffd700', 'active', '2020-12-06 10:02:12'),
(56, 'GUN/SILVER', 'dual', '#808080', '#c0c0c0', 'active', '2020-12-06 06:20:45'),
(57, 'BLUE/SILVER', 'dual', '#0000ff', '#c0c0c0', 'active', '2020-12-06 06:20:32'),
(58, 'BLACK/RED', 'dual', '#000000', '#ff0000', 'active', '2020-12-06 06:20:00'),
(59, 'BLACK/YELLOW', 'dual', '#000000', '#ffff00', 'active', '2020-12-06 06:19:41'),
(60, 'BLUE/RED', 'dual', '#0000ff', '#ff0000', 'active', '2020-12-06 06:19:09'),
(61, 'BROWN/DA', 'dual', '#a52a2a', 'rgba(165,42,42,0.64)', 'active', '2020-12-06 06:18:31'),
(62, 'BLACK/GREY', 'dual', '#000000', '#808080', 'active', '2020-12-06 06:16:05'),
(63, 'BLACK/PINK', 'dual', '#000000', '#ff1493', 'active', '2020-12-06 06:15:30'),
(64, 'BLACK/WHITE', 'dual', '#000000', '#ffffff', 'active', '2020-12-06 06:14:41'),
(65, 'BLACK/PURPLE', 'dual', '#000000', '#800080', 'active', '2020-12-06 06:14:23'),
(66, 'TRANSPARENT', 'single', 'transparent', '', 'active', '2020-12-05 13:27:08'),
(67, 'M.BLACK', 'single', '#000000', '', 'active', '2020-12-05 13:27:38'),
(68, 'S.BLACK', 'single', '#000000', '', 'active', '2020-12-06 06:12:34'),
(69, 'GOLD/WHITE', 'dual', '#ffd700', '#ffffff', 'active', '2020-12-06 10:02:24'),
(70, 'LIGHT GOLD', 'single', '#e8d1d1', '', 'active', '2020-12-06 11:10:04'),
(71, 'SILVER/PURPLE', 'dual', '#c0c0c0', '#800080', 'active', '2020-12-06 12:21:15'),
(72, 'BLUE/WHITE', 'dual', '#0000ff', '#ffffff', 'active', '2020-12-06 12:29:46'),
(73, 'WINE/WHITE', 'dual', '#800000', '#ffffff', 'active', '2020-12-06 12:30:10'),
(74, 'S. DA', 'single', '#ffbf00', '', 'active', '2020-12-06 12:49:45'),
(75, 'M. DA', 'single', '#f3cb53', '', 'active', '2020-12-06 12:50:05'),
(76, 'DA', 'single', '#dfa700', '', 'active', '2020-12-06 12:50:24'),
(77, 'SILVER/GUN', 'dual', '#c0c0c0', '#808080', 'active', '2020-12-07 06:39:52'),
(78, 'M.BLACK/RED', 'dual', '#000000', '#ff0000', 'active', '2020-12-07 07:28:55'),
(79, 'S.BLACK/RED', 'dual', '#000000', '#ff0000', 'active', '2020-12-07 07:29:16'),
(80, 'M.BLACK/GUN', 'dual', '#000000', '#808080', 'active', '2020-12-07 07:37:10'),
(81, 'S.BLACK/GUN', 'dual', '#000000', '#808080', 'active', '2020-12-07 07:55:06'),
(82, 'S.BLACK/BLUE', 'dual', '#000000', '#0000ff', 'active', '2020-12-07 07:57:27'),
(83, 'M.BLACK/BLUE', 'dual', '#000000', '#0000ff', 'active', '2020-12-07 07:57:46'),
(84, 'MIX', 'single', 'rgba(183,110,121,0.62)', '', 'active', '2020-12-07 08:32:36'),
(85, 'GREY', 'single', '#808080', '', 'active', '2020-12-07 08:34:36'),
(86, 'M.GREY', 'single', '#aa99aa', '', 'active', '2020-12-07 10:50:52'),
(87, 'M.WINE', 'single', '#8c0034', '', 'active', '2020-12-07 10:50:42'),
(88, 'M.BLACK/WINE', 'dual', '#000000', '#722f37', 'active', '2020-12-07 10:52:45'),
(89, 'S.BR./GOLD', 'dual', '#a52a2a', '#ffd700', 'active', '2020-12-08 06:45:07'),
(90, 'S.BL/SILVER', 'dual', '#000000', '#c0c0c0', 'active', '2020-12-08 06:47:06'),
(91, 'BROWN/X RAY', 'dual', '#a52a2a', '#b5651d', 'active', '2020-12-08 06:50:00'),
(92, 'S.BLACK/GOLD', 'dual', '#000000', '#ffd700', 'active', '2021-01-06 11:38:06'),
(93, 'S.BLACK/BROWN', 'dual', '#000000', '#a52a2a', 'active', '2020-12-08 06:51:01'),
(94, 'S.BLACK/PURPLE', 'dual', '#000000', '#800080', 'active', '2020-12-08 06:51:37'),
(95, 'S.BLACK/WINE', 'dual', '#000000', '#9f0202', 'active', '2020-12-08 06:52:40'),
(96, 'M.BLACK/GOLD', 'dual', '#000000', 'GOLD', 'active', '2020-12-08 07:18:53'),
(97, 'M.PURPLE', 'single', '#800080', '', 'active', '2020-12-08 07:36:59'),
(98, 'S.PURPLE', 'single', '#800080', '', 'active', '2020-12-08 07:37:15'),
(99, 'S.BLACK/SILVER', 'dual', '#000000', '#c0c0c0', 'active', '2020-12-08 07:38:57'),
(100, 'M.BLACK/SILVER', 'dual', '#000000', 'SILVER', 'active', '2020-12-08 07:39:54'),
(101, 'BLACK/WINE', 'dual', '#000000', '#bb3636', 'active', '2020-12-08 07:40:22'),
(102, 'L.BROWN', 'single', 'rgba(241,154,154,0.76)', '', 'active', '2020-12-08 07:42:36'),
(103, 'S.GREY', 'single', '#808080', '', 'active', '2020-12-08 07:44:39'),
(105, 'D.BROWN', 'single', '#5a1313', '', 'active', '2020-12-08 07:48:29'),
(106, 'M.BROWN/GOLD', 'dual', '#a52a2a', '#ffd700', 'active', '2020-12-08 07:49:18'),
(107, 'S.BROWN/XRAY', 'dual', '#a52a2a', '#f1c8c8', 'active', '2020-12-08 07:50:01'),
(108, 'WINE/BLACK', 'dual', '#800000', '#000000', 'active', '2020-12-08 08:01:36'),
(109, 'S.BLUE/RED', 'dual', '#1515ac', 'RED', 'active', '2020-12-08 11:07:42'),
(110, 'SILVER/GREEN', 'dual', '#c0c0c0', 'rgba(0,128,0,0.69)', 'active', '2020-12-08 12:15:52'),
(111, 'BLACK/GREEN', 'dual', '#000000', '#008000', 'active', '2020-12-08 12:18:06'),
(112, 'GUN/GREY', 'dual', '#000000', 'GREY', 'active', '2020-12-08 12:38:07'),
(113, 'S.WINE', 'single', '#800000', '', 'active', '2020-12-08 12:38:34'),
(114, 'GOLD/DA', 'dual', '#ffd700', '#dfa700', 'active', '2020-12-08 13:39:30'),
(115, 'L.GOLD', 'single', 'rgba(255,215,0,0.59)', '', 'active', '2020-12-10 05:57:35'),
(116, 'M.WINE/BLACK', 'dual', '#800000', '#000000', 'active', '2020-12-10 06:09:29'),
(117, 'S.WINE/BLACK', 'dual', '#800000', '#000000', 'active', '2020-12-10 06:09:49'),
(118, 'DA/GOLD', 'dual', '#dfa700', '#ffd700', 'active', '2020-12-10 08:30:39'),
(119, 'BLACK/BROWN', 'dual', '#000000', '#a52a2a', 'active', '2020-12-10 11:25:31'),
(120, 'GUN/PURPLE', 'dual', '#808080', '#800080', 'active', '2021-01-06 11:38:32'),
(121, 'BROWN/BLACK', 'dual', '#a52a2a', '#000000', 'active', '2021-01-06 11:52:28'),
(122, 'D. GREY', 'single', '#504a4a', '', 'active', '2021-02-21 05:50:13'),
(123, 'L.GREY', 'single', '#aca5a5', '', 'active', '2021-02-21 05:50:48'),
(124, 'D.BLUE', 'single', '#004f83', '', 'active', '2021-02-21 06:03:18'),
(125, 'L.BROWN', 'single', '#9a2d4d', '', 'active', '2021-02-21 06:04:10'),
(126, 'L.PURPLE', 'single', '#b19cd9', '', 'active', '2021-02-21 06:05:27'),
(127, 'L.BLUE', 'single', '#78bce6', '', 'active', '2021-02-21 06:18:18'),
(128, 'D.PURPLE', 'single', '#60346a', '', 'active', '2021-02-21 06:19:20'),
(129, 'GREY/YELLOW', 'dual', '#645c5c', '#ffff00', 'active', '2021-02-21 06:20:06'),
(130, 'BLACK/S.GREEN', 'dual', '#000000', '#b0dcb0', 'active', '2021-02-21 06:47:21'),
(131, 'BROWN/GREEN', 'dual', '#ae0000', 'GREEN', 'active', '2021-02-21 06:55:29'),
(132, 'GUN/RED', 'dual', '#746f6f', '#ff0000', 'active', '2021-02-22 05:56:50'),
(133, 'M.BLACK/GREEN', 'dual', '#000000', '#008000', 'active', '2021-02-22 11:32:57'),
(134, 'L.BLACK/BLUE', 'dual', '#6f6e6e', '#0000ff', 'active', '2021-02-22 11:33:48'),
(135, 'BLACK/L.GREEN', 'dual', '#000000', '#aef26f', 'active', '2021-02-25 06:07:48'),
(136, 'BLACK/D.GREEN', 'dual', '#000000', '#377900', 'active', '2021-02-25 06:08:32'),
(137, 'GREY/WHITE', 'dual', '#ac9d9d', '#ffffff', 'active', '2021-02-25 06:09:15'),
(138, 'BLACK/GRADLE', 'dual', '#000000', '#000000', 'active', '2021-02-25 06:34:31'),
(139, 'M.BLACK/BROWN', 'dual', '#000000', '#a52a2a', 'active', '2021-02-25 06:37:42'),
(140, 'GREY/GRADLE', 'dual', '#000000', '#000000', 'active', '2021-02-25 06:55:37'),
(141, 'BLUE/GRADLE', 'dual', '#0000ff', '#000000', 'active', '2021-02-25 07:06:06'),
(142, 'RED/DA', 'dual', '#ff0000', '#000000', 'active', '2021-02-25 07:22:44'),
(143, 'PURPLE/DA', 'dual', '#800080', '#000000', 'active', '2021-02-25 07:23:39'),
(144, 'BLUE/PINK', 'dual', '#0000ff', '#ffc0cb', 'active', '2021-02-25 09:47:10'),
(145, 'S.BROWN/GUN', 'dual', '#000000', '#000000', 'active', '2021-02-25 09:56:55'),
(146, 'M.BLUE/BLACK', 'dual', '#000000', '#000000', 'active', '2021-02-25 09:57:49'),
(148, 'GREY/GUN', 'dual', '#000000', '#000000', 'active', '2021-02-26 06:20:34'),
(149, 'BLACK/L.GOLD', 'dual', '#000000', '#000000', 'active', '2021-02-26 06:25:16'),
(150, 'WINE/SILVER', 'dual', '#000000', '#c0c0c0', 'active', '2021-02-26 06:36:17'),
(151, 'GREY/GOLD', 'dual', '#000000', '#ffd700', 'active', '2021-02-26 06:36:52'),
(152, 'M.GOLD', 'single', '#000000', '', 'active', '2021-02-26 06:55:12'),
(153, 'SILVER/GOLD', 'dual', '#c0c0c0', '#ffd700', 'active', '2021-02-26 06:56:12'),
(154, 'GUN/BROWN', 'dual', '#000000', '#a52a2a', 'active', '2021-02-26 07:04:20'),
(155, 'L.GUN', 'single', '#000000', '', 'active', '2021-02-26 07:22:05'),
(156, 'D.GUN', 'single', '#000000', '', 'active', '2021-02-26 07:22:28'),
(157, 'S.BROWN/BLACK', 'dual', '#000000', '#000000', 'active', '2021-02-27 07:36:27'),
(158, 'S.BROWN/GOLD', 'dual', '#000000', '#ffd700', 'active', '2021-02-27 07:37:03'),
(159, 'M.BLACK/GREY', 'dual', '#000000', '#000000', 'active', '2021-02-27 07:37:48'),
(160, 'WINE/L.GOLD', 'dual', '#000000', '#000000', 'active', '2021-02-27 09:50:17'),
(161, 'TRANSPARENT/DA', 'dual', '#ffffff', '#000000', 'active', '2021-02-27 10:32:39'),
(162, 'TRANSPARENT/DA', 'dual', '#ffffff', '#000000', 'active', '2021-02-27 10:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productenquiry`
--

CREATE TABLE `tbl_productenquiry` (
  `eid` int(11) NOT NULL,
  `pid` int(11) NOT NULL COMMENT 'Product id',
  `company` varchar(200) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_productenquiry`
--

INSERT INTO `tbl_productenquiry` (`eid`, `pid`, `company`, `name`, `email`, `phone`, `message`, `date_added`, `date_modified`) VALUES
(1, 78, '6', 'sfdsdfs', 'sdfs@gmaic.com', '9898989899', 'test test test', '0000-00-00 00:00:00', '2019-10-24 09:08:05'),
(2, 83, '1', 'Akshit kumar', 'akshitkumar012@gmail.com', '08368262954', 'I want to buy tuoren Vedio Laryngoscope', '0000-00-00 00:00:00', '2019-11-13 14:52:01'),
(3, 83, '1', 'Akshit kumar', 'akshitkumar012@gmail.com', '08368262954', 'I want to buy tuoren Vedio Laryngoscope', '0000-00-00 00:00:00', '2019-11-13 14:52:04'),
(4, 83, '1', 'Akshit kumar', 'akshitkumar012@gmail.com', '08368262954', 'I want to buy tuoren Vedio Laryngoscope', '0000-00-00 00:00:00', '2019-11-13 14:52:06'),
(5, 86, 'Test', 'Abhishek', 'akak.kumar620@gmail.com', '0123456789', 'test enquiry', '0000-00-00 00:00:00', '2019-11-18 06:44:01'),
(6, 81, 'himed  Technology', 'Jeff', '13066973151@qq.com', '+86 13066973151', 'UV pump', '0000-00-00 00:00:00', '2020-03-06 12:33:14'),
(7, 90, 'MAITREYA ', 'Rajesh shah', 'mumuresh@yahoo.co.in', '91 9377632009', 'Hello \r\nCan u please send me details and price ', '0000-00-00 00:00:00', '2020-04-27 10:21:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productmaterial`
--

CREATE TABLE `tbl_productmaterial` (
  `id` int(10) NOT NULL,
  `material_name` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `last_modified_date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_productmaterial`
--

INSERT INTO `tbl_productmaterial` (`id`, `material_name`, `status`, `last_modified_date`) VALUES
(2, 'Stainless Steel', 'active', '2021-02-14 06:16:29'),
(3, 'TR', 'active', '2020-11-30 13:32:10'),
(4, 'ACETATE', 'active', '2020-11-30 13:32:01'),
(6, 'WOODEN', 'active', '2020-11-30 13:46:19'),
(8, 'TITANIUM', 'active', '2020-11-30 13:45:37'),
(9, 'MONAL', 'active', '2020-11-30 13:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productshape`
--

CREATE TABLE `tbl_productshape` (
  `id` int(10) NOT NULL,
  `product_shape` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `last_modified_date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_productshape`
--

INSERT INTO `tbl_productshape` (`id`, `product_shape`, `status`, `last_modified_date`) VALUES
(2, 'OVAL', 'active', '2020-11-30 13:29:43'),
(3, 'SQUARE', 'active', '2020-11-30 13:29:31'),
(4, 'CAT EYE', 'active', '2020-11-30 13:29:19'),
(5, 'ROUND', 'active', '2020-11-30 13:29:06'),
(6, 'RECTANGLE', 'active', '2020-11-30 13:29:58'),
(7, 'AVAITOR', 'active', '2020-12-06 09:36:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productsize`
--

CREATE TABLE `tbl_productsize` (
  `id` int(10) NOT NULL,
  `product_size` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `last_modified_date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_productsize`
--

INSERT INTO `tbl_productsize` (`id`, `product_size`, `status`, `last_modified_date`) VALUES
(10, '52-18-138', 'active', '2020-12-06 06:00:17'),
(11, '51-18-140', 'active', '2020-12-06 06:00:34'),
(12, '52-18-140', 'active', '2020-12-06 06:00:56'),
(13, '53-17-135', 'active', '2020-12-06 06:01:36'),
(14, '54-17-135', 'active', '2020-12-06 06:01:51'),
(15, '53-18-140', 'active', '2020-12-06 06:02:08'),
(16, '50-18-140', 'active', '2020-12-06 06:02:36'),
(17, '50-17-135', 'active', '2020-12-06 06:03:39'),
(18, '52-16-138', 'active', '2020-12-06 06:03:56'),
(19, '53-16-138', 'active', '2020-12-06 06:04:09'),
(20, '54-17-140', 'active', '2020-12-06 06:04:20'),
(21, '53-18-138', 'active', '2020-12-06 06:04:48'),
(22, '53-17-140', 'active', '2020-12-06 06:05:10'),
(23, '50-17-140', 'active', '2020-12-06 06:05:25'),
(24, '54-18-140', 'active', '2020-12-06 06:05:39'),
(25, '54-16-140', 'active', '2020-12-06 06:06:38'),
(26, '52-18-145', 'active', '2020-12-06 06:06:59'),
(27, '53-18-145', 'active', '2020-12-06 06:07:11'),
(28, '50-18-138', 'active', '2020-12-06 06:07:39'),
(29, '51-18-138', 'active', '2020-12-06 06:07:54'),
(30, '55-17-140', 'active', '2020-12-06 06:08:20'),
(31, '52-17-140', 'active', '2020-12-06 06:10:41'),
(32, '50-18-145', 'active', '2020-12-06 06:11:11'),
(33, '53-19-140', 'active', '2020-12-06 06:12:12'),
(34, '52-19-140', 'active', '2020-12-06 06:12:22'),
(35, '53-19-137', 'active', '2020-12-06 06:12:33'),
(36, '52-19-137', 'active', '2020-12-06 06:12:41'),
(37, '51-18-145', 'active', '2020-12-06 06:16:47'),
(38, '51-16-140', 'active', '2020-12-06 06:48:38'),
(39, '50-19-138', 'active', '2020-12-06 07:51:07'),
(40, '52-19-138', 'active', '2020-12-06 07:56:25'),
(41, '50-19-137', 'active', '2020-12-06 08:20:42'),
(42, '53-15-145', 'active', '2020-12-06 08:37:15'),
(43, '54-17-142', 'active', '2020-12-06 09:24:42'),
(44, '52-18-142', 'active', '2020-12-06 09:42:16'),
(45, '56-15-145', 'active', '2020-12-06 09:52:54'),
(46, '55-18-142', 'active', '2020-12-06 10:13:03'),
(47, '53-18-140', 'active', '2020-12-06 10:13:53'),
(48, '49-18-140', 'active', '2020-12-06 10:29:08'),
(49, '51-17-140', 'active', '2020-12-06 11:12:20'),
(50, '49-18-135', 'active', '2020-12-06 11:24:20'),
(51, '51-19-140', 'active', '2020-12-06 11:30:02'),
(52, '55-16-142', 'active', '2020-12-06 11:50:17'),
(53, '56-18-142', 'active', '2020-12-06 11:53:29'),
(54, '50-18-135', 'active', '2020-12-06 12:02:04'),
(55, '51-18-135', 'active', '2020-12-06 12:17:40'),
(56, '50-16-138', 'active', '2020-12-06 12:22:00'),
(57, '55-18-140', 'active', '2020-12-06 12:32:18'),
(58, '51-19-135', 'active', '2020-12-06 13:02:32'),
(59, '49-17-138', 'active', '2020-12-07 07:37:33'),
(60, '46-17-136', 'active', '2020-12-07 08:02:12'),
(61, '45-17-136', 'active', '2020-12-07 08:02:23'),
(62, '49-17-136', 'active', '2020-12-07 08:02:33'),
(63, '51-17-140', 'active', '2020-12-07 08:02:46'),
(64, '52-17-140', 'active', '2020-12-07 08:03:04'),
(65, '53-16-140', 'active', '2020-12-07 08:24:38'),
(66, '52-16-140', 'active', '2020-12-07 08:24:56'),
(67, '48-16-130', 'active', '2020-12-07 08:30:21'),
(68, '50-16-130', 'active', '2020-12-07 08:30:32'),
(69, '52-16-130', 'active', '2020-12-07 08:30:44'),
(70, '53-17-145', 'active', '2020-12-07 08:31:23'),
(71, '48-15-135', 'active', '2020-12-07 08:35:46'),
(72, '50-15-135', 'active', '2020-12-07 08:35:56'),
(73, '50-16-135', 'active', '2020-12-07 09:01:35'),
(74, '48-16-135', 'active', '2020-12-07 09:01:47'),
(75, '52-15-135', 'active', '2020-12-07 09:05:24'),
(76, '48-17-135', 'active', '2020-12-07 09:11:35'),
(77, '48-17-130', 'active', '2020-12-07 09:14:16'),
(78, '50-17-130', 'active', '2020-12-07 09:14:25'),
(79, '52-17-130', 'active', '2020-12-07 09:14:35'),
(80, '51-19-142', 'active', '2020-12-07 10:24:32'),
(81, '50-14-140', 'active', '2020-12-07 11:02:40'),
(82, '53-15-140', 'active', '2020-12-07 11:07:10'),
(83, '52-18-135', 'active', '2020-12-07 12:41:51'),
(84, '48-18-140', 'active', '2020-12-07 12:43:03'),
(85, '50-18-140', 'active', '2020-12-07 12:43:13'),
(87, '54-18-135', 'active', '2020-12-07 13:08:24'),
(88, '50-19-135', 'active', '2020-12-07 13:16:01'),
(89, '52-19-135', 'active', '2020-12-07 13:16:11'),
(90, '54-19-135', 'active', '2020-12-07 13:16:19'),
(91, '54-16-145', 'active', '2020-12-07 13:18:03'),
(92, '52-16-145', 'active', '2020-12-07 13:18:14'),
(93, '50-16-145', 'active', '2020-12-07 13:18:24'),
(94, '46-15-125', 'active', '2020-12-07 13:22:38'),
(95, '44-15-125', 'active', '2020-12-07 13:22:50'),
(96, '46-16-125', 'active', '2020-12-07 13:24:16'),
(97, '44-16-125', 'active', '2020-12-07 13:23:10'),
(98, '44-15-120', 'active', '2020-12-07 13:23:19'),
(99, '46-15-120', 'active', '2020-12-07 13:23:35'),
(100, '48-15-125', 'active', '2020-12-07 13:23:45'),
(101, '48-15-120', 'active', '2020-12-07 13:30:31'),
(102, '48-16-125', 'active', '2020-12-07 13:32:31'),
(103, '46-18-125', 'active', '2020-12-08 05:30:43'),
(104, '44-18-125', 'active', '2020-12-08 05:31:02'),
(105, '48-18-125', 'active', '2020-12-08 05:31:36'),
(106, '50-18-125', 'active', '2020-12-08 05:31:49'),
(107, '48-17-125', 'active', '2020-12-08 05:39:06'),
(108, '46-17-130', 'active', '2020-12-08 05:42:42'),
(109, '52-17-135', 'active', '2020-12-08 05:45:02'),
(110, '44-16-130', 'active', '2020-12-08 05:50:59'),
(111, '46-16-130', 'active', '2020-12-08 05:51:58'),
(112, '42-19-125', 'active', '2020-12-08 05:52:18'),
(113, '44-19-125', 'active', '2020-12-08 05:52:29'),
(114, '44-19-130', 'active', '2020-12-08 05:59:22'),
(116, '46-19-130', 'active', '2020-12-08 05:59:33'),
(117, '49-20-145', 'active', '2020-12-08 06:15:43'),
(118, '46-19-143', 'active', '2020-12-08 06:15:53'),
(119, '53-16-145', 'active', '2020-12-08 06:16:09'),
(120, '51-15-134', 'active', '2020-12-08 06:16:20'),
(121, '52-17-145', 'active', '2020-12-08 06:16:42'),
(122, '53-17-139', 'active', '2020-12-08 06:16:54'),
(123, '53-17-138', 'active', '2020-12-08 06:17:07'),
(124, '48-16-132', 'active', '2020-12-08 06:17:19'),
(125, '50-14-127', 'active', '2020-12-08 06:17:31'),
(126, '53-18-142', 'active', '2020-12-08 06:17:43'),
(127, '53-17-141', 'active', '2020-12-08 06:17:56'),
(128, '48-19-145', 'active', '2020-12-08 06:18:33'),
(129, '51-16-145', 'active', '2020-12-08 06:18:48'),
(130, '54-12-140', 'active', '2020-12-08 06:36:32'),
(131, '50-16-140', 'active', '2020-12-08 06:53:11'),
(132, '52-14-140', 'active', '2020-12-08 07:26:31'),
(133, '51-14-140', 'active', '2020-12-08 07:47:01'),
(134, '52-15-143', 'active', '2020-12-08 07:58:59'),
(135, '52-16-143', 'active', '2020-12-08 08:02:29'),
(136, '51-15-143', 'active', '2020-12-08 08:04:52'),
(137, '53-15-147', 'active', '2020-12-08 08:06:31'),
(138, '54-17-141', 'active', '2020-12-08 08:11:07'),
(139, '54-19-145', 'active', '2020-12-08 09:15:12'),
(140, '53-19-145', 'active', '2020-12-08 09:20:11'),
(141, '55-19-145', 'active', '2020-12-08 09:20:20'),
(142, '53-18-135', 'active', '2020-12-08 09:29:25'),
(143, '49-16-130', 'active', '2020-12-08 09:31:56'),
(144, '51-16-130', 'active', '2020-12-08 09:32:12'),
(145, '53-16-130', 'active', '2020-12-08 09:32:24'),
(146, '48-20-135', 'active', '2020-12-08 09:45:19'),
(147, '50-20-135', 'active', '2020-12-08 09:45:27'),
(148, '52-20-135', 'active', '2020-12-08 09:45:37'),
(149, '51-17-135', 'active', '2020-12-08 10:06:39'),
(150, '49-17-135', 'active', '2020-12-08 10:11:07'),
(152, '54-19-140', 'active', '2020-12-08 10:39:49'),
(153, '52-16-140', 'active', '2020-12-08 10:46:29'),
(154, '51-17-145', 'active', '2020-12-08 10:52:40'),
(155, '55-17-145', 'active', '2020-12-08 10:52:48'),
(156, '48-21-130', 'active', '2020-12-08 10:55:59'),
(157, '50-17-135', 'active', '2020-12-08 10:56:15'),
(158, '52-16-135', 'active', '2020-12-08 10:57:38'),
(159, '46-21-135', 'active', '2020-12-08 11:03:12'),
(160, '54-17-136', 'active', '2020-12-08 11:07:58'),
(161, '44-16-120', 'active', '2020-12-08 11:25:22'),
(162, '46-16-120', 'active', '2020-12-08 11:25:32'),
(163, '48-16-120', 'active', '2020-12-08 11:25:42'),
(164, '42-16-125', 'active', '2020-12-08 11:32:32'),
(165, '56-17-140', 'active', '2020-12-08 12:38:03'),
(166, '52-15-140', 'active', '2020-12-08 12:39:37'),
(167, '51-17-138', 'active', '2020-12-08 12:46:36'),
(168, '52-17-138', 'active', '2020-12-08 12:48:16'),
(169, '49-16-140', 'active', '2020-12-08 12:52:32'),
(170, '51-15-140', 'active', '2020-12-08 12:59:14'),
(171, '52-15-138', 'active', '2020-12-08 13:19:20'),
(172, '48-20-140', 'active', '2020-12-08 13:28:56'),
(173, '55-16-140', 'active', '2020-12-10 06:40:46'),
(174, '49-21-140', 'active', '2020-12-10 06:43:14'),
(175, '54-17-145', 'active', '2020-12-10 08:12:04'),
(176, '49-22-140', 'active', '2020-12-10 08:27:54'),
(177, '46-18-140', 'active', '2020-12-10 13:30:02'),
(178, '54-18-138', 'active', '2020-12-12 13:10:36'),
(179, '50-17-138', 'active', '2020-12-30 09:37:13'),
(180, '49-18-138', 'active', '2020-12-30 09:40:22'),
(181, '51-17-138', 'active', '2020-12-30 09:40:38'),
(182, '52-17-138', 'active', '2020-12-30 09:41:09'),
(183, '49-17-140', 'active', '2021-01-06 11:32:16'),
(184, '50-17-140', 'active', '2021-01-06 11:32:25'),
(185, '49-18-140', 'active', '2021-01-06 11:33:01'),
(186, '44-17-128', 'active', '2021-01-12 11:16:18'),
(187, '45-16-125', 'active', '2021-01-12 11:20:44'),
(188, '45-17-130', 'active', '2021-01-12 11:52:11'),
(189, '41-19-125', 'active', '2021-01-12 12:00:06'),
(190, '41-18-125', 'active', '2021-01-12 12:04:15'),
(191, '43-17-125', 'active', '2021-01-12 12:14:25'),
(192, '48-14-130', 'active', '2021-01-12 12:17:09'),
(193, '46-15-130', 'active', '2021-01-12 12:27:04'),
(194, '45-17-129', 'active', '2021-01-12 12:41:46'),
(195, '45-15-125', 'active', '2021-01-12 12:53:53'),
(196, '44-14-130', 'active', '2021-01-16 05:40:41'),
(197, '50-15-130', 'active', '2021-01-16 06:06:55'),
(198, '43-16-130', 'active', '2021-01-16 06:07:06'),
(199, '49-16-130', 'active', '2021-01-16 06:07:18'),
(200, '48-15-130', 'active', '2021-01-16 06:20:39'),
(201, '40-18-120', 'active', '2021-01-16 06:23:39'),
(202, '47-15-130', 'active', '2021-01-16 06:23:49'),
(203, '46-15-130', 'active', '2021-01-16 06:24:00'),
(204, '55', 'active', '2021-01-24 12:25:34'),
(205, '58', 'active', '2021-01-24 12:25:40'),
(206, '55-17-143', 'active', '2021-02-07 12:57:09'),
(207, '50-18-143', 'active', '2021-02-07 12:57:25'),
(208, '48-15-138', 'active', '2021-02-07 13:01:02'),
(209, '51-18-136', 'active', '2021-02-19 14:20:24'),
(210, '40-14-128', 'active', '2021-02-21 05:46:10'),
(211, '47-15-125', 'active', '2021-02-21 05:51:24'),
(212, '44-13-128', 'active', '2021-02-21 05:57:07'),
(213, '46-14-128', 'active', '2021-02-21 05:57:55'),
(214, '47-16-130', 'active', '2021-02-21 05:58:28'),
(215, '45-16-130', 'active', '2021-02-21 05:58:53'),
(216, '43-19-125', 'active', '2021-02-21 05:59:56'),
(217, '41-20-125', 'active', '2021-02-21 06:00:33'),
(218, '44-18-128', 'active', '2021-02-21 06:00:56'),
(219, '45-18-125', 'active', '2021-02-21 06:39:42'),
(220, '60-13-142', 'active', '2021-02-21 12:07:52'),
(221, '51-21-148', 'active', '2021-02-21 12:08:18'),
(222, '55-14-135', 'active', '2021-02-21 12:15:32'),
(223, '66-12-130', 'active', '2021-02-21 12:16:22'),
(224, '55-17-135', 'active', '2021-02-21 12:17:25'),
(225, '59-16-142', 'active', '2021-02-21 12:17:51'),
(227, '53-18-145', 'active', '2021-02-21 12:19:16'),
(228, '55-19-140', 'active', '2021-02-21 12:19:40'),
(229, '56-14-138', 'active', '2021-02-21 12:20:55'),
(230, '55-18-144', 'active', '2021-02-21 12:21:28'),
(231, '58-16-138', 'active', '2021-02-21 12:21:49'),
(232, '62', 'active', '2021-02-21 12:28:30'),
(233, '57-17-140', 'active', '2021-02-21 12:31:42'),
(234, '52-19-140', 'active', '2021-02-21 12:32:42'),
(235, '60-18-130', 'active', '2021-02-21 12:33:21'),
(236, '61-15-130', 'active', '2021-02-21 12:33:38'),
(237, '52-18-136', 'active', '2021-02-22 06:46:50'),
(238, '49-18-136', 'active', '2021-02-22 06:50:28'),
(239, '62-14-130', 'active', '2021-02-23 07:46:16'),
(240, '64-12-124', 'active', '2021-02-23 08:05:00'),
(241, '59-15-145', 'active', '2021-02-23 08:26:24'),
(242, '58-19-142', 'active', '2021-02-23 09:05:58'),
(243, '55-17-142', 'active', '2021-02-23 09:23:01'),
(244, '52-21-143', 'active', '2021-02-23 10:23:48'),
(245, '49', 'active', '2021-02-23 11:05:54'),
(247, '48', 'active', '2021-02-23 11:07:54'),
(248, '51', 'active', '2021-02-23 11:08:05'),
(249, '50', 'active', '2021-02-23 11:08:19'),
(250, '47', 'active', '2021-02-23 11:08:29'),
(251, '52', 'active', '2021-02-23 11:08:39'),
(252, '54', 'active', '2021-02-23 11:08:54'),
(254, '00', 'active', '2021-02-23 11:12:51'),
(255, '46', 'active', '2021-02-23 12:03:40'),
(256, '51-20-143', 'active', '2021-02-25 05:19:32'),
(257, '48-21-139', 'active', '2021-02-25 05:53:57'),
(258, '53-17-132', 'active', '2021-02-25 06:15:18'),
(259, '56-16-142', 'active', '2021-02-25 06:30:58'),
(260, '52-17-142', 'active', '2021-02-25 06:54:15'),
(261, '53-19-138', 'active', '2021-02-25 08:28:37'),
(262, '48-19-138', 'active', '2021-02-25 09:13:46'),
(263, '49-19-140', 'active', '2021-02-25 09:40:38'),
(264, '48-19-135', 'active', '2021-02-25 09:55:50'),
(265, '52-21-145', 'active', '2021-02-26 05:49:11'),
(266, '50-20-145', 'active', '2021-02-26 06:34:59'),
(267, '53-20-145', 'active', '2021-02-26 06:52:25'),
(268, '54-18-142', 'active', '2021-02-27 09:37:11'),
(269, '52-20-140', 'active', '2021-02-27 09:49:11'),
(270, '50-19-140', 'active', '2021-02-27 10:06:31'),
(271, '50-20-140', 'active', '2021-02-27 10:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_producttype`
--

CREATE TABLE `tbl_producttype` (
  `type_id` int(11) NOT NULL,
  `producttype_name` varchar(255) NOT NULL,
  `url_slug` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_producttype`
--

INSERT INTO `tbl_producttype` (`type_id`, `producttype_name`, `url_slug`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Full Rim', 'full-rim', 'active', '2019-10-11 09:52:49', '2019-10-11 09:52:49'),
(2, 'Half Rim', 'half-rim', 'active', '2019-10-14 12:18:14', '2019-10-14 12:18:14'),
(3, 'Rimless', 'rimless', 'active', '2019-10-14 12:18:43', '2020-11-28 07:22:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promocode`
--

CREATE TABLE `tbl_promocode` (
  `id` int(11) NOT NULL,
  `promocode_name` varchar(50) NOT NULL,
  `promocode_on` varchar(10) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `product_id` varchar(500) NOT NULL,
  `promocode_type` varchar(10) NOT NULL,
  `promocode_value` int(11) NOT NULL,
  `promocode_value_limit` int(11) NOT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `usage_limit_per_user` int(11) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_promocode`
--

INSERT INTO `tbl_promocode` (`id`, `promocode_name`, `promocode_on`, `category_id`, `product_id`, `promocode_type`, `promocode_value`, `promocode_value_limit`, `usage_limit`, `usage_limit_per_user`, `start_date`, `expiry_date`, `status`, `date_added`, `date_modified`) VALUES
(1, 'XYZPOP', 'all', '2,1', '1', 'percent', 10, 100, 2, 2, '2020-11-02 02:00:00', '2020-12-16 01:30:00', 'active', '2020-07-30 21:21:34', '2020-11-03 08:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subbrands`
--

CREATE TABLE `tbl_subbrands` (
  `id` int(10) NOT NULL,
  `brand_name` int(100) DEFAULT NULL,
  `sub_brand_name` varchar(255) DEFAULT NULL,
  `image_fids` varchar(255) DEFAULT NULL,
  `url_slug` varchar(255) DEFAULT NULL,
  `meta_title` varchar(100) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subbrands`
--

INSERT INTO `tbl_subbrands` (`id`, `brand_name`, `sub_brand_name`, `image_fids`, `url_slug`, `meta_title`, `meta_desc`, `status`, `date_added`, `date_modified`) VALUES
(13, 13, 'DELUXE', 'null', 'Cashier/deluxe', NULL, NULL, 'active', '2020-12-04 05:50:04', '2020-12-08 09:41:33'),
(14, 15, 'EYE WEAR', 'null', 'kidstar/eye-wear', NULL, NULL, 'active', '2020-12-04 05:51:57', '2020-12-17 11:30:32'),
(15, 15, 'KIDDY', 'null', 'kidstar/kiddy', NULL, NULL, 'active', '2020-12-04 05:52:01', '2020-12-17 11:30:16'),
(17, 14, 'AVAITOR', 'null', 'trackon/avaitor', NULL, NULL, 'active', '2020-12-04 05:56:56', '2020-12-17 11:29:53'),
(18, 14, 'DESIGNER', 'null', 'trackon/designer', NULL, NULL, 'active', '2020-12-04 05:59:56', '2020-12-17 11:29:27'),
(19, 14, 'CP', 'null', 'trackon/cp', NULL, NULL, 'active', '2020-12-04 05:59:59', '2020-12-17 11:28:36'),
(23, 14, 'DELUXE', 'null', 'trackon/deluxe', NULL, NULL, 'active', '2020-12-04 06:02:01', '2020-12-17 11:27:14'),
(26, 16, 'ALUMINIUM SUNGLASS', 'null', 'Caron/aluminium-sunglass', NULL, NULL, 'active', '2020-12-04 06:04:11', '2020-12-08 09:40:58'),
(28, 16, '7 EYE SERIES', 'null', 'Caron/7-eye-series', NULL, NULL, 'active', '2020-12-04 06:05:17', '2020-12-08 09:40:55'),
(29, 16, '6 EYE SERIES', 'null', 'Caron/6-eye-series', NULL, NULL, 'active', '2020-12-04 06:05:19', '2020-12-08 09:40:23'),
(30, 16, 'M-TR', 'null', 'Caron/mtr', NULL, NULL, 'inactive', '2020-12-04 06:05:52', '2020-12-08 09:40:14'),
(31, 16, '5 EYE SERIES', 'null', 'Caron/5-eye-series', NULL, NULL, 'active', '2020-12-04 06:05:55', '2020-12-08 09:40:10'),
(32, 16, 'FASHION EYEWEAR', 'null', 'Caron/fashion-eyewear', NULL, NULL, 'active', '2020-12-04 06:06:46', '2020-12-08 09:40:07'),
(33, 16, 'TR', 'null', 'Caron/tr', NULL, NULL, 'active', '2020-12-04 06:06:49', '2020-12-08 09:40:02'),
(35, 16, 'SUPER', 'null', 'Caron/super', NULL, NULL, 'active', '2020-12-04 06:07:25', '2020-12-08 09:39:46'),
(36, 17, '24KT GOLD PLATED', 'null', 'Feather/24kt-gold-plated', NULL, NULL, 'active', '2020-12-04 06:20:07', '2020-12-08 09:39:42'),
(37, 17, 'TITANIUM', 'null', 'Feather/titanium', NULL, NULL, 'active', '2020-12-04 06:30:05', '2020-12-08 09:39:35'),
(38, 18, 'WOODEN COLLECTION', 'null', 'galorebay/wooden-collection', NULL, NULL, 'active', '2020-12-04 06:30:10', '2020-12-08 09:39:30'),
(39, 18, 'TITANIUM', 'null', 'galorebay/titanium', NULL, NULL, 'active', '2020-12-04 06:32:14', '2020-12-08 09:39:14'),
(40, 18, '17 EYE SERIES', 'null', 'galorebay/17-eye-series', NULL, NULL, 'active', '2020-12-04 06:32:17', '2020-12-08 09:39:04'),
(41, 18, '14 EYE SERIES', 'null', 'galorebay/14-eye-series', NULL, NULL, 'active', '2020-12-04 06:32:51', '2020-12-08 09:38:06'),
(42, 18, '13 EYE SERIES', 'null', 'galorebay/13-eye-series', NULL, NULL, 'active', '2020-12-04 06:32:53', '2020-12-08 09:38:00'),
(44, 18, '12 EYE SERIES', 'null', 'galorebay/12-eye-series', NULL, NULL, 'active', '2020-12-04 06:33:28', '2020-12-08 09:37:55'),
(50, 18, '11 EYE SERIES', 'null', 'galorebay/11-eye-series', NULL, NULL, 'active', '2020-12-08 09:37:20', '2020-12-08 09:37:20'),
(51, 14, 'ACETATE KIDS', 'null', 'trackon/acetate-kids', NULL, NULL, 'active', '2021-02-16 06:11:55', '2021-02-16 06:11:55'),
(52, 14, 'ACETATE FANCY', 'null', 'trackon/acetate-fancy', NULL, NULL, 'active', '2021-02-16 06:17:42', '2021-02-16 06:17:42'),
(53, 14, 'ACETATE VIRGIN', 'null', 'trackon/acetate-virgin', NULL, NULL, 'active', '2021-02-16 06:18:41', '2021-02-16 06:18:41'),
(54, 16, 'SUNGLASS', 'null', 'caron/sunglass', NULL, NULL, 'active', '2021-02-23 05:27:26', '2021-02-23 05:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_team`
--

CREATE TABLE `tbl_team` (
  `team_id` int(11) NOT NULL,
  `team_title` varchar(50) NOT NULL,
  `image_fids` varchar(255) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `team_desc` mediumtext NOT NULL,
  `h1_tag` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `additional_tag` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  `url_slug` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_team`
--

INSERT INTO `tbl_team` (`team_id`, `team_title`, `image_fids`, `designation`, `team_desc`, `h1_tag`, `meta_title`, `meta_desc`, `additional_tag`, `sort_order`, `url_slug`, `status`, `date_added`, `date_modified`) VALUES
(2, 'Dr. Bhim Sen Bansal', '[\"230\"]', 'Chairman & Managing Director', '<p>Dr. Bhim Sen Bansal, popularly known as &lsquo;Father of Lithotripsy in India,&rsquo; is the Chairman &amp; Managing Director, RG Stone Urology &amp; Laparoscopy Hospital &ndash; World&rsquo;s largest chain of Urology Hospitals. Born in 1935 in Delhi, he completed MBBS from SMS Medical College, Jaipur; and FCGP from Delhi. He started as a family physician and continues today as a successful physician.</p>\r\n\r\n<p>Starting as a small stone clinic in Mumbai to the current chain of 16 centres PAN India itself speaks about his passion, passion, and just passion for work! He has been the vital part in getting RG from the sunrise to the sunshine position. Under the guidance of the visionary, RG Stone has many feathers attached to its cap.</p>\r\n\r\n<p>Dr. Bansal&#39;s personal attributes of understanding the current urological scene, business sense, quick analysis, bold decision making and creating teams to disseminate the brand &lsquo;RG Stone&rsquo; were integral to this success and popularity of the group.</p>\r\n\r\n<p>He has been awarded with several prestigious awards including CNBC India Haelthcare Award, Award of Appreciation in USICON (Kolkata 2011), The Sunday Indian Lifetime Achievement Award in Medical Science MEGA EXCELLENCE Awards 2009, Dhanwantari Award, Rashtriya Gaurav Award 1994, Adharshila Award, 21st Century Excellence Award, Father of Lithotripsy Award, Delhi Medical Association lifetime achievement award of ICICI LOMBARD and many more.</p>\r\n', 'Dr. Bhim Sen Bansal', 'Dr. Bhim Sen Bansal', 'Dr. Bhim Sen Bansal', '', 1, 'dr-bhim-sen-bansal', 'active', '2018-12-13 10:49:42', '2019-07-30 09:01:00'),
(3, 'Dr. Manish Bansal', '[\"227\"]', 'Joint Managing Director', '<p>Dr. Manish Bansal was born in 1965 at Delhi. After completing his MBBS from Mysore University, he went to Russia where he completed his PhD in Urology and joined RG Stone Urology &amp; Laparoscopy Hospital as Consultant Urologist in 1990. He was later promoted as Joint Managing Director of the Company.</p>\r\n\r\n<p>Dr. Manish bears strong leadership skills and a passion for excellence. He believes in bringing up a culture that is entrepreneurial, result oriented and patient focused.</p>\r\n\r\n<p>He has performed numerous National &amp; International Live Surgery Workshops. Also, he has diverse and wide ranging experience in Lithotripsy &amp; Endoscopic procedures. He has trained more than 55 Urologists in the field of Endoscopy &amp; Lithotripsy.</p>\r\n', 'Dr. Manish Bansal', 'Dr. Manish Bansal', 'Dr. Manish Bansal', '', 2, '', 'active', '2019-05-27 13:45:59', '2019-07-30 09:00:50'),
(4, 'Hanish Bansal', '[\"228\"]', 'Executive Director', '<p>Hanish Bansal is young, pro-active, energetic and ambitious ED with his unflinching quest to expand the super-specialty hospital chain. Gifted with entrepreneurial powers and sharp acumen, Hanish made major reforms in RG including transition RG Stone Urology &amp; Laparoscopy Hospital from a family-run to a professionally-managed unit, grow in numbers, operations &amp; philosophy; and bring in PE capital.</p>\r\n\r\n<p>With rapid growth, aggressive marketing initiatives, Guinness Record, awards and hard-earned reputations, RG holds many firsts in a country where healthcare is probably the most sensitive industry. &nbsp;However, Hanish Bansal has not yet stopped. In fact, he has only laid the foundation. Still as energetic and hungry as he was 16 years back, Hanish is scripting further plans endlessly.</p>\r\n\r\n<p>For him, in this age and time, even sky is not the limit. Behind his thoughts there is a strategic mind making his next move. And in between those moves and plans, there also lies a bike lover who when overworked would not shy away from zooming his bike across the length and breadth of India.</p>\r\n\r\n<p>He is the recipient of many prestigious awards including the &lsquo;Young Achiever Award&rsquo; by GE Healthcare.</p>\r\n', 'Hanish Bansal', 'Hanish Bansal', 'Hanish Bansal', '', 3, 'hanish-bansal', 'active', '2019-05-27 13:47:34', '2019-07-30 09:00:33'),
(5, 'Avinash Ojha', '[\"229\"]', 'Chief Executive Officer', '<p>AVINASH OJHA is the President &amp; CEO of RG Stone Group, India &#39;s largest network of Urology &amp; Laparoscopy Hospitals. A seasoned healthcare professional with 16 years of experience across diverse functions like medical technology, projects, finance, sales &amp; marketing and operations, Avinash has worked at senior management positions with leading multinationals and Indian organizations. He had a 10 year stint with GE in various roles at GE Healthcare and GE Capital.</p>\r\n\r\n<p>A recipient of many awards, Avinash has special interest in operations &amp; quality and is Six Sigma Green Belt certified. He is a keen reader and travels extensively.</p>\r\n', 'Avinash Ojha', 'Avinash Ojha', 'Avinash Ojha', '', 4, 'avinash-ojha', 'active', '2019-05-27 13:56:50', '2019-07-30 09:00:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_testimonial`
--

CREATE TABLE `tbl_testimonial` (
  `testimonial_id` int(11) NOT NULL,
  `testimonial_title` varchar(255) NOT NULL,
  `testimonial_desc` varchar(500) DEFAULT NULL,
  `image_fids` varchar(150) NOT NULL,
  `status` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_testimonial`
--

INSERT INTO `tbl_testimonial` (`testimonial_id`, `testimonial_title`, `testimonial_desc`, `image_fids`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Kamal Kumar', 'A thorough team of professionals! They delivery what they say, understanding web at the back of their hand, and deliver in time and budget. Strongly recommended! ', '0', 'active', '2018-08-22 14:20:44', '2020-10-28 13:59:33'),
(2, 'Arun Saxena', 'Doors Studio delivered at all fronts. From a world-class UI/UX, robust technology, and amazing understanding of digital marketing. They truly delivered customer delight. Really exceeded my expectations. \r\n      \r\nWell done team!', '0', 'active', '2018-09-11 12:55:08', '2020-10-28 13:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `trid` int(11) NOT NULL,
  `card_holder_name` varchar(255) NOT NULL,
  `merchant_amount` float NOT NULL,
  `merchant_total` float NOT NULL,
  `currency_code` varchar(5) NOT NULL,
  `order_id` int(11) NOT NULL,
  `d_order_id` int(11) NOT NULL,
  `razorpay_payment_id` varchar(20) NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wallet`
--

CREATE TABLE `tbl_wallet` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `amount` float NOT NULL,
  `status` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_wallet`
--

INSERT INTO `tbl_wallet` (`id`, `uid`, `amount`, `status`, `date_added`, `date_modified`) VALUES
(1, 21, 120, '1', '0000-00-00 00:00:00', '2020-11-05 18:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wallet_transactions`
--

CREATE TABLE `tbl_wallet_transactions` (
  `id` int(11) NOT NULL,
  `wallet_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `amount` float NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `amount_type` varchar(10) DEFAULT NULL COMMENT '1:OrderPoints',
  `operation` int(11) NOT NULL DEFAULT 0 COMMENT '0:credit 1:debit',
  `status` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_website_setting`
--

CREATE TABLE `tbl_website_setting` (
  `id` int(11) NOT NULL,
  `var_name` varchar(255) NOT NULL,
  `var_title` varchar(250) NOT NULL,
  `setting_value` varchar(500) NOT NULL,
  `old_setting_value` varchar(500) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_website_setting`
--

INSERT INTO `tbl_website_setting` (`id`, `var_name`, `var_title`, `setting_value`, `old_setting_value`, `date_added`, `date_modified`) VALUES
(1, 'WEBSITE_NAME', 'Website Name', 'SOFTECH', 'SOFTECH', '2015-04-14 16:03:22', '2020-10-06 05:39:07'),
(2, 'RECORDS', 'Records per Page', '10', '10', '2017-08-23 08:49:23', '2017-08-23 08:49:23'),
(3, 'ENQUIRY_EMAIL', 'Enquiry email', 'operation@theglobalsoftech.com', 'operation@theglobalsoftech.com', '2018-12-13 01:52:15', '2020-12-04 07:11:33'),
(4, 'ENQUIRY_NAME', 'Enquiry Name', 'SOFTECH Enquiry', 'SOFTECH Enquiry', '2019-06-28 07:37:29', '2020-10-13 08:15:26'),
(7, 'OFFICE_ADDRESS', 'Address', '<p>Tri Nagar</p>\n', 'test', '2019-11-14 00:49:35', '2020-12-22 01:00:45'),
(19, 'PHONE', 'phone', '+91 9899196259', '+91 9899196259', '2020-12-04 07:15:25', '2021-01-18 17:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_weight_unit`
--

CREATE TABLE `tbl_weight_unit` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_weight_unit`
--

INSERT INTO `tbl_weight_unit` (`id`, `name`, `date_added`, `date_modified`) VALUES
(1, 'g', '2022-02-18 11:11:02', '2022-02-18 15:41:08'),
(2, 'Kg', '2022-02-18 11:11:02', '2022-02-18 15:41:37'),
(3, 'ml', '2022-02-18 11:11:02', '2022-02-18 15:41:37'),
(4, 'pkt', '2022-02-18 11:11:02', '2022-02-18 15:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `id` int(10) NOT NULL,
  `uid` int(10) DEFAULT NULL,
  `pro_id` int(10) DEFAULT NULL,
  `addition_date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`id`, `uid`, `pro_id`, `addition_date`) VALUES
(1, 21, 3, '2020-11-05 14:16:11'),
(2, 21, 1, '2020-11-05 14:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `salutation` varchar(10) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `locations` varchar(150) NOT NULL,
  `departments` varchar(100) NOT NULL,
  `legal_notification_alerts` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `salutation`, `first_name`, `last_name`, `company`, `phone`, `address`, `locations`, `departments`, `legal_notification_alerts`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@softech.com', '', NULL, NULL, NULL, 1268889823, 1645170454, 1, 'Mr', 'Admin', 'istrator', 'ADMIN', '9634640664', '', '1', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nationality`
--
ALTER TABLE `nationality`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_afterbefore`
--
ALTER TABLE `tbl_afterbefore`
  ADD PRIMARY KEY (`afterbefore_id`);

--
-- Indexes for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `tbl_author`
--
ALTER TABLE `tbl_author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `tbl_blogcategory`
--
ALTER TABLE `tbl_blogcategory`
  ADD PRIMARY KEY (`bcat_id`);

--
-- Indexes for table `tbl_blogcomments`
--
ALTER TABLE `tbl_blogcomments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tbl_career`
--
ALTER TABLE `tbl_career`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_careerenquiry`
--
ALTER TABLE `tbl_careerenquiry`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_clients`
--
ALTER TABLE `tbl_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_discount`
--
ALTER TABLE `tbl_discount`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `tbl_enquiry`
--
ALTER TABLE `tbl_enquiry`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `tbl_files`
--
ALTER TABLE `tbl_files`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `tbl_meesho_order`
--
ALTER TABLE `tbl_meesho_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order_address`
--
ALTER TABLE `tbl_order_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order_items`
--
ALTER TABLE `tbl_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order_status`
--
ALTER TABLE `tbl_order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  ADD PRIMARY KEY (`pages_id`);

--
-- Indexes for table `tbl_pagesmeta`
--
ALTER TABLE `tbl_pagesmeta`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `tbl_productcolor`
--
ALTER TABLE `tbl_productcolor`
  ADD UNIQUE KEY `color_id` (`color_id`);

--
-- Indexes for table `tbl_productenquiry`
--
ALTER TABLE `tbl_productenquiry`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `tbl_productmaterial`
--
ALTER TABLE `tbl_productmaterial`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tbl_productshape`
--
ALTER TABLE `tbl_productshape`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tbl_productsize`
--
ALTER TABLE `tbl_productsize`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tbl_producttype`
--
ALTER TABLE `tbl_producttype`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tbl_promocode`
--
ALTER TABLE `tbl_promocode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subbrands`
--
ALTER TABLE `tbl_subbrands`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tbl_team`
--
ALTER TABLE `tbl_team`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `tbl_testimonial`
--
ALTER TABLE `tbl_testimonial`
  ADD PRIMARY KEY (`testimonial_id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`trid`);

--
-- Indexes for table `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wallet_transactions`
--
ALTER TABLE `tbl_wallet_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_website_setting`
--
ALTER TABLE `tbl_website_setting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `var_name` (`var_name`),
  ADD KEY `var_title` (`var_title`);

--
-- Indexes for table `tbl_weight_unit`
--
ALTER TABLE `tbl_weight_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `nationality`
--
ALTER TABLE `nationality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_afterbefore`
--
ALTER TABLE `tbl_afterbefore`
  MODIFY `afterbefore_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_author`
--
ALTER TABLE `tbl_author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_blogcategory`
--
ALTER TABLE `tbl_blogcategory`
  MODIFY `bcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_blogcomments`
--
ALTER TABLE `tbl_blogcomments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_career`
--
ALTER TABLE `tbl_career`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_careerenquiry`
--
ALTER TABLE `tbl_careerenquiry`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_clients`
--
ALTER TABLE `tbl_clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tbl_discount`
--
ALTER TABLE `tbl_discount`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_enquiry`
--
ALTER TABLE `tbl_enquiry`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_files`
--
ALTER TABLE `tbl_files`
  MODIFY `fid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_meesho_order`
--
ALTER TABLE `tbl_meesho_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_order_address`
--
ALTER TABLE `tbl_order_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order_items`
--
ALTER TABLE `tbl_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbl_order_status`
--
ALTER TABLE `tbl_order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  MODIFY `pages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_pagesmeta`
--
ALTER TABLE `tbl_pagesmeta`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=632;

--
-- AUTO_INCREMENT for table `tbl_productcolor`
--
ALTER TABLE `tbl_productcolor`
  MODIFY `color_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `tbl_productenquiry`
--
ALTER TABLE `tbl_productenquiry`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_productmaterial`
--
ALTER TABLE `tbl_productmaterial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_productshape`
--
ALTER TABLE `tbl_productshape`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_productsize`
--
ALTER TABLE `tbl_productsize`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `tbl_producttype`
--
ALTER TABLE `tbl_producttype`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_promocode`
--
ALTER TABLE `tbl_promocode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_subbrands`
--
ALTER TABLE `tbl_subbrands`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_team`
--
ALTER TABLE `tbl_team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_testimonial`
--
ALTER TABLE `tbl_testimonial`
  MODIFY `testimonial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `trid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_wallet_transactions`
--
ALTER TABLE `tbl_wallet_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_website_setting`
--
ALTER TABLE `tbl_website_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_weight_unit`
--
ALTER TABLE `tbl_weight_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
