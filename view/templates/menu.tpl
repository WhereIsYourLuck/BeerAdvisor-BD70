<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="index.php?controller=utilisateur&action=accueil">
			<!-- <img src="./view/img/paris.png" width="30" height="25" alt="Logo h3-Campus"> -->
            BeerAdvisor
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="true" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
	
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
    	<ul class="navbar-nav navbar-sm-1">
	  		<li class="nav-item">
				<a class="nav-link" aria-current="page" href="index.php?controller=utilisateur&action=accueil">Accueil</a>
			</li>
                <?php 
				 if(isset($_SESSION['ident']) && isset($_SESSION['pwd']) && isset($_SESSION['grade'])){
					if($_SESSION['grade'] != 'Invite'){
						echo $serviceInfo;
					}
					if(isset($_SESSION['grade']) && $_SESSION['grade'] == "admin"){
						echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?controller=professeur&action=monitoringServeur\">Monitoring serveurs</a></li>";
						echo "<li class=\"nav-item\"><a class=\"nav-link\" href='index.php?controller=annuaireIP&action=affichage'>Annuaire IPs</a>";
						echo "<li class=\"nav-item\"><a class=\"nav-link\" href='index.php?controller=serviceInfo&action=affichageInscriptionSI'>Créer Utilisateur</a>";
					}
					echo "<li class=\"nav-item\"><a class=\"nav-link\" href='index.php?controller=utilisateur&action=deconnexion'>Deconnexion</a></li>";
					echo "<li class=\"nav-item\"><a class=\"nav-link justify-content-end\">" . $_SESSION['ident'] . "</a></li>";
				}  else {
					echo "<li class=\"nav-item\"><a class=\"nav-link\" href='index.php?controller=serviceInfo&action=affichageConnexionSI'>Connexion</a></li>";
				}
				?>
      	</ul>
    </div>
	</div>
</nav>