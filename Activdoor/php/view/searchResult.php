<?php $title = "Résultats de recherche pour : ".$input?>

<?php ob_start(); ?>

<div class="container">

    <form>

        <input type='hidden' name='action' value='search' />
        <input type='hidden' name='filter' value='city' />

        <input style="background: white;" id="searchbar" type="text" id="search" name="input"
               maxlength="40" size="10" placeholder="Rechercher une ville, une activitée, etc...">
    </form>


    <h2>
        Résultats de recherche pour : <?= $input ?>
    </h2>


<?php

while($data = $spots->fetch()){

    ?>

    <div class="cel" onclick="openSpot('<?= $data['idSpot'] ?>')">
        <img class="activity_icon" src="../src/img/acticon_color/<?= $data['type'] ?>.png">
        <h3><?= $data['nom'] ?></h3>
        <img class="localisation_icon" src="../src/img/localisation.png">
        <p class="localisation"><?= $data['ville'] ?>, <?= $data['pays'] ?></p>
    </div>


    <?php

}
$spots->closeCursor();
?>


    <script>

        function openSpot(spotId){
            window.open("https://activdoor.000webhostapp.com/php/index.php?action=getSpot&spotId="+spotId,"_self");
        }

    </script>

<?php $content = ob_get_clean() ;?>


<?php require('template_spot_list.php'); ?>