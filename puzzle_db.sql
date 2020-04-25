-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 25, 2020 at 12:43 PM
-- Server version: 10.3.22-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puzzle_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `action_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `row_id` int(11) DEFAULT NULL,
  `data_before_edit` longtext COLLATE utf8_persian_ci DEFAULT NULL,
  `action_type` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `tblName` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `aid` int(11) NOT NULL,
  `name` mediumtext COLLATE utf8_persian_ci NOT NULL,
  `username` mediumtext COLLATE utf8_persian_ci NOT NULL,
  `password` mediumtext COLLATE utf8_persian_ci NOT NULL,
  `pic` varchar(250) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`aid`, `name`, `username`, `password`, `pic`) VALUES
(1, 'مدیر سیستم', 'admin', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'avatar1.png'),
(2, 'مدیر سیستم 2', 'admin2', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'avatar1.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblBlogs`
--

CREATE TABLE `tblBlogs` (
  `id` int(11) NOT NULL,
  `uri` text COLLATE utf8_persian_ci NOT NULL,
  `title` text COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL,
  `content` longtext COLLATE utf8_persian_ci NOT NULL,
  `index_img` text COLLATE utf8_persian_ci NOT NULL,
  `icon` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tblBlogs`
--

INSERT INTO `tblBlogs` (`id`, `uri`, `title`, `description`, `content`, `index_img`, `icon`) VALUES
(1, 'test-blog', 'وبلاگ تست ', 'خلاصه تست', '&lt;p&gt;محتوای تست&lt;/p&gt;&lt;p&gt;در چند خط&lt;/p&gt;', 'index_img1587534236.png', 'icon1587461417.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblCounters`
--

CREATE TABLE `tblCounters` (
  `counter_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `sign` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `text` varchar(200) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tblCounters`
--

INSERT INTO `tblCounters` (`counter_id`, `number`, `sign`, `text`) VALUES
(1, 100, '+', 'پروژه های تکمیل شده'),
(2, 10, '', 'متخصص در زمینه های تبلیغات و طراحی'),
(3, 1500, '+', 'مشتری راضی'),
(4, 100, '٪', 'نظرات مثبت از سمت مشتریان');

-- --------------------------------------------------------

--
-- Table structure for table `tblFooterSettings`
--

CREATE TABLE `tblFooterSettings` (
  `setting_id` int(11) NOT NULL,
  `tel` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(25) COLLATE utf8_persian_ci NOT NULL,
  `instagram` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  `facebook` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  `twitter` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  `telegram` varchar(500) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tblFooterSettings`
--

INSERT INTO `tblFooterSettings` (`setting_id`, `tel`, `email`, `instagram`, `facebook`, `twitter`, `telegram`) VALUES
(0, '02151045105', 'parsabarati83@gmail.com', 'puzzle', 'puzzlez', 'puzzle', ''),
(0, '02151045105', 'parsabarati83@gmail.com', 'puzzle', 'puzzlez', 'puzzle', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblMidBanners`
--

CREATE TABLE `tblMidBanners` (
  `banner_id` int(11) NOT NULL,
  `title` text COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `btn_text` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `link` varchar(65) COLLATE utf8_persian_ci NOT NULL,
  `image` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tblMidBanners`
--

INSERT INTO `tblMidBanners` (`banner_id`, `title`, `text`, `btn_text`, `link`, `image`) VALUES
(1, 'تیتر', 'تیتر یک', 'دکمه', '', 'image1587396447.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblNewsLetter`
--

CREATE TABLE `tblNewsLetter` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `sdate` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tblNewsLetter`
--

INSERT INTO `tblNewsLetter` (`id`, `email`, `sdate`) VALUES
(2, 'Parsabarati83@gmail.com', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `tblServices`
--

CREATE TABLE `tblServices` (
  `service_id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `image` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tblServices`
--

INSERT INTO `tblServices` (`service_id`, `title`, `icon`, `image`, `text`) VALUES
(1, 'تیزر سازی ', 'icon1587390798.png', 'image1587390836.png', '&lt;p&gt;تست&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `tblTickets`
--

CREATE TABLE `tblTickets` (
  `ticket_id` int(11) NOT NULL,
  `sdate` int(15) NOT NULL,
  `user_name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_persian_ci NOT NULL,
  `message` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tblTickets`
--

INSERT INTO `tblTickets` (`ticket_id`, `sdate`, `user_name`, `email`, `message`) VALUES
(1, 2147483647, '', '', ''),
(2, 2147483647, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblTitles`
--

CREATE TABLE `tblTitles` (
  `title_id` int(11) NOT NULL,
  `title` text COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `item_for` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tblTitles`
--

INSERT INTO `tblTitles` (`title_id`, `title`, `text`, `item_for`) VALUES
(1, 'خدماتی که ما ارایه میدهیم', '', 'تیتر بخش سرویس ها\r\n\r\n'),
(2, 'چرا گروه ما؟', 'گروه ما خوبه', 'بخش اعداد با بکگراند آبی\r\n\r\n'),
(3, 'رویه کاری', '', 'تیتر بخش رویه کاری\r\n'),
(4, 'با تیم ما ارتباط بگیرید', '', 'فرم ارتباط با تیم ما\r\n'),
(5, 'در خبرنامه ی ما عضو شوید', '', 'تیتر ثبت نام در خبرنامه\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tblTopBanners`
--

CREATE TABLE `tblTopBanners` (
  `banner_id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_persian_ci NOT NULL,
  `text` longtext COLLATE utf8_persian_ci NOT NULL,
  `btn_text` varchar(120) COLLATE utf8_persian_ci NOT NULL,
  `link` int(50) NOT NULL,
  `image` varchar(50) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tblTopBanners`
--

INSERT INTO `tblTopBanners` (`banner_id`, `title`, `text`, `btn_text`, `link`, `image`) VALUES
(1, 'تست', 'متن تست', 'بیشتر بدانید', 10, 'image1587387495.png'),
(2, 'تست', 'متن تست', 'بیشتر بدانید', 10, 'image1587398795.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblVisits`
--

CREATE TABLE `tblVisits` (
  `visit_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `ip` text COLLATE utf8_persian_ci NOT NULL,
  `sess_id` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tblVisits`
--

INSERT INTO `tblVisits` (`visit_id`, `time`, `ip`, `sess_id`) VALUES
(1, 1587414631, '37.137.5.225', '5174710c0567aaf4583a8bb2e128dcb7'),
(2, 1587415031, '2.147.17.111', '5d89d8088f5fca6f60a682d405b3ab51');

-- --------------------------------------------------------

--
-- Table structure for table `tblWelcomeMessages`
--

CREATE TABLE `tblWelcomeMessages` (
  `message_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `for` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tblWelcomeMessages`
--

INSERT INTO `tblWelcomeMessages` (`message_id`, `title`, `text`, `for`) VALUES
(1, 'خوش آمدید!', 'به خبر نامه خوش آمدید', 'خبرنامه\r\n'),
(2, 'تیکت ارسال شد\r\n', 'تیکت شما با موفقیت ارسال شد', 'ارسال تیکت');

-- --------------------------------------------------------

--
-- Table structure for table `tblWorkPlan`
--

CREATE TABLE `tblWorkPlan` (
  `plan_id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `image` varchar(25) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tblWorkPlan`
--

INSERT INTO `tblWorkPlan` (`plan_id`, `title`, `text`, `image`) VALUES
(1, 'مرحله اول', 'صحبت با مشتری عزیز و بحث راجب پروژه', 'image1587404561.png'),
(2, 'متوجه ایده ی اصلی نقشه میشویم', 'چیزی که متوجه شدیم را آماده ی پیاده سازی میکنیم', 'image1587404721.png'),
(3, 'روی پروژه کار میکنیم', 'متخصصین ما کار میکنن', 'image1587404731.png'),
(4, 'چک میکنیم همه چی رو', 'یه بار دیگه همه چی رو دابل چک میکنیم', 'image1587404745.png'),
(5, 'همه چی رو تحویل میدیم', 'پروژه تحویل داده شد', 'image1587417933.png');

-- --------------------------------------------------------

--
-- Table structure for table `template_data`
--

CREATE TABLE `template_data` (
  `template_id` int(11) NOT NULL,
  `tbl_name` mediumtext COLLATE utf8_persian_ci NOT NULL,
  `column_data` longtext COLLATE utf8_persian_ci NOT NULL,
  `label_data` longtext COLLATE utf8_persian_ci NOT NULL,
  `type_data` longtext COLLATE utf8_persian_ci NOT NULL,
  `join_data` longtext COLLATE utf8_persian_ci DEFAULT NULL,
  `form_data` longtext COLLATE utf8_persian_ci NOT NULL,
  `image_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `validation_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `template_data`
--

INSERT INTO `template_data` (`template_id`, `tbl_name`, `column_data`, `label_data`, `type_data`, `join_data`, `form_data`, `image_data`, `validation_data`) VALUES
(11, 'tblStates', '{\"state_name\":\"varchar\"}', '{\"state_name\":\"نام استان\"}', '{\"state_name\":\"input\"}', '{\"state_name\":\"\"}', '{\"state_name\":\"6\"}', '', ''),
(19, 'tblDist', '{\"title\":\"varchar\",\"state_image\":\"varchar\",\"detail\":\"text\"}', '{\"title\":\"تیتر\",\"state_image\":\"تصویر\",\"detail\":\"متن دیست\"}', '{\"title\":\"input\",\"state_image\":\"image\",\"detail\":\"input\"}', '{\"title\":\"*\",\"state_image\":\"*\",\"detail\":\"*\"}', '{\"title\":\"6\",\"state_image\":\"6\",\"detail\":\"12\"}', '{\"state_image\":{\"type\":\"image/jpeg\",\"width\":\"150\",\"height\":\"150\"}}', '{\"title\":\"Input\",\"state_image\":\"ImageInput\",\"detail\":\"ImageInput\"}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `tblBlogs`
--
ALTER TABLE `tblBlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblCounters`
--
ALTER TABLE `tblCounters`
  ADD PRIMARY KEY (`counter_id`);

--
-- Indexes for table `tblMidBanners`
--
ALTER TABLE `tblMidBanners`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `tblNewsLetter`
--
ALTER TABLE `tblNewsLetter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblServices`
--
ALTER TABLE `tblServices`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `tblTickets`
--
ALTER TABLE `tblTickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `tblTitles`
--
ALTER TABLE `tblTitles`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `tblTopBanners`
--
ALTER TABLE `tblTopBanners`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `tblVisits`
--
ALTER TABLE `tblVisits`
  ADD PRIMARY KEY (`visit_id`);

--
-- Indexes for table `tblWelcomeMessages`
--
ALTER TABLE `tblWelcomeMessages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `tblWorkPlan`
--
ALTER TABLE `tblWorkPlan`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `template_data`
--
ALTER TABLE `template_data`
  ADD PRIMARY KEY (`template_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10105;

--
-- AUTO_INCREMENT for table `tblBlogs`
--
ALTER TABLE `tblBlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblCounters`
--
ALTER TABLE `tblCounters`
  MODIFY `counter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblMidBanners`
--
ALTER TABLE `tblMidBanners`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblNewsLetter`
--
ALTER TABLE `tblNewsLetter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblServices`
--
ALTER TABLE `tblServices`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblTickets`
--
ALTER TABLE `tblTickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblTitles`
--
ALTER TABLE `tblTitles`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblTopBanners`
--
ALTER TABLE `tblTopBanners`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblVisits`
--
ALTER TABLE `tblVisits`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblWelcomeMessages`
--
ALTER TABLE `tblWelcomeMessages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblWorkPlan`
--
ALTER TABLE `tblWorkPlan`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_data`
--
ALTER TABLE `template_data`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
