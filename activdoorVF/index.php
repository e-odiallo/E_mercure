<?php session_start();
    $connected = false;
    if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] ) {
        if (isset($_SESSION['userId'])) {
            $connected = true;
        }
    }
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Nous chargeons les fichiers CDN de Leaflet. Le CSS AVANT le JS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
    <style type="text/css">

        @font-face {
            font-family: vice;
            src: url("./src/fonts/vice.otf");
        }

        body{
            font-family: vice;


        }

        #map { /* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
            height: 500px;
        }


        #map:hover{

        }

        #mainscreen{
            position: absolute;
            top: 0;
            left: 0;

        }

        h1{
            z-index: 10;
            color: red;
            background: rgba(255, 255, 255, 0);
        }

        #barRecherche{

            border-radius: 30px;
            width: 400px;
            margin: 0 auto;
            margin-top: 30px;
        }


        #search{
            padding: 4px;
            border-radius: 30px;
            width: 100%;
            border: 0;
            outline: none;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            background: white;

        }



        .bottom_button{
            width:50px;
            height:50px;
            position: fixed;
            bottom: 0px;
            right: 0px;
            margin: 50px;
            z-index: 200;position: absolute;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            border-radius: 50px;
            transition: all .2s ease-in-out;
        }

        #infobutton {
            margin-bottom: 120px;
        }

        #addbutton{
            margin-bottom: 190px;
        }

        .bottom_button:hover{
            transform: scale(1.1);
        }

        .mycluster {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            background-color: #3498db;
            color: white;
            text-align: center;
            font-size: 20px;
            line-height: 40px;
            margin-top: -20px;
            margin-left: -20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }

        #fixed-action-btn{
            margin-bottom: 15px;
            margin-right: 20px;
            top:30px;
        }


        #fixed-action-btn activity{
            margin-bottom: 15px;
            margin-right: 20px;
            bottom:30px;
        }

        #logo{
            width:150px;
            margin-bottom: 25px;
        }

        input[type='text'] { font-size: 18px; font-family: vice; text-align: center;  }


        .lds-ripple {

            width: 94px;
            height: 94px;
            position: absolute;
            top:0;
            bottom: 0;
            left: 0;
            right: 0;

            margin: auto;
        }
        .lds-ripple div {
            position: absolute;
            border: 4px solid #000;
            opacity: 1;
            border-radius: 50%;
            animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
        }
        .lds-ripple div:nth-child(2) {
            animation-delay: -0.5s;
        }
        @keyframes lds-ripple {
            0% {
                top: 28px;
                left: 28px;
                width: 0;
                height: 0;
                opacity: 1;
            }
            100% {
                top: -1px;
                left: -1px;
                width: 58px;
                height: 58px;
                opacity: 0;
            }
        }


        .lds-dual-ring {
            display: inline-block;
            width: 120px;
            height: 120px;
            position: absolute;
            top:0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 3000;

            margin: auto;
        }
        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 100px;
            height: 100px;
            margin: 1px;
            border-radius: 50%;
            border: 10px solid deepskyblue;
            border-color: deepskyblue transparent deepskyblue transparent;
            animation: lds-dual-ring 1.2s linear infinite;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);


        }
        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }


        @keyframes sideApparition {
            0% {

                transform: translateX(150px) rotate(30deg);
            }
            100% {
                transform: translateX(0px);
            }
        }

        @keyframes topApparition {
            0% {

                transform: translateY(-150px);
            }
            100% {
                transform: translateX(0px);
            }
        }

        .error {
            width:200px;
            height:20px;
            height:auto;
            position:absolute;
            left:50%;
            margin-left:-100px;
            bottom:10px;
            background-color: #383838;
            color: #F0F0F0;
            font-family: Calibri;
            font-size: 20px;
            padding:10px;
            text-align:center;
            border-radius: 2px;
            -webkit-box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
            -moz-box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
            box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
        }


        #in{
            position: absolute;
            top: 40px;
            left: 40px;
            width: 40px;
            height: 40px;
            padding-right: 10px;
            padding-left: 16px;
            font-size: 20px;
            z-index: 2000;
            background-color: #EEE;
            border-radius: 50%;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            cursor:pointer;
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        }
        #out{
            position: absolute;
            top: 90px;
            left: 40px;
            width: 40px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            padding-right: 10px;
            padding-left: 16px;
            padding-bottom: 17px;
            height: 40px;
            z-index: 2000;
            background-color: #EEE;
            font-size: 20px;
            padding-top: -20px;
            border-radius: 50%;
            cursor:pointer;
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        }

        #myLoc2{
            position: absolute;
            top: 145px;
            left: 40px;
            width: 40px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            padding-right: 10px;
            padding-left: 16px;
            padding-bottom: 17px;
            height: 40px;
            z-index: 2000;
            background-color: #EEE;
            font-size: 20px;
            padding-top: -20px;
            border-radius: 50%;
            cursor:pointer;
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        }



        #currentLoc{
            position: absolute;
            top: 150px;
            left: 40px;
        }


        #out:hover{
            transform: scale(1.1);
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }

        #in:hover{
            transform: scale(1.1);
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }

        .bigButton{
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        }

        .bigButton:hover{
            transform: scale(1.2);
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }

        .littleButton{
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        }

        .littleButton:hover{
            transform: scale(1.1);
            box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        }

        .pulsing{
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }

        #myLoc{
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        }



    </style>

    <title>Activdoor</title>
</head>
<body>
<div id="mainscreen">

    <div class="lds-ripple"><div></div><div></div></div>

    <div id="loader" style="visibility:hidden;" class="lds-dual-ring"></div>

    <div id="centerLogo" style="text-align:center; z-index: 200;position: absolute; width:300px;height:70px; bottom: 0; top:0; right:0; left:0 ;margin:auto;text-align:center;">
        <img style="width:250px; margin-top: 70px;" src="./src/img/logo.png">
    </div>

    <div id="nav" style="visibility:hidden; text-align:center; z-index: 200;position: absolute; top: 0px; width: 100%;text-align:center;">
        <form id="barRecherche" action="php/route.php?">

            <input type='hidden' name='action' value='search' />
            <input type='hidden' name='filter' value='city' />


                <input autocomplete="off" type="text" id="search" name="input"
                       maxlength="40" size="10" placeholder="Recherchez une ville">


        </form>
    </div>

    <div id="map" style="z-index: 1; position: absolute; top: 0px; left: 0px;">

    </div>

    <div id="fixed-action-btn" style="visibility:hidden; " class="fixed-action-btn menu">
        <a class="btn-floating btn-large red bigButton">
            <i onclick="discard()" class="large material-icons"><img id="menuButton" style="height: 30px; width:30px;" src="./src/img/menu.png"></i>
        </a>
        <ul id="menu-list">
            <?php if($connected) echo "<li><a onclick=\"logout()\" class=\"btn-floating btn--blue darken-1\"><i class=\"material-icons\"><img style=\"height: 25px; width:25px;\" src=\"./src/img/exit.png\"></i></a></li>"?>
            <li><a class="btn-floating green"><i class="material-icons"><img style="height: 35px; width:35px;" src="./src/img/info-transparent.png"></i></a></li>
            <li><a onclick="addSpot()" name="user-but"class="btn-floating red"><i class="material-icons"><img style="height: 25px; width:25px;;" src="./src/img/add-transparent.png"></i></a></li>
            <li><a onclick="userIsConnected()" class="btn-floating yellow darken-1"><i class="material-icons"><img style="height: 25px; width:25px;" src="./src/img/user-transparent.png"></i></a></li>
        </ul>
    </div>

    <div style="visibility:hidden; margin-bottom: 15px; margin-right: 19px;" id="activity" class="fixed-action-btn activity">
        <a id="bigButton" onclick="resetActivity()" class="btn-floating btn-large blue bigButton">
            <i class="large material-icons"><img id="main-button" style="height: 30px; width:30px;" src="./src/img/selection.png"></i>
        </a>
        <ul>
            <li><a onclick="selectedActivity('windsurf')" class="btn-floating bgwhite sub-button littleButton"><i class="material-icons"><img style="height: 40px; width:40px;margin-top: -5px;" src="./src/img/acticon_color/windsurf.png"></i></a></li>
            <li><a onclick="selectedActivity('workout')" class="btn-floating yellow darken-1 sub-button littleButton"><i class="material-icons"><img style="height: 40px; width:40px;margin-top: -5px;" src="./src/img/acticon_color/workout.png"></i></a></li>
            <li><a onclick="selectedActivity('skateboard')" class="btn-floating green sub-button littleButton"><i class="material-icons"><img style="height: 40px; width:40px;margin-top: -5px;" src="./src/img/acticon_color/skateboard.png"></i></a></li>
            <li><a onclick="selectedActivity('ski')" class="btn-floating green sub-button littleButton"><i class="material-icons"><img style="height: 40px; width:40px;margin-top: -5px;" src="./src/img/acticon_color/ski.png"></i></a></li>
            <li><a onclick="selectedActivity('basket')" class="btn-floating green sub-button"><i class="material-icons"><img style="height: 40px; width:40px;margin-top: -5px;" src="./src/img/acticon_color/basket.png"></i></a></li>
            <li><a onclick="selectedActivity('running')" class="btn-floating green sub-button"><i class="material-icons"><img style="height: 40px; width:40px;margin-top: -5px;" src="./src/img/acticon_color/running.png"></i></a></li>
            <li><a onclick="selectedActivity('football')" class="btn-floating green sub-button"><i class="material-icons"><img style="height: 40px; width:40px;margin-top: -5px;" src="./src/img/acticon_color/football.png"></i></a></li>
            <li><a onclick="selectedActivity('surf')" class="btn-floating green sub-button"><i class="material-icons"><img style="height: 40px; width:40px;margin-top: -5px;" src="./src/img/acticon_color/surf.png"></i></a></li>
            <li><a onclick="selectedActivity('VTT')" class="sub-button btn-floating green"><i class="material-icons"><img style="height: 40px; width:40px;margin-top: -5px;" src="./src/img/acticon_color/VTT.png"></i></a></li>
        </ul>
    </div>

    <div id="bottom" style="visibility:hidden; text-align:center; z-index: 200;position: absolute; bottom: 0px; width: 100%;text-align:center;">
        <img id="logo" src="./src/img/logo.png">
    </div>

    <div style="visibility:hidden; " id="zoomButtons">
        <div onclick="zoomIn()" class="zoomControl" id = 'in'><p style="height: 20px; margin-top: 6px;">+</p></div>
        <div onclick="zoomOut()" class="zoomControl" id = 'out'><p style="height: 20px; margin-top: 6px;">-</p></div>
        <div onclick="goToCurrentLocation()" class="zoomControl" id = 'myLoc2'> <img  id="myLocIcon" style="height: 32px; width:32px;margin-top:3px;margin-left: -12px;" src="./src/img/self-localisation.png"></div>
        <div id="currentLoc" class="tooltip">
            <a onclick="goToCurrentLocation()" id="myLoc" class="btn-floating white pulsing">
            <i class="material-icons" >
                <img id="myLocIcon" style="height: 35px; width:35px;margin-top:2px;" src="./src/img/self-localisation.png">
            </i>

            </a>
            <span id="locMessage">Activdoor n'a pas l'autorisation pour connaitre votre position</span>
        </div>
    </div>

</div>

<script>


    document.getElementById("barRecherche").addEventListener("submit", function (event) {
        var queryString = document.getElementById("search").value;
        goToLocation(queryString);
        event.preventDefault();
    });

    function goToLocation(location){
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var obj = JSON.parse(this.responseText);
                var res = obj.results[0].geometry;
                var lat = res.lat;
                var lng = res.lng;
                macarte.flyTo(new L.LatLng(lat, lng), 14);
            }
        };
        xhr.open("GET", "https://api.opencagedata.com/geocode/v1/json?q="+location+"&key=35ffbef3106a4d99926dd52bcbc6aa75", true);
        xhr.send();
    }





    function userIsConnected() {

        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //traitement reponse serveur
                var obj = JSON.parse(this.responseText);
                var connected = obj.connected;
                console.log(connected);
                if(connected == "no"){
                    document.location.href="https://activdoor.000webhostapp.com/html/connexion.html"
                }else {
                    document.location.href="https://activdoor.000webhostapp.com/myProfile";
                }
            }
        };
        xhr.open("GET", "https://activdoor.000webhostapp.com/php/route.php?action=isConnected ", true);
        xhr.send();

    }

    function logout(){
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //traitement reponse serveur
                var obj = JSON.parse(this.responseText);
                var logout = obj.logout;
                if(logout == "ok"){
                    document.location.href="https://activdoor.000webhostapp.com/"
                }
            }
        };
        xhr.open("GET", "https://activdoor.000webhostapp.com/php/route.php?action=logout", true);
        xhr.send();
    }

    function zoomIn(){
        macarte.setZoom(macarte.getZoom()+1);
    }

    function zoomOut(){
        macarte.setZoom(macarte.getZoom()-1);
    }

</script>

<!-- Fichiers Javascript -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
<script src="./js/map.js"></script>
<script type='text/javascript' src='https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js'></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        $('.btn-floating').tooltip({ delay: { "show": 500, "hide": 100 } })
    })

</script>


<script src="https://cdn.jsdelivr.net/npm/places.js@1.17.0"></script>




<script>
    (function() {
        var placesAutocomplete = places({
            appId: 'plULMQ62VW14',
            apiKey: '34edc3988a26089a658358fef1022077',
            container: document.querySelector('#search')
        });

        var $address = document.querySelector('#address-value')
        placesAutocomplete.on('change', function(e) {
            goToLocation(e.suggestion.value);
        });

    })();
</script>

<div style="text-align: right;position: fixed;z-index:9999999;bottom: 0;width: auto;right: 1%;cursor: pointer;line-height: 0;display:block !important;"><a title="Hosted on free web hosting 000webhost.com. Host your own website for FREE." target="_blank" href="https://www.000webhost.com/?utm_source=000webhostapp&utm_campaign=000_logo&utm_medium=website&utm_content=footer_img"><img src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png" alt="www.000webhost.com"></a></div><script>function getCookie(t){for(var e=t+"=",n=decodeURIComponent(document.cookie).split(";"),o=0;o<n.length;o++){for(var i=n[o];" "==i.charAt(0);)i=i.substring(1);if(0==i.indexOf(e))return i.substring(e.length,i.length)}return""}getCookie("hostinger")&&(document.cookie="hostinger=;expires=Thu, 01 Jan 1970 00:00:01 GMT;",location.reload());var wordpressAdminBody=document.getElementsByClassName("wp-admin")[0],notification=document.getElementsByClassName("notice notice-success is-dismissible"),hostingerLogo=document.getElementsByClassName("hlogo"),mainContent=document.getElementsByClassName("notice_content")[0];if(null!=wordpressAdminBody&&notification.length>0&&null!=mainContent){var googleFont=document.createElement("link");googleFontHref=document.createAttribute("href"),googleFontRel=document.createAttribute("rel"),googleFontHref.value="https://fonts.googleapis.com/css?family=Roboto:300,400,600",googleFontRel.value="stylesheet",googleFont.setAttributeNode(googleFontHref),googleFont.setAttributeNode(googleFontRel);var css="@media only screen and (max-width: 576px) {#main_content {max-width: 320px !important;} #main_content h1 {font-size: 30px !important;} #main_content h2 {font-size: 40px !important; margin: 20px 0 !important;} #main_content p {font-size: 14px !important;} #main_content .content-wrapper {text-align: center !important;}} @media only screen and (max-width: 781px) {#main_content {margin: auto; justify-content: center; max-width: 445px;}} @media only screen and (max-width: 1325px) {.web-hosting-90-off-image-wrapper {position: absolute; max-width: 95% !important;} .notice_content {justify-content: center;} .web-hosting-90-off-image {opacity: 0.3;}} @media only screen and (min-width: 769px) {.notice_content {justify-content: space-between;} #main_content {margin-left: 5%; max-width: 445px;} .web-hosting-90-off-image-wrapper {position: absolute; right: 0; display: flex; padding: 0 5%}} .web-hosting-90-off-image {max-width: 90%;} .content-wrapper {z-index: 5} .notice_content {display: flex; align-items: center;} * {-webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;} .upgrade_button_red_sale{box-shadow: 0 2px 4px 0 rgba(255, 69, 70, 0.2); max-width: 350px; border: 0; border-radius: 3px; background-color: #ff4546 !important; padding: 15px 55px !important;  margin-bottom: 48px; font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 600; color: #ffffff;} .upgrade_button_red_sale:hover{color: #ffffff !important; background: #d10303 !important;}",style=document.createElement("style"),sheet=window.document.styleSheets[0];style.styleSheet?style.styleSheet.cssText=css:style.appendChild(document.createTextNode(css)),document.getElementsByTagName("head")[0].appendChild(style),document.getElementsByTagName("head")[0].appendChild(googleFont);var button=document.getElementsByClassName("upgrade_button_red")[0],link=button.parentElement;link.setAttribute("href","https://www.hostinger.com/hosting-starter-offer?utm_source=000webhost&utm_medium=panel&utm_campaign=000-wp"),link.innerHTML='<button class="upgrade_button_red_sale">TRANSFER NOW</button>',(notification=notification[0]).setAttribute("style","padding-bottom: 0; padding-top: 5px; background-color: #313134; background-size: cover; background-repeat: no-repeat; color: #ffffff; border-color: #ff123a; border-width: 8px;"),notification.className="notice notice-error is-dismissible";var mainContentHolder=document.getElementById("main_content");mainContentHolder.setAttribute("style","padding: 0;"),hostingerLogo[0].remove();var h1Tag=notification.getElementsByTagName("H1")[0];h1Tag.className="000-h1",h1Tag.innerHTML="Black Friday Sale",h1Tag.setAttribute("style",'color: white;  margin-top: 48px; font-family: "Roboto", sans-serif; font-size: 48px; font-weight: 600;');var h2Tag=document.createElement("H2");h2Tag.innerHTML="Get 90% Off!",h2Tag.setAttribute("style",'color: white; margin: 45px 0; font-family: "Roboto", sans-serif; font-size: 80px; font-weight: 600;'),h1Tag.parentNode.insertBefore(h2Tag,h1Tag.nextSibling);var paragraph=notification.getElementsByTagName("p")[0];paragraph.innerHTML="Don’t miss the opportunity to enjoy up to <strong>4x WordPress Speed, Free SSL and all premium features</strong> available for a fraction of the price!",paragraph.setAttribute("style",'font-family: "Roboto", sans-serif; font-size: 18px; font-weight: 300;');var list=notification.getElementsByTagName("UL")[0];list.remove();var org_html=mainContent.innerHTML,new_html='<div class="content-wrapper">'+mainContent.innerHTML+'</div><div class="web-hosting-90-off-image-wrapper"><img class="web-hosting-90-off-image" src="https://cdn.000webhost.com/000webhost/promotions/black-friday-2019-wordpress.png"></div>';mainContent.innerHTML=new_html;var saleImage=mainContent.getElementsByClassName("web-hosting-90-off-image")[0]}</script></body>
</html>