<?php

    function statistique(){
        require('./modele/statistiqueDB.php');
        nbrUtilisateur($nbrUtilisateur);
        BiereSaisies($nbrBiere);
        nbrAdmin($nbrAdmin);
        nbrUtilisateurUnique($nbrUtilUnique);
        recommandationStat($BiereRecommand);
        require_once('./view/statistique.tpl');
    }

return array('statistique');