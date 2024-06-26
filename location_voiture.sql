CREATE TABLE Voiture (
  id_voiture INT AUTO_INCREMENT PRIMARY KEY,
  marque VARCHAR(50),
  modèle VARCHAR(50),
  année INT,
  kilométrage INT,
  disponibilité BOOLEAN
);

CREATE TABLE Client (
  id_client INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(50),
  prénom VARCHAR(50),
  adresse VARCHAR(100),
  email VARCHAR(50),
  numéro_téléphone VARCHAR(15),
  numéro_permis_conduire VARCHAR(20)
);

CREATE TABLE Réservation (
  id_réservation INT AUTO_INCREMENT PRIMARY KEY,
  id_voiture INT,
  id_client INT,
  date_début DATE,
  date_fin DATE,
  coût_total DECIMAL(10, 2),
  FOREIGN KEY (id_voiture) REFERENCES Voiture(id_voiture),
  FOREIGN KEY (id_client) REFERENCES Client(id_client)
);

/*ajouter une nouvelle voiture*/

INSERT INTO Voiture (marque, modèle, année, kilométrage, disponibilité)
VALUES ('Toyota', 'Corolla', 2020, 15000, TRUE);
SELECT id_voiture, marque, modèle, année, kilométrage, disponibilité FROM Voiture;

/*ajouter un nouveau client*/

INSERT INTO Client (nom, prénom, adresse, email, numéro_téléphone, numéro_permis_conduire)
VALUES ('Dupont', 'Jean', '123 Rue de la Paix, Paris', 'jean.dupont@example.com', '0123456789', 'A12345678');
SELECT id_client, nom, prénom, adresse, email, numéro_téléphone, numéro_permis_conduire FROM Client;

/*ajouter une nouvelle réservation*/
INSERT INTO Réservation (id_voiture, id_client, date_début, date_fin, coût_total)
VALUES (1, 1, '2024-06-10', '2024-06-20', 300.00);
SELECT id_réservation, id_voiture, id_client, date_début, date_fin, coût_total FROM Réservation;

/*lister les voitures disponibles*/
SELECT id_voiture, marque, modèle, année, kilométrage, disponibilité FROM Voiture where disponibilité = TRUE;

/*Afficher les informations d'un client spécifique*/
SELECT id_client, nom, prénom, adresse, email, numéro_téléphone, numéro_permis_conduire FROM Client WHERE id_client = 1;

/*Lister les réservations d'un client*/
SELECT id_voiture, id_client, date_début, date_fin, coût_total FROM Réservation WHERE id_client = 1;

/*Mettre à jour les informations d'une voiture*/
UPDATE Voiture
SET kilométrage = 20000, disponibilité = FALSE
WHERE id_voiture = 1;

/*Mettre à jour les informations d'un client */
UPDATE Client
SET email = 'nouveau.email@example.com'
WHERE id_client = 1;

-- Comment prolonger la durée d'une réservation 
UPDATE Réservation
SET date_fin = '2024-06-25'
WHERE id_réservation = 1;

/*Supprimer une voiture */
DELETE FROM Voiture WHERE id_voiture = 1;

/*Supprimer un client*/
DELETE FROM Client WHERE id_client = 1;

/*Supprimer une réservation */
DELETE FROM Réservation WHERE id_réservation = 1;

/*Comment s'assurer qu'une voiture ne peut être louée que si elle est disponible*/
INSERT INTO Réservation (id_voiture, id_client, date_début, date_fin, coût_total)
SELECT 1, 1, '2024-06-10', '2024-06-20', 300.00
FROM Voiture
WHERE id_voiture = 1 AND disponibilité = TRUE;

/*Comment gérer les conflits de réservation (par exemple, deux clients essayant de réserver la même voiture pour la même période)*/
ALTER TABLE Réservation
ADD CONSTRAINT UNIQUE (id_voiture, date_début, date_fin);

-- Comment mettre à jour la disponibilité d'une voiture lorsque celle-ci est réservée ou retournée ?
CREATE TRIGGER update_voiture_disponibilite
AFTER INSERT ON Réservation
FOR EACH ROW
BEGIN
  UPDATE Voiture
  SET disponibilité = FALSE
  WHERE id_voiture = NEW.id_voiture
END;

-- Comment calculer automatiquement le coût total d'une réservation en fonction des jours de location ?
CREATE TRIGGER calculate_cost
BEFORE INSERT ON Réservation
FOR EACH ROW
BEGIN
  SET NEW.coût_total = DATEDIFF(NEW.date_fin, NEW.date_début) * 30.00;
END;

-- Question 25 
SELECT count(*) as NombreReservation FROM Reservation 
WHERE id_voiture = 1 AND "2024-06-17" BETWEEN date_debut AND date_fin;
-- Vérifier que NombreReservation = 0 pour pouvoir faire une autre reservation

INSERT INTO Reservation VALUES (?,?,?,?,?);
-- Inserer ma nouvelle réservation 

Update Voiture set disponibilite = false where id_voiture = 1;
-- Vient mettre a jour la dispo si la date de reservation est courante (Aujourd'hui)

-- Question 26

SELECT numero_permi FROM client WHERE id_client = 1;
-- Vérifier que le numéro de permis est bien renseigné et valide 

INSERT INTO reservation VALUES (?,?,?,?,?);  
-- insere la nouvelle reservation


-- Question 27

SELECT count(*) as NombreReservation from reservation where id_voiture = 1 AND '2024-06-20' 
between date_debut AND date_fin; 
-- Si NombreReservation = 0 on insert sinon on renvoie un message d'erreur

INSERT INTO reservation VALUES (?,?,?,?,?);

-- Question 28

SELECT count(*) from reservation WHERE id_voiture= 1 AND now() between date_debut and date_fin;
-- Verifie que aucune reservation pour le vehicule x est faite aujourd'hui

UPDATE voiture set disponibilite = true where id_voiture = 1;

-- Question 29
insert into reservation (id_voiture, id_client, date_debut, date_fin, cout_total)
VALUES (1, 1, '2024-06-20', '2024-06-30', DATEDIFF('2024-06-30', '2024-06-20')*cout_journalier);

-- Question 30 

-- exemple de trigger 
-- CREATE OR REPLACE TRIGGER trigg_example
--  BEFORE INSERT OR UPDATE ON table_example
--  FOR EACH ROW
--  WHEN (new.no_line > 0)
--  DECLARE
--      evol_exemple number;
--  BEGIN
--      evol_exemple := :new.exemple  - :old.exemple;
--      DBMS_OUTPUT.PUT_LINE('  evolution : ' || evol_exemple);
--  END;



























