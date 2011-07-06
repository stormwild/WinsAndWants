-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 23, 2010 at 03:19 AM
-- Server version: 5.1.47
-- PHP Version: 5.2.9



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `capston4_wins`
--

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS "role" (
  "id" int(11) NOT NULL AUTO_INCREMENT,
  "name" varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=4 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'member'),
(3, 'guest');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS "user" (
  "id" int(11) NOT NULL AUTO_INCREMENT,
  "name" varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  "password" varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  "email" varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  "created" datetime NOT NULL,
  "confirmed" tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY ("id"),
  UNIQUE KEY "name_UNIQUE" ("name"),
  UNIQUE KEY "email_UNIQUE" ("email")
) AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `created`, `confirmed`) VALUES
(4, 'stormwild', 'f7a9e24777ec23212c54d7a350bc5bea5477fdbb', 'artorrijos@gmail.com', '2010-12-04 03:21:15', 1),
(5, 'maurice', '14689895ffdda22478eb9d5c25037e7fd76eeec5', 'maurice@capstone.sg', '2010-12-05 03:13:14', 1),
(6, 'michaelong', 'fd908736d4b9febb66fba7fcacc20d36a2d337fe', 'michael@capstone.sg', '2010-12-17 02:06:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_role`
--

DROP TABLE IF EXISTS `user_has_role`;
CREATE TABLE IF NOT EXISTS "user_has_role" (
  "user_id" int(11) NOT NULL,
  "role_id" int(11) NOT NULL,
  PRIMARY KEY ("user_id","role_id"),
  KEY "fk_user_has_role_role1" ("role_id")
);

--
-- Dumping data for table `user_has_role`
--

INSERT INTO `user_has_role` (`user_id`, `role_id`) VALUES
(4, 2),
(5, 2),
(6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `wins_and_wants`
--

DROP TABLE IF EXISTS `wins_and_wants`;
CREATE TABLE IF NOT EXISTS "wins_and_wants" (
  "id" int(11) NOT NULL AUTO_INCREMENT,
  "created" date DEFAULT NULL,
  "wins_01" varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  "wins_02" varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  "wins_03" varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  "wins_04" varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  "wins_05" varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  "wants_01" varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  "wants_02" varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  "wants_03" varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  "wants_04" varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  "wants_05" varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  "user_id" int(11) NOT NULL,
  PRIMARY KEY ("id","user_id"),
  KEY "fk_wins_and_wants_user1" ("user_id")
) AUTO_INCREMENT=9 ;

--
-- Dumping data for table `wins_and_wants`
--

INSERT INTO `wins_and_wants` (`id`, `created`, `wins_01`, `wins_02`, `wins_03`, `wins_04`, `wins_05`, `wants_01`, `wants_02`, `wants_03`, `wants_04`, `wants_05`, `user_id`) VALUES
(1, '2010-12-15', 'aaaaa', 'aaa', '', '', 'aaa', '', 'aa', '', '', '', 4),
(2, '2010-12-19', 'aaa', '', '', '', '', '', '', '', '', '', 4),
(3, '2010-12-18', 'aaaa', '', 'aaaa', '', '', '', '', '', 'aa', '', 4),
(4, '2010-12-22', 'aaa', '', '', '', '', 'aaa', '', '', '', '', 4),
(5, '2010-12-23', 'aaa', 'aa', '', '', '', '', '', '', '', '', 4),
(6, '2101-12-17', 'Win Test 1', 'Win Test 2', 'Win Test 3', 'Win Test 4', 'Win Test 5', 'Want Test 1', 'Want Test 2', 'Want Test 3', '', '', 6),
(7, '2010-12-25', 'aaa', '', '', 'aa', '', 'aaa', '', '', 'aaa', '', 4),
(8, '2010-12-22', 'got my computer', '', '', '', '', 'to complete my task', '', '', '', '', 5);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_has_role`
--
ALTER TABLE `user_has_role`
  ADD CONSTRAINT "fk_user_has_role_role" FOREIGN KEY ("role_id") REFERENCES "role" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT "fk_user_has_role_user" FOREIGN KEY ("user_id") REFERENCES "user" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wins_and_wants`
--
ALTER TABLE `wins_and_wants`
  ADD CONSTRAINT "fk_wins_and_wants_user1" FOREIGN KEY ("user_id") REFERENCES "user" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
