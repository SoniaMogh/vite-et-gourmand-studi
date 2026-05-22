# Vite et Gourmand

## Présentation du projet

Ce site est un site vitrine, développé en PHP, pour le restaurant Vite et Gourmand, permettant de présenter leur menus et de gérer les commandes clients.

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
- Docker Destop

### Cloner le projet

Dans un terminal, à l'endoit où vous souhaitez cloner le projet, tapez la commande
`git clone https://github.com/SoniaMogh/vite-et-gourmand-studi.git`

puis entrez dans le dossier
`cd nom-du-dossier-créé`

### Configuration des variables d'environnement

Créer un fichier .env à la racine du projet, et y copier ce code :

```
  DB_HOST=mysql
  DB_NAME=viteetgourmand
  DB_USER=root
  DB_PASSWORD=root
```

### Lancer Docker

Démarrer Docker Desktop et lancer, dans un terminal, la commande :

`docker-compose up --build`

Cette commande sert à démarrer les conteneurs écrit dans le fichier `docker-compose.yml`

### Accéder au projet

Une fois la commande au-dessus, lancée, vous pourrez trouver le site à l'adresse http://localhost:9000

La base de données, présente dans le init.sql, est lancé automatiquement, grâce à la ligne 34 du fichier docker-compose.yml

    `./docker/mysql/init.sql:/docker-entrypoint-initdb.d/init.sql`

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
