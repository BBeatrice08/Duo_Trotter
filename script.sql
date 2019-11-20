DROP DATABASE duo_trotter;
CREATE DATABASE duo_trotter;
USE duo_trotter;
CREATE TABLE categories (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150)
);
CREATE TABLE continents (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL

);
CREATE TABLE countries (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    continents_id INT NOT NULL,
    image TEXT,
    FOREIGN KEY (continents_id) REFERENCES continents(id)
);
CREATE TABLE articles (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL ,
    image TEXT,
    date DATE,
    content MEDIUMTEXT,
    categories_id INT,
    countries_id INT,
    FOREIGN KEY (categories_id) REFERENCES categories(id),
    FOREIGN KEY (countries_id) REFERENCES countries(id)
);
CREATE TABLE comments (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    date DATE,
    user_name VARCHAR(150) NOT NULL,
    content TEXT,
    articles_id INT,
    FOREIGN KEY (articles_id) REFERENCES articles(id)
);

INSERT INTO continents (name) VALUES ('Afrique'), ('Amerique du Nord'),('Amerique du Sud'), ('Asie'), ('Europe'), ('Oceanie');

