<?php

/**
 * SpotController
 *
 *
 * @package    Controller
 * @author     LUDOVC MARQUIER <YOUREMAIL@domain.com>
 */

class SpotController{

    private $_manager;
    private $_imageManager;

    function __construct(){
        $this->_manager = new SpotManager();
        $this->_imageManager = new ImageManager();
    }


    /**
     *
     * get all spost from manager and display them in html or json
     *
     * @param boolean $json to gie the result in json format or not
     */
    public function allSpots($json){

        if($json){
            $spots = $this->_manager->getAllSpots();
            require('./view/displaySpotJson.php');
        }else{
            $type = "tous les types";
            $spots = $this->_manager->getAllSpots();
            require('./view/templateSpotByType.php');
        }
    }


    /**
     *
     * get one particular spot and display it in the html view
     *
     * @param string $spotId the id of the required spot
     */
    public function spot($spotId){
        $spot = $this->_manager->getSpot($spotId);
        $images = $this->_imageManager->spotImages($spotId);
        require ('./view/spot.php');
    }


    /**
     *
     * get all the spot from one type given and display them in html
     *
     * @param string $type the type wanted
     */
    public function spotByType($type){

        if($type == "all"){
            $this->allSpots(false);
        }else{
            $spots = $this->_manager->getAllSpotsByType($type);
            require('./view/templateSpotByType.php');
        }

    }


    /**
     *
     * get all the spots from one city given and display them in html
     *
     * @param string $city the city wanted
     */
    public function spotByCity($city){
        if($city == "all"){
            $this->allSpots(false);
        }else{
            $spots = $this->_manager->getAllSpotsByCity($city);
            require('./view/templateSpotByCity.php');
        }
    }


    public function searchByCity($input){
        $spots = $this->_manager->getAllSpotsByCity($input);
        require('./view/searchResult.php');
    }

    public function autoCompleteSuggestion($input){
        $spots = $this->_manager->searchResultSpotByName($input);
        require('./view/autoSuggestionsSpots.php');
    }


}