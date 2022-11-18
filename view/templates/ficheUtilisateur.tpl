<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Beer Advisor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<?php include_once('./view/templates/menu.tpl');

if(isset($_SESSION['idUtilisateur']) && $_GET['id'] != $_SESSION['idUtilisateur'] && $_SESSION['idUtilisateur'] != -1){
    if(!$EstSuivi){
        echo "<a href=\"index.php?controller=utilisateur&action=suivreUtilisateur&id=" . $_GET['id'] . "\"><button class=\"btn btn-primary btn-sm\">Suivre</button></a>";
    } else {
        echo "<a href=\"index.php?controller=utilisateur&action=desabonnementUtilisateur&id=" . $_GET['id'] . "\"><button class=\"btn btn-primary btn-sm\">Se désabonner</button></a>";
    }
}
?>
</form>
</button>
<p> Abonnements :
<?php for($i = 0 ; $i < count($UtilisateursSuivis) ; $i++){
    echo "<a href=\"index.php?controller=utilisateur&action=affichageCompte&id=" . $UtilisateursSuivis[$i]['idUtilisateurSuivi'] . "&tri=ASC&tri2=noteValeur\">" . $UtilisateursSuivis[$i]['nomUtilisateur'] . "</a>";
    echo " "; } ?>
</p>
<p> Bières commentées par les utilisateurs suivis : 
<?php
for($i = 0 ; $i < count($unserializedBiereCommenteesSuiveur) ; $i++){
    echo "<a href=\"index.php?controller=biere&action=affichageBiere&idBiere=" . $unserializedBiereCommenteesSuiveur[$i]['idBiere'] . "\">" . $unserializedBiereCommenteesSuiveur[$i]['nomBiere'] . "</a>";
    echo " ";
}
?>

</p>
<p>Les coups de coeur (recommandations): 
<?php for($i = 0 ; $i < count($recommandations) ; $i++){
    echo "<a href=\"index.php?controller=biere&action=affichageBiere&idBiere=" . $recommandations[$i]['idBiere'] . "\">" . $recommandations[$i]['nomBiere'] . "</a>";
    echo " "; } ?>
</p>

<div class="container vw-70">
<div class="row">
    <table class="table table-striped table-responsive border table-sm">
        <tr>
            <?php
            if(isset($_SESSION['idUtilisateur']) && ($_SESSION['idUtilisateur'] == $_GET['id']) || ($_SESSION['idTypeUtilisateur'] == $_SESSION['idUtilisateur'])){
               echo "<th scope=\"col\" class=\"text-center\"></th>";
            } ?>
            
            <th scope="col" class="text-center">Bière</th>
            <th scope="col" class="text-center">
                <?php
                    if($_GET['tri'] == "ASC"){
                        echo "<a href=\"index.php?controller=utilisateur&action=affichageCompte&id=" . $_GET['id'] . "&tri=DESC&tri2=noteValeur\">Notes</a>";
                    } else {
                        echo "<a href=\"index.php?controller=utilisateur&action=affichageCompte&id=" . $_GET['id'] . "&tri=ASC&tri2=noteValeur\">Notes</a>";
                    }
                
                ?>
            </th>
            <th scope="col" class="text-center">
                <?php
                    if($_GET['tri'] == "ASC"){
                        echo "<a href=\"index.php?controller=utilisateur&action=affichageCompte&id=" . $_GET['id'] . "&tri=DESC&tri2=noteMoyBiere\">Moyenne Bière</a>";;
                    } else {
                        echo "<a href=\"index.php?controller=utilisateur&action=affichageCompte&id=" . $_GET['id'] . "&tri=ASC&tri2=noteMoyBiere\">Moyenne Bière</a>";
                    }
                ?>
            </th>
            <th scope="col" class="text-center">date de dégustation</th>
            <th scope="col" class="text-center">commentaire</th>
        </tr>
            <?php
            for($i = 0 ; $i < count($NotesUtilisateurs) ; $i++){
                echo "<tr>";
                if(isset($_SESSION['idUtilisateur']) && ($_SESSION['idUtilisateur'] == $_GET['id']) && ($_SESSION['idTypeUtilisateur'] != $_SESSION['idUtilisateur'])){
                    echo "<th scope=\"row\" class=\"text-center\"><a class=\"nav-link\" href=\"index.php?controller=utilisateur&action=supprimerCommentaire&tri=ASC&tri2=noteValeur&id=" . $_SESSION['idUtilisateur'] . "&idBiere=" . $NotesUtilisateurs[$i]['idBiere'] ."\"><button class=\"btn btn-primary btn-sm\">Supprimer</button></a></th>";
                }
                if(isset($_SESSION['idUtilisateur']) && $_SESSION['idTypeUtilisateur'] == 1 || ($_SESSION['idTypeUtilisateur'] == $_SESSION['idUtilisateur'])){
                    echo "<th scope=\"row\" class=\"text-center\"><a class=\"nav-link\" href=\"index.php?controller=utilisateur&action=supprimerCommentaireAdmin&tri=ASC&tri2=noteValeur&id=" . $_GET['id'] . "&idBiere=" . $NotesUtilisateurs[$i]['idBiere'] ."\"><button class=\"btn btn-primary btn-sm\">Supprimer</button></a></th>";
                }
                
                echo "<th scope=\"row\" class=\"text-center\"><a href=\"index.php?controller=biere&action=affichageBiere&idBiere=". $NotesUtilisateurs[$i]['idBiere']. "\">" . $NotesUtilisateurs[$i]['nomBiere'] . "</th>";
                echo "<th scope=\"row\" class=\"text-center\">" . $NotesUtilisateurs[$i]['noteValeur'] . "</th>";
                echo "<th scope=\"row\" class=\"text-center\">" . $NotesUtilisateurs[$i]['noteMoyBiere'] . "</th>";
                echo "<th scope=\"row\" class=\"text-center\">" . $NotesUtilisateurs[$i]['dateDegustation'] . "</th>";
                echo "<th class=\"text-center\">" . $NotesUtilisateurs[$i]['commentaireBiere'] . "</th>";
                echo "</tr>";
            }
        ?>
    </table>
</div>
</div>
</p>
</html>