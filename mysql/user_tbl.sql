CREATE TABLE user(
	id INTEGER AUTO_INCREMENT,
	user_code VARCHAR(20) NOT NULL,
	user_status VARCHAR(20) NOT NULL,
	user_name VARCHAR(20) NOT NULL,
	password VARCHAR(40) NOT NULL,
	created_at DATETIME,
	PRIMARY KEY(id),
	UNIQUE KEY user_name_index(user_name)
) ENGINE = INNODB;
