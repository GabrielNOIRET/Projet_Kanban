<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0)
{

	$getid = intval($_GET['id']);
	$requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();


?>


<html>
<head>
	<title>Inscriptions</title>
	<meta charset="utf-8">
</head>
<body>
<div align="center">
	<h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
<br /><br />
<div id = "photodeprofil">
<?php
if(!empty($userinfo['avatar']))
{
?>
<img src="membres/avatar/<?php echo $userinfo['avatar'];?>" width="150" />
<?php 
}
?>	

</div>
pseudo = <?php echo $userinfo['pseudo']; ?>
<br />
Mail = <?php echo $userinfo['mail']; ?>
<br />
<?php
if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
{
	?>
	<a href ="edition_profil.php">Editer mon profil </a>
	<br />
	<a href ="deconnexion.php">Se deconnecter
	<br />
	<a href ="creation_projet.
	php">Creer un projet
	<br />
	<a href ="connexion_projet.php">Connexion à un projet
	<?php
}
?>


</body>
</html>

<?php	
}
?>
