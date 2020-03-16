<?php


class CommentManager{

    private $_bd;

    public function __construct(){
        $this->_bd = $this->dbConnect();
    }

    //Connexion a la base de données
    private function dbConnect(){
        $db = new PDO('mysql:host=localhost;dbname=id11084404_bd;charset=utf8', 'id11084404_ludo', 'Activd00r');
        return $db;
    }

    public function getCommentsBySpot($spotId){
        $req = $this->_bd->prepare("SELECT * FROM commentaire INNER JOIN utilisateur ON commentaire.userId = utilisateur.userId WHERE commentaire.spotId = ? ORDER BY date_heure DESC");
        $req->execute(array($spotId));

        return $req;
    }

    public function getCommentsByUser($userId){
        $req = $this->_bd->prepare("SELECT * FROM commentaire WHERE userId = ?");
        $req->execute(array($userId));

        return $req;
    }

    public function postComment($userId, $spotId, $commentContent){
        $req = $this->_bd->prepare("INSERT INTO commentaire (spotId, userId, commentContent, date_heure) VALUES (:spotId, :userId, :commentContent, NOW())");
        $affectedLines = $req->execute(array(
            ":spotId"=>$spotId,
            ":userId"=>$userId,
            ":commentContent"=>$commentContent));

        return $affectedLines;
    }

    public function deleteComment($commentId){

    }

}