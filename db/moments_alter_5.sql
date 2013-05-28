-- theme table by Alavi and TDK

CREATE TABLE IF NOT EXISTS `themes` (
  `theme_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`theme_id`)
);

INSERT INTO `themes` (`theme_id`, `name`) VALUES
(1, 'default'),
(2, 'blue'),
(3, 'purple'),
(4, 'harmony');

ALTER TABLE users ADD COLUMN theme_id INT(11) DEFAULT 1;
ALTER TABLE users ADD CONSTRAINT fk_users_themes FOREIGN KEY (theme_id) REFERENCES themes(theme_id);

