<!-- <?php
if(isset($_SESSION['ident'])){
    header("location: index.php?controller=serviceInfo&action=panelAdministration");
}
?> -->
<!DOCTYPE html>
<html>
<head>
    <title>Connexion sur BeerAdvisor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once('menu.tpl'); ?>
    <br>
    <div class="d-flex justify-content-center flex-nowrap h-100">      
        <form action="index.php?controller=utilisateur&action=connexion" method="post">
            <div class="form-row">
                <div>
                    <label for="ident">Identifiant : </label><br>
                    <input type="text" class="form-control" type="text" id="ident" name="ident" placeholder="" required>
                </div>
                <div class="col">
                    <label for="pwd">Mot de passe : </label><br>
                    <input type="password" id="pwd" name="pwd" class="form-control" required><br>
                </div>
                <div class="col">
                    <input class="btn btn-secondary" type="submit" name="submit" value="Se connecter"><br>
                    </div>
                        <!-- <?php
                            if(isset($_POST['ident']) && isset($_POST['pwd'])){
                                echo "<p>Identifiant ou mot de passe incorrect</p>";
                            }
                        ?> -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html> 