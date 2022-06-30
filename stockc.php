<?php 
require_once("menu.php");
require_once("functions.php");

// Récupère les données du stock de la boutique
if(isset($_GET['id'])){
    $stock = get_stock_by_id($_GET['id']);
}
else{
    header('location:boutiquec.php');
}
?>
<!-- Affiche le nom de la boutiques -->
<h2>Stock de la boutique <?=get_boutiques()[intval($_GET['id'])]['nom']?></h2>
<div class="boutique-container">
            <div class="menu-filter"></div>
            <div class="card-list">
                <?php
                    // Ceci permet d'afficher les éléments qu'une seule fois
                    $ord_stock = [];
                    foreach($stock as $key => $product) {
                        if(count(array_keys($ord_stock, $product['confiserie_id'])) ==0){
                            array_push($ord_stock,$product['confiserie_id']);
                        }
                    }
                    foreach($stock as $index => $element) {
                        foreach($ord_stock as $key => $produit) {
                            if(count(array_keys($ord_stock, $element['confiserie_id']))>0){
                                echo("
                                <div class='card'>
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
                                </div>");
                                $ord_stock= array_diff($ord_stock, array($element['confiserie_id']));
                            }
                        }
                    }
                ?>
            </div>
        </div> 
    </body>
</html>