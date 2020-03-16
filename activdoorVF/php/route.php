<?php session_start();

use MongoDB\Driver\Manager;

include './class/Activity.php';
include './class/Lieu.php';
include './class/Spot.php';
include './model/SpotManager.php';
include './model/UserManager.php';
include './model/ImageManager.php';
include './model/CommentManager.php';
include './model/VisiteManager.php';
include './model/VideoManager.php';
include './controller/Controller.php';
include './controller/SpotController.php';
include './controller/UserController.php';


$spotController = new SpotController();
$userController = new UserController();

if(isset($_GET['action'])){
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
                $userController->createAccount($_POST['nom'], $_POST['prenom'],$_POST['email'], $_POST['password'], file_get_contents($_FILES['fic']['tmp_name']), $_POST['ville']);
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

        case 'visited':
            if(isset($_GET['spotId'])){
                $userController->spotVisite($_GET['spotId']);
            }
            break;

        case "unVisite":
            if(isset($_GET['spotId'])){
                $userController->spotUnvisit($_GET['spotId']);
            }
            break;

        case  "userProfile" :
            if(isset($_GET['userId'])){
                $userController->userProfile($_GET['userId']);
            }

            break;

        case "myProfile":
            $userController->myProfile();
            break;

        case "userImage":
            if(isset($_GET['userId'])){
                $userController->getUserImage($_GET['userId']);
            }
            break;

        case"logout":
            $userController->logout();
            break;

        case "postComment":
            if(isset($_POST['spotId']) && isset($_POST['commentContent'])){
                $spotController->publishComment($_POST['spotId'], $_POST['commentContent']);
            }else{

            }
            break;

        case "shareVideo":
            if(isset($_GET['videoId']) && isset($_GET['spotId'])){
                $spotController->addVideo($_GET['videoId'], $_GET['spotId']);
            }
            break;

        case "deleteVideo":
            if(isset($_GET['videoId'])){
                $userController->deleteVideo($_GET['videoId']);
            }
            break;

        case "editNewSpot":
            if(isset($_GET['latitude']) && isset($_GET['longitude'])){
                $spotController->editNewSpot($_GET['latitude'], $_GET['longitude']);
            }

        case "editDescription":
            if(isset($_GET['latitude'])&& isset($_GET['longitude']) && isset($_GET['ville']) && isset($_GET['type']) && isset($_GET['nom'])){
                $spotController->editNewSpotDescription($_GET['latitude'], $_GET['longitude'], $_GET['ville'], $_GET['type'], $_GET['nom']);
            }

        case "addSpot":
            if(isset($_POST['description'])){
                $spotController->addSpot($_POST['description']);
            }
            break;

        case "spotAdded":
            $spotController->addedSpot();
            break;

        case "uploadImage":

            break;


        default :
            $spotController->badURL();
            break;
    }
} else{
    $spotController->badURL();
}


?>