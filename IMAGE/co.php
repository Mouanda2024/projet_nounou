<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = ""; // Assurez-vous d'utiliser un mot de passe sécurisé en production
$basededonnees = "airnounou";

// Connexion à la base de données MySQL
$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $basededonnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

// Récupérer et nettoyer les données du formulaire
$prenom = mysqli_real_escape_string($connexion, $_POST['prenom']);
$nom = mysqli_real_escape_string($connexion, $_POST['nom']);
$email = mysqli_real_escape_string($connexion, $_POST['email']);
$mot_de_passe = mysqli_real_escape_string($connexion, $_POST['mot_de_passe']);

// Requête d'insertion des données dans la table appropriée
$sql = "INSERT INTO utilisateur (prenom, nom, email, mot_de_passe) VALUES ('$prenom', '$nom', '$email', '$mot_de_passe')";

// Exécuter la requête et vérifier son succès
if ($connexion->query($sql) === TRUE) {
    echo "connexion réussie !";
} else {
    echo "Erreur lors de la connexion. Veuillez réessayer ultérieurement.";
}

// Fermer la connexion à la base de données
$connexion->close();
?>
