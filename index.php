<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Accueil</title>
</head>
<body>
			<?php
				if(isset($erreur)){
					echo '<div>'.$erreur.'</div>';
				}
			?>
			<h1><b>Bienvenue !</b></h1>
			<br>
			<a href="SeConnecter.php">Déjà un compte ? Connectez vous ici !</a> <br/><br/>
			<a href="SInscrire.php">Pas encore inscrit ? Suivez ce lien !</a>
</body>
</html>
