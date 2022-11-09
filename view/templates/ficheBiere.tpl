<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Beer Advisor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body> <?php include_once('./view/templates/menu.tpl'); ?> <br>
    <?php
    if(isset($_SESSION['idUtilisateur'])){
        if(!$recommande){
            echo "<a href=\"index.php?controller=biere&action=recommanderBiere&idBiere=" . $_GET['idBiere'] ."\"><button class=\"btn btn-primary btn-sm\">Recommander</button></a>";
        } else {
            echo "<a href=\"index.php?controller=biere&action=retirerRecommanderBiere\"><button class=\"btn btn-primary btn-sm\">Ne plus recommander</button></a>";
        }
    }
    ?>
    <h2> <?php echo $infosBiere[0]['nomBiere']; ?> </h2>
    <p>Caractéristiques :<br>
    Taux Alcool : <?php echo $infosBiere[0]['tauxAlcool']; ?>%<br>
    Note moyenne Bière : <?php
    if($infosBiere[0]['noteMoyBiere'] == NULL) { echo "<b><i>Pas de notes</i></b>"; } else { echo $infosBiere[0]['noteMoyBiere']; } ?>

<?php
for($i = 0; $i < count($commentairesBiere) ; $i++){
    echo "<div class=\"container vw-70 d-flex flex-column border border-dark border-rounded\">";
    echo "<div class=\"d-flex flex-row\">";
    echo "<div class=\"m-1\"> <a href=\"index.php?controller=utilisateur&action=affichageCompte&id="
    . $commentairesBiere[$i]['idUtilisateur'] . "&tri=ASC&tri2=noteValeur\">"
    . $commentairesBiere[$i]['nomUtilisateur'] . "</a></div>";
    echo "<div class=\"m-1\">" . $commentairesBiere[$i]['noteValeur'] . " /5</div>";
    echo "<div class=\"m-1\">" . $commentairesBiere[$i]['dateDegustation'] . "</div>";
    echo "</div>";
    echo "<div>" . $commentairesBiere[$i]['commentaireBiere'] . "</div>";
    echo "</div>";
}
?>
</body>
</html>