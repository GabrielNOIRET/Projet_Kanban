<!DOCTYPE html>

<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_SESSION['id']))
{

$requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();
$user_admin = $user['pseudo'];

if(isset($_POST['forminscription']))
{
	$nom = htmlspecialchars($_POST['nom']);
	$mdp3 = sha1($_POST['mdp3']);
	$mdp4 = sha1($_POST['mdp4']);

	if(!empty($_POST['nom']) AND !empty($_POST['mdp3']) AND !empty($_POST['mdp4']))
	{

		$nomlenght = strlen($nom);
		if($nomlenght <= 255)
		{
			$reqnom =$bdd->prepare("SELECT * FROM projets WHERE nom =?");
					$reqnom->execute(array($nom));
					$nomexist = $reqnom->rowCount();
					if($nomexist == 0)
					{
						if($mdp3 == $mdp4)
						{
							$insertproj = $bdd->prepare("INSERT INTO projets(nom, motdepasse2, admin) VALUES(?, ?, ?) ");
							$insertproj->execute(array($nom, $mdp3, $user_admin));
							$erreur = "Votre projet a bien été créé <a href=\"../pages_web/page_connexion_projet.php\">Me connecter</a>";

						}
						else
						{
							$erreur ="Vos mot de passe ne correspondent pas";
						}
					}
					else
					{
						$erreur="Nom de compte déjà utilisés";
					}
				}
		else
		{
			$erreur = "Votre nom de projet ne peut pas depasser 255 caractères";
		}
	}
	else
	{
		$erreur = "Tous les champs doivent être completer";
	}
}

?>



<html>
<head>
	<title>Inscriptions</title>
	<meta charset="utf-8">
</head>
<body>
<div align="center">
	<h2>Creation projet</h2>
<br /><br />
	<form method="POST" action="">
		<table>
			<tr>
				<td align="right">
					<label for="nom">Nom : </label>
				</td>
				<td>
					<input type="text" placeholder ="Votre Pseudo" name="nom" id="nom" value="<?php if(isset($nom)) {echo $nom; }?>"/>
				</td>
			</tr>
		<tr>
			<td align="right">
				<label for="mdp3">Mot de passe : </label>
			</td>
			<td>
				<input type="password" placeholder ="Votre mot de passe" name="mdp3" id="mdp3"/>
			</td>
		</tr>
		<tr>
			<td align="right">
				<label for="mdp4">Confirmation du mot de passe : </label>
			</td>
			<td>
				<input type="password" placeholder ="Confirmer votre mdp" name="mdp4" id="mdp4"/>
			</td>
		</tr>
		<tr>
			<td></td>
			<td align="center">
				<input type="submit" value ="Je crée mon projet" name="forminscription"/>
			</td>
		</tr>
	</table>
</form>




<?php
if(isset($erreur))
{
	echo '<font color="red">'.$erreur."</font>";
}

?>


</body>
</html>

<?php
}
else{
	header("Location : ../pages_web/page_connexion_projet.php");
}
?>
