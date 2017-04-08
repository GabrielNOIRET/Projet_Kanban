<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
if(isset($_POST['formconnexion']))
{
	$mailconnect = htmlspecialchars($_POST['mailconnect']);
	$mdpconnect = sha1($_POST['mdpconnect']);
	if(!empty($mailconnect) AND !empty($mdpconnect))
	{
		$requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
		$requser->execute(array($mailconnect, $mdpconnect));
		$userexist = $requser->rowCount();
		if($userexist == 1)
		{
			$userinfo = $requser->fetch();
			$_SESSION['id'] = $userinfo['id'];
			$_SESSION['pseudo'] = $userinfo['pseudo'];
			$_SESSION['mail'] = $userinfo['mail'];
			header("Location: ../pages_web/page_profil.php?id=".$_SESSION['id']);
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
}

?>


<html>
<head>
	<title>Inscriptions</title>
	<meta charset="utf-8">
</head>
<body>
<div id='form'>
<br /><br />
	<form method="POST" action="" class="form">
		<h1>Connexion</h1>
		<table>
			
			<tr>
				<td align="right">
					<label for="mail">Mail : </label>
			</td>
			<td>
				<input type="email" name="mailconnect" placeholder="Mail"/>
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<label for="mdp">Mot de passe : </label>
			</td>
			<td>
				<input type="password" name="mdpconnect" placeholder="Mot de passe"/>
			</td>
		</tr>
		<
		<tr>
			<td></td>
			<td>
				<input type="submit" name="formconnexion" vulue ="Se connecter" class="button"/>
				<a href="page_inscription.php" class="button_deja">m'inscrire</a>
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
