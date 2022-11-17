<?php

    function statistique(){
        require('./modele/statistiqueDB.php');
        nbrUtilisateur($nbrUtilisateur);
        BiereSaisies($nbrBiere);
        nbrAdmin($nbrAdmin);
        nbrUtilisateurUnique($nbrUtilUnique);
        require_once('./view/statistique.tpl');
    }

return array('statistique');