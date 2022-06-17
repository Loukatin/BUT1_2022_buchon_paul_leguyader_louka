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
    $id = count(get_boutiques()) + 1;
    $data[1] = intval($data[1]);
    $sql = "INSERT INTO adresses(adresse_id, numero_rue, nom_adresse, code_postal, ville, pays) VALUES ($id, '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."', '".$data[5]."');";
    $sql2 = "INSERT INTO boutiques(boutique_id, nom, adresse_id) VALUES ($id,'".$data[0]."', $id);";
try {
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $stmt2 = $DB->prepare($sql2);
    $stmt2->execute();
} 
catch (Exception $ex) {
    echo $ex->getMessage();
}
}

function delete_boutique($id){
    global $DB;
    $id = intval($id) + 1;
    $sql = "DELETE FROM boutiques WHERE `boutique_id` = $id";
    $sql2 = "DELETE FROM adresses WHERE `adresse_id` = $id";
try {
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $stmt2 = $DB->prepare($sql2);
    $stmt2->execute();
} 
catch (Exception $ex) {
    echo $ex->getMessage();
}
}


function compte_gâtrerie($idb,$idc){
    global $DB;
    $idc = intval($idc);
    $sql = "SELECT count(confiserie_id) FROM `stocks` WHERE confiserie_id =$idc AND boutique_id = $idb";
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

function supprime_gâtrerie($idb,$idc){
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
  ?>

