<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

//if(isset($_GET['id']) AND $_GET['id'] > 0)
//{
	$projet = $_GET['id'];
	$requser = $bdd->prepare("SELECT * FROM projets WHERE nom = ?");
	$requser->execute(array($projet));
	$userinfo = $requser->fetch();
	echo $projet;

?>
<?php
if(isset($_POST['mailform'])){
$header="MIME-Version: 1.0\r\n";
$header.='From:"Projet.com"<support@projet.com'."\n";
$header.='Content-Type:text/html; charset="uft-8"'."\n";
$header.='Content-Transfer-Encoding: 8bit';

$message='
<html>
	<body>
		<div align="center">
			<img src="http://www.sosiphone.com/blogiphone/wp-content/uploads//2011/02/Pac-Man-banniere.jpg>
			<br />
			J\'ai envoyé ce mail avec PHP !
			<br />
		</div>
	</body>
</html>
';

mail("atest@gmail.com", "Salut tout le monde !", $message, $header);
}


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

//if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
//{
	?>



<h3>Inviter des membres</h3>
<form method="POST" action="">
<input type="email" name="invite_email" value="Email de ton ami" />
<br /><br />
<input type="text" name="invite_nom" value ="Nom d'utilisateur ami" id="invite_nom"/>
<br /><br />
<input type="submit" name="formconnexion" value="Envoyer l'invitation">

</form>
<form method="POST" action="">
	<input type="submit" value="Recevoir un mail !" name="mailform"/>
</form>



<br /><br />
Les membres :
<br /><br />
Admin : 
<br />

	<?php
//}
?>


</body>
</html>

<?php	
//}
?>
