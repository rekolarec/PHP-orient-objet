<?php
    session_start();
    require_once "php/config.php";

   
    // Rechuperation du chemin ( de l'url apres le nom de domaine)
    // echo $_SERVER["REQUEST_URI"];die(); // Mike/php-object-webforce3/
    
    $statements = preg_split("(/)",$_SERVER["REQUEST_URI"]);
    //seconde facon de compterles séparateur de l'url
    //$nbElem = ...
    $id = (sizeof($statements) >4)?$statements[4]:0;
    unset($statements[4]);
    $_SERVER["REQUEST_URI"] = implode("/",$statements);
    //print_r($statements);
    //echo $_SERVER["REQUEST_URI"];die();
    // Verification des Method Utiliser
    // echo $_SERVER["REQUEST_METHOD"]; die(); // Retourne le type de la method utiliser
    if($_SERVER["REQUEST_METHOD"] == "POST"){ // Si la method est POST

        // Test l'existance de la route
        switch($_SERVER["REQUEST_URI"]){
            case FOLDER."user-register": // Chargement de la Class et lancement de la methode
                require "php/Controller/UsersController.php"; // Charger le fichier php
                $test = new UsersController();
                $test->addUser();
            break;

            case FOLDER."single":
                require "php/Controller/ApiController.php";
                $apiController = new ApiController();
                $apiController->detailItem((int)$id);
            break;

            default: // Redirection vers la route 404
                header("Location:".HOST.FOLDER."404");
        }

    }elseif($_SERVER["REQUEST_METHOD"] == "GET"){

       

        switch($_SERVER["REQUEST_URI"]){
            case FOLDER:
                require "php/Controller/HomeController.php";   
                $home = new HomeController();
                $home->home();
            break;

            case FOLDER."logout":
                require "php/Controller/UsersController.php";
                $usersContoller = new UsersController();
                $usersContoller->logClientOut();
            break;

            case FOLDER."single":
                require "php/Controller/ShopController.php";
                $shop = new ShopController();
                $shop->single((int)$id);
            break;

            case FOLDER."404":
                include("404.php");
            break;


            default:
                header("Location:".HOST.FOLDER."404");
        }


    }