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
        echo "<br><a href=\"index.php?controller=biere&action=affichageBiere&idBiere=" . $_GET['idBiere'] ."\"><button class=\"btn btn-primary btn-sm\">Revenir sur la fiche</button></a>";
    }
    ?>
    <h2> <?php echo $infosBiere[0]['nomBiere']; ?> </h2>
    <p>Caractéristiques :<br>
    Taux Alcool : <?php echo $infosBiere[0]['tauxAlcool']; ?>%<br>
    Houblons utilisés : <?php foreach($houblonsBiere as $key => $value){ echo $houblonsBiere[$key]['nomHoublon'] . " "; } ?> <br>
    Malts utilisés : <?php foreach($maltsBiere as $key => $value){ echo $maltsBiere[$key]['nomMalt'] . " "; } ?> <br>
    Levure utilisées : <?php foreach($levuresBiere as $key => $value){ echo $levuresBiere[$key]['nomLevure'] . " "; } ?> <br>
    </p>
    <div class="container">
        <form class="form-inline" method="POST" action="">
            <div class="row">
                <div class="col">
                    <label>Changer le nom</label>
                </div>
                <div class="col">
                    <input type="text" pattern="[a-zA-Z]*" class="form-control" placeholder="nom" id="nomBiere" name="nomBiere" maxlength="20">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary mb-2">Changer</button>
                </div>
            </div>
        </form>
        <form class="form-inline" method="POST" action="">
            <div class="row">
                <div class="col">
                    <label>Changer le taux d'alcool</label>
                </div>
                <div class="col">
                    <input type="number" step="0.1" min="1" class="form-control" placeholder="Taux" id="tauxAlcool" name="tauxAlcool">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary mb-2">Changer</button>
                </div>
            </div>
        </form>

    <form class="form-inline" method="POST" action="">
        <div class="row">
            <p class="col">Supprimer houblon : </p>
            <div class="col">
                <select class="form-control" id="houblon" name="houblon">
                    <option value=""> </option>
                    <?php
                        foreach($houblonsBiere as $p){
                            echo "<option value=" . $p['idHoublon'] . ">" . $p['nomHoublon'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary mb-2">Supprimer</button>
            </div>
        </div>
</form>
<form class="form-inline" method="POST" action="">
        <div class="row">
            <p class="col">Supprimer malt : </p>
            <div class="col">
                <select class="form-control" id="malt" name="malt">
                    <option value=""> </option>
                    <?php
                        foreach($maltsBiere as $p){
                            echo "<option value=" . $p['idMalt'] . ">" . $p['nomMalt'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary mb-2">Supprimer</button>
            </div>
        </div>
</form>
<form class="form-inline" method="POST" action="">
        <div class="row">
            <p class="col">Supprimer levure : </p>
            <div class="col">
                <select class="form-control" id="levure" name="levure">
                    <option value=""> </option>
                    <?php
                        foreach($levuresBiere as $p){
                            echo "<option value=" . $p['idLevure'] . ">" . $p['nomLevure'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary mb-2">Supprimer</button>
            </div>
        </div>
</form>

<h2 class="text-center"> Ajouter des catégories </h2>

<form class="form-inline" method="POST" action="">
        <div class="row">
            <p class="col">Ajouter houblon : </p>
            <div class="col">
                <select class="form-control" id="houblon" name="houblon">
                    <option value=""> </option>
                    <?php
                        foreach($houblons as $p){
                            echo "<option value=" . $p['idHoublon'] . ">" . $p['nomHoublon'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
            </div>
        </div>
</form>
<form class="form-inline" method="POST" action="">
        <div class="row">
            <p class="col">Ajouter malt : </p>
            <div class="col">
                <select class="form-control" id="malt" name="malt">
                    <option value=""> </option>
                    <?php
                        foreach($malts as $p){
                            echo "<option value=" . $p['idMalt'] . ">" . $p['nomMalt'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
            </div>
        </div>
</form>
<form class="form-inline" method="POST" action="">
        <div class="row">
            <p class="col">Ajouter levure : </p>
            <div class="col">
                <select class="form-control" id="levure" name="levure">
                    <option value=""> </option>
                    <?php
                        foreach($levures as $p){
                            echo "<option value=" . $p['idLevure'] . ">" . $p['nomLevure'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
            </div>
        </div>
</form>


<?php
if(isset($_GET['messerr'])){
    echo "<p>" . $_GET['messerr'] . "<p>";
}
?>
</div>
</body>
</html>