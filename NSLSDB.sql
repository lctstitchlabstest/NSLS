<?sql

CREATE TABLE IF NOT EXISTS account (
  id INT UNSIGNED AUTO_INCREMENT NOT NULL ,
  name   VARCHAR(35) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL, 
  email VARCHAR(35) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  recordtime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY ( id ),
  UNIQUE KEY (name, email)
) ; 
