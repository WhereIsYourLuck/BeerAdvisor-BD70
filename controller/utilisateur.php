<?php
function accueil(){
    require_once('./view/accueil.tpl');
}

function affichageConnexion(){
    require_once('./view/connexion.tpl');
}

function affichageInscription(){
    require_once('./view/inscription.tpl');
}

function affichageCompte(){
    require_once('./view/templates/ficheUtilisateur.tpl');
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
    } else {
        $messerr = "Erreur de connexion";
        require_once('./view/connexion.tpl');
    }
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

return array('accueil', 'affichageInscription','affichageConnexion', 'affichageCompte', 'connexion', 'inscription', 'deconnexion');