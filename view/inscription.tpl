<?php
if(isset($_SESSION['nomUtilisateur'])){
    header("location: index.php?");
}
?>
<!DOCTYPE html >
<html lang="fr">
<head>
    <title>Inscription Utilisateur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once('./view/templates/menu.tpl'); ?>
    <br>
    <div class="d-flex justify-content-center flex-nowrap h-100">      
        <form action="index.php?controller=utilisateur&action=inscription" method="post">
            <div class="form-row">
                <div>
                    <label for="identifiant">Nouveau utilisateur : </label><br>
                    <input type="text" class="form-control" type="text" id="identifiant" name="identifiant" placeholder="" required>
                </div>
                <div class="col">
                    <label for="password">Mot de passe : </label><br>
                    <input type="password" id="password" name="password" class="form-control" minlength="5" required><br>
                </div>
                <div class="col">
                    <input class="btn btn-secondary" type="submit" name="submit" value="S'inscrire"><br>
                    </div>
                    <?php
                            if(isset($_POST['identifiant']) && isset($_POST['password'])){
                                echo $messerr;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html> 