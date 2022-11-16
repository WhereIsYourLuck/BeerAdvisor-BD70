<?php

function verifBD_utilisateur($login, $password, &$profil){
    $log = $login; $passwd = $password;
    require('./modele/connectDB.php');
    $sql = "SELECT * FROM utilisateur WHERE nomUtilisateur= :lgn";
    try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':lgn', $log, PDO::PARAM_STR);
        $bool = $commande->execute();
        if($bool){ $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n"); die();
    }
    if(count($resultat) == 0){ $profil = array(); return false; } 
    else {
        $valide = password_verify($passwd, $resultat[0]['passwordUtilisateur']);
        if($valide){ $profil = $resultat; return true; }
        $profil = array();
        return false;
    }
}

function existeUtilisateur($login){
    $log = $login;
    require_once('./modele/connectDB.php');
    $sql = "SELECT nomUtilisateur FROM utilisateur WHERE nomUtilisateur= :lgn";
    try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':lgn', $log, PDO::PARAM_STR);
        $bool = $commande->execute();
        if($bool){ $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n"); die();
    }
    if(count($resultat) == 0){ return false; } 
    else { return true; }
}

function inscriptionUtilisateur($name, $password){
    $pwdHash = $password;
    require('./modele/connectDB.php');
    $sql = "INSERT INTO utilisateur(nomUtilisateur, passwordUtilisateur, idTypeUtilisateur) VALUES (:nom, :pwd, 2)";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':nom', $name, PDO::PARAM_STR);
        $commande->bindParam(':pwd', $pwdHash, PDO::PARAM_STR);
        $bool = $commande->execute();
    } catch (PDOException $e) { 
        echo utf__encode("Echec insert into : " . $e->getMessage . "\n"); die();
    }
}

function getUtilisateursSuivis($idSuiveur, &$UtilisateursSuivis){
    require('./modele/connectDB.php');
    $sql = "SELECT suit.idUtilisateurSuivi, u2.nomUtilisateur
                    FROM suit 
                            INNER JOIN utilisateur u1 ON suit.idUtilisateurSuiveur = u1.idUtilisateur 
                            INNER JOIN utilisateur u2 ON u2.idUtilisateur = suit.idUtilisateurSuivi
            WHERE suit.idUtilisateurSuiveur = :id";
   try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':id', $idSuiveur, PDO::PARAM_INT);
        $bool = $commande->execute();
        if($bool){ $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n"); die();
    }
    if(count($resultat) == 0){ $UtilisateursSuivis = array(); return false; }
    else { $UtilisateursSuivis = $resultat; return true; }
}

function getRecommandations($idSuiveur, &$recommandations){
    require('./modele/connectDB.php');
    $sql = "SELECT recommande.idBiere, biere.nomBiere
                FROM recommande 
                        INNER JOIN utilisateur ON recommande.idUtilisateur = utilisateur.idUtilisateur
                        INNER JOIN biere ON recommande.idBiere = biere.idBiere
            WHERE recommande.idUtilisateur = :id";
   try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':id', $idSuiveur, PDO::PARAM_INT);
        $bool = $commande->execute();
        if($bool){ $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n"); die();
    }
    if(count($resultat) == 0){ $recommandations = array(); return false; }
    else { $recommandations = $resultat; return true; }
}

function getNotes($idUtilisateur, &$NotesUtilisateurs, $orderBy, $orderBy2){
    require('./modele/connectDB.php');
    $sql = "SELECT note.idBiere, biere.nomBiere, biere.noteMoyBiere, note.idUtilisateur, utilisateur.nomUtilisateur, note.noteValeur, note.commentaireBiere, note.dateDegustation
                FROM note
                    INNER JOIN utilisateur on note.idUtilisateur = utilisateur.idUtilisateur
                    INNER JOIN biere ON note.idBiere = biere.idBiere
            WHERE note.idUtilisateur = :id ORDER BY " . $orderBy2 . " ". $orderBy;
   try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':id', $idUtilisateur, PDO::PARAM_INT);
        $bool = $commande->execute();
        if($bool){
            $resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n"); die();
    }
    if(count($resultat) == 0){ $NotesUtilisateurs = array(); return false; } 
    else { $NotesUtilisateurs = $resultat; return true; }
}

function ajouterUtilisateurSuivi($idUtilisateurSuiveur, $idUtilisateurSuivi){
    require('./modele/connectDB.php');
    $sql = "INSERT INTO suit(idUtilisateurSuiveur, idUtilisateurSuivi) VALUES (:id1, :id2)";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':id1', $idUtilisateurSuiveur, PDO::PARAM_INT);
        $commande->bindParam(':id2', $idUtilisateurSuivi, PDO::PARAM_INT);
        $bool = $commande->execute();
    } catch (PDOException $e) { 
        echo utf__encode("Echec insert into : " . $e->getMessage . "\n"); die();
    }
}

function existeUtilisateurSuivi($idUtilisateurSuiveur, $idUtilisateurSuivi){
    require('./modele/connectDB.php');
    $sql = "SELECT idUtilisateurSuivi FROM suit WHERE idUtilisateurSuiveur = :id1 AND idUtilisateurSuivi = :id2";
    try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':id1', $idUtilisateurSuiveur, PDO::PARAM_INT);
        $commande->bindParam(':id2', $idUtilisateurSuivi, PDO::P²RAM_INT);
        $bool = $commande->execute();
        if($bool){
            $resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n"); die();
    }
    if(count($resultat) == 0){ return false; } else { return true; }
}

function desabonnerUtilisateur($idUtilisateurSuiveur, $idUtilisateurSuivi){
    require('./modele/connectDB.php');
    $sql ="DELETE FROM suit WHERE idUtilisateurSuiveur = :id1 AND idUtilisateurSuivi = :id2";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':id1', $idUtilisateurSuiveur, PDO::PARAM_INT);
        $commande->bindParam(':id2', $idUtilisateurSuivi, PDO::PARAM_INT);
        $bool = $commande->execute();
    } catch (PDOException $e) { 
        echo utf__encode("Echec insert into : " . $e->getMessage . "\n"); die();
    }
}

function getBiereSuiveur($idSuivi, &$BiereCommenteesSuiveur){
    require('./modele/connectDB.php');
    $sql = "SELECT biere.nomBiere, note.idBiere FROM note INNER JOIN biere ON note.idBiere = biere.idBiere WHERE note.idUtilisateur = :id";
   try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':id', $idSuivi, PDO::PARAM_INT);
        $bool = $commande->execute();
        if($bool){ $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n"); die();
    }
    if(count($resultat) == 0){ $BiereCommenteesSuiveur = array(); return false; }
    else { $BiereCommenteesSuiveur = $resultat; return true; }
}