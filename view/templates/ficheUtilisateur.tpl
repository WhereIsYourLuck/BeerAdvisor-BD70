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
if($_GET['id'] != $_SESSION['idUtilisateur']){
    echo "<a href=\"index.php?controller=utilisateur&action=suivreUtilisateur&id=" . $_GET['id'] . "\"><button class=\"btn btn-primary btn-sm\">Suivre</button></a>";
} else { echo "<a href=\"index.php?controller=utilisateur&action=desabonnementUtilisateur&id=" . $_GET['id'] . "\"><button class=\"btn btn-primary btn-sm\">Se désabonner</button></a>"; }
?>
</form>
</button>
<p> Abonnements :
<?php for($i = 0 ; $i < count($UtilisateursSuivis) ; $i++){
    echo "<a href=\"index.php?controller=utilisateur&action=affichageCompte&id=" . $UtilisateursSuivis[$i]['idUtilisateurSuivi'] . "\">" . $UtilisateursSuivis[$i]['nomUtilisateur'] . "</a>";
    echo " "; } ?>

<div class="container vw-70">
<div class="row">
    <table class="table table-striped table-responsive border">
        <tr>
            <th scope="col" class="text-center">Bière</th>
            <th scope="col" class="text-center">Votre note</th>
            <th scope="col" class="text-center">date de dégustation</th>
            <th scope="col" class="text-center">commentaire</th>
        </tr>
            <?php
            for($i = 0 ; $i < count($NotesUtilisateurs) ; $i++){
                echo "<tr>";
                echo "<th scope=\"row\" class=\"text-center\">" . $NotesUtilisateurs[$i]['nomBiere'] . "</th>";
                echo "<th scope=\"row\" class=\"text-center\">" . $NotesUtilisateurs[$i]['noteValeur'] . "</th>";
                echo "<th scope=\"row\" class=\"text-center\">" . $NotesUtilisateurs[$i]['dateDegustation'] . "</th>";
                echo "<th class=\"text-center\">" . $NotesUtilisateurs[$i]['commentaireBiere'] . "</th>";
                echo "</tr>";
            }
        ?>
    </div>
</div>
</p>
</html>