<?php session_start();

use MongoDB\Driver\Manager;

include './class/Activity.php';
include './class/Lieu.php';
include './class/Spot.php';
include './model/ImageManager.php';
include './model/SpotManager.php';
include './model/UserManager.php';
include './controller/SpotController.php';
include './controller/UserController.php';


if(isset($_GET['action'])){

    $spotController = new SpotController();
    $userController = new UserController();

    switch ($_GET['action']){
        case "getAllSpots":

            if(isset($_GET['json'])){
                $spotController->allSpots($_GET['json'] == "true");
            }else{
                //afficher la page spot
            }
            break;

        case "getSpot":
            if(isset($_GET['spotId'])){
                $spotController->spot($_GET['spotId']);
            }
            break;

        case "completeSuggestions":
            if(isset($_GET['input'])){
                $spotController->autoCompleteSuggestion($_GET['input']);
            }
            break;

        case "search":
            if(isset($_GET['filter'])){
                switch ($_GET['filter']){
                    case "city":
                        $spotController->searchByCity($_GET['input']);
                        break;
                }

            }
            break;

        case "getSpotsByType":
            if(isset($_GET['type'])){
                $spotController->spotByType($_GET['type']);
            }
            break;

        case "getSpotsByCity":
            if(isset($_GET['city'])){
                $spotController->spotByCity($_GET['city']);
            }
            break;

        case "checkEmail":
            $userController->checkEmail($_GET['email'], $_GET['json'] == "true");
            break;

        case "register":
            if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['img']) && isset($_POST['ville'])){
                $userController->createAccount($_POST['nom'], $_POST['prenom'],$_POST['email'], $_POST['password'], $_POST['img'], $_POST['ville']);
            }else{

            }
            break;

        case "login":
            if(isset($_POST["email"]) && isset($_POST['password'])){
                $userController->connexion($_POST['email'], $_POST['password']);
            }
            break;

        case "isConnected":
            $userController->isConnected(true);
            break;


        case  "profile" :
            $userController->userProfile($_GET['userId']);
            

        default :
            break;
    }
}else{

}


?>