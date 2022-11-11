<?php

function affichageAccueil(){
    require_once('./modele/biereDB.php');
    listeBieres($listeBieresResultat);
    require_once('./view/accueil.tpl');
}

function affichageBiere(){
    require_once('./modele/biereDB.php');
    if(isset($_GET['idBiere'])){ 
        infoBiere($_GET['idBiere'], $infosBiere);
        commentairesBiere($_GET['idBiere'], $commentairesBiere);
        if(isset($_SESSION['idUtilisateur'])) {
            $recommande = utilisateurRecommandeBiere($_SESSION['idUtilisateur'], $_GET['idBiere']);
        } else { $recommande = -1; }
     } else { header("location: index.php?"); }
    require('./view./templates/ficheBiere.tpl');
}

function recommanderBiere(){
    require_once('./modele/biereDB.php');
    //On fait pas de verif si l'utilisateur est pas déjà suiveur par le 1er user car c'est checké dans la bdd
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
return array('affichageAccueil', 'affichageBiere', 'recommanderBiere', 'retirerRecommanderBiere', 'supprimerBiere');