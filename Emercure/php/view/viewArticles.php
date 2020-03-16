<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../model/ClientManager.php';
include '../model/ArticlesManagers.php';
include '../controller/ClientControler.php';
include '../controller/ArticlesContoller.php';

$hostlocal='postgresql-dop.alwaysdata.net';
$dbnamelocal = 'dop_e_mercure';
$usernamelocal = 'dop';
$passwordlocal = 'quxvas-kabby3-Taqras';

   // $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $dsn = "pgsql:host=$hostlocal;port=5432;dbname=$dbnamelocal;user=$usernamelocal;password=$passwordlocal";
    //insert into articles(bytea_data) select bytea_import('/my/file.name');
    $conn = new PDO($dsn);

    $articleControl = new ArticlesContoller();

?>
<?php session_start();
$connected = false;
if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] ) {
    if (isset($_SESSION['id_client'])) {
        $connected = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-mercure dress</title>

    <!-- Bootstrap core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/shop-homepage.css" rel="stylesheet">

    <!-- Google  font -->
    <link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Materialize CSS
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
-->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.10.1/css/mdb.min.css" rel="stylesheet">

</head>

<body>
<style>
    .bg {
        background: black ;
    }
    body { font-family: Roboto,Helvetica,Arial,sans-serif;}
</style>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="../../index.php">E-mercure</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="../../index.php">Acceuil
                    </a>
                </li>
                <li class="nav-item">
                    <?php
                    ?>
                </li>
                <li class="nav-item">
                    <?php
                    if($connected) {
                        echo '<a class="nav-link" href="commandeView.php">Commandes</a>' ;
                    }else{
                        echo "<a class=\"nav-link\" href=\"../../html/connexion.html\">Mon compte</a>";
                    }
                    ?>
                </li>
                <?php if($connected) echo
                "<li class='nav-item'> <a class='nav-link' href='../root.php?action=logout'>Deconnexion</a></li>"
                ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-3">
            <h1 class="my-4">Collections</h1>
            <div class="list-group">
                <form action="#" method="get" enctype="multipart/form-data">
                    <input type="submit" formaction="viewArticles.php?submit=vetement" class="btn btn-primary btn-lg btn-block"  name="submit" value="vetement">
                </form>
                <form action="#" method="get" enctype="multipart/form-data">
                    <input style="margin-top: 1em;"  type="submit" formaction="viewArticles.php?submit=accessoire" class="btn btn-primary btn-lg btn-block"  name="submit" value="accessoire">
                </form>
                <form action="#" method="get" enctype="multipart/form-data">
                    <input style="margin-top: 1em;"  type="submit" formaction="viewArticles.php?submit=chaussure" class="btn btn-primary btn-lg btn-block"  name="submit" value="chaussure">
                </form>
                <form action="#" method="get" enctype="multipart/form-data">
                    <input style="margin-top: 1em;"  type="submit" formaction="viewArticles.php?submit=Articles" class="btn btn-primary btn-lg btn-block"  name="submit" value="Articles">
                </form>
                <div class="form-row" style="margin-top: 2em ;">
                    <div class="value">
                        <div class="class=selectpicker">
                            <form action="#" method="get">
                                <select class="select2-dropdown-below" name="order">
                                    <option value="" >Trier par : </option>
                                    <option value="asc" >prix croissant</option>
                                    <option value="desc">prix decroissant</option>
                                </select>
                                <input style="background: white;" type="submit" name="submit" value="ok" />
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-3 -->
        <!-- /.col-lg-3 -->


        <div class="col-lg-9">

            <div class="row" style="margin-top: 2em;">

                <?php

                if (isset($_GET['submit'])) {

                    switch ($_GET['submit']){

                        case 'homme':
                            $articleControl->getArticlesByGenre('homme');
                            break ;
                        case 'femme':
                            $articleControl->getArticlesByGenre('femme');
                            break;
                        case 'chaussure':
                             $shoes='chaussure';
                             $articleControl->getArticlesByType($shoes);
                            break;
                        case 'accessoire':
                            $acc='accessoire';
                            $articleControl->getArticlesByType($acc);
                            break;
                        case 'vetement':
                            $vetement='vetement';
                            $articleControl->getArticlesByType($vetement);
                            break;
                        case 'Articles':
                            $articleControl->getAllArticles();
                            break;
                    }

                }
                if(isset($_GET['order'])){
                    switch ($_GET['order']){
                        case 'asc';
                            $asc ='ASC';
                            $articleControl->orderByAsc();
                            break;
                        case 'desc';
                            $desc ='DESC';
                            $articleControl->orderByDesc();
                            break;
                    }
                }
                if(isset($_GET['id_article'])&& isset($_GET['nom_article'])&& isset($_GET['image'])&& isset($_GET['prix'])&& isset($_GET['taille'])){

                    require('../include/detailArticleView.inc.php');
                }
                ?>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->
<!-- /.container -->

    </div>
<!-- Footer -->
<footer class="page-footer font-small bg pt-4">

    <!-- Footer Elements -->
    <div class="container">

        <!-- Social buttons -->
        <div class="social-but">
            <ul class="list-unstyled list-inline text-center">
                <li class="list-inline-item">
                    <a class="btn-floating btn-fb mx-1">
                        <i class="fab fa-facebook-f"> </i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-tw mx-1">
                        <i class="fab fa-twitter"> </i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-gplus mx-1">
                        <i class="fab fa-google-plus-g"> </i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-li mx-1">
                        <i class="fab fa-linkedin-in"> </i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Social buttons -->

    </div>
    <!-- Footer Elements -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="https://mdbootstrap.com/education/bootstrap/">E-Mercure </a>
    </div>
    <!-- Copyright -->

</footer>

<!-- Footer -->


<!-- Bootstrap core JavaScript -->
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>