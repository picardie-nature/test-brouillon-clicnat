create table biblio_documents (
	id_biblio_document serial primary key,
	titre varchar(200),
	date_creation timestamp default now(),
	date_modif timestamp,
	nb_pages integer,
	annee_publi integer
);

create table biblio_articles (
	id_biblio_article serial primary key,
	id_biblio_document integer references biblio_documents (id_biblio_document),
	titre text,
	premiere_page integer,
	derniere_page integer,
	date_creation timestamp default now(),
	date_modif timestamp
);

create table biblio_classeurs (
	id_biblio_classeur serial primary key,
	id_biblio_classeur_parent integer,
	nom varchar(100),
	public boolean default false,
	date_creation timestamp default now(),
	date_modif timestamp
);

create table biblio_auteurs (
	id_biblio_auteur serial primary key,
	nom varchar(200),
	prenom varchar(200),
	date_creation timestamp default now(),
	date_modif timestamp
);

create table biblio_documents__biblio_classeurs (
	id_biblio_document integer references biblio_documents (id_biblio_document),
	id_biblio_classeur integer references biblio_classeurs (id_biblio_classeur),
	primary key (id_biblio_document, id_biblio_classeur)
);

create table biblio_articles__biblio_auteurs (
	id_biblio_article integer references biblio_articles (id_biblio_article),
	id_biblio_classeur integer references biblio_classeurs (id_biblio_classeur),
	primary key (id_biblio_article, id_biblio_classeur)
);
