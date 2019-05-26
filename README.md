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
4. [Gestion des images avec le module Intervention]()

# [Outil NodeJs] 

# Structure de l'outil

La structure de l'application est quasiment la même que celle énoncée dans la note d'intention. On rappelle que cet outil à pour but de peupler rapidement la table de donnée de la plateforme de livre à partir des données récupérées sur l'API Google Book.
[Voici une **démonstration vidéo** du résultat de l'outil]().

# La récupération des données de l’API GoogleBooks

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

# Traitement des données

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
# Injections des données dans la BDD

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
# [Application Laravel] 

# Structure de l'application 

Laravel est un framework très complet. Je ne vais donc pas détailler toutes la structure du framework mais plutôt de l'organisation Model Vue Controlleurs mise en place.

* **Les Vues**

  Les vues sont organisées en 6 parties

  | Parties   | Description                                                                   |
  |-----------|-------------------------------------------------------------------------------|
  | admins    | Vues du back-office                                                           |
  | auth      | Vues pour la gestion d'authentification (natives à Laravel)                   |
  | books     | Vues pour l'affichage et l'éditions des livres                                |
  | partials  | Composants de vue à insérer dans d'autres vues (header, footer, sideMenu ...) |
  | templates | Modèle de page pour toutes les vues                                           |
  | users     | Vue pour le profil utilisateur                                                |

  Pour le dossier Scss, j'ai repris la même organisation pour une question de cohérence.

* Les Models

  Il y a 3 tables différentes
  * Book
  * Users
  * Category

  Pour voir plus en détail les champs, je vous invite à regarder les migrations de laravel ```database/migrations```

* Les Contrôleurs (ceux que j'ai créé)

  | Contrôleurs | Rôle                                                                      |
  |-------------|---------------------------------------------------------------------------|
  | Users       | Gère la partie profil des utilisateur (update la photo de profil)         |
  | Admin       | Gère l'affiche du Backoffice                                              |
  | Books       | Gère l'affichage et les traitements des livres (logique CRUD)             |
  | Category    | Gère la logique de regroupement des livre à l'affichage                   |

# Les routes

Vous pouvez retrouver toutes les routes dans le fichier ```web.php```
Voici un tableau récapitulatif de toutes les routes de l'application

```bash
+--------+----------+----------------------------------------+------------------+------------------------------------------------------------------------+--------------+
| Domain | Method   | URI                                    | Name             | Action                                                                 | Middleware   |
+--------+----------+----------------------------------------+------------------+------------------------------------------------------------------------+--------------+
|        | GET|HEAD | /                                      | home             | Closure                                                                | web          |
|        | GET|HEAD | admin/backoffice/{view}                | backoffice       | App\Http\Controllers\AdminController@displayBackoffice                 | web,admin    |
|        | GET|HEAD | api/user                               |                  | Closure                                                                | api,auth:api |
|        | GET|HEAD | book/add                               | createBook       | App\Http\Controllers\BookController@create                             | web,admin    |
|        | POST     | book/add                               | storeBook        | App\Http\Controllers\BookController@store                              | web,admin    |
|        | POST     | book/borrow/{id_book}                  | borrowBook       | App\Http\Controllers\BookController@borrow                             | web          |
|        | GET|HEAD | book/collection                        | collectionBook   | App\Http\Controllers\CategoryController@index                          | web          |
|        | GET|HEAD | book/collection/{slug_categ}           | categoryBook     | App\Http\Controllers\CategoryController@show                           | web          |
|        | GET|HEAD | book/collection/{slug_categ}/{id_book} | singleBook       | App\Http\Controllers\BookController@show                               | web          |
|        | POST     | book/delete/{id_book}                  | deleteBook       | App\Http\Controllers\BookController@destroy                            | web,admin    |
|        | GET|HEAD | book/edit/{id_book}                    | editBook         | App\Http\Controllers\BookController@edit                               | web,admin    |
|        | POST     | book/edit/{id_book}                    | updateBook       | App\Http\Controllers\BookController@update                             | web,admin    |
|        | POST     | book/search                            | searchBook       | App\Http\Controllers\BookController@search                             | web          |
|        | POST     | book/unborrow/{id_book}                | unborrowBook     | App\Http\Controllers\BookController@unborrow                           | web          |
|        | GET|HEAD | login                                  | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST     | login                                  |                  | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | POST     | logout                                 | logout           | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | POST     | password/email                         | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    |
|        | GET|HEAD | password/reset                         | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    |
|        | POST     | password/reset                         | password.update  | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    |
|        | GET|HEAD | password/reset/{token}                 | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    |
|        | GET|HEAD | register                               | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
|        | POST     | register                               |                  | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
|        | GET|HEAD | user/profile                           | profile          | App\Http\Controllers\UsersController@profile                           | web,auth     |
|        | POST     | user/profile                           | update_avatar    | App\Http\Controllers\UsersController@update_avatar                     | web,auth     |
+--------+----------+----------------------------------------+------------------+------------------------------------------------------------------------+--------------+
```
# Le front dynamique

Laravel possède le moteur de template [Blade](https://laravel.com/docs/5.8/blade). Il permet d'effectuer facilement des conditions d'affichages dans les vues grâces à des directives conditionnelles. Voici un exemple avec l'affichage des thumbnails des livres :

```php
<img src="@if($book->fromApi) {{ $book->large_thumbnail }} @else {{ asset('upload/thumbnails').'/'.$book->large_thumbnail }} @endif" alt="Page de couverture du livre {{ $book->title }}">
```
Dans cet exemple, on peut voir 3 directives de Blade :
* ```@if @else``` qui permet d'afficher ou non des élements en fonction de la condition.
* ```{{ asset('...').'/'}}``` qui permet de récupérer d'obtenir le chemin absolue du dossier public du site
* ```{{ $book->title }}``` qui permet d'afficher une variable injectée dans la vue grâce au contrôleur

Il existe aussi des directives très pratiques pour afficher du contenu en fonction de l'état d'authentification de l'utilsateur. On peut prendre l'exemple avec l'affichage du bouton "Editer le livre" dans la foche descriptif de chaque livre :

```php
@auth
    @if (Auth::user()->role == 'admin')
    <a class="button-edit" href="{{ route('editBook', $book->id) }}">Éditer</a>
        
    @endif
@endauth
```
Le lien ne s'affiche que si l'utilisateur est connecté et possède le rôle admin

# Gestion des images avec le module Intervention

Lors de la création d'un livre ou de la modification de l'image de profil d'utilisateur, il faut créer une image pour pouvoir la stocker dans le dossier uploads du site. J'ai choisi d'utiliser [Intervention Image](http://image.intervention.io/). C'est une librairie PHP permettant de manipuler les images. On peut effectuer tout un tas de traitements solides avec. 

Voici un exemple d'utilisation de la librairie dans un contrôleur
```php
$data_large_thumbnail = $request->file('book_large_thumbnail');
$prefix_thumbnail = $this->formateString($book->title).time();
$name_large_thumbnail = $prefix_thumbnail.'_large.'. $data_large_thumbnail->getClientOriginalExtension();
$name_small_thumbnail = $prefix_thumbnail.'_small.'. $data_large_thumbnail->getClientOriginalExtension();

Image::make($data_large_thumbnail)->save( public_path('/upload/thumbnails/'.$name_large_thumbnail) );
Image::make($data_large_thumbnail)->resize(128,181)->save( public_path('/upload/thumbnails/'.$name_small_thumbnail) );
$book->large_thumbnail = $name_large_thumbnail;
$book->small_thumbnail = $name_small_thumbnail;
```