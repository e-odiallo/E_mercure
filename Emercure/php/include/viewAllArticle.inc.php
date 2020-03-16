<!--  ce fichier sera utilisé pour affiché les elements de la base de donneés en fonction de la requete  -->
<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <?php echo "<a><img class='card-img-top' src=../../src/images/" . $image . " alt='' ></a>" ?>
        <div class="card-body">
            <h4 class="card-title">
                <?php echo "<a href='../view/viewArticles.php?id_article=$id_article&nom_article=$nom_articles&prix=$prix&image=$image&taille=$taille'>" .$nom_articles. "</a>" ?>
            </h4>
            <?php echo "<h5>" . $prix . '€' . "</h5>" ?>
            <?php echo "<h6>" ."Taille :". $taille . "</h6>" ?>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam
                aspernatur! Lorem ipsum dolor sit amet.</p>
        </div>
        <div class="card-footer">
            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            <?php

            if ($dispo==false){
                echo '<button type="button" class="btn btn-danger" style="margin-left:2em; "></button>';
            }else{
                echo '<button type="button" class="btn btn-success" style="margin-left:2em; "></button>';
            }
            ?>
        </div>
    </div>
</div>