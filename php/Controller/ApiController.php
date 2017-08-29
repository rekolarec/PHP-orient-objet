<?php
class ApiController{
    public function detailItem($id){
        require "php/Model/ItemsModel.php";
        $dbItem = new ItemsModel();
        $pictureItem = $dbItem->listenerPictureItem($id);
        $reviewsItem = $dbItem->listenerReviewItem($id);
        echo json_encode(array("pictures" => $pictureItem, "reviews"=>$reviewsItem));
    }
}
