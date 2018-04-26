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

Route::get('/', ['middleware' => 'auth', function () {
    return view('home');
}]);
Route::resource('reporte', 'StreamController');
Route::controllers([
    '/' => 'Auth\AuthController'
]);

Route::get('/register', function ()    {
    return view('home');
});
Route::get('/password', function ()    {
    return view('home');
});

