SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `time` time NOT NULL,
  `longitude` float(10,6) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `address` varchar(80) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `media_category`;
CREATE TABLE IF NOT EXISTS `media_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `moments_with`;
CREATE TABLE IF NOT EXISTS `moments_with` (
  `moment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  PRIMARY KEY (`moment_id`,`user_id`,`friend_id`),
  KEY `user_id` (`user_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
DROP TRIGGER IF EXISTS `notifications_trigger`;
DELIMITER //
CREATE TRIGGER `notifications_trigger` AFTER INSERT ON `moments_with`
 FOR EACH ROW BEGIN
INSERT INTO notifications
VALUES (null, NEW.friend_id, NEW.user_id, 0, UNIX_TIMESTAMP(NOW()), 1);
END
//
DELIMITER ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `theme_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_users_themes` (`theme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `user_friend_assoc`;
CREATE TABLE IF NOT EXISTS `user_friend_assoc` (
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `has_accepted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`friend_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`moment_id`) REFERENCES `moments` (`moment_id`);

ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `media_category` (`category_id`);

ALTER TABLE `moments`
  ADD CONSTRAINT `moments_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `media` (`media_id`),
  ADD CONSTRAINT `moments_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`),
  ADD CONSTRAINT `moments_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `moments_with`
  ADD CONSTRAINT `moments_with_ibfk_1` FOREIGN KEY (`moment_id`) REFERENCES `moments` (`moment_id`),
  ADD CONSTRAINT `moments_with_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `moments_with_ibfk_3` FOREIGN KEY (`friend_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifi_by_user` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_notifi_to_user` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `pictures`
  ADD CONSTRAINT `fk_pictures_moments` FOREIGN KEY (`moment_id`) REFERENCES `moments` (`moment_id`),
  ADD CONSTRAINT `fk_pictures_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_themes` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`theme_id`);

ALTER TABLE `user_friend_assoc`
  ADD CONSTRAINT `user_friend_assoc_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
