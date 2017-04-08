<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');


if(isset($_POST['formconnexion']))
{
	if(isset($_SESSION['id']))
	{

	$requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
	$requser->execute(array($_SESSION['id']));
	$user = $requser->fetch();
	$user1 = $user['pseudo'];


	$nomconnect = htmlspecialchars($_POST['nomconnect']);
	$mdpconnect = sha1($_POST['mdpconnect']);
	if(!empty($nomconnect) AND !empty($mdpconnect))
	{
		$requser = $bdd->prepare("SELECT * FROM projets WHERE nom = ? AND motdepasse2 = ?");
		$requser->execute(array($nomconnect, $mdpconnect));
		$userexist = $requser->rowCount();
		if($userexist == 1)
		{
			$userinfo = $requser->fetch();
			$_SESSION['id'] = $userinfo['id'];
			$_SESSION['nom'] = $userinfo['nom'];

				$requser1 = $bdd->prepare("SELECT * FROM connexion WHERE nom_user = ?");
				$requser1->execute(array($user1));
				$userexist1 = $requser1->rowCount();
				if($userexist1 == 1)
				{

				}
				else
				{

					$insertco = $bdd->prepare("INSERT INTO connexion(nom_user, nom_projet) VALUES(?, ?)");
					$insertco->execute(array($user1, $nomconnect));
					header("Location: ../pages_web/page_profil_projet.php?id=".$_SESSION['id']);
				}
		}
		else
		{
			$erreur = "Mauvais mail ou mot de passe";
		}
	}
	else
	{
		$erreur = "Tous les champs doivent être complétés";
	}
}}

?>


<html>
<head>
	<title>Inscriptions</title>
	<meta charset="utf-8">
</head>
<body>
<div align="center">
	<h2>Connexion</h2>
<br /><br />
	<form method="POST" action="">
		<input type="text" name="nomconnect" placeholder="Nom du projet"/>
		<input type="password" name="mdpconnect" placeholder="Mot de passe"/>
		<input type="submit" name="formconnexion" value ="Se connecter"/>
</form>




<?php
if(isset($erreur))
{
	echo '<font color="red">'.$erreur."</font>";
}

?>


</body>
</html>
