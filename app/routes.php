<?php
/* Si no hay usuario logueado redirecciona a la página de login*/
if(!isset(Auth::user()->id)){
	Route::get('/dashboard', function(){
		return Redirect::to('/auth/login');
	});
}

Route::get('/', function(){
	return Redirect::to('/auth/login');
});

/* -------------------------------------------------- */
/* Auth Links */

Route::get('/auth/login', ['as' => 'login', 'uses' => 'AuthController@showLogin']);
Route::post('/auth/login', ['as' => 'login', 'uses' => 'AuthController@login']);

Route::get('/auth/register', ['as' => 'register', 'uses' => 'AuthController@showRegister']);
Route::post('/auth/register', ['as' => 'register', 'uses' => 'AuthController@register']);

Route::get('/auth/forgot', ['uses' => 'AuthController@showForgot']);
Route::post('/auth/forgot', ['uses' => 'RemindersController@postRemind']);

Route::get('/auth/forgot/{token}', ['uses' => 'RemindersController@getReset']);
Route::post('/auth/forgot/reset', ['uses' => 'RemindersController@postReset']);

Route::get('/auth/logout', ['uses' => 'AuthController@logout']);

/* :Auth Links */
/* -------------------------------------------------- */

// Paneles
Route::group(['before' => 'auth'], function () {

	if(Auth::user()){

		Route::get('/', ['uses' => 'UserController@dashboard']);

		/* License */
		Route::resource('licenses', 'LicenseController');
		Route::get('/licenses/delete/{id}', 'LicenseController@destroy');
		/*Route::get('/libros/delete/{id}', 'BookController@destroy');
		Route::post('/libros/update/{id}', 'BookController@update');

		Route::resource('estudiantes', 'StudentController');
		Route::get('/estudiantes/delete/{id}', 'StudentController@destroy');
		Route::post('/estudiantes/update/{id}', 'StudentController@update');



		Route::get('/prestamos', 'StudentController@prestamos');

		Route::post('/prestar', 'StudentController@prestar');

		Route::get('/devolver/{id}', 'StudentController@devolver');*/


		require (__DIR__ . '/routes/shared.php');
	}

});

// Error Handle

App::missing(function($exception)
{
	if(Auth::user()){
		//return Redirect::to('/panel')->with('alert', ['type' => 'danger', 'message' => 'Ocurrio un extraño error, intenta de nuevo.']);
	}else{
		return Redirect::to('/auth/login')->with('alert', ['type' => 'danger', 'message' => 'Ocurrio un extraño error, intenta de nuevo.']);
	}

});