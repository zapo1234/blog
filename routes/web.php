<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    Route::group(['middleware' => ['auth']], function () {
    //only authorized users can access these routes
    // route de fichier upload et affichage
    Route::get('/uploadfile', 'InscriptionController@upload')->name('upload');

    // traitement sur les vues MessageController
    // create des messages
    Route::get('/message', 'MessageController@message')->name('message');
    Route::post('/message', 'MessageController@add_message')->name('add_message');

});

  Auth::routes();

   Route::get('/home', 'HomeController@index')->name('home');

   // methode insert simple
  Route::get('/inscription', 'InscriptionController@insert')->name('insert');
  Route::post('/create', 'InscriptionController@create')->name('create');

  // envoi de mail
  Route::get('/contact', 'SendemailController@sendEmail')->name('sendEmail');
  Route::post('/', 'SendemailController@creates')->name('creates');

  // et gestion de cache
  Route::get('/listepdf', 'InscriptionController@index')->name('listepdf');

  Route::get('pdf', 'InscriptionController@pdf')->name('pdf');

  Route::get('/student/pdf', 'InscriptionController@pdfs');

  Route::get('/student/list', 'InscriptionController@list');

  Route::get('/search', 'InscriptionController@search');

// crud edit,delete

 Route::get('/edit/{tag}', 'InscriptionController@edit')->name('edit');
 Route::post('/edit/{tag}', 'InscriptionController@creates')->name('cre');
 Route::get('/delete/{tag}', 'InscriptionController@hide');

 // upload fichier
 Route::post('/store', 'InscriptionController@store')->name('store');

 // route surpime upload en base de données et sur le serveur
 Route::get('/delete_img/{tag}', 'InscriptionController@del');


 // relation on to many et hasmany

 // route surpime upload en base de données et sur le serveur
 Route::get('/add_categories', 'RelationController@addcart');
 // route surpime upload en base de données et sur le serveur
 Route::get('/add_annonce/{tag}', 'RelationController@addannonce');

 // route surpime upload en base de données et sur le serveur
 Route::get('/categories_annonce/{tag}', 'RelationController@getannonce');

 //  génération des route pdf route mdpf

 n:Route::get('/pdfm', 'PDF\TestPDF@generate')->name('generate');

// route pour ecommerce

// view article liste
//show un article
Route::get('/product/article', 'ProductsController@list')->name('list');
//show un article
Route::get('/product/product/{product}', 'ProductsController@show')->name('show');

// route du parnier
// Les routes de gestion du panier
Route::get('basket', "BasketController@show")->name('basket.show');
Route::post('basket/add/{product}', "BasketController@add")->name('basket.add');
Route::get('basket/remove/{product}', "BasketController@remove")->name('basket.remove');
Route::get('basket/empty', "BasketController@empty")->name('basket.empty');

 // route role gestion des users pour les roles
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');
//show un article
Route::get('/users', 'GerantController@index')->name('users')->middleware('users');


