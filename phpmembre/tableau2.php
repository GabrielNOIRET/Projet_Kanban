<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PREMIERS PAS AVEC BRACKETS</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="tab.css">
    </head>
    <body>     
      
        <form id="form">
        <p> Qui êtes vous ? 
        <select id="noms_projet">
        <?php
        $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $prenoms=$bdd->query("SELECT * FROM test ");
        $prenoms->setFetchMode(PDO::FETCH_OBJ);
        while( $prenom = $prenoms->fetch() ){
            ?> <option id="<?php echo "$prenom->ID"; ?>"><?php echo "$prenom->Prenom";?></option><?php
            }
            ?>
        </select></p> 
        
        <p>Tache à ajouter : <input type="text" name="tache"> <input type="submit" name="ok" value="Valider"></p></form>
        <?php
        $prenoms->closeCursor();
        ?>  

<div id="board">
    <div>
      <h3>Nom</h3><h3>A faire</h3><h3>En cours</h3><h3>Fait</h3>
    </div>
    <ul id="nom">
        <?php
        $noms=$bdd->query("SELECT * FROM test");
        $noms->setFetchMode(PDO::FETCH_OBJ);
        while( $nom = $noms->fetch() ){
            ?> <li id ="item<?php echo ''.$nom->ID; ?>" href="#" style="color: <?php echo ''.$nom->Couleur; ?>; text-align: center;"><?php echo ''.$nom->Prenom.' '.$nom->Nom; ?></li><?php
            }
        $noms->closeCursor();
    
        ?>
    </ul>
    <ul id="todo" ondragover="allowDrop(event)" ondrop="drop(event)">
        <li id="item30" href="#" style="color: purple;" draggable="true" ondragstart="drag(event)" ondragover="allowDrop(event)" ondrop="drop(event)">* Tache 1</li>
        <li id="item31" href="#" style="color: maroon;" draggable="true" ondragstart="drag(event)" ondragover="allowDrop(event)" ondrop="drop(event)">* Tache 2</li>
    </ul><!--
    --><ul id="inprogress" ondragover="allowDrop(event)" ondrop="drop(event)">
    </ul><!--
    --><ul id="done" ondragover="allowDrop(event)" ondrop="drop(event)">
    </ul>
</div>
     
        <script type="text/javascript" src="java.js"></script> 
        
    </body>
</html>