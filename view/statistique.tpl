<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Beer Advisor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Admin/Utilisateur', 'nbrPersonnes'],
          ['Admin',     11],
          ['Utilisateur',      2],
          //creer fonction pour déterminer le nombre d'admin parmis tous les utilisateurs et une autre fonction pour les utilisateurs basiques
        ]);

        var options = {
          title: 'Répartition admins et utilisateurs'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
</head>
<body>
    <?php include_once('./view/templates/menu.tpl'); ?> <br>
<div class="container vw-70">
    <div class="row">
        <table class="table table-striped table-responsive border table-sm">
        </tr>
            <th scope="col" class="text-center">Nombre d'utilisateurs</th>
            <th scope="col" class="text-center">Nombre de bières saisies</th>
            <th scope="col" class="text-center"> </th>
        </tr>
        <?php
            echo "<tr>";
            echo "<th scope=\"row\" class=\"text-center\">" . $nbrUtilisateur[0]["COUNT(idUtilisateur)"] . "</th>";
            echo "<th scope=\"row\" class=\"text-center\">" . $nbrBiere[0]["COUNT(idBiere)"] . "</th>";
            echo "<tr>"; 
            ?>
        </table>
        
         
    </div>
</div>
<div id="piechart" style="width: 900px; height: 500px;"></div>
</body>
</html>