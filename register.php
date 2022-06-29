<?php 
require_once("header.php");
require_once("functions.php");
if(count($_POST)>0){
    add_user($_POST);
    // header('location:register.php');
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
                    <input class="button" type="submit" value="Connexion">
                    <input class="button" type="checkbox" name="gerant" value="gerant">
                    <a class="button1" href='login.php'><p>Connexion</p></a>
                </form>
            </div>
        </div>   
    </body>
</html>