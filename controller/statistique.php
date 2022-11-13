<?php

    function statistique(){
        require('./modele/connectDB.php');
        $sql = "SELECT idUtilisateur FROM utilisateur;
        $nbrUtilisateur = count($sql);
        
    }

return array(statistique);