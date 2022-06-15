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
?>

