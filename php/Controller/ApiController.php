<?php
require "Controller.php";

class ApiController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    public function detailItem($id){
        $pictureItem = $this->itemsModel->listenerPictureItem($id);
        $reviewsItem = $this->itemsModel->listenerReviewsItem($id);
        echo json_encode(array("pictures" => $pictureItem, "reviews"=>$reviewsItem));
    }
}
