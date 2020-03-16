<?php


class VideoManager{

    private $_db;

    function __construct(){
        $this->_db = $this->dbConnect();
    }

    //Connexion a la base de données
    private function dbConnect(){
        $db = new PDO('mysql:host=localhost;dbname=id11084404_bd;charset=utf8', 'id11084404_ludo', 'Activd00r');
        return $db;
    }

    public function addVideo($videoId, $spotId, $userId){
        $req = $this->_db->prepare("INSERT INTO video (videoId, spotId, userId) VALUES (:videoId, :spotId, :userId)");
        $affectedLines = $req->execute(array(
            ":videoId"=>$videoId,
            ":spotId"=>$spotId,
            ":userId"=>$userId
        ));

        return $affectedLines;
    }

    public function getVideosBySpot($spotId){
        $req = $this->_db->prepare("SELECT * FROM video WHERE spotId = ?");
        $req->execute(array($spotId));

        return $req;
    }

    public function deleteVideo($videoId){
        $req = $this->_db->prepare("DELETE FROM video WHERE videoId = ?");
        $affectedLines = $req->execute(array($videoId));

        return $affectedLines;
    }

    public function getVideosByUser($userId){
        $req = $this->_db->prepare("SELECT * FROM video WHERE userId = ?");
        $req->execute(array($userId));

        return $req;
    }

}