-- Creazione tabella "users"
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    nome VARCHAR(100) NOT NULL,
    cognome VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Creazione tabella "appointments"
CREATE TABLE appointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    appo_slot VARCHAR(50) NOT NULL,
    appo_date DATE NOT NULL,
    confirmed ENUM('SI', 'NO') DEFAULT 'NO',
    CONSTRAINT fk_user_email FOREIGN KEY (email) REFERENCES users(email)
);
