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
    FOREIGN KEY (continents_id) REFERENCES continents(id)


                       
);

CREATE TABLE articles (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL ,
    image VARCHAR(255),
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

INSERT INTO countries (name, continents_id) VALUES ('Maroc', 1), ('Tunisie', 1), ('Nigeria', 1), ('Cameroun', 1), ('Mozambique', 1);
INSERT INTO countries (name, continents_id) VALUES ('Etats-Unis', 2), ('Canada', 2), ('Alaska', 2), ('Mexique', 2);
INSERT INTO countries (name, continents_id) VALUES ('Perou', 3), ('Argentine', 3), ('Brésil', 3), ('Colombie', 3), ('Chili', 3);
INSERT INTO countries (name, continents_id) VALUES ('Japon', 4), ('Mongolie', 4), ('Vietnam', 4), ('Thailande', 4), ('Corée du Sud', 4);
INSERT INTO countries (name, continents_id) VALUES ('France', 5), ('Italie', 5), ('Espagne', 5), ('Portugal', 5), ('Croatie', 5);
INSERT INTO countries (name, continents_id) VALUES ('Australie', 6), ('Nouvelle-Zelande', 6), ('Philippines', 6);

INSERT INTO categories(name) VALUES ('Destinations'), ('Gastronomie'), ('Logement');
INSERT INTO articles(title, date, content, categories_id, countries_id) VALUES ('Article traitant de la gastronomie Chilienne', '2019-10-18',
            'Voici du contenu pour créer une base de données superbement bien établie avec tout plein texte qui parle de bouffe au Chili', '2', 14 );



