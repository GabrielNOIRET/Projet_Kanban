<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Page d'acceuil</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya|Josefin+Sans|Muli|Slabo+27px" rel="stylesheet">
  </head>
  <body>
    <!--ajouter header avec le titre et le button pour revenir à l'accueil-->
    <?php include 'element_page/header_btn.php'; ?>

  <section>
    <!-- main body: chercher le fichier de php pour se connecter, vérifier l'identifiant dans la bdd -->  
    <?php include '../phpmembre/connexion.php'; ?>
  </section>

     <!-- ajouter footer : lien vers le github de notre travail--> 
    <?php include 'element_page/footer.php'; ?>
  </body>
</html>
