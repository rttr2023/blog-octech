<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Votre Compte</title>
</head>

<body>
    <?php include("Topnav.php"); ?>

    <section class="details">
        <?php
        // Connexion à la base de données
        $dsn = "mysql:host=localhost;dbname=octechusers";
        $utilisateur = 'root';
        $motDePasseDB = '';

        try {
            $conn = new PDO($dsn, $utilisateur, $motDePasseDB);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

            // Requête SQL sécurisée
            $sql = "SELECT * FROM users WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                // Affichage des données
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // ... (no changes here)
                    echo "Nom : " .$row["name"]. "</br>Email : " .$row["email"]. "</br>Age : " .$row["age"]. "</br>Sexe : " .$row["sexe"]. "</br>Compte : " .$row["account"];
                }
            } else {
                echo "Aucun résultat trouvé";
            }
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }

        // Fermeture de la connexion à la base de données
        $conn = null;
        ?>
    </section>

    <?php
    $dsn = "mysql:host=localhost;dbname=octechusers";
    $utilisateur = 'root';
    $motDePasseDB = '';

    try {
        $connexion = new PDO($dsn, $utilisateur, $motDePasseDB);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $requete = "SELECT * FROM users WHERE account = 'Blogeur'";
        $resultat = $connexion->query($requete);

        if ($resultat->rowCount() > 0) {
            ?>
            <!-- Affichez votre formulaire HTML ici -->
            <form action="creation_Blog.php" method="post" enctype="multipart/form-data">
                <!-- Ajoutez vos champs de formulaire (nom, type de jeux, image, etc.) ici -->
                <!-- Exemple : -->
                Nom: <input type="text" name="nom"><br>
                Type de jeux:
                <select name="type_jeux">
                    <option value="jeux1">Jeux 1</option>
                    <option value="jeux2">Jeux 2</option>
                    <!-- Ajoutez d'autres options selon vos besoins -->
                </select><br>
                Image: <input type="file" name="image"><br>
                <input type="submit" value="Envoyer">
            </form>
            <?php
        } else {
            echo "Erreur";
        }
    } catch (PDOException $e) {
        die("Échec de la connexion à la base de données : " . $e->getMessage());
    }
    ?>


</body>

</html>

<?php
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
    $requete_insertion = $connexion->prepare("INSERT INTO blog (nom, type_jeux, image) VALUES (?, ?, ?)");
    $requete_insertion->bindParam(1, $nom);
    $requete_insertion->bindParam(2, $type_jeux);
    $requete_insertion->bindParam(3, $chemin_fichier);

    // Exécution de la requête préparée
    $requete_insertion->execute();
}
?>
