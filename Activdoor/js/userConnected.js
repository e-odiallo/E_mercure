function isConnected() {

   var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //traitement reponse serveur
            alert(this.responseText);
        }else if (this.readyState == 4) {
            alert("Une erreur a ete rencontre");
            console.log(this.responseText);
            var obj = JSON.parse(this.responseText);
            var connected = obj.connected;
            console.log(connected);
            alert(this.responseText);
            if(connected == "no"){
                document.location.href="https://activdoor.000webhostapp.com/html/connexion.html"
            }else {
                document.location.href="https://activdoor.000webhostapp.com/php/profileView.php"
            }
        }
    };
    xhr.open("POST", "https://activdoor.000webhostapp.com/php/index.php?action=isConnected ", true);

}