<?php
function existeType($type, $idType, $idBiere){
    require('./modele/connectDB.php');
    $sql = "SELECT id" . $type . " FROM possede" . $type . " WHERE id" . $type . " = :idType AND idBiere = :idBiere";
    try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':idType', $idType, PDO::PARAM_INT);
        $commande->bindParam(':idBiere', $idBiere, PDO::PARAM_INT);
        $bool = $commande->execute();
        if($bool){
            $resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select type" .$type . " : " . $e->getMessage() . "\n"); die();
    }
    if(count($resultat) == 0){ return false; } else { return true; }
}
function existeNom($idNom){
    require('./modele/connectDB.php');
    $sql = "SELECT nomBiere FROM biere WHERE nomBiere = :nom";
    try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':nom', $idNom, PDO::PARAM_STR);
        $bool = $commande->execute();
        if($bool){
            $resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n"); die();
    }
    if(count($resultat) == 0){ return false; }
    else { return true; }
}