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
            echo "<a href=\"index.php?controller=biere&action=retirerRecommanderBiere&idBiere=" . $_GET['idBiere'] ."\"><button class=\"btn btn-primary btn-sm\">Ne plus recommander</button></a>";
            
        }
        echo "<br><a href=\"index.php?controller=modificationsBiere&action=affichageModification&idBiere=" . $_GET['idBiere'] ."\"><button class=\"btn btn-primary btn-sm\">Modifier</button></a>";
    }
    ?>
    <h2> <?php echo $infosBiere[0]['nomBiere']; ?> </h2>
    <p>Caractéristiques :<br>
    Taux Alcool : <?php echo $infosBiere[0]['tauxAlcool']; ?>%<br>
    Houblons utilisés : <?php foreach($houblonsBiere as $key => $value){ echo $houblonsBiere[$key]['nomHoublon'] . " "; } ?> <br>
    Malts utilisés : <?php foreach($maltsBiere as $key => $value){ echo $maltsBiere[$key]['nomMalt'] . " "; } ?> <br>
    Levure utilisées : <?php foreach($levuresBiere as $key => $value){ echo $levuresBiere[$key]['nomLevure'] . " "; } ?> <br>
    Note moyenne Bière : <?php
    if($infosBiere[0]['noteMoyBiere'] == NULL) { echo "<b><i>Pas de notes</i></b>"; } else { echo $infosBiere[0]['noteMoyBiere']; } ?>

<br>
<?php
if(isset($_SESSION['idUtilisateur']) && (!$estCommentee)){
    echo "<div class=\"container vw-70\">
    <form class=\"form-inline\" method=\"POST\" action=\"index.php?controller=utilisateur&action=ajouterCommentaire&idBiere=" . $_GET['idBiere'] ."\" >
        <div class=\"row\">
            <div class=\"col\">
                <label for=\"note\">Votre Note</label>
                <input type=\"number\" class=\"form-control\" placeholder=\"0.0\" id=\"note\" name=\"note\" step=\"0.1\" min=\"0\" max=\"5\" required>
            </div>
            <div class=\"col\">
                <label for=\"dateDegustation\">Date de dégustation yyyy-mm-dd</label>
                <input type=\"text\" id=\"dateDegustation\" name=\"dateDegustation\" class=\"datepicker form-control\" pattern=\"(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))\" placeholder=\"YYYY-MM-DD\" name=\"date\" value=\"\"/>
            </div>
            <div class=\"form-group\">
                <label for=\"commentaire\">Votre commentaire (max 300 caractères) : </label>
                <input class=\"form-control\" id=\"commentaire\" name=\"commentaire\" rows=\"3\" min=\"1\" max=\"300\" required></input>
            </div>
            <div class=\"form-group\">
                <button type=\"submit\" class=\"btn btn-primary\">Commenter</button>
            </div>
        </div>
    </form>";
if(isset($_GET['messerr'])){ echo $_GET['messerr'];}
echo "</div>";
}
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