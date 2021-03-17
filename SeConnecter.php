<?php
	require 'conf/config.php';

	if(isset($_POST['se_connecter'])) {
		$erreur = '';

		// Les données du formulaire
		$name = $_POST['name'];
		$password = $_POST['password'];

		// Conditions pour afficher des erreurs si besoin
		if($name == '') {
			$erreur = 'Entrez le nom s\'il vous plaît';
		}
			
		if($password == '') {
			$erreur = 'Entrez le mot de passe s\'il vous plaît.';
		}

		if($name == '' && $password == '') {
			$erreur = 'Entrez le nom et le mot de passe s\'il vous plaît.';
		}
		
		

		if($erreur == '') {
			try {
				$stmt = $connect->prepare('SELECT id, name, company_name, email, phone_number, password FROM user WHERE name = :name');
				$stmt->execute(array(
					':name' => $name
					));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);

				if($data == false){
					$erreur = "L'utilisateur $name n'a pas été trouvé.";
				}
				else {
					if($password == password_verify($password, $data['password'])) {
						$_SESSION['name'] = $data['name'];
						$_SESSION['company_name'] = $data['company_name'];
						$_SESSION['email'] = $data['email'];
						$_SESSION['phone_number'] = $data['phone_number'];
						header('Location: Profil.php');
						exit;
					}
					else
						$erreur = 'Le mot de passe est erroné. Veuillez réessayer s\'il vous plaît.';
				}
			}
			catch(PDOException $e) {
				$erreur = $e->getMessage();
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Se connecter</title>
</head>
<body>
			<?php
				if(isset($erreur)){
					echo '<div>'.$erreur.'</div>';
				}
			?>
			<h1><b>Se connecter</b></h1>
			<form action="" method="post">
				<input type="text" name="name" placeholder="Votre nom" value="<?php if(isset($_POST['name'])) echo $_POST['name'] ?>" autocomplete="off" class="box"/><br /><br />
				<input type="password" name="password" placeholder="Votre mot de passe" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" autocomplete="off" class="box" /><br/><br />
				<input type="submit" name='se_connecter' value="Se connecter" class='submit'/><br />
			</form><br/>
			<a href="SInscrire.php">Pas encore inscrit ? Suivez ce lien !</a>
</body>
</html>
