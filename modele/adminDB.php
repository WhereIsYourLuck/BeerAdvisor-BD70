<?php

function retirerHoublon($idHoublon){
    require('./modele/connectDB.php');
    $sql = "DELETE FROM typeHoublon WHERE idHoublon = :idHoublon";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':idHoublon', $idHoublon, PDO::PARAM_INT);
        $bool = $commande->execute();
    } catch (PDOException $e) { 
        echo utf__encode("Echec DELETE FROM typeHoublon : " . $e->getMessage . "\n"); die();
    }
}

function retirerMalt($idMalt){
    require('./modele/connectDB.php');
    $sql = "DELETE FROM typeMalt WHERE idMalt = :idMalt";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':idMalt', $idMalt, PDO::PARAM_INT);
        $bool = $commande->execute();
    } catch (PDOException $e) { 
        echo utf__encode("Echec DELETE FROM typeMalt : " . $e->getMessage . "\n"); die();
    }
}

function retirerLevure($idLevure){
    require('./modele/connectDB.php');
    $sql = "DELETE FROM typeLevure WHERE idLevure = :idLevure";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':idLevure', $idLevure, PDO::PARAM_INT);
        $bool = $commande->execute();
    } catch (PDOException $e) { 
        echo utf__encode("Echec DELETE FROM typeLevure : " . $e->getMessage . "\n"); die();
    }
}

function existeType($type, $nomType){
    require('./modele/connectDB.php');
    $sql = "SELECT id" . $type . " FROM type" . $type . " WHERE nom" . $type . " = :nom";
    try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':nom', $nomType, PDO::PARAM_STR);
        $bool = $commande->execute();
        if($bool){
            $resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select type" .$type . " : " . $e->getMessage() . "\n"); die();
    }
    if(count($resultat) == 0){ return false; } else { return true; }
}

function ajouterHoublonDB($nomHoublon){
    require('./modele/connectDB.php');
    $sql = "INSERT INTO typeHoublon(nomHoublon) VALUES(:nomHoublon)";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':nomHoublon', $nomHoublon, PDO::PARAM_STR);
        $bool = $commande->execute();
    } catch (PDOException $e) { 
        echo utf__encode("Echec insert into typeHoublon " . $e->getMessage . "\n"); die();
    }
}

function ajouterMaltDB($nomMalt){
    require('./modele/connectDB.php');
    $sql = "INSERT INTO typeMalt(nomMalt) VALUES(:nomMalt)";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':nomMalt', $nomMalt, PDO::PARAM_STR);
        $bool = $commande->execute();
    } catch (PDOException $e) { 
        echo utf__encode("Echec insert into typeMalt " . $e->getMessage . "\n"); die();
    }
}

function ajouterLevureDB($nomLevure){
    require('./modele/connectDB.php');
    $sql = "INSERT INTO typeLevure(nomLevure) VALUES(:nomLevure)";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':nomLevure', $nomLevure, PDO::PARAM_STR);
        $bool = $commande->execute();
    } catch (PDOException $e) { 
        echo utf__encode("Echec insert into typeLevure " . $e->getMessage . "\n"); die();
    }
}