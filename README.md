<div style="display:flex; justify-content: center; align-items: baseline">
  <h1 style="margin-right: 2rem">Colombien-être</h1>
  <img src="https://github.com/AndreaDellaBiancia/colombienetre/blob/main/public/assets/images/logo.png?raw=true" width="100px" alt="Logo WildBooking">
    
</div>

## Description

Colombien-être est un blog qui regroupe des informations et des articles sur le bien-être.  
Il propose des articles par thématiques, des lectures conseillées, des vidéos et une boutique avec des produits conseillés.  
Un back-office permet à un administrateur de gérer le blog.

## Objectifs

Les objectifs de Colombienetre sont de :

* Proposer du contenu sur le bien-être
* Permettre aux utilisateurs de trouver des informations et des conseils utiles
* Offrir une expérience utilisateur agréable  


## Fonctionnalités

* Pages par thématiques
* Articles consultables
* Lectures conseillées
* Vidéos
* Boutique avec des produits conseillés
* Tri des produits par catégorie et nom
* Back-office pour l'administrateur 


## Technologies utilisées

* Symfony 5.4
* JavaScript
* MySQL  

## Instructions d'installation et d'utilisation

1. Clonez le projet sur votre machine.
2. Lancez la commande `composer install` et `composer update`.
3. Dans le fichier .env, modifiez les informations de connexion à la base de données.  
    `DATABASE_URL="mysql://name_user:password@127.0.0.1:3306/colombienetre?serverVersion=5.7&charset=utf8mb4`
4. Lancez les commandes suivantes pour créer la base de données et les tables :  
    `php bin/console doctrine:database:create`  
    `php bin/console doctrine:migrations:diff`  
    `php bin/console doctrine:migrations:migrate`  

5. Importer le fichier colombienetre.sql dans la base de données.
   [Utiliser le fichier SQL](colombienetre.sql)
6. Lancez le serveur web avec la commande `symfony server:start`.
7. Accédez au site.
8. Pour se connecter au backhoffice rendez-vous à l'adresse `localhost:login`.
  * E-mail `admin@gmail.com` 
  * Mot de passe `adminadmin`    

### Homepage
![Homepage](https://github.com/AndreaDellaBiancia/images-readme/blob/main/colombienetre/home.png?raw=true) 

### Corps & Esprit
![Corps & Esprit](https://github.com/AndreaDellaBiancia/images-readme/blob/main/colombienetre/CE.png?raw=true)  

### Article
![Article](https://github.com/AndreaDellaBiancia/images-readme/blob/main/colombienetre/article.png?raw=true)     

### Boutique
![Boutique](https://github.com/AndreaDellaBiancia/images-readme/blob/main/colombienetre/boutique.png?raw=true)   


### Backoffice
![Back office](https://github.com/AndreaDellaBiancia/images-readme/blob/main/colombienetre/backoffice.png?raw=true)  

### Création article
![Création article](https://github.com/AndreaDellaBiancia/images-readme/blob/main/colombienetre/creation-article.png?raw=true)  
