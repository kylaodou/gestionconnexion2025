# Gestion des connexions réseau

Application web de gestion de l'accès au réseau d'un établissement : étudiants, personnel,
appareils (adresses MAC) et connexions, avec demandes d'enregistrement d'appareils et exports.

Une copie de ce projet préparée pour le déploiement sur Heroku se trouve dans
[`gestionConnexionHeroku2025`](https://github.com/kylaodou/gestionConnexionHeroku2025).
## Fonctionnalités

- **Connexion / inscription** des administrateurs.
- **Étudiants** (identifiés par leur INE) : ajout, liste, modification, suppression.
- **Personnel** : ajout, liste, modification, suppression.
- **Appareils** (identifiés par leur adresse MAC) : ajout, liste, modification, suppression.
- **Connexions** : attribution d'un accès réseau, liste, modification, suppression.
- **Demandes d'ajout d'appareil** par les étudiants et par le personnel, et consultation de
  « mes appareils ».
- **Exports** Excel et PDF des étudiants, du personnel, des connexions et des appareils.
- Tableau de bord.

## Stack technique

- PHP 8.1+, Laravel 10
- MySQL
- maatwebsite/excel, barryvdh/laravel-dompdf
- Bootstrap, Font Awesome

## Prérequis

- PHP 8.1+ avec les extensions `pdo_mysql`, `gd`, `zip`
- Composer 2
- MySQL 8 (ou MariaDB)

## Installation

```bash
git clone https://github.com/kylaodou/gestionconnexion2025.git
cd gestionconnexion2025

composer install
cp .env.example .env
php artisan key:generate
```

Renseignez la base MySQL dans `.env` (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`), puis :

```bash
php artisan migrate
php artisan serve
```

L'application est disponible sur http://localhost:8000.

## Auteur

[@kylaodou](https://github.com/kylaodou)
