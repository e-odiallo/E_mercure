
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


function publishComment(){
    var commentContent = document.getElementById('comments').value;

    var divContent = document.getElementById("user-comments").innerHTML;

    var newComment = "<div class=\"card card-white post\">\n" +
        "                    <div class=\"post-heading\">\n" +
        "                        <div class=\"float-left image\">\n" +
        "                            <img src=\"http://bootdey.com/img/Content/user_1.jpg\" class=\"img-circle avatar\" alt=\"user profile image\">\n" +
        "                        </div>\n" +
        "                        <div class=\"float-left meta\">\n" +
        "                            <div style=\"margin-top: 10px;\" class=\"title h5\">\n" +
        "                                <a href=\"#\"><b>"+username+"</b></a>\n" +
        "                            </div>\n" +
        "                            <h6 class=\"text-muted time\">A l'instant</h6>\n" +
        "                        </div>\n" +
        "                    </div>\n" +
        "                    <div class=\"post-description\">\n" +
        "                        <p>"+commentContent+"</p>\n" +
        "\n" +
        "                    </div>\n" +
        "                </div>"
    document.getElementById("user-comments").innerHTML = newComment + document.getElementById("user-comments").innerHTML;


    $.post(
        'https://activdoor.000webhostapp.com/php/route.php?action=postComment', // Le fichier cible côté serveur.
        {
            spotId : spotId, // Nous supposons que ce formulaire existe dans le DOM.
            commentContent : commentContent
        },
        callBack, // Nous renseignons uniquement le nom de la fonction de retour.
        'text' // Format des données reçues.
    );

    function callBack(response){
        var obj = JSON.parse(response);
        document.getElementById('comments').value = '';
        if(obj.result === "success"){
            //NOTHING
        }else{
            document.getElementById("user-comments").innerHTML = divContent;
            Swal.fire({
                icon: 'error',
                title: 'Oups...',
                text: 'Désolé, nous n\'avons pas pu publier votre commentaire...'
            });
        }
    }

}


function goToMap() {
    window.open("https://activdoor.000webhostapp.com","_self");
}

