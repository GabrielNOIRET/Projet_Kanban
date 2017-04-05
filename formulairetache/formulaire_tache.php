<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Formulaire</title>
  </head>
  <body>
    <h3>Ajoute une tache</h3>
    <form method="POST" action="" id="tacheform">
      <label for="">Nom</label><br>
      <input type="text" id=Nom name="nom" value="Tache 1"><br>

      <label for="">Date de debut</label><br>
      <input type="date" id=date1 name="debut" min="01-01-2017"><br>

      <label for="">Date de fin</label><br>
      <input type="date" id=date2 name="fin" min="01-01-2017"><br>

      <input type="submit" id="form" name="bouton" value="planifier tache">
    </form>
    <div class="">

      <?php

        echo $_POST["nom"];
        echo $_POST["debut"];
        echo $_POST["fin"];

       ?>
       <script src="formulaire_tache.js"></script>

    </div>
  </body>
</html>
