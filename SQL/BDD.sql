CREATE DATABASE OpenInnov;
USE OpenInnov;


CREATE TABLE Soutenance(
   id_soutenance VARCHAR(50),
   date_soutenance DATE NOT NULL,
   PRIMARY KEY(id_soutenance)
);

CREATE TABLE Projet(
   id_projet VARCHAR(50),
   validation boolean NOT NULL,
   nom_projet VARCHAR(50) NOT NULL,
   id_soutenance VARCHAR(50) NOT NULL,
   id_createur VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_projet),
   FOREIGN KEY(id_soutenance) REFERENCES Soutenance(id_soutenance),
   FOREIGN KEY(id_createur) REFERENCES Participant(id_participant)
);

CREATE TABLE Description(
   id_description VARCHAR(50),
   fichier_description VARCHAR(50),
   texte_description VARCHAR(50),
   besoins VARCHAR(50),
   technos VARCHAR(50),
   etapes VARCHAR(50),
   competances VARCHAR(50),
   id_projet VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_description),
   FOREIGN KEY(id_projet) REFERENCES Projet(id_projet)
);

CREATE TABLE Rendu(
   id_rendu VARCHAR(50),
   date_rendu DATE,
   fichier_rendu VARCHAR(50) NOT NULL,
   id_projet VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_rendu),
   FOREIGN KEY(id_projet) REFERENCES Projet(id_projet)
);

CREATE TABLE Groupe(
   id_groupe VARCHAR(50),
   numero_groupe INT,
   id_projet VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_groupe),
   FOREIGN KEY(id_projet) REFERENCES Projet(id_projet)
);

CREATE TABLE Participant(
   id_participant VARCHAR(50),
   nom_participant VARCHAR(50) NOT NULL,
   prenom_participant VARCHAR(50) NOT NULL,
   promo VARCHAR(50) NOT NULL,
   email VARCHAR(50) NOT NULL,
   id_groupe VARCHAR(50),
   id_groupe_1 VARCHAR(50),
   PRIMARY KEY(id_participant),
   FOREIGN KEY(id_groupe) REFERENCES Groupe(id_groupe),
   FOREIGN KEY(id_groupe_1) REFERENCES Groupe(id_groupe)
);
