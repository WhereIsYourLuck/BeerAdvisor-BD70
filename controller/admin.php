<?php
function affichageCaracteristiques(){
    require_once('./modele/biereDB.php');
    getMalts($malts);
    getLevures($levures);
    getHoublons($houblons);
    require_once('./view/menuAdmin.tpl');
}

function supprimerHoublon(){
    require_once('./modele/adminDB.php');
    retirerHoublon($_POST['houblon']);
    affichageCaracteristiques();
}
function supprimerMalt(){
    require_once('./modele/adminDB.php');
    retirerMalt($_POST['malt']);
    affichageCaracteristiques();
}

function supprimerLevure(){
    require_once('./modele/adminDB.php');
    retirerLevure($_POST['levure']);
    affichageCaracteristiques();
}

function ajouterHoublon(){
    require_once('./modele/adminDB.php');
    if($_POST['houblon'] == "" || strlen($_POST['houblon']) == 0){
        header("location: index.php?controller=admin&action=affichageCaracteristiques&messerr=Impossible");
    } else {
        if(!existeType("Houblon", $_POST['houblon'])){
            ajouterHoublonDB($_POST['houblon']);
            affichageCaracteristiques();
        } else {
            header("location: index.php?controller=admin&action=affichageCaracteristiques&messerr=Ce Type existe Déjà");
        }
    }
}

function ajouterMalt(){
    require_once('./modele/adminDB.php');
    if(isset($_POST['Malt']) || $_POST['Malt'] == "" || strlen($_POST['Malt']) == 0){
        header("location: index.php?controller=admin&action=affichageCaracteristiques&messerr=Impossible");
    } else {
        if(!existeType("Malt", $_POST['Malt'])){
            ajouterMaltDB($_POST['Malt']);
            affichageCaracteristiques();
        } else {
            header("location: index.php?controller=admin&action=affichageCaracteristiques&messerr=Ce Type existe Déjà");
        }
    }
}

function ajouterLevure(){
    require_once('./modele/adminDB.php');
    if(isset($_POST['Levure']) || $_POST['Levure'] == "" || strlen($_POST['Levure']) == 0){
        header("location: index.php?controller=admin&action=affichageCaracteristiques&messerr=Impossible");
    } else {
        if(!existeType("Levure", $_POST['Levure'])){
            ajouterLevureDB($_POST['Levure']);
            affichageCaracteristiques();
        } else {
            header("location: index.php?controller=admin&action=affichageCaracteristiques&messerr=Ce Type existe Déjà");
        }
    }
}

return array('affichageCaracteristiques', 'supprimerLevure', 'supprimerMalt', 'supprimerHoublon', 'ajouterLevure', 'ajouterMalt', 'ajouterHoublon');
?>

