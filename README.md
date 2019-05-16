# Petite note d'intention
Pour cet exercice, il y aura **deux principaux** composants :
- La plateforme de réservation de livres.
- Une application NodeJs "utilitaire". 

# Détail des deux parties

### 1. La plateforme de réservation de livres
  
  Cette partie représente 80% du travail. C'est le corps de la plateforme qui permettra aux utilisateurs d'accéder aux différents services en fonction de leur statut :
  
| Utilisateur non enregistré                 | Utilisateur enregistré                                                 | Libraire                                                                                                                                                |
|------------------------------------------------|------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------|
| - Accès libre aux différents livres.           | - Accès à un espace personnalisé pour éditer son profil                | - Accès libre aux différents livres                                                                                                                     |
| - Consultation de la fiche technique du livre. | - Accès libre aux différents livres                                    | - Consultation de la fiche technique du livre (version plus détaillée)                                                                                  |
| - Ne peut pas emprunter un livre.              | - Consultation de la fiche technique du livre (version plus détaillée) | - Accès à un back-office pour la gestion des utilisateurs et des livres (actions [CRUD](https://en.wikipedia.org/wiki/Create,_read,_update_and_delete)). |
|                                                | - Possibilité d'emprunter un livre                                     |                                                                                                                                                         |


Pour réaliser la plateforme, j'ai choisi d'utiliser **Laravel** car il s'accorde parfaitement avec ce genre d'application (CRUD Application). 

Les **principales parties** de l'application seront donc 
- L'espace utilisateur.
- Le back-office pour le libraire.
- La page "fiche technique" pour chaque livre.
- La page catégorie pour lister toutes les catgéories de livres.

Pour l'organisation des données, il y aura 4 tables différentes :
- Une table **Users**
- Une table **Books**
- Une table **Categories**
- Une table **Comments (partie bonus)**



### 2. L'Application en NodeJS

  Pour réaliser cette plateforme, il faut avoir un bon stock de livres dans notre base de donnée. Les remplir un à un représenterait un travail long et compliqué.
  Plutôt que de faire cela, je me suis aidé de l'API Google Book. En créant une application NodeJS, on peut exploiter cette API Google pour récupérer un échantillon de livre en fonction de la catégorie renseignée dans la requête :
  
  ```js
  let category = 'Infomaniak';
  axios.get(`https://www.googleapis.com/books/v1/volumes?q=${category}&maxResults=20`)
  .then(function (response) {
   //retrieve all books about Infomaniak in JSON format
  }
  ```
  
  On peut ensuite utiliser des modules NodeJS pour injecter ces données directement dans la BDD de notre plateforme !
  
  Modules utilisés :
  - [Axios](https://www.npmjs.com/package/axios), un client HTTP basé sur les Promesses.
  - [Express](https://www.npmjs.com/package/express),  une librairie qui permet de créer une application Web plus simplement. 
  - [Mysql](https://www.npmjs.com/package/mysql), un module Nodejs permettant d'interagir avec une base de donnée mysql.
  - [Moment.js](https://momentjs.com/), une librairie Javascript permettant de manipuler les dates.
  
  **Structure de l'application**
  
  Le routing de l'application se fera avec Express. Pour renvoyer les vues côté front, j'utiliserai le système de template [EJS](). Il s'accorde parfaitement avec Express (possibilité d'injecter des variables dans les vues après les avoir traitées côté serveur).
  
  La structure de l'application ressemblera à celle ci : 
  
  
