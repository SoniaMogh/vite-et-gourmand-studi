# Vite et Gourmand

## Présentation du projet

Ce site est un site vitrine, développé en PHP, pour le restaurant Vite et Gourmand, permettant de présenter leur menu et de gérer les commandes clients.

Il y a plusieurs rôles :

- Visiteur, qui sont les utilisateurs sans compte
- Client, qui sont les utilisateurs avec compte
- Employé
- Administrateur

## Installation du projet en local

### Outils nécessaires

Avant de commencer assurez vous d'avoir installé

- Git
- Docker
- Docker Desktop
- Node.js (npm est inclus avec Node.js. Il sera utilisé pour installer les dépendances front-end si vous souhaitez modifier le code sans connexion internet)
- Composer

### Installer les dépendances Font-end

Lancez, dans un terminal à la racine du projet, la commande :

`npm install`

Cette commande permet d'installer les dépendences front-end, notamment Bootstrap

### Installer les dépendances PHP

Lancez la commande

`composer install`

Dans un terminal, ça va générer un dossier vendor/ nécessaire pour l'utilisation de la base de donnée

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
```

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

### Lancer Docker

Démarrez Docker Desktop et lancer, dans un terminal, la commande :

`docker-compose up --build`

Cette commande sert à lancer Apache, PHP, MySQL, PHPMyAdmin et l'application web

### Accéder au projet

Une fois la commande au-dessus lancée, vous pourrez trouver le site à l'adresse http://localhost:9000

### Base de données

La base de données, présente dans le init.sql, est lancé automatiquement.

### Comptes test

#### Administrateur

Email : test3@test.fr

Mot de passe : 2TestDeTest!

#### Employé

Email : test6@test.fr

Mot de passe : 2TestDeTest!

#### Client

Email : test2@test.fr

Mot de passe : 2TestDeTest!

## Technologies utilisées

### Front-end

- HTML
- SCSS / Saas Bootstrap
- JavaScript

### Back-end

- PHP
- PDO

### Base de données

- MySQL

### Environnement local/Déploiement

- Docker
- Render
- Railway (pour la Base de données en production)

## Organisation GitHub

Le projet suit une organisation basée sur plusieurs branches :

- `main` : version stable du projet
- `dev` : la branche de développement
- `feature/*`: les branches dédiées aux fonctionnalités, supprimées après merge sur la branche dev

## Informations complémentaires

Certaines fonctionnalités prévues dans le cahier des charges n’ont pas pu être totalement finalisées, notamment l’intégration de MongoDB, l'instauration de filtres ou d'un dashboard pour les comptes administrateurs. Mais c'est en cours de réalisation.
