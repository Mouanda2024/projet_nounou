<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["id_utilisateur"])) {
    header("Location: co.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style copy.css">
    <link rel="apple-touch-icon" href="favicon.png">
    <title>PAGE RESTREINTE - airnounou</title>
</head>
<body>
    <header>
        <!-- Votre en-tête ici -->

        <div class="titre">
            <h1>PAGE RESTREINTE</h1>
            <?php echo "Bienvenue, " . $_SESSION['prenom'] . " " . $_SESSION['nom']; 
            ?>
        </div>
    </header>

    <!-- Liens vers les pages Match, Billet et Réservation -->
    <nav>
        <ul>
            <li><a href="#">UTILISATEUR</a></li>
            <li><a href="#">S'INSCRIRE</a></li>
            <li><a href="#">NOUNOUS</a></li>
        </ul>
    </nav>

    <!-- Reste du contenu de la page -->

</body>
</html>
