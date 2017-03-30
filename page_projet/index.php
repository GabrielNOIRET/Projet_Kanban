
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Projet Kanban</title>
    <link rel="stylesheet" href="style_index.css">
  </head>
  <body>
    <section id="ajout">
        <br/>
      <input type="text" name="nom_projet" value="Entrez un nom de projet">
        <br/>
      <input type="button" style="width:38px;height:20px;" id="button" name="ajouter" value="ok">
    </section>
      
    <div id="firstlist"> 
    <?php
    $listprojet=array("projet A","Projet B","Projet C");   
    ?>
    <p id="ListProjet">Liste Projets</p>    
    <table id="tableauprojet" border="2px" width="250px">
    

    <?php foreach($listprojet as $lp): ?>
    <tr>
    <td><?=$lp?></td>    
     </tr>
    <?php endforeach ?>  
  
    </table>
    </div> 
      
    <div id="secondlist" > 
    <p id="ListUtilisateur"> Liste Utilisateurs</p>
    <table id="tableau_utilisateur" border="2px" width="250px">
    
    </table>    
    </div> 
      
    <div id="btn">
    <section id="modifier">
     <input type="button" style="width:70px;height:20px;display:block;" id="btnajout" name="btn1" value="<-">
        <br/>
        <br/>
        <br/>
        <br/>
    <input type="button" style="width:70px;height:20px;display:block;" id="btnsupprime" name="btn2"value="->">  
    </section>  
      
      
    </div>
      
    <div id="thirdlist">
    <p id="ListPersonnes">Liste Personnes</p>
    <table id="tableaupersonnes">
        
        
    </table>
    </div>  
      
    <script src="index.js" type="text/javascript"></script>    
  </body>
</html>