CREATE TABLE users (
id INT unsigned auto_increment,
created_at DATETIME NOT NULL,
full_name VARCHAR(200) DEFAULT "",
email VARCHAR(255) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
created_by INT unsigned NOT NULL,
bio VARCHAR(255) DEFAULT "",
PRIMARY KEY (id)
);