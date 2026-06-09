# Sixième Sens

Ce dépôt contient le projet d’intégration réalisé dans le cadre du Bachelor en Ingénierie des Médias à la HEIG-VD par le groupe **Sixième Sens**.

Le groupe est composé de :

- Sarah Furrer — Responsable gestion de projet & Scrum Master
- Marike Platen — Responsable UX & Product Owner
- Sacha Loskov — Responsable UI
- Ella Maiburg — Responsable marketing
- Steve Benjamin — Responsable développement front-end
- Benoît Jaques — Responsable développement back-end

## Table des matières

- [Objectif du projet](#objectif-du-projet)
- [Organisation du projet](#organisation-du-projet)
- [Configuration du projet](#configuration-du-projet)
- [Workflow Git](#workflow-git)

## Objectif du projet

Ce projet consiste à concevoir et développer une plateforme web dédiée au **Trophée de la générosité** des HUG, afin de valoriser les entreprises partenaires organisant des collectes de sang et de leur fournir un espace clair pour s’informer, participer aux campagnes en cours et accéder aux informations utiles à l’organisation d’une collecte. Le site doit notamment présenter le trophée et le Label CTS, mettre en avant les entreprises labellisées et les lauréats, proposer des formulaires de contact et de participation, ainsi qu’une version co-brandée accessible via un lien spécifique à chaque entreprise. L’objectif est également d’améliorer la participation aux collectes grâce à une communication plus attractive, à une meilleure diffusion des critères d’éligibilité au don et à un outil administrable, traduisible et mesurable pour le CTS.

## Organisation du projet

Le projet comprend :

- Une analyse des attentes et des problématiques du mandant
- Une page vitrine présentant le don du sang et le Trophée de la générosité
- Une page co-brandée permettant aux employé·e·s de s’informer sur les critères d’éligibilité au don du sang et d’accéder au lien d’inscription à une collecte
- Une interface d’administration pour la gestion des pages co-brandées
- Un kit de communication à destination des entreprises, comprenant des supports internes pour les employé·e·s, des supports externes pour valoriser leur engagement, ainsi qu’un label à mettre en avant
- Une définition de KPI afin d’évaluer la performance du projet
- Un rapport final de projet
- Une présentation finale de 15 minutes

Le projet s’appuie sur les outils et technologies suivants :

- [Jira](https://sixieme-sens.atlassian.net/jira/software/projects/SCRUM/boards/1/backlog) pour la gestion de projet et des sprints
- Figma pour l’idéation, la création des user flows, des wireframes et des maquettes
- MySQL pour la base de données
- Laravel pour le back-end
- Vue.js pour le front-end
- [Infomaniak](https://manager.infomaniak.com/v3/1183546/ng/home) pour l’hébergement et le déploiement

## Workflow Git

Pour chaque modification du code sur le dépôt GitHub, les étapes suivantes doivent être respectées :

1. Créer une issue décrivant l’implémentation ou la correction à réaliser
2. Créer une branche liée à cette issue
3. Développer la fonctionnalité ou le correctif
4. Push la branche sur le dépôt distant
5. Demander une review au responsable concerné :
    - Steve Benjamin pour le front-end
    - Benoît Jaques pour le back-end
6. Merger la branche une fois la review validée, puis supprimer la branche

> **Ne jamais modifier directement la branche `main`.**

## Pré-requis

Afin de lancer ce projet, une stack compatible avec Laravel, est requise.

Voici les pré-requis nécessaires :

- PHP >= 8.0.
- Composer.
- Node.js et npm.
- Une base de données (MySQL, PostgreSQL, SQLite, etc.).
- Un serveur web (Apache, Nginx, etc.).

[Laravel Herd](https://helm.sh/docs/charts/laravel/) est recommandé pour une installation facile de Laravel et de ses dépendances.
[Mailtrap](https://mailtrap.io/home) est recommandé pour tester l'envoi de mail durant la partie développement

> Dans l'environnement de développement, le sgdb sera MySQL
> Il est cependant possible (et recommandé) de développer localement en SQLite

> [!WARNING]
> Ne pas utiliser de technologie propre à MySQL ou SQLite afin d'éviter tout bugg

### Développement local

Pour développer et tester le mini-projet en local, voici les étapes à suivre :

1. Cloner ce dépôt sur votre machine locale :

    ```bash
    git clone git@github.com:BenbounBigHydra/sixieme_sens.git

    cd sixieme_sens
    ```

2. Installer les dépendances avec npm et Composer :

    ```bash
    npm install

    npm run build

    composer install
    ```

3. Copier le fichier `.env.example` en `.env`.
4. Modifier les variables d'environnement si nécessaire.

    ```bash
    DB_CONNECTION=monTypeDeDB
    # Ajouter les autres variable de la DB si nécessaire

    MAIL_HOST=sandbox.smtp.mailtrap.io
    # Ajouter les autres données de mailtrap ou du service mail utilisé
    ```

5. Générer la clé d'application Laravel :

    ```bash
    php artisan key:generate
    ```

6. Créer le lien symbolique pour les fichiers téléversés :

    ```bash
    php artisan storage:link
    ```

7. Créer la base de donnée, exécuter les migrations et seed :

    ```bash
    php artisan migrate
    ```

_S'il est nécessaire de réinitialiser la base de données durant le développement_

```bash
php artisan migrate:fresh --seed
```

8. Démarrer le serveur de développement Laravel :

    ```bash
    composer run dev
    ```

L'application sera accessible à l'adresse <http://127.0.0.1:8000>.

### Déploiement serveur de production

À chaque Merged pull request, le serveur Infomaniak se met à jour.

```bash
source ~/.bashrc
cd ~/sites/sixieme_sens
git config pull.rebase false
git reset --hard HEAD
git config pull.rebase false
git pull origin main
npm install
npm run build
composer install --no-dev --optimize-autoloader
php artisan migrate:fresh --seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

> [!CAUTION]
> Actuellement, la DB est totalement effacée, recréé et seedée à chaques fois. Au moment du déploiement réel, corriger cette fonctionnalité

### Pages

[donnons.ch](https://donnons.ch/) : Site vitrine

[donnons.ch/collection/{company_name}/{collection_id}](https://donnons.ch/collection/heig-vd/237) : Site co-brandé. Pour les tests ; 
* company : heig-vd
* collection : 237

[donnons.ch/admin](https://donnons.ch/admin) : Site admin. Pour les tests ; 
* email : admin@example.ch
* psw : password

## Structure du projet

### Model

Les [migrations](database\migrations) définissent la structure de la base de donnée.

Les [Models](\app\Models) définissent le comportement de ces données en tant qu'objet php.

<details>
<summary>Schéma relationnel</summary>

![Model](doc/schema%20relationnel.png)
    
</details><br>

Le model a été fait de manière à éviter toute donnée redondante afin de prévenir au maximum les erreurs. Les données concernant les labels et les trophées ne sont donc jamais directement stockés mais systématiquement calculés sur la base des collectes des entreprises.

### Controller

Quatre controller différents ont été créé pour gérer ce site

- [VitrinController.php](\app\Http\Controllers\VitrinController.php) s'occupe de la gestion du site vitrine
- [CoBrandController.php](\app\Http\Controllers\CoBrandController.php) s'occupe de la gestion du site co-brandé
    - La logique est d'avoir des site co-brandé généré dès la création d'une nouvelle collecte et les informations de la collecte sont récupérées dans l'url pour gérer l'affichage
- [AdminController.php](\app\Http\Controllers\AdminController.php) s'occupe de la gestion du site admin des HUG
    - [LoginController.php](\app\Http\Controllers\LoginController.php) est un controller dédié au login des admin HUG. La logique a été qu'un seul compte admin était défini (même si plusieurs personnes utilisent le même profil admin).

La logique du traitement des données, étant complexe, a été déléguée dans deux [services](\app\Services) dédiés :

- [CompanyStatsService.php](\app\Services\CompanyStatsService.php) s'occupe du calcul des trophées et des labels attribués aux entreprise et mis en avant sur le site vitrine.
- [AdminService.php](\app\Services\AdminService.php) s'occupe de toutes les données nécessaire à la gestion par les admins HUG
- [TrackingService.php](\app\Services\TrackingService.php) s'occupe du traitement des données liées au tracking de performance (KPIs)

Pour gérer les interaction Frontend - Backend, une api a été mise en place avec ses [controller](\app\Http\Controllers\Api) dédiés :

- [ApiCollectionController.php](app/Http/Controllers/Api/ApiCollectionController.php) gère un CRUD complet pour les collectes
- [ApiCompanyController.php](app/Http/Controllers/Api/ApiCompanyController.php) gère un CRUD complet pour les entreprises
> Les routes CRUD sont protégées par `auth:sanctum` un token d'authentification est requis.
- [ApiRewardsController.php](app/Http/Controllers/Api/ApiRewardsController.php) gère la récupération des récompenses des entreprises
- [ApiMailController.php](app/Http/Controllers/Api/ApiMailController.php) s'occupe de l'envoi de mail depuis le formulaire de contact
- [ApiTrackingController.php](app/Http/Controllers/Api/ApiTrackingController.php) gère le tracking de l'activité utilisateur afin de mesurer les KPIs

[CollecteDemandeMail.php](app/Mail/CollecteDemandeMail.php) est un fichier spécifiquement conçu uniquement pour l'envoi des mail
[TrackCollectionVisit.php](app/Http/Controllers/Middleware/TrackCollectionVisit.php) est un middleware gérant la mise en place des cookies afin de mesurer correctement les KPIs
[web.php](routes/web.php) s'occupe du routage des pages
[api.php](routes/api.php) s'occupe du routage de l'api

### Vue

Le routage des pages renvoi vers l'un des dossiers suivant :

- [vitrin](resources/views/vitrin) contient les fichiers blade des vues du site vitrine
- [cobrand](resources/views/cobrand) contient les fichiers blade des vues du site co-brandé
- [admin](resources/views/admin) contient les fichiers blade des vues du site admin

Ces fichiers ne contiennent que les datas nécessaire à l'affichage de la page. L'ensemble de l'affichage est généré coté front-end par les fichiers [Vue.js](\resources\js\components)
- `*Vitrine.vue` — composants du site vitrine (HomeVitrine, TropheesVitrine, LabelVitrine, CompaniesVitrine, CollecteVitrine)
- `*Cobrand.vue` — composants du site co-brandé (HomeCobrand, InfosCobrand, QuizzCobrand, HeaderCobrand, FooterCobrand)
- `*Admin.vue` — composants de l'interface d'administration (DashboardAdmin, CollectionsAdmin, CompaniesAdmin, LeaderboardAdmin, LoginAdmin, HeaderAdmin)

### Medias

Les fichiers medias de l'application sont directement stockés dans le dossier [public/images](public/images) (comprenant le logo, images du quizz, pictos, ...)

Les logos des entreprise, chargés depuis la console admin HUG, sont stockés dans le sous-dossier [public/images/companies_logo](public/images/companies_logo). Ces logos sont renommé en ajoutant le timestamp d'upload (hormis les logos du seeder) pour garantir l'unicité.
