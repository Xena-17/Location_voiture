<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Voitures</title>
    <link rel="stylesheet" href="index.css">
   </head>
<body>
    <h1>Bienvenue sur notre plateforme de réservation de voitures</h1>
    <nav>
        <ul>
            <li><a href="ajout_voiture.php">Ajouter une Voiture</a></li>
            <li><a href="ajout_client.php">Ajouter un Client</a></li>
            <li><a href="reservation.php">Faire une Réservation</a></li>
            <li><a href="liste_voitures.php">Voir Voitures Disponibles</a></li>
            <li><a href="client_info.php">Voir Info Client</a></li>
            <li><a href="liste_reservations.php">Voir Réservations Client</a></li>
        </ul>
    </nav>
        <h2>Ajouter une Voiture</h2>
        <form action="ajout_voiture.php" method="post">
            <input type="text" name="marque" placeholder="Marque" required>
            <input type="text" name="modele" placeholder="Modèle" required>
            <input type="number" name="annee" placeholder="Année" required>
            <input type="number" name="kilometrage" placeholder="Kilométrage" required>
            <label for="disponibilite">Disponible :</label>
            <input type="checkbox" name="disponibilite" id="disponibilite">
            <button type="submit">Ajouter</button>
        </form>
        <h2>Ajouter un Client</h2>
        <form action="ajout_client.php" method="post">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="text" name="adresse" placeholder="Adresse" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="telephone" placeholder="Numéro de Téléphone" required>
            <input type="text" name="permis" placeholder="Numéro de Permis de Conduire" required>
            <button type="submit">Ajouter</button>
        </form>
        <h2>Faire une Réservation</h2>
        <form action="reservation.php" method="post">
            <input type="number" name="id_voiture" placeholder="ID Voiture" required>
            <input type="number" name="id_client" placeholder="ID Client" required>
            <input type="date" name="date_debut" placeholder="Date de Début" required>
            <input type="date" name="date_fin" placeholder="Date de Fin" required>
            <button type="submit">Réserver</button>
        </form>
    
</body>
<?php
   $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "location_voiture";
    
    // Créez une connexion
    $conn = new PDO($servername, $username, $password, $dbname);
    
    // Vérifiez la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    };
    

?>
  
</html>

