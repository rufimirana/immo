CREATE SCHEMA immo;

CREATE TABLE immo.categorie (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	nom_categorie        varchar(100)  NOT NULL    ,
	taux_amortissement   int      ,
	duree_vie            int
 );

CREATE TABLE immo.couleur (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	couleur              varchar(100)  NOT NULL
 );

CREATE TABLE immo.departement (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	departement          varchar(100)  NOT NULL
 );

CREATE TABLE immo.devise (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	devise               varchar(100)  NOT NULL    ,
	description_devise   varchar(100)  NOT NULL
 );

CREATE TABLE immo.emplacement (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	emplacement          varchar(100)  NOT NULL
 );

CREATE TABLE immo.etat_usage (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	etat                 varchar(100)
 );

CREATE TABLE immo.extension (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	extension_travail    varchar(100)  NOT NULL
 );

CREATE TABLE immo.failed_jobs (
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	uuid                 varchar(255)  NOT NULL    ,
	connection           text  NOT NULL    ,
	queue                text  NOT NULL    ,
	payload              longtext  NOT NULL    ,
	exception            longtext  NOT NULL    ,
	failed_at            timestamp  NOT NULL DEFAULT (current_timestamp())   ,
	CONSTRAINT failed_jobs_uuid_unique UNIQUE ( uuid )
 );

CREATE TABLE immo.fournisseur (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	nom_fournisseur      varchar(100)  NOT NULL    ,
	siege_social         varchar(50)  NOT NULL    ,
	telephone            varchar(50)  NOT NULL    ,
	email                varchar(50)  NOT NULL
 );

CREATE TABLE immo.gardien (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	nom_gardien          varchar(100)  NOT NULL    ,
	prenom               varchar(100)  NOT NULL
 );

CREATE TABLE immo.marque (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	marque               varchar(100)
 );

CREATE TABLE immo.methode_amortissement (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	methode              varchar(80)  NOT NULL
 );

CREATE TABLE immo.migrations (
	id                   int UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	migration            varchar(255)  NOT NULL    ,
	batch                int  NOT NULL
 );

CREATE TABLE immo.modele (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	modele               varchar(100)  NOT NULL
 );

CREATE TABLE immo.password_resets (
	email                varchar(255)  NOT NULL    ,
	token                varchar(255)  NOT NULL    ,
	created_at           timestamp
 );

CREATE TABLE immo.post_tbl (
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	created_at           timestamp      ,
	updated_at           timestamp
 );

CREATE TABLE immo.service (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	nom_service          varchar(100)  NOT NULL
 );

CREATE TABLE immo.sous_categorie (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	nom_sous_categorie   varchar(100)  NOT NULL    ,
	id_categorie         int  NOT NULL
 );

CREATE TABLE immo.taille (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	taille               varchar(100)  NOT NULL
 );

CREATE TABLE immo.travail (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	nom_travail          varchar(100)
 );

CREATE TABLE immo.type_cession (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	type_cession         varchar(100)
 );

CREATE TABLE immo.article (
	code_article         int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	nom                  varchar(100)  NOT NULL    ,
	designation          varchar(100)  NOT NULL    ,
	designation_courte   varchar(100)  NOT NULL    ,
	id_categorie         int  NOT NULL    ,
	id_sous_categorie    int  NOT NULL    ,
	id_departement       int  NOT NULL    ,
	id_service           int  NOT NULL    ,
	id_methode_amortissement int  NOT NULL    ,
	duree_annee          int  NOT NULL    ,
	id_modele            int  NOT NULL    ,
	id_couleur           int  NOT NULL    ,
	id_taille            int  NOT NULL    ,
	id_marque            int  NOT NULL    ,
	CONSTRAINT fk_article_categorie FOREIGN KEY ( id_categorie ) REFERENCES immo.categorie( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_article_couleur FOREIGN KEY ( id_couleur ) REFERENCES immo.couleur( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_article_departement FOREIGN KEY ( id_departement ) REFERENCES immo.departement( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_article_marque FOREIGN KEY ( id_marque ) REFERENCES immo.marque( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_article FOREIGN KEY ( id_methode_amortissement ) REFERENCES immo.methode_amortissement( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_article_modele FOREIGN KEY ( id_modele ) REFERENCES immo.modele( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_article_service FOREIGN KEY ( id_service ) REFERENCES immo.service( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_article_sous_categorie FOREIGN KEY ( id_sous_categorie ) REFERENCES immo.sous_categorie( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_article_taille FOREIGN KEY ( id_taille ) REFERENCES immo.taille( id ) ON DELETE RESTRICT ON UPDATE RESTRICT
 );

CREATE TABLE immo.consignataire (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	id_gardien           int  NOT NULL    ,
	id_travail           int  NOT NULL    ,
	id_departement       int  NOT NULL    ,
	id_service           int  NOT NULL    ,
	id_extension         int  NOT NULL    ,
	CONSTRAINT fk_consignataire_departement FOREIGN KEY ( id_departement ) REFERENCES immo.departement( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_consignataire_extension FOREIGN KEY ( id_extension ) REFERENCES immo.extension( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_consignataire_gardien FOREIGN KEY ( id_gardien ) REFERENCES immo.gardien( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_consignataire_service FOREIGN KEY ( id_service ) REFERENCES immo.service( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_consignataire_travail FOREIGN KEY ( id_travail ) REFERENCES immo.travail( id ) ON DELETE RESTRICT ON UPDATE RESTRICT
 );

CREATE TABLE immo.facture (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	`date`               date  NOT NULL    ,
	id_fournisseur       int  NOT NULL    ,
	id__consignataire    int  NOT NULL    ,
	id_departement       int  NOT NULL    ,
	id_devise            int  NOT NULL    ,
	CONSTRAINT fk_facture_consignataire FOREIGN KEY ( id__consignataire ) REFERENCES immo.consignataire( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_facture_departement FOREIGN KEY ( id_departement ) REFERENCES immo.departement( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_facture_devise FOREIGN KEY ( id_devise ) REFERENCES immo.devise( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_facture_fournisseur FOREIGN KEY ( id_fournisseur ) REFERENCES immo.fournisseur( id ) ON DELETE RESTRICT ON UPDATE RESTRICT
 );

CREATE TABLE immo.inventaire_immo (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	date_inventaire      date  NOT NULL    ,
	id_consignataire     int  NOT NULL    ,
	id_categorie         int  NOT NULL    ,
	id_emplacement       int      ,
	id_gardien           int      ,
	CONSTRAINT fk_inventaire_immo_categorie FOREIGN KEY ( id_categorie ) REFERENCES immo.categorie( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_inventaire_immo FOREIGN KEY ( id_consignataire ) REFERENCES immo.consignataire( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_inventaire_immo_emplacement FOREIGN KEY ( id_emplacement ) REFERENCES immo.emplacement( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_inventaire_immo_gardien FOREIGN KEY ( id_gardien ) REFERENCES immo.gardien( id ) ON DELETE RESTRICT ON UPDATE RESTRICT
 );

CREATE TABLE immo.login (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	id_consignataire     int  NOT NULL    ,
	utilisateur          varchar(100)  NOT NULL    ,
	mot_de_passe         varchar(100)  NOT NULL    ,
	CONSTRAINT fk_login_consignataire FOREIGN KEY ( id_consignataire ) REFERENCES immo.consignataire( id ) ON DELETE RESTRICT ON UPDATE RESTRICT
 );

CREATE TABLE immo.reception (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	date_reception       date  NOT NULL    ,
	id_fournisseur       int  NOT NULL    ,
	id_consignataire     int  NOT NULL    ,
	id_emplacement       int      ,
	id_facture           int      ,
	CONSTRAINT fk_reception_consignataire FOREIGN KEY ( id_consignataire ) REFERENCES immo.consignataire( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_reception_emplacement FOREIGN KEY ( id_emplacement ) REFERENCES immo.emplacement( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_reception_facture FOREIGN KEY ( id_facture ) REFERENCES immo.facture( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_reception_fournisseur FOREIGN KEY ( id_fournisseur ) REFERENCES immo.fournisseur( id ) ON DELETE RESTRICT ON UPDATE RESTRICT
 );

CREATE TABLE immo.users (
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	name                 int  NOT NULL    ,
	email                varchar(255)  NOT NULL    ,
	password             varchar(255)  NOT NULL    ,
	CONSTRAINT users_email_unique UNIQUE ( email ) ,
	CONSTRAINT fk_users_consignataire FOREIGN KEY ( name ) REFERENCES immo.consignataire( id ) ON DELETE RESTRICT ON UPDATE RESTRICT
 );

CREATE TABLE immo.details_facture (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	id_article           int  NOT NULL    ,
	description          varchar(100)  NOT NULL    ,
	quantite             int  NOT NULL    ,
	prix_unitaire        double  NOT NULL    ,
	commanded            int  NOT NULL    ,
	id_facture           int  NOT NULL    ,
	tva                  int      ,
	CONSTRAINT fk_details_facture_article FOREIGN KEY ( id_article ) REFERENCES immo.article( code_article ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_details_facture_facture FOREIGN KEY ( id_facture ) REFERENCES immo.facture( id ) ON DELETE RESTRICT ON UPDATE RESTRICT
 );

CREATE TABLE immo.details_reception (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	id_article           int      ,
	commanded            int      ,
	recu                 int      ,
	restant              int      ,
	id_reception         int      ,
	remarque             varchar(150)      ,
	CONSTRAINT fk_details_reception_article FOREIGN KEY ( id_article ) REFERENCES immo.article( code_article ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_details_reception_reception FOREIGN KEY ( id_reception ) REFERENCES immo.reception( id ) ON DELETE RESTRICT ON UPDATE RESTRICT
 );

CREATE TABLE immo.immo (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	code_reception       int  NOT NULL    ,
	code_barre           int UNSIGNED     ,
	id_emplacement       int  NOT NULL DEFAULT (37)   ,
	id_details_reception int  NOT NULL    ,
	deleted              tinyint   DEFAULT (0)   ,
	CONSTRAINT code_barre UNIQUE ( code_barre ) ,
	CONSTRAINT fk_immo_details_reception FOREIGN KEY ( id_details_reception ) REFERENCES immo.details_reception( id ) ON DELETE RESTRICT ON UPDATE RESTRICT
 );

CREATE TABLE immo.transfert_immo (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	date_transfert       date  NOT NULL    ,
	id_consignataire     int  NOT NULL    ,
	id_immo              int  NOT NULL    ,
	remarque             varchar(100)      ,
	id_emplacement       int  NOT NULL    ,
	CONSTRAINT fk_transfert_immo FOREIGN KEY ( id_consignataire ) REFERENCES immo.consignataire( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_transfert_immo_emplacement FOREIGN KEY ( id_emplacement ) REFERENCES immo.emplacement( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_transfert_immo_immo FOREIGN KEY ( id_immo ) REFERENCES immo.immo( id ) ON DELETE RESTRICT ON UPDATE RESTRICT
 );

CREATE TABLE immo.cession_immo (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	date_cession         date  NOT NULL    ,
	id_immo              int  NOT NULL    ,
	id_devise            int  NOT NULL    ,
	id_type              int      ,
	prix_final           int      ,
	CONSTRAINT fk_cession_immo_devise FOREIGN KEY ( id_devise ) REFERENCES immo.devise( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_cession_immo_immo FOREIGN KEY ( id_immo ) REFERENCES immo.immo( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_cession_immo_type_cession FOREIGN KEY ( id_type ) REFERENCES immo.type_cession( id ) ON DELETE RESTRICT ON UPDATE RESTRICT
 );

CREATE TABLE immo.details_inventaire (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	id_inventaire        int      ,
	id_immo              int      ,
	etat                 tinyint      ,
	id_etat_usage        int      ,
	CONSTRAINT fk_etat_usage FOREIGN KEY ( id_etat_usage ) REFERENCES immo.etat_usage( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_details_inventaire_immo FOREIGN KEY ( id_immo ) REFERENCES immo.immo( id ) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_details_inventaire FOREIGN KEY ( id_inventaire ) REFERENCES immo.inventaire_immo( id ) ON DELETE RESTRICT ON UPDATE RESTRICT
 );

CREATE INDEX password_resets_email_index ON immo.password_resets ( email );

CREATE INDEX fk_article ON immo.article ( id_methode_amortissement );

CREATE INDEX fk_article_categorie ON immo.article ( id_categorie );

CREATE INDEX fk_article_couleur ON immo.article ( id_couleur );

CREATE INDEX fk_article_departement ON immo.article ( id_departement );

CREATE INDEX fk_article_marque ON immo.article ( id_marque );

CREATE INDEX fk_article_modele ON immo.article ( id_modele );

CREATE INDEX fk_article_service ON immo.article ( id_service );

CREATE INDEX fk_article_sous_categorie ON immo.article ( id_sous_categorie );

CREATE INDEX fk_article_taille ON immo.article ( id_taille );

CREATE INDEX fk_consignataire_departement ON immo.consignataire ( id_departement );

CREATE INDEX fk_consignataire_extension ON immo.consignataire ( id_extension );

CREATE INDEX fk_consignataire_gardien ON immo.consignataire ( id_gardien );

CREATE INDEX fk_consignataire_service ON immo.consignataire ( id_service );

CREATE INDEX fk_consignataire_travail ON immo.consignataire ( id_travail );

CREATE INDEX fk_facture_consignataire ON immo.facture ( id__consignataire );

CREATE INDEX fk_facture_departement ON immo.facture ( id_departement );

CREATE INDEX fk_facture_devise ON immo.facture ( id_devise );

CREATE INDEX fk_facture_fournisseur ON immo.facture ( id_fournisseur );

CREATE INDEX fk_inventaire_immo ON immo.inventaire_immo ( id_consignataire );

CREATE INDEX fk_inventaire_immo_categorie ON immo.inventaire_immo ( id_categorie );

CREATE INDEX fk_inventaire_immo_emplacement ON immo.inventaire_immo ( id_emplacement );

CREATE INDEX fk_inventaire_immo_gardien ON immo.inventaire_immo ( id_gardien );

CREATE INDEX fk_login_consignataire ON immo.login ( id_consignataire );

CREATE INDEX fk_reception_consignataire ON immo.reception ( id_consignataire );

CREATE INDEX fk_reception_emplacement ON immo.reception ( id_emplacement );

CREATE INDEX fk_reception_facture ON immo.reception ( id_facture );

CREATE INDEX fk_reception_fournisseur ON immo.reception ( id_fournisseur );

CREATE INDEX fk_users_consignataire ON immo.users ( name );

CREATE INDEX fk_details_facture_article ON immo.details_facture ( id_article );

CREATE INDEX fk_details_facture_facture ON immo.details_facture ( id_facture );

CREATE INDEX fk_details_reception_article ON immo.details_reception ( id_article );

CREATE INDEX fk_details_reception_reception ON immo.details_reception ( id_reception );

CREATE INDEX fk_immo_details_reception ON immo.immo ( id_details_reception );

CREATE INDEX fk_transfert_immo ON immo.transfert_immo ( id_consignataire );

CREATE INDEX fk_transfert_immo_emplacement ON immo.transfert_immo ( id_emplacement );

CREATE INDEX fk_transfert_immo_immo ON immo.transfert_immo ( id_immo );

CREATE INDEX fk_cession_immo_devise ON immo.cession_immo ( id_devise );

CREATE INDEX fk_cession_immo_immo ON immo.cession_immo ( id_immo );

CREATE INDEX fk_cession_immo_type_cession ON immo.cession_immo ( id_type );

CREATE INDEX fk_details_inventaire ON immo.details_inventaire ( id_inventaire );

CREATE INDEX fk_details_inventaire_immo ON immo.details_inventaire ( id_immo );

CREATE INDEX fk_etat_usage ON immo.details_inventaire ( id_etat_usage );

CREATE VIEW immo.v_article AS select `immo`.`article`.`code_article` AS `code_article`,`immo`.`article`.`nom` AS `nom_article`,`immo`.`article`.`designation` AS `designation_article`,`immo`.`article`.`designation_courte` AS `designation_courte_article`,`immo`.`article`.`duree_annee` AS `annee_amortie`,`immo`.`article`.`id_categorie` AS `id_categorie`,`immo`.`categorie`.`nom_categorie` AS `categorie_article`,`immo`.`sous_categorie`.`nom_sous_categorie` AS `sous_categorie_article`,`immo`.`departement`.`departement` AS `departement_article`,`immo`.`service`.`nom_service` AS `service_article`,`immo`.`couleur`.`couleur` AS `couleur_article`,`immo`.`marque`.`marque` AS `marque_article`,`immo`.`modele`.`modele` AS `modele_article`,`immo`.`taille`.`taille` AS `taille_article`,`immo`.`methode_amortissement`.`methode` AS `amortissement_article` from (((((((((`immo`.`article` join `immo`.`categorie` on(`immo`.`categorie`.`id` = `immo`.`article`.`id_categorie`)) join `immo`.`sous_categorie` on(`immo`.`sous_categorie`.`id` = `immo`.`article`.`id_sous_categorie`)) join `immo`.`departement` on(`immo`.`departement`.`id` = `immo`.`article`.`id_departement`)) join `immo`.`service` on(`immo`.`service`.`id` = `immo`.`article`.`id_service`)) join `immo`.`couleur` on(`immo`.`couleur`.`id` = `immo`.`article`.`id_couleur`)) join `immo`.`marque` on(`immo`.`marque`.`id` = `immo`.`article`.`id_marque`)) join `immo`.`modele` on(`immo`.`modele`.`id` = `immo`.`article`.`id_modele`)) join `immo`.`taille` on(`immo`.`taille`.`id` = `immo`.`article`.`id_taille`)) join `immo`.`methode_amortissement` on(`immo`.`methode_amortissement`.`id` = `immo`.`article`.`id_methode_amortissement`));

CREATE VIEW immo.v_cession AS select `immo`.`cession_immo`.`id` AS `id`,`immo`.`cession_immo`.`date_cession` AS `date_cession`,`immo`.`cession_immo`.`id_immo` AS `id_immo`,`immo`.`immo`.`code_barre` AS `code_barre`,`immo`.`immo`.`deleted` AS `deleted`,`immo`.`cession_immo`.`id_devise` AS `id_devise`,`immo`.`devise`.`devise` AS `devise`,`immo`.`cession_immo`.`id_type` AS `id_type`,`immo`.`type_cession`.`type_cession` AS `type_cession`,`immo`.`cession_immo`.`prix_final` AS `prix_final` from (((`immo`.`cession_immo` join `immo`.`immo` on(`immo`.`immo`.`id` = `immo`.`cession_immo`.`id_immo`)) join `immo`.`devise` on(`immo`.`devise`.`id` = `immo`.`cession_immo`.`id_devise`)) join `immo`.`type_cession` on(`immo`.`type_cession`.`id` = `immo`.`cession_immo`.`id_type`));

CREATE VIEW immo.v_details_inventaire AS select `immo`.`inventaire_immo`.`id` AS `id`,`immo`.`inventaire_immo`.`id_categorie` AS `id_categorie`,`immo`.`inventaire_immo`.`date_inventaire` AS `date_inventaire`,`immo`.`categorie`.`nom_categorie` AS `nom_categorie`,`immo`.`inventaire_immo`.`id_emplacement` AS `id_emplacement`,`immo`.`emplacement`.`emplacement` AS `emplacement`,`immo`.`details_inventaire`.`id_inventaire` AS `id_inventaire`,`immo`.`details_inventaire`.`id_immo` AS `id_immo`,`immo`.`immo`.`code_barre` AS `code_barre`,`immo`.`details_inventaire`.`etat` AS `etat`,`immo`.`details_inventaire`.`id_etat_usage` AS `id_etat_usage`,`immo`.`etat_usage`.`etat` AS `etat_usage`,`immo`.`article`.`designation` AS `designation` from (((((((`immo`.`inventaire_immo` join `immo`.`details_inventaire` on(`immo`.`details_inventaire`.`id_inventaire` = `immo`.`inventaire_immo`.`id`)) join `immo`.`immo` on(`immo`.`immo`.`id` = `immo`.`details_inventaire`.`id_immo`)) join `immo`.`emplacement` on(`immo`.`emplacement`.`id` = `immo`.`inventaire_immo`.`id_emplacement`)) join `immo`.`categorie` on(`immo`.`categorie`.`id` = `immo`.`inventaire_immo`.`id_categorie`)) join `immo`.`details_reception` on(`immo`.`details_reception`.`id` = `immo`.`immo`.`id_details_reception`)) join `immo`.`article` on(`immo`.`article`.`code_article` = `immo`.`details_reception`.`id_article`)) join `immo`.`etat_usage` on(`immo`.`etat_usage`.`id` = `immo`.`details_inventaire`.`id_etat_usage`));

CREATE VIEW immo.v_facture AS select `immo`.`facture`.`id` AS `id`,`immo`.`facture`.`date` AS `date`,`immo`.`facture`.`id_fournisseur` AS `id_fournisseur`,`immo`.`fournisseur`.`nom_fournisseur` AS `nom_fournisseur`,`immo`.`facture`.`id__consignataire` AS `id__consignataire`,`immo`.`facture`.`id_departement` AS `id_departement`,`immo`.`facture`.`id_devise` AS `id_devise`,`immo`.`consignataire`.`id_gardien` AS `id_gardien`,`immo`.`gardien`.`nom_gardien` AS `nom_gardien`,`immo`.`gardien`.`prenom` AS `prenom`,`immo`.`devise`.`devise` AS `devise`,`immo`.`devise`.`description_devise` AS `description_devise`,`immo`.`departement`.`departement` AS `departement`,`immo`.`details_facture`.`id` AS `id_details_facture`,`immo`.`details_facture`.`id_article` AS `id_article`,`immo`.`details_facture`.`description` AS `description`,`immo`.`details_facture`.`quantite` AS `quantite`,`immo`.`details_facture`.`prix_unitaire` AS `prix_unitaire`,`immo`.`details_facture`.`commanded` AS `commanded`,`immo`.`details_facture`.`id_facture` AS `id_facture`,`immo`.`article`.`code_article` AS `code_article`,`immo`.`article`.`nom` AS `nom`,`immo`.`article`.`designation` AS `designation`,`immo`.`article`.`id_categorie` AS `id_categorie` from (((((((`immo`.`facture` join `immo`.`fournisseur` on(`immo`.`fournisseur`.`id` = `immo`.`facture`.`id_fournisseur`)) join `immo`.`consignataire` on(`immo`.`consignataire`.`id` = `immo`.`facture`.`id__consignataire`)) join `immo`.`departement` on(`immo`.`departement`.`id` = `immo`.`facture`.`id_departement`)) join `immo`.`gardien` on(`immo`.`gardien`.`id` = `immo`.`consignataire`.`id_gardien`)) join `immo`.`devise` on(`immo`.`devise`.`id` = `immo`.`facture`.`id_devise`)) join `immo`.`details_facture` on(`immo`.`details_facture`.`id_facture` = `immo`.`facture`.`id`)) join `immo`.`article` on(`immo`.`article`.`code_article` = `immo`.`details_facture`.`id_article`));

CREATE VIEW immo.v_facture_details AS select `immo`.`details_facture`.`id` AS `id`,rank() over ( partition by `immo`.`details_facture`.`id_facture` order by `immo`.`details_facture`.`id`) AS `numero_article_facture`,`immo`.`details_facture`.`id_facture` AS `id_facture`,`immo`.`details_facture`.`id_article` AS `id_article`,`immo`.`details_facture`.`description` AS `description`,`immo`.`details_facture`.`quantite` AS `quantite`,`immo`.`details_facture`.`commanded` AS `commanded`,`immo`.`details_facture`.`prix_unitaire` AS `prix_unitaire`,`immo`.`details_facture`.`tva` AS `tva`,`immo`.`details_facture`.`quantite` * `immo`.`details_facture`.`prix_unitaire` AS `total_details`,`immo`.`details_facture`.`quantite` * `immo`.`details_facture`.`prix_unitaire` + `immo`.`details_facture`.`quantite` * `immo`.`details_facture`.`prix_unitaire` * `immo`.`details_facture`.`tva` / 100 AS `total_soumis_tva` from `immo`.`details_facture`;

CREATE VIEW immo.v_grand_total AS select `v_facture_details`.`id_facture` AS `id_facture`,sum(`v_facture_details`.`total_details`) AS `montant_sans_tva`,sum(`v_facture_details`.`total_soumis_tva`) AS `montant_avec_tva` from `immo`.`v_facture_details` group by `v_facture_details`.`id_facture`;

CREATE VIEW immo.v_inventaire AS select `immo`.`immo`.`id` AS `id_immo`,`immo`.`immo`.`code_barre` AS `code_barre`,`immo`.`immo`.`id_details_reception` AS `id_details_reception`,`immo`.`immo`.`id_emplacement` AS `id_emplacement`,`immo`.`details_reception`.`id_article` AS `id_article`,`immo`.`article`.`designation` AS `designation`,`immo`.`article`.`id_categorie` AS `id_categorie`,`immo`.`categorie`.`id` AS `id`,`immo`.`emplacement`.`emplacement` AS `emplacement` from ((((`immo`.`immo` join `immo`.`details_reception` on(`immo`.`details_reception`.`id` = `immo`.`immo`.`id_details_reception`)) join `immo`.`article` on(`immo`.`article`.`code_article` = `immo`.`details_reception`.`id_article`)) join `immo`.`emplacement` on(`immo`.`emplacement`.`id` = `immo`.`immo`.`id_emplacement`)) join `immo`.`categorie` on(`immo`.`categorie`.`id` = `immo`.`article`.`id_categorie`));

CREATE VIEW immo.v_liste_inventaire AS select `immo`.`inventaire_immo`.`id` AS `id`,`immo`.`inventaire_immo`.`date_inventaire` AS `date_inventaire`,`immo`.`inventaire_immo`.`id_emplacement` AS `id_emplacement`,`immo`.`emplacement`.`emplacement` AS `emplacement`,`immo`.`inventaire_immo`.`id_categorie` AS `id_categorie`,`immo`.`categorie`.`nom_categorie` AS `nom_categorie`,`immo`.`inventaire_immo`.`id_gardien` AS `id_gardien`,`immo`.`gardien`.`nom_gardien` AS `nom_gardien`,`immo`.`gardien`.`prenom` AS `prenom` from (((`immo`.`inventaire_immo` join `immo`.`emplacement` on(`immo`.`emplacement`.`id` = `immo`.`inventaire_immo`.`id_emplacement`)) join `immo`.`categorie` on(`immo`.`categorie`.`id` = `immo`.`inventaire_immo`.`id_categorie`)) join `immo`.`gardien` on(`immo`.`gardien`.`id` = `immo`.`inventaire_immo`.`id_gardien`));

CREATE VIEW immo.v_login AS select `immo`.`users`.`id` AS `id`,`immo`.`users`.`name` AS `name`,`immo`.`consignataire`.`id_gardien` AS `id_gardien`,`immo`.`gardien`.`nom_gardien` AS `nom_gardien`,`immo`.`gardien`.`prenom` AS `prenom`,`immo`.`users`.`email` AS `email`,`immo`.`users`.`password` AS `password` from ((`immo`.`users` join `immo`.`consignataire` on(`immo`.`consignataire`.`id` = `immo`.`users`.`name`)) join `immo`.`gardien` on(`immo`.`gardien`.`id` = `immo`.`consignataire`.`id_gardien`));

CREATE VIEW immo.v_reception AS select `immo`.`reception`.`id` AS `code_reception`,`immo`.`reception`.`date_reception` AS `date_reception`,`immo`.`reception`.`id_facture` AS `facture_reception`,`immo`.`reception`.`id_fournisseur` AS `id_fournisseur`,`immo`.`fournisseur`.`nom_fournisseur` AS `fournisseur`,`immo`.`reception`.`id_consignataire` AS `id_consignataire`,`v_login`.`nom_gardien` AS `nom_consignataire`,`v_login`.`prenom` AS `prenom_consignataire`,`immo`.`details_reception`.`id` AS `id_details_reception`,`immo`.`details_reception`.`id_reception` AS `id_reception`,`immo`.`details_reception`.`commanded` AS `commande`,`immo`.`details_reception`.`restant` AS `restant`,`immo`.`details_reception`.`recu` AS `recu`,`immo`.`details_reception`.`remarque` AS `remarque`,`immo`.`details_reception`.`id_article` AS `code_article` from ((((((`immo`.`reception` join `immo`.`facture` on(`immo`.`facture`.`id` = `immo`.`reception`.`id_facture`)) join `immo`.`fournisseur` on(`immo`.`fournisseur`.`id` = `immo`.`reception`.`id_fournisseur`)) join `immo`.`details_reception` on(`immo`.`details_reception`.`id_reception` = `immo`.`reception`.`id`)) join `immo`.`consignataire` on(`immo`.`consignataire`.`id` = `immo`.`reception`.`id_consignataire`)) join `immo`.`gardien` on(`immo`.`gardien`.`id` = `immo`.`consignataire`.`id_gardien`)) join `immo`.`v_login` on(`v_login`.`id_gardien` = `immo`.`gardien`.`id`));

CREATE VIEW immo.v_search_article AS select `immo`.`article`.`code_article` AS `code_article`,`immo`.`article`.`nom` AS `nom_article`,`immo`.`article`.`designation` AS `designation_article`,`immo`.`article`.`designation_courte` AS `designation_courte_article`,`immo`.`article`.`duree_annee` AS `annee_amortie`,`immo`.`categorie`.`nom_categorie` AS `categorie_article`,`immo`.`sous_categorie`.`nom_sous_categorie` AS `sous_categorie_article`,`immo`.`departement`.`departement` AS `departement_article`,`immo`.`service`.`nom_service` AS `service_article`,`immo`.`couleur`.`couleur` AS `couleur_article`,`immo`.`marque`.`marque` AS `marque_article`,`immo`.`modele`.`modele` AS `modele_article`,`immo`.`taille`.`taille` AS `taille_article`,`immo`.`methode_amortissement`.`methode` AS `amortissement_article`,`immo`.`details_facture`.`id_article` AS `details_facture_article`,`immo`.`details_facture`.`id_facture` AS `facture`,`immo`.`facture`.`id_fournisseur` AS `fournisseur_id`,`immo`.`fournisseur`.`nom_fournisseur` AS `fournisseur` from ((((((((((((`immo`.`article` join `immo`.`categorie` on(`immo`.`categorie`.`id` = `immo`.`article`.`id_categorie`)) join `immo`.`sous_categorie` on(`immo`.`sous_categorie`.`id` = `immo`.`article`.`id_sous_categorie`)) join `immo`.`departement` on(`immo`.`departement`.`id` = `immo`.`article`.`id_departement`)) join `immo`.`service` on(`immo`.`service`.`id` = `immo`.`article`.`id_service`)) join `immo`.`couleur` on(`immo`.`couleur`.`id` = `immo`.`article`.`id_couleur`)) join `immo`.`marque` on(`immo`.`marque`.`id` = `immo`.`article`.`id_marque`)) join `immo`.`modele` on(`immo`.`modele`.`id` = `immo`.`article`.`id_modele`)) join `immo`.`taille` on(`immo`.`taille`.`id` = `immo`.`article`.`id_taille`)) join `immo`.`methode_amortissement` on(`immo`.`methode_amortissement`.`id` = `immo`.`article`.`id_methode_amortissement`)) join `immo`.`details_facture` on(`immo`.`details_facture`.`id_article` = `immo`.`article`.`code_article`)) join `immo`.`facture` on(`immo`.`facture`.`id` = `immo`.`details_facture`.`id_facture`)) join `immo`.`fournisseur` on(`immo`.`fournisseur`.`id` = `immo`.`facture`.`id_fournisseur`));

CREATE VIEW immo.v_stock_article AS select `immo`.`immo`.`id` AS `id`,`immo`.`immo`.`code_barre` AS `code_barre`,`immo`.`immo`.`id_details_reception` AS `id_details_reception`,`immo`.`immo`.`id_emplacement` AS `id_emplacement`,`immo`.`details_reception`.`id_article` AS `id_article`,`immo`.`article`.`designation` AS `designation`,`immo`.`emplacement`.`emplacement` AS `emplacement` from (((`immo`.`immo` join `immo`.`details_reception` on(`immo`.`details_reception`.`id` = `immo`.`immo`.`id_details_reception`)) join `immo`.`article` on(`immo`.`details_reception`.`id_article` = `immo`.`article`.`code_article`)) join `immo`.`emplacement` on(`immo`.`emplacement`.`id` = `immo`.`immo`.`id_emplacement`));

CREATE VIEW immo.v_total_montant AS select `v_facture_details`.`id` AS `id`,`v_facture_details`.`total_details` AS `total_details`,`v_facture_details`.`total_soumis_tva` AS `total_soumis_tva`,sum(`v_facture_details`.`total_details`) AS `montant_sans_tva`,sum(`v_facture_details`.`total_soumis_tva`) AS `montant_avec_tva` from `immo`.`v_facture_details` group by `v_facture_details`.`id`;

CREATE VIEW immo.v_transfert AS select `immo`.`transfert_immo`.`id` AS `code_transfert`,`immo`.`transfert_immo`.`date_transfert` AS `date_transfert`,`immo`.`immo`.`id` AS `is_immo`,`immo`.`immo`.`code_barre` AS `code_barre`,`immo`.`transfert_immo`.`id_consignataire` AS `id_consignataire`,`immo`.`consignataire`.`id_gardien` AS `id_gardien`,`immo`.`gardien`.`nom_gardien` AS `nom_gardien`,`immo`.`gardien`.`prenom` AS `prenom`,`immo`.`transfert_immo`.`id_immo` AS `id_immo`,`immo`.`transfert_immo`.`remarque` AS `remarque`,`immo`.`transfert_immo`.`id_emplacement` AS `id_emplacement`,`immo`.`emplacement`.`emplacement` AS `emplacement` from ((((`immo`.`transfert_immo` join `immo`.`immo` on(`immo`.`immo`.`id` = `immo`.`transfert_immo`.`id_immo`)) join `immo`.`consignataire` on(`immo`.`consignataire`.`id` = `immo`.`transfert_immo`.`id_consignataire`)) join `immo`.`gardien` on(`immo`.`gardien`.`id` = `immo`.`consignataire`.`id_gardien`)) join `immo`.`emplacement` on(`immo`.`emplacement`.`id` = `immo`.`transfert_immo`.`id_emplacement`));

INSERT INTO immo.categorie( id, nom_categorie, taux_amortissement, duree_vie ) VALUES ( 1, 'I.AAI', 10, 10);
INSERT INTO immo.categorie( id, nom_categorie, taux_amortissement, duree_vie ) VALUES ( 2, 'I.Batiment annexe', 2, 50);
INSERT INTO immo.categorie( id, nom_categorie, taux_amortissement, duree_vie ) VALUES ( 3, 'I.Concessions et droits sim brevet', 25, 4);
INSERT INTO immo.categorie( id, nom_categorie, taux_amortissement, duree_vie ) VALUES ( 4, 'I.Immeubles Cem', 2, 50);
INSERT INTO immo.categorie( id, nom_categorie, taux_amortissement, duree_vie ) VALUES ( 5, 'I.Immo corporelles en cours', 0, 0);
INSERT INTO immo.categorie( id, nom_categorie, taux_amortissement, duree_vie ) VALUES ( 6, 'I.Logiciels Informatiques et ASSIM', 25, 4);
INSERT INTO immo.categorie( id, nom_categorie, taux_amortissement, duree_vie ) VALUES ( 7, 'I.Materiels de transport', 20, 5);
INSERT INTO immo.categorie( id, nom_categorie, taux_amortissement, duree_vie ) VALUES ( 8, 'I.Materiels et mobiliers de bureau', 10, 10);
INSERT INTO immo.categorie( id, nom_categorie, taux_amortissement, duree_vie ) VALUES ( 9, 'I.Materiels et mobiliers de logement', 10, 10);
INSERT INTO immo.categorie( id, nom_categorie, taux_amortissement, duree_vie ) VALUES ( 10, 'I.Materiels et outillages', 10, 10);
INSERT INTO immo.categorie( id, nom_categorie, taux_amortissement, duree_vie ) VALUES ( 11, 'I.Materiels informatiques', 25, 4);
INSERT INTO immo.categorie( id, nom_categorie, taux_amortissement, duree_vie ) VALUES ( 12, 'I.Terrains', 0, 0);
INSERT INTO immo.couleur( id, couleur ) VALUES ( 1, 'Bleu');
INSERT INTO immo.couleur( id, couleur ) VALUES ( 2, 'Beige');
INSERT INTO immo.couleur( id, couleur ) VALUES ( 3, 'Noir');
INSERT INTO immo.couleur( id, couleur ) VALUES ( 4, 'Gris');
INSERT INTO immo.couleur( id, couleur ) VALUES ( 5, 'Vert');
INSERT INTO immo.couleur( id, couleur ) VALUES ( 6, 'Mec 6 feet');
INSERT INTO immo.couleur( id, couleur ) VALUES ( 7, 'Rouge');
INSERT INTO immo.couleur( id, couleur ) VALUES ( 8, 'Blanc');
INSERT INTO immo.couleur( id, couleur ) VALUES ( 9, 'Jaune');
INSERT INTO immo.departement( id, departement ) VALUES ( 1, 'Agence CEM 001');
INSERT INTO immo.departement( id, departement ) VALUES ( 2, 'Agence CEM 002');
INSERT INTO immo.departement( id, departement ) VALUES ( 3, 'Agence CEM 003');
INSERT INTO immo.departement( id, departement ) VALUES ( 4, 'Agence CEM 004');
INSERT INTO immo.departement( id, departement ) VALUES ( 5, 'Agence CEM 005');
INSERT INTO immo.departement( id, departement ) VALUES ( 6, 'Agence CEM 006');
INSERT INTO immo.departement( id, departement ) VALUES ( 7, 'Agence CEM 008');
INSERT INTO immo.departement( id, departement ) VALUES ( 8, 'Agence CEM 009');
INSERT INTO immo.departement( id, departement ) VALUES ( 9, 'Agence CEM 010');
INSERT INTO immo.departement( id, departement ) VALUES ( 10, 'Agence CEM 011');
INSERT INTO immo.departement( id, departement ) VALUES ( 11, 'Agence CEM 012');
INSERT INTO immo.departement( id, departement ) VALUES ( 12, 'Agence CEM 016');
INSERT INTO immo.departement( id, departement ) VALUES ( 13, 'Agence CEM 017');
INSERT INTO immo.departement( id, departement ) VALUES ( 14, 'Agence CEM 018');
INSERT INTO immo.departement( id, departement ) VALUES ( 15, 'Agence CEM 019');
INSERT INTO immo.departement( id, departement ) VALUES ( 16, 'Agence CEM 020');
INSERT INTO immo.departement( id, departement ) VALUES ( 17, 'Agence CEM 024');
INSERT INTO immo.departement( id, departement ) VALUES ( 18, 'Agence CEM 028');
INSERT INTO immo.departement( id, departement ) VALUES ( 19, 'Agence CEM 029');
INSERT INTO immo.departement( id, departement ) VALUES ( 20, 'Agence CEM 043');
INSERT INTO immo.departement( id, departement ) VALUES ( 21, 'Agence CEM 044');
INSERT INTO immo.departement( id, departement ) VALUES ( 22, 'Agence CEM 046');
INSERT INTO immo.departement( id, departement ) VALUES ( 23, 'Agence CEM 048');
INSERT INTO immo.departement( id, departement ) VALUES ( 24, 'Agence CEM 049');
INSERT INTO immo.departement( id, departement ) VALUES ( 25, 'Agence CEM 086');
INSERT INTO immo.departement( id, departement ) VALUES ( 26, 'Agence CEM 170');
INSERT INTO immo.departement( id, departement ) VALUES ( 27, 'Agence CEM 177');
INSERT INTO immo.departement( id, departement ) VALUES ( 28, 'Agence CEM 477');
INSERT INTO immo.departement( id, departement ) VALUES ( 29, 'Agence CEM 770');
INSERT INTO immo.departement( id, departement ) VALUES ( 30, 'Agence CEM 777');
INSERT INTO immo.departement( id, departement ) VALUES ( 31, 'Direction Administrative et financière');
INSERT INTO immo.departement( id, departement ) VALUES ( 32, 'Direction des affaires juridiques');
INSERT INTO immo.departement( id, departement ) VALUES ( 33, 'Direction des opérations');
INSERT INTO immo.departement( id, departement ) VALUES ( 34, 'Direction des études et du marketing');
INSERT INTO immo.departement( id, departement ) VALUES ( 35, 'Direction des relations avec la clientèle');
INSERT INTO immo.departement( id, departement ) VALUES ( 36, 'Direction des ressources humaines');
INSERT INTO immo.departement( id, departement ) VALUES ( 37, 'Direction du contrôle interne');
INSERT INTO immo.departement( id, departement ) VALUES ( 38, 'Direction du patrimoine et de la logistique');
INSERT INTO immo.departement( id, departement ) VALUES ( 39, 'Direction du système d''information');
INSERT INTO immo.departement( id, departement ) VALUES ( 40, 'Direction générale');
INSERT INTO immo.departement( id, departement ) VALUES ( 41, 'Magasin');
INSERT INTO immo.departement( id, departement ) VALUES ( 42, 'Magasin Ambatobe');
INSERT INTO immo.departement( id, departement ) VALUES ( 43, 'Service approvisionnement et immobilisations');
INSERT INTO immo.departement( id, departement ) VALUES ( 44, 'Service cav et dat');
INSERT INTO immo.departement( id, departement ) VALUES ( 45, 'Service centre clientèle');
INSERT INTO immo.departement( id, departement ) VALUES ( 46, 'Service Comptabilité');
INSERT INTO immo.departement( id, departement ) VALUES ( 47, 'Service Développemnt logiciel');
INSERT INTO immo.departement( id, departement ) VALUES ( 48, 'Service Logistique');
INSERT INTO immo.departement( id, departement ) VALUES ( 49, 'Service sécurité et développement des infrastrustures');
INSERT INTO immo.departement( id, departement ) VALUES ( 50, 'Service système réseaux et maintenance');
INSERT INTO immo.departement( id, departement ) VALUES ( 51, 'Service travaux');
INSERT INTO immo.departement( id, departement ) VALUES ( 52, 'Service trésorerie');
INSERT INTO immo.departement( id, departement ) VALUES ( 53, 'Service valorisation du patrimoine');
INSERT INTO immo.devise( id, devise, description_devise ) VALUES ( 1, 'CAD', 'CAD');
INSERT INTO immo.devise( id, devise, description_devise ) VALUES ( 2, 'Euro', 'Euro');
INSERT INTO immo.devise( id, devise, description_devise ) VALUES ( 3, 'GBP', 'Sterlign pounds');
INSERT INTO immo.devise( id, devise, description_devise ) VALUES ( 4, 'JPY', 'Yen');
INSERT INTO immo.devise( id, devise, description_devise ) VALUES ( 5, 'MGA', 'Ariary');
INSERT INTO immo.devise( id, devise, description_devise ) VALUES ( 6, 'USD', 'United States Dollars');
INSERT INTO immo.devise( id, devise, description_devise ) VALUES ( 7, 'XAF', 'XAF');
INSERT INTO immo.devise( id, devise, description_devise ) VALUES ( 8, 'XOF', 'XOF');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 1, 'DIR. GENER. - AGENCE CEM 018 MANAKARA - ADJOINT CEM 0018');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 2, 'DIR. GENER. - AGENCE CEM 019 MORAMANGA');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 3, 'DIR. GENER. - AGENCE CEM 020 TSIROANOMANDIDY');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 4, 'DIR. GENER. - AGENCE CEM 024 AMBATOLAMPY');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 5, 'DIR. GENER. - AGENCE CEM 028 AMBALAVAO');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 6, 'DIR. GENER. - AGENCE CEM 029 FANDRIANA');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 7, 'DIR. GENER. - AGENCE CEM 043 AMBANJA');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 8, 'DIR. GENER. - AGENCE CEM 044 AMBILOBE');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 9, 'DIR. GENER. - AGENCE CEM 046 SAMBAVA');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 10, 'DIR. GENER. - AGENCE CEM 048 ANDRAVOAHANGY');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 11, 'DIR. GENER. - AGENCE CEM 049 ANTSAKAVIRO');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 12, 'DIR. GENER. - AGENCE CEM 048 ANDRAVOAHANGY');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 13, 'DIR. GENER. - AGENCE CEM 086 TAMATAVE TANAMBAO');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 14, 'DIR. GENER. - AGENCE DIEGO WU DEDIEE- ADJOINT CEM 777');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 15, 'DIR. GENER. - AGENCE DIEGO 2 WU DEDIEE - ADJOINT CEM 770');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 16, 'DIR. GENER. - AGENCE NOSY BE WU DEDIEE - CHEF CEM WU012');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 17, 'DIR. GENER. - AGENCE TSARALALANA CHEF CEM CEM177');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 18, 'DIR. GENER. - DIR. DES OPERATIONS - SERV. DU CONTROLE DES OPERATIONS');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 19, 'DIR. GENER. - DIR. DES OPERATIONS - SERV. DU CONTROLE ET DE LA QUALITE');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 20, 'DIR. GENER. - DIR. DES RELATIONS AVEC LA CLIENTELE');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 21, 'DIR. GENER. - DIR. DES RELATIONS AVEC LA CLIENTELE - CENTRE DE SERVICE');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 22, 'DIR. GENER. - DIR. DES RELATIONS AVEC LA CLIENTELE . DIR. DES RELATIONS');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 23, 'DIR. GENER. - DIR. DES RELATIONS AVEC LA CLIENTELE - SERV. DES PRODUITS');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 24, 'DIR. GENER. - DIR. DES RESSOURCES HUMAINES - DIR. DES RESSOURCES H...');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 25, 'DIR. GENER. - DIR. DES RESSOURCES HUMAINES - SERV. DU DEVELOPPEME...');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 26, 'DIR. GENER. - DIR. DES RESSOURCES HUMAINES - SERV. DE L''ADMINISTRATION');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 27, 'DIR. GENER. - DIR. DES ETUDES ET DU MARKETING - SERV. DU MARKETING');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 28, 'DIR. GENER. - DIR. DU SYSTEME INFORMATION');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 29, 'DIR. GENER. - DIR. DU CONTROLE INTERNE - DIR. DE L''AUDIT INTERNE');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 30, 'DIR. GENER. - DIR. DU SYSTEME INFORMATION - DIR. DU SYSTEME INFORMATION');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 31, 'DIR. GENER. - DIR. DU SYSTEME INFORMATION - SERV. DE LA SECURITE INFORMATIQUE');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 32, 'DIR. GENER. - DIR. DU SYSTEME INFORMATION - SERV. DES ETUDES ET DU DEVELOPPEMENT');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 33, 'DIR. GENER. - DIR. DU SYSTEME INFORMATION . SERVICE SYSTEMES RESEAUX');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 34, 'DIR. GENER. - DIR. ADMINISTRATIVE ET FINANCIERE');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 35, 'DIR. GENER. - DIR. ADMINISTRATIVE ET FINANCIERE - SERV. DE LA COMPTABLITE');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 36, 'DIR. GENER. - DIR. DES OPERATIONS - DIR. DES OPERATIONS');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 37, 'DIR. GENERALE ADJOINTE DIR. GENER. - MAGASIN');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 38, 'DIR. GENER. - RESPONSABLE DES MARCHES PUBLICS');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 39, 'DIR. GENER. - RESPONSABLE DES MARCHES PUBLICS');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 40, 'DIR. GENER. SERV. DU COOPERANT');
INSERT INTO immo.emplacement( id, emplacement ) VALUES ( 41, 'DIR. GENER. - DIR. DES AFFAIRES JURIDIQUES');
INSERT INTO immo.etat_usage( id, etat ) VALUES ( 1, 'Neuf');
INSERT INTO immo.etat_usage( id, etat ) VALUES ( 2, 'Bon état');
INSERT INTO immo.etat_usage( id, etat ) VALUES ( 3, 'Mauvaise état');
INSERT INTO immo.etat_usage( id, etat ) VALUES ( 4, 'Hors d''usage');
INSERT INTO immo.etat_usage( id, etat ) VALUES ( 5, 'Disparue');
INSERT INTO immo.extension( id, extension_travail ) VALUES ( 1, 'SIA');
INSERT INTO immo.extension( id, extension_travail ) VALUES ( 2, 'BO');
INSERT INTO immo.extension( id, extension_travail ) VALUES ( 3, 'BO');
INSERT INTO immo.fournisseur( id, nom_fournisseur, siege_social, telephone, email ) VALUES ( 1, 'Cosmos', 'Analakely', '+261 34 54 713 93', 'service.client@cosmos.mg');
INSERT INTO immo.fournisseur( id, nom_fournisseur, siege_social, telephone, email ) VALUES ( 2, 'BATIMAX', 'Batimax Andraharo', '+261340531786', 'gc2@batimax.mg');
INSERT INTO immo.fournisseur( id, nom_fournisseur, siege_social, telephone, email ) VALUES ( 3, 'BRICOBAT', '\r\nroute digue Andranoambo', '0202233689', 'bricobat@moov.mg');
INSERT INTO immo.fournisseur( id, nom_fournisseur, siege_social, telephone, email ) VALUES ( 4, 'Luxor', 'Behoririka', '0320542012', 'luxormada@gmail.com');
INSERT INTO immo.gardien( id, nom_gardien, prenom ) VALUES ( 1, 'RAZAKAMBOLOLONA', 'Rufin');
INSERT INTO immo.gardien( id, nom_gardien, prenom ) VALUES ( 2, 'RATEFINANAHARY', 'Francky');
INSERT INTO immo.gardien( id, nom_gardien, prenom ) VALUES ( 3, 'RATEFINANAHARY', 'Francky');
INSERT INTO immo.marque( id, marque ) VALUES ( 1, 'Agfa');
INSERT INTO immo.marque( id, marque ) VALUES ( 2, 'Brand');
INSERT INTO immo.marque( id, marque ) VALUES ( 3, 'Bic');
INSERT INTO immo.marque( id, marque ) VALUES ( 4, 'Genius');
INSERT INTO immo.marque( id, marque ) VALUES ( 5, 'HP');
INSERT INTO immo.marque( id, marque ) VALUES ( 6, 'Lenovo');
INSERT INTO immo.marque( id, marque ) VALUES ( 7, 'Logitech');
INSERT INTO immo.marque( id, marque ) VALUES ( 8, 'NCR');
INSERT INTO immo.marque( id, marque ) VALUES ( 9, 'Panasonic');
INSERT INTO immo.marque( id, marque ) VALUES ( 10, 'Sony');
INSERT INTO immo.marque( id, marque ) VALUES ( 11, 'Stabilo');
INSERT INTO immo.marque( id, marque ) VALUES ( 12, 'Tally');
INSERT INTO immo.marque( id, marque ) VALUES ( 13, 'Toshiba');
INSERT INTO immo.marque( id, marque ) VALUES ( 14, 'Wood Features');
INSERT INTO immo.methode_amortissement( id, methode ) VALUES ( 1, 'Linéaire');
INSERT INTO immo.methode_amortissement( id, methode ) VALUES ( 2, 'Dégressif');
INSERT INTO immo.migrations( id, migration, batch ) VALUES ( 1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO immo.migrations( id, migration, batch ) VALUES ( 2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO immo.migrations( id, migration, batch ) VALUES ( 3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO immo.migrations( id, migration, batch ) VALUES ( 4, '2023_01_11_182224_create_post_tbl', 1);
INSERT INTO immo.modele( id, modele ) VALUES ( 1, 'A4');
INSERT INTO immo.modele( id, modele ) VALUES ( 2, 'Beige enveloppe-credocs');
INSERT INTO immo.modele( id, modele ) VALUES ( 3, 'Beige enveloppe-remdocs');
INSERT INTO immo.modele( id, modele ) VALUES ( 4, 'Blue Stamp');
INSERT INTO immo.modele( id, modele ) VALUES ( 5, 'C170');
INSERT INTO immo.modele( id, modele ) VALUES ( 6, 'CR2032');
INSERT INTO immo.modele( id, modele ) VALUES ( 7, 'Dos moyen +acc tissu');
INSERT INTO immo.modele( id, modele ) VALUES ( 8, 'KXFP/05BX');
INSERT INTO immo.modele( id, modele ) VALUES ( 9, 'Laser - 12 PPM');
INSERT INTO immo.modele( id, modele ) VALUES ( 10, 'M700');
INSERT INTO immo.modele( id, modele ) VALUES ( 11, 'Pentiumll-64MBSD-RAMPC133');
INSERT INTO immo.modele( id, modele ) VALUES ( 12, 'Personnas-86 5886-K223');
INSERT INTO immo.modele( id, modele ) VALUES ( 13, 'T5025');
INSERT INTO immo.modele( id, modele ) VALUES ( 14, 'T5710');
INSERT INTO immo.modele( id, modele ) VALUES ( 15, 'T9121');
INSERT INTO immo.modele( id, modele ) VALUES ( 16, 'Toner-MT 9412-9312');
INSERT INTO immo.modele( id, modele ) VALUES ( 17, 'UF490');
INSERT INTO immo.modele( id, modele ) VALUES ( 18, '19');
INSERT INTO immo.service( id, nom_service ) VALUES ( 1, 'Adjoint chef d''agence');
INSERT INTO immo.service( id, nom_service ) VALUES ( 2, 'Chef d''agence');
INSERT INTO immo.service( id, nom_service ) VALUES ( 3, 'Direction du patrimoine et logistique');
INSERT INTO immo.service( id, nom_service ) VALUES ( 4, 'Responsable d''agence');
INSERT INTO immo.service( id, nom_service ) VALUES ( 5, 'Responsable dédié Western Union');
INSERT INTO immo.service( id, nom_service ) VALUES ( 6, 'Service des systèmes et réseaux');
INSERT INTO immo.service( id, nom_service ) VALUES ( 7, 'Service Cav et Dat');
INSERT INTO immo.service( id, nom_service ) VALUES ( 8, 'Service centre clientèle');
INSERT INTO immo.service( id, nom_service ) VALUES ( 9, 'Service étude et Développement');
INSERT INTO immo.service( id, nom_service ) VALUES ( 10, 'Service immobilisation et approvisionnement');
INSERT INTO immo.service( id, nom_service ) VALUES ( 11, 'Service Logistique');
INSERT INTO immo.service( id, nom_service ) VALUES ( 12, 'Service Marketing');
INSERT INTO immo.service( id, nom_service ) VALUES ( 13, 'Service méthodes et procédures');
INSERT INTO immo.service( id, nom_service ) VALUES ( 14, 'Service produits livrets et épargnes');
INSERT INTO immo.service( id, nom_service ) VALUES ( 15, 'Service sécurité informatiques et développement infrastructures');
INSERT INTO immo.service( id, nom_service ) VALUES ( 16, 'Service travaux');
INSERT INTO immo.service( id, nom_service ) VALUES ( 17, 'Servuce Valorisation du patrimoine');
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 1, 'I.Agencement,aménagement', 1);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 2, 'I.Armoire', 8);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 3, 'I.Autres meubles', 8);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 4, 'I.Chaise', 8);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 5, 'I.Autres périphériques', 11);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 6, 'I.Construction', 1);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 7, 'I.Extension et rehabilitation', 1);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 8, 'I.Imprimante', 11);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 9, 'I.Logiciel intangible', 6);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 10, 'I.Licence', 6);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 11, 'I.Matériel de bureau', 8);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 12, 'I.Matériel de communication', 11);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 13, 'I.Matériel de logement', 9);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 14, 'I.Matériel de sécurité', 10);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 15, 'I.Matériel et outillage éléctrique et éléctronique', 10);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 16, 'I.Matériel et outillage mécanique', 10);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 17, 'I.Matériel publicitaire', 10);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 18, 'I.Matériels de réseau', 11);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 19, 'I.Matériels de télécommunication', 11);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 20, 'I.Meuble et logement', 9);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 21, 'I.Moto', 7);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 22, 'I.PC,ordinateurs portables', 11);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 23, 'I.Poids lourds', 1);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 24, 'I.Systèmes centraux', 11);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 25, 'I.Systèmes de stockage séparés de l''unité centrale', 11);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 26, 'I.Table', 8);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 27, 'I.Terrain', 12);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 28, 'I.Voiture 4*4', 7);
INSERT INTO immo.sous_categorie( id, nom_sous_categorie, id_categorie ) VALUES ( 29, 'I.Voitures légères', 7);
INSERT INTO immo.taille( id, taille ) VALUES ( 1, 'GM');
INSERT INTO immo.taille( id, taille ) VALUES ( 2, 'PM');
INSERT INTO immo.taille( id, taille ) VALUES ( 3, 'MM');
INSERT INTO immo.travail( id, nom_travail ) VALUES ( 1, 'Chef de service');
INSERT INTO immo.travail( id, nom_travail ) VALUES ( 2, 'Backoffice');
INSERT INTO immo.travail( id, nom_travail ) VALUES ( 3, 'Backoffice');
INSERT INTO immo.type_cession( id, type_cession ) VALUES ( 1, 'Ventes aux enchères');
INSERT INTO immo.type_cession( id, type_cession ) VALUES ( 2, 'Cession');
INSERT INTO immo.article( code_article, nom, designation, designation_courte, id_categorie, id_sous_categorie, id_departement, id_service, id_methode_amortissement, duree_annee, id_modele, id_couleur, id_taille, id_marque ) VALUES ( 1, 'Table basse', 'Table basse', 'Table', 8, 3, 1, 2, 1, 10, 18, 3, 2, 14);
INSERT INTO immo.article( code_article, nom, designation, designation_courte, id_categorie, id_sous_categorie, id_departement, id_service, id_methode_amortissement, duree_annee, id_modele, id_couleur, id_taille, id_marque ) VALUES ( 2, 'Ventilateur', 'Ventilateur', 'Ventilateur', 8, 11, 33, 8, 1, 10, 10, 1, 3, 13);
INSERT INTO immo.article( code_article, nom, designation, designation_courte, id_categorie, id_sous_categorie, id_departement, id_service, id_methode_amortissement, duree_annee, id_modele, id_couleur, id_taille, id_marque ) VALUES ( 3, 'Compteur de billet', 'Compteur de billet', 'Compteur de billet', 10, 15, 1, 8, 1, 10, 14, 3, 1, 8);
INSERT INTO immo.article( code_article, nom, designation, designation_courte, id_categorie, id_sous_categorie, id_departement, id_service, id_methode_amortissement, duree_annee, id_modele, id_couleur, id_taille, id_marque ) VALUES ( 4, 'Routeur', 'Routeur', 'Routeur', 11, 18, 39, 6, 1, 4, 5, 8, 3, 7);
INSERT INTO immo.article( code_article, nom, designation, designation_courte, id_categorie, id_sous_categorie, id_departement, id_service, id_methode_amortissement, duree_annee, id_modele, id_couleur, id_taille, id_marque ) VALUES ( 5, 'Licence Oracle', 'Licence Oracle', 'Licence Oracle', 3, 10, 39, 9, 1, 4, 18, 3, 3, 11);
INSERT INTO immo.article( code_article, nom, designation, designation_courte, id_categorie, id_sous_categorie, id_departement, id_service, id_methode_amortissement, duree_annee, id_modele, id_couleur, id_taille, id_marque ) VALUES ( 6, 'Imprimante XEROX', 'Imprimante XEROX', 'Imprimante', 11, 5, 38, 10, 1, 4, 7, 4, 1, 5);
INSERT INTO immo.article( code_article, nom, designation, designation_courte, id_categorie, id_sous_categorie, id_departement, id_service, id_methode_amortissement, duree_annee, id_modele, id_couleur, id_taille, id_marque ) VALUES ( 7, 'Chaise visiteur', 'Chaise visiteur', 'Chaise', 8, 4, 1, 2, 1, 10, 18, 4, 3, 14);
INSERT INTO immo.article( code_article, nom, designation, designation_courte, id_categorie, id_sous_categorie, id_departement, id_service, id_methode_amortissement, duree_annee, id_modele, id_couleur, id_taille, id_marque ) VALUES ( 8, 'Onduleur', 'Onduleur', 'Onduleur', 11, 5, 39, 9, 1, 4, 16, 3, 3, 7);
INSERT INTO immo.article( code_article, nom, designation, designation_courte, id_categorie, id_sous_categorie, id_departement, id_service, id_methode_amortissement, duree_annee, id_modele, id_couleur, id_taille, id_marque ) VALUES ( 9, 'Ordinateur portable HP', 'Ordinateur portable HP cori5', 'Ordinateur', 11, 22, 39, 6, 1, 4, 15, 4, 2, 5);
INSERT INTO immo.consignataire( id, id_gardien, id_travail, id_departement, id_service, id_extension ) VALUES ( 1, 1, 1, 38, 10, 1);
INSERT INTO immo.consignataire( id, id_gardien, id_travail, id_departement, id_service, id_extension ) VALUES ( 2, 2, 2, 39, 15, 2);
INSERT INTO immo.consignataire( id, id_gardien, id_travail, id_departement, id_service, id_extension ) VALUES ( 3, 2, 2, 39, 15, 2);
INSERT INTO immo.facture( id, `date`, id_fournisseur, id__consignataire, id_departement, id_devise ) VALUES ( 1, '2023-03-02', 2, 1, 43, 5);
INSERT INTO immo.facture( id, `date`, id_fournisseur, id__consignataire, id_departement, id_devise ) VALUES ( 2, '2015-03-02', 4, 1, 1, 5);
INSERT INTO immo.facture( id, `date`, id_fournisseur, id__consignataire, id_departement, id_devise ) VALUES ( 3, '2016-02-01', 3, 1, 39, 5);
INSERT INTO immo.facture( id, `date`, id_fournisseur, id__consignataire, id_departement, id_devise ) VALUES ( 4, '2023-04-03', 1, 1, 43, 5);
INSERT INTO immo.inventaire_immo( id, date_inventaire, id_consignataire, id_categorie, id_emplacement, id_gardien ) VALUES ( 1, '2023-03-31', 2, 8, 11, 1);
INSERT INTO immo.inventaire_immo( id, date_inventaire, id_consignataire, id_categorie, id_emplacement, id_gardien ) VALUES ( 2, '2023-04-02', 2, 11, 1, 1);
INSERT INTO immo.inventaire_immo( id, date_inventaire, id_consignataire, id_categorie, id_emplacement, id_gardien ) VALUES ( 3, '2023-04-03', 2, 8, 1, 1);
INSERT INTO immo.reception( id, date_reception, id_fournisseur, id_consignataire, id_emplacement, id_facture ) VALUES ( 1, '2023-03-03', 2, 1, 11, 1);
INSERT INTO immo.reception( id, date_reception, id_fournisseur, id_consignataire, id_emplacement, id_facture ) VALUES ( 2, '2015-03-12', 4, 1, 10, 2);
INSERT INTO immo.reception( id, date_reception, id_fournisseur, id_consignataire, id_emplacement, id_facture ) VALUES ( 3, '2016-02-08', 3, 1, 28, 3);
INSERT INTO immo.reception( id, date_reception, id_fournisseur, id_consignataire, id_emplacement, id_facture ) VALUES ( 4, '2023-04-04', 1, 1, 26, 4);
INSERT INTO immo.users( id, name, email, password ) VALUES ( 1, 1, 'cem001@gmail.com', '$2y$10$QmjXh0gXuaZo9BTg40jcEuF2Rid40w/PBd3H17hslrDQ4MR1suo2O');
INSERT INTO immo.users( id, name, email, password ) VALUES ( 2, 2, 'francky@gmail.com', '$2y$10$hZLb80LLbvbfZ850o9S3Bus2aVDqYnw4.vZP.1hrBGqhHfmUSx/CC');
INSERT INTO immo.users( id, name, email, password ) VALUES ( 3, 1, 'rufinrazakambololona@gmail.com', '$2y$10$b/jaPDVn6JDO1ecwVJKI4ujJ5rhdRg5yxNoBS7N7qKb3CUYUG/Xk2');
INSERT INTO immo.details_facture( id, id_article, description, quantite, prix_unitaire, commanded, id_facture, tva ) VALUES ( 1, 1, 'Table', 2, 200000.0, 2, 1, 10);
INSERT INTO immo.details_facture( id, id_article, description, quantite, prix_unitaire, commanded, id_facture, tva ) VALUES ( 2, 2, 'Ventilateur', 3, 150000.0, 3, 1, 10);
INSERT INTO immo.details_facture( id, id_article, description, quantite, prix_unitaire, commanded, id_facture, tva ) VALUES ( 3, 3, 'Compteur de billet', 1, 400000.0, 1, 1, 10);
INSERT INTO immo.details_facture( id, id_article, description, quantite, prix_unitaire, commanded, id_facture, tva ) VALUES ( 4, 5, 'Oracle', 5, 200000.0, 5, 1, 10);
INSERT INTO immo.details_facture( id, id_article, description, quantite, prix_unitaire, commanded, id_facture, tva ) VALUES ( 5, 4, 'Routeur', 3, 80000.0, 3, 2, 10);
INSERT INTO immo.details_facture( id, id_article, description, quantite, prix_unitaire, commanded, id_facture, tva ) VALUES ( 6, 3, 'Compteur de billet', 2, 400000.0, 2, 3, 10);
INSERT INTO immo.details_facture( id, id_article, description, quantite, prix_unitaire, commanded, id_facture, tva ) VALUES ( 7, 6, 'Imprimante Xerox', 3, 500000.0, 3, 3, 10);
INSERT INTO immo.details_facture( id, id_article, description, quantite, prix_unitaire, commanded, id_facture, tva ) VALUES ( 8, 2, 'Ventilateur', 2, 200000.0, 2, 3, 10);
INSERT INTO immo.details_facture( id, id_article, description, quantite, prix_unitaire, commanded, id_facture, tva ) VALUES ( 9, 7, 'Chaise', 4, 500000.0, 4, 3, 10);
INSERT INTO immo.details_facture( id, id_article, description, quantite, prix_unitaire, commanded, id_facture, tva ) VALUES ( 10, 6, 'Imprimante', 1, 500000.0, 1, 4, 10);
INSERT INTO immo.details_facture( id, id_article, description, quantite, prix_unitaire, commanded, id_facture, tva ) VALUES ( 11, 2, 'Ventilateur', 2, 150000.0, 2, 4, 10);
INSERT INTO immo.details_reception( id, id_article, commanded, recu, restant, id_reception, remarque ) VALUES ( 1, 1, 2, 2, 0, 1, 'Table');
INSERT INTO immo.details_reception( id, id_article, commanded, recu, restant, id_reception, remarque ) VALUES ( 2, 2, 3, 3, 0, 1, 'Ventilateur');
INSERT INTO immo.details_reception( id, id_article, commanded, recu, restant, id_reception, remarque ) VALUES ( 3, 3, 1, 1, 0, 1, 'Compteur de billet');
INSERT INTO immo.details_reception( id, id_article, commanded, recu, restant, id_reception, remarque ) VALUES ( 4, 5, 5, 5, 0, 1, 'Oracle');
INSERT INTO immo.details_reception( id, id_article, commanded, recu, restant, id_reception, remarque ) VALUES ( 5, 4, 3, 3, 0, 2, 'Routeur');
INSERT INTO immo.details_reception( id, id_article, commanded, recu, restant, id_reception, remarque ) VALUES ( 6, 3, 2, 2, 0, 3, 'Compteur de billet');
INSERT INTO immo.details_reception( id, id_article, commanded, recu, restant, id_reception, remarque ) VALUES ( 7, 6, 3, 3, 0, 3, 'Imprimante Xerox');
INSERT INTO immo.details_reception( id, id_article, commanded, recu, restant, id_reception, remarque ) VALUES ( 8, 2, 2, 2, 0, 3, 'Ventilateur');
INSERT INTO immo.details_reception( id, id_article, commanded, recu, restant, id_reception, remarque ) VALUES ( 9, 7, 4, 4, 0, 3, 'Chaise');
INSERT INTO immo.details_reception( id, id_article, commanded, recu, restant, id_reception, remarque ) VALUES ( 10, 6, 1, 1, 0, 4, 'Imprimante');
INSERT INTO immo.details_reception( id, id_article, commanded, recu, restant, id_reception, remarque ) VALUES ( 11, 2, 2, 2, 0, 4, 'Ventilateur');
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 1, 1, 101, 11, 1, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 2, 1, 102, 11, 1, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 3, 1, 201, 10, 2, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 4, 1, 202, 10, 2, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 5, 1, 203, 11, 2, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 6, 2, 501, 10, 5, 1);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 7, 2, 502, 10, 5, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 8, 2, 503, 10, 5, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 9, 3, 801, 28, 8, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 10, 3, 802, 28, 8, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 11, 3, 901, 28, 9, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 12, 3, 902, 28, 9, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 13, 3, 903, 28, 9, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 14, 3, 904, 28, 9, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 15, 3, 701, 28, 7, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 16, 3, 702, 28, 7, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 17, 3, 703, 1, 7, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 18, 4, 1001, 2, 10, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 19, 4, 1101, 26, 11, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 20, 4, 1102, 26, 11, 0);
INSERT INTO immo.immo( id, code_reception, code_barre, id_emplacement, id_details_reception, deleted ) VALUES ( 21, 1, 301, 11, 3, 0);
INSERT INTO immo.transfert_immo( id, date_transfert, id_consignataire, id_immo, remarque, id_emplacement ) VALUES ( 1, '2023-03-31', 1, 4, 'Ventilateur', 10);
INSERT INTO immo.transfert_immo( id, date_transfert, id_consignataire, id_immo, remarque, id_emplacement ) VALUES ( 2, '2023-04-02', 1, 17, 'Transfert n° 17', 1);
INSERT INTO immo.transfert_immo( id, date_transfert, id_consignataire, id_immo, remarque, id_emplacement ) VALUES ( 3, '2023-04-02', 1, 17, 'Transfert n° 17', 1);
INSERT INTO immo.transfert_immo( id, date_transfert, id_consignataire, id_immo, remarque, id_emplacement ) VALUES ( 4, '2023-04-02', 1, 17, 'Transfert n° 17', 1);
INSERT INTO immo.transfert_immo( id, date_transfert, id_consignataire, id_immo, remarque, id_emplacement ) VALUES ( 5, '2023-04-04', 1, 18, 'Tansfert de Fandriana vers Moramanga', 2);
INSERT INTO immo.cession_immo( id, date_cession, id_immo, id_devise, id_type, prix_final ) VALUES ( 1, '2020-04-22', 6, 5, 1, 90000);
INSERT INTO immo.cession_immo( id, date_cession, id_immo, id_devise, id_type, prix_final ) VALUES ( 2, '2023-04-03', 6, 5, 1, 500000);
INSERT INTO immo.cession_immo( id, date_cession, id_immo, id_devise, id_type, prix_final ) VALUES ( 3, '2023-04-03', 6, 5, 1, 100000);
INSERT INTO immo.cession_immo( id, date_cession, id_immo, id_devise, id_type, prix_final ) VALUES ( 4, '2023-04-03', 6, 5, 1, 100000);
INSERT INTO immo.details_inventaire( id, id_inventaire, id_immo, etat, id_etat_usage ) VALUES ( 1, 1, 1, 1, 1);
INSERT INTO immo.details_inventaire( id, id_inventaire, id_immo, etat, id_etat_usage ) VALUES ( 2, 2, 17, 1, 1);
INSERT INTO immo.details_inventaire( id, id_inventaire, id_immo, etat, id_etat_usage ) VALUES ( 3, 2, 17, 1, 1);
INSERT INTO immo.details_inventaire( id, id_inventaire, id_immo, etat, id_etat_usage ) VALUES ( 4, 2, 17, 1, 1);
INSERT INTO immo.details_inventaire( id, id_inventaire, id_immo, etat, id_etat_usage ) VALUES ( 5, 2, 17, 1, 1);

