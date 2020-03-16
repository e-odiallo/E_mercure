<?php


class SpotManager{

    private $_db;

    function __construct(){
        $this->_db = $this->dbConnect();
    }

    //Connexion a la base de données
    private function dbConnect(){
        $db = new PDO('mysql:host=localhost;dbname=id11084404_bd;charset=utf8', 'id11084404_ludo', 'Activd00r');
        //$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        return $db;
    }

    //Recuperation de tous les spots de la base
    public function getAllSpots(){
        $req = $this->_db->query('SELECT * FROM spot');

        return $req;
    }

    //Selection d'un spot en particulier
    public function getSpot($spotId){
        $req = $this->_db->prepare('SELECT * FROM spot WHERE idSpot = ?');
        $req->execute(array($spotId));

        return $req->fetch();
    }

    //Selection de tous les spots d'une ville donnée
    public function getAllSpotsByCity($city){
        $req = $this->_db->prepare('SELECT * FROM spot WHERE ville LIKE ?');
        $req->execute(array('%'.$city.'%'));

        return $req;
    }

    //Selection de tous les spots d'un type donnée
    public function getAllSpotsByType($type){
        $req = $this->_db->prepare('SELECT * FROM spot WHERE type = ?');
        $req->execute(array($type));

        return $req;
    }


    public function searchResultSpotByName($input){
        $req = $this->_db->prepare('SELECT * FROM spot WHERE nom LIKE ?');
        $req->execute(array('%'.$input.'%'));

        return $req;
    }

    public function addSpot($name, $ville, $lat, $long, $description, $type, $pays){
        $req = $this->_db->prepare("INSERT INTO spot (nom, description, latitude, longitude, ville, pays, type) VALUES (:nom, :description, :latitude, :longitude, :ville, :pays, :type)");
        $affectedLines = $req->execute(array(
            ":nom"=>$name,
            ":description"=>$description,
            ":latitude"=>$lat,
            ":longitude"=>$long,
            ":ville"=>$ville,
            ":pays"=>$pays,
            ":type"=>$type
        ));

        $spotId = $this->_db->lastInsertId();
        $_SESSION['addedSpot'] = $spotId;

        return $affectedLines;
    }

}