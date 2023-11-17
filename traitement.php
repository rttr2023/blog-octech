<?php

    $serveur ='localhost';
    $login = 'root';
    $pass = '';

    // Vérifiez si des données ont été soumises
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérez les données du formulaire
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $motDePasse = $_POST["mdp"];
        $mdpCrypted = password_hash($motDePasse, PASSWORD_ARGON2ID);
        $age = $_POST["age"];
        $sexe = $_POST["sexe"];
        $userType = $_POST["utilisation"];

        try{
            $connexion = new PDO("mysql:host=$serveur;dbname=octechusers", $login, $pass);
            $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Connexion à la base de données réussie <br/>';

            $nom = $connexion->quote($nom);
            $email = $connexion->quote($email);
            $mdpCrypted = $connexion->quote($mdpCrypted);
            $age = intval($age); // Assurez-vous que $age est un entier
            $sexe = $connexion->quote($sexe);
            $userType = $connexion->quote($userType);
    
            $insertion = "INSERT INTO users (name, email, password, age, sexe, account) VALUES ($nom, $email, $mdpCrypted, $age, $sexe, $userType)";
            $connexion->exec($insertion);
            echo 'Ajout de l\'utilisateur <br/>';
            header("Location: octech_connexion.php");

        }
    
        catch(PDOException $e){
            echo'Echec de la connexion : ' .$e->getMessage();
            echo'<br/>';
        }

        // Affichez les données pour vérification
        echo "Nom : $nom<br>";
        echo "Email : $email<br>";
        echo "Mot de passe : $motDePasse<br>";
        echo "Sexe : $sexe <br>";
        echo "type de compte : $userType<br>";

        $user = array(
            'nom' => $nom,
            'email' => $email,
            'sexe' => $sexe,
            'mot_de_passe' => $motDePasse,
        );

       $users[$nom] = $user;

    } else {
        // Si le formulaire n'a pas été soumis, redirigez l'utilisateur vers le formulaire
        header("Location: inscription.php");
        exit();
    }

    echo "Tableau des valeurs du formulaire :\n";
    echo '<pre>';
    print_r($users);
    echo '<pre>';



    
?>
