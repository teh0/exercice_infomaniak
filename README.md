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
Avant d'aller plus loin dans les explications, voici un **scénario d'utilisation** pour faire le tour des fonctionnalités de l'application Borrowell.

Rendez-vous sur l'application à l'adresse [https://borrowell.championtheo.fr](https://borrowell.championtheo.fr).
  
### 1. Navigation en mode guest

  * Vous pouvez utiliser la barre de recherche.
  * Cliquez sur le bouton "voir tous les livres".
  * Sélectionner une catégorie de livre.
  * Sélectionner un livre.
  * Vous ne pouvez pas emprunter de livres. Pour pouvoir le faire, **créez-vous un compte**.
  
### 2. Navigation en mode Authentifié
  * Vous pouvez vous rendre sur votre espace utilisateur pour modifier votre image de profil.
  * Vous pouvez cette fois-ci emprunter un livre en vous rendant sur n'importe quel livre. (Cependant, si le livre est déjà emprunté par un autre utilisateur, vous verrez un bouton grisé avec écrit dessus "Livre déjà emprunté".
  * Depuis votre espace profil, vous pouvez rendre un livre que vous avez emprunté.
  
### 3. Navigation en mode Libraire
  Pour cette partie, il faut vous connecter avec un compte libraire :
  ```js
  let libraire = {
    email: "tochampion38@gmail.com",
    password: "1234567897911111977!"
  }
  ```
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

# [Outil NodeJs] - Structure de l'outil

La structure de l'application est quasiment la même que celle énoncée dans la note d'intention. On rappelle que cet outil à pour but de peupler rapidement la table de donnée de la plateforme de livre à partir des données récupérées sur l'API Google Book.
[Voici une **démonstration vidéo** du résultat de l'outil]().

# [Outil NodeJs] - La récupération des données de l’API GoogleBooks

J'ai restreints la recherche de livres à 6 catégorie différentes : PHP, HTML, CSS, JavaScript, Python, NodeJs. Comme vous avez pu le voir sur le [vidéo](), je peux les choisir avec un bouton select

```html
<form action="" method="POST">
    <select name="category">
        <option value="php">PHP</option>
        <option value="javascript">JavaScript</option>
        <option value="html">HTML</option>
        <option value="css">CSS</option>
        <option value="python">Python</option>
        <option value="nodejs">NodeJs</option>
    </select>
    <button type="submit">Choisir</button>
</form>
```
A la soumission du formulaire, je récupère le paramètre ```category``` grâce à express et je fais uen requête sur l'api grâce à [Axios](https://www.npmjs.com/package/axios).
```js
    app.post('/', function (req, res) {
        category = req.body.category;
        ...
    }
```
Ainsi, la requête est dynamique en fonction du choix de l'utilisateur.

# [Outil NodeJs] - Traitement des données

Une fois les données récupérées, il faut effectuer des traitements et des filtres afin d'injecter seulement les livres qui respectent certaines conditions : 
  * Le livre doit posseder une description, un auteur, une miniature, un titre, un nombre de page, une langue. Autrement dit, il ne faut pas que ces champs soit vides (NULL).
  * Le livre ne doit pas être présent dans la base de donnée.

Pour se faire j'ai décomposé le traitement en 3 étapes : 
### 1. On créé un tableau d'objets comportant chaque livre de la requête en ne gardant que les propriétés qui nous interesse

  ```js
  //dataBooks is the result of all books retrieved from Axios
  dataBooks.forEach(element => {
    let newdataBook = {
        title: element.volumeInfo.title,
        authors: element.volumeInfo.authors,
        description: element.volumeInfo.description,
        pageCount: element.volumeInfo.pageCount,
        lang: element.volumeInfo.language,

    };
    if (element.volumeInfo.imageLinks) {
        newdataBook.small_thumbnail = element.volumeInfo.imageLinks.thumbnail.replace("http", "https");
    }
  });
  ```

### 2. On filtre les livres dont toutes les propriétés sont présentes et non NULL et on les stock dans un tableau ```listValidBooks```

  ```js
  // If a value of props is undefined or total props number != 7, we don't keep the book
  if (Object.values(newdataBook).length === 6 && !Object.values(newdataBook).includes(undefined)) {
      newdataBook.large_thumbnail = newdataBook.small_thumbnail.replace('zoom=1', 'zoom=0.5');
      listValidBooks.push(newdataBook);
  }
  ```
### 3. On vérifie si le livre n'est pas déjà présent dans la base de donnée de la librairie. Pour cela, on compare le titre et la description de chaque livre de la BDD avec ceux récupérés dans la requête Axios

  ```js
  // If a value of props is undefined or total props number != 7, we don't keep the book
  let listTitleBookStored = [];
  let listDescriptionBookStored = [];
  let listNewBooksStored = [];
  listBookStored.forEach(element => {
      listTitleBookStored.push(element.title);
      listDescriptionBookStored.push(element.description);
  });

  listValidBooks.forEach(element => {
      if (!listTitleBookStored.includes(element.title) && !listDescriptionBookStored.includes(encodeURI(element.description))) {
          listNewBooksStored.push(element);
          ... 
          //INSERT BOOKS
      }
  });
  ```
# [Outil NodeJs] - Injections des données dans la BDD

Pour se connecter à la base de donnée locale de la plateforme, j'ai utilisé [Mysql](https://www.npmjs.com/package/mysql).
Il faut d'abord se connecter avec la BDD :

```js
//Instance local database connection 
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'infomaniak',
});
connection.connect();
``` 

A partir de cette connection, on peut effectuer n'importe quel traitement sur la base de donnée. J'ai donc inséré dans la BDD le contenu de mon tableau ```listNewBooksStored``` comportant tous les livres valides.

```js
listValidBooks.forEach(element => {
    if (!listTitleBookStored.includes(element.title) && !listDescriptionBookStored.includes(encodeURI(element.description))) {
        listNewBooksStored.push(element);
        connection.query(`INSERT INTO ${table} (category_id, title, authors, small_thumbnail, large_thumbnail, description, pageCount, lang, fromApi, created_at, updated_at) 
        VALUES ("${categroyID[category]}", "${element.title}", "${element.authors}", "${element.small_thumbnail}", "${element.large_thumbnail}", "${encodeURI(element.description)}", "${element.pageCount}", "${element.lang}", true, "${moment().format('YYYY-MM-DD HH:mm:ss')}", "${moment().format('YYYY-MM-DD HH:mm:ss')}")`, function (error, results, fields) {
            if (error) throw error;
        });
    }
});
```
