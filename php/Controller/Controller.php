<?php
class Controller{

    protected $categories ;
    protected $itemsModel;

    public function __construct(){
        require "php/Model/itemsModel.php";
        $this->itemsModel = new ItemsModel();
        $this->categories = $this->itemsModel->listenerCategories();
        
    }

    public function arrayIsEmpty($data = array(), $keyObligatory = array()){
        if(!is_array($data))
            return -1;
        
        $isOk = false;

        foreach($data as $key => $val){
            foreach($keyObligatory as $valO)
                if($valO == $key)
                    $isOk = true;
            if(!$isOk || empty(trim($val))){
                return -1;die();
            }
        }

        return 1;
    }
}