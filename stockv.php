<?php require_once("menu.php");
require_once("functions.php");
if(isset($_GET['id'])){
    $stock = get_stock_by_id($_GET['id']);
}
ajoute_gâtrerie(1,1)
?>
<div class="boutique-container">
            <div class="menu-filter"></div>
            <div class="card-list">
                
                 <?php
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
                                        <div class='bouton moins'>Soustraire</div>
                                        <input class='compteur-value' type='number'>
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
    </body>
</html>