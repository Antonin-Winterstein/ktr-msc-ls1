<?php
	require 'conf/config.php';
	if(empty($_SESSION['name']))
		header('Location: SeConnecter.php');

	if(isset($_POST['creerCarteDeVisite'])) {
		$erreur = '';

    // Les données du formulaire
		$name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
		$company_name = filter_var($_POST['company_name'], FILTER_SANITIZE_SPECIAL_CHARS);
		$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
		$phone_number = filter_var($_POST['phone_number'], FILTER_VALIDATE_FLOAT);

    // Condition pour afficher une erreur si besoin
    if ($email == false) {
      $erreur = 'Veuillez entrer une adresse valide s\'il vous plaît.';
      if ($name == '' || $company_name == '' || $phone_number == '') {
        $erreur = 'Entrez tous les champs s\'il vous plaît.';
      }
    }
    if ($phone_number == false) {
      $erreur = 'Veuillez entrer un numéro valide s\'il vous plaît.';
      if ($name == '' || $company_name == '' || $email == '') {
        $erreur = 'Entrez tous les champs s\'il vous plaît.';
      }
    }

    if ($email == false && $phone_number == false) {
      $erreur = 'Veuillez entrer une adresse et un numéro valide s\'il vous plaît.';
      if ($name == '' || $company_name == '') {
        $erreur = 'Entrez tous les champs s\'il vous plaît.';
      }
    }

		if($erreur == ''){
			try {
				$stmt = $connect->prepare('INSERT INTO library (name, company_name, email, phone_number) VALUES (:name, :company_name, :email, :phone_number)');
				$stmt->execute(array(
					':name' => $name,
					':company_name' => $company_name,
					':email' => $email,
					':phone_number' => $phone_number,
					));
				$erreur = 'La carte de visite a bien été enregistrée, vous pourrez la retrouver sur votre profil : <a href="Profil.php">Votre profil</a>';
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
	<title>Créer une carte de visite</title>
</head>
<body>

			<?php
				if(isset($erreur)){
					echo '<div>'.$erreur.'</div>';
				}
			?>
			<h1><b>Créer une carte de visite</b></h1>
			<form action="" method="post">
				<input type="text" name="name" placeholder="Nom" value="<?php if(isset($_POST['name'])) echo $_POST['name'] ?>" autocomplete="off"/><br /><br />

				<input type="text" name="company_name" placeholder="Nom de l'entreprise" value="<?php if(isset($_POST['company_name'])) echo $_POST['company_name'] ?>" autocomplete="off"/><br /><br />

				<input type="email" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" autocomplete="off"/><br /><br />

				<input type="text" name="phone_number" placeholder="Numéro de téléphone" value="<?php if(isset($_POST['phone_number'])) echo $_POST['phone_number'] ?>" autocomplete="off"/><br /><br />

				<input type="submit" name='creerCarteDeVisite' value="Créer la carte de visite" /><br />
			</form><br/>
			<a href="Profil.php">Retourner à mon profil</a> <br/><br/>
</body>
</html>
