

<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
$nom = $_SESSION['pseudo'];
$requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();
$mail1 = $user['mail'];
if(isset($_SESSION['id']))
{
	$requser = $bdd->prepare("SELECT * FROM membres WHERE id=? ");
	$requser->execute(array($_SESSION['id']));
	$user = $requser->fetch();
	if(isset($_POST["newpseudo"]) AND !empty($_POST["newpseudo"]) AND $_POST['newpseudo'] != $user["pseudo"])
	{
		$newpseudo = htmlspecialchars($_POST["newpseudo"]);
		$insertpseudo = $bdd->prepare("UPDATE membres SET pseudo =? WHERE id =?");
		$insertpseudo->execute(array($newpseudo, $_SESSION['id']));
		header('Location: ../pages_web/page_profil.php?id='.$_SESSION['id']);
	}
		if(isset($_POST["newmail"]) AND !empty($_POST["newmail"]) AND $_POST['newmail'] != $user["mail"])
		{
			$newmail = htmlspecialchars($_POST["newmail"]);
			$insertpseudo = $bdd->prepare("UPDATE membres SET mail =? WHERE id =?");
			$insertpseudo->execute(array($newmail, $_SESSION['id']));
			header('Location: ../pages_web/page_profil.php?id='.$_SESSION['id']);
		}
			if(isset($_POST["newmd1"]) AND !empty($_POST["newmdp1"]) AND isset($_POST["newmd2"]) AND !empty($_POST["newmdp2"]))
			{
				$mdp1 = sha1($_POST['newmdp1']);
				$mdp2 = sha1($_POST['newmdp2']);
				if($mdp1 == $mdp2)
				{
					$insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
					$insertmdp->execute(array($_mdp1, $_SESSION['id']));
					header('Location: profil.php?id='.$_SESSION['id']);
				}
				else
				{
					$msg = "Vos deux mot de passe ne correspondent pas";
				}
			}
			if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
			{
				$tailleMax= 2097152;
				$extensionValides = array('jpg', 'jpeg', 'gif', 'png');
				if($_FILES['avatar']['size'] <= $tailleMax)
				{
					$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
					if(in_array($extensionUpload, $extensionValides))
					{
						$chemin = "membres/avatar/".$_SESSION['id'].".".$extensionUpload;
						$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
						if($resultat)
						{
							$updateavatar = $bdd->prepare('UPDATE membres SET avatar = :avatar WHERE id = :id');
							$updateavatar->execute(array(
								'avatar' => $_SESSION['id'].".".$extensionUpload,
								'id' => $_SESSION['id']
							));
							header('Location: ../pages_web/page_profil.php?id='.$_SESSION['id']);
						}
						else
						{
							$msg = "Erreur d'imporation";
						}
					}
					else
					{
						$msg = "Votre photo n'est pas au bon format";
					}
				}
				else
				{
					$msg = "Votre photo de profil est trop grosse";
				}
			}
			if(isset($_POST['newpseudo']) AND $_POST['newpseudo'] == $user['pseudo'])
			{
				header('Location: ../pages_web/page_profil.php?id='.$_SESSION['id']);
			}
?>

<html>
	<body>
	<div class="profil_gauche">
		<div id="profil">
			<br>
				<?php
					if(!empty($userinfo['avatar']))
					{
				?>
					<img src="membres/avatar/<?php echo $userinfo['avatar'];?>" width="150" />
				<?php 
					}
					else
					{
				?>
					<img src="http://www.aruvart.com/tableaux-photos/Peinture-abstraite-DOUCE-TENTATION_840.jpg" width="150" />
					
				
					<h2>Profil de <?php echo $nom; ?></h2>
					<?php
					}
					echo "pseudo = ".$nom;
					?>
					<br />
					<?php
					echo "Mail = ".$mail1;
				?>	
				</div>
				<a  id="button_deconnect" href ="../phpmembre/deconnexion.php">Se deconnecter </a>
		</div>
	<div align="center" id="page_edition">
			<form method="POST" action ="" class="form" enctype="multipart/form-data">
				<h1>Edition de mon profil </h1>
				<label>Pseudo : </label>
				<input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo'];?>"/><br /><br />
				<label>Mail : </label>
				<input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail'];?>"/><br /><br />
				<label>Mot de passe :</label>
				<input type="password" name="newmdp1" placeholder="Mot de passe" /><br /><br />
				<label>Confirmation du mot de passe :</label>
				<input type="password" name="newmdp2" placeholder="Confirmation mot de passe" /><br /><br />
				<label>Nouvelle photo de profil</label>
				<input type="file" name="avatar" /><br /><br />
				<input type="submit" value="Mettre a jour" class="button"/>
		
			</form>

			
		<?php
			if(isset($msg)){echo $msg;}
		?>
		</div>
	<?php	
	}
	else
	{
		header("Location : ../pages_web/page_connexion.php");
	}
	?>
	</body>
</html>