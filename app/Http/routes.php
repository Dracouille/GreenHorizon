<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Route::get('/galerie', function () {
//    return view('galerie');
//})->name('galerie');

Route::get('/galerie', 'AlbumController@indexFront')->name('galerieindexfront');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


//Routes Avis
Route::get('/avis', 'ComController@index')->name('avis');
Route::post('/avis', 'ComController@store');

//Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
	Route::get('/', 'Back\AdminController@index')->name('AdminIndex');
	//commentaires
	Route::get('/commentaire/affiche', 'Back\AdminController@ComAValider')->name('ComAValider');
	Route::get('/commentaire/liste', 'Back\AdminController@ListeCom')->name('ComListe');
	Route::get('/commentaire/valide/{id}', 'ComController@ValideCom')->name('ValideCom');
	Route::get('/commentaire/delete/{id}', 'ComController@delete')->name('DeleteCom');
	//Type de photos
    Route::get('/album/typeimage/index', 'TypeImageController@index')->name('AdminIndexTypeImage');
    Route::post('/album/typeimage/index', 'TypeImageController@store')->name('AdminStoreTypeImage');
    Route::get('/album/typeimage/delete/{id}', 'TypeImageController@delete')->name('AdminDeleteTypeImage');
    Route::get('/album/typeimage/modifier/{id}', 'TypeImageController@edit')->name('AdminEditTypeImage');
    Route::post('/album/typeimage/modifier/{id}', 'TypeImageController@update')->name('AdminUpdateTypeImage');
    //Album photos
    Route::get('/album/image/index', 'AlbumController@index')->name('AdminIndexImage');
    Route::get('/album/image/gestion/{id}', 'AlbumController@GestionPhotoGroupe')->name('AdminGestionImageType');
    Route::get('/album/image/delete/{id}', 'AlbumController@delete')->name('AdminDeleteImage');
    Route::get('/album/image/deletetout/{id}', 'AlbumController@VideTout')->name('AdminDeleteToutImage');
    Route::get('/album/image/ordre/{liste}', 'AlbumController@Ordre')->name('AdminOrdreImage');
    Route::get('/album/image/import/{id}', 'AlbumController@create')->name('AdminCreateImage');
    Route::post('/album/image/import/{id}', 'AlbumController@store')->name('AdminStoreImage');
});


//login
Route::group(['prefix' => 'gestion'], function () {
    Route::get('/login', 'Auth\AuthController@showLoginForm')->name('NameLogin');
    Route::post('login', 'Auth\AuthController@login');
    Route::get('/logout', 'Auth\AuthController@logout')->name('NameLogout');

    // Registration Routes...
    $this->get('/register', 'Auth\AuthController@showRegistrationForm');
    $this->post('/register', 'Auth\AuthController@register');

});


Route::get('/home', 'HomeController@index');
