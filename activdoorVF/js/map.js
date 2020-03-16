// On initialise la latitude et la longitude de Paris (centre de la carte)
var macarte = null;
var markerClusters;
var markers = [];
var spotTab;
var userLocated = false;
var userLat = 48.856614;
var userLong = 2.3522219;
var tabIcon;
var activitySelected = false;
var creatingSpot = false;

window.onload = function(){
    // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
    //getLocation();
    setMapSize();
    hideElements();
    initMap();
}

window.onresize = function () {
    setMapSize();
}

function setMapSize(){
    //On recupere la taille da la fenetre
    var width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth,
        height = window.innerHeight|| document.documentElement.clientHeight|| document.body.clientHeight;

//On adapte la taille de la carte a acelle de la fenetre
    document.getElementById('map').style.height = height.toString()+"px";
    document.getElementById('map').style.width = width.toString()+"px";
    document.getElementById('mainscreen').style.height = height.toString()+"px";
    document.getElementById('mainscreen').style.width = width.toString()+"px";
}

function initMap() {
    navigator.geolocation.getCurrentPosition(function(location) {
        //document.getElementById('lds-ripple').style.visibility = "visible";
        document.getElementById("myLoc2").className = "btn-floating blue pulsing";

        $("#myLoc2").hover(function(){
            $(this).css("box-shadow", "0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22)");
            $(this).css("transform","scale(1.2)");
        }, function(){
            $(this).css("box-shadow", "0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24)");
            $(this).css("transform","scale(1)")
        });

        userLat = location.coords.latitude;
        userLong = location.coords.longitude;
        userLocated = true;
        displayMap(13);

    }, function (error){
        document.getElementById("myLoc").className = "btn-floating white pulsing";
        document.getElementById("locMessage").className = "tooltiptext";
        document.getElementById("myLoc").style.cursor="default";
        document.getElementById("myLocIcon").src="./src/img/self-localisation-black.png";

        $("#myLoc").hover(function(){
            $(this).css("box-shadow", "0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24)");
        }, function(){
            $(this).css("background-color", "pink");
        });

        displayMap( 6);
    });
}

function displayMap(zoomLevel){
    // Créer l'objet "macarte" et l'insèrer dans  l'élément HTML qui a l'ID "map"
    document.getElementById("map").style.cursor = "default";
    macarte = L.map('map', {zoomControl: false}).setView([userLat, userLong], zoomLevel);
    markerClusters = new L.MarkerClusterGroup({
        iconCreateFunction: function (cluster) {
            return L.divIcon({
                html: cluster.getChildCount(),
                className: 'mycluster',
                iconSize: null
            });
        }
    });
    // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
    L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png', {
        // Il est toujours bien de laisser le lien vers la source des données
        attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
        minZoom: 1,
        maxZoom: 20
    }).addTo(macarte);

    macarte.on('click', function(e){
        var coord = e.latlng;
        var lat = coord.lat;
        var lng = coord.lng;
        if(creatingSpot){
            creatingSpot = false;
            window.open("./php/route.php?action=editNewSpot&latitude="+lat+"&longitude="+lng,"_self");
        }
    });
    const userLocIcon = L.icon({
        iconUrl: "./src/img/user_location.png",
        iconSize: [40, 40],
        iconAnchor: [25, 50],
        popupAnchor: [-3, -76]
    });

    const skiIcon = L.icon({
        iconUrl: "./src/img/markers_colors/ski.png",
        iconSize: [40, 56],
        iconAnchor: [25, 50],
        popupAnchor: [-3, -76],
    });

    const vttIcon = L.icon({
        iconUrl: "./src/img/markers_colors/vtt.png",
        iconSize: [40, 56],
        iconAnchor: [25, 50],
        popupAnchor: [-3, -76],
    });

    const windsurfIcon = L.icon({
        iconUrl: "./src/img/markers_colors/windsurf.png",
        iconSize: [40, 56],
        iconAnchor: [25, 50],
        popupAnchor: [-3, -76],
    });

    var runningIcon = L.icon({
        iconUrl: "./src/img/markers_colors/running.png",
        iconSize: [40, 56],
        iconAnchor: [25, 50],
        popupAnchor: [-3, -76],
    });

    const wakeBoardIcon = L.icon({
        iconUrl: "./src/img/markers_colors/wakeboard.png",
        iconSize: [40, 56],
        iconAnchor: [25, 50],
        popupAnchor: [-3, -76],
    });

    const workoutIcon = L.icon({
        iconUrl: "./src/img/markers_colors/workout.png",
        iconSize: [40, 56],
        iconAnchor: [25, 50],
        popupAnchor: [-3, -76],
    });

    const basketIcon = L.icon({
        iconUrl: "./src/img/markers_colors/basket.png",
        iconSize: [40, 56],
        iconAnchor: [25, 50],
        popupAnchor: [-3, -76],
    });

    const surfIcon = L.icon({
        iconUrl: "./src/img/markers_colors/surf.png",
        iconSize: [40, 56],
        iconAnchor: [25, 50],
        popupAnchor: [-3, -76],
    });

    const footballIcon = L.icon({
        iconUrl: "./src/img/markers_colors/football.png",
        iconSize: [40, 56],
        iconAnchor: [25, 50],
        popupAnchor: [-3, -76],
    });

    const skateboardIcon = L.icon({
        iconUrl: "./src/img/markers_colors/skateboard.png",
        iconSize: [40, 56],
        iconAnchor: [25, 50],
        popupAnchor: [-3, -76],
    });

    tabIcon = { "ski" : skiIcon,
        "windsurf" : windsurfIcon,
        "VTT": vttIcon,
        "running" : runningIcon,
        "wakeboard" : wakeBoardIcon,
        "workout" : workoutIcon,
        "basket" : basketIcon,
        "surf" : surfIcon,
        "football" : footballIcon,
        "skateboard" : skateboardIcon
    };

    if(userLocated){
        markerUser = L.marker([userLat, userLong], {icon: userLocIcon});
        markerUser.bindPopup("<b>Vous êtes ici</b>");
        markerUser.on('mouseover', function (e) {
            this.openPopup();
        });
        markerUser.on('mouseout', function (e) {
            this.closePopup();
        });
        markerUser.on('click',function (e) {
            goToCurrentLocation();
        })
        markerUser.addTo(macarte);
    }

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            spotTab = JSON.parse(this.responseText);
            showMarkers("all");
        }
    };
    xhttp.open("GET", "https://activdoor.000webhostapp.com/php/route.php?action=getAllSpots&json=true", true);
    xhttp.send();
    showElements();
    macarte.addLayer(markerClusters);
}

function removeMarkers(markerList, cluster, activity){
    for(i in markerList){
        cluster.removeLayer(markerList[i]);
    }
}

function showMarkers(type){
    macarte.addLayer(markerClusters);
    for (i in spotTab) {
        markers[i] = L.marker([spotTab[i].latitude, spotTab[i].longitude], {icon: tabIcon[spotTab[i].type]});
        markers[i].myCustomId = spotTab[i].idSpot;
        markers[i].type=spotTab[i].type;
        markers[i].on('click', markerClick);
        if(type === "all" || spotTab[i].type === type) markerClusters.addLayer(markers[i]);
    }
}

function markerClick(e){
    window.open("./spot/"+e.target.myCustomId,"_self");
}

function hideElements(){
    document.getElementById('nav').style.visibility = "hidden";
    document.getElementById('fixed-action-btn').style.visibility = "hidden";
    document.getElementById('loader').style.visibility = "hidden";
    document.getElementById("activity").style.visibility = "hidden";
    document.getElementById("bottom").style.visibility = "hidden";
    document.getElementById("zoomButtons").style.visibility = "hidden";

}

function showElements(){
    document.getElementById("zoomButtons").style.visibility = "visible";
    document.getElementById('nav').style.visibility = "visible";
    document.getElementById('fixed-action-btn').style.visibility = "visible";
    document.getElementById('bottom').style.visibility = "visible";
    document.getElementById('centerLogo').style.visibility = "hidden";
    document.getElementById("activity").style.visibility = "visible";
    document.getElementById("activity").style.animation = "sideApparition 1s";
    document.getElementById("fixed-action-btn").style.animation = "sideApparition 1s";
    document.getElementById("nav").style.animation = "topApparition 1s";
}

function goToCurrentLocation(){
    if(userLocated){
        macarte.flyTo(new L.LatLng(userLat, userLong), 13);
    }else{
        $('.error').fadeIn(400).delay(3000).fadeOut(400);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems, options);
});

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.menu');
    var instances = M.FloatingActionButton.init(elems, {
        direction: 'bottom'
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.activity');
    var instances = M.FloatingActionButton.init(elems, {
        direction: 'top'
    });
});

function addSpot(){
    //document.getElementById('loader').style.visibility = "visible";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            obj = JSON.parse(this.responseText);
            if(obj.connected ==="yes"){
                document.getElementById("menuButton").src="./src/img/cross.png";
                document.getElementById("map").style.cursor = "url(./src/img/markers/empty.png) 10 30, auto"
                creatingSpot = true;
            }else{
                window.open("./html/connexion.html","_self");
            }
        }
    };
    xhttp.open("GET", "https://activdoor.000webhostapp.com/php/route.php?action=isConnected", true);
    xhttp.send();
}

function selectedActivity(activity){
    activitySelected = true;
    document.getElementById("main-button").src="./src/img/cross.png";
    removeMarkers(markers, markerClusters);
    showMarkers(activity);
}

function resetActivity(){
    if(activitySelected){
        removeMarkers(markers, markerClusters);
        showMarkers("all");
        activitySelected = false;
        document.getElementById("main-button").src="./src/img/selection.png";
    }
}

function discard() {
    if(creatingSpot){
        creatingSpot = false;
        document.getElementById("menuButton").src="./src/img/menu.png";
        document.getElementById("map").style.cursor = "default";
    }
}