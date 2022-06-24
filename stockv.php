<?php require_once("menu.php");
require_once("functions.php");
//Ceci empêche les clients d'accéder à cette page
if( $_SESSION['session']['type'] == 'client'){
    header("location:boutiquec.php");
}

//Ceci permet l'ajout de boutique via le menu
if(count($_POST)>0){
    for($i=0; $i<$_POST['conf-numb'];$i++){
        ajoute_gâtrerie($_GET['id'],$_POST['conf-type']);
    }
}

//On récuppère le stock de la boutique sélectionnée
if(isset($_GET['id'])){
    $stock = get_stock_by_id($_GET['id']);
}
//On regarde si l'utilisateur à demandé la supression d'un élément via les boutons sur les cartes (A partir de Js en bas de page)

if(isset($_GET['sup'])){
  for($i=0; $i<$_GET['sup'];$i++){
    supprime_gâtrerie($_GET['id'],$_GET['type']);
  }
  header('location:stockv.php?id='.$_GET['id']);  
}

//On regarde si l'utilisateur à demandé l'ajout' d'un élément via les boutons sur les cartes (A partir de Js en bas de page)
if(isset($_GET['add'])){
    for($i=0; $i<$_GET['add'];$i++){
        ajoute_gâtrerie($_GET['id'],$_GET['type']);
      }
    header('location:stockv.php?id='.$_GET['id']);  
} 

?>
        <h2>Stock de la boutique <?=get_boutiques()[intval($_GET['id'])]['nom']?></h2>
        <div class="boutique-container">
            <div class="menu-filter add-conf">
            <form action="" method="POST">  
                    <div id="line1" class="line">
                        <select name="conf-type">
                            <?php 
                            //Liste déroualnte avec le nom des confiseries
                            $confis_liste = get_confiserie();
                                foreach($confis_liste as $index => $conf){
                                    echo("<option value='".$conf['confiserie_id']."'>".$conf['nom']."</option>");
                                }
                            ?>
                        </select>
                        <p class=nombre> Nombre de confisseries : </p>
                        <input type="number" min="0" id="conf-numb" name="conf-numb" required>
                        <input class=submitv type="submit" value="Ajouter une confiserie">
                    </div>
                </form>
            </div>
            <div class="card-list">
                
                 <?php
                    //On stock dans un tableau toutes les confiseries différentes. On se retrouve
                    // donc avec un tableau avec le nom des confiserie qui sont tous différent
                    // Cela permet de ne pas avoir une carte par confiserie mais une carte avec le nombre dessus                
                    $ord_stock = [];
                    foreach($stock as $key => $product) {
                        if(count(array_keys($ord_stock, $product['confiserie_id'])) ==0){
                            array_push($ord_stock,$product['confiserie_id']);
                        }
                    }
                    //On parcours le tableau avec tout les éléments
                    foreach($stock as $index => $element) {
                        //On parcours le tableau avec l'id des produits présent sur la page
                        foreach($ord_stock as $key => $produit) {
                        //Si un produit se trouve dans les deux tableaux, on affiche ses infos et son nombre
                        // avec la fonction compte_gâtrerie(). Puis on supprime l'id du tableau pour ne pas le réafficher
                            if(count(array_keys($ord_stock, $element['confiserie_id']))>0){
                                echo("
                                <div class='card'>
                                    <div class='top-number'>
                                        <p>".compte_gâtrerie($_GET['id'],$element['confiserie_id'])[0][0]."</p>
                                    </div>
                                    <div class='card-illustration'>
                                        <img src='media/bonbon.jpg'>
                                    </div>
                                    <div class='nom-boutique titles-div'>
                                        <p class='card-titles'>Type:</p>
                                        <div class='nom-content'>
                                            <p>".$element['type']."</p>
                                        </div>
                                        <p class='card-titles'>Nom:</p>
                                        <div class='nom-content'>
                                            <p>".$element['nom']."</p>
                                        </div>
                                        <p class='card-titles'>Prix:</p>
                                        <div class='nom-content'>
                                            <p>".$element['prix']."€</p>
                                        </div>
                                    </div>
                                    <div class='compteur'>
                                        <div style='display:none;'class=type-confiz'>".$element['confiserie_id']."</div>
                                        <div class='bouton moins'>Soustraire</div>
                                        <input class='compteur-value' type='number' min='0' value='0'>
                                        <div class='bouton plus'>Ajouter</div>
                                    </div>

                                </div>");
                                $ord_stock= array_diff($ord_stock, array($element['confiserie_id']));
                            }
                        }
                    }
                ?>
            </div>
        </div> 
        <script>
            var id_page = <?php echo json_encode($_GET['id']); ?>;
            let moins = document.querySelectorAll('.moins')
            let plus = document.querySelectorAll('.plus')
            moins.forEach(element=>element.addEventListener('click',function(){
                location.href = "stockv.php?id="+id_page +'&sup=' + element.parentElement.children[2].value+"&type="+element.parentElement.children[0].innerHTML
            }))
            plus.forEach(element=>element.addEventListener('click',function(){
                location.href = "stockv.php?id="+id_page +'&add=' + element.parentElement.children[2].value+"&type="+element.parentElement.children[0].innerHTML
            }))
        </script>
    </body>
</html>