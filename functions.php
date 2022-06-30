<?php
require_once("db/db.php");

function db_query($query){
    global $DB;
    $sql = $query;
    $results = [];

    try {
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

    return $results;
}


function get_boutiques(){
    $sql = "SELECT * FROM boutiques b JOIN adresses a on b.adresse_id = a.adresse_id";
    return db_query($sql);
}

function get_confiserie(){
    $sql = "SELECT * FROM confiseries";
    return db_query($sql);
}

function checklogin($user,$pass){
    try {
        $results = db_query("SELECT * FROM `utilisateurs`");
        foreach($results as $index => $element){
            if($element['username'] == $user && $element['password'] == md5($pass)){
                return $element;
            }
        }
    } 
    catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

function get_stock_by_id($id){
    $sql = "SELECT * FROM `stocks` s JOIN confiseries c on c.confiserie_id = s.confiserie_id WHERE s.boutique_id = $id; ";
    return db_query($sql);
}

function add_boutique($data){
    global $DB;
    $sql = "INSERT INTO adresses(numero_rue, nom_adresse, code_postal, ville, pays) VALUES ('".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."', '".$data[5]."');";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $last_id = $DB->lastInsertId();
        add_boutique_adresse($last_id,$data);
    } 
    catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

function add_boutique_adresse($adresse,$data){
    global $DB;
    $adresse = intval($adresse);
    $sql= "INSERT INTO boutiques(boutique_id, nom, adresse_id) VALUES ($adresse,'".$data[0]."', $adresse);";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    } 
    catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

function delete_boutique($id){
    $sql = "DELETE FROM adresses WHERE `adresse_id` =$id";
    $sql2 = "DELETE FROM stocks WHERE `boutique_id` = $id";
    $sql3 = "DELETE FROM boutiques WHERE `boutique_id` = $id";
    db_query($sql);
    db_query($sql2);
    db_query($sql3);
}


function compte_gâtrerie($idb,$idc){
    $sql = "SELECT count(confiserie_id) FROM `stocks` WHERE confiserie_id = $idc AND boutique_id = $idb";
    return db_query($sql);
}

function ajoute_gâtrerie($idb,$idc){
    $sql = "INSERT INTO stocks(date_de_peremption, date_de_mise_en_stock, boutique_id, confiserie_id) VALUES (NOW() + INTERVAL 14 DAY, NOW(), $idb, $idc);";
    db_query($sql);
}

function liste_gâterie_boutique($idb,$idc){
    $sql = "SELECT * FROM stocks WHERE `boutique_id` = $idb AND `confiserie_id`= $idc;";
    return db_query($sql);
}

function supprime_gâtrerie($idb,$idc){
    $liste_gaterie = liste_gâterie_boutique($idb,$idc);
    if(count($liste_gaterie)>0){
        $sql = "DELETE FROM stocks WHERE `id` = ".$liste_gaterie[0]['id'];
        db_query($sql);
    }
}

function list_all_user(){
    $sql = "SELECT * from utilisateurs";
    return db_query($sql);
}

function prom_user($id, $role){
    $sql = "UPDATE utilisateurs SET type = '$role' WHERE id=$id";
    return db_query($sql);
}

function get_user_by_id($id){
    $sql = "SELECT * from utilisateurs where id = $id";
    return db_query($sql);
}

function add_user($data){
    if(isset($data['gerant'])){
        $type = 'gerant';
    }
    else{
        $type = 'client';
    }
    $sql = "INSERT INTO utilisateurs(username, password, type, prenom, nom, ddn)
    VALUES ('".$data['login']."', md5('".$data['password']."'), '$type', '".$data['firstname']."', '".$data['name']."', '".$data['date']."');";
    return db_query($sql);
}
?>