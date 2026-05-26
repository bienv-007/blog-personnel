CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE articles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    is_published TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL
) ENGINE=InnoDB;

INSERT INTO users (name, email, password) VALUES
('Administrateur', 'admin@example.com', '$2y$10$.REbcybsDjJseAMDOBMJ/eXaUXt8HD2x.rnb6XHCOmxjpY4J3xBQ.');

INSERT INTO articles (title, content, image, is_published, created_at) VALUES
('Bienvenue sur mon blog', 'Ceci est un premier article de démonstration. Vous pouvez le modifier ou le supprimer depuis l''administration.', NULL, 1, NOW()),
('Pourquoi apprendre PHP orienté objet ?', 'La programmation orientée objet aide à organiser le code en classes responsables. Dans ce projet, Database gère la connexion, Article gère les articles, User et Auth gèrent la connexion administrateur.', NULL, 1, NOW());
