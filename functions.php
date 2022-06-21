<?php
require_once("db/db.php");
function get_boutiques(){
        global $DB;
        $sql = "SELECT * FROM boutiques b JOIN adresses a on b.adresse_id = a.adresse_id";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    } 
    catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

function get_confiserie(){
    global $DB;
    $sql = "SELECT * FROM confiseries";
try {
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
} 
catch (Exception $ex) {
    echo $ex->getMessage();
}
}
function checklogin($user,$pass){
    global $DB;
    $sql = "SELECT * FROM `utilisateurs`";
try {
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();

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
    global $DB;
    $sql = "SELECT * FROM `stocks` s JOIN confiseries c on c.confiserie_id = s.confiserie_id WHERE s.boutique_id = $id; ";
try {
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
} 
catch (Exception $ex) {
    echo $ex->getMessage();
}
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
    global $DB;
    $sql = " DELETE FROM adresses WHERE `adresse_id` =$id";
    $sql2 = "DELETE FROM stocks WHERE `boutique_id` = $id";
    $sql3 = "DELETE FROM boutiques WHERE `boutique_id` = $id";

try {
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $stmt2 = $DB->prepare($sql2);
    $stmt2->execute();
    $stmt3 = $DB->prepare($sql3);
    $stmt3->execute();
} 
catch (Exception $ex) {
    echo $ex->getMessage();
}
}


function compte_gâtrerie($idb,$idc){
    global $DB;
    $idc = intval($idc);
    $sql = "SELECT count(confiserie_id) FROM `stocks` WHERE confiserie_id = $idc AND boutique_id = $idb";
try {
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
} 
catch (Exception $ex) {
    echo $ex->getMessage();
}
}

function ajoute_gâtrerie($idb,$idc){
    global $DB;
    $idc = intval($idc);
    $sql = "INSERT INTO stocks(date_de_peremption, date_de_mise_en_stock, boutique_id, confiserie_id) VALUES (NOW() + INTERVAL 14 DAY, NOW(), $idb, $idc);";
try {
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
} 
catch (Exception $ex) {
    echo $ex->getMessage();
}
}

function liste_gâterie_boutique($idb,$idc){
    global $DB;
    $sql = "SELECT * FROM stocks WHERE `boutique_id` = $idb AND `confiserie_id`= $idc;";
try {
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
} 
catch (Exception $ex) {
    echo $ex->getMessage();
}
}

function supprime_gâtrerie($idb,$idc){
    global $DB;
    $liste_gaterie = liste_gâterie_boutique($idb,$idc);
    if(count($liste_gaterie)>0){
        $sql = "DELETE FROM stocks WHERE `id` = ".$liste_gaterie[0]['id'];
        try {
            $stmt = $DB->prepare($sql);
            $stmt->execute();
        } 
        catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}

function list_all_user(){
    global $DB;
    $sql = "SELECT * from utilisateurs";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    } 
    catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

function prom_user($id, $role){
    global $DB;
    $sql = "UPDATE utilisateurs SET type = '$role' WHERE id=$id";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    } 
    catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
function get_user_by_id($id){
    global $DB;
    $sql = "SELECT * from utilisateurs where id = $id";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    } 
    catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
?>



