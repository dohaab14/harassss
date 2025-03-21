## Sujet de projet BD relationnelle CSC8444 : Gestion d’un Haras et de ses Compétitions
-----------------------------

## Objectif :

L'objectif est de se familiariser avec la conception de bases de données relationnelles et leur utilisation dans une application web. Vous modéliserez une base de données pour la gestion d’un haras (élevage de chevaux), incluant la gestion des chevaux, des cavaliers, des soins vétérinaires et des compétitions équestres.
On part du principe que sur le site nous sommes les admin; il n'y a pas de role en particulier sur le site pour celui-ci.

Dans une première étape, vous construirez un MCD permettant de modéliser la base de données du haras. Ensuite, vous réaliserez le MLD et implanterez le MPD sur un SGBD. Vous insérerez des données de test en lien avec les questions Q1 à Q5 et développerez une application web en PHP pour interagir avec la base de données.

## Informations utiles: 

Chaque partie contient la consigne ainsi que les éléments de réponses aux questions. Pour dire que ce sont nos réponses nous avons ajouté: **--réponses**.

Concernant la partie création et insertion des données tout se trouve dans le fichier sql `haras.sql`

-----

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

-----

## Partie 2 : Réalisation du MLD et MPD

    Transformer le MCD en MLD en appliquant les règles de transformation vues en cours.
    Générer le script SQL de création de la base, en choisissant les bons types pour chaque attribut et en ajoutant :
    Contraintes de clé primaire et d’intégrité référentielle.
    Deux contraintes d’intégrité métier (exemple : un cheval ne peut participer qu’à une seule compétition par jour).
    
**-- réponses**
```
ALTER TABLE cheval ADD CONSTRAINT Csexe CHECK(sexe_chev IN ('M', 'F'));

ALTER TABLE palmares ADD CONSTRAINT Crang CHECK(rang BETWEEN 1 and 10); 

ALTER TABLE palmares ADD CONSTRAINT unique_rang_par_competition UNIQUE (id_compet, rang); 
```

Insérer un jeu de données permettant de tester les requêtes SQL de la partie 3.(OK)
Tester l’insertion de données erronées et démontrer que le SGBD applique bien les contraintes d’intégrité.(OK)

-----

## Partie 3 : Requêtes SQL

Écrire et tester sur le SGBD les requêtes SQL permettant de répondre aux questions Q1 à Q5.

**-- réponses**
```
 
SELECT c.nom_cheval, count(p.id_cheval)
FROM cheval as c, palmares as p
WHERE c.id_cheval = p.id_cheval
GROUP by c.nom_cheval
order by count(p.id_cheval) DESC;

SELECT C.nom_cheval, sv.date_soin
FROM cheval AS C ,
soin_veterinaire AS sv
WHERE C.id_cheval = sv.id_cheval AND sv.date_soin <= CURDATE() AND DATEDIFF(CURDATE(), sv.date_soin) <= 30;


SELECT c.prenom_caval, c.nom_caval
FROM cavalier as c
Join participe as p on c.id_licence = p.id_licence
JOIN competition as co on co.id_compet = p.id_compet
where DATEDIFF(now(),co.date_compet) <=180;


SELECT ch.nom_cheval, COUNT(p.id_compet) AS nombre_competitions
FROM cheval AS ch
JOIN palmares AS p ON ch.id_cheval = p.id_cheval
JOIN competition AS c ON p.id_compet = c.id_compet
WHERE YEAR(c.date_compet) = 2025 // dans le code on a une variable year
GROUP BY ch.nom_cheval;


SELECT ch.nom_cheval, v.nom_ville, COUNT(p.id_cheval)
AS nombre_compétion
FROM cheval AS ch
JOIN palmares as p on p.id_cheval=ch.id_cheval
JOIN competition as c on p.id_compet=c.id_compet
JOIN ville as v on v.id_ville=c.id_ville
WHERE p.rang=1
GROUP BY v.nom_ville, ch.nom_cheval;

```

-----

## Partie 4 : Vues et droits

On distingue deux catégories d’utilisateurs : les vétérinaires et les organisateurs de compétitions.

    Définir les relations accessibles par chaque utilisateur et les opérations permises (lecture, insertion…).
    Créer une vue pour chaque catégorie (exemple : liste des chevaux sous suivi vétérinaire pour les vétérinaires).
    Écrire les requêtes SQL pour créer les utilisateurs et leur attribuer les droits d’accès via GRANT.

**-- réponses**
On a créé quatre vues : vue_soins,vue_chevaux,vue_compet,vue_palm.

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
-----

## Partie 5 : Application web en PHP

Créer une application permettant :

    La connexion avec authentification via une table Utilisateurs (login/mot de passe).
    L’affichage des chevaux d’un club donné.
    L’affichage des informations d'un cavalier.
    L’enregistrement d’un soin vétérinaire (creation/suppression/modification).
    La consultation du palmarès d’un cheval.
-----

### Comment lancer le projet 

#### Prérequis 

- PHP v8.3 +
- Laravel Installer 5.14.0
- Composer
- MySQL

#### Fichiers à modifier: 
Il faut regarder le numero de port de la BD quand XAMPP ou WAMP est allumé.

Sur **MAC**: 

dans **.env** :
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=haras
DB_USERNAME=root
DB_PASSWORD=root
```

dans **config/database.php**
```
 'mysql' => [
            'driver' => 'mysql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '8889'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', 'root'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
```
Sur **Windows**: 

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=haras
DB_USERNAME=root
```
dans **config/database.php**
```
 'mysql' => [
            'driver' => 'mysql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
```

#### Lancer sur le terminal
`php artisan serve`

-----

Doc à rendre

    MCD
    MLD + script SQL de création
    Requêtes SQL pour les questions
    Requêtes SQL pour les vues et les utilisateurs
    Code source PHP de l’application prête pour une démonstration

Remarque : Ce projet permettra d’explorer les concepts de modélisation, de gestion des droits et de développement d’applications interagissant avec une base de données, tout en appliquant ces connaissances à un domaine concret et structuré.


