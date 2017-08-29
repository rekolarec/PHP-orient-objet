<?php 
   
	class HomeController{
        
        public function home(){
            require "php/Model/itemsModel.php"; // Charger le fichier php
            $dbItems =new ItemsModel();
            $itemsHome = $dbItems->listenerItems();
            include("home.php");
        }
    }