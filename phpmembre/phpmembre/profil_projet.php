<?php
	session_start();
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
		$projet = $_GET['id'];
		$requser = $bdd->prepare("SELECT * FROM projets WHERE nom = ?");
		$requser->execute(array($projet));
		$userinfo = $requser->fetch();
		$nom = $_SESSION["pseudo"];

				$requser1 = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ?");
		$requser1->execute(array($nom));
		$userinfo1 = $requser1->fetch();
		$avatar = $userinfo1["avatar"];
						$requser2 = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ?");
		$requser2->execute(array($nom));
		$userinfo2 = $requser2->fetch();
		$mail = $userinfo2["mail"];

?>
<?php
	if(isset($_POST['mailform'])){
		$header="MIME-Version: 1.0\r\n";
		$header.='From:"Projet.com"<support@projet.com'."\n";
		$header.='Content-Type:text/html; charset="uft-8"'."\n";
		$header.='Content-Transfer-Encoding: 8bit';
		$destinataire = $_POST['invite_email'];
		$message='
			<html>
				<body>
					<div align="center">
						<img src="http://www.design-nature-perso.com/uploads/1/7/0/8/17085524/8808807_orig.jpg"/>
						<br />
						L\'utilisateur '.$nom.' t\'as ajouté au projet '.$projet.'
						<br />
						<img src="http://www.sosiphone.com/blogiphone/wp-content/uploads//2011/02/Pac-Man-banniere.jpg"/>
					</div>
				</body>
			</html>
		';
		mail($destinataire, $nom. " t'as ajouté au projet ".$projet, $message, $header);
		$reponse3 = $bdd->query('SELECT * FROM membres WHERE mail ="'.$destinataire.'" ');
		while ($a = $reponse3->fetch())
                			{
								$utilisateur_mail = $a['pseudo'];
								$reqnom =$bdd->prepare("SELECT * FROM membres_projet WHERE nom_user =? AND nom_projet = ?");
                                $reqnom->execute(array($utilisateur_mail, $projet));
                                $nomexist = $reqnom->rowCount();
                                    if($nomexist == 0)
                                    {
                                        $insertmbr = $bdd->prepare("INSERT INTO membres_projet(nom_user, nom_projet) VALUES(?, ?) ");
                                        $insertmbr->execute(array($utilisateur_mail, $projet));
                                        $userinfo = $reqnom->fetch();
									}
							}
	}
?>
<?php
if(isset($_POST["message"]) AND !empty($_POST["message"]))
{
	$message = htmlspecialchars($_POST['message']);
	$insertmsg = $bdd->prepare('INSERT INTO chat(pseudo, message, nom_projet) VALUES(?, ?, ?)');
	$insertmsg->execute(array($nom, $message, $projet));
}
?>
<?php
	if(isset($_POST["ajouter_base"]))
	{
		header("Location: ../pages_web/page_membres_projet.php?id=".$_SESSION['id']);
	}
?>

<html>
	<head>
		<title>Inscriptions</title>
		<meta charset="utf-8">
	</head>
	<body>
				<div id = "photodeprofil">
				<?php
					if(!empty($avatar))
					{
				?>
					<img src="membres/avatar/<?php echo $avatar;?>" width="150" />
				<?php 
					}
					else
					{
				?>
					<img src="http://www.aruvart.com/tableaux-photos/Peinture-abstraite-DOUCE-TENTATION_840.jpg" width="150" />
					<br />
				<?php
					}
					echo "Pseudo : ".$nom;
					?>
					<br />
					<?php
					echo "Mail : ".$mail;
				?>

			</div>
		<div align="center">
			<h2>Projet : <?php echo $userinfo['nom']; ?></h2>
				<br /><br />
				<h3> Admin projet <?php echo $userinfo['nom']; ?>: </h3>
					<br />
						<?php 
							$reponse1 = $bdd->query('SELECT * FROM projets WHERE nom ="'.$projet.'" ');
							while ($a = $reponse1->fetch())
                			{
								echo $a['admin'];
							}
						?>
					<h3>Liste des membres projet <?php echo $userinfo['nom']; ?> :</h3>
						<?php 
							$reponse = $bdd->query('SELECT * FROM membres_projet WHERE nom_projet ="'.$projet.'" ');
							while ($a = $reponse->fetch())
                			{
								echo $a['nom_user'];
						?>
								<br />
						<?php
							}
						?>
					<br /><br />			
					<h3>Inviter des membres</h3>
						<form method="POST" action="">
							<input type="submit" name="ajouter_base" value="Ajouter membre">
							<br /><br />
							<input type="email" name="invite_email" placeholder="Email de ton ami" />
							<br /><br />
							<input type="submit" value="Envoyer un mail !" name="mailform"/>
						</form>
						<a href ="../pages_web_page_tableau.php" >Backlog du jour </a>
						<br />
						<a href ="#">Diagramme gantt</a>
						<br />
					<h3>Commentaires sur le projet</h3>
						<form method="post" action="">
							<textarea type="text" placeholder="Votre message" name="message"></textarea> <br/>
							<input type="submit" name="envoyer">
						</form>
						<?php
						$reqmsg=$bdd->query('SELECT* FROM chat WHERE nom_projet ="'.$projet.'" ORDER BY id DESC');
						while($msg = $reqmsg->fetch())
						{
							?>
							<b><?php echo $msg["pseudo"]; ?> : </b><?php echo $msg["message"]; ?></br>
							<?php
						}
						?>
			</div>
	</body>
</html>