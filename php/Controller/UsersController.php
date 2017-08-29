<?php 
    require "Controller.php";
	class UsersController extends Controller{
        
        public function addUser(){
            
   require "php/Model/UsersModel.php"; // Charger le fichier php
            $redirect = 0; // Define ma variable de redirection

            $error = $this->arrayIsEmpty($_POST, array("firstname","lastname","email","password"));
           
            if($error == -1)
                $redirect = -1;

            if($redirect != -1):

                $dbUser = new UsersModel();
                $user = $dbUser->listenerClientsByEmail($_POST['email']); // Email to database

                if(count($user) >= 1)
                    $redirect = -1;

                if($redirect != -1){
                    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT); // cryptage du mdp.
                    $idUser = $dbUser->addUser($_POST);
                }

            endif;
            
            if($redirect == -1)
                header("Location:".HOST.FOLDER."404");
            else{
                $_POST["idclients"] = $idUser;// ajouter l'id
                $this->clientAddSession($_POST);
                header("Location:".HOST.FOLDER);
            }
        }

            
       


        // rajout session utilisateur permet de se connecter
        public function clientAddSession($user = array()){
            if (!isset($user["idclients"])) {
                return -1;
            }
            unset($user["password"]);
            $_SESSION["user"] = $user;

        }

        // fonction pour se déconnecter 
        public function logClientOut(){
            unset($_SESSION["user"]);
            header("Location:".HOST.FOLDER);
        }
    }
