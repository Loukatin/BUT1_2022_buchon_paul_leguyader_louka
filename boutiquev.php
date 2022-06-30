<?php 
require_once("menu.php");
require_once("functions.php");
//Les clients ne peuvent y accéder
if( $_SESSION['session']['type'] == 'client'){
    header("location:boutiquec.php");
}

//Cette variable sert à l'affichage de toutes les boutiques plus bas
$boutiques = get_boutiques();

if(count($_POST)>0){
    //Ceci est éxecuté quand un utilisateur clique sur la poubelle à côté d'une boutique
    if(isset($_POST['delete'])){
        delete_boutique($_POST['delete']);
        header('location:boutiquev.php');
    }
    //Ceci est éxecuté quand l'utilisateur rempli et envoie le formulaire d'ajout de boutique
    else{
        add_boutique([$_POST['name'],$_POST['nbstreet'],$_POST['street'],$_POST['codep'],$_POST['ville'],$_POST['pays']]);
        header('location:boutiquev.php');
}
}
?>
    <h2>Choisissez votre boutique</h2>
        <div class="boutique-container">
            <div class="add-boutique">
                <form action="boutiquev.php" method="POST">  
                    <div id="line1" class="line">
                        <p>Nom boutique:</p>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div id="line2" class="line">
                        <p>Code Postal: </p>
                        <input type="text" id="codep" name="codep" required>
                        <p>Ville: </p>
                        <input type="text" id="ville" name="ville" required>
                    </div>
                    <div id="line3" class="line">
                        <p>N°Rue: </p>
                        <input type="number" id="nbstreet" name="nbstreet" required>
                        <p>Rue: </p>
                        <input type="text" id="street" name="street" required>
                        <p>Pays: </p>
                        <select class='pays' name="pays" id="pet-select">
                            <?php 
                                // Le code ne permet d'ajouter des boutique que dans les pays où il y a déjà des boutiques
                                $already = [];
                                foreach($boutiques as $index => $boutique){
                                    if(!in_array($boutique['pays'],$already))
                                        echo("<option value='".$boutique['pays']."'>".$boutique['pays']."</option>");
                                        array_push($already,$boutique['pays']);
                                }
                            ?>
                        </select>
                        <input class='submit-btn'type="submit" value="Ajouter une boutique">
                    </div>
                </form>
            </div>
            <div class="card-list">
            <?php
                    // Ce code permet d'afficher toutes les boutiques. Il y a à côté de chaque carte, une boutique pour supprimé cette boutiques
                    foreach($boutiques as $index => $boutique) {
                        echo("
                        <div class='ligne'>
                            <a class='card boutique-vendeur' href=stockv.php?id='".$boutique['boutique_id']."'>
                                <div class='card-illustration'>
                                    <img src='media/boutique.png'>
                                </div>
                                <div class='info'>
                                    <div class='nom-boutique titles-div'>
                                        <p class='card-titles'>Nom boutique:</p>
                                        <div class='nom-content'>
                                            <p>".$boutique['nom']."</p>
                                        </div>
                                    </div>
                                    <div class='adresse-boutique titles-div'>
                                        <p class='card-titles'>Adresse:</p>
                                        <div class='adresse-content'>
                                            <p>".$boutique['numero_rue'].' '.$boutique['nom_adresse'].'<br>'.$boutique['code_postal'].' '.$boutique['ville'].'<br>'.$boutique['pays']." </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class='delete'>
                                <form name='formulaire' class='delete-form' action='' method='POST'>  
                                    <input type='hidden' type='numb' name='delete' value='".$boutique['boutique_id']."'>
                                        <img id='deletes'src='media/trash.png'>
                                    </input>
                                </form>
                            </div>
                        </div>
                    ");
                    }
                ?>
            </div>
        </div> 

        <script>
            //Ceci permet l'envoie du formulaire de suppression lorsque l'on clique sur la poubelle
            let del = document.querySelectorAll('.delete')
            del.forEach(element => element.addEventListener('click',function(){
                element.children[0].submit()
            }))
        </script>
    </body>
</html>