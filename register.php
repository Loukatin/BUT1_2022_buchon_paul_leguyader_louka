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
                <form class="register" action="register.php" method="POST"> 
                    <div class="nom-prenom">
                        <input type="text" name="name" placeholder="Nom" required>
                        <input type="text" name="firstname" placeholder="Prénom" required>
                        <input type="date"  name="date" placeholder="Utilisateur" required>
                    </div>  
                    <input type="text"  name="login" placeholder="Utilisateur" required>
                    <input type="password"  name="password" placeholder="Mot de passe" required>
                    <input  type="submit" value="Connexion">
                    <input type="checkbox" name="gerant" value="gerant">
                    <a href='login.php'><p>Connexion</p></a>
                </form>
            </div>
        </div>   
    </body>
</html>