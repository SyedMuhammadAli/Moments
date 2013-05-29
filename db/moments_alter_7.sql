--insert a notification for every time a user is tagged in a moment. Type = 1 for being tagged in a moment.
delimiter $$
CREATE TRIGGER notifications_trigger
AFTER INSERT ON moments_with
FOR EACH ROW
BEGIN
INSERT INTO notifications
VALUES (null, NEW.friend_id, NEW.user_id, 0, UNIX_TIMESTAMP(NOW()), 1);
END$$
