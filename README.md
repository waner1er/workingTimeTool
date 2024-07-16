# Nom du Projet

Ce projet Laravel - Livewire - Filament est une plateforme de suivi des heures de travail pour tout utilisateur inscrit. Il vous permet d'enregistrer vos heures de travail quotidiennes et de garder un historique pour faciliter le suivi.

## Caractéristiques :

- Inscription d'utilisateur
- Enregistrement des heures de travail
- Suivi des heures de travail
- Historique des heures de travail

## Initialisation du Projet

Pour initialiser ce projet sur votre machine locale, veuillez suivre les étapes ci-dessous :

### Prérequis :

- PHP 8.2
- Composer
- Laravel
- Node.js et NPM

### Étapes :

1. Cloner le dépôt du projet. Ouvrez un terminal et tapez :<br>
    ``` cd workingTimeTool ```
2. Naviguez dans le répertoire du projet :<br>
 ``` cd workingTimeTool ```

3. Installez les dépendances PHP avec Composer :<br>
   ``` composer install ```   
4. Installez les dépendances JavaScript avec npm:<br>
   ``` npm install ``` ou ```yarn install ```
5. Copiez le fichier .env.example en .env :<br>
   ```cp .env.example .env```
6. Générez une clé d'application Laravel :<br>
   ```php artisan key:generate```
7. Configurez vos informations de base de données dans le fichier .env: <br>
   ``` 
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=<nom de votre base de données>
   DB_USERNAME=<nom d'utilisateur de votre base de données>
   DB_PASSWORD=<mot de passe de votre base de données>
   ```
8. Exécutez les migrations pour créer les tables de la base de données: <br>
   ```php artisan migrate --seed```
9. Démarrez le serveur de développement :<br>
   ```php artisan serve```
<br>
<br>
<br>
