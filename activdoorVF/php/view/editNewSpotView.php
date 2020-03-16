<!DOCTYPE html>

<html>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="../css/newSpot-style.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
</head>


<body>
<div class="wrapper fadeInDown">

    <h1 style="margin: 70px; font-size: 65px;">Nouveau Spot</h1>

    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Login Form -->
        <form id="form">
            <input type="text" id="nom" class="fadeIn second" name="nom" paceholder="Nom">
            <input type="text" id="ville" class="fadeIn third" name="ville" placeholder="Ville">
            <input type="text" id="latitude" class="fadeIn third" name="latitude" placeholder="Latitude">
            <input type="text" id="longitude" class="fadeIn third" name="longitude" placeholder="Longitude">



            <div class="container fadeIn third">
                <div class="dropdown">
                    <div class="select">
                        <span>Type d'activité</span>
                        <i class="fa fa-chevron-left"></i>
                    </div>
                    <input type="hidden" name="gender">
                    <ul class="dropdown-menu">
                        <li id="ski">Ski</li>
                        <li id="windsurf">Windsurf</li>
                        <li id="wakeboard">Wakeboardf</li>
                        <li id="workout">Workout</li>
                        <li id="VTT">VTT</li>
                        <li id="running">Running</li>
                        <li id="basket">Basket</li>
                        <li id="football">Football</li>
                        <li id="surf">Surf</li>
                        <li id="skateboard">Skateboard</li>
                    </ul>
                </div>
            </div>



            <input type="submit" class="fadeIn fourth" value="Suivant">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a href="https://activdoor.000webhostapp.com">Retour à la carte</a>
        </div>

    </div>
</div>

<script>

    document.getElementById("latitude").value = <?= $latitude ?>;
    document.getElementById("longitude").value = <?= $longitude ?>;

    var spotType;
    var hasSelected = false;

    document.getElementById("form").addEventListener("submit", function (event) {
        if(hasSelected){
            event.preventDefault();
            var nom = document.getElementById("nom").value;
            var ville = document.getElementById("ville").value;
            var latitude = document.getElementById("latitude").value;
            var longitude = document.getElementById("longitude").value;
            window.open("./route.php?action=editDescription&latitude="+latitude+"&longitude="+longitude+"&nom="+nom+"&ville="+ville+"&type="+spotType,"_self");
        }

    });

    /*Dropdown Menu*/
    $('.dropdown').click(function () {
        $(this).attr('tabindex', 1).focus();
        $(this).toggleClass('active');
        $(this).find('.dropdown-menu').slideToggle(300);
    });
    $('.dropdown').focusout(function () {
        $(this).removeClass('active');
        $(this).find('.dropdown-menu').slideUp(300);
    });
    $('.dropdown .dropdown-menu li').click(function () {
        $(this).parents('.dropdown').find('span').text($(this).text());
        $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
    });
    /*End Dropdown Menu*/


    $('.dropdown-menu li').click(function () {
        hasSelected = true;
        spotType = $(this).parents('.dropdown').find('input').val();
    });
</script>

</body>

</html>