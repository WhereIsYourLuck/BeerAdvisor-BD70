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

function existeTypeBug($type, $idType){
    require('./modele/connectDB.php');
    $sql = "SELECT id" . $type . " FROM type" . $type . " WHERE id" . $type . " = :idType";
    try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':idType', $idType, PDO::PARAM_INT);

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

function changerNomDB($idBiere, $nvNomBiere){
    require('./modele/connectDB.php');
    $sql = "UPDATE biere set nomBiere = :nvNom WHERE idBiere = :id";
    try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':nvNom', $nvNomBiere,  PDO::PARAM_STR);
        $commande->bindParam(':id', $idBiere, PDO::PARAM_INT);
        $bool = $commande->execute();
        if($bool){
            $resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e){
        echo utf8_encode("Echec d'update changerNomBiere' : " . $e->getMessage() . "\n"); die();
    }
}

function changerTauxAlcoolDB($idBiere, $nvTauxAlcool){
    require('./modele/connectDB.php');
    $sql = "UPDATE biere set tauxAlcool = :nvTaux WHERE idBiere = :id";
    try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':nvTaux', $nvTauxAlcool,  PDO::PARAM_STR);
        $commande->bindParam(':id', $idBiere, PDO::PARAM_INT);
        $bool = $commande->execute();
        if($bool){
            $resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e){
        echo utf8_encode("Echec d'update : " . $e->getMessage() . "\n"); die();
    }
}

function ajouterTypeDB($idBiere, $idType, $nomType){
    require('./modele/connectDB.php');
    $sql = "INSERT INTO possede" . $nomType . "(id" . $nomType .  ", idBiere) VALUES (:idT, :idB)";
    try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':idB', $idBiere,  PDO::PARAM_INT);
        $commande->bindParam(':idT', $idType, PDO::PARAM_INT);
        $bool = $commande->execute();
        if($bool){
            $resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e){
        echo utf8_encode("Echec d'insert : " . $e->getMessage() . "\n"); die();
    }
}

function supprimerTypeDB($idBiere, $idType, $nomType){
    require('./modele/connectDB.php');
    $sql = "DELETE from possede" . $nomType . " WHERE idBiere = :idB AND id" . $nomType . " = :idT";
    try{
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':idB', $idBiere,  PDO::PARAM_INT);
        $commande->bindParam(':idT', $idType, PDO::PARAM_INT);
        $bool = $commande->execute();
        if($bool){
            $resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e){
        echo utf8_encode("Echec 'de delete' : " . $e->getMessage() . "\n"); die();
    }
}

