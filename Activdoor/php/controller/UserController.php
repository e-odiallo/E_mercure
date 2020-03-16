<?php

/**
 * UserController
 *
 *
 * @package    Controller
 * @author     MARQUIER LUDOVIC <YOUREMAIL@domain.com>
 */


class UserController{

    private $_userManager;

    public function __construct(){
        $this->_userManager = new UserManager();
    }

    /**
     *
     * get the informations of the user
     *
     * @param string $userId the id given by the user
     */
    public function userProfile($userId){
          // Implementer la fonction UserProfile pour recuperer les information de l'utlisateur et faire un template pour afficher le user bone
            if($this->isConnected(false)){
                if ($_SESSION['userId'] == $userId){
                    $user = $this->_userManager->getUser($userId);
                    if(!empty($user)){
                        $name =  $user['nom'];
                        $lastnme = $user['prenom'];
                        $email = $user['email'];
                        $city = $user['ville'];
                        $profil_pic = $user['img'];

                        require ('./view/profileView.php');

                    }
                    else{
                        echo "";
                    }
                }
                else{
                    header("");
                    exit();
                }

            }
            else{

            }
    }


    /**
     *
     * Log the user to the website by checking email and password
     *
     * @param string $email the email adress given by the user
     * @param string $password the password given by the user
     */
    public function connexion($email, $password){
        $user = $this->_userManager->login($email);
        if(!empty($user)){
            if(password_verify($password, $user['password'])){
                $_SESSION['isConnected'] = true;
                $_SESSION['userId'] = $user['userId'];
                echo json_encode(array("login"=>"ok", "userId"=>$user['userId']));
            }else{
                echo json_encode(array("login"=>"failure", "error"=>"password"));
            }
        }else{
            echo json_encode(array("login"=>"failure", "error"=>"email"));
        }
    }


    /**
     *
     * Create the user account
     *
     * @param string $nom user's last name
     * @param string $prenom user's first name
     * @param string $email user's email adress
     * @param string $password user's password
     * @param string $image image
     * @param string $ville user's city
     *
     */
    public function createAccount($nom,$prenom, $email, $password, $image, $ville){
        if($this->checkEmail($email, false)){ //check if email is not already registered
            if($this->_userManager->addUser($nom, $prenom, $email, $password, $image, $ville)){
                $_SESSION['isConnected'] = true;
                $_SESSION['userId'] = $this->_userManager->getIdByEmail($email)['userId'];
                echo json_encode(array("result"=>"ok"));
            }else{
                echo json_encode(array("result"=>"dataBasefailure"));
            }
        }else{
            echo json_encode(array("result"=>"userNameFailure"));
        }
    }


    /**
     *
     * Check if a given mail adress is not already registered
     *
     * @param string $email the given mail adress
     * @param boolean  $json if you want the result as json or not
     * @return boolean
     */
    public function checkEmail($email, $json){
        $result = $this->_userManager->email($email);
        if($data = $result->fetch()){
            if ($json) echo json_encode(array("result"=>"not available"));
            return false;
        }else{
            if ($json)echo json_encode(array("result"=>"available"));
            return true;
        }
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

}