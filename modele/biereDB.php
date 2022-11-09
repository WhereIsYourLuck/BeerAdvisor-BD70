<?php 

function listeBieres(&$listeBieresResultat){
    require('./modele/connectDB.php');
    $sql = "SELECT * FROM biere";
    try{
        $commande = $pdo->prepare($sql);
        $bool = $commande->execute();
        if($bool){ $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n"); die();
    }
    if(count($resultat) == 0){ $listeBieresResultat = array(); return false; }
    else { $listeBieresResultat = $resultat; return true; }
}

function infoBiere($idBiere, &$infosBiere){
    require('./modele/connectDB.php');
    $sql = "SELECT * FROM biere WHERE idBiere = :id";
    try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':id', $idBiere, PDO::PARAM_INT);
        $bool = $commande->execute();
        if($bool){ $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n"); die();
    }
    if(count($resultat) == 0){ $$infosBiere = array(); return false; }
    else { $$infosBiere = $resultat; return true; }
}