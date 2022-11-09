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
        ajouterUtilisateurSuivi($_SESSION['idUtilisateur'],$_GET['id']); affichageCompte();
    } else { header("location: index.php?"); }
}

function desabonnementUtilisateur(){
    require_once('./modele/utilisateurDB.php');
    if(isset($_SESSION['idUtilisateur'])) {
        desabonnerUtilisateur($_SESSION['idUtilisateur'], $_GET['id']); affichageCompte();
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

return array('accueil', 'affichageInscription','affichageConnexion', 'affichageCompte', 'connexion', 'inscription', 'deconnexion', 'suivreUtilisateur', 'desabonnementUtilisateur');