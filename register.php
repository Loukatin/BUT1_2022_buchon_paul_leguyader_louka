<?php 
require_once("header.php");
require_once("functions.php");
// if(isset($_POST['login'])&&isset($_POST['password'])){
//     $_SESSION['session'] = checklogin($_POST['login'],$_POST['password']);
//     if( $_SESSION['session'] != null){
//         if( $_SESSION['session']['type'] == 'gerant'){
//             header("location:boutiquev.php");
//         }
//         elseif( $_SESSION['session']['type'] == 'client'){
//             header("location:boutiquec.php");
//         }
//     }    
// }
// else{
//     session_destroy();
// }
?>
        <form action="" method="post" class="form-example">
            <div class="conteneur"> 
                <div class="register- carre">
                        <input type="text" id="login" name="login" placeholder="Utilisateur" required>
                        <input type="text" id="password" name="password" placeholder="Mot de passe" required>
                        <input class="connexion" type="submit" value="Connexion">
                        <a href='register.php'><p>S'inscrire</p></a>
                </div>
            </div>   
        </form>
    </body>
</html>