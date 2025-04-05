CREATE TABLE posts (
id INT AUTO_INCREMENT PRIMARY KEY,
users_id INT unsigned,
title VARCHAR(200) DEFAULT "",
description VARCHAR(255) DEFAULT "",
likes INT DEFAULT 0,
image_path VARCHAR(255),
created_at DATETIME NOT NULL,
created_by INT unsigned NOT NULL,
FOREIGN KEY (users_id) REFERENCES users(id)
);