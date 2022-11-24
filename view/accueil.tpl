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
    <form class="form-inline" method="POST" action="index.php?controller=biere&action=rechercheBiere">
        <div class="row">
            <div class="col">
                <label for="  text-center">Bière</label>
                <input type="text" class="form-control" placeholder="nom" id="nomBiere" name="nomBiere" maxlength="20">
            </div>
            <div class="col">
                <label for=" ">Note moyenne entre</label>
                <select class="form-control" id="noteMoyenne" name="noteMoyenne">
                    <option value=""></option>
                    <option value="noteMoyBiere BETWEEN 1 AND 2">1-2</option>
                    <option value="noteMoyBiere BETWEEN 2 AND 3">2-3</option>
                    <option value="noteMoyBiere BETWEEN 3 AND 4">3-4</option>
                    <option value="noteMoyBiere BETWEEN 4 AND 5">4-5</option>
                </select>
            </div>
            <div class="col">
                <label for=" ">Taux d'alcool minimum</label>
                <input type="number" step="0.1" min="1" class="form-control" placeholder="Taux" id="tauxAlcool" name="tauxAlcool">
            </div>
            <div class="col">
                <label for=" ">Par houblon</label>
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
                <label for=" ">Par malt</label>
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
                <label for=" ">Par levure</label>
                <select class="form-control" id="malt" name="levure">
                    <option value=""> </option>
                    <?php
                        foreach($levures as $p){
                            echo "<option value=" . $p['idLevure'] . ">" . $p['nomLevure'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col">
            <button type="submit" class="btn btn-primary mb-2">Rechercher</button>
            </div>
        </div>
    </form> <br>
    <form class="form-inline" method="POST" action="index.php?controller=biere&action=affichageAccueil">
        <button type="submit" class="btn btn-primary mb-2">Supprimer recherche</button>
    </form>
    <br>
<div>
    <?php
    if(isset($_SESSION['idUtilisateur'])){
        echo "<div class=\"container\">
        <form class=\"form-inline\" method=\"POST\" action=\"index.php?controller=biere&action=ajouterBiere\">
            <div class=\"row\">
                <div class=\"col\">
                    <label for=\"  text-center\">Nom de la nouvelle bière</label>
                    <input type=\"text\" pattern=\"[a-zA-Z]*\" class=\"form-control\" placeholder=\"nom\" id=\"nomBiere\" name=\"nomBiere\" maxlength=\"20\">
                </div>
                <div class=\"col\">
                    <label for=\" \">Taux d'alcool</label>
                    <input type=\"number\" step=\"0.1\" min=\"1\" class=\"form-control\" placeholder=\"Taux\" id=\"tauxAlcool\" name=\"tauxAlcool\">
                </div>
                <div class=\"col\">
                    <p></p>
                    <button type=\"submit\" class=\"btn btn-primary mb-2\">Ajouter</button>
                </div>
            </div>
        </form>
        
    <div>";
    }

if(isset($_GET['messajout'])) {echo $_GET['messajout']; } ?>
<br>
<div class="container vw-70">
    <div class="row">
        <table class="table table-striped table-responsive border table-sm">
        </tr>
            <?php if(isset($_SESSION['idTypeUtilisateur']) && ($_SESSION['idTypeUtilisateur'] == 1)){ echo "<th scope=\"col\" class=\"text-center\"></th>"; } ?>
            <th scope="col" class="text-center">
            <?php
                    if(isset($_GET['tri2']) && $_GET['tri2'] == "ASC"){
                        echo $nomTri;
                    } else {
                        echo $nomTri;
                    }
            ?>
            </th>
            <th scope="col" class="text-center">
            <?php
                    if(isset($_GET['tri2']) && $_GET['tri2'] == "ASC"){
                        echo $moyTri;
                    } else {
                        echo $moyTri;
                    }
            ?>
            </th>
            <th scope="col" class="text-center">
            <?php
                    if(isset($_GET['tri2']) && $_GET['tri2'] == "ASC"){
                        echo $alcoolTri;
                    } else {
                        echo $alcoolTri;
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