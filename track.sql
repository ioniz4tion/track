-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2014 at 11:16 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `track`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_athlete`
--

CREATE TABLE IF NOT EXISTS `tb_athlete` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `first` varchar(30) NOT NULL,
  `last` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL DEFAULT 'None',
  `carrier` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT 'None',
  `sex` varchar(6) NOT NULL,
  `shirt` varchar(6) NOT NULL,
  `sweatshirt` varchar(6) NOT NULL,
  `grade` varchar(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_index_coach`
--

CREATE TABLE IF NOT EXISTS `tb_index_coach` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `number` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tb_index_coach`
--

INSERT INTO `tb_index_coach` (`ID`, `name`, `title`, `description`, `number`, `email`, `image`) VALUES
(1, 'Kelly Reed', 'Head Coach/ Girls Sprints-Relays/Triple Jump', 'Coach Reed has been the head track and field coach at Lake City for 12 years, and was an assistant for two years prior to becoming head coach.', '208-964-2869', 'kreed@cdaschools.org', 'pic1.jpg'),
(2, 'Heather Harmon-Reed', 'Distance', 'Heather has been with the LC track and field program for 12 seasons. She has coached 7 individual state champions, 2 state-runner up finishers, and was a 7-time NJCAA all-American in cross country and track and field while participating for North Idaho College. She is the current womens'' record holder for the Coeur d'' Alene Half Marathon. Heather has taught at Lake City for 12 years, and was named School District #271 Secondary Educator of the Year in 2012. She currently teaches reading and algebra.', '(XXX) XXX-XXXX', 'hreed@cdaschools.org', 'pic1.jpg'),
(3, 'Van Troxel', 'Boys Sprints/Relays', 'Short bio or description of coach goes here. They''ll tell us what to write.', '(XXX) XXX-XXXX', 'vtroxel@cdaschools.org', 'pic1.jpg'),
(4, 'Joe Partington', 'Hurdles', 'Short bio or description of coach goes here. They''ll tell us what to write.', '(XXX) XXX-XXXX', 'jpartington@cdaschools.org', 'pic1.jpg'),
(5, 'Damian Caires', 'High Jump/Long Jump', 'Short bio or description of coach goes here. They''ll tell us what to write.', '(XXX) XXX-XXXX', 'dcaires@cdaschools.org', 'pic1.jpg'),
(6, 'Russ Blank', 'Pole Vault', 'Short bio or description of coach goes here. They''ll tell us what to write.', '(XXX) XXX-XXXX', 'rblank@cdaschools.org', 'pic1.jpg'),
(7, 'Mr. Carlson', 'Throwing', 'Short bio or description of coach goes here. They''ll tell us what to write.', '(XXX) XXX-XXXX', 'Email', 'pic1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_index_events`
--

CREATE TABLE IF NOT EXISTS `tb_index_events` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_index_events`
--

INSERT INTO `tb_index_events` (`ID`, `text`, `image`) VALUES
(1, 'Varsity Track Banquet is Wednesday, June 4th at 6 p.m. in Lake City Commons.', 'maddi ward.png'),
(2, 'Congratulations to Scott Cummings- 2014 Idaho State Champion and school record holder in the pole vault! Congratulations as well to Kasey Widmyer, 2nd place in Triple Jump and school record holder; to Quinn Mitchell- 3rd place in Discus and school record holder; to Clarissa Smith- 6th place Discus. Awesome Job!', 'Scott C pole vault.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `tb_index_field_boy`
--

CREATE TABLE IF NOT EXISTS `tb_index_field_boy` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(60) NOT NULL,
  `record` varchar(60) NOT NULL,
  `name` varchar(100) NOT NULL,
  `year` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_index_field_boy`
--

INSERT INTO `tb_index_field_boy` (`ID`, `event`, `record`, `name`, `year`) VALUES
(1, 'Discus', '160'' 3"', 'Quinn Mitchell', '2014'),
(2, 'Shotput', '53'' 5.75"', 'Carson York', '2007'),
(3, 'High Jump', '6'' 6"', 'Zack Linscott', '2012'),
(4, 'Long Jump', '21'' 11"', 'Robbie Quinn', '2011'),
(5, 'Triple Jump', '43'' 10"', 'Kyle Ferebee', '2006'),
(6, 'Pole Vault', '14'' 6"', 'Scott Cummings', '2014');

-- --------------------------------------------------------

--
-- Table structure for table `tb_index_field_girl`
--

CREATE TABLE IF NOT EXISTS `tb_index_field_girl` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(60) NOT NULL,
  `record` varchar(60) NOT NULL,
  `name` varchar(100) NOT NULL,
  `year` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_index_field_girl`
--

INSERT INTO `tb_index_field_girl` (`ID`, `event`, `record`, `name`, `year`) VALUES
(1, 'Discus', '122'' 11"', 'Jamie Tart', '2005'),
(2, 'Shotput', '38'' 5.5"', 'Jessica Nyrop', '2004'),
(3, 'High Jump', '5'' 4"', 'Brianne Duncan', '2003'),
(4, 'Long Jump', '17'' 2.5"', 'Brianne Duncan', '2003'),
(5, 'Triple Jump', '36'' 9.5"', 'Kasey Widmyer', '2014'),
(6, 'Pole Vault', '11'' 7"', 'Kierstie Shellman', '2012');

-- --------------------------------------------------------

--
-- Table structure for table `tb_index_news`
--

CREATE TABLE IF NOT EXISTS `tb_index_news` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_index_news`
--

INSERT INTO `tb_index_news` (`ID`, `name`, `text`) VALUES
(1, '5-30-2014', 'Congratulations to the Timberwolves 2014 Idaho State Champions- Maddison Ward- 100m and 200m (back to back titles in the 200), Jerry Louie- McGee - 400m, and Scott Cummings- Pole Vault. Relay state title winners- Boys 4x200- Jerry Louie-McGee, Nathan Newby, Rikki McCaw, and Chris Baker. 4x400- Jake Finney, Nathan Newby, Tanner Horton, Jerry Louie-McGee. Once a state champion... ALWAYS a state champion! Congrats again!!');

-- --------------------------------------------------------

--
-- Table structure for table `tb_index_relay_boy`
--

CREATE TABLE IF NOT EXISTS `tb_index_relay_boy` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(50) NOT NULL,
  `record` varchar(50) NOT NULL,
  `name1` varchar(50) NOT NULL,
  `name2` varchar(50) NOT NULL,
  `name3` varchar(50) NOT NULL,
  `name4` varchar(50) NOT NULL,
  `year` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_index_relay_boy`
--

INSERT INTO `tb_index_relay_boy` (`ID`, `event`, `record`, `name1`, `name2`, `name3`, `name4`, `year`) VALUES
(1, '4 × 100m Relay', '42.34', 'Rhett Damschen', 'Nathan Newby', 'Rikki McCaw', 'Chris Baker', '2014'),
(2, '4 × 200m Relay', '1:28.18', 'Jerry Louie-McGee', 'Nathan Newby', 'Rikki McCaw', 'Chris Baker', '2014'),
(3, '4 × 400m Relay', '3:21.87', 'Jake Finney', 'Nathan Newby', 'Tanner Horton', 'Jerry Louie-McGee', '2014'),
(4, '4 × 800m Relay', '8:10.98', 'Kyler Little', 'Marcus Ross', 'Max Evans', 'Jake Finney', '2014'),
(5, 'Medley Relay', '3:32.44', 'Kyle Graves', 'Matt Olson', 'John Coyle', 'Logan Frederickson	', '2007'),
(6, 'Distance Medley Relay', 'xx.xx', 'Name of Person', 'Name of Person', 'Name of Person', 'Name of Person', 'year');

-- --------------------------------------------------------

--
-- Table structure for table `tb_index_relay_girl`
--

CREATE TABLE IF NOT EXISTS `tb_index_relay_girl` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(50) NOT NULL,
  `record` varchar(50) NOT NULL,
  `name1` varchar(50) NOT NULL,
  `name2` varchar(50) NOT NULL,
  `name3` varchar(50) NOT NULL,
  `name4` varchar(50) NOT NULL,
  `year` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_index_relay_girl`
--

INSERT INTO `tb_index_relay_girl` (`ID`, `event`, `record`, `name1`, `name2`, `name3`, `name4`, `year`) VALUES
(1, '4 × 100m Relay', '48.52', 'Sasha Tucker', 'Marisa Schneider', 'Natalie Hammons', 'Meagan Garcia', '2004'),
(2, '4 × 200m Relay', '1:42.71', 'Carly Garcia', 'Maddison Ward', 'Alissa Jolliff', 'Leanne Asper', '2012'),
(3, '4 × 400m Relay', '3:57.40', 'Sasha Tucker', 'Bre Sande', 'Natalie Hammons', 'Meagan Garcia', '2004'),
(4, '4 × 800m Relay', '9:42.49', 'Rachel Ward', 'Chloe Hutter', 'Alia Lacroix', 'Meaghan Bare	', '2012'),
(5, 'Medley Relay', '1:49.91', 'Jenny Mick', 'Marisa Schneider', 'Natalie Hammons', 'Meagan Garcia', '2003'),
(6, 'Distance Medley Relay', 'xx.xx', 'Name of Person', 'Name of Person', 'Name of Person', 'Name of Person', 'year');

-- --------------------------------------------------------

--
-- Table structure for table `tb_index_schedule`
--

CREATE TABLE IF NOT EXISTS `tb_index_schedule` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `monthday` date NOT NULL,
  `date` varchar(150) NOT NULL,
  `time` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `location` varchar(150) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tb_index_schedule`
--

INSERT INTO `tb_index_schedule` (`ID`, `monthday`, `date`, `time`, `name`, `location`) VALUES
(1, '2015-03-14', 'Sat 3-14', '10 am', 'Sweeney Invitational', 'Lewiston'),
(2, '2015-03-18', 'Wed 3-18', '3:30 pm', 'I.E.L JV/Varsity', 'CHS'),
(3, '0000-00-00', 'Fri/Sat 20/21', 'TBA', 'TBA', 'TBA'),
(4, '2015-03-25', 'Wed 3-25', '12 (noon)', 'Panhandle Classic', 'Lewiston'),
(5, '2015-04-08', 'Wed 4-8', '2:30 pm', 'Christina Finney Co-Ed Relays', 'Post Falls'),
(6, '2015-04-10', 'Fri 4-10*', 'TBA*', 'Pulse Invitational (Tentative)', 'Centennial (Boise)'),
(7, '2015-04-11', 'Sat 4-11', '10 am', 'Moscow Invitational (Tentative)', 'Moscow'),
(8, '2015-04-16', 'Thurs 4-16', '3:30', 'I.E.L. JV/Varsity', 'Sandpoint'),
(9, '2015-04-17', 'Fri/Sat 4-17/18', 'TBA', 'Bandana Invitational (Tentative)', 'Mt. View (Boise)'),
(10, '2015-04-18', 'Sat 4-18', '9:00 am', 'Pasco Invitational', 'Pasco, WA'),
(11, '2015-04-18', 'Sat 4-18', '9:00 am', 'Kootenai Invitational', 'Kootenai (Harrison)'),
(12, '2015-04-21', 'Tue 4-21', '3:30', 'I.E.L. JV Championships', 'Lake City'),
(13, '2015-04-24', 'Fri/Sat 4-24-25', 'TBA', 'Rasmussen Invitational* (Tentative)', 'TBA*'),
(14, '2015-04-30', 'Thu 4-30', '2:30', 'Meet of Champions', 'Post Falls'),
(15, '2015-05-07', 'Thu 5-7', '1:00 pm', '4A/5A District I/II Regionals', 'CHS'),
(16, '2015-05-08', 'Fri 5-8', '12 (noon)', '4A/5A District I/II Regionals', 'Lewiston'),
(17, '2015-05-15', 'Fri 5-15', 'TBA', 'Idaho State Track Meet', 'TBA'),
(18, '2015-05-16', 'Sat 5-16', 'TBA', 'Idaho State Track Meet', 'TBA');

-- --------------------------------------------------------

--
-- Table structure for table `tb_index_shoutout`
--

CREATE TABLE IF NOT EXISTS `tb_index_shoutout` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `text` text NOT NULL,
  `image` varchar(150) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_index_shoutout`
--

INSERT INTO `tb_index_shoutout` (`ID`, `name`, `text`, `image`) VALUES
(1, 'Congratulations to whomever', 'Say stuff about the person here. Say what they did well and stuff like that.', 'wolf.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_index_track_boy`
--

CREATE TABLE IF NOT EXISTS `tb_index_track_boy` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(60) NOT NULL,
  `record` varchar(60) NOT NULL,
  `name` varchar(100) NOT NULL,
  `year` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tb_index_track_boy`
--

INSERT INTO `tb_index_track_boy` (`ID`, `event`, `record`, `name`, `year`) VALUES
(1, '100m', '10.86', 'Chris Baker', '2013'),
(2, '200m', '21.91', 'Chris Baker', '2014'),
(3, '400m', '48.64', 'Jerry Louie-McGee', '2014'),
(4, '800m', '1:55.42', 'Jake Finney', '2014'),
(5, '1600m', '4:16.16', 'Kyler Little', '2014'),
(6, '3200m', '9:20.30', 'Cody Helbling', '2010'),
(7, '110m Hurdles', '15.08', 'Tanner Schalk', '2008'),
(8, '300m Hurdles', '39.30', 'Tanner Schalk', '2008');

-- --------------------------------------------------------

--
-- Table structure for table `tb_index_track_girl`
--

CREATE TABLE IF NOT EXISTS `tb_index_track_girl` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(60) NOT NULL,
  `record` varchar(60) NOT NULL,
  `name` varchar(100) NOT NULL,
  `year` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tb_index_track_girl`
--

INSERT INTO `tb_index_track_girl` (`ID`, `event`, `record`, `name`, `year`) VALUES
(1, '100m', '12.16', 'Maddi Ward', '2013'),
(2, '200m', '24.68', 'Maddi Ward', '2013'),
(3, '400m', '57.72', 'Sasha Tucker', '2004'),
(4, '800m', '2:14.66', 'Bre Sande', '2005'),
(5, '1600m', '5:06.40', 'Bre Sande', '2005'),
(6, '3200m', '11:06.28', 'Molly Mitchell', '2009'),
(7, '110m Hurdles', '15.07', 'Carly Garcia', '2012'),
(8, '300m Hurdles', '44.79', 'Holly Meyer', '2005');

-- --------------------------------------------------------

--
-- Table structure for table `tb_parent`
--

CREATE TABLE IF NOT EXISTS `tb_parent` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `kid` varchar(40) NOT NULL,
  `first` varchar(20) NOT NULL,
  `last` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL DEFAULT 'None',
  `phone` varchar(10) NOT NULL DEFAULT 'None',
  `carrier` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_state_champions`
--

CREATE TABLE IF NOT EXISTS `tb_state_champions` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `year` varchar(30) NOT NULL,
  `event` varchar(80) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` tinytext NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`),
  KEY `ID_2` (`ID`),
  KEY `ID_3` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_state_champions`
--

INSERT INTO `tb_state_champions` (`ID`, `name`, `year`, `event`, `image`, `description`) VALUES
(1, 'Scott Cummings', '2014', 'Pole Vault', 'Wolf.png', 'Scott became the first Lake City vaulter to capture gold at the state meet, setting a school record along the way with his 14-6 vault.'),
(2, 'Jerry Louie-McGee', '2014', '400m Dash', 'wolf.png', 'Jerry set the Lake City school record in the 400m with a state best 48.64 in winning the schools first individual title in the 400m dash.'),
(3, 'Breanna Sande', '2002, 2003, 2004, 2005', '1600m Run', 'wolf.png', 'The only female in Idaho 5A track and field history to win the 1600m run four years in a row.  Bre went on to have a very successful collegiate career at Boise State University.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
