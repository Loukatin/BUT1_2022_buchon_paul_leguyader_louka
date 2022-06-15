<?php require_once("menu.php")?>
        <div class="boutique-container">
            <div class="add-boutique">
                <form>  
                    <div id="line1" class="line">
                        <p>Nom boutique:</p>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div id="line2" class="line">
                        <p>Code Postal: </p>
                        <input type="text" id="codep" name="codep" required>
                        <p>Ville: </p>
                        <input type="text" id="ville" name="ville" required>
                    </div>
                    <div id="line3" class="line">
                        <p>Rue: </p>
                        <input type="text" id="street" name="street" required>
                        <p>Pays: </p>
                        <select name="pets" id="pet-select">
                            <option value="fr">France</option>
                            <option value="en">Angleterre</option>
                        </select>
                        <input type="submit" value="Ajouter une boutique">
                    </div>
                </form>
            </div>
            <div class="card-list">
                <div class="card boutique-vendeur">
                    <div class="card-illustration">
                        <img src="media/bonbon.jpg">
                    </div>
                    <div class="info">
                        <div class="nom-boutique titles-div">
                            <p class="card-titles">Nom boutique:</p>
                            <div class="nom-content">
                                <p>Le petit fournil</p>
                            </div>
                        </div>
                        <div class="adresse-boutique titles-div">
                            <p class="card-titles">Adresse:</p>
                            <div class="adresse-content">
                                <p>3 rue 2 Eric Tabarly 22950 Trégeux </p>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </body>
</html>