<meta charset="utf-8">
    <?php
        session_start();
            $projet = $_SESSION["nom_projet"];
            $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
            $reponse = $bdd->query('SELECT * FROM membres');
                if(isset($_GET['q']) AND !empty($_GET['q']))
                {
                    $q = htmlspecialchars($_GET["q"]);
                    $q_array = explode(' ',$q);
                    $reponse = $bdd->query('SELECT * FROM membres WHERE pseudo LIKE "%'.$q.'%" OR mail LIKE "%'.$q.'%" ');
                }
    ?>
    <?php
        if(isset($_POST['sub']))
        {
            if($_POST['sub'])
            {
                $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
                    if(isset($_POST['check']))
                        {
                            $check = $_POST['check'];
                            foreach ($check as $ch) 
                            {
                                $reqnom =$bdd->prepare("SELECT * FROM membres_projet WHERE nom_user =? AND nom_projet = ?");
                                $reqnom->execute(array($ch, $projet));
                                $nomexist = $reqnom->rowCount();
                                    if($nomexist == 0)
                                    {
                                        $insertmbr = $bdd->prepare("INSERT INTO membres_projet(nom_user, nom_projet) VALUES(?, ?) ");
                                        $insertmbr->execute(array($ch, $projet));
                                        $userinfo = $reqnom->fetch();
                                        $_SESSION['id'] = $userinfo['id'];
                                        $_SESSION['nom_user'] = $userinfo['nom_user'];
                                        $_SESSION['nom_projet'] = $userinfo['nom_projet'];
                                        $confirmation = "L'utilisateur " .$ch. " a bien été ajouté au projet";
                                        header("Location: ../pages_web/page_profil_projet.php?id=".$ch);
                                    }
                                    else
                                    {
                                    }
                            }
                        }
                        else
                        {
                            $erreur = "Aucun membres ajoutés";
                        }
            }
        }
    ?>
<html>
    <head>
        <title>Création projet</title>
        <meta charset="utf-8">
    </head>
    <body>
    <form method="GET">
        <input type="search" placeholder="Recherche ..." name="q">
        <input type="submit" value ="Valider" name="recher">
    </form>
        <?php
            if($reponse->rowCount() > 0)
            { 
        ?>
        <ul>
            <?php
                while ($a = $reponse->fetch())
                {
            ?>
                <li>
                    Pseudo : <?php echo $a['pseudo']; ?><br />
                    Mail : <?php echo $a['mail']; ?><br />
                    <form action=" " method="post">
                    <input type="checkbox" name="check[]" id="ajouter1" value="<?php echo $a['pseudo']; ?>" />
                </li>
            <?php 
                } 
            ?>
        <input type="submit" name="sub" value="ajouter" />
        </form>
        </ul>
            <?php
                }
                else
                {
            ?>
                aucun résultat pour : <?= $q ?>
            <?php 
                } 
            ?>
            <?php
                if(isset($erreur))
                {
                    echo '<font color="red">'.$erreur."</font>";
                }
            ?>
        <br/>
            <?php
                if(isset($confirmation))
                {
                    echo '<font color="green">'.$confirmation."</font>";
                }else
                {
            ?>
        <br/>
            <?php
                if(isset($_POST['check']))
                {
                    $check = $_POST['check'];
                    foreach ($check as $ch)
                    {
                        $erreur2 = "L'utilisateur " .$ch. " est déjà sur le projet";?><br /><?php
                            if(isset($erreur2))
                            {
                                echo '<font color="red">'.$erreur2."</font>";
                            }
                    }       
                }
            }
            ?>