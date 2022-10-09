<?php

function verifBD_utilisateur($login, $password, &$profil){
    $log = $login;
    $passwd = $password;
    include_once('./modele/connectDB.php');
    $sql = "SELECT * FROM users WHERE nomUser= :lgn";
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
        $valide = password_verify($passwd, $resultat[0]['passwordUser']);
        if($valide){
            $profil = $resultat;
            return true;
        }
        $profil = array();
        return false;
    }
}

function inscriptionUtilisateur($name, $grade, $password){
    $pwdHash = $password;
    require_once('./modele/connectDB.php');
    $sql = "INSERT INTO users(nomUser, passwordUser, gradeUser) VALUES (:nom, :pwd, :grd)";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':nom', $name, PDO::PARAM_STR);
        $commande->bindParam(':pwd', $pwdHash, PDO::PARAM_STR);
        $commande->bindParam(':grd', $grade, PDO::PARAM_STR);
        $bool = $commande->execute();
         
    } catch (PDOException $e) {
        echo utf__encode("Echec insert into : " . $e->getMessage . "\n");
        die();
    }
}