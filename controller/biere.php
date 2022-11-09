<?php

function affichageAccueil(){
    require('./modele/connectDB.php');
    require('./modele/biereDB.php');
    listeBieres($listeBieresResultat);
    require_once('./view/accueil.tpl');
}

function affichageBiere(){
    if(isset($_GET['idBiere'])){

    } else {
        
    }
    require_once('./view./templates/ficheBiere.tpl');
}

return array('affichageAccueil', 'affichageBiere');