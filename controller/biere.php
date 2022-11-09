<?php

function affichageAccueil(){
    require('./modele/connectDB.php');
    require('./modele/biereDB.php');
    listeBieres($listeBieresResultat);
    require_once('./view/accueil.tpl');
}

return array('affichageAccueil');