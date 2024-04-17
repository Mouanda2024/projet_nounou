<?php

// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$basededonnees = "airnounou";

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $basededonnees);

if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

// Vérifier si les données du formulaire ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et nettoyer les données du formulaire
    $email = $connexion->real_escape_string($_POST['email']);
    $motdepasse = $connexion->real_escape_string($_POST['mot_de_passe']);

    // Requête de sélection des données de l'utilisateur
    $sql = "SELECT id, prenom, nom, email, mot_de_passe FROM utilisateur WHERE email = ?";

    // Préparer la requête
    $stmt = $connexion->prepare($sql);
    if (!$stmt) {
        die("Erreur de préparation de la requête: " . $connexion->error);
    }

    // Lier le paramètre
    $stmt->bind_param("s", $email);

    // Exécuter la requête
    $stmt->execute();

    // Liaison des résultats
    $stmt->bind_result($id_utilisateur, $prenom, $nom, $email_db, $mot_de_passe_db);

    // Vérifier l'authentification
    if (!empty($email) && !empty($mot_de_passe)) {
        // Authentification réussie, rediriger vers la page restreinte
        session_start();
        $_SESSION['id_utilisateur'] = $id_utilisateur;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;
        header("Location: identificationrestricte.php");
        exit();
    } else {
        // Authentification échouée, afficher un message d'erreur
        echo "Identifiants incorrects. Veuillez réessayer.";
    }

    // Fermer la connexion à la base de données
    $stmt->close();
} else {
    // Si la méthode de requête n'est pas POST, afficher un message d'erreur
    echo "Erreur : la méthode de requête n'est pas POST.";
}

$connexion->close();
?>
