<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Page d'acceuil</title>
    <link rel="stylesheet" href="style.css">
      
    <!-- modifier la police-->   
    <link href="https://fonts.googleapis.com/css?family=Alegreya|Josefin+Sans|Muli|Slabo+27px" rel="stylesheet">
    
  </head>
  <body>
    <!--ajouter le header avec le titre sans le boutton pour revenir à l'accueil-->
    <?php include 'element_page/header.php'; ?>

      <!--div pour css-->
    <div id="section_img">
      <div id="bienvenue">
        <p>Bienvenue</p> <!--ajouter texte-->
      </div>
        <!--deux buttons pour accéder à la page d'inscription et de connection-->
      <div id="boutons">
          <!--lien vers la page d'inscription-->
        <a class="bouton" href="page_inscription.php">Inscription</a>
          <!--lien vers la page de connection-->
        <a class="bouton" href="page_connexion.php">Connexion</a>

      </div>
    </div>

   <!-- ajouter footer : lien vers le github de notre travail-->
    <?php include 'element_page/footer.php'; ?>


    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script>
      $(document).ready(function() {
      var movementStrength = 55;
      var height = movementStrength / $(window).height();
      var width = movementStrength / $(window).width();
      $("#section_img").mousemove(function(e){
      var pageX = e.pageX - ($(window).width() / 2);
      var pageY = e.pageY - ($(window).height() / 2);
      var newvalueX = width * pageX * -1 - 55;
      var newvalueY = height * pageY * -1 - 22;
      $('#section_img').css("background-position", newvalueX+"px     "+newvalueY+"px");
      });
      });
    </script>
  </body>
</html>
