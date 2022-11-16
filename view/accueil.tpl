<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Beer Advisor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once('./view/templates/menu.tpl');?> <br>

<div class="container">
    <form class="form-inline">
        <div class="row">
            <div class="col">
                <label for="exampleFormControlSelect1 text-center">Bière</label>
                <input type="text" class="form-control" placeholder="nom" id="nomBiere">
            </div>
            <div class="col">
                <label for="exampleFormControlSelect1">note moyenne entre</label>
                <select class="form-control" id="note moyenne">
                    <option values="">1-2</option>
                    <option values="">2-3</option>
                    <option values="">3-4</option>
                    <option values="">4-5</option>
                </select>
            </div>
            <div class="col">
                <label for="exampleFormControlSelect1">Taux d'alcool minimum</label>
                <input type="text" class="form-control" placeholder="nom" id="taux">
            </div>
            <div class="col">
                <label for="exampleFormControlSelect1">Par houblon</label>
                <select class="form-control" id="houblon">
                    <option values="-1"> </option>
                    <?php
                        foreach($houblons as $p){
                            echo "<option values=" . $p['idHoublon'] . ">" . $p['nomHoublon'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col">
                <label for="exampleFormControlSelect1">Par malt</label>
                <select class="form-control" id="malt">
                    <option values="-1"> </option>
                    <?php
                        foreach($malts as $p){
                            echo "<option values=" . $p['idMalt'] . ">" . $p['nomMalt'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col">
                <label for="exampleFormControlSelect1">Par levure</label>
                <select class="form-control" id="malt">
                    <option values="-1"> </option>
                    <?php
                        foreach($levures as $p){
                            echo "<option values=" . $p['idLevure'] . ">" . $p['nomLevure'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col">
            <button type="submit" class="btn btn-primary mb-2">Rechercher</button>
            </div>
        </div>
    </form>
    <br>
<div>
<div class="container vw-70">
    <div class="row">
        <table class="table table-striped table-responsive border table-sm">
        </tr>
            <?php if(isset($_SESSION['idTypeUtilisateur']) && ($_SESSION['idTypeUtilisateur'] == 1)){ echo "<th scope=\"col\" class=\"text-center\"></th>"; } ?>
            <th scope="col" class="text-center">
            <?php
                    if(isset($_GET['tri2']) && $_GET['tri2'] == "ASC"){
                        echo "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=nomBiere&tri2=DESC\">nom</a>";
                    } else {
                        echo "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=nomBiere&tri2=ASC\">nom</a>";
                    }
            ?>
            </th>
            <th scope="col" class="text-center">
            <?php
                    if(isset($_GET['tri2']) && $_GET['tri2'] == "ASC"){
                        echo "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=noteMoyBiere&tri2=DESC\">note moyenne / 5</a>";
                    } else {
                        echo "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=noteMoyBiere&tri2=ASC\">note moyenne / 5</a>";
                    }
            ?>
            </th>
            <th scope="col" class="text-center">
            <?php
                    if(isset($_GET['tri2']) && $_GET['tri2'] == "ASC"){
                        echo "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=tauxAlcool&tri2=DESC\">Taux d'alcool en %</a>";
                    } else {
                        echo "<a href=\"index.php?controller=biere&action=affichageAccueilTrie&tri=tauxAlcool&tri2=ASC\">Taux d'alcool en %</a>";
                    }
            ?>
            </th>
            <th scope="col" class="text-center"> </th>
        </tr>
        <?php
            for($i = 0; $i < count($listeBieresResultat); $i++){
                echo "<tr>";
                if(isset($_SESSION['idTypeUtilisateur']) && ($_SESSION['idTypeUtilisateur'] == 1)){
                    echo "<th scope=\"row\" class=\"text-center\"><a href=\"index.php?controller=biere&action=supprimerBiere&idBiere=" . $listeBieresResultat[$i]['idBiere'] . "\"><button class=\"btn btn-primary btn-sm\">Supprimer Biere</button></a></th>";
                }
                echo "<th scope=\"row\" class=\"text-center\">" . $listeBieresResultat[$i]['nomBiere'] . "</th>";
                echo "<th scope=\"row\" class=\"text-center\">" . $listeBieresResultat[$i]['noteMoyBiere'] . "</th>";
                echo "<th scope=\"row\" class=\"text-center\">" . $listeBieresResultat[$i]['tauxAlcool'] . "%</th>";
                echo "<th scope=\"row\" class=\"text-center\"><a href=\"index.php?controller=biere&action=affichageBiere&idBiere=" . $listeBieresResultat[$i]['idBiere'] . "\"><button class=\"btn btn-primary btn-sm\">Caractéristiques</button></a></th>";
                echo "<tr>";
            }
            ?>
        </table>
    </div>
</div>
    
</body>
</html> 