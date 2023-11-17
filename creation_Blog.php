<?php

$dsn = "mysql:host=localhost;dbname=octechusers";
$utilisateur = 'root';
$motDePasseDB = '';

$connexion = new PDO($dsn, $utilisateur, $motDePasseDB);
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $type_jeux = $_POST["type_jeux"];

    // Traitement de l'image (téléchargement, validation, etc.)
    $dossier_cible = "chemin/vers/dossier/";
    $nom_fichier = $_FILES["image"]["name"];
    $chemin_fichier = $dossier_cible . $nom_fichier;

    // Ajoutez ici le code pour déplacer l'image téléchargée vers le dossier cible

    // Utilisation de requête préparée pour éviter l'injection SQL
    $requete_insertion = $connexion->prepare("INSERT INTO blog (nom, type, img) VALUES (?, ?, ?)");
    $requete_insertion->bindParam(1, $nom);
    $requete_insertion->bindParam(2, $type_jeux);
    $requete_insertion->bindParam(3, $chemin_fichier);

    // Exécution de la requête préparée
    $requete_insertion->execute();
    header("Location: octech_accueil.php");
}
?>