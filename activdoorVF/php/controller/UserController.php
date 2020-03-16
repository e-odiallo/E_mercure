<?php


/**
 * UserController
 *
 *
 * @package    Controller
 * @author     MARQUIER LUDOVIC <YOUREMAIL@domain.com>
 */


class UserController extends Controller {

    private $_userManager;
    private $_visiteManager;
    private $_imageManager;
    private $_videoManager;
    private $_commentManager;

    public function __construct(){
        parent::__construct();
        $this->_userManager = new UserManager();
        $this->_visiteManager = new VisiteManager();
        $this->_imageManager = new ImageManager();
        $this->_videoManager = new VideoManager();
        $this->_commentManager = new CommentManager();
    }

    /**
     *
     * get the informations of the user
     *
     * @param string $userId the id given by the user
     */
    public function userProfile($userId){
        $user = $this->_userManager->getUser($userId);
        if(!empty($user)){
            $name =  $user['nom'];
            $lastname = $user['prenom'];
            $email = $user['email'];
            $city = $user['ville'];
            $profil_pic = $user['img'];
            $visited = $this->_visiteManager->getUserVisites($userId);
            $images = $this->_imageManager->getImageByUser($userId);
            $videos = $this->_videoManager->getVideosByUser($userId);
            $comments = $this->_commentManager->getCommentsByUser($userId);

            require ('./view/userView.php');
        }else{
            echo "";
        }
    }


    /**
     *
     * Opens current's user page
     *
     */
    public function myProfile(){
        if($this->isConnected(false)){
            if(isset($_SESSION['userId'])){
                $this->userProfile($_SESSION['userId']);
            }else{
                header('Location: ../html/connexion.html');
                exit();
            }
        }else{
            header('Location: ../html/connexion.html');
            exit();
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
                $_SESSION['userName'] = $user['prenom']." ".$user['nom'];
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
            if($this->_userManager->addUser($nom, $prenom, $email, $password, $ville, $image)){
                $_SESSION['isConnected'] = true;
                $_SESSION['userId'] = $this->_userManager->email($email)->fetch()['userId'];
                header('Location: https://activdoor.000webhostapp.com/html/connexion.html');
                exit();
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
     * add a visited spot to the user connected
     *
     * @param string $spotId the id of the visited spot
     *
     */
    public function spotVisite($spotId){
        if($this->isConnected(false)){
            if(isset($_SESSION['userId'])){
                if($this->checkVisitedSpots($_SESSION['userId'], $spotId)){
                    if($this->_visiteManager->addVisite($_SESSION['userId'], $spotId)){
                        echo json_encode(array("result"=>"success"));
                    }else{
                        echo json_encode(array("result"=>"fail", "error"=>"database_failure"));
                    }
                }else{
                    echo json_encode(array("result"=>"fail", "error"=>"already_visited"));
                }
            }else{
                echo json_encode(array("result"=>"fail", "error"=>"userId_not_defined"));
            }
        }else{
            echo json_encode(array("result"=>"fail", "error"=>"not_connected"));
        }
    }


    /**
     *
     * delete spot from visited spot list
     *
     * @param string $spotId the id of the Unvisited spot
     *
     */
    public function spotUnvisit($spotId){
        if($this->isConnected(false)){
            if(isset($_SESSION['userId'])){
                if(!$this->checkVisitedSpots($_SESSION['userId'], $spotId)){
                    if($this->_visiteManager->deleteVisite($_SESSION['userId'], $spotId)){
                        echo json_encode(array("result"=>"success"));
                    }else{
                        echo json_encode(array("result"=>"fail", "error"=>"database_failure"));
                    }
                }else{
                    echo json_encode(array("result"=>"fail", "error"=>"already_deleted"));
                }
            }else{
                echo json_encode(array("result"=>"fail", "error"=>"userId_not_defined"));
            }
        }else{
            echo json_encode(array("result"=>"fail", "error"=>"not_connected"));
        }
    }

    public function deleteVideo($videoId){
        if($this->isConnected(false)){
            if($this->isVideoPostedByUser($videoId)){
                if($this->_videoManager->deleteVideo($videoId)){
                    echo json_encode(array("result" => "success"));
                }else{
                    echo json_encode(array("result" => "fail", "error"=>"database-failure"));
                }
            }else{
                echo json_encode(array("result" => "fail", "error"=>"notUsersVideo"));
            }
        }else{
            echo json_encode(array("result" => "fail", "error"=>"not-connected"));
        }
    }

    public function logout(){
        if($this->isConnected(false)){
            unset($_SESSION['isConnected']);
            unset($_SESSION['userId']);
            echo (json_encode(array("logout"=>"ok")));
        }else{
            echo (json_encode(array("logout"=>"failure")));
        }
    }

    public function getUserImage($userId){
        $image = $this->_userManager->userImage($userId);
        $data = $image->fetch();
        echo '<img src="data:image/jpeg;base64,'.base64_encode($data['img']) .'" />';
    }

    private function isVideoPostedByUser($videoId){
        $videos = $this->_videoManager->getVideosByUser($_SESSION['userId']);
        while($video = $videos->fetch()){
            if($video['videoId'] == "$videoId"){
                return true;
            }
        }
        return false;
    }

}