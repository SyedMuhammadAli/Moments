ALTER TABLE users ADD COLUMN cover VARCHAR(24) NOT NULL DEFAULT 'default-cover.png';

ALTER TABLE themes CHANGE COLUMN name theme_name VARCHAR(24) NOT NULL;
