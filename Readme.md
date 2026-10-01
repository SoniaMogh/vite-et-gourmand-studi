# Vite et Gourmand

## Présentation du projet

Ce site est une application vitrine, développé en PHP, pour le restaurant Vite et Gourmand, permettant de présenter leur menu et de gérer les commandes clients.

Le site permet notamment de :

- consulter les menus proposés
- consulter les informations du restaurant
- créer un compte client et se connecter
- gérer les commandes
- gérer différents rôles utilisateurs
- consulter les avis clients
- récupérer les avis depuis une API connectée à MongoDB

Il y a plusieurs rôles :

- Visiteur, qui sont les utilisateurs sans compte
- Client, qui sont les utilisateurs avec compte
- Employé
- Administrateur

## Installation du projet en local

### Prérequis

Avant de commencer assurez vous d'avoir installé

- Git
- Docker
- Docker Desktop
- Node.js (npm est inclus avec Node.js). Il sera utilisé pour installer les dépendances front-end si vous souhaitez modifier le SCSS Bootstrap ou travailler hors ligne, sans dépendre d'un CDN.
- Composer

Et d'avoir un compte MongoDB Atlas.

### Cloner le projet

Dans un terminal, à l'endroit où vous souhaitez cloner le projet, tapez la commande
`git clone https://github.com/SoniaMogh/vite-et-gourmand-studi.git`

puis entrez dans le dossier
`cd nom-du-dossier-créé`

### Configuration des variables d'environnement

Créez un fichier .env à la racine du projet, et y copier ce code :

```
DB_HOST=mysql
DB_NAME=viteetgourmand
DB_USER=root
DB_PASSWORD=root

MONGODB_URI = mongodb+srv://USERNAME:PASSWORD@CLUSTER.mongodb.net/
```

(Par mesure de sécurité, je ne mettrais pas l'URI MongoDB.

Pour tester les avis clients, contactez-moi afin d'obtenir l'URI MongoDB de démonstration.)

Puis allez dans le fichier `database.php` du dossier config, et remplacez le code par :

```
<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$host = $_ENV["DB_HOST"];
$dbname = $_ENV["DB_NAME"];
$user = $_ENV["DB_USER"];
$password = $_ENV["DB_PASSWORD"];

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    error_log($e->getMessage());
    echo "DB error";
    exit;
}
```

### Installer les dépendances PHP

Lancez, à la racine du projet, la commande

`composer install`

Dans un terminal, ça va générer un dossier vendor/ nécessaire pour l'utilisation de la base de donnée.

Cette commande installe :

- vlucas/phpdotenv
- mongodb/mongodb

### Installer les dépendances Front-end (optionnel mais recommandé si modifications du code prévus)

Lancez, dans un terminal à la racine du projet, la commande :

`npm install`

Cette commande permet d'installer les dépendences front-end, notamment Bootstrap

### Modifier les chemins js et icons (optionnel, utile si modification hors ligne)

Dans index.php, changer la ligne

`<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>`

Par

`<script src="<?= BASE_URL ?>/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>`

et retirer la ligne

`<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">`

Et dans main.scss, ajouter

`@import url('../node_modules/bootstrap-icons/font/bootstrap-icons.css');`

### Lancer Docker

Démarrez Docker Desktop et lancer, dans un terminal, la commande :

`docker-compose up --build`

Cette commande sert à lancer Apache, PHP, MySQL, PHPMyAdmin et l'application web

### Accéder au projet

Une fois la commande au-dessus lancée, vous pourrez trouver le site à l'adresse http://localhost:9000

et phpMyAdmin sur http://localhost:8081

### Base de données MySQL

La base de données, présente dans le init.sql, est lancé automatiquement.

### Base de données MongoDB

Les avis clients sont stockés dans une base MongoDB hébergée sur MongoDB Atlas.

L'application utilise :

- l'extension MongoDB pour PHP
- la bibliothèque Composer mongodb/mongodb
- une variable d'environnement MONGODB_URI pour la connexion

Pour tester l'affichage des avis clients, un accès MongoDB est nécessaire.

Après avoir configuré votre fichier .env, contactez-moi pour obtenir l'URI MongoDB de démonstration.

Les données de test sont déjà présentes dans la collection reviews, il n'est donc pas nécessaire de créer ou saisir les avis manuellement.

Les avis sont récupérés par l'application via l'API reviewsApi.php.

### Comptes test

#### Administrateur

Email : test3@test.fr

Mot de passe : 2TestDeTest!

#### Employé

Email : test5@test.fr

Mot de passe : 2TestDeTest!

#### Client

Email : test2@test.fr

Mot de passe : 2TestDeTest!

## Technologies utilisées

### Front-end

- HTML
- SCSS / Saas
- Bootstrap
- JavaScript

### Back-end

- PHP
- PDO
- Architecture MVC partielle

### Base de données

- MySQL
- MongoDB (Atlas)

### Environnement local/Déploiement

- Docker
- Docker Compose
- Git/GitHub
- Composer
- Render
- Railway (pour la Base de données en production)
- MongoDB Atlas

## Organisation GitHub

Le projet suit une organisation basée sur plusieurs branches :

- `main` : version stable du projet
- `dev` : la branche de développement
- `feature/*`: les branches dédiées aux fonctionnalités, supprimées après merge sur la branche dev

## Déploiement

L'application PHP est déployée sur Render.

La base MySQL utilisée pour le projet est configurée séparément de l'application, sur Railway.

MongoDB est hébergé sur MongoDB Atlas.

Les variables d'environnement nécessaires au fonctionnement de l'application doivent être configurées dans l'environnement de déploiement et ne sont pas stockées dans le dépôt Git.

## Informations complémentaires

Certaines fonctionnalités prévues dans le cahier des charges n’ont pas pu être totalement finalisées, notamment l'instauration de filtres ou d'un dashboard pour les comptes administrateurs. Mais c'est en cours de réalisation.
