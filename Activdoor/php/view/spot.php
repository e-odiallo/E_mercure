<!DOCTYPE html>

<html>

<!------ Include the above in your HEAD tag ---------->

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
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

        .spotImg {
            object-fit: cover;
            width:230px;
            height:230px;
            transition: all .2s ease-in-out;
        }


        .spotImg:hover{
            cursor: pointer;
            transform: scale(1.1);
        }


        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 9999; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform:scale(0)}
            to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }

        #add-image{
            width: 180px;
            width: 180px;
            transition: all .2s ease-in-out;
        }

        #add-image:hover{
            cursor: pointer;
            transform: scale(1.1);
        }


    </style>

</head>

<body class="profile-page">

<div class="page-header header-filter" data-parallax="true" style="background-image:url('../src/img/backgrounds/<?= $spot['type'] ?>.jpg');"></div>
<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="profile">
                        <div class="avatar">
                            <img src="../src/img/acticon_color/<?= $spot['type'] ?>.png" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                        </div>
                        <div class="name">
                            <h3 style="font-family: vice;" class="title"><?= $spot['nom'] ?></h3>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm"><p onclick="openAllSpotsType()" class="spot_button" ><?= $spot['type'] ?></p></div>
                                    <div class="col-sm"><p onclick="openAllSpotsCity()" class="spot_button"><?= $spot['ville'] ?></p></div>
                                    <div class="col-sm"><p class="spot_button" style="background: limegreen; color: white;">J'y suis allé !</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="description text-center">
                <p><?= $spot['description'] ?></p>
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

                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content tab-space">
                <div class="tab-pane active text-center gallery" id="studio">

                    <?php if(empty($images->fetch())){
                        echo "<p>Aucune image disponible pour ce spot</p>";
                    }?>

                    <div class="row text-center text-lg-left">

                        <?php


                                while($imgData = $images->fetch()){
                                    echo "<div class=\"col-lg-3 col-md-4 col-6 thumb1\">
                            
                                <img onclick=\"displayModal(this)\" class=\"img-fluid img-thumbnail spotImg\" src=\"".$imgData['url_image']."\" alt=\"\">
                            
                                </div>";
                                }



                        ?>

                        <div class="col-lg-3 col-md-4 col-6">
                                <img id="add-image" class="img-fluid img-thumbnail" src="../src/img/add_image_grey.png" alt="">
                        </div>


                    </div>
                </div>
                <div class="tab-pane text-center gallery" id="works">
                    <h3>PAGE 2</h3>
                </div>

            </div>


        </div>
    </div>
</div>

<footer class="footer text-center ">
    <img style="width: 150px;" id="logo" src="../src/img/logo.png">
</footer>


<!-- The Modal -->
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>


<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script src="../js/profile_js.js"></script>

<script>


    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.fixed-action-btn');
        var instances = M.FloatingActionButton.init(elems, options);
    });


    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.fixed-action-btn');
        var instances = M.FloatingActionButton.init(elems, {
            direction: 'top'
        });
    });


    function openAllSpotsType(){
        window.open("https://activdoor.000webhostapp.com/php/index.php?action=getSpotsByType&type=<?= $spot['type']?>","_self");
    }

    function openAllSpotsCity(){
        window.open("https://activdoor.000webhostapp.com/php/index.php?action=getSpotsByCity&city=<?= $spot['ville']?>","_self");
    }

</script>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    function displayModal(img) {
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");

        modal.style.display = "block";
        modalImg.src = img.src;
        captionText.innerHTML = img.alt;


        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    }

</script>

</body>

</html>
