<?php 
require_once("header.php");
require_once("functions.php");
//Cette Partie du code est rappelé lorsque l'on clique sur s'inscrire pour traiter le formulaire'

if(count($_POST)>0){
    add_user($_POST);
    header('location:login.php');
}
?>
        <div class="conteneur"> 
            <div class="register">
                <form class="register0" action="register.php" method="POST"> 
                    <div class="nom-prenom">
                        <input class="button" type="text" name="name" placeholder="Nom" required>
                        <input class="button" type="text" name="firstname" placeholder="Prénom" required>
                        <input class="button" type="date"  name="date" placeholder="Utilisateur" required>
                    </div>  
                    <input class="button" type="text"  name="login" placeholder="Utilisateur" required>
                    <input class="button" type="password"  name="password" placeholder="Mot de passe" required>
                    <input class="button registerb" type="submit" value="S'inscrire">
                    <div class='cstyle'>
                        <label for="gerant">Gérant:</label>
                        <input class="button checkbox" type="checkbox" name="gerant" value="gerant">                        
                    </div>
                    <a class="button1" href='login.php'><p>Connexion</p></a>
                </form>
            </div>
        </div>   
    </body>
</html>