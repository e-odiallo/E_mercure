<!DOCTYPE html>

<html>

<!------ Include the above in your HEAD tag ---------->

<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesgeet" href="https://rawgit.com/creativetimofficial/material-kit/master/assets/css/material-kit.css">
    <link href="../css/profile-style.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: vice;
            src: url("../src/fonts/vice.otf");
        }

        body{
            text-align: center;
            font-family: vice;
            background: rgba(150,150,150,0.1);
        }

        .bounce.active{
            color: #fff;
            background-color: green;
            box-shadow: 0 5px 20px 0 rgba(0,0,0,.2), 0 13px 24px -11px rgba(156,39,176,.6);
        }
    </style>

</head>

<body class="profile-page">

<div class="page-header header-filter" data-parallax="true" style="background-image:url('../src/img/backgrounds/windsurf.jpg');"></div>
<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="profile">
                        <div class="avatar">
                            <img src="../src/img/user.png" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                        </div>
                        <div class="name">
                            <h3 style="font-family: vice;" class="title"><?php echo $name.'  '.$lastnme?></h3>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm"><p class="spot_button"</p><?php echo $city ?></div>

                                </div>
                                <div class="row">
                                    <div class="col-sm"><p class="spot_button" style="background: limegreen; color: white;">Modifier le profile </p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="description text-center">
            </div>
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="profile-tabs">
                        <ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#studio" role="tab" data-toggle="tab">
                                    <i class="material-icons">photo_library</i>
                                    Photos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#works" role="tab" data-toggle="tab">
                                    <i class="material-icons">comment</i>
                                    Avis
                                </a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link bounce" href="#favorite" role="tab" data-toggle="tab">
                                    <i class="material-icons">done</i>
                                    Done
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content tab-space">
                <div class="tab-pane active text-center gallery" id="studio">
                    <h3>PAGE 1</h3>
                </div>
                <div class="tab-pane text-center gallery" id="works">
                    <h3>PAGE 2</h3>
                </div>
                <div class="tab-pane text-center gallery" id="favorite">
                    <h3>PAGE 3</h3>
                </div>
            </div>


        </div>
    </div>
</div>

<footer class="footer text-center ">
    <img style="width: 150px;" id="logo" src="../src/img/logo.png">
</footer>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script src="../js/profile_js.js"></script>
</body>

</html>