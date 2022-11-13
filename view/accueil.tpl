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
    <?php include_once('./view/templates/menu.tpl'); ?> <br>
<div class="container vw-70">
    <div class="row">
        <table class="table table-striped table-responsive border table-sm">
        </tr>
            <th scope="col" class="text-center">Nom</th>
            <th scope="col" class="text-center">Note Moyenne / 5</th>
            <th scope="col" class="text-center">Taux Alcool en %</th>
            <th scope="col" class="text-center"> </th>
        </tr>
        <?php
            for($i = 0; $i < count($listeBieresResultat); $i++){
                echo "<tr>";
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