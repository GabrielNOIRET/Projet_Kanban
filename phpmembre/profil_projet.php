<?php
	session_start();
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
		$projet = $_GET['id'];
		$requser = $bdd->prepare("SELECT * FROM projets WHERE nom = ?");
		$requser->execute(array($projet));
		$userinfo = $requser->fetch();
		$nom = $_SESSION["pseudo"];
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
<?php
	if(isset($_POST["date_temps"]))
	{
		$date_debut = $_POST["date_debut"];
		$date_fin = $_POST["date_fin"];
		$insertdate = $bdd->prepare("UPDATE projets SET date_debut = ? WHERE nom = ?");
		$insertdate->execute(array($date_debut, $projet));
		$insertdate1 = $bdd->prepare("UPDATE projets SET date_fin = ? WHERE nom = ?");
		$insertdate1->execute(array($date_fin, $projet));
		$d1 = new DateTime($date_fin); 
		$d2 = new DateTime($date_debut); 
		$diff = $d1->diff($d2); 
		$nb_jours = $diff->d;
		?>
		<br>
		<?php
		$date_jour = date("Y-m-d");
		$d3 = new DateTime($date_jour);
		$diff1 = $d3->diff($d1);
		$nb_jours_restants = $diff1->d;
		?>
		<br>
		<?php
		$diff2 = $d2->diff($d3);
		$nb_jours_passe = $diff2->d;
	}

?>
<html>
	<head>
		<title>Inscriptions</title>
		<meta charset="utf-8">
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript" src="profil_projet.js"></script>
		<link rel="stylesheet" href="profil_projet.css" type="text/css" />
    	<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
      	var nb_jours_restants1 = '<?php echo $nb_jours_restants; ?>';
      	var nb_jours_passe1 = '<?php echo $nb_jours_passe; ?>';
var data = new google.visualization.DataTable();
      data.addColumn('string', 'Temps');
      data.addColumn('number', 'temps');
      data.addRows([
        ['Pourcentage restant', parseInt(nb_jours_restants1, 8)],
        ['Pourcentage passé', parseInt(nb_jours_passe1, 32 )],
      ]);

        var options = {
          title: 'Temps du projets',
          pieHole: 0.4,
          backgroundColor :'white'
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
	</head>
	<body>
	<section id="page_profil_projet">
	<div id='projet_gauche'>
	<div id="entete_projet">
		<div id="entete">
			<div id="cpBtn" onclick="toggleCP()">
	          <div></div>
	          <div></div>
	          <div></div>
	        </div>
	        <div id="cp"  style="width: 700px; height: 500px;">
	        <h3>Resumé de votre projet<h3>
	        <p> Date de debut : <?php echo $date_debut; ?> </p>
	        <p> Date de fin : <?php echo $date_fin; ?> </p>
		<div id="donutchart" style="width: 500px; height: 500px;"></div>
		</div>
	      </div>
			<div>
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
					</div></div>
					<div id="pied_projet">
					<div id="pied_projet_1">
						<h3>Inviter des membres</h3>
							<form method="POST" action="">
								<input type="submit" name="ajouter_base" value="Ajouter membre"/>
								<br /><br />
								<input type="email" name="invite_email" placeholder="Email de ton ami" />
								<br /><br />
								<input type="submit" value="Envoyer un mail !" name="mailform"/>
							</form>
					</div>
					<div id="pied_projet_5">
					<div id="pied_projet_2">

							<a class="bouton_page_projet" href ="../pages_web/page_tableau.php" >Backlog du jour </a>
							<br />
					</div>
					<div id="pied_projet_3">

							<a  class="bouton_page_projet" href ="../calendrier/agenda-views.html">Votre planning</a>
							<br />
					</div>
					<div id="pied_projet_4">

						<div id="date">
						<h3>Date</h3>
						<form method="POST" action="">
							<input type="date" name="date_debut"/>
							<br/><br/>
							<input type="date" name="date_fin"/>
							<br/><br/>
							<input type="submit" name="date_temps">
						</form>
						</div>
						</div>
					</div>
				</div>
		</div>

		
		<div id="espace_com">
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
				</div>
			</div>
			</div>
		</section>
	</body>
</html>