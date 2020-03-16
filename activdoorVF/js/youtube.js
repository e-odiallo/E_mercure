var video_id;
// 2. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

document.getElementById("pulse").style.display = "none";

var myPlayer;



function checkYoutubeVideo(){
    var url = document.getElementById('myYoutubeVideo').value;
    video_id = url.split('v=')[1];
    var ampersandPosition = video_id.indexOf('&');
    if(ampersandPosition != -1) {
        video_id = video_id.substring(0, ampersandPosition);
    }

    myPlayer.loadVideoById(video_id);

    document.getElementById("pulse").style.display="block";

}


function confirmVideo(){
    var myDiv = document.getElementById("myYplayer");
    var newDiv = myDiv.cloneNode(true);
    var videos = document.getElementById("youtubeVideos").innerHTML;

    var tmp = document.createElement("div");
    tmp.appendChild(myDiv);
    var pulse = tmp.innerHTML;
    tmp.style.display = "none";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var obj = JSON.parse(this.responseText);
            var result = obj.result;
            if(result == "success"){
                document.location.reload();
            }else{

            }
        }
    };
    xhttp.open("GET", "https://activdoor.000webhostapp.com/php/route.php?action=shareVideo&videoId="+video_id+"&spotId="+spotId, true);
    xhttp.send();
}

function unConfirmVideo(){
    document.getElementById("pulse").style.display = "none";
}

function suppVideo(elem, videoId){
    var parentId = elem.parentNode.id;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var obj = JSON.parse(this.responseText);
            var result = obj.result;
            if(result == "success"){
                document.getElementById(parentId).style.display ="none";
            }else{
                alert(obj.error);
            }
        }
    };
    xhttp.open("GET", "https://activdoor.000webhostapp.com/php/route.php?action=deleteVideo&videoId="+videoId, true);
    xhttp.send();

}