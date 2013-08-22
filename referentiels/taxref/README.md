TAXREF
======

*Référentiel taxonomique : Faune, flore et fonge de France métropolitaine et d'outre-mer*

http://inpn.mnhn.fr/programme/referentiel-taxonomique-taxref

### Description des colonnes

Colonne | Type | Description
--------|------|--------------------------------
REGNE | Texte | Règne auquel le taxon appartient 
PHYLUM | Texte | Embranchement auquel le taxon appartient 
CLASSE | Texte | Classe à laquelle le taxon appartient
ORDRE | Texte | Texte Ordre auquel le taxon appartient
FAMILLE | Texte | Famille à laquelle le taxon appartient
CD\_NOM | Entier long | Identifiant unique du nom scientifique
CD\_TAXSUP | Entier long | Identifiant (CD\_NOM) du taxon supérieur
CD\_REF | Entier long | Identifiant (CD\_NOM) du taxon de référence (nom retenu)
RANG | Texte | Rang taxonomique (lien vers TAXREF\_RANG)
LB\_NOM | Texte | Nom scientifique du taxon (sans l’autorité)
LB\_AUTEUR | Texte | Autorité du taxon (Auteur, année, gestion des parenthèses)
NOM\_COMPLET | Texte | Combinaison des champs précédents pour donner le nom complet (~LB\_NOM+" " +LB\_AUTEUR)
NOM\_VALIDE | Texte | Le NOM\_COMPLET du CD\_REF 
NOM\_VERN | Texte | Noms vernaculaires français 
NOM\_VERN\_ENG | Texte | Noms vernaculaires anglais
HABITAT | Entier court | Code de l'habitat (clé vers TAXREF\_HABITATS)
FR | Texte | Statut biogéographique en France métropolitaine (clé vers TAXREF\_STATUTS)
GF | Texte | Texte Statut biogéographique en Guyane française (clé vers TAXREF\_STATUTS)
MAR | Texte | Statut biogéographique à la Martinique (clé vers TAXREF\_STATUTS)
GUA | Texte | Statut biogéographique à la Guadeloupe (clé vers TAXREF\_STATUTS)
SM | Texte | Statut biogéographique à Saint ‐ Martin (clé vers TAXREF\_STATUTS)
SB | Texte | Statut biogéographique à Saint ‐ Barthélemy (clé vers TAXREF\_STATUTS) 
SPM | Texte | Statut biogéographique à Saint ‐ Pierre et Miquelon (clé vers TAXREF\_STATUTS)
MAY | Texte | Statut biogéographique à Mayotte (clé vers TAXREF\_STATUTS)
EPA | Texte | Statut biogéographique aux Îles Éparses (clé vers TAXREF\_STATUTS)
REU | Texte | Statut biogéographique à la Réunion (clé vers TAXRE\_STATUTS)
TAAF | Texte | Statut biogéographique aux TAAF (clé vers TAXREF\_STATUTS) 
PF | Texte | Statut biogéographique en Polynésie française (clé vers TAXREF\_STATUTS)
NC | Texte | Statut biogéographique en Nouvelle ‐ Calédonie (clé vers TAXREF\_STATUTS
WF | Texte | Statut biogéographique à Wallis et Futuna (clé vers TAXREF\_STATUTS) 
CLI | Texte | Statut biogéographique à Clipperton (clé vers TAXREF\_STATUTS)
URL | Texte | Permalien INPN = "http://inpn.mnhn.fr/espece/cd_nom/" + CD\_NOM

### Valeurs de la colonne RANG

Valeurs du GBIF http://rs.gbif.org/vocabulary/gbif/rank.xml

 Valeur Taxref | Valeur GBIF | Description
---------------|-------------|--------------
Dumm           | domain      | Domaine
SPRG           |             | Super-Règne
KD             | kingdom     | _Règne_
SSRG           | subkingdom  | Sous-Règne
IFRG           |             | Infra-Règne
               | superphylum | 
PH             | phylum      | _Phylum/Embranchement_
SBPH           | subphylum   | Sous-Phylum
IFPH           |             | Infra-Phylum
DV             |             | Division
SBDV           |             | Sous-Division
SPCL           | superclass  | Super-Classe
CLAD           |             | Cladus
CL             | class       | _Classe_
SBCL           | subclass    | Sous-classe
IFCL           |             | Infra-classe
LEG            |             | Legio
SPOR           |             | Super-Ordre
               | supercohort | Super-Cohorte
COH            | cohort      | Cohorte
               | subcohort   | Sous Cohorte
               | superorder  | Super Ordre
OR             | order       | Ordre
SBOR           | suborder    | Sous-Ordre
IFOR           | infraorder  | Infra-Ordre
SPFM           | superfamily | Super-Famille
FM             | family      | _Famille_
SBFM           | subfamily   | Sous-Famille
TR             | tribe       | Tribu
SSTR           | subtribe    | Sous-Tribu
GN             | genus       | _Genre_
SSGN           | subgenus    | Sous-Genre
SC             | section     | Section
SBSC           | subsection  | Sous-Section
SER            | series      | Série
SSER           | subseries   | Sous-Série
AGES           | speciesAggregate | Agrégat
ES             | species     | Espèce
               | subspecificAggregate | A loosely defined group of subspecies. Zoology:'Aggregate - a group of subspecies within a species. An aggregate may be denoted by a group name interpolated in parentheses
SMES           |             | Semi-Espèce
MES            |             | Micro-Espèce
SSES           | subspecies  | Sous-Espèce
NAT            |             | Natio
VAR            | variety     | Variété
SVAR           | subvariety  | Sous-Variété
FO             | form        | Forme
SSFO           | subform     | Sous-Forme
               | cultivar    | The epithet is usually output in single quotes and may contain multiple words, see ICBN §28. Examples: Taxus baccata 'Variegata', Juniperus ×pfitzeriana 'Wilhelm Pfitzer'; Magnolia 'Elizabeth' (= a hybrid, no species epithet)
               | strain      | Bacteria species may be classified by strains (for example Escherichia coli O157:H7, a strain that can cause food poisoning).
FOES           |             | Format species
LIN            |             | Linea
CLO            |             | Clonage
RACE           |             | Race
CAR            |             | Cultivar
MO             |             | Morpha
AB             |             | Abberation
