function logButton() {

    //recuperation dnnés de connexion
    var email = document.getElementById("email").value ;
    var pwd = document.getElementById("password").value ;
    var params = 'email='+email+'&passeword ='+pwd ;


    //formalisation des données
    var data =  new FormData();
    data.append("password",pwd);
    data.append("email",email);

    //desactivation formulaire
    document.getElementById("loginForm").addEventListener("submit", function (event) {
        event.preventDefault();
    })

    //Requete POST AJAX
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //traitement reponse serveur
            //alert(this.responseText);
            var obj = JSON.parse(this.responseText);
            var login = obj.login;

            var userId = obj.userId ;
            if(login === "ok"){
                //redirection
                document.location.href="https://activdoor.000webhostapp.com/myProfile";
            }else{
                if(obj.error === "password"){
                    setRedField("password");
                }else{
                    setRedField("email");
                }
            }

        }
    };
    xhttp.open("POST", "https://activdoor.000webhostapp.com/php/route.php?action=login ", true);
    xhttp.send(data);
}

function setRedField(fieldId, error){
    document.getElementById(fieldId).style.boxShadow="0 3px 6px rgba(255,100,100,0.45), 0 3px 6px rgba(255,50,50,0.22)";
}