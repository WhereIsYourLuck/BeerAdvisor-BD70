<?php

function affichageModification(){
    require_once('./modele/biereDB.php');
    require_once('./modele/utilisateurDB.php');
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

return array('affichageModification');