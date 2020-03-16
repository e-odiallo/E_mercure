<?php

class ArticlesContoller
{
    private $_articles_control;

    public function _construct ()
    {
        $this->_articles_manage=new ArticlesManagers();
    }
    /**
     * @author Oumar Diallo
     * Display all articles in the DataBase
     */
    public function getAllArticles()
    {

        $articlesManage = new ArticlesManagers();
        $requete = ('SELECT * FROM articles ');

        foreach ($articlesManage->dbConnect()->query($requete) as $row) {
                $image = $row['src_image'];
                $nom_articles = $row['nom_article'];
                $prix = $row['prix'];
                    $taille = $row['taille'];
                    $dispo = $row['est_dispo'];
                    $id_article = $row['id_article'];
            ?>
            <?php include('../include/viewAllArticle.inc.php') ?>
            <?php
        }
    }

    /**
     * @author Oumar Diallo
     * Get the statut of an Order by article id
     * @param String $id_commande the id of the article
     */
    public function getStatutOrder($id_commande)
    {
        $articlesMange = new ArticlesManagers();
        $requete = $articlesMange->statutOrder($id_commande);

        while ($resultat = $requete->fetch()) {
            $statut = $resultat['statut_livraison'];
            $id_commande = $resultat['id_commande'] ;
            $id_client = $resultat['client'];
            ?>
        <button type="button" class="list-group-item list-group-item-action">
        <?php echo 'La commande N° '.'<strong>'.$id_commande.'</strong>'.' : '.'<strong>'.$statut.'</strong>'  ;?>
        </button>
            <?php

            }

    }
    /**
     * @author Oumar Diallo
     * Sort the all articles by descending
     *
     */
    public function orderByDesc()
    {
        $articlesManage = new ArticlesManagers();
        $requete = ('SELECT * FROM articles ORDER BY prix DESC ;');

        foreach ($articlesManage->dbConnect()->query($requete) as $row) {
            $image = $row['src_image'];
            $nom_articles = $row['nom_article'];
            $prix = $row['prix'];
            $taille = $row['taille'];
            $dispo = $row['est_dispo'];
            $id_article = $row['id_article'];

            ?>
            <?php include('../include/viewAllArticle.inc.php') ?>
            <?php
        }
    }
    /**
     * @author Oumar Diallo
     * Sort the all articles by ascending
     *
     */
    public function orderByAsc()
    {
        $articlesManage = new ArticlesManagers();
        $requete = ('SELECT * FROM articles ORDER BY prix ASC ;');

        foreach ($articlesManage->dbConnect()->query($requete) as $row) {
            $image = $row['src_image'];
            $nom_articles = $row['nom_article'];
            $prix = $row['prix'];
            $taille = $row['taille'];
            $dispo = $row['est_dispo'];
            $id_article = $row['id_article'];

            ?>
            <?php include('../include/viewAllArticle.inc.php') ?>
            <?php
        }
    }
    /**
     * @author Oumar Diallo
     * Sort the all articles by type
     * @param String $type the type of the article
     */
    public function getArticlesByType($type)
    {
        $articlesManage = new ArticlesManagers();
        $requete = $articlesManage->getArticlesByType($type);

        while ($row = $requete->fetch()) {
            $image = $row['src_image'];
            $nom_articles = $row['nom_article'];
            $prix = $row['prix'];
            $taille = $row['taille'];
            $dispo = $row['est_dispo'];
            $id_article = $row['id_article'];

            ?>
            <?php include('../include/viewAllArticle.inc.php') ?>
            <?php
        }
    }
    /**
     * @author Oumar Diallo
     * Sort the all articles by kind
     * @param String $genre the kind of the article
     */
    public function getArticlesByGenre($genre)
    {
        $articlesManage = new ArticlesManagers();
        $requete = $articlesManage->getArticlesByGenre($genre);

        while ($row = $requete->fetch()) {
            $image = $row['src_image'];
            $nom_articles = $row['nom_article'];
            $prix = $row['prix'];
            $taille = $row['taille'];
            $dispo = $row['est_dispo'];
            $id_article = $row['id_article'];

            ?>
            <?php include('../include/viewAllArticle.inc.php') ?>
            <?php
        }
    }
    public function displayComment($idArticle)
    {
        $articlesManage = new ArticlesManagers();
        $requete = $articlesManage->getCommentById($idArticle);

        while ($row = $requete->fetch()) {
            $comment = $row['commentaire'];
            $date = $row['date_commentaire'];
            $client = $row['client'];

            echo '<div class="card-body">
                      <p>'.$comment.'</p>
                 <small class="text-muted">Publie le '.$date.'</small>
                 <hr>
                 ' ;
        }
    }
}

?>