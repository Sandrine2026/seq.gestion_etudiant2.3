CREATE DATABASE gestion_etudiants;

USE gestion_etudiants;

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe_hache VARCHAR(255) NOT NULL
);

CREATE TABLE etudiants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    filiere VARCHAR(100) NOT NULL
);