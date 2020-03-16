<?php


class UserManager{

    private $_db;

    function __construct(){
        $this->_db = $this->dbConnect();
    }

    //Connexion a la base de données
    private function dbConnect(){
        $db = new PDO('mysql:host=localhost;dbname=id11084404_bd;charset=utf8', 'id11084404_ludo', 'Activd00r');
        //debug mode
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        return $db;
    }

    public function addUser($nom, $prenom, $email, $password, $ville, $img){
        $req = $this->_db->prepare('INSERT INTO utilisateur (nom, prenom, email, password, img, ville) VALUES (:nom, :prenom, :email ,:password , :img , :ville)');
        $affectedLines = $req->execute(array(
            ":nom"=>$nom,
            ":prenom"=>$prenom,
            ":email"=>$email,
            ":password"=>password_hash($password, PASSWORD_DEFAULT),
            ":img"=>$img,
            ":ville"=>$ville
        ));

        return $affectedLines;
    }

    public function getUser($userId){
        $req = $this->_db->prepare("SELECT * FROM utilisateur WHERE userId = ?");
        $req->execute(array($userId));
        return $req->fetch();
    }

    public function login($email){
        $req = $this->_db->prepare('SELECT * FROM utilisateur WHERE email = ?');
        $req->execute(array($email));

        return $req->fetch();
    }

    public function userConnexion($login){
        $req = $this->_db->prepare('SELECT password FROM utilisateur WHERE login = ?');
        $req->execute(array($login));

        return $req->fetch();
    }

    public function email($email){
        $req = $this->_db->prepare('SELECT * FROM utilisateur WHERE email = ?');
        $req->execute(array($email));

        return $req;
    }

    public function userImage($userId){
        $req = $this->_db->prepare("SELECT img FROM utilisateur WHERE userId = ?");
        $req->execute(array($userId));

        return $req;
    }


}