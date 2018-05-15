<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use Cache;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*Route::get('/test123', function () {
    return response('Test API', 200)
                  ->header('Content-Type', 'application/json');
});*/

Route::post('login', 'API\PassportController@login');
 
Route::post('register', 'API\PassportController@register');

Route::group(['middleware' => 'auth:api'], function(){
 	Route::get('get-user-details', 'API\PassportController@getDetails');
 	Route::post('add-employee', 'API\PassportController@insertEmp');
 	Route::get('emplist', ['uses' => 'API\PassportController@empList']);
 	Route::get('logout', 'API\PassportController@logout');
});