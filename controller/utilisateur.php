<?php

function affichageConnexion(){ require_once('./view/connexion.tpl'); }

function affichageInscription(){ require_once('./view/inscription.tpl'); }

function affichageCompte(){
    require_once('./modele/utilisateurDB.php');
    if(isset($_GET['id']) && is_numeric($_GET['id']) && isset($_GET['tri']) && isset($_GET['tri2'])) {
        
        getUtilisateursSuivis($_GET['id'], $UtilisateursSuivis);
        $bcParUtilisateursSuivis = [];
        for($i = 0 ; $i < count($UtilisateursSuivis) ; $i++){
            getBiereSuiveur($UtilisateursSuivis[$i]['idUtilisateurSuivi'], $resultatVolatil);
            $bcParUtilisateursSuivis = array_merge($bcParUtilisateursSuivis, $resultatVolatil);
        }
        // Impossible d'array_unique sur tableau multi-dimensions ; Serialized pour obtenir un autre format
        $serialized = array_map('serialize', $bcParUtilisateursSuivis);
        $unique = array_unique($serialized); 
        $unserializedBiereCommenteesSuiveur = array_map("unserialize", $unique);

        getRecommandations($_GET['id'], $recommandations);

        if($_GET['tri2'] == "noteValeur" || $_GET['tri2'] == "noteMoyBiere"){
            if($_GET['tri'] == "DESC"){ getNotes($_GET['id'], $NotesUtilisateurs, "DESC", $_GET['tri2']); }
            else { getNotes($_GET['id'], $NotesUtilisateurs, "ASC", $_GET['tri2']); }
        } else { header("location: index.php?"); }
        if(isset($_SESSION['idUtilisateur'])){ 
            $EstSuivi = existeUtilisateurSuivi($_SESSION['idUtilisateur'], $_GET['id']);
        } else { $EstSuivi = -1; }  
        require_once('./view/templates/ficheUtilisateur.tpl');
    } else { header("location: index.php?"); }
}

function suivreUtilisateur(){
    require_once('./modele/utilisateurDB.php');
    //On fait pas de verif si l'utilisateur est pas déjà suiveur par le 1er user car c'est checké dans la bdd
    if(isset($_SESSION['idUtilisateur'])) {
        ajouterUtilisateurSuivi($_SESSION['idUtilisateur'],$_GET['id']); 
        header("location: index.php?controller=utilisateur&action=affichageCompte&tri=ASC&tri2=noteValeur&id=" . $_GET['id']);
    } else { header("location: index.php?"); }
}

function desabonnementUtilisateur(){
    require_once('./modele/utilisateurDB.php');
    if(isset($_SESSION['idUtilisateur'])) {
        desabonnerUtilisateur($_SESSION['idUtilisateur'], $_GET['id']);
        header("location: index.php?controller=utilisateur&action=affichageCompte&tri=ASC&tri2=noteValeur&id=" . $_GET['id']);
    } else { header("location: index.php?"); }
}

function connexion(){
    require_once('./modele/utilisateurDB.php'); 
    $login = htmlspecialchars($_POST['identifiant']);
    $password = htmlspecialchars($_POST['password']);
    if(verifBD_utilisateur($login, $password, $profil)){
        $_SESSION['idUtilisateur'] = $profil[0]['idUtilisateur'];
        $_SESSION['nomUtilisateur'] = $profil[0]['nomUtilisateur'];
        $_SESSION['idTypeUtilisateur'] = $profil[0]['idTypeUtilisateur'];
        header("location: index.php?");
    } else {  $messerr = "Erreur de connexion"; require_once('./view/connexion.tpl'); }
}

function inscription(){
    require_once('./modele/utilisateurDB.php'); 
    $login = htmlspecialchars($_POST['identifiant']);
    if(existeUtilisateur($login)){
        $messerr = "Utilisateur déjà existant";
        require_once('./view/inscription.tpl');
    } else {
        $password = htmlspecialchars($_POST['password']);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        inscriptionUtilisateur($login, $passwordHash);
        connexion();
    }
}
function deconnexion(){
    unset($_SESSION['idUtilisateur']);
    unset($_SESSION['nomUtilisateur']);
    unset($_SESSION['idTypeUtilisateur']);
    header('location: index.php?');
}

function ajouterCommentaire(){
    require_once('./modele/utilisateurDB.php');
    require_once('./modele/outilsDB.php');
    require_once('./controller/biere.php');
    if(isset($_POST['note']) && isset($_POST['dateDegustation']) && isset($_POST['commentaire']) && isset($_GET['idBiere']) && isset($_SESSION['idUtilisateur'])){
        if(!existeCommentaire($_SESSION['idUtilisateur'], $_GET['idBiere'])){
            if(($_POST['note'] >= 0 && $_POST['note'] <= 5)){
                if((strtotime($_POST['dateDegustation']) <= strtotime(getDateToday()))){
                        if(strlen($_POST['commentaire']) > 0 && strlen($_POST['commentaire']) < 301){
                            ajouterCommentaireDB($_GET['idBiere'], $_SESSION['idUtilisateur'], $_POST['note'], $_POST['commentaire'],  $_POST['dateDegustation']); affichageBiere();
                        } else { header("location: index.php?controller=biere&action=affichageBiere&idBiere=" . $_GET['idBiere'] . "&messerr=Le message doit contenir entre 1 et 300 caractères"); }
                } else { header("location: index.php?controller=biere&action=affichageBiere&idBiere=" . $_GET['idBiere'] . "&messerr=La date de dégustation doit être antérieure ou égale à la date d'aujourd'hui");}
            } else { header("location: index.php?controller=biere&action=affichageBiere&idBiere=" . $_GET['idBiere'] . "&messerr=La note dans être comprise entre 0 et 5");}
        } else { header('location: index.php?'); }
    } else { header('location: index.php?'); }
}

function supprimerCommentaire(){
    require_once('./modele/utilisateurDB.php'); 
    if(existeCommentaire($_SESSION['idUtilisateur'], $_GET['idBiere'])){
        supprimerCommentaireBiere($_SESSION['idUtilisateur'], $_GET['idBiere']);
    } affichageCompte();
}

function supprimerCommentaireAdmin(){
    require_once('./modele/utilisateurDB.php'); 
    if(existeCommentaire($_GET['id'], $_GET['idBiere'])){
        supprimerCommentaireBiere($_GET['id'], $_GET['idBiere']);
    } affichageCompte();
}

return array('supprimerCommentaireAdmin', 'ajouterCommentaire', 'supprimerCommentaire', 'accueil', 'affichageInscription','affichageConnexion', 'affichageCompte', 'connexion', 'inscription', 'deconnexion', 'suivreUtilisateur', 'desabonnementUtilisateur');