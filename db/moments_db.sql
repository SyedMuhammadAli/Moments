CREATE TABLE location (
  location_id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(30) NOT NULL,
  time TIME NOT NULL,
  PRIMARY KEY(location_id)
);

CREATE TABLE users (
  user_id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(32) NOT NULL,
  pswd VARCHAR(64) NOT NULL,
  salt BINARY(16) NOT NULL,
  fname VARCHAR(30) NOT NULL,
  lname VARCHAR(30) NOT NULL,
  email VARCHAR(48) NOT NULL,
  birthdate DATE,
  phone VARCHAR(12),
  gender CHAR(1),
  dp varchar(24) NOT NULL DEFAULT 'default.jpg',
  PRIMARY KEY(user_id)
);

CREATE TABLE activity (
  activity_id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(30) NULL,
  PRIMARY KEY(activity_id)
);

CREATE TABLE media_category (
  category_id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(30) NULL,
  PRIMARY KEY(category_id)
);

CREATE TABLE notifications (
  notifications_id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  time TIME NOT NULL,
  msg VARCHAR(96) NOT NULL,
  PRIMARY KEY(notifications_id),
  FOREIGN KEY(user_id)
    REFERENCES users(user_id)
);

CREATE TABLE user_friend_assoc (
  user_id INT(11) NOT NULL,
  friend_id INT(11) NOT NULL,
  has_accepted BOOL NOT NULL DEFAULT 0,
  PRIMARY KEY(friend_id, user_id),
  FOREIGN KEY(user_id)
    REFERENCES users(user_id)
);

CREATE TABLE media (
  media_id INT(11) NOT NULL AUTO_INCREMENT,
  category_id INT(11) NOT NULL,
  name VARCHAR(30) NOT NULL,
  date_added DATE,
  path VARCHAR(256),
  PRIMARY KEY(media_id),
  FOREIGN KEY(category_id)
    REFERENCES media_category(category_id)
);

CREATE TABLE moments (
  moment_id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  media_id INT(11),
  location_id INT(11),
  msg VARCHAR(256),
  time int(11) NOT NULL,
  PRIMARY KEY(moment_id),
  FOREIGN KEY(media_id)
    REFERENCES media(media_id),
  FOREIGN KEY(location_id)
    REFERENCES location(location_id),
  FOREIGN KEY(user_id)
    REFERENCES users(user_id)
);

CREATE TABLE comments (
  comment_id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  moment_id INT(11) NOT NULL,
  msg VARCHAR(160),
  time TIME NOT NULL,
  PRIMARY KEY(comment_id),
  FOREIGN KEY(user_id)
    REFERENCES users(user_id),
  FOREIGN KEY(moment_id)
    REFERENCES moments(moment_id)
);

CREATE TABLE moments_with (
  moment_id INT(11) NOT NULL,
  user_id INT(11) NOT NULL,
  friend_id INT(11) NOT NULL,
  PRIMARY KEY(moment_id, user_id, friend_id),
  FOREIGN KEY(moment_id)
    REFERENCES moments(moment_id),
  FOREIGN KEY(user_id)
    REFERENCES users(user_id),
  FOREIGN KEY(friend_id)
    REFERENCES users(user_id)
);

