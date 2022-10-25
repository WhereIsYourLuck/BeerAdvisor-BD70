<?php

function verifBD_utilisateur($login, $password, &$profil){
    $log = $login;
    $passwd = $password;
    require('./modele/connectDB.php');
    $sql = "SELECT * FROM utilisateur WHERE nomUtilisateur= :lgn";
    try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':lgn', $log, PDO::PARAM_STR);
        $bool = $commande->execute();
        if($bool){
            $resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
        die();
    }
    if(count($resultat) == 0){
        $profil = array();
        return false;
    } else {
        $valide = password_verify($passwd, $resultat[0]['passwordUtilisateur']);
        if($valide){
            $profil = $resultat;
            return true;
        }
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
        if($bool){
            $resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e){
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
        die();
    }
    if(count($resultat) == 0){
        return false;
    } else {
        return true;
    }
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
        echo utf__encode("Echec insert into : " . $e->getMessage . "\n");
        die();
    }
}