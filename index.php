<?php
/**
 * Page principale du service web, seule page chargée sur l'ensemble du site.
 * architecture PHP MVC
 *  controller : fichiers php dans ./controller
 *  action : fonction executée dans ledit controller
 */
    session_start(); // Demarre une nouvelle session // Ne jamais fermé
    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if(isset($_GET['controller']) & isset($_GET['action'])){
        $controller = $_GET['controller'];
        $action     = $_GET['action'];
    } else {
        $controller = "biere";
        $action     = "affichageAccueil";
    }

/*-------------------------Bloque le changement manuel des liens----------------------------*/
    $path    = './controller/' . $controller . '.php';
    if(!file_exists($path)){
        header("location: index.php?");
    }

    // Array contenant le nom des fonctions du controller toujours en fin des documents controller.
    $actions = require($path); 

    if(!in_array($action, $actions)){
        header("location: index.php?");
    }
    $action ();
/*------------------------------------------------------------------------------------------*/ 
?>