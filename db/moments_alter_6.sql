--increased size because some urls were long
ALTER TABLE media CHANGE COLUMN artworkUrl artworkUrl VARCHAR(256);

--new schema for the notification table
DROP TABLE IF EXISTS notifications;
CREATE TABLE notifications (
	notification_id int(11) not null auto_increment, 
	to_user_id int(11) not null, 
	from_user_id int(11), 
	is_read bool default 0, 
	time int(11),
	type_id int(11)
	PRIMARY KEY (notification_id)
);

ALTER TABLE notifications ADD CONSTRAINT fk_notifi_to_user FOREIGN KEY (to_user_id) REFERENCES users(user_id);
ALTER TABLE notifications ADD CONSTRAINT fk_notifi_by_user FOREIGN KEY (from_user_id) REFERENCES users(user_id);

--uniqueness for username and email
ALTER TABLE users ADD UNIQUE (username);
ALTER TABLE users ADD UNIQUE (email);

