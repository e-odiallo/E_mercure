<!DOCTYPE>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/shop-homepage.css" rel="stylesheet">
    <title>Action formulaire</title>
</head>
<body>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Ajout d'un article dans la base de donnees**********************************
if (isset($_POST['ajouter'])) {
    try {
        $img = $_FILES['imagebd']['name'];

        $host='postgresql-dop.alwaysdata.net';
        $dbname = 'dop_e_mercure';
        $username = 'dop';
        $password = 'quxvas-kabby3-Taqras';
        $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
        $conn = new PDO($dsn);

        $requete = $conn->prepare('INSERT INTO public.articles( nom_article, genre_article, type_article, prix, date_ajout, src_image, descrip_article, taille, quantite, est_dispo)
                                        VALUES (:nom,:genre,:typ,:prix,:dates,:img,:descrip,:taille,:quantite,:dispo);');
        $addOnBD = $requete->execute(array(
            ":nom" => $_POST['nom'],
            ":genre" => $_POST['genre'],
            ":typ" => $_POST['type'],
            ":prix" => $_POST['prix'],
            ":dates" => $_POST['date'],
            ":img" => $img,
            ":descrip" => $_POST['description'],
            ":taille" => $_POST['taille'],
            ":quantite" => $_POST['quantite'],
            ":dispo" => $_POST['dispo'],
        ));
        echo 'L\'article a bien été ajouté';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
if (isset($_POST['solder'])){
    try {
        $id_article = $_POST['id'];
        $prix_solde = $_POST['prix_solde'];
        $date_debut = $_POST['date_debut'];
        $date_fin = $_POST['date_fin'];

        $hostlocal='postgresql-dop.alwaysdata.net';
        $dbnamelocal = 'dop_e_mercure';
        $usernamelocal = 'dop';
        $passwordlocal = 'quxvas-kabby3-Taqras';

        $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
        $conn = new PDO($dsn);

        $requete1 = $conn->prepare('INSERT INTO public.article_solde(num_article, prix_solde, date_debut, date_fin)
                                   VALUES (:id, :prix_s, :date_aj, :date_f);');
        $solde = $requete1->execute(array(
            ":id"=>$id_article,
            ":prix_s"=>$prix_solde,
            "date_aj"=>$date_debut,
            "date_f"=>$date_fin
        ));
        echo 'L\'article a bien été soldé ';

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// Suppression dans la base de donnees par son identifiant***********************************

if (isset($_POST['supprimer_id'])) {
    try {
        $hostlocal='postgresql-dop.alwaysdata.net';
        $dbnamelocal = 'dop_e_mercure';
        $usernamelocal = 'dop';
        $passwordlocal = 'quxvas-kabby3-Taqras';

        $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
        $conn = new PDO($dsn);
        //$sql = 'DELECTE FROM articles WHERE id = ?;';

        $requete = $conn->prepare('DELETE FROM  articles WHERE id_article = ? ;');
        $addOnBD = $requete->execute(array($id_article));
        echo 'L\'article a bien été retiré';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// Suppression dans la base de donnees par son nom***********************************

if (isset($_POST['supprimer_nom'])) {
    try {
        $hostlocal='postgresql-dop.alwaysdata.net';
        $dbnamelocal = 'dop_e_mercure';
        $usernamelocal = 'dop';
        $passwordlocal = 'quxvas-kabby3-Taqras';

        $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
        $conn = new PDO($dsn);
        //$sql = 'DELECTE FROM articles WHERE id = ?;';

        $requete = $conn->prepare('DELETE FROM  articles WHERE nom_article = ? ;');
        $addOnBD = $requete->execute(array($nom));
        echo 'L\'article a bien été retiré';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

//*************Modifier lle prix de l'article**********************************

if (isset($_POST['modifier'])) {
    try {
        $id = $_POST['id'];
        $prix = $_POST['prix'];

        $hostlocal='postgresql-dop.alwaysdata.net';
        $dbnamelocal = 'dop_e_mercure';
        $usernamelocal = 'dop';
        $passwordlocal = 'quxvas-kabby3-Taqras';

        $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
        $conn = new PDO($dsn);
        //$sql = 'DELECTE FROM articles WHERE id = ?;';

        $requete = $conn->prepare('UPDATE articles SET prix = :px WHERE id_article = :idd;');
        $addOnBD = $requete->execute(array(
                ":px"=>$prix,
            ":idd"=>$id
        ));
        echo 'Le prix a bien été modifié';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// Solder un article
if (isset($_POST['solder'])){
    try {
        $id_article = $_POST['id'];
        $prix_solde = $_POST['prix_solde'];
        $date_debut = $_POST['date_debut'];
        $date_fin = $_POST['date_fin'];

        $hostlocal='postgresql-dop.alwaysdata.net';
        $dbnamelocal = 'dop_e_mercure';
        $usernamelocal = 'dop';
        $passwordlocal = 'quxvas-kabby3-Taqras';

        $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
        $conn = new PDO($dsn);

        $requete1 = $conn->prepare('INSERT INTO public.article_solde(num_article, prix_solde, date_debut, date_fin)
                                   VALUES (:id, :prix_s, :date_aj, :date_f);');
        $solde = $requete1->execute(array(
            ":id"=>$id_article,
            ":prix_s"=>$prix_solde,
            "date_aj"=>$date_debut,
            "date_f"=>$date_fin
        ));
        echo 'L\'article a bien été soldé ';

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<p><a class="nav-link" href="gerer_articles.php">Retour</a></p>
</body>
</html>
