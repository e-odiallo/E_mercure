-- CREATE TYPE

--TYPE public.genre
CREATE TYPE public.genre AS ENUM
    ('homme','femme','mixte');

--TYPE public.genre
CREATE TYPE public.sexe AS ENUM
    ('masculin','feminin');

--TYPE public.genre
CREATE TYPE public.taille AS ENUM
    ('XS','S','M','L','XL');

--TYPE public.genre
CREATE TYPE public.type_article AS ENUM
    ('vetement','chaussure','accessoire');

--TYPE public.genre
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

