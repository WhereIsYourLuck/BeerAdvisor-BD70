<?php

function affichageAccueil(){
    require_once('./modele/biereDB.php');
    listeBieres($listeBieresResultat);
    getMalts($malts);
    getLevures($levures);
    getHoublons($houblons);
    $nomTri = "";
    $moyTri = "";
    $alcoolTri = "";
    if(isset($_GET['tri2']) && $_GET['tri2'] == "ASC"){
        $nomTri =  "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=nomBiere&tri2=DESC\">nom</a>";
        $moyTri =  "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=noteMoyBiere&tri2=DESC\">note moyenne / 5</a>";
        $alcoolTri = "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=tauxAlcool&tri2=DESC\">Taux d'alcool en %</a>";
    } else {
        $nomTri = "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=nomBiere&tri2=ASC\">nom</a>";
        $moyTri = "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=noteMoyBiere&tri2=ASC\">note moyenne / 5</a>";
        $alcoolTri = "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=tauxAlcool&tri2=ASC\">Taux d'alcool en %</a>";
    }
    require_once('./view/accueil.tpl');
}

function affichageAccueilTrie(){
    require_once('./modele/biereDB.php');
    if(isset($_GET['tri']) && isset($_GET['tri2']) && ($_GET['tri'] == "nomBiere" || $_GET['tri'] == "tauxAlcool" || $_GET['tri'] == "noteMoyBiere") && ($_GET['tri2'] == "DESC" || $_GET['tri2'] == "ASC")){
        listeBieresTriees($_GET['tri'], $_GET['tri2'], $listeBieresResultat);
        getMalts($malts);
        getLevures($levures);
        getHoublons($houblons);
        $nomTri = "";
        $moyTri = "";
        $alcoolTri = "";
        if(isset($_GET['tri2']) && $_GET['tri2'] == "ASC"){
            $nomTri =  "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=nomBiere&tri2=DESC\">nom</a>";
            $moyTri =  "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=noteMoyBiere&tri2=DESC\">note moyenne / 5</a>";
            $alcoolTri = "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=tauxAlcool&tri2=DESC\">Taux d'alcool en %</a>";
        } else {
            $nomTri = "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=nomBiere&tri2=ASC\">nom</a>";
            $moyTri = "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=noteMoyBiere&tri2=ASC\">note moyenne / 5</a>";
            $alcoolTri = "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=tauxAlcool&tri2=ASC\">Taux d'alcool en %</a>";
        }
    } else {
        header("location: index.php?");
    }
    require_once('./view/accueil.tpl');
}

function affichageBiere(){
    require_once('./modele/biereDB.php');
    require_once('./modele/utilisateurDB.php');
    if(isset($_GET['idBiere'])){ 
        infoBiere($_GET['idBiere'], $infosBiere);
        getLevuresBiere($_GET['idBiere'], $levuresBiere);
        getHoublonsBiere($_GET['idBiere'], $houblonsBiere);
        getMaltsBiere($_GET['idBiere'], $maltsBiere);
        commentairesBiere($_GET['idBiere'], $commentairesBiere);
        if(isset($_SESSION['idUtilisateur'])) {
            $recommande = utilisateurRecommandeBiere($_SESSION['idUtilisateur'], $_GET['idBiere']);
            $estCommentee = existeCommentaire($_SESSION['idUtilisateur'], $_GET['idBiere']);
        } else { $recommande = -1; }
     } else { header("location: index.php?"); }
    require('./view./templates/ficheBiere.tpl');
}


function recommanderBiere(){
    require_once('./modele/biereDB.php');
    //On fait pas de verif si l'utilisateur est pas d??j?? suiveur par le 1er user car c'est check?? dans la bdd
    if(isset($_SESSION['idUtilisateur']) && isset($_GET['idBiere'])) {
        ajouterRecommandationBiere($_SESSION['idUtilisateur'], intval($_GET['idBiere'])); affichageBiere();
    } else { header("location: index.php?"); }
}

function supprimerRecommandation(){
    require_once('./modele/biereDB.php');
    if(isset($_SESSION['idUtilisateur']) && isset($_GET['idBiere'])) {
        supprimerRecommandationBiere($_SESSION['idUtilisateur'], intval($_GET['idBiere'])); affichageBiere();
    } else { header("location: index.php?"); }
}

function retirerRecommanderBiere(){
    require_once('./modele/biereDB.php');
    if(isset($_SESSION['idUtilisateur'])) {
        supprimerRecommandationBiere($_SESSION['idUtilisateur'], intval($_GET['idBiere'])); affichageBiere();
    } else { header("location: index.php?"); }
}

function supprimerBiere(){
    require_once('./modele/biereDB.php');
    if(isset($_SESSION['idTypeUtilisateur']) && ($_SESSION['idTypeUtilisateur'] == 1)) {
        SupprimerBiereDB(intval($_GET['idBiere'])); affichageAccueil();
    } else { header("location: index.php?"); }
}


function rechercheBiere(){
    require_once('./modele/biereDB.php');
    $arguments = array("biere.nomBiere" => $_POST['nomBiere'], "noteMoyenne" => $_POST['noteMoyenne'], "tauxAlcool" => floatval($_POST['tauxAlcool']), "possedehoublon.idHoublon" => intval($_POST['houblon']), "possedemalt.idMalt" => intval($_POST['malt']),  "possedelevure.idLevure" => intval($_POST['levure']));
    $sql = "SELECT DISTINCT biere.idBiere, biere.nomBiere, biere.tauxAlcool, biere.noteMoyBiere FROM biere ";
    if($arguments['possedehoublon.idHoublon'] != 0){ $sql = $sql . "INNER JOIN possedehoublon ON possedehoublon.idBiere = biere.idBiere INNER JOIN typehoublon ON typehoublon.idHoublon = possedehoublon.idHoublon ";}
    if($arguments['possedemalt.idMalt'] != 0){ $sql = $sql . "INNER JOIN possedemalt ON possedemalt.idBiere = biere.idBiere INNER JOIN typemalt ON typemalt.idMalt = possedemalt.idMalt ";}
    if($arguments['possedelevure.idLevure'] != 0){ $sql = $sql . "INNER JOIN possedelevure ON possedelevure.idBiere = biere.idBiere INNER JOIN typelevure ON typelevure.idLevure = possedelevure.idLevure ";}
    $sql = $sql . " WHERE ";
    foreach($arguments as $key => $value){ if($value == 0 || $value == ""){ unset($arguments[$key]); } }
    $argumentsTaille = Count($arguments); $index = 0;
    foreach($arguments as $key => $value){
        $index++;
        if($value == 0 || $value == ""){ continue; }
        if($key == "tauxAlcool") { $sql = $sql . $key . " >= " . $value; continue; }
        if($key == "noteMoyenne" && ($argumentsTaille == $index)){ $sql = $sql .  $value; continue; } 
        elseif($key == "noteMoyenne" && ($argumentsTaille != $index)){ $sql = $sql .  $value . " AND "; continue; }
        if(gettype($value) == 'string'){ $valueModif = "'". $value ."'"; } 
            else { $valueModif = $value; }
        if($argumentsTaille  == $index){ $sql = $sql . $key . " = " . $valueModif; }
            else { $sql = $sql . $key . " = " . $valueModif . " AND "; }
    }
    rechercheBiereParCriteres($sql, $listeBieresResultat);
    getMalts($malts);
    getLevures($levures);
    getHoublons($houblons);
    $nomTri = "Nom";
    $moyTri = "note moyenne / 5";
    $alcoolTri = "Taux d'alcool en %";
    require_once('./view/accueil.tpl');
}

function ajouterBiere(){
    require_once('./modele/biereDB.php');
    require_once('./modele/modificationBiereDB.php');
    if(existeNom(trim(strtolower($_POST['nomBiere']) == false))){
        if($_POST['nomBiere'] != "" || existeNom(trim(strtolower($_POST['nomBiere'])))){
            ajouterBiereDB(trim(strtolower($_POST['nomBiere'])), $_POST['tauxAlcool']);
            header("location: index.php?controller=biere&action=affichageAccueil&messajout=Biere ajout??e, vous pouvez remplir ces informations dans sa fiche.");
        } else { header("location: index.php?controller=biere&action=affichageAccueil&messajout=Il faut remplir correctement les champs"); }
    } else { header("location: index.php?controller=biere&action=affichageAccueil&messajout=Biere d??j?? existante"); }
}

return array('ajouterBiere', 'rechercheBiere', 'affichageAccueil', 'affichageBiere', 'recommanderBiere', 'retirerRecommanderBiere', 'supprimerBiere', 'affichageAccueilTrie');