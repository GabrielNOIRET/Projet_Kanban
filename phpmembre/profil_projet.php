<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');



if(isset($_GET['id']) AND $_GET['id'] > 0)
{

	$getid = intval($_GET['id']);
	$requser = $bdd->prepare("SELECT * FROM projets WHERE id = ?");
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
	$user_admin = $userinfo["admin"];


?>


<html>
<head>
	<title>Inscriptions</title>
	<meta charset="utf-8">
</head>
<body>
<div align="center">
	<h2>Projet : <?php echo $userinfo['nom']; ?></h2>
<br /><br />
Nom du projet = <?php echo $userinfo['nom']; ?>
<br />
<?php

if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
{
	?>



<h3>Inviter des membres</h3>
<form method="POST" action="">
<input type="email" name="invite_email" value="Email de ton ami" />
<br /><br />
<input type="text" name="invite_nom" value ="Nom d'utilisateur ami" id="invite_nom"/>
<br /><br />
<input type="submit" name="formconnexion" value="Envoyer l'invitation">
</form>



<br /><br />
Les membres :
<br /><br />
Admin : <?php echo" $user_admin" ?>
<br />

	<?php
}
?>


</body>
</html>

<?php	
}
?>
