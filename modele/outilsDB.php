<?php

function getDateToday(){
    require('./modele/connectDB.php');
    $sql = "SELECT CURDATE()";
    try{
        $commande = $pdo->prepare($sql);
        $bool = $commande->execute();
        if($bool){ $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n"); die();
    }
    return $resultat[0]["CURDATE()"];
}