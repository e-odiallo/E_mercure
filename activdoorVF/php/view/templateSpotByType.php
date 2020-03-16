<?php $title = "Tous les spots du type : ".$type?>

<?php ob_start(); ?>

    <div class="container">

    <h2>
        Tous les spots de <?= $type ?>
    </h2>


<?php

while($data = $spots->fetch()){

    ?>

    <div class="cel" onclick="openAllSpotsType('<?= $data['idSpot']?>')">
        <img class="activity_icon" src="../src/img/acticon_color/<?= $data['type'] ?>.png">
        <h3><?= $data['nom'] ?></h3>
        <img class="localisation_icon" src="../src/img/localisation.png">
        <p class="localisation"><?= $data['ville'] ?>, <?= $data['pays']?></p>
    </div>


    <?php

}
$spots->closeCursor();
?>


    <script>

        function openAllSpotsType(spotId){
            window.open("https://activdoor.000webhostapp.com/spot/"+spotId,"_self");
        }

    </script>


<?php $content = ob_get_clean() ;?>


<?php require('template_spot_list.php'); ?>