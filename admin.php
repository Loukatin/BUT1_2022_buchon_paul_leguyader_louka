<?php 
require_once("menu.php");
require_once("functions.php");

//On empêches les client d'accéder à cette page
if($_SESSION['session']['type']=='client'){
    header('location:boutiquec.php');
}
//Ceci est exécuté lorsqu'on clique sur Promouvoir ou rétrograder prom_user() change les gérant en client et vice-versa
if(isset($_GET['id'])){
    if(get_user_by_id($_GET['id'])[0]['type'] == 'client'){
        prom_user($_GET['id'], 'gerant');
        header('location:admin.php');
    }
    else{
        prom_user($_GET['id'], 'client');
        header('location:admin.php');
    }
}

//Par mesure de sécurité et empêcher qu'il n'y ai plus d'admin, un admin ne peut pas s'enlever son rôle car il n'aparait pas dans sa page d'administration
$users = list_all_user();
foreach($users as $index => $user) {
    if($user['id']==$_SESSION['session']['id']){
        unset($users[$index]);
    }
}

?>  
        <div class="boutique-container">
            <div class="card-list">
                <?php
                    //Affihe des cartes différentes en fonction de si c'est un client ou bien à gérant. Le style change en conséquence
                    foreach($users as $index => $user) {
                        if($user['type']=='client'){
                            echo("<div id='ccard".$user['id']."' class='card user-card'>");
                        }
                        else{
                            echo("<div id='vcard".$user['id']."' class='card user-card'>");
                        }
                        echo("
                                <img class='img-rdm'src='https://picsum.photos/400/400?random'>
                                <p>". $user['prenom']." <span style='color:#1b96d1;'>''".$user['username']."''</span> ".$user['nom']."</p>
                                <p>".$user['ddn']."</p>");
                        if($user['type']=='client'){
                            echo("<a href='?id=".$user['id']."'class='usr-role'>Promouvoir</a>");
                        }
                        else{
                            echo("<a href='?id=".$user['id']."' class='usr-role'>Dégrader</a>");
                        }
                        echo("</div>
                        <style>
                        #vcard".$user['id']."{
                            box-shadow: 4px 4px 35px -4px rgb(255, 215, 61) ;
                        }
                        </style>
                        ");

                    }
                ?>
             </div>
        </div>
<script>
    let imgrdm = document.querySelectorAll('.img-rdm')
    imgrdm.forEach(element => element.src = element.src + Math.floor(Math.random() * 100000))

</script>
           