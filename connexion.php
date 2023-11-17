<?php
// Vérifier si une session est déjà active avant d'appeler session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Déplacez la partie PHP en haut du fichier
$serveur = 'localhost';
$login = 'root';
$pass = '';

// Initialiser la variable isConnected à false
$isConnected = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si le formulaire a été soumis
    echo 'formulaire soumis<br/>';
    if (isset($_POST['email_C']) && isset($_POST['mdp_C'])) {
        // Récupérer les données du formulaire
        $email = $_POST['email_C'];
        $motDePasse = $_POST['mdp_C'];
        $name = "user";
        $id = 0;
        echo 'données récupérées<br/>';

        // Connexion à la base de données (à remplacer par vos propres informations)
        $dsn = "mysql:host=$serveur;dbname=octechusers";
        $utilisateur = 'root';
        $motDePasseDB = '';

        try {
            $connexion = new PDO($dsn, $utilisateur, $motDePasseDB);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour vérifier l'existence de l'utilisateur avec des variables liées
            $requete = "SELECT password FROM users WHERE email = :email";

            $statement = $connexion->prepare($requete);
            $statement->bindParam(':email', $email);
            $statement->execute();

            $resultat = $statement->fetch(PDO::FETCH_ASSOC);
            $motDePasseDeLaBase = $resultat['password'];

            $motDePasseUtilisateur = $motDePasse;

            // Comparez le mot de passe saisi avec le mot de passe haché récupéré depuis la base de données
            if (password_verify($motDePasseUtilisateur, $motDePasseDeLaBase)) {
                // Mot de passe correct, permettez l'accès à l'utilisateur

                $isConnected = true;
                $_SESSION['isConnected'] = $isConnected;
                echo "Mot de passe correct. Connexion autorisée!";

                // Utilisez une variable différente pour la seconde préparation et exécution
                $requete = "SELECT * FROM users WHERE email = :email";

                $resultat = $connexion->prepare($requete);
                $resultat->execute(array(':email' => $email));

                $utilisateurDetails = $resultat->fetch(PDO::FETCH_ASSOC); // Use a different variable
                $name = $utilisateurDetails['name'];
                echo''. $name .'';
                $id = $utilisateurDetails['id'];

                $_SESSION['email'] = $email;
                $_SESSION['name'] = $name;
                $_SESSION['id'] = $id;



                header('Location: octech_connexion.php');
            } else {
                // Mot de passe incorrect
                echo "Mot de passe incorrect. Connexion refusée.";
            }
        } catch (PDOException $e) {
            echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
        }
    }
}
