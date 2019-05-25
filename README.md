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
  Plutôt que de faire cela, je me suis aidé de l'API Google Book. En créant une application NodeJS, on peut exploiter cette API Google pour récupérer un échantillon de livres en fonction de la catégorie renseignée dans la requête :
  
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
  
  Le routing de l'application se fera avec Express. Pour renvoyer les vues côté front, j'utiliserai le système de template [EJS](https://ejs.co/). Il s'accorde parfaitement avec Express (possibilité **d'injecter des variables dans les vues** après les avoir traitées côté serveur).
  
  La structure de l'application ressemblera à celle ci : 
  ```bash
.
│   server.js
│
│
├───public
│   ├───css
│   │       app.css
│   │
│   └───img
├───ressources
│   └───scss
│           app.scss
│
├───routes
│       index.js
│
└───views
    ├───pages
    │       index.ejs
    │       validation.ejs
    │
    └───partials
            head.ejs
            script.ejs
```

Le fichier ```server.js``` est le noyaux de l'application. Il va permettre de lier toutes les parties grâce à **Express**. Il va initialiser le moteur de template EJS, utiliser le fichier ```index.js``` du dossier routes pour assurer les liens entre les pages et va rendre les différentes vues ```.ejs``` en front.

# Compte rendu technique de l'exercice
Avant d'aller plus loin dans les explications, voici un **scénario d'utilisation** pour faire le tour des fonctionnalités de l'application Borrowell. **Pour commencer, je vous invite à cloner le dossier node_application du projet**.

### 1. Utilisez l'outil NodeJs

  **On va peupler notre base de données en quelques cliques !**
  * Avec une ligne de commande, allez dans le dossier ```node_application``` et lancez la commande  ```node server.js```.
  * Ouvrir le navigateur et connectez-vous au serveur à l'adresse [localhost:3000](localhost:3000).
  * Sélectionnez la catégorie de livre que vous voulez injecter dans la base de donnée (il est préférable d'injecter toutes les catégories).
  
  C'est fait ! La librairie compte maintenant des dizaines de livres. Rendez-vous sur l'application à l'adresse [https://borrowell.championtheo.fr](https://borrowell.championtheo.fr).
  
### 2. Navigation en mode guest

  * Vous pouvez utiliser la barre de recherche.
  * Cliquez sur le bouton "voir tous les livres".
  * Sélectionner une catégorie de livre.
  * Sélectionner un livre.
  * Vous ne pouvez pas emprunter de livres. Pour pouvoir le faire, **créez-vous un compte**.
  
### 3. Navigation en mode Authentifié
  * Vous pouvez vous rendre sur votre espace utilisateur pour modifier votre image de profil.
  * Vous pouvez cette fois-ci emprunter un livre en vous rendant sur n'importe quel livre. (Cependant, si le livre est déjà emprunté par un autre utilisateur, vous verrez un bouton grisé avec écrit dessus "Livre déjà emprunté".
  * Depuis votre espace profil, vous pouvez rendre un livre que vous avez emprunté.
  
### 4. Navigation en mode Libraire
  Vous bénéficiez de toutes les fonctionnalités mais vous avez en plus :
  * L'**accès à un back-office** où vous pouvez gérer les livres (ajouter/éditer/supprimer) ainsi qu'un aperçu de tous les utilisateurs enregistrés sur la plateforme (possibilité de leur envoyer un mail).
  * Vous avez un petit bouton orange "Editer" sur chaque page présentation d'un livre.
  
# Partie Technique

**Outil NodeJs**
1. [Structure de l'outil]()
2. [La récupération des données de l’API GoogleBooks]()
3. [Traitement des données]()
4. [Injections des données dans la BDD]()

**Application Laravel**
1. [Structure de l'application]()
2. [Les routes]()
3. [Le front dynamique]()
4. [Authentification]()
5. [Interaction entre Vue et Model]()
6. [Gestion des images avec intervention]()
