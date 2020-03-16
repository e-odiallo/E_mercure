
<div class="col-lg-12">
    <div class="card mt-4">
        <img class="card-img-top img-fluid" src="../../src/images/<?php echo $_GET['image']?>" alt="article">
        <div class="card-body">
            <?php echo'<h3 class="card-title">'.$_GET['nom_article'].'</h3>'?>
            <?php echo '<h4>'.$_GET['prix'].'€</h4>' ; ?>
            <?php echo '<h5> Taille :'.$_GET['taille'].'</h5>' ; ?>
            <p class="card-text"></p>
            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
            4.0 stars
        </div>
    </div>
    <!-- /.card -->

    <div class="card card-outline-secondary my-4">
        <div class="card-header">
            Commentaire
        </div>
        <div class="card-body">
            <?php $articleControl->displayComment($_GET['id_article']); ?>
        </div>
       <?php
       $article = $_GET['id_article'];
       if ($connected) $client = $_SESSION['id_client'];
       echo "<form method='post' action='../root.php'>"?>
            <textarea name="comments" id="comments" style= "font-family:sans-serif;font-size:1.2em; width: 100%;" placeholder="Rédigez un avis"></textarea>
            <input type="hidden" value="<?php echo $article?>" name="idArticle" />
            <input type="hidden" value="<?php if($connected) echo $client?> " name="client" />
           <?php
           if($connected){
               echo '<input type="submit" class="btn-success" value="commenter" />';
           }else {
              echo '<a href="../../html/connexion.html">Connectez-vous pour donner votre avis</a>';
           }
           ?>

        </form>
    </div>
    <!-- /.card -->
</div>
<!-- /.col-lg-9 -->
</div>
</div>