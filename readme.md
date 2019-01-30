

# Laravel 
Lien du projet : https://github.com/Jeremy-vanneau/Laravel-5.7-
Lien de la doc pour Laravel 5.7 : https://laravel.com/docs/5.7

Laravel a besoin d'un wamp, laragon etc et de composer.

Installer Composer.
https://getcomposer.org/download/ 

Tout d’abord il vous faut composer. Composer va servir : 
* Télécharger les composants et placer directement dans la structure du projet,
* Gérer les conflits de nommage,
* mettre à jour les librairies,
* Prévoir le code.
 

### Téléchargement du projet

En ligne de commande.

- Pour créer un nouveau projet avec la dernière version de laravel en ligne de commande 
```php
composer create-project --prefer-dist laravel/laravel blog
```
- Pour créer un nouveau projet avec une version antérieur de laravel en ligne de commande 
```php
composer create-project --prefer-dist laravel/laravel blog "5.6.*"
```
Si vous codez sur VS installer les plugins suivant
"Laravel Blade Snippets" Blade et le template php de laravel.

### l'arborescence des fichiers 
A l'installation de votre projet laravel de nombreux fichiers et dossier on était créé. 
1. app
2. bootstrap
3. config
4. database
5. public
6. resources
7. routes
8. storage
9.  tests
10. vendor
11. .editorconfig
12. .env
13.  .env.example
14. .gitattributes
15. artisan
16. composer.json
17. package.json
18. phpunit.xml
19. readme.md
20. server.php
21. webpack.js

### Connexion à une base de donnée
1. Dans phpMyAdmin créer une nouvelle base de donnée qui se nommera blog comme le nom du projet  
2. Dans notre projet "blog" il y à un fichier à la racine qui se nomme ".env.example" il faut le supprimer.
3. Dans notre projet "blog" toujours il y a un fichier ".env" celui-ci vas nous servir à faire la connexion à la base de donnée.
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead -> nom de la base
DB_USERNAME=homestead -> utilisateur de la base
DB_PASSWORD=secret -> mot de passe de l'utilisateur
 ```
4. Dans ce bloc ci-dessus il faut remplacer certain éléments comme ceci.
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=root
DB_PASSWORD=
 ```
 6. une fois les modifications effectuer nous pouvons faire la migration avec artisan en ligne de commande. 
```php
php artisan migrate
```
Mais une erreur arrive nous disant que la clé est trop longue et que la longueur maximale est de 1000. 
Nous allons donc modifier cette clé pour effectuer la migration de notre projet à notre base de donnée 
dans le dossier "app" -> "Providers" nous allons ouvrir le .php qui se nomme "AppServiceProvider.php" et nous allons faire la modification suivante dans la fonction boot
```php
use Illuminate\Support\Facades\Schema;
public  function  boot(){
Schema::defaultStrignLenght(191);
}
```
5. Dans phpMyAdmin il faut supprimer les deux tables existante pour éviter un conflit de migration 
6. Nous pouvons donc effectuer la migration avec la commande artisan.
 ```php
php artisan migrate
```
si la commande à bien était effectué votre terminal doit afficher : 
 ```php
Migration table create successfully
Migrating : 2014_10_12_000000_create-user_table
Migrated : 2014_10_12_000000_create-user_table
Migrating : 2014_10_12_000000_create-password_resets_table
Migrated : 2014_10_12_000000_create-password_resets_table
```
et vous retrouver ses deux tables dans votre base de donnée donc la migration à était effectuer. 
### L'authentification de laravel 
Nous allons installer le système de  connexion utilisateur  de laravel. 
1.  Dans votre terminal 
```php
php artisan make:auth
```
Et voila maintenant sur votre page d'accueil sur la navbar vous avez "login" et "register" vous pouvez donc créer des ou un utilisateur.

https://github.com/Jeremy-vanneau/Laravel-5.7-

# CRUD Article

Nous allons créer le CRUD ( Create Read Update Delete) article pour pouvoir alimenter notre blog. 
Tout d'abord laravel fonction avec un MVC (Model View Controller) 

- Model : le model interagie avec la base de donnée et récupère les informations de vos objets 
- Controller : Va gérer les demandes utilisateurs et récupérer les donnée en utilisant des modèles 
- View : Va gérer le rendu de vos pages

Pour créer notre CRUD on va avoir besoin 
1. D'un Controller,
2. D'un Model,
3. D'une Migration,
4. et des vues.

Le Controller va avoir toutes les fonctions de notre crud article
- la fonction index  qui va récupérer tous nos articles.
- la fonction create  qui va renvoyer sur la route et la fonction store .
- la fonction store qui va récupérer les éléments saisie de la vue et les enregistrer dans la base de donnée.
- la fonction edit  qui va renvoyer sur la route et la fonction update.
- la fonction update qui va récupérer les éléments de la base de donnée pour que l'utilisateur puisse les modifier.
- la fonction delete ou destroy : qui va supprimer un article  .

Le Model va récupérer les champs dans notre de table "article" de notre base "blog".
La Migration va servir à faire la création et la migration des champs de notre table "article"


Pour créer le Controller
```php
php artisan make:controller Article
```
Pour créer le Model
```php
php artisan make:model Article
```
Pour créer la Migration
```php
php artisan make:migration create_articles_table
```
Pour créer les trois en même temps
```php
php artisan make:model Article -mc
```
Pour créer les trois en même temps + les resources du controller
```php
php artisan make:model Article -mc -r
```
- -mc va créer le fichier de migration et le controller 
- -r va créer les ressources dans le controller 

### Pour créer un article 
Nous allons donc commencer par créer le model la migration et le controller avec la commande suivante :
```php
php artisan make:model Article -mc -r
```
Commençons par créer les différentes view. Dans le dossier "resources" puis "views" nous allons créer un dossier "articles" et dans se dossier articles nous allons créer 4 fichiers :
1. index.blade.php
2. create.blade.php
3. edit.blade.php
4. show.blade.php

ces 4 fichiers seront nos vues.

Maintenant nous allons mettre les champs de notre table article. A la racine du dossier "app" nous avons un fichier Article.php qui a était créer. Dans la classe Article de se fichier on va ajouter un tableau qui sera protected fillable avec nos different champs comme ceci : 
```php
class  Article  extends  Model
{
	protected  $fillable = [
		'name','extract','content'
	];
}
```
name = titre de l'article
extract = extrait de l'article 
content = contenu de l'article 

Le model est donc créer. 

Dans le dossier "database" puis "migration". le fichier 2019_01_29_150022_create_articles_tables.php a était créer. 
Dans ce fichier il y a déjà le schema de création de notres tables articles nous allons donc rajouter les champs de notre model. 
```php
public  function  up(){
	Schema::create('articles', function (Blueprint  $table) {
		$table->increments('id');
		$table->string('name');
		$table->text('extract',200);
		$table->longtext('content');
		$table->timestamps();
	});
}
```
- Sur la ligne 5 de l'exemple après 'extract' nous avons le nombres 200 il va limiter le nombre de caractère à 200 pour le champ extract 
Nous pouvons maintenant effectuer la migration de notre table sur phpMyAdmin avec la commande suivante.
```php
php artisan migrate 
```
Et nous retrouvons notre table articles avec tous ces champs.

Dans le fichier "app" -> "Http" puis "Controllers" nous avons le fichier "ArticleController.php" dans ce fichier nous avons 7 fonctions qui on était créer nous allons remplir les fonctions create et strore: 

Dans la fonction create
```php
public  function  create(){
	return  view ('articles\create');
}
```
La fonction create va juste nous retourner notre vue create 

- articles = correspond à notre dossier articles
- create = correspond à notre vue 

Dans la fonction Store
```php
public  function  store(Request  $request){
	$article = Article::create([
		'name' => $request->input('name'),
		'extract' => $request->input('extract'),
		'content' => $request->input('content'),
	]);
	return  redirect(route('index_article'));
}
```
on retrouve nos champs et les request sur nos futur input. et on retourne notre route index_article

Du coup nous allons créer nos route dans le dossier "routes" puis dans le fichiers "web.php" nous allons éditer nos routes 

> si vous avec en double la route Auth et Route::get ('home' ... etc vous pouvez les supprimer

Pour prendre de l'avance nous allons directement créer toute nos routes
```php
Route::get('articles', 'ArticleController@index')->name('index_article');
Route::get('articles/create', 'ArticleController@create')->name('create_article');
Route::post('articles/store','ArticleController@store')->name('store_article');
Route::get('articles/edit/{id}', 'ArticleController@edit')->name('edit_article');
Route::put('articles/update/{article}', 'ArticleController@update')->name('update_article');
Route::get('articles/destroy/{id}', 'ArticleController@destroy')->name('destroy_article');
Route::get('articles/{article}', 'ArticleController@show')->name('show_article');
```
Explication 

- Route  = routeur
- Get;Post;Put = Méthode de la requête  
- ('.....', = Url. Exemple = monprojet.fr/articles
- ...'ArticleController@index = On utilise le controller article avec la fonction index
- ->name ('') = Pour nommé la route 

Dans notre vue create nous allons créer le formulaire pour créer un article. Donc dans le dossier "resources"; "views" puis "articles" dans le fichier "create.blade.php" nous mettre le code si-dessous :
```html
@extends('layouts.app')

@section('content')

<h3  class="jumbotron text-center">Ajouter un article</h3>

<div  class="container">

<form  method="post"  action="{{route('store_article')}}"  enctype="multipart/form-data">

@csrf

<div  class="row">

<div  class="form-group ">

<label  for="name">Titre de l'article:</label>

<input  type="text"  class="form-control"  name="name">

</div>

</div>

<div  class="row">

<div  class="form-group ">

<label  for="extract">Extrait de l'article:</label>

<input  type="text"  class="form-control"  name="extract">

</div>

</div>

<div  class="row">

<div  class="form-group ">

<label  for="content">Contenu de l'article:</label>

<textarea  type="text"  class="form-control"  name="content"></textarea>

</div>

</div>

<div  class="row">

<div  class="form-group "  style="margin-top:60px">

<button  type="submit"  class="btn btn-success">Submit</button>

</div>

</div>

</form>

</div>

@endsection
```
Sur la ligne 1 vous pouvez voir que notre fichier "create.blade.php" hérite de "layouts.app" dans le dossier "resources" vous avec un dossier qui ce nomme "layouts" et dedans un fichier "app.blade.php" cela fait parti du template de laravel, dans ce fichier vous trouverez tous se qui est fixe à votre si. Par exemple si vous créez un navbar ne répéter pas le code sur chaque page mais faite un extends. 
Sur la ligne 2 vous une section qui se nomme "content" entre elle vous pouvez mettre le code correspondant à la page. (ne pas oublier de fermer la section). pourquoi un "@" blade et un moteur de template tirer du php les "@" evite d'ouvrir et de fermer la balise php.

Notre fonction create pour nos articles est fini

### L'index de article 
Maintenant nous allons créer notre index article. Cette page aura pour but de lister tous nos article créer.
De plus on rajoutera sur cette page la possibilité de créer, modifier, supprimer et de regarder un article.
Dans notre Controller nous allons rajotuer le code suivant : 
```php
public  function  index(){
	$articles = Article::all();
	return  view ('articles/index',[
		'articles'=>$articles
	]);
}
```
C'est tout simplement une fonction qui va faire appel a au model de Article. 

Dans notre vue index nous allons créer un tableau qui recevra les données de notre table.
```html
@extends('layouts.app')

@section('content')

<div  class="container">

<div  class="row">

<div  class="col-lg-10 col-lg-offset-1">

<a  href="{{  route('create_article') }}"  class="btn btn-success">Ajouter un Article</a>

</div>

</div>

<div  class="row">

<div  class="col-lg-10 col-lg-offset-1">

<table  class="table">

<thead>

<tr>

<th>Voir l'article</th>

<th>Titre</th>

<th>Extrait de l'article</th>

<th>Date modification</th>

<th>Date création</th>

<th>Editer</th>

<th>Supprimer</th>

</thead>

<tbody>

@foreach($articles  as  $article)

<tr>

{{-- <td><a href="{{ route('show_index', $aricle->id) }}" class="btn btn-primary">Lire l'article</a></td> --}}

<td>{{  $article->name  }}</td>

<td>{{  $article->extract  }}</td>

<td>{{  $article->updated_at  }}</td>

<td>{{  $article->created_at  }}</td>

<td><a  href="{{  route('edit_article', $article) }}"  class="btn btn-primary">Editer</a></td>

<td><a  href="{{  route('destroy_article', $article) }}"  class="btn btn-danger">Supprimer</a></td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>

@endsection
```
on a ici 3 commentaires, ce sont juste les buttons de redirection pour show edit et delete.

Pour notre index c'est terminer. 

 ### Éditer un article
 Dans le controller Article dans la fonction edit on va ajouter se code
 ```php
 public function edit($id){
        $articles = Article::findorfail($id);
        return view('articles/edit', [
            'article' => $articles
        ]);
 }
```
Comme pour la fonction index on va récuperer l'article mais pas en tous, on va faire un findorfail sur id de l'article en question.
Ensuite nous allons faire la fonction update
```php
public  function  update(Request  $request, Article  $article){
	$article->name = $request->input('name');
	$article->extract = $request->input('extract');
	$article->content = $request->input('content');
	$article->save();
	return  redirect(route('index_article'));
}
```
Mais avant nous allons facilité la création de nos formulaire en installant laravel collective
voici la doc: https://laravelcollective.com/docs/5.4/html
et la commande pour l'installer 
```php
composer require "laravelcollective/html":"^5.4.0"
```
Dans notre vue edit nous allons créer le formulaire.
```html
@extends('layouts.app')
@section('content')
<h3  class="jumbotron text-center">Editer un article</h3>
<div  class="container">
{!!  Form::model($article, [
'url'  =>  route('update_article', $article),
'method'  =>  'PUT'
]) !!}
<div  class="form-group">
<label  for="">Titre de l'article</label>
{{  Form::text('name', null, ['class'  =>  'form-control']) }}
</div>
<div  class="form-group">
<label  for="extract">Extrait de l'article</label>
{{  Form::textarea('extract', null, ['class'  =>  'form-control']) }}
</div>
<div  class="form-group">
<label  for="">Contenu de l'article</label>
{{  Form::textarea('content', null, ['class'  =>  'form-control']) }}
</div>
{{  Form::submit('Sauvegarder', ['class'  =>  'btn btn-primary']) }}
{!!  Form::close() !!}
</div>
@endsection
```
On peut donc éditer un article 


 ### Supprimer un article
Dans le controller à la fonction destroy nous allons ajouter ce code 
```php
public function destroy($id)
    {
        Article::findorfail($id)->forceDelete();
        return redirect(route('index_article'));
    }
```
et dans notre index retirer le commentaire du bouton supprimer 

 ### Lire un article
Dans notre controller dans la fonction Show comme pour la fonction index 
```php
public function show(Article $article)
    {
        $article = Article::findorfail($article);
        return view('article/show',[
            'articles' => $article
        ]);
    }
```
Dans l'index on retire le commentaire du boutton show. 
Et on passe à la présentation de la vue "show.blade.php"
```html
  @foreach($artistes as $artiste)
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <img class="rounded-circle"
                         src="{{url($artiste->filename? 'images/'.$artiste->filename:'images/noimage.jpg')}}"
                         alt="{{$artiste->description_img}}"/>

                </div>
                <div class="col-sm-8">
                    <h1 class="text-center">{{ $artiste->name }}</h1>
                    <p>{{ $artiste->description }}</p>
                </div>
            </div>
            <div class="row-flex">
                <div class="col-md-12">
                    <ul>
                        <li><a class="btn btn-primary" href="{{ $artiste->link_fb }}">Facebook</a></li>
                        <li><a class="btn btn-primary" href="{{ $artiste->link_twitter }}">Twitter</a></li>
                        <li><a class="btn btn-primary" href="{{ $artiste->link_insta }}">Instagram</a></li>
                    </ul>
                </div>

            </div>
        </div>
    @endforeach
```
Vous avez maintenant un crud complet 

