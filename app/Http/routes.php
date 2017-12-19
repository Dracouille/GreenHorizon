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

Route::get('/galerie', function () {
    return view('galerie');
})->name('galerie');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/avis', function () {
    return view('avis');
})->name('avis');


//Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
	Route::get('/', 'Back\AdminController@index')->name('AdminIndex');
	Route::get('/commentaire', 'Back\AdminController@GestionCom')->name('GestionCom');
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
