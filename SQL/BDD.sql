CREATE DATABASE OpenInnov;
USE OpenInnov;


CREATE TABLE Soutenance(
   id_soutenance INT NOT NULL AUTO_INCREMENT,
   date_soutenance DATE NOT NULL,
   id_projet INT NOT NULL,
   PRIMARY KEY(id_soutenance)
);

CREATE TABLE Projet(
   id_projet INT NOT NULL AUTO_INCREMENT,
   validation boolean NOT NULL,
   nom_projet VARCHAR(50) NOT NULL,
   url_img varchar(50) NOT NULL,
   id_createur INT NOT NULL,
   PRIMARY KEY(id_projet)
);

CREATE TABLE Description(
   id_description INT NOT NULL AUTO_INCREMENT,
   fichier_description VARCHAR(50),
   texte_description TEXT(5000),
   besoins TEXT(5000),
   technos TEXT(5000),
   etapes TEXT(5000),
   competances TEXT(5000),
   id_projet INT NOT NULL,
   PRIMARY KEY(id_description)
);

CREATE TABLE Rendu(
   id_rendu INT NOT NULL AUTO_INCREMENT,
   date_rendu DATE,
   titre_rendu VARCHAR(50) NOT NULL,
   consignes TEXT(5000) NOT NULL,
   id_projet INT NOT NULL,
   PRIMARY KEY(id_rendu)
);

CREATE TABLE Fichier(
   id_fichier INT NOT NULL AUTO_INCREMENT,
   destination VARCHAR(50) NOT NULL,
   date_rendu DATE NOT NULL,
   commentaire TEXT(5000),
   id_rendu INT NOT NULL,
   PRIMARY KEY(id_fichier)
);

CREATE TABLE Groupe(
   id_groupe INT NOT NULL AUTO_INCREMENT,
   numero_groupe INT,
   id_projet INT NOT NULL,
   PRIMARY KEY(id_groupe)
);

CREATE TABLE Participant(
   id_participant INT NOT NULL AUTO_INCREMENT,
   nom_participant VARCHAR(50) NOT NULL,
   prenom_participant VARCHAR(50) NOT NULL,
   promo VARCHAR(50) NOT NULL,
   email VARCHAR(50) NOT NULL,
   id_groupe INT,
   id_groupe_1 INT,
   PRIMARY KEY(id_participant)
);

ALTER TABLE Soutenance
   ADD CONSTRAINT FK_id_projet_soutenance FOREIGN KEY(id_projet) REFERENCES Projet(id_projet);

ALTER TABLE Projet
   ADD CONSTRAINT FK_id_createur FOREIGN KEY(id_createur) REFERENCES Participant(id_participant);

ALTER TABLE Description
   ADD CONSTRAINT FK_id_projet_description FOREIGN KEY(id_projet) REFERENCES Projet(id_projet);
   
ALTER TABLE Rendu
   ADD CONSTRAINT FK_id_projet_rendu FOREIGN KEY(id_projet) REFERENCES Projet(id_projet);

ALTER TABLE Groupe
   ADD CONSTRAINT FK_id_projet_groupe FOREIGN KEY(id_projet) REFERENCES Projet(id_projet);

ALTER TABLE Participant
   ADD CONSTRAINT FK_id_groupe_participant FOREIGN KEY(id_groupe) REFERENCES Groupe(id_groupe);

ALTER TABLE Participant
   ADD CONSTRAINT FK_id_groupe1_participant FOREIGN KEY(id_groupe_1) REFERENCES Groupe(id_groupe);

ALTER TABLE Fichier
   ADD CONSTRAINT FK_id_rendu_fichier FOREIGN KEY(id_rendu) REFERENCES Rendu(id_rendu);

INSERT INTO `projet` (`id_projet`, `validation`, `nom_projet`, `url_img`) VALUES ('1', '1', 'verif-equation', 'files/verif-equation/image.jpg');

INSERT INTO `description` (`id_description`, `fichier_description`, `texte_description`, `besoins`, `technos`, `etapes`, `competances`, `id_projet`) VALUES ('1', 'files/verif-equation/description.pdf', 'Verif-equation à pour but l\'entraide des etudiants dans la résolution des équations !', 'Ont à besoins de rien dans la vie ! Vivont heureux !', 'Euh disont que j\'ai pas trop réfléchit aux technos donc démerder vous !', 'Alors sa serra en 3 étapes réflexion, determination, attaque !', 'Pas besoins de compétances tout le monde est bienvenue !', '1');

INSERT INTO `participant` (`id_participant`, `nom_participant`, `prenom_participant`, `promo`, `email`, `id_groupe`, `id_groupe_1`) VALUES ('1', 'Fouvry', 'Antoine', 'B1', 'antoine.fouvry@epsi.fr', '1', NULL);

UPDATE `projet` SET `id_createur` = `1`;