if(isVisited){
    setVisited();
}else{
    setUnvisited();
}

function visited(){

    var url = "https://activdoor.000webhostapp.com/php/route.php?action=visited&spotId=";

    if(isVisited){
        url = "https://activdoor.000webhostapp.com/php/route.php?action=unVisite&spotId=";
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var obj = JSON.parse(this.responseText);
            if(obj.result == "success"){
                if(isVisited){
                    setUnvisited()
                }else{
                    setVisited();
                }
            }else{
                switch (obj.error) {
                    case "database_failure":
                        alert ("bof bof (db)");
                        break;

                    case "userId_not_defined":
                        alert ("bof bof (und)");
                        break;

                    case "not_connected":
                        alert ("bof bof (nc)");
                        break;
                }
            }
        }
    };
    xhttp.open("GET", url+spotId, true);
    xhttp.send();
}

function setVisited(){
    document.getElementById("visited_button").style.background = "grey";
    document.getElementById("visited_button").innerText = "Vous y êtes allé";
    isVisited = true;
}

function setUnvisited() {
    document.getElementById("visited_button").style.background = "limegreen";
    document.getElementById("visited_button").innerText = "J'y suis allé !";
    isVisited = false;
}