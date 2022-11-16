<?php 

function nbrUtilisateur(&$nbrUtil){
    require('./modele/connectDB.php');
    $sql = "SELECT COUNT(idUtilisateur) FROM utilisateur";
    try {
        $commande = $pdo->prepare($sql);
        $bool = $commande->execute();
        if($bool){ $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); }
    } catch (PDOException $e) { 
        echo utf__encode("Echec insert into : " . $e->getMessage . "\n"); die();
    }
    if(count($resultat) == 0){ $nbrUtil = array(); return false; } 
    else {
        $nbrUtil = $resultat; return true;
    }
}

function BiereSaisies(&$nbrBiere){
    require('./modele/connectDB.php');
    $sql = "SELECT COUNT(idBiere) FROM biere";
    try {
        $commande = $pdo->prepare($sql);
        $bool = $commande->execute();
        if($bool){ $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); }
    } catch (PDOException $e) { 
        echo utf__encode("Echec insert into : " . $e->getMessage . "\n"); die();
    }
    if(count($resultat) == 0){ $nbrBiere = array(); return false; } 
    else {
        $nbrBiere = $resultat; return true;
    }
}

function nbrAdmin(&$nbrAdmin){
    require('./modele/connectDB.php');
    $sql = " ";
    try {
        $commande = $pdo->prepare($sql);
        $bool = $commande->execute();
        if($bool){ $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); }
    } catch (PDOException $e) { 
        echo utf__encode("Echec insert into : " . $e->getMessage . "\n"); die();
    }
    if(count($resultat) == 0){ $nbrAdmin = array(); return false; } 
    else {
        $nbrAdmin = $resultat; return true;
    }
}
