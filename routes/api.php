<?php

use Illuminate\Http\Request;

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


Route::post('login', 'API\PassportController@login');
Route::post('register', 'API\PassportController@register');
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('/claim-form-data', 'API\PassportController@getClaimFormData');
    Route::post('/claim/create', 'API\PassportController@createClaim');
    Route::get('/categories', 'API\PassportController@getCategories');
    Route::get('/user/roles', 'API\PassportController@getUserRoles');
    Route::get('/category/{id?}', 'API\PassportController@getCategory');
    Route::get('/claim/{id?}', 'API\PassportController@getClaim');
    Route::get('/claims/open', 'API\PassportController@getOpenClaims');

    Route::delete('/claim/image/{id?}', 'API\PassportController@deleteClaimImage');
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::post('/v2/claim-form-data', 'API\V2\PassportController@getClaimFormData');
});