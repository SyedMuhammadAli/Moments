--now saving latitude and longitude instead
ALTER TABLE location DROP COLUMN name;

ALTER TABLE location ADD COLUMN latitude FLOAT(10,6) NOT NULL;
ALTER TABLE location ADD COLUMN longitude FLOAT(10,6) NOT NULL;
ALTER TABLE location ADD COLUMN address VARCHAR(80) NOT NULL;

