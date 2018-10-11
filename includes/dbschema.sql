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
INSERT INTO users (username, email, password, role) VALUES ('test', 'test@local.host', '$2y$10$6xw37IavGPJXnk2zZWo1L.PrHQWPxysmUL43d9SzKO4vfZOynCnA6', 'user');

CREATE TABLE IF NOT EXISTS books (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(60) NOT NULL,
    cover VARCHAR(60) NOT NULL,
    path VARCHAR(60) NOT NULL,
    price INT UNSIGNED NOT NULL,
    description TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS orders (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    book_id INT UNSIGNED NOT NULL,
    price INT UNSIGNED NOT NULL,
    delivered_at DATETIME DEFAULT NULL,
    ordered_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);

