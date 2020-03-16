<!DOCTYPE html>

<html>

<!------ Include the above in your HEAD tag ---------->

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesgeet" href="https://rawgit.com/creativetimofficial/material-kit/master/assets/css/material-kit.css">
    <link href="../css/profile-style.css" rel="stylesheet">
    <link href="../css/comment.css" rel="stylesheet">

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

        .weatherIcon{
            width: 90px;
        }

        .card{
            border-radius: 10px;
            margin-bottom: 50px;
            max-width: 800px;
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
            z-index: 999999; /* Sit on top */
            padding-top: 200px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */

        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            height: 180px;
            border: 1px solid #888;
            max-width: 30%;
            border-radius: 20px;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            fonhttps://www.w3schools.com/t-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .nav-pills .nav-item .nav-link.active {
            color: #fff;
            background-color: limegreen;
            box-shadow: 0 5px 20px 0 rgba(0,0,0,.2), 0 13px 24px -11px rgba(156,39,176,.6);
        }



        .cel{
            width: 600px;
            display: inline-block;
            margin: 14px;
            padding: 20px;
            background: white;
            border-radius: 20px;
            height: 90px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        }

        .cel:hover{
            cursor: pointer;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }

        .activity_icon{
            width: 50px;
            height:50px;
            border-radius: 100px;
            float: left;
        }

        .localisation_icon{
            width:9px;
            height:9px;
            float: right;
            margin-top: 3px;
        }


        .localisation{
            float: right;
            font-size: 12px;
            margin-right: 5px;
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
                            <img src="data:image/jpeg;base64,<?php


                            echo base64_encode($profil_pic);

                            ?>" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                        </div>
                        <div class="name">
                            <h3 style="font-family: vice;" class="title"><?= $lastname." ".$name ?></h3>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm"><p style="padding-right: 50px;display: inline-block;padding-left: 50px;" class="spot_button" ><?= $city ?></p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="description text-center">
                <p>Informations</p>
            </div>
            <div class="row">
                <div style="max-width: 100%;flex: 0 0 100%;" class="col-md-6 ml-auto mr-auto">
                    <div class="profile-tabs">
                        <ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link active" href="#visite" role="tab" data-toggle="tab">
                                    <i class="material-icons">beenhere</i>
                                    visités
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#studio" role="tab" data-toggle="tab">
                                    <i class="material-icons">photo_library</i>
                                    Photos
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#video" role="tab" data-toggle="tab">
                                    <i class="material-icons">video_library</i>
                                    Vidéos
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#avis" role="tab" data-toggle="tab">
                                    <i class="material-icons">comment</i>
                                    Avis
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content tab-space">

                <div class="tab-pane active text-center gallery" id="visite">

                    <?php

                    $count = 0;

                    while($data = $visited->fetch()){

                            ?>

                            <div class="cel" onclick="openSpot('<?= $data['idSpot']?>')">
                                <img class="activity_icon" src="../src/img/acticon_color/<?= $data['type'] ?>.png">
                                <h3 style="font-size: 20px; margin-top: 10px;"><?= $data['nom'] ?></h3>
                                <img class="localisation_icon" src="../src/img/localisation.png">
                                <p class="localisation"><?= $data['ville'] ?>, <?= $data['pays']?></p>
                            </div>


                            <?php

                            $count++;

                        }
                        $visited->closeCursor();

                    if($count == 0){
                        echo "<p>pas de spots</p>";
                    }

                    ?>

                </div>

                <div class="tab-pane text-center gallery" id="studio">
                    <div style="margin-top: 30px;" class="row text-center text-lg-left">

                            <?php

                            $count = 0;

                            while($imgData = $images->fetch()){
                                echo "<div class=\"col-lg-3 col-md-4 col-6 thumb1\">
                            
                                <img onclick=\"displayModal(this)\" class=\"img-fluid img-thumbnail spotImg\" src=\"".$imgData['url_image']."\" alt=\"\">
                            
                                </div>";

                                $count++;

                            }


                            ?>

                        </div>

                    <?php

                    if($count == 0){
                        echo "<p>Aucune images mises en ligne</p>";
                    }

                    ?>
                </div>

                <div class="tab-pane text-center gallery" id="video">

                    <?php


                    echo "<div id='youtubeVideos'>";

                    $count = 0;
                    $videos;
                    $JSVideos = array();

                    while($videosData = $videos->fetch()){
                        echo "<div style=\"margin-top:55px;\" id=\"ytplayer".$count."\"></div>\n";

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
                        echo "<p style='margin-top: 20px;'>Aucune vidéo publiées par ...</p>";
                    }

                    echo "</div>";



                    ?>

                </div>

                <div class="tab-pane text-center gallery" id="avis">



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

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <p style="margin-bottom: 20px;margin-top: 20px;">Vous devez être connécté pour effectuer cette action</p>
        <div>
            <div style="float: left; width: 50%;"><p id="connexion-button" class="spot_button" style="background: limegreen; color: white; float: right; margin-right: 10px; width: 150px;">Se connecter</p></div>
            <div style="float: right;width: 50%;"><p id="back-button" class="spot_button" style="background: red; color: white;float: left; margin-left: 10px; width: 150px;">Retour</p> </div>
        </div>
    </div>

</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("new-comment");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    const connexion = document.getElementById("connexion-button");
    const back = document.getElementById("back-button");

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    };
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {

        }
    };

    connexion.onclick = function(){
        window.open("../html/connexion.html","_self");
    };

    back.onclick = function () {
        modal.style.display = "none";
    };


</script>


<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script src="../js/profile_js.js"></script>
<script src="js/addons/rating.js"></script>

<script>

    var d = new Date();



    getWeatherForecast();

    function getWeatherForecast() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var obj = JSON.parse(this.responseText);

                var day = 1;
                var object;

                for(i in obj.list){

                    if(i == 0){
                        document.getElementById("day1").innerHTML= "<div class=\"forecast-icon\">\n" +
                            "                                    <img class=\"weatherIcon\" src=\"http://openweathermap.org/img/wn/"+obj.list[i].weather[0].icon+"@2x.png\" alt=\"\" width=28>\n" +
                            "                                </div>\n" +
                            "                                <div class=\"degree\">"+obj.list[i].main.temp_max+"<sup>o</sup>C</div>\n" +
                            "                                <small>18<sup>"+obj.list[i].main.temp_min+"</sup></small>";
                        day++;
                    }

                    if(obj.list[i].dt_txt.includes("12:00:00")){
                        var div = "day"+day.toString();
                        document.getElementById(div).innerHTML= "<div class=\"forecast-icon\">\n" +
                            "                                    <img class=\"weatherIcon\" src=\"http://openweathermap.org/img/wn/"+obj.list[i].weather[0].icon+"@2x.png\" alt=\"\" width=28>\n" +
                            "                                </div>\n" +
                            "                                <div class=\"degree\">"+obj.list[i].main.temp_max+"<sup>o</sup>C</div>\n" +
                            "                                <small>"+obj.list[i].main.temp_min+"<sup>o</sup></small>";

                        day++;
                    }
                    object = obj.list[i];
                }

                console.log("here I am");

                if(day == 5){
                    day++;
                    var div = "day"+day.toString();
                    document.getElementById(div).innerHTML= "<div class=\"forecast-icon\">\n" +
                        "                                    <img class=\"weatherIcon\" src=\"http://openweathermap.org/img/wn/"+object.weather[0].icon+"@2x.png\" alt=\"\" width=28>\n" +
                        "                                </div>\n" +
                        "                                <div class=\"degree\">23<sup>o</sup>C</div>\n" +
                        "                                <small>18<sup>o</sup></small>";
                }

            }
        };
        xhttp.open("GET", "https://api.openweathermap.org/data/2.5/forecast?lat=35&lon=13&lang=fr&units=metric&appid=88662f94e1d8c03cadaa77322e4835eb", true);
        xhttp.send();
    }
</script>

<script>

    const newCom = document.getElementById("comments");
    const newComDiv = document.getElementById("new-comment");

    newCom.addEventListener('focus', (event) => {
        newComDiv.style.boxShadow =' 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22)';
        newComDiv.style.transform ='scale(1.05)';
    });

    newCom.addEventListener('blur', (event) => {
        newComDiv.style.boxShadow ='0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24)';
        newComDiv.style.transform ='scale(1)';
    });



</script>

<script>

    var video_id
    // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    document.getElementById("pulse").style.display = "none";

    var myPlayer;

    function onYouTubePlayerAPIReady() {

        <?php
        $nbVideos = count($JSVideos);

        for($i=0 ; $i<$nbVideos;$i++){
            echo $JSVideos[$i]."\n";
        }
        ?>

    }


</script>

<script>

    function openSpot(spotId){
        window.open("https://activdoor.000webhostapp.com/spot/"+spotId,"_self");
    }

</script>

</body>

</html>