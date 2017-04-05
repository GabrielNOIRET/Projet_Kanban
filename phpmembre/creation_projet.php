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
						if(!empty($_POST['nom']))
						{
							$nomlenght = strlen($nom);
							if($nomlenght <= 255)
							{
								$reqnom =$bdd->prepare("SELECT * FROM projets WHERE nom =?");
								$reqnom->execute(array($nom));
								$nomexist = $reqnom->rowCount();
								if($nomexist == 0)
								{
									$insertproj = $bdd->prepare("INSERT INTO projets(nom, admin) VALUES(?, ?) ");
									$insertproj->execute(array($nom, $user_admin));
									$userinfo = $reqnom->fetch();
                                    $_SESSION['nom_projet'] = $nom;
									header("Location: ../pages_web/page_membres_projet.php?nom=");
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
		<title>Création projet</title>
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
							<input type="text" placeholder ="Votre nom de projet" name="nom" id="nom" value="<?php if(isset($nom)) {echo $nom; }?>"/>
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
			}
			else
			{
				header("Location : ../pages_web/page_connexion.php");
			}
	?>
	</body>
</html>