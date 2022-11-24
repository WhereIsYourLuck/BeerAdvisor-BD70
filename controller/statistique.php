<?php

    function statistique(){
        require('./modele/statistiqueDB.php');
        nbrUtilisateur($nbrUtilisateur);
        BiereSaisies($nbrBiere);
        nbrAdmin($nbrAdmin);
        nbrUtilisateurUnique($nbrUtilUnique);
        ListeBiereRecommand($liste);
        $listeBiereNom = array();
        $listeComptBiere = array();
        for ($i = 0; $i < count($liste); $i++){
            BiereRecommand($liste[$i]["nomBiere"], $countBiere);
            $listeBiereNom += [$i => $liste[$i]["nomBiere"]];
            $listeComptBiere += [ $liste[$i]["nomBiere"] => $countBiere[0]["COUNT(recommande.idBiere)"]];
        }
        require_once('./view/statistique.tpl');
    }

return array('statistique');