<?php
	require 'conf/config.php';
	if(empty($_SESSION['name']))
		header('Location: SeConnecter.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mon profil</title>
	<style>
	li {
		list-style-type: none;
	}
	
	ul:last-of-type hr {
		display: none;
	}
	</style>
</head>
<body>

			<?php
				if(isset($erreur)){
					echo '<h1>'.$erreur.'</h1>';
				}
			?>

				<h1 style="color:IndianRed;">Salut <?php echo $_SESSION['name']; ?> !</h1> <br>

				<h2>Voici ci-après tes différentes informations : </h2>
				<ul>
					<li><b>Nom de l'entreprise</b> : <?php echo $_SESSION['company_name']; ?></li>
					<li><b>Email</b> : <a href="<?php echo $_SESSION['email']; ?>"><?php echo $_SESSION['email']; ?></a></li>
					<li><b>Téléphone</b> : <?php echo $_SESSION['phone_number']; ?></li>
				</ul>

				<h2>Et voici ci-après la librairie des différentes cartes de visite : </h2>

				<?php $reponse = $connect->query('SELECT * FROM library');
				while ($donnees = $reponse->fetch())
				{
				?>

				<ul>
					<li><b>Nom</b> : <?php echo $donnees['name']; ?></li>
					<li><b>Nom de l'entreprise</b> : <?php echo $donnees['company_name']; ?></li>
					<li><b>Email</b> : <a href="mailto:<?php echo $donnees['email']; ?>"><?php echo $donnees['email']; ?></a></li>
					<li><b>Téléphone</b> : <?php echo $donnees['phone_number']; ?></li>
					<hr>
				</ul>
				<?php
				}
				?>

				<a href="CarteDeVisite.php">Créer une carte de visite</a><br/><br/>
				<a href="SeDeconnecter.php">Se déconnecter</a>

</body>
</html>
