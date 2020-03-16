<?php


class VisiteManager{

    private $_bd;

    public function __construct(){
        $this->_bd = $this->dbConnect();
    }

    //Connexion a la base de données
    private function dbConnect(){
        $db = new PDO('mysql:host=localhost;dbname=id11084404_bd;charset=utf8', 'id11084404_ludo', 'Activd00r');
        //$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        return $db;
    }

    public function addVisite($userId, $spotId){
        $req = $this->_bd->prepare("INSERT INTO visite (spotId, userId) VALUES (:spotId, :userId)");
        $affectedLines = $req->execute(array(
            ":spotId"=>$spotId,
            ":userId"=>$userId
        ));

        return $affectedLines;
    }

    public function deleteVisite($userId, $spotId){
        $req = $this->_bd->prepare("DELETE FROM visite WHERE spotId = :spotId AND userId = :userId");
        $affectedLines = $req->execute(array(
            ":spotId"=>$spotId,
            ":userId"=>$userId
        ));

        return $affectedLines;
    }

    public function getUserVisites($userId){
        $req = $this->_bd->prepare("SELECT * FROM visite INNER JOIN spot ON visite.spotId = spot.idSpot WHERE userId = ?");
        $req->execute(array($userId));

        return $req;
    }

    public function getVisitors($spotId){
        $req = $this->_bd->prepare("SELECT userId FROM visite WHERE spotId = ?");
        $req->execute(array($spotId));

        return $req;
    }


}