<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
    <!-- Ajoutez vos liens CSS ici -->
</head>

<body>
    <?php include("Topnav.php"); ?>

    <div class="connexion">
        <section class="section-connexion">
            <h1>Entrer vos identifiants</h1>
            <form action="connexion.php" method="post">
                <label for="email_C">Adresse Mail</label>
                <input type="email" name="email_C" id="email_C" autocomplete="email" required>

                <label for="mdp_C">Mot de passe</label>
                <input type="password" name="mdp_C" id="mdp_C" autocomplete="current-password" required>

                <input type="submit" value="Connexion à mon compte">
            </form>
            <form action="octech_inscription.php">
                <input type="submit" class="inscrire-button" value="Je m'inscris">
            </form>
        </section>
    </div>
</body>

</html>