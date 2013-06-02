-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 02, 2013 at 11:04 AM
-- Server version: 5.5.31
-- PHP Version: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `moments_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `moment_id` int(11) NOT NULL,
  `msg` varchar(160) DEFAULT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `moment_id` (`moment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `time` time NOT NULL,
  `longitude` float(10,6) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `address` varchar(80) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=207 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `time`, `longitude`, `latitude`, `address`) VALUES
(194, '838:59:59', 67.028061, 24.893379, 'Imam Bargah to Nazimabad Road St., Karachi, Pakistan'),
(195, '838:59:59', 67.028061, 24.893379, 'Imam Bargah to Nazimabad Road St., Karachi, Pakistan'),
(196, '838:59:59', 67.028061, 24.893379, 'Imam Bargah to Nazimabad Road St., Karachi, Pakistan'),
(197, '838:59:59', 67.028061, 24.893379, 'Imam Bargah to Nazimabad Road St., Karachi, Pakistan'),
(198, '838:59:59', 67.028061, 24.893379, 'Imam Bargah to Nazimabad Road St., Karachi, Pakistan'),
(199, '838:59:59', 67.028061, 24.893379, 'Imam Bargah to Nazimabad Road St., Karachi, Pakistan'),
(200, '838:59:59', 67.028061, 24.893379, 'Imam Bargah to Nazimabad Road St., Karachi, Pakistan'),
(201, '838:59:59', 67.028061, 24.893379, 'Imam Bargah to Nazimabad Road St., Karachi, Pakistan'),
(202, '838:59:59', 67.028061, 24.893379, 'Imam Bargah to Nazimabad Road St., Karachi, Pakistan'),
(203, '838:59:59', 67.028061, 24.893379, 'Imam Bargah to Nazimabad Road St., Karachi, Pakistan'),
(204, '838:59:59', 67.028061, 24.893379, 'Imam Bargah to Nazimabad Road St., Karachi, Pakistan'),
(205, '838:59:59', 67.028061, 24.893379, 'Imam Bargah to Nazimabad Road St., Karachi, Pakistan'),
(206, '838:59:59', 67.028061, 24.893379, 'Imam Bargah to Nazimabad Road St., Karachi, Pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `media_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `artistName` varchar(64) NOT NULL,
  `trackName` varchar(64) DEFAULT NULL,
  `previewUrl` varchar(256) DEFAULT NULL,
  `artworkUrl` varchar(256) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  PRIMARY KEY (`media_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `category_id`, `artistName`, `trackName`, `previewUrl`, `artworkUrl`, `date_added`) VALUES
(171676237, 3, 'Cartel', 'A', 'http://a25.phobos.apple.com/us/r1000/064/Music/fc/c4/9c/mzm.muamejap.aac.p.m4a', 'http://a1.mzstatic.com/us/r1000/021/Music/5e/ff/e9/mzi.ffqpytfl.100x100-75.jpg', '0000-00-00'),
(215188639, 3, 'Nusrat Fateh Ali Khan', 'Yeh Jo Halka Halka Saroor Hai', 'http://a150.phobos.apple.com/us/r30/Music/d7/c8/14/mzm.sahkbdvd.aac.p.m4a', 'http://a3.mzstatic.com/us/r30/Music/d3/03/7f/mzi.eqjdmsmb.100x100-75.jpg', '0000-00-00'),
(259704473, 3, 'a-ha', 'Take On Me', 'http://a547.v.phobos.apple.com/us/r1000/022/Video/d8/a1/05/mzm.omzgsvwh..640x480.h264lc.u.p.m4v', 'http://a1.mzstatic.com/us/r1000/033/Music/27/ca/c3/mzi.wflnqfbp.100x100-75.jpg', '0000-00-00'),
(265820183, 3, 'A+', 'All I See', 'http://a1205.v.phobos.apple.com/us/r1000/029/Video/26/c2/ab/mzm.hkdenomh..640x368.h264lc.u.p.m4v', 'http://a1.mzstatic.com/us/r1000/045/Features/2b/cf/0a/dj.utkxnoyp.100x100-75.jpg', '0000-00-00'),
(265820277, 3, 'Dido & Eminem', 'Stan', 'http://a1928.v.phobos.apple.com/us/r1000/049/Video/43/fd/53/mzm.ajcdxshi..640x272.h264lc.u.p.m4v', 'http://a4.mzstatic.com/us/r1000/054/Features/e2/67/77/dj.vwkcxbzk.100x100-75.jpg', '0000-00-00'),
(266976163, 3, 'Britney Spears', 'Piece of Me', 'http://a597.phobos.apple.com/us/r1000/092/Music/1a/56/8a/mzm.dnbheqgv.aac.p.m4a', 'http://a3.mzstatic.com/us/r1000/032/Music/ce/ea/91/mzi.xbwyqifr.100x100-75.jpg', '0000-00-00'),
(267779610, 2, 'J.J. Abrams, Roberto Orci & Eric Schwab', 'Mission: Impossible III', 'http://a1504.v.phobos.apple.com/us/r1000/009/Video/b6/18/51/mzm.txuepmda..640x480.h264lc.d2.p.m4v', 'http://a5.mzstatic.com/us/r1000/067/Video/v4/dd/48/99/dd4899c6-f347-c160-df69-c89983e05e43/mza_3796716794175362229.100x100-75.jpg', '0000-00-00'),
(273696792, 2, 'David Yates', 'Harry Potter and the Order of the Phoenix', 'http://a1279.v.phobos.apple.com/us/r1000/023/Video/36/db/cf/mzm.wywuginh..640x354.h264lc.d2.p.m4v', 'http://a1.mzstatic.com/us/r1000/040/Video/da/73/b1/mzl.brnnqjbz.100x100-75.jpg', '0000-00-00'),
(287374359, 3, 'Alexander Acha', 'Te Amo', 'http://a516.phobos.apple.com/us/r1000/072/Music/8d/f1/41/mzm.ddwavjeu.aac.p.m4a', 'http://a4.mzstatic.com/us/r1000/046/Features/5a/93/4d/dj.hdphqnjr.100x100-75.jpg', '0000-00-00'),
(296192682, 3, 'Barenaked Ladies', 'A', 'http://a1364.phobos.apple.com/us/r1000/090/Music/3b/36/f8/mzm.ultmerwl.aac.p.m4a', 'http://a4.mzstatic.com/us/r1000/032/Music/0b/97/13/mzi.npxztxzc.100x100-75.jpg', '0000-00-00'),
(296667996, 3, 'Britney Spears', 'If U Seek Amy', 'http://a103.phobos.apple.com/us/r1000/115/Music/45/5a/8c/mzm.qikwxiwk.aac.p.m4a', 'http://a3.mzstatic.com/us/r1000/022/Music/d5/b2/60/mzi.doisfoll.100x100-75.jpg', '0000-00-00'),
(342689360, 3, 'Inna', 'Love', 'http://a1701.phobos.apple.com/us/r1000/011/Music/df/55/f6/mzi.gkdpfylc.aac.p.m4a', 'http://a4.mzstatic.com/us/r1000/036/Music/f0/5e/fe/mzi.yfxcrxds.100x100-75.jpg', '0000-00-00'),
(342689361, 3, 'Inna', 'Amazing', 'http://a538.phobos.apple.com/us/r1000/092/Music/v4/0c/9e/ac/0c9eacf7-c892-7bca-8c09-23b9d93f8457/mzaf_9169690297577684353.m4a', 'http://a4.mzstatic.com/us/r1000/036/Music/f0/5e/fe/mzi.yfxcrxds.100x100-75.jpg', '0000-00-00'),
(348014354, 3, 'Geht''s Noch', 'Naughty', 'http://a1326.phobos.apple.com/us/r1000/107/Music/v4/ae/ed/91/aeed9109-fab1-631f-087d-e3fc2752db8e/mzaf_271205492507111401.aac.m4a', 'http://a3.mzstatic.com/us/r1000/028/Music/75/dc/e1/mzi.lmemwdtw.100x100-75.jpg', '0000-00-00'),
(361487482, 3, 'Justin Bieber', 'Baby', 'http://a476.v.phobos.apple.com/us/r1000/044/Video/56/2a/22/mzm.iaemwaqc..640x304.h264lc.u.p.m4v', 'http://a5.mzstatic.com/us/r1000/011/Video/9d/a0/c4/mzi.lpsspzsh.100x100-75.jpg', '0000-00-00'),
(386222799, 3, 'Eminem & Rihanna', 'Love the Way You Lie', 'http://a1389.v.phobos.apple.com/us/r1000/033/Video/f6/5e/52/mzm.pisjdcxm..640x256.h264lc.u.p.m4v', 'http://a5.mzstatic.com/us/r1000/013/Video/00/e4/50/mzi.gtvyzdot.100x100-75.jpg', '0000-00-00'),
(390320341, 2, 'Jon Favreau', 'Iron Man 2', 'http://a399.v.phobos.apple.com/us/r1000/037/Video/e0/42/d0/mzm.okqbvdbn..640x362.h264lc.d2.p.m4v', 'http://a3.mzstatic.com/us/r1000/047/Features/e6/57/e6/dj.qvuueopr.100x100-75.jpg', '0000-00-00'),
(392429630, 3, 'a-ha', 'Butterfly, Butterfly (The Last Hurrah)', 'http://a17.v.phobos.apple.com/us/r1000/109/Video/v4/e4/91/51/e491511b-8237-da13-6784-2be68d400932/mzvf_1334272027627302058.640x480.h264lc.U.p.m4v', 'http://a3.mzstatic.com/us/r1000/022/Video/f5/99/45/dj.tlnwcjyc.100x100-75.jpg', '0000-00-00'),
(392429634, 3, 'a-ha', 'Crying In the Rain', 'http://a359.v.phobos.apple.com/us/r1000/036/Video/26/47/f8/mzm.dcyymebb..640x416.h264lc.u.p.m4v', 'http://a2.mzstatic.com/us/r1000/009/Video/99/e8/c6/dj.qqxaofch.100x100-75.jpg', '0000-00-00'),
(400763833, 2, 'Christopher Nolan', 'Inception', 'http://a649.v.phobos.apple.com/us/r1000/091/Video/8c/d7/81/mzm.ralngrgq..640x356.h264lc.d2.p.m4v', 'http://a2.mzstatic.com/us/r1000/008/Features/3b/02/37/dj.zsolzzxc.100x100-75.jpg', '0000-00-00'),
(410385276, 3, 'Inna', 'Hot (Dancing In the Dark Video Edit)', 'http://a369.v.phobos.apple.com/us/r1000/046/Video/7c/ac/19/mzm.xgtzxpvc..640x288.h264lc.u.p.m4v', 'http://a1.mzstatic.com/us/r1000/042/Video/cd/fc/46/mzi.ibvijfgz.100x100-75.jpg', '0000-00-00'),
(424917556, 3, 'Alexandra Stan', 'Mr. Saxobeat', 'http://a453.v.phobos.apple.com/us/r1000/020/Video/ff/57/52/mzm.aaacinma..640x288.h264lc.u.p.m4v', 'http://a1.mzstatic.com/us/r1000/012/Video/43/70/7b/mzi.lptukvic.100x100-75.jpg', '0000-00-00'),
(425305936, 2, 'Michel Gondry', 'The Green Hornet (2011)', 'http://a1271.v.phobos.apple.com/us/r1000/087/Video/81/27/a7/mzm.yrpknvgc..640x354.h264lc.d2.p.m4v', 'http://a2.mzstatic.com/us/r1000/042/Video/d9/34/a2/mzi.kfltrfbz.100x100-75.jpg', '0000-00-00'),
(509857961, 1, 'E L James', 'Fifty Shades of Grey', NULL, 'http://a4.mzstatic.com/us/r30/Publication/v4/a3/4c/fd/a34cfdae-a519-e80b-78fc-913e426fa4d3/9781612130293.60x60-50.jpg', '0000-00-00'),
(541847473, 3, 'The Fighters', 'Summer Paradise', 'http://a1936.phobos.apple.com/us/r1000/104/Music/42/d9/db/mzi.pjxobkoz.aac.p.m4a', 'http://a2.mzstatic.com/us/r1000/105/Music/v4/eb/16/a8/eb16a83a-3eca-ef7c-e1e1-b65820af4573/cover.100x100-75.jpg', '0000-00-00'),
(564832212, 3, 'Alexandra Stan', 'Lemonade', 'http://a167.phobos.apple.com/us/r1000/106/Music/cd/9a/ff/mzi.nwpmried.aac.p.m4a', 'http://a3.mzstatic.com/us/r1000/104/Music/v4/77/f7/f6/77f7f60f-3db0-55db-0c40-ff4eed18a9fd/0617465350955.100x100-75.jpg', '0000-00-00'),
(576067307, 1, 'Jamillah Castle', 'The Lynch Brothers:Garrett', NULL, 'http://a3.mzstatic.com/us/r30/Publication/v4/8b/1c/9b/8b1c9bac-c712-46af-eee3-c8a4eb3b18ef/9781301132768.100x100-75.jpg', '0000-00-00'),
(598391810, 3, 'Justin Timberlake', 'Suit & Tie (feat. JAY Z)', 'http://a789.phobos.apple.com/us/r1000/089/Music2/v4/01/84/68/018468d9-f18f-2c21-5074-5f7a89454354/mzaf_4436511326608476720.aac.m4a', 'http://a3.mzstatic.com/us/r1000/079/Features/v4/00/9f/d4/009fd4b4-5fd3-6e3d-56dc-000456929f1e/dj.lywsxafc.100x100-75.jpg', '0000-00-00'),
(598391850, 3, 'Justin Timberlake', 'Mirrors', 'http://a1940.phobos.apple.com/us/r1000/111/Music/v4/67/44/54/67445483-f69b-1aa8-3c6d-dcadfd024d3c/mzaf_1241664199923799714.aac.m4a', 'http://a3.mzstatic.com/us/r1000/079/Features/v4/00/9f/d4/009fd4b4-5fd3-6e3d-56dc-000456929f1e/dj.lywsxafc.100x100-75.jpg', '0000-00-00'),
(603732652, 3, 'Mariah Carey', 'Almost Home', 'http://a1890.phobos.apple.com/us/r1000/080/Music2/v4/40/24/9a/40249a20-3428-d9a6-8fdc-d0e1ac79584e/mzaf_1220046622370910043.aac.m4a', 'http://a2.mzstatic.com/us/r1000/086/Music/v4/7d/54/73/7d547310-b13d-77df-cd98-6e066b214b8a/UMG_cvrart_00602537335954_01_RGB72_1500x1500_13UMGIM15671.100x100-75.jpg', '0000-00-00'),
(624003686, 3, 'Justin Timberlake', 'Mirrors', 'http://a1568.v.phobos.apple.com/us/r1000/089/Video2/v4/21/08/02/2108020c-ec4a-e10e-49f5-b44ad83c7af1/mzvf_2751514043028315772.640x480.h264lc.U.p.m4v', 'http://a2.mzstatic.com/us/r1000/060/Video/v4/b4/b5/c7/b4b5c79c-3158-4531-4851-761c7c4dece5/8864439364160101VIC.100x100-75.jpg', '0000-00-00'),
(631830757, 3, 'Bridgit Mendler', 'Hurricane', 'http://a482.v.phobos.apple.com/us/r1000/088/Video/v4/76/e2/cd/76e2cd75-c385-3a79-031b-5546a76b1375/mzvf_5223827481991646716.640x320.h264lc.U.p.m4v', 'http://a5.mzstatic.com/us/r1000/060/Video/v4/e1/16/04/e11604c1-10e3-9cb7-a3bd-ae1037fdf2a7/dj.ukdulhnt.100x100-75.jpg', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `media_category`
--

DROP TABLE IF EXISTS `media_category`;
CREATE TABLE IF NOT EXISTS `media_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `media_category`
--

INSERT INTO `media_category` (`category_id`, `name`) VALUES
(1, 'ebook'),
(2, 'movie'),
(3, 'musicTrack');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_text` varchar(512) NOT NULL,
  `time` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `fk_msg_users` (`sender_id`),
  KEY `fk_msg_users2` (`receiver_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `message_text`, `time`, `sender_id`, `receiver_id`) VALUES
(7, 'wtf fix this ?', 1370092522, 21, 14),
(8, 'Okay chk this', 1370092543, 21, 14),
(9, 'to myself :)', 1370092550, 21, 21),
(10, 'another to myself :P', 1370092558, 21, 21),
(11, 'asadsadsd', 1370092745, 14, 21),
(12, 'reply mesg', 1370092754, 14, 21),
(13, '3rd reply msg', 1370092762, 14, 14),
(14, 'aaaaaaaaaaaaa', 1370092828, 14, 23),
(15, 'asddddddddddddddddddddddd', 1370092832, 14, 23),
(16, 'Wtf?', 1370108057, 14, 21);

-- --------------------------------------------------------

--
-- Table structure for table `moments`
--

DROP TABLE IF EXISTS `moments`;
CREATE TABLE IF NOT EXISTS `moments` (
  `moment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `msg` varchar(256) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`moment_id`),
  KEY `media_id` (`media_id`),
  KEY `location_id` (`location_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=178 ;

--
-- Dumping data for table `moments`
--

INSERT INTO `moments` (`moment_id`, `user_id`, `media_id`, `location_id`, `msg`, `time`) VALUES
(157, 22, 603732652, 194, 'party scene', 1369802490),
(158, 22, NULL, 195, 'simple moment', 1369802532),
(159, 22, NULL, 196, 'simple with friends', 1369802544),
(162, 22, NULL, NULL, 'I''m with friends', 1369805476),
(163, 22, NULL, NULL, 'I''m with friends', 1369805556),
(164, 22, NULL, NULL, 'with friends 1', 1369805624),
(165, 22, NULL, NULL, 'with friends 1', 1369805713),
(166, 22, NULL, NULL, 'with friends 1', 1369805741),
(167, 22, NULL, NULL, 'with friends 1', 1369806097),
(168, 22, NULL, NULL, 'With friends atrium again :D', 1369806360),
(169, 22, NULL, 198, 'I''m sleeping now.', 1369806695),
(170, 22, NULL, 199, 'I''m awake.', 1369806698),
(171, 14, NULL, 200, 'I''m asif woot! :D', 1369812830),
(172, 22, 171676237, 201, '', 1369859865),
(173, 22, NULL, 202, 'testing', 1369984988),
(174, 21, 267779610, 203, 'Anth movie :)', 1370066003),
(175, 21, NULL, 204, 'Simley check ;) :) :| :/ :D :-D :P :$ :@', 1370066165),
(176, 21, NULL, 205, 'Okay :))', 1370074250),
(177, 14, NULL, 206, 'aaaaaaaaaaaaaaaaaa', 1370099187);

-- --------------------------------------------------------

--
-- Table structure for table `moments_with`
--

DROP TABLE IF EXISTS `moments_with`;
CREATE TABLE IF NOT EXISTS `moments_with` (
  `moment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  PRIMARY KEY (`moment_id`,`user_id`,`friend_id`),
  KEY `user_id` (`user_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moments_with`
--

INSERT INTO `moments_with` (`moment_id`, `user_id`, `friend_id`) VALUES
(171, 14, 22),
(174, 21, 14),
(174, 21, 22),
(167, 22, 19),
(167, 22, 21),
(167, 22, 23),
(168, 22, 19),
(168, 22, 21),
(168, 22, 23),
(172, 22, 21),
(172, 22, 23);

--
-- Triggers `moments_with`
--
DROP TRIGGER IF EXISTS `notifications_trigger`;
DELIMITER //
CREATE TRIGGER `notifications_trigger` AFTER INSERT ON `moments_with`
 FOR EACH ROW BEGIN
INSERT INTO notifications
VALUES (null, NEW.friend_id, NEW.user_id, 0, UNIX_TIMESTAMP(NOW()), 1);
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `time` int(11) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`notification_id`),
  KEY `fk_notifi_to_user` (`to_user_id`),
  KEY `fk_notifi_by_user` (`from_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `to_user_id`, `from_user_id`, `is_read`, `time`, `type_id`) VALUES
(1, 19, 22, 0, 1369806099, 1),
(2, 21, 22, 0, 1369806099, 1),
(3, 23, 22, 1, 1369806099, 1),
(4, 19, 22, 0, 1369806361, 1),
(5, 21, 22, 1, 1369806361, 1),
(6, 23, 22, 1, 1369806361, 1),
(7, 22, 14, 1, 1369812831, 1),
(8, 21, 22, 0, 1369859866, 1),
(9, 23, 22, 0, 1369859866, 1),
(10, 14, 21, 1, 1370066004, 1),
(11, 22, 21, 0, 1370066005, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) DEFAULT NULL,
  `moment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `picture_base64` mediumtext,
  `is_public` tinyint(1) DEFAULT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`picture_id`),
  KEY `fk_pictures_users` (`user_id`),
  KEY `fk_pictures_moments` (`moment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `theme_id` int(11) NOT NULL,
  `theme_name` varchar(24) NOT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`theme_id`, `theme_name`) VALUES
(1, ''),
(2, 'blue'),
(3, 'purple'),
(4, 'harmony'),
(5, 'eggplant'),
(6, 'night'),
(7, 'stones'),
(8, 'green');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pswd` varchar(64) NOT NULL,
  `salt` binary(16) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `dp` varchar(24) NOT NULL DEFAULT 'default.jpg',
  `theme_id` int(11) DEFAULT '1',
  `cover` varchar(24) NOT NULL DEFAULT 'default-cover.png',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_users_themes` (`theme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `pswd`, `salt`, `fname`, `lname`, `birthdate`, `phone`, `gender`, `dp`, `theme_id`, `cover`) VALUES
(14, 'admin', 'admin@moments.com', 'dc8fc036e8efffaa5ceeaee7577ffada9b4d7df2c241d5c237740148ee87d001', ']¨1˜r∫°3ÏéÄÓ_†', 'M.', 'Ali', '1990-09-13', '03412371121', 'm', 'admin.jpg', 6, 'admin.jpg'),
(19, 'aaa', 'ali_the_judean2@yahoo.com', '3b161dfaac29c2b2f0b7a0e912365165284d25478d25dfeb614542a697f7a68e', '«£*"µú‚—¶G©ß‰', 'M', 'Ali', NULL, NULL, NULL, 'default.jpg', 1, 'default-cover.png'),
(20, 'm0m0', 'mohsin@moments.net.pk', '7d649e21e74b0a4127b9aab0dc61d0758e370b93dca4419b40229389e88705c5', '›,¡*^oA®ÄCk#å*&=', 'Mohsin', 'Khan', '1991-08-13', '', 'm', 'default.jpg', 5, 'default-cover.png'),
(21, 'addy', 'addy@moments.net.pk', '4706b15e3ac8051312537b2faf226d3161ed5c29c113f9d43a819cf884090ae0', '§AD…°So\0◊&±|&|', 'Adnan', 'Makhani', '2012-01-04', '', '0', 'default.jpg', 7, 'default-cover.png'),
(22, 'asif', 'asif@moments.net.pk', 'b4bf4d477dcbff1455f1027d5e3e380f9e5dc5e58642bf4643106c9c18a5408b', 'ç„èøÅ)U\\˛ı~', 'Asif', 'Niazi', '2005-05-06', '090078601', 'm', 'asif.jpg', 8, 'default-cover.png'),
(23, 'alavi201', 'alavi@moments.net.pk', '0001c3a14c8bd66f7e23377617c39d19c0b338234f02612109b54c88b4007e66', '6@ÌL''&drä{nV˝6', 'Ali', 'Alavi', '1992-02-13', '090078601', 'm', 'default.jpg', 1, 'default-cover.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_friend_assoc`
--

DROP TABLE IF EXISTS `user_friend_assoc`;
CREATE TABLE IF NOT EXISTS `user_friend_assoc` (
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `has_accepted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`friend_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_friend_assoc`
--

INSERT INTO `user_friend_assoc` (`user_id`, `friend_id`, `has_accepted`) VALUES
(21, 14, 1),
(22, 19, 1),
(14, 20, 1),
(22, 21, 1),
(14, 22, 1),
(23, 22, 1),
(20, 23, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`moment_id`) REFERENCES `moments` (`moment_id`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `media_category` (`category_id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_msg_users` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_msg_users2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `moments`
--
ALTER TABLE `moments`
  ADD CONSTRAINT `moments_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `media` (`media_id`),
  ADD CONSTRAINT `moments_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`),
  ADD CONSTRAINT `moments_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `moments_with`
--
ALTER TABLE `moments_with`
  ADD CONSTRAINT `moments_with_ibfk_1` FOREIGN KEY (`moment_id`) REFERENCES `moments` (`moment_id`),
  ADD CONSTRAINT `moments_with_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `moments_with_ibfk_3` FOREIGN KEY (`friend_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifi_by_user` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_notifi_to_user` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `fk_pictures_moments` FOREIGN KEY (`moment_id`) REFERENCES `moments` (`moment_id`),
  ADD CONSTRAINT `fk_pictures_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_themes` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`theme_id`);

--
-- Constraints for table `user_friend_assoc`
--
ALTER TABLE `user_friend_assoc`
  ADD CONSTRAINT `user_friend_assoc_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
