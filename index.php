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
   $host = 'localhost';
   $dbname = 'location_voiture';
   $username = 'root';
   $password = '';
   
   try {
       $dsn = "mysql:host=$host;dbname=$dbname";
       $options = [
           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
           PDO::ATTR_EMULATE_PREPARES => false,
       ];
       
       // Correction de l'ordre des paramètres
       $conn = new PDO($dsn, $username, $password, $options);
       echo "Connected successfully";
   } catch (PDOException $e) {
       echo "Connection failed: " . $e->getMessage();
   }

   
    // ajout voiture

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $annee = $_POST['annee'];
    $kilometrage = $_POST['kilometrage'];
    $disponibilite = isset($_POST['disponibilite']) ? 1 : 0;

    $sql = "INSERT INTO Voiture (marque, modèle, année, kilométrage, disponibilité) VALUES ('$marque', '$modele', $annee, $kilometrage, $disponibilite)";

    if ($conn->query($sql) === TRUE) {
        echo "Nouvelle voiture ajoutée avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
};

// ajout client

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $permis = $_POST['permis'];

    $sql = "INSERT INTO Client (nom, prénom, adresse, email, numéro_téléphone, numéro_permis_conduire) VALUES ('$nom', '$prenom', '$adresse', '$email', '$telephone', '$permis')";

    if ($conn->query($sql) === TRUE) {
        echo "Nouveau client ajouté avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
};

// Réservation voiture

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_voiture = $_POST['id_voiture'];
    $id_client = $_POST['id_client'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $cout_total = (strtotime($date_fin) - strtotime($date_debut)) / (60 * 60 * 24) * 30;

    $sql = "INSERT INTO Réservation (id_voiture, id_client, date_début, date_fin, coût_total) VALUES ($id_voiture, $id_client, '$date_debut', '$date_fin', $cout_total)";

    if ($conn->query($sql) === TRUE) {
        $conn->query("UPDATE Voiture SET disponibilité = FALSE WHERE id_voiture = $id_voiture");
        echo "Nouvelle réservation ajoutée avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}



?>
  
</html>

