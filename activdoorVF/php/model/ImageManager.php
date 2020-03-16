<?php


class ImageManager{

    private $_db;

    function __construct(){
        $this->_db = $this->dbConnect();
    }

    //Connexion a la base de données
    private function dbConnect(){
        $db = new PDO('mysql:host=localhost;dbname=id11084404_bd;charset=utf8', 'id11084404_ludo', 'Activd00r');
        return $db;
    }

    public function spotImages($spotId){
        $req = $this->_db->prepare("SELECT url_image FROM image WHERE idSpot = ?");
        $req->execute(array($spotId));

        return $req;
    }

    public function getImageByUser($userId){
        $req = $this->_db->prepare("SELECT url_image FROM image WHERE userId = ?");
        $req->execute(array($userId));

        return $req;
    }

}