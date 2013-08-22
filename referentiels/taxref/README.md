TAXREF
======

## Référentiel taxonomique : Faune, flore et fonge de France métropolitaine et d'outre-mer

### Description des colonnes

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
URL | Texte | Permalien INPN = "http://inpn.mnhn.fr/espece/cd\_nom/’ + CD\_NOM

### Valeurs de la colonne RANG

Valeur | Description
--------------
Dumm | Domaine
SPRG | Super-Règne
KD | _Règne_
SSRG | Sous-Règne
IFRG | Infra-Règne
PH | _Phylum/Embranchement_
SBPH | Sous-Phylum
IFPH | Infra-Phylum
DV | Division
SBDV | Sous-Division
SPCL | Super-Classe
CLAD | Cladus
CL | _Classe_
SBCL | Sous-classe
IFCL | Infra-classe
LEG | Legio
SPOR | Super-Ordre
COH | Cohorte
OR | Ordre
SBOR | Sous-Ordre
IFOR | Infra-Ordre
SPFM | Super-Famille
FM | _Famille_
SBFM | Sous-Famille
TR | Tribu
SSTR | Sous-Tribu
GN | _Genre_
SSGN | Sous-Genre
SC | Section
SBSC | Sous-Section
SER | Série
SSER | Sous-Série
AGES | Agrégat
ES | Espèce
SMES | Semi-Espèce
MES | Micro-Espèce
SSES | Sous-Espèce
NAT | Natio
VAR | Variété
SVAR | Sous-Variété
FO | Forme
SSFO | Sous-Forme
FOES | Format species
LIN | Linea
CLO | Clonage
RACE | Race
CAR | Cultivar
MO | Morpha
AB | Abberation
