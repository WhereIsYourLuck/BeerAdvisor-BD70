<?php

function affichageModification(){
    require_once('./modele/biereDB.php');
    require_once('./modele/utilisateurDB.php');
    require_once('./modele/modificationBiereDB.php');
    if(isset($_GET['idBiere'])){ 
        infoBiere($_GET['idBiere'], $infosBiere);
        getLevuresBiere($_GET['idBiere'], $levuresBiere);
        getHoublonsBiere($_GET['idBiere'], $houblonsBiere);
        getMaltsBiere($_GET['idBiere'], $maltsBiere);
        getMalts($malts);
        getLevures($levures);
        getHoublons($houblons);
     } else { header("location: index.php?"); }
    require('./view./templates/modificationsBiere.tpl');
}

function changerNom(){
    require_once('./modele/biereDB.php');
    require_once('./modele/modificationBiereDB.php');
    if(!isset($_POST['nomBiere']) || $_POST['nomBiere'] != ""){
        if(!existeNom($_POST['nomBiere'])){
            changerNomDB($_GET['idBiere'], trim(strtolower($_POST['nomBiere'])));
            affichageModification();
        } else { header("location: index.php?controller=modificationsBiere&action=affichageModification&idBiere=" . $_GET['idBiere'] . "&prbnom=Ce nom existe déjà"); }
    } else { header("location: index.php?controller=modificationsBiere&action=affichageModification&idBiere=" . $_GET['idBiere'] . "&prbnom=Mettre un nom valide"); }
}

function changerTAlcool(){
    require_once('./modele/biereDB.php');
    require_once('./modele/modificationBiereDB.php');
    if(!isset($_POST['tauxAlcool']) || $_POST['tauxAlcool'] != ""){
        changerTauxAlcoolDB($_GET['idBiere'], $_POST['tauxAlcool']);
        affichageModification();
    } else { header("location: index.php?controller=modificationsBiere&action=affichageModification&idBiere=" . $_GET['idBiere'] . "&prbAlcool=Rentrer un taux d'alcool valide"); }
}

function supprimerType(){
    require_once('./modele/biereDB.php');
    require_once('./modele/modificationBiereDB.php');
    if(isset($_GET['typeChangement'])){
        switch($_GET['typeChangement']){
            case "levure" :
                supprimerTypeDB($_GET['idBiere'], $_POST['typeCarac'], "levure"); break;
            case "houblon" :
                supprimerTypeDB($_GET['idBiere'], $_POST['typeCarac'], "houblon"); break;
            case "malt" : 
                supprimerTypeDB($_GET['idBiere'], $_POST['typeCarac'], "malt"); break;
            default : 
            header("location: index.php?controller=modificationsBiere&action=affichageModification&idBiere=" . $_GET['idBiere']); break;
        }
        header("location: index.php?controller=modificationsBiere&action=affichageModification&idBiere=" . $_GET['idBiere']);
    } else { header("location: index.php?controller=modificationsBiere&action=affichageModification&idBiere=" . $_GET['idBiere']); }
}

function ajouterType(){
    require_once('./modele/biereDB.php');
    require_once('./modele/modificationBiereDB.php');
    if(isset($_GET['typeChangement']) && $_GET['typeChangement'] != "" && existeTypeBug($_GET['typeChangement'], $_POST['typeCarac'])){
        if(existeType($_GET['typeChangement'], $_POST['typeCarac'], $_GET['idBiere'])){
            header("location: index.php?controller=modificationsBiere&action=affichageModification&idBiere=" . $_GET['idBiere'] . "&messerr=Cette caractéristique est déjà dans la bière");
        } else {
            switch($_GET['typeChangement']){
                case "levure" :
                    ajouterTypeDB($_GET['idBiere'], $_POST['typeCarac'], "levure");
                    header("location: index.php?controller=modificationsBiere&action=affichageModification&idBiere=" . $_GET['idBiere']); break;
                case "houblon" :
                    ajouterTypeDB($_GET['idBiere'], $_POST['typeCarac'], "houblon");
                    header("location: index.php?controller=modificationsBiere&action=affichageModification&idBiere=" . $_GET['idBiere']); break;
                case "malt" : 
                    ajouterTypeDB($_GET['idBiere'], $_POST['typeCarac'], "malt");
                    header("location: index.php?controller=modificationsBiere&action=affichageModification&idBiere=" . $_GET['idBiere']); break;
                default : 
                header("location: index.php?controller=modificationsBiere&action=affichageModification&idBiere=" . $_GET['idBiere']); break;
            }
        }
    } else { header("location: index.php?controller=modificationsBiere&action=affichageModification&idBiere=" . $_GET['idBiere']); }
}

return array('ajouterType', 'affichageModification', 'changerNom', 'changerTAlcool', 'supprimerType');