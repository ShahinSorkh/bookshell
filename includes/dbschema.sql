DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL,
    password VARCHAR(60) NOT NULL,
    role VARCHAR(20) DEFAULT 'user',
    joined_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    last_login DATETIME
);

INSERT INTO users (username, email, password, role) VALUES ('admin', 'admin@local.host', '$2y$10$HyxQDw4rEpPEAL/Ua9IJku.85jdmredVRAOiorLIrtxMBVpK2Wf7K', 'admin');

CREATE TABLE IF NOT EXISTS books (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(60) NOT NULL,
    cover VARCHAR(60) NOT NULL,
    price INT UNSIGNED NOT NULL,
    description TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

