CREATE TABLE messages (
	message_id INT(11) NOT NULL AUTO_INCREMENT,
	message_text VARCHAR(512) NOT NULL,
	PRIMARY KEY(message_id)
);

--group support postponed for a later version
CREATE TABLE message_user_assoc (
	message_id INT(11) NOT NULL,
	receiver_id INT(11) NOT NULL,
	sender_id INT(11) NOT NULL,
	CONSTRAINT fk_msgassoc_msg FOREIGN KEY (message_id) REFERENCES messages(message_id),
	CONSTRAINT fk_msgassoc_users FOREIGN KEY (sender_id) REFERENCES users(user_id),
	CONSTRAINT fk_msgassoc_users2 FOREIGN KEY (receiver_id) REFERENCES users(user_id),
	PRIMARY KEY (message_id, receiver_id, sender_id)
);

DROP TABLE message_user_assoc;

ALTER TABLE messages ADD COLUMN time INT(11) NOT NULL;
ALTER TABLE messages ADD COLUMN sender_id INT(11) NOT NULL;
ALTER TABLE messages ADD COLUMN receiver_id INT(11) NOT NULL;

ALTER TABLE messages ADD CONSTRAINT fk_msg_users FOREIGN KEY (sender_id) REFERENCES users(user_id);
ALTER TABLE messages ADD CONSTRAINT fk_msg_users2 FOREIGN KEY (receiver_id) REFERENCES users(user_id);