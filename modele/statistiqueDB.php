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
    $sql = "SELECT COUNT(idUtilisateur) FROM utilisateur WHERE idTypeUtilisateur = 1";
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

function nbrUtilisateurUnique(&$nbrUtilUnique){
    require('./modele/connectDB.php');
    $sql = "SELECT COUNT(idUtilisateur) FROM utilisateur WHERE idTypeUtilisateur = 2";
    try {
        $commande = $pdo->prepare($sql);
        $bool = $commande->execute();
        if($bool){ $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); }
    } catch (PDOException $e) { 
        echo utf__encode("Echec insert into : " . $e->getMessage . "\n"); die();
    }
    if(count($resultat) == 0){ $nbrUtilUnique = array(); return false; } 
    else {
        $nbrUtilUnique = $resultat; return true;
    }
}

function ListeBiereRecommand(&$liste){
    require('./modele/connectDB.php');
    $sql = "SELECT DISTINCT nomBiere FROM biere INNER JOIN recommande ON biere.idBiere = recommande.idBiere";
    try {
        $commande = $pdo->prepare($sql);
        $bool = $commande->execute();
        if($bool){ $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); }
    } catch (PDOException $e) { 
        echo utf__encode("Echec insert into : " . $e->getMessage . "\n"); die();
    }
    if(count($resultat) == 0){ $liste = array(); return false; } 
    else {
        $liste = $resultat; return true;
    }
}

function BiereRecommand($num, &$biere){
    require('./modele/connectDB.php');
    $sql = "SELECT COUNT(recommande.idBiere) FROM biere INNER JOIN recommande ON biere.idBiere = recommande.idBiere WHERE nomBiere = '$num'";
    try {
        $commande = $pdo->prepare($sql);
        $bool = $commande->execute();
        if($bool){ $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); }
    } catch (PDOException $e) { 
        echo utf__encode("Echec insert into : " . $e->getMessage . "\n"); die();
    }
    if(count($resultat) == 0){ $biere = array(); return false; } 
    else {
        $biere = $resultat; return true;
    }
}
