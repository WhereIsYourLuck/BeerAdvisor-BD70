<?php

    function statistique(){
        require('./modele/statistiqueDB.php');
        nbrUtilisateur($nbrUtilisateur);
        BiereSaisies($nbrBiere);
        require_once('./view/statistique.tpl');
    }

return array('statistique');