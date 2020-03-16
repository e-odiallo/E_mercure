<?php session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './model/ClientManager.php';
include './model/ArticlesManagers.php';
include 'controller/ClientControler.php';
include 'controller/ArticlesContoller.php';

    $clientManager = new ClientManager();
    $clientController = new ClientControler();

    $articleControl = new ArticlesContoller();
    $articleManager = new ArticlesManagers();

        if(isset($_GET['action'])) {
            switch ($_GET['action']) {
                case "register":
                    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['sexe']) && isset($_POST['mail']) && isset($_POST['adresse']) && isset($_POST['password']) && isset($_POST['numero'])) {
                        $clientController->addAccount($_POST['nom'], $_POST['prenom'], $_POST['sexe'], $_POST['mail'], $_POST['adresse'], $_POST['password'], $_POST['numero']);
                    }
                    break;

                case "add_articles":
                    if (isset($_POST['nom']) && isset($_POST['genre']) && isset($_POST['prix']) && isset($_POST['date']) && isset($_POST['quantite']) && isset($_FILES['imagebd']['name'], $_POST['descrip']) && isset($_POST['type'])) {
                        $articleManager->addArticles($_POST['nom'], $_POST['genre'], $_POST['prix'], $_POST['date'], $_POST['quantite'], $_FILES['imagebd']['name'], $_POST['descrip'], $_POST['type']);
                        echo "article ajoutee";
                    } else {
                        echo "une erreur a ete rencontre";
                    }
                    break;

                case 'login':
                    $clientController->connexion($_POST['email'], $_POST['password']);
                    break;

                case 'connected' :
                    $clientController->isConnected(true);
                    break;

                case 'logout':
                    $clientController->logout();
                    break;

                default :
                    break;
            }
        }
                            if (isset($_POST['comments']) && isset($_POST['idArticle']) && isset($_POST['client'])) {
                                $comment = $_POST['comments'];
                                $article = $_POST['idArticle'];
                                $client = $_POST['client'];

                                $articleManager->addComment($client,$comment, $article);

                            }


?>
