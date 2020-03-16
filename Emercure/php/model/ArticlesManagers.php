<?php


class ArticlesManagers
{
    private $_dbconnexion ;

    function __construct (){
        $this->_dbconnexion=$this->dbConnect();
    }

    //Connexion a la base de données
    public function dbConnect(){
        $hostlocal='postgresql-dop.alwaysdata.net';
        $dbnamelocal = 'dop_e_mercure';
        $usernamelocal = 'dop';
        $passwordlocal = 'quxvas-kabby3-Taqras';
        $host='devwebdb.etu';
        $dbname = 'db2019l3i_e_odiallo';
        $username = 'y2019l3i_e_odiallo';
        $password = 'A123456*';

        //$dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
        $dsn = "pgsql:host=$hostlocal;port=5432;dbname=$dbnamelocal;user=$usernamelocal;password=$passwordlocal";
        $connex = new PDO($dsn);

        $connex->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        return $connex;
    }
    public function addArticles($nom, $genre, $type, $prix, $dateAjout, $quantite, $img, $descrip)
    {
        $requete = $this->_dbconnexion->prepare('INSERT INTO public.articles(nom_article, genre_article, prix, date_ajout ,quantite, src_image, descrip_article, type_article)
                                        VALUES (:nom,:genre,:prix,:dates,:quantite,:img,:descrip,:typ);');

        $addOnBD = $requete->execute(array(
           ":nom"=>$nom,
            ":genre"=>$genre,
            ":prix"=>$prix,
            ":dates"=>$dateAjout,
            ":quantite"=>$quantite,
            ":img"=>$img,
            ":descrip"=>$descrip,
             ":typ"=>$type
        ));
        return $addOnBD ;
    }
    public function getArticlesByType($type)
    {
        $requete = $this->_dbconnexion->prepare('SELECT * FROM articles WHERE type_article =?');
        $requete->execute(array($type));

        return $requete ;
    }
    public function getArticlesByGenre($genre)
    {
        $requete = $this->_dbconnexion->prepare('SELECT * FROM articles WHERE genre_article =?');
        $requete->execute(array($genre));

        return $requete ;
    }
    public function statutOrder($id_article)
    {
        $req = $this->_dbconnexion->prepare('SELECT id_commande , client , statut_livraison FROM commande WHERE id_commande =?;');
        $req->execute(array($id_article));

        return $req ;
    }
    public function addComment($idClient,$comment,$idArticle){
        $req = $this->_dbconnexion->prepare("INSERT INTO public.commenter(client,commentaire, date_commentaire, article)VALUES (:idClient,:comment, NOW(),:idArticle)");
        $affectedLines = $req->execute(array(
            ":idArticle"=>$idArticle,
            ":comment"=>$comment,
            ":idClient"=>$idClient
            ));

        return $affectedLines;
    }
    public function getCommentById($idArticle)
    {
        $req = $this->_dbconnexion->prepare('SELECT commentaire ,date_commentaire , client  FROM commenter WHERE article  
                                            IN (SELECT id_article FROM articles WHERE id_article = ?);');
        $req->execute(array($idArticle));

        return $req ;
    }

}