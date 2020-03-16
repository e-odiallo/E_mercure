<?php
//*************************Afficher les articles par genre************************************//
function by_genre($genre){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT * FROM articles WHERE genre_article = ? ;';
    $requete = $conn->prepare($sql);
    $requete->execute(array($genre));
    while ($resultat = $requete->fetch()) {
        $image = $resultat['src_image'];
        $nom_articles = $resultat['nom_article'];
        $id_article = $resultat['id_article'];
        $prix_article = $resultat['prix'];
        ?>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <?php echo "<a><img class='card-img-top' src=../../src/images/" . $image . "></a>" ?>
                <div class="card-body">
                    <h4 style="margin-top: 3.5em;" class="card-title">
                        <?php echo "<a href='#'>".'n°'.$id_article.', '. $nom_articles .', '.$prix_article.' euros'. "</a>" ?>
                    </h4>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        <?php
    }
}

//*********************************Afficher les articles par type**********************************************//

function by_type($type){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT * FROM articles WHERE type_article = ? ;';
    $requete = $conn->prepare($sql);
    $requete->execute(array($type));
    while ($resultat = $requete->fetch()) {
        $image = $resultat['src_image'];
        $nom_articles = $resultat['nom_article'];
        $id_article = $resultat['id_article'];
        $prix_article = $resultat['prix'];
        ?>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <?php echo "<a><img class='card-img-top' src=../../src/images/" . $image . "></a>" ?>
                <div class="card-body">
                    <h4 style="margin-top: 3.5em;" class="card-title">
                        <?php echo "<a href='#'>" .'n°'.$id_article.', '. $nom_articles .', '.$prix_article.' euros'. "</a>" ?>
                    </h4>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        <?php
    }
}

//***************************************afficher tout les articles*************************************//
function all_articles(){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT * FROM articles  ;';
    $requete = $conn->query($sql);
    while ($resultat = $requete->fetch()) {
        $image = $resultat['src_image'];
        $nom_articles = $resultat['nom_article'];
        $id_article = $resultat['id_article'];
        $prix_article = $resultat['prix'];
        ?>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <?php echo "<a><img class='card-img-top' src=../src/images/" . $image . "></a>" ?>
                <div class="card-body">
                    <h4 style="margin-top: 3.5em;" class="card-title">
                        <?php echo "<a href='#'>" .'n°'.$id_article.', '. $nom_articles .', '.$prix_article.' euros'. "</a>" ?>
                    </h4>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        <?php
    }
}


//*************************************************Commandes Clients************************************//

//**********************Afficher tout les clients*****************************//

function all_clients(){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT * FROM client  ;';
    $requete = $conn->query($sql);

    while ($resultat = $requete->fetch()) {
        $id = $resultat['id_client'];
        $prenom = $resultat['prenom_client'];
        $nom = $resultat['nom_client'];
        ?>
            <button type="button" class="list-group-item list-group-item-action"><?php echo $prenom.' '.$nom;?></button>
        <?php
    }
}

//*************************************Client par sexe***********************************//

function by_sexe($sexe){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT * FROM client WHERE sexe = ? ;';
    $requete = $conn->prepare($sql);
    $requete->execute(array($sexe));
    while ($resultat = $requete->fetch()) {
        $id = $resultat['id_client'];
        $prenom = $resultat['prenom_client'];
        $nom = $resultat['nom_client'];
        ?>
        <button type="button" class="list-group-item list-group-item-action"><?php echo $prenom.' '.$nom;?></button>
        <?php
    }
}

//*********************Articles par date*****************************************//

function all_articles_date_ajout(){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT * FROM articles ORDER BY date_ajout ;';
    $requete = $conn->query($sql);
    while ($resultat = $requete->fetch()) {
        $image = $resultat['src_image'];
        $nom_articles = $resultat['nom_article'];
        $id_article = $resultat['id_article'];
        $prix_article = $resultat['prix'];
        ?>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <?php echo "<a><img class='card-img-top' src=../../src/images/" . $image . "></a>" ?>
                <div class="card-body">
                    <h4 style="margin-top: 3.5em;" class="card-title">
                        <?php echo "<a href='#'>".'n°'.$id_article.', '. $nom_articles .', '.$prix_article.' euros'. "</a>" ?>
                    </h4>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        <?php
    }
}

//****************************Trier par prix********************************************//

function all_articles_prix(){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT * FROM articles ORDER BY prix ;';
    $requete = $conn->query($sql);
    while ($resultat = $requete->fetch()) {
        $image = $resultat['src_image'];
        $nom_articles = $resultat['nom_article'];
        $id_article = $resultat['id_article'];
        $prix_article = $resultat['prix'];
        ?>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <?php echo "<a><img class='card-img-top' src=../../src/images/" . $image . "></a>" ?>
                <div class="card-body">
                    <h4 style="margin-top: 3.5em;" class="card-title">
                        <?php echo "<a href='#'>" .'n°'.$id_article.', '. $nom_articles .', '.$prix_article.' euros'. "</a>" ?>
                    </h4>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        <?php
    }
}

//************************normal******************************************//

function all_articles_normal(){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT * FROM articles  ;';
    $requete = $conn->query($sql);
    while ($resultat = $requete->fetch()) {
        $image = $resultat['src_image'];
        $nom_articles = $resultat['nom_article'];
        $id_article = $resultat['id_article'];
        $prix_article = $resultat['prix'];
        ?>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <?php echo "<a><img class='card-img-top' src=../../src/images/" . $image . "></a>" ?>
                <div class="card-body">
                    <h4 style="margin-top: 3.5em;" class="card-title">
                        <?php echo "<a href='#'>" .'n°'.$id_article.', '. $nom_articles .', '.$prix_article.' euros'. "</a>" ?>
                    </h4>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        <?php
    }
}

//**********************************Accessoires Hommes*************************************************//

function by_type_and_genre($type,$genre){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT * FROM articles WHERE type_article = ? AND  genre_article =  ?;';
    $requete = $conn->prepare($sql);
    $requete->execute(array($type,$genre));
    while ($resultat = $requete->fetch()) {
        $image = $resultat['src_image'];
        $nom_articles = $resultat['nom_article'];
        $id_article = $resultat['id_article'];
        $prix_article = $resultat['prix'];
        ?>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <?php echo "<a><img class='card-img-top' src=../../src/images/" . $image . "></a>" ?>
                <div class="card-body">
                    <h4 style="margin-top: 3.5em;" class="card-title">
                        <?php echo "<a href='#'>" .'n°'.$id_article.', '. $nom_articles .', '.$prix_article.' euros'. "</a>" ?>
                    </h4>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        <?php


        //
    }
}
















// Les requetes poussées
//Afficher toutes les commandes et les clients qui les ont commander

function all_commande(){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT client.prenom_client,client.nom_client,commande.id_commande,commande.date_achat,commande.statut_livraison FROM client,commande WHERE client.id_client = commande.client;';
    $requete = $conn->prepare($sql);
    $requete->execute(array());

    while ($resultat = $requete->fetch()) {
        $prenom = $resultat['prenom_client'];
        $nom = $resultat['nom_client'];
        $commande = $resultat['id_commande'];
        $statut = $resultat['statut_livraison'];
        $date = $resultat['date_achat'];
        ?>
        <button type="button" class="list-group-item list-group-item-action"><?php echo 'La commande numero '.'<strong>'.$commande.'</strong>'.' pour '.'<strong>'. $prenom.'</strong>'.' <strong>'.$nom.'</strong>'.'. Commande du '.'<strong>'.$date.'</strong>'.', <strong>'.$statut.'</strong>';?></button>
        <?php
    }
}

// Afficher les commandes par statut

function all_commande_by_statut($statut){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT client.prenom_client,client.nom_client,commande.id_commande,commande.date_achat,commande.statut_livraison FROM client,commande WHERE client.id_client = commande.client AND commande.statut_livraison = ?;';
    $requete = $conn->prepare($sql);
    $requete->execute(array($statut));

    while ($resultat = $requete->fetch()) {
        $prenom = $resultat['prenom_client'];
        $nom = $resultat['nom_client'];
        $commande = $resultat['id_commande'];
        $date = $resultat['date_achat'];
        ?>
        <button type="button" class="list-group-item list-group-item-action"><?php echo 'La commande numero '.'<strong>'.$commande.'</strong>'.' pour '.'<strong>'. $prenom.'</strong>'.' <strong>'.$nom.'</strong>'.'. Commande du '.'<strong>'.$date.'</strong>';?></button>
        <?php
    }
}


// Afficher tout les clients qui ont passer une coommande


function all_client_commande(){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT client.prenom_client,client.nom_client FROM client WHERE id_client IN (SELECT client FROM commande);';
    $requete = $conn->query($sql);

    while ($resultat = $requete->fetch()) {
        $prenom = $resultat['prenom_client'];
        $nom = $resultat['nom_client'];
        ?>
        <button type="button" class="list-group-item list-group-item-action"><?php echo $prenom.' '.$nom;?></button>
        <?php
    }
}

// Afficher toutes les commanndes et les articles qui se trouvent dans chaque commande


function all_article_commande(){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT id_commande,nom_article FROM articles,commande,contenir WHERE id_article = num_article AND num_commande = id_commande;';
    $requete = $conn->query($sql);

    while ($resultat = $requete->fetch()) {
        $nom = $resultat['nom_article'];
        $commande = $resultat['id_commande'];
        ?>
        <button type="button" class="list-group-item list-group-item-action"><?php echo '<strong>'.$nom.'</strong>'.' dans la commande numro '.'<strong>'.$commande.'</strong>';?></button>
        <?php
    }
}

// Afficher les commande avec le prix total de chaque commande

function all_commande_prix(){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT id_commande, SUM(articles.prix) AS somme FROM articles,commande,contenir WHERE id_commande = num_commande AND id_article = num_article GROUP BY id_commande;';
    $requete = $conn->query($sql);

    while ($resultat = $requete->fetch()) {
        $somme = $resultat['somme'];
        $commande = $resultat['id_commande'];
        ?>
        <button type="button" class="list-group-item list-group-item-action"><?php echo 'La commande '.'<strong>'.$commande.'</strong>'.' pour un prix total de '.'<strong>'.$somme.'</strong>'.' euros.';?></button>
        <?php
    }
}

// Les livreurs

function all_livreur(){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT * FROM public.livreur';
    $requete = $conn->query($sql);

    while ($resultat = $requete->fetch()) {
        $id = $resultat['id_livreur'];
        $nom = $resultat['nom_livreur'];
        $prenom = $resultat['prenom_livreur'];
        ?>
        <button type="button" class="list-group-item list-group-item-action"><?php echo 'Numero livreur '.$id.', '.$prenom.' '.$nom;?></button>
        <?php
    }
}

function all_articles_soldes(){
    $host='postgresql-dop.alwaysdata.net';
    $dbname = 'dop_e_mercure';
    $username = 'dop';
    $password = 'quxvas-kabby3-Taqras';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $sql = 'SELECT id_article,nom_article,prix,src_image,prix_solde,date_debut,date_fin FROM articles,article_solde WHERE id_article = num_article  ;';
    $requete = $conn->query($sql);
    while ($resultat = $requete->fetch()) {
        $image = $resultat['src_image'];
        $nom_articles = $resultat['nom_article'];
        $id_article = $resultat['id_article'];
        $prix_article = $resultat['prix'];
        $prix_sol = $resultat['prix_solde'];
        $date_deb = $resultat['date_debut'];
        $date_f = $resultat['date_fin'];
        ?>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <?php echo "<a><img class='card-img-top' src=../../src/images/" . $image . "></a>" ?>
                <div class="card-body">
                    <h4 style="margin-top: 3.5em;" class="card-title">
                        <?php echo 'n°'.$id_article.', '. $nom_articles .', '.$prix_article.' euros. Pour '.$prix_sol.' euros du '.$date_deb.' au '.$date_f ?>
                    </h4>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        <?php
    }
}

?>
<?php
