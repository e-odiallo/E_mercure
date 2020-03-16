<?php


class ImageController extends Controller {

    private $_manager;

    public function __construct(){
        parent::__construct();
        $this->_manager = new ImageManager();
    }

    public function getSpotImages($spotId){
        $images = $this->_manager->spotImages($spotId);
    }


}