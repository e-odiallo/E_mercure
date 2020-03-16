<?php
$requeteImage = 'SELECT * FROM articles  WHERE type_article !=\'chaussure\' AND type_article !=\'accessoire\';';
foreach ($conn->query($requeteImage) as $row) {
    $image = $row['src_image'];
    $nom_articles = $row['nom_article'];
    $id_article = $row['id_article'];
    $prix_article = $row['prix'];

    ?>

    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <?php echo "<a><img class='card-img-top' src=../../src/images/" . $image . "></a>" ?>
            <div class="card-body">
                <h4 style="margin-top: 3.5em;" class="card-title">
                    <?php echo "<a href='#'>".'n°'.$id_article.', '. $nom_articles .', '.$prix_article. "</a>" ?>
                </h4>
                <p class="card-text"></p>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>

    <?php
}
?>