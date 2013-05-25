CREATE TABLE pictures (
  picture_id int(11) AUTO_INCREMENT,
  album_id int(11), -- for future extensions
  user_id int(11),
  picture_base64 mediumtext,
  is_public tinyint(1),
  CONSTRAINT fk_pictures_users FOREIGN KEY (user_id) REFERENCES users(user_id),
  PRIMARY KEY (picture_id)
);
