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
    if(count($resultat) == 0){ $infosBiere = array(); return false; }
    else { $infosBiere = $resultat; return true; }
}

function listeBieresTriees($type, $sensOrder, &$listeBieresResultat){
    require('./modele/connectDB.php');
    $sql = "SELECT * FROM biere ORDER BY " . $type . " " . $sensOrder;
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

function commentairesBiere($idBiere, &$commantairesBiere){
    require('./modele/connectDB.php');
    $sql = "SELECT utilisateur.idUtilisateur , utilisateur.nomUtilisateur, note.noteValeur, note.dateDegustation, note.commentaireBiere
            FROM biere INNER JOIN note on note.idBiere = biere.idBiere
                INNER JOIN utilisateur ON note.idUtilisateur = utilisateur.idUtilisateur
            WHERE biere.idBiere = :id";
    try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':id', $idBiere, PDO::PARAM_INT);
        $bool = $commande->execute();
        if($bool){ $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n"); die();
    }
    if(count($resultat) == 0){ $commantairesBiere = array(); return false; }
    else { $commantairesBiere = $resultat; return true; }
}

function utilisateurRecommandeBiere($idUtilisateur, $idBiere){
    require('./modele/connectDB.php');
    $sql = "SELECT * FROM recommande WHERE idBiere = :id1 AND idUtilisateur = :id2";
    try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':id2', $idUtilisateur, PDO::PARAM_INT);
        $commande->bindParam(':id1', $idBiere, PDO::PARAM_INT);
        $bool = $commande->execute();
        if($bool){
            $resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n"); die();
    }
    if(count($resultat) == 0){ return false; } else { return true; }
}

function ajouterRecommandationBiere($idUtilisateur, $idBiere){
    require('./modele/connectDB.php');
    $sql = "INSERT INTO recommande(idBiere, idUtilisateur) VALUES (:id1, :id2)";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':id1', $idBiere, PDO::PARAM_INT);
        $commande->bindParam(':id2', $idUtilisateur, PDO::PARAM_INT);
        $bool = $commande->execute();
    } catch (PDOException $e) { 
        echo utf__encode("Echec insert into : " . $e->getMessage . "\n"); die();
    }
}

function supprimerRecommandationBiere($idUtilisateur, $idBiere){
    require('./modele/connectDB.php');
    $sql = "DELETE FROM recommande WHERE idBiere = :id1 AND idUtilisateur = :id2";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':id1', $idBiere, PDO::PARAM_INT);
        $commande->bindParam(':id2', $idUtilisateur, PDO::PARAM_INT);
        $bool = $commande->execute();
    } catch (PDOException $e) { 
        echo utf__encode("Echec DELETE FROM recommande : " . $e->getMessage . "\n"); die();
    }
}

function supprimerBiereDB($idBiere){
    require('./modele/connectDB.php');
    $sql = "DELETE FROM biere WHERE idBiere = :id1";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':id1', $idBiere, PDO::PARAM_INT);
        $bool = $commande->execute();
    } catch (PDOException $e) { 
        echo utf__encode("Echec DELETE FROM note : " . $e->getMessage . "\n"); die();
    }
}