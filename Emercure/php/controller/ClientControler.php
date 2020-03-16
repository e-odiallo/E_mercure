<?php


class ClientControler
{

    private $_clientManager;

    public function __construct()
    {
        $this->_clientManager = new ClientManager();
    }

    /**
     * @author Oumar Diallo
     * Add new user in the database
     * @param String $nom the lastname of the customer
     * @param String $prenom the firstname of the customer
     * @param String $sexe the sex of the customer
     * @param String $email the mail of the customer
     * @param String $adressec the adress of the customer
     * @param String $password the password of the customer
     * @param String $tel the number phone of the customer
     */
    public function addAccount($nom,$prenomc,$sexe,$email,$adressec,$password,$tel)
    {
        if ($this->checkEmail($email, false)) {//Verification si l'email n'exite pas deja dans la base de données
            $clientmanager = new ClientManager() ;
            if ($clientmanager->addClient($nom,$prenomc,$sexe,$email,$adressec,$password,$tel)) {
                $_SESSION['isConnected'] = true;
                $_SESSION['id_client'] = $clientmanager->email($email)->fetch()['id_client'];
               header('Location: ../../index.php');
                exit();
            } else {
                echo json_encode(array("result" => "dataBasefailure"));
            }
        } else {
            echo json_encode(array("result" => "Compte existant deja dans la base de données "));
        }
    }

    /**
     * @author Oumar Diallo
     * Check if the mail of the new user when registred is already in database
     * @param String $email the email of the new customer
     * @param boolean  $json if you want the result as json or not
     * @return boolean
     */
    public function checkEmail($email, $json)
    {
        $result = $this->_clientManager->email($email);
        if($data = $result->fetch()){
            if ($json) echo json_encode(array("result"=>"not available"));
            return false;
        }else{
            if ($json)echo json_encode(array("result"=>"available"));
            return true;
        }
    }
    /**
     * @author Oumar Diallo
     * Check if the user is connected
     * @param boolean  $json if you want the result as json or not
     * @return boolean
     */
    public function isConnected($json){
        if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] ){
            if($json) echo json_encode(array("connected"=>"yes", "id_client"=>$_SESSION['id_client']));
            return true;
        }else{
            if($json) echo json_encode(array("connected"=>"no"));
            return false;
        }
    }
    /**
     * @author Oumar Diallo
     * Check the email and the password of the custumer to connected
     * @param String $email the email of the customer
     * @param String $password of of the customer
     *
     */
    public function connexion($email, $password)
    {
        $manager = new ClientManager();
        $user = $manager->login($email,true);
        if(!empty($user)){
            if(password_verify($password, $user['mdp_client'])){
                $_SESSION['isConnected'] = true;
                $_SESSION['id_client'] = $user['id_client'];
                $_SESSION['nameClient'] = $user['prenom_client']." ".$user['nom_client'];
                header('location: ../index.php');
            }else{
                header('location: ../html/connexion.html');
                exit();
               // echo json_encode(array("login"=>"failure", "error"=>"password"));
            }
        }else{
            header('location: ../html/connexion.html');
            exit();
           // echo json_encode(array("login"=>"failure", "error"=>"email"));
        }
    }
    /**
     * @author Oumar Diallo
     * Deconnected the user
     */
    public function logout(){
        if($this->isConnected(true)){
            unset($_SESSION['isConnected']);
            unset($_SESSION['id_client']);
            echo (json_encode(array("logout"=>"ok")));
        }else{
            echo (json_encode(array("logout"=>"failure")));
        }

    }
}