<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
if(isset($_GET['controller']) & isset($_GET['action'])){
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {
    $controller = "utilisateur";
    $action = "accueil";
}

require('./controller/' . $controller . '.php');
$action ();
?>