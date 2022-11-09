
<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="index.php?controller=utilisateur&action=accueil">
            BeerAdvisor
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="true" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
	
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
    	<ul class="navbar-nav navbar-sm-1">
	  		<li class="nav-item">
				<a class="nav-link" aria-current="page" href="index.php?controller=biere&action=affichageAccueil">Accueil</a>

				<?php
					if(isset($_SESSION['nomUtilisateur']) && isset($_SESSION['idUtilisateur'])&& isset($_SESSION['idTypeUtilisateur'])){
						if($_SESSION['idTypeUtilisateur'] == "1"){
							echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?controller=utilisateurAdmin&action=aaaaaa\">Statistiques du site</a></li>";
						}
						echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?controller=utilisateur&action=affichageCompte&tri=ASC&tri2=noteValeur&id=" . $_SESSION['idUtilisateur'] . " \">" . $_SESSION['nomUtilisateur'] . "</a></li>";
						echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?controller=utilisateur&action=deconnexion\">Deconnexion</a></li>";
					} else {
						echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?controller=utilisateur&action=affichageConnexion\">Connexion</a></li>";
						echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?controller=utilisateur&action=affichageInscription\">Inscription</a></li>";
					}
				?>
			</li>
      	</ul>
    </div>
	</div>
</nav>