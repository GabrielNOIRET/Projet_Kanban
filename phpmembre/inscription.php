<!DOCTYPE html>

<?php


$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_POST['forminscription']))
{
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$mail = htmlspecialchars($_POST['mail']);
	$mail2 = htmlspecialchars($_POST['mail2']);
	$mdp = sha1($_POST['mdp']);
	$mdp2 = sha1($_POST['mdp2']);

	if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
	{

		$pseudolenght = strlen($pseudo);
		if($pseudolenght <= 255)
		{
			if($mail == $mail2)
			{
				if(filter_var($mail, FILTER_VALIDATE_EMAIL))
				{
					$reqmail =$bdd->prepare("SELECT * FROM membres WHERE mail =?");
					$reqmail->execute(array($mail));
					$mailexist = $reqmail->rowCount();
					if($mailexist == 0)
					{
						if($mdp == $mdp2)
						{
							$insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, mail, motdepasse) VALUES(?, ?, ?) ");
							$insertmbr->execute(array($pseudo, $mail, $mdp));
							$erreur = "Votre compte a bien été créé <a href=\"../pages_web/page_connexion.php\">Me connecter</a>";
						}
						else
						{
							$erreur ="Vos mot de passe ne correspondent pas";
						}
					}
					else
					{
						$erreur="Adresse mail déjà utilisé";
					}
				}
				else
				{
					$erreur = "Votre adresse mail n'est pas valide";
				}
			}
			else
			{
				$erreur ="Vos adresses ne correspondent pas";
			}
		}
		else
		{
			$erreur = "Votre pseudo ne peut pas depasser 255 caractères";
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
<div id='form_iscription'>
<br /><br />
	<form method="POST" action="" class="form_inscription">
		<h1>Inscription</h1>
		<table>
			<tr>
				<td align="right">
					<label for="pseudo">Pseudo : </label>
				</td>
				<td>
					<input type="text" placeholder ="Votre Pseudo" name="pseudo" id="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo; }?>"/>
				</td>
			</tr>
			<tr>
				<td align="right">
					<label for="mail">Mail : </label>
			</td>
			<td>
				<input type="mail" placeholder ="Votre Mail" name="mail" id="mail" value="<?php if(isset($mail)) {echo $mail; }?>"/>
			</td>
		</tr>
		<tr>
			<td align="right">
				<label for="mail2">Confirmation du mail : </label>
			</td>
			<td>
				<input type="mail" placeholder ="Confirmer votre mail" name="mail2" id="mail2" value="<?php if(isset($mail2)) {echo $mail2; }?>"/>
			</td>
		</tr>
		<tr>
			<td align="right">
				<label for="mdp">Mot de passe : </label>
			</td>
			<td>
				<input type="password" placeholder ="Votre mot de passe" name="mdp" id="mdp"/>
			</td>
		</tr>
		<tr>
			<td align="right">
				<label for="mdp2">Confirmation du mot de passe : </label>
			</td>
			<td>
				<input type="password" placeholder ="Confirmer votre mdp" name="mdp2" id="mdp2"/>
			</td>
		</tr>
		<tr>
			<td></td>
			<td align="center">
				<input type="submit" value ="Je m'inscris" name="forminscription" class="button"/>
				<a href="page_connexion" class="button_deja">Je suis déja inscrit</a>
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
