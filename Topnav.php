<div class="topnav">
    <!-- Image octech -->
    <a href="octech_accueil.php">
        <img class="img" src="image/logo octech noir.png" alt="image" height="75" width="125">
    </a>

    <a class="text_center" href="octech_connexion.php">Se connecter</a>
    <a class="text_center" href="#">Code</a>
    <a class="text_center" href="#">About</a>

    <?php
    include("connexion.php");

    // Assurez-vous que la clé 'isConnected' existe dans $_SESSION avant de l'assigner à $isConnected
    $isConnected = isset($_SESSION['isConnected']) ? $_SESSION['isConnected'] : false;

    if ($isConnected === false) {
        echo '<a class="right" href="octech_connexion.php">L\'utilisateur n\'est pas connecté</a>';
    } else {
        // Assurez-vous de définir $email avant de l'utiliser
        $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
        $username = isset($_SESSION['name']) ? $_SESSION['name'] : '';
    }

    if (isset($_POST['logout'])) {
        // Déconnexion de l'utilisateur
        session_unset();
        session_destroy();
        $isConnected = false;
        // Assurez-vous de définir $email avant de l'utiliser
    }

    if ($isConnected) {
        echo '<a class="right" href="octech_account.php" > Connecté : ' . $username . '<br/></a>';
        echo '<a class="right" href="logout.php">Déconnection</a>';
    } else {
        // Utilisez une balise <a> pour créer un lien hypertexte
        echo '<a class="right" href="octech_connexion.php">Déconnecté</a>';
    }
    ?>

</div>