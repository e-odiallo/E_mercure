<?php


/**
 * SpotController
 *
 *
 * @package    Controller
 * @author     LUDOVC MARQUIER <YOUREMAIL@domain.com>
 */

class SpotController extends Controller {

    private $_manager;
    private $_imageManager;
    private $_visiteManager;
    private $_videoManager;
    private $_commentManager;
    private $_userManager;

    function __construct(){
        parent::__construct();
        $this->_manager = new SpotManager();
        $this->_imageManager = new ImageManager();
        $this->_visiteManager = new VisiteManager();
        $this->_videoManager = new VideoManager();
        $this->_commentManager = new CommentManager();
    }


    public function addSpot($description){
        if($this->isConnected(false)){
            if(isset($_SESSION['new-spot-lat']) && isset($_SESSION['new-spot-long']) && isset($_SESSION['new-spot-ville']) && isset($_SESSION['new-spot-nom']) && isset($_SESSION['new-spot-type'])){
                $pays = file_get_contents("http://api.geonames.org/countryCode?lat=".$_SESSION['new-spot-lat']."&lng=".$_SESSION['new-spot-long']."&username=ludomav");
                if($this->_manager->addSpot($_SESSION['new-spot-nom'], $_SESSION['new-spot-ville'], $_SESSION['new-spot-lat'], $_SESSION['new-spot-long'], $description, $_SESSION['new-spot-type'], $pays)){
                    $_SESSION['hasAdded'] = true;
                    echo json_encode(array("result"=>"success", "spotId"=>$_SESSION['addedSpot']));
                }else{
                    echo json_encode(array("result"=>"failure", "error"=>"database-failure"));
                }
            }else{
                echo json_encode(array("result"=>"failure", "error"=>"badentry"));
            }
        }else{
            echo json_encode(array("result"=>"failure", "error"=>"notConnected"));
        }
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
        $isConnected = $this->isConnected(false);
        $isVisited = false;
        $spot = $this->_manager->getSpot($spotId);

        if(!empty($spot)){
            $images = $this->_imageManager->spotImages($spotId);
            $jours = $this->getDays();
            $nbVisitor = $this->getNumberOfVisitors($spotId);
            $videos = $this->_videoManager->getVideosBySpot($spotId);
            $comments = $this->_commentManager->getCommentsBySpot($spotId);

            if($isConnected){
                $isVisited = !($this->checkVisitedSpots($_SESSION['userId'], $spotId));

            }

            require ('./view/spot.php');
        }else{
            echo" non";
        }

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

    public function addVideo($videoId, $spotId){
        if($this->isConnected(false)){
            if($this->_videoManager->addVideo($videoId,$spotId, $_SESSION['userId'])){
                echo json_encode(array("result"=>"success"));
            }else{
                echo json_encode(array("result"=>"fail", "error"=>"database-failure"));
            }
        }else{
            echo json_encode(array("result"=>"fail", "error"=>"not-connected"));
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

    public function publishComment($spotId, $commentContent){
        if($this->isConnected(false)){
            if($this->_commentManager->postComment($_SESSION['userId'],$spotId, $commentContent)){
                echo json_encode(array("result"=>"success"));
            }else{
                echo json_encode(array(
                    "result"=>"fail",
                    "error"=>"database_failure"));
            }
        }else{
            echo json_encode(array(
                "result"=>"fail",
                "error"=>"no_connected"));
        }

    }

    private function getDays(){
        $days = array("Monday"=>"Lundi",
            "Tuesday" => "Mardi",
            "Wednesday"  =>"Mercredi",
            "Thursday" => "Jeudi",
            "Friday" => "Vendredi",
            "Saturday" => "Samedi",
            "Sunday" => "Dimanche");


        $keys = array_keys( $days );
        $jours = array();
        $index = array_search(date('l'),array_keys($days))+1;
        array_push($jours, "Aujourd'hui");

        for($i=0;$i<7;$i++){
            if ($index < 7){
                array_push($jours, $days[$keys[$index]]);
                $index++;
            }else $index = 0;
        }

        return $jours;
    }

    private function getNumberOfVisitors($spotId){
        $visitors = $this->_visiteManager->getVisitors($spotId);
        $nbVisitors = 0;
        while($data = $visitors->fetch()){
            $nbVisitors++;
        }

        return $nbVisitors;
    }

    public function editNewSpot($lat, $long){
        if($this->isConnected(false)){
            $latitude = $lat;
            $longitude = $long;
            require('./view/editNewSpotView.php');
        }
    }

    public function editNewSpotDescription($lat, $long, $ville, $type, $nom){
        if($this->isConnected(false)){
            $_SESSION['new-spot-lat'] = $lat;
            $_SESSION['new-spot-long'] = $long;
            $_SESSION['new-spot-ville'] = $ville;
            $_SESSION['new-spot-type'] = $type;
            $_SESSION['new-spot-nom'] = $nom;

            require('./view/editNewSpotDescView.php');
        }
    }

    public function addedSpot(){
        if($this->isConnected(false)){
            if(isset($_SESSION['hasAdded']) && $_SESSION['hasAdded']){
                $spotId = $_SESSION['addedSpot'];
                require('./view/spotAddedView.php');
            }
        }
    }

}