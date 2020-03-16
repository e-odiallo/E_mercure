<?php
class ClientManager
{
    private $_dbconnexion ;

    function __construct (){
        $this->_dbconnexion=$this->dbConnect();
    }
    //Connexion a la base de données
     private function dbConnect(){
         $hostlocal='postgresql-dop.alwaysdata.net';
         $dbnamelocal = 'dop_e_mercure';
         $usernamelocal = 'dop';
         $passwordlocal = 'quxvas-kabby3-Taqras';

         $host='devwebdb.etu';
         $dbname = 'db2019l3i_e_odiallo';
         $username = 'y2019l3i_e_odiallo';
         $password = 'A123456*';

         //$dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
         $dsn = "pgsql:host=$hostlocal;port=5432;dbname=$dbnamelocal;user=$usernamelocal;password=$passwordlocal";
         $connex = new PDO($dsn);

        $connex->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        return $connex;
    }

    public function addClient($nom,$prenomc,$sexe,$email,$adressec,$password,$tel){

        $req = $this->_dbconnexion->prepare('INSERT INTO client (nom_client, prenom_client, sexe, mail_client, adresse_client, mdp_client, tel_client)
                                                     VALUES (:nom,:prenom,:sexe,:email,:adresse,:mdp,:telephone)');

        $affectedLines = $req->execute(array(
            ':nom'=>$nom,
            ':prenom'=>$prenomc,
            ':sexe'=>$sexe,
            ':email'=>$email,
            ':adresse'=>$adressec,
            ':mdp'=>password_hash($password, PASSWORD_DEFAULT),
            ':telephone'=>$tel
        ));
        return $affectedLines;
    }
    public function login($email,$json){
        $req = $this->_dbconnexion->prepare('SELECT * FROM client WHERE mail_client = ?');
        $req->execute(array($email));

        return $req->fetch();
    }

    public function getUser ($clientId){
        $req = $this->_dbconnexion->prepare('SELECT * FROM client WHERE id_client = ?');
        $req->execute(array($clientId));

        return $req->fetch();
    }
    public function getIdByEmail ($email){
        $req = $this->_dbconnexion->prepare('SELECT id_client FROM client WHERE mail_client = ?');
        $req->execute(array($email));

        return $req->fetch();
    }
    public function email($email){
        $req = $this->_dbconnexion->prepare('SELECT * FROM client WHERE mail_client = ?');
        $req->execute(array($email));

        return $req;
    }


}