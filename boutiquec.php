<?php 
require_once("menu.php");
require_once("functions.php");
$boutiques = get_boutiques();
?>
<div class="boutique-container">
            <div class="menu-filter"></div>
            <div class="card-list">
                <?php
                    foreach($boutiques as $index => $boutique) {
                        echo("
                        <a class='card' href=stockc.php?id='".$boutique['boutique_id']."'>
                        <div>
                            <div class='card-illustration'>
                                <img src='media/bonbon.jpg'>
                            </div>
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
                         </div></a>");
                    }
                ?>
            </div>
        </div>    
    </body>
</html>