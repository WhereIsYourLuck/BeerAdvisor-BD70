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
        existeType("Levure", 1,$_GET['idBiere']);
        var_dump(existeType("Levure", 2,$_GET['idBiere']));
     } else { header("location: index.php?"); }
    require('./view./templates/modificationsBiere.tpl');
}

return array('affichageModification');