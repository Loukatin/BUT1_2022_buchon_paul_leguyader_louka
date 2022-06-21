<?php require_once("header.php");?>
            <div class="top-nav">
                <a style='margin-left:2%'href='boutiquev.php'><p class="nom-prenom"><?=$_SESSION['session']['nom']?> <?=$_SESSION['session']['prenom']?></p></a>
                <div class='left-button'>
                    <?php if($_SESSION['session']['type']=='gerant'){
                        echo("<a style='margin-right:2%;' href='admin.php'><p class='nom-prenom'>Gérer les utilisateurs</p></a>");
                    }?>
                    <a style='margin-right:2%;' href='login.php'><p class="nom-prenom">Déconnexion</p></a>
                </div>
        </div>
