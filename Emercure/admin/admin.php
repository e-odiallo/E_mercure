<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-mercure Admin</title>
    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/shop-homepage.css" rel="stylesheet">

</head>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$host='postgresql-dop.alwaysdata.net';
$dbname = 'dop_e_mercure';
$username = 'dop';
$password = 'quxvas-kabby3-Taqras';

$dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
$conn = new PDO($dsn);

include ('fonctions_admin.php');

?>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">E-mercure</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Arcticles
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="clients/client.php">Clients</a>
                </li>
                <li class="nav-item">
                    <form action="commandes/commande.php" method="get" enctype="multipart/form-data">
                        <input type="submit" class="btn btn-dark"  name="submit" value="Commandes">
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=livreurs/livreur.php>Livreurs</a>
                </li>
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
                <form action="" method="get" enctype="multipart/form-data">
                    <input type="submit" formaction="articles/type_articles.php?submit=vetement" class="btn btn-outline-danger"  name="submit" value="Vetement">
                </form>

                <form action="" method="get" enctype="multipart/form-data">
                    <input style="margin-top: 1em;"  type="submit" formaction="articles/type_articles.php?submit=accessoire" class="btn btn-outline-danger"  name="submit" value="Accessoire">
                </form>

                <form action="" method="get" enctype="multipart/form-data">
                    <input style="margin-top: 1em;"  type="submit" formaction="articles/type_articles.php?submit=chaussure" class="btn btn-outline-danger"  name="submit" value="Chaussure">
                </form>
                <form action="" method="get" enctype="multipart/form-data">
                    <input style="margin-top: 1em;"  type="submit" formaction="articles/type_articles.php?submit=Articles soldés" class="btn btn-outline-danger"  name="submit" value="Articles soldés">
                </form>
                <form action="" method="get" enctype="multipart/form-data">
                    <input style="margin-top: 1em;"  type="submit" formaction="articles/gerer_articles.php?submit=chaussure" class="btn btn-outline-danger"  name="submit" value="Gerer articles">
                </form>
            </div>

        </div>
        <!-- /.col-lg-3 -->


        <div class="col-lg-9">

            <div class="row" style="margin-top: 2em;">

                <?php
                all_articles();
                ?>



            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; E-Mercure 2019</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
