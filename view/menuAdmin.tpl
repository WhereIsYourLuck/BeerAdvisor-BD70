<?php
if(!isset($_SESSION['idTypeUtilisateur']) || $_SESSION['idTypeUtilisateur'] != 1){ header("location: index.php?"); }
?>
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
</body>

<p> Caractéristiques : <br>
Houblons existants : <?php  foreach($houblons as $p){ echo $p['nomHoublon']; echo " "; } ?>
<br> Malts existants : <?php  foreach($malts as $p){ echo $p['nomMalt']; echo " "; } ?>
<br> Levures existantes : <?php  foreach($levures as $p){ echo $p['nomLevure']; echo " "; } ?>
<br>
<form class="form-inline" method="POST" action="index.php?controller=admin&action=supprimerHoublon">
        <div class="row">
            <p class="col">Supprimer houblon : </p>
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
                <button type="submit" class="btn btn-primary mb-2">Supprimer</button>
            </div>
        </div>
</form>
<form class="form-inline" method="POST" action="index.php?controller=admin&action=supprimerMalt">
        <div class="row">
            <p class="col">Supprimer malt : </p>
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
                <button type="submit" class="btn btn-primary mb-2">Supprimer</button>
            </div>
        </div>
</form>
<form class="form-inline" method="POST" action="index.php?controller=admin&action=supprimerLevure">
        <div class="row">
            <p class="col">Supprimer levure : </p>
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
                <button type="submit" class="btn btn-primary mb-2">Supprimer</button>
            </div>
        </div>
</form>

<h2> Ajouter des catégories </h2>

<form class="form-inline" method="POST" action="index.php?controller=admin&action=ajouterHoublon">
        <div class="row">
            <p class="col">Ajouter Houblon : </p>
            <div class="col">
                <input type="text" class="form-control" minlength="4" placeholder="" id="houblon" name="houblon" maxlength="20">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
            </div>
        </div>
</form>

<form class="form-inline" method="POST" action="index.php?controller=admin&action=ajouterMalt">
        <div class="row">
            <p class="col">Ajouter Malt : </p>
            <div class="col">
                <input type="text" class="form-control" minlength="4" placeholder="" id="Malt" name="malt" maxlength="20">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
            </div>
        </div>
</form>

<form class="form-inline" method="POST" action="index.php?controller=admin&action=ajouterLevure">
        <div class="row">
            <p class="col">Ajouter Levure : </p>
            <div class="col">
                <input type="text" class="form-control" minlength="4" placeholder="" id="Levure" name="levure" maxlength="20">
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

</html>