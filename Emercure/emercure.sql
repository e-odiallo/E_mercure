CREATE TYPE public.genre AS ENUM
    ('homme','femme','mixte');
CREATE TYPE public.sexe AS ENUM
    ('masculin','feminin');
CREATE TYPE public.taille AS ENUM
    ('XS','S','M','L','XL');
CREATE TYPE public.type_article AS ENUM
    ('vetement','chaussure','accessoire');
CREATE TYPE public.statut AS ENUM
    ('livraison en cours', 'livré', 'avec le livreur');

-- Table: public.articles
-- CREATE TABLE public.articles;
CREATE TABLE public.articles
(
    id_article SERIAL NOT NULL,
    nom_article character varying(50),
    genre_article genre,
    type_article type_article ,
    prix integer,
    date_ajout date NOT NULL ,
    src_image character varying(255),
    descrip_article text,
    taille taille,
    quantite integer,
    est_dispo boolean,
    CONSTRAINT article_pk PRIMARY KEY (id_article)
);

-- Table: public.article_solde
-- CREATE TABLE public.article_solde;
CREATE TABLE public.article_solde
(
    -- Inherited from table public.articles: id_article integer NOT NULL DEFAULT nextval('articles_id_article_seq'::regclass),
    -- Inherited from table public.articles: nom_article character varying(50) COLLATE pg_catalog."default",
    -- Inherited from table public.articles: genre_article genre,
    -- Inherited from table public.articles: type_article type_article,
    -- Inherited from table public.articles: prix integer,
    -- Inherited from table public.articles: date_ajout date,
    -- Inherited from table public.articles: quantite integer,
    -- Inherited from table public.articles: src_image bytea,
    -- Inherited from table public.articles: descrip_article text COLLATE pg_catalog."default",
    prix_solde integer,
    date_debut date NOT NULL,
    date_fin date NOT NULL ) INHERITS (public.articles);

-- Table: public.client
-- CREATE TABLE public.client;
CREATE TABLE public.client
(
    id_client SERIAL NOT NULL ,
    nom_client character varying(50) ,
    prenom_client character varying(50),
    sexe sexe,
    mail_client character varying(100) ,
    adresse_client character varying(100),
    code_postale character varying(100),
    mdp_client character varying(255) ,
    tel_client character varying(100) ,
    CONSTRAINT client_pk PRIMARY KEY (id_client)
);


-- Table: public.carte_fidelite
-- CREATE TABLE public.carte_fidelite;
CREATE TABLE public.carte_fidelite
(
    id_carte SERIAL NOT NULL ,
    nombre_point integer,
    client integer,
    CONSTRAINT carte_fidelite_pkey PRIMARY KEY (id_carte),
    CONSTRAINT carte_fidelite_client_fkey FOREIGN KEY (client)
        REFERENCES public.client (id_client)
) ;

-- Table: public.commande
-- CREATE TABLE public.commande;
CREATE TABLE public.commande
(
    id_commande SERIAL NOT NULL ,
    client integer NOT NULL,
    article integer NOT NULL ,
    date_achat date NOT NULL,
    statut_livraison statut ,
    CONSTRAINT commande_pk PRIMARY KEY (id_commande),
    CONSTRAINT commande_fk FOREIGN KEY (client)
        REFERENCES public.client (id_client),
    CONSTRAINT commande_fk2 FOREIGN KEY (article)
        REFERENCES public.articles (id_article)
);

-- Table: public.commenter
-- CREATE TABLE public.commenter;
CREATE TABLE public.commenter
(
    id_commentaire SERIAL NOT NULL ,
    client integer NOT NULL ,
    commentaire text ,
    date_commentaire date NOT NULL,
    article integer NOT NULL,
    CONSTRAINT commentaire_pk PRIMARY KEY (id_commentaire),
    CONSTRAINT commentaire_fk FOREIGN KEY (article)
        REFERENCES public.articles (id_article),
    CONSTRAINT commentaire_fk2 FOREIGN KEY (client)
        REFERENCES public.client (id_client)
);

-- Table: public.livreur
-- CREATE TABLE public.livreur;
CREATE TABLE public.livreur
(
    id_livreur SERIAL NOT NULL ,
    nom_livreur character varying(50),
    prenom_livreur character varying(50),
    commande integer NOT NULL,
    CONSTRAINT livreur_pk PRIMARY KEY (id_livreur),
    CONSTRAINT livreur_fk FOREIGN KEY (commande)
        REFERENCES public.commande (id_commande)
);

-- Table: public.contenir
-- CREATE TABLE public.contenir;
CREATE TABLE public.contenir
(
    id_contenir serial NOT NULL ,
    num_article integer NOT NULL,
    num_commande integer NOT NULL,
    CONSTRAINT contenir_pk PRIMARY KEY (id_contenir),
    CONSTRAINT contenir_fk FOREIGN KEY (num_article)
        REFERENCES public.articles (id_article),
    CONSTRAINT contenir_fk2 FOREIGN KEY (num_commande)
        REFERENCES public.commande (id_commande)
);

-------------------------------------------------------------------------------------------------------------------------

--SELECT * FROM articles WHERE type_article !='pantalon';
--SELECT * FROM articles WHERE type_article !='chaussure';

SELECT commentaire FROM commenter WHERE commenter.article  IN (SELECT id_article FROM articles WHERE id_article =17);
SELECT id_commande , SUM (articles.prix) FROM articles ,commande , contenir WHERE id_commande = num_commande AND id_article = num_article GROUP BY id_commande;
SELECT * FROM articles WHERE genre_article = ?;
SELECT * FROM articles WHERE type_article = ?;
SELECT * FROM articles ORDER BY date_ajout ;
SELECT * FROM articles ORDER BY prix ;
SELECT * FROM articles WHERE type_article = ? AND  genre_article =  ?;
SELECT id_commande , client , statut_livraison FROM commande WHERE id_commande =? ;
SELECT texte_commentaire ,date_commentaire , client  FROM commentaire WHERE article  IN (SELECT id_article FROM articles WHERE id_article = ?);
SELECT id_client FROM client WHERE mail_client = ?;
SELECT * FROM articles ORDER BY prix DESC ;
SELECT nom_client FROM commande NATURAL JOIN client ;
SELECT * FROM commande NATURAL JOIN client WHERE client = 2  ;
SELECT * FROM commande NATURAL JOIN client WHERE id_client = 2  AND client = 2;
SELECT nom_article FROM articles NATURAL JOIN commande WHERE id_commande =1;
SELECT statut_livraison FROM commande WHERE article =2 ;
SELECT * FROM commenter INNER JOIN articles ON commenter.article = articles.id_article WHERE commenter.article = 3 ORDER BY date_commentaire DESC ;
SELECT * FROM public.articles WHERE src_image ='product_1.jpg';
SELECT nom_client , prenom_client FROM client WHERE id_client IN (SELECT client FROM commande);

ALTER TABLE commande DROP COLUMN statut_livraison ;
ALTER TABLE commande ADD COLUMN statut_livraison statut;
ALTER TABLE articles ADD COLUMN est_dispo boolean;
ALTER TABLE articles ADD COLUMN taille taille;

INSERT INTO public.articles( nom_article, genre_article, type_article, prix, date_ajout, src_image, descrip_article, taille, quantite, est_dispo) VALUES ('veste bleu','homme','vetement',123,'2019-11-27','item-9.jpg','Machin chouette','XS',10,true);
INSERT INTO public.article_solde(nom_article, genre_article, prix, date_ajout, src_image, descrip_article, prix_solde, date_debut, date_fin, type_article)VALUES ('veste bleu','homme',123,'2019-11-27',6,'item-9.jpg','Machin chouette','2019-11-27', '2019-12-27' ,'vetement');
INSERT INTO public.article_solde(  nom_article, genre_article, type_article, prix, date_ajout, src_image, descrip_article, taille, quantite, est_dispo, prix_solde, date_debut, date_fin)VALUES ('Vetement','homme','vetement',123,'2019-11-27','item-6.jpg','Machin chouette','S',5,true,21,'2019-11-27', '2019-12-27');
INSERT INTO public.commenter(client, commentaire, date_commentaire, article)VALUES (2,'ceci est un test','2019-01-02',2);
INSERT INTO public.commande(client, date_achat, article, statut_livraison)VALUES (7,'2019-11-11',18,false);
INSERT INTO public.commande(client, date_achat, article, statut_livraison, id_commande)VALUES (7,'2019-01-02',20,true,2);
INSERT INTO public.commenter(commentaire, date_commentaire, article)VALUES ('machin chouette machin chouette ','2019-03-11',5);
INSERT INTO public.commenter( commentaire, date_commentaire, article, client)VALUES ('magnifique EPOUSTOUFLANT !!!!!!!!!',NOW(),17,1);

-----------------------------------------------
UPDATE articles SET prix = :px WHERE id_article = :idd;
UPDATE public.commande SET statut_livraison = true WHERE id_commande =20;

-----------------------------------------------RAPPORT---------------------------------------
--1
SELECT commentaire ,date_commentaire , client  FROM commentaire WHERE article IN (SELECT id_article FROM articles WHERE id_article = 11);

--2
SELECT nom_client , prenom_client FROM client WHERE id_client IN (SELECT client FROM commande);

--3
SELECT nom_article , type_article , genre_article ,prix  FROM articles ORDER BY prix DESC ;

--4
--SELECT texte_commentaire FROM public.commentaire WHERE commentaire.article  IN (SELECT id_article FROM articles WHERE id_article =11);
--5
SELECT id_commande , nom_article,prix,nom_client FROM commande NATURAL JOIN client NATURAL JOIN articles WHERE  id_client = 1 ;

SELECT DISTINCT nom_article , prix FROM articles WHERE prix > 100 ;

--SELECT titre from film WHERE fiml.id_film IN (SELECT id_titre FROM evaluation GROUP BY id_titre HAVING AVG (note)>=4)
--SELECT nom_article , prix FROM articles WHERE articles.id_article IN(SELECT id_commande FROM commande GROUP BY id_commande);
SELECT article FROM commande WHERE commande.article IN (SELECT id_article FROM articles GROUP BY id_article HAVING AVG (prix)>=100);

SELECT nom_article , prix , date_ajout FROM articles WHERE nom_article LIKE 'v%';

SELECT DISTINCT id_article , prix , nom_article FROM commande NATURAL JOIN articles WHERE commande.article IN (SELECT id_article FROM articles GROUP BY id_article HAVING AVG (prix)<=50);

SELECT nom_article , prix , type_article , date_ajout FROM articles WHERE date_ajout BETWEEN '2019-11-20' AND NOW();
SELECT nom_client , prenom_client , nombre_point FROM client NATURAL JOIN carte_fidelite WHERE client =3;

SELECT * FROM commande WHERE statut_livraison = 'livré';

-----------Affiche les commentaires d'un client
SELECT texte_commentaire FROM commentaire WHERE client = 1 ;

---affiche les commmandes dun clients
SELECT DISTINCT commande.id_commande
FROM commande,client
WHERE client.id_client = commande.client
  AND client.id_client = 7