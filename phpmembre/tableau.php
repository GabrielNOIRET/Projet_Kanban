<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PREMIERS PAS AVEC BRACKETS</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="../pages_web/style.css">
    </head>
    <body>     
               
        
     <!--  <p> <select name="choix_tableau">
            <option> Kanban </option>
            <option> Scrumb </option>
           </select></p> -->
        
        <form id="form">
        <p> Qui êtes vous ? 
        <select id="noms_projet">
            <option>Gabriel</option>
            <option>Guillaume</option>
            <option>Ismaël</option>
            <option>Quentin</option>
            <option>Yao</option>
        </select></p> 
        
        <p>Tache à ajouter : <input type="text" name="tache"> <input type="submit" name="ok" value="Valider"></p></form>

<div id="board">
    <div>
      <h3>Nom</h3><h3>A faire</h3><h3>En cours</h3><h3>Fait</h3>
    </div>
    <ul id="nom">
        <li href="#" style="color: blue; text-align: center;">Gabriel NOIRET</li>
        <li href="#" style="color: maroon; text-align: center;">Guillaume FLAMME</li>
        <li href="#" style="color: green; text-align: center;">Ismaël ESSEDDIK</li>
        <li href="#" style="color: purple; text-align: center;">Quentin GUINNEBAULT</li>
        <li href="#" style="color: teal; text-align: center;"> Yao XIE</li>
    </ul>
    <ul id="todo" ondragover="allowDrop(event)" ondrop="drop(event)">
        <li id="item1" href="#" style="color: purple;" draggable="true" ondragstart="drag(event)" ondragover="allowDrop(event)" ondrop="drop(event)">* Tache 1</li>
        <li id="item2" href="#" style="color: maroon;" draggable="true" ondragstart="drag(event)" ondragover="allowDrop(event)" ondrop="drop(event)">* Tache 2</li>
    </ul><!--
    --><ul id="inprogress" ondragover="allowDrop(event)" ondrop="drop(event)">
    </ul><!--
    --><ul id="done" ondragover="allowDrop(event)" ondrop="drop(event)">
    </ul>
</div>
     
        <script type="text/javascript" src="java.js"></script> 
        
    </body>
</html>