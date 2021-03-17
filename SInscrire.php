<?php
	require 'conf/config.php';

	if(isset($_POST['s_inscrire'])) {
		$erreur = '';

		// Les données du formulaire
		$name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
		$company_name = filter_var($_POST['company_name'], FILTER_SANITIZE_SPECIAL_CHARS);
		$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
		$phone_number = filter_var($_POST['phone_number'], FILTER_VALIDATE_FLOAT);
		$password =  password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Condition pour afficher une erreur si besoin
    if ($email == false) {
      $erreur = 'Veuillez entrer une adresse valide s\'il vous plaît.';
      if ($name == '' || $company_name == '' || $phone_number == '' || $password == '') {
        $erreur = 'Entrez tous les champs s\'il vous plaît.';
      }
    }
    if ($phone_number == false) {
      $erreur = 'Veuillez entrer un numéro valide s\'il vous plaît.';
      if ($name == '' || $company_name == '' || $email == '' || $password == '') {
        $erreur = 'Entrez tous les champs s\'il vous plaît.';
      }
    }

    if ($email == false && $phone_number == false) {
      $erreur = 'Veuillez entrer une adresse et un numéro valide s\'il vous plaît.';
      if ($name == '' || $company_name == '' || $password == '') {
        $erreur = 'Entrez tous les champs s\'il vous plaît.';
      }
    }

		if($erreur == ''){
			try {
				$stmt = $connect->prepare('INSERT INTO user (name, company_name, email, phone_number, password) VALUES (:name, :company_name, :email, :phone_number, :password)');
				$stmt->execute(array(
					':name' => $name,
					':company_name' => $company_name,
					':email' => $email,
					':phone_number' => $phone_number,
					':password' => $password,
					));
				$erreur = 'Votre compte a bien été enregistré, veuillez maintenant vous connecter en suivant ce lien : <a href="SeConnecter.php">Se connecter</a>';
			}
			catch(PDOException $e) {
				echo $e->getMessage();
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
	<title>S'inscrire</title>
</head>
<body>

			<?php
				if(isset($erreur)){
					echo '<div>'.$erreur.'</div>';
				}
			?>
			<h1><b>S'inscrire</b></h1>
			<form action="" method="post">
				<input type="text" name="name" placeholder="Votre nom" value="<?php if(isset($_POST['name'])) echo $_POST['name'] ?>" autocomplete="off"/><br /><br />

				<input type="text" name="company_name" placeholder="Le nom de votre entreprise" value="<?php if(isset($_POST['company_name'])) echo $_POST['company_name'] ?>" autocomplete="off"/><br /><br />

				<input type="email" name="email" placeholder="Votre email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" autocomplete="off"/><br /><br />

				<input type="text" name="phone_number" placeholder="Votre numéro de téléphone" value="<?php if(isset($_POST['phone_number'])) echo $_POST['phone_number'] ?>" autocomplete="off"/><br /><br />

				
				<input type="password" name="password" placeholder="Votre mot de passe" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>"/><br/><br />

				<input type="submit" name='s_inscrire' value="S'inscrire" /><br />
			</form><br/>
			<a href="SeConnecter.php">Déjà un compte ? Connectez vous ici !</a> <br/><br/>
</body>
</html>
