DROP TABLE user;

CREATE TABLE IF NOT EXISTS user (
  id INT PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(255)
);

INSERT INTO user (email) VALUES ("user1@test.de");
