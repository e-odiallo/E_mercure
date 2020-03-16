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
    <link href="../css/comment.css" rel="stylesheet">

    <script>
        var isVisited = <?php if($isVisited){echo "true";} else {echo "false";} ?>;
        var spotId = <?=  $spot['idSpot'] ?>;
        var username = "<?php if($isConnected) echo $_SESSION['userName']; ?>";
        var lat = <?= $spot['latitude']?>;
        var long = <?= $spot['longitude']?>;
    </script>

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

        .weatherIcon{
            width: 90px;
        }


        .card{
            border-radius: 10px;
            margin-bottom: 50px;
            width: 800px;
            display: inline-block;
        }

        #new-comment{
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 30px;
            border-radius: 30px;
            padding: 30px;
            transition: all .2s ease-in-out;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }

        #comments{
            resize: none;
            height: 130px;
            border: none;
            margin-bottom: 20px;
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

        #user-comments{
            transition: opacity .25s ease-in-out;
        }

        .pp{
            border-radius: 50%;
        }

        .fixed-button {
            background-color: deepskyblue;
            color: #FFFFFF;
            border: none;
            outline: none;
            position: fixed;
            top: 0px;
            left: 30px;
            height: 60px;
            width: 60px;
            margin-top: 30px;
            border-radius: 50%;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            z-index: 9999;
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        }

        .fixed-button:hover{
            transform: scale(1.06);
            cursor: pointer;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);

        }

        #myYoutubeVideo{
            border-radius: 30px;
            width: 400px;
            border: 0;
            outline: none;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            background: white;
            margin: 20px;
            padding: 13px;
        }


        #pulse{
            width: 700px;
            padding: 15px;
            border-radius: 20px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }

        .button{
            color: white;
            border-radius: 15px;
            padding: 15px;
            padding-left: 30px;
            padding-right: 30px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        }

        .button:hover{
            transform: scale(1.05);
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            cursor: pointer;
        }

        .image-upload>input {
            display: none;
        }

        .userUploaed{
            margin-top: 50px;
            border-radius: 15px;
            padding: 15px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }


    </style>

</head>

<body class="profile-page">


<button class="fixed-button wobble" onclick="goToMap()" type="button">
    <i class="ion-plus-round"></i>
    <img style="width: 20px; width: 20px;" src="../src/img/map.png">
</button>


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

                            <p style="font-size: 11px; color: grey; padding: 15px;"><?= $nbVisitor ?> personnes y sont allée</p>

                            <div class="container">
                                <div class="row">
                                    <div class="col-sm"><p onclick="openAllSpotsType()" class="spot_button" ><?= $spot['type'] ?></p></div>
                                    <div class="col-sm"><p onclick="openAllSpotsCity()" class="spot_button"><?= $spot['ville'] ?></p></div>
                                    <div onclick="visited()" class="col-sm"><p id="visited_button" class="spot_button" style="background: limegreen; color: white;">J'y suis allé !</p></div>
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
                <div style="max-width: 100%; flex: 0 0 100%; " class="col-md-6 ml-auto mr-auto">
                    <div class="profile-tabs">
                        <ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#studio" role="tab" data-toggle="tab">
                                    <i class="material-icons">photo_library</i>
                                    Photos
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#video" role="tab" data-toggle="tab">
                                    <i class="material-icons">video_library</i>
                                    Videos
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#works" role="tab" data-toggle="tab">
                                    <i class="material-icons">comment</i>
                                    Avis
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#meteo" role="tab" data-toggle="tab">
                                    <i class="material-icons">cloud</i>
                                    Météo
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content tab-space">
                <div class="tab-pane active text-center gallery" id="studio">

                    <?php

                    if(empty($images->fetch())){
                        echo "<p>Aucune image disponible pour ce spot</p>";
                    }

                    if(!$isConnected){
                        echo '<a style="ma" href="">connectez vous pour poster une image</a>';
                    }

                    ?>

                    <div style="margin-top: 30px;" class="row text-center text-lg-left">

                        <?php


                                while($imgData = $images->fetch()){
                                    echo "<div class=\"col-lg-3 col-md-4 col-6 thumb1\">
                            
                                <img onclick=\"displayModal(this)\" class=\"img-fluid img-thumbnail spotImg\" src=\"".$imgData['url_image']."\" alt=\"\">
                            
                                </div>";
                                }


                                if($isConnected){
                                    echo "<div class=\"col-lg-3 col-md-4 col-6\">
                               
                                
                                
                                
                                                                <div class=\"image-upload\">
                                  <label for=\"file-input\">
                                        <img id=\"add-image\" class=\"img-fluid img-thumbnail\" src=\"../src/img/add_image_grey.png\" alt=\"\">
                                  </label>
                                
                                  <input id=\"file-input\" type=\"file\" />
</div>
                                
                                
                        </div>
                        
                        
                        ";
                                }

                        ?>





                    </div>
                </div>

                <div class="tab-pane text-center gallery" id="video">

                        <?php

                        if(!$isConnected){
                            echo "<a href='../html/connexion.html'>Connectez vous pour partager une vidéo de ce spot</a>";
                        }else{
                            echo " <input onchange='checkYoutubeVideo()' type=\"text\" id=\"myYoutubeVideo\" name=\"input\"
                   maxlength=\"70\" size=\"30\" placeholder=\"Entrez l'URL d'une vidéo à partager.\"></br>
                   <a href='https://www.youtube.com' target=\"_blank\" style='color: white; background: red; padding:8px; border-radius: 15px;'>Ouvrir Youtube</a>";
                        }

                        echo "<div id='youtubeVideos'>";

                        if($isConnected){
                            echo "<div  style='width: 100%;' id=\"pulse\" style=\"text-align: center\">\n".
                                "  <h4 style='margin: 30px; padding: 14px; background: deepskyblue; color: white; border-radius: 15px;'>Nouvelle vidéo</h4>  <div id=\"myYplayer\"></div>\n".
                                "\n".
                                "    <p style='margin-top: 15px;'>Souhaitez vos partager cette vidéo ?</p>\n".
                                "\n".
                                "    <div style=\"display: inline-flex;\" >\n".
                                "        <p onclick='confirmVideo()' class=\"button\" style=\"margin-right: 30px; background: limegreen\">oui</p>\n".
                                "        <p onclick='unConfirmVideo()' class=\"button\" style=\"background: red\">non</p>\n".
                                "    </div>\n".
                                "\n".
                                "</div>";
                        }

                        $count = 0;
                        $videos;
                        $JSVideos = array();

                        while($videosData = $videos->fetch()){

                            if($isConnected && $videosData['userId'] == $_SESSION['userId']){
                                echo "<div class='userUploaed' id='myVideo".$count."'> <h4>Ma vidéo</h4> <img onclick='suppVideo(this, \"".$videosData['videoId']."\" )' style='cursor: pointer; width: 40px; height: 40px; top: 0px; float: right; margin-right: 15px;' src='../src/img/red-cross.png'><div id=\"ytplayer".$count."\"></div> </div>\n";
                            }else{
                                echo "<div style=\"margin-top:55px;\" id=\"ytplayer".$count."\"></div>\n";
                            }


                            $videoScript = "
                                        player".$count." = new YT.Player('ytplayer".$count."', {
                                          height: '360',
                                          width: '640',
                                          videoId: '".$videosData['videoId']."'
                                        });
                                      ";

                            $count++;

                            array_push($JSVideos, $videoScript);
                        }

                        if($count == 0){
                            echo "<p style='margin-top: 20px;'>Aucune vidéo disponible pour ce spot.</p>";
                        }

                        echo "</div>";



                        ?>

                </div>

                <div class="tab-pane text-center gallery" id="works">
                    <?php
                    if(!$isConnected){
                        echo "<p>Vous devez être conncté pour publier un avis</p> <a href='../html/connexion.html'>Se connecter</a>";
                    } else{
                        echo "<div  id=\"new-comment\">

                        <textarea name=\"comments\" id=\"comments\" style=\"font-family:sans-serif;font-size:1.2em; width: 100%;\" placeholder=\"Rédigez un avis\"></textarea>

                        <div onclick='publishComment()' style=\"margin-bottom:0; max-width:300px; display: inline-block\" class=\"col-sm\"><p class=\"spot_button\" style=\"background: limegreen; color: white;\">Publier un avis</p></div>

                    </div>";
                    } ?>

                    <div id="user-comments">

                    <?php
                        while ($dataComment = $comments->fetch()){
                            echo "<div class=\"card card-white post\">
                        <div class=\"post-heading\">
                            <div class=\"float-left image\">
                                <img src=\"data:image/jpeg;base64,".base64_encode($dataComment['img'])."\" class=\"img-circle avatar pp\" alt=\"user profile image\">
                            </div>
                            <div class=\"float-left meta\">
                                <div style=\"margin-top: 10px;\" class=\"title h5\">
                                    <a href=\"../user/".$dataComment['userId']."\"><b>".$dataComment['prenom']." ".$dataComment['nom']."</b></a>
                                </div>
                                <h6 class=\"text-muted time\">".$dataComment['date_heure']."</h6>
                            </div>
                        </div>
                        <div class=\"post-description\">
                            <p>".$dataComment['commentContent']."</p>

                        </div> </div>";

                    }

                    ?>

                    </div>
                </div>

                <div class="tab-pane text-center gallery" id="meteo">
                    <div style="margin-top: 50px; box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);" class="forecast-container">
                        <div class="forecast">
                            <div class="forecast-header">
                                <div class="day"><?php $day=0;
                                                        echo $jours[$day];
                                                        $day++;?></div>
                            </div> <!-- .forecast-header -->
                            <div id="day1" class="forecast-content">

                            </div>
                        </div>
                        <div class="forecast">
                            <div class="forecast-header">
                                <div class="day"><?php echo $jours[$day];
                                                            $day++; ?></div>
                            </div> <!-- .forecast-header -->
                            <div id="day2" class="forecast-content">
                                <div class="forecast-icon">
                                    <img src="../src/img/weather/cloud_and_sun.png" alt="" width=48>
                                </div>
                                <div class="degree">23<sup>o</sup>C</div>
                                <small>18<sup>o</sup></small>
                            </div>
                        </div>
                        <div class="forecast">
                            <div class="forecast-header">
                                <div class="day"><?php echo $jours[$day];
                                    $day++; ?></div>
                            </div> <!-- .forecast-header -->
                            <div id="day3" class="forecast-content">
                                <div class="forecast-icon">
                                    <img src="../src/img/weather/sun.png" alt="" width=48>
                                </div>
                                <div class="degree">23<sup>o</sup>C</div>
                                <small>18<sup>o</sup></small>
                            </div>
                        </div>
                        <div class="forecast">
                            <div class="forecast-header">
                                <div class="day"><?php echo $jours[$day];
                                    $day++; ?></div>
                            </div> <!-- .forecast-header -->
                            <div id="day4" class="forecast-content">
                                <div class="forecast-icon">
                                    <img src="../src/img/weather/cloud.png" alt="" width=48>
                                </div>
                                <div class="degree">23<sup>o</sup>C</div>
                                <small>18<sup>o</sup></small>
                            </div>
                        </div>
                        <div class="forecast">
                            <div class="forecast-header">
                                <div class="day"><?php echo $jours[$day];
                                    $day++; ?></div>
                            </div> <!-- .forecast-header -->
                            <div id="day5" class="forecast-content">
                                <div class="forecast-icon">
                                    <img src="../src/img/weather/wind.png" alt="" width=48>
                                </div>
                                <div class="degree">23<sup>o</sup>C</div>
                                <small>18<sup>o</sup></small>
                            </div>
                        </div>
                        <div class="forecast">
                            <div class="forecast-header">
                                <div class="day"><?php echo $jours[$day];
                                    $day++; ?></div>
                            </div> <!-- .forecast-header -->
                            <div id="day6" class="forecast-content">
                                <div class="forecast-icon">
                                    <img src="../src/img/weather/sun.png" alt="" width=48>
                                </div>
                                <div class="degree">23<sup>o</sup>C</div>
                                <small>18<sup>o</sup></small>
                            </div>
                        </div>
                    </div>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../js/youtube.js"></script>
<script src="../js/comment.js"></script>
<script src="../js/visit.js"></script>
<script src="../js/weather.js"></script>

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
        window.open("https://activdoor.000webhostapp.com/php/route.php?action=getSpotsByType&type=<?= $spot['type']?>","_self");
    }

    function openAllSpotsCity(){
        window.open("https://activdoor.000webhostapp.com/php/route.php?action=getSpotsByCity&city=<?= $spot['ville']?>","_self");
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

<script>
    function onYouTubePlayerAPIReady() {

    <?php
        $nbVideos = count($JSVideos);

        if($isConnected){
            echo " myPlayer = new YT.Player('myYplayer', {
                                          height: '360',
                                          width: '640',
                                          videoId: ''
                   });";
        }

        for($i=0 ; $i<$nbVideos;$i++){
            echo $JSVideos[$i]."\n";
        }
    ?>

}

</script>

</body>

</html>
