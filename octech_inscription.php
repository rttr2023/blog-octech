<!DOCTYPE html>

<html lang="fr">

<head>
	<link rel="stylesheet" href="style.css">
	<title>Test de formulaire</title>
	<link rel="icon" href="image/logo page.PNG">
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
	<script src="mdp_request.js" defer></script>
</head>

<body>
	<?php
	include("Topnav.php");
	?>

	<h1>Inscription OCTECH</h1>

	<!--On est pas sexiste on est juste autiste-->

	<form action="traitement.php" method="post">

		<h3>
			<p><i>Compl&eacute;tez le formulaire. Les champs marqu&eacute; par </i><em>*</em> sont <em>obligatoires</em></p>

			<fieldset>

				<legend>Contact</legend>

				<label for="nom">Nom <em>*</em></label>
				<div>
					<input name="nom" id="nom" type="text" placeholder="Saisissez votre nom ici" autofocus="" required><br>
				</div>
				<label for="email">Email <em>*</em></label>
				<div>
					<input name="email" id="email" type="text" placeholder="email" required autocomplete="@gmail.com"><br>
				</div>

				<label for="mdp">Mots de passe <em>*</em></label>
				<div class="pass-field">
					<input name="mdp" type="password" placeholder="mots de passe" required><br>
					<i class="fa-solid fa-eye"></i>
				</div>
				<ul class="requirement-list">
					<li><i class="fa-solid fa-circle"></i><span>8 caractères minimum</span></li>
					<li><i class="fa-solid fa-circle"></i><span>1 nombre minimum (1...9)</span></li>
					<li><i class="fa-solid fa-circle"></i><span>1 caractère minuscule (a...z)</span></li>
					<li><i class="fa-solid fa-circle"></i><span>1 caractère spécial (!...$)</span></li>
					<li><i class="fa-solid fa-circle"></i><span>1 caractère majuscule</span></li>
				</ul>


			</fieldset>


			<fieldset>

				<legend>Informations personnelles</legend>

				<label for="age">Age<em>*</em></label>
				<input name="age" type="text" placeholder="00" pattern="[0-9]{2}" required><br>

				<label for="sexe">Sexe</label>
				<select name="sexe">
					<option value="F" id="Femme">Femme</option>
					<option value="H" id="Homme">Homme</option>
					<option value="A" id="Autres">Autres</option>
					<option value="h" id="hélicoptère de combat">hélicoptère de combat</option>
					<option value="C" id="croissant">croissant</option>
				</select><br>
			</fieldset>

			<fieldset>
				<legend>Informations utilisateur</legend>
				<Label for="UserType">Choisissez votre style d'utilisation</Label>
				<select name="utilisation" id="UserType">
					<option value="Blogeur"> Blogeur</option>
					<option value="Lecteur"> Lecteur</option>
				</select>

				</h2>
			</fieldset>
			<div class="center-button">
				<input type="submit" class="connecter" value="Continuer"></input>
			</div>


	</form>
</body>

</html>