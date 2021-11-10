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
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">

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
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">E-mercure</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item ">
            <a class="nav-link" href="#">Acceuil
            </a>
          </li>
          <li class="nav-item">
            <?php
                 ?>
          </li>
          <li class="nav-item">
              <?php
              if($connected) {// si l'utilisateur est connecte on affiche ses commande sinon un lien pour se connecter
                  echo '<a class="nav-link" href="php/view/commandeView.php">Commandes</a>' ;
              }else{
                  echo "<a class=\"nav-link\" href=\"html/connexion.html\">Mon compte</a>";
              }
              ?>
          </li>
            <?php if($connected) echo //si l'u
            "<li class='nav-item'> <a class='nav-link' href='php/root.php?action=logout'>Deconnexion</a></li>"
            ?>
        </ul>
      </div>
    </div>
  </nav>

  <style>
      .bg {
          background: black ;
      }
      body { font-family: Roboto,Helvetica,Arial,sans-serif;}
  </style>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">
            <h1 class="my-4">Collections</h1>
            <div class="list-group">
              <form action="#" method="get" enctype="multipart/form-data">
                <input type="submit" formaction="php/view/viewArticles.php?submit=vetement" class="btn btn-primary btn-lg btn-block"  name="submit" value="vetement">
              </form>

              <form action="#" method="get" enctype="multipart/form-data">
                <input style="margin-top: 1em;"  type="submit" formaction="php/view/viewArticles.php?submit=accessoire" class="btn btn-primary btn-lg btn-block"  name="submit" value="accessoire">
              </form>

              <form action="#" method="get" enctype="multipart/form-data">
                <input style="margin-top: 1em;"  type="submit" formaction="php/view/viewArticles.php?submit=chaussure" class="btn btn-primary btn-lg btn-block"  name="submit" value="chaussure">
              </form>
                <form action="#" method="get" enctype="multipart/form-data">
                    <input style="margin-top: 1em;"  type="submit" formaction="php/view/viewArticles.php?submit=Articles" class="btn btn-primary btn-lg btn-block"  name="submit" value="Articles">
                </form>
            </div>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" style="width: 900px;height: 450px;" src="src/images/blog-1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" style="width: 900px;height: 450px;" src="src/images/b2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" style="width: 900px;height: 450px;" src="src/images/sportvarious-footwear-shoe-shoes.jpg" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <!-- ROW men - women -->
        <div class="row">
          <div class="col-lg-6 col-md-8 mb-6">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="src/images/feature_1.png" alt=""></a>
              <div class="card-body">
                <div class="card-title">
                  <form action="#" method="get" enctype="multipart/form-data">
                    <input type="submit" formaction="php/view/viewArticles.php?submit=homme" class="btn btn-primary btn-lg"  name="submit" value="homme">
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-md-8 mb-6">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="src/images/feature_2.png" alt=""></a>
              <div class="card-body">
                <div class="card-title">
                  <form action="#" method="get" enctype="multipart/form-data">
                    <input type="submit" formaction="php/view/viewArticles.php?submit=homme" class="btn btn-primary btn-lg"  name="submit" value="femme">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ROW men - women -->


        <div class="row" style="margin-top: 2em;">


          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="src/images/arrivel_5.png" alt=""></a>
              <div class="card-body">
                <div style="margin-top: 3.5em;"  class="card-title">
                  <form action="#" method="get" enctype="multipart/form-data">
                    <input type="submit" formaction="php/view/viewArticles.php?submit=homme" class="btn btn-primary btn-lg"  name="submit" value="chaussure">
                  </form>
                </div>
                <p class="card-text"> </p>
              </div>
              <div class="card-footer">
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="src/images/arrivel_1.png" alt=""></a>
              <div class="card-body">
                <div class="card-title">
                    <form action="#" method="get" enctype="multipart/form-data">
                        <input type="submit" formaction="php/view/viewArticles.php?submit=homme" class="btn btn-primary btn-lg"  name="submit" value="accessoire">
                    </form>
                </div>
                <p class="card-text"></p>
              </div>
              <div class="card-footer">
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="src/images/bg-2.jpg" alt=""></a>
              <div class="card-body">
                <div style="margin-top: 4em;"  class="card-title">
                  <form action="#" method="get" enctype="multipart/form-data">
                    <input type="submit" formaction="php/view/viewArticles.php?submit=homme" class="btn btn-primary btn-lg"  name="submit" value="vetement">
                  </form>
                </div>
                <p class="card-text"></p>
              </div>
              <div class="card-footer">
              </div>
            </div>
          </div>


        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>
