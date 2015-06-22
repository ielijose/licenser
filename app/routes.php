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

		Route::get('/settings', ['uses' => 'UserController@settings']);
		Route::post('/settings', ['uses' => 'UserController@settings_post']);

		Route::get('/payments', ['uses' => 'UserController@payments']);


		/* License */
		Route::resource('licenses', 'LicenseController');
		Route::get('/licenses/delete/{id}', 'LicenseController@destroy');

		require (__DIR__ . '/routes/shared.php');
	}

});

/* PayPal */
Route::get('payment/prepare', array(
    'as' => 'payment.prepare',
    'uses' => 'PaypalController@prepare',
));

Route::any('payment', array(
    'as' => 'payment',
    'uses' => 'PaypalController@postPayment',
));
// this is after make the payment, PayPal redirect back to your site
Route::get('payment/status', array(
    'as' => 'payment.status',
    'uses' => 'PaypalController@getPaymentStatus',
));

Route::get('payment/success', array(
    'as' => 'payment.success',
    'uses' => 'PaypalController@success',
));

Route::get('payment/failed', array(
    'as' => 'payment.failed',
    'uses' => 'PaypalController@failed',
));

/* API */
	Route::post('/api/activate', ['uses' => 'ApiController@activate']);

Route::get('/download/plugin/{token}', ['uses' => 'ApiController@download']);


// Error Handle

App::missing(function($exception)
{
	if(Auth::user()){
		//return Redirect::to('/panel')->with('alert', ['type' => 'danger', 'message' => 'Ocurrio un extraño error, intenta de nuevo.']);
	}else{
		return Redirect::to('/auth/login')->with('alert', ['type' => 'danger', 'message' => 'Ocurrio un extraño error, intenta de nuevo.']);
	}

});