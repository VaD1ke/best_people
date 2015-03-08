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

Route::get('/', 'MainController@index');

Route::get('/login', function() {
    if (Auth::check())
        return redirect('/');
    else
        return view('auth');
});

Route::get('/logout', function() {
    Auth::logout();
    return redirect()->back();
});

Route::get('/registration', function() {
    if (Auth::check())
        return redirect('/');
    else
        return view('registration');
});

Route::get('/edit', function() {
    if (Auth::check())
        return view('edit');
    else
        return redirect('/');
});

Route::get('/user/{id}', 'UserController@getUser');



Route::group(['prefix' => 'vote'], function () {
    Route::post('up', 'UserController@voteUp');
    Route::post('down', 'UserController@voteDown');

});

Route::post('/edit', 'UserController@edit');

Route::post('/login', 'UserController@authenticate');

Route::post('/registration', 'UserController@register');

Route::post('/user/{id}', 'UserController@leftComment');

/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/
