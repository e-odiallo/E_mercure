<?php


class Controller {

    private $_userManager;
    private $_commentManager;
    private $_spotManager;
    private $_visiteManager;
    private $_imageManager;

    public function __construct(){
        $this->_userManager = new UserManager();
        $this->_spotManager = new SpotManager();
        $this->_visiteManager = new VisiteManager();
    }

    /**
     *
     * Check if the user is connectd or not to the plateform
     *
     * @param boolean  $json if you want the result as json or not
     * @return boolean
     */
    public function isConnected($json){
        if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] ){
            if($json) echo json_encode(array("connected"=>"yes", "userId"=>$_SESSION['userId']));
            return true;
        }else{
            if($json) echo json_encode(array("connected"=>"no"));
            return false;
        }
    }


    /**
     *
     * check if the current user didnt alredy visited the given spot
     *
     * @param string $userId the id of the current User
     * @param string spotId the id of the spot that the user is tryinf to visit
     *
     *@return boolean true if the user hasn't visited the spot
     */
    public function checkVisitedSpots($userId, $spotId){
        $result = true;
        $visited = $this->_visiteManager->getUserVisites($userId);
        while ($data = $visited->fetch()){
            if(strval($data['spotId']) == $spotId){
                $result = false;
            }
        }
        return $result;
    }

    public function badURL(){
        require('./view/badURLView.php');
    }

}