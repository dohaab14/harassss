# Sujet de projet BD relationnelle CSC8444 : Gestion d’un Haras et de ses Compétitions
## Objectif :

L'objectif est de se familiariser avec la conception de bases de données relationnelles et leur utilisation dans une application web. Vous modéliserez une base de données pour la gestion d’un haras (élevage de chevaux), incluant la gestion des chevaux, des cavaliers, des soins vétérinaires et des compétitions équestres.

Dans une première étape, vous construirez un MCD permettant de modéliser la base de données du haras. Ensuite, vous réaliserez le MLD et implanterez le MPD sur un SGBD. Vous insérerez des données de test en lien avec les questions Q1 à Q5 et développerez une application web en PHP pour interagir avec la base de données.
## Partie 1 : Réalisation du MCD

Le modèle conceptuel devra permettre de gérer :

    Les chevaux, identifiés par un numéro d’identification unique, un nom, une race, une date de naissance, un sexe et un propriétaire.
    Les cavaliers, identifiés par un numéro de licence, un nom, un prénom, et leur club d’appartenance.
    Les soins vétérinaires, incluant le vétérinaire responsable, la date, la nature du soin et le cheval concerné.
    Les compétitions, avec un nom, une date, un lieu et une catégorie (dressage, saut d’obstacles, cross, etc.).
    Les inscriptions aux compétitions, qui lient un cheval et un cavalier à une compétition et enregistrent leurs résultats.
    Les palmarès des chevaux, enregistrant leurs performances et classements en compétition.
    Les entraîneurs, associés aux chevaux qu’ils entraînent, avec une spécialité et un club.

Le MCD devra être construit de manière à répondre aux questions suivantes :

Q1 : Liste des chevaux classés par race et nombre de compétitions disputées.

Q2 : Liste des chevaux ayant eu un soin vétérinaire dans les 30 derniers jours.

Q3 : Liste des cavaliers ayant participé à une compétition dans les six mois.

Q4 : Nombre moyen de compétitions disputées par cheval dans l’année.

Q5 : Villes dans lesquelles un cheval est arrivé premier.

## Partie 2 : Réalisation du MLD et MPD

    Transformer le MCD en MLD en appliquant les règles de transformation vues en cours.
    Générer le script SQL de création de la base, en choisissant les bons types pour chaque attribut et en ajoutant :
        Contraintes de clé primaire et d’intégrité référentielle.
        Deux contraintes d’intégrité métier (exemple : un cheval ne peut participer qu’à une seule compétition par jour).
    Insérer un jeu de données permettant de tester les requêtes SQL de la partie 3.
    Tester l’insertion de données erronées et démontrer que le SGBD applique bien les contraintes d’intégrité.

## Partie 3 : Requêtes SQL

Écrire et tester sur le SGBD les requêtes SQL permettant de répondre aux questions Q1 à Q5.

## Partie 4 : Vues et droits

On distingue deux catégories d’utilisateurs : les vétérinaires et les organisateurs de compétitions.

    Définir les relations accessibles par chaque utilisateur et les opérations permises (lecture, insertion…).
    Créer une vue pour chaque catégorie (exemple : liste des chevaux sous suivi vétérinaire pour les vétérinaires).
    Écrire les requêtes SQL pour créer les utilisateurs et leur attribuer les droits d’accès via GRANT.

On va créer quatre vues : vue_soins,vue_chevaux,vue_compet,vue_palm.
```
//un user entraineur voit les soins
CREATE VIEW vue_soins AS
SELECT
    sv.date_soin,
    sv.nature_soin,
    c.nom_cheval,
    v.nom_vet
FROM
    soin_veterinaire sv
JOIN
    cheval c ON sv.id_cheval = c.id_cheval
JOIN
    veterinaire v on sv.id_vet = v.id_vet;

//vue  les compet
CREATE VIEW vue_compet
AS SELECT c.nom_compet, c.date_compet, c.categorie, v.nom_ville
FROM competition c
JOIN ville v ON c.id_ville = v.id_ville;

//vue chevaux 

CREATE VIEW vue_chev
AS SELECT c.nom_cheval, c.race, en.nom_club
FROM cheval c
JOIN entraine e ON c.id_cheval = e.id_cheval
JOIN entraineur en ON e.id_entraineur = en.id_entraineur;

;

//vue palmares

CREATE VIEW vue_palmares_chevaux AS
SELECT p.rang, c.nom_cheval, cp.nom_compet, cp.date_compet
FROM palmares p
JOIN cheval c ON p.id_cheval = c.id_cheval
JOIN competition cp ON p.id_compet = cp.id_compet
ORDER BY p.rang;


```
## Partie 5 : Application web en PHP

Créer une application permettant :

    La connexion avec authentification via une table Utilisateurs (login/mot de passe).
    L’affichage des chevaux d’un club donné.
    L’inscription d’un cheval à une compétition.
    L’enregistrement d’un soin vétérinaire.
    La consultation du palmarès d’un cheval.
### COMANDLINES USEFUL
`php artisan serve`
### Architecture du projet PHP 
```/haras-gestion
│
├── /assets
│   └── /css
│   └── /js
│   └── /images
│
├── /includes
│   └── db.php           // Connexion à la base de données
│
├── /views
│   ├── login.php        // Formulaire de connexion
│   ├── dashboard.php    // Tableau de bord de l'utilisateur
│   ├── chevaux.php      // Liste des chevaux d'un club
│   ├── inscription_compet.php // Formulaire d'inscription à une compétition
│   ├── soins.php        // Enregistrement des soins vétérinaires
│   ├── palmares.php     // Consultation du palmarès d'un cheval
│   └── logout.php       // Déconnexion
│
├── /controllers
│   └── AuthController.php    // Logique d'authentification
│   └── DashboardController.php // Logique pour le tableau de bord
│   └── ChevauxController.php  // Logique pour les chevaux
│   └── CompetController.php   // Logique pour les compétitions
│   └── SoinsController.php    // Logique pour les soins vétérinaires
│   └── PalmaresController.php // Logique pour les palmarès
│
├── /models
│   └── User.php        // Modèle pour l'utilisateur
│   └── Cheval.php      // Modèle pour les chevaux
│   └── Veterinaire.php // Modèle pour les vétérinaires
│   └── Competition.php // Modèle pour les compétitions
│   └── Soin.php        // Modèle pour les soins vétérinaires
│   └── Palmares.php    // Modèle pour les palmarès
│
└── index.php           // Page d'accueil du projet
```
    

Documents à rendre :

    MCD
    MLD + script SQL de création
    Requêtes SQL pour les questions
    Requêtes SQL pour les vues et les utilisateurs
    Code source PHP de l’application prête pour une démonstration

Remarque : Ce projet permettra d’explorer les concepts de modélisation, de gestion des droits et de développement d’applications interagissant avec une base de données, tout en appliquant ces connaissances à un domaine concret et structuré.

