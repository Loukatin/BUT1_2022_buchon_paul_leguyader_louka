<?php require_once("header.php");?>
            <div class="top-nav">
                <!-- Permet un retour à la boutique -->
                <a style='margin-left:2%'href='boutiquev.php'><p class="nom-prenom"><?=$_SESSION['session']['nom']?> <?=$_SESSION['session']['prenom']?></p></a>

                <div class='left-button'>
                    <!-- Permet au admin de gérer les utilisateurs -->
                    <?php if($_SESSION['session']['type']=='gerant'){
                        echo("<a style='margin-right:2%;' href='admin.php'><p class='nom-prenom'>Gérer les utilisateurs</p></a>");
                    }?>
                    <!-- Permet la déconnexion -->
                    <a style='margin-right:2%;' href='login.php'><p class="nom-prenom">Déconnexion</p></a>
                </div>
        </div>
