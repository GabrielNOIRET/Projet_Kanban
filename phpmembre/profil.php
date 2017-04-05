<?php
	session_start();
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
		if(isset($_GET['id']) AND $_GET['id'] > 0)
		{
			$getid = intval($_GET['id']);
			$requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
			$requser->execute(array($getid));
			$userinfo = $requser->fetch();
			$requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
		    $requser->execute(array($_SESSION['id']));
		    $user = $requser->fetch();
		    $user1 = $user['pseudo'];
		    $nom = $_SESSION["pseudo"];
			$reqproj = $bdd->query("SELECT * FROM membres_projet WHERE nom_user = '$nom' ");	
?>

<html>
	<head>
		<title>Profil utilisateur</title>
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
						else
						{
					?>
						<img src="http://www.aruvart.com/tableaux-photos/Peinture-abstraite-DOUCE-TENTATION_840.jpg" width="150" />
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
					<a href ="../pages_web/page_edition_profil.php">Editer mon profil </a>
					<br />
					<a href ="../phpmembre/deconnexion.php">Se deconnecter </a>
					<br />
					<a href ="../pages_web/page_creation_projet.php">Creer un projet </a>
					<br />
				<?php
					}
		}
		while ($a = $reqproj->fetch())
        {
                ?>
        			<li>
                    Projet :  <?php echo $a['nom_projet']; ?>;
                    <form action=" " method="post">
                    <input type="checkbox" name="check[]" id="ajouter1" value="<?php echo $a['nom_projet']; ?>" />
                <?php 
        } 

        		?>
        		<input type="submit" name="sub" value="Rejoindre" />
        		<?php
        		if(isset($_POST['check']))
                        {
                        	 $check = $_POST['check'];
                            foreach ($check as $ch) 
                            {

                            	header("Location: profil_projet.php?id=".$ch);
                            }}


        		?>
        </form>
	</body>
</html>
